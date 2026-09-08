<?php

it('renders a dedicated public page with shared navigation and legal links', function (string $route, string $heading): void {
    $this->get(route($route))
        ->assertOk()
        ->assertSee($heading)
        ->assertSee(route('products'))
        ->assertSee(route('contact'))
        ->assertSee(route('privacy'))
        ->assertSee(route('terms'))
        ->assertSee(route('cookies'))
        ->assertDontSee('fonts.bunny.net')
        ->assertDontSee('<iframe', false);
})->with([
    ['products', 'El software adecuado'],
    ['products.okaisp', 'Tu red crece.'],
    ['products.okastore', 'Más cerca de tus clientes.'],
    ['development', 'Tu proceso es único.'],
    ['security', 'Conoce tus riesgos.'],
    ['about', 'Tecnología con criterio.'],
    ['contact', '¿Qué necesitas'],
    ['privacy', 'Política de privacidad'],
    ['cookies', 'Política de cookies'],
    ['terms', 'Términos y condiciones'],
]);

it('marks the parent product navigation as current on product detail pages', function (): void {
    $response = $this->get(route('products.okaisp'));
    $document = new DOMDocument;
    @$document->loadHTML($response->getContent());
    $navigation = new DOMXPath($document);

    expect($navigation->evaluate('string(//nav[@id="site-menu"]/a[@aria-current="page"]/@href)'))
        ->toBe(route('products'));
});

it('leads the security page without the status badge', function (): void {
    $this->get(route('security'))
        ->assertDontSee('Evaluación autorizada · Informe accionable')
        ->assertSee('Conoce tus riesgos.')
        ->assertSee('Identificar')
        ->assertSee('Priorizar')
        ->assertSee('Corregir')
        ->assertSee('href="#consultas-gratuitas"', false);
});

it('preselects the requested service and explains the third party handoff before contact', function (): void {
    $this->get(route('contact', ['interest' => 'Pruebas de penetración']))
        ->assertSee('value="Pruebas de penetración" selected', false)
        ->assertSee('Preparar mensaje')
        ->assertSee('Continuar en WhatsApp')
        ->assertSee('WhatsApp (Meta)')
        ->assertSee('no lo envía ni lo guarda en nuestros servidores')
        ->assertSee('tel:+584241780659', false)
        ->assertSee('<fieldset disabled>', false)
        ->assertSee('<noscript>', false);
});

it('does not reflect arbitrary contact query values into the page', function (mixed $interest): void {
    $this->get(route('contact', ['interest' => $interest]))
        ->assertOk()
        ->assertDontSee('<script>alert(1)</script>', false)
        ->assertDontSee('value="<script>', false)
        ->assertSee('Preparar mensaje');
})->with([
    'markup' => ['<script>alert(1)</script>'],
    'unexpected array' => [['<script>alert(1)</script>']],
]);

it('discloses configured cookies and distinguishes technical storage from optional tracking', function (): void {
    config(['session.cookie' => 'okanet_test_session', 'session.lifetime' => 45]);

    $this->get(route('cookies'))
        ->assertSee('okanet_test_session')
        ->assertSee('45 minutos')
        ->assertSee('XSRF-TOKEN')
        ->assertSee('remember_web_')
        ->assertSee('400 días')
        ->assertSee('No hay categorías opcionales')
        ->assertSee('No guardamos preferencias o mensajes');
});

it('discloses browser close expiry when configured for session cookies', function (): void {
    config(['session.expire_on_close' => true]);

    $this->get(route('cookies'))->assertSee('Hasta cerrar el navegador.');
});

it('publishes updated legal documents after the business details and policy are approved', function (string $route): void {
    $this->get(route($route))
        ->assertSee('Última actualización')
        ->assertDontSee('Documento pendiente de validación.')
        ->assertDontSee('Versión de trabajo')
        ->assertDontSee('name="robots" content="noindex, follow"', false);
})->with(['privacy', 'cookies', 'terms']);

it('protects public pages from embedded third party content and referral leakage', function (): void {
    $this->get(route('home'))
        ->assertSee('name="referrer" content="no-referrer"', false)
        ->assertSee("img-src 'self' data:; frame-src 'none'; object-src 'none'; base-uri 'self';", false)
        ->assertSee('id="cookie-settings"', false)
        ->assertSee('No hay cookies opcionales que aceptar o rechazar en esta aplicación.');
});

