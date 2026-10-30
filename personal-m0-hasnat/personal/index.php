<?php require_once __DIR__ . '/identity.php'; ?>
<!DOCTYPE html>
<html lang="id" data-theme="light">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="Hasnat Ferdiananda — Applied AI Engineer. Mahasiswa Informatika Telkom University.">
  <title><?= htmlspecialchars(MEMBER_NAMA, ENT_QUOTES, 'UTF-8') ?> (<?= htmlspecialchars(MEMBER_NIM, ENT_QUOTES, 'UTF-8') ?>)</title>
  <link rel="icon" href="assets/img/hasnat.jpg" type="image/jpeg">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <!-- Geist: explicit user choice for Swiss neo-grotesque matching Michal Rome reference -->
  <link href="https://fonts.googleapis.com/css2?family=Geist:wght@400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="assets/css/style.css">
  <script>
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
      <a class="brand" href="#profil">
        <img class="brand-avatar" src="assets/img/hasnat.jpg" width="28" height="28" alt="">
        <span class="brand-name"><?= htmlspecialchars(MEMBER_NAMA, ENT_QUOTES, 'UTF-8') ?></span>
      </a>

      <button class="nav-toggle" type="button" aria-expanded="false" aria-controls="site-nav" aria-label="Buka menu">
        <span aria-hidden="true">+ Menu</span>
      </button>

      <nav id="site-nav" class="site-nav" aria-label="Navigasi utama">
        <ul class="nav-list">
          <li><a href="#about">+ About</a></li>
          <li><a href="#portofolio">+ Work</a></li>
          <li><a href="#riwayat">+ Experience</a></li>
          <li><a href="#rsvp">+ RSVP</a></li>
          <li><a href="#kontak">+ Get in touch</a></li>
          <li><a class="nav-app" href="app/">App</a></li>
        </ul>
      </nav>

      <button class="theme-toggle" type="button" aria-label="Ganti ke mode gelap" title="Ganti tema">
        <span class="theme-label theme-label-dark">Dark</span>
        <span class="theme-label theme-label-light">Light</span>
      </button>
    </div>
  </header>

  <main id="main">
    <!-- HERO — typography as the primary graphic (Michal Rome pattern) -->
    <section id="profil" class="hero" aria-labelledby="hero-title">
      <div class="container">
        <h1 id="hero-title" class="hero-statement">
          <span class="hero-muted">Models are</span>
          <span class="hero-muted">the easy part.</span>
          <span class="hero-strong">I ship AI</span>
          <span class="hero-media">
            <span class="hero-media-frame">
              <img src="assets/img/hasnat.jpg" width="720" height="480" alt="Portrait of Hasnat Ferdiananda">
            </span>
          </span>
          <span class="hero-strong">that works.</span>
        </h1>

        <p class="hero-lede reveal">
          Applied AI Engineer — generative AI infrastructure, RAG, and agentic workflows from prototype to production.
          S1 Informatika, Telkom University · NIM <?= htmlspecialchars(MEMBER_NIM, ENT_QUOTES, 'UTF-8') ?> · route m0.
        </p>

        <dl class="hero-meta reveal">
          <div>
            <dt>Experience</dt>
            <dd>3+ years</dd>
          </div>
          <div>
            <dt>Based</dt>
            <dd>Indonesia</dd>
          </div>
          <div>
            <dt>Specialized</dt>
            <dd>Applied AI &amp; backend</dd>
          </div>
        </dl>
      </div>
    </section>

    <!-- WORKED WITH -->
    <section class="band" aria-label="Tempat pernah bekerja">
      <div class="container">
        <div class="band-head">
          <p class="label">Worked with</p>
        </div>
        <ul class="logo-row">
          <li>Virtuwed.id</li>
          <li>PT GITS Indonesia</li>
          <li>Telkom University</li>
          <li>APICTA 2023</li>
        </ul>
      </div>
    </section>

    <!-- ABOUT — portrait + copy like Michal Rome -->
    <section id="about" class="section" aria-labelledby="about-title">
      <div class="container section-grid">
        <p class="section-index" aria-hidden="true">01</p>
        <div class="about-layout">
          <figure class="about-photo reveal">
            <img src="assets/img/hasnat.jpg" width="640" height="800" alt="Hasnat Ferdiananda">
          </figure>
          <div class="about-copy">
            <p class="label">About me</p>
            <h2 id="about-title" class="section-display">I make complex AI systems feel reliable.</h2>
            <div class="prose reveal">
              <p>
                Berpengalaman membawa konsep AI dari prototipe ke production: multi-agent workflows, RAG,
                evaluasi LLM, dan API yang scalable. Fokus pada latency, reliability, observability, dan safeguards.
              </p>
              <p>
                Saat ini mahasiswa S1 Informatika Telkom University (beasiswa <strong>APERTI BUMN</strong>),
                sekaligus ketua kelompok aplikasi RSVP untuk mata kuliah Komputasi Awan.
              </p>
            </div>
            <ul class="chip-plain reveal" aria-label="Keahlian utama">
              <li>Python · FastAPI</li>
              <li>LangGraph · RAG</li>
              <li>TypeScript</li>
              <li>AWS · GCP · Azure</li>
              <li>Docker · CI/CD</li>
              <li>PostgreSQL</li>
            </ul>
          </div>
        </div>
      </div>
    </section>

    <!-- EXPERIENCE -->
    <section id="riwayat" class="section" aria-labelledby="riwayat-title">
      <div class="container section-grid">
        <p class="section-index" aria-hidden="true">02</p>
        <div>
          <p class="label">Experience</p>
          <h2 id="riwayat-title" class="section-display">Roles that shaped the craft.</h2>

          <ol class="role-list">
            <li class="role reveal">
              <div class="role-meta">
                <span class="role-when">Jun 2023 — Nov 2024</span>
                <span class="role-where">Virtuwed.id</span>
              </div>
              <h3>Lead Developer</h3>
              <p>Memimpin platform pernikahan virtual: infrastruktur scalable, fitur untuk APICTA 2023, 2.000+ unique visitors dan 102.000+ request.</p>
            </li>
            <li class="role reveal">
              <div class="role-meta">
                <span class="role-when">Jan 2024 — May 2024</span>
                <span class="role-where">PT GITS Indonesia</span>
              </div>
              <h3>Software Engineer</h3>
              <p>Code quality assessment (24 critical vulnerabilities), pre-sales review untuk klien Singapura, dan community platform Nuxt.js &amp; Elysia.js.</p>
            </li>
            <li class="role reveal">
              <div class="role-meta">
                <span class="role-when">2026</span>
                <span class="role-where">Telkom University</span>
              </div>
              <h3>Ketua Kelompok — Aplikasi RSVP</h3>
              <p>Koordinasi repo m0–m4 dan aplikasi RSVP PHP &amp; MySQL di XAMPP untuk Komputasi Awan.</p>
            </li>
          </ol>

          <div class="edu-block reveal">
            <p class="label">Education</p>
            <h3>Telkom University</h3>
            <p>Bachelor of Computer Science · Sep 2024 — Sep 2028 (Expected) · APERTI BUMN</p>
          </div>

          <div class="edu-block reveal">
            <p class="label">Selected achievements</p>
            <ul class="plain-list">
              <li>Finalist — ZTE Indonesia Business Plan Competition 2025</li>
              <li>Top 10 Startup of The Year — APICTA Hong Kong 2023</li>
              <li>Top 5 — West Java LPDP Business Competition 2023</li>
              <li>1st Winner — Mini Hackathon Challenge BFI Finance 2023</li>
              <li>2nd Runner-up Minicase — COMPFEST 2022</li>
              <li>2nd Winner — Student Competency Competition 2021</li>
            </ul>
          </div>
        </div>
      </div>
    </section>

    <!-- WORK / PORTFOLIO -->
    <section id="portofolio" class="section" aria-labelledby="porto-title">
      <div class="container section-grid">
        <p class="section-index" aria-hidden="true">03</p>
        <div>
          <p class="label">Selected work</p>
          <h2 id="porto-title" class="section-display">Projects with measurable outcomes.</h2>

          <div class="filter-bar reveal" role="group" aria-label="Filter kategori portofolio">
            <button type="button" class="filter-btn is-active" data-filter="all" aria-pressed="true">All</button>
            <button type="button" class="filter-btn" data-filter="ai" aria-pressed="false">AI</button>
            <button type="button" class="filter-btn" data-filter="backend" aria-pressed="false">Backend</button>
            <button type="button" class="filter-btn" data-filter="web" aria-pressed="false">Web</button>
            <button type="button" class="filter-btn" data-filter="cloud" aria-pressed="false">Cloud</button>
          </div>
          <p class="filter-status sr-only" aria-live="polite"></p>

          <div class="work-list">
            <article class="work-item porto-card reveal" data-category="ai"
                     data-title="Agentic AI for Legal IP Audit &amp; Trademark Strategy"
                     data-detail="Sistem agentic AI (LangGraph, Gemini) dengan RAG untuk mengotomasi pre-audit merek dagang, mengurangi beban review legal manual dan risiko penolakan aplikasi. Dilengkapi scoring engine untuk evaluasi kemiripan teks dan kelas, membantu mitigasi risiko rebranding hingga $500k."
                     data-tech="LangGraph · Gemini · RAG · Python">
              <button type="button" class="work-open porto-open" aria-label="Detail: Agentic AI Legal IP Audit">
                <span class="work-cat">AI</span>
                <span class="work-body">
                  <h3>Agentic AI for Legal IP Audit &amp; Trademark Strategy</h3>
                  <p>Pre-audit merek dagang otomatis dengan RAG dan scoring kemiripan. Jan–Mar 2026.</p>
                </span>
                <span class="work-cta" aria-hidden="true">View</span>
              </button>
            </article>

            <article class="work-item porto-card reveal" data-category="ai"
                     data-title="Soulmi: AI Mental Wellness Companion"
                     data-detail="Platform pendamping kesehatan mental berbasis AI. Discaling ke 80+ pengguna aktif pada fase awal dengan fokus keandalan teknis. Mengembangkan sistem avatar 3D real-time yang menampilkan ekspresi emosi tersinkron dengan respons AI untuk meningkatkan immersi pengguna."
                     data-tech="AI · Three.js · Real-time avatar">
              <button type="button" class="work-open porto-open" aria-label="Detail: Soulmi">
                <span class="work-cat">AI</span>
                <span class="work-body">
                  <h3>Soulmi: AI Mental Wellness Companion</h3>
                  <p>Companion AI dengan avatar 3D emosional; 80+ pengguna aktif. Sep–Dec 2024.</p>
                </span>
                <span class="work-cta" aria-hidden="true">View</span>
              </button>
            </article>

            <article class="work-item porto-card reveal" data-category="web"
                     data-title="Virtuwed.id — Virtual Wedding Platform"
                     data-detail="Platform pernikahan virtual yang membuat upacara lebih mudah diakses. Sebagai Lead Developer mengarahkan development dan maintenance berkelanjutan, mendorong 2.000+ unique visitors dan 102.000+ user requests, serta infrastruktur yang handal saat beban tinggi. Fitur inovatif juga disiapkan untuk APICTA 2023 Hong Kong (Top 10 Startup of The Year)."
                     data-tech="Full-stack · Scalable infrastructure · APICTA 2023">
              <button type="button" class="work-open porto-open" aria-label="Detail: Virtuwed.id">
                <span class="work-cat">Web</span>
                <span class="work-body">
                  <h3>Virtuwed.id — Virtual Wedding Platform</h3>
                  <p>Lead Developer. 2.000+ visitors, 102K+ requests, Top 10 APICTA 2023.</p>
                </span>
                <span class="work-cta" aria-hidden="true">View</span>
              </button>
            </article>

            <article class="work-item porto-card reveal" data-category="backend"
                     data-title="Anime Community Platform (GITS)"
                     data-detail="Platform komunitas untuk penggemar anime yang dikembangkan dan di-deploy secara scalable memakai Nuxt.js dan Elysia.js saat bekerja di PT GITS Indonesia. Dilengkapi juga assessment kualitas kode untuk platform sosial media (10K+ unduhan) yang mengidentifikasi 24 kerentanan kritis."
                     data-tech="Nuxt.js · Elysia.js · Code quality">
              <button type="button" class="work-open porto-open" aria-label="Detail: Anime Community Platform">
                <span class="work-cat">Backend</span>
                <span class="work-body">
                  <h3>Anime Community Platform (GITS)</h3>
                  <p>Community platform scalable dengan Nuxt.js &amp; Elysia.js.</p>
                </span>
                <span class="work-cta" aria-hidden="true">View</span>
              </button>
            </article>

            <article class="work-item porto-card reveal" data-category="cloud"
                     data-title="Aplikasi RSVP Kelompok (Komputasi Awan)"
                     data-detail="Aplikasi pendaftaran acara (RSVP) yang dikerjakan bersama 5 anggota kelompok. Setiap anggota menjalankan laman personal di server lokal masing-masing, sementara aplikasi bersama memakai satu basis data. Saya bertanggung jawab atas struktur repo, partial bersama, dan integrasi sebagai ketua kelompok (m0)."
                     data-tech="PHP · MySQL · XAMPP · Git">
              <button type="button" class="work-open porto-open" aria-label="Detail: Aplikasi RSVP">
                <span class="work-cat">Cloud</span>
                <span class="work-body">
                  <h3>Aplikasi RSVP Kelompok</h3>
                  <p>RSVP acara bersama dengan kuota peserta — ketua repo m0.</p>
                </span>
                <span class="work-cta" aria-hidden="true">View</span>
              </button>
            </article>
          </div>
        </div>
      </div>
    </section>

    <!-- SKILLS (plain lists — no fake % bars) -->
    <section id="keahlian" class="section" aria-labelledby="keahlian-title">
      <div class="container section-grid">
        <p class="section-index" aria-hidden="true">04</p>
        <div>
          <p class="label">Skills</p>
          <h2 id="keahlian-title" class="section-display">Tools I reach for first.</h2>
          <div class="skills-grid reveal">
            <div>
              <h3 class="mini-title">Engineering</h3>
              <p>Python, FastAPI, TypeScript, JavaScript, Java, SQL, PostgreSQL, Docker, CI/CD, Git</p>
            </div>
            <div>
              <h3 class="mini-title">AI systems</h3>
              <p>LangChain, LangGraph, LangSmith, Pinecone, RAG, Agentic AI, LLM evaluations, fine-tuning, PyTorch, TensorFlow</p>
            </div>
            <div>
              <h3 class="mini-title">Product surface</h3>
              <p>React, Next.js, Nuxt.js, Vue.js, Node.js, Three.js, n8n</p>
            </div>
            <div>
              <h3 class="mini-title">Cloud &amp; ops</h3>
              <p>AWS, GCP (Vertex AI), Azure ML, MLflow, Snowflake, observability, distributed systems</p>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- RSVP (assignment requirement) -->
    <section id="rsvp" class="section" aria-labelledby="rsvp-title">
      <div class="container section-grid">
        <p class="section-index" aria-hidden="true">05</p>
        <div>
          <p class="label">Group app</p>
          <h2 id="rsvp-title" class="section-display">Acara kelompok (RSVP)</h2>
          <p class="section-lead reveal">Data diambil langsung dari basis data aplikasi bersama.</p>
          <div class="rsvp-wrap reveal">
