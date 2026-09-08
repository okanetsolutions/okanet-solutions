@extends('layouts.legal')
@section('title', 'Política de cookies — Okanet Solutions')
@section('description', 'Qué cookies utiliza Okanet, para qué sirven y cuánto duran. El sitio no incorpora cookies de analítica ni publicidad.')
@section('legal-title', 'Política de cookies')
@section('legal-content')
    <p>Las cookies son pequeños archivos que el navegador guarda para mantener una sesión, proteger solicitudes o recordar información. El sitio se aloja en DigitalOcean NYC1 (Nueva York, Estados Unidos) y utiliza el proxy estándar y el almacenamiento R2 de Cloudflare. Este documento distingue las cookies de la aplicación de las cookies de seguridad que puedan establecer los servicios de red.</p>
    <h2>1. Solo cookies técnicas</h2>
    <p>El código de esta aplicación no incorpora analítica, publicidad, píxeles de seguimiento ni widgets externos. La configuración de las funciones adicionales de Cloudflare debe verificarse por separado. Las fuentes se sirven desde el propio sitio. No guardamos preferencias o mensajes en el almacenamiento local del navegador.</p>
    <p>Las cookies estrictamente necesarias para prestar el servicio solicitado están exentas de consentimiento previo conforme a las reglas europeas sobre cookies. Por eso no mostramos una solicitud de aceptación de cookies opcionales que no utilizamos.</p>
    <h2>2. Inventario de cookies</h2>
    <div class="legal-table-wrap" tabindex="0" role="region" aria-label="Inventario de cookies, desplazable horizontalmente">
        <table>
            <thead>
                <tr>
                    <th scope="col">Cookie propia</th>
                    <th scope="col">Finalidad</th>
                    <th scope="col">Duración</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <code>{{ config('session.cookie') }}</code>
                    </td>
                    <td>Mantener la sesión, los mensajes del sistema y el acceso autenticado cuando corresponda.</td>
                    <td>
                        @if(config('session.expire_on_close')) Hasta cerrar el navegador. @else {{ config('session.lifetime') }} minutos desde su renovación. @endif
                    </td>
                </tr>
                <tr>
                    <td>
                        <code>XSRF-TOKEN</code>
                    </td>
                    <td>Proteger las solicitudes frente a falsificación entre sitios.</td>
                    <td>{{ config('session.lifetime') }} minutos desde su renovación.</td>
                </tr>
                <tr>
                    <td>
                        <code>remember_web_…</code>
                    </td>
                    <td>Mantener el acceso del personal que inicia sesión en el panel de administración. No se crea por visitar las páginas públicas.</td>
                    <td>Hasta 400 días; se retira al cerrar sesión.</td>
                </tr>
            </tbody>
        </table>
    </div>
    <p>Las cookies técnicas pueden renovarse al navegar. Su caducidad no determina la conservación de registros en el servidor. El nombre de la cookie de sesión y su duración reflejan la configuración de esta aplicación.</p>
    <h2>3. Cookies de seguridad de Cloudflare</h2>
    <p>El tráfico pasa por el proxy estándar de Cloudflare. Si están habilitadas las funciones de protección correspondientes, Cloudflare puede establecer cookies para detectar tráfico automatizado o recordar verificaciones de seguridad. No son cookies publicitarias. Esta lista es condicional: no confirma que todas estén activadas en este sitio.</p>
    <ul>
        <li><code>__cf_bm</code>: utilizada por determinadas funciones de protección frente a bots; caduca tras 30 minutos de inactividad continua.</li>
        <li><code>cf_clearance</code>: conserva el resultado de una comprobación de seguridad. Su duración depende de la configuración de desafíos del sitio, que todavía no hemos verificado.</li>
    </ul>
    <p>Consulta la <a href="https://developers.cloudflare.com/fundamentals/reference/policies-compliances/cloudflare-cookies/" rel="noreferrer">documentación de cookies de Cloudflare</a> para las funciones y cookies que pueden existir. El inventario definitivo requiere revisar el tráfico real y las funciones activas, incluidos los controles de bots, límites de solicitudes, balanceo y salas de espera si se utilizan. Cloudflare puede tratar datos de cookies en Estados Unidos por defecto; no se ha confirmado una opción de localización específica para nuestra cuenta.</p>
    <p>El uso de R2 para almacenar archivos no equivale a instalar analítica o publicidad en el navegador. Postmark interviene en el procesamiento del correo y no añade por sí mismo cookies a estas páginas. El tratamiento y los plazos propios de ambos proveedores se describen en la <a href="{{ route('privacy') }}" wire:navigate>política de privacidad</a>.</p>
    <h2>4. Preferencias y eliminación</h2>
    <p>Puedes <a href="{{ route('cookies') }}" data-cookie-settings>abrir el panel de cookies</a> desde aquí o desde el pie de cualquier página. No hay categorías opcionales activadas ni consentimientos que retirar en esta versión.</p>
    <p>Tu navegador permite consultar, bloquear y eliminar cookies en su configuración de privacidad. Bloquear las cookies necesarias puede impedir el acceso al panel administrativo o el funcionamiento de los formularios protegidos. Cerrar sesión elimina el acceso persistente del navegador utilizado.</p>
    <h2>5. Enlaces a terceros</h2>
    <p>WhatsApp y otros enlaces externos solo se abren cuando eliges visitarlos. Esos servicios pueden utilizar sus propias cookies y tratar datos bajo sus políticas. Si continúas con un mensaje preparado, WhatsApp recibe ese texto para abrir la conversación.</p>
    <p>La preferencia de este sitio no controla las cookies de un sitio externo. Puedes consultar la <a href="https://www.whatsapp.com/legal/privacy-policy" rel="noreferrer">política de privacidad de WhatsApp</a> antes de utilizarlo, o contactar a Okanet por teléfono.</p>
    <h2>6. Si incorporamos nuevas herramientas</h2>
    <p>Antes de añadir cookies opcionales se deberá actualizar esta política y habilitar un consentimiento previo, específico y revocable, con opciones para aceptar y rechazar de forma equivalente. Navegar, cerrar un aviso o continuar usando el sitio no constituye consentimiento.</p>
    <h2>7. Contacto y actualización</h2>
    <p>Para consultas sobre cookies, escribe a <a href="mailto:info@okanetsolutions.com">info@okanetsolutions.com</a>, llama al <a href="tel:+584241780659">+58 424 178 0659</a> o consulta la <a href="{{ route('privacy') }}" wire:navigate>política de privacidad</a>. El inventario debe mantenerse actualizado con las funciones de Cloudflare que estén activas. La configuración exacta de los desafíos y las cookies de producción no se ha verificado desde esta aplicación. Las cookies o herramientas opcionales que requieran consentimiento deben permanecer desactivadas hasta disponer de un mecanismo previo adecuado.</p>
@endsection
