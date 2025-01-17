<?php
include '../../koneksi.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil nilai dari form
    $idPoli = $_SESSION['id_poli'];
    $idDokter = $_SESSION['id'];
    $hari = $_POST["hari"];
    $jamMulai = $_POST["jamMulai"];
    $jamSelesai = $_POST["jamSelesai"];

    // Validasi jika dokter sudah memiliki jadwal pada hari yang sama
    $queryHariSama = "SELECT * FROM jadwal_periksa WHERE id_dokter = '$idDokter' AND hari = '$hari'";

    $resultHariSama = mysqli_query($mysqli, $queryHariSama);
    
    if (mysqli_num_rows($resultHariSama) > 0) {
        // Jika ada jadwal yang sudah ada di hari yang sama
        echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>';
        echo '<script>
                document.addEventListener("DOMContentLoaded", function() {
                    Swal.fire({
                        icon: "error",
                        title: "Jadwal Bertabrakan!",
                        text: "Dokter sudah memiliki jadwal pada hari ini.",
                        confirmButtonText: "OK"
                    }).then(function() {
                        window.location.href = "../../jadwal_periksa.php";
                    });
                });
              </script>';
    } else {
        // Jika tidak ada jadwal di hari yang sama, lanjutkan untuk memasukkan jadwal baru
        $query = "INSERT INTO jadwal_periksa (id_dokter, hari, jam_mulai, jam_selesai, aktif) 
                  VALUES ('$idDokter', '$hari', '$jamMulai', '$jamSelesai', '2')";

        if (mysqli_query($mysqli, $query)) {
            echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>';
            echo '<script>
                    document.addEventListener("DOMContentLoaded", function() {
                        Swal.fire({
                            icon: "success",
                            title: "Berhasil!",
                            text: "Jadwal berhasil ditambahkan!",
                            confirmButtonText: "OK"
                        }).then(function() {
                            window.location.href = "../../jadwal_periksa.php";
                        });
                    });
                  </script>';
            exit();
        } else {
            echo "Error: " . $query . "<br>" . mysqli_error($mysqli);
        }
    }
}

mysqli_close($mysqli);
?>
