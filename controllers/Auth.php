<?php
/**
 * Auth Controller
 * Dibuat oleh: Rachel
 * Tanggal: 18 November 2025
 * Deskripsi: Controller untuk menangani autentikasi (login, register, logout)
 */

session_start();
require_once _DIR_ . '/../models/User.php';

class Auth {
    private $userModel;

    public function __construct() {
        $this->userModel = new User();
    }

    /**
     * Handle login
     */
    public function login() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $email = trim($_POST['email']);
            $password = trim($_POST['password']);

            // Validasi input
            if (empty($email) || empty($password)) {
                $_SESSION['error'] = "Email dan password harus diisi!";
                header("Location: ../views/auth/login.php");
                exit();
            }

            // Cek kredensial
            $user = $this->userModel->login($email, $password);

            if ($user) {
                // Set session
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['email'] = $user['email'];
                $_SESSION['role'] = $user['role'];
                $_SESSION['logged_in'] = true;

                // Redirect berdasarkan role
                switch($user['role']) {
                    case 'admin':
                        header("Location: ../views/dashboard/admin.php");
                        break;
                    case 'kepala_lab':
                        header("Location: ../views/dashboard/kepala_lab.php");
                        break;
                    case 'mahasiswa':
                        header("Location: ../views/dashboard/mahasiswa.php");
                        break;
                    default:
                        header("Location: ../index.php");
                }
                exit();
            } else {
                $_SESSION['error'] = "Email atau password salah!";
                header("Location: ../views/auth/login.php");
                exit();
            }
        }
    }

    /**
     * Handle register
     */
    public function register() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $email = trim($_POST['email']);
            $password = trim($_POST['password']);
            $confirm_password = trim($_POST['confirm_password']);

            // Validasi input
            if (empty($email) || empty($password) || empty($confirm_password)) {
                $_SESSION['error'] = "Semua field harus diisi!";
                header("Location: ../views/auth/register.php");
                exit();
            }

            // Validasi email format
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $_SESSION['error'] = "Format email tidak valid!";
                header("Location: ../views/auth/register.php");
                exit();
            }

            // Validasi password match
            if ($password !== $confirm_password) {
                $_SESSION['error'] = "Password tidak cocok!";
                header("Location: ../views/auth/register.php");
                exit();
            }

            // Validasi panjang password
            if (strlen($password) < 6) {
                $_SESSION['error'] = "Password minimal 6 karakter!";
                header("Location: ../views/auth/register.php");
                exit();
            }

            // Register user
            if ($this->userModel->register($email, $password, 'mahasiswa')) {
                $_SESSION['success'] = "Registrasi berhasil! Silakan login.";
                header("Location: ../views/auth/login.php");
                exit();
            } else {
                $_SESSION['error'] = "Email sudah terdaftar atau terjadi kesalahan!";
                header("Location: ../views/auth/register.php");
                exit();
            }
        }
    }

    /**
     * Handle logout
     */
    public function logout() {
        session_unset();
        session_destroy();
        header("Location: ../index.php");
        exit();
    }
}

// Router sederhana
if (isset($_GET['action'])) {
    $auth = new Auth();
    
    switch($_GET['action']) {
        case 'login':
            $auth->login();
            break;
        case 'register':
            $auth->register();
            break;
        case 'logout':
            $auth->logout();
            break;
        default:
            header("Location: ../index.php");
            exit();
    }
}
?>