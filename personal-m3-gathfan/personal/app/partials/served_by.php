<?php
// partials/served_by.php — banner "Anda dilayani oleh laman ..." untuk setiap halaman.
// Dipakai oleh personal page (index.php) dan halaman aplikasi.
// Setelah UTS banner ini menunjukkan server mana yang melayani request dari load balancer.

if (!defined('MEMBER_ROUTE')) {
    $identityPath = __DIR__ . '/../../identity.php';
    if (is_file($identityPath)) {
        require_once $identityPath;
    }
}
$sbNama  = defined('MEMBER_NAMA') ? MEMBER_NAMA : 'Tanpa Identitas';
$sbNim   = defined('MEMBER_NIM') ? MEMBER_NIM : '-';
$sbRoute = defined('MEMBER_ROUTE') ? MEMBER_ROUTE : '-';
$sbHost  = gethostname() ?: 'localhost';
?>
<style>
  .served-by{display:flex;flex-wrap:wrap;justify-content:center;align-items:center;gap:.35rem .75rem;
    padding:.5rem 1rem;background:#111827;color:#f9fafb;font:500 .875rem/1.4 system-ui,-apple-system,"Segoe UI",sans-serif;
    text-align:center;position:relative;z-index:1000}
  .served-by strong{color:#fbbf24}
  .served-by .served-by-meta{opacity:.7;font-size:.8em}
</style>
<div class="served-by" role="status" data-route="<?= htmlspecialchars($sbRoute, ENT_QUOTES, 'UTF-8') ?>">
  <span>Anda dilayani oleh laman <strong><?= htmlspecialchars($sbNama, ENT_QUOTES, 'UTF-8') ?></strong> (<?= htmlspecialchars($sbNim, ENT_QUOTES, 'UTF-8') ?>)</span>
  <span class="served-by-meta">route <?= htmlspecialchars($sbRoute, ENT_QUOTES, 'UTF-8') ?> · host <?= htmlspecialchars($sbHost, ENT_QUOTES, 'UTF-8') ?></span>
</div>
