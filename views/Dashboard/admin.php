<?php
// Pastikan sudah login dan role admin
session_start();
require_once __DIR__ . '/../../helpers/auth_helper.php';
requireLogin();
requireRole('admin');
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Admin - Sistem TOEFL</title>
    <link href="../../assets/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container my-5">
        <h2>Dashboard Admin - Lab Bahasa</h2>
        <hr>
        <h4>Pendaftar Tes TOEFL</h4>
        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Nama Mahasiswa</th>
                    <th>NIM</th>
                    <th>Tanggal Daftar</th>
                    <th>Tanggal Tes</th>
                    <th>Status Pembayaran</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($dataPendaftar as $no => $p): ?>
                <tr>
                    <td><?= $no+1; ?></td>
                    <td><?= $p['nama_lengkap']; ?></td>
                    <td><?= $p['nim']; ?></td>
                    <td><?= $p['tanggal_daftar']; ?></td>
                    <td><?= $p['tanggal_tes']; ?></td>
                    <td><?= $p['status_pembayaran']; ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <h4 class="mt-5">Jadwal Tes</h4>
        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Tanggal Tes</th>
                    <th>Waktu</th>
                    <th>Lokasi</th>
                    <th>Kuota</th>
                    <th>Sisa Kuota</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($dataJadwal as $no => $j): ?>
                <tr>
                    <td><?= $no+1; ?></td>
                    <td><?= $j['tanggal_tes']; ?></td>
                    <td><?= $j['waktu_mulai'].' - '.$j['waktu_selesai']; ?></td>
                    <td><?= $j['lokasi']; ?></td>
                    <td><?= $j['kuota']; ?></td>
                    <td><?= $j['sisa_kuota']; ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <script src="../../assets/js/bootstrap.bundle.min.js"></script>
</body>
</html>