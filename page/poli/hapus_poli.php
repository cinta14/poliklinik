<?php
include '../../koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil nilai dari form
    $id = $_POST["id"];

    // Query untuk menghapus data poli
    $query = "DELETE FROM poli WHERE id = $id";

    // Eksekusi query
    if (mysqli_query($mysqli, $query)) {
        // Jika berhasil, tampilkan SweetAlert dan redirect
        echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>'; // pastikan SweetAlert2 sudah ter-load
        echo '<script>';
        echo 'window.onload = function() {';
        echo '  Swal.fire({';
        echo '    icon: "success",';
        echo '    title: "Sukses!",';
        echo '    text: "Data poli berhasil dihapus!"';
        echo '  }).then(function() {';
        echo '    window.location.href = "../../poli.php";'; // Redirect setelah alert ditutup
        echo '  });';
        echo '};';
        echo '</script>';
        exit();
    } else {
        // Jika terjadi kesalahan, tampilkan SweetAlert dengan pesan error
        echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>'; // pastikan SweetAlert2 sudah ter-load
        echo '<script>';
        echo 'window.onload = function() {';
        echo '  Swal.fire({';
        echo '    icon: "error",';
        echo '    title: "Gagal!",';
        echo '    text: "Terjadi kesalahan dalam menghapus data poli!"';
        echo '  }).then(function() {';
        echo '    window.location.href = "../../poli.php";'; // Redirect setelah alert ditutup
        echo '  });';
        echo '};';
        echo '</script>';
    }
}

// Tutup koneksi
mysqli_close($mysqli);
?>