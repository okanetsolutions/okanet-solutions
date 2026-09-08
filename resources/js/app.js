const toggle = document.getElementById('menu-toggle');
const menu = document.getElementById('site-menu');

if (toggle && menu) {
    toggle.hidden = false;
    menu.classList.add('menu-enhanced');
    const setMenuOpen = (open) => {
        menu.classList.toggle('menu-open', open);
        toggle.setAttribute('aria-expanded', String(open));
        toggle.setAttribute('aria-label', open ? 'Cerrar menú' : 'Abrir menú');
    };
    toggle.addEventListener('click', () => setMenuOpen(toggle.getAttribute('aria-expanded') !== 'true'));
    menu.querySelectorAll('a').forEach((link) => link.addEventListener('click', () => setMenuOpen(false)));
    document.addEventListener('keydown', (event) => {
        if (event.key === 'Escape' && toggle.getAttribute('aria-expanded') === 'true') {
            setMenuOpen(false);
            toggle.focus();
        }
    });
    document.addEventListener('click', (event) => {
        if (!menu.contains(event.target) && !toggle.contains(event.target)) {
            setMenuOpen(false);
        }
    });
    window.matchMedia('(min-width: 1024px)').addEventListener('change', () => setMenuOpen(false));
}

const cookieDialog = document.getElementById('cookie-settings');
if (cookieDialog && typeof cookieDialog.showModal === 'function') {
    document.querySelectorAll('[data-cookie-settings]').forEach((link) => {
        link.addEventListener('click', (event) => {
            event.preventDefault();
            cookieDialog.showModal();
        });
    });
}

const form = document.getElementById('contact-form');
const preview = document.getElementById('contact-preview');
if (form && preview) {
    form.addEventListener('submit', (event) => {
        event.preventDefault();
        const data = new FormData(form);
        const name = String(data.get('name') ?? '').trim();
        const nameInput = form.elements.namedItem('name');
        nameInput.setCustomValidity(name ? '' : 'Escribe tu nombre para preparar el mensaje.');
        if (!form.reportValidity()) {
            return;
        }
        const company = String(data.get('company') ?? '').trim();
        const details = String(data.get('message') ?? '').trim();
        const message = [
            `Hola Okanet, soy ${name}${company ? ` de ${company}` : ''}.`,
            `Me interesa: ${data.get('interest')}.`,
            details ? `Mi proyecto: ${details}` : '',
        ].filter(Boolean).join('\n');
        document.getElementById('prepared-message').textContent = message;
        document.getElementById('whatsapp-message').href = `https://wa.me/584241780659?text=${encodeURIComponent(message)}`;
        form.hidden = true;
        preview.hidden = false;
        preview.focus();
    });
    form.elements.namedItem('name').addEventListener('input', (event) => event.target.setCustomValidity(''));
    document.getElementById('edit-message').addEventListener('click', () => {
        preview.hidden = true;
        form.hidden = false;
        document.getElementById('whatsapp-message').removeAttribute('href');
        document.getElementById('prepared-message').textContent = '';
        form.elements.namedItem('name').focus();
    });
    form.querySelector('fieldset').disabled = false;
}
