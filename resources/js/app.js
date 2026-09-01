import './bootstrap';

const setupReveal = () => {
    const revealNodes = document.querySelectorAll('.reveal');

    if (!revealNodes.length) {
        return;
    }

    const observer = new IntersectionObserver(
        (entries) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('is-visible');
                    observer.unobserve(entry.target);
                }
            });
        },
        { threshold: 0.18 }
    );

    revealNodes.forEach((node, index) => {
        node.style.transitionDelay = `${Math.min(index * 60, 360)}ms`;
        observer.observe(node);
    });
};

const setupParallax = () => {
    const layers = document.querySelectorAll('[data-parallax]');

    if (!layers.length || window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
        return;
    }

    const updateParallax = () => {
        const offsetY = window.scrollY;

        layers.forEach((layer) => {
            const speed = Number(layer.getAttribute('data-parallax')) || 0;
            layer.style.transform = `translate3d(0, ${offsetY * speed}px, 0)`;
        });
    };

    updateParallax();
    window.addEventListener('scroll', updateParallax, { passive: true });
};

document.addEventListener('DOMContentLoaded', () => {
    setupReveal();
    setupParallax();
});
