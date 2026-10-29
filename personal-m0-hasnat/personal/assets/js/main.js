/* hasnat.dev — interaksi halaman (vanilla JS, tanpa library) */
(function () {
  'use strict';

  var root = document.documentElement;
  root.classList.add('js');
  var reduceMotion = window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches;

  /* ---------- 1. Mode gelap / terang (disimpan di localStorage) ---------- */
  var THEME_KEY = 'm0-theme';
  var themeBtn = document.querySelector('.theme-toggle');

  function applyTheme(theme) {
    root.setAttribute('data-theme', theme);
    if (themeBtn) {
      var label = theme === 'dark' ? 'Ganti ke mode terang' : 'Ganti ke mode gelap';
      themeBtn.setAttribute('aria-label', label);
      themeBtn.setAttribute('title', label);
    }
  }

  var savedTheme = null;
  try { savedTheme = localStorage.getItem(THEME_KEY); } catch (e) { savedTheme = null; }
  applyTheme(savedTheme === 'light' || savedTheme === 'dark' ? savedTheme : (root.getAttribute('data-theme') || 'dark'));

  if (themeBtn) {
    themeBtn.addEventListener('click', function () {
      var next = root.getAttribute('data-theme') === 'dark' ? 'light' : 'dark';
      applyTheme(next);
      try { localStorage.setItem(THEME_KEY, next); } catch (e) { /* abaikan */ }
    });
  }

  /* ---------- 2. Menu hamburger (mobile) ---------- */
  var navToggle = document.querySelector('.nav-toggle');
  var nav = document.getElementById('site-nav');

  function setNav(open) {
    if (!navToggle || !nav) { return; }
    navToggle.setAttribute('aria-expanded', open ? 'true' : 'false');
    navToggle.setAttribute('aria-label', open ? 'Tutup menu navigasi' : 'Buka menu navigasi');
    nav.classList.toggle('is-open', open);
  }

  if (navToggle && nav) {
    navToggle.addEventListener('click', function () {
      setNav(navToggle.getAttribute('aria-expanded') !== 'true');
    });
    nav.addEventListener('click', function (e) {
      if (e.target.closest('a')) { setNav(false); }
    });
    document.addEventListener('keydown', function (e) {
      if (e.key === 'Escape' && nav.classList.contains('is-open')) {
        setNav(false);
        navToggle.focus();
      }
    });
    window.addEventListener('resize', function () {
      if (window.innerWidth > 860) { setNav(false); }
    });
  }

  /* ---------- 3. Efek mengetik di hero ---------- */
  var typingEl = document.querySelector('.typing');
  if (typingEl) {
    var phrases = [];
    try { phrases = JSON.parse(typingEl.getAttribute('data-phrases') || '[]'); } catch (e) { phrases = []; }
    if (!phrases.length) { phrases = [typingEl.textContent]; }

    if (reduceMotion) {
      typingEl.textContent = phrases[0];
    } else {
      var pi = 0, ci = 0, deleting = false;
      typingEl.textContent = '';
      var tick = function () {
        var word = phrases[pi];
        if (!deleting) {
          ci++;
          typingEl.textContent = word.slice(0, ci);
          if (ci === word.length) { deleting = true; return setTimeout(tick, 1800); }
          return setTimeout(tick, 55 + Math.random() * 45);
        }
        ci--;
        typingEl.textContent = word.slice(0, ci);
        if (ci === 0) { deleting = false; pi = (pi + 1) % phrases.length; return setTimeout(tick, 350); }
        return setTimeout(tick, 28);
      };
      setTimeout(tick, 500);
    }
  }

  /* ---------- 4. Reveal on scroll (IntersectionObserver) ---------- */
  var reveals = document.querySelectorAll('.reveal');
  if (reduceMotion || !('IntersectionObserver' in window)) {
    reveals.forEach(function (el) { el.classList.add('is-visible'); });
  } else {
    var io = new IntersectionObserver(function (entries, obs) {
      entries.forEach(function (entry) {
        if (entry.isIntersecting) {
          entry.target.classList.add('is-visible');
          obs.unobserve(entry.target);
        }
      });
    }, { threshold: 0.12, rootMargin: '0px 0px -40px 0px' });
    reveals.forEach(function (el) { io.observe(el); });
  }

  /* Tandai menu aktif sesuai section yang terlihat */
  if ('IntersectionObserver' in window) {
    var navLinks = document.querySelectorAll('.nav-list a[href^="#"]');
    var linkMap = {};
    navLinks.forEach(function (a) { linkMap[a.getAttribute('href').slice(1)] = a; });
    var spy = new IntersectionObserver(function (entries) {
      entries.forEach(function (entry) {
        if (entry.isIntersecting && linkMap[entry.target.id]) {
          navLinks.forEach(function (a) { a.classList.remove('is-current'); a.removeAttribute('aria-current'); });
          linkMap[entry.target.id].classList.add('is-current');
          linkMap[entry.target.id].setAttribute('aria-current', 'true');
        }
      });
    }, { rootMargin: '-45% 0px -50% 0px' });
    document.querySelectorAll('main section[id]').forEach(function (s) { spy.observe(s); });
  }

  /* ---------- 5. Filter kategori portofolio ---------- */
  var filterBtns = document.querySelectorAll('.filter-btn');
  var cards = document.querySelectorAll('.porto-card');
  var filterStatus = document.querySelector('.filter-status');

  filterBtns.forEach(function (btn) {
    btn.addEventListener('click', function () {
      var cat = btn.getAttribute('data-filter');
      filterBtns.forEach(function (b) {
        var active = b === btn;
        b.classList.toggle('is-active', active);
        b.setAttribute('aria-pressed', active ? 'true' : 'false');
      });
      var shown = 0;
      cards.forEach(function (card) {
        var match = cat === 'all' || card.getAttribute('data-category') === cat;
        card.classList.toggle('is-hidden', !match);
        if (match) { shown++; card.classList.add('is-visible'); }
      });
      if (filterStatus) {
        filterStatus.textContent = 'Menampilkan ' + shown + ' proyek' + (cat === 'all' ? '' : ' kategori ' + cat) + '.';
      }
    });
  });

  /* ---------- 6. Modal / lightbox portofolio ---------- */
  var modal = document.getElementById('porto-modal');
  var lastFocus = null;

  function openModal(card) {
    if (!modal) { return; }
    var title = card.getAttribute('data-title') || '';
    var img = modal.querySelector('.modal-img');
    img.src = card.getAttribute('data-img') || '';
    img.alt = 'Ilustrasi proyek ' + title;
    modal.querySelector('.modal-title').textContent = title;
    modal.querySelector('.modal-tag').textContent = card.getAttribute('data-category') || '';
    modal.querySelector('.modal-detail').textContent = card.getAttribute('data-detail') || '';
    modal.querySelector('.modal-tech').textContent = card.getAttribute('data-tech') || '';
    lastFocus = document.activeElement;
    if (typeof modal.showModal === 'function') {
      modal.showModal();
    } else {
      modal.setAttribute('open', '');
    }
    modal.querySelector('.modal-close').focus();
  }

  function closeModal() {
    if (!modal) { return; }
    if (typeof modal.close === 'function') { modal.close(); } else { modal.removeAttribute('open'); }
  }

  cards.forEach(function (card) {
    card.querySelectorAll('.porto-thumb, .porto-open').forEach(function (trigger) {
      trigger.addEventListener('click', function () { openModal(card); });
    });
  });

  if (modal) {
    modal.querySelector('.modal-close').addEventListener('click', closeModal);
    /* klik di luar konten (backdrop) menutup modal */
    modal.addEventListener('click', function (e) {
      if (e.target === modal) { closeModal(); }
    });
    modal.addEventListener('close', function () {
      if (lastFocus && typeof lastFocus.focus === 'function') { lastFocus.focus(); }
    });
  }

  /* ---------- 7. Validasi formulir kontak ---------- */
  var form = document.getElementById('contact-form');
  if (form) {
    var emailRe = /^[^\s@]+@[^\s@]+\.[^\s@]{2,}$/;
    var rules = {
      nama: function (v) {
        if (!v) { return 'Nama wajib diisi.'; }
        if (v.length < 3) { return 'Nama minimal 3 karakter.'; }
        return '';
      },
      email: function (v) {
        if (!v) { return 'Email wajib diisi.'; }
        if (!emailRe.test(v)) { return 'Format email belum valid, contoh: nama@domain.com'; }
        return '';
      },
      pesan: function (v) {
        if (!v) { return 'Pesan wajib diisi.'; }
        if (v.length < 10) { return 'Pesan minimal 10 karakter.'; }
        return '';
      }
    };
    var success = form.querySelector('.form-success');

    var validateField = function (name) {
      var field = form.elements[name];
      var msg = rules[name](field.value.trim());
      var err = document.getElementById('err-' + name);
      err.textContent = msg;
      field.setAttribute('aria-invalid', msg ? 'true' : 'false');
      return !msg;
    };

    Object.keys(rules).forEach(function (name) {
      var field = form.elements[name];
      field.addEventListener('blur', function () { if (field.value) { validateField(name); } });
      field.addEventListener('input', function () {
        if (field.getAttribute('aria-invalid') === 'true') { validateField(name); }
      });
    });

    form.addEventListener('submit', function (e) {
      e.preventDefault(); /* tidak ada backend: jangan kirim sungguhan */
      success.textContent = '';
      var firstInvalid = null;
      Object.keys(rules).forEach(function (name) {
        if (!validateField(name) && !firstInvalid) { firstInvalid = form.elements[name]; }
      });
      if (firstInvalid) { firstInvalid.focus(); return; }

      var nama = form.elements.nama.value.trim();
      form.reset();
      Object.keys(rules).forEach(function (name) { form.elements[name].removeAttribute('aria-invalid'); });
      success.textContent = '> pesan diterima. Terima kasih, ' + nama + '! (demo — tidak ada data yang dikirim)';
    });
  }

  /* ---------- Tahun di footer ---------- */
  var yearEl = document.getElementById('year');
  if (yearEl) { yearEl.textContent = String(new Date().getFullYear()); }
})();
