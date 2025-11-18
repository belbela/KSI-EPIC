<?php
/**
 * Mahasiswa Controller
 * Dibuat oleh: Gheytsha
 * Tanggal: 18 November 2025
 */

session_start();
require_once __DIR__ . '/../models/Mahasiswa.php';
require_once __DIR__ . '/../models/HasilTes.php';
require_once __DIR__ . '/../models/JadwalTes.php';
require_once __DIR__ . '/../helpers/auth_helper.php';

// Cek login dan role mahasiswa
requireLogin();
requireRole('mahasiswa');

class MahasiswaController {
    private $mahasiswaModel;
    private $hasilTesModel;
    private $jadwalTesModel;

    public function __construct() {
        $this->mahasiswaModel = new Mahasiswa();
        $this->hasilTesModel = new HasilTes();
        $this->jadwalTesModel = new JadwalTes();
    }

    /**
     * Dashboard mahasiswa
     */
    public function index() {
        $mahasiswa = $this->mahasiswaModel->getByUserId($_SESSION['user_id']);
        $riwayatPendaftaran = $this->mahasiswaModel->getRiwayatPendaftaran($mahasiswa['id']);
        $hasilTes = $this->hasilTesModel->getByMahasiswaId($mahasiswa['id']);
        $jadwalTes = $this->jadwalTesModel->getAll();

        include __DIR__ . '/../views/dashboard/mahasiswa.php';
    }

    /**
     * Daftar tes
     */
    public function daftarTes() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $mahasiswa_id = $_POST['mahasiswa_id'];
            $jadwal_tes_id = $_POST['jadwal_tes_id'];

            if ($this->mahasiswaModel->daftarTes($mahasiswa_id, $jadwal_tes_id)) {
                $_SESSION['success'] = "Pendaftaran berhasil! Silakan upload bukti pembayaran.";
                header("Location: ../views/dashboard/mahasiswa.php");
            } else {
                $_SESSION['error'] = "Pendaftaran gagal!";
                header("Location: ../views/dashboard/mahasiswa.php");
            }
            exit();
        }
    }
}
?>
