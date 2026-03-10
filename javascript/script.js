/**
 * IIBPR Theme — script.js
 *
 * Front-end JS: mobile menu (aria + Esc), sticky header,
 * carousel (touch/swipe/keyboard/autoplay), smooth scroll,
 * active nav highlight, animated counters.
 *
 * Processed by esbuild → ../theme/js/script.min.js
 * See: https://esbuild.github.io/
 */

document.addEventListener('DOMContentLoaded', function () {

  /* ── Mobile menu ── */
  var toggle = document.querySelector('.mobile-menu-toggle');
  var nav    = document.getElementById('site-navigation');
  if (toggle && nav) {
    toggle.addEventListener('click', function () {
      var isOpen = nav.classList.toggle('open');
      toggle.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
    });
    document.addEventListener('click', function (e) {
      if (!toggle.contains(e.target) && !nav.contains(e.target)) {
        nav.classList.remove('open');
        toggle.setAttribute('aria-expanded', 'false');
      }
    });
    document.addEventListener('keydown', function (e) {
      if (e.key === 'Escape' && nav.classList.contains('open')) {
        nav.classList.remove('open');
        toggle.setAttribute('aria-expanded', 'false');
        toggle.focus();
      }
    });
  }

  /* ── Sticky header shadow ── */
  var header = document.getElementById('masthead');
  if (header) {
    window.addEventListener('scroll', function () {
      header.classList.toggle('scrolled', window.scrollY > 10);
    }, { passive: true });
  }

  /* ── Universal Carousel ── */
  document.querySelectorAll('.carousel-wrapper').forEach(function (wrapper) {
    var track   = wrapper.querySelector('.carousel-track');
    var prevBtn = wrapper.querySelector('.carousel-btn-prev');
    var nextBtn = wrapper.querySelector('.carousel-btn-next');
    var dots    = wrapper.querySelectorAll('.carousel-dot');
    var current = 0;
    var total   = wrapper.querySelectorAll('.carousel-slide').length;
    var timer   = null;

    if (!track || total === 0) return;

    function goTo(idx) {
      current = (idx + total) % total;
      track.style.transform = 'translateX(-' + (current * 100) + '%)';
      dots.forEach(function (d, i) {
        d.classList.toggle('bg-purple-600', i === current);
        d.classList.toggle('bg-gray-300',   i !== current);
        d.setAttribute('aria-selected', String(i === current));
      });
    }

    if (prevBtn) prevBtn.addEventListener('click', function () { goTo(current - 1); });
    if (nextBtn) nextBtn.addEventListener('click', function () { goTo(current + 1); });
    dots.forEach(function (d, i) { d.addEventListener('click', function () { goTo(i); }); });

    wrapper.setAttribute('tabindex', '0');
    wrapper.addEventListener('keydown', function (e) {
      if (e.key === 'ArrowLeft')  goTo(current - 1);
      if (e.key === 'ArrowRight') goTo(current + 1);
    });

    var touchX = 0;
    wrapper.addEventListener('touchstart', function (e) { touchX = e.changedTouches[0].screenX; }, { passive: true });
    wrapper.addEventListener('touchend',   function (e) {
      var diff = touchX - e.changedTouches[0].screenX;
      if (Math.abs(diff) > 40) goTo(diff > 0 ? current + 1 : current - 1);
    }, { passive: true });

    var interval = wrapper.dataset.autoplay ? parseInt(wrapper.dataset.autoplay) : 0;
    if (interval > 0) {
      function startTimer() { timer = setInterval(function () { goTo(current + 1); }, interval); }
      startTimer();
      wrapper.addEventListener('mouseenter', function () { clearInterval(timer); });
      wrapper.addEventListener('mouseleave', startTimer);
    }
    goTo(0);
  });

  /* ── Smooth scroll ── */
  document.querySelectorAll('a[href^="#"]').forEach(function (a) {
    a.addEventListener('click', function (e) {
      var target = document.querySelector(this.getAttribute('href'));
      if (target) {
        e.preventDefault();
        target.scrollIntoView({ behavior: 'smooth', block: 'start' });
        if (nav && toggle) { nav.classList.remove('open'); toggle.setAttribute('aria-expanded', 'false'); }
      }
    });
  });

  /* ── Active nav on scroll ── */
  var sections = document.querySelectorAll('section[id]');
  var navLinks = document.querySelectorAll('#primary-menu a[href^="#"]');
  if (sections.length && navLinks.length) {
    window.addEventListener('scroll', function () {
      var pos = window.scrollY + 100;
      sections.forEach(function (s) {
        if (s.offsetTop <= pos && s.offsetTop + s.offsetHeight > pos) {
          navLinks.forEach(function (l) { l.classList.toggle('active', l.getAttribute('href') === '#' + s.id); });
        }
      });
    }, { passive: true });
  }

  /* ── Animated counters ── */
  var counters = document.querySelectorAll('.counter-animate');
  if (counters.length && 'IntersectionObserver' in window) {
    var obs = new IntersectionObserver(function (entries) {
      entries.forEach(function (entry) {
        if (!entry.isIntersecting) return;
        var el = entry.target;
        var max = parseInt(el.dataset.target, 10);
        var sfx = el.dataset.suffix || '';
        var pfx = el.dataset.prefix || '';
        var n = 0; var step = Math.max(1, Math.ceil(max / 88));
        var iv = setInterval(function () {
          n = Math.min(n + step, max);
          el.textContent = pfx + n + sfx;
          if (n >= max) clearInterval(iv);
        }, 16);
        obs.unobserve(el);
      });
    }, { threshold: 0.4 });
    counters.forEach(function (c) { obs.observe(c); });
  }

});
