document.addEventListener('DOMContentLoaded', () => {
    const splash = document.getElementById('splash');
    const page = document.getElementById('page')!;
    const menuBtn = document.getElementById('menu-btn');
    const closeNavBtn = document.getElementById('close-nav-btn');
    const sideNav = document.getElementById('side-nav');
    const navOverlay = document.getElementById('nav-overlay');
    const navLinks = document.querySelectorAll<HTMLElement>('.nav-link');
    const modal = document.getElementById('prayer-modal') as HTMLDialogElement | null;
    const modalDelivery = document.getElementById('modal-delivery') as HTMLSelectElement | null;
    const modalContactFields = document.getElementById('modal-contact-fields');
    const prayerForm = document.getElementById('prayer-form') as HTMLFormElement | null;
    const submitBtn = document.getElementById('submit-btn') as HTMLButtonElement | null;
    const submitText = document.getElementById('submit-text');
    const submitSpinner = document.getElementById('submit-spinner');
    const textarea = document.getElementById('modal-message') as HTMLTextAreaElement | null;
    const charCount = document.getElementById('char-count');

    const toggleMobileNav = (open: boolean): void => {
        if (!sideNav || !navOverlay) return;
        sideNav.classList.toggle('open', open);
        navOverlay.classList.toggle('open', open);
        if (menuBtn) menuBtn.setAttribute('aria-expanded', String(open));
        document.body.style.overflow = open ? 'hidden' : '';
    };

    const closeMobileNav = (): void => { toggleMobileNav(false); };
    (window as unknown as { closeMobileNav: () => void }).closeMobileNav = closeMobileNav;

    if (menuBtn) {
        menuBtn.addEventListener('click', () => { toggleMobileNav(true); });
    }
    if (closeNavBtn) closeNavBtn.addEventListener('click', closeMobileNav);
    if (navOverlay) navOverlay.addEventListener('click', closeMobileNav);

    navLinks.forEach((link: HTMLElement) => {
        link.addEventListener('click', closeMobileNav);
    });

    document.addEventListener('keydown', (e: KeyboardEvent) => {
        if (e.key === 'Escape' && sideNav && sideNav.classList.contains('open')) {
            closeMobileNav();
        }
    });

    const showContactFields = (): void => {
        if (modalContactFields && modalDelivery) {
            modalContactFields.classList.toggle('hidden', modalDelivery.value !== 'recorded');
        }
    };

    if (modalDelivery && modalContactFields) {
        modalDelivery.addEventListener('change', showContactFields);
        showContactFields();
    }

    if (modal) {
        modal.addEventListener('click', (e: MouseEvent) => {
            const rect = (modal.querySelector('.modal-content') as HTMLElement).getBoundingClientRect();
            const isInDialog = rect.top <= e.clientY && e.clientY <= rect.top + rect.height &&
                rect.left <= e.clientX && e.clientX <= rect.left + rect.width;
            if (!isInDialog) modal.close();
        });
        modal.addEventListener('close', () => {
            document.body.style.overflow = '';
        });
        modal.addEventListener('open', () => {
            document.body.style.overflow = 'hidden';
        });
    }

    setTimeout(() => {
        if (splash) {
            splash.classList.add('splash-hide');
            setTimeout(() => {
                splash.style.display = 'none';
                page.classList.add('page-show');
                initRevealObserver();
            }, 400);
        } else {
            page.classList.add('page-show');
            initRevealObserver();
        }
    }, 800);

    const initRevealObserver = (): void => {
        const reveals = document.querySelectorAll<HTMLElement>('.reveal');
        if (!('IntersectionObserver' in window)) {
            reveals.forEach((el: HTMLElement) => { el.classList.add('visible'); });
            return;
        }
        const observer = new IntersectionObserver((entries: IntersectionObserverEntry[]) => {
            entries.forEach((entry: IntersectionObserverEntry) => {
                if (entry.isIntersecting) {
                    (entry.target as HTMLElement).classList.add('visible');
                    observer.unobserve(entry.target);
                }
            });
        }, { threshold: 0.08, rootMargin: '0px 0px -40px 0px' });
        reveals.forEach((el: HTMLElement) => { observer.observe(el); });
    };

    if (prayerForm && submitBtn) {
        prayerForm.addEventListener('submit', () => {
            submitBtn.disabled = true;
            if (submitText) submitText.classList.add('hidden');
            if (submitSpinner) submitSpinner.classList.remove('hidden');
        });
    }

    if (textarea && charCount) {
        textarea.addEventListener('input', () => {
            charCount.textContent = textarea.value.length + ' / 2000';
        });
    }

    const initScrollSpy = (): void => {
        const sections = document.querySelectorAll<HTMLElement>('section[id]');
        const sidebarLinks = document.querySelectorAll<HTMLElement>('.sidebar a[href^="#"]');

        if (!sections.length || !sidebarLinks.length) return;

        const observer = new IntersectionObserver((entries: IntersectionObserverEntry[]) => {
            entries.forEach((entry: IntersectionObserverEntry) => {
                if (entry.isIntersecting) {
                    const id = entry.target.getAttribute('id');
                    sidebarLinks.forEach((link: HTMLElement) => {
                        const href = link.getAttribute('href');
                        link.classList.toggle('nav-link-active', href === '#' + id);
                    });
                }
            });
        }, { threshold: 0.2, rootMargin: '-80px 0px -40% 0px' });

        sections.forEach((section: HTMLElement) => { observer.observe(section); });
    };

    if (document.querySelector('.sidebar')) {
        initScrollSpy();
    }
});
