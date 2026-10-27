CREATE DATABASE IF NOT EXISTS perpustakaan CHARACTER SET utf8mb4;
USE perpustakaan;

CREATE TABLE IF NOT EXISTS users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(50) NOT NULL UNIQUE,
  password VARCHAR(255) NOT NULL,
  nama VARCHAR(100) NOT NULL
);

CREATE TABLE IF NOT EXISTS buku (
  id_buku INT AUTO_INCREMENT PRIMARY KEY,
  judul VARCHAR(150) NOT NULL,
  pengarang VARCHAR(100) NOT NULL,
  tahun YEAR NOT NULL,
  stok INT NOT NULL DEFAULT 0
);

-- Login default: username = admin | password = admin123
INSERT INTO users (username, password, nama) VALUES
('admin', '$2y$12$75Csow2bq5CQriwFwPHWKeeAontX0rYUct3u8RraETIWIi8gYpjty', 'Administrator');

INSERT INTO buku (judul, pengarang, tahun, stok) VALUES
('Pemrograman Web', 'Budi Raharjo', 2022, 5),
('Basis Data', 'Rosa Ariani', 2021, 3),
('Analisis dan Perancangan Sistem', 'Jogiyanto', 2020, 4);
