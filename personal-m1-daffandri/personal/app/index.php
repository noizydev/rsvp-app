<?php
// index.php — halaman utama aplikasi bersama Pendaftaran Acara (RSVP).
// Fitur: daftar acara + sisa kuota (baca), pencarian & paginasi, form pendaftaran (tulis),
// daftar pendaftar terbaru, form tambah acara, dan pembaruan sisa kuota via AJAX.

require_once __DIR__ . '/lib/bootstrap.php';
start_session();

const PER_HALAMAN = 6;

$q        = trim((string) ($_GET['q'] ?? ''));
$q        = function_exists('mb_substr') ? mb_substr($q, 0, 100, 'UTF-8') : substr($q, 0, 100);
$halaman  = max(1, (int) ($_GET['page'] ?? 1));
$pilihId  = filter_var($_GET['acara'] ?? '', FILTER_VALIDATE_INT, ['options' => ['min_range' => 1]]) ?: null;

$flash       = flash_take();
$formDaftar  = form_state_take('daftar');
$formAcara   = form_state_take('acara');
$oldDaftar   = $formDaftar['old'];
$errDaftar   = $formDaftar['errors'];
$oldAcara    = $formAcara['old'];
$errAcara    = $formAcara['errors'];
$csrf        = csrf_token();

$dbError     = null;
$acaraList   = [];
$total       = 0;
$totalHal    = 1;
$pilihan     = null;
$opsiAcara   = [];
$pendaftar   = [];
$statRoute   = [];

try {
    $pdo = db();

    // --- Daftar acara: pencarian + paginasi -------------------------------
    $where  = '';
    $params = [];
    if ($q !== '') {
        $like  = '%' . addcslashes($q, '%_\\') . '%';
        $where = 'WHERE (a.judul LIKE :q1 OR a.lokasi LIKE :q2 OR a.deskripsi LIKE :q3)';
        $params = [':q1' => $like, ':q2' => $like, ':q3' => $like];
    }

    $stmt = $pdo->prepare("SELECT COUNT(*) FROM acara a $where");
    $stmt->execute($params);
    $total    = (int) $stmt->fetchColumn();
    $totalHal = max(1, (int) ceil($total / PER_HALAMAN));
    $halaman  = min($halaman, $totalHal);

    $stmt = $pdo->prepare(
        "SELECT a.id, a.route_id, a.judul, a.deskripsi, a.lokasi, a.waktu_mulai, a.kuota, a.terisi,
                ag.nama AS pembuat
           FROM acara a
           LEFT JOIN anggota ag ON ag.route_id = a.route_id
           $where
          ORDER BY (a.waktu_mulai < NOW()) ASC, a.waktu_mulai ASC, a.id ASC
          LIMIT :lim OFFSET :off"
    );
    foreach ($params as $k => $v) {
        $stmt->bindValue($k, $v, PDO::PARAM_STR);
    }
    $stmt->bindValue(':lim', PER_HALAMAN, PDO::PARAM_INT);
    $stmt->bindValue(':off', ($halaman - 1) * PER_HALAMAN, PDO::PARAM_INT);
    $stmt->execute();
    $acaraList = $stmt->fetchAll();

    // --- Acara yang dipilih (detail di atas form) --------------------------
    if ($pilihId) {
        $stmt = $pdo->prepare(
            'SELECT a.*, ag.nama AS pembuat FROM acara a
               LEFT JOIN anggota ag ON ag.route_id = a.route_id
              WHERE a.id = :id'
        );
        $stmt->execute([':id' => $pilihId]);
        $pilihan = $stmt->fetch() ?: null;
    }

    // --- Opsi acara di form pendaftaran (yang belum dimulai) --------------
    $opsiAcara = $pdo->query(
        'SELECT id, judul, waktu_mulai, kuota, terisi FROM acara
          WHERE waktu_mulai > NOW() ORDER BY waktu_mulai ASC'
    )->fetchAll();

    // --- Pendaftar terbaru -------------------------------------------------
    $sqlPendaftar = 'SELECT p.nama, p.email, p.instansi, p.route_id, p.created_at, a.judul
                       FROM pendaftar p JOIN acara a ON a.id = p.acara_id';
    if ($pilihan) {
        $stmt = $pdo->prepare($sqlPendaftar . ' WHERE p.acara_id = :id ORDER BY p.created_at DESC, p.id DESC LIMIT 10');
        $stmt->execute([':id' => $pilihan['id']]);
    } else {
        $stmt = $pdo->prepare($sqlPendaftar . ' ORDER BY p.created_at DESC, p.id DESC LIMIT 10');
        $stmt->execute();
    }
    $pendaftar = $stmt->fetchAll();

    // --- Statistik: pendaftaran yang diterima tiap server ------------------
    $statRoute = $pdo->query(
        'SELECT ag.route_id, ag.nama, COUNT(p.id) AS jumlah
           FROM anggota ag LEFT JOIN pendaftar p ON p.route_id = ag.route_id
          GROUP BY ag.route_id, ag.nama ORDER BY ag.route_id'
    )->fetchAll();
} catch (Throwable $ex) {
    error_log('[rsvp] index: ' . $ex->getMessage());
    $dbError = $ex instanceof RuntimeException ? $ex->getMessage() : 'Tidak dapat terhubung ke database kelompok_db.';
}

