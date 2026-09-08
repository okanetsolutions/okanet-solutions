@extends('layouts.site')
@section('title', 'Contacto — Hablemos de tu proyecto | Okanet Solutions')
@section('description', 'Conversa con Okanet Solutions sobre software, productos y ciberseguridad. Contacto directo desde Caracas, Venezuela.')
@section('content')
    <section class="site-width contact-page">
        <div class="contact-copy">
            <p class="section-label">Empecemos por una conversación</p>
            <h1>¿Qué necesitas<br>
                <span>resolver?</span>
            </h1>
            <p class="page-lead">Un proceso que consume tiempo. Un negocio que está creciendo. Una duda sobre seguridad. Te escuchamos.</p>
            <div class="contact-channel">
                <h2>Hablemos directamente</h2>
                <p><a class="text-link" href="mailto:info@okanetsolutions.com">info@okanetsolutions.com</a></p>
                <a href="tel:+584241780659" class="phone-link">+58 424 178 0659</a>
                <a href="https://wa.me/584241780659" class="text-link" rel="noreferrer">Abrir WhatsApp <span aria-hidden="true">↗</span>
                </a>
                <p>WhatsApp es un servicio externo de Meta. También puedes llamarnos si prefieres no utilizarlo.</p>
            </div>
            <div class="contact-channel">
                <h2>En Caracas</h2>
                <p>Av. Rómulo Gallegos con Calle Pedro Manrique<br>Edif. Centro ALOA, PP-36-L<br>Caracas 1071, Venezuela</p>
            </div>
        </div>
        <div>
            @include('partials.contact-form')</div>
    </section>
@endsection
