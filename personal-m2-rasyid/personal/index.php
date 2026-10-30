<?php require_once __DIR__ . '/identity.php'; ?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= htmlspecialchars(MEMBER_NAMA) ?> (<?= htmlspecialchars(MEMBER_NIM) ?>) — Web Developer &amp; Asisten Praktikum</title>
    <meta name="description" content="Laman personal <?= htmlspecialchars(MEMBER_NAMA) ?>, mahasiswa S1 Informatika Telkom University: pengembang aplikasi web dan bot Discord, asisten praktikum dan asisten dosen pemrograman.">
    <meta name="theme-color" content="#FFF4DE">
    <link rel="icon" href="assets/img/avatar.svg" type="image/svg+xml">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Archivo+Black&family=Space+Grotesk:wght@400;500;700&display=swap">
    <link rel="stylesheet" href="assets/css/style.css">
    <script>
        // Pasang tema tersimpan sebelum halaman digambar agar tidak berkedip.
        (function () {
            var d = document.documentElement;
            d.classList.add('js');
            try {
                var t = localStorage.getItem('rr-theme');
                if (t === 'dark' || t === 'light') { d.setAttribute('data-theme', t); }
            } catch (e) { /* localStorage tidak tersedia */ }
        })();
    </script>
</head>
<body>
<?php include __DIR__ . '/app/partials/served_by.php'; ?>
<a class="skip-link" href="#main">Lewati ke konten utama</a>

<header class="site-header">
    <div class="container nav-wrap">
        <a class="brand" href="#profil" aria-label="Kembali ke atas: profil <?= htmlspecialchars(MEMBER_NAMA) ?>">
            <span class="brand-mark" aria-hidden="true">RR</span>
            <span class="brand-text">rasyid<span class="brand-dot">.</span>dev</span>
        </a>

        <div class="nav-actions">
            <button class="icon-btn theme-toggle" id="themeToggle" type="button" aria-pressed="false" aria-label="Ganti ke mode gelap" title="Ganti ke mode gelap">
                <svg class="icon-moon" viewBox="0 0 24 24" width="22" height="22" aria-hidden="true" focusable="false"><path d="M20 14.5A8.5 8.5 0 0 1 9.5 4a8.5 8.5 0 1 0 10.5 10.5Z" fill="currentColor" stroke="currentColor" stroke-width="1.5" stroke-linejoin="round"/></svg>
                <svg class="icon-sun" viewBox="0 0 24 24" width="22" height="22" aria-hidden="true" focusable="false"><circle cx="12" cy="12" r="4.5" fill="currentColor"/><g stroke="currentColor" stroke-width="2.4" stroke-linecap="round"><path d="M12 1.8v2.6M12 19.6v2.6M1.8 12h2.6M19.6 12h2.6M4.8 4.8l1.8 1.8M17.4 17.4l1.8 1.8M4.8 19.2l1.8-1.8M17.4 6.6l1.8-1.8"/></g></svg>
            </button>
            <button class="icon-btn nav-toggle" type="button" aria-expanded="false" aria-controls="navMenu" aria-label="Buka menu">
                <span class="burger" aria-hidden="true"><span></span><span></span><span></span></span>
            </button>
        </div>

        <nav class="site-nav" id="navMenu" aria-label="Navigasi utama">
            <ul>
                <li><a href="#profil">Profil</a></li>
                <li><a href="#perjalanan">Perjalanan</a></li>
                <li><a href="#keahlian">Keahlian</a></li>
                <li><a href="#portofolio">Portofolio</a></li>
                <li><a href="#rsvp">Acara</a></li>
                <li><a href="#kontak">Kontak</a></li>
                <li><a class="nav-app" href="app/">Aplikasi RSVP</a></li>
            </ul>
        </nav>
    </div>
</header>