$acaraTerpilihForm = (string) ($oldDaftar['acara_id'] ?? ($pilihan['id'] ?? ''));

/** URL halaman dengan parameter pencarian tetap terjaga. */
function url_halaman(int $page, string $q): string
{
    $params = array_filter(['q' => $q, 'page' => $page > 1 ? $page : null], fn($v) => $v !== null && $v !== '');
    return 'index.php' . ($params ? '?' . http_build_query($params) : '') . '#acara';
}

function field_error(array $errors, string $key): string
{
    return isset($errors[$key])
        ? '<p class="field-error" id="err-' . e($key) . '">' . e($errors[$key]) . '</p>'
        : '<p class="field-error" id="err-' . e($key) . '" hidden></p>';
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>RSVP Acara Kelompok — <?= e(MEMBER_NAMA) ?></title>
  <link rel="stylesheet" href="assets/app.css">
</head>
<body>
<?php include __DIR__ . '/partials/served_by.php'; ?>

<header class="app-header">
  <div class="wrap header-inner">
    <a class="brand" href="index.php">
      <span class="brand-mark" aria-hidden="true">✓</span>
      <span>RSVP<small>Acara Kelompok</small></span>
    </a>
    <button class="nav-toggle" type="button" aria-expanded="false" aria-controls="app-nav">Menu</button>
    <nav id="app-nav" class="app-nav" aria-label="Navigasi aplikasi">
      <a href="#acara">Acara</a>
      <a href="#daftar">Daftar</a>
      <a href="#pendaftar">Pendaftar</a>
      <a href="#tambah-acara">Buat Acara</a>
      <a class="nav-back" href="../">← Personal page</a>
    </nav>
  </div>
</header>

<main class="wrap">
  <section class="hero">
    <h1>Pendaftaran Acara</h1>
    <p>Pilih acara, cek sisa kuota, lalu daftar. Setiap pendaftaran dicatat bersama
      <code>route_id</code> server yang menerimanya — saat ini <strong><?= e(MEMBER_ROUTE) ?></strong>.</p>
  </section>

  <?php foreach ($flash as $f): ?>
    <div class="alert alert-<?= e($f['type']) ?>" role="alert"><?= e($f['message']) ?></div>
  <?php endforeach; ?>

  <?php if ($dbError): ?>
    <div class="alert alert-error" role="alert">
      <strong>Database belum siap.</strong> <?= e($dbError) ?>
      Pastikan MySQL di XAMPP berjalan, <code>sql/schema.sql</code> sudah diimpor, dan <code>config/db.php</code> berisi user <code>app_local</code>.
    </div>
  <?php else: ?>

  <!-- ================= DAFTAR ACARA ================= -->
  <section id="acara" class="panel" aria-labelledby="judul-acara">
    <div class="panel-head">
      <h2 id="judul-acara">Daftar Acara</h2>
      <p class="live-status" id="live-status" aria-live="polite">Sisa kuota diperbarui otomatis.</p>
    </div>

    <form class="search" method="get" action="index.php#acara" role="search">
      <label class="sr-only" for="q">Cari acara</label>
      <input type="search" id="q" name="q" value="<?= e($q) ?>" placeholder="Cari judul, lokasi, atau deskripsi…" maxlength="100">
      <button type="submit">Cari</button>
      <?php if ($q !== ''): ?><a class="btn-ghost" href="index.php#acara">Reset</a><?php endif; ?>
    </form>

    <p class="result-info">
      <?php if ($q !== ''): ?>
        <?= $total ?> acara cocok dengan “<?= e($q) ?>”.
      <?php else: ?>
        Total <?= $total ?> acara.
      <?php endif; ?>
    </p>

    <?php if (!$acaraList): ?>
      <p class="empty">Tidak ada acara yang ditemukan.</p>
    <?php else: ?>
    <div class="cards">
      <?php foreach ($acaraList as $a):
          $kuota   = (int) $a['kuota'];
          $terisi  = (int) $a['terisi'];
          $sisa    = max(0, $kuota - $terisi);
          $selesai = strtotime($a['waktu_mulai']) <= time();
          $status  = $selesai ? 'selesai' : ($sisa === 0 ? 'penuh' : 'buka');
      ?>
      <article class="card status-<?= $status ?><?= $pilihan && (int) $pilihan['id'] === (int) $a['id'] ? ' is-selected' : '' ?>" data-acara-id="<?= (int) $a['id'] ?>" data-selesai="<?= $selesai ? '1' : '0' ?>">
        <div class="card-top">
          <span class="badge" data-badge><?= $selesai ? 'Selesai' : ($sisa === 0 ? 'Penuh' : 'Dibuka') ?></span>
          <span class="route-tag" title="Dibuat lewat server <?= e($a['route_id']) ?>"><?= e($a['route_id']) ?></span>
        </div>
        <h3><?= e($a['judul']) ?></h3>
        <p class="meta"><span aria-hidden="true">📅</span> <?= e(tanggal_id($a['waktu_mulai'])) ?></p>
        <p class="meta"><span aria-hidden="true">📍</span> <?= e($a['lokasi']) ?></p>
        <p class="desc"><?= e($a['deskripsi']) ?></p>
        <div class="quota">
          <div class="bar" role="progressbar" aria-label="Kuota terisi" aria-valuemin="0" aria-valuemax="<?= $kuota ?>" aria-valuenow="<?= $terisi ?>">
            <span data-bar style="width:<?= persen_terisi($terisi, $kuota) ?>%"></span>
          </div>
          <p class="quota-text" data-sisa>Sisa <strong><?= $sisa ?></strong> dari <?= $kuota ?> kursi</p>
        </div>
        <?php if (!$selesai): ?>
          <a class="btn<?= $sisa === 0 ? ' is-disabled' : '' ?>" data-daftar-link href="index.php?acara=<?= (int) $a['id'] ?>#daftar"><?= $sisa === 0 ? 'Lihat detail' : 'Daftar sekarang' ?></a>
        <?php else: ?>
          <a class="btn btn-ghost" href="index.php?acara=<?= (int) $a['id'] ?>#pendaftar">Lihat peserta</a>
        <?php endif; ?>
      </article>
      <?php endforeach; ?>
    </div>
    <?php endif; ?>

    <?php if ($totalHal > 1): ?>
    <nav class="pagination" aria-label="Halaman daftar acara">
      <?php if ($halaman > 1): ?>
        <a href="<?= e(url_halaman($halaman - 1, $q)) ?>" rel="prev">‹ Sebelumnya</a>
      <?php endif; ?>
      <?php for ($i = 1; $i <= $totalHal; $i++): ?>
        <?php if ($i === $halaman): ?>
          <span aria-current="page"><?= $i ?></span>
        <?php else: ?>
          <a href="<?= e(url_halaman($i, $q)) ?>"><?= $i ?></a>
        <?php endif; ?>
      <?php endfor; ?>
      <?php if ($halaman < $totalHal): ?>
        <a href="<?= e(url_halaman($halaman + 1, $q)) ?>" rel="next">Berikutnya ›</a>
      <?php endif; ?>
    </nav>
    <?php endif; ?>
  </section>

  <div class="grid-2">
    <!-- ================= FORM PENDAFTARAN ================= -->
    <section id="daftar" class="panel" aria-labelledby="judul-daftar">
      <h2 id="judul-daftar">Form Pendaftaran</h2>

      <?php if ($pilihan):
          $sisaPilih = max(0, (int) $pilihan['kuota'] - (int) $pilihan['terisi']); ?>
        <div class="selected-event" data-acara-id="<?= (int) $pilihan['id'] ?>">
          <p class="eyebrow">Acara dipilih</p>
          <h3><?= e($pilihan['judul']) ?></h3>
          <p class="meta"><?= e(tanggal_id($pilihan['waktu_mulai'])) ?> · <?= e($pilihan['lokasi']) ?></p>
          <p class="quota-text" data-sisa>Sisa <strong><?= $sisaPilih ?></strong> dari <?= (int) $pilihan['kuota'] ?> kursi</p>
        </div>
      <?php endif; ?>

      <?php if (!$opsiAcara): ?>
        <p class="empty">Belum ada acara yang membuka pendaftaran. Buat acara baru di bawah.</p>
      <?php else: ?>
      <form id="form-daftar" method="post" action="daftar.php" novalidate data-validate>
        <input type="hidden" name="csrf" value="<?= e($csrf) ?>">

        <div class="field">
          <label for="acara_id">Acara <span class="req">*</span></label>
          <select id="acara_id" name="acara_id" required aria-describedby="err-acara_id">
            <option value="">— Pilih acara —</option>
            <?php foreach ($opsiAcara as $o):
                $sisaO = max(0, (int) $o['kuota'] - (int) $o['terisi']); ?>
              <option value="<?= (int) $o['id'] ?>" data-sisa="<?= $sisaO ?>"
                <?= $acaraTerpilihForm === (string) $o['id'] ? 'selected' : '' ?>
                <?= $sisaO === 0 ? 'disabled' : '' ?>>
                <?= e($o['judul']) ?> — <?= $sisaO === 0 ? 'penuh' : 'sisa ' . $sisaO ?>
              </option>
            <?php endforeach; ?>
          </select>
          <?= field_error($errDaftar, 'acara_id') ?>
        </div>

        <div class="field">
          <label for="nama">Nama lengkap <span class="req">*</span></label>
          <input type="text" id="nama" name="nama" required minlength="2" maxlength="100"
                 value="<?= e($oldDaftar['nama'] ?? '') ?>" autocomplete="name" aria-describedby="err-nama">
          <?= field_error($errDaftar, 'nama') ?>
        </div>

        <div class="field">
          <label for="email">Email <span class="req">*</span></label>
          <input type="email" id="email" name="email" required maxlength="150"
                 value="<?= e($oldDaftar['email'] ?? '') ?>" autocomplete="email" aria-describedby="err-email">
          <?= field_error($errDaftar, 'email') ?>
        </div>

        <div class="field">
          <label for="instansi">Instansi / Kelas <span class="opt">(opsional)</span></label>
          <input type="text" id="instansi" name="instansi" maxlength="100"
                 value="<?= e($oldDaftar['instansi'] ?? '') ?>" aria-describedby="err-instansi">
          <?= field_error($errDaftar, 'instansi') ?>
        </div>

        <button type="submit" class="btn btn-block">Kirim pendaftaran</button>
        <p class="hint">Satu email hanya dapat mendaftar satu kali per acara.</p>
      </form>
      <?php endif; ?>
    </section>

    <!-- ================= PENDAFTAR TERBARU ================= -->
    <section id="pendaftar" class="panel" aria-labelledby="judul-pendaftar">
      <h2 id="judul-pendaftar">Pendaftar Terbaru<?= $pilihan ? ' — ' . e($pilihan['judul']) : '' ?></h2>
      <?php if ($pilihan): ?>
        <p class="hint"><a href="index.php#pendaftar">Tampilkan pendaftar semua acara</a></p>
      <?php endif; ?>

      <?php if (!$pendaftar): ?>
        <p class="empty">Belum ada pendaftar.</p>
      <?php else: ?>
      <ol class="people">
        <?php foreach ($pendaftar as $p): ?>
        <li>
          <span class="avatar" aria-hidden="true"><?= e(function_exists('mb_substr') ? mb_strtoupper(mb_substr($p['nama'], 0, 1, 'UTF-8'), 'UTF-8') : strtoupper($p['nama'][0])) ?></span>
          <div>
            <p class="person-name"><?= e($p['nama']) ?></p>
            <p class="person-meta">
              <?= e(mask_email($p['email'])) ?><?= $p['instansi'] !== null && $p['instansi'] !== '' ? ' · ' . e($p['instansi']) : '' ?>
            </p>
            <p class="person-meta">
              <?= $pilihan ? '' : e($p['judul']) . ' · ' ?><?= e(tanggal_id($p['created_at'])) ?>
            </p>
          </div>
          <span class="route-tag" title="Diterima oleh server <?= e($p['route_id']) ?>"><?= e($p['route_id']) ?></span>
        </li>
        <?php endforeach; ?>
      </ol>
      <?php endif; ?>

      <h3 class="sub">Pendaftaran per server</h3>
      <ul class="route-stats">
        <?php foreach ($statRoute as $s): ?>
          <li class="<?= $s['route_id'] === MEMBER_ROUTE ? 'is-me' : '' ?>" title="<?= e($s['nama']) ?>">
            <span><?= e($s['route_id']) ?></span><strong><?= (int) $s['jumlah'] ?></strong>
          </li>
        <?php endforeach; ?>
      </ul>
    </section>
  </div>

  <!-- ================= TAMBAH ACARA ================= -->
  <section id="tambah-acara" class="panel" aria-labelledby="judul-tambah">
    <details <?= $errAcara || $oldAcara ? 'open' : '' ?>>
      <summary><h2 id="judul-tambah">Buat Acara Baru</h2></summary>
      <form id="form-acara" method="post" action="tambah_acara.php" novalidate data-validate>
        <input type="hidden" name="csrf" value="<?= e($csrf) ?>">
        <div class="form-grid">
          <div class="field">
            <label for="judul">Judul acara <span class="req">*</span></label>
            <input type="text" id="judul" name="judul" required minlength="3" maxlength="150" value="<?= e($oldAcara['judul'] ?? '') ?>" aria-describedby="err-judul">
            <?= field_error($errAcara, 'judul') ?>
          </div>
          <div class="field">
            <label for="lokasi">Lokasi <span class="req">*</span></label>
            <input type="text" id="lokasi" name="lokasi" required minlength="3" maxlength="150" value="<?= e($oldAcara['lokasi'] ?? '') ?>" aria-describedby="err-lokasi">
            <?= field_error($errAcara, 'lokasi') ?>
          </div>
          <div class="field">
            <label for="waktu_mulai">Waktu mulai <span class="req">*</span></label>
            <input type="datetime-local" id="waktu_mulai" name="waktu_mulai" required value="<?= e($oldAcara['waktu_mulai'] ?? '') ?>" aria-describedby="err-waktu_mulai">
            <?= field_error($errAcara, 'waktu_mulai') ?>
          </div>
          <div class="field">
            <label for="kuota">Kuota peserta <span class="req">*</span></label>
            <input type="number" id="kuota" name="kuota" required min="1" max="1000" step="1" value="<?= e($oldAcara['kuota'] ?? '') ?>" aria-describedby="err-kuota">
            <?= field_error($errAcara, 'kuota') ?>
          </div>
          <div class="field field-full">
            <label for="deskripsi">Deskripsi <span class="req">*</span> <span class="counter" data-counter-for="deskripsi">0/1000</span></label>
            <textarea id="deskripsi" name="deskripsi" rows="4" required minlength="10" maxlength="1000" aria-describedby="err-deskripsi"><?= e($oldAcara['deskripsi'] ?? '') ?></textarea>
            <?= field_error($errAcara, 'deskripsi') ?>
          </div>
        </div>
        <button type="submit" class="btn">Simpan acara</button>
      </form>
    </details>
  </section>
  <?php endif; ?>
</main>

<footer class="app-footer">
  <div class="wrap">
    <p>Aplikasi bersama RSVP · Kelompok Komputasi Awan dan Terdistribusi · Dilayani server <?= e(MEMBER_ROUTE) ?></p>
  </div>
</footer>

<script src="assets/app.js"></script>
</body>
</html>
