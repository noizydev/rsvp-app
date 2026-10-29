/* Laman pribadi Faqih — interaksi (vanilla JS, tanpa pustaka) */
(function () {
  'use strict';

  var root = document.documentElement;
  var THEME_KEY = 'faqih-theme';
  var reduceMotion = window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches;

  /* ---------- 1. Mode gelap / terang (disimpan di localStorage) ---------- */
  var themeBtn = document.querySelector('.theme-toggle');
  var themeLabel = themeBtn ? themeBtn.querySelector('.theme-label') : null;
  var darkQuery = window.matchMedia ? window.matchMedia('(prefers-color-scheme: dark)') : null;

  function currentTheme() {
    var set = root.getAttribute('data-theme');
    if (set === 'dark' || set === 'light') return set;
    return darkQuery && darkQuery.matches ? 'dark' : 'light';
  }

  function syncThemeButton() {
    if (!themeBtn) return;
    var isDark = currentTheme() === 'dark';
    themeBtn.setAttribute('aria-pressed', isDark ? 'true' : 'false');
    themeBtn.setAttribute('aria-label', isDark ? 'Ganti ke mode terang' : 'Ganti ke mode gelap');
    if (themeLabel) themeLabel.textContent = isDark ? 'Mode terang' : 'Mode gelap';
  }

  if (themeBtn) {
    themeBtn.addEventListener('click', function () {
      var next = currentTheme() === 'dark' ? 'light' : 'dark';
      root.setAttribute('data-theme', next);
      try { localStorage.setItem(THEME_KEY, next); } catch (e) { /* penyimpanan tidak tersedia */ }
      syncThemeButton();
    });
  }
  if (darkQuery) {
    var onScheme = function () { syncThemeButton(); };
    if (darkQuery.addEventListener) darkQuery.addEventListener('change', onScheme);
    else if (darkQuery.addListener) darkQuery.addListener(onScheme);
  }
  syncThemeButton();

  /* ---------- 2. Menu hamburger (mobile) ---------- */
  var navToggle = document.querySelector('.nav-toggle');
  var sideMenu = document.getElementById('side-menu');

  function setMenu(open) {
    if (!navToggle || !sideMenu) return;
    sideMenu.classList.toggle('is-open', open);
    navToggle.setAttribute('aria-expanded', open ? 'true' : 'false');
    navToggle.setAttribute('aria-label', open ? 'Tutup menu navigasi' : 'Buka menu navigasi');
  }

  if (navToggle && sideMenu) {
    navToggle.addEventListener('click', function () {
      setMenu(navToggle.getAttribute('aria-expanded') !== 'true');
    });
    sideMenu.addEventListener('click', function (e) {
      if (e.target.closest('a')) setMenu(false);
    });
    document.addEventListener('keydown', function (e) {
      if (e.key === 'Escape' && navToggle.getAttribute('aria-expanded') === 'true') {
        setMenu(false);
        navToggle.focus();
      }
    });
    window.addEventListener('resize', function () {
      if (window.innerWidth > 900) setMenu(false);
    });
  }

  /* ---------- 3. Animasi muncul saat gulir + penanda menu aktif ---------- */
  var reveals = document.querySelectorAll('.reveal');
  if ('IntersectionObserver' in window && !reduceMotion) {
    var revealObs = new IntersectionObserver(function (entries) {
      entries.forEach(function (entry) {
        if (entry.isIntersecting) {
          entry.target.classList.add('is-visible');
          revealObs.unobserve(entry.target);
        }
      });
    }, { threshold: 0.12, rootMargin: '0px 0px -40px 0px' });
    reveals.forEach(function (el) { revealObs.observe(el); });
  } else {
    reveals.forEach(function (el) { el.classList.add('is-visible'); });
  }

  var navLinks = document.querySelectorAll('.side-nav a[href^="#"]');
  if ('IntersectionObserver' in window && navLinks.length) {
    var linkById = {};
    navLinks.forEach(function (a) { linkById[a.getAttribute('href').slice(1)] = a; });
    var spyObs = new IntersectionObserver(function (entries) {
      entries.forEach(function (entry) {
        if (!entry.isIntersecting) return;
        var link = linkById[entry.target.id];
        if (!link) return;
        navLinks.forEach(function (a) { a.classList.remove('is-current'); a.removeAttribute('aria-current'); });
        link.classList.add('is-current');
        link.setAttribute('aria-current', 'location');
      });
    }, { rootMargin: '-45% 0px -50% 0px' });
    document.querySelectorAll('main section[id]').forEach(function (s) { spyObs.observe(s); });
  }

  /* ---------- 4. Filter kategori portofolio ---------- */
  var filterBtns = document.querySelectorAll('.filter-btn');
  var portoItems = document.querySelectorAll('.porto-item');
  var portoEmpty = document.querySelector('.porto-empty');

  filterBtns.forEach(function (btn) {
    btn.addEventListener('click', function () {
      var cat = btn.getAttribute('data-filter');
      var shown = 0;
      filterBtns.forEach(function (b) {
        var active = b === btn;
        b.classList.toggle('is-active', active);
        b.setAttribute('aria-pressed', active ? 'true' : 'false');
      });
      portoItems.forEach(function (item) {
        var match = cat === 'semua' || item.getAttribute('data-category') === cat;
        item.hidden = !match;
        if (match) {
          shown++;
          item.classList.add('is-visible');
        }
      });
      if (portoEmpty) portoEmpty.hidden = shown > 0;
    });
  });

  /* ---------- 5. Lightbox / modal portofolio ---------- */
  var lightbox = document.getElementById('lightbox');
  var lastTrigger = null;

  function openLightbox(item, trigger) {
    if (!lightbox) return;
    var img = item.querySelector('img');
    var lbImg = lightbox.querySelector('.lb-img');
    lbImg.src = img.getAttribute('src');
    lbImg.alt = img.getAttribute('alt');
    lightbox.querySelector('.lb-cat').textContent = item.querySelector('.porto-cat').textContent;
    lightbox.querySelector('.lb-title').textContent = item.querySelector('.porto-title').textContent;
    var detail = item.querySelector('.porto-detail');
    lightbox.querySelector('.lb-desc').innerHTML = detail ? detail.innerHTML : '';
    lastTrigger = trigger;
    if (typeof lightbox.showModal === 'function') {
      lightbox.showModal();
    } else {
      lightbox.setAttribute('open', '');
    }
    lightbox.querySelector('.lb-close').focus();
  }

  function closeLightbox() {
    if (!lightbox) return;
    if (typeof lightbox.close === 'function' && lightbox.open) {
      lightbox.close();
    } else {
      lightbox.removeAttribute('open');
      if (lastTrigger) lastTrigger.focus();
    }
  }

  document.querySelectorAll('.porto-card').forEach(function (card) {
    card.addEventListener('click', function () {
      openLightbox(card.closest('.porto-item'), card);
    });
  });

  if (lightbox) {
    lightbox.querySelector('.lb-close').addEventListener('click', closeLightbox);
    lightbox.addEventListener('click', function (e) {
      if (e.target === lightbox) closeLightbox(); // klik di luar kotak
    });
    lightbox.addEventListener('close', function () {
      if (lastTrigger) lastTrigger.focus();
    });
    document.addEventListener('keydown', function (e) {
      if (e.key === 'Escape' && lightbox.hasAttribute('open')) closeLightbox();
    });
  }

  /* ---------- 6. Validasi formulir kontak ---------- */
  var form = document.getElementById('contact-form');
  if (form) {
    var successMsg = form.querySelector('.form-success');
    var emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]{2,}$/;

    var rules = {
      nama: function (v) {
        if (!v) return 'Nama wajib diisi.';
        if (v.length < 3) return 'Nama minimal 3 karakter.';
        return '';
      },
      email: function (v) {
        if (!v) return 'Email wajib diisi.';
        if (!emailPattern.test(v)) return 'Format email belum benar, contoh: nama@domain.com.';
        return '';
      },
      pesan: function (v) {
        if (!v) return 'Pesan wajib diisi.';
        if (v.length < 10) return 'Pesan minimal 10 karakter.';
        return '';
      }
    };

    function validateField(name) {
      var input = form.elements[name];
      var msg = rules[name](input.value.trim());
      var field = input.closest('.field');
      var errEl = document.getElementById('err-' + name);
      field.classList.toggle('has-error', !!msg);
      input.setAttribute('aria-invalid', msg ? 'true' : 'false');
      errEl.textContent = msg;
      return !msg;
    }

    Object.keys(rules).forEach(function (name) {
      var input = form.elements[name];
      input.addEventListener('blur', function () {
        if (input.value.trim() !== '') validateField(name);
      });
      input.addEventListener('input', function () {
        if (input.closest('.field').classList.contains('has-error')) validateField(name);
        if (successMsg) successMsg.hidden = true;
      });
    });

    form.addEventListener('submit', function (e) {
      e.preventDefault(); // tidak ada backend: jangan kirim sungguhan
      var firstInvalid = null;
      Object.keys(rules).forEach(function (name) {
        if (!validateField(name) && !firstInvalid) firstInvalid = form.elements[name];
      });
      if (firstInvalid) {
        firstInvalid.focus();
        return;
      }
      var nama = form.elements.nama.value.trim();
      form.reset();
      Object.keys(rules).forEach(function (name) {
        form.elements[name].removeAttribute('aria-invalid');
      });
      if (successMsg) {
        successMsg.textContent = 'Terima kasih, ' + nama + '! Pesan Anda sudah tercatat. Saya akan membalas lewat email secepatnya.';
        successMsg.hidden = false;
      }
    });
  }

  /* ---------- Tahun di footer ---------- */
  var tahun = document.getElementById('tahun');
  if (tahun) tahun.textContent = String(new Date().getFullYear());
})();
