<?php

/**
 * Database Configuration
 * Dibuat oleh: Bella
 * Tanggal: 18 November 2025
 */

class Database
{
    // Database credentials
    private $host = 'localhost';
    private $db_name = 'sistem_toefl';
    private $username = 'root';
    private $password = '';
    public $conn;

    /**
     * Get database connection
     * @return PDO connection object
     */
    public function getConnection()
    {
        $this->conn = null;

        try {
            $this->conn = new PDO(
                "mysql:host=" . $this->host . ";dbname=" . $this->db_name,
                $this->username,
                $this->password
            );

            // Set charset UTF-8
            $this->conn->exec("set names utf8");

            // Set error mode to exceptions
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $exception) {
            echo "Connection error: " . $exception->getMessage();
        }

        return $this->conn;
    }

    /**
     * Close database connection
     */
    public function closeConnection()
    {
        $this->conn = null;
    }
}
