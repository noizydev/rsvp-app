<?php
// tambah_acara.php — handler POST form pembuatan acara baru.

require_once __DIR__ . '/lib/bootstrap.php';
start_session();

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    redirect('index.php');
}
if (!csrf_valid($_POST['csrf'] ?? null)) {
    flash_set('error', 'Sesi formulir sudah kedaluwarsa. Silakan kirim ulang.');
    redirect('index.php#tambah-acara');
}

[$data, $errors] = validate_acara($_POST);
$old = [
    'judul'       => post_str('judul'),
    'deskripsi'   => post_str('deskripsi'),
    'lokasi'      => post_str('lokasi'),
    'waktu_mulai' => post_str('waktu_mulai'),
    'kuota'       => post_str('kuota'),
];

if ($errors) {
    form_state_set('acara', $old, $errors);
    flash_set('error', 'Acara gagal dibuat. Periksa kembali isian formulir.');
    redirect('index.php#tambah-acara');
}

try {
    $stmt = db()->prepare(
        'INSERT INTO acara (route_id, judul, deskripsi, lokasi, waktu_mulai, kuota)
         VALUES (:route_id, :judul, :deskripsi, :lokasi, :waktu_mulai, :kuota)'
    );
    $stmt->execute([
        ':route_id'    => MEMBER_ROUTE,
        ':judul'       => $data['judul'],
        ':deskripsi'   => $data['deskripsi'],
        ':lokasi'      => $data['lokasi'],
        ':waktu_mulai' => $data['waktu_mulai_sql'],
        ':kuota'       => $data['kuota'],
    ]);
    $id = (int) db()->lastInsertId();
    flash_set('success', 'Acara "' . $data['judul'] . '" berhasil dibuat oleh server ' . MEMBER_ROUTE . '.');
    redirect('index.php?acara=' . $id . '#daftar');
} catch (Throwable $ex) {
    error_log('[rsvp] tambah_acara: ' . $ex->getMessage());
    form_state_set('acara', $old, []);
    flash_set('error', 'Acara gagal disimpan karena kesalahan database.');
    redirect('index.php#tambah-acara');
}
