@extends('layouts.site')
@section('title', 'OkaStore — Tienda en línea y gestión comercial | Okanet Solutions')
@section('description', 'Tu tienda en línea, pedidos, inventario y contabilidad en una plataforma pensada para el comercio venezolano. Conoce OkaStore.')
@section('content')
    <section class="product-hero">
        <div class="site-width product-hero-grid">
            <div>
                <a href="{{ route('products') }}" class="breadcrumb" wire:navigate>Productos / OkaStore</a>
                <h1>Más cerca de tus clientes.<br>
                    <span>Al día con tu negocio.</span>
                </h1>
                <p class="page-lead">Tu tienda en línea, pedidos, inventario y contabilidad en una plataforma pensada para el comercio venezolano.</p>
                <a class="button" href="{{ route('contact', ['interest' => 'OkaStore']) }}" wire:navigate>Conversemos sobre OkaStore <span aria-hidden="true">↗</span>
                </a>
            </div>
            @include('partials.product-preview', ['product' => 'OkaStore'])</div>
    </section>
    <section class="section-space site-width">
        <div class="section-intro">
            <h2>Cada venta conecta<br>con el resto del negocio.</h2>
            <p>Para comercios que necesitan una tienda en línea con una gestión administrativa que acompañe las ventas.</p>
        </div>
        <div class="capability-list">
            <article>
                <h3>Tu catálogo en línea</h3>
                <p>Presenta tus productos y organiza tu catálogo para que tus clientes encuentren lo que buscan.</p>
            </article>
            <article>
                <h3>Pedidos y pagos</h3>
                <p>Centraliza el seguimiento de los pedidos, sus pagos y la preparación de envíos. Revisa con nuestro equipo los medios de pago que necesita tu negocio.</p>
            </article>
            <article>
                <h3>Inventario conectado</h3>
                <p>Mantén el inventario vinculado a las ventas para que tu equipo pueda revisar existencias y planificar reposiciones.</p>
            </article>
            <article>
                <h3>Contabilidad del negocio</h3>
                <p>Conecta ventas y administración con funciones de contabilidad e IVA pensadas para Venezuela. Acuerda los reportes que requiere tu operación.</p>
            </article>
        </div>
    </section>
    <section class="tinted-section">
        <div class="site-width split-copy">
            <h2>Una tienda adaptada a cómo vendes.</h2>
            <div>
                <p>Empezamos por tu catálogo, tu inventario y tu proceso de venta. Revisamos la configuración, los datos iniciales y las integraciones necesarias antes de ponerla en marcha.</p>
                <p>El alcance, el costo y las condiciones de soporte se acuerdan en la propuesta. Las interfaces mostradas son ilustrativas.</p>
                <a class="text-link" href="{{ route('contact', ['interest' => 'OkaStore']) }}" wire:navigate>Cuéntanos sobre tu comercio <span aria-hidden="true">↗</span>
                </a>
            </div>
        </div>
    </section>
    <section class="faq-section site-width">
        <h2>Antes de abrir tu tienda</h2>
        <div>
            <details>
                <summary>¿Puedo importar mi catálogo actual?</summary>
                <p>Podemos evaluar tus archivos y la estructura del catálogo para definir qué datos se pueden importar y cuáles necesitan ajustes.</p>
            </details>
            <details>
                <summary>¿Qué medios de pago puedo utilizar?</summary>
                <p>Revisamos los medios de pago de tu comercio y confirmamos su compatibilidad y alcance en la propuesta. No todos los proveedores o integraciones están incluidos por defecto.</p>
            </details>
            <details>
                <summary>¿Qué incluye la implementación?</summary>
                <p>Definimos contigo la configuración, la preparación de datos y el acompañamiento que necesitas. La propuesta detalla los entregables y las responsabilidades de cada parte.</p>
            </details>
        </div>
    </section>
    @include('partials.cta')
@endsection
