import './bootstrap';

// Signal that JS is available — the hidden pre-reveal state in CSS is scoped
// to .js so content stays visible if scripts never load.
document.documentElement.classList.add('js');

// Stagger siblings inside a reveal group (30-80ms apart, capped so late
// items never feel slow).
document.querySelectorAll('[data-reveal-group]').forEach((group) => {
    group.querySelectorAll('[data-reveal]').forEach((el, index) => {
        el.style.setProperty('--reveal-delay', `${Math.min(index * 60, 300)}ms`);
    });
});

const revealObserver = new IntersectionObserver(
    (entries, observer) => {
        entries.forEach((entry) => {
            if (entry.isIntersecting) {
                entry.target.classList.add('is-revealed');
                observer.unobserve(entry.target);
            }
        });
    },
    { rootMargin: '0px 0px -10% 0px', threshold: 0.1 },
);

document.querySelectorAll('[data-reveal]').forEach((el) => revealObserver.observe(el));
