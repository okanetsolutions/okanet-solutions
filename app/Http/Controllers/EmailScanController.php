<?php

namespace App\Http\Controllers;

use App\Jobs\CheckEmailExposure;
use App\Models\EmailScan;
use App\Services\Breachsense;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Throwable;

class EmailScanController extends Controller
{
    public function store(Request $request, Breachsense $breachsense): RedirectResponse
    {
        $request->validate(['consent' => ['accepted']], [
            'consent.accepted' => 'Autoriza la consulta de tu correo en Breachsense para continuar.',
        ]);
        if (! config('services.breachsense.enabled') || blank(config('services.breachsense.key'))) {
            throw ValidationException::withMessages(['scan' => 'La consulta de filtraciones no está disponible por el momento. Inténtalo más tarde.']);
        }

        $scan = EmailScan::firstOrCreate(['user_id' => $request->user()->id], ['email' => $request->user()->email]);
        $shouldCheck = $scan->wasRecentlyCreated;
        if (! $shouldCheck) {
            $shouldCheck = EmailScan::whereKey($scan->id)->where('status', EmailScan::Failed)
                ->update(['status' => EmailScan::Queued]) === 1;
        }
        if ($shouldCheck) {
            $job = new CheckEmailExposure($scan->id);

            try {
                $job->handle($breachsense);
            } catch (Throwable $exception) {
                $job->failed($exception);
                report($exception);
                throw ValidationException::withMessages(['scan' => 'No pudimos completar la consulta. Inténtalo de nuevo más tarde.']);
            }

            if ($scan->refresh()->status !== EmailScan::Completed) {
                throw ValidationException::withMessages(['scan' => 'No pudimos completar la consulta. Inténtalo de nuevo más tarde.']);
            }
        }

        $status = $scan->status === EmailScan::Completed
            ? 'Consulta completada. Tu resultado ya está disponible.'
            : 'Tu consulta ya está en proceso. Te avisaremos cuando termine.';

        return redirect()->route('security.dashboard')->with('status', $status);
    }

    public function requestDetails(Request $request, EmailScan $scan): RedirectResponse
    {
        abort_unless($scan->user_id === $request->user()->id, 404);
        abort_unless($scan->status === EmailScan::Completed, 409);
        EmailScan::whereKey($scan->id)->whereNull('details_requested_at')->update(['details_requested_at' => now()]);

        return back()->with('status', 'Solicitud recibida. Te contactaremos para compartir el informe completo y los siguientes pasos.');
    }
}
