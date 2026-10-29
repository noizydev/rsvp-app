<?php require_once __DIR__ . '/identity.php'; ?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?= htmlspecialchars(MEMBER_NAMA) ?> (<?= htmlspecialchars(MEMBER_NIM) ?>) — Laman Pribadi</title>
  <meta name="description" content="Laman pribadi <?= htmlspecialchars(MEMBER_NAMA) ?>, mahasiswa S1 Informatika Telkom University yang menekuni jaringan dan infrastruktur cloud.">
  <script>
    /* Pasang tema tersimpan sebelum CSS dirender agar tidak berkedip */
    document.documentElement.className += ' js';
    try {
      var t = localStorage.getItem('faqih-theme');
      if (t === 'dark' || t === 'light') { document.documentElement.setAttribute('data-theme', t); }
    } catch (e) {}
  </script>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Lora:ital,wght@0,500;0,600;0,700;1,500&family=Nunito:wght@400;600;700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="assets/css/style.css">
  <link rel="icon" href="assets/img/avatar.svg" type="image/svg+xml">
</head>
<body>
<?php include __DIR__ . '/app/partials/served_by.php'; ?>
<a class="skip-link" href="#konten">Lewati ke konten utama</a>

<div class="page">
  <!-- ========== SIDEBAR (desktop) / TOP BAR (mobile) ========== -->
  <header class="sidebar">
    <div class="side-top">
      <a class="side-brand" href="#profil">
        <img class="side-avatar" src="assets/img/avatar.svg" alt="Avatar <?= htmlspecialchars(MEMBER_NAMA) ?>" width="120" height="120">
        <span class="side-id">
          <span class="side-name"><?= htmlspecialchars(MEMBER_NAMA) ?></span>
          <span class="side-nim">NIM <?= htmlspecialchars(MEMBER_NIM) ?></span>
        </span>
      </a>
      <button class="nav-toggle" type="button" aria-expanded="false" aria-controls="side-menu" aria-label="Buka menu navigasi">
        <span class="nav-toggle-bar" aria-hidden="true"></span>
      </button>
    </div>

    <div class="side-menu" id="side-menu">
      <p class="side-tag">Jaringan &amp; Infrastruktur Cloud</p>
      <nav aria-label="Navigasi utama">
        <ul class="side-nav">
          <li><a href="#profil"><span class="nav-num">01</span>Profil</a></li>
          <li><a href="#pendidikan"><span class="nav-num">02</span>Pendidikan</a></li>
          <li><a href="#pengalaman"><span class="nav-num">03</span>Pengalaman</a></li>
          <li><a href="#keahlian"><span class="nav-num">04</span>Keahlian</a></li>
          <li><a href="#portofolio"><span class="nav-num">05</span>Portofolio</a></li>
          <li><a href="#rsvp"><span class="nav-num">06</span>Acara (RSVP)</a></li>
          <li><a href="#kontak"><span class="nav-num">07</span>Kontak</a></li>
          <li><a class="nav-app" href="app/"><span class="nav-num" aria-hidden="true">&#8599;</span>Aplikasi RSVP</a></li>
        </ul>
      </nav>
      <button class="theme-toggle" type="button" aria-pressed="false">
        <span class="theme-icon" aria-hidden="true"></span>
        <span class="theme-label">Mode gelap</span>
      </button>
      <p class="side-foot">Bandung, Jawa Barat <!-- GANTI --></p>
    </div>
  </header>

  <div class="content">
    <main id="konten">
      <!-- ========== PROFIL ========== -->
      <section id="profil" class="section hero" aria-labelledby="judul-profil">
        <p class="eyebrow reveal">Halo, selamat datang di laman saya</p>
        <h1 id="judul-profil" class="hero-title reveal"><?= htmlspecialchars(MEMBER_NAMA) ?></h1>
        <p class="hero-meta reveal">NIM <?= htmlspecialchars(MEMBER_NIM) ?> &middot; S1 Informatika &middot; Telkom University</p>
        <div class="hero-grid">
          <div class="hero-text reveal">
            <!-- GANTI: deskripsi singkat sesuai diri sendiri -->
            <p>Saya mahasiswa semester 5 yang senang mengutak-atik <strong>jaringan komputer</strong> dan <strong>infrastruktur cloud</strong>: merancang topologi, mengonfigurasi server Linux, sampai menjalankan layanan dalam kontainer.</p>
            <p>Di luar kelas saya aktif di kegiatan <strong>pengabdian masyarakat</strong> kampus, membantu sekolah dan desa mitra menyiapkan jaringan internet yang stabil dan mudah dirawat.</p>
            <div class="hero-actions">
              <a class="btn btn-primary" href="#portofolio">Lihat Portofolio</a>
              <a class="btn btn-ghost" href="#kontak">Hubungi Saya</a>
            </div>
          </div>
          <ul class="hero-facts reveal" aria-label="Ringkasan singkat">
            <li><span class="fact-num">5</span><span class="fact-label">Semester berjalan</span></li>
            <li><span class="fact-num">3</span><span class="fact-label">Program pengmas diikuti <!-- GANTI --></span></li>
            <li><span class="fact-num">5</span><span class="fact-label">Proyek portofolio</span></li>
          </ul>
        </div>
      </section>

      <!-- ========== PENDIDIKAN ========== -->
      <section id="pendidikan" class="section" aria-labelledby="judul-pendidikan">
        <h2 id="judul-pendidikan" class="section-title reveal"><span class="title-num">02</span>Pendidikan</h2>
        <ol class="timeline">
          <li class="tl-item reveal">
            <span class="tl-dot" aria-hidden="true"></span>
            <div class="tl-body">
              <span class="tl-time">2024 – sekarang</span>
              <h3>S1 Informatika</h3>
              <p class="tl-place">Telkom University, Bandung</p>
              <p>Fokus pada mata kuliah Jaringan Komputer, Sistem Operasi, serta Komputasi Awan dan Terdistribusi. <!-- GANTI: tambahkan IPK/peminatan bila perlu --></p>
            </div>
          </li>
          <li class="tl-item reveal">
            <span class="tl-dot" aria-hidden="true"></span>
            <div class="tl-body">
              <span class="tl-time">2021 – 2024 <!-- GANTI --></span>
              <h3>SMA, Jurusan MIPA <!-- GANTI --></h3>
              <p class="tl-place">SMA Negeri — (ganti) <!-- GANTI --></p>
              <p>Aktif di ekstrakurikuler komputer dan mulai belajar merakit PC serta jaringan sederhana di laboratorium sekolah. <!-- GANTI --></p>
            </div>
          </li>
        </ol>
      </section>

      <!-- ========== PENGALAMAN ========== -->
      <section id="pengalaman" class="section" aria-labelledby="judul-pengalaman">
        <h2 id="judul-pengalaman" class="section-title reveal"><span class="title-num">03</span>Pengalaman</h2>
        <ol class="timeline timeline-olive">
          <!-- GANTI: semua entri pengalaman di bawah adalah contoh -->
          <li class="tl-item reveal">
            <span class="tl-dot" aria-hidden="true"></span>
            <div class="tl-body">
              <span class="tl-time">2025 – sekarang</span>
              <h3>Staf Divisi Pengabdian Masyarakat</h3>
              <p class="tl-place">Himpunan Mahasiswa Informatika <!-- GANTI --></p>
              <p>Merancang dan memasang jaringan WiFi untuk sekolah mitra, lalu melatih guru agar mampu merawat perangkat secara mandiri.</p>
            </div>
          </li>
          <li class="tl-item reveal">
            <span class="tl-dot" aria-hidden="true"></span>
            <div class="tl-body">
              <span class="tl-time">2025</span>
              <h3>Koordinator Divisi IT &amp; Jaringan</h3>
              <p class="tl-place">Kepanitiaan Seminar Teknologi Kampus <!-- GANTI --></p>
              <p>Menyiapkan jaringan acara untuk ±300 peserta, live streaming, serta formulir pendaftaran daring.</p>
            </div>
          </li>
          <li class="tl-item reveal">
            <span class="tl-dot" aria-hidden="true"></span>
            <div class="tl-body">
              <span class="tl-time">2024 – sekarang</span>
              <h3>Anggota Kelompok Studi Cloud &amp; Networking</h3>
              <p class="tl-place">Komunitas mahasiswa Telkom University <!-- GANTI --></p>
              <p>Belajar bersama tiap pekan: subnetting, Linux server, Docker, hingga dasar layanan cloud publik.</p>
            </div>
          </li>
        </ol>
      </section>

      <!-- ========== KEAHLIAN ========== -->
      <section id="keahlian" class="section" aria-labelledby="judul-keahlian">
        <h2 id="judul-keahlian" class="section-title reveal"><span class="title-num">04</span>Keahlian</h2>
        <div class="skills-grid">
          <div class="skill-card reveal">
            <h3>Teknis</h3>
            <!-- GANTI: sesuaikan tingkat keahlian -->
            <ul class="skill-bars">
              <li><span class="skill-name">Jaringan Komputer (Cisco)</span><span class="skill-val">80%</span><span class="skill-track"><span class="skill-fill" style="--lvl:80%"></span></span></li>
              <li><span class="skill-name">Linux Server</span><span class="skill-val">75%</span><span class="skill-track"><span class="skill-fill" style="--lvl:75%"></span></span></li>
              <li><span class="skill-name">PHP &amp; MySQL</span><span class="skill-val">70%</span><span class="skill-track"><span class="skill-fill" style="--lvl:70%"></span></span></li>
              <li><span class="skill-name">Docker &amp; Kontainer</span><span class="skill-val">65%</span><span class="skill-track"><span class="skill-fill" style="--lvl:65%"></span></span></li>
              <li><span class="skill-name">Layanan Cloud (dasar)</span><span class="skill-val">60%</span><span class="skill-track"><span class="skill-fill" style="--lvl:60%"></span></span></li>
            </ul>
          </div>
          <div class="skill-card reveal">
            <h3>Non-teknis</h3>
            <ul class="chips">
              <li>Kerja tim</li>
              <li>Komunikasi</li>
              <li>Manajemen acara</li>
              <li>Pemecahan masalah</li>
              <li>Mengajar &amp; pendampingan</li>
              <li>Dokumentasi teknis</li>
            </ul>
            <h3 class="mt">Perkakas</h3>
            <ul class="chips chips-olive">
              <li>Cisco Packet Tracer</li>
              <li>Git</li>
              <li>XAMPP</li>
              <li>Grafana</li>
              <li>VS Code</li>
            </ul>
          </div>
        </div>
      </section>

      <!-- ========== PORTOFOLIO ========== -->
      <section id="portofolio" class="section" aria-labelledby="judul-portofolio">
        <h2 id="judul-portofolio" class="section-title reveal"><span class="title-num">05</span>Portofolio</h2>
        <div class="filter-bar reveal" role="group" aria-label="Saring portofolio berdasarkan kategori">
          <button type="button" class="filter-btn is-active" data-filter="semua" aria-pressed="true">Semua</button>
          <button type="button" class="filter-btn" data-filter="cloud" aria-pressed="false">Cloud</button>
          <button type="button" class="filter-btn" data-filter="jaringan" aria-pressed="false">Jaringan</button>
          <button type="button" class="filter-btn" data-filter="web" aria-pressed="false">Web</button>
        </div>
        <!-- GANTI: sesuaikan proyek dengan yang benar-benar dikerjakan -->
        <ul class="porto-grid">
          <li class="porto-item reveal" data-category="cloud">
            <button type="button" class="porto-card" aria-haspopup="dialog">
              <img src="assets/img/portfolio-1.svg" alt="Ilustrasi aplikasi RSVP di atas awan" width="400" height="260" loading="lazy">
              <span class="porto-cat">Cloud</span>
              <span class="porto-title">Aplikasi RSVP Kelompok (Komputasi Awan)</span>
              <span class="porto-desc">Aplikasi pendaftaran acara berbasis PHP &amp; MySQL yang dijalankan bersama di beberapa server lokal.</span>
            </button>
            <div class="porto-detail" hidden>
              <p>Tugas kelompok mata kuliah Komputasi Awan dan Terdistribusi. Setiap anggota menjalankan salinan aplikasi di server XAMPP masing-masing, dan laman ini menampilkan ringkasan kuota acara secara langsung.</p>
              <p>Peran saya: menyiapkan konfigurasi server lokal, basis data, dan menguji akses antarmesin di jaringan yang sama. <!-- GANTI --></p>
            </div>
          </li>
          <li class="porto-item reveal" data-category="jaringan">
            <button type="button" class="porto-card" aria-haspopup="dialog">
              <img src="assets/img/portfolio-2.svg" alt="Ilustrasi topologi jaringan router, switch, dan komputer" width="400" height="260" loading="lazy">
              <span class="porto-cat">Jaringan</span>
              <span class="porto-title">Desain Topologi Lab Komputer</span>
              <span class="porto-desc">Simulasi jaringan bersegmen VLAN dengan routing antar-VLAN di Cisco Packet Tracer.</span>
            </button>
            <div class="porto-detail" hidden>
              <p>Merancang topologi untuk tiga ruang laboratorium: pembagian subnet, VLAN per ruang, DHCP terpusat, dan ACL sederhana agar jaringan dosen terpisah dari jaringan mahasiswa. <!-- GANTI --></p>
            </div>
          </li>
          <li class="porto-item reveal" data-category="cloud">
            <button type="button" class="porto-card" aria-haspopup="dialog">
              <img src="assets/img/portfolio-3.svg" alt="Ilustrasi dasbor pemantauan server dan kontainer" width="400" height="260" loading="lazy">
              <span class="porto-cat">Cloud</span>
              <span class="porto-title">Homelab Pemantauan Server</span>
              <span class="porto-desc">Docker Compose berisi Prometheus dan Grafana untuk memantau server mini di rumah.</span>
            </button>
            <div class="porto-detail" hidden>
              <p>Proyek pribadi untuk belajar observability: mengumpulkan metrik CPU, memori, dan jaringan, lalu menampilkannya di dasbor Grafana dengan peringatan bila server tidak merespons. <!-- GANTI --></p>
            </div>
          </li>
          <li class="porto-item reveal" data-category="web">
            <button type="button" class="porto-card" aria-haspopup="dialog">
              <img src="assets/img/portfolio-4.svg" alt="Ilustrasi situs web profil desa binaan" width="400" height="260" loading="lazy">
              <span class="porto-cat">Web</span>
              <span class="porto-title">Situs Profil Desa Binaan</span>
              <span class="porto-desc">Laman statis ringan untuk memperkenalkan potensi desa mitra kegiatan pengabdian.</span>
            </button>
            <div class="porto-detail" hidden>
              <p>Dibuat bersama tim pengabdian masyarakat. Situs dirancang ringan agar cepat diakses dari koneksi seluler, dan perangkat desa dilatih memperbarui konten sendiri. <!-- GANTI --></p>
            </div>
          </li>
          <li class="porto-item reveal" data-category="jaringan">
            <button type="button" class="porto-card" aria-haspopup="dialog">
              <img src="assets/img/portfolio-5.svg" alt="Ilustrasi pemasangan titik akses WiFi di gedung sekolah" width="400" height="260" loading="lazy">
              <span class="porto-cat">Jaringan</span>
              <span class="porto-title">Instalasi WiFi Sekolah Mitra</span>
              <span class="porto-desc">Survei sinyal, penempatan access point, dan manajemen bandwidth untuk sekolah mitra.</span>
            </button>
            <div class="porto-detail" hidden>
              <p>Kegiatan pengabdian masyarakat: memetakan area tanpa sinyal, memasang beberapa access point, dan membuat panduan perawatan bergambar untuk staf sekolah. <!-- GANTI --></p>
            </div>
          </li>
        </ul>
        <p class="porto-empty" hidden>Belum ada proyek di kategori ini.</p>
      </section>

      <!-- ========== RSVP KELOMPOK ========== -->
      <section id="rsvp" class="section" aria-labelledby="judul-rsvp">
        <h2 id="judul-rsvp" class="section-title reveal"><span class="title-num">06</span>Acara Kelompok (RSVP)</h2>
        <div class="rsvp-box reveal">
          <p class="rsvp-intro">Berikut acara kelompok kami yang sedang membuka pendaftaran. Data kuota diambil langsung dari aplikasi RSVP kelompok.</p>
          <?php include __DIR__ . '/app/partials/ringkasan.php'; ?>
          <a class="btn btn-primary rsvp-cta" href="app/">Buka Aplikasi RSVP</a>
        </div>
      </section>

      <!-- ========== KONTAK ========== -->
      <section id="kontak" class="section" aria-labelledby="judul-kontak">
        <h2 id="judul-kontak" class="section-title reveal"><span class="title-num">07</span>Kontak</h2>
        <div class="contact-grid">
          <div class="contact-info reveal">
            <p>Tertarik berdiskusi soal jaringan, cloud, atau kolaborasi kegiatan pengabdian? Kirim pesan lewat formulir atau hubungi saya di:</p>
            <ul class="contact-list">
              <!-- GANTI dengan akun asli -->
              <li><span class="c-label">Email</span><a href="mailto:faqih@example.com">faqih@example.com</a></li>
              <!-- GANTI dengan akun asli -->
              <li><span class="c-label">GitHub</span><a href="https://github.com/username" target="_blank" rel="noopener">github.com/username</a></li>
              <!-- GANTI dengan akun asli -->
              <li><span class="c-label">LinkedIn</span><a href="https://www.linkedin.com/in/username" target="_blank" rel="noopener">linkedin.com/in/username</a></li>
              <!-- GANTI dengan akun asli -->
              <li><span class="c-label">Instagram</span><a href="https://www.instagram.com/username" target="_blank" rel="noopener">instagram.com/username</a></li>
            </ul>
          </div>

          <form class="contact-form reveal" id="contact-form" novalidate>
            <div class="field">
              <label for="cf-nama">Nama</label>
              <input id="cf-nama" name="nama" type="text" autocomplete="name" aria-describedby="err-nama">
              <p class="field-error" id="err-nama" aria-live="polite"></p>
            </div>
            <div class="field">
              <label for="cf-email">Email</label>
              <input id="cf-email" name="email" type="email" autocomplete="email" aria-describedby="err-email">
              <p class="field-error" id="err-email" aria-live="polite"></p>
            </div>
            <div class="field">
              <label for="cf-pesan">Pesan</label>
              <textarea id="cf-pesan" name="pesan" rows="5" aria-describedby="err-pesan"></textarea>
              <p class="field-error" id="err-pesan" aria-live="polite"></p>
            </div>
            <button class="btn btn-primary" type="submit">Kirim Pesan</button>
            <p class="form-success" role="status" hidden></p>
          </form>
        </div>
      </section>
    </main>

    <footer class="site-footer">
      <p>&copy; <span id="tahun">2026</span> <?= htmlspecialchars(MEMBER_NAMA) ?> &middot; NIM <?= htmlspecialchars(MEMBER_NIM) ?></p>
      <p class="footer-sub">Tugas 1 Komputasi Awan dan Terdistribusi &middot; Telkom University</p>
    </footer>
  </div>
</div>

<!-- Lightbox portofolio -->
<dialog class="lightbox" id="lightbox" aria-labelledby="lb-title">
  <div class="lb-inner">
    <button type="button" class="lb-close" aria-label="Tutup detail proyek">&times;</button>
    <img class="lb-img" src="assets/img/portfolio-1.svg" alt="">
    <div class="lb-text">
      <span class="porto-cat lb-cat"></span>
      <h3 id="lb-title" class="lb-title"></h3>
      <div class="lb-desc"></div>
    </div>
  </div>
</dialog>

<script src="assets/js/main.js" defer></script>
</body>
</html>
