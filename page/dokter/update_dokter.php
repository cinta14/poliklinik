<?php
include '../../koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil nilai dari form
    $id = $_POST["id"];
    $nama = $_POST["nama"];
    $alamat = $_POST["alamat"];
    $no_hp = $_POST["no_hp"];
    $password = $_POST["password"];
    $poli = $_POST["poli"];

    if (!empty($password)) {
        // Hash password jika ada perubahan
        $hashed_password = md5($password);
        // Query untuk melakukan update dengan password baru
        $query = "UPDATE dokter SET 
            nama = '$nama', 
            alamat = '$alamat',
            no_hp = '$no_hp',
            password = '$hashed_password', 
            id_poli = $poli
            WHERE id = '$id'";
    } else {
        // Jika password tidak diubah, hanya update data lainnya tanpa mengubah password
        $query = "UPDATE dokter SET 
            nama = '$nama', 
            alamat = '$alamat',
            no_hp = '$no_hp',
            id_poli = $poli
            WHERE id = '$id'";
    }

    // Eksekusi query
    if (mysqli_query($mysqli, $query)) {
        // Jika berhasil, tampilkan SweetAlert2 untuk konfirmasi
        echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>';
        echo '<script>
                document.addEventListener("DOMContentLoaded", function() {
                    Swal.fire({
                        icon: "success",
                        title: "Sukses",
                        text: "Data dokter berhasil edit!",
                        confirmButtonText: "OK",
                        didClose: () => {
                            window.location.href = "../../dokter.php";
                        }
                    });
                });
              </script>';
        exit();
    } else {
        // Jika terjadi kesalahan, tampilkan SweetAlert2 error
        echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>';
        echo '<script>
                document.addEventListener("DOMContentLoaded", function() {
                    Swal.fire({
                        icon: "error",
                        title: "Gagal",
                        text: "Terjadi kesalahan saat mengubah data dokter. Coba lagi.",
                        confirmButtonText: "OK",
                        didClose: () => {
                            window.location.href = "../../dokter.php";
                        }
                    });
                });
              </script>';
    }
}

// Tutup koneksi
mysqli_close($mysqli);
?>