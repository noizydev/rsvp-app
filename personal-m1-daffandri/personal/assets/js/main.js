/* =========================================================
   main.js — interaksi laman personal (vanilla JS, tanpa library)
   ========================================================= */
(function () {
    'use strict';

    var root = document.documentElement;
    root.classList.add('js');

    var THEME_KEY = 'df-theme';
    var mqDark = window.matchMedia ? window.matchMedia('(prefers-color-scheme: dark)') : null;
    var mqReduce = window.matchMedia ? window.matchMedia('(prefers-reduced-motion: reduce)') : null;
    var reduceMotion = !!(mqReduce && mqReduce.matches);

    function storageGet(key) {
        try { return window.localStorage.getItem(key); } catch (e) { return null; }
    }
    function storageSet(key, value) {
        try { window.localStorage.setItem(key, value); } catch (e) { /* abaikan */ }
    }

    /* ---------- 1. Mode gelap / terang ---------- */
    var themeBtn = document.getElementById('themeToggle');
    var metaTheme = document.querySelector('meta[name="theme-color"]');

    function applyTheme(theme) {
        var dark = theme === 'dark';
        root.setAttribute('data-theme', dark ? 'dark' : 'light');
        if (themeBtn) {
            var label = dark ? 'Ganti ke mode terang' : 'Ganti ke mode gelap';
            themeBtn.setAttribute('aria-pressed', String(dark));
            themeBtn.setAttribute('aria-label', label);
            themeBtn.setAttribute('title', label);
        }
        if (metaTheme) { metaTheme.setAttribute('content', dark ? '#14151C' : '#F3F1EA'); }
    }

    var stored = storageGet(THEME_KEY);
    var initialTheme = (stored === 'dark' || stored === 'light')
        ? stored
        : (mqDark && mqDark.matches ? 'dark' : 'light');
    applyTheme(initialTheme);

    if (themeBtn) {
        themeBtn.addEventListener('click', function () {
            var next = root.getAttribute('data-theme') === 'dark' ? 'light' : 'dark';
            applyTheme(next);
            storageSet(THEME_KEY, next);
        });
    }

    // Ikuti perubahan tema sistem selama pengguna belum memilih sendiri.
    if (mqDark && mqDark.addEventListener) {
        mqDark.addEventListener('change', function (e) {
            var s = storageGet(THEME_KEY);
            if (s !== 'dark' && s !== 'light') { applyTheme(e.matches ? 'dark' : 'light'); }
        });
    }

    /* ---------- 2. Menu hamburger (mobile) ---------- */
    var navToggle = document.querySelector('.nav-toggle');
    var nav = document.getElementById('navMenu');

    function setNav(open) {
        if (!nav || !navToggle) { return; }
        nav.classList.toggle('is-open', open);
        navToggle.setAttribute('aria-expanded', String(open));
        navToggle.setAttribute('aria-label', open ? 'Tutup menu' : 'Buka menu');
    }

    if (nav && navToggle) {
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

        document.addEventListener('click', function (e) {
            if (nav.classList.contains('is-open') && !e.target.closest('.site-header')) {
                setNav(false);
            }
        });

        var mqDesktop = window.matchMedia ? window.matchMedia('(min-width: 901px)') : null;
        if (mqDesktop && mqDesktop.addEventListener) {
            mqDesktop.addEventListener('change', function (e) { if (e.matches) { setNav(false); } });
        }
    }

    /* ---------- 3. Tandai menu aktif saat scroll ---------- */
    var navLinks = nav ? nav.querySelectorAll('a[href^="#"]') : [];
    if ('IntersectionObserver' in window && navLinks.length) {
        var linkById = {};
        Array.prototype.forEach.call(navLinks, function (a) {
            linkById[a.getAttribute('href').slice(1)] = a;
        });
        var sectionObserver = new IntersectionObserver(function (entries) {
            entries.forEach(function (entry) {
                if (!entry.isIntersecting) { return; }
                Array.prototype.forEach.call(navLinks, function (a) { a.removeAttribute('aria-current'); });
                var link = linkById[entry.target.id];
                if (link) { link.setAttribute('aria-current', 'true'); }
            });
        }, { rootMargin: '-45% 0px -50% 0px' });
        Object.keys(linkById).forEach(function (id) {
            var sec = document.getElementById(id);
            if (sec) { sectionObserver.observe(sec); }
        });
    }

    /* ---------- 4. Animasi muncul saat scroll ---------- */
    var revealEls = document.querySelectorAll('.reveal');
    if (!('IntersectionObserver' in window) || reduceMotion) {
        Array.prototype.forEach.call(revealEls, function (el) { el.classList.add('is-visible'); });
    } else {
        var revealObserver = new IntersectionObserver(function (entries, obs) {
            entries.forEach(function (entry) {
                if (entry.isIntersecting) {
                    entry.target.classList.add('is-visible');
                    obs.unobserve(entry.target);
                }
            });
        }, { threshold: 0.12, rootMargin: '0px 0px -40px 0px' });
        Array.prototype.forEach.call(revealEls, function (el) { revealObserver.observe(el); });
    }

    /* ---------- 5. Filter kategori portofolio ---------- */
    var filterBtns = document.querySelectorAll('.filter-btn');
    var cards = document.querySelectorAll('.porto-card');
    var countEl = document.getElementById('portoCount');

    function applyFilter(filter) {
        var shown = 0;
        Array.prototype.forEach.call(cards, function (card) {
            var cats = (card.getAttribute('data-cat') || '').split(/\s+/);
            var match = filter === 'semua' || cats.indexOf(filter) !== -1;
            var wasHidden = card.hidden;
            card.hidden = !match;
            if (match) {
                shown++;
                if (wasHidden && !reduceMotion) {
                    card.classList.remove('pop');
                    void card.offsetWidth; // mulai ulang animasi
                    card.classList.add('pop');
                }
            }
        });
        if (countEl) {
            countEl.textContent = shown === 0
                ? 'Belum ada proyek di kategori ini'
                : 'Menampilkan ' + shown + ' proyek';
        }
    }

    Array.prototype.forEach.call(filterBtns, function (btn) {
        btn.addEventListener('click', function () {
            Array.prototype.forEach.call(filterBtns, function (b) {
                b.setAttribute('aria-pressed', String(b === btn));
            });
            applyFilter(btn.getAttribute('data-filter'));
        });
    });
    Array.prototype.forEach.call(cards, function (card) {
        card.addEventListener('animationend', function () { card.classList.remove('pop'); });
    });

    /* ---------- 6. Modal / lightbox portofolio ---------- */
    var modal = document.getElementById('portoModal');
    var modalImg = document.getElementById('modalImg');
    var modalCat = document.getElementById('modalCat');
    var modalTitle = document.getElementById('modalTitle');
    var modalBody = document.getElementById('modalBody');
    var modalClose = modal ? modal.querySelector('.modal-close') : null;
    var nativeDialog = !!(modal && typeof modal.showModal === 'function');
    var lastFocus = null;

    function openModal(card) {
        if (!modal) { return; }
        var img = card.querySelector('.porto-media img');
        var cat = card.querySelector('.porto-cat');
        var title = card.querySelector('.porto-open');
        var detail = card.querySelector('.porto-detail');

        modalImg.setAttribute('src', img.getAttribute('src'));
        modalImg.setAttribute('alt', img.getAttribute('alt'));
        modalCat.textContent = cat ? cat.textContent : '';
        modalCat.className = 'modal-cat ' + (cat ? (cat.className.match(/sticker-\w+/) || [''])[0] : '');
        modalTitle.textContent = title ? title.textContent : '';
        modalBody.textContent = '';
        if (detail) {
            Array.prototype.forEach.call(detail.childNodes, function (node) {
                modalBody.appendChild(node.cloneNode(true));
            });
        }

        lastFocus = document.activeElement;
        if (nativeDialog) {
            modal.showModal();
        } else {
            modal.setAttribute('open', '');
            modal.classList.add('is-fallback');
        }
        document.body.classList.add('modal-open');
        if (modalClose) { modalClose.focus(); }
    }

    function closeModal() {
        if (!modal || !modal.hasAttribute('open')) { return; }
        if (nativeDialog) {
            modal.close();
        } else {
            modal.removeAttribute('open');
            modal.classList.remove('is-fallback');
            onModalClosed();
        }
    }

    function onModalClosed() {
        document.body.classList.remove('modal-open');
        if (lastFocus && typeof lastFocus.focus === 'function') { lastFocus.focus(); }
    }

    if (modal) {
        Array.prototype.forEach.call(document.querySelectorAll('.porto-open'), function (btn) {
            btn.addEventListener('click', function () { openModal(btn.closest('.porto-card')); });
        });
        if (modalClose) { modalClose.addEventListener('click', closeModal); }
        // Klik di area gelap (backdrop) menutup modal.
        modal.addEventListener('click', function (e) { if (e.target === modal) { closeModal(); } });
        modal.addEventListener('close', onModalClosed);
        if (!nativeDialog) {
            document.addEventListener('keydown', function (e) {
                if (e.key === 'Escape' && modal.hasAttribute('open')) { closeModal(); }
            });
        }
    }

    /* ---------- 7. Validasi formulir kontak ---------- */
    var form = document.getElementById('contactForm');
    var statusEl = document.getElementById('formStatus');
    var pesanCount = document.getElementById('pesanCount');
    var EMAIL_RE = /^[^\s@]+@[^\s@]+\.[^\s@]{2,}$/;

    var validators = {
        nama: function (v) {
            if (!v) { return 'Nama wajib diisi.'; }
            if (v.length < 3) { return 'Nama minimal 3 karakter.'; }
            return '';
        },
        email: function (v) {
            if (!v) { return 'Email wajib diisi.'; }
            if (!EMAIL_RE.test(v)) { return 'Format email belum benar, contoh: nama@contoh.com'; }
            return '';
        },
        pesan: function (v) {
            if (!v) { return 'Pesan wajib diisi.'; }
            if (v.length < 10) { return 'Pesan minimal 10 karakter (sekarang ' + v.length + ').'; }
            if (v.length > 500) { return 'Pesan maksimal 500 karakter.'; }
            return '';
        }
    };

    function setFieldError(name, message) {
        var input = form.elements[name];
        var err = document.getElementById(name + 'Error');
        var field = input.closest('.field');
        input.setAttribute('aria-invalid', message ? 'true' : 'false');
        if (err) { err.textContent = message; }
        if (field) { field.classList.toggle('has-error', !!message); }
    }

    function validateField(name) {
        var value = form.elements[name].value.trim();
        var message = validators[name](value);
        setFieldError(name, message);
        return message;
    }

    function updateCount() {
        if (pesanCount && form) {
            pesanCount.textContent = form.elements.pesan.value.length + '/500';
        }
    }

    if (form) {
        Object.keys(validators).forEach(function (name) {
            var input = form.elements[name];
            input.addEventListener('blur', function () {
                if (input.value.trim() !== '' || input.getAttribute('aria-invalid') === 'true') {
                    validateField(name);
                }
            });
            input.addEventListener('input', function () {
                if (input.getAttribute('aria-invalid') === 'true') { validateField(name); }
                if (statusEl && statusEl.classList.contains('is-success')) {
                    statusEl.textContent = '';
                    statusEl.className = 'form-status';
                }
            });
        });
        form.elements.pesan.addEventListener('input', updateCount);

        form.addEventListener('submit', function (e) {
            e.preventDefault(); // tidak ada backend: jangan kirim sungguhan

            var firstInvalid = null;
            Object.keys(validators).forEach(function (name) {
                if (validateField(name) && !firstInvalid) { firstInvalid = form.elements[name]; }
            });

            if (firstInvalid) {
                statusEl.textContent = 'Masih ada isian yang perlu diperbaiki.';
                statusEl.className = 'form-status is-error';
                firstInvalid.focus();
                return;
            }

            var nama = form.elements.nama.value.trim();
            form.reset();
            Object.keys(validators).forEach(function (name) { setFieldError(name, ''); });
            updateCount();
            statusEl.textContent = 'Terima kasih, ' + nama + '! Pesanmu sudah tercatat. (Simulasi: laman ini belum punya backend, jadi pesan tidak benar-benar dikirim.)';
            statusEl.className = 'form-status is-success';
        });
    }

    /* ---------- 8. Angka statistik dihitung naik saat terlihat ---------- */
    var counters = document.querySelectorAll('[data-count]');
    function runCounter(el) {
        var target = parseInt(el.getAttribute('data-count'), 10) || 0;
        var start = null;
        var DURATION = 1200;
        function step(ts) {
            if (start === null) { start = ts; }
            var t = Math.min(1, (ts - start) / DURATION);
            el.textContent = String(Math.round(target * (1 - Math.pow(1 - t, 3))));
            if (t < 1) { window.requestAnimationFrame(step); }
        }
        window.requestAnimationFrame(step);
    }
    if (counters.length && 'IntersectionObserver' in window && !reduceMotion) {
        var counterObserver = new IntersectionObserver(function (entries, obs) {
            entries.forEach(function (entry) {
                if (entry.isIntersecting) {
                    runCounter(entry.target);
                    obs.unobserve(entry.target);
                }
            });
        }, { threshold: 0.6 });
        Array.prototype.forEach.call(counters, function (el) { counterObserver.observe(el); });
    }

    /* ---------- 9. Tahun di footer ---------- */
    var yearEl = document.getElementById('year');
    if (yearEl) { yearEl.textContent = String(new Date().getFullYear()); }
})();
