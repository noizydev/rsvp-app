<?php require_once __DIR__ . '/identity.php'; ?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?= htmlspecialchars(MEMBER_NAMA, ENT_QUOTES, 'UTF-8') ?> — Data &amp; Machine Learning Enthusiast</title>
  <meta name="description" content="Laman personal <?= htmlspecialchars(MEMBER_NAMA, ENT_QUOTES, 'UTF-8') ?> (<?= htmlspecialchars(MEMBER_NIM, ENT_QUOTES, 'UTF-8') ?>), mahasiswa S1 Informatika Telkom University yang menekuni data, machine learning, dan visualisasi data.">
  <meta name="color-scheme" content="dark light">
  <link rel="icon" href="assets/img/avatar.svg" type="image/svg+xml">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&amp;family=Poppins:wght@500;600;700&amp;display=swap" rel="stylesheet">
  <link rel="stylesheet" href="assets/css/style.css?v=<?= filemtime(__DIR__ . '/assets/css/style.css') ?>">
  <script>
    /* Terapkan tema tersimpan sebelum halaman digambar agar tidak berkedip */
    (function () {
      var root = document.documentElement;
      root.classList.add('js');
      try {
        var t = localStorage.getItem('gf-theme');
        if (t === 'light' || t === 'dark') { root.setAttribute('data-theme', t); }
        else { root.setAttribute('data-theme', 'light'); }
      } catch (e) { /* localStorage tidak tersedia */ }
    })();
  </script>
