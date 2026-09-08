<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\EmailScan;
use App\Models\SecurityAssessment;
use App\Notifications\AssessmentReportReady;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Throwable;

class SecurityAssessmentController extends Controller
{
    public function index(): View
    {
        return view('admin.assessments.index', [
            'assessments' => SecurityAssessment::with('user')->whereNotNull('authorized_at')
                ->orderByRaw('CASE WHEN status IN (?, ?) THEN 0 ELSE 1 END', [SecurityAssessment::Requested, SecurityAssessment::InProgress])
                ->orderBy('due_at')->orderBy('id')->paginate(20),
            'emailRequests' => EmailScan::with('user')->whereNotNull('details_requested_at')
                ->whereNull('followup_completed_at')->oldest('details_requested_at')->paginate(20, ['*'], 'email_page'),
            'reportRequests' => SecurityAssessment::with('user')->whereNotNull('full_report_requested_at')
                ->whereNull('followup_completed_at')->oldest('full_report_requested_at')->paginate(20, ['*'], 'report_page'),
        ]);
    }

    public function show(SecurityAssessment $assessment): View
    {
        return view('admin.assessments.show', ['assessment' => $assessment->load('user')]);
    }

    public function start(SecurityAssessment $assessment): RedirectResponse
    {
        if (! $assessment->authorized_at || $assessment->status !== SecurityAssessment::Requested || $assessment->due_at->isPast()) {
            throw ValidationException::withMessages(['assessment' => 'No puedes iniciar esta evaluación: requiere una autorización vigente y estado solicitado.']);
        }
        SecurityAssessment::whereKey($assessment->id)->where('status', SecurityAssessment::Requested)
            ->where('due_at', '>', now())->update(['status' => SecurityAssessment::InProgress]);

        return back()->with('status', 'Evaluación en revisión. Respeta los límites y la ventana de autorización.');
    }

    public function upload(Request $request, SecurityAssessment $assessment): RedirectResponse
    {
        abort_unless($assessment->authorized_at && in_array($assessment->status, [SecurityAssessment::InProgress, SecurityAssessment::ReportReady], true), 409);
        $data = $request->validate([
            'summary' => ['required', 'string', 'max:5000'],
            'report' => ['required', 'file', 'mimes:pdf', 'extensions:pdf', 'max:10240'],
        ]);
        $path = $request->file('report')->store('assessments/'.$assessment->id, 'reports');
        $oldPath = null;
        try {
            DB::transaction(function () use ($assessment, $data, $path, &$oldPath): void {
                $current = SecurityAssessment::whereKey($assessment->id)->lockForUpdate()->firstOrFail();
                abort_unless(in_array($current->status, [SecurityAssessment::InProgress, SecurityAssessment::ReportReady], true), 409);
                $oldPath = $current->report_path;
                $current->forceFill([
                    'summary' => $data['summary'], 'report_path' => $path,
                    'report_ready_at' => now(), 'status' => SecurityAssessment::ReportReady,
                ])->save();
            });
        } catch (Throwable $exception) {
            Storage::disk('reports')->delete($path);
            throw $exception;
        }
        if ($oldPath) {
            Storage::disk('reports')->delete($oldPath);
        }

        return back()->with('status', 'Informe preparado. Revísalo y pulsa «Entregar informe» para avisar al cliente.');
    }

    public function deliver(SecurityAssessment $assessment): RedirectResponse
    {
        DB::transaction(function () use ($assessment): void {
            $current = SecurityAssessment::with('user')->whereKey($assessment->id)->lockForUpdate()->firstOrFail();
            if ($current->status === SecurityAssessment::Delivered) {
                return;
            }
            abort_unless($current->status === SecurityAssessment::ReportReady && $current->report_path, 409);
            abort_unless($current->user->hasVerifiedEmail(), 409);
            abort_unless(Storage::disk('reports')->exists($current->report_path), 409);

            $current->user->notify(new AssessmentReportReady($current->id));
            $current->forceFill(['status' => SecurityAssessment::Delivered, 'delivered_at' => now()])->save();
        });

        return back()->with('status', 'Informe disponible para el cliente y aviso enviado por correo.');
    }

    public function download(SecurityAssessment $assessment): StreamedResponse
    {
        abort_unless($assessment->report_path, 404);
        abort_unless(Storage::disk('reports')->exists($assessment->report_path), 404);

        return Storage::disk('reports')->download($assessment->report_path, 'informe-'.$assessment->domain.'.pdf', [
            'Content-Type' => 'application/pdf', 'X-Content-Type-Options' => 'nosniff',
        ]);
    }

    public function completeEmailFollowup(EmailScan $scan): RedirectResponse
    {
        abort_unless($scan->details_requested_at, 409);
        $scan->forceFill(['followup_completed_at' => now()])->save();

        return back()->with('status', 'Seguimiento de correo marcado como atendido.');
    }

    public function completeReportFollowup(SecurityAssessment $assessment): RedirectResponse
    {
        abort_unless($assessment->full_report_requested_at, 409);
        $assessment->forceFill(['followup_completed_at' => now()])->save();

        return back()->with('status', 'Solicitud de informe completo marcada como atendida.');
    }
}
