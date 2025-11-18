<?php
/**
 * User Model
 * Dibuat oleh: Rachel
 * Tanggal: 18 November 2025
 * Deskripsi: Model untuk menangani operasi user (login, register)
 */

require_once _DIR_ . '/../config/database.php';

class User {
    private $conn;
    private $table = 'users';

    public $id;
    public $email;
    public $password;
    public $role;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    /**
     * Login user
     * @param string $email
     * @param string $password
     * @return array|false User data atau false
     */
    public function login($email, $password) {
        $query = "SELECT id, email, role 
                  FROM " . $this->table . " 
                  WHERE email = :email AND password = MD5(:password)";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $password);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }
        
        return false;
    }

    /**
     * Register user baru
     * @param string $email
     * @param string $password
     * @param string $role
     * @return bool
     */
    public function register($email, $password, $role = 'mahasiswa') {
        // Cek email sudah ada atau belum
        if ($this->emailExists($email)) {
            return false;
        }

        $query = "INSERT INTO " . $this->table . " 
                  (email, password, role) 
                  VALUES (:email, MD5(:password), :role)";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $password);
        $stmt->bindParam(':role', $role);

        if ($stmt->execute()) {
            $this->id = $this->conn->lastInsertId();
            return true;
        }
        
        return false;
    }

    /**
     * Cek apakah email sudah terdaftar
     * @param string $email
     * @return bool
     */
    public function emailExists($email) {
        $query = "SELECT id FROM " . $this->table . " 
                  WHERE email = :email";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        return $stmt->rowCount() > 0;
    }

    /**
     * Get user by ID
     * @param int $id
     * @return array|false
     */
    public function getUserById($id) {
        $query = "SELECT id, email, role 
                  FROM " . $this->table . " 
                  WHERE id = :id";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?>