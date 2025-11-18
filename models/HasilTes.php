<?php
/**
 * Hasil Tes Model
 * Dibuat oleh: Gheytsha
 * Tanggal: 18 November 2025
 */

require_once __DIR__ . '/../config/database.php';

class HasilTes {
    private $conn;
    private $table = 'hasil_tes';

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    /**
     * Ambil hasil tes berdasarkan pendaftaran_id
     */
    public function getByPendaftaranId($pendaftaran_id) {
        $query = "SELECT * FROM " . $this->table . " 
                  WHERE pendaftaran_id = :pendaftaran_id";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':pendaftaran_id', $pendaftaran_id);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Ambil semua hasil tes mahasiswa
     */
    public function getByMahasiswaId($mahasiswa_id) {
        $query = "SELECT ht.*, p.mahasiswa_id
                  FROM " . $this->table . " ht
                  JOIN pendaftaran p ON ht.pendaftaran_id = p.id
                  WHERE p.mahasiswa_id = :mahasiswa_id
                  ORDER BY ht.tanggal_tes DESC";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':mahasiswa_id', $mahasiswa_id);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Statistik hasil tes (untuk kepala lab)
     */
    public function getStatistik() {
        $query = "SELECT 
                    COUNT(*) as total_peserta,
                    AVG(total_score) as rata_rata_skor,
                    MIN(total_score) as skor_terendah,
                    MAX(total_score) as skor_tertinggi
                  FROM " . $this->table;
        
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?>
