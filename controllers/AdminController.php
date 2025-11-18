<?php
session_start();
require_once __DIR__ . '/../models/Pendaftaran.php';
require_once __DIR__ . '/../models/JadwalTes.php';
require_once __DIR__ . '/../helpers/auth_helper.php';

// Cek apakah user sudah login dan role-nya admin
requireLogin();
requireRole('admin');

class AdminController {
    // Tampilkan dashboard admin
    public function index() {
        $pendaftaran = new Pendaftaran();
        $dataPendaftar = $pendaftaran->getAll();

        $jadwalTes = new JadwalTes();
        $dataJadwal = $jadwalTes->getAll();

        include __DIR__ . '/../views/dashboard/admin.php';
    }

    // Fitur: verifikasi pembayaran (misal lewat GET/POST)
    // Dll...
}
?>