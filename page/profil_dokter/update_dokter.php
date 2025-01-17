<?php
// Periksa apakah sesi sudah dimulai
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Koneksi ke database
require '../../koneksi.php';

// Periksa apakah data dikirim melalui POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'] ?? null;
    $nama = $_POST['nama'] ?? '';
    $alamat = $_POST['alamat'] ?? '';
    $no_hp = $_POST['no_hp'] ?? '';
    $password = $_POST['password'] ?? '';

    // Validasi data
    if (!$id || !$nama || !$alamat || !$no_hp) {
        die("Semua field kecuali password wajib diisi!");
    }

    // Siapkan query untuk update
    if (!empty($password)) {
        $hashed_password = md5($password); // Hash password baru
        $query = "UPDATE dokter SET nama = ?, alamat = ?, no_hp = ?, password = ? WHERE id = ?";
        $stmt = $mysqli->prepare($query);
        $stmt->bind_param("ssssi", $nama, $alamat, $no_hp, $hashed_password, $id);
    } else {
        $query = "UPDATE dokter SET nama = ?, alamat = ?, no_hp = ? WHERE id = ?";
        $stmt = $mysqli->prepare($query);
        $stmt->bind_param("sssi", $nama, $alamat, $no_hp, $id);
    }
 // Eksekusi query
 if ($stmt->execute()) {
    // Update berhasil
    $_SESSION['nama'] = $nama; // Perbarui nama di session
    echo "<script>
            window.onload = function() {
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil',
                    text: 'Profil dokter berhasil diperbarui!',
                    didClose: () => {
                        window.location = '../../profil_dokter.php'; // Redirect setelah alert ditutup
                    }
                });
            };
          </script>";
} else {
    // Update gagal
    echo "<script>
            window.onload = function() {
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal',
                    text: 'Gagal mengupdate data dokter: " . $stmt->error . "'
                });
            };
          </script>";
}
} else {
die("Metode request tidak valid!");
}
?>
<!-- Memuat SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

