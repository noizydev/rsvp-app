<?php require_once __DIR__ . '/identity.php'; ?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= htmlspecialchars(MEMBER_NAMA) ?> (<?= htmlspecialchars(MEMBER_NIM) ?>) — Founder &amp; AI Builder</title>
    <meta name="description" content="Laman personal <?= htmlspecialchars(MEMBER_NAMA) ?>, mahasiswa Informatika Telkom University, founder Gobot.ID dan Wibusoft, fokus pada aplikasi AI multi-model.">
    <meta name="theme-color" content="#F3F1EA">
    <link rel="icon" href="assets/img/avatar.svg" type="image/svg+xml">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Bricolage+Grotesque:opsz,wght@12..96,600;12..96,800&family=DM+Mono:wght@400;500&family=Manrope:wght@400;600;700&display=swap">
    <link rel="stylesheet" href="assets/css/style.css">
    <script>
        // Pasang tema tersimpan sebelum halaman digambar agar tidak berkedip.
        (function () {
            var d = document.documentElement;
            d.classList.add('js');
            try {
                var t = localStorage.getItem('df-theme');
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
            <span class="brand-mark" aria-hidden="true">DF</span>
            <span class="brand-text">daffandri<span class="brand-dot">/</span>build</span>
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

    <!-- ===================== PROFIL (bento) ===================== -->
    <section class="hero" id="profil" aria-labelledby="hero-title">
        <div class="container bento">
            <div class="tile tile-intro reveal">
                <p class="hero-hello">&gt; halo, saya</p>
                <h1 id="hero-title"><span class="name-hl"><?= htmlspecialchars(MEMBER_NAMA) ?></span></h1>
                <p class="hero-nim">
                    <span class="nim-label">NIM</span>
                    <span class="nim-value"><?= htmlspecialchars(MEMBER_NIM) ?></span>
                </p>
                <p class="hero-lead">
                    Pemikir strategis dan pemecah masalah yang terbiasa memimpin tim lintas budaya
                    untuk mencapai tujuan bersama. Kini fokus pada <mark>aplikasi AI multi-model</mark>,
                    membawa kemampuan perencanaan, inisiatif strategis, dan
                    <mark class="mark-violet">pengembangan konsep baru</mark> ke bidang teknologi ini.
                </p>
                <ul class="tag-list" aria-label="Peran dan fokus">
                    <li class="sticker sticker-lime">Founder Gobot.ID</li>
                    <li class="sticker sticker-orange">Founder Wibusoft</li>
                    <li class="sticker sticker-violet">AI Multi-model</li>
                    <li class="sticker sticker-aqua">Business Development</li>
                </ul>
                <div class="hero-cta">
                    <a class="btn btn-primary" href="#portofolio">Lihat Portofolio</a>
                    <a class="btn btn-ghost" href="#kontak">Ajak Kolaborasi</a>
                </div>
            </div>

            <figure class="tile tile-avatar reveal">
                <img src="assets/img/avatar.svg" width="240" height="240" alt="Avatar ilustrasi <?= htmlspecialchars(MEMBER_NAMA) ?> berkacamata dengan lencana AI">
            </figure>

            <div class="tile tile-s1 reveal">
                <span class="stat-num"><span data-count="100">100</span>K+</span>
                <span class="stat-label">pengguna terdaftar chatbot Wibusoft</span>
            </div>

            <div class="tile tile-focus reveal">
                <span class="focus-label">Sedang dikerjakan</span>
                <p class="focus-text">Sistem layanan pelanggan berbasis AI untuk bisnis B2B di Gobot.ID<span class="cursor" aria-hidden="true"></span></p>
            </div>

            <div class="tile tile-s2 reveal">
                <span class="stat-num">+<span data-count="40">40</span>%</span>
                <span class="stat-label">pendapatan Wibusoft setelah strategi penjualan dirombak</span>
            </div>

            <div class="tile tile-s3 reveal">
                <span class="stat-num"><span data-count="2">2</span></span>
                <span class="stat-label">usaha teknologi dirintis sejak 2021</span>
            </div>
        </div>
    </section>

    <div class="ticker" aria-hidden="true">
        <div class="ticker-track">
            <span>AI CUSTOMER SERVICE</span><span>&#9632;</span><span>WHATSAPP CHATBOT</span><span>&#9632;</span><span>BUSINESS DEVELOPMENT</span><span>&#9632;</span><span>MACHINE LEARNING</span><span>&#9632;</span><span>CLOUD &amp; DISTRIBUTED</span><span>&#9632;</span>
            <span>AI CUSTOMER SERVICE</span><span>&#9632;</span><span>WHATSAPP CHATBOT</span><span>&#9632;</span><span>BUSINESS DEVELOPMENT</span><span>&#9632;</span><span>MACHINE LEARNING</span><span>&#9632;</span><span>CLOUD &amp; DISTRIBUTED</span><span>&#9632;</span>
        </div>
    </div>

    <!-- ===================== PENDIDIKAN, ORGANISASI & PENGALAMAN ===================== -->
    <section class="section" id="perjalanan" aria-labelledby="perjalanan-title">
        <div class="container">
            <header class="section-head reveal">
                <span class="kicker">01 / Perjalanan</span>
                <h2 id="perjalanan-title">Pendidikan &amp; Pengalaman</h2>
            </header>

            <div class="two-col">
                <div class="col reveal">
                    <h3 class="col-title"><span class="col-icon" aria-hidden="true">&#127891;</span> Pendidikan &amp; Organisasi</h3>
                    <ol class="timeline">
                        <li class="t-item">
                            <span class="t-date sticker-lime">Agu 2024 – sekarang</span>
                            <h4>Telkom University, Bandung</h4>
                            <p class="t-sub">S1 Informatika</p>
                            <p>Mahasiswa semester 5. Saat ini mendalami komputasi awan dan sistem terdistribusi lewat proyek aplikasi RSVP kelompok.</p>
                        </li>
                        <li class="t-item">
                            <span class="t-date sticker-violet">Des 2024 – Des 2025</span>
                            <h4>Google Developer Group on Campus</h4>
                            <p class="t-sub">Member of Machine Learning (ML) · Bandung</p>
                            <p>Bergabung di divisi Machine Learning komunitas developer kampus untuk memperdalam dasar-dasar ML.</p>
                        </li>
                        <li class="t-item">
                            <span class="t-date sticker-aqua">Jan 2025 – Feb 2026</span>
                            <h4>AIESEC in Bandung</h4>
                            <p class="t-sub">Team Member, Business Development · Strategic Commercial Growth I</p>
                            <p>Bagian dari tim pengembangan bisnis yang mendorong pertumbuhan komersial organisasi secara strategis.</p>
                        </li>
                    </ol>
                </div>

                <div class="col reveal">
                    <h3 class="col-title"><span class="col-icon" aria-hidden="true">&#128640;</span> Pengalaman Kerja</h3>
                    <ol class="timeline">
                        <li class="t-item">
                            <span class="t-date sticker-orange">Jul 2022 – sekarang</span>
                            <h4>PT Gobot Teknologi Indonesia</h4>
                            <p class="t-sub">Founder · Gobot.ID</p>
                            <p>Gobot.ID adalah penyedia layanan pelanggan berbasis AI (SaaS) untuk meningkatkan layanan dukungan perusahaan.</p>
                            <ul class="t-points">
                                <li>Menginisiasi sistem customer service berbasis AI dengan fokus implementasi B2B.</li>
                                <li>Memimpin tim karyawan dan freelancer dalam pengembangan AI Customer Service.</li>
                            </ul>
                        </li>
                        <li class="t-item">
                            <span class="t-date sticker-pink">Agu 2021 – sekarang</span>
                            <h4>Wibusoft.com</h4>
                            <p class="t-sub">Founder</p>
                            <p>Menyediakan layanan hiburan berbasis chatbot WhatsApp bagi pemilik komunitas.</p>
                            <ul class="t-points">
                                <li>Mengembangkan chatbot hiburan untuk komunitas informal, gamer, tech enthusiast, dan pencinta anime: <strong>100 ribu+ pengguna terdaftar</strong> dan ratusan pengguna aktif dalam 3 tahun terakhir.</li>
                                <li>Merombak strategi penjualan sehingga pendapatan naik <strong>40% (sekitar Rp200 juta per tahun)</strong> dalam 2 tahun terakhir.</li>
                            </ul>
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
                <h2 id="keahlian-title">Yang Saya Bawa</h2>
                <p class="section-sub">Setiap keahlian disertai tempat saya memakainya, bukan sekadar angka persentase.</p>
            </header>

            <div class="skills-grid">
                <div class="panel panel-tech reveal">
                    <h3 class="panel-title">Teknis</h3>
                    <!-- GANTI: tambah/kurangi sesuai keahlian teknis Anda -->
                    <ul class="skill-rows">
                        <li><strong>Chatbot WhatsApp</strong><span>Wibusoft · sejak 2021</span></li>
                        <li><strong>AI Customer Service (SaaS)</strong><span>Gobot.ID · sejak 2022</span></li>
                        <li><strong>Aplikasi AI multi-model</strong><span>Fokus pengembangan saat ini</span></li>
                        <li><strong>Machine Learning</strong><span>GDG on Campus · divisi ML</span></li>
                        <li><strong>PHP, MySQL, HTML/CSS/JS</strong><span>Aplikasi RSVP kelompok</span></li>
                        <li><strong>Git &amp; GitHub</strong><span>Kolaborasi branch &amp; pull request</span></li>
                    </ul>
                </div>

                <div class="panel-stack">
                    <div class="panel panel-soft reveal">
                        <h3 class="panel-title">Bisnis &amp; Kepemimpinan</h3>
                        <ul class="chip-list">
                            <li class="chip chip-lime">Perencanaan strategis</li>
                            <li class="chip chip-orange">Business development</li>
                            <li class="chip chip-aqua">Strategi penjualan</li>
                            <li class="chip chip-lime">Memimpin tim lintas budaya</li>
                            <li class="chip chip-orange">Manajemen tim &amp; freelancer</li>
                            <li class="chip chip-aqua">Pengembangan konsep produk</li>
                            <li class="chip chip-lime">Problem solving</li>
                        </ul>
                    </div>
                    <div class="panel panel-tools reveal">
                        <h3 class="panel-title">Bidang yang Digeluti</h3>
                        <ul class="chip-list chip-list-plain">
                            <li class="chip">SaaS B2B</li>
                            <li class="chip">Conversational AI</li>
                            <li class="chip">Community product</li>
                            <li class="chip">Cloud computing</li>
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
                <h2 id="portofolio-title">Proyek &amp; Usaha</h2>
                <p class="section-sub">Klik kartu untuk melihat detail. Pakai filter untuk memilih kategori.</p>
            </header>

            <div class="filter-bar reveal" role="group" aria-label="Filter kategori portofolio">
                <button class="filter-btn" type="button" data-filter="semua" aria-pressed="true">Semua</button>
                <button class="filter-btn" type="button" data-filter="ai" aria-pressed="false">AI</button>
                <button class="filter-btn" type="button" data-filter="chatbot" aria-pressed="false">Chatbot</button>
                <button class="filter-btn" type="button" data-filter="web" aria-pressed="false">Web</button>
                <button class="filter-btn" type="button" data-filter="bisnis" aria-pressed="false">Bisnis</button>
            </div>
            <p class="porto-count" id="portoCount" aria-live="polite">Menampilkan 4 proyek</p>

            <div class="porto-grid">
                <article class="porto-card" data-cat="ai bisnis">
                    <div class="porto-media"><img src="assets/img/portfolio-1.svg" width="400" height="260" alt="Ilustrasi dasbor layanan pelanggan AI dengan percakapan bot dan agen" loading="lazy"></div>
                    <div class="porto-body">
                        <span class="porto-cat sticker-lime">AI &middot; SaaS</span>
                        <h3><button class="porto-open" type="button" aria-haspopup="dialog">Gobot.ID — AI Customer Service</button></h3>
                        <p class="porto-desc">Layanan pelanggan berbasis AI (SaaS) untuk perusahaan, dengan fokus implementasi B2B.</p>
                        <span class="porto-more" aria-hidden="true">Lihat detail &rarr;</span>
                    </div>
                    <div class="porto-detail" hidden>
                        <p>Produk utama PT Gobot Teknologi Indonesia, perusahaan yang saya dirikan pada Juli 2022. Gobot.ID membantu perusahaan meningkatkan layanan dukungan pelanggan dengan sistem customer service berbasis AI.</p>
                        <p><strong>Peran saya:</strong> founder; menginisiasi sistem AI customer service, menentukan fokus B2B, dan memimpin tim karyawan serta freelancer dalam pengembangannya.</p>
                        <p><a href="https://gobot.id" target="_blank" rel="noopener noreferrer">gobot.id</a></p><!-- GANTI bila alamat situs berbeda -->
                        <ul class="detail-tags"><li>AI</li><li>SaaS</li><li>B2B</li><li>Kepemimpinan</li></ul>
                    </div>
                </article>

                <article class="porto-card" data-cat="chatbot bisnis">
                    <div class="porto-media"><img src="assets/img/portfolio-2.svg" width="400" height="260" alt="Ilustrasi ponsel berisi obrolan chatbot hiburan dengan stiker game dan anime" loading="lazy"></div>
                    <div class="porto-body">
                        <span class="porto-cat sticker-violet">Chatbot</span>
                        <h3><button class="porto-open" type="button" aria-haspopup="dialog">Wibusoft — Chatbot Hiburan WhatsApp</button></h3>
                        <p class="porto-desc">Chatbot hiburan untuk komunitas gamer, tech enthusiast, dan pencinta anime dengan 100 ribu+ pengguna terdaftar.</p>
                        <span class="porto-more" aria-hidden="true">Lihat detail &rarr;</span>
                    </div>
                    <div class="porto-detail" hidden>
                        <p>Usaha pertama saya sejak Agustus 2021: layanan hiburan berbasis chatbot WhatsApp yang disediakan untuk para pemilik komunitas. Penggunanya mencakup komunitas informal, gamer, tech enthusiast, dan pencinta anime.</p>
                        <p><strong>Hasil:</strong> lebih dari 100 ribu pengguna terdaftar dan ratusan pengguna aktif dalam 3 tahun terakhir. Setelah strategi penjualan dirombak, pendapatan naik 40% atau sekitar Rp200 juta per tahun dalam 2 tahun terakhir.</p>
                        <p><a href="https://wibusoft.com" target="_blank" rel="noopener noreferrer">wibusoft.com</a></p>
                        <ul class="detail-tags"><li>WhatsApp Bot</li><li>Komunitas</li><li>Strategi penjualan</li></ul>
                    </div>
                </article>

                <article class="porto-card" data-cat="web">
                    <div class="porto-media"><img src="assets/img/portfolio-3.svg" width="400" height="260" alt="Ilustrasi tiket acara dan bar sisa kuota aplikasi RSVP di lima server" loading="lazy"></div>
                    <div class="porto-body">
                        <span class="porto-cat sticker-aqua">Web</span>
                        <h3><button class="porto-open" type="button" aria-haspopup="dialog">Aplikasi RSVP Kelompok (Komputasi Awan)</button></h3>
                        <p class="porto-desc">Aplikasi pendaftaran acara berbasis PHP &amp; MySQL dengan sisa kuota real-time di lima server anggota.</p>
                        <span class="porto-more" aria-hidden="true">Lihat detail &rarr;</span>
                    </div>
                    <div class="porto-detail" hidden>
                        <p>Proyek kelompok mata kuliah Komputasi Awan dan Terdistribusi. Lima anggota menjalankan kode yang sama di server masing-masing; setiap pendaftaran mencatat server penerimanya, dan transaksi database menjaga agar kuota tidak terlampaui.</p>
                        <p><strong>Peran saya (route m1):</strong> partial banner <em>served by</em>, ringkasan acara untuk personal page, dan tampilan aplikasi.</p>
                        <ul class="detail-tags"><li>PHP</li><li>MySQL</li><li>XAMPP</li><li>Git</li></ul>
                    </div>
                </article>

                <article class="porto-card" data-cat="bisnis">
                    <div class="porto-media"><img src="assets/img/portfolio-4.svg" width="400" height="260" alt="Ilustrasi papan strategi bisnis dengan grafik pertumbuhan dan catatan rencana" loading="lazy"></div>
                    <div class="porto-body">
                        <span class="porto-cat sticker-orange">Bisnis</span>
                        <h3><button class="porto-open" type="button" aria-haspopup="dialog">Strategic Commercial Growth — AIESEC in Bandung</button></h3>
                        <p class="porto-desc">Kerja tim pengembangan bisnis untuk pertumbuhan komersial organisasi, Januari 2025 – Februari 2026.</p>
                        <span class="porto-more" aria-hidden="true">Lihat detail &rarr;</span>
                    </div>
                    <div class="porto-detail" hidden>
                        <p>Sebagai Team Member Business Development di AIESEC in Bandung, saya tergabung dalam Strategic Commercial Growth I: tim yang bertugas mengembangkan sisi komersial dan kemitraan organisasi.</p>
                        <p><strong>Yang saya bawa:</strong> pengalaman merintis usaha sendiri, perencanaan strategis, dan kerja sama dalam tim lintas budaya.</p>
                        <!-- GANTI: tambahkan capaian konkret (jumlah mitra, program, dsb.) bila ada -->
                        <ul class="detail-tags"><li>Business Development</li><li>Kemitraan</li><li>Organisasi</li></ul>
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
                <h2 id="kontak-title">Mari Terhubung</h2>
                <p class="section-sub">Tertarik kolaborasi soal AI, chatbot, atau pengembangan bisnis? Kirim pesan saja.</p>
            </header>

            <div class="contact-grid">
                <div class="panel contact-info reveal">
                    <h3 class="panel-title">Temukan saya di</h3>
                    <ul class="social-list">
                        <li>
                            <a class="social social-mail" href="mailto:daffandrifaiz@student.telkomuniversity.ac.id">
                                <span class="social-label">Email</span>
                                <span class="social-value">daffandrifaiz@student.telkomuniversity.ac.id</span>
                            </a>
                        </li>
                        <li>
                            <a class="social social-in" href="https://www.linkedin.com/in/daffandri/" target="_blank" rel="noopener noreferrer">
                                <span class="social-label">LinkedIn</span>
                                <span class="social-value">linkedin.com/in/daffandri</span>
                            </a>
                        </li>
                        <li>
                            <a class="social social-gh" href="https://github.com/noizydev" target="_blank" rel="noopener noreferrer">
                                <span class="social-label">GitHub</span>
                                <span class="social-value">github.com/noizydev</span>
                            </a>
                        </li>
                    </ul>
                    <p class="contact-note">Berbasis di Bandung · terbuka untuk diskusi produk AI dan kemitraan.</p>
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
                        <textarea id="pesan" name="pesan" rows="5" required minlength="10" maxlength="500" aria-describedby="pesanError" placeholder="Ceritakan ide atau kebutuhanmu..."></textarea>
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