<?php include __DIR__ . '/app/partials/ringkasan.php'; ?>
          </div>
          <p class="rsvp-cta reveal"><a class="btn btn-primary" href="app/">Open RSVP app</a></p>
        </div>
      </div>
    </section>

    <!-- CONTACT -->
    <section id="kontak" class="section section-last" aria-labelledby="kontak-title">
      <div class="container section-grid">
        <p class="section-index" aria-hidden="true">06</p>
        <div>
          <p class="label">Get in touch</p>
          <h2 id="kontak-title" class="section-display">Let’s talk about AI systems that ship.</h2>

          <ul class="social-row reveal">
            <li><a href="mailto:ferdianandahasnat@gmail.com">+ Email</a></li>
            <li><a href="tel:+628996944806">+ Phone</a></li>
            <li><a href="https://github.com/hasnat5" target="_blank" rel="noopener noreferrer">+ GitHub</a></li>
            <li><a href="https://www.linkedin.com/in/hasnatf/" target="_blank" rel="noopener noreferrer">+ LinkedIn</a></li>
            <li><a href="https://www.instagram.com/hasnat5_/" target="_blank" rel="noopener noreferrer">+ Instagram</a></li>
          </ul>

          <div class="contact-layout">
            <div class="contact-details reveal">
              <p><a href="mailto:ferdianandahasnat@gmail.com">ferdianandahasnat@gmail.com</a></p>
              <p><a href="tel:+628996944806">+62 899-6944-806</a></p>
              <p class="muted">Terbuka untuk diskusi generative AI, Agentic AI, backend, atau kolaborasi proyek.</p>
            </div>

            <form id="contact-form" class="contact-form reveal" action="#" method="post" novalidate>
              <div class="field">
                <label for="f-nama">Name</label>
                <input id="f-nama" name="nama" type="text" autocomplete="name" aria-describedby="err-nama" required>
                <p id="err-nama" class="field-error" aria-live="polite"></p>
              </div>
              <div class="field">
                <label for="f-email">Email</label>
                <input id="f-email" name="email" type="email" autocomplete="email" aria-describedby="err-email" required>
                <p id="err-email" class="field-error" aria-live="polite"></p>
              </div>
              <div class="field">
                <label for="f-pesan">Message</label>
                <textarea id="f-pesan" name="pesan" rows="5" aria-describedby="err-pesan" required></textarea>
                <p id="err-pesan" class="field-error" aria-live="polite"></p>
              </div>
              <button type="submit" class="btn btn-primary">Send message</button>
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
      <p class="muted">Komputasi Awan · Tugas 1 · <a href="app/">App</a> · <a href="#profil">Top</a></p>
    </div>
  </footer>

  <dialog id="porto-modal" class="modal" aria-labelledby="modal-title">
    <div class="modal-inner">
      <button type="button" class="modal-close" aria-label="Tutup detail">Close</button>
      <div class="modal-body">
        <p class="label modal-tag">AI</p>
        <h3 id="modal-title" class="modal-title">Judul</h3>
        <p class="modal-detail"></p>
        <p class="modal-tech"></p>
      </div>
    </div>
  </dialog>
</body>
</html>
