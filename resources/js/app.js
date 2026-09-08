import './bootstrap';

const toggle = document.getElementById('menu-toggle');
const menu = document.getElementById('mobile-menu');

if (toggle && menu) {
    const setMenuOpen = (open) => {
        menu.classList.toggle('hidden', !open);
        toggle.setAttribute('aria-expanded', String(open));
        toggle.setAttribute('aria-label', open ? 'Cerrar menú' : 'Abrir menú');
    };

    toggle.addEventListener('click', () => {
        setMenuOpen(toggle.getAttribute('aria-expanded') !== 'true');
    });
    menu.querySelectorAll('a').forEach((link) => {
        link.addEventListener('click', () => setMenuOpen(false));
    });
    document.addEventListener('keydown', (event) => {
        if (event.key === 'Escape' && toggle.getAttribute('aria-expanded') === 'true') {
            setMenuOpen(false);
            toggle.focus();
        }
    });
    window.matchMedia('(min-width: 768px)').addEventListener('change', () => setMenuOpen(false));
}

const form = document.getElementById('contact-form');

if (form) {
    document.querySelectorAll('[data-interest]').forEach((link) => {
        link.addEventListener('click', () => {
            form.elements.interest.value = link.dataset.interest;
        });
    });
    form.addEventListener('submit', (event) => {
        event.preventDefault();
        const data = new FormData(form);
        const message = [
            `Hola Okanet, soy ${data.get('name')}${data.get('company') ? ` de ${data.get('company')}` : ''}.`,
            `Me interesa: ${data.get('interest')}.`,
            data.get('message') ? `Mi proyecto: ${data.get('message')}` : '',
        ].filter(Boolean).join('\n');
        window.open(`https://wa.me/584241780659?text=${encodeURIComponent(message)}`, '_blank', 'noopener');
    });
}
