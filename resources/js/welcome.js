document.addEventListener('DOMContentLoaded', function () {
    var splash = document.getElementById('splash');
    var page = document.getElementById('page');
    var menuBtn = document.getElementById('menu-btn');
    var closeNavBtn = document.getElementById('close-nav-btn');
    var sideNav = document.getElementById('side-nav');
    var navOverlay = document.getElementById('nav-overlay');
    var navLinks = document.querySelectorAll('.nav-link');
    var modal = document.getElementById('prayer-modal');
    var modalDelivery = document.getElementById('modal-delivery');
    var modalContactFields = document.getElementById('modal-contact-fields');

    function toggleMobileNav(open) {
        if (!sideNav || !navOverlay) return;
        sideNav.classList.toggle('open', open);
        navOverlay.classList.toggle('open', open);
        if (menuBtn) menuBtn.setAttribute('aria-expanded', open);
        document.body.style.overflow = open ? 'hidden' : '';
    }

    function closeMobileNav() { toggleMobileNav(false); }
    window.closeMobileNav = closeMobileNav;

    if (menuBtn) {
        menuBtn.addEventListener('click', function () { toggleMobileNav(true); });
    }
    if (closeNavBtn) closeNavBtn.addEventListener('click', closeMobileNav);
    if (navOverlay) navOverlay.addEventListener('click', closeMobileNav);

    navLinks.forEach(function (link) {
        link.addEventListener('click', closeMobileNav);
    });

    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape' && sideNav && sideNav.classList.contains('open')) {
            closeMobileNav();
        }
    });

    function showContactFields() {
        if (modalContactFields && modalDelivery) {
            modalContactFields.classList.toggle('hidden', modalDelivery.value !== 'recorded');
        }
    }

    if (modalDelivery && modalContactFields) {
        modalDelivery.addEventListener('change', showContactFields);
        showContactFields();
    }

    if (modal) {
        modal.addEventListener('click', function (e) {
            var rect = modal.querySelector('.modal-content').getBoundingClientRect();
            var isInDialog = rect.top <= e.clientY && e.clientY <= rect.top + rect.height &&
                rect.left <= e.clientX && e.clientX <= rect.left + rect.width;
            if (!isInDialog) modal.close();
        });
        modal.addEventListener('close', function () {
            document.body.style.overflow = '';
        });
        modal.addEventListener('open', function () {
            document.body.style.overflow = 'hidden';
        });
    }

    setTimeout(function () {
        if (splash) {
            splash.classList.add('splash-hide');
            setTimeout(function () {
                splash.style.display = 'none';
                page.classList.add('page-show');
                initRevealObserver();
            }, 400);
        } else {
            page.classList.add('page-show');
            initRevealObserver();
        }
    }, 800);

    function initRevealObserver() {
        var reveals = document.querySelectorAll('.reveal');
        if (!('IntersectionObserver' in window)) {
            reveals.forEach(function (el) { el.classList.add('visible'); });
            return;
        }
        var observer = new IntersectionObserver(function (entries) {
            entries.forEach(function (entry) {
                if (entry.isIntersecting) {
                    entry.target.classList.add('visible');
                    observer.unobserve(entry.target);
                }
            });
        }, { threshold: 0.08, rootMargin: '0px 0px -40px 0px' });
        reveals.forEach(function (el) { observer.observe(el); });
    }

    var prayerForm = document.getElementById('prayer-form');
    var submitBtn = document.getElementById('submit-btn');
    var submitText = document.getElementById('submit-text');
    var submitSpinner = document.getElementById('submit-spinner');
    var textarea = document.getElementById('modal-message');
    var charCount = document.getElementById('char-count');

    if (prayerForm && submitBtn) {
        prayerForm.addEventListener('submit', function () {
            submitBtn.disabled = true;
            submitText.classList.add('hidden');
            submitSpinner.classList.remove('hidden');
        });
    }

    if (textarea && charCount) {
        textarea.addEventListener('input', function () {
            charCount.textContent = textarea.value.length + ' / 2000';
        });
    }

    function initScrollSpy() {
        var sections = document.querySelectorAll('section[id]');
        var sidebarLinks = document.querySelectorAll('.sidebar a[href^="#"]');

        if (!sections.length || !sidebarLinks.length) return;

        var observer = new IntersectionObserver(function (entries) {
            entries.forEach(function (entry) {
                if (entry.isIntersecting) {
                    var id = entry.target.getAttribute('id');
                    sidebarLinks.forEach(function (link) {
                        var href = link.getAttribute('href');
                        link.classList.toggle('nav-link-active', href === '#' + id);
                    });
                }
            });
        }, { threshold: 0.2, rootMargin: '-80px 0px -40% 0px' });

        sections.forEach(function (section) { observer.observe(section); });
    }

    if (document.querySelector('.sidebar')) {
        initScrollSpy();
    }
});