</head>
<body>
<?php include __DIR__ . '/app/partials/served_by.php'; ?>
  <a class="skip-link" href="#main">Langsung ke konten utama</a>

  <!-- Latar bersih -->
  <div class="bg-scene" aria-hidden="true"></div>

  <header class="site-header" id="site-header">
    <div class="nav-wrap glass">
      <a class="brand" href="#beranda" aria-label="Ke beranda">
        <span class="brand-mark" aria-hidden="true">GF</span>
        <span class="brand-text">gathfan<span>.data</span></span><!-- GANTI (opsional) -->
      </a>

      <nav class="nav" aria-label="Navigasi utama">
        <ul class="nav-menu" id="nav-menu">
          <li><a href="#profil">Profil</a></li>
          <li><a href="#pendidikan">Pendidikan</a></li>
          <li><a href="#keahlian">Keahlian</a></li>
          <li><a href="#portofolio">Portofolio</a></li>
          <li><a href="#rsvp">Acara</a></li>
          <li><a href="#kontak">Kontak</a></li>
          <li><a class="nav-cta" href="app/">Aplikasi RSVP</a></li>
        </ul>
      </nav>

      <div class="nav-actions">
        <button class="icon-btn theme-toggle" id="theme-toggle" type="button" aria-label="Ganti mode tampilan" data-mode="dark">
          <svg class="icon-sun" viewBox="0 0 24 24" width="20" height="20" aria-hidden="true" focusable="false"><circle cx="12" cy="12" r="4.5" fill="none" stroke="currentColor" stroke-width="2"/><path d="M12 2v2.5M12 19.5V22M2 12h2.5M19.5 12H22M4.9 4.9l1.8 1.8M17.3 17.3l1.8 1.8M4.9 19.1l1.8-1.8M17.3 6.7l1.8-1.8" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg>
          <svg class="icon-moon" viewBox="0 0 24 24" width="20" height="20" aria-hidden="true" focusable="false"><path d="M20.5 14.5A8.5 8.5 0 0 1 9.5 3.5a8.5 8.5 0 1 0 11 11z" fill="none" stroke="currentColor" stroke-width="2" stroke-linejoin="round"/></svg>
        </button>
        <button class="icon-btn nav-toggle" id="nav-toggle" type="button" aria-expanded="false" aria-controls="nav-menu" aria-label="Buka menu navigasi">
          <span class="burger" aria-hidden="true"><span></span><span></span><span></span></span>
        </button>
      </div>
    </div>
  </header>

  <main id="main">
    <!-- ============ HERO ============ -->
    <section class="hero" id="beranda" aria-labelledby="hero-title">
      <div class="avatar-ring reveal">
        <img src="assets/img/avatar.jpg" alt="Foto Gathfan Fadhilah Ananda Syukur" width="168" height="168">
      </div>
      <p class="hero-eyebrow reveal"><span class="pulse-dot" aria-hidden="true"></span> S1 Informatika · Telkom University</p>
      <h1 id="hero-title" class="reveal"><?= htmlspecialchars(MEMBER_NAMA, ENT_QUOTES, 'UTF-8') ?></h1>
      <p class="hero-nim reveal">NIM <span><?= htmlspecialchars(MEMBER_NIM, ENT_QUOTES, 'UTF-8') ?></span></p>
      <p class="hero-tagline reveal">
        <!-- GANTI -->
        Data &amp; machine-learning enthusiast yang senang mengubah tumpukan angka menjadi
        <span class="grad-text">cerita visual</span> yang mudah dipahami.
      </p>
      <div class="hero-cta reveal">
        <a class="btn btn-primary" href="#portofolio">Lihat Portofolio</a>
        <a class="btn btn-ghost" href="#kontak">Hubungi Saya</a>
      </div>
      <!-- GANTI: angka-angka di bawah ini hanya contoh -->
      <ul class="hero-stats glass reveal" aria-label="Ringkasan singkat">
        <li><strong>5+</strong><span>Proyek data</span></li>
        <li><strong>3</strong><span>Kepanitiaan</span></li>
        <li><strong>12</strong><span>Notebook Kaggle</span></li>
      </ul>
    </section>

    <!-- ============ PROFIL ============ -->
    <section class="section" id="profil" aria-labelledby="profil-title">
      <div class="section-head reveal">
        <span class="eyebrow">01 · Profil</span>
        <h2 id="profil-title">Tentang Saya</h2>
      </div>
      <div class="grid-2">
        <article class="card glass reveal">
          <h3>Halo, saya Gathfan 👋</h3>
          <!-- GANTI: deskripsi diri -->
          <p>
            Saya mahasiswa S1 Informatika angkatan 2024 di Telkom University yang tertarik pada
            <strong>data science</strong>, <strong>machine learning</strong>, dan <strong>visualisasi data</strong>.
            Saya suka proses dari awal sampai akhir: membersihkan data mentah, mencari pola,
            melatih model sederhana, lalu menyajikannya dalam grafik yang jujur dan enak dilihat.
          </p>
          <p>
            Di mata kuliah Komputasi Awan dan Terdistribusi, saya belajar bagaimana aplikasi data
            dapat di-<em>deploy</em> dan diskalakan di lingkungan server, mulai dari XAMPP lokal hingga cloud.
          </p>
          <figure class="sparkline">
            <svg viewBox="0 0 300 70" role="img" aria-labelledby="spark-title">
              <title id="spark-title">Grafik garis dekoratif: kurva belajar yang terus naik</title>
              <defs>
                <linearGradient id="spark-fill" x1="0" y1="0" x2="0" y2="1">
                  <stop offset="0" stop-color="currentColor" stop-opacity=".35"/>
                  <stop offset="1" stop-color="currentColor" stop-opacity="0"/>
                </linearGradient>
              </defs>
              <path d="M0 60 L30 52 L60 56 L90 40 L120 44 L150 30 L180 34 L210 20 L240 24 L270 10 L300 6 L300 70 L0 70 Z" fill="url(#spark-fill)"/>
              <path class="spark-line" d="M0 60 L30 52 L60 56 L90 40 L120 44 L150 30 L180 34 L210 20 L240 24 L270 10 L300 6" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/>
              <circle cx="300" cy="6" r="4" fill="currentColor"/>
            </svg>
            <figcaption>Kurva belajar — semoga terus naik 📈</figcaption>
          </figure>
        </article>

        <aside class="card glass facts reveal" aria-label="Fakta singkat">
          <h3>Fakta Singkat</h3>
          <dl>
            <div><dt>Nama</dt><dd><?= htmlspecialchars(MEMBER_NAMA, ENT_QUOTES, 'UTF-8') ?></dd></div>
            <div><dt>NIM</dt><dd><?= htmlspecialchars(MEMBER_NIM, ENT_QUOTES, 'UTF-8') ?></dd></div>
            <div><dt>Program Studi</dt><dd>S1 Informatika</dd></div>
            <div><dt>Kampus</dt><dd>Telkom University, Bandung</dd></div>
            <div><dt>Minat</dt><dd>Data Science · ML · Data Viz</dd></div><!-- GANTI -->
            <div><dt>Sedang belajar</dt><dd>Deep Learning &amp; MLOps dasar</dd></div><!-- GANTI -->
          </dl>
        </aside>
      </div>
    </section>

    <!-- ============ PENDIDIKAN & PENGALAMAN ============ -->
    <section class="section" id="pendidikan" aria-labelledby="pendidikan-title">
      <div class="section-head reveal">
        <span class="eyebrow">02 · Perjalanan</span>
        <h2 id="pendidikan-title">Pendidikan &amp; Pengalaman</h2>
      </div>
      <div class="grid-2">
        <div class="card glass reveal">
          <h3 class="card-title"><span class="card-icon" aria-hidden="true">🎓</span> Pendidikan</h3>
          <ol class="timeline">
            <li>
              <span class="tl-date">2024 — sekarang</span>
              <h4>Telkom University</h4>
              <p class="tl-sub">S1 Informatika · Fakultas Informatika</p>
              <p>Fokus pada pemrograman, basis data, kecerdasan buatan, dan komputasi awan.</p>
            </li>
            <li>
              <!-- GANTI: nama sekolah, jurusan, tahun -->
              <span class="tl-date">2021 — 2024</span>
              <h4>SMA Negeri 1 Ciawi</h4>
              <p class="tl-sub">Jurusan MIPA</p>
              <p>Aktif di ekstrakurikuler sains dan mulai belajar pemrograman secara mandiri.</p>
            </li>
          </ol>
        </div>

        <div class="card glass reveal" id="pengalaman">
          <h3 class="card-title"><span class="card-icon" aria-hidden="true">🧭</span> Pengalaman</h3>
          <!-- GANTI: seluruh pengalaman di bawah ini adalah contoh -->
          <ol class="timeline">
            <li>
              <span class="tl-date">2025 — sekarang</span>
              <h4>Staf Divisi Riset &amp; Data</h4>
              <p class="tl-sub">Himpunan Mahasiswa Informatika</p>
              <p>Mengolah data survei kepuasan mahasiswa dan menyusun dashboard hasilnya untuk pengurus.</p>
            </li>
            <li>
              <span class="tl-date">2025</span>
              <h4>Panitia Divisi Acara — Data Science Bootcamp</h4>
              <p class="tl-sub">Kepanitiaan kampus</p>
              <p>Menyusun rundown, mengoordinasikan pemateri, dan merekap data peserta.</p>
            </li>
            <li>
              <span class="tl-date">2026</span>
              <h4>Proyek Kelompok — Aplikasi RSVP</h4>
              <p class="tl-sub">Mata kuliah Komputasi Awan dan Terdistribusi</p>
              <p>Membangun aplikasi pendaftaran acara berbasis PHP &amp; MySQL yang dijalankan di beberapa server.</p>
            </li>
          </ol>
        </div>
      </div>
    </section>

    <!-- ============ KEAHLIAN ============ -->
    <section class="section" id="keahlian" aria-labelledby="keahlian-title">
      <div class="section-head reveal">
        <span class="eyebrow">03 · Keahlian</span>
        <h2 id="keahlian-title">Keahlian</h2>
        <p class="section-lead">Ditampilkan sebagai grafik batang — tentu saja. <!-- GANTI: nilai persentase --></p>
      </div>
      <div class="grid-2 skills-grid">
        <div class="card glass reveal">
          <h3 class="card-title"><span class="card-icon" aria-hidden="true">📊</span> Teknis</h3>
          <ul class="skill-list">
            <li class="skill" style="--val: 85%"><span class="skill-name">Python</span><span class="skill-val">85%</span><span class="skill-track" aria-hidden="true"><span class="skill-fill"></span></span></li>
            <li class="skill" style="--val: 80%"><span class="skill-name">Pandas &amp; NumPy</span><span class="skill-val">80%</span><span class="skill-track" aria-hidden="true"><span class="skill-fill"></span></span></li>
            <li class="skill" style="--val: 78%"><span class="skill-name">Visualisasi (Matplotlib, Plotly)</span><span class="skill-val">78%</span><span class="skill-track" aria-hidden="true"><span class="skill-fill"></span></span></li>
            <li class="skill" style="--val: 72%"><span class="skill-name">SQL &amp; MySQL</span><span class="skill-val">72%</span><span class="skill-track" aria-hidden="true"><span class="skill-fill"></span></span></li>
            <li class="skill" style="--val: 68%"><span class="skill-name">scikit-learn</span><span class="skill-val">68%</span><span class="skill-track" aria-hidden="true"><span class="skill-fill"></span></span></li>
            <li class="skill" style="--val: 62%"><span class="skill-name">PHP, HTML, CSS, JS</span><span class="skill-val">62%</span><span class="skill-track" aria-hidden="true"><span class="skill-fill"></span></span></li>
          </ul>
        </div>

        <div class="skills-side">
          <div class="card glass reveal">
            <h3 class="card-title"><span class="card-icon" aria-hidden="true">🤝</span> Non-teknis</h3>
            <ul class="chips">
              <li class="chip">Data storytelling</li>
              <li class="chip">Kerja tim</li>
              <li class="chip">Berpikir analitis</li>
              <li class="chip">Komunikasi</li>
              <li class="chip">Manajemen waktu</li>
              <li class="chip">Rasa ingin tahu</li>
            </ul>
          </div>
          <div class="card glass reveal">
            <h3 class="card-title"><span class="card-icon" aria-hidden="true">🧰</span> Tools</h3>
            <ul class="chips chips-outline">
              <li class="chip">Jupyter</li>
              <li class="chip">Google Colab</li>
              <li class="chip">Git &amp; GitHub</li>
              <li class="chip">Looker Studio</li>
              <li class="chip">XAMPP</li>
              <li class="chip">VS Code</li>
              <li class="chip">Linux dasar</li>
            </ul>
          </div>
        </div>
      </div>
    </section>

    <!-- ============ PORTOFOLIO ============ -->
    <section class="section" id="portofolio" aria-labelledby="portofolio-title">
      <div class="section-head reveal">
        <span class="eyebrow">04 · Portofolio</span>
        <h2 id="portofolio-title">Proyek Pilihan</h2>
        <p class="section-lead">Klik sebuah kartu untuk melihat detailnya. <!-- GANTI: deskripsi proyek --></p>
      </div>

      <div class="filter-bar reveal" role="group" aria-label="Filter kategori portofolio">
        <button type="button" class="filter-btn is-active" data-filter="all" aria-pressed="true">Semua</button>
        <button type="button" class="filter-btn" data-filter="ml" aria-pressed="false">Machine Learning</button>
        <button type="button" class="filter-btn" data-filter="dataviz" aria-pressed="false">Visualisasi Data</button>
        <button type="button" class="filter-btn" data-filter="web" aria-pressed="false">Web &amp; Cloud</button>
      </div>
      <p class="sr-only" id="filter-status" aria-live="polite"></p>

      <div class="porto-grid">
        <article class="porto-card glass reveal" data-category="dataviz"
          data-detail="Dashboard interaktif untuk menjelajahi data gempa bumi Indonesia lima tahun terakhir. Data dibersihkan dengan Pandas, lalu divisualisasikan sebagai peta sebaran, histogram magnitudo, dan tren bulanan sehingga pola wilayah rawan gempa lebih mudah terlihat."
          data-tools="Python, Pandas, Plotly, Streamlit">
          <div class="porto-media"><img src="assets/img/portfolio-1.svg" alt="Ilustrasi dashboard dengan titik sebaran gempa dan grafik batang" width="800" height="500" loading="lazy"></div>
          <div class="porto-body">
            <span class="tag" data-cat="dataviz">Visualisasi Data</span>
            <h3>Dashboard Sebaran Gempa Indonesia</h3>
            <p>Peta sebaran dan tren gempa dari data publik dalam satu dashboard.</p>
            <button type="button" class="porto-more" aria-haspopup="dialog">Lihat detail <span aria-hidden="true">→</span></button>
          </div>
        </article>

        <article class="porto-card glass reveal" data-category="ml"
          data-detail="Model klasifikasi sentimen untuk ulasan aplikasi berbahasa Indonesia di Play Store. Tahapannya meliputi scraping ulasan, preprocessing teks (case folding, stopword, stemming), pembobotan TF-IDF, lalu perbandingan Naive Bayes dan Logistic Regression yang dievaluasi dengan confusion matrix."
          data-tools="Python, scikit-learn, Sastrawi, TF-IDF">
          <div class="porto-media"><img src="assets/img/portfolio-2.svg" alt="Ilustrasi gelembung chat positif dan negatif serta confusion matrix" width="800" height="500" loading="lazy"></div>
          <div class="porto-body">
            <span class="tag" data-cat="ml">Machine Learning</span>
            <h3>Klasifikasi Sentimen Ulasan Aplikasi</h3>
            <p>Membedakan ulasan positif dan negatif dengan NLP sederhana.</p>
            <button type="button" class="porto-more" aria-haspopup="dialog">Lihat detail <span aria-hidden="true">→</span></button>
          </div>
        </article>

        <article class="porto-card glass reveal" data-category="web"
          data-detail="Aplikasi RSVP acara kelompok untuk tugas Komputasi Awan dan Terdistribusi. Pengguna dapat melihat daftar acara, sisa kuota, dan mendaftar. Aplikasi yang sama dijalankan di beberapa server anggota kelompok dengan basis data bersama, sehingga terlihat server mana yang sedang melayani."
          data-tools="PHP, MySQL, XAMPP, HTML/CSS/JS">
          <div class="porto-media"><img src="assets/img/portfolio-3.svg" alt="Ilustrasi awan, kalender acara, dan bar kuota pendaftaran" width="800" height="500" loading="lazy"></div>
          <div class="porto-body">
            <span class="tag" data-cat="web">Web &amp; Cloud</span>
            <h3>Aplikasi RSVP Kelompok (Komputasi Awan)</h3>
            <p>Pendaftaran acara yang berjalan di beberapa server kelompok.</p>
            <button type="button" class="porto-more" aria-haspopup="dialog">Lihat detail <span aria-hidden="true">→</span></button>
          </div>
        </article>

        <article class="porto-card glass reveal" data-category="ml"
          data-detail="Model regresi untuk memperkirakan harga rumah berdasarkan luas tanah, luas bangunan, jumlah kamar, dan lokasi. Dilakukan eksplorasi data, penanganan outlier, feature engineering, lalu perbandingan Linear Regression dan Random Forest menggunakan metrik MAE dan R²."
          data-tools="Python, Pandas, scikit-learn, Seaborn">
          <div class="porto-media"><img src="assets/img/portfolio-4.svg" alt="Ilustrasi scatter plot dengan garis regresi dan ikon rumah" width="800" height="500" loading="lazy"></div>
          <div class="porto-body">
            <span class="tag" data-cat="ml">Machine Learning</span>
            <h3>Prediksi Harga Rumah</h3>
            <p>Regresi dan feature engineering pada data properti.</p>
            <button type="button" class="porto-more" aria-haspopup="dialog">Lihat detail <span aria-hidden="true">→</span></button>
          </div>
        </article>

        <article class="porto-card glass reveal" data-category="dataviz"
          data-detail="Infografis interaktif berbasis web yang merangkum hasil survei kebiasaan belajar mahasiswa: jam belajar, perangkat yang dipakai, dan sumber belajar favorit. Dibuat dengan grafik donat dan batang yang bisa di-hover untuk melihat angka detail."
          data-tools="JavaScript, SVG, Looker Studio, Google Sheets">
          <div class="porto-media"><img src="assets/img/portfolio-5.svg" alt="Ilustrasi infografis dengan grafik donat dan grafik batang horizontal" width="800" height="500" loading="lazy"></div>
          <div class="porto-body">
            <span class="tag" data-cat="dataviz">Visualisasi Data</span>
            <h3>Infografis Kebiasaan Belajar Mahasiswa</h3>
            <p>Hasil survei disajikan sebagai grafik interaktif yang ringkas.</p>
            <button type="button" class="porto-more" aria-haspopup="dialog">Lihat detail <span aria-hidden="true">→</span></button>
          </div>
        </article>
      </div>
    </section>

    <!-- ============ RSVP ============ -->
    <section class="section" id="rsvp" aria-labelledby="rsvp-title">
      <div class="section-head reveal">
        <span class="eyebrow">05 · Acara</span>
        <h2 id="rsvp-title">Acara Kelompok (RSVP)</h2>
        <p class="section-lead">Berikut acara yang sedang dibuka pendaftarannya oleh kelompok kami. Data diambil langsung dari aplikasi RSVP bersama.</p>
      </div>
      <div class="rsvp-wrap glass reveal">
        <?php include __DIR__ . '/app/partials/ringkasan.php'; ?>
        <div class="rsvp-cta">
          <a class="btn btn-primary" href="app/">Buka Aplikasi RSVP</a>
        </div>
      </div>
    </section>

    <!-- ============ KONTAK ============ -->
    <section class="section" id="kontak" aria-labelledby="kontak-title">
      <div class="section-head reveal">
        <span class="eyebrow">06 · Kontak</span>
        <h2 id="kontak-title">Mari Terhubung</h2>
        <p class="section-lead">Ingin berdiskusi soal data, ML, atau proyek kelompok? Kirim pesan saja.</p>
      </div>
      <div class="grid-2 contact-grid">
        <div class="card glass reveal">
          <h3 class="card-title"><span class="card-icon" aria-hidden="true">✉️</span> Email &amp; Sosial</h3>
          <!-- GANTI dengan akun asli -->
          <a class="contact-email" href="mailto:gathfanfadhilah@student.telkomuniversity.ac.id">gathfanfadhilah@student.telkomuniversity.ac.id</a>
          <!-- GANTI dengan akun asli -->
          <ul class="socials">
            <li>
              <a href="https://github.com/GathfanDess" target="_blank" rel="noopener noreferrer">
                <svg viewBox="0 0 24 24" width="22" height="22" aria-hidden="true" focusable="false"><path fill="currentColor" d="M12 .5a11.5 11.5 0 0 0-3.64 22.41c.58.1.79-.25.79-.56v-2c-3.2.7-3.88-1.37-3.88-1.37-.53-1.33-1.28-1.69-1.28-1.69-1.05-.71.08-.7.08-.7 1.16.08 1.77 1.19 1.77 1.19 1.03 1.77 2.7 1.26 3.36.96.1-.75.4-1.26.73-1.55-2.55-.29-5.24-1.28-5.24-5.68 0-1.26.45-2.28 1.19-3.09-.12-.29-.52-1.46.11-3.04 0 0 .97-.31 3.17 1.18a11 11 0 0 1 5.77 0c2.2-1.49 3.17-1.18 3.17-1.18.63 1.58.23 2.75.11 3.04.74.81 1.19 1.83 1.19 3.09 0 4.41-2.69 5.38-5.26 5.67.41.36.78 1.06.78 2.14v3.17c0 .31.21.67.8.56A11.5 11.5 0 0 0 12 .5z"/></svg>
                <span>GitHub</span>
              </a>
            </li>
            <li>
              <a href="https://www.linkedin.com/in/gathfanfadhilah" target="_blank" rel="noopener noreferrer">
                <svg viewBox="0 0 24 24" width="22" height="22" aria-hidden="true" focusable="false"><path fill="currentColor" d="M4.98 3.5a2.5 2.5 0 1 1 0 5 2.5 2.5 0 0 1 0-5zM3 9.75h4v11H3v-11zm6.5 0h3.83v1.5h.05c.53-1 1.84-2.06 3.79-2.06 4.05 0 4.8 2.67 4.8 6.13v5.43h-4v-4.82c0-1.15-.02-2.63-1.6-2.63-1.6 0-1.85 1.25-1.85 2.55v4.9h-4v-11z"/></svg>
                <span>LinkedIn</span>
              </a>
            </li>
            <li>
              <a href="https://www.instagram.com/gathfanhatta" target="_blank" rel="noopener noreferrer">
                <svg viewBox="0 0 24 24" width="22" height="22" aria-hidden="true" focusable="false"><rect x="3" y="3" width="18" height="18" rx="5" fill="none" stroke="currentColor" stroke-width="2"/><circle cx="12" cy="12" r="4" fill="none" stroke="currentColor" stroke-width="2"/><circle cx="17.3" cy="6.7" r="1.2" fill="currentColor"/></svg>
                <span>Instagram</span>
              </a>
            </li>
          </ul>
          <p class="muted small">Biasanya saya membalas dalam 1–2 hari kerja.</p>
        </div>

        <form class="card glass contact-form reveal" id="contact-form" action="#" method="post" novalidate>
          <h3 class="card-title"><span class="card-icon" aria-hidden="true">💬</span> Kirim Pesan</h3>
          <div class="field">
            <label for="cf-nama">Nama</label>
            <input type="text" id="cf-nama" name="nama" autocomplete="name" required minlength="3" aria-describedby="err-nama">
            <p class="field-error" id="err-nama" aria-live="polite"></p>
          </div>
          <div class="field">
            <label for="cf-email">Email</label>
            <input type="email" id="cf-email" name="email" autocomplete="email" required aria-describedby="err-email">
            <p class="field-error" id="err-email" aria-live="polite"></p>
          </div>
          <div class="field">
            <label for="cf-pesan">Pesan</label>
            <textarea id="cf-pesan" name="pesan" rows="5" required minlength="10" aria-describedby="err-pesan"></textarea>
            <p class="field-error" id="err-pesan" aria-live="polite"></p>
          </div>
          <button type="submit" class="btn btn-primary btn-block">Kirim Pesan</button>
          <p class="form-success" id="form-success" role="status" hidden></p>
        </form>
      </div>
    </section>
  </main>

  <footer class="site-footer">
    <div class="footer-inner glass">
      <p>&copy; <span id="tahun">2026</span> <?= htmlspecialchars(MEMBER_NAMA, ENT_QUOTES, 'UTF-8') ?> · NIM <?= htmlspecialchars(MEMBER_NIM, ENT_QUOTES, 'UTF-8') ?></p>
      <p class="muted small">Tugas 1 · Komputasi Awan dan Terdistribusi · Telkom University</p>
      <a class="to-top" href="#beranda">Kembali ke atas <span aria-hidden="true">↑</span></a>
    </div>
  </footer>

  <!-- Modal detail portofolio -->
  <div class="modal" id="porto-modal" hidden>
    <div class="modal-backdrop" data-close></div>
    <div class="modal-dialog glass" role="dialog" aria-modal="true" aria-labelledby="modal-title" aria-describedby="modal-desc">
      <button class="icon-btn modal-close" type="button" data-close aria-label="Tutup detail proyek">
        <svg viewBox="0 0 24 24" width="20" height="20" aria-hidden="true" focusable="false"><path d="M6 6l12 12M18 6L6 18" stroke="currentColor" stroke-width="2.2" stroke-linecap="round"/></svg>
      </button>
      <div class="modal-media"><img id="modal-img" alt="" width="800" height="500"></div>
      <div class="modal-body">
        <span class="tag" id="modal-cat"></span>
        <h3 id="modal-title">Detail proyek</h3>
        <p id="modal-desc"></p>
        <p class="modal-tools-label">Tools yang digunakan</p>
        <ul class="chips chips-outline" id="modal-tools"></ul>
      </div>
    </div>
  </div>

  <script src="assets/js/main.js" defer></script>
</body>
</html>
