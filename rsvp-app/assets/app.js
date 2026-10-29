// Aplikasi bersama RSVP — validasi form sisi klien, menu mobile,
// penghitung karakter, dan pembaruan sisa kuota lewat AJAX.
// Catatan: validasi sisi server (PHP) tetap berjalan walau validasi ini dilewati.
(function () {
  'use strict';

  var EMAIL_RE = /^[^\s@]+@[^\s@]+\.[^\s@]{2,}$/;

  // ---------- Menu mobile ----------
  var toggle = document.querySelector('.nav-toggle');
  var nav = document.getElementById('app-nav');
  if (toggle && nav) {
    toggle.addEventListener('click', function () {
      var open = nav.classList.toggle('is-open');
      toggle.setAttribute('aria-expanded', open ? 'true' : 'false');
    });
    nav.addEventListener('click', function (ev) {
      if (ev.target.tagName === 'A') {
        nav.classList.remove('is-open');
        toggle.setAttribute('aria-expanded', 'false');
      }
    });
  }

  // ---------- Validasi form ----------
  var rules = {
    acara_id: function (v) { return v ? '' : 'Pilih acara yang ingin diikuti.'; },
    nama: function (v) { return v.length >= 2 && v.length <= 100 ? '' : 'Nama wajib diisi, 2–100 karakter.'; },
    email: function (v) { return v.length <= 150 && EMAIL_RE.test(v) ? '' : 'Masukkan alamat email yang valid.'; },
    instansi: function (v) { return v.length <= 100 ? '' : 'Instansi maksimal 100 karakter.'; },
    judul: function (v) { return v.length >= 3 && v.length <= 150 ? '' : 'Judul wajib diisi, 3–150 karakter.'; },
    lokasi: function (v) { return v.length >= 3 && v.length <= 150 ? '' : 'Lokasi wajib diisi, 3–150 karakter.'; },
    deskripsi: function (v) { return v.length >= 10 && v.length <= 1000 ? '' : 'Deskripsi wajib diisi, 10–1000 karakter.'; },
    kuota: function (v) {
      var n = Number(v);
      return Number.isInteger(n) && n >= 1 && n <= 1000 ? '' : 'Kuota berupa angka 1–1000.';
    },
    waktu_mulai: function (v) {
      if (!v) return 'Tanggal dan jam wajib diisi.';
      var t = new Date(v);
      if (isNaN(t.getTime())) return 'Tanggal dan jam tidak valid.';
      return t > new Date() ? '' : 'Waktu acara harus di masa depan.';
    }
  };

  function showError(field, message) {
    var box = document.getElementById('err-' + field.name);
    field.setAttribute('aria-invalid', message ? 'true' : 'false');
    if (box) {
      box.textContent = message;
      box.hidden = !message;
    }
  }

  function check(field) {
    var rule = rules[field.name];
    if (!rule) return true;
    var msg = rule(field.value.trim());
    if (!msg && field.name === 'acara_id') {
      var opt = field.options[field.selectedIndex];
      if (opt && opt.dataset.sisa === '0') msg = 'Kuota acara ini sudah penuh.';
    }
    showError(field, msg);
    return !msg;
  }

  document.querySelectorAll('form[data-validate]').forEach(function (form) {
    var fields = Array.prototype.filter.call(form.elements, function (el) { return rules[el.name]; });

    fields.forEach(function (field) {
      field.addEventListener('blur', function () { check(field); });
      field.addEventListener('input', function () {
        if (field.getAttribute('aria-invalid') === 'true') check(field);
      });
    });

    form.addEventListener('submit', function (ev) {
      var firstInvalid = null;
      fields.forEach(function (field) {
        if (!check(field) && !firstInvalid) firstInvalid = field;
      });
      if (firstInvalid) {
        ev.preventDefault();
        firstInvalid.focus();
        return;
      }
      var btn = form.querySelector('button[type="submit"]');
      if (btn) {
        btn.disabled = true;
        btn.textContent = 'Mengirim…';
      }
    });
  });

  // ---------- Penghitung karakter & batas tanggal ----------
  document.querySelectorAll('[data-counter-for]').forEach(function (counter) {
    var input = document.getElementById(counter.getAttribute('data-counter-for'));
    if (!input) return;
    var max = input.getAttribute('maxlength');
    var update = function () { counter.textContent = input.value.length + '/' + max; };
    input.addEventListener('input', update);
    update();
  });

  var waktu = document.getElementById('waktu_mulai');
  if (waktu) {
    var now = new Date(Date.now() - new Date().getTimezoneOffset() * 60000);
    waktu.min = now.toISOString().slice(0, 16);
  }

  // ---------- Sisa kuota real-time (AJAX polling) ----------
  var status = document.getElementById('live-status');
  var POLL_MS = 10000;

  function applyKuota(data) {
    data.acara.forEach(function (a) {
      document.querySelectorAll('[data-acara-id="' + a.id + '"]').forEach(function (el) {
        var sisaEl = el.querySelector('[data-sisa]');
        if (sisaEl) {
          var lama = sisaEl.querySelector('strong');
          if (lama && lama.textContent !== String(a.sisa)) {
            sisaEl.classList.remove('flash-update');
            void sisaEl.offsetWidth;
            sisaEl.classList.add('flash-update');
          }
          sisaEl.innerHTML = '';
          sisaEl.append('Sisa ');
          var strong = document.createElement('strong');
          strong.textContent = a.sisa;
          sisaEl.append(strong, ' dari ' + a.kuota + ' kursi');
        }
        var bar = el.querySelector('[data-bar]');
        if (bar) bar.style.width = a.persen + '%';

        if (el.classList.contains('card') && el.dataset.selesai !== '1') {
          var penuh = a.sisa === 0;
          el.classList.toggle('status-penuh', penuh);
          el.classList.toggle('status-buka', !penuh);
          var badge = el.querySelector('[data-badge]');
          if (badge) badge.textContent = penuh ? 'Penuh' : 'Dibuka';
          var link = el.querySelector('[data-daftar-link]');
          if (link) {
            link.classList.toggle('is-disabled', penuh);
            link.textContent = penuh ? 'Lihat detail' : 'Daftar sekarang';
          }
        }
      });

      var opt = document.querySelector('#acara_id option[value="' + a.id + '"]');
      if (opt) {
        opt.dataset.sisa = String(a.sisa);
        opt.disabled = a.sisa === 0;
        opt.textContent = opt.textContent.replace(/— (penuh|sisa \d+)\s*$/, '— ' + (a.sisa === 0 ? 'penuh' : 'sisa ' + a.sisa));
      }
    });
  }

  function poll() {
    if (document.hidden || !window.fetch) return;
    fetch('api/kuota.php', { headers: { 'Accept': 'application/json' }, cache: 'no-store' })
      .then(function (res) { return res.json(); })
      .then(function (data) {
        if (!data.ok) throw new Error(data.error || 'gagal');
        applyKuota(data);
        if (status) {
          status.textContent = 'Kuota diperbarui ' + data.waktu + ' oleh server ' + data.served_by.route + '.';
        }
      })
      .catch(function () {
        if (status) status.textContent = 'Gagal memperbarui kuota, mencoba lagi…';
      });
  }

  if (document.querySelector('[data-acara-id]')) {
    setInterval(poll, POLL_MS);
    document.addEventListener('visibilitychange', function () { if (!document.hidden) poll(); });
  }
})();
