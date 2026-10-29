-- =====================================================================
-- Skema database aplikasi bersama: Pendaftaran Acara (RSVP)
-- Kelompok Komputasi Awan dan Terdistribusi
-- Kompatibel dengan MariaDB (XAMPP) dan MySQL 8 (GCP).
-- Impor lewat phpMyAdmin (tab Import) memakai user root.
-- =====================================================================

CREATE DATABASE IF NOT EXISTS kelompok_db
  CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE kelompok_db;

DROP TABLE IF EXISTS pendaftar;
DROP TABLE IF EXISTS acara;
DROP TABLE IF EXISTS anggota;

-- Tabel wajib: identitas server/laman setiap anggota
CREATE TABLE anggota (
  route_id VARCHAR(10)  NOT NULL PRIMARY KEY,   -- m0 (ketua), m1..m4
  nim      VARCHAR(15)  NOT NULL,
  nama     VARCHAR(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Daftar acara beserta kuota.
-- Kolom terisi adalah penghitung pendaftar; selalu diubah di dalam transaksi
-- bersamaan dengan INSERT ke tabel pendaftar sehingga kuota tidak terlampaui.
CREATE TABLE acara (
  id          INT UNSIGNED  NOT NULL AUTO_INCREMENT PRIMARY KEY,
  route_id    VARCHAR(10)   NOT NULL,             -- server yang membuat acara
  judul       VARCHAR(150)  NOT NULL,
  deskripsi   TEXT          NOT NULL,
  lokasi      VARCHAR(150)  NOT NULL,
  waktu_mulai DATETIME      NOT NULL,
  kuota       INT UNSIGNED  NOT NULL,
  terisi      INT UNSIGNED  NOT NULL DEFAULT 0,
  created_at  TIMESTAMP     NOT NULL DEFAULT CURRENT_TIMESTAMP,
  CONSTRAINT fk_acara_anggota FOREIGN KEY (route_id) REFERENCES anggota (route_id),
  CONSTRAINT chk_acara_kuota CHECK (kuota > 0 AND terisi <= kuota),
  INDEX idx_acara_waktu (waktu_mulai)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Pendaftar acara. Satu email hanya boleh mendaftar sekali per acara.
CREATE TABLE pendaftar (
  id         INT UNSIGNED  NOT NULL AUTO_INCREMENT PRIMARY KEY,
  acara_id   INT UNSIGNED  NOT NULL,
  route_id   VARCHAR(10)   NOT NULL,              -- server yang menerima pendaftaran
  nama       VARCHAR(100)  NOT NULL,
  email      VARCHAR(150)  NOT NULL,
  instansi   VARCHAR(100)  NULL,
  created_at TIMESTAMP     NOT NULL DEFAULT CURRENT_TIMESTAMP,
  CONSTRAINT fk_pendaftar_acara   FOREIGN KEY (acara_id) REFERENCES acara (id) ON DELETE CASCADE,
  CONSTRAINT fk_pendaftar_anggota FOREIGN KEY (route_id) REFERENCES anggota (route_id),
  CONSTRAINT uq_pendaftar_email   UNIQUE (acara_id, email),
  INDEX idx_pendaftar_created (created_at)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ---------------------------------------------------------------------
-- Data awal
-- ---------------------------------------------------------------------
INSERT INTO anggota (route_id, nim, nama) VALUES
  ('m0', '103012430038', 'Hasnat Ferdiananda'),
  ('m1', '103012400056', 'Daffandri Faiz Zhafransyah'),
  ('m2', '103012400042', 'Rasyid Ridlo'),
  ('m3', '103012400298', 'Gathfan Fadhilah Ananda Syukur'),
  ('m4', '103012400405', 'Faqih Hanif Abdul Rahman');

INSERT INTO acara (route_id, judul, deskripsi, lokasi, waktu_mulai, kuota) VALUES
  ('m0', 'Study Group Komputasi Awan',
   'Belajar bersama materi virtualisasi, container, dan layanan cloud menjelang UTS. Kuota sengaja kecil untuk menguji kondisi kuota penuh.',
   'Ruang Diskusi Perpustakaan', '2026-11-08 13:00:00', 5),
  ('m1', 'Workshop Docker untuk Pemula',
   'Praktik langsung membuat image, menjalankan container, dan menyusun docker-compose untuk aplikasi PHP + MySQL.',
   'Lab Komputer Gedung TULT', '2026-11-15 09:00:00', 30),
  ('m2', 'Seminar Karier Cloud Engineer',
   'Sesi berbagi pengalaman dari praktisi tentang jalur karier cloud engineer, sertifikasi, dan tips magang.',
   'Aula Fakultas Informatika', '2026-11-22 10:00:00', 100),
  ('m3', 'Mini Hackathon Aplikasi Terdistribusi',
   'Kompetisi 8 jam membangun aplikasi web sederhana yang berjalan di beberapa server dengan load balancer.',
   'Co-working Space Kampus', '2026-12-05 08:00:00', 40),
  ('m4', 'Bakti Sosial Literasi Digital',
   'Kegiatan pengabdian masyarakat: pengenalan internet aman dan layanan cloud gratis untuk pelajar SMA.',
   'SMA Mitra, Kabupaten Bandung', '2026-12-13 08:30:00', 25);
