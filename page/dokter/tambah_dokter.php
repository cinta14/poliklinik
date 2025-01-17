<?php
require '../../koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data dari form
    $nama = $_POST["nama"];
    $alamat = $_POST["alamat"];
    $no_hp = $_POST["no_hp"];
    $password = $_POST["password"];
    $poli = $_POST["poli"];
    $hashed_password = md5($password); // Hash password (gunakan hash lebih aman seperti password_hash)

    // Validasi input tidak kosong
    if (empty($nama) || empty($alamat) || empty($no_hp) || empty($password) || empty($poli)) {
        echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>';
        echo '<script>
                document.addEventListener("DOMContentLoaded", function() {
                    Swal.fire({
                        icon: "error",
                        title: "Gagal",
                        text: "Semua kolom harus diisi!",
                        confirmButtonText: "OK",
                        didClose: () => {
                            window.location.href = "../../dokter.php";
                        }
                    });
                });
              </script>';
        exit();
    }

    // Query untuk menambahkan data dokter
    $query = "INSERT INTO dokter (nama, alamat, no_hp, password, id_poli) VALUES (?, ?, ?, ?, ?)";

    // Persiapkan query menggunakan prepared statement untuk menghindari SQL injection
    if ($stmt = $mysqli->prepare($query)) {
        // Bind parameter ke prepared statement
        $stmt->bind_param("ssssi", $nama, $alamat, $no_hp, $hashed_password, $poli);

        // Eksekusi query
        if ($stmt->execute()) {
            echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>';
            echo '<script>
                    document.addEventListener("DOMContentLoaded", function() {
                        Swal.fire({
                            icon: "success",
                            title: "Sukses",
                            text: "Data dokter berhasil ditambahkan!",
                            confirmButtonText: "OK",
                            didClose: () => {
                                window.location.href = "../../dokter.php";
                            }
                        });
                    });
                  </script>';
            exit();
        } else {
            // Jika query gagal, tampilkan pesan error
            echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>';
            echo '<script>
                    document.addEventListener("DOMContentLoaded", function() {
                        Swal.fire({
                            icon: "error",
                            title: "Gagal",
                            text: "Terjadi kesalahan saat menambahkan data dokter. Coba lagi.",
                            confirmButtonText: "OK",
                            didClose: () => {
                                window.location.href = "../../dokter.php";
                            }
                        });
                    });
                  </script>';
        }

        // Tutup statement
        $stmt->close();
    } else {
        // Jika query gagal dipersiapkan, tampilkan pesan error
        echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>';
        echo '<script>
                document.addEventListener("DOMContentLoaded", function() {
                    Swal.fire({
                        icon: "error",
                        title: "Gagal",
                        text: "Kesalahan saat mempersiapkan query.",
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