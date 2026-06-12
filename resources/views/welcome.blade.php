<!DOCTYPE html>
<html lang="es" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Okanet Solutions — Software desde Caracas</title>
    <meta name="description" content="Okanet Solutions C.A. — Empresa venezolana de software con CRM para creadores de contenido y ERP con IA para proveedores de internet.">
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=fraunces:400,500,600,700,800,900|inter:300,400,500,600,700|jetbrains-mono:400,500,600&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-bone text-espresso antialiased font-sans selection:bg-terracotta selection:text-bone">

    {{-- Navigation --}}
    <nav class="fixed top-0 w-full z-50 bg-bone/85 backdrop-blur-sm border-b border-espresso/10">
        <div class="max-w-7xl mx-auto px-6 py-4 flex items-center justify-between">
            <a href="#" class="flex items-center gap-3">
                <div class="w-9 h-9 bg-terracotta flex items-center justify-center font-display font-bold text-bone text-base">O</div>
                <span class="text-xl font-display font-semibold tracking-tight">Okanet<span class="text-terracotta">.</span></span>
            </a>
            <div class="hidden md:flex items-center gap-8 text-sm">
                <a href="#productos" class="nav-link text-umber hover:text-espresso transition-colors flex items-baseline gap-1.5"><span class="font-mono text-[10px] text-stone">02</span>Productos</a>
                <a href="#okacrm" class="nav-link text-umber hover:text-espresso transition-colors flex items-baseline gap-1.5"><span class="font-mono text-[10px] text-stone">03</span>OkaCRM</a>
                <a href="#okaisp" class="nav-link text-umber hover:text-espresso transition-colors flex items-baseline gap-1.5"><span class="font-mono text-[10px] text-stone">04</span>OkaISP</a>
                <a href="#nosotros" class="nav-link text-umber hover:text-espresso transition-colors flex items-baseline gap-1.5"><span class="font-mono text-[10px] text-stone">05</span>Nosotros</a>
                <a href="{{ route('blog.index') }}" class="nav-link text-umber hover:text-espresso transition-colors flex items-baseline gap-1.5"><span class="font-mono text-[10px] text-stone">06</span>Blog</a>
                <a href="#contacto" class="pressable px-5 py-2 bg-espresso hover:bg-terracotta text-bone font-medium">Contacto →</a>
            </div>
            <button id="menu-toggle" class="md:hidden text-espresso">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
            </button>
        </div>
        <div id="mobile-menu" class="hidden md:hidden px-6 pb-5 space-y-3 text-sm border-t border-espresso/5">
            <a href="#productos" class="block pt-3 text-umber hover:text-espresso transition-colors"><span class="font-mono text-[10px] text-stone mr-2">02</span>Productos</a>
            <a href="#okacrm" class="block text-umber hover:text-espresso transition-colors"><span class="font-mono text-[10px] text-stone mr-2">03</span>OkaCRM</a>
            <a href="#okaisp" class="block text-umber hover:text-espresso transition-colors"><span class="font-mono text-[10px] text-stone mr-2">04</span>OkaISP</a>
            <a href="#nosotros" class="block text-umber hover:text-espresso transition-colors"><span class="font-mono text-[10px] text-stone mr-2">05</span>Nosotros</a>
            <a href="{{ route('blog.index') }}" class="block text-umber hover:text-espresso transition-colors"><span class="font-mono text-[10px] text-stone mr-2">06</span>Blog</a>
            <a href="#contacto" class="block text-terracotta font-semibold"><span class="font-mono text-[10px] text-stone mr-2">07</span>Contacto →</a>
        </div>
    </nav>

    {{-- Hero — Section 01 --}}
    <section class="relative pt-36 pb-24 md:pt-44 md:pb-32 overflow-hidden">
        <div class="absolute inset-0 grain opacity-50 pointer-events-none"></div>

        <div class="relative max-w-7xl mx-auto px-6">
            {{-- Section marker --}}
            <div class="flex items-center gap-3 mb-12 font-mono text-xs text-greige uppercase tracking-widest">
                <span>(01)</span>
                <span class="h-px w-12 bg-espresso/30"></span>
                <span>Inicio</span>
                <span class="ml-auto hidden sm:flex items-center gap-2">
                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-deep animate-pulse"></span>
                    Operando · Caracas, VE
                </span>
            </div>

            <div class="grid lg:grid-cols-12 gap-8 lg:gap-12 items-end" data-reveal-group>
                <div class="lg:col-span-9" data-reveal>
                    <h1 class="font-display font-medium tracking-tight leading-[0.95] text-[clamp(3rem,9vw,8.5rem)]">
                        Software<br>
                        <span class="italic font-light text-terracotta">hecho a mano,</span><br>
                        a escala.
                    </h1>
                </div>
                <div class="lg:col-span-3 lg:pb-4" data-reveal>
                    <div class="h-px w-16 bg-espresso/40 mb-5"></div>
                    <p class="text-umber leading-relaxed">
                        Plataformas verticales para industrias específicas. Un CRM para creadores de contenido. Un ERP con IA para proveedores de internet.
                    </p>
                </div>
            </div>

            <div class="mt-14 flex flex-col sm:flex-row items-start sm:items-center gap-5" data-reveal style="--reveal-delay: 120ms">
                <a href="#productos" class="group pressable inline-flex items-center gap-3 px-7 py-3.5 bg-espresso hover:bg-terracotta text-bone font-medium">
                    Ver productos
                    <span class="font-mono text-xs group-hover:translate-x-1 transition-transform duration-200 ease-out-strong">→</span>
                </a>
                <a href="#contacto" class="inline-flex items-center gap-3 text-espresso hover:text-terracotta font-medium transition-colors border-b border-espresso/30 hover:border-terracotta pb-1">
                    Hablemos de tu proyecto
                </a>
            </div>

            {{-- Metadata strip --}}
            <div class="mt-24 pt-8 border-t border-espresso/15 grid grid-cols-2 md:grid-cols-4 gap-y-6 gap-x-8 font-mono text-xs" data-reveal style="--reveal-delay: 200ms">
                <div>
                    <div class="text-stone uppercase tracking-widest mb-1.5">Sede</div>
                    <div class="text-espresso">Caracas, Venezuela</div>
                    <div class="text-greige">10.4806° N · 66.9036° W</div>
                </div>
                <div>
                    <div class="text-stone uppercase tracking-widest mb-1.5">Fundada</div>
                    <div class="text-espresso">MMXIX · 2019</div>
                    <div class="text-greige">RIF J-41299500-6</div>
                </div>
                <div>
                    <div class="text-stone uppercase tracking-widest mb-1.5">Productos</div>
                    <div class="text-espresso">OkaCRM · OkaISP</div>
                    <div class="text-greige">Más en desarrollo</div>
                </div>
                <div>
                    <div class="text-stone uppercase tracking-widest mb-1.5">Stack</div>
                    <div class="text-espresso">IA · Cloud · LATAM</div>
                    <div class="text-greige">Soporte 24/7</div>
                </div>
            </div>
        </div>
    </section>

    {{-- Marquee — clientes / sectores --}}
    <div class="marquee border-y border-espresso/15 bg-paper py-5 overflow-hidden">
        <div class="marquee-track flex gap-16 whitespace-nowrap font-mono text-sm text-greige">
            @for ($i = 0; $i < 2; $i++)
                <span>★ INFLUENCERS</span>
                <span>★ CREADORES DE CONTENIDO</span>
                <span>★ PROVEEDORES DE INTERNET</span>
                <span>★ ISP REGIONALES</span>
                <span>★ MARCAS PERSONALES</span>
                <span>★ OPERADORES DE FIBRA</span>
                <span>★ AGENCIAS DIGITALES</span>
                <span>★ PYMES TECNOLÓGICAS</span>
            @endfor
        </div>
    </div>

    {{-- Productos — Section 02 --}}
    <section id="productos" class="py-24 md:py-32 relative">
        <div class="max-w-7xl mx-auto px-6">
            <div class="flex items-center gap-3 mb-16 font-mono text-xs text-greige uppercase tracking-widest">
                <span>(02)</span>
                <span class="h-px w-12 bg-espresso/30"></span>
                <span>Productos</span>
            </div>

            <div class="grid lg:grid-cols-12 gap-8 lg:gap-12 mb-20" data-reveal>
                <div class="lg:col-span-7">
                    <h2 class="font-display font-medium tracking-tight leading-[1.05] text-5xl md:text-6xl lg:text-7xl">
                        Dos productos.<br>
                        <span class="italic text-greige">Dos mundos distintos.</span>
                    </h2>
                </div>
                <div class="lg:col-span-4 lg:col-start-9 flex items-end">
                    <p class="text-umber leading-relaxed">
                        No hacemos software genérico. Cada plataforma resuelve problemas concretos de una industria concreta — con la profundidad que eso exige.
                    </p>
                </div>
            </div>

            <div class="grid md:grid-cols-2 gap-px bg-espresso/15 border border-espresso/15" data-reveal-group>
                {{-- OkaCRM Card — editorial / warm --}}
                <a href="#okacrm" class="group pressable bg-paper hover:bg-cream p-10 lg:p-12 relative" data-reveal>
                    <div class="flex items-start justify-between mb-12">
                        <div class="font-mono text-xs text-greige uppercase tracking-widest">
                            <div>Producto / 01</div>
                            <div class="text-terracotta mt-1">okacrm.net</div>
                        </div>
                        <div class="w-12 h-12 bg-terracotta/10 border border-terracotta/30 flex items-center justify-center">
                            <svg class="w-5 h-5 text-terracotta" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128H5.228A2 2 0 013 17.208V5.792A2 2 0 015.228 3.872h13.544A2 2 0 0121 5.792v3.528M12 8.25a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0z"/></svg>
                        </div>
                    </div>
                    <h3 class="font-display text-4xl md:text-5xl font-medium mb-3 tracking-tight">OkaCRM</h3>
                    <p class="text-umber leading-relaxed mb-8 max-w-md">
                        El CRM diseñado para creadores de contenido que quieren convertir su audiencia en una marca personal sostenible.
                    </p>
                    <div class="flex flex-wrap gap-x-4 gap-y-2 font-mono text-xs text-greige">
                        <span>+ Gestión de marca</span>
                        <span>+ Campañas</span>
                        <span>+ Métricas</span>
                        <span>+ Colaboraciones</span>
                    </div>
                    <div class="mt-10 flex items-center gap-2 text-terracotta font-medium text-sm">
                        Conocer OkaCRM
                        <span class="font-mono group-hover:translate-x-1 transition-transform">→</span>
                    </div>
                </a>

                {{-- OkaISP Card — technical / structural --}}
                <a href="#okaisp" class="group pressable bg-espresso hover:bg-ink text-bone p-10 lg:p-12 relative" data-reveal>
                    <div class="flex items-start justify-between mb-12">
                        <div class="font-mono text-xs text-stone uppercase tracking-widest">
                            <div>Producto / 02</div>
                            <div class="text-emerald-soft mt-1">okaisp · v1.0</div>
                        </div>
                        <div class="w-12 h-12 bg-emerald-soft/15 border border-emerald-soft/40 flex items-center justify-center">
                            <svg class="w-5 h-5 text-emerald-soft" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M5.25 14.25h13.5m-13.5 0a3 3 0 01-3-3m3 3a3 3 0 100 6h13.5a3 3 0 100-6m-16.5-3a3 3 0 013-3h13.5a3 3 0 013 3m-19.5 0a4.5 4.5 0 01.9-2.7L5.737 5.1a3.375 3.375 0 012.7-1.35h7.126c1.062 0 2.062.5 2.7 1.35l2.587 3.45a4.5 4.5 0 01.9 2.7"/></svg>
                        </div>
                    </div>
                    <h3 class="font-mono text-4xl md:text-5xl font-medium mb-3 tracking-tighter">OkaISP</h3>
                    <p class="text-stone leading-relaxed mb-8 max-w-md font-sans">
                        ERP con inteligencia artificial para proveedores de internet. Operaciones, contabilidad y predicción — en una sola plataforma.
                    </p>
                    <div class="flex flex-wrap gap-x-4 gap-y-2 font-mono text-xs text-stone">
                        <span>// IA integrada</span>
                        <span>// contabilidad</span>
                        <span>// automatización</span>
                        <span>// predicción</span>
                    </div>
                    <div class="mt-10 flex items-center gap-2 text-emerald-soft font-medium text-sm">
                        Conocer OkaISP
                        <span class="font-mono group-hover:translate-x-1 transition-transform">→</span>
                    </div>
                </a>
            </div>
        </div>
    </section>

    {{-- OkaCRM Detail — Section 03 --}}
    <section id="okacrm" class="py-24 md:py-32 bg-paper relative">
        <div class="max-w-7xl mx-auto px-6">
            <div class="flex items-center gap-3 mb-16 font-mono text-xs text-greige uppercase tracking-widest">
                <span>(03)</span>
                <span class="h-px w-12 bg-espresso/30"></span>
                <span>OkaCRM</span>
                <span class="ml-auto text-terracotta">okacrm.net</span>
            </div>

            <div class="grid lg:grid-cols-12 gap-8 lg:gap-16 items-start" data-reveal-group>
                <div class="lg:col-span-6" data-reveal>
                    <h2 class="font-display font-medium tracking-tight leading-[1.05] text-5xl md:text-6xl mb-8">
                        El CRM que los<br>
                        <span class="italic text-terracotta">influencers</span> necesitan.
                    </h2>
                    <p class="text-umber text-lg leading-relaxed mb-12 max-w-lg">
                        Centraliza tus contactos, gestiona colaboraciones con marcas y mide el impacto real de tu presencia digital. Profesionaliza tu marca personal sin perder la voz que te trajo aquí.
                    </p>

                    <div class="space-y-px bg-espresso/15">
                        <div class="bg-paper py-6 px-1 grid grid-cols-12 gap-4">
                            <div class="col-span-1 font-mono text-xs text-stone pt-1">01</div>
                            <div class="col-span-11">
                                <h4 class="font-display font-semibold text-lg mb-1">Posicionamiento de marca</h4>
                                <p class="text-greige text-sm leading-relaxed">Herramientas estratégicas para construir y fortalecer tu marca personal.</p>
                            </div>
                        </div>
                        <div class="bg-paper py-6 px-1 grid grid-cols-12 gap-4">
                            <div class="col-span-1 font-mono text-xs text-stone pt-1">02</div>
                            <div class="col-span-11">
                                <h4 class="font-display font-semibold text-lg mb-1">Gestión de colaboraciones</h4>
                                <p class="text-greige text-sm leading-relaxed">Propuestas, contratos y campañas con marcas — todo en un solo lugar.</p>
                            </div>
                        </div>
                        <div class="bg-paper py-6 px-1 grid grid-cols-12 gap-4">
                            <div class="col-span-1 font-mono text-xs text-stone pt-1">03</div>
                            <div class="col-span-11">
                                <h4 class="font-display font-semibold text-lg mb-1">Analítica de impacto</h4>
                                <p class="text-greige text-sm leading-relaxed">Métricas reales de engagement, alcance y crecimiento de audiencia.</p>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Editorial-style mockup: creator profile card --}}
                <div class="lg:col-span-6 lg:sticky lg:top-32" data-reveal>
                    <div class="border border-espresso/20 bg-bone p-8 md:p-10">
                        <div class="flex items-center justify-between font-mono text-xs text-greige mb-8 pb-6 border-b border-espresso/10">
                            <span>okacrm.net / perfil</span>
                            <span class="text-emerald-deep">● activo</span>
                        </div>

                        <div class="flex items-start gap-5 mb-8">
                            <div class="w-16 h-16 bg-terracotta/15 border border-terracotta/30 flex items-center justify-center font-display font-semibold text-2xl text-terracotta shrink-0">M</div>
                            <div class="flex-1">
                                <h5 class="font-display text-2xl font-medium leading-tight">María Fernández</h5>
                                <p class="font-mono text-xs text-greige mt-1">@maria.creates · Lifestyle · Caracas</p>
                            </div>
                        </div>

                        <div class="grid grid-cols-3 gap-px bg-espresso/15 mb-8">
                            <div class="bg-bone p-4">
                                <div class="font-mono text-[10px] text-greige uppercase tracking-widest mb-1">Audiencia</div>
                                <div class="font-display text-2xl font-medium">128K</div>
                            </div>
                            <div class="bg-bone p-4">
                                <div class="font-mono text-[10px] text-greige uppercase tracking-widest mb-1">Engagement</div>
                                <div class="font-display text-2xl font-medium text-emerald-deep">8.2%</div>
                            </div>
                            <div class="bg-bone p-4">
                                <div class="font-mono text-[10px] text-greige uppercase tracking-widest mb-1">Activos</div>
                                <div class="font-display text-2xl font-medium text-terracotta">04</div>
                            </div>
                        </div>

                        <div class="space-y-3">
                            <div class="font-mono text-[10px] text-greige uppercase tracking-widest mb-3">Colaboraciones · Q2 2026</div>
                            <div class="flex items-center justify-between py-2.5 border-b border-espresso/10">
                                <div>
                                    <div class="text-sm font-medium">Cosmética Andina</div>
                                    <div class="font-mono text-[10px] text-greige">propuesta enviada · 04/22</div>
                                </div>
                                <span class="font-mono text-[10px] px-2 py-1 bg-ochre/15 text-ochre">PENDIENTE</span>
                            </div>
                            <div class="flex items-center justify-between py-2.5 border-b border-espresso/10">
                                <div>
                                    <div class="text-sm font-medium">Café Coronado</div>
                                    <div class="font-mono text-[10px] text-greige">campaña activa · 03/15 → 05/15</div>
                                </div>
                                <span class="font-mono text-[10px] px-2 py-1 bg-emerald-deep/15 text-emerald-deep">ACTIVA</span>
                            </div>
                            <div class="flex items-center justify-between py-2.5">
                                <div>
                                    <div class="text-sm font-medium">Aurora Joyas</div>
                                    <div class="font-mono text-[10px] text-greige">finalizada · 02/10</div>
                                </div>
                                <span class="font-mono text-[10px] px-2 py-1 bg-stone/20 text-greige">CERRADA</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- OkaISP Detail — Section 04 — technical / blueprint --}}
    <section id="okaisp" class="py-24 md:py-32 bg-espresso text-bone relative overflow-hidden">
        <div class="absolute inset-0 grain opacity-20 pointer-events-none"></div>

        <div class="relative max-w-7xl mx-auto px-6">
            <div class="flex items-center gap-3 mb-16 font-mono text-xs text-stone uppercase tracking-widest">
                <span>(04)</span>
                <span class="h-px w-12 bg-bone/25"></span>
                <span>OkaISP</span>
                <span class="ml-auto text-emerald-soft">okaisp · v1.0.0</span>
            </div>

            <div class="grid lg:grid-cols-12 gap-8 lg:gap-16 items-start" data-reveal-group>
                {{-- Technical mockup --}}
                <div class="lg:col-span-6 order-2 lg:order-1 lg:sticky lg:top-32" data-reveal>
                    <div class="border border-bone/15 bg-ink/50 backdrop-blur p-8 font-mono text-sm">
                        <div class="flex items-center justify-between text-xs text-stone mb-6 pb-4 border-b border-bone/10">
                            <span>okaisp / dashboard.operaciones</span>
                            <span class="text-emerald-soft flex items-center gap-2">
                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-soft animate-pulse"></span>
                                IA · activa
                            </span>
                        </div>

                        <div class="text-xs text-stone uppercase tracking-widest mb-4">// Métricas operativas</div>

                        <div class="grid grid-cols-2 gap-px bg-bone/10 mb-8">
                            <div class="bg-ink p-5">
                                <div class="text-[10px] text-stone uppercase tracking-widest mb-2">Costos op.</div>
                                <div class="text-3xl text-emerald-soft font-medium tracking-tight">−32%</div>
                                <div class="mt-3 h-px w-full bg-bone/10 relative">
                                    <div class="absolute top-0 left-0 h-px w-2/3 bg-emerald-soft"></div>
                                </div>
                            </div>
                            <div class="bg-ink p-5">
                                <div class="text-[10px] text-stone uppercase tracking-widest mb-2">Automatización</div>
                                <div class="text-3xl text-terracotta-soft font-medium tracking-tight">87%</div>
                                <div class="mt-3 h-px w-full bg-bone/10 relative">
                                    <div class="absolute top-0 left-0 h-px w-[87%] bg-terracotta-soft"></div>
                                </div>
                            </div>
                        </div>

                        <div class="text-xs text-stone uppercase tracking-widest mb-4">// Predicción · 30 días</div>
                        <div class="bg-ink p-5 border border-bone/10 mb-8">
                            <div class="flex items-end gap-[2px] h-20">
                                @php
                                    $bars = [42, 58, 73, 51, 88, 67, 79, 45, 92, 64, 73, 81, 56, 89, 72, 94, 68, 82, 59, 76, 91, 65, 87, 73, 95, 68, 84, 71, 79, 88];
                                @endphp
                                @foreach ($bars as $h)
                                    <div class="flex-1 bg-emerald-soft/60 hover:bg-terracotta-soft transition-colors" style="height: {{ $h }}%"></div>
                                @endforeach
                            </div>
                            <div class="flex justify-between mt-3 text-[10px] text-stone">
                                <span>04/30</span>
                                <span>05/15</span>
                                <span>05/30</span>
                            </div>
                        </div>

                        <div class="text-xs text-stone uppercase tracking-widest mb-4">// Estado red</div>
                        <div class="grid grid-cols-3 gap-px bg-bone/10">
                            <div class="bg-ink p-4">
                                <div class="text-[10px] text-stone uppercase mb-1">Clientes</div>
                                <div class="text-lg text-bone">2,847</div>
                            </div>
                            <div class="bg-ink p-4">
                                <div class="text-[10px] text-stone uppercase mb-1">Tickets</div>
                                <div class="text-lg text-emerald-soft">14</div>
                            </div>
                            <div class="bg-ink p-4">
                                <div class="text-[10px] text-stone uppercase mb-1">Uptime</div>
                                <div class="text-lg text-bone">99.94%</div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="lg:col-span-6 order-1 lg:order-2" data-reveal>
                    <h2 class="font-display font-medium tracking-tight leading-[1.05] text-5xl md:text-6xl mb-8">
                        ERP inteligente para<br>
                        <span class="italic text-emerald-soft">proveedores de internet.</span>
                    </h2>
                    <p class="text-stone text-lg leading-relaxed mb-12 max-w-lg">
                        Cada proceso operativo, con IA integrada. Desde la gestión de clientes hasta la contabilidad — todo optimizado para reducir costos y aumentar la eficiencia de tu red.
                    </p>

                    <div class="space-y-px bg-bone/10">
                        <div class="bg-espresso py-6 px-1 grid grid-cols-12 gap-4">
                            <div class="col-span-2 font-mono text-xs text-stone pt-1">// 01</div>
                            <div class="col-span-10">
                                <h4 class="font-mono font-medium text-base mb-1.5 text-bone">IA para operaciones</h4>
                                <p class="text-stone text-sm leading-relaxed">Predicción de fallas, optimización de rutas y asignación inteligente de recursos.</p>
                            </div>
                        </div>
                        <div class="bg-espresso py-6 px-1 grid grid-cols-12 gap-4">
                            <div class="col-span-2 font-mono text-xs text-stone pt-1">// 02</div>
                            <div class="col-span-10">
                                <h4 class="font-mono font-medium text-base mb-1.5 text-bone">Optimización de costos</h4>
                                <p class="text-stone text-sm leading-relaxed">Análisis automatizado de gastos con sugerencias basadas en patrones históricos.</p>
                            </div>
                        </div>
                        <div class="bg-espresso py-6 px-1 grid grid-cols-12 gap-4">
                            <div class="col-span-2 font-mono text-xs text-stone pt-1">// 03</div>
                            <div class="col-span-10">
                                <h4 class="font-mono font-medium text-base mb-1.5 text-bone">Contabilidad integrada</h4>
                                <p class="text-stone text-sm leading-relaxed">Facturación, cuentas por cobrar y reportes fiscales adaptados a Venezuela.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- IA en movimiento — Sidebar editorial entre OkaISP y Nosotros --}}
    <section id="ia" class="py-24 md:py-32 bg-paper relative overflow-hidden">
        <div class="max-w-7xl mx-auto px-6">
            <div class="flex items-center gap-3 mb-16 font-mono text-xs text-greige uppercase tracking-widest">
                <span>// IA</span>
                <span class="h-px w-12 bg-espresso/30"></span>
                <span>Motor interno</span>
                <span class="ml-auto text-terracotta">04 ½</span>
            </div>

            <div class="grid lg:grid-cols-12 gap-8 lg:gap-16 items-center" data-reveal-group>
                <div class="lg:col-span-5 lg:order-1" data-reveal>
                    <h2 class="font-display font-medium tracking-tight leading-[1.05] text-5xl md:text-6xl mb-8">
                        Inteligencia<br>
                        <span class="italic text-terracotta">no decorativa.</span>
                    </h2>
                    <p class="text-umber text-lg leading-relaxed mb-8 max-w-md">
                        La IA no es una etiqueta de marketing. Es el motor que predice fallas en tu red, optimiza tus colaboraciones y aprende de cada operación — en producción, no en una demo.
                    </p>
                    <div class="flex flex-wrap gap-x-5 gap-y-2 font-mono text-xs text-greige">
                        <span>+ predicción</span>
                        <span>+ optimización</span>
                        <span>+ aprendizaje</span>
                        <span>+ automatización</span>
                    </div>
                </div>

                <div class="lg:col-span-7 lg:order-2" data-reveal>
                    <figure class="border border-espresso/20 bg-espresso aspect-video overflow-hidden relative group">
                        <video
                            autoplay
                            loop
                            muted
                            playsinline
                            preload="metadata"
                            poster=""
                            aria-label="Visualización de una red neuronal artificial"
                            class="w-full h-full object-cover opacity-90 group-hover:opacity-100 transition-opacity">
                            <source src="https://videos.pexels.com/video-files/18333010/18333010-hd_1280_720_25fps.mp4" type="video/mp4">
                            Tu navegador no soporta video HTML5.
                        </video>

                        <div class="absolute top-4 left-4 flex items-center gap-2 px-2.5 py-1 bg-ink/60 backdrop-blur-sm font-mono text-[10px] text-bone uppercase tracking-widest">
                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-soft animate-pulse"></span>
                            live · neural net
                        </div>
                        <figcaption class="absolute bottom-4 right-4 font-mono text-[10px] text-bone/60 uppercase tracking-widest">
                            footage · pexels · royalty-free
                        </figcaption>
                    </figure>
                </div>
            </div>
        </div>
    </section>

    {{-- Nosotros — Section 05 --}}
    <section id="nosotros" class="py-24 md:py-32 relative">
        <div class="max-w-7xl mx-auto px-6">
            <div class="flex items-center gap-3 mb-16 font-mono text-xs text-greige uppercase tracking-widest">
                <span>(05)</span>
                <span class="h-px w-12 bg-espresso/30"></span>
                <span>Nosotros</span>
            </div>

            <div class="grid lg:grid-cols-12 gap-8 lg:gap-16 mb-20" data-reveal>
                <div class="lg:col-span-7">
                    <h2 class="font-display font-medium tracking-tight leading-[1.05] text-5xl md:text-6xl">
                        Tecnología venezolana,<br>
                        <span class="italic text-terracotta">construida con criterio.</span>
                    </h2>
                </div>
                <div class="lg:col-span-4 lg:col-start-9 flex items-end">
                    <p class="text-umber leading-relaxed">
                        Desde Caracas, Venezuela. Desde 2019. Combinamos innovación, IA y un conocimiento profundo del mercado latinoamericano para construir software que dura.
                    </p>
                </div>
            </div>

            <div class="grid md:grid-cols-3 gap-px bg-espresso/15 border border-espresso/15" data-reveal-group>
                <div class="bg-paper p-10" data-reveal>
                    <div class="font-mono text-xs text-greige uppercase tracking-widest mb-6">— 01</div>
                    <h3 class="font-display text-2xl font-medium mb-3">Hecha en Venezuela</h3>
                    <p class="text-umber text-sm leading-relaxed">
                        Conocemos las necesidades del mercado latinoamericano de primera mano. Eso se nota en cada decisión de producto.
                    </p>
                </div>
                <div class="bg-paper p-10" data-reveal>
                    <div class="font-mono text-xs text-terracotta uppercase tracking-widest mb-6">— 02</div>
                    <h3 class="font-display text-2xl font-medium mb-3">IA como pilar</h3>
                    <p class="text-umber text-sm leading-relaxed">
                        La inteligencia artificial no es un añadido. Es parte fundamental de la arquitectura y la propuesta de valor.
                    </p>
                </div>
                <div class="bg-paper p-10" data-reveal>
                    <div class="font-mono text-xs text-emerald-deep uppercase tracking-widest mb-6">— 03</div>
                    <h3 class="font-display text-2xl font-medium mb-3">Verticales, no genéricos</h3>
                    <p class="text-umber text-sm leading-relaxed">
                        No hacemos software para todos. Cada producto resuelve problemas concretos de una industria específica.
                    </p>
                </div>
            </div>
        </div>
    </section>

    {{-- Contacto — Section 06 --}}
    <section id="contacto" class="py-24 md:py-32 bg-paper relative">
        <div class="max-w-7xl mx-auto px-6">
            <div class="flex items-center gap-3 mb-16 font-mono text-xs text-greige uppercase tracking-widest">
                <span>(06)</span>
                <span class="h-px w-12 bg-espresso/30"></span>
                <span>Contacto</span>
            </div>

            <div class="grid lg:grid-cols-12 gap-12 lg:gap-16" data-reveal-group>
                <div class="lg:col-span-5" data-reveal>
                    <h2 class="font-display font-medium tracking-tight leading-[1.05] text-5xl md:text-6xl mb-8">
                        Hablemos de<br>
                        <span class="italic text-terracotta">tu proyecto.</span>
                    </h2>
                    <p class="text-umber leading-relaxed mb-12">
                        Si eres creador de contenido o un proveedor de internet — o algo entre medio que requiere software bien hecho — escríbenos.
                    </p>

                    <div class="space-y-6">
                        <div>
                            <div class="font-mono text-xs text-greige uppercase tracking-widest mb-2">Directo · WhatsApp</div>
                            <a href="https://wa.me/584241780659" target="_blank" rel="noopener" class="inline-flex items-center gap-3 text-2xl font-display font-medium text-espresso hover:text-terracotta transition-colors">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
                                +58 424 178 0659
                            </a>
                        </div>

                        <div>
                            <div class="font-mono text-xs text-greige uppercase tracking-widest mb-2">Oficina</div>
                            <p class="text-espresso leading-relaxed">
                                Av. Rómulo Gallegos con Calle Pedro Manrique<br>
                                Edif. Centro ALOA, PP-36-L<br>
                                <span class="text-greige">Caracas 1071, Venezuela</span>
                            </p>
                        </div>
                    </div>
                </div>

                <div class="lg:col-span-7" data-reveal>
                    <form class="border border-espresso/20 bg-bone p-8 md:p-10 space-y-8">
                        <div class="grid md:grid-cols-2 gap-x-6 gap-y-8">
                            <div>
                                <label class="block font-mono text-xs text-greige uppercase tracking-widest mb-2">— Nombre</label>
                                <input type="text" placeholder="Tu nombre" class="w-full bg-transparent border-0 border-b border-espresso/30 px-0 py-2 text-espresso placeholder-stone focus:outline-none focus:border-terracotta transition-colors">
                            </div>
                            <div>
                                <label class="block font-mono text-xs text-greige uppercase tracking-widest mb-2">— Email</label>
                                <input type="email" placeholder="tu@email.com" class="w-full bg-transparent border-0 border-b border-espresso/30 px-0 py-2 text-espresso placeholder-stone focus:outline-none focus:border-terracotta transition-colors">
                            </div>
                        </div>
                        <div>
                            <label class="block font-mono text-xs text-greige uppercase tracking-widest mb-2">— Producto de interés</label>
                            <select class="w-full bg-transparent border-0 border-b border-espresso/30 px-0 py-2 text-espresso focus:outline-none focus:border-terracotta transition-colors">
                                <option value="">Selecciona un producto</option>
                                <option value="okacrm">OkaCRM — CRM para creadores</option>
                                <option value="okaisp">OkaISP — ERP para ISP</option>
                                <option value="ambos">Ambos productos</option>
                                <option value="otro">Otro</option>
                            </select>
                        </div>
                        <div>
                            <label class="block font-mono text-xs text-greige uppercase tracking-widest mb-2">— Mensaje</label>
                            <textarea rows="4" placeholder="Cuéntanos sobre tu proyecto..." class="w-full bg-transparent border-0 border-b border-espresso/30 px-0 py-2 text-espresso placeholder-stone focus:outline-none focus:border-terracotta transition-colors resize-none"></textarea>
                        </div>
                        <button type="submit" class="group pressable inline-flex items-center gap-3 px-8 py-3.5 bg-espresso hover:bg-terracotta text-bone font-medium">
                            Enviar mensaje
                            <span class="font-mono text-xs group-hover:translate-x-1 transition-transform duration-200 ease-out-strong">→</span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    {{-- Footer --}}
    <footer class="bg-espresso text-bone py-16">
        <div class="max-w-7xl mx-auto px-6">
            <div class="grid md:grid-cols-12 gap-10 mb-16">
                <div class="md:col-span-5">
                    <a href="#" class="flex items-center gap-3 mb-5">
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
                        <li><a href="#okacrm" class="hover:text-terracotta transition-colors">OkaCRM</a></li>
                        <li><a href="#okaisp" class="hover:text-terracotta transition-colors">OkaISP</a></li>
                    </ul>
                </div>
                <div class="md:col-span-2">
                    <h4 class="font-mono text-xs text-greige uppercase tracking-widest mb-4">— Empresa</h4>
                    <ul class="space-y-2.5 text-sm text-stone">
                        <li><a href="#nosotros" class="hover:text-terracotta transition-colors">Nosotros</a></li>
                        <li><a href="{{ route('blog.index') }}" class="hover:text-terracotta transition-colors">Blog</a></li>
                        <li><a href="#contacto" class="hover:text-terracotta transition-colors">Contacto</a></li>
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
        document.querySelectorAll('#mobile-menu a').forEach(link => {
            link.addEventListener('click', () => {
                document.getElementById('mobile-menu').classList.add('hidden');
            });
        });
    </script>
</body>
</html>
