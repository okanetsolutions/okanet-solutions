<form id="contact-form" class="contact-form" method="post" action="{{ route('contact') }}">
    <fieldset disabled>
        <legend>Cuéntanos sobre tu proyecto</legend>
        <div class="form-columns">
            <div>
                <label for="contact-name">Nombre <span>(obligatorio)</span>
                </label>
                <input id="contact-name" name="name" type="text" required maxlength="100" autocomplete="name" placeholder="Tu nombre">
            </div>
            <div>
                <label for="contact-company">Empresa <span>(opcional)</span>
                </label>
                <input id="contact-company" name="company" type="text" maxlength="150" autocomplete="organization" placeholder="Nombre de tu empresa">
            </div>
        </div>
        <div>
            <label for="contact-interest">¿Qué te interesa?</label>
            <select id="contact-interest" name="interest">
                @foreach (['Sistema a medida' => 'Desarrollo a medida', 'OkaISP' => 'OkaISP · Proveedores de internet', 'OkaStore' => 'OkaStore · Comercios', 'Protección de ciberseguridad' => 'Protección de ciberseguridad', 'Pruebas de penetración' => 'Pruebas de penetración', 'Otra consulta' => 'Quiero orientación'] as $value => $label)
                    <option value="{{ $value }}" @selected(request()->query('interest') === $value)>{{ $label }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label for="contact-message">¿Qué necesitas resolver? <span>(opcional)</span>
            </label>
            <textarea id="contact-message" name="message" rows="4" maxlength="1500" placeholder="Cuéntanos brevemente sobre tu operación y lo que quieres mejorar." aria-describedby="message-guidance"></textarea>
            <p id="message-guidance" class="field-note">No incluyas contraseñas, datos bancarios ni información confidencial.</p>
        </div>
        <p class="contact-privacy">Usaremos la información que compartas para atender tu consulta. Preparar el mensaje no lo envía ni lo guarda en nuestros servidores. Consulta la <a href="{{ route('privacy') }}">política de privacidad</a>.</p>
        <button class="button" type="submit">Preparar mensaje <span aria-hidden="true">→</span>
        </button>
    </fieldset>
    <noscript>
        <p>Para preparar un mensaje aquí necesitas JavaScript. Puedes llamarnos al <a href="tel:+584241780659">+58 424 178 0659</a> o <a href="https://wa.me/584241780659" rel="noreferrer">abrir WhatsApp</a>, un servicio externo de Meta.</p>
    </noscript>
</form>
<section id="contact-preview" class="contact-preview" aria-labelledby="preview-title" hidden tabindex="-1">
    <h2 id="preview-title">Revisa tu mensaje</h2>
    <p id="prepared-message"></p>
    <p>Al continuar, estos datos se compartirán con WhatsApp (Meta) para abrir la conversación. Podrás revisar el mensaje antes de enviarlo desde esa aplicación. Se aplica la <a href="https://www.whatsapp.com/legal/privacy-policy" rel="noreferrer">política de privacidad de WhatsApp</a>.</p>
    <div class="button-row">
        <a id="whatsapp-message" class="button" rel="noreferrer">Continuar en WhatsApp <span aria-hidden="true">↗</span>
        </a>
        <button id="edit-message" class="text-link" type="button">Editar mensaje</button>
    </div>
</section>
