<?php
// lib/helpers.php — fungsi bantu: escaping, flash message, CSRF, validasi, format.

/** Escape semua data sebelum ditampilkan (wajib untuk setiap output). */
function e($value): string
{
    return htmlspecialchars((string) $value, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}

function start_session(): void
{
    if (session_status() === PHP_SESSION_NONE) {
        session_name('rsvp_sess');
        session_start([
            'cookie_httponly' => true,
            'cookie_samesite' => 'Lax',
        ]);
    }
}

function redirect(string $url): void
{
    header('Location: ' . $url, true, 303);
    exit;
}

function flash_set(string $type, string $message): void
{
    $_SESSION['flash'][] = ['type' => $type, 'message' => $message];
}

function flash_take(): array
{
    $items = $_SESSION['flash'] ?? [];
    unset($_SESSION['flash']);
    return $items;
}

/** Simpan input lama & pesan error per field agar form terisi kembali setelah redirect. */
function form_state_set(string $form, array $old, array $errors): void
{
    $_SESSION['form'][$form] = ['old' => $old, 'errors' => $errors];
}

function form_state_take(string $form): array
{
    $state = $_SESSION['form'][$form] ?? ['old' => [], 'errors' => []];
    unset($_SESSION['form'][$form]);
    return $state;
}

function csrf_token(): string
{
    if (empty($_SESSION['csrf'])) {
        $_SESSION['csrf'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf'];
}

function csrf_valid(?string $token): bool
{
    return is_string($token) && !empty($_SESSION['csrf']) && hash_equals($_SESSION['csrf'], $token);
}

/** Ambil string dari $_POST, dipangkas spasinya. */
function post_str(string $key): string
{
    $value = $_POST[$key] ?? '';
    return is_string($value) ? trim($value) : '';
}

function str_len(string $s): int
{
    return function_exists('mb_strlen') ? mb_strlen($s, 'UTF-8') : strlen($s);
}

/** Validasi data pendaftaran. Mengembalikan [data bersih, daftar error]. */
function validate_pendaftaran(array $in): array
{
    $errors = [];
    $data = [
        'acara_id' => filter_var($in['acara_id'] ?? '', FILTER_VALIDATE_INT, ['options' => ['min_range' => 1]]),
        'nama'     => trim((string) ($in['nama'] ?? '')),
        'email'    => strtolower(trim((string) ($in['email'] ?? ''))),
        'instansi' => trim((string) ($in['instansi'] ?? '')),
    ];

    if ($data['acara_id'] === false) {
        $errors['acara_id'] = 'Pilih acara yang ingin diikuti.';
    }
    $len = str_len($data['nama']);
    if ($len < 2 || $len > 100) {
        $errors['nama'] = 'Nama wajib diisi, 2–100 karakter.';
    }
    if ($data['email'] === '' || str_len($data['email']) > 150 || !filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = 'Masukkan alamat email yang valid.';
    }
    if (str_len($data['instansi']) > 100) {
        $errors['instansi'] = 'Instansi maksimal 100 karakter.';
    }
    return [$data, $errors];
}

/** Validasi data acara baru. */
function validate_acara(array $in): array
{
    $errors = [];
    $data = [
        'judul'       => trim((string) ($in['judul'] ?? '')),
        'deskripsi'   => trim((string) ($in['deskripsi'] ?? '')),
        'lokasi'      => trim((string) ($in['lokasi'] ?? '')),
        'waktu_mulai' => trim((string) ($in['waktu_mulai'] ?? '')),
        'kuota'       => filter_var($in['kuota'] ?? '', FILTER_VALIDATE_INT, ['options' => ['min_range' => 1, 'max_range' => 1000]]),
    ];

    $len = str_len($data['judul']);
    if ($len < 3 || $len > 150) {
        $errors['judul'] = 'Judul wajib diisi, 3–150 karakter.';
    }
    $len = str_len($data['deskripsi']);
    if ($len < 10 || $len > 1000) {
        $errors['deskripsi'] = 'Deskripsi wajib diisi, 10–1000 karakter.';
    }
    $len = str_len($data['lokasi']);
    if ($len < 3 || $len > 150) {
        $errors['lokasi'] = 'Lokasi wajib diisi, 3–150 karakter.';
    }
    $waktu = DateTime::createFromFormat('Y-m-d\TH:i', $data['waktu_mulai']);
    if (!$waktu || $waktu->format('Y-m-d\TH:i') !== $data['waktu_mulai']) {
        $errors['waktu_mulai'] = 'Tanggal dan jam tidak valid.';
    } elseif ($waktu <= new DateTime()) {
        $errors['waktu_mulai'] = 'Waktu acara harus di masa depan.';
    } else {
        $data['waktu_mulai_sql'] = $waktu->format('Y-m-d H:i:00');
    }
    if ($data['kuota'] === false) {
        $errors['kuota'] = 'Kuota berupa angka 1–1000.';
    }
    return [$data, $errors];
}

/** Format tanggal Indonesia, contoh: Sab, 15 Nov 2026 · 09.00 WIB */
function tanggal_id(string $datetime, bool $withTime = true): string
{
    $ts = strtotime($datetime);
    if ($ts === false) {
        return $datetime;
    }
    $hari  = ['Min', 'Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab'];
    $bulan = ['', 'Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'];
    $out = $hari[(int) date('w', $ts)] . ', ' . date('j', $ts) . ' ' . $bulan[(int) date('n', $ts)] . ' ' . date('Y', $ts);
    if ($withTime) {
        $out .= ' · ' . date('H.i', $ts) . ' WIB';
    }
    return $out;
}

/** Samarkan email untuk daftar publik: daffa@gmail.com -> da***@gmail.com */
function mask_email(string $email): string
{
    $at = strpos($email, '@');
    if ($at === false) {
        return '***';
    }
    return substr($email, 0, min(2, $at)) . '***' . substr($email, $at);
}

/** Persentase kuota terisi (0–100). */
function persen_terisi(int $terisi, int $kuota): int
{
    return $kuota > 0 ? (int) min(100, round($terisi / $kuota * 100)) : 0;
}
