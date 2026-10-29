<?php
// api/kuota.php — JSON sisa kuota semua acara, dipanggil AJAX tiap beberapa detik.
// Setelah UTS, tiap polling bisa dilayani server berbeda (lihat field served_by).

require_once __DIR__ . '/../lib/bootstrap.php';

header('Content-Type: application/json; charset=utf-8');
header('Cache-Control: no-store');

try {
    $rows = db()->query('SELECT id, kuota, terisi FROM acara')->fetchAll();
    $acara = [];
    foreach ($rows as $r) {
        $kuota  = (int) $r['kuota'];
        $terisi = (int) $r['terisi'];
        $acara[] = [
            'id'     => (int) $r['id'],
            'kuota'  => $kuota,
            'terisi' => $terisi,
            'sisa'   => max(0, $kuota - $terisi),
            'persen' => persen_terisi($terisi, $kuota),
        ];
    }
    echo json_encode([
        'ok'        => true,
        'served_by' => ['route' => MEMBER_ROUTE, 'nama' => MEMBER_NAMA],
        'waktu'     => date('H:i:s'),
        'acara'     => $acara,
    ]);
} catch (Throwable $ex) {
    error_log('[rsvp] api/kuota: ' . $ex->getMessage());
    http_response_code(503);
    echo json_encode(['ok' => false, 'error' => 'Database tidak tersedia']);
}
