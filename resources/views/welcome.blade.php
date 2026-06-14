<!DOCTYPE html>
<html lang="es" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Okanet Solutions — Automatización de operaciones · Caracas</title>
    <meta name="description" content="Okanet Solutions C.A. diseña e implementa sistemas que automatizan la operación de empresas en Venezuela: procesos que corren 24/7, sin trabajo manual. OkaISP, OkaStore y sistemas a medida.">
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=archivo:400,500,600,700,800|martian-mono:300,400,500&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-ink text-bone antialiased font-sans selection:bg-signal selection:text-ink overflow-x-hidden">

    <a href="#contenido" class="sr-only focus:not-sr-only focus:fixed focus:top-3 focus:left-3 focus:z-[80] focus:px-4 focus:py-2 focus:bg-signal focus:text-ink focus:font-semibold focus:rounded-sm">
        Saltar al contenido
    </a>

    {{-- Scroll progress — the page's single wayfinding system --}}
    <div class="fixed top-0 left-0 right-0 h-px z-[70] bg-bone/10">
        <div id="scroll-progress" class="scroll-progress h-full bg-signal"></div>
    </div>

    {{-- Navigation --}}
    <nav class="fixed top-0 w-full z-[60] bg-ink/80 backdrop-blur-md border-b border-bone/10">
        <div class="max-w-7xl mx-auto px-6 h-16 flex items-center justify-between">
            <a href="#top" class="group flex items-center gap-2.5">
                <span class="relative flex w-2.5 h-2.5">
                    <span class="ping absolute inline-flex w-2.5 h-2.5 rounded-full bg-signal"></span>
                    <span class="relative inline-flex w-2.5 h-2.5 rounded-full bg-signal"></span>
                </span>
                <span class="text-lg font-display font-extrabold tracking-tight">okanet</span>
            </a>
            <div class="hidden md:flex items-center gap-8 text-sm text-fog">
                <a href="#sistema" data-nav class="nav-link hover:text-bone transition-colors">Cómo trabajamos</a>
                <a href="#productos" data-nav class="nav-link hover:text-bone transition-colors">Productos</a>
                <a href="#amedida" data-nav class="nav-link hover:text-bone transition-colors">A medida</a>
                <a href="{{ route('blog.index') }}" class="nav-link hover:text-bone transition-colors">Blog</a>
                <a href="#contacto" class="pressable inline-flex items-center gap-2 px-4 py-2 bg-bone text-ink font-semibold rounded-sm hover:bg-signal hover:text-ink">
                    Contacto
                </a>
            </div>
            <button id="menu-toggle" class="md:hidden text-bone -mr-1 p-1" aria-label="Abrir menú" aria-expanded="false" aria-controls="mobile-menu">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-width="1.5" d="M4 7h16M4 12h16M4 17h16"/></svg>
            </button>
        </div>
        <div id="mobile-menu" class="hidden md:hidden px-6 pb-5 pt-1 space-y-1 text-sm border-t border-bone/10 bg-ink">
            <a href="#sistema" class="block py-2.5 text-fog hover:text-bone transition-colors">Cómo trabajamos</a>
            <a href="#productos" class="block py-2.5 text-fog hover:text-bone transition-colors">Productos</a>
            <a href="#amedida" class="block py-2.5 text-fog hover:text-bone transition-colors">A medida</a>
            <a href="{{ route('blog.index') }}" class="block py-2.5 text-fog hover:text-bone transition-colors">Blog</a>
            <a href="#contacto" class="block py-2.5 text-signal font-semibold">Contacto →</a>
        </div>
    </nav>

    <span id="top"></span>

    {{-- ───────────────────────── HERO — the control room ───────────────────────── --}}
    <header id="contenido" class="hero relative min-h-[100svh] flex flex-col overflow-hidden bg-ink">
        <div class="absolute inset-0 console-grid mask-fade opacity-50 pointer-events-none"></div>

        {{-- The telemetry trace: the operation, running. Lives in the lower band. --}}
        <div class="absolute inset-x-0 bottom-0 h-[44%] pointer-events-none">
            <div class="relative w-full h-full">
                <svg class="absolute inset-0 w-full h-full" viewBox="0 0 1200 280" preserveAspectRatio="none" aria-hidden="true">
                    <line x1="0" y1="170" x2="1200" y2="170" class="trace-grid" stroke-dasharray="2 6"/>
                    <path class="trace-path" pathLength="1" vector-effect="non-scaling-stroke"
                        d="M0,170 L150,170 L160,98 L172,232 L184,150 L196,170 L360,170 L378,134 L396,170 L520,170 L536,58 L552,214 L568,170 L700,170 L740,148 L772,192 L804,150 L836,176 L900,170 L1040,170 L1058,112 L1076,176 L1090,170 L1200,170"/>
                </svg>
                <div class="trace-sweep"></div>
                <div class="absolute left-6 bottom-4 font-mono text-[10px] text-fog-dim tracking-tight hidden sm:block">señal de operación · tiempo real</div>
                <div class="absolute right-6 bottom-4 font-mono text-[10px] text-fog-dim tracking-tight hidden sm:block">— sin intervención humana</div>
            </div>
        </div>

        <div class="relative w-full max-w-7xl mx-auto px-6 flex-1 flex flex-col justify-center pt-24 pb-44">
            {{-- Status readout --}}
            <div class="flex items-center gap-3 mb-10 md:mb-12 font-mono text-[11px] text-fog hero-fade" style="--line-delay: 0ms">
                <span class="flex items-center gap-2 text-bone">
                    <span class="relative flex w-1.5 h-1.5">
                        <span class="ping absolute inline-flex w-1.5 h-1.5 rounded-full bg-signal"></span>
                        <span class="relative inline-flex w-1.5 h-1.5 rounded-full bg-signal"></span>
                    </span>
                    OPERANDO
                </span>
                <span class="w-6 h-px bg-bone/25"></span>
                <span>CARACAS · 10.48°N 66.90°W</span>
                <span class="ml-auto hidden sm:block text-fog-dim">EMPRESA DE SOFTWARE · EST. 2019</span>
            </div>

            <div class="max-w-4xl">
                <h1 class="font-display font-extrabold tracking-[-0.035em] leading-[0.95] text-[clamp(2.6rem,7vw,5.25rem)]">
                    <span class="reveal-line" style="--line-delay: 90ms"><span>Diseñamos los sistemas</span></span>
                    <span class="reveal-line" style="--line-delay: 170ms"><span>que automatizan tu operación</span></span>
                    <span class="reveal-line" style="--line-delay: 250ms"><span>para que <span class="text-signal">escale</span>.</span></span>
                </h1>
            </div>

            <div class="mt-9 max-w-xl hero-fade" style="--line-delay: 380ms">
                <p class="text-fog text-lg leading-relaxed text-pretty">
                    Automatización para empresas que quieren dejar de hacer a mano lo que un sistema puede hacer solo: procesos que corren <span class="text-bone">24/7</span>, sin intervención humana.
                </p>
            </div>

            <div class="mt-10 flex flex-col sm:flex-row sm:items-center gap-4 hero-fade" style="--line-delay: 470ms">
                <a href="#contacto" class="group pressable inline-flex items-center justify-center gap-3 px-7 py-3.5 bg-signal text-ink font-semibold rounded-sm hover:bg-signal-bright">
                    Hablemos de tu operación
                    <span class="font-mono text-sm group-hover:translate-x-1 transition-transform duration-200 ease-out">→</span>
                </a>
                <a href="#productos" class="group pressable inline-flex items-center justify-center gap-3 px-7 py-3.5 border border-bone/20 text-bone font-medium rounded-sm hover:border-bone/50 hover:bg-bone/5">
                    Ver qué construimos
                </a>
            </div>
        </div>

        {{-- Live activity readout — illustrative feed of work that runs automatically --}}
        <aside class="absolute right-6 bottom-6 z-10 hidden lg:block w-[300px] panel rounded-sm hero-fade" style="--line-delay: 600ms" aria-label="Ejemplo de actividad automatizada">
            <div class="flex items-center justify-between px-4 py-2.5 border-b border-bone/10">
                <span class="font-mono text-[10px] text-fog-dim uppercase tracking-wider">registro · automático</span>
                <span class="flex items-center gap-1.5 font-mono text-[10px] text-signal">
                    <span class="relative flex w-1.5 h-1.5"><span class="ping absolute inline-flex w-1.5 h-1.5 rounded-full bg-signal"></span><span class="relative inline-flex w-1.5 h-1.5 rounded-full bg-signal"></span></span>
                    en vivo
                </span>
            </div>
            <ul id="activity-log" class="px-4 py-3 space-y-2.5 font-mono text-[11px]">
                <li class="flex items-center justify-between gap-3"><span class="text-bone/90">Factura emitida</span><span class="text-fog-dim">ahora</span></li>
                <li class="flex items-center justify-between gap-3"><span class="text-bone/90">Pago conciliado</span><span class="text-fog-dim">hace 6s</span></li>
                <li class="flex items-center justify-between gap-3"><span class="text-bone/90">Stock actualizado</span><span class="text-fog-dim">hace 18s</span></li>
                <li class="flex items-center justify-between gap-3"><span class="text-bone/90">Respaldo verificado</span><span class="text-fog-dim">hace 41s</span></li>
            </ul>
        </aside>
    </header>

    {{-- Sectors strip — quiet, concrete, no marquee --}}
    <div class="border-y border-bone/10 bg-graphite">
        <div class="max-w-7xl mx-auto px-6 py-4 flex flex-col sm:flex-row sm:items-center gap-x-8 gap-y-2 font-mono text-[11px] text-fog">
            <span class="text-fog-dim shrink-0">DONDE OPERAMOS —</span>
            <div class="flex flex-wrap items-center gap-x-5 gap-y-1">
                <span>Proveedores de internet</span>
                <span class="text-bone/20">/</span>
                <span>Comercios y tiendas</span>
                <span class="text-bone/20">/</span>
                <span>Distribuidores</span>
                <span class="text-bone/20">/</span>
                <span>Servicios B2B</span>
            </div>
            <span class="sm:ml-auto text-fog-dim shrink-0">En producción desde 2019</span>
        </div>
    </div>

    {{-- ──────────────── SISTEMA — how we work (light schematic world) ──────────────── --}}
    <section id="sistema" class="relative py-24 md:py-32 bg-paper text-espresso scroll-mt-16 overflow-hidden">
        <div class="absolute inset-0 schematic mask-fade opacity-70 pointer-events-none"></div>

        <div class="relative max-w-7xl mx-auto px-6">
            <div class="grid lg:grid-cols-12 gap-8 lg:gap-12 items-end mb-16 lg:mb-20" data-reveal>
                <div class="lg:col-span-7">
                    <p class="font-mono text-xs text-signal-deep mb-5">// cómo trabajamos</p>
                    <h2 class="font-display font-extrabold tracking-tight leading-[1.02] text-[clamp(2rem,5vw,3.5rem)] text-balance">
                        Reemplazamos el trabajo manual por procesos que corren solos.
                    </h2>
                </div>
                <div class="lg:col-span-4 lg:col-start-9">
                    <p class="text-umber leading-relaxed text-pretty">
                        No entregamos software y nos vamos. Diagnosticamos tu operación, diseñamos la automatización, la implementamos sobre las herramientas que ya usas y la mantenemos funcionando.
                    </p>
                </div>
            </div>

            {{-- Before → Okanet → After schematic --}}
            <div class="border border-espresso/12 bg-surface rounded-sm overflow-hidden mb-16 lg:mb-20" data-reveal>
                <svg class="w-full" viewBox="0 0 1200 300" preserveAspectRatio="xMidYMid meet" role="img" aria-label="Diagrama: un proceso manual con esperas y errores se convierte, a través de Okanet, en un proceso que corre solo 24/7.">
                    {{-- left: manual --}}
                    <text x="60" y="48" font-family="Martian Mono, monospace" font-size="13" fill="oklch(0.66 0.011 256)">ANTES — manual</text>
                    <g stroke="oklch(0.66 0.04 30)" stroke-width="1.4" fill="none">
                        <rect x="60" y="74" width="150" height="40" rx="3"/>
                        <rect x="60" y="134" width="150" height="40" rx="3"/>
                        <rect x="60" y="194" width="150" height="40" rx="3"/>
                    </g>
                    <g font-family="Archivo, sans-serif" font-size="14" fill="oklch(0.43 0.013 256)">
                        <text x="76" y="99">Tarea repetitiva</text>
                        <text x="76" y="159">Espera y revisión</text>
                        <text x="76" y="219">Error humano</text>
                    </g>
                    <g stroke="oklch(0.66 0.04 30)" stroke-width="1.4" stroke-dasharray="3 4">
                        <path d="M210 94 H300 V154 H300"/>
                        <path d="M210 154 H300"/>
                        <path d="M210 214 H300 V154"/>
                    </g>

                    {{-- center: Okanet processor --}}
                    <rect x="470" y="104" width="260" height="92" rx="4" fill="oklch(0.165 0.013 256)"/>
                    <rect x="470" y="104" width="260" height="92" rx="4" fill="none" stroke="oklch(0.74 0.142 233)" stroke-width="1.4"/>
                    <text x="600" y="142" text-anchor="middle" font-family="Archivo, sans-serif" font-weight="700" font-size="20" fill="oklch(0.948 0.005 245)">OKANET</text>
                    <text x="600" y="166" text-anchor="middle" font-family="Martian Mono, monospace" font-size="11" fill="oklch(0.74 0.142 233)">diseño · IA · automatización</text>
                    <path d="M300 154 H470" stroke="oklch(0.74 0.142 233)" stroke-width="1.6" fill="none"/>
                    <circle cx="300" cy="154" r="3.5" fill="oklch(0.74 0.142 233)"/>

                    {{-- right: automated loop --}}
                    <text x="900" y="48" font-family="Martian Mono, monospace" font-size="13" fill="oklch(0.515 0.15 248)">DESPUÉS — corre solo</text>
                    <path d="M730 150 H838" stroke="oklch(0.74 0.142 233)" stroke-width="1.6" fill="none"/>
                    <circle cx="1000" cy="150" r="74" fill="none" stroke="oklch(0.515 0.15 248)" stroke-width="1.6" stroke-dasharray="5 7"/>
                    <circle cx="1000" cy="150" r="48" fill="oklch(0.998 0.0015 245)" stroke="oklch(0.515 0.15 248)" stroke-width="1.4"/>
                    <text x="1000" y="146" text-anchor="middle" font-family="Archivo, sans-serif" font-weight="700" font-size="16" fill="oklch(0.235 0.013 256)">24/7</text>
                    <text x="1000" y="166" text-anchor="middle" font-family="Martian Mono, monospace" font-size="10" fill="oklch(0.515 0.15 248)">operando</text>
                    <circle cx="1000" cy="76" r="4" fill="oklch(0.74 0.142 233)"/>
                </svg>
            </div>

            {{-- Ordered process — a real sequence, so the numbers carry meaning --}}
            <ol class="grid md:grid-cols-2 lg:grid-cols-4 gap-px bg-espresso/12 border border-espresso/12 rounded-sm overflow-hidden" data-reveal-group>
                <li class="bg-surface p-7 lg:p-8" data-reveal>
                    <div class="flex items-baseline justify-between mb-5">
                        <span class="font-mono text-sm text-signal-deep">01</span>
                        <span class="font-mono text-[10px] text-stone uppercase tracking-wider">diagnóstico</span>
                    </div>
                    <h3 class="font-display font-bold text-xl mb-2">Mapeamos lo manual</h3>
                    <p class="text-umber text-sm leading-relaxed">Dónde se pierde tiempo, dónde se cae el proceso y cuánto cuesta hacerlo a mano.</p>
                </li>
                <li class="bg-surface p-7 lg:p-8" data-reveal>
                    <div class="flex items-baseline justify-between mb-5">
                        <span class="font-mono text-sm text-signal-deep">02</span>
                        <span class="font-mono text-[10px] text-stone uppercase tracking-wider">diseño</span>
                    </div>
                    <h3 class="font-display font-bold text-xl mb-2">Definimos el sistema</h3>
                    <p class="text-umber text-sm leading-relaxed">Qué se automatiza, qué se integra y en qué punto decide la IA.</p>
                </li>
                <li class="bg-surface p-7 lg:p-8" data-reveal>
                    <div class="flex items-baseline justify-between mb-5">
                        <span class="font-mono text-sm text-signal-deep">03</span>
                        <span class="font-mono text-[10px] text-stone uppercase tracking-wider">implementación</span>
                    </div>
                    <h3 class="font-display font-bold text-xl mb-2">Construimos e integramos</h3>
                    <p class="text-umber text-sm leading-relaxed">Sobre las herramientas que ya usas. Sin reemplazar todo de golpe.</p>
                </li>
                <li class="bg-surface p-7 lg:p-8" data-reveal>
                    <div class="flex items-baseline justify-between mb-5">
                        <span class="font-mono text-sm text-signal-deep">04</span>
                        <span class="font-mono text-[10px] text-stone uppercase tracking-wider">operación</span>
                    </div>
                    <h3 class="font-display font-bold text-xl mb-2">Lo mantenemos vivo</h3>
                    <p class="text-umber text-sm leading-relaxed">El sistema corre solo 24/7. Nosotros lo monitoreamos y respondemos si algo falla.</p>
                </li>
            </ol>
        </div>
    </section>

    {{-- ───────────────────── PRODUCTOS — instrument modules (dark) ───────────────────── --}}
    <section id="productos" class="relative py-24 md:py-32 bg-ink scroll-mt-16 overflow-hidden">
        <div class="absolute inset-0 console-grid mask-fade opacity-40 pointer-events-none"></div>

        <div class="relative max-w-7xl mx-auto px-6">
            <div class="grid lg:grid-cols-12 gap-8 items-end mb-16 lg:mb-24" data-reveal>
                <div class="lg:col-span-7">
                    <p class="font-mono text-xs text-signal mb-5">// productos en producción</p>
                    <h2 class="font-display font-extrabold tracking-tight leading-[1.02] text-[clamp(2rem,5vw,3.5rem)] text-balance">
                        Dos productos. Cada uno automatiza una industria entera.
                    </h2>
                </div>
                <div class="lg:col-span-4 lg:col-start-9">
                    <p class="text-fog leading-relaxed text-pretty">
                        Construidos a fondo para un sector específico, no genéricos para todos. La operación completa en un solo sistema.
                    </p>
                </div>
            </div>

            {{-- OkaISP --}}
            <div id="okaisp" class="grid lg:grid-cols-12 gap-10 lg:gap-14 items-center mb-24 lg:mb-32 scroll-mt-24" data-reveal-group>
                <div class="lg:col-span-5" data-reveal>
                    <div class="flex items-center gap-2.5 mb-5 font-mono text-xs text-signal">
                        <span class="w-1.5 h-1.5 rounded-full bg-signal"></span>
                        okaisp
                    </div>
                    <h3 class="font-display font-extrabold text-3xl md:text-4xl tracking-tight mb-4">
                        ERP con IA para proveedores de internet
                    </h3>
                    <p class="text-fog leading-relaxed mb-8 text-pretty">
                        Toda la operación de un ISP en un solo sistema: clientes, facturación y cobranza, monitoreo de red, soporte y contabilidad adaptada a Venezuela. La IA predice fallas y automatiza la cobranza y el primer nivel de soporte.
                    </p>
                    <ul class="space-y-px bg-bone/10 border border-bone/10 rounded-sm overflow-hidden">
                        @foreach ([
                            'Facturación y cobranza automática',
                            'Monitoreo de red y gestión de cortes',
                            'Tickets y soporte con IA',
                            'Contabilidad fiscal venezolana',
                            'Predicción de fallas y morosidad',
                        ] as $feat)
                            <li class="flex items-center gap-3 bg-graphite px-4 py-3 text-sm text-bone/90">
                                <svg class="w-4 h-4 text-signal shrink-0" viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M3 8.5l3.5 3.5L13 5"/></svg>
                                {{ $feat }}
                            </li>
                        @endforeach
                    </ul>
                </div>

                {{-- OkaISP product surface — dark operations console.
                     Reemplazar por captura real: <img src="/images/okaisp.png" alt="..."> --}}
                <figure class="lg:col-span-7 lg:order-last" data-reveal>
                    <div class="panel rounded-md overflow-hidden shadow-[0_30px_80px_-40px_rgba(0,0,0,0.9)]">
                        <div class="flex items-center justify-between px-4 py-2.5 border-b border-bone/10 bg-graphite-2">
                            <div class="flex items-center gap-3">
                                <span class="flex gap-1.5"><span class="w-2.5 h-2.5 rounded-full bg-bone/15"></span><span class="w-2.5 h-2.5 rounded-full bg-bone/15"></span><span class="w-2.5 h-2.5 rounded-full bg-bone/15"></span></span>
                                <span class="font-mono text-[11px] text-fog-dim">okaisp · operaciones</span>
                            </div>
                            <span class="font-mono text-[10px] text-signal flex items-center gap-1.5"><span class="w-1.5 h-1.5 rounded-full bg-signal"></span>IA activa</span>
                        </div>
                        <div class="p-5 grid grid-cols-3 gap-4">
                            <div class="col-span-2">
                                <div class="font-mono text-[10px] text-fog-dim uppercase tracking-wider mb-2">Clientes · red norte</div>
                                <div class="border border-bone/10 rounded-sm overflow-hidden">
                                    @foreach ([
                                        ['C. Mendoza', '120 Mbps', 'activo', 'text-signal'],
                                        ['Fibra Centro', '300 Mbps', 'activo', 'text-signal'],
                                        ['R. Salazar', '50 Mbps', 'mora', 'text-amber'],
                                        ['Edif. Aurora', '500 Mbps', 'activo', 'text-signal'],
                                        ['L. Ramírez', '120 Mbps', 'corte', 'text-fog-dim'],
                                    ] as $row)
                                        <div class="flex items-center justify-between px-3 py-2 text-[12px] border-b border-bone/5 last:border-0">
                                            <span class="text-bone/85">{{ $row[0] }}</span>
                                            <span class="font-mono text-fog-dim">{{ $row[1] }}</span>
                                            <span class="font-mono text-[10px] {{ $row[3] }} w-12 text-right">{{ $row[2] }}</span>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            <div class="space-y-4">
                                <div class="border border-bone/10 rounded-sm p-3">
                                    <div class="font-mono text-[10px] text-fog-dim uppercase tracking-wider mb-2">Red</div>
                                    <div class="flex items-end gap-1 h-10">
                                        @foreach ([60,80,55,90,72,84,68,95,78] as $h)
                                            <div class="flex-1 bg-signal/55 rounded-[1px]" style="height: {{ $h }}%"></div>
                                        @endforeach
                                    </div>
                                    <div class="font-mono text-[10px] text-fog-dim mt-2">enlaces estables</div>
                                </div>
                                <div class="border border-bone/10 rounded-sm p-3">
                                    <div class="font-mono text-[10px] text-fog-dim uppercase tracking-wider mb-1.5">Cobranza</div>
                                    <div class="font-mono text-[11px] text-bone/85 flex items-center gap-2"><span class="w-1.5 h-1.5 rounded-full bg-signal"></span>emitiendo</div>
                                    <div class="font-mono text-[10px] text-fog-dim mt-1">automática · mensual</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <figcaption class="mt-3 font-mono text-[10px] text-fog-dim text-center">vista del panel de OkaISP · datos de ejemplo</figcaption>
                </figure>
            </div>

            {{-- OkaStore --}}
            <div id="okastore" class="grid lg:grid-cols-12 gap-10 lg:gap-14 items-center scroll-mt-24" data-reveal-group>
                <div class="lg:col-span-5 lg:order-last" data-reveal>
                    <div class="flex items-center gap-2.5 mb-5 font-mono text-xs text-signal">
                        <span class="w-1.5 h-1.5 rounded-full bg-signal"></span>
                        okastore
                    </div>
                    <h3 class="font-display font-extrabold text-3xl md:text-4xl tracking-tight mb-4">
                        Tienda en línea con contabilidad, hecha para Venezuela
                    </h3>
                    <p class="text-fog leading-relaxed mb-8 text-pretty">
                        Como Shopify, pero pensado para el comercio venezolano: monta tu tienda, vende en línea y lleva la contabilidad sin un contador detrás. Inventario, pedidos e IVA se calculan solos.
                    </p>
                    <ul class="space-y-px bg-bone/10 border border-bone/10 rounded-sm overflow-hidden">
                        @foreach ([
                            'Tienda y catálogo en minutos',
                            'Pedidos, pagos y envíos',
                            'Inventario que se descuenta solo',
                            'Contabilidad e IVA simplificados',
                            'Reportes listos para el SENIAT',
                        ] as $feat)
                            <li class="flex items-center gap-3 bg-graphite px-4 py-3 text-sm text-bone/90">
                                <svg class="w-4 h-4 text-signal shrink-0" viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M3 8.5l3.5 3.5L13 5"/></svg>
                                {{ $feat }}
                            </li>
                        @endforeach
                    </ul>
                </div>

                {{-- OkaStore product surface — light commerce admin, for contrast.
                     Reemplazar por captura real: <img src="/images/okastore.png" alt="..."> --}}
                <figure class="lg:col-span-7" data-reveal>
                    <div class="rounded-md overflow-hidden border border-bone/15 bg-surface text-espresso shadow-[0_30px_80px_-40px_rgba(0,0,0,0.9)]">
                        <div class="flex items-center justify-between px-4 py-2.5 border-b border-espresso/10 bg-mist">
                            <div class="flex items-center gap-3">
                                <span class="flex gap-1.5"><span class="w-2.5 h-2.5 rounded-full bg-espresso/15"></span><span class="w-2.5 h-2.5 rounded-full bg-espresso/15"></span><span class="w-2.5 h-2.5 rounded-full bg-espresso/15"></span></span>
                                <span class="font-mono text-[11px] text-greige">okastore · panel</span>
                            </div>
                            <span class="font-mono text-[10px] text-signal-deep">contabilidad: al día</span>
                        </div>
                        <div class="p-5 grid grid-cols-3 gap-4">
                            <div class="col-span-2">
                                <div class="font-mono text-[10px] text-stone uppercase tracking-wider mb-2">Pedidos de hoy</div>
                                <div class="border border-espresso/10 rounded-sm overflow-hidden">
                                    @foreach ([
                                        ['#1042', 'M. Pérez', 'Bs 480,00', 'pagado', 'text-signal-deep'],
                                        ['#1041', 'Tienda Sol', 'Bs 1.250,00', 'enviado', 'text-greige'],
                                        ['#1040', 'J. Castro', 'Bs 96,00', 'pagado', 'text-signal-deep'],
                                        ['#1039', 'A. Díaz', 'Bs 320,00', 'pendiente', 'text-amber'],
                                    ] as $row)
                                        <div class="flex items-center justify-between px-3 py-2 text-[12px] border-b border-espresso/5 last:border-0">
                                            <span class="font-mono text-greige">{{ $row[0] }}</span>
                                            <span class="text-espresso/85 flex-1 px-3 truncate">{{ $row[1] }}</span>
                                            <span class="font-mono text-espresso/75 tabular">{{ $row[2] }}</span>
                                            <span class="font-mono text-[10px] {{ $row[4] }} w-16 text-right">{{ $row[3] }}</span>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            <div class="space-y-4">
                                <div class="border border-espresso/10 rounded-sm p-3">
                                    <div class="font-mono text-[10px] text-stone uppercase tracking-wider mb-2">Ventas · 7 días</div>
                                    <div class="flex items-end gap-1 h-10">
                                        @foreach ([40,55,48,70,62,88,76] as $h)
                                            <div class="flex-1 bg-signal-deep/45 rounded-[1px]" style="height: {{ $h }}%"></div>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="border border-espresso/10 rounded-sm p-3">
                                    <div class="font-mono text-[10px] text-stone uppercase tracking-wider mb-1.5">Inventario</div>
                                    <div class="font-mono text-[11px] text-espresso/85 flex items-center gap-2"><span class="w-1.5 h-1.5 rounded-full bg-amber"></span>2 productos bajos</div>
                                    <div class="font-mono text-[10px] text-stone mt-1">reposición sugerida</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <figcaption class="mt-3 font-mono text-[10px] text-fog-dim text-center">vista del panel de OkaStore · datos de ejemplo</figcaption>
                </figure>
            </div>
        </div>
    </section>

    {{-- ───────────────── A MEDIDA — custom systems (light schematic) ───────────────── --}}
    <section id="amedida" class="relative py-24 md:py-32 bg-paper text-espresso scroll-mt-16 overflow-hidden">
        <div class="absolute inset-0 schematic mask-fade opacity-70 pointer-events-none"></div>

        <div class="relative max-w-7xl mx-auto px-6">
            <div class="grid lg:grid-cols-12 gap-10 lg:gap-14 items-start">
                <div class="lg:col-span-5" data-reveal>
                    <p class="font-mono text-xs text-signal-deep mb-5">// sistemas a medida</p>
                    <h2 class="font-display font-extrabold tracking-tight leading-[1.04] text-[clamp(2rem,4.5vw,3.25rem)] mb-6 text-balance">
                        ¿Tu operación no entra en una caja? La construimos a medida.
                    </h2>
                    <p class="text-umber leading-relaxed mb-10 text-pretty">
                        Cuando ningún producto encaja, diseñamos el sistema desde cero. Integramos lo que hoy no se comunica, automatizamos el back-office y construimos las herramientas internas que tu equipo necesita.
                    </p>
                    <ul class="grid sm:grid-cols-2 gap-x-8 gap-y-4 text-sm">
                        @foreach ([
                            'Integración entre sistemas que no se hablan',
                            'Automatización de facturación y conciliación',
                            'Paneles internos a la medida del equipo',
                            'Agentes que atienden y resuelven solos',
                            'Migración y limpieza de datos',
                            'Reportería automática',
                        ] as $item)
                            <li class="flex items-start gap-2.5 text-umber">
                                <span class="mt-1.5 w-1.5 h-1.5 rounded-sm bg-signal-deep shrink-0"></span>
                                {{ $item }}
                            </li>
                        @endforeach
                    </ul>
                </div>

                {{-- Integration-hub schematic --}}
                <div class="lg:col-span-7" data-reveal>
                    <div class="border border-espresso/12 bg-surface rounded-sm p-2">
                        <svg class="w-full" viewBox="0 0 600 420" role="img" aria-label="Diagrama: sistemas dispersos —hoja de cálculo, banco, WhatsApp, inventario y facturación— se conectan a un núcleo Okanet que los automatiza.">
                            <defs>
                                <marker id="dot" markerWidth="6" markerHeight="6" refX="3" refY="3"><circle cx="3" cy="3" r="2.5" fill="oklch(0.515 0.15 248)"/></marker>
                            </defs>
                            {{-- spokes --}}
                            @php
                                $nodes = [
                                    ['Hoja de cálculo', 90, 70],
                                    ['Banco', 510, 70],
                                    ['WhatsApp', 70, 230],
                                    ['Inventario', 530, 230],
                                    ['Facturación', 300, 360],
                                ];
                            @endphp
                            @foreach ($nodes as $n)
                                <line x1="{{ $n[1] }}" y1="{{ $n[2] }}" x2="300" y2="210" stroke="oklch(0.66 0.011 256)" stroke-width="1.2" stroke-dasharray="3 5"/>
                            @endforeach
                            @foreach ($nodes as $n)
                                <g>
                                    <rect x="{{ $n[1] - 62 }}" y="{{ $n[2] - 18 }}" width="124" height="36" rx="3" fill="oklch(0.945 0.006 245)" stroke="oklch(0.66 0.011 256)" stroke-width="1"/>
                                    <text x="{{ $n[1] }}" y="{{ $n[2] + 5 }}" text-anchor="middle" font-family="Archivo, sans-serif" font-size="13" fill="oklch(0.43 0.013 256)">{{ $n[0] }}</text>
                                </g>
                            @endforeach
                            {{-- hub --}}
                            <circle cx="300" cy="210" r="58" fill="oklch(0.165 0.013 256)"/>
                            <circle cx="300" cy="210" r="58" fill="none" stroke="oklch(0.74 0.142 233)" stroke-width="1.5"/>
                            <text x="300" y="205" text-anchor="middle" font-family="Archivo, sans-serif" font-weight="700" font-size="17" fill="oklch(0.948 0.005 245)">OKANET</text>
                            <text x="300" y="226" text-anchor="middle" font-family="Martian Mono, monospace" font-size="10" fill="oklch(0.74 0.142 233)">núcleo</text>
                        </svg>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ─────────────────── OKANET — why (dark spec sheet) ─────────────────── --}}
    <section id="okanet" class="relative py-24 md:py-32 bg-ink scroll-mt-16 overflow-hidden">
        <div class="absolute inset-0 console-grid mask-fade opacity-40 pointer-events-none"></div>

        <div class="relative max-w-7xl mx-auto px-6">
            <div class="max-w-3xl mb-16 lg:mb-20" data-reveal>
                <p class="font-mono text-xs text-signal mb-5">// por qué okanet</p>
                <h2 class="font-display font-extrabold tracking-tight leading-[1.02] text-[clamp(2rem,5vw,3.5rem)] text-balance">
                    Por qué una empresa nos confía su operación.
                </h2>
            </div>

            <div class="grid lg:grid-cols-12 gap-10 lg:gap-16 items-start">
                <div class="lg:col-span-7 space-y-px bg-bone/10 border border-bone/10 rounded-sm overflow-hidden" data-reveal-group>
                    <div class="bg-graphite p-7 lg:p-9 grid grid-cols-12 gap-5" data-reveal>
                        <div class="col-span-12 sm:col-span-4">
                            <h3 class="font-display font-bold text-xl text-bone">Operamos, no solo entregamos</h3>
                        </div>
                        <p class="col-span-12 sm:col-span-8 text-fog leading-relaxed">Mantenemos el sistema funcionando en producción. Si se cae a las 3 a. m., es nuestro problema, no el tuyo.</p>
                    </div>
                    <div class="bg-graphite p-7 lg:p-9 grid grid-cols-12 gap-5" data-reveal>
                        <div class="col-span-12 sm:col-span-4">
                            <h3 class="font-display font-bold text-xl text-bone">IA donde decide, no donde decora</h3>
                        </div>
                        <p class="col-span-12 sm:col-span-8 text-fog leading-relaxed">La usamos para predecir, automatizar y resolver — no para ponerle una etiqueta de moda al producto.</p>
                    </div>
                    <div class="bg-graphite p-7 lg:p-9 grid grid-cols-12 gap-5" data-reveal>
                        <div class="col-span-12 sm:col-span-4">
                            <h3 class="font-display font-bold text-xl text-bone">Conocemos Venezuela</h3>
                        </div>
                        <p class="col-span-12 sm:col-span-8 text-fog leading-relaxed">IVA, SENIAT, pagos, cortes de luz e internet. El software asume el terreno real, no uno ideal.</p>
                    </div>
                </div>

                {{-- Provenance spec — honest, verifiable facts only --}}
                <div class="lg:col-span-5" data-reveal>
                    <div class="panel rounded-sm">
                        <div class="px-6 py-4 border-b border-bone/10 font-mono text-[10px] text-fog-dim uppercase tracking-wider">ficha de la empresa</div>
                        <dl class="px-6 py-2 font-mono text-sm">
                            @foreach ([
                                ['empresa', 'Okanet Solutions C.A.'],
                                ['fundación', '2019'],
                                ['sede', 'Caracas, Venezuela'],
                                ['rif', 'J-41299500-6'],
                                ['operación', '24/7'],
                            ] as $spec)
                                <div class="flex items-center justify-between gap-4 py-3 border-b border-bone/5 last:border-0">
                                    <dt class="text-fog-dim">{{ $spec[0] }}</dt>
                                    <dd class="text-bone text-right">{{ $spec[1] }}</dd>
                                </div>
                            @endforeach
                        </dl>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ─────────────────────────── CONTACTO (dark) ─────────────────────────── --}}
    <section id="contacto" class="relative py-24 md:py-32 bg-graphite scroll-mt-16 overflow-hidden">
        <div class="relative max-w-7xl mx-auto px-6">
            <div class="grid lg:grid-cols-12 gap-12 lg:gap-16">
                <div class="lg:col-span-5" data-reveal>
                    <h2 class="font-display font-extrabold tracking-tight leading-[1.03] text-[clamp(2rem,4.5vw,3.25rem)] mb-6 text-balance">
                        Cuéntanos qué haces a mano hoy.
                    </h2>
                    <p class="text-fog leading-relaxed mb-12 text-pretty">
                        Si tu equipo repite la misma tarea todos los días, lo más probable es que podamos automatizarla. Escríbenos y lo conversamos — sin compromiso.
                    </p>

                    <div class="space-y-8">
                        <div>
                            <div class="font-mono text-[11px] text-fog-dim uppercase tracking-wider mb-2">Directo · WhatsApp</div>
                            <a href="https://wa.me/584241780659" target="_blank" rel="noopener" class="inline-flex items-center gap-3 text-2xl font-display font-bold text-bone hover:text-signal transition-colors">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
                                +58 424 178 0659
                            </a>
                        </div>
                        <div>
                            <div class="font-mono text-[11px] text-fog-dim uppercase tracking-wider mb-2">Oficina</div>
                            <p class="text-bone/90 leading-relaxed">
                                Av. Rómulo Gallegos con Calle Pedro Manrique<br>
                                Edif. Centro ALOA, PP-36-L<br>
                                <span class="text-fog">Caracas 1071, Venezuela</span>
                            </p>
                        </div>
                    </div>
                </div>

                <div class="lg:col-span-7" data-reveal>
                    <form id="contact-form" class="panel rounded-sm p-7 md:p-9 space-y-7">
                        <div class="grid md:grid-cols-2 gap-x-6 gap-y-7">
                            <div>
                                <label for="contact-name" class="block font-mono text-[11px] text-fog-dim uppercase tracking-wider mb-2">Nombre</label>
                                <input id="contact-name" name="name" type="text" required placeholder="Tu nombre" class="w-full bg-transparent border-0 border-b border-bone/20 px-0 py-2 text-bone placeholder-fog-dim focus:border-signal transition-colors">
                            </div>
                            <div>
                                <label for="contact-company" class="block font-mono text-[11px] text-fog-dim uppercase tracking-wider mb-2">Empresa</label>
                                <input id="contact-company" name="company" type="text" placeholder="Tu empresa" class="w-full bg-transparent border-0 border-b border-bone/20 px-0 py-2 text-bone placeholder-fog-dim focus:border-signal transition-colors">
                            </div>
                        </div>
                        <div>
                            <label for="contact-interest" class="block font-mono text-[11px] text-fog-dim uppercase tracking-wider mb-2">¿Qué te interesa?</label>
                            <select id="contact-interest" name="interest" class="w-full bg-transparent border-0 border-b border-bone/20 px-0 py-2 text-bone focus:border-signal transition-colors [&>option]:bg-graphite">
                                <option value="Sistema a medida">Automatizar un proceso a medida</option>
                                <option value="OkaISP">OkaISP — ERP para proveedores de internet</option>
                                <option value="OkaStore">OkaStore — tienda en línea + contabilidad</option>
                                <option value="Otro">Otro</option>
                            </select>
                        </div>
                        <div>
                            <label for="contact-message" class="block font-mono text-[11px] text-fog-dim uppercase tracking-wider mb-2">¿Qué proceso quieres automatizar?</label>
                            <textarea id="contact-message" name="message" rows="4" placeholder="Cuéntanos qué tarea repite tu equipo hoy…" class="w-full bg-transparent border-0 border-b border-bone/20 px-0 py-2 text-bone placeholder-fog-dim focus:border-signal transition-colors resize-none"></textarea>
                        </div>
                        <button type="submit" class="group pressable inline-flex items-center gap-3 px-7 py-3.5 bg-signal text-ink font-semibold rounded-sm hover:bg-signal-bright">
                            Enviar por WhatsApp
                            <span class="font-mono text-sm group-hover:translate-x-1 transition-transform duration-200 ease-out">→</span>
                        </button>
                        <p class="font-mono text-[10px] text-fog-dim">Se abre WhatsApp con tu mensaje listo para enviar.</p>
                    </form>
                </div>
            </div>
        </div>
    </section>

    {{-- ──────────────────────────── FOOTER ──────────────────────────── --}}
    <footer class="bg-ink text-bone pt-16 pb-10 border-t border-bone/10">
        <div class="max-w-7xl mx-auto px-6">
            <div class="grid md:grid-cols-12 gap-10 mb-14">
                <div class="md:col-span-5">
                    <a href="#top" class="flex items-center gap-2.5 mb-5">
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
                        <li><a href="#okaisp" class="hover:text-signal transition-colors">OkaISP</a></li>
                        <li><a href="#okastore" class="hover:text-signal transition-colors">OkaStore</a></li>
                        <li><a href="#amedida" class="hover:text-signal transition-colors">A medida</a></li>
                    </ul>
                </nav>
                <nav class="md:col-span-2" aria-label="Empresa">
                    <h2 class="font-mono text-[11px] text-fog-dim uppercase tracking-wider mb-4">Empresa</h2>
                    <ul class="space-y-2.5 text-sm text-fog">
                        <li><a href="#sistema" class="hover:text-signal transition-colors">Cómo trabajamos</a></li>
                        <li><a href="#okanet" class="hover:text-signal transition-colors">Por qué Okanet</a></li>
                        <li><a href="{{ route('blog.index') }}" class="hover:text-signal transition-colors">Blog</a></li>
                        <li><a href="#contacto" class="hover:text-signal transition-colors">Contacto</a></li>
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
        (function () {
            const reduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

            // Hero choreography — fire on the same pass that confirms JS so a
            // no-JS or headless render shows the headline immediately.
            const hero = document.querySelector('.hero');
            if (hero) {
                const enter = () => hero.classList.add('is-in');
                requestAnimationFrame(enter);
                // Failsafe: rAF is throttled in background/headless renders; never
                // leave the choreographed content stranded invisible.
                setTimeout(enter, 400);
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
                if (!ticking) { window.requestAnimationFrame(updateProgress); ticking = true; }
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

            // Live activity readout — illustrative feed of automated work.
            const log = document.getElementById('activity-log');
            if (log && !reduceMotion) {
                const events = ['Factura emitida', 'Pago conciliado', 'Stock actualizado', 'Respaldo verificado', 'Ticket resuelto', 'Reporte enviado', 'Cliente sincronizado', 'IVA calculado'];
                let i = 0;
                setInterval(() => {
                    i = (i + 1) % events.length;
                    const rows = Array.from(log.children);
                    // age the existing timestamps
                    const stamps = ['ahora', 'hace 6s', 'hace 18s', 'hace 41s'];
                    const li = document.createElement('li');
                    li.className = 'log-row flex items-center justify-between gap-3';
                    li.innerHTML = '<span class="text-bone/90">' + events[i] + '</span><span class="text-fog-dim">ahora</span>';
                    log.insertBefore(li, log.firstChild);
                    if (log.children.length > 4) { log.removeChild(log.lastChild); }
                    Array.from(log.children).forEach((row, idx) => {
                        const t = row.querySelector('span:last-child');
                        if (t && stamps[idx]) { t.textContent = stamps[idx]; }
                    });
                }, 3200);
            }

            // Contact form → open WhatsApp with the message prefilled (honest about destination).
            const form = document.getElementById('contact-form');
            if (form) {
                form.addEventListener('submit', (e) => {
                    e.preventDefault();
                    const data = new FormData(form);
                    const text =
                        'Hola Okanet, soy ' + (data.get('name') || '') +
                        (data.get('company') ? ' de ' + data.get('company') : '') + '.%0A' +
                        'Me interesa: ' + (data.get('interest') || '') + '.%0A' +
                        (data.get('message') ? 'Proceso a automatizar: ' + data.get('message') : '');
                    window.open('https://wa.me/584241780659?text=' + encodeURIComponent(text).replace(/%2520/g, '%20'), '_blank', 'noopener');
                });
            }
        })();
    </script>
</body>
</html>
