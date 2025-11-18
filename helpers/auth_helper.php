<?php
/**
 * Auth Helper
 * Dibuat oleh: Rachel
 * Tanggal: 18 November 2025
 * Deskripsi: Helper functions untuk autentikasi
 */

/**
 * Cek apakah user sudah login
 * @return bool
 */
function isLoggedIn() {
    return isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true;
}

/**
 * Cek role user
 * @param string $role
 * @return bool
 */
function hasRole($role) {
    return isset($_SESSION['role']) && $_SESSION['role'] === $role;
}

/**
 * Redirect jika belum login
 */
function requireLogin() {
    if (!isLoggedIn()) {
        header("Location: ../auth/login.php");
        exit();
    }
}

/**
 * Redirect jika bukan role tertentu
 * @param string $role
 */
function requireRole($role) {
    if (!hasRole($role)) {
        header("Location: ../auth/login.php");
        exit();
    }
}

/**
 * Get current user data dari session
 * @return array
 */
function getCurrentUser() {
    if (!isLoggedIn()) {
        return null;
    }
    
    return [
        'id' => $_SESSION['user_id'] ?? null,
        'email' => $_SESSION['email'] ?? null,
        'role' => $_SESSION['role'] ?? null
    ];
}
?>