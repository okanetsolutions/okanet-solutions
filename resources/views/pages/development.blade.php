@extends('layouts.site')
@section('title', 'Desarrollo de software a medida — Okanet Solutions')
@section('description', 'Aplicaciones, integraciones entre sistemas y automatización de procesos para tu empresa. Desarrollo a medida desde Caracas.')
@section('content')
    <section class="page-hero site-width">
        <p class="section-label">Desarrollo a medida</p>
        <h1>Tu proceso es único.<br>
            <span>Tu software también puede serlo.</span>
        </h1>
        <p class="page-lead">Conectamos lo que ya funciona y construimos lo que falta. Software pensado alrededor de las personas que lo van a utilizar.</p>
        <a class="button" href="{{ route('contact', ['interest' => 'Sistema a medida']) }}">Cuéntanos qué necesitas resolver <span aria-hidden="true">↗</span>
        </a>
    </section>
    <section class="tinted-section">
        <div class="site-width split-copy">
            <h2>Empecemos por el trabajo que más tiempo te cuesta.</h2>
            <div>
                <p>Una hoja de cálculo que ya no alcanza. Dos sistemas que no se comunican. Un proceso que depende de copiar y pegar información.</p>
                <p>Estudiamos el recorrido completo para definir una solución que tenga sentido en tu operación y pueda evolucionar con ella.</p>
            </div>
        </div>
    </section>
    <section class="section-space site-width">
        <div class="capability-list">
            <article>
                <h3>Aplicaciones de negocio</h3>
                <p>Herramientas internas y portales para gestionar los procesos que no encajan en una solución estándar.</p>
            </article>
            <article>
                <h3>Integraciones y APIs</h3>
                <p>Conecta plataformas, sincroniza información y reduce tareas duplicadas entre sistemas.</p>
            </article>
            <article>
                <h3>Automatización de procesos</h3>
                <p>Transforma tareas repetitivas, reportes y flujos de aprobación en procesos que tu equipo pueda supervisar.</p>
            </article>
            <article>
                <h3>Mantenimiento y evolución</h3>
                <p>Planifica mejoras, resuelve problemas y adapta tus aplicaciones a las nuevas necesidades del negocio.</p>
            </article>
        </div>
    </section>
    <section class="delivery-section site-width">
        <div class="section-intro">
            <h2>Un alcance claro.<br>Entregas que puedes validar.</h2>
            <p>La claridad del proyecto empieza antes de escribir código.</p>
        </div>
        <ol class="process-list">
            <li>
                <h3>Descubrimiento</h3>
                <p>Mapeamos procesos, usuarios, datos e integraciones. Definimos qué problema resolver primero.</p>
            </li>
            <li>
                <h3>Diseño y desarrollo</h3>
                <p>Acordamos entregables y construimos con revisiones para comprobar que la solución encaja.</p>
            </li>
            <li>
                <h3>Puesta en marcha</h3>
                <p>Validamos el resultado y acordamos el traspaso, la documentación y el acompañamiento necesario.</p>
            </li>
        </ol>
    </section>
    @include('partials.cta')
@endsection
