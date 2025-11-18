<?php
require_once __DIR__ . '/../config/database.php';

class JadwalTes {
    private $conn;
    private $table = 'jadwal_tes';

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function getAll() {
        $query = "SELECT * FROM jadwal_tes ORDER BY tanggal_tes DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Tambahkan method CRUD jadwal
}
?>