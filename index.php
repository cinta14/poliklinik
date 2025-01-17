<?php
session_start();
include_once 'navbar.php';

// Fungsi untuk redirect ke halaman login jika belum login
function redirectToLoginIfNotLoggedIn()
{
    if (!isset($_SESSION['nama'])) {
        header("Location: login_user.php");
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Poliklinik</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="app/plugins/fontawesome-free/css/all.min.css">
    <!-- Bootstrap 4 -->
    <link rel="stylesheet" href="app/plugins/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="app/dist/css/adminlte.min.css">

    <style>
        /* Global Styles */
        body {
            margin: 0;
            padding: 0;
            background-color: #f4f6f9;
        }

        /* Hero Section */
        .hero-section {
            height: 400px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            color: white;
            text-align: center;
            padding: 20px;
        }

        .hero-section h1 {
            font-size: 48px;
            font-weight: 700;
            margin-bottom: 20px;
        }

        .hero-section p {
            font-size: 20px;
            margin-top: 10px;
        }

        /* Card Layout */
        .card-container {
            display: flex;
            justify-content: center;
            gap: 30px;
            margin-top: 50px;
            flex-wrap: wrap;
        }

        .card {
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 300px;
            padding: 30px;
            text-align: center;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .card:hover {
            transform: translateY(-10px);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2);
        }

        .card i {
            font-size: 34px;
            color: #007bff;
            /* Warna biru sesuai dengan bg-primary */
        }

        .card h3 {
            font-size: 24px;
            margin-top: 20px;
        }

        .card p {
            font-size: 16px;
            color: #666;
            margin-top: 10px;
        }

        .card .btn {
            margin-top: 20px;
            background-color: #007bff;
            /* Warna biru sesuai dengan bg-primary */
            color: white;
            padding: 12px 30px;
            border-radius: 5px;
            text-decoration: none;
            font-size: 16px;
            transition: background-color 0.3s ease;
        }

        .card .btn:hover {
            background-color: #0056b3;
            /* Darker blue on hover */
        }
         /* FAQ Section */
         #faq {
            background-color: #fff;
            padding: 30px;
            margin-top: 40px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        #faq h2 {
            text-align: center;
            color: #007bff;
            font-size: 2.5em;
        }

        .faq-container {
            margin-top: 20px;
        }

        .faq-item {
            background-color: #f9f9f9;
            border-left: 5px solid #007bff;
            padding: 20px;
            margin-bottom: 15px;
            border-radius: 5px;
            transition: transform 0.3s ease;
        }

        .faq-item:hover {
            transform: translateX(5px);
            background-color: #e7f1ff;
        }

        .faq-item h3 {
            font-size: 1.25em;
            color: #007bff;
            margin-bottom: 10px;
        }

        .faq-item p {
            font-size: 1em;
            color: #555;
        }

        /* Review Section */
        #reviews {
            background-color: #fff;
            padding: 30px;
            margin-top: 40px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        #reviews h2 {
            text-align: center;
            color: #007bff;
            font-size: 2.5em;
        }

        .review-container {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }

        .review-item {
            background-color: #f9f9f9;
            padding: 20px;
            border-radius: 8px;
            width: 30%;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
            transition: transform 0.3s ease;
        }

        .review-item:hover {
            transform: translateY(-5px);
            background-color: #e7f1ff;
        }

        .review-item h3 {
            font-size: 1.2em;
            color: #007bff;
            margin-bottom: 10px;
        }

        .review-item p {
            font-size: 1em;
            color: #555;
            font-style: italic;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .card-container {
                flex-direction: column;
                gap: 20px;
            }

            .card {
                width: 100%;
            }

            .review-container {
                flex-direction: column;
            }

            .review-item {
                width: 100%;
                margin-bottom: 20px;
            }

        /* Responsive design */
        @media (max-width: 768px) {
            .hero-section h1 {
                font-size: 36px;
            }

            .hero-section p {
                font-size: 18px;
            }

            .card-container {
                flex-direction: column;
                align-items: center;
            }

            .card {
                width: 80%;
                margin-bottom: 20px;
            }
        }
    </style>
</head>

<body>
    <!-- Hero Section -->
    <div class="hero-section bg-primary">
        <h1>Selamat datang di Poliklinik</h1>
        <p>Pelayanan Kesehatan Terbaik Se Dunia</p>
    </div>

    <!-- Main Content -->
    <div class="container">
        <div class="card-container">
            <!-- Pasien Card -->
            <div class="card">
                <i class="fas fa-hospital "></i> <!-- Icon warna biru menggunakan class text-primary -->
                <h3>Pasien</h3>
                <p>Sebagai Pasien dapat melakukan registrasi terlebih dahulu untuk melakukan pendaftaran Pasien.</p>
                <a href="login_pasien.php" class="btn">Login</a>
            </div>

            <!-- Dokter Card -->
            <div class="card">
                <i class="fas fa-user-md "></i> <!-- Icon warna biru menggunakan class text-primary -->
                <h3>Dokter</h3>
                <p>Sebagai Dokter dapat melakukan login terlebih dahulu untuk melakukan pelayanan Pasien.</p>
                <a href="login_user.php" class="btn">Login</a>
            </div>
        </div>
        
          <!-- FAQ Section -->
          <section id="faq">
            <h2>FAQ (Frequently Asked Questions)</h2>
            <div class="faq-container">
                <div class="faq-item">
                    <h3>1. Apa fungsinya aplikasi ini?</h3>
                    <p>Aplikasi ini adalah sistem untuk mempermudah pendaftaran dan pelayanan medis antara pasien dan dokter.</p>
                </div>
                <div class="faq-item">
                    <h3>2. Apakah saya perlu membuat akun untuk menggunakan aplikasi ini?</h3>
                    <p>pasien perlu mendaftar terlebih dahulu untuk membuat akun dan mengakses layanan pendaftaran</p>
                </div>
                <div class="faq-item">
                    <h3>3. Bagaimana cara mendaftar sebagai pasien?</h3>
                    <p>Untuk mendaftar sebagai pasien, Anda perlu melakukan registrasi terlebih dahulu melalui halaman login pasien.</p>
                </div>
                
                <div class="faq-item">
                    <h3>4. Apakah saya bisa memilih dokter yang saya inginkan?</h3>
                    <p>setelah login sebagai pasien, Anda bisa memilih dokter yang sesuai dengan jadwal yang tersedia.</p>
                </div>
            </div>
        </section>

        <!-- Review Section -->
        <section id="reviews">
            <h2>Ulasan Pengguna</h2>
            <div class="review-container">
                <div class="review-item">
                    <h3>Ruby (Pasien)</h3>
                    <p>"Aplikasi ini sangat membantu saya untuk mendaftar dan memilih jadwal dokter dengan mudah."</p>
                </div>
                <div class="review-item">
                    <h3>Joni (Pasien)</h3>
                    <p>"Sangat efisien! Saya bisa melihat pasien yang terdaftar dengan cepat dan memberikan pelayanan yang optimal."</p>
                </div>
                <div class="review-item">
                    <h3>Deni (Pasien)</h3>
                    <p>"Pengalaman yang luar biasa. Proses pendaftaran sangat cepat dan tidak ada kesulitan sama sekali."</p>
                </div>
            </div>
        </section>
    </div>

    </div>

    <!-- jQuery and Bootstrap JS -->
    <script src="app/plugins/jquery/jquery.min.js"></script>
    <script src="app/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="app/dist/js/adminlte.min.js"></script>
</body>

</html>