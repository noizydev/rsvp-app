# RSVP — Aplikasi Pendaftaran Acara

Aplikasi bersama untuk **Tugas 1 Komputasi Awan dan Terdistribusi** (pra-UTS).
Pengunjung melihat daftar acara beserta **sisa kuota**, mendaftar lewat formulir, dan
setiap data yang tersimpan mencatat `route_id` server yang menerimanya.

## Anggota & route

| Route | Nama | NIM | Peran |
|---|---|---|---|
| `m0` | Hasnat Ferdiananda | 103012430038 | Ketua (koordinasi repo) |
| `m1` | Daffandri Faiz Zhafransyah | 103012400056 | Anggota |
| `m2` | Rasyid Ridlo | 103012400042 | Anggota |
| `m3` | Gathfan Fadhilah Ananda Syukur | 103012400298 | Anggota |
| `m4` | Faqih Hanif Abdul Rahman | 103012400405 | Anggota |

## Fitur

- **Baca** — daftar acara (judul, waktu, lokasi, deskripsi) dengan bar & angka sisa kuota.
- **Tulis** — form pendaftaran acara dan form pembuatan acara baru.
- **Pencarian & paginasi** — cari acara berdasarkan judul/lokasi/deskripsi, 6 acara per halaman.
- **Pendaftar terbaru** — 10 pendaftar terakhir (email disamarkan), bisa difilter per acara,
  plus jumlah pendaftaran yang diterima tiap server (`m0`–`m4`).
- **Sisa kuota real-time** — AJAX polling ke `api/kuota.php` tiap 10 detik.
- **Ringkasan untuk personal page** — `partials/ringkasan.php` menampilkan 3 acara terdekat.
- **Anti kuota terlampaui** — pendaftaran memakai transaksi + `SELECT … FOR UPDATE`
  dan constraint `UNIQUE (acara_id, email)` untuk mencegah pendaftaran ganda.

## Keamanan

- Semua query memakai **PDO prepared statement** (`ATTR_EMULATE_PREPARES = false`).
- Semua output melewati **`htmlspecialchars()`** (fungsi `e()` di `lib/helpers.php`).
- **Validasi ganda**: JavaScript (`assets/app.js`) dan PHP (`lib/helpers.php`).
- **Token CSRF** pada setiap form; pola Post/Redirect/Get agar form tidak terkirim ulang.
- **Tanpa kredensial di repo**: koneksi selalu membaca `../config/db.php` (di luar `app/`).

## Struktur

```
app/                       ← repo ini (git clone ke htdocs/personal/app)
├── index.php              ← halaman aplikasi
├── daftar.php             ← handler POST pendaftaran (transaksi)
├── tambah_acara.php       ← handler POST acara baru
├── api/kuota.php          ← JSON sisa kuota (AJAX)
├── lib/
│   ├── bootstrap.php      ← memuat identity.php, db.php, helpers.php
│   ├── db.php             ← koneksi PDO (membaca ../config/db.php)
│   └── helpers.php        ← escaping, CSRF, flash, validasi, format tanggal
├── partials/
│   ├── served_by.php      ← banner "Anda dilayani oleh laman …"
│   └── ringkasan.php      ← ringkasan acara untuk personal page
├── assets/app.css, app.js
└── sql/
    ├── schema.sql         ← skema + data awal (anggota, acara)
    └── create_user.sql    ← user app_local dengan hak minimum
```

File di luar repo (milik masing-masing laptop, **tidak di-commit**):

```
htdocs/personal/
├── index.php, assets/     ← personal page
├── identity.php           ← MEMBER_ROUTE, MEMBER_NAMA, MEMBER_NIM
└── config/
    ├── .htaccess          ← Require all denied
    └── db.php             ← kredensial database lokal
```

## Instalasi (XAMPP, Windows)

1. Jalankan **Apache** dan **MySQL** dari XAMPP Control Panel.
2. Siapkan folder personal page di `C:\xampp\htdocs\personal\` (berisi `index.php`,
   `identity.php`, `config/`).
3. Clone repo ini sebagai folder `app`:
   ```bash
   cd C:/xampp/htdocs/personal
   git clone https://github.com/<akun-ketua>/<nama-repo>.git app
   ```
4. Buka `http://localhost/phpmyadmin` → tab **Import** → pilih `app/sql/schema.sql` → **Go**.
   (Peringatan: impor ulang akan menghapus dan membuat ulang tabel.)
5. Tab **SQL** → tempel isi `app/sql/create_user.sql` (ganti password bila perlu) → **Go**.
6. Salin `config/db.example.php` menjadi `config/db.php` dan sesuaikan password.
7. Pastikan `identity.php` berisi route Anda sendiri (`m0`…`m4`).
8. Buka `http://localhost/personal/` dan `http://localhost/personal/app/`.

Memperbarui ke versi terbaru: `cd C:/xampp/htdocs/personal/app && git pull`.
Folder `app/` tidak boleh diubah langsung di laptop; semua perubahan lewat branch + pull request.

## Alur kerja Git

1. Ketua membuat repo, mengundang anggota sebagai collaborator, dan memproteksi branch `main`.
2. Setiap anggota membuat branch fitur, misalnya `feat/form-pendaftaran`.
3. Commit → push → buka **pull request** ke `main`.
4. Minimal satu anggota lain me-review; ketua melakukan merge.
5. Semua anggota `git pull` ke folder `app/` masing-masing.

## Uji keamanan

Isi kolom **Nama** atau **Instansi** dengan:

- `<script>alert(1)</script>` → tersimpan apa adanya, tampil sebagai teks, tidak ada pop-up.
- `' OR '1'='1` → tersimpan apa adanya, tidak ada error SQL, tidak membocorkan data.

Periksa di phpMyAdmin bahwa baris tersimpan dengan `route_id` server Anda.
