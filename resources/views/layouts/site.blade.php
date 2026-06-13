<!DOCTYPE html>
<html lang="es" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Okanet Solutions — Software desde Caracas')</title>
    <meta name="description" content="@yield('description', 'Okanet Solutions C.A. — Empresa venezolana de software con CRM para creadores de contenido y ERP con IA para proveedores de internet.')">
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=archivo:400,500,600,700,800|martian-mono:300,400,500&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-paper text-espresso antialiased font-sans selection:bg-signal selection:text-ink">

    {{-- Navigation — shared chrome, matches the landing --}}
    <nav class="fixed top-0 w-full z-[60] bg-ink/85 backdrop-blur-md border-b border-bone/10">
        <div class="max-w-7xl mx-auto px-6 h-16 flex items-center justify-between">
            <a href="{{ route('home') }}" class="group flex items-center gap-2.5">
                <span class="inline-flex w-2.5 h-2.5 rounded-full bg-signal"></span>
                <span class="text-lg font-display font-extrabold tracking-tight text-bone">okanet</span>
            </a>
            <div class="hidden md:flex items-center gap-8 text-sm text-fog">
                <a href="{{ route('home') }}#sistema" class="nav-link hover:text-bone transition-colors">Cómo trabajamos</a>
                <a href="{{ route('home') }}#productos" class="nav-link hover:text-bone transition-colors">Productos</a>
                <a href="{{ route('home') }}#amedida" class="nav-link hover:text-bone transition-colors">A medida</a>
                <a href="{{ route('blog.index') }}" class="nav-link hover:text-bone transition-colors {{ request()->routeIs('blog.*') ? 'text-bone' : '' }}">Blog</a>
                <a href="{{ route('home') }}#contacto" class="pressable inline-flex items-center gap-2 px-4 py-2 bg-bone text-ink font-semibold rounded-sm hover:bg-signal">Contacto</a>
            </div>
            <button id="menu-toggle" class="md:hidden text-bone -mr-1 p-1" aria-label="Abrir menú" aria-expanded="false" aria-controls="mobile-menu">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-width="1.5" d="M4 7h16M4 12h16M4 17h16"/></svg>
            </button>
        </div>
        <div id="mobile-menu" class="hidden md:hidden px-6 pb-5 pt-1 space-y-1 text-sm border-t border-bone/10 bg-ink">
            <a href="{{ route('home') }}#sistema" class="block py-2.5 text-fog hover:text-bone transition-colors">Cómo trabajamos</a>
            <a href="{{ route('home') }}#productos" class="block py-2.5 text-fog hover:text-bone transition-colors">Productos</a>
            <a href="{{ route('home') }}#amedida" class="block py-2.5 text-fog hover:text-bone transition-colors">A medida</a>
            <a href="{{ route('blog.index') }}" class="block py-2.5 text-fog hover:text-bone transition-colors">Blog</a>
            <a href="{{ route('home') }}#contacto" class="block py-2.5 text-signal font-semibold">Contacto →</a>
        </div>
    </nav>

    @yield('content')

    {{-- Footer — shared chrome, matches the landing --}}
    <footer class="bg-ink text-bone pt-16 pb-10 border-t border-bone/10">
        <div class="max-w-7xl mx-auto px-6">
            <div class="grid md:grid-cols-12 gap-10 mb-14">
                <div class="md:col-span-5">
                    <a href="{{ route('home') }}" class="flex items-center gap-2.5 mb-5">
                        <span class="inline-flex w-2.5 h-2.5 rounded-full bg-signal"></span>
                        <span class="text-lg font-display font-extrabold tracking-tight">okanet</span>
                    </a>
                    <p class="text-fog leading-relaxed max-w-sm mb-5">
                        Automatizamos la operación de empresas en Venezuela. Software en producción desde Caracas, 2019.
                    </p>
                    <p class="font-mono text-[11px] text-fog-dim">Okanet Solutions C.A. · RIF J-41299500-6</p>
                </div>
                <nav class="md:col-span-2" aria-label="Productos">
                    <h2 class="font-mono text-[11px] text-fog-dim uppercase tracking-wider mb-4">Productos</h2>
                    <ul class="space-y-2.5 text-sm text-fog">
                        <li><a href="{{ route('home') }}#okaisp" class="hover:text-signal transition-colors">OkaISP</a></li>
                        <li><a href="{{ route('home') }}#okastore" class="hover:text-signal transition-colors">OkaStore</a></li>
                        <li><a href="{{ route('home') }}#amedida" class="hover:text-signal transition-colors">A medida</a></li>
                    </ul>
                </nav>
                <nav class="md:col-span-2" aria-label="Empresa">
                    <h2 class="font-mono text-[11px] text-fog-dim uppercase tracking-wider mb-4">Empresa</h2>
                    <ul class="space-y-2.5 text-sm text-fog">
                        <li><a href="{{ route('home') }}#sistema" class="hover:text-signal transition-colors">Cómo trabajamos</a></li>
                        <li><a href="{{ route('home') }}#okanet" class="hover:text-signal transition-colors">Por qué Okanet</a></li>
                        <li><a href="{{ route('blog.index') }}" class="hover:text-signal transition-colors">Blog</a></li>
                        <li><a href="{{ route('home') }}#contacto" class="hover:text-signal transition-colors">Contacto</a></li>
                    </ul>
                </nav>
                <div class="md:col-span-3">
                    <h2 class="font-mono text-[11px] text-fog-dim uppercase tracking-wider mb-4">Sede</h2>
                    <p class="text-fog text-sm leading-relaxed">
                        Av. Rómulo Gallegos<br>
                        Edif. Centro ALOA, PP-36-L<br>
                        Caracas 1071, Venezuela
                    </p>
                </div>
            </div>

            <div class="pt-8 border-t border-bone/10 flex flex-col md:flex-row items-start md:items-center justify-between gap-3 font-mono text-[11px] text-fog-dim">
                <p>&copy; {{ date('Y') }} Okanet Solutions C.A. · Todos los derechos reservados.</p>
                <p>10.4806°N · 66.9036°W · Caracas, VE</p>
            </div>
        </div>
    </footer>

    <script>
        document.getElementById('menu-toggle').addEventListener('click', function() {
            document.getElementById('mobile-menu').classList.toggle('hidden');
        });
    </script>
</body>
</html>
