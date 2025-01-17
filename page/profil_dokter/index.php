<?php
// Periksa apakah sesi sudah dimulai
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Koneksi ke database
require 'C:\xampp\htdocs\poli_bk\koneksi.php';

// Periksa apakah pengguna sudah login
if (!isset($_SESSION['akses']) || $_SESSION['akses'] !== "dokter") {
    header("location:login_user.php");
    exit;
}

// Ambil data dokter dari session
$id_dokter = $_SESSION['id'] ?? null;

// Cek validitas ID dokter
if (!$id_dokter) {
    die("ID dokter tidak valid!");
}

// Ambil data dokter dari database
$query = "SELECT * FROM dokter WHERE id = ?";
$stmt = $mysqli->prepare($query);
$stmt->bind_param("i", $id_dokter);
$stmt->execute();
$result = $stmt->get_result();
$dokter = $result->fetch_assoc();

if (!$dokter) {
    die("Data dokter tidak ditemukan!");
}

// Variabel untuk mengisi form
$nama = $dokter['nama'] ?? '';
$alamat = $dokter['alamat'] ?? '';
$no_hp = $dokter['no_hp'] ?? '';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profil Dokter</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
    
</head>
<body>
    <div class="container mt-5">
        <h3 class="text-center mb-4">Edit Data Dokter</h3>
        <div class="card">
            <div class="card-header bg-primary text-white">
                Edit Data Dokter
            </div>
            <div class="card-body">
                <form action="page/profil_dokter/update_dokter.php" method="POST">
                    <input type="hidden" name="id" value="<?= htmlspecialchars($id_dokter); ?>">

                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama Dokter</label>
                        <input type="text" class="form-control" id="nama" name="nama" 
                               value="<?= htmlspecialchars($nama); ?>" required>
                    </div>

                    <div class="mb-3">
                        <label for="alamat" class="form-label">Alamat Dokter</label>
                        <input type="text" class="form-control" id="alamat" name="alamat" 
                               value="<?= htmlspecialchars($alamat); ?>" required>
                    </div>

                    <div class="mb-3">
                        <label for="no_hp" class="form-label">Telepon Dokter</label>
                        <input type="text" class="form-control" id="no_hp" name="no_hp" 
                               value="<?= htmlspecialchars($no_hp); ?>" required>
                    </div>
                    <div class="mb-3">
    <label for="password" class="form-label">Password Baru</label>
    <input type="password" class="form-control" id="password" name="password" 
           placeholder="Kosongkan jika tidak ingin mengubah password">
</div>

                    <button type="submit" class="btn btn-primary">Edit Profile</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
