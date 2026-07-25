import IMask from "imask";

document.addEventListener("DOMContentLoaded", () => {
    const splash = document.getElementById("splash");
    const page = document.getElementById("page")!;
    const menuBtn = document.getElementById("menu-btn");
    const closeNavBtn = document.getElementById("close-nav-btn");
    const sideNav = document.getElementById("side-nav");
    const navOverlay = document.getElementById("nav-overlay");
    const navLinks = document.querySelectorAll<HTMLElement>(".nav-link");
    const modal = document.getElementById(
        "prayer-modal",
    ) as HTMLDialogElement | null;
    const prayerForm = document.getElementById(
        "prayer-form",
    ) as HTMLFormElement | null;
    const submitBtn = document.getElementById(
        "submit-btn",
    ) as HTMLButtonElement | null;
    const submitText = document.getElementById("submit-text");
    const submitSpinner = document.getElementById("submit-spinner");
    const textarea = document.getElementById(
        "modal-message",
    ) as HTMLTextAreaElement | null;
    const charCount = document.getElementById("char-count");
    const step1 = document.getElementById("modal-step-1");
    const step2 = document.getElementById("modal-step-2");
    const continueBtn = document.getElementById("step-1-continue");
    const backBtn = document.getElementById("step-2-back");
    const nameInput = document.getElementById(
        "modal-name",
    ) as HTMLInputElement | null;
    const step2NameDisplay = document.getElementById("step-2-name-display");
    const whatsappInput = document.getElementById(
        "modal-whatsapp",
    ) as HTMLInputElement | null;
    const emailInput = document.getElementById(
        "modal-email",
    ) as HTMLInputElement | null;
    const stepDot1 = document.getElementById("step-dot-1");
    const stepDot2 = document.getElementById("step-dot-2");
    const stepLabel = document.getElementById("step-label");

    const clearStep1Errors = (): void => {
        const errors = document.querySelectorAll(
            "#modal-step-1 .welcome-form-error",
        );
        errors.forEach((el) => el.classList.add("hidden"));
    };

    const clearDescriptionError = (): void => {
        const err = document.getElementById("description-error");
        if (err) err.classList.add("hidden");
    };

    let whatsappMask: ReturnType<typeof IMask> | null = null;

    if (whatsappInput) {
        whatsappMask = IMask(whatsappInput, { mask: "+{55} (00) 00000-0000" });
        whatsappInput.addEventListener("input", () => {
            const error = document.getElementById("whatsapp-error");
            if (error && whatsappMask?.masked.isComplete)
                error.classList.add("hidden");
        });
    }

    if (emailInput) {
        const emailError = document.getElementById("email-error");
        const validateEmail = (): boolean => {
            const value = emailInput.value.trim();
            const valid = /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(value);
            if (emailError) {
                emailError.classList.toggle("hidden", valid || !value);
            }
            return valid;
        };
        emailInput.addEventListener("input", () => {
            emailInput.value = emailInput.value
                .replace(/\s/g, "")
                .toLowerCase();
            validateEmail();
        });
    }

    const toggleMobileNav = (open: boolean): void => {
        if (!sideNav || !navOverlay) return;
        sideNav.classList.toggle("open", open);
        navOverlay.classList.toggle("open", open);
        if (menuBtn) menuBtn.setAttribute("aria-expanded", String(open));
        document.body.style.overflow = open ? "hidden" : "";
    };

    const closeMobileNav = (): void => {
        toggleMobileNav(false);
    };
    (window as unknown as { closeMobileNav: () => void }).closeMobileNav =
        closeMobileNav;

    if (menuBtn) {
        menuBtn.addEventListener("click", () => {
            toggleMobileNav(true);
        });
    }
    if (closeNavBtn) closeNavBtn.addEventListener("click", closeMobileNav);
    if (navOverlay) navOverlay.addEventListener("click", closeMobileNav);

    navLinks.forEach((link: HTMLElement) => {
        link.addEventListener("click", closeMobileNav);
    });

    document.addEventListener("keydown", (e: KeyboardEvent) => {
        if (
            e.key === "Escape" &&
            sideNav &&
            sideNav.classList.contains("open")
        ) {
            closeMobileNav();
        }
    });

    const updateStepIndicator = (activeStep: number): void => {
        if (!stepDot1 || !stepDot2 || !stepLabel) return;
        stepDot1.classList.toggle("welcome-step-dot-active", activeStep === 1);
        stepDot2.classList.toggle("welcome-step-dot-active", activeStep === 2);
        stepLabel.textContent = `Passo ${activeStep} de 2`;
    };

    const goToStep = (toStep: number): void => {
        if (!step1 || !step2) return;
        const goingForward = toStep === 2;

        step1.classList.toggle("hidden", goingForward);
        step2.classList.toggle("hidden", !goingForward);

        step1.classList.remove(
            "welcome-modal-step-enter",
            "welcome-modal-step-enter-active",
            "welcome-modal-step-leave",
        );
        step2.classList.remove(
            "welcome-modal-step-enter",
            "welcome-modal-step-enter-active",
            "welcome-modal-step-leave",
        );

        if (goingForward) {
            step1.classList.add("welcome-modal-step-leave");
            step2.classList.add("welcome-modal-step-enter");
            requestAnimationFrame(() => {
                step2.classList.add("welcome-modal-step-enter-active");
            });
        } else {
            clearStep1Errors();
            clearDescriptionError();
        }

        updateStepIndicator(toStep);
    };

    if (continueBtn && step2NameDisplay && nameInput) {
        continueBtn.addEventListener("click", () => {
            const whatsappError = document.getElementById("whatsapp-error");
            const emailError = document.getElementById("email-error");
            const whatsappValue = whatsappInput?.value.trim() || "";
            const emailValue = emailInput?.value.trim() || "";
            const emailValid = /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(emailValue);
            let hasError = false;

            if (!whatsappMask?.masked.isComplete) {
                if (whatsappError) {
                    whatsappError.classList.remove("hidden");
                    hasError = true;
                }
            } else {
                if (whatsappError) whatsappError.classList.add("hidden");
            }

            if (!emailValid) {
                if (emailError) {
                    emailError.classList.remove("hidden");
                    hasError = true;
                }
            } else {
                if (emailError) emailError.classList.add("hidden");
            }

            if (hasError) return;

            step2NameDisplay.textContent = nameInput.value.trim() || "Anônimo";
            goToStep(2);
        });
    }

    if (backBtn) {
        backBtn.addEventListener("click", () => goToStep(1));
    }

    if (modal) {
        modal.addEventListener("click", (e: MouseEvent) => {
            const target = e.target as HTMLElement;
            if (target.closest("select")) return;
            const rect = (
                modal.querySelector(".modal-content") as HTMLElement
            ).getBoundingClientRect();
            const isInDialog =
                rect.top <= e.clientY &&
                e.clientY <= rect.top + rect.height &&
                rect.left <= e.clientX &&
                e.clientX <= rect.left + rect.width;
            if (!isInDialog) modal.close();
        });
        modal.addEventListener("close", () => {
            document.body.style.overflow = "";
            goToStep(1);
        });
        modal.addEventListener("open", () => {
            document.body.style.overflow = "hidden";
            goToStep(1);
        });
    }

    setTimeout(() => {
        if (splash) {
            splash.classList.add("splash-hide");
            setTimeout(() => {
                splash.style.display = "none";
                page.classList.add("page-show");
                initRevealObserver();
            }, 400);
        } else {
            page.classList.add("page-show");
            initRevealObserver();
        }
    }, 800);

    const initRevealObserver = (): void => {
        const reveals = document.querySelectorAll<HTMLElement>(".reveal");
        if (!("IntersectionObserver" in window)) {
            reveals.forEach((el: HTMLElement) => {
                el.classList.add("visible");
            });
            return;
        }
        const observer = new IntersectionObserver(
            (entries: IntersectionObserverEntry[]) => {
                entries.forEach((entry: IntersectionObserverEntry) => {
                    if (entry.isIntersecting) {
                        (entry.target as HTMLElement).classList.add("visible");
                        observer.unobserve(entry.target);
                    }
                });
            },
            { threshold: 0.08, rootMargin: "0px 0px -40px 0px" },
        );
        reveals.forEach((el: HTMLElement) => {
            observer.observe(el);
        });
    };

    if (prayerForm) {
        prayerForm.addEventListener("keydown", (e: KeyboardEvent) => {
            if (e.key === "Enter") {
                const step1 = document.getElementById("modal-step-1");
                if (step1 && !step1.classList.contains("hidden")) {
                    e.preventDefault();
                    const continueBtn =
                        document.getElementById("step-1-continue");
                    if (continueBtn) continueBtn.click();
                }
            }
        });
    }

    if (prayerForm && submitBtn) {
        const descriptionError = document.getElementById("description-error");
        prayerForm.addEventListener("submit", (e) => {
            if (!textarea?.value.trim()) {
                e.preventDefault();
                if (descriptionError)
                    descriptionError.classList.remove("hidden");
                return;
            }
            submitBtn.disabled = true;
            if (submitText) submitText.classList.add("hidden");
            if (submitSpinner) submitSpinner.classList.remove("hidden");
        });
    }

    if (textarea && charCount) {
        const descriptionError = document.getElementById("description-error");
        textarea.addEventListener("input", () => {
            charCount.textContent = textarea.value.length + " / 2000";
            if (descriptionError && textarea.value.trim()) {
                descriptionError.classList.add("hidden");
            }
        });
    }

    const initScrollSpy = (): void => {
        const sections = document.querySelectorAll<HTMLElement>("section[id]");
        const sidebarLinks = document.querySelectorAll<HTMLElement>(
            '.sidebar a[href^="#"]',
        );
        const mobileLinks = document.querySelectorAll(
            '.welcome-mobile-nav-links a[href^="#"]',
        );

        console.log(mobileLinks);

        if (!sections.length || !sidebarLinks.length) return;

        const observer = new IntersectionObserver(
            (entries: IntersectionObserverEntry[]) => {
                entries.forEach((entry: IntersectionObserverEntry) => {
                    if (entry.isIntersecting) {
                        const id = entry.target.getAttribute("id");

                        sidebarLinks.forEach((link: HTMLElement) => {
                            const href = link.getAttribute("href");
                            link.classList.toggle(
                                "nav-link-active",
                                href === "#" + id,
                            );
                        });

                        mobileLinks.forEach((link: HTMLElement) => {
                            const href = link.getAttribute("href");
                            link.classList.toggle(
                                "nav-link-active",
                                href === "#" + id,
                            );
                        });
                    }
                });
            },
            { threshold: 0.2, rootMargin: "-80px 0px -40% 0px" },
        );

        sections.forEach((section: HTMLElement) => {
            observer.observe(section);
        });
    };

    if (
        document.querySelector(".sidebar") ||
        document.querySelector(".welcome-mobile-nav-links")
    ) {
        initScrollSpy();
    }
});
