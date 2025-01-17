<?php
// Menghubungkan ke database
include '../../koneksi.php'; // Sesuaikan dengan jalur yang benar

// Memeriksa jika request menggunakan metode POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data dari form
    $nama_poli = $_POST["nama_poli"];
    $keterangan = $_POST["keterangan"];

    // Validasi data input
    if (empty($nama_poli) || empty($keterangan)) {
        echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>'; // pastikan script SweetAlert2 di-load terlebih dahulu
        echo '<script>';
        echo 'window.onload = function() {';
        echo '  Swal.fire({';
        echo '    icon: "error",';
        echo '    title: "Error!",';
        echo '    text: "Nama Poli dan Keterangan harus diisi!"';
        echo '  }).then(function() {';
        echo '    window.location.href = "../../poli.php";';
        echo '  });';
        echo '};';
        echo '</script>';
        exit();
    }

    // Cek apakah poli sudah ada
    $check = "SELECT * FROM poli WHERE nama_poli = ?";
    $stmt = $mysqli->prepare($check);
    $stmt->bind_param("s", $nama_poli);
    $stmt->execute();
    $result = $stmt->get_result();

    // Jika poli sudah ada
    if (mysqli_num_rows($result) > 0) {
        echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>'; // pastikan script SweetAlert2 di-load terlebih dahulu
        echo '<script>';
        echo 'window.onload = function() {';
        echo '  Swal.fire({';
        echo '    icon: "error",';
        echo '    title: "Poli sudah ada!",';
        echo '    text: "Nama Poli ini sudah terdaftar!"';
        echo '  }).then(function() {';
        echo '    window.location.href = "../../poli.php";';
        echo '  });';
        echo '};';
        echo '</script>';
    } else {
        // Query untuk menambahkan data poli
        $query = "INSERT INTO poli (nama_poli, keterangan) VALUES (?, ?)";
        $stmt = $mysqli->prepare($query);
        $stmt->bind_param("ss", $nama_poli, $keterangan);

        // Eksekusi query dan tangani hasilnya
        if ($stmt->execute()) {
            echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>'; // pastikan script SweetAlert2 di-load terlebih dahulu
            echo '<script>';
            echo 'window.onload = function() {';
            echo '  Swal.fire({';
            echo '    icon: "success",';
            echo '    title: "Sukses!",';
            echo '    text: "Data Poli berhasil ditambahkan!"';
            echo '  }).then(function() {';
            echo '    window.location.href = "../../poli.php";'; // Redirect setelah alert ditutup
            echo '  });';
            echo '};';
            echo '</script>';
        } else {
            // Jika terjadi kesalahan, tampilkan error
            echo "Error: " . $stmt->error;
        }
        $stmt->close();
    }
}

// Tutup koneksi
mysqli_close($mysqli);
?>