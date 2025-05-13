<script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
<!-- Swiper JS -->
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

<script>
    window.addEventListener('scroll', () => {
        const navbar = document.getElementById('navbar');
        const headerHeight = document.querySelector('header').offsetHeight;

        if (window.scrollY > headerHeight) {
            navbar.classList.add('bg-gray-900', 'shadow-lg', 'border-b', 'border-gray-700');
        } else {
            navbar.classList.remove('bg-gray-900', 'shadow-lg', 'border-b', 'border-gray-700');
        }
    });

    // Parallax effect on scroll
    const parallax = document.getElementById('parallax-section');
    window.addEventListener('scroll', () => {
        const offset = window.scrollY;
        parallax.style.backgroundPositionY = offset * 0.5 + "px"; // Ajuste la vitesse ici (0.5 = effet doux)
    });

    document.addEventListener("DOMContentLoaded", function () {
        const fadeConfigs = {
            'fade-section': 'visible',
            'fade-left': 'visible',
            'fade-right': 'visible'
        };

        const observer = new IntersectionObserver((entries, obs) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('visible');
                    obs.unobserve(entry.target);
                }
            });
        }, {
            threshold: 0.1
        });

        Object.keys(fadeConfigs).forEach(className => {
            const elements = document.querySelectorAll('.' + className);
            elements.forEach(el => observer.observe(el));
        });
    });

    //Swiper
    const swiper = new Swiper(".mySwiper", {
        loop: true,
        autoplay: {
            delay: 5000,
            disableOnInteraction: false,
        },
        centeredSlides: true,
        spaceBetween: 30,
        grabCursor: true,
        slidesPerView: 1,
        breakpoints: {
            640: {
            slidesPerView: 1,
            },
            1024: {
            slidesPerView: 1,
            },
        },
    });

    document.addEventListener("DOMContentLoaded", function () {
        const sections = document.querySelectorAll('.section'); // adapte ce sélecteur selon ta structure

        sections.forEach((section, index) => {
        const isDark = index % 2 == 1;

        // 1. Appliquer le background à la section
        if (isDark) {
            section.classList.add('bg-gray-950');
            section.classList.remove('bg-gray-800'); // au cas où
        } else {
            section.classList.remove('bg-gray-950');
        }

        // 2. Animation sur le premier enfant
        const children = section.children;
        if (children.length > 0) {
            const child = children[0];
            if (isDark) {
            child.classList.add('fade-left');
            child.classList.remove('fade-right');
            } else {
            child.classList.add('fade-right');
            child.classList.remove('fade-left');
            }
        }

        // 3. Appliquer un fond différent aux cards internes
        const cards = section.querySelectorAll('.card'); // adapte .card si nécessaire
        cards.forEach(card => {
            card.classList.remove('bg-gray-800', 'bg-gray-900'); // on enlève d'abord les deux possibles
            if (isDark) {
            card.classList.add('bg-gray-900');
            } else {
            card.classList.add('bg-gray-800');
            }
        });
        });
    });
</script>