<main id="main">

    <!-- ===================== PROFIL ===================== -->
    <section class="hero" id="profil" aria-labelledby="hero-title">
        <div class="container hero-grid">
            <div class="hero-text reveal">
                <p class="sticker sticker-yellow" style="--r:-3deg">Halo, saya</p>
                <h1 id="hero-title"><?= htmlspecialchars(MEMBER_NAMA) ?></h1>
                <p class="hero-nim">
                    <span class="nim-label">NIM</span>
                    <span class="nim-value"><?= htmlspecialchars(MEMBER_NIM) ?></span>
                </p>
                <p class="hero-lead">
                    Mahasiswa S1 Informatika Telkom University asal Bogor yang membangun
                    <mark>aplikasi web</mark> dan <mark class="mark-coral">bot Discord</mark> sendiri,
                    dari frontend, backend, sampai database. Di kampus, saya menjadi asisten praktikum
                    dan asisten dosen untuk mata kuliah pemrograman.
                </p>
                <ul class="tag-list" aria-label="Fokus minat">
                    <li class="sticker sticker-sky" style="--r:-2deg">Web Dev</li>
                    <li class="sticker sticker-coral" style="--r:2deg">Discord Bot</li>
                    <li class="sticker sticker-mint" style="--r:-1deg">Asisten Praktikum</li>
                    <li class="sticker sticker-lilac" style="--r:3deg">Cloud Learner</li>
                </ul>
                <div class="hero-cta">
                    <a class="btn btn-primary" href="#portofolio">Lihat Portofolio</a>
                    <a class="btn btn-ghost" href="#kontak">Ajak Kolaborasi</a>
                </div>
            </div>

            <div class="hero-art reveal">
                <figure class="avatar-frame">
                    <img src="assets/img/avatar.svg" width="240" height="240" alt="Avatar ilustrasi <?= htmlspecialchars(MEMBER_NAMA) ?> memakai hoodie dengan stiker gamepad">
                </figure>
                <span class="float-sticker fs-1" aria-hidden="true">Next.js</span>
                <span class="float-sticker fs-2" aria-hidden="true">Spring Boot</span>
                <span class="float-sticker fs-3" aria-hidden="true">IPK 3.7 &#9733;</span>
                <dl class="stat-strip">
                    <div><dt>IPK</dt><dd>3.7</dd></div>
                    <div><dt>Server bot</dt><dd>100</dd></div>
                    <div><dt>Dibimbing</dt><dd>100+</dd></div>
                </dl>
            </div>
        </div>
    </section>

    <div class="ticker" aria-hidden="true">
        <div class="ticker-track">
            <span>WEB DEV</span><span>&#10022;</span><span>DISCORD BOT</span><span>&#10022;</span><span>ASISTEN PRAKTIKUM</span><span>&#10022;</span><span>CLOUD &amp; DISTRIBUTED</span><span>&#10022;</span>
            <span>WEB DEV</span><span>&#10022;</span><span>DISCORD BOT</span><span>&#10022;</span><span>ASISTEN PRAKTIKUM</span><span>&#10022;</span><span>CLOUD &amp; DISTRIBUTED</span><span>&#10022;</span>
        </div>
    </div>

    <!-- ===================== PENDIDIKAN & PENGALAMAN ===================== -->
    <section class="section" id="perjalanan" aria-labelledby="perjalanan-title">
        <div class="container">
            <header class="section-head reveal">
                <span class="kicker">01 / Perjalanan</span>
                <h2 id="perjalanan-title">Pendidikan &amp; Pengalaman</h2>
            </header>

            <div class="two-col">
                <div class="col reveal">
                    <h3 class="col-title"><span class="col-icon" aria-hidden="true">&#127891;</span> Pendidikan</h3>
                    <ol class="timeline">
                        <li class="t-item">
                            <span class="t-date sticker-yellow">2024 – sekarang</span>
                            <h4>Telkom University</h4>
                            <p class="t-sub">S1 Informatika &middot; IPK 3.7</p>
                            <p>Mata kuliah relevan: Kecerdasan Artifisial, Algoritma Pemrograman, Pemrograman Berorientasi Objek, dan Struktur Data.</p>
                        </li>
                        <li class="t-item">
                            <span class="t-date sticker-sky">SMA</span><!-- GANTI: tahun masuk – tahun lulus -->
                            <h4>Ummul Quro Bogor</h4>
                            <p class="t-sub">Sekolah Menengah Atas</p>
                            <p>Menyelesaikan pendidikan menengah di Bogor, Jawa Barat.</p>
                        </li>
                    </ol>
                </div>

                <div class="col reveal">
                    <h3 class="col-title"><span class="col-icon" aria-hidden="true">&#9889;</span> Pengalaman</h3>
                    <ol class="timeline">
                        <li class="t-item">
                            <span class="t-date sticker-coral">Ganjil 2026/2027</span>
                            <h4>Asisten Praktikum Algoritma Pemrograman 1 &amp; Struktur Data</h4>
                            <p class="t-sub">Telkom University, Informatics Lab</p>
                            <p>Membimbing 13 mahasiswa di dua kelas praktikum, mengajarkan linked list, stack, queue, dan tree, menilai laporan, serta membantu debugging.</p>
                        </li>
                        <li class="t-item">
                            <span class="t-date sticker-mint">Ganjil 2026/2027</span>
                            <h4>Asisten Dosen Pemrograman Berorientasi Objek</h4>
                            <p class="t-sub">Telkom University, Fakultas Informatika</p>
                            <p>Mendampingi dosen di dua kelas (sekitar 80 mahasiswa), menilai tugas dan evaluasi, serta membuka sesi pendampingan dan tanya-jawab.</p>
                        </li>
                        <li class="t-item">
                            <span class="t-date sticker-lilac">Genap 2025/2026</span>
                            <h4>Asisten Praktikum Algoritma Pemrograman 2</h4>
                            <p class="t-sub">Telkom University, Informatics Lab</p>
                            <p>Membimbing 14 mahasiswa di dua kelas praktikum tentang tipe data bentukan, array, searching, dan sorting.</p>
                        </li>
                        <li class="t-item">
                            <span class="t-date sticker-yellow">Organisasi</span><!-- GANTI: periode -->
                            <h4>IMASC Telkom University</h4>
                            <p class="t-sub">Divisi Entrepreneur &amp; Event (E&amp;E)</p><!-- GANTI: jabatan jika ada -->
                            <p>Bertugas di bagian logistik untuk program kerja Marketing Class, Marketing Goes To Campus, dan Marlin.</p>
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <!-- ===================== KEAHLIAN ===================== -->
    <section class="section section-alt" id="keahlian" aria-labelledby="keahlian-title">
        <div class="container">
            <header class="section-head reveal">
                <span class="kicker">02 / Keahlian</span>
                <h2 id="keahlian-title">Skill Tree</h2>
                <p class="section-sub">Angka di bawah adalah penilaian diri, bukan sertifikasi. Masih terus naik level.</p>
            </header>

            <div class="skills-grid">
                <div class="panel panel-tech reveal">
                    <h3 class="panel-title">Teknis</h3>
                    <!-- GANTI: persentase hanya perkiraan, sesuaikan dengan penilaian sendiri -->
                    <ul class="skill-bars">
                        <li class="skill">
                            <div class="skill-meta"><span>JavaScript &amp; Node.js (Discord.js)</span><span>85%</span></div>
                            <div class="bar" role="img" aria-label="JavaScript dan Node.js, 85 persen"><span style="--lvl:85%"></span></div>
                        </li>
                        <li class="skill">
                            <div class="skill-meta"><span>Next.js</span><span>80%</span></div>
                            <div class="bar bar-coral" role="img" aria-label="Next.js, 80 persen"><span style="--lvl:80%"></span></div>
                        </li>
                        <li class="skill">
                            <div class="skill-meta"><span>Java &amp; Spring Boot</span><span>80%</span></div>
                            <div class="bar bar-sky" role="img" aria-label="Java dan Spring Boot, 80 persen"><span style="--lvl:80%"></span></div>
                        </li>
                        <li class="skill">
                            <div class="skill-meta"><span>PostgreSQL</span><span>75%</span></div>
                            <div class="bar bar-mint" role="img" aria-label="PostgreSQL, 75 persen"><span style="--lvl:75%"></span></div>
                        </li>
                        <li class="skill">
                            <div class="skill-meta"><span>Go, C &amp; C++</span><span>80%</span></div>
                            <div class="bar bar-lilac" role="img" aria-label="Go, C dan C++, 80 persen"><span style="--lvl:80%"></span></div>
                        </li>
                        <li class="skill">
                            <div class="skill-meta"><span>Python (Pandas, NumPy)</span><span>70%</span></div>
                            <div class="bar" role="img" aria-label="Python dengan Pandas dan NumPy, 70 persen"><span style="--lvl:70%"></span></div>
                        </li>
                        <li class="skill">
                            <div class="skill-meta"><span>Git, GitHub &amp; Docker</span><span>70%</span></div>
                            <div class="bar bar-coral" role="img" aria-label="Git, GitHub dan Docker, 70 persen"><span style="--lvl:70%"></span></div>
                        </li>
                    </ul>
                </div>

                <div class="panel-stack">
                    <div class="panel panel-soft reveal">
                        <h3 class="panel-title">Non-teknis</h3>
                        <ul class="chip-list">
                            <li class="chip chip-yellow">Mengajar &amp; mentoring</li>
                            <li class="chip chip-coral">Kerja mandiri</li>
                            <li class="chip chip-sky">Kolaborasi online</li>
                            <li class="chip chip-mint">Debugging</li>
                            <li class="chip chip-lilac">Komunikasi</li>
                            <li class="chip chip-yellow">Logistik acara</li>
                            <li class="chip chip-sky">Bahasa Inggris (Intermediate)</li>
                        </ul>
                    </div>
                    <div class="panel panel-tools reveal">
                        <h3 class="panel-title">Peralatan Harian</h3>
                        <ul class="chip-list chip-list-plain">
                            <li class="chip">Git</li>
                            <li class="chip">GitHub</li>
                            <li class="chip">Docker</li>
                            <li class="chip">PostgreSQL</li>
                            <li class="chip">C#</li>
                            <li class="chip">XAMPP</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ===================== PORTOFOLIO ===================== -->
    <section class="section" id="portofolio" aria-labelledby="portofolio-title">
        <div class="container">
            <header class="section-head reveal">
                <span class="kicker">03 / Portofolio</span>
                <h2 id="portofolio-title">Proyek &amp; Kegiatan</h2>
                <p class="section-sub">Klik kartu untuk melihat detail. Pakai filter untuk memilih kategori.</p>
            </header>

            <div class="filter-bar reveal" role="group" aria-label="Filter kategori portofolio">
                <button class="filter-btn" type="button" data-filter="semua" aria-pressed="true">Semua</button>
                <button class="filter-btn" type="button" data-filter="web" aria-pressed="false">Web</button>
                <button class="filter-btn" type="button" data-filter="bot" aria-pressed="false">Bot</button>
                <button class="filter-btn" type="button" data-filter="mengajar" aria-pressed="false">Mengajar</button>
                <button class="filter-btn" type="button" data-filter="konten" aria-pressed="false">Konten</button>
            </div>
            <p class="porto-count" id="portoCount" aria-live="polite">Menampilkan 5 proyek</p>

            <div class="porto-grid">
                <article class="porto-card" data-cat="web">
                    <div class="porto-media"><img src="assets/img/portfolio-1.svg" width="400" height="260" alt="Ilustrasi jendela browser berisi kalender acara dan daftar peserta yang sudah RSVP" loading="lazy"></div>
                    <div class="porto-body">
                        <span class="porto-cat sticker-sky">Web</span>
                        <h3><button class="porto-open" type="button" aria-haspopup="dialog">Aplikasi RSVP Kelompok (Komputasi Awan)</button></h3>
                        <p class="porto-desc">Aplikasi pendaftaran acara kelompok berbasis PHP &amp; MySQL dengan kuota peserta real-time.</p>
                        <span class="porto-more" aria-hidden="true">Lihat detail &rarr;</span>
                    </div>
                    <div class="porto-detail" hidden>
                        <p>Proyek kelompok mata kuliah Komputasi Awan dan Terdistribusi. Setiap anggota menjalankan laman personal di server lokal (XAMPP) dengan aplikasi RSVP bersama dari satu repo GitHub.</p>
                        <p><strong>Peran saya:</strong> mengerjakan form pendaftaran dan handler <code>daftar.php</code> yang memakai transaksi database agar kuota tidak terlampaui.</p>
                        <ul class="detail-tags"><li>PHP</li><li>MySQL</li><li>XAMPP</li><li>Git</li></ul>
                    </div>
                </article>

                <article class="porto-card" data-cat="bot">
                    <div class="porto-media"><img src="assets/img/portfolio-2.svg" width="400" height="260" alt="Ilustrasi jendela chat Discord berisi perintah bot dan lencana 100 server" loading="lazy"></div>
                    <div class="porto-body">
                        <span class="porto-cat sticker-coral">Bot</span>
                        <h3><button class="porto-open" type="button" aria-haspopup="dialog">Glitchtrap — Bot Discord Serbaguna</button></h3>
                        <p class="porto-desc">Bot Discord bertema Five Nights at Freddy's yang dipakai di 100 server Discord.</p>
                        <span class="porto-more" aria-hidden="true">Lihat detail &rarr;</span>
                    </div>
                    <div class="porto-detail" hidden>
                        <p>Bot serbaguna dengan fitur moderasi, sistem leveling, pemutar musik, command kustom, dan pemrosesan real-time. Saat ini digunakan di 100 server Discord.</p>
                        <p><strong>Peran saya:</strong> pengembang tunggal. Saya membangun bot, backend, frontend, dan database sendiri.</p>
                        <ul class="detail-tags"><li>Node.js</li><li>Discord.js</li><li>PostgreSQL</li></ul>
                    </div>
                </article>

                <article class="porto-card" data-cat="web bot">
                    <div class="porto-media"><img src="assets/img/portfolio-3.svg" width="400" height="260" alt="Ilustrasi dashboard web dengan sakelar pengaturan, grafik, dan ikon database" loading="lazy"></div>
                    <div class="porto-body">
                        <span class="porto-cat sticker-yellow">Web &middot; Bot</span>
                        <h3><button class="porto-open" type="button" aria-haspopup="dialog">Glitchtrap — Dashboard &amp; Backend</button></h3>
                        <p class="porto-desc">Frontend Next.js dan backend Spring Boot untuk mengatur konfigurasi bot di tiap server.</p>
                        <span class="porto-more" aria-hidden="true">Lihat detail &rarr;</span>
                    </div>
                    <div class="porto-detail" hidden>
                        <p>Sisi web dari Glitchtrap: frontend Next.js untuk konfigurasi server, backend Spring Boot, dan data tersimpan di PostgreSQL yang juga dibaca oleh bot.</p>
                        <p><strong>Yang saya pelajari:</strong> merancang struktur kode agar sistem bisa dikembangkan secara vertikal maupun horizontal.</p>
                        <ul class="detail-tags"><li>Next.js</li><li>Spring Boot</li><li>PostgreSQL</li><li>Docker</li></ul>
                    </div>
                </article>

                <article class="porto-card" data-cat="mengajar">
                    <div class="porto-media"><img src="assets/img/portfolio-4.svg" width="400" height="260" alt="Ilustrasi papan tulis berisi diagram linked list, tumpukan stack, dan pohon biner" loading="lazy"></div>
                    <div class="porto-body">
                        <span class="porto-cat sticker-lilac">Mengajar</span>
                        <h3><button class="porto-open" type="button" aria-haspopup="dialog">Asisten Praktikum &amp; Asisten Dosen</button></h3>
                        <p class="porto-desc">Mendampingi lebih dari 100 mahasiswa di Algoritma Pemrograman, Struktur Data, dan PBO.</p>
                        <span class="porto-more" aria-hidden="true">Lihat detail &rarr;</span>
                    </div>
                    <div class="porto-detail" hidden>
                        <p>Sejak Genap 2025/2026 saya menjadi asisten praktikum Algoritma Pemrograman 1 &amp; 2 serta Struktur Data di Informatics Lab, dan asisten dosen Pemrograman Berorientasi Objek untuk sekitar 80 mahasiswa.</p>
                        <p><strong>Materi:</strong> tipe data bentukan, array, searching, sorting, singly &amp; doubly linked list, stack, queue, dan tree.</p>
                        <ul class="detail-tags"><li>Struktur Data</li><li>PBO</li><li>Debugging</li><li>Mentoring</li></ul>
                    </div>
                </article>

                <article class="porto-card" data-cat="konten">
                    <div class="porto-media"><img src="assets/img/portfolio-5.svg" width="400" height="260" alt="Ilustrasi layar siaran langsung dengan tombol putar, lampu LIVE, dan mikrofon" loading="lazy"></div>
                    <div class="porto-body">
                        <span class="porto-cat sticker-mint">Konten</span>
                        <h3><button class="porto-open" type="button" aria-haspopup="dialog">Konten Kreator &amp; Streamer</button></h3>
                        <p class="porto-desc">Membuat konten dan siaran langsung di YouTube dan Twitch.</p>
                        <span class="porto-more" aria-hidden="true">Lihat detail &rarr;</span>
                    </div>
                    <div class="porto-detail" hidden>
                        <p>Di luar kuliah dan coding, saya aktif sebagai konten kreator dan streamer di YouTube dan Twitch.</p>
                        <p><strong>Yang saya pelajari:</strong> berkomunikasi dengan penonton secara langsung dan konsisten mengelola jadwal konten.</p>
                        <ul class="detail-tags"><li>YouTube</li><li>Twitch</li><li>Streaming</li></ul>
                    </div>
                </article>
            </div>
        </div>
    </section>

    <!-- ===================== RSVP KELOMPOK ===================== -->
    <section class="section section-rsvp" id="rsvp" aria-labelledby="rsvp-title">
        <div class="container">
            <header class="section-head reveal">
                <span class="kicker">04 / Acara</span>
                <h2 id="rsvp-title">Acara Kelompok (RSVP)</h2>
                <p class="section-sub">Daftar acara dari aplikasi RSVP kelompok kami. Cek sisa kuota, lalu amankan kursimu sebelum penuh.</p>
            </header>

            <div class="rsvp-wrap reveal">
                <?php include __DIR__ . '/app/partials/ringkasan.php'; ?>
            </div>

            <div class="rsvp-cta reveal">
                <a class="btn btn-primary btn-big" href="app/">Buka Aplikasi RSVP</a>
            </div>
        </div>
    </section>

    <!-- ===================== KONTAK ===================== -->
    <section class="section section-alt" id="kontak" aria-labelledby="kontak-title">
        <div class="container">
            <header class="section-head reveal">
                <span class="kicker">05 / Kontak</span>
                <h2 id="kontak-title">Say Hi!</h2>
                <p class="section-sub">Mau kolaborasi aplikasi web, butuh bot Discord, atau ingin tanya soal praktikum? Kirim pesan saja.</p>
            </header>

            <div class="contact-grid">
                <div class="panel contact-info reveal">
                    <h3 class="panel-title">Temukan saya di</h3>
                    <ul class="social-list">
                        <li>
                            <a class="social social-mail" href="mailto:9c.rasyidridlo@gmail.com">
                                <span class="social-label">Email</span>
                                <span class="social-value">9c.rasyidridlo@gmail.com</span>
                            </a>
                        </li>
                        <li>
                            <a class="social social-gh" href="https://github.com/henryemily098" target="_blank" rel="noopener noreferrer">
                                <span class="social-label">GitHub</span>
                                <span class="social-value">github.com/henryemily098</span>
                            </a>
                        </li>
                        <li>
                            <a class="social social-in" href="https://www.linkedin.com/in/rasyid-ridlo-3344b9258" target="_blank" rel="noopener noreferrer">
                                <span class="social-label">LinkedIn</span>
                                <span class="social-value">linkedin.com/in/rasyid-ridlo-3344b9258</span>
                            </a>
                        </li>
                    </ul>
                    <p class="contact-note">Berdomisili di Bogor, Jawa Barat. Biasanya membalas dalam 1–2 hari.</p>
                </div>

                <form class="panel contact-form reveal" id="contactForm" action="#" method="post" novalidate>
                    <h3 class="panel-title">Kirim Pesan</h3>
                    <div class="field">
                        <label for="nama">Nama</label>
                        <input type="text" id="nama" name="nama" autocomplete="name" required minlength="3" aria-describedby="namaError" placeholder="Nama lengkap">
                        <p class="error" id="namaError"></p>
                    </div>
                    <div class="field">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" autocomplete="email" required aria-describedby="emailError" placeholder="nama@contoh.com">
                        <p class="error" id="emailError"></p>
                    </div>
                    <div class="field">
                        <label for="pesan">Pesan <span class="char-count" id="pesanCount" aria-hidden="true">0/500</span></label>
                        <textarea id="pesan" name="pesan" rows="5" required minlength="10" maxlength="500" aria-describedby="pesanError" placeholder="Ceritakan idemu..."></textarea>
                        <p class="error" id="pesanError"></p>
                    </div>
                    <button class="btn btn-primary" type="submit">Kirim Pesan</button>
                    <p class="form-status" id="formStatus" role="status" aria-live="polite"></p>
                </form>
            </div>
        </div>
    </section>
</main>

<footer class="site-footer">
    <div class="container footer-inner">
        <p class="footer-name">
            <strong><?= htmlspecialchars(MEMBER_NAMA) ?></strong>
            <span class="footer-nim">NIM <?= htmlspecialchars(MEMBER_NIM) ?></span>
        </p>
        <p>&copy; <span id="year">2026</span> &middot; S1 Informatika, Telkom University &middot; Tugas 1 Komputasi Awan dan Terdistribusi</p>
        <a class="back-top" href="#profil">Kembali ke atas &uarr;</a>
    </div>
</footer>

<dialog class="modal" id="portoModal" aria-labelledby="modalTitle">
    <div class="modal-box">
        <button class="modal-close" type="button" aria-label="Tutup detail proyek">&times;</button>
        <img class="modal-img" id="modalImg" src="assets/img/portfolio-1.svg" width="400" height="260" alt="">
        <div class="modal-content">
            <span class="modal-cat" id="modalCat"></span>
            <h3 id="modalTitle">Detail proyek</h3>
            <div class="modal-body" id="modalBody"></div>
        </div>
    </div>
</dialog>

<script src="assets/js/main.js" defer></script>
</body>
</html>
