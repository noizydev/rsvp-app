# Tugas 1 — Personal Page + Aplikasi Bersama RSVP

Mata kuliah **Komputasi Awan dan Terdistribusi**, Telkom University.
Aplikasi bersama yang dipilih: **Pendaftaran Acara (RSVP)**.

## Anggota & route

| Route | Nama | NIM | Folder personal page |
|---|---|---|---|
| `m0` | Hasnat Ferdiananda (ketua) | 103012430038 | [`personal-m0-hasnat/`](personal-m0-hasnat/personal) |
| `m1` | Daffandri Faiz Zhafransyah | 103012400056 | [`personal-m1-daffandri/`](personal-m1-daffandri/personal) |
| `m2` | Rasyid Ridlo | 103012400042 | [`personal-m2-rasyid/`](personal-m2-rasyid/personal) |
| `m3` | Gathfan Fadhilah Ananda Syukur | 103012400298 | [`personal-m3-gathfan/`](personal-m3-gathfan/personal) |
| `m4` | Faqih Hanif Abdul Rahman | 103012400405 | [`personal-m4-faqih/`](personal-m4-faqih/personal) |

## Isi repo

```
rsvp-app/                    ← aplikasi bersama (server): PHP + MySQL
personal-mX-nama/personal/   ← personal page tiap anggota, siap disalin ke htdocs
    ├── index.php, assets/
    ├── identity.php         ← MEMBER_ROUTE, MEMBER_NAMA, MEMBER_NIM
    ├── config/              ← .htaccess + db.example.php (db.php tidak di-commit)
    └── app/                 ← salinan rsvp-app/
PANDUAN.md                   ← langkah lengkap instalasi, uji, dan pengumpulan
```

Detail fitur, skema database, dan keamanan aplikasi ada di [`rsvp-app/README.md`](rsvp-app/README.md).

## Instalasi singkat (XAMPP)

1. Salin `personal-mX-nama/personal/` milik Anda ke `C:\xampp\htdocs\personal\`.
2. phpMyAdmin → Import `app/sql/schema.sql`, lalu jalankan `app/sql/create_user.sql` di tab SQL.
3. Salin `config/db.example.php` menjadi `config/db.php`.
4. Buka `http://localhost/personal/` dan `http://localhost/personal/app/`.

Folder `app/` di setiap personal page adalah salinan `rsvp-app/`. Perubahan aplikasi
dikerjakan di `rsvp-app/`, lalu disalin ulang ke kelima folder `app/`.
