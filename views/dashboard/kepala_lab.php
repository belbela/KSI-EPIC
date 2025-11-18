<?php
session_start();
require_once __DIR__ . '/../../helpers/auth_helper.php';
require_once __DIR__ . '/../../models/HasilTes.php';

// Cek login
requireLogin();
requireRole('kepala_lab');

// Ambil statistik
$hasilTesModel = new HasilTes();
$statistik = $hasilTesModel->getStatistik();
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Kepala Lab - Sistem TOEFL</title>
    <link href="../../assets/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .navbar-custom {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        .card-header-custom {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }
        .stat-card {
            border-left: 4px solid #667eea;
            padding: 20px;
            border-radius: 8px;
            background: white;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        }
        .stat-value {
            font-size: 2rem;
            font-weight: 700;
            color: #667eea;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark navbar-custom">
        <div class="container">
            <a class="navbar-brand" href="../../index.php">Sistem TOEFL</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <span class="nav-link">Kepala Lab</span>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../../controllers/Auth.php?action=logout">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container my-5">
        <h2 class="mb-4">Dashboard Kepala Lab</h2>

        <!-- Statistik Umum -->
        <div class="row mb-5">
            <div class="col-md-3">
                <div class="stat-card">
                    <small class="text-muted">Total Peserta</small>
                    <div class="stat-value"><?= $statistik['total_peserta'] ?? 0; ?></div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stat-card">
                    <small class="text-muted">Rata-Rata Skor</small>
                    <div class="stat-value"><?= round($statistik['rata_rata_skor'] ?? 0); ?></div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stat-card">
                    <small class="text-muted">Skor Terendah</small>
                    <div class="stat-value"><?= $statistik['skor_terendah'] ?? 0; ?></div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stat-card">
                    <small class="text-muted">Skor Tertinggi</small>
                    <div class="stat-value"><?= $statistik['skor_tertinggi'] ?? 0; ?></div>
                </div>
            </div>
        </div>

        <!-- Laporan -->
        <div class="card">
            <div class="card-header card-header-custom">
                <h5 class="mb-0">Laporan & Monitoring</h5>
            </div>
            <div class="card-body">
                <p class="text-muted">Fitur laporan detail akan ditambahkan di versi berikutnya</p>
                <ul>
                    <li>Laporan hasil tes per periode</li>
                    <li>Grafik statistik skor peserta</li>
                    <li>Export laporan ke PDF/Excel</li>
                </ul>
            </div>
        </div>
    </div>

    <script src="../../assets/js/bootstrap.bundle.min.js"></script>
</body>
</html>
