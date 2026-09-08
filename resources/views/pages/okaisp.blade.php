@extends('layouts.site')
@section('title', 'OkaISP — Software para proveedores de internet | Okanet Solutions')
@section('description', 'Conecta clientes, facturación, cobranza, red y soporte con OkaISP, el ERP con IA para proveedores de internet en Venezuela.')
@section('content')
    <section class="product-hero">
        <div class="site-width product-hero-grid">
            <div>
                <a href="{{ route('products') }}" class="breadcrumb" wire:navigate>Productos / OkaISP</a>
                <h1>Tu red crece.<br>
                    <span>Tu operación se conecta.</span>
                </h1>
                <p class="page-lead">El ERP con IA para proveedores de internet que reúne clientes, facturación, cobranza, soporte y monitoreo de red.</p>
                <a class="button" href="{{ route('contact', ['interest' => 'OkaISP']) }}" wire:navigate>Conversemos sobre OkaISP <span aria-hidden="true">↗</span>
                </a>
            </div>
            @include('partials.product-preview', ['product' => 'OkaISP'])</div>
    </section>
    <section class="section-space site-width">
        <div class="section-intro">
            <h2>De la red a la cobranza,<br>todos en la misma página.</h2>
            <p>Para proveedores de internet que necesitan conectar la gestión comercial, el soporte técnico y la administración.</p>
        </div>
        <div class="capability-list">
            <article>
                <h3>Clientes y facturación</h3>
                <p>Centraliza clientes, planes y servicios. Gestiona la emisión de facturas y el seguimiento de pagos con información compartida entre equipos.</p>
            </article>
            <article>
                <h3>Red y continuidad</h3>
                <p>Relaciona el monitoreo de red con los servicios de tus clientes y la gestión de cortes. Da a soporte el contexto que necesita.</p>
            </article>
            <article>
                <h3>Automatización con IA</h3>
                <p>Apoya la cobranza y el primer nivel de soporte con automatización. Evalúa con nuestro equipo las funciones de predicción de fallas y morosidad para tu operación.</p>
            </article>
            <article>
                <h3>Administración local</h3>
                <p>Integra la contabilidad con el día a día del negocio, teniendo en cuenta los procesos fiscales y administrativos venezolanos.</p>
            </article>
        </div>
    </section>
    <section class="tinted-section">
        <div class="site-width split-copy">
            <h2>La implementación comienza con tu operación.</h2>
            <div>
                <p>Revisamos los sistemas que utilizas, los datos que necesitas migrar y los procesos de tu equipo. Definimos juntos el alcance, las integraciones y la puesta en marcha.</p>
                <p>Las funciones, condiciones de soporte y costos aplicables se concretan en la propuesta. Las interfaces mostradas son ilustrativas.</p>
                <a class="text-link" href="{{ route('contact', ['interest' => 'OkaISP']) }}" wire:navigate>Hablar con el equipo <span aria-hidden="true">↗</span>
                </a>
            </div>
        </div>
    </section>
    <section class="faq-section site-width">
        <h2>Antes de empezar</h2>
        <div>
            <details>
                <summary>¿Podemos migrar desde otro sistema?</summary>
                <p>Revisamos el formato, la calidad y el volumen de tus datos para proponer una migración y acordar sus límites antes de iniciar.</p>
            </details>
            <details>
                <summary>¿Cómo se define el precio?</summary>
                <p>La propuesta depende de tu operación, las funciones necesarias, las integraciones y el acompañamiento acordado. Contáctanos para evaluar tu caso.</p>
            </details>
            <details>
                <summary>¿La IA reemplaza a mi equipo de soporte?</summary>
                <p>La automatización apoya tareas repetitivas y el primer nivel de atención. Tu equipo sigue siendo necesario para supervisar, resolver excepciones y atender los casos que requieren criterio.</p>
            </details>
        </div>
    </section>
    @include('partials.cta')
@endsection
