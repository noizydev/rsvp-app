<?php
// lib/db.php — koneksi PDO bersama.
// Kredensial TIDAK disimpan di repo: selalu dibaca dari ../config/db.php
// (di luar folder app/), sehingga pindah ke GCP cukup mengganti file itu.

function db(): PDO
{
    static $pdo = null;
    if ($pdo instanceof PDO) {
        return $pdo;
    }

    $path = __DIR__ . '/../../config/db.php';
    if (!is_file($path)) {
        throw new RuntimeException('File config/db.php tidak ditemukan. Salin config/db.example.php menjadi config/db.php.');
    }
    $cfg = require $path;

    $dsn = sprintf(
        'mysql:host=%s;port=%d;dbname=%s;charset=utf8mb4',
        $cfg['host'],
        (int) ($cfg['port'] ?? 3306),
        $cfg['name']
    );

    $pdo = new PDO($dsn, $cfg['user'], $cfg['pass'], [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,   // prepared statement asli di server
    ]);
    $pdo->exec("SET time_zone = '+07:00'");

    return $pdo;
}
