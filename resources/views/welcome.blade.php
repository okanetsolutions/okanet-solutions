@extends('layouts.site')

@section('title', 'Okanet Solutions — Software y ciberseguridad en Venezuela')
@section('description', 'Desarrollo de software, automatización, protección de ciberseguridad y pruebas de penetración. OkaISP y OkaStore. Okanet Solutions, Caracas, Venezuela.')

@section('content')
    <header class="home-intro">
        <div class="site-width">
            <p class="intro-location">Okanet Solutions · Caracas, Venezuela</p>
            <div class="intro-layout">
                <div>
                    <h1>Software que resuelve.<br><span>Seguridad que protege.</span></h1>
                    <p class="intro-description">Desarrollamos sistemas para tu operación y te ayudamos a protegerlos. Automatización, productos propios y ciberseguridad, con un equipo en Caracas.</p>
                    <a href="#contacto" class="primary-link">Cuéntanos tu proyecto <span aria-hidden="true">↗</span></a>
                </div>
                <aside class="intro-services" aria-label="Nuestros servicios">
                    <p>Cómo podemos ayudarte</p>
                    <a href="#productos"><span>Productos para tu negocio<small>OkaISP y OkaStore</small></span><span aria-hidden="true">↗</span></a>
                    <a href="#amedida"><span>Desarrollo a medida<small>Procesos, integraciones y automatización</small></span><span aria-hidden="true">↗</span></a>
                    <a href="#seguridad"><span>Ciberseguridad<small>Protección y pruebas de penetración</small></span><span aria-hidden="true">↗</span></a>
                </aside>
            </div>
            <div class="intro-bottom"><span>Software desde 2019</span><span>Para proveedores de internet, comercios y empresas de servicios</span></div>
        </div>
    </header>

    <section id="productos" class="bg-ink text-bone py-20 md:py-28">
        <div class="site-width">
            <div class="section-intro">
                <h2>Conocemos tu sector.<br>Construimos para él.</h2>
                <p>Dos productos con un propósito concreto: reunir las herramientas que tu equipo necesita para trabajar cada día.</p>
            </div>
            {{-- OkaISP --}}
            <div id="okaisp" class="grid lg:grid-cols-12 gap-10 lg:gap-14 items-center mb-24 lg:mb-32 scroll-mt-24">
                <div class="lg:col-span-5">
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
                <figure class="lg:col-span-7 lg:order-last">
                    <div class="panel rounded-md overflow-hidden">
                        <div class="flex items-center justify-between px-4 py-2.5 border-b border-bone/10 bg-graphite-2">
                            <div class="flex items-center gap-3">
                                <span class="flex gap-1.5"><span class="w-2.5 h-2.5 rounded-full bg-bone/15"></span><span class="w-2.5 h-2.5 rounded-full bg-bone/15"></span><span class="w-2.5 h-2.5 rounded-full bg-bone/15"></span></span>
                                <span class="font-mono text-[11px] text-fog-dim">okaisp · operaciones</span>
                            </div>
                            <span class="font-mono text-[10px] text-signal flex items-center gap-1.5"><span class="w-1.5 h-1.5 rounded-full bg-signal"></span>Datos de ejemplo</span>
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
            <div id="okastore" class="grid lg:grid-cols-12 gap-10 lg:gap-14 items-center scroll-mt-24">
                <div class="lg:col-span-5 lg:order-last">
                    <div class="flex items-center gap-2.5 mb-5 font-mono text-xs text-signal">
                        <span class="w-1.5 h-1.5 rounded-full bg-signal"></span>
                        okastore
                    </div>
                    <h3 class="font-display font-extrabold text-3xl md:text-4xl tracking-tight mb-4">
                        Tienda en línea con contabilidad, hecha para Venezuela
                    </h3>
                    <p class="text-fog leading-relaxed mb-8 text-pretty">
                        Gestiona tu tienda, pedidos e inventario junto con la contabilidad del negocio. Una plataforma pensada para las necesidades del comercio venezolano.
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
                <figure class="lg:col-span-7">
                    <div class="rounded-md overflow-hidden border border-bone/15 bg-surface text-espresso">
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

    <section id="amedida" class="service-section site-width">
        <div class="service-heading"><p>Desarrollo a medida</p><h2>El sistema se adapta<br>a tu operación.</h2></div>
        <div class="service-detail"><p>Conectamos las herramientas que ya usas y desarrollamos lo que falta. Empezamos por el proceso que más tiempo le cuesta a tu equipo.</p>
            <ul class="service-list"><li>Integraciones entre sistemas y APIs</li><li>Automatización de tareas y reportes</li><li>Aplicaciones para procesos internos</li><li>Mantenimiento y evolución del software</li></ul>
            <a class="text-link" href="#contacto">Conversemos sobre tu proceso <span aria-hidden="true">↗</span></a>
        </div>
    </section>

    <section id="seguridad" class="security-section">
        <div class="site-width">
            <div class="section-intro"><h2>La seguridad también<br>es parte del trabajo.</h2><p>Protección de ciberseguridad y pruebas de penetración para identificar riesgos y reforzar tus aplicaciones, redes e infraestructura.</p></div>
            <div class="security-services">
                <article><h3>Protección de ciberseguridad</h3><p>Revisamos configuraciones, accesos y controles de seguridad para detectar puntos débiles y ayudarte a reducir la exposición de tus sistemas.</p><p class="service-note">Evaluación de riesgos · Configuración segura · Control de accesos</p></article>
                <article><h3>Pruebas de penetración</h3><p>Evaluamos tus sistemas mediante pruebas autorizadas y con un alcance acordado. Documentamos los hallazgos y las recomendaciones para que tu equipo pueda priorizar las correcciones.</p><p class="service-note">Pentesting · Análisis de vulnerabilidades · Recomendaciones de corrección</p></article>
            </div>
            <a class="text-link" href="#contacto" data-interest="Pruebas de penetración">Hablemos de la seguridad de tus sistemas <span aria-hidden="true">↗</span></a>
        </div>
    </section>

    <section id="sistema" class="process-section site-width">
        <div class="section-intro"><h2>Primero entendemos.<br>Después construimos.</h2><p>Un proyecto empieza con una conversación sobre tu operación. Definimos juntos el alcance, las prioridades y cómo comprobar el resultado.</p></div>
        <ol class="process-list">
            <li><h3>Entender el problema</h3><p>Revisamos tus procesos, herramientas y restricciones con las personas que los conocen.</p></li>
            <li><h3>Acordar el alcance</h3><p>Definimos entregables y prioridades para que sepas qué vamos a resolver.</p></li>
            <li><h3>Implementar y acompañar</h3><p>Probamos el resultado contigo y planificamos el mantenimiento que necesita.</p></li>
        </ol>
        <div id="okanet" class="company-note"><h3>Desde Caracas, desde 2019.</h3><p>Somos Okanet Solutions C.A. Desarrollamos software para empresas en Venezuela, con atención a sus procesos, sus herramientas de pago y su contexto local.</p></div>
    </section>
    <section id="contacto" class="relative py-24 md:py-32 bg-graphite scroll-mt-16 overflow-hidden">
        <div class="relative max-w-7xl mx-auto px-6">
            <div class="grid lg:grid-cols-12 gap-12 lg:gap-16">
                <div class="lg:col-span-5">
                    <h2 class="font-display font-extrabold tracking-tight leading-[1.03] text-[clamp(2rem,4.5vw,3.25rem)] mb-6 text-balance">
                        Hablemos de tu próximo proyecto.
                    </h2>
                    <p class="text-fog leading-relaxed mb-12 text-pretty">
                        ¿Necesitas automatizar un proceso, implementar un producto o evaluar la seguridad de tus sistemas? Cuéntanos dónde estás y qué necesitas resolver.
                    </p>

                    <div class="space-y-8">
                        <div>
                            <div class="text-sm text-fog mb-2">Directo · WhatsApp</div>
                            <a href="https://wa.me/584241780659" target="_blank" rel="noopener" class="inline-flex items-center gap-3 text-2xl font-display font-bold text-bone hover:text-signal transition-colors">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
                                +58 424 178 0659
                            </a>
                        </div>
                        <div>
                            <div class="text-sm text-fog mb-2">Oficina</div>
                            <p class="text-bone/90 leading-relaxed">
                                Av. Rómulo Gallegos con Calle Pedro Manrique<br>
                                Edif. Centro ALOA, PP-36-L<br>
                                <span class="text-fog">Caracas 1071, Venezuela</span>
                            </p>
                        </div>
                    </div>
                </div>

                <div class="lg:col-span-7">
                    <form id="contact-form" class="panel rounded-sm p-7 md:p-9 space-y-7">
                        <div class="grid md:grid-cols-2 gap-x-6 gap-y-7">
                            <div>
                                <label for="contact-name" class="block text-sm text-fog mb-2">Nombre</label>
                                <input id="contact-name" name="name" autocomplete="name" type="text" required placeholder="Tu nombre" class="w-full bg-transparent border-0 border-b border-bone/20 px-0 py-2 text-bone placeholder-fog-dim focus:border-signal transition-colors">
                            </div>
                            <div>
                                <label for="contact-company" class="block text-sm text-fog mb-2">Empresa</label>
                                <input id="contact-company" name="company" autocomplete="organization" type="text" placeholder="Tu empresa" class="w-full bg-transparent border-0 border-b border-bone/20 px-0 py-2 text-bone placeholder-fog-dim focus:border-signal transition-colors">
                            </div>
                        </div>
                        <div>
                            <label for="contact-interest" class="block text-sm text-fog mb-2">¿Qué te interesa?</label>
                            <select id="contact-interest" name="interest" class="w-full bg-transparent border-0 border-b border-bone/20 px-0 py-2 text-bone focus:border-signal transition-colors [&>option]:bg-graphite">
                                <option value="Sistema a medida">Automatizar un proceso a medida</option>
                                <option value="OkaISP">OkaISP — ERP para proveedores de internet</option>
                                <option value="OkaStore">OkaStore — tienda en línea + contabilidad</option>
                                <option value="Protección de ciberseguridad">Protección de ciberseguridad</option>
                                <option value="Pruebas de penetración">Pruebas de penetración (pentesting)</option>
                                <option value="Otro">Otro</option>
                            </select>
                        </div>
                        <div>
                            <label for="contact-message" class="block text-sm text-fog mb-2">¿Qué necesitas resolver?</label>
                            <textarea id="contact-message" name="message" rows="4" placeholder="Describe tu proyecto o los sistemas que necesitas proteger…" class="w-full bg-transparent border-0 border-b border-bone/20 px-0 py-2 text-bone placeholder-fog-dim focus:border-signal transition-colors resize-none"></textarea>
                        </div>
                        <button type="submit" class="group pressable inline-flex items-center gap-3 px-7 py-3.5 bg-signal text-ink font-semibold rounded-sm hover:bg-signal-bright">
                            Enviar por WhatsApp
                            <span class="font-mono text-sm group-hover:translate-x-1 transition-transform duration-200 ease-out">→</span>
                        </button>
                        <p class="text-sm text-fog">Se abre WhatsApp con tu mensaje listo para enviar.</p>
                    </form>
                </div>
            </div>
        </div>
    </section>

@endsection
