document.addEventListener('DOMContentLoaded', function () {

    /* =========================================
       NAVBAR MOBILE
    ========================================= */
    const navToggle = document.querySelector('.nav-toggle');
    const navMenu = document.querySelector('.nav-menu');

    if (navToggle && navMenu) {
        navToggle.addEventListener('click', function () {
            navMenu.classList.toggle('open');
            navToggle.classList.toggle('active');
        });
    }


    /* =========================================
       DROPDOWN MOBILE
    ========================================= */
    const dropdownParents = document.querySelectorAll('.has-dropdown');

    dropdownParents.forEach(function (parent) {

        const link = parent.querySelector(':scope > a');

        if (link) {
            link.addEventListener('click', function (event) {

                if (window.innerWidth <= 900) {
                    event.preventDefault();
                    parent.classList.toggle('open');
                }

            });
        }

    });


    /* =========================================
       TUTUP MENU SAAT KLIK LINK
    ========================================= */
    const menuLinks = document.querySelectorAll('.nav-menu a');

    menuLinks.forEach(function (link) {
        link.addEventListener('click', function () {

            if (window.innerWidth <= 900 && !link.parentElement.classList.contains('has-dropdown')) {
                if (navMenu) {
                    navMenu.classList.remove('open');
                }

                if (navToggle) {
                    navToggle.classList.remove('active');
                }
            }

        });
    });


    /* =========================================
       ANIMASI ANGKA STATISTIK
    ========================================= */
    const statCards = document.querySelectorAll('.stat-card');

    statCards.forEach(function (card) {

        const numberElement = card.querySelector('.stat-number');
        const target = parseInt(card.dataset.target || '0');

        if (!numberElement || target <= 0) {
            if (numberElement) {
                numberElement.textContent = target;
            }
            return;
        }

        let current = 0;

        const duration = 1200;
        const intervalTime = 30;
        const steps = duration / intervalTime;
        const increment = target / steps;

        const counter = setInterval(function () {

            current += increment;

            if (current >= target) {
                current = target;
                clearInterval(counter);
            }

            numberElement.textContent = Math.floor(current);

        }, intervalTime);

    });


    /* =========================================
       LIGHTBOX GALERI
    ========================================= */
    const lightbox = document.getElementById('lightbox');
    const lightboxImg = document.getElementById('lightboxImg');
    const lightboxCaption = document.getElementById('lightboxCaption');
    const lightboxClose = document.getElementById('lightboxClose');

    const galleryItems = document.querySelectorAll('[data-lightbox]');

    galleryItems.forEach(function (item) {

        item.addEventListener('click', function () {

            const image = item.dataset.src;
            const caption = item.dataset.caption || '';

            if (lightbox && lightboxImg) {

                lightboxImg.src = image;
                lightboxImg.alt = caption;

                if (lightboxCaption) {
                    lightboxCaption.textContent = caption;
                }

                lightbox.classList.add('active');

                document.body.style.overflow = 'hidden';
            }

        });

    });


    function closeLightbox() {

        if (lightbox) {
            lightbox.classList.remove('active');
        }

        document.body.style.overflow = '';

    }


    if (lightboxClose) {
        lightboxClose.addEventListener('click', closeLightbox);
    }


    if (lightbox) {
        lightbox.addEventListener('click', function (event) {

            if (event.target === lightbox) {
                closeLightbox();
            }

        });
    }


    /* =========================================
       ESC UNTUK MENUTUP LIGHTBOX
    ========================================= */
    document.addEventListener('keydown', function (event) {

        if (event.key === 'Escape') {
            closeLightbox();
        }

    });


    /* =========================================
       SEARCH GURU
    ========================================= */
    const searchGuru = document.getElementById('searchGuru');
    const tableGuru = document.getElementById('tableGuru');

    if (searchGuru && tableGuru) {

        searchGuru.addEventListener('input', function () {

            const keyword = searchGuru.value.toLowerCase();
            const rows = tableGuru.querySelectorAll('tbody tr');

            rows.forEach(function (row) {

                const text = row.textContent.toLowerCase();

                if (text.includes(keyword)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }

            });

        });

    }


    /* =========================================
       BACK TO TOP
    ========================================= */
    const backToTop = document.getElementById('backToTop');

    if (backToTop) {

        window.addEventListener('scroll', function () {

            if (window.scrollY > 300) {
                backToTop.classList.add('show');
            } else {
                backToTop.classList.remove('show');
            }

        });


        backToTop.addEventListener('click', function () {

            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });

        });

    }


    /* =========================================
       ANIMASI CARD SAAT MUNCUL
    ========================================= */
    const animatedElements = document.querySelectorAll(
        '.news-card, .ekskul-card, .gallery-item, .jurusan-card, .fasilitas-card, .stat-card, kepsek-card'
    );

    if ('IntersectionObserver' in window) {

        const observer = new IntersectionObserver(function (entries) {

            entries.forEach(function (entry) {

                if (entry.isIntersecting) {
                    entry.target.classList.add('show');
                    observer.unobserve(entry.target);
                }

            });

        }, {
            threshold: 0.1
        });

        animatedElements.forEach(function (element) {
            element.classList.add('animate');
            observer.observe(element);
        });

    }

});