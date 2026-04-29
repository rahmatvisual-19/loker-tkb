-- SQL untuk menambahkan kolom priority ke tabel jobs
-- Jalankan query ini di phpMyAdmin

-- Menambahkan kolom priority setelah kolom title dengan default value 'Medium'
ALTER TABLE `jobs` 
ADD COLUMN `priority` VARCHAR(50) NOT NULL DEFAULT 'Medium' AFTER `title`;

-- Jika ingin menambahkan komentar pada kolom (opsional)
ALTER TABLE `jobs` 
MODIFY COLUMN `priority` VARCHAR(50) NOT NULL DEFAULT 'Medium' COMMENT 'Skala prioritas: Low Priority, Medium-Low, Medium, High Priority, Critical';
