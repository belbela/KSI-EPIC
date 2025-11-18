<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem TOEFL Lab Bahasa</title>
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .hero-section {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 100px 0;
            min-height: 100vh;
            display: flex;
            align-items: center;
        }

        .hero-title {
            font-size: 3rem;
            font-weight: 700;
            margin-bottom: 20px;
        }

        .hero-subtitle {
            font-size: 1.25rem;
            margin-bottom: 40px;
            opacity: 0.9;
        }

        .btn-hero {
            padding: 15px 40px;
            font-size: 1.1rem;
            border-radius: 50px;
            margin: 10px;
            transition: transform 0.3s;
        }

        .btn-hero:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
        }

        .features {
            padding: 80px 0;
            background: #f8f9fa;
        }

        .feature-card {
            text-align: center;
            padding: 40px 20px;
            border-radius: 15px;
            background: white;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s;
            margin-bottom: 30px;
        }

        .feature-card:hover {
            transform: translateY(-10px);
        }

        .feature-icon {
            font-size: 3rem;
            margin-bottom: 20px;
            color: #667eea;
        }
    </style>
</head>

<body>
    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <h1 class="hero-title">Sistem Pendaftaran TOEFL Lab Bahasa</h1>
                    <p class="hero-subtitle">
                        Mahasiswa dapat mendaftar tes, upload bukti pembayaran, dan download sertifikat PDF dengan mudah dan cepat
                    </p>
                    <div>
                        <a href="views/auth/login.php" class="btn btn-light btn-hero">
                            Login
                        </a>
                        <a href="views/auth/register.php" class="btn btn-outline-light btn-hero">
                            Daftar Sekarang
                        </a>
                    </div>
                </div>
                <div class="col-lg-6">
                    <!-- Optional: Tambahkan ilustrasi atau gambar -->
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="features">
        <div class="container">
            <div class="text-center mb-5">
                <h2>Fitur Unggulan</h2>
                <p class="text-muted">Kemudahan dalam satu sistem</p>
            </div>

            <div class="row">
                <div class="col-md-4">
                    <div class="feature-card">
                        <div class="feature-icon">📝</div>
                        <h4>Pendaftaran Online</h4>
                        <p class="text-muted">Daftar tes TOEFL kapan saja dan dimana saja</p>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="feature-card">
                        <div class="feature-icon">💳</div>
                        <h4>Pembayaran Mudah</h4>
                        <p class="text-muted">Upload bukti pembayaran dan tracking status</p>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="feature-card">
                        <div class="feature-icon">📄</div>
                        <h4>Sertifikat Digital</h4>
                        <p class="text-muted">Download sertifikat TOEFL Anda dalam format PDF</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-card">
                        <div class="feature-icon">📊</div>
                        <h4>Dashboard Interaktif</h4>
                        <p class="text-muted">Monitoring riwayat tes dan hasil dengan visualisasi data</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-dark text-white text-center py-4">
        <div class="container">
            <p class="mb-0">&copy; 2025 Lab Bahasa - Sistem TOEFL. All rights reserved.</p>
        </div>
    </footer>

    <script src="assets/js/bootstrap.bundle.min.js"></script>
</body>

</html>