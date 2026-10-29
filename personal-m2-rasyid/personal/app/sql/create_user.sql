-- Jalankan SEKALI sebagai root (phpMyAdmin > tab SQL) setelah schema.sql.
-- User aplikasi dengan hak minimum; kode aplikasi tidak pernah memakai root.
-- Ganti password_lokal dengan password Anda sendiri, lalu samakan di config/db.php.

CREATE USER IF NOT EXISTS 'app_local'@'localhost' IDENTIFIED BY 'password_lokal';
CREATE USER IF NOT EXISTS 'app_local'@'127.0.0.1' IDENTIFIED BY 'password_lokal';
GRANT SELECT, INSERT, UPDATE, DELETE ON kelompok_db.* TO 'app_local'@'localhost';
GRANT SELECT, INSERT, UPDATE, DELETE ON kelompok_db.* TO 'app_local'@'127.0.0.1';
FLUSH PRIVILEGES;
