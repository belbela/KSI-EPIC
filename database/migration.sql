-- Database: sistem_toefl
-- Dibuat oleh: Bella
-- Tanggal: 18 November 2025

-- Buat database
CREATE DATABASE IF NOT EXISTS sistem_toefl;
USE sistem_toefl;

-- ============================================
-- Tabel Users (untuk semua role)
-- ============================================
CREATE TABLE users (
    id INT PRIMARY KEY AUTO_INCREMENT,
    email VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    role ENUM('mahasiswa', 'admin', 'kepala_lab') NOT NULL DEFAULT 'mahasiswa',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- ============================================
-- Tabel Mahasiswa
-- ============================================
CREATE TABLE mahasiswa (
    id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT,
    nim VARCHAR(20) UNIQUE NOT NULL,
    nama_lengkap VARCHAR(100) NOT NULL,
    jurusan VARCHAR(50),
    no_telepon VARCHAR(15),
    alamat TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

-- ============================================
-- Tabel Jadwal Tes
-- ============================================
CREATE TABLE jadwal_tes (
    id INT PRIMARY KEY AUTO_INCREMENT,
    tanggal_tes DATE NOT NULL,
    waktu_mulai TIME NOT NULL,
    waktu_selesai TIME NOT NULL,
    kuota INT DEFAULT 20,
    sisa_kuota INT DEFAULT 20,
    lokasi VARCHAR(100),
    status ENUM('aktif', 'penuh', 'selesai') DEFAULT 'aktif',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- ============================================
-- Tabel Pendaftaran
-- ============================================
CREATE TABLE pendaftaran (
    id INT PRIMARY KEY AUTO_INCREMENT,
    mahasiswa_id INT,
    jadwal_tes_id INT,
    tanggal_daftar TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    status_pembayaran ENUM('pending', 'verified', 'rejected') DEFAULT 'pending',
    bukti_pembayaran VARCHAR(255),
    biaya DECIMAL(10,2) DEFAULT 50000.00,
    catatan TEXT,
    verified_by INT,
    verified_at TIMESTAMP NULL,
    FOREIGN KEY (mahasiswa_id) REFERENCES mahasiswa(id) ON DELETE CASCADE,
    FOREIGN KEY (jadwal_tes_id) REFERENCES jadwal_tes(id) ON DELETE CASCADE,
    FOREIGN KEY (verified_by) REFERENCES users(id) ON DELETE SET NULL
);

-- ============================================
-- Tabel Hasil Tes
-- ============================================
CREATE TABLE hasil_tes (
    id INT PRIMARY KEY AUTO_INCREMENT,
    pendaftaran_id INT,
    listening_score INT,
    structure_score INT,
    reading_score INT,
    total_score INT,
    tanggal_tes DATE,
    sertifikat_path VARCHAR(255),
    input_by INT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (pendaftaran_id) REFERENCES pendaftaran(id) ON DELETE CASCADE,
    FOREIGN KEY (input_by) REFERENCES users(id) ON DELETE SET NULL
);

-- ============================================
-- Insert Data Dummy untuk Testing
-- ============================================

-- Admin dan Kepala Lab
INSERT INTO users (email, password, role) VALUES 
('admin@lab.com', MD5('admin123'), 'admin'),
('kepalalab@lab.com', MD5('kepala123'), 'kepala_lab'),
('mahasiswa@student.com', MD5('mahasiswa123'), 'mahasiswa');

-- Data Mahasiswa Dummy
INSERT INTO mahasiswa (user_id, nim, nama_lengkap, jurusan, no_telepon) VALUES
(3, '2211010001', 'Budi Santoso', 'Teknik Informatika', '081234567890');

-- Jadwal Tes Dummy
INSERT INTO jadwal_tes (tanggal_tes, waktu_mulai, waktu_selesai, lokasi) VALUES
('2025-12-01', '09:00:00', '12:00:00', 'Lab Bahasa Gedung A'),
('2025-12-08', '09:00:00', '12:00:00', 'Lab Bahasa Gedung A'),
('2025-12-15', '13:00:00', '16:00:00', 'Lab Bahasa Gedung B');

-- Pendaftaran Dummy
INSERT INTO pendaftaran (mahasiswa_id, jadwal_tes_id, status_pembayaran) VALUES
(1, 1, 'pending');