@extends('layouts.site')
@section('title', 'Nosotros — Tecnología con criterio desde Caracas | Okanet Solutions')
@section('description', 'Okanet Solutions C.A., empresa de software en Caracas desde 2019. Productos propios, desarrollo a medida y ciberseguridad para empresas en Venezuela.')
@section('content')
    <section class="page-hero site-width">
        <p class="section-label">Somos Okanet Solutions</p>
        <h1>Tecnología con criterio.<br>
            <span>Cercanía de verdad.</span>
        </h1>
        <p class="page-lead">Desde Caracas, construimos software para empresas que necesitan herramientas conectadas a su realidad.</p>
    </section>
    <section class="company-story">
        <div class="site-width story-grid">
            <div class="company-stamp">
                <span class="brand-lockup" role="img" aria-label="Okanet"></span>
                <p>Caracas<br>Venezuela</p>
                <span>Construyendo desde 2019</span>
            </div>
            <div>
                <h2>Conocemos el contexto.<br>Nos involucramos en el problema.</h2>
                <p>Somos Okanet Solutions C.A. Desarrollamos productos y soluciones de software con atención a los procesos, las herramientas de pago y las necesidades de las empresas en Venezuela.</p>
                <p>Nuestros productos OkaISP y OkaStore responden a dos operaciones distintas: proveedores de internet y comercios. También desarrollamos sistemas a medida y ayudamos a evaluar y reforzar su seguridad.</p>
                <p>En cada proyecto empezamos por la misma pregunta: ¿qué necesita tu equipo para trabajar mejor?</p>
            </div>
        </div>
    </section>
    <section class="section-space site-width">
        <div class="section-intro">
            <h2>Así nos gusta trabajar.</h2>
            <p>Una relación clara entre quienes conocen el negocio y quienes construyen la tecnología.</p>
        </div>
        <ol class="process-list">
            <li>
                <h3>Escuchar antes de proponer</h3>
                <p>Entendemos el problema con las personas que lo viven, antes de decidir qué construir.</p>
            </li>
            <li>
                <h3>Hacer visible el trabajo</h3>
                <p>Acordamos alcance, prioridades y entregables para que puedas evaluar el avance.</p>
            </li>
            <li>
                <h3>Pensar en lo que sigue</h3>
                <p>Consideramos mantenimiento, seguridad y evolución desde las primeras decisiones.</p>
            </li>
        </ol>
    </section>
    <section class="site-width help-strip">
        <div>
            <h2>Un equipo en Caracas.</h2>
            <p>Av. Rómulo Gallegos con Calle Pedro Manrique, Edif. Centro ALOA, PP-36-L.<br>Caracas 1071, Venezuela · RIF J-41299500-6</p>
        </div>
        <a class="text-link" href="{{ route('contact') }}" wire:navigate>Conversemos <span aria-hidden="true">↗</span>
        </a>
    </section>
    @include('partials.cta')
@endsection
