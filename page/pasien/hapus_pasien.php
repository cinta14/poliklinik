<?php
include("../../koneksi.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil nilai dari form
    $id = $_POST["id"];

    // Query untuk melakukan delete data pasien
    $query = "DELETE FROM pasien WHERE id = $id";

    // Eksekusi query
    if (mysqli_query($mysqli, $query)) {
        // Jika berhasil, tampilkan SweetAlert2
        echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>';
        echo '<script>
                window.onload = function() {
                    Swal.fire({
                        icon: "success",
                        title: "Berhasil!",
                        text: "Data pasien berhasil dihapus.",
                        confirmButtonText: "OK",
                        willClose: () => {
                            window.location.href = "../../pasien.php"; // Redirect setelah alert ditutup
                        }
                    });
                }
              </script>';
        exit();
    } else {
        // Jika terjadi kesalahan, tampilkan pesan error
        echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>';
        echo '<script>
                Swal.fire({
                    icon: "error",
                    title: "Gagal!",
                    text: "Terjadi kesalahan saat menghapus data pasien.",
                    confirmButtonText: "OK"
                });
              </script>';
    }
}

// Tutup koneksi
mysqli_close($mysqli);
?>