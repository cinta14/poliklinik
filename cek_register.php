<?php
require 'koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil tahun dan bulan saat ini
    $tahun = date('Y');   // Tahun penuh (4 digit)
    $bulan = date('m');   // Bulan (2 digit)

    // Ambil data dari form register
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $no_ktp = $_POST['no_ktp'];
    $no_hp = $_POST['no_hp'];
    $password = md5($_POST['password']); // Hash password (gunakan hash lebih aman seperti password_hash)
    //$password = password_hash($_POST['password'], PASSWORD_DEFAULT);  Menggunakan password_hash() untuk keamanan

    // Validasi input tidak kosong
    if (empty($nama) || empty($alamat) || empty($no_ktp) || empty($no_hp) || empty($password)) {
        echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>';
        echo '<script>
                document.addEventListener("DOMContentLoaded", function() {
                    Swal.fire({
                        icon: "error",
                        title: "Gagal",
                        text: "Isi semua kolom input!",
                        confirmButtonText: "OK",
                        didClose: () => {
                            window.location.href = "register.php";
                        }
                    });
                });
              </script>';
        exit();
    }

    // Cek apakah no_ktp sudah ada
    $cekNoKTP = "SELECT * FROM pasien WHERE no_ktp = '$no_ktp'";
    $queryCekKTP = mysqli_query($mysqli, $cekNoKTP);
    if (mysqli_num_rows($queryCekKTP) > 0) {
        echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>';
        echo '<script>
                document.addEventListener("DOMContentLoaded", function() {
                    Swal.fire({
                        icon: "error",
                        title: "Gagal",
                        text: "No KTP telah terdaftar sebelumnya",
                        confirmButtonText: "OK",
                        didClose: () => {
                            window.location.href = "register.php";
                        }
                    });
                });
              </script>';
        exit();
    }

    // membuat nomor rekam medis dengan format yyyymm-xxx
    $prefix = sprintf('%s%s', $tahun, $bulan); // Format prefix yyyymm
    $getLastData = "SELECT no_rm FROM pasien WHERE no_rm LIKE '$prefix-%' ORDER BY no_rm DESC LIMIT 1";
    $queryGetLast = mysqli_query($mysqli, $getLastData);

    if (mysqli_num_rows($queryGetLast) > 0) {
        $lastData = mysqli_fetch_assoc($queryGetLast);
        $substring = substr($lastData['no_rm'], 7); // Ambil 3 digit terakhir setelah "yyyymm-"
        $urutanTerakhir = (int) $substring + 1; // Increment nomor urut
    } else {
        $urutanTerakhir = 1; // Jika tidak ada data, mulai dari 1
    }

    // Format nomor RM menjadi 3 digit
    $no_rm = sprintf('%s-%03d', $prefix, $urutanTerakhir);

    // Insert/menyimpan data pasien ke database
    $insertData = "INSERT INTO pasien (nama, password, alamat, no_ktp, no_hp, no_rm) VALUES ('$nama', '$password', '$alamat', '$no_ktp', '$no_hp', '$no_rm')";
    $queryInsert = mysqli_query($mysqli, $insertData);

    if ($queryInsert) {
        echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>';
        echo '<script>
                document.addEventListener("DOMContentLoaded", function() {
                    Swal.fire({
                        icon: "success",
                        title: "Berhasil",
                        text: "Pendaftaran akun berhasil",
                        confirmButtonText: "OK",
                        didClose: () => {
                            window.location.href = "login_pasien.php";
                        }
                    });
                });
              </script>';
    } else {
        echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>';
        echo '<script>
                document.addEventListener("DOMContentLoaded", function() {
                    Swal.fire({
                        icon: "error",
                        title: "Gagal",
                        text: "Pendaftaran akun gagal: ' . mysqli_error($mysqli) . '",
                        confirmButtonText: "OK",
                        didClose: () => {
                            window.location.href = "registerPasien.php";
                        }
                    });
                });
              </script>';
    }
}

// Tutup koneksi
mysqli_close($mysqli);
?>