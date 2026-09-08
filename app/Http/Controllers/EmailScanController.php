<?php

namespace App\Http\Controllers;

use App\Jobs\CheckEmailExposure;
use App\Models\EmailScan;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Throwable;

class EmailScanController extends Controller
{
    public function store(Request $request): RedirectResponse
    {
        $request->validate(['consent' => ['accepted']], [
            'consent.accepted' => 'Autoriza la consulta de tu correo en Breachsense para continuar.',
        ]);
        if (! config('services.breachsense.enabled') || blank(config('services.breachsense.key'))) {
            throw ValidationException::withMessages(['scan' => 'La consulta de filtraciones no está disponible por el momento. Inténtalo más tarde.']);
        }

        $scan = EmailScan::firstOrCreate(['user_id' => $request->user()->id], ['email' => $request->user()->email]);
        $shouldDispatch = $scan->wasRecentlyCreated;
        if (! $shouldDispatch) {
            $shouldDispatch = EmailScan::whereKey($scan->id)->where('status', EmailScan::Failed)
                ->update(['status' => EmailScan::Queued]) === 1;
        }
        if ($shouldDispatch) {
            try {
                CheckEmailExposure::dispatch($scan->id)->afterCommit();
            } catch (Throwable $exception) {
                EmailScan::whereKey($scan->id)->where('status', EmailScan::Queued)->update(['status' => EmailScan::Failed]);
                report($exception);
                throw ValidationException::withMessages(['scan' => 'No pudimos poner la consulta en cola. Inténtalo de nuevo más tarde.']);
            }
        }

        return redirect()->route('security.dashboard')->with('status', 'Consulta recibida. Actualiza esta página para ver el resultado.');
    }

    public function requestDetails(Request $request, EmailScan $scan): RedirectResponse
    {
        abort_unless($scan->user_id === $request->user()->id, 404);
        abort_unless($scan->status === EmailScan::Completed, 409);
        EmailScan::whereKey($scan->id)->whereNull('details_requested_at')->update(['details_requested_at' => now()]);

        return back()->with('status', 'Solicitud recibida. Nos pondremos en contacto contigo en tu correo verificado.');
    }
}
