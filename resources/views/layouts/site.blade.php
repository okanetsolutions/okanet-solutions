<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="referrer" content="no-referrer">
        <meta http-equiv="Content-Security-Policy" content="img-src 'self' data:; frame-src 'none'; object-src 'none'; base-uri 'self';">
        <title>@yield('title', 'Okanet Solutions — Software y ciberseguridad desde Caracas')</title>
        <meta name="description" content="@yield('description', 'Software para proveedores de internet y comercios, desarrollo a medida y ciberseguridad. Okanet Solutions, desde Caracas, Venezuela.')">
        <link rel="canonical" href="{{ url()->current() }}">
        <link rel="icon" href="{{ asset('favicon.ico') }}" sizes="16x16 32x32 48x48">
        <link rel="apple-touch-icon" href="{{ asset('images/okanet-icon-180.png') }}">
        @yield('robots')
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        @livewireStyles
    </head>
    <body class="bg-paper text-espresso antialiased font-sans selection:bg-signal selection:text-ink">
        <a href="#contenido" class="skip-link">Saltar al contenido</a>
        <header class="site-header">
            <div class="site-width header-inner">
                <a href="{{ route('home') }}" class="wordmark" aria-label="Okanet Solutions, inicio" wire:navigate>
                    <img src="{{ asset('images/okanet-logo.png') }}" alt="" width="534" height="108" fetchpriority="high" decoding="async">
                </a>
                <button id="menu-toggle" class="menu-toggle" aria-label="Abrir menú" aria-expanded="false" aria-controls="site-menu" hidden>Menú <span aria-hidden="true">☰</span>
                </button>
                <nav id="site-menu" class="site-menu" aria-label="Navegación principal">
                    @foreach (['products' => 'Productos', 'development' => 'A medida', 'security' => 'Ciberseguridad', 'about' => 'Nosotros', 'blog.index' => 'Blog'] as $name => $label)
                        <a href="{{ route($name) }}" wire:navigate @if(request()->routeIs($name, $name === 'products' ? 'products.*' : ($name === 'blog.index' ? 'blog.*' : $name))) aria-current="page" @endif>{{ $label }}</a>
                    @endforeach
                    <a href="{{ route('contact') }}" class="button button-small" wire:navigate>Hablemos <span aria-hidden="true">↗</span>
                    </a>
                </nav>
            </div>
        </header>
        <main id="contenido" tabindex="-1">@yield('content')</main>
        <footer class="site-footer">
            <div class="site-width">
                <div class="footer-grid">
                    <div class="footer-brand">
                        <a href="{{ route('home') }}" class="wordmark" wire:navigate>
                            <img src="{{ asset('images/okanet-logo-light.png') }}" alt="Okanet Solutions" width="534" height="108" loading="lazy" decoding="async">
                        </a>
                        <p>Tecnología con criterio.<br>Desde Caracas, desde 2019.</p>
                        <p class="footer-registration">Okanet Solutions C.A.<br>RIF J-41299500-6</p>
                    </div>
                    <nav aria-label="Soluciones">
                        <h2>Soluciones</h2>
                        <a href="{{ route('products.okaisp') }}" wire:navigate>OkaISP</a>
                        <a href="{{ route('products.okastore') }}" wire:navigate>OkaStore</a>
                        <a href="{{ route('development') }}" wire:navigate>Desarrollo a medida</a>
                        <a href="{{ route('security') }}" wire:navigate>Ciberseguridad</a>
                    </nav>
                    <nav aria-label="Empresa">
                        <h2>Conócenos</h2>
                        <a href="{{ route('about') }}" wire:navigate>Nosotros</a>
                        <a href="{{ route('blog.index') }}" wire:navigate>Blog</a>
                        <a href="{{ route('contact') }}" wire:navigate>Contacto</a>
                        <a href="mailto:info@okanetsolutions.com" class="break-all">info@okanetsolutions.com</a>
                        <a href="tel:+584241780659">+58 424 178 0659</a>
                    </nav>
                    <div>
                        <h2>Nos encuentras en Caracas</h2>
                        <p>Av. Rómulo Gallegos con Calle Pedro Manrique<br>Edif. Centro ALOA, PP-36-L<br>Caracas 1071, Venezuela</p>
                    </div>
                </div>
                <div class="footer-bottom">
                    <p>© {{ date('Y') }} Okanet Solutions C.A.</p>
                    <nav aria-label="Información legal">
                        <a href="{{ route('privacy') }}" wire:navigate>Privacidad</a>
                        <a href="{{ route('terms') }}" wire:navigate>Términos y condiciones</a>
                        <a href="{{ route('cookies') }}" data-cookie-settings>Cookies y preferencias</a>
                    </nav>
                </div>
            </div>
        </footer>
        <dialog id="cookie-settings" class="cookie-dialog" aria-labelledby="cookie-title" aria-describedby="cookie-description">
            <div class="dialog-heading">
                <h2 id="cookie-title">Tu privacidad, por defecto.</h2>
                <form method="dialog">
                    <button class="dialog-close" aria-label="Cerrar preferencias de cookies" autofocus>×</button>
                </form>
            </div>
            <p id="cookie-description">La aplicación utiliza cookies técnicas de sesión y seguridad. Cloudflare puede añadir cookies de protección según su configuración. La aplicación no incorpora cookies de analítica ni publicidad.</p>
            <dl class="cookie-categories">
                <div>
                    <dt>Necesarias</dt>
                    <dd>Siempre activas <span aria-hidden="true">✓</span>
                    </dd>
                </div>
                <div>
                    <dt>Analítica</dt>
                    <dd>No utilizadas</dd>
                </div>
                <div>
                    <dt>Publicidad</dt>
                    <dd>No utilizadas</dd>
                </div>
            </dl>
            <p>No hay cookies opcionales que aceptar o rechazar en esta aplicación. No guardamos esta interacción. Los canales externos de contacto, como WhatsApp, solo se abren cuando eliges visitarlos. El tratamiento por DigitalOcean NYC1, Cloudflare (proxy y R2) y Postmark se explica en nuestras políticas.</p>
            <a class="text-link" href="{{ route('cookies') }}" wire:navigate>Leer la política de cookies <span aria-hidden="true">↗</span>
            </a>
            <form method="dialog">
                <button class="button">Entendido</button>
            </form>
        </dialog>
        @livewireScripts
    </body>
</html>
