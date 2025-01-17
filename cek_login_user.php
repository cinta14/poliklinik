<?php
session_start();
require 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    //ambil data yang dimasukkan pengguna pd form login
    $nama = $_POST['nama'];
    $password = md5($_POST['password']);

    // Cek login untuk admin
    if ($nama == "admin" && $password == md5("admin")) {
        $_SESSION['nama'] = $nama;
        $_SESSION['password'] = $password;
        $_SESSION['akses'] = "admin";

        header("location:dashboard_admin.php");
    } else {
        // Cek login untuk dokter
        $query = "SELECT * FROM dokter WHERE nama = '$nama' && password = '$password'";
        $result = mysqli_query($mysqli, $query);

        if (mysqli_num_rows($result) > 0) { //jika lebih dr 0 yg berarti pass dan nama cocok 
            $data = mysqli_fetch_assoc($result); //mengambil hasil query dalam bentuk array asosiatif (key-value) untuk setiap baris yang ditemukan.
            //dpt data dokter, disimpan dalam session menggunakan superglobal $_SESSION
            $_SESSION['id'] = $data['id'];
            $_SESSION['nama'] = $data['nama'];
            $_SESSION['password'] = $data['password'];
            $_SESSION['id_poli'] = $data['id_poli'];
            $_SESSION['akses'] = "dokter";

            header("location:dashboard_dokter.php");
        } else {
            // Menampilkan SweetAlert jika login gagal
            echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>';
            echo '<script>
                    document.addEventListener("DOMContentLoaded", function() {
                        Swal.fire({
                            icon: "error",
                            title: "Login Gagal",
                            text: "nama atau password salah!",
                            confirmButtonText: "OK",
                            didClose: () => {
                                window.location.href = "login_user.php";
                            }
                        });
                    });
                  </script>';
        }
    }
}
?>