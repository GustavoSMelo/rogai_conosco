// donation.ts – selection, reveal, copy, CTA
(() => {
  'use strict';

  const root = document.querySelector('[data-donate-root]');
  if (!root) return;

  const cards = root.querySelectorAll('.donate-amount-card');
  const ctaBtn = root.querySelector('[data-donate-cta]');
  const ctaLabel = ctaBtn ? ctaBtn.querySelector('span') : null;
  const ctaNote = root.querySelector('[data-donate-cta-note]');
  const doneNote = root.querySelector('[data-donate-done]');
  const copyBtn = root.querySelector('[data-donate-copy]');
  const copyFeedback = root.querySelector('[data-donate-copy-feedback]');

  let selectedAmount = null;

  // Selection
  cards.forEach(card => {
    card.addEventListener('click', () => {
      if (card.hasAttribute('disabled')) return;
      cards.forEach(c => c.setAttribute('aria-pressed', 'false'));
      card.setAttribute('aria-pressed', 'true');
      selectedAmount = card.dataset.amount;
      if (ctaBtn) {
        ctaBtn.removeAttribute('disabled');
        ctaBtn.textContent = `Doar R$ ${selectedAmount}`;
      }
    });
  });

  // CTA action
  if (ctaBtn) {
    ctaBtn.addEventListener('click', () => {
      if (!selectedAmount) return;
      ctaBtn.setAttribute('disabled', '');
      if (ctaNote) ctaNote.classList.add('hidden');
      if (doneNote) doneNote.classList.remove('hidden');
      // Optional: toast or analytics
    });
  }

  // Copy link
  if (copyBtn && copyFeedback) {
    copyBtn.addEventListener('click', async () => {
      const url = window.location.href;
      try {
        if (navigator.clipboard && navigator.clipboard.writeText) {
          await navigator.clipboard.writeText(url);
        } else {
          // Fallback
          const textarea = document.createElement('textarea');
          textarea.value = url;
          textarea.style.position = 'fixed';
          textarea.style.left = '-9999px';
          document.body.appendChild(textarea);
          textarea.select();
          document.execCommand('copy');
          document.body.removeChild(textarea);
        }
        copyFeedback.classList.remove('hidden');
        setTimeout(() => copyFeedback.classList.add('hidden'), 2000);
      } catch (err) {
        console.warn('Copy failed', err);
      }
    });
  }

  // Reveal on scroll (respect prefers-reduced-motion)
  const reduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
  const revealEls = root.querySelectorAll('.donate-reveal');
  if (revealEls.length && !reduceMotion) {
    const observer = new IntersectionObserver(
      (entries) => {
        entries.forEach(entry => {
          if (entry.isIntersecting) {
            entry.target.classList.add('donate-visible');
            observer.unobserve(entry.target);
          }
        });
      },
      { threshold: 0.1 }
    );
    revealEls.forEach((el, i) => {
      el.classList.add('donate-reveal');
      // Stagger delay via inline style (could also use CSS nth-child)
      el.style.transitionDelay = `${i * 80}ms`;
      observer.observe(el);
    });
  } else {
    // No animation
    revealEls.forEach(el => el.classList.add('donate-visible'));
  }
})();