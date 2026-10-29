<?php
// daftar.php — handler POST form pendaftaran acara.
// Kuota dijaga dengan transaksi + SELECT ... FOR UPDATE: baris acara dikunci selama
// pengecekan sisa kuota dan INSERT, sehingga dua pendaftaran bersamaan (bahkan dari
// server berbeda yang memakai database terpusat) tidak bisa melampaui kuota.

require_once __DIR__ . '/lib/bootstrap.php';
start_session();

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    redirect('index.php');
}
if (!csrf_valid($_POST['csrf'] ?? null)) {
    flash_set('error', 'Sesi formulir sudah kedaluwarsa. Silakan kirim ulang.');
    redirect('index.php#daftar');
}

[$data, $errors] = validate_pendaftaran($_POST);
$back = 'index.php' . ($data['acara_id'] ? '?acara=' . $data['acara_id'] : '') . '#daftar';
$old  = [
    'acara_id' => post_str('acara_id'),
    'nama'     => post_str('nama'),
    'email'    => post_str('email'),
    'instansi' => post_str('instansi'),
];

if ($errors) {
    form_state_set('daftar', $old, $errors);
    flash_set('error', 'Pendaftaran gagal. Periksa kembali isian formulir.');
    redirect($back);
}

$pdo = null;
try {
    $pdo = db();
    $pdo->beginTransaction();

    $stmt = $pdo->prepare('SELECT id, judul, kuota, terisi, waktu_mulai FROM acara WHERE id = :id FOR UPDATE');
    $stmt->execute([':id' => $data['acara_id']]);
    $acara = $stmt->fetch();

    $gagal = null;
    if (!$acara) {
        $gagal = 'Acara tidak ditemukan.';
    } elseif (strtotime($acara['waktu_mulai']) <= time()) {
        $gagal = 'Pendaftaran untuk acara ini sudah ditutup.';
    } elseif ((int) $acara['terisi'] >= (int) $acara['kuota']) {
        $gagal = 'Maaf, kuota acara "' . $acara['judul'] . '" sudah penuh.';
    }
    if ($gagal !== null) {
        $pdo->rollBack();
        form_state_set('daftar', $old, []);
        flash_set('error', $gagal);
        redirect($back);
    }

    $stmt = $pdo->prepare(
        'INSERT INTO pendaftar (acara_id, route_id, nama, email, instansi)
         VALUES (:acara_id, :route_id, :nama, :email, :instansi)'
    );
    $stmt->execute([
        ':acara_id' => $data['acara_id'],
        ':route_id' => MEMBER_ROUTE,
        ':nama'     => $data['nama'],
        ':email'    => $data['email'],
        ':instansi' => $data['instansi'] !== '' ? $data['instansi'] : null,
    ]);

    $stmt = $pdo->prepare('UPDATE acara SET terisi = terisi + 1 WHERE id = :id');
    $stmt->execute([':id' => $data['acara_id']]);

    $pdo->commit();

    $sisa = (int) $acara['kuota'] - (int) $acara['terisi'] - 1;
    flash_set('success', 'Pendaftaran berhasil! ' . $data['nama'] . ' terdaftar di "' . $acara['judul']
        . '" (diterima server ' . MEMBER_ROUTE . '). Sisa kuota: ' . $sisa . '.');
    redirect($back);
} catch (PDOException $ex) {
    if ($pdo instanceof PDO && $pdo->inTransaction()) {
        $pdo->rollBack();
    }
    form_state_set('daftar', $old, []);
    if (($ex->errorInfo[1] ?? null) === 1062) {
        form_state_set('daftar', $old, ['email' => 'Email ini sudah terdaftar di acara tersebut.']);
        flash_set('error', 'Email tersebut sudah terdaftar di acara ini.');
    } else {
        error_log('[rsvp] daftar: ' . $ex->getMessage());
        flash_set('error', 'Terjadi kesalahan database. Silakan coba lagi.');
    }
    redirect($back);
} catch (Throwable $ex) {
    error_log('[rsvp] daftar: ' . $ex->getMessage());
    flash_set('error', 'Aplikasi belum terhubung ke database. Periksa config/db.php.');
    redirect($back);
}
