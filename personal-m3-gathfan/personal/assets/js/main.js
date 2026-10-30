/* ==========================================================
   main.js — interaksi laman personal (vanilla JS, tanpa library)
   1. Mode gelap/terang (localStorage)
   2. Menu hamburger (mobile)
   3. Reveal-on-scroll (IntersectionObserver) + menu aktif
   4. Filter kategori portofolio
   5. Modal / lightbox detail portofolio
   6. Validasi formulir kontak
   ========================================================== */
(function () {
  'use strict';

  var root = document.documentElement;
  var THEME_KEY = 'gf-theme';
  var mqReduce = window.matchMedia ? window.matchMedia('(prefers-reduced-motion: reduce)') : null;
  var mqLight = window.matchMedia ? window.matchMedia('(prefers-color-scheme: light)') : null;

  function reducedMotion() { return !!(mqReduce && mqReduce.matches); }

  /* ---------- 1. Mode gelap / terang ---------- */
  var themeBtn = document.getElementById('theme-toggle');

  function readTheme() {
    try { return localStorage.getItem(THEME_KEY); } catch (e) { return null; }
  }
  function saveTheme(value) {
    try { localStorage.setItem(THEME_KEY, value); } catch (e) { /* abaikan */ }
  }
  function effectiveTheme() {
    var attr = root.getAttribute('data-theme');
    if (attr === 'light' || attr === 'dark') { return attr; }
    return 'light';
  }
  function syncThemeButton() {
    if (!themeBtn) { return; }
    var mode = effectiveTheme();
    themeBtn.setAttribute('data-mode', mode);
    var label = mode === 'dark' ? 'Ganti ke mode terang' : 'Ganti ke mode gelap';
    themeBtn.setAttribute('aria-label', label);
    themeBtn.setAttribute('title', label);
  }

  var stored = readTheme();
  if (stored === 'light' || stored === 'dark') {
    root.setAttribute('data-theme', stored);
  } else {
    root.setAttribute('data-theme', 'light');
  }
  syncThemeButton();

  if (themeBtn) {
    themeBtn.addEventListener('click', function () {
      var next = effectiveTheme() === 'dark' ? 'light' : 'dark';
      root.setAttribute('data-theme', next);
      saveTheme(next);
      syncThemeButton();
    });
  }
  if (mqLight) {
    var onSchemeChange = function () { if (!readTheme()) { syncThemeButton(); } };
    if (mqLight.addEventListener) { mqLight.addEventListener('change', onSchemeChange); }
    else if (mqLight.addListener) { mqLight.addListener(onSchemeChange); }
  }

  /* ---------- 2. Menu hamburger ---------- */
  var navToggle = document.getElementById('nav-toggle');
  var navMenu = document.getElementById('nav-menu');
  var header = document.getElementById('site-header');

  function setMenu(open) {
    if (!navToggle || !navMenu) { return; }
    navToggle.setAttribute('aria-expanded', open ? 'true' : 'false');
    navToggle.setAttribute('aria-label', open ? 'Tutup menu navigasi' : 'Buka menu navigasi');
    navMenu.classList.toggle('is-open', open);
  }

  if (navToggle && navMenu) {
    navToggle.addEventListener('click', function () {
      setMenu(navToggle.getAttribute('aria-expanded') !== 'true');
    });
    navMenu.addEventListener('click', function (e) {
      if (e.target.closest('a')) { setMenu(false); }
    });
    document.addEventListener('click', function (e) {
      if (navToggle.getAttribute('aria-expanded') === 'true' && header && !header.contains(e.target)) {
        setMenu(false);
      }
    });
    document.addEventListener('keydown', function (e) {
      if (e.key === 'Escape' && navToggle.getAttribute('aria-expanded') === 'true') {
        setMenu(false);
        navToggle.focus();
      }
    });
    window.addEventListener('resize', function () {
      if (window.innerWidth > 980) { setMenu(false); }
    });
  }

  // Bayangan header saat halaman digulir
  function onScroll() {
    if (header) { header.classList.toggle('is-scrolled', window.scrollY > 20); }
  }
  window.addEventListener('scroll', onScroll, { passive: true });
  onScroll();

  /* ---------- 3. Reveal on scroll ---------- */
  var revealEls = document.querySelectorAll('.reveal');

  if (!('IntersectionObserver' in window) || reducedMotion()) {
    revealEls.forEach(function (el) { el.classList.add('is-visible'); });
  } else {
    var revealObserver = new IntersectionObserver(function (entries) {
      entries.forEach(function (entry) {
        if (entry.isIntersecting) {
          entry.target.classList.add('is-visible');
          revealObserver.unobserve(entry.target);
        }
      });
    }, { threshold: 0.12, rootMargin: '0px 0px -40px 0px' });
    revealEls.forEach(function (el) { revealObserver.observe(el); });
  }

  // Tandai menu aktif sesuai bagian yang sedang terlihat
  if ('IntersectionObserver' in window && navMenu) {
    var navLinks = navMenu.querySelectorAll('a[href^="#"]');
    var linkFor = {};
    navLinks.forEach(function (a) { linkFor[a.getAttribute('href').slice(1)] = a; });
    var sectionObserver = new IntersectionObserver(function (entries) {
      entries.forEach(function (entry) {
        if (!entry.isIntersecting) { return; }
        navLinks.forEach(function (a) { a.classList.remove('is-active'); a.removeAttribute('aria-current'); });
        var link = linkFor[entry.target.id];
        if (link) { link.classList.add('is-active'); link.setAttribute('aria-current', 'true'); }
      });
    }, { rootMargin: '-45% 0px -50% 0px' });
    Object.keys(linkFor).forEach(function (id) {
      var sec = document.getElementById(id);
      if (sec) { sectionObserver.observe(sec); }
    });
  }

  /* ---------- 4. Filter portofolio ---------- */
  var filterBtns = document.querySelectorAll('.filter-btn');
  var cards = document.querySelectorAll('.porto-card');
  var filterStatus = document.getElementById('filter-status');

  function applyFilter(category) {
    var shown = 0;
    cards.forEach(function (card) {
      var match = category === 'all' || card.getAttribute('data-category') === category;
      card.hidden = !match;
      card.classList.remove('is-filtering-in');
      if (match) {
        shown += 1;
        card.classList.add('is-visible');
        if (!reducedMotion()) {
          void card.offsetWidth; // restart animasi
          card.classList.add('is-filtering-in');
        }
      }
    });
    if (filterStatus) { filterStatus.textContent = 'Menampilkan ' + shown + ' proyek.'; }
  }

  filterBtns.forEach(function (btn) {
    btn.addEventListener('click', function () {
      filterBtns.forEach(function (b) {
        var active = b === btn;
        b.classList.toggle('is-active', active);
        b.setAttribute('aria-pressed', active ? 'true' : 'false');
      });
      applyFilter(btn.getAttribute('data-filter'));
    });
  });

  /* ---------- 5. Modal / lightbox portofolio ---------- */
  var modal = document.getElementById('porto-modal');
  var lastFocus = null;
  var closeTimer = null;

  function focusables() {
    return modal.querySelectorAll('button, [href], input, textarea, select, [tabindex]:not([tabindex="-1"])');
  }

  function openModal(card) {
    if (!modal) { return; }
    var img = card.querySelector('.porto-media img');
    var tag = card.querySelector('.tag');
    var title = card.querySelector('h3');
    var modalImg = document.getElementById('modal-img');
    var modalCat = document.getElementById('modal-cat');
    var toolsList = document.getElementById('modal-tools');

    modalImg.src = img ? img.getAttribute('src') : '';
    modalImg.alt = img ? img.getAttribute('alt') : '';
    modalCat.textContent = tag ? tag.textContent : '';
    modalCat.setAttribute('data-cat', card.getAttribute('data-category') || '');
    document.getElementById('modal-title').textContent = title ? title.textContent : '';
    document.getElementById('modal-desc').textContent = card.getAttribute('data-detail') || '';

    toolsList.innerHTML = '';
    (card.getAttribute('data-tools') || '').split(',').forEach(function (tool) {
      tool = tool.trim();
      if (!tool) { return; }
      var li = document.createElement('li');
      li.className = 'chip';
      li.textContent = tool;
      toolsList.appendChild(li);
    });

    clearTimeout(closeTimer);
    lastFocus = document.activeElement;
    modal.hidden = false;
    document.body.classList.add('modal-open');
    requestAnimationFrame(function () {
      requestAnimationFrame(function () { modal.classList.add('is-open'); });
    });
    modal.querySelector('.modal-close').focus();
  }

  function closeModal() {
    if (!modal || modal.hidden) { return; }
    modal.classList.remove('is-open');
    document.body.classList.remove('modal-open');
    closeTimer = setTimeout(function () { modal.hidden = true; }, reducedMotion() ? 0 : 300);
    if (lastFocus && typeof lastFocus.focus === 'function') { lastFocus.focus(); }
  }

  cards.forEach(function (card) {
    card.addEventListener('click', function () { openModal(card); });
  });

  if (modal) {
    modal.addEventListener('click', function (e) {
      if (e.target.closest('[data-close]')) { closeModal(); }
    });
    document.addEventListener('keydown', function (e) {
      if (modal.hidden) { return; }
      if (e.key === 'Escape') { e.preventDefault(); closeModal(); return; }
      if (e.key === 'Tab') {
        var items = focusables();
        if (!items.length) { return; }
        var first = items[0];
        var last = items[items.length - 1];
        if (e.shiftKey && document.activeElement === first) { e.preventDefault(); last.focus(); }
        else if (!e.shiftKey && document.activeElement === last) { e.preventDefault(); first.focus(); }
      }
    });
  }

  /* ---------- 6. Validasi formulir kontak ---------- */
  var form = document.getElementById('contact-form');

  if (form) {
    var successBox = document.getElementById('form-success');
    var emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]{2,}$/;
    var rules = {
      nama: function (v) {
        if (!v) { return 'Nama wajib diisi.'; }
        if (v.length < 3) { return 'Nama minimal 3 karakter.'; }
        return '';
      },
      email: function (v) {
        if (!v) { return 'Email wajib diisi.'; }
        if (!emailPattern.test(v)) { return 'Format email belum benar, contoh: nama@domain.com'; }
        return '';
      },
      pesan: function (v) {
        if (!v) { return 'Pesan wajib diisi.'; }
        if (v.length < 10) { return 'Pesan minimal 10 karakter (sekarang ' + v.length + ').'; }
        return '';
      }
    };

    var validateField = function (field) {
      var rule = rules[field.name];
      if (!rule) { return true; }
      var msg = rule(field.value.trim());
      var errEl = document.getElementById('err-' + field.name);
      if (errEl) { errEl.textContent = msg; }
      if (msg) { field.setAttribute('aria-invalid', 'true'); }
      else { field.removeAttribute('aria-invalid'); }
      return !msg;
    };

    Object.keys(rules).forEach(function (name) {
      var field = form.elements[name];
      if (!field) { return; }
      field.addEventListener('blur', function () { if (field.value.trim() !== '') { validateField(field); } });
      field.addEventListener('input', function () {
        if (field.getAttribute('aria-invalid') === 'true') { validateField(field); }
        if (successBox) { successBox.hidden = true; }
      });
    });

    form.addEventListener('submit', function (e) {
      e.preventDefault(); // tidak ada backend: jangan kirim sungguhan
      var firstInvalid = null;
      Object.keys(rules).forEach(function (name) {
        var field = form.elements[name];
        if (field && !validateField(field) && !firstInvalid) { firstInvalid = field; }
      });
      if (firstInvalid) {
        if (successBox) { successBox.hidden = true; }
        firstInvalid.focus();
        return;
      }
      var nama = form.elements.nama.value.trim();
      form.reset();
      Object.keys(rules).forEach(function (name) {
        var field = form.elements[name];
        if (field) { field.removeAttribute('aria-invalid'); }
        var errEl = document.getElementById('err-' + name);
        if (errEl) { errEl.textContent = ''; }
      });
      if (successBox) {
        successBox.textContent = 'Terima kasih, ' + nama + '! Pesanmu sudah tervalidasi. ' +
          'Karena laman ini belum memiliki backend, pesan tidak benar-benar terkirim — ' +
          'silakan hubungi saya lewat email di samping.';
        successBox.hidden = false;
      }
    });
  }

  /* ---------- Tahun di footer ---------- */
  var yearEl = document.getElementById('tahun');
  if (yearEl) { yearEl.textContent = String(new Date().getFullYear()); }
})();
