<?php
// lib/bootstrap.php — dimuat oleh setiap halaman/handler aplikasi.
// identity.php berada di luar folder app/ (milik masing-masing server).

$identityPath = __DIR__ . '/../../identity.php';
if (is_file($identityPath)) {
    require_once $identityPath;
}
defined('MEMBER_ROUTE') || define('MEMBER_ROUTE', 'm0');
defined('MEMBER_NAMA')  || define('MEMBER_NAMA', 'Tanpa Identitas');
defined('MEMBER_NIM')   || define('MEMBER_NIM', '-');

date_default_timezone_set('Asia/Jakarta');

require_once __DIR__ . '/db.php';
require_once __DIR__ . '/helpers.php';
