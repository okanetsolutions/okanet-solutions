<!DOCTYPE html>
<html lang="es" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Okanet Solutions — Software desde Caracas')</title>
    <meta name="description" content="@yield('description', 'Okanet Solutions C.A. — Empresa venezolana de software con CRM para creadores de contenido y ERP con IA para proveedores de internet.')">
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=fraunces:400,500,600,700,800,900|inter:300,400,500,600,700|jetbrains-mono:400,500,600&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-bone text-espresso antialiased font-sans selection:bg-terracotta selection:text-bone">

    {{-- Navigation --}}
    <nav class="fixed top-0 w-full z-50 bg-bone/85 backdrop-blur-sm border-b border-espresso/10">
        <div class="max-w-7xl mx-auto px-6 py-4 flex items-center justify-between">
            <a href="{{ route('home') }}" class="flex items-center gap-3">
                <div class="w-9 h-9 bg-terracotta flex items-center justify-center font-display font-bold text-bone text-base">O</div>
                <span class="text-xl font-display font-semibold tracking-tight">Okanet<span class="text-terracotta">.</span></span>
            </a>
            <div class="hidden md:flex items-center gap-8 text-sm">
                <a href="{{ route('home') }}#productos" class="text-umber hover:text-espresso transition-colors flex items-baseline gap-1.5"><span class="font-mono text-[10px] text-stone">02</span>Productos</a>
                <a href="{{ route('home') }}#okacrm" class="text-umber hover:text-espresso transition-colors flex items-baseline gap-1.5"><span class="font-mono text-[10px] text-stone">03</span>OkaCRM</a>
                <a href="{{ route('home') }}#okaisp" class="text-umber hover:text-espresso transition-colors flex items-baseline gap-1.5"><span class="font-mono text-[10px] text-stone">04</span>OkaISP</a>
                <a href="{{ route('blog.index') }}" class="text-umber hover:text-espresso transition-colors flex items-baseline gap-1.5 {{ request()->routeIs('blog.*') ? 'text-terracotta' : '' }}"><span class="font-mono text-[10px] text-stone">05</span>Blog</a>
                <a href="{{ route('home') }}#contacto" class="px-5 py-2 bg-espresso hover:bg-terracotta text-bone font-medium transition-colors">Contacto →</a>
            </div>
            <button id="menu-toggle" class="md:hidden text-espresso">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
            </button>
        </div>
        <div id="mobile-menu" class="hidden md:hidden px-6 pb-5 space-y-3 text-sm border-t border-espresso/5">
            <a href="{{ route('home') }}#productos" class="block pt-3 text-umber hover:text-espresso transition-colors"><span class="font-mono text-[10px] text-stone mr-2">02</span>Productos</a>
            <a href="{{ route('home') }}#okacrm" class="block text-umber hover:text-espresso transition-colors"><span class="font-mono text-[10px] text-stone mr-2">03</span>OkaCRM</a>
            <a href="{{ route('home') }}#okaisp" class="block text-umber hover:text-espresso transition-colors"><span class="font-mono text-[10px] text-stone mr-2">04</span>OkaISP</a>
            <a href="{{ route('blog.index') }}" class="block text-umber hover:text-espresso transition-colors"><span class="font-mono text-[10px] text-stone mr-2">05</span>Blog</a>
            <a href="{{ route('home') }}#contacto" class="block text-terracotta font-semibold"><span class="font-mono text-[10px] text-stone mr-2">06</span>Contacto →</a>
        </div>
    </nav>

    @yield('content')

    {{-- Footer --}}
    <footer class="bg-espresso text-bone py-16">
        <div class="max-w-7xl mx-auto px-6">
            <div class="grid md:grid-cols-12 gap-10 mb-16">
                <div class="md:col-span-5">
                    <a href="{{ route('home') }}" class="flex items-center gap-3 mb-5">
                        <div class="w-9 h-9 bg-terracotta flex items-center justify-center font-display font-bold text-bone">O</div>
                        <span class="text-xl font-display font-semibold tracking-tight">Okanet<span class="text-terracotta">.</span></span>
                    </a>
                    <p class="text-stone leading-relaxed max-w-sm mb-4">
                        Software vertical para industrias específicas. Construido con criterio desde Caracas.
                    </p>
                    <p class="font-mono text-xs text-greige">RIF · J-41299500-6</p>
                </div>
                <div class="md:col-span-2">
                    <h4 class="font-mono text-xs text-greige uppercase tracking-widest mb-4">— Productos</h4>
                    <ul class="space-y-2.5 text-sm text-stone">
                        <li><a href="{{ route('home') }}#okacrm" class="hover:text-terracotta transition-colors">OkaCRM</a></li>
                        <li><a href="{{ route('home') }}#okaisp" class="hover:text-terracotta transition-colors">OkaISP</a></li>
                    </ul>
                </div>
                <div class="md:col-span-2">
                    <h4 class="font-mono text-xs text-greige uppercase tracking-widest mb-4">— Empresa</h4>
                    <ul class="space-y-2.5 text-sm text-stone">
                        <li><a href="{{ route('home') }}#nosotros" class="hover:text-terracotta transition-colors">Nosotros</a></li>
                        <li><a href="{{ route('blog.index') }}" class="hover:text-terracotta transition-colors">Blog</a></li>
                        <li><a href="{{ route('home') }}#contacto" class="hover:text-terracotta transition-colors">Contacto</a></li>
                    </ul>
                </div>
                <div class="md:col-span-3">
                    <h4 class="font-mono text-xs text-greige uppercase tracking-widest mb-4">— Sede</h4>
                    <p class="text-stone text-sm leading-relaxed">
                        Av. Rómulo Gallegos<br>
                        Edif. Centro ALOA, PP-36-L<br>
                        Caracas 1071, Venezuela
                    </p>
                </div>
            </div>

            <div class="pt-8 border-t border-bone/10 flex flex-col md:flex-row items-start md:items-center justify-between gap-4 font-mono text-xs text-greige">
                <p>&copy; {{ date('Y') }} Okanet Solutions C.A. · Todos los derechos reservados.</p>
                <p>10.4806° N · 66.9036° W · Caracas, VE</p>
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
