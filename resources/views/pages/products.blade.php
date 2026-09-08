@extends('layouts.site')
@section('title', 'Productos — OkaISP y OkaStore | Okanet Solutions')
@section('description', 'Conoce OkaISP para proveedores de internet y OkaStore para comercios. Software adaptado a la operación de las empresas en Venezuela.')
@section('content')
    <section class="page-hero site-width">
        <p class="section-label">Productos Okanet</p>
        <h1>El software adecuado<br>para <span>tu operación.</span>
        </h1>
        <p class="page-lead">Dos sectores distintos. Dos plataformas construidas alrededor de sus necesidades.</p>
    </section>
    <section class="site-width product-detail-row">
        <div>
            <span class="product-name">OkaISP</span>
            <h2>Gestiona tu proveedor de internet de forma conectada.</h2>
            <p>Desde el alta de un cliente hasta la cobranza y el soporte técnico: reúne la operación comercial y de red en un solo sistema.</p>
            <ul class="check-list">
                <li>Clientes, planes y servicios</li>
                <li>Facturación y cobranza</li>
                <li>Monitoreo y soporte con IA</li>
            </ul>
            <a class="button" href="{{ route('products.okaisp') }}" wire:navigate>Descubrir OkaISP <span aria-hidden="true">↗</span>
            </a>
        </div>
        @include('partials.product-preview', ['product' => 'OkaISP'])</section>
    <section class="site-width product-detail-row">
        <div>
            <span class="product-name">OkaStore</span>
            <h2>Vende y administra tu comercio en el mismo lugar.</h2>
            <p>Conecta tu tienda en línea con los pedidos, el inventario y la contabilidad. Menos información dispersa, más claridad para tu equipo.</p>
            <ul class="check-list">
                <li>Catálogo y tienda en línea</li>
                <li>Pedidos, pagos e inventario</li>
                <li>Contabilidad para Venezuela</li>
            </ul>
            <a class="button" href="{{ route('products.okastore') }}" wire:navigate>Descubrir OkaStore <span aria-hidden="true">↗</span>
            </a>
        </div>
        @include('partials.product-preview', ['product' => 'OkaStore'])</section>
    <section class="site-width help-strip">
        <div>
            <h2>¿Tu operación necesita algo diferente?</h2>
            <p>También desarrollamos aplicaciones e integraciones a medida.</p>
        </div>
        <a class="text-link" href="{{ route('development') }}" wire:navigate>Explorar desarrollo a medida <span aria-hidden="true">↗</span>
        </a>
    </section>
    @include('partials.cta')
@endsection
