<?php require_once __DIR__ . '/identity.php'; ?>
<!DOCTYPE html>
<html lang="id" data-theme="dark">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="Laman personal mahasiswa Informatika Telkom University — backend &amp; cloud enthusiast, ketua kelompok project RSVP.">
  <title><?= htmlspecialchars(MEMBER_NAMA, ENT_QUOTES, 'UTF-8') ?> (<?= htmlspecialchars(MEMBER_NIM, ENT_QUOTES, 'UTF-8') ?>) — ~/personal</title>
  <link rel="icon" href="assets/img/avatar.svg" type="image/svg+xml">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=JetBrains+Mono:wght@400;600;800&family=IBM+Plex+Sans:wght@400;500;600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="assets/css/style.css">
  <script>
    /* Terapkan tema tersimpan sebelum render agar tidak berkedip. */
    (function () {
      document.documentElement.classList.add('js');
      try {
        var t = localStorage.getItem('m0-theme');
        if (t === 'light' || t === 'dark') { document.documentElement.setAttribute('data-theme', t); }
      } catch (e) { /* localStorage tidak tersedia */ }
    })();
  </script>
  <script src="assets/js/main.js" defer></script>
</head>
<body>
<?php include __DIR__ . '/app/partials/served_by.php'; ?>
  <a class="skip-link" href="#main">Lewati ke konten utama</a>

  <header class="site-header">
    <div class="container header-inner">
      <a class="brand" href="#profil" aria-label="Kembali ke profil">
        <span class="brand-prompt" aria-hidden="true">~$</span>
        <span class="brand-name">hasnat<span class="brand-dot">.</span>dev</span>
      </a>

      <button class="nav-toggle" type="button" aria-expanded="false" aria-controls="site-nav" aria-label="Buka menu navigasi">
        <span class="nav-toggle-bar" aria-hidden="true"></span>
        <span class="nav-toggle-bar" aria-hidden="true"></span>
        <span class="nav-toggle-bar" aria-hidden="true"></span>
      </button>

      <nav id="site-nav" class="site-nav" aria-label="Navigasi utama">
        <ul class="nav-list">
          <li><a href="#profil">profil</a></li>
          <li><a href="#riwayat">riwayat</a></li>
          <li><a href="#keahlian">keahlian</a></li>
          <li><a href="#portofolio">portofolio</a></li>
          <li><a href="#rsvp">rsvp</a></li>
          <li><a href="#kontak">kontak</a></li>
          <li><a class="nav-app" href="app/">./app</a></li>
        </ul>
      </nav>

      <button class="theme-toggle" type="button" aria-label="Ganti ke mode terang" title="Ganti tema">
        <svg class="icon-sun" viewBox="0 0 24 24" width="20" height="20" aria-hidden="true" focusable="false"><circle cx="12" cy="12" r="4.5" fill="none" stroke="currentColor" stroke-width="2"/><path d="M12 2v2.5M12 19.5V22M2 12h2.5M19.5 12H22M4.9 4.9l1.8 1.8M17.3 17.3l1.8 1.8M4.9 19.1l1.8-1.8M17.3 6.7l1.8-1.8" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg>
        <svg class="icon-moon" viewBox="0 0 24 24" width="20" height="20" aria-hidden="true" focusable="false"><path d="M20 14.5A8 8 0 0 1 9.5 4a8 8 0 1 0 10.5 10.5z" fill="none" stroke="currentColor" stroke-width="2" stroke-linejoin="round"/></svg>
      </button>
    </div>
  </header>

  <main id="main">
    <!-- ===================== PROFIL / HERO ===================== -->
    <section id="profil" class="hero" aria-labelledby="hero-title">
      <div class="container hero-grid">
        <div class="hero-text reveal">
          <p class="eyebrow"><span aria-hidden="true">// </span>route: m0 · ketua kelompok</p>
          <h1 id="hero-title" class="hero-title"><?= htmlspecialchars(MEMBER_NAMA, ENT_QUOTES, 'UTF-8') ?></h1>
          <p class="hero-nim">NIM <span class="mono-accent"><?= htmlspecialchars(MEMBER_NIM, ENT_QUOTES, 'UTF-8') ?></span> · S1 Informatika, Telkom University</p>

          <div class="terminal" role="group" aria-label="Terminal perkenalan">
            <div class="terminal-bar" aria-hidden="true">
              <span class="dot dot-r"></span><span class="dot dot-y"></span><span class="dot dot-g"></span>
              <span class="terminal-title">hasnat@cloud: ~</span>
            </div>
            <div class="terminal-body">
              <p class="term-line"><span class="term-prompt" aria-hidden="true">hasnat@cloud:~$</span> <span class="term-cmd">cat role.txt</span></p>
              <p class="term-line term-out">
                <span class="sr-only">Backend &amp; cloud enthusiast, ketua kelompok project RSVP.</span>
                <span class="typing" aria-hidden="true" data-phrases='["backend &amp; cloud enthusiast","ketua kelompok project RSVP","build → deploy → monitor → repeat"]'>backend &amp; cloud enthusiast</span><span class="caret" aria-hidden="true"></span>
              </p>
            </div>
          </div>

          <!-- GANTI: sesuaikan deskripsi diri -->
          <p class="hero-desc">
            Mahasiswa Informatika angkatan 2024 yang senang merancang <em>backend</em>, menata server, dan
            membuat aplikasi tetap hidup saat diakses banyak orang. Di Tugas 1 Komputasi Awan saya menjadi
            koordinator repo dan ketua kelompok untuk aplikasi RSVP acara.
          </p>

          <div class="hero-actions">
            <a class="btn btn-primary" href="#portofolio">./lihat-portofolio</a>
            <a class="btn btn-ghost" href="app/">Buka Aplikasi RSVP</a>
          </div>
        </div>

        <div class="hero-visual reveal">
          <figure class="avatar-card">
            <img src="assets/img/avatar.svg" width="240" height="240" alt="Avatar bergaya terminal dengan inisial HF">
            <figcaption>
              <span class="status-dot" aria-hidden="true"></span> status: <strong>online</strong> · Bandung <!-- GANTI -->
            </figcaption>
          </figure>
          <dl class="stat-list">
            <div><dt>semester</dt><dd>5</dd></div>
            <div><dt>angkatan</dt><dd>2024</dd></div>
            <div><dt>fokus</dt><dd>cloud</dd></div>
          </dl>
        </div>
      </div>
    </section>

    <!-- ===================== PENDIDIKAN & PENGALAMAN ===================== -->
    <section id="riwayat" class="section" aria-labelledby="riwayat-title">
      <div class="container">
        <h2 id="riwayat-title" class="section-title reveal"><span class="hash" aria-hidden="true">#</span> pendidikan &amp; pengalaman</h2>

        <div class="two-col">
          <div class="reveal">
            <h3 class="col-title">$ ls ./pendidikan</h3>
            <ol class="timeline">
              <li class="timeline-item">
                <span class="timeline-time">2024 — sekarang</span>
                <h4>Telkom University</h4>
                <p>S1 Informatika. Fokus minat: komputasi awan, sistem terdistribusi, dan pengembangan <em>backend</em>.</p>
              </li>
              <li class="timeline-item">
                <span class="timeline-time">2021 — 2024</span> <!-- GANTI -->
                <h4>SMA Negeri — (ganti)</h4> <!-- GANTI -->
                <p>Jurusan MIPA. Aktif di ekstrakurikuler komputer dan klub robotik sekolah.</p> <!-- GANTI -->
              </li>
            </ol>
          </div>

          <div class="reveal">
            <h3 class="col-title">$ ls ./pengalaman</h3>
            <ol class="timeline">
              <li class="timeline-item">
                <span class="timeline-time">2026 · Tugas 1 Komputasi Awan</span>
                <h4>Ketua Kelompok — Project Aplikasi RSVP</h4>
                <p>Mengoordinasikan repo kelompok, membagi rute m0–m4, dan menyusun aplikasi RSVP acara bersama berbasis PHP &amp; MySQL di XAMPP.</p>
              </li>
              <li class="timeline-item">
                <span class="timeline-time">2025</span> <!-- GANTI -->
                <h4>Divisi IT — Panitia Seminar Teknologi Fakultas</h4> <!-- GANTI -->
                <p>Membangun dan memelihara web pendaftaran peserta serta membantu operasional jaringan saat acara.</p> <!-- GANTI -->
              </li>
              <li class="timeline-item">
                <span class="timeline-time">2025 — sekarang</span> <!-- GANTI -->
                <h4>Anggota Komunitas Cloud &amp; DevOps Kampus</h4> <!-- GANTI -->
                <p>Ikut sesi belajar rutin tentang Linux, Docker, dan deployment ke layanan cloud.</p> <!-- GANTI -->
              </li>
            </ol>
          </div>
        </div>
      </div>
    </section>

    <!-- ===================== KEAHLIAN ===================== -->
    <section id="keahlian" class="section section-alt" aria-labelledby="keahlian-title">
      <div class="container">
        <h2 id="keahlian-title" class="section-title reveal"><span class="hash" aria-hidden="true">#</span> keahlian</h2>

        <div class="two-col">
          <div class="card reveal">
            <h3 class="col-title">teknis</h3>
            <!-- GANTI: sesuaikan level keahlian -->
            <ul class="skill-list">
              <li class="skill">
                <div class="skill-head"><span>PHP &amp; MySQL</span><span class="skill-val">80%</span></div>
                <div class="skill-track" role="progressbar" aria-label="PHP dan MySQL" aria-valuemin="0" aria-valuemax="100" aria-valuenow="80"><span class="skill-fill" style="--lvl:80%"></span></div>
              </li>
              <li class="skill">
                <div class="skill-head"><span>Linux &amp; Shell</span><span class="skill-val">75%</span></div>
                <div class="skill-track" role="progressbar" aria-label="Linux dan Shell" aria-valuemin="0" aria-valuemax="100" aria-valuenow="75"><span class="skill-fill" style="--lvl:75%"></span></div>
              </li>
              <li class="skill">
                <div class="skill-head"><span>Docker &amp; Deployment</span><span class="skill-val">65%</span></div>
                <div class="skill-track" role="progressbar" aria-label="Docker dan Deployment" aria-valuemin="0" aria-valuemax="100" aria-valuenow="65"><span class="skill-fill" style="--lvl:65%"></span></div>
              </li>
              <li class="skill">
                <div class="skill-head"><span>REST API Design</span><span class="skill-val">70%</span></div>
                <div class="skill-track" role="progressbar" aria-label="REST API Design" aria-valuemin="0" aria-valuemax="100" aria-valuenow="70"><span class="skill-fill" style="--lvl:70%"></span></div>
              </li>
              <li class="skill">
                <div class="skill-head"><span>Git &amp; GitHub</span><span class="skill-val">85%</span></div>
                <div class="skill-track" role="progressbar" aria-label="Git dan GitHub" aria-valuemin="0" aria-valuemax="100" aria-valuenow="85"><span class="skill-fill" style="--lvl:85%"></span></div>
              </li>
            </ul>
          </div>

          <div class="card reveal">
            <h3 class="col-title">non-teknis</h3>
            <ul class="chip-list">
              <li class="chip">kepemimpinan tim</li>
              <li class="chip">koordinasi proyek</li>
              <li class="chip">komunikasi</li>
              <li class="chip">manajemen waktu</li>
              <li class="chip">problem solving</li>
              <li class="chip">dokumentasi</li>
            </ul>
            <h3 class="col-title col-title-gap">tools</h3>
            <ul class="chip-list chip-list-alt">
              <li class="chip">XAMPP</li>
              <li class="chip">VS Code</li>
              <li class="chip">Postman</li>
              <li class="chip">Nginx</li>
              <li class="chip">Python</li>
              <li class="chip">Figma</li>
            </ul>
          </div>
        </div>
      </div>
    </section>

    <!-- ===================== PORTOFOLIO ===================== -->
    <section id="portofolio" class="section" aria-labelledby="porto-title">
      <div class="container">
        <h2 id="porto-title" class="section-title reveal"><span class="hash" aria-hidden="true">#</span> portofolio</h2>

        <div class="filter-bar reveal" role="group" aria-label="Filter kategori portofolio">
          <button type="button" class="filter-btn is-active" data-filter="all" aria-pressed="true">--all</button>
          <button type="button" class="filter-btn" data-filter="cloud" aria-pressed="false">--cloud</button>
          <button type="button" class="filter-btn" data-filter="backend" aria-pressed="false">--backend</button>
          <button type="button" class="filter-btn" data-filter="web" aria-pressed="false">--web</button>
          <button type="button" class="filter-btn" data-filter="data" aria-pressed="false">--data</button>
        </div>
        <p class="filter-status sr-only" aria-live="polite"></p>

        <!-- GANTI: sesuaikan daftar proyek -->
        <div class="porto-grid">
          <article class="porto-card reveal" data-category="cloud"
                   data-title="Aplikasi RSVP Kelompok (Komputasi Awan)"
                   data-img="assets/img/portfolio-1.svg"
                   data-detail="Aplikasi pendaftaran acara (RSVP) yang dikerjakan bersama 5 anggota kelompok. Setiap anggota menjalankan laman personal di server lokal masing-masing, sementara aplikasi bersama memakai satu basis data. Saya bertanggung jawab atas struktur repo, partial bersama, dan integrasi."
                   data-tech="PHP · MySQL · XAMPP · Git">
            <button type="button" class="porto-thumb" aria-label="Lihat detail: Aplikasi RSVP Kelompok">
              <img src="assets/img/portfolio-1.svg" width="480" height="300" alt="Ilustrasi kalender dengan tanda centang di samping awan" loading="lazy">
            </button>
            <div class="porto-body">
              <span class="tag">cloud</span>
              <h3>Aplikasi RSVP Kelompok (Komputasi Awan)</h3>
              <p>Aplikasi RSVP acara bersama kelompok dengan kuota peserta dan ringkasan acara.</p>
              <button type="button" class="link-btn porto-open">detail →</button>
            </div>
          </article>

          <article class="porto-card reveal" data-category="backend"
                   data-title="REST API Peminjaman Ruang"
                   data-img="assets/img/portfolio-2.svg"
                   data-detail="API sederhana untuk mengelola peminjaman ruang kelas: daftar ruang, pengajuan, dan persetujuan. Dilengkapi validasi input dan respons JSON yang konsisten. Proyek mata kuliah Pemrograman Web."
                   data-tech="PHP · MySQL · Postman">
            <button type="button" class="porto-thumb" aria-label="Lihat detail: REST API Peminjaman Ruang">
              <img src="assets/img/portfolio-2.svg" width="480" height="300" alt="Ilustrasi daftar endpoint API GET, POST, dan PUT" loading="lazy">
            </button>
            <div class="porto-body">
              <span class="tag">backend</span>
              <h3>REST API Peminjaman Ruang</h3>
              <p>Endpoint CRUD untuk peminjaman ruang kelas dengan respons JSON.</p>
              <button type="button" class="link-btn porto-open">detail →</button>
            </div>
          </article>

          <article class="porto-card reveal" data-category="cloud"
                   data-title="Dashboard Monitoring Server Mini"
                   data-img="assets/img/portfolio-3.svg"
                   data-detail="Dashboard ringan yang menampilkan penggunaan CPU, memori, dan status layanan dari beberapa VM latihan. Data diambil berkala lewat skrip shell dan ditampilkan sebagai grafik garis."
                   data-tech="Bash · Python · Chart sederhana">
            <button type="button" class="porto-thumb" aria-label="Lihat detail: Dashboard Monitoring Server Mini">
              <img src="assets/img/portfolio-3.svg" width="480" height="300" alt="Ilustrasi grafik penggunaan CPU server" loading="lazy">
            </button>
            <div class="porto-body">
              <span class="tag">cloud</span>
              <h3>Dashboard Monitoring Server Mini</h3>
              <p>Memantau CPU, memori, dan status layanan beberapa VM latihan.</p>
              <button type="button" class="link-btn porto-open">detail →</button>
            </div>
          </article>

          <article class="porto-card reveal" data-category="web"
                   data-title="Website Kepanitiaan Seminar"
                   data-img="assets/img/portfolio-4.svg"
                   data-detail="Website informasi dan pendaftaran untuk seminar teknologi tingkat fakultas: jadwal, pembicara, dan formulir pendaftaran. Dibuat responsif agar nyaman dibuka dari ponsel peserta."
                   data-tech="HTML · CSS · JavaScript">
            <button type="button" class="porto-thumb" aria-label="Lihat detail: Website Kepanitiaan Seminar">
              <img src="assets/img/portfolio-4.svg" width="480" height="300" alt="Ilustrasi jendela browser berisi halaman acara" loading="lazy">
            </button>
            <div class="porto-body">
              <span class="tag">web</span>
              <h3>Website Kepanitiaan Seminar</h3>
              <p>Laman acara responsif dengan jadwal, pembicara, dan pendaftaran.</p>
              <button type="button" class="link-btn porto-open">detail →</button>
            </div>
          </article>

          <article class="porto-card reveal" data-category="data"
                   data-title="Analisis Log Akses Web Server"
                   data-img="assets/img/portfolio-5.svg"
                   data-detail="Skrip untuk membaca access log Apache, menghitung jumlah request per jam, dan menandai kode status error. Hasilnya dipakai untuk melihat jam sibuk dan halaman yang sering gagal dimuat."
                   data-tech="Python · Pandas · Apache log">
            <button type="button" class="porto-thumb" aria-label="Lihat detail: Analisis Log Akses Web Server">
              <img src="assets/img/portfolio-5.svg" width="480" height="300" alt="Ilustrasi diagram batang jumlah request per jam" loading="lazy">
            </button>
            <div class="porto-body">
              <span class="tag">data</span>
              <h3>Analisis Log Akses Web Server</h3>
              <p>Mengolah access log Apache menjadi statistik request per jam.</p>
              <button type="button" class="link-btn porto-open">detail →</button>
            </div>
          </article>
        </div>
      </div>
    </section>

    <!-- ===================== RSVP ===================== -->
    <section id="rsvp" class="section section-alt" aria-labelledby="rsvp-title">
      <div class="container">
        <h2 id="rsvp-title" class="section-title reveal"><span class="hash" aria-hidden="true">#</span> Acara Kelompok (RSVP)</h2>
        <p class="section-lead reveal">Berikut acara yang sedang dibuka di aplikasi RSVP kelompok kami. Data diambil langsung dari basis data aplikasi bersama.</p>
        <div class="rsvp-wrap reveal">
