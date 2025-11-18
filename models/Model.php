<?php
require_once __DIR__ . '/../config/database.php';

class Pendaftaran {
    private $conn;
    private $table = 'pendaftaran';

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function getAll() {
        $query = "SELECT p.*, m.nama_lengkap, m.nim, j.tanggal_tes
                  FROM pendaftaran p
                  JOIN mahasiswa m ON p.mahasiswa_id = m.id
                  JOIN jadwal_tes j ON p.jadwal_tes_id = j.id
                  ORDER BY p.id DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Tambahkan method lain: verifikasi, update status, dll sesuai kebutuhan
}
?>