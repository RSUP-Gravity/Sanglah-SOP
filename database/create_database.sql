-- SQL Script untuk membuat database SIM SOP Rumah Sakit Sanglah
-- 
-- Cara menggunakan:
-- 1. Buka MySQL CLI, phpMyAdmin, atau MySQL Workbench
-- 2. Copy dan paste script ini
-- 3. Execute
--
-- Atau jalankan via command line:
-- mysql -u root -p < create_database.sql

-- Buat database baru
CREATE DATABASE IF NOT EXISTS sanglah_sop 
CHARACTER SET utf8mb4 
COLLATE utf8mb4_unicode_ci;

-- Gunakan database
USE sanglah_sop;

-- Tampilkan konfirmasi
SELECT 'Database sanglah_sop berhasil dibuat!' AS status;

-- Tampilkan informasi database
SHOW DATABASES LIKE 'sanglah_sop';