<?php include __DIR__ . '/app/partials/ringkasan.php'; ?>
        </div>
        <p class="rsvp-cta reveal"><a class="btn btn-primary" href="app/">Buka Aplikasi RSVP</a></p>
      </div>
    </section>

    <!-- ===================== KONTAK ===================== -->
    <section id="kontak" class="section" aria-labelledby="kontak-title">
      <div class="container">
        <h2 id="kontak-title" class="section-title reveal"><span class="hash" aria-hidden="true">#</span> kontak</h2>

        <div class="two-col">
          <div class="card reveal">
            <h3 class="col-title">$ cat kontak.json</h3>
            <ul class="contact-list">
              <!-- GANTI dengan akun asli -->
              <li><span class="key">"email"</span>: <a href="mailto:hasnat@example.com">hasnat@example.com</a></li> <!-- GANTI -->
              <li><span class="key">"github"</span>: <a href="https://github.com/username" target="_blank" rel="noopener noreferrer">github.com/username</a></li> <!-- GANTI dengan akun asli -->
              <li><span class="key">"linkedin"</span>: <a href="https://www.linkedin.com/in/username" target="_blank" rel="noopener noreferrer">linkedin.com/in/username</a></li> <!-- GANTI dengan akun asli -->
              <li><span class="key">"instagram"</span>: <a href="https://www.instagram.com/username" target="_blank" rel="noopener noreferrer">instagram.com/username</a></li> <!-- GANTI dengan akun asli -->
            </ul>
            <p class="muted">Terbuka untuk diskusi seputar cloud, backend, atau kolaborasi proyek kampus.</p>
          </div>

          <div class="card reveal">
            <h3 class="col-title">$ ./kirim-pesan</h3>
            <form id="contact-form" class="contact-form" action="#" method="post" novalidate>
              <div class="field">
                <label for="f-nama">nama</label>
                <input id="f-nama" name="nama" type="text" autocomplete="name" aria-describedby="err-nama" required>
                <p id="err-nama" class="field-error" aria-live="polite"></p>
              </div>
              <div class="field">
                <label for="f-email">email</label>
                <input id="f-email" name="email" type="email" autocomplete="email" aria-describedby="err-email" required>
                <p id="err-email" class="field-error" aria-live="polite"></p>
              </div>
              <div class="field">
                <label for="f-pesan">pesan</label>
                <textarea id="f-pesan" name="pesan" rows="5" aria-describedby="err-pesan" required></textarea>
                <p id="err-pesan" class="field-error" aria-live="polite"></p>
              </div>
              <button type="submit" class="btn btn-primary">kirim --pesan</button>
              <p class="form-success" role="status" aria-live="polite"></p>
            </form>
          </div>
        </div>
      </div>
    </section>
  </main>

  <footer class="site-footer">
    <div class="container footer-inner">
      <p>&copy; <span id="year">2026</span> <?= htmlspecialchars(MEMBER_NAMA, ENT_QUOTES, 'UTF-8') ?> · NIM <?= htmlspecialchars(MEMBER_NIM, ENT_QUOTES, 'UTF-8') ?></p>
      <p class="muted">Komputasi Awan dan Terdistribusi · Tugas 1 · <a href="app/">./app</a> · <a href="#profil">↑ ke atas</a></p>
    </div>
  </footer>

  <!-- Modal detail portofolio -->
  <dialog id="porto-modal" class="modal" aria-labelledby="modal-title">
    <div class="modal-inner">
      <div class="modal-bar">
        <span class="dot dot-r" aria-hidden="true"></span><span class="dot dot-y" aria-hidden="true"></span><span class="dot dot-g" aria-hidden="true"></span>
        <button type="button" class="modal-close" aria-label="Tutup detail">×</button>
      </div>
      <img class="modal-img" src="assets/img/portfolio-1.svg" width="480" height="300" alt="">
      <div class="modal-body">
        <span class="tag modal-tag">cloud</span>
        <h3 id="modal-title" class="modal-title">Judul</h3>
        <p class="modal-detail"></p>
        <p class="modal-tech mono-accent"></p>
      </div>
    </div>
  </dialog>
</body>
</html>
