<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start(); // Start the session only if it's not already active
}
require 'koneksi.php'; // Database connection file

// Set default nama and id_poli for testing (Remove this in production)
if (!isset($_SESSION['nama'])) {
    $_SESSION['nama'] = 'Rafi'; // Example nama
}
if (!isset($_SESSION['id_poli'])) {
    $_SESSION['id_poli'] = 1; // Example id_poli
}

$nama = $_SESSION['nama'];
$id_poli = $_SESSION['id_poli'];

if ($id_poli) {
    // Use prepared statements to fetch nama_poli
    $stmt = $mysqli->prepare("SELECT nama_poli FROM poli WHERE id = ?");
    $stmt->bind_param("i", $id_poli);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $nama_poli = $row['nama_poli'];
    } else {
        $nama_poli = "Nama poli tidak ditemukan";
    }
    $stmt->close();
} else {
    $nama_poli = "Poli tidak tersedia";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dokter Dashboard</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
    /* Menggunakan gambar background */
    .content-header h1, .content-header h4 {
            font-weight: 500;
            text-align: center;
        }

    /* Kartu atau box konten dengan bayangan */
    .content-box {
        background: rgba(255, 255, 255, 0.8);
        padding: 40px;
        margin-top: 30px;
        border-radius: 15px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
        width: 80%;
        max-width: 800px;
        margin-left: auto;
        margin-right: auto;
    }

    .content-box h2 {
        font-size: 30px;
        font-weight: 600;
        color: #333;
    }

    .content-box p {
        font-size: 18px;
        color: #555;
        line-height: 1.6;
    }
</style>

<body>
    <!-- Content Header -->
    <div class="content-header py-5 bg-primary">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1 class="m-0 text-white">Selamat Datang <b>Dokter <?php echo htmlspecialchars($nama); ?></b></h1>
                    <h4 class="m-0 text-white">Anda berada di <b><?php echo htmlspecialchars($nama_poli); ?></b></h4>
                </div>
            </div>
        </div>
    </div>

    <!-- Box Konten tambahan (optional) -->
    <div class="content-box">
        <h2>Informasi Layanan</h2>
        <p>Selamat datang di sistem informasi rumah sakit kami. Di sini, Anda dapat melihat jadwal periksa, periksa pasien, melihat riwayat pasien, dan update profil. Nikmati pengalaman menggunakan sistem kami dengan lebih baik!</p>
    </div>
</body>


</html>