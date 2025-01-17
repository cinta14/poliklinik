<?php
include '../../koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil nilai dari form
    $id = $_POST["id"];
    $nama_poli = $_POST["nama_poli"];
    $keterangan = $_POST["keterangan"];

    // Query untuk melakukan update data poli
    $query = "UPDATE poli SET 
        nama_poli = '$nama_poli', 
        keterangan = '$keterangan'
        WHERE id = '$id'";

    // Eksekusi query
    if (mysqli_query($mysqli, $query)) {
        // Jika berhasil, tampilkan SweetAlert dan redirect ke halaman
        echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>'; // pastikan SweetAlert2 sudah ter-load
        echo '<script>';
        echo 'window.onload = function() {';
        echo '  Swal.fire({';
        echo '    icon: "success",';
        echo '    title: "Sukses!",';
        echo '    text: "Data Poli berhasil diedit!"';
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
        echo '    text: "Terjadi kesalahan dalam mengubah data poli!"';
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