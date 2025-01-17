<?php
include '../../koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil nilai dari form
    $nama_obat = $_POST["nama_obat"];
    $kemasan = $_POST["kemasan"];
    $harga = $_POST["harga"];

    // Query untuk menambahkan data obat ke dalam tabel
    $query = "INSERT INTO obat (nama_obat, kemasan, harga) VALUES ('$nama_obat', '$kemasan', '$harga')";

    // Eksekusi query
    if (mysqli_query($mysqli, $query)) {
        // Jika berhasil, tampilkan SweetAlert dan redirect
        echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>'; // pastikan SweetAlert2 sudah ter-load
        echo '<script>';
        echo 'window.onload = function() {';
        echo '  Swal.fire({';
        echo '    icon: "success",';
        echo '    title: "Sukses!",';
        echo '    text: "Data obat berhasil ditambahkan!"';
        echo '  }).then(function() {';
        echo '    window.location.href = "../../obat.php";'; // Redirect setelah alert ditutup
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
        echo '    text: "Terjadi kesalahan dalam menambahkan data obat!"';
        echo '  }).then(function() {';
        echo '    window.location.href = "../../obat.php";'; // Redirect setelah alert ditutup
        echo '  });';
        echo '};';
        echo '</script>';
    }
}

// Tutup koneksi
mysqli_close($mysqli);
?>