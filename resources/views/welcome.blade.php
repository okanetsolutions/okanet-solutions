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
<body class="bg-bone text-espresso antialiased font-sans selection:bg-terracotta selection:text-bone overflow-x-hidden">

    {{-- Scroll progress — the page's single wayfinding system --}}
    <div class="fixed top-0 left-0 right-0 h-0.5 z-[60] bg-espresso/5">
        <div id="scroll-progress" class="scroll-progress h-full bg-terracotta"></div>
    </div>

    {{-- Navigation --}}
    <nav class="fixed top-0 w-full z-50 bg-bone/80 backdrop-blur-md border-b border-espresso/10">
        <div class="max-w-7xl mx-auto px-6 py-4 flex items-center justify-between">
            <a href="#top" class="group flex items-center gap-3">
                <div class="w-9 h-9 bg-espresso group-hover:bg-terracotta transition-colors duration-300 flex items-center justify-center font-display font-bold text-bone text-base">O</div>
                <span class="text-xl font-display font-semibold tracking-tight">Okanet<span class="text-terracotta">.</span></span>
            </a>
            <div class="hidden md:flex items-center gap-8 text-sm">
                <a href="#productos" data-nav class="nav-link text-umber hover:text-espresso transition-colors">Productos</a>
                <a href="#okacrm" data-nav class="nav-link text-umber hover:text-espresso transition-colors">OkaCRM</a>
                <a href="#okaisp" data-nav class="nav-link text-umber hover:text-espresso transition-colors">OkaISP</a>
                <a href="#nosotros" data-nav class="nav-link text-umber hover:text-espresso transition-colors">Nosotros</a>
                <a href="{{ route('blog.index') }}" class="nav-link text-umber hover:text-espresso transition-colors">Blog</a>
                <a href="#contacto" class="pressable px-5 py-2 bg-espresso hover:bg-terracotta text-bone font-medium">Contacto →</a>
            </div>
            <button id="menu-toggle" class="md:hidden text-espresso" aria-label="Abrir menú" aria-expanded="false" aria-controls="mobile-menu">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
            </button>
        </div>
        <div id="mobile-menu" class="hidden md:hidden px-6 pb-5 space-y-3 text-sm border-t border-espresso/5">
            <a href="#productos" class="block pt-3 text-umber hover:text-espresso transition-colors">Productos</a>
            <a href="#okacrm" class="block text-umber hover:text-espresso transition-colors">OkaCRM</a>
            <a href="#okaisp" class="block text-umber hover:text-espresso transition-colors">OkaISP</a>
            <a href="#nosotros" class="block text-umber hover:text-espresso transition-colors">Nosotros</a>
            <a href="{{ route('blog.index') }}" class="block text-umber hover:text-espresso transition-colors">Blog</a>
            <a href="#contacto" class="block text-terracotta font-semibold">Contacto →</a>
        </div>
    </nav>

    <span id="top"></span>

    {{-- Hero — one dominant idea, choreographed on load --}}
    <header class="hero relative min-h-[100svh] flex flex-col justify-center pt-28 pb-16 overflow-hidden">
        <div class="absolute inset-0 grain opacity-60 pointer-events-none"></div>

        <div class="relative w-full max-w-7xl mx-auto px-6">
            {{-- Status row — not an eyebrow, a live signal --}}
            <div class="flex items-center gap-4 mb-10 md:mb-14 font-mono text-xs text-greige reveal-line" style="--line-delay: 0ms">
                <span class="flex items-center gap-2 text-umber">
                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-soft animate-pulse"></span>
                    Operando
                </span>
                <span class="h-px w-8 bg-espresso/25"></span>
                <span>Caracas, Venezuela · 10.48°N 66.90°W</span>
                <span class="ml-auto hidden sm:block">EST. MMXIX</span>
            </div>

            <div class="grid lg:grid-cols-12 gap-y-10 lg:gap-12 items-end">
                <div class="lg:col-span-8">
                    <h1 class="hero-title font-display font-medium tracking-tight leading-[0.92] text-[clamp(2.75rem,7.5vw,5.75rem)] text-balance">
                        <span class="reveal-line" style="--line-delay: 80ms"><span>Software</span></span>
                        <span class="reveal-line" style="--line-delay: 160ms"><span class="italic font-light text-terracotta">hecho a mano,</span></span>
                        <span class="reveal-line" style="--line-delay: 240ms"><span>a escala.</span></span>
                    </h1>
                </div>
                <div class="lg:col-span-4 lg:pb-3">
                    <div class="reveal-line" style="--line-delay: 360ms">
                        <div class="h-px w-16 bg-terracotta mb-5"></div>
                    </div>
                    <p class="reveal-line text-umber leading-relaxed" style="--line-delay: 420ms">
                        <span>Plataformas verticales para industrias específicas. Un CRM para creadores de contenido. Un ERP con IA para proveedores de internet.</span>
                    </p>
                </div>
            </div>

            <div class="mt-12 md:mt-16 flex flex-col sm:flex-row items-start sm:items-center gap-5 reveal-line" style="--line-delay: 520ms">
                <div class="flex flex-col sm:flex-row items-start sm:items-center gap-5">
                    <a href="#contacto" class="group pressable inline-flex items-center gap-3 px-7 py-3.5 bg-espresso hover:bg-terracotta text-bone font-medium">
                        Hablemos de tu proyecto
                        <span class="font-mono text-xs group-hover:translate-x-1 transition-transform duration-200 ease-out-strong">→</span>
                    </a>
                </div>
            </div>
        </div>

    </header>

    {{-- Marquee — sectores que servimos --}}
    <div class="marquee border-y border-espresso/15 bg-paper py-5 overflow-hidden">
        <div class="marquee-track flex gap-16 whitespace-nowrap font-mono text-sm text-umber/65">
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

    {{-- Productos — dos mundos --}}
    <section id="productos" class="py-24 md:py-32 scroll-mt-20">
        <div class="max-w-7xl mx-auto px-6">
            <div class="grid lg:grid-cols-12 gap-8 lg:gap-12 mb-16 lg:mb-20" data-reveal>
                <div class="lg:col-span-8">
                    <h2 class="font-display font-medium tracking-tight leading-[1.02] text-[clamp(2.25rem,5.5vw,4.5rem)] text-balance">
                        Dos productos.
                        <span class="italic text-greige">Dos mundos distintos.</span>
                    </h2>
                </div>
                <div class="lg:col-span-3 lg:col-start-10 flex items-end">
                    <p class="text-umber leading-relaxed">
                        No hacemos software genérico. Cada plataforma resuelve problemas concretos de una industria concreta — con la profundidad que eso exige.
                    </p>
                </div>
            </div>

            {{-- The two worlds meet at a seam --}}
            <div class="relative grid md:grid-cols-2 border border-espresso/15" data-reveal-group>
                <div class="hidden md:block absolute top-0 bottom-0 left-1/2 -translate-x-1/2 w-px seam z-10" aria-hidden="true">
                    <div class="seam-node absolute -left-[3px] w-[7px] h-[7px] rounded-full bg-terracotta shadow-[0_0_12px_2px_rgba(184,83,42,0.5)]"></div>
                </div>

                {{-- OkaCRM — the warm world --}}
                <a href="#okacrm" class="group pressable bg-paper hover:bg-cream p-10 lg:p-14 relative border-b md:border-b-0 border-espresso/15" data-reveal>
                    <div class="flex items-start justify-between mb-14">
                        <div class="font-mono text-xs">
                            <div class="text-greige">El mundo cálido</div>
                            <div class="text-terracotta mt-1">okacrm.net</div>
                        </div>
                        <div class="w-12 h-12 bg-terracotta/10 border border-terracotta/30 flex items-center justify-center group-hover:scale-105 transition-transform duration-300 ease-out-strong">
                            <svg class="w-5 h-5 text-terracotta" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128H5.228A2 2 0 013 17.208V5.792A2 2 0 015.228 3.872h13.544A2 2 0 0121 5.792v3.528M12 8.25a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0z"/></svg>
                        </div>
                    </div>
                    <h3 class="font-display text-4xl md:text-5xl font-medium mb-3 tracking-tight">OkaCRM</h3>
                    <p class="text-umber leading-relaxed mb-8 max-w-md">
                        El CRM diseñado para creadores de contenido que quieren convertir su audiencia en una marca personal sostenible.
                    </p>
                    <div class="flex flex-wrap gap-x-4 gap-y-2 font-mono text-xs text-umber/70">
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

                {{-- OkaISP — the technical world --}}
                <a href="#okaisp" class="group pressable bg-espresso hover:bg-ink text-bone p-10 lg:p-14 relative overflow-hidden" data-reveal>
                    <div class="absolute inset-0 blueprint opacity-60 pointer-events-none"></div>
                    <div class="relative flex items-start justify-between mb-14">
                        <div class="font-mono text-xs">
                            <div class="text-stone">El mundo técnico</div>
                            <div class="text-emerald-soft mt-1">okaisp · v1.0</div>
                        </div>
                        <div class="w-12 h-12 bg-emerald-soft/15 border border-emerald-soft/40 flex items-center justify-center group-hover:scale-105 transition-transform duration-300 ease-out-strong">
                            <svg class="w-5 h-5 text-emerald-soft" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M5.25 14.25h13.5m-13.5 0a3 3 0 01-3-3m3 3a3 3 0 100 6h13.5a3 3 0 100-6m-16.5-3a3 3 0 013-3h13.5a3 3 0 013 3m-19.5 0a4.5 4.5 0 01.9-2.7L5.737 5.1a3.375 3.375 0 012.7-1.35h7.126c1.062 0 2.062.5 2.7 1.35l2.587 3.45a4.5 4.5 0 01.9 2.7"/></svg>
                        </div>
                    </div>
                    <h3 class="relative font-mono text-4xl md:text-5xl font-medium mb-3 tracking-tighter">OkaISP</h3>
                    <p class="relative text-stone leading-relaxed mb-8 max-w-md font-sans">
                        ERP con inteligencia artificial para proveedores de internet. Operaciones, contabilidad y predicción — en una sola plataforma.
                    </p>
                    <div class="relative flex flex-wrap gap-x-4 gap-y-2 font-mono text-xs text-stone">
                        <span>// IA integrada</span>
                        <span>// contabilidad</span>
                        <span>// automatización</span>
                        <span>// predicción</span>
                    </div>
                    <div class="relative mt-10 flex items-center gap-2 text-emerald-soft font-medium text-sm">
                        Conocer OkaISP
                        <span class="font-mono group-hover:translate-x-1 transition-transform">→</span>
                    </div>
                </a>
            </div>
        </div>
    </section>

    {{-- OkaCRM Detail — warm, editorial --}}
    <section id="okacrm" class="py-24 md:py-32 bg-paper scroll-mt-20">
        <div class="max-w-7xl mx-auto px-6">
            <div class="grid lg:grid-cols-12 gap-8 lg:gap-16 items-start" data-reveal-group>
                <div class="lg:col-span-6" data-reveal>
                    <div class="flex items-center gap-3 mb-6 font-mono text-xs text-terracotta">
                        <span class="w-1.5 h-1.5 rounded-full bg-terracotta"></span>
                        OkaCRM · okacrm.net
                    </div>
                    <h2 class="font-display font-medium tracking-tight leading-[1.04] text-[clamp(2.25rem,5vw,3.75rem)] mb-8 text-balance">
                        El CRM que los
                        <span class="italic text-terracotta">influencers</span> necesitan.
                    </h2>
                    <p class="text-umber text-lg leading-relaxed mb-12 max-w-lg text-pretty">
                        Centraliza tus contactos, gestiona colaboraciones con marcas y mide el impacto real de tu presencia digital. Profesionaliza tu marca personal sin perder la voz que te trajo aquí.
                    </p>

                    <div class="space-y-px bg-espresso/15">
                        <div class="bg-paper py-6 px-1 grid grid-cols-12 gap-4">
                            <div class="col-span-1 font-mono text-xs text-terracotta pt-1">01</div>
                            <div class="col-span-11">
                                <h3 class="font-display font-semibold text-lg mb-1">Posicionamiento de marca</h3>
                                <p class="text-umber text-sm leading-relaxed">Herramientas estratégicas para construir y fortalecer tu marca personal.</p>
                            </div>
                        </div>
                        <div class="bg-paper py-6 px-1 grid grid-cols-12 gap-4">
                            <div class="col-span-1 font-mono text-xs text-terracotta pt-1">02</div>
                            <div class="col-span-11">
                                <h3 class="font-display font-semibold text-lg mb-1">Gestión de colaboraciones</h3>
                                <p class="text-umber text-sm leading-relaxed">Propuestas, contratos y campañas con marcas — todo en un solo lugar.</p>
                            </div>
                        </div>
                        <div class="bg-paper py-6 px-1 grid grid-cols-12 gap-4">
                            <div class="col-span-1 font-mono text-xs text-terracotta pt-1">03</div>
                            <div class="col-span-11">
                                <h3 class="font-display font-semibold text-lg mb-1">Analítica de impacto</h3>
                                <p class="text-umber text-sm leading-relaxed">Métricas reales de engagement, alcance y crecimiento de audiencia.</p>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Editorial-style mockup: creator profile card --}}
                <div class="lg:col-span-6 lg:sticky lg:top-28" data-reveal>
                    <div class="border border-espresso/20 bg-bone p-8 md:p-10 shadow-[0_24px_60px_-30px_rgba(28,24,20,0.35)]">
                        <div class="flex items-center justify-between font-mono text-xs text-greige mb-8 pb-6 border-b border-espresso/10">
                            <span>okacrm.net / perfil</span>
                            <span class="text-emerald-deep flex items-center gap-1.5"><span class="w-1.5 h-1.5 rounded-full bg-emerald-deep"></span> activo</span>
                        </div>

                        <div class="flex items-start gap-5 mb-8">
                            <div class="w-16 h-16 bg-terracotta/15 border border-terracotta/30 flex items-center justify-center font-display font-semibold text-2xl text-terracotta shrink-0">M</div>
                            <div class="flex-1">
                                <h4 class="font-display text-2xl font-medium leading-tight">María Fernández</h4>
                                <p class="font-mono text-xs text-greige mt-1">@maria.creates · Lifestyle · Caracas</p>
                            </div>
                        </div>

                        <div class="grid grid-cols-3 gap-px bg-espresso/15 mb-8">
                            <div class="bg-bone p-4">
                                <div class="font-mono text-[10px] text-greige uppercase tracking-widest mb-1">Audiencia</div>
                                <div class="font-display text-2xl font-medium tabular">128K</div>
                            </div>
                            <div class="bg-bone p-4">
                                <div class="font-mono text-[10px] text-greige uppercase tracking-widest mb-1">Engagement</div>
                                <div class="font-display text-2xl font-medium text-emerald-deep tabular">8.2%</div>
                            </div>
                            <div class="bg-bone p-4">
                                <div class="font-mono text-[10px] text-greige uppercase tracking-widest mb-1">Activos</div>
                                <div class="font-display text-2xl font-medium text-terracotta tabular">04</div>
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
                                <span class="font-mono text-[10px] px-2 py-1 bg-stone/20 text-umber/70">CERRADA</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- OkaISP Detail — technical, drenched --}}
    <section id="okaisp" class="py-24 md:py-32 bg-espresso text-bone relative overflow-hidden scroll-mt-20">
        <div class="absolute inset-0 blueprint opacity-50 pointer-events-none"></div>
        <div class="absolute inset-0 grain opacity-20 pointer-events-none"></div>

        <div class="relative max-w-7xl mx-auto px-6">
            <div class="grid lg:grid-cols-12 gap-8 lg:gap-16 items-start" data-reveal-group>
                {{-- Technical mockup --}}
                <div class="lg:col-span-6 order-2 lg:order-1 lg:sticky lg:top-28" data-reveal>
                    <div class="border border-bone/15 bg-ink/60 backdrop-blur p-8 font-mono text-sm">
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
                                <div class="text-3xl text-emerald-soft font-medium tracking-tight tabular">−32%</div>
                                <div class="mt-3 h-px w-full bg-bone/10 relative">
                                    <div class="absolute top-0 left-0 h-px w-2/3 bg-emerald-soft"></div>
                                </div>
                            </div>
                            <div class="bg-ink p-5">
                                <div class="text-[10px] text-stone uppercase tracking-widest mb-2">Automatización</div>
                                <div class="text-3xl text-terracotta-soft font-medium tracking-tight tabular">87%</div>
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
                                <div class="text-lg text-bone tabular">2,847</div>
                            </div>
                            <div class="bg-ink p-4">
                                <div class="text-[10px] text-stone uppercase mb-1">Tickets</div>
                                <div class="text-lg text-emerald-soft tabular">14</div>
                            </div>
                            <div class="bg-ink p-4">
                                <div class="text-[10px] text-stone uppercase mb-1">Uptime</div>
                                <div class="text-lg text-bone tabular">99.94%</div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="lg:col-span-6 order-1 lg:order-2" data-reveal>
                    <div class="flex items-center gap-3 mb-6 font-mono text-xs text-emerald-soft">
                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-soft"></span>
                        OkaISP · v1.0.0
                    </div>
                    <h2 class="font-display font-medium tracking-tight leading-[1.04] text-[clamp(2.25rem,5vw,3.75rem)] mb-8 text-balance">
                        ERP inteligente para
                        <span class="italic text-emerald-soft">proveedores de internet.</span>
                    </h2>
                    <p class="text-stone text-lg leading-relaxed mb-12 max-w-lg text-pretty">
                        Cada proceso operativo, con IA integrada. Desde la gestión de clientes hasta la contabilidad — todo optimizado para reducir costos y aumentar la eficiencia de tu red.
                    </p>

                    <div class="space-y-px bg-bone/10">
                        <div class="bg-espresso py-6 px-1 grid grid-cols-12 gap-4">
                            <div class="col-span-2 font-mono text-xs text-emerald-soft pt-1">// 01</div>
                            <div class="col-span-10">
                                <h3 class="font-mono font-medium text-base mb-1.5 text-bone">IA para operaciones</h3>
                                <p class="text-stone text-sm leading-relaxed">Predicción de fallas, optimización de rutas y asignación inteligente de recursos.</p>
                            </div>
                        </div>
                        <div class="bg-espresso py-6 px-1 grid grid-cols-12 gap-4">
                            <div class="col-span-2 font-mono text-xs text-emerald-soft pt-1">// 02</div>
                            <div class="col-span-10">
                                <h3 class="font-mono font-medium text-base mb-1.5 text-bone">Optimización de costos</h3>
                                <p class="text-stone text-sm leading-relaxed">Análisis automatizado de gastos con sugerencias basadas en patrones históricos.</p>
                            </div>
                        </div>
                        <div class="bg-espresso py-6 px-1 grid grid-cols-12 gap-4">
                            <div class="col-span-2 font-mono text-xs text-emerald-soft pt-1">// 03</div>
                            <div class="col-span-10">
                                <h3 class="font-mono font-medium text-base mb-1.5 text-bone">Contabilidad integrada</h3>
                                <p class="text-stone text-sm leading-relaxed">Facturación, cuentas por cobrar y reportes fiscales adaptados a Venezuela.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- IA en movimiento --}}
    <section id="ia" class="py-24 md:py-32 bg-paper relative overflow-hidden scroll-mt-20">
        <div class="max-w-7xl mx-auto px-6">
            <div class="grid lg:grid-cols-12 gap-8 lg:gap-16 items-center" data-reveal-group>
                <div class="lg:col-span-5 lg:order-1" data-reveal>
                    <div class="flex items-center gap-3 mb-6 font-mono text-xs text-greige">
                        <span class="h-px w-8 bg-terracotta"></span>
                        Motor interno
                    </div>
                    <h2 class="font-display font-medium tracking-tight leading-[1.04] text-[clamp(2.25rem,5vw,3.75rem)] mb-8 text-balance">
                        Inteligencia
                        <span class="italic text-terracotta">no decorativa.</span>
                    </h2>
                    <p class="text-umber text-lg leading-relaxed mb-8 max-w-md text-pretty">
                        La IA no es una etiqueta de marketing. Es el motor que predice fallas en tu red, optimiza tus colaboraciones y aprende de cada operación — en producción, no en una demo.
                    </p>
                    <div class="flex flex-wrap gap-x-5 gap-y-2 font-mono text-xs text-umber/70">
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
                            aria-label="Visualización de una red neuronal artificial"
                            class="w-full h-full object-cover opacity-90 group-hover:opacity-100 transition-opacity duration-500">
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

    {{-- Nosotros --}}
    <section id="nosotros" class="py-24 md:py-32 scroll-mt-20">
        <div class="max-w-7xl mx-auto px-6">
            <div class="grid lg:grid-cols-12 gap-8 lg:gap-16 mb-16 lg:mb-20" data-reveal>
                <div class="lg:col-span-8">
                    <h2 class="font-display font-medium tracking-tight leading-[1.02] text-[clamp(2.25rem,5.5vw,4.5rem)] text-balance">
                        Tecnología venezolana,
                        <span class="italic text-terracotta">construida con criterio.</span>
                    </h2>
                </div>
                <div class="lg:col-span-3 lg:col-start-10 flex items-end">
                    <p class="text-umber leading-relaxed">
                        Desde Caracas, Venezuela. Desde 2019. Combinamos innovación, IA y un conocimiento profundo del mercado latinoamericano para construir software que dura.
                    </p>
                </div>
            </div>

            <div class="grid md:grid-cols-3 gap-px bg-espresso/15 border border-espresso/15" data-reveal-group>
                <div class="bg-paper p-10" data-reveal>
                    <div class="font-display text-3xl text-terracotta mb-6">⌖</div>
                    <h3 class="font-display text-2xl font-medium mb-3">Hecha en Venezuela</h3>
                    <p class="text-umber text-sm leading-relaxed">
                        Conocemos las necesidades del mercado latinoamericano de primera mano. Eso se nota en cada decisión de producto.
                    </p>
                </div>
                <div class="bg-paper p-10" data-reveal>
                    <div class="font-display text-3xl text-terracotta mb-6">◈</div>
                    <h3 class="font-display text-2xl font-medium mb-3">IA como pilar</h3>
                    <p class="text-umber text-sm leading-relaxed">
                        La inteligencia artificial no es un añadido. Es parte fundamental de la arquitectura y la propuesta de valor.
                    </p>
                </div>
                <div class="bg-paper p-10" data-reveal>
                    <div class="font-display text-3xl text-terracotta mb-6">▤</div>
                    <h3 class="font-display text-2xl font-medium mb-3">Verticales, no genéricos</h3>
                    <p class="text-umber text-sm leading-relaxed">
                        No hacemos software para todos. Cada producto resuelve problemas concretos de una industria específica.
                    </p>
                </div>
            </div>
        </div>
    </section>

    {{-- Contacto --}}
    <section id="contacto" class="py-24 md:py-32 bg-paper scroll-mt-20">
        <div class="max-w-7xl mx-auto px-6">
            <div class="grid lg:grid-cols-12 gap-12 lg:gap-16" data-reveal-group>
                <div class="lg:col-span-5" data-reveal>
                    <h2 class="font-display font-medium tracking-tight leading-[1.03] text-[clamp(2.25rem,5vw,3.75rem)] mb-8 text-balance">
                        Hablemos de
                        <span class="italic text-terracotta">tu proyecto.</span>
                    </h2>
                    <p class="text-umber leading-relaxed mb-12 text-pretty">
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
                                <span class="text-umber/70">Caracas 1071, Venezuela</span>
                            </p>
                        </div>
                    </div>
                </div>

                <div class="lg:col-span-7" data-reveal>
                    <form class="border border-espresso/20 bg-bone p-8 md:p-10 space-y-8">
                        <div class="grid md:grid-cols-2 gap-x-6 gap-y-8">
                            <div>
                                <label for="contact-name" class="block font-mono text-xs text-greige uppercase tracking-widest mb-2">Nombre</label>
                                <input id="contact-name" name="name" type="text" placeholder="Tu nombre" class="w-full bg-transparent border-0 border-b border-espresso/30 px-0 py-2 text-espresso placeholder-greige focus:outline-none focus:border-terracotta transition-colors">
                            </div>
                            <div>
                                <label for="contact-email" class="block font-mono text-xs text-greige uppercase tracking-widest mb-2">Email</label>
                                <input id="contact-email" name="email" type="email" placeholder="tu@email.com" class="w-full bg-transparent border-0 border-b border-espresso/30 px-0 py-2 text-espresso placeholder-greige focus:outline-none focus:border-terracotta transition-colors">
                            </div>
                        </div>
                        <div>
                            <label for="contact-product" class="block font-mono text-xs text-greige uppercase tracking-widest mb-2">Producto de interés</label>
                            <select id="contact-product" name="product" class="w-full bg-transparent border-0 border-b border-espresso/30 px-0 py-2 text-espresso focus:outline-none focus:border-terracotta transition-colors">
                                <option value="">Selecciona un producto</option>
                                <option value="okacrm">OkaCRM — CRM para creadores</option>
                                <option value="okaisp">OkaISP — ERP para ISP</option>
                                <option value="ambos">Ambos productos</option>
                                <option value="otro">Otro</option>
                            </select>
                        </div>
                        <div>
                            <label for="contact-message" class="block font-mono text-xs text-greige uppercase tracking-widest mb-2">Mensaje</label>
                            <textarea id="contact-message" name="message" rows="4" placeholder="Cuéntanos sobre tu proyecto..." class="w-full bg-transparent border-0 border-b border-espresso/30 px-0 py-2 text-espresso placeholder-greige focus:outline-none focus:border-terracotta transition-colors resize-none"></textarea>
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
    <footer class="bg-espresso text-bone py-16 relative overflow-hidden">
        <div class="absolute inset-0 blueprint opacity-40 pointer-events-none"></div>
        <div class="relative max-w-7xl mx-auto px-6">
            <div class="grid md:grid-cols-12 gap-10 mb-16">
                <div class="md:col-span-5">
                    <a href="#top" class="flex items-center gap-3 mb-5">
                        <div class="w-9 h-9 bg-terracotta flex items-center justify-center font-display font-bold text-bone">O</div>
                        <span class="text-xl font-display font-semibold tracking-tight">Okanet<span class="text-terracotta">.</span></span>
                    </a>
                    <p class="text-stone leading-relaxed max-w-sm mb-4">
                        Software vertical para industrias específicas. Construido con criterio desde Caracas.
                    </p>
                    <p class="font-mono text-xs text-stone">RIF · J-41299500-6</p>
                </div>
                <div class="md:col-span-2">
                    <h2 class="font-mono text-xs text-stone uppercase tracking-widest mb-4">Productos</h2>
                    <ul class="space-y-2.5 text-sm text-bone/80">
                        <li><a href="#okacrm" class="hover:text-terracotta transition-colors">OkaCRM</a></li>
                        <li><a href="#okaisp" class="hover:text-terracotta transition-colors">OkaISP</a></li>
                    </ul>
                </div>
                <div class="md:col-span-2">
                    <h2 class="font-mono text-xs text-stone uppercase tracking-widest mb-4">Empresa</h2>
                    <ul class="space-y-2.5 text-sm text-bone/80">
                        <li><a href="#nosotros" class="hover:text-terracotta transition-colors">Nosotros</a></li>
                        <li><a href="{{ route('blog.index') }}" class="hover:text-terracotta transition-colors">Blog</a></li>
                        <li><a href="#contacto" class="hover:text-terracotta transition-colors">Contacto</a></li>
                    </ul>
                </div>
                <div class="md:col-span-3">
                    <h2 class="font-mono text-xs text-stone uppercase tracking-widest mb-4">Sede</h2>
                    <p class="text-bone/80 text-sm leading-relaxed">
                        Av. Rómulo Gallegos<br>
                        Edif. Centro ALOA, PP-36-L<br>
                        Caracas 1071, Venezuela
                    </p>
                </div>
            </div>

            <div class="pt-8 border-t border-bone/10 flex flex-col md:flex-row items-start md:items-center justify-between gap-4 font-mono text-xs text-stone">
                <p>&copy; {{ date('Y') }} Okanet Solutions C.A. · Todos los derechos reservados.</p>
                <p>10.4806° N · 66.9036° W · Caracas, VE</p>
            </div>
        </div>
    </footer>

    <script>
        (function () {
            // Hero choreography — fire on the same pass that confirms JS, so a
            // headless or no-JS render shows the headline immediately.
            const hero = document.querySelector('.hero');
            if (hero) {
                requestAnimationFrame(() => hero.classList.add('is-in'));
            }

            // Scroll progress rail.
            const progress = document.getElementById('scroll-progress');
            let ticking = false;
            function updateProgress() {
                const max = document.documentElement.scrollHeight - window.innerHeight;
                const ratio = max > 0 ? window.scrollY / max : 0;
                progress.style.setProperty('--progress', ratio.toFixed(4));
                ticking = false;
            }
            window.addEventListener('scroll', () => {
                if (!ticking) {
                    window.requestAnimationFrame(updateProgress);
                    ticking = true;
                }
            }, { passive: true });
            updateProgress();

            // Scroll-spy — highlight the nav link for the section in view.
            const navLinks = Array.from(document.querySelectorAll('[data-nav]'));
            const byId = new Map(navLinks.map((l) => [l.getAttribute('href').slice(1), l]));
            const spy = new IntersectionObserver((entries) => {
                entries.forEach((entry) => {
                    if (entry.isIntersecting) {
                        navLinks.forEach((l) => l.setAttribute('aria-current', 'false'));
                        const link = byId.get(entry.target.id);
                        if (link) { link.setAttribute('aria-current', 'true'); }
                    }
                });
            }, { rootMargin: '-45% 0px -50% 0px' });
            byId.forEach((_, id) => {
                const section = document.getElementById(id);
                if (section) { spy.observe(section); }
            });

            // Mobile menu.
            const toggle = document.getElementById('menu-toggle');
            const menu = document.getElementById('mobile-menu');
            toggle.addEventListener('click', () => {
                const open = menu.classList.toggle('hidden');
                toggle.setAttribute('aria-expanded', String(!open));
            });
            menu.querySelectorAll('a').forEach((link) => {
                link.addEventListener('click', () => {
                    menu.classList.add('hidden');
                    toggle.setAttribute('aria-expanded', 'false');
                });
            });
        })();
    </script>
</body>
</html>
