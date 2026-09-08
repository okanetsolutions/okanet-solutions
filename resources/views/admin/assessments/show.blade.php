@extends('layouts.account')
@section('title', 'Gestionar evaluación — Okanet Solutions')
@section('account-content')
    <a class="text-link" href="{{ route('admin.assessments.index') }}" wire:navigate>← Evaluaciones y solicitudes</a>
    <div class="account-heading"><h1>{{ $assessment->domain }}</h1><p>{{ $assessment->statusLabel() }} · {{ $assessment->user->name }} · {{ $assessment->user->email }}</p></div>
    <div class="account-columns">
        <section class="account-panel">
            <h2>Alcance y autorización</h2>
            @if($assessment->authorized_at)
                <p>{{ $assessment->authorization_text }}</p>
                <dl class="account-details"><dt>Representante</dt><dd>{{ $assessment->authorized_by }} · {{ $assessment->authorization_email }}</dd><dt>Autorización</dt><dd>{{ $assessment->authorized_at->format('d/m/Y H:i') }} UTC · IP {{ $assessment->authorization_ip }}</dd><dt>Versión</dt><dd>{{ $assessment->authorization_version }}</dd><dt>Límite de respuesta y pruebas</dt><dd>{{ $assessment->due_at->format('d/m/Y H:i') }} UTC</dd></dl>
                @if($assessment->due_at->isPast())<p class="account-notice account-error">La ventana autorizada ha vencido. No inicies nuevas pruebas; contacta al cliente para acordar una nueva autorización.</p>@endif
                @if($assessment->status === \App\Models\SecurityAssessment::Requested && $assessment->due_at->isFuture())
                    <form method="post" action="{{ route('admin.assessments.start', $assessment) }}">@csrf<button class="button" type="submit">Marcar en revisión</button></form>
                @endif
            @else
                <p>Esta solicitud todavía no tiene autorización. No realices pruebas.</p>
            @endif
        </section>
        <section class="account-panel">
            <h2>Informe preliminar</h2>
            @if(in_array($assessment->status, [\App\Models\SecurityAssessment::InProgress, \App\Models\SecurityAssessment::ReportReady], true))
                <form method="post" action="{{ route('admin.assessments.upload', $assessment) }}" enctype="multipart/form-data" class="account-form">
                    @csrf
                    <div><label for="summary">Resumen para el cliente</label><textarea id="summary" name="summary" rows="6" required maxlength="5000" aria-describedby="summary-help">{{ old('summary', $assessment->summary) }}</textarea><p id="summary-help" class="account-help">Incluye los hallazgos principales, su gravedad y recomendaciones. No incluyas contraseñas ni secretos.</p></div>
                    <div><label for="report">Informe PDF (máximo 10 MB)</label><input id="report" type="file" name="report" accept="application/pdf,.pdf" required></div>
                    <button class="button" type="submit">{{ $assessment->report_path ? 'Reemplazar informe' : 'Guardar informe' }}</button>
                </form>
            @elseif($assessment->status !== \App\Models\SecurityAssessment::Delivered)
                <p>Marca la evaluación como «En revisión» para preparar el informe.</p>
            @endif
            @if($assessment->report_path)
                <p class="account-preserve">{{ $assessment->summary }}</p>
                <a class="text-link" href="{{ route('admin.assessments.download', $assessment) }}">Descargar y revisar PDF</a>
            @endif
            @if($assessment->status === \App\Models\SecurityAssessment::ReportReady)
                <form method="post" action="{{ route('admin.assessments.deliver', $assessment) }}" class="account-form">@csrf<p>Al entregar, el cliente podrá descargar el informe y recibirá un aviso por correo.</p><button class="button" type="submit">Entregar informe</button></form>
            @elseif($assessment->delivered_at)
                <p class="account-notice">Informe disponible y aviso enviado el {{ $assessment->delivered_at->format('d/m/Y H:i') }} UTC.</p>
            @endif
        </section>
    </div>
@endsection
