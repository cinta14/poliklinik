<?php
session_start();
require 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $nama = $_POST['nama'];
    $password = md5($_POST['password']);

    // Cek apakah nama dan password cocok di database
    $query = "SELECT * FROM pasien WHERE nama = '$nama' && password = '$password'";
    $result = mysqli_query($mysqli, $query);

    if (mysqli_num_rows($result) > 0) { //Jika lebih dari 0, artinya ada pengguna yang cocok dengan nama dan password yang dimasukkan
        $data = mysqli_fetch_assoc($result); //Mengambil data pengguna yang ditemukan dari hasil query dan menyimpannya dalam bentuk array asosiatif.

        // Jika login berhasil, simpan data pengguna ke sesi
        $_SESSION['id'] = $data['id'];
        $_SESSION['nama'] = $data['nama'];
        $_SESSION['password'] = $data['password'];
        $_SESSION['no_rm'] = $data['no_rm'];
        $_SESSION['akses'] = "pasien";

        header("location:dashboard_pasien.php");
    } else {
        // Jika tidak ada data yang cocok, kirimkan alert SweetAlert2
        echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>';
        echo '<script>
                document.addEventListener("DOMContentLoaded", function() {
                    Swal.fire({
                        icon: "error",
                        title: "Login Gagal",
                        text: "nama atau password salah!",
                        confirmButtonText: "OK"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = "login_pasien.php";
                        }
                    });
                });
              </script>';
    }
}
?>