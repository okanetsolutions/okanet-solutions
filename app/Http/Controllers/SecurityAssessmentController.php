<?php

namespace App\Http\Controllers;

use App\Models\SecurityAssessment;
use App\Rules\PublicDomain;
use App\Services\DnsLookup;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\StreamedResponse;

class SecurityAssessmentController extends Controller
{
    public function store(Request $request): RedirectResponse
    {
        if (is_string($request->input('domain'))) {
            $request->merge(['domain' => strtolower(rtrim(trim($request->input('domain')), '.'))]);
        }
        $data = $request->validate(['domain' => ['required', 'string', new PublicDomain]]);
        $assessment = SecurityAssessment::firstOrCreate([
            'user_id' => $request->user()->id, 'domain' => $data['domain'],
        ], ['dns_token' => Str::random(64), 'dns_expires_at' => now()->addDays(7)]);

        return redirect()->route('security.assessments.show', $assessment);
    }

    public function show(Request $request, SecurityAssessment $assessment): View
    {
        abort_unless($assessment->user_id === $request->user()->id, 404);

        return view('security.assessment', compact('assessment'));
    }

    public function verify(Request $request, SecurityAssessment $assessment, DnsLookup $dns): RedirectResponse
    {
        abort_unless($assessment->user_id === $request->user()->id, 404);
        abort_unless($assessment->status === SecurityAssessment::PendingVerification, 409);
        if ($assessment->dns_expires_at->isPast()) {
            throw ValidationException::withMessages(['dns' => 'El código ha vencido. Genera uno nuevo y actualiza el registro TXT.']);
        }
        if (! $dns->hasTxtRecord($assessment->dnsName(), $assessment->dns_token)) {
            return back()->with('warning', 'Todavía no encontramos el registro TXT correcto. Revisa el nombre y el valor; la propagación puede tardar.');
        }
        SecurityAssessment::whereKey($assessment->id)
            ->where('status', SecurityAssessment::PendingVerification)->where('dns_token', $assessment->dns_token)
            ->update(['dns_verified_at' => now()]);

        return back()->with('status', 'Dominio verificado. Revisa el alcance y autoriza la evaluación.');
    }

    public function renew(Request $request, SecurityAssessment $assessment): RedirectResponse
    {
        abort_unless($assessment->user_id === $request->user()->id, 404);
        abort_unless($assessment->status === SecurityAssessment::PendingVerification, 409);
        SecurityAssessment::whereKey($assessment->id)->where('status', SecurityAssessment::PendingVerification)
            ->where('dns_expires_at', '<', now())->update([
                'dns_token' => Str::random(64), 'dns_expires_at' => now()->addDays(7), 'dns_verified_at' => null,
            ]);

        return back()->with('status', 'Usa el código vigente que aparece en esta página.');
    }

    public function authorizeAssessment(Request $request, SecurityAssessment $assessment, DnsLookup $dns): RedirectResponse
    {
        abort_unless($assessment->user_id === $request->user()->id, 404);
        $request->validate(['authorization' => ['accepted']], ['authorization.accepted' => 'Debes aceptar el alcance para autorizar la evaluación.']);
        if ($assessment->authorized_at) {
            return back()->with('status', 'La evaluación ya fue solicitada.');
        }
        if (! $assessment->dns_verified_at || $assessment->dns_expires_at->isPast()
            || ! $dns->hasTxtRecord($assessment->dnsName(), $assessment->dns_token)) {
            throw ValidationException::withMessages(['dns' => 'Verifica de nuevo el registro DNS antes de autorizar.']);
        }

        DB::transaction(function () use ($assessment, $request): void {
            $current = SecurityAssessment::whereKey($assessment->id)->lockForUpdate()->firstOrFail();
            if ($current->authorized_at) {
                return;
            }
            if ($current->dns_token !== $assessment->dns_token || $current->dns_expires_at->isPast()) {
                throw ValidationException::withMessages(['dns' => 'El código cambió o venció. Verifica de nuevo el dominio.']);
            }
            $current->forceFill([
                'authorized_by' => $request->user()->name,
                'authorization_email' => $request->user()->email,
                'authorization_ip' => $request->ip(),
                'authorization_version' => config('security.authorization_version'),
                'authorization_text' => 'Dominio autorizado: '.$current->domain.'. '.config('security.authorization_text'),
                'authorized_at' => now(), 'due_at' => now()->addHours(48), 'status' => SecurityAssessment::Requested,
            ])->save();
        });

        return back()->with('status', 'Evaluación solicitada. Recibirás un informe preliminar en 24–48 horas.');
    }

    public function download(Request $request, SecurityAssessment $assessment): StreamedResponse
    {
        abort_unless($assessment->user_id === $request->user()->id, 404);
        abort_unless($assessment->status === SecurityAssessment::Delivered && $assessment->report_path, 404);
        abort_unless(Storage::disk('reports')->exists($assessment->report_path), 404);

        return Storage::disk('reports')->download($assessment->report_path, 'informe-'.$assessment->domain.'.pdf', [
            'Content-Type' => 'application/pdf', 'X-Content-Type-Options' => 'nosniff',
        ]);
    }

    public function requestFullReport(Request $request, SecurityAssessment $assessment): RedirectResponse
    {
        abort_unless($assessment->user_id === $request->user()->id, 404);
        abort_unless($assessment->status === SecurityAssessment::Delivered, 409);
        SecurityAssessment::whereKey($assessment->id)->whereNull('full_report_requested_at')->update(['full_report_requested_at' => now()]);

        return back()->with('status', 'Solicitud recibida. Te contactaremos para conversar sobre el informe completo y los siguientes pasos.');
    }
}
