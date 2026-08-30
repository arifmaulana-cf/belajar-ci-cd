// Scroll-reveal halus untuk elemen berkelas .reveal
const revealEls = document.querySelectorAll('.reveal');

if ('IntersectionObserver' in window) {
    const observer = new IntersectionObserver(
        (entries) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('is-visible');
                    observer.unobserve(entry.target);
                }
            });
        },
        { threshold: 0.12, rootMargin: '0px 0px -40px 0px' }
    );

    revealEls.forEach((el) => observer.observe(el));
} else {
    revealEls.forEach((el) => el.classList.add('is-visible'));
}

// ============================================================
// PARALLAX — gerakkan elemen [data-parallax] saat halaman di-scroll
// (efek lapisan mengalir, ringan & tanpa jQuery)
// ============================================================
const reduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
const parallaxLayers = document.querySelectorAll('[data-parallax]');

if (!reduceMotion && parallaxLayers.length) {
    let ticking = false;

    const applyParallax = () => {
        const y = window.scrollY;
        parallaxLayers.forEach((el) => {
            const speed = parseFloat(el.getAttribute('data-parallax')) || 0.2;
            el.style.transform = `translate3d(0, ${(y * speed).toFixed(2)}px, 0)`;
        });
        ticking = false;
    };

    window.addEventListener('scroll', () => {
        if (!ticking) {
            requestAnimationFrame(applyParallax);
            ticking = true;
        }
    }, { passive: true });

    applyParallax();
}