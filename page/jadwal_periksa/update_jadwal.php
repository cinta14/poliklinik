<?php
// Koneksi ke database
require '../../koneksi.php';

// Proses update jadwal periksa
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['id']) && isset($_POST['hari']) && isset($_POST['jamMulai']) && isset($_POST['jamSelesai']) && isset($_POST['aktif'])) {
    // Ambil data dari form
    $id = $_POST['id'];
    $hari = $_POST['hari'];
    $jamMulai = $_POST['jamMulai'];
    $jamSelesai = $_POST['jamSelesai'];
    $aktif = $_POST['aktif'];

    // Validasi input
    if (empty($hari) || empty($jamMulai) || empty($jamSelesai) || empty($aktif)) {
        echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>';
        echo '<script>
                document.addEventListener("DOMContentLoaded", function () {
                    Swal.fire({
                        icon: "error",
                        title: "Error",
                        text: "Semua kolom harus diisi!",
                        confirmButtonText: "OK"
                    }).then(function() {
                        window.location.href = "../../jadwal_periksa.php";
                    });
                });
              </script>';
    } else {
        // Pastikan data yang dimasukkan aman
        $hari = mysqli_real_escape_string($mysqli, $hari);
        $jamMulai = mysqli_real_escape_string($mysqli, $jamMulai);
        $jamSelesai = mysqli_real_escape_string($mysqli, $jamSelesai);
        $aktif = mysqli_real_escape_string($mysqli, $aktif);

        // Cek apakah jadwal akan diaktifkan
        if ($aktif == '1') {
            // Nonaktifkan jadwal lain milik dokter yang sama
            $getDokterQuery = "SELECT id_dokter FROM jadwal_periksa WHERE id = ?";
            $stmtGetDokter = mysqli_prepare($mysqli, $getDokterQuery);
            mysqli_stmt_bind_param($stmtGetDokter, 'i', $id);
            mysqli_stmt_execute($stmtGetDokter);
            mysqli_stmt_bind_result($stmtGetDokter, $idDokter);
            mysqli_stmt_fetch($stmtGetDokter);
            mysqli_stmt_close($stmtGetDokter);

            $nonaktifQuery = "UPDATE jadwal_periksa SET aktif = 2 WHERE id_dokter = ? AND id != ?";
            $stmtNonaktif = mysqli_prepare($mysqli, $nonaktifQuery);
            mysqli_stmt_bind_param($stmtNonaktif, 'ii', $idDokter, $id);
            mysqli_stmt_execute($stmtNonaktif);
            mysqli_stmt_close($stmtNonaktif);
        }

        // Update status aktif untuk jadwal yang terpilih
        $query = "UPDATE jadwal_periksa SET 
                  hari = ?, 
                  jam_mulai = ?, 
                  jam_selesai = ?, 
                  aktif = ? 
                  WHERE id = ?";

        // Persiapkan query
        $stmt = mysqli_prepare($mysqli, $query);

        if ($stmt === false) {
            echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>';
            echo '<script>
                    document.addEventListener("DOMContentLoaded", function () {
                        Swal.fire({
                            icon: "error",
                            title: "Error",
                            text: "Terjadi kesalahan saat mempersiapkan query!",
                            confirmButtonText: "OK"
                        }).then(function() {
                            window.location.href = "../../jadwal_periksa.php";
                        });
                    });
                  </script>';
            exit;
        }

        // Bind parameter
        mysqli_stmt_bind_param($stmt, 'ssssi', $hari, $jamMulai, $jamSelesai, $aktif, $id);

        // Eksekusi query
        if (mysqli_stmt_execute($stmt)) {
            // Jika berhasil update, tampilkan SweetAlert sukses
            echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>';
            echo '<script>
                    document.addEventListener("DOMContentLoaded", function () {
                        Swal.fire({
                            icon: "success",
                            title: "Berhasil!",
                            text: "Jadwal berhasil diubah!",
                            confirmButtonText: "OK"
                        }).then(function() {
                            window.location.href = "../../jadwal_periksa.php";
                        });
                    });
                  </script>';
            exit;
        } else {
            // Jika gagal, tampilkan SweetAlert error
            echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>';
            echo '<script>
                    document.addEventListener("DOMContentLoaded", function () {
                        Swal.fire({
                            icon: "error",
                            title: "Error",
                            text: "Gagal mengupdate jadwal.",
                            confirmButtonText: "OK"
                        }).then(function() {
                            window.location.href = "../../jadwal_periksa.php";
                        });
                    });
                  </script>';
        }

        // Tutup statement
        mysqli_stmt_close($stmt);
    }
}
?>
