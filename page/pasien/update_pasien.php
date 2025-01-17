<?php
include("../../koneksi.php");
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil nilai dari form pasien
    $id = $_POST["id"];
    $nama = $_POST["nama"];
    $alamat = $_POST["alamat"];
    $no_ktp = $_POST["no_ktp"];
    $no_hp = $_POST["no_hp"];

    // Query untuk melakukan update data pasien
    $query = "UPDATE pasien SET 
        nama = '$nama', 
        alamat = '$alamat', 
        no_ktp = '$no_ktp',
        no_hp = '$no_hp'
        WHERE id = '$id'";

    // Eksekusi query
    if (mysqli_query($mysqli, $query)) {
        echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>';
        echo '<script>
                window.onload = function() {
                    Swal.fire({
                        icon: "success",
                        title: "Sukses!",
                        text: "Data pasien berhasil diedit!",
                        confirmButtonText: "OK",
                        willClose: () => {
                            window.location.href = "../../pasien.php";
                        }
                    });
                }
              </script>';
        exit();
    } else {
        // Jika terjadi kesalahan, tampilkan pesan error
        echo "Error: " . $query . "<br>" . mysqli_error($mysqli);
    }
}

mysqli_close($mysqli);
?>