it('publishes the confirmed privacy contact and infrastructure providers', function (): void {
    $this->get(route('privacy'))
        ->assertSee('mailto:info@okanetsolutions.com', false)
        ->assertSee('DigitalOcean')
        ->assertSee('Cloudflare')
        ->assertSee('Actualmente no tenemos clientes en la Unión Europea')
        ->assertSee('Esto no excluye la aplicación de otras normas')
        ->assertSee('NYC1 (Nueva York, Estados Unidos)')
        ->assertSee('Cloudflare R2')
        ->assertSee('Postmark')
        ->assertSee('Notificaciones operativas')
        ->assertSee('No incluimos contraseñas, tokens ni el contenido de los formularios')
        ->assertDontSee('Está pendiente incorporar la identidad')
        ->assertDontSee('Está pendiente confirmar el correo');
});

it('distinguishes approved retention periods from verified cleanup and legal archives', function (): void {
    $this->get(route('privacy'))
        ->assertSee('Plazos de conservación aprobados por Okanet')
        ->assertDontSee('pendiente de aprobación')
        ->assertDontSee('plazos son recomendaciones')
        ->assertSee('12 meses desde la última interacción')
        ->assertSee('30 días desde su generación')
        ->assertSee('30 días desde la creación de cada copia')
        ->assertSee('último asiento de cada libro')
        ->assertSee('Estos archivos legales se conservan separados')
        ->assertSee('no acredita su ejecución en producción')
        ->assertSee('no debe aplicarse indiscriminadamente a todos los objetos de R2');
});

it('discloses Cloudflare security cookies conditionally without claiming they are enabled', function (): void {
    $this->get(route('cookies'))
        ->assertSee('__cf_bm')
        ->assertSee('cf_clearance')
        ->assertSee('30 minutos de inactividad continua')
        ->assertSee('no confirma que todas estén activadas')
        ->assertSee('Estados Unidos por defecto');
});

it('applies Venezuelan law to the website terms and retains mandatory protections', function (): void {
    $this->get(route('terms'))
        ->assertSee('se rigen por las leyes de la República Bolivariana de Venezuela')
        ->assertSee('sin excluir normas imperativas ni derechos irrenunciables')
        ->assertSee('mailto:info@okanetsolutions.com', false)
        ->assertDontSee('Está pendiente la validación jurídica de la legislación');
});

it('distinguishes provider retention and data location from the approved local policy', function (): void {
    $this->get(route('privacy'))
        ->assertSee('se conservan por defecto durante 45 días')
        ->assertSee('No se ha verificado un plazo personalizado en nuestra cuenta')
        ->assertSee('estadísticas agregadas y registros de supresión')
        ->assertSee('no se garantiza una residencia exclusiva en NYC1')
        ->assertSee('eliminación de objetos de R2 mediante reglas de ciclo de vida es asíncrona')
        ->assertSee('normalmente ocurre dentro de las 24 horas siguientes');
});

it('renders the brand lockup artwork in the header, the footer and the browser icons', function (): void {
    $this->get(route('home'))
        ->assertSee(asset('images/okanet-logo.png'), false)
        ->assertSee(asset('images/okanet-logo-light.png'), false)
        ->assertSee(asset('images/okanet-icon-180.png'), false)
        ->assertSee('rel="icon"', false);
});

it('keeps the complete primary journey in the home hero', function (): void {
    $this->get(route('home'))
        ->assertOk()
        ->assertSee('Software que resuelve.')
        ->assertSee('Un equipo que responde.')
        ->assertSee('Hecho para tu día a día')
        ->assertSee('Cuéntanos tu proyecto')
        ->assertSee('Explorar productos')
        ->assertSee('Conoce OkaISP')
        ->assertSee(route('contact'), false)
        ->assertSee(route('products'), false)
        ->assertSee(route('products.okaisp'), false);
});

it('ships every brand asset the layouts reference', function (string $path): void {
    expect(public_path($path))->toBeReadableFile()
        ->and(filesize(public_path($path)))->toBeGreaterThan(0);
})->with([
    'favicon.ico',
    'images/okanet-logo.png',
    'images/okanet-logo-light.png',
    'images/okanet-mark.png',
    'images/okanet-icon-180.png',
]);
