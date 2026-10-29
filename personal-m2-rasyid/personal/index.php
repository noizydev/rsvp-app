<?php require_once __DIR__ . '/identity.php'; ?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= htmlspecialchars(MEMBER_NAMA) ?> (<?= htmlspecialchars(MEMBER_NIM) ?>) — Mobile &amp; Game Dev</title>
    <meta name="description" content="Laman personal <?= htmlspecialchars(MEMBER_NAMA) ?>, mahasiswa S1 Informatika Telkom University: mobile &amp; game dev, aktif di kepanitiaan acara kampus.">
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
            <span class="brand-text">rasyid<span class="brand-dot">.</span>dev</span><!-- GANTI -->
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
                <!-- GANTI: deskripsi singkat diri -->
                <p class="hero-lead">
                    Mahasiswa S1 Informatika Telkom University angkatan 2024 yang betah ngoprek
                    <mark>aplikasi mobile</mark> dan <mark class="mark-coral">game indie</mark>.
                    Di luar kelas, saya sering jadi panitia acara kampus, biasanya di bagian
                    acara atau dokumentasi, sambil cari ide untuk prototipe berikutnya.
                </p>
                <ul class="tag-list" aria-label="Fokus minat">
                    <li class="sticker sticker-sky" style="--r:-2deg">Mobile Dev</li>
                    <li class="sticker sticker-coral" style="--r:2deg">Game Dev</li>
                    <li class="sticker sticker-mint" style="--r:-1deg">Panitia Acara</li>
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
                <span class="float-sticker fs-1" aria-hidden="true">Flutter</span><!-- GANTI -->
                <span class="float-sticker fs-2" aria-hidden="true">Godot</span><!-- GANTI -->
                <span class="float-sticker fs-3" aria-hidden="true">LVL 5 &#9733;</span>
                <!-- GANTI: angka statistik -->
                <dl class="stat-strip">
                    <div><dt>Semester</dt><dd>5</dd></div>
                    <div><dt>Proyek</dt><dd>5+</dd></div>
                    <div><dt>Kepanitiaan</dt><dd>3</dd></div>
                </dl>
            </div>
        </div>
    </section>

    <div class="ticker" aria-hidden="true">
        <div class="ticker-track">
            <span>MOBILE APP</span><span>&#10022;</span><span>GAME JAM</span><span>&#10022;</span><span>EVENT CREW</span><span>&#10022;</span><span>CLOUD &amp; DISTRIBUTED</span><span>&#10022;</span>
            <span>MOBILE APP</span><span>&#10022;</span><span>GAME JAM</span><span>&#10022;</span><span>EVENT CREW</span><span>&#10022;</span><span>CLOUD &amp; DISTRIBUTED</span><span>&#10022;</span>
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
                            <p class="t-sub">S1 Informatika</p>
                            <p>Fokus belajar rekayasa perangkat lunak, pemrograman mobile, dan komputasi awan &amp; terdistribusi.</p>
                        </li>
                        <li class="t-item">
                            <span class="t-date sticker-sky">2021 – 2024</span><!-- GANTI -->
                            <h4>SMA Negeri — (ganti)</h4><!-- GANTI -->
                            <p class="t-sub">Jurusan MIPA</p><!-- GANTI -->
                            <p>Mulai belajar coding lewat ekstrakurikuler komputer dan membuat game sederhana pertama.</p><!-- GANTI -->
                        </li>
                    </ol>
                </div>

                <div class="col reveal">
                    <h3 class="col-title"><span class="col-icon" aria-hidden="true">&#9889;</span> Pengalaman</h3>
                    <!-- GANTI: seluruh entri pengalaman di bawah -->
                    <ol class="timeline">
                        <li class="t-item">
                            <span class="t-date sticker-coral">2025</span>
                            <h4>Staf Divisi Acara — Pekan Informatika</h4>
                            <p class="t-sub">Kepanitiaan himpunan mahasiswa</p>
                            <p>Menyusun rundown, mengatur alur registrasi peserta, dan menjadi MC cadangan untuk sesi talkshow.</p>
                        </li>
                        <li class="t-item">
                            <span class="t-date sticker-mint">2024 – sekarang</span>
                            <h4>Anggota Komunitas Game Dev Kampus</h4>
                            <p class="t-sub">Komunitas / UKM teknologi</p>
                            <p>Ikut sesi belajar mingguan Unity &amp; Godot, lalu membantu mentoring anggota baru di kelas dasar.</p>
                        </li>
                        <li class="t-item">
                            <span class="t-date sticker-lilac">2025</span>
                            <h4>Peserta Game Jam 48 Jam</h4>
                            <p class="t-sub">Proyek tim (programmer gameplay)</p>
                            <p>Bersama tim 4 orang membuat game platformer <em>Pixel Dash</em> dari nol dalam dua hari.</p>
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
                    <!-- GANTI: sesuaikan skill & persentase -->
                    <ul class="skill-bars">
                        <li class="skill">
                            <div class="skill-meta"><span>Flutter / Dart</span><span>75%</span></div>
                            <div class="bar" role="img" aria-label="Flutter dan Dart, 75 persen"><span style="--lvl:75%"></span></div>
                        </li>
                        <li class="skill">
                            <div class="skill-meta"><span>Kotlin (Android)</span><span>60%</span></div>
                            <div class="bar bar-coral" role="img" aria-label="Kotlin Android, 60 persen"><span style="--lvl:60%"></span></div>
                        </li>
                        <li class="skill">
                            <div class="skill-meta"><span>Godot / GDScript</span><span>65%</span></div>
                            <div class="bar bar-sky" role="img" aria-label="Godot dan GDScript, 65 persen"><span style="--lvl:65%"></span></div>
                        </li>
                        <li class="skill">
                            <div class="skill-meta"><span>Unity / C#</span><span>55%</span></div>
                            <div class="bar bar-mint" role="img" aria-label="Unity dan C#, 55 persen"><span style="--lvl:55%"></span></div>
                        </li>
                        <li class="skill">
                            <div class="skill-meta"><span>HTML, CSS &amp; JavaScript</span><span>70%</span></div>
                            <div class="bar bar-lilac" role="img" aria-label="HTML, CSS dan JavaScript, 70 persen"><span style="--lvl:70%"></span></div>
                        </li>
                        <li class="skill">
                            <div class="skill-meta"><span>PHP &amp; MySQL</span><span>60%</span></div>
                            <div class="bar" role="img" aria-label="PHP dan MySQL, 60 persen"><span style="--lvl:60%"></span></div>
                        </li>
                        <li class="skill">
                            <div class="skill-meta"><span>Git &amp; GitHub</span><span>65%</span></div>
                            <div class="bar bar-coral" role="img" aria-label="Git dan GitHub, 65 persen"><span style="--lvl:65%"></span></div>
                        </li>
                    </ul>
                </div>

                <div class="panel-stack">
                    <div class="panel panel-soft reveal">
                        <h3 class="panel-title">Non-teknis</h3>
                        <!-- GANTI -->
                        <ul class="chip-list">
                            <li class="chip chip-yellow">Kerja tim</li>
                            <li class="chip chip-coral">Manajemen acara</li>
                            <li class="chip chip-sky">Public speaking</li>
                            <li class="chip chip-mint">Problem solving</li>
                            <li class="chip chip-lilac">Komunikasi</li>
                            <li class="chip chip-yellow">Manajemen waktu</li>
                            <li class="chip chip-sky">Kreativitas</li>
                        </ul>
                    </div>
                    <div class="panel panel-tools reveal">
                        <h3 class="panel-title">Peralatan Harian</h3>
                        <!-- GANTI -->
                        <ul class="chip-list chip-list-plain">
                            <li class="chip">Android Studio</li>
                            <li class="chip">VS Code</li>
                            <li class="chip">Figma</li>
                            <li class="chip">Aseprite</li>
                            <li class="chip">XAMPP</li>
                            <li class="chip">Firebase</li>
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
                <h2 id="portofolio-title">Proyek &amp; Mainan</h2>
                <p class="section-sub">Klik kartu untuk melihat detail. Pakai filter untuk memilih kategori.</p>
            </header>

            <div class="filter-bar reveal" role="group" aria-label="Filter kategori portofolio">
                <button class="filter-btn" type="button" data-filter="semua" aria-pressed="true">Semua</button>
                <button class="filter-btn" type="button" data-filter="mobile" aria-pressed="false">Mobile</button>
                <button class="filter-btn" type="button" data-filter="game" aria-pressed="false">Game</button>
                <button class="filter-btn" type="button" data-filter="web" aria-pressed="false">Web</button>
                <button class="filter-btn" type="button" data-filter="acara" aria-pressed="false">Acara</button>
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
                        <p>Proyek kelompok mata kuliah Komputasi Awan dan Terdistribusi. Setiap anggota menjalankan laman personal di server lokal (XAMPP), lalu semuanya terhubung ke satu aplikasi RSVP bersama.</p>
                        <p><strong>Peran saya:</strong> membantu pengujian alur pendaftaran dan menyelaraskan tampilan ringkasan acara di laman personal.</p><!-- GANTI -->
                        <ul class="detail-tags"><li>PHP</li><li>MySQL</li><li>XAMPP</li><li>Kerja tim</li></ul>
                    </div>
                </article>

                <article class="porto-card" data-cat="mobile">
                    <div class="porto-media"><img src="assets/img/portfolio-2.svg" width="400" height="260" alt="Ilustrasi ponsel menampilkan daftar menu kantin dengan tombol pre-order" loading="lazy"></div>
                    <div class="porto-body">
                        <span class="porto-cat sticker-coral">Mobile</span>
                        <h3><button class="porto-open" type="button" aria-haspopup="dialog">KantinKu — Pre-order Kantin</button></h3><!-- GANTI -->
                        <p class="porto-desc">Aplikasi Flutter untuk pesan makanan kantin lebih dulu supaya tidak antre saat jam istirahat.</p>
                        <span class="porto-more" aria-hidden="true">Lihat detail &rarr;</span>
                    </div>
                    <div class="porto-detail" hidden>
                        <!-- GANTI -->
                        <p>Prototipe aplikasi mobile untuk memesan menu kantin sebelum jam istirahat. Pengguna memilih menu, menentukan jam ambil, lalu menerima notifikasi saat pesanan siap.</p>
                        <p><strong>Yang saya pelajari:</strong> state management, integrasi Firebase Auth &amp; Firestore, dan merancang UI yang nyaman dipakai satu tangan.</p>
                        <ul class="detail-tags"><li>Flutter</li><li>Dart</li><li>Firebase</li></ul>
                    </div>
                </article>

                <article class="porto-card" data-cat="game">
                    <div class="porto-media"><img src="assets/img/portfolio-3.svg" width="400" height="260" alt="Ilustrasi game platformer piksel dengan karakter kotak, koin, dan bendera finis" loading="lazy"></div>
                    <div class="porto-body">
                        <span class="porto-cat sticker-yellow">Game</span>
                        <h3><button class="porto-open" type="button" aria-haspopup="dialog">Pixel Dash — Platformer 2D</button></h3><!-- GANTI -->
                        <p class="porto-desc">Game platformer cepat buatan tim saat game jam 48 jam, dibuat dengan Godot.</p>
                        <span class="porto-more" aria-hidden="true">Lihat detail &rarr;</span>
                    </div>
                    <div class="porto-detail" hidden>
                        <!-- GANTI -->
                        <p>Game platformer 2D bertema lari cepat: kumpulkan koin, hindari duri, dan capai bendera secepat mungkin. Dibuat oleh tim 4 orang dalam 48 jam.</p>
                        <p><strong>Peran saya:</strong> programmer gameplay, mulai dari kontrol karakter, coyote time, sampai sistem checkpoint.</p>
                        <ul class="detail-tags"><li>Godot</li><li>GDScript</li><li>Aseprite</li><li>Game Jam</li></ul>
                    </div>
                </article>

                <article class="porto-card" data-cat="game mobile">
                    <div class="porto-media"><img src="assets/img/portfolio-4.svg" width="400" height="260" alt="Ilustrasi kotak-kotak huruf permainan tebak kata dengan bintang dan pengatur waktu" loading="lazy"></div>
                    <div class="porto-body">
                        <span class="porto-cat sticker-lilac">Game &middot; Mobile</span>
                        <h3><button class="porto-open" type="button" aria-haspopup="dialog">Tebak Kata Nusantara</button></h3><!-- GANTI -->
                        <p class="porto-desc">Game kuis kosakata daerah untuk Android, dengan mode waktu dan papan skor lokal.</p>
                        <span class="porto-more" aria-hidden="true">Lihat detail &rarr;</span>
                    </div>
                    <div class="porto-detail" hidden>
                        <!-- GANTI -->
                        <p>Game tebak kata kasual yang mengenalkan kosakata bahasa daerah. Ada tiga tingkat kesulitan, mode melawan waktu, dan skor tertinggi yang disimpan di perangkat.</p>
                        <p><strong>Yang saya pelajari:</strong> menyusun data soal dalam JSON, animasi UI sederhana, dan uji coba ke teman sekelas untuk umpan balik.</p>
                        <ul class="detail-tags"><li>Kotlin</li><li>Android</li><li>JSON</li></ul>
                    </div>
                </article>

                <article class="porto-card" data-cat="web acara">
                    <div class="porto-media"><img src="assets/img/portfolio-5.svg" width="400" height="260" alt="Ilustrasi poster acara dengan megafon dan tiket masuk" loading="lazy"></div>
                    <div class="porto-body">
                        <span class="porto-cat sticker-mint">Acara &middot; Web</span>
                        <h3><button class="porto-open" type="button" aria-haspopup="dialog">Microsite Pekan Informatika</button></h3><!-- GANTI -->
                        <p class="porto-desc">Laman informasi acara himpunan: jadwal, pembicara, dan formulir pendaftaran peserta.</p>
                        <span class="porto-more" aria-hidden="true">Lihat detail &rarr;</span>
                    </div>
                    <div class="porto-detail" hidden>
                        <!-- GANTI -->
                        <p>Microsite satu halaman untuk acara tahunan himpunan. Saya menggarapnya sambil menjadi panitia divisi acara, jadi isi rundown dan informasi peserta selalu terbaru.</p>
                        <p><strong>Hasil:</strong> peserta cukup membuka satu tautan untuk melihat jadwal, lokasi, dan cara mendaftar.</p>
                        <ul class="detail-tags"><li>HTML</li><li>CSS</li><li>JavaScript</li><li>Kepanitiaan</li></ul>
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
                <p class="section-sub">Mau ajak bikin game, kolaborasi aplikasi, atau butuh panitia? Kirim pesan saja.</p>
            </header>

            <div class="contact-grid">
                <div class="panel contact-info reveal">
                    <h3 class="panel-title">Temukan saya di</h3>
                    <ul class="social-list">
                        <!-- GANTI dengan akun asli -->
                        <li>
                            <a class="social social-mail" href="mailto:rasyid.ridlo@example.com">
                                <span class="social-label">Email</span>
                                <span class="social-value">rasyid.ridlo@example.com</span>
                            </a>
                        </li>
                        <!-- GANTI dengan akun asli -->
                        <li>
                            <a class="social social-gh" href="https://github.com/username" target="_blank" rel="noopener noreferrer">
                                <span class="social-label">GitHub</span>
                                <span class="social-value">github.com/username</span>
                            </a>
                        </li>
                        <!-- GANTI dengan akun asli -->
                        <li>
                            <a class="social social-in" href="https://www.linkedin.com/in/username" target="_blank" rel="noopener noreferrer">
                                <span class="social-label">LinkedIn</span>
                                <span class="social-value">linkedin.com/in/username</span>
                            </a>
                        </li>
                        <!-- GANTI dengan akun asli -->
                        <li>
                            <a class="social social-ig" href="https://www.instagram.com/username" target="_blank" rel="noopener noreferrer">
                                <span class="social-label">Instagram</span>
                                <span class="social-value">@username</span>
                            </a>
                        </li>
                    </ul>
                    <p class="contact-note">Biasanya membalas dalam 1–2 hari, kecuali sedang ikut game jam.</p><!-- GANTI -->
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
