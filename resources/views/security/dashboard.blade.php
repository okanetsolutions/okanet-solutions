@extends('layouts.account')
@section('title', 'Mi seguridad — Okanet Solutions')
@section('account-content')
    <div class="account-heading"><h1>Conoce tu exposición.</h1><p>Tu correo está verificado. Elige por dónde empezar.</p></div>
    <div class="account-columns">
        <section class="account-panel" aria-labelledby="email-title">
            <p class="account-help">Consulta gratuita · Resultado inmediato</p>
            <h2 id="email-title">Tu correo corporativo</h2>
            @if($scan?->status === \App\Models\EmailScan::Completed)
                <p class="account-result">{{ $scan->exposure_count > 0 ? 'Encontramos exposición.' : 'No encontramos exposición.' }}</p>
                <p>La revisión de <strong>{{ $scan->maskedEmail() }}</strong> está lista.</p>
                <div class="account-report-preview" aria-hidden="true">
                    <div class="account-report-preview-data">
                        <span>Registros asociados</span><i></i>
                        <span>Fuentes identificadas</span><i></i>
                        <span>Contexto del hallazgo</span><i></i>
                    </div>
                    <span class="account-report-preview-label">Detalle protegido</span>
                </div>
                <p>Mostramos solo el resultado general para proteger la información. Contacta con nuestro equipo para recibir el informe completo.</p>
                <p class="account-help">Consulta: {{ $scan->checked_at->format('d/m/Y H:i') }} UTC. Fuente: Breachsense, base de filtraciones de credenciales. No encontrar resultados no garantiza ausencia de exposición.</p>
                @if($scan->details_requested_at)
                    <p class="account-notice account-success">Recibimos tu solicitud del informe completo. Te contactaremos en tu correo verificado.</p>
                @else
                    <form method="post" action="{{ route('security.email.details', $scan) }}">@csrf<button class="button" type="submit">Solicitar informe completo</button></form>
                    <p class="account-help">Al solicitarlo, autorizas que te contactemos sobre el informe, los hallazgos y nuestros servicios de seguridad.</p>
                @endif
            @elseif($scan?->status === \App\Models\EmailScan::Queued)
                <p class="account-notice account-warning" role="status">Tu consulta anterior sigue en proceso. No necesitas actualizar esta página; te avisaremos cuando termine.</p>
            @else
                @if($scan?->status === \App\Models\EmailScan::Failed)<p class="account-notice account-error" role="alert">No pudimos completar la consulta. No hay un resultado disponible; puedes volver a intentarlo.</p>@endif
                <p>Comprueba si <strong>{{ auth()->user()->email }}</strong> aparece en las filtraciones de credenciales de Breachsense.</p>
                @if($scanAvailable)
                    <form method="post" action="{{ route('security.email.store') }}" class="account-form">
                        @csrf
                        <label class="account-check"><input type="checkbox" name="consent" value="1" required><span>Solicito la consulta de mi correo y autorizo su envío a Breachsense para obtener el resultado. <a href="{{ route('privacy') }}">Cómo tratamos tus datos</a>.</span></label>
                        <button class="button" type="submit">{{ $scan ? 'Volver a intentar' : 'Consultar mi correo' }}</button>
                    </form>
                @else
                    <p class="account-notice account-warning">La consulta de correo no está disponible por el momento. Puedes solicitar una evaluación de tu dominio.</p>
                @endif
            @endif
        </section>
        <section class="account-panel" aria-labelledby="domain-title">
            <p class="account-help">Evaluación preliminar gratuita</p>
            <h2 id="domain-title">El dominio de tu empresa</h2>
            <p>Verifica el control del dominio mediante DNS y autoriza una revisión manual. Te responderemos en 24–48 horas con un informe preliminar.</p>
            <form method="post" action="{{ route('security.assessments.store') }}" class="account-form">
                @csrf
                <div><label for="domain">Dominio</label><input id="domain" name="domain" value="{{ old('domain') }}" placeholder="empresa.com" required maxlength="253" autocomplete="off" autocapitalize="none" spellcheck="false" aria-describedby="domain-help"><p id="domain-help" class="account-help">Solo el dominio, sin https:// ni rutas. Debes poder añadir un registro TXT en su DNS.</p></div>
                <button class="button" type="submit">Verificar mi dominio</button>
            </form>
            <p class="account-help">El plazo empieza cuando terminas la verificación y autorizas la evaluación. Las pruebas de penetración adicionales se acuerdan por separado.</p>
        </section>
    </div>
    <section class="account-section">
        <h2>Tus evaluaciones</h2>
        @forelse($assessments as $assessment)
            <a class="account-row" href="{{ route('security.assessments.show', $assessment) }}"><strong>{{ $assessment->domain }}</strong><span>{{ $assessment->statusLabel() }}</span><span>Ver solicitud →</span></a>
        @empty
            <p>Aquí aparecerán los dominios que registres y sus informes.</p>
        @endforelse
        {{ $assessments->links() }}
    </section>
@endsection
