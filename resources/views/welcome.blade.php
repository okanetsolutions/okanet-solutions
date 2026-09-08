@extends('layouts.site')

@section('content')
    <section class="home-hero">
        <div class="site-width hero-grid">
            <div class="hero-copy">
                <p class="hero-provenance">
                    <span aria-hidden="true"></span>Software y ciberseguridad · Caracas, Venezuela</p>
                <h1>Software que resuelve.<br>
                    <span>Un equipo que responde.</span>
                </h1>
                <p class="hero-description">Conectamos tu operación, construimos las herramientas que faltan y te ayudamos a proteger lo que has creado.</p>
                <div class="button-row">
                    <a href="{{ route('contact') }}" class="button">Cuéntanos tu proyecto <span aria-hidden="true">↗</span>
                    </a>
                    <a href="{{ route('products') }}" class="text-link">Explorar productos <span aria-hidden="true">→</span>
                    </a>
                </div>
            </div>
            <div class="hero-product">
                <div class="hero-product-caption">
                    <span>Hecho para tu día a día</span>
                    <span aria-hidden="true">↘</span>
                </div>
                @include('partials.product-preview', ['product' => 'OkaISP'])<a href="{{ route('products.okaisp') }}" class="hero-product-link">
                    <span>Conoce OkaISP <small>Software para proveedores de internet</small>
                    </span>
                    <span aria-hidden="true">↗</span>
                </a>
            </div>
        </div>
        <div class="site-width hero-bottom">
            <p>Entendemos el negocio.<br>
                <strong>Después construimos la solución.</strong>
            </p>
            <div>
                <span>Proveedores de internet</span>
                <span>Comercios</span>
                <span>Empresas de servicios</span>
            </div>
        </div>
    </section>

    <section id="productos" class="section-space site-width">
        <div class="section-intro">
            <h2>Tu sector tiene sus retos.<br>Nuestro software los conoce.</h2>
            <p>Productos propios, diseñados alrededor de la operación real de tu negocio y del contexto venezolano.</p>
        </div>
        <div class="product-offerings">
            <article id="okaisp" class="product-offering isp-offering">
                <div class="offering-heading">
                    <span class="product-name">OkaISP</span>
                    <span class="product-tag">Para proveedores de internet</span>
                </div>
                <h3>Una red de clientes.<br>Una sola operación.</h3>
                <p>Clientes, facturación, cobranza, soporte y monitoreo de red. Conecta tu equipo con la información que necesita.</p>
                <div class="offering-modules">
                    <span>Facturación</span>
                    <span>Red y soporte</span>
                    <span>Automatización con IA</span>
                </div>
                <a href="{{ route('products.okaisp') }}" class="offering-link">Explorar OkaISP <span aria-hidden="true">↗</span>
                </a>
            </article>
            <article id="okastore" class="product-offering store-offering">
                <div class="offering-heading">
                    <span class="product-name">OkaStore</span>
                    <span class="product-tag">Para comercios</span>
                </div>
                <h3>Tu tienda crece.<br>Tu gestión sigue el ritmo.</h3>
                <p>Catálogo, pedidos, inventario y contabilidad conectados. Una plataforma para vender y llevar las cuentas de tu negocio.</p>
                <div class="offering-modules">
                    <span>Tienda en línea</span>
                    <span>Inventario</span>
                    <span>Contabilidad</span>
                </div>
                <a href="{{ route('products.okastore') }}" class="offering-link">Explorar OkaStore <span aria-hidden="true">↗</span>
                </a>
            </article>
        </div>
    </section>

    <section class="expertise-section" id="amedida">
        <div class="site-width expertise-grid">
            <div>
                <p class="section-label">Un equipo, de principio a fin</p>
                <h2>Construimos.<br>Conectamos.<br>
                    <span>Protegemos.</span>
                </h2>
                <p class="expertise-description">Cuando tu negocio necesita algo propio, trabajamos contigo para convertir un problema operativo en una solución concreta.</p>
                <a href="{{ route('about') }}" class="text-link">Así trabajamos <span aria-hidden="true">↗</span>
                </a>
            </div>
            <div class="expertise-services">
                <article>
                    <div class="service-title">
                        <h3>Desarrollo a medida</h3>
                        <span aria-hidden="true">↗</span>
                    </div>
                    <p>Aplicaciones, integraciones y automatización para los procesos que hacen único a tu negocio.</p>
                    <a href="{{ route('development') }}" class="text-link">Conoce el servicio</a>
                </article>
                <article id="seguridad">
                    <div class="service-title">
                        <h3>Ciberseguridad</h3>
                        <span aria-hidden="true">↗</span>
                    </div>
                    <p>Protección de ciberseguridad y pruebas de penetración con hallazgos claros y prioridades de corrección.</p>
                    <a href="{{ route('security') }}" class="text-link">Conoce el servicio</a>
                </article>
            </div>
        </div>
    </section>

    <section id="sistema" class="section-space site-width">
        <div class="section-intro">
            <h2>Claridad en cada paso.</h2>
            <p>Sabes qué estamos resolviendo, por qué lo hacemos y qué sigue. El proyecto se construye contigo.</p>
        </div>
        <ol class="process-list">
            <li>
                <h3>Entendemos tu operación</h3>
                <p>Escuchamos a tu equipo y revisamos los procesos, herramientas y restricciones del negocio.</p>
            </li>
            <li>
                <h3>Acordamos un camino</h3>
                <p>Definimos alcance, entregables y prioridades antes de comenzar el trabajo.</p>
            </li>
            <li>
                <h3>Construimos y acompañamos</h3>
                <p>Validamos cada entrega contigo y planificamos la evolución de la solución.</p>
            </li>
        </ol>
        <div id="okanet" class="company-note">
            <h3>Desde Caracas.<br>Con contexto local.</h3>
            <p>Somos Okanet Solutions C.A. Desde 2019, desarrollamos software con atención a cómo trabajan las empresas en Venezuela. <a class="text-link" href="{{ route('about') }}">Conoce al equipo detrás <span aria-hidden="true">↗</span>
                </a>
            </p>
        </div>
    </section>
    <section id="contacto" class="home-contact site-width">
        <div>
            <h2>Tu próximo paso empieza con una conversación.</h2>
            <p>Un producto, un proceso o una pregunta de seguridad. Cuéntanos qué necesitas resolver.</p>
        </div>
        <a class="button" href="{{ route('contact') }}">Hablemos <span aria-hidden="true">↗</span>
        </a>
    </section>
@endsection
