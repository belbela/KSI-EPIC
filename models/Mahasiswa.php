<?php
/**
 * Mahasiswa Model
 * Dibuat oleh: Gheytsha
 * Tanggal: 18 November 2025
 */

require_once __DIR__ . '/../config/database.php';

class Mahasiswa {
    private $conn;
    private $table = 'mahasiswa';

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    /**
     * Ambil data mahasiswa berdasarkan user_id
     */
    public function getByUserId($user_id) {
        $query = "SELECT * FROM " . $this->table . " 
                  WHERE user_id = :user_id";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':user_id', $user_id);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Daftar tes baru
     */
    public function daftarTes($mahasiswa_id, $jadwal_tes_id) {
        $query = "INSERT INTO pendaftaran 
                  (mahasiswa_id, jadwal_tes_id, status_pembayaran) 
                  VALUES (:mahasiswa_id, :jadwal_tes_id, 'pending')";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':mahasiswa_id', $mahasiswa_id);
        $stmt->bindParam(':jadwal_tes_id', $jadwal_tes_id);

        return $stmt->execute();
    }

    /**
     * Ambil riwayat pendaftaran mahasiswa
     */
    public function getRiwayatPendaftaran($mahasiswa_id) {
        $query = "SELECT p.*, j.tanggal_tes, j.waktu_mulai, j.lokasi
                  FROM pendaftaran p
                  JOIN jadwal_tes j ON p.jadwal_tes_id = j.id
                  WHERE p.mahasiswa_id = :mahasiswa_id
                  ORDER BY p.tanggal_daftar DESC";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':mahasiswa_id', $mahasiswa_id);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
