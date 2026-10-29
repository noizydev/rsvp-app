# Panduan Tugas 1 — Personal Page + Aplikasi Bersama RSVP

Kelompok: Hasnat (m0, ketua), Daffandri (m1), Rasyid (m2), Gathfan (m3), Faqih (m4).
Penetapan ketua = m0 (Hasnat) mengikuti urutan nama; ubah jika kelompok memutuskan lain
(cukup ganti `identity.php` dan tabel `anggota` di `sql/schema.sql`).

## Isi folder ini

| Folder | Isi | Untuk siapa |
|---|---|---|
| `rsvp-app/` | Kode aplikasi bersama → **di-push ke repo GitHub kelompok** | Semua (via Git) |
| `personal-m0-hasnat/personal/` | Personal page Hasnat (tema terminal gelap) | Hasnat |
| `personal-m1-daffandri/personal/` | Personal page Daffandri (tema neo-brutalist bento, isi dari CV) | Daffandri |
| `personal-m2-rasyid/personal/` | Personal page Rasyid (tema neo-brutalist) | Rasyid |
| `personal-m3-gathfan/personal/` | Personal page Gathfan (tema glassmorphism) | Gathfan |
| `personal-m4-faqih/personal/` | Personal page Faqih (tema sidebar hangat) | Faqih |

Setiap folder `personal/` sudah berisi salinan `app/` agar langsung jalan, tetapi untuk
penilaian **ganti `app/` dengan hasil `git clone` dari repo kelompok** (langkah 3 di bawah).

> Semua isian pribadi yang dikarang (sekolah asal, pengalaman, portofolio, email, akun media
> sosial) ditandai `<!-- GANTI -->` di `index.php`. Cari teks itu dan ganti dengan data asli.

## 1. Ketua: buat repo GitHub

```bash
cd "Tugas 1/rsvp-app"
git init -b main
git add .
git commit -m "Kerangka aplikasi RSVP"
git remote add origin https://github.com/<akun-ketua>/rsvp-kelompok.git
git push -u origin main
```

Undang keempat anggota (Settings → Collaborators) dan aktifkan proteksi `main`
(Settings → Branches → *Require a pull request before merging*, 1 approval).

### Pembagian fitur (masing-masing 1 branch + 1 pull request)

| Route | Anggota | Branch | File |
|---|---|---|---|
| m0 | Hasnat | `feat/skema-koneksi` | `sql/schema.sql`, `sql/create_user.sql`, `lib/db.php`, `lib/bootstrap.php`, `README.md` |
| m1 | Daffandri | `feat/partials-tampilan` | `partials/served_by.php`, `partials/ringkasan.php`, `assets/app.css` |
| m2 | Rasyid | `feat/form-pendaftaran` | `daftar.php` (transaksi kuota), bagian form di `index.php` |
| m3 | Gathfan | `feat/daftar-acara-paginasi` | `index.php` (daftar acara, pencarian, paginasi, pendaftar terbaru) |
| m4 | Faqih | `feat/validasi-ajax` | `assets/app.js`, `api/kuota.php`, `tambah_acara.php`, `lib/helpers.php` |

Agar riwayat Git mencerminkan pembagian ini, ketua cukup mem-push kerangka minimal
(README + struktur folder), lalu tiap anggota menambahkan file bagiannya dari `rsvp-app/`:

```bash
git checkout -b feat/form-pendaftaran
# salin / kerjakan file bagian Anda
git add daftar.php
git commit -m "Form pendaftaran dengan transaksi kuota"
git push -u origin feat/form-pendaftaran
# buka Pull Request di GitHub, minta 1 anggota me-review, ketua melakukan merge
```

## 2. Setiap anggota: siapkan XAMPP

1. Jalankan **Apache** dan **MySQL** di XAMPP Control Panel.
2. Salin isi `personal-mX-nama/personal/` ke `C:\xampp\htdocs\personal\`.
3. phpMyAdmin (`http://localhost/phpmyadmin`) → **Import** → `app/sql/schema.sql`.
4. phpMyAdmin → **SQL** → tempel isi `app/sql/create_user.sql` → Go.
5. Salin `config/db.example.php` → `config/db.php` (sesuaikan password jika diganti).
6. Buka `http://localhost/personal/` dan `http://localhost/personal/app/`.

Jika MySQL gagal dengan pesan *"Read page with wrong checksum" from storage engine Aria*,
tabel sistem XAMPP rusak; jalankan `REPAIR TABLE mysql.proxies_priv;` (atau tabel yang
disebut) di tab SQL phpMyAdmin.

## 3. Integrasi versi akhir

```bash
cd C:/xampp/htdocs/personal
rmdir /s /q app        # hapus salinan bawaan (cmd) — atau hapus lewat Explorer
git clone https://github.com/<akun-ketua>/rsvp-kelompok.git app
```

Setelah ada perubahan di repo: `cd app && git pull`.

## 4. Uji yang perlu direkam di video (maks. 5 menit)

1. Personal page di `http://localhost/personal/` + banner *"Anda dilayani oleh laman …"*.
2. Interaksi JS: mode gelap/terang, filter portofolio, modal, validasi form kontak, menu mobile.
3. Aplikasi RSVP: cari acara, daftar ke acara, lihat sisa kuota berkurang, buat acara baru.
4. Validasi: kirim form kosong (error dari JS), daftar dua kali dengan email sama (ditolak server).
5. Kuota penuh: acara *Study Group Komputasi Awan* berkuota 5 — isi sampai penuh.
6. Uji keamanan: isi Nama `<script>alert(1)</script>` dan Instansi `' OR '1'='1` →
   tampil sebagai teks biasa, tanpa pop-up dan tanpa error.
7. phpMyAdmin → `kelompok_db` → `pendaftar`: data tersimpan dengan `route_id` Anda.

## 5. Pengumpulan

**Per mahasiswa** — ZIP folder `personal/` **tanpa `config/db.php`**
(`config/db.example.php` sudah ada). Di PowerShell:

```powershell
cd C:\xampp\htdocs
Compress-Archive -Path personal\* -DestinationPath Tugas1_<NIM>.zip -Force
# lalu buka ZIP dan pastikan config\db.php TIDAK ada (atau hapus db.php sebelum zip)
```

**Per kelompok** — tautan repo GitHub (README sudah berisi anggota, route, aplikasi, instalasi)
dan laporan singkat (maks. 5 halaman).

## Hasil uji yang sudah dilakukan (laptop pengembang, XAMPP PHP 8.1 + MariaDB 10.4)

| Uji | Hasil |
|---|---|
| Personal page & aplikasi tampil tanpa warning PHP (`error_reporting=E_ALL`) | Lolos |
| Pendaftaran tersimpan dengan `route_id` server (`m4`) | Lolos |
| `<script>alert(1)</script>` tersimpan apa adanya, tampil sebagai `&lt;script&gt;…` | Lolos |
| `' OR '1'='1` tersimpan apa adanya, tidak ada error SQL | Lolos |
| Email sama didaftarkan dua kali → ditolak (UNIQUE) | Lolos |
| Validasi server: nama 1 karakter, email salah, waktu lampau, kuota 0 → ditolak | Lolos |
| Token CSRF salah → ditolak | Lolos |
| 12 pendaftaran **serentak** ke acara berkuota 5 → tepat 5 tersimpan, `terisi = 5` | Lolos |
| Validasi JavaScript mencegah form kosong terkirim | Lolos |
| `api/kuota.php` mengembalikan JSON sisa kuota + server yang melayani | Lolos |
