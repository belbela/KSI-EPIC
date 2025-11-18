<?php
session_start();
require_once __DIR__ . '/../../helpers/auth_helper.php';
require_once __DIR__ . '/../../models/Mahasiswa.php';
require_once __DIR__ . '/../../models/HasilTes.php';
require_once __DIR__ . '/../../models/JadwalTes.php';

// Cek login
requireLogin();
requireRole('mahasiswa');

// Ambil data
$mahasiswaModel = new Mahasiswa();
$hasilTesModel = new HasilTes();
$jadwalTesModel = new JadwalTes();

$mahasiswa = $mahasiswaModel->getByUserId($_SESSION['user_id']);
$riwayatPendaftaran = $mahasiswaModel->getRiwayatPendaftaran($mahasiswa['id']);
$hasilTes = $hasilTesModel->getByMahasiswaId($mahasiswa['id']);
$jadwalTes = $jadwalTesModel->getAll();
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Mahasiswa - Sistem TOEFL</title>
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
        .sidebar {
            background: white;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            margin-bottom: 20px;
        }
        .nav-link-custom {
            color: #333;
            border-left: 3px solid transparent;
            padding: 10px 15px;
            margin-bottom: 5px;
            border-radius: 5px;
            transition: all 0.3s;
        }
        .nav-link-custom:hover {
            background: #f0f0f0;
            border-left-color: #667eea;
            color: #667eea;
        }
        .badge-status {
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 0.85rem;
        }
        .btn-action {
            padding: 5px 15px;
            font-size: 0.9rem;
            border-radius: 5px;
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
                        <span class="nav-link">Hi, <?= htmlspecialchars($mahasiswa['nama_lengkap']) ?></span>
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
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-3">
                <div class="sidebar">
                    <h5>Menu</h5>
                    <div class="nav-link-custom active">📊 Dashboard</div>
                    <div class="nav-link-custom">📝 Daftar Tes</div>
                    <div class="nav-link-custom">📋 Riwayat</div>
                    <div class="nav-link-custom">📄 Sertifikat</div>
                </div>

                <div class="sidebar">
                    <h6>Informasi Akun</h6>
                    <small class="d-block mb-2"><strong>NIM:</strong> <?= $mahasiswa['nim']; ?></small>
                    <small class="d-block mb-2"><strong>Nama:</strong> <?= $mahasiswa['nama_lengkap']; ?></small>
                    <small class="d-block"><strong>Jurusan:</strong> <?= $mahasiswa['jurusan']; ?></small>
                </div>
            </div>

            <!-- Main -->
            <div class="col-md-9">
                <?php if(isset($_SESSION['success'])): ?>
                    <div class="alert alert-success">
                        <?= $_SESSION['success']; unset($_SESSION['success']); ?>
                    </div>
                <?php endif; ?>

                <?php if(isset($_SESSION['error'])): ?>
                    <div class="alert alert-danger">
                        <?= $_SESSION['error']; unset($_SESSION['error']); ?>
                    </div>
                <?php endif; ?>

                <!-- Card Statistik -->
                <div class="row mb-4">
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body text-center">
                                <h5 class="card-title">Pendaftaran</h5>
                                <h3><?= count($riwayatPendaftaran); ?></h3>
                                <small class="text-muted">Kali terdaftar</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body text-center">
                                <h5 class="card-title">Hasil Tes</h5>
                                <h3><?= count($hasilTes); ?></h3>
                                <small class="text-muted">Sudah selesai</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body text-center">
                                <h5 class="card-title">Sertifikat</h5>
                                <h3><?= count(array_filter($hasilTes, fn($h) => !empty($h['sertifikat_path']))); ?></h3>
                                <small class="text-muted">Tersedia</small>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Riwayat Pendaftaran -->
                <div class="card mb-4">
                    <div class="card-header card-header-custom">
                        <h5 class="mb-0">Riwayat Pendaftaran</h5>
                    </div>
                    <div class="card-body">
                        <?php if(count($riwayatPendaftaran) > 0): ?>
                            <table class="table table-sm table-hover">
                                <thead>
                                    <tr>
                                        <th>Tanggal Daftar</th>
                                        <th>Tanggal Tes</th>
                                        <th>Waktu</th>
                                        <th>Lokasi</th>
                                        <th>Pembayaran</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($riwayatPendaftaran as $p): ?>
                                    <tr>
                                        <td><?= date('d/m/Y', strtotime($p['tanggal_daftar'])); ?></td>
                                        <td><?= date('d/m/Y', strtotime($p['tanggal_tes'])); ?></td>
                                        <td><?= substr($p['waktu_mulai'], 0, 5); ?> - <?= substr($p['waktu_selesai'], 0, 5); ?></td>
                                        <td><?= $p['lokasi']; ?></td>
                                        <td>
                                            <?php 
                                                $badgeClass = $p['status_pembayaran'] == 'verified' ? 'bg-success' : 
                                                             ($p['status_pembayaran'] == 'rejected' ? 'bg-danger' : 'bg-warning');
                                            ?>
                                            <span class="badge <?= $badgeClass; ?>">
                                                <?= ucfirst($p['status_pembayaran']); ?>
                                            </span>
                                        </td>
                                        <td>
                                            <button class="btn btn-sm btn-primary btn-action">Detail</button>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        <?php else: ?>
                            <p class="text-muted">Belum ada pendaftaran. <a href="#daftarTes">Daftar sekarang</a></p>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- Daftar Tes -->
                <div class="card" id="daftarTes">
                    <div class="card-header card-header-custom">
                        <h5 class="mb-0">Jadwal Tes Tersedia</h5>
                    </div>
                    <div class="card-body">
                        <?php if(count($jadwalTes) > 0): ?>
                            <table class="table table-sm table-hover">
                                <thead>
                                    <tr>
                                        <th>Tanggal</th>
                                        <th>Waktu</th>
                                        <th>Lokasi</th>
                                        <th>Sisa Kuota</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($jadwalTes as $j): ?>
                                    <tr>
                                        <td><?= date('d/m/Y', strtotime($j['tanggal_tes'])); ?></td>
                                        <td><?= substr($j['waktu_mulai'], 0, 5); ?> - <?= substr($j['waktu_selesai'], 0, 5); ?></td>
                                        <td><?= $j['lokasi']; ?></td>
                                        <td><?= $j['sisa_kuota']; ?> / <?= $j['kuota']; ?></td>
                                        <td>
                                            <?php if($j['sisa_kuota'] > 0): ?>
                                                <form method="POST" action="../../controllers/MahasiswaController.php?action=daftarTes" style="display: inline;">
                                                    <input type="hidden" name="mahasiswa_id" value="<?= $mahasiswa['id']; ?>">
                                                    <input type="hidden" name="jadwal_tes_id" value="<?= $j['id']; ?>">
                                                    <button type="submit" class="btn btn-sm btn-success btn-action">Daftar</button>
                                                </form>
                                            <?php else: ?>
                                                <span class="text-danger">Penuh</span>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        <?php else: ?>
                            <p class="text-muted">Tidak ada jadwal tes tersedia</p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="../../assets/js/bootstrap.bundle.min.js"></script>
</body>
</html>
