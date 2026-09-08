@extends('layouts.account')
@section('title', 'Evaluación de dominio — Okanet Solutions')
@section('account-content')
    <a class="text-link" href="{{ route('security.dashboard') }}" wire:navigate>← Mis evaluaciones</a>
    <div class="account-heading"><h1>{{ $assessment->domain }}</h1><p>{{ $assessment->statusLabel() }}</p></div>
    @if($assessment->status === \App\Models\SecurityAssessment::PendingVerification)
        <div class="account-columns">
            <section class="account-panel">
                <h2>1. Verifica tu dominio</h2>
                <p>Añade este registro en el proveedor que administra el DNS de tu dominio. Si pide solo el nombre del registro, introduce <code>_okanet-verification</code>.</p>
                <dl class="account-details">
                    <dt>Tipo</dt><dd>TXT</dd>
                    <dt>Nombre completo</dt><dd><code>{{ $assessment->dnsName() }}</code></dd>
                    <dt>Valor</dt><dd><code>{{ $assessment->dns_token }}</code></dd>
                    <dt>Válido hasta</dt><dd>{{ $assessment->dns_expires_at->format('d/m/Y H:i') }} UTC</dd>
                </dl>
                @if($assessment->dns_expires_at->isPast())
                    <p>Este código ha vencido. Genera uno nuevo y reemplaza el valor del registro.</p>
                    <form method="post" action="{{ route('security.assessments.renew', $assessment) }}">@csrf<button class="button" type="submit">Generar nuevo código</button></form>
                @else
                    @if($assessment->dns_verified_at)<p class="account-notice">Registro DNS verificado. Consérvalo hasta completar la autorización.</p>@endif
                    <form method="post" action="{{ route('security.assessments.verify', $assessment) }}">@csrf<button class="button" type="submit">Comprobar registro DNS</button></form>
                    <p class="account-help">La propagación puede tardar. Puedes volver a comprobarlo sin cambiar el código.</p>
                @endif
            </section>
            <section class="account-panel">
                <h2>2. Autoriza la evaluación</h2>
                <p><strong>Único dominio incluido: {{ $assessment->domain }}</strong></p>
                <p>{{ config('security.authorization_text') }}</p>
                @if($assessment->dns_verified_at && $assessment->dns_expires_at->isFuture())
                    <form method="post" action="{{ route('security.assessments.authorize', $assessment) }}" class="account-form">
                        @csrf
                        <label class="account-check"><input type="checkbox" name="authorization" value="1" required><span>Acepto este alcance y autorizo la evaluación en nombre de mi empresa, como {{ auth()->user()->name }} ({{ auth()->user()->email }}).</span></label>
                        <button class="button" type="submit">Autorizar y solicitar evaluación</button>
                    </form>
                @else
                    <p class="account-notice">Primero completa la verificación DNS para habilitar la autorización.</p>
                @endif
            </section>
        </div>
    @else
        <section class="account-panel account-narrow">
            <h2>{{ $assessment->status === \App\Models\SecurityAssessment::Delivered ? 'Tu informe preliminar' : 'Tu evaluación está solicitada' }}</h2>
            <p>Plazo de respuesta: 24–48 horas desde la autorización. Fecha límite: <strong>{{ $assessment->due_at->format('d/m/Y H:i') }} UTC</strong>.</p>
            @if($assessment->status === \App\Models\SecurityAssessment::Delivered)
                <p class="account-preserve">{{ $assessment->summary }}</p>
                <a class="button" href="{{ route('security.assessments.download', $assessment) }}">Descargar informe PDF</a>
                <p>El informe refleja únicamente el alcance y el momento de la evaluación.</p>
                @if($assessment->full_report_requested_at)
                    <p class="account-notice">Recibimos tu solicitud del informe completo. Te contactaremos por correo.</p>
                @else
                    <form method="post" action="{{ route('security.assessments.full-report', $assessment) }}">@csrf<button class="button" type="submit">Solicitar informe completo</button></form>
                    <p class="account-help">Te contactaremos para conversar sobre los hallazgos, las correcciones y nuestros servicios de ciberseguridad.</p>
                @endif
            @else
                <p>Nuestro equipo revisará los activos autorizados y te avisará por correo cuando el informe esté disponible.</p>
            @endif
            <details><summary>Consultar mi autorización</summary><p>{{ $assessment->authorization_text }}</p><p>Autorizado por {{ $assessment->authorized_by }} el {{ $assessment->authorized_at->format('d/m/Y H:i') }} UTC.</p></details>
            <p class="account-help">Para solicitar la suspensión, escribe a <a href="mailto:info@okanetsolutions.com">info@okanetsolutions.com</a> indicando tu dominio.</p>
        </section>
    @endif
@endsection
