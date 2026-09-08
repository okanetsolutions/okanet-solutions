@extends('layouts.site')
@section('title', 'Ciberseguridad y pruebas de penetración — Okanet Solutions')
@section('description', 'Evaluación de riesgos, protección de ciberseguridad y pruebas de penetración autorizadas. Hallazgos claros y recomendaciones para tu equipo.')
@section('content')
    <section class="security-hero">
        <div class="site-width security-hero-panel">
            <div class="security-hero-content">
                <h1>Conoce tus riesgos.<br>
                    <span>Actúa con criterio.</span>
                </h1>
                <p class="page-lead">Evaluamos tus aplicaciones, redes e infraestructura para ayudarte a identificar puntos débiles y priorizar las correcciones.</p>
                <a class="button button-light" href="#consultas-gratuitas">Consulta tu exposición <span aria-hidden="true">↗</span>
                </a>
            </div>
            <div class="security-deliverable">
                <div class="security-deliverable-heading">
                    <p>Del hallazgo a la acción</p>
                    <h2>Un informe que tu equipo puede utilizar.</h2>
                    <span class="security-scope">Siempre con autorización y alcance acordado.</span>
                </div>
                <ol>
                    <li>
                        <span>Identificar</span>
                        <p>Qué está expuesto y dónde.</p>
                    </li>
                    <li>
                        <span>Priorizar</span>
                        <p>Qué impacto tiene para tu negocio.</p>
                    </li>
                    <li>
                        <span>Corregir</span>
                        <p>Qué pasos tomar para reducir el riesgo.</p>
                    </li>
                </ol>
            </div>
        </div>
    </section>
    <section id="consultas-gratuitas" class="section-space site-width security-offers">
        <h2>Empieza con una consulta gratuita.</h2>
        <div class="account-columns">
            <article class="account-panel">
                <h3>¿Tu correo aparece en una filtración?</h3>
                <p>Crea tu cuenta con un correo corporativo y verifícalo. Consulta cuántos registros de exposición encontramos y solicita más información para conocer los siguientes pasos.</p>
                <a class="button" href="{{ auth()->check() ? route('security.dashboard') : route('register') }}">Consultar mi correo</a>
                <p class="account-help">Consulta de filtraciones de credenciales con Breachsense. No mostramos contraseñas ni datos sensibles. Sujeto a disponibilidad del servicio.</p>
            </article>
            <article class="account-panel">
                <h3>Una primera evaluación de tu dominio.</h3>
                <p>Verifica tu correo y el control de tu dominio mediante un registro DNS. Autoriza la revisión y recibe un informe preliminar de nuestro equipo en 24–48 horas.</p>
                <a class="button" href="{{ auth()->check() ? route('security.dashboard') : route('register') }}">Solicitar evaluación</a>
                <p class="account-help">El plazo comienza tras la verificación y autorización. Las pruebas de penetración adicionales requieren un alcance acordado por escrito.</p>
            </article>
        </div>
        @guest<p>¿Ya tienes cuenta? <a class="text-link" href="{{ route('login') }}">Inicia sesión</a>.</p>@endguest
    </section>
    <section class="section-space site-width">
        <div class="section-intro">
            <h2>La seguridad es un trabajo<br>que se sostiene.</h2>
            <p>Evaluaciones concretas, recomendaciones comprensibles y un alcance ajustado a tus sistemas.</p>
        </div>
        <div class="security-services">
            <article>
                <h3>Protección de ciberseguridad</h3>
                <p>Revisamos configuraciones, accesos y controles para identificar oportunidades de mejora y reducir la exposición de tus sistemas.</p>
                <ul class="check-list">
                    <li>Evaluación de riesgos y controles</li>
                    <li>Revisión de configuraciones</li>
                    <li>Gestión de accesos y permisos</li>
                    <li>Recomendaciones de protección</li>
                </ul>
                <a href="{{ route('contact', ['interest' => 'Protección de ciberseguridad']) }}" class="text-link">Consultar sobre protección <span aria-hidden="true">↗</span>
                </a>
            </article>
            <article>
                <h3>Pruebas de penetración</h3>
                <p>Evaluamos la seguridad mediante pruebas autorizadas. Documentamos las vulnerabilidades identificadas y los pasos para tratarlas.</p>
                <ul class="check-list">
                    <li>Alcance y autorización por escrito</li>
                    <li>Pruebas sobre activos acordados</li>
                    <li>Hallazgos, evidencia y severidad</li>
                    <li>Recomendaciones de corrección</li>
                </ul>
                <a href="{{ route('contact', ['interest' => 'Pruebas de penetración']) }}" class="text-link">Consultar sobre pentesting <span aria-hidden="true">↗</span>
                </a>
            </article>
        </div>
    </section>
    <section class="tinted-section">
        <div class="site-width split-copy">
            <h2>Antes de probar,<br>acordamos los límites.</h2>
            <div>
                <p>Definimos los activos autorizados, las ventanas de trabajo, las exclusiones y los contactos de coordinación. El tratamiento de la información y la entrega de evidencias se acuerdan con tu equipo.</p>
                <p>Una evaluación refleja el alcance y el momento de las pruebas. No garantiza la ausencia de vulnerabilidades ni sustituye la gestión continua de la seguridad.</p>
            </div>
        </div>
    </section>
    <section class="faq-section site-width">
        <h2>Preguntas frecuentes</h2>
        <div>
            <details>
                <summary>¿Qué necesito para solicitar una evaluación?</summary>
                <p>Una descripción general de tus sistemas y el objetivo de la evaluación. No envíes contraseñas, claves de acceso ni información sensible a través del formulario de contacto.</p>
            </details>
            <details>
                <summary>¿Las pruebas pueden afectar mi operación?</summary>
                <p>Las pruebas pueden implicar riesgos operativos. Por eso acordamos previamente el tipo de pruebas, las ventanas, las medidas de coordinación y las exclusiones.</p>
            </details>
            <details>
                <summary>¿Incluyen la corrección de los hallazgos?</summary>
                <p>El informe incluye recomendaciones. La implementación de correcciones y la repetición de pruebas se incluyen únicamente cuando forman parte del alcance contratado.</p>
            </details>
        </div>
    </section>
    @include('partials.cta')
@endsection
