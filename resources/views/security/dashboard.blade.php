@extends('layouts.account')
@section('title', 'Mi seguridad — Okanet Solutions')
@section('account-content')
    <div class="account-heading"><h1>Conoce tu exposición.</h1><p>Tu correo está verificado. Elige por dónde empezar.</p></div>
    <div class="account-columns">
        <section class="account-panel" aria-labelledby="email-title">
            <p class="account-help">Consulta gratuita</p>
            <h2 id="email-title">Tu correo corporativo</h2>
            @if($scan?->status === \App\Models\EmailScan::Completed)
                <p class="account-result">{{ $scan->exposure_count > 0 ? 'Encontramos exposición.' : 'No encontramos exposición.' }}</p>
                <p><strong>{{ $scan->exposure_count }}</strong> {{ $scan->exposure_count === 1 ? 'registro asociado' : 'registros asociados' }} a <strong>{{ $scan->maskedEmail() }}</strong> en las filtraciones de credenciales consultadas.</p>
                <p class="account-help">Consulta: {{ $scan->checked_at->format('d/m/Y H:i') }} UTC. Fuente: Breachsense, base de filtraciones de credenciales. Los registros no equivalen necesariamente a filtraciones distintas. No encontrar resultados no garantiza ausencia de exposición.</p>
                @if($scan->details_requested_at)
                    <p class="account-notice">Solicitud de información recibida. Te contactaremos en tu correo verificado.</p>
                @else
                    <form method="post" action="{{ route('security.email.details', $scan) }}">@csrf<button class="button" type="submit">Solicitar más información</button></form>
                    <p class="account-help">Al solicitarla, autorizas que te contactemos sobre los hallazgos y nuestros servicios de seguridad.</p>
                @endif
            @elseif($scan?->status === \App\Models\EmailScan::Queued)
                <p class="account-notice" role="status">Tu consulta está en cola. Estamos preparando el resultado.</p>
                <a class="button" href="{{ route('security.dashboard') }}">Actualizar resultado</a>
            @else
                @if($scan?->status === \App\Models\EmailScan::Failed)<p class="account-notice account-error">No pudimos completar la consulta. No hay un resultado disponible; puedes volver a intentarlo.</p>@endif
                <p>Comprueba si <strong>{{ auth()->user()->email }}</strong> aparece en las filtraciones de credenciales de Breachsense.</p>
                @if($scanAvailable)
                    <form method="post" action="{{ route('security.email.store') }}" class="account-form">
                        @csrf
                        <label class="account-check"><input type="checkbox" name="consent" value="1" required><span>Solicito la consulta de mi correo y autorizo su envío a Breachsense para obtener el resultado. <a href="{{ route('privacy') }}">Cómo tratamos tus datos</a>.</span></label>
                        <button class="button" type="submit">{{ $scan ? 'Volver a intentar' : 'Consultar mi correo' }}</button>
                    </form>
                @else
                    <p class="account-notice">La consulta de correo no está disponible por el momento. Puedes solicitar una evaluación de tu dominio.</p>
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
