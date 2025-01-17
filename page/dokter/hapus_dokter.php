<?php
include '../../koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil nilai dari form
    $id = $_POST["id"];

    // Query untuk melakukan hapus data dokter
    $query = "DELETE FROM dokter WHERE id = $id";

    // Eksekusi query
    if (mysqli_query($mysqli, $query)) {
        // Jika berhasil, tampilkan SweetAlert2 untuk konfirmasi sukses
        echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>';
        echo '<script>
                document.addEventListener("DOMContentLoaded", function() {
                    Swal.fire({
                        icon: "success",
                        title: "Sukses",
                        text: "Data dokter berhasil dihapus!",
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
                        text: "Terjadi kesalahan saat menghapus data dokter. Coba lagi.",
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
