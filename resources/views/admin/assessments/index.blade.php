@extends('layouts.account')
@section('title', 'Evaluaciones y solicitudes — Okanet Solutions')
@section('account-content')
    <div class="account-heading"><h1>Evaluaciones y solicitudes.</h1><p>Revisa las autorizaciones, realiza la evaluación y entrega un informe preliminar. Todas las horas se muestran en UTC.</p></div>
    <section class="account-section">
        <h2>Evaluaciones autorizadas</h2>
        @forelse($assessments as $assessment)
            <a class="account-row" href="{{ route('admin.assessments.show', $assessment) }}">
                <span><strong>{{ $assessment->domain }}</strong><small>{{ $assessment->user->email }}</small></span>
                <span>{{ $assessment->statusLabel() }}</span>
                <span>Límite: {{ $assessment->due_at->format('d/m/Y H:i') }} @if($assessment->due_at->isPast() && $assessment->status !== \App\Models\SecurityAssessment::Delivered)<strong> · Plazo vencido</strong>@endif</span>
            </a>
        @empty
            <p>No hay evaluaciones autorizadas. Las solicitudes aparecen cuando el cliente verifica el DNS y acepta el alcance.</p>
        @endforelse
        {{ $assessments->links() }}
    </section>
    <section class="account-section">
        <h2>Solicitudes de información sobre correos</h2>
        @forelse($emailRequests as $scan)
            <div class="account-row"><span><strong>{{ $scan->user->name }}</strong><small>{{ $scan->email }}</small></span><span>{{ $scan->exposure_count }} registros · {{ $scan->details_requested_at->format('d/m/Y H:i') }}</span><form method="post" action="{{ route('admin.email.followup', $scan) }}">@csrf<button class="button button-small" type="submit">Marcar atendida</button></form></div>
        @empty
            <p>No hay solicitudes de correo pendientes de seguimiento.</p>
        @endforelse
        {{ $emailRequests->links() }}
    </section>
    <section class="account-section">
        <h2>Solicitudes de informe completo</h2>
        @forelse($reportRequests as $assessment)
            <div class="account-row"><a class="text-link" href="{{ route('admin.assessments.show', $assessment) }}">{{ $assessment->domain }}</a><span>{{ $assessment->user->email }}</span><form method="post" action="{{ route('admin.assessments.followup', $assessment) }}">@csrf<button class="button button-small" type="submit">Marcar atendida</button></form></div>
        @empty
            <p>No hay solicitudes de informe completo pendientes.</p>
        @endforelse
        {{ $reportRequests->links() }}
    </section>
@endsection
