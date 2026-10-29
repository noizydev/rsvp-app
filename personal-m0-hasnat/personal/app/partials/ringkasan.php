<?php
// partials/ringkasan.php — ringkasan acara mendatang untuk disematkan di personal page.
// Pemakaian di personal/index.php:  include __DIR__ . '/app/partials/ringkasan.php';
// Opsional sebelum include: $rsvpBase (default 'app/'), $rsvpLimit (default 3).

require_once __DIR__ . '/../lib/bootstrap.php';

$rsvpBase  = isset($rsvpBase) ? (string) $rsvpBase : 'app/';
$rsvpLimit = isset($rsvpLimit) ? max(1, (int) $rsvpLimit) : 3;
$rsvpItems = null;

try {
    $stmt = db()->prepare(
        'SELECT id, judul, lokasi, waktu_mulai, kuota, terisi
           FROM acara
          WHERE waktu_mulai >= NOW()
          ORDER BY waktu_mulai ASC
          LIMIT :lim'
    );
    $stmt->bindValue(':lim', $rsvpLimit, PDO::PARAM_INT);
    $stmt->execute();
    $rsvpItems = $stmt->fetchAll();
} catch (Throwable $ex) {
    error_log('[rsvp] ringkasan: ' . $ex->getMessage());
}
?>
<style>
  .rsvp-ringkasan .rsvp-list{list-style:none;margin:0;padding:0;display:grid;gap:1rem;grid-template-columns:repeat(auto-fit,minmax(220px,1fr))}
  .rsvp-ringkasan .rsvp-item{border:1px solid rgba(127,127,127,.35);border-radius:10px;padding:1rem;display:flex;flex-direction:column;gap:.4rem}
  .rsvp-ringkasan .rsvp-head{display:flex;flex-direction:column;gap:.15rem}
  .rsvp-ringkasan .rsvp-tanggal,.rsvp-ringkasan .rsvp-lokasi,.rsvp-ringkasan .rsvp-sisa{font-size:.875em;opacity:.8}
  .rsvp-ringkasan .rsvp-bar{height:8px;border-radius:99px;background:rgba(127,127,127,.25);overflow:hidden}
  .rsvp-ringkasan .rsvp-bar span{display:block;height:100%;background:currentColor;border-radius:inherit}
  .rsvp-ringkasan .rsvp-link{align-self:flex-start;margin-top:.25rem;font-weight:600}
</style>
<div class="rsvp-ringkasan" data-served-route="<?= e(MEMBER_ROUTE) ?>">
<?php if ($rsvpItems === null): ?>
  <p class="rsvp-error">Ringkasan acara belum dapat dimuat (database belum terhubung). Periksa config/db.php.</p>
<?php elseif (!$rsvpItems): ?>
  <p class="rsvp-empty">Belum ada acara mendatang. <a href="<?= e($rsvpBase) ?>">Buat acara pertama</a>.</p>
<?php else: ?>
  <ul class="rsvp-list">
  <?php foreach ($rsvpItems as $a):
      $kuota  = (int) $a['kuota'];
      $terisi = (int) $a['terisi'];
      $sisa   = max(0, $kuota - $terisi);
  ?>
    <li class="rsvp-item<?= $sisa === 0 ? ' rsvp-penuh' : '' ?>">
      <div class="rsvp-head">
        <strong class="rsvp-judul"><?= e($a['judul']) ?></strong>
        <span class="rsvp-tanggal"><?= e(tanggal_id($a['waktu_mulai'])) ?></span>
      </div>
      <div class="rsvp-lokasi"><?= e($a['lokasi']) ?></div>
      <div class="rsvp-bar" role="progressbar" aria-label="Kuota terisi" aria-valuemin="0" aria-valuemax="<?= $kuota ?>" aria-valuenow="<?= $terisi ?>"><span style="width:<?= persen_terisi($terisi, $kuota) ?>%"></span></div>
      <div class="rsvp-sisa"><?= $sisa === 0 ? 'Kuota penuh' : 'Sisa kuota: ' . $sisa . ' dari ' . $kuota ?></div>
      <a class="rsvp-link" href="<?= e($rsvpBase) ?>index.php?acara=<?= (int) $a['id'] ?>#daftar"><?= $sisa === 0 ? 'Lihat detail' : 'Daftar' ?></a>
    </li>
  <?php endforeach; ?>
  </ul>
<?php endif; ?>
</div>
