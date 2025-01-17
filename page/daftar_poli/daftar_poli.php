<?php
require '../../koneksi.php';

// Ambil data poli untuk dropdown
$queryPoli = "SELECT id, nama_poli FROM poli";
$resultPoli = mysqli_query($mysqli, $queryPoli);

//proses formulir pendaftaran
if ($_SERVER["REQUEST_METHOD"] == "POST") { //Mengambil data yang dikirimkan dari formulir
    $no_rm = $_POST['no_rm'];
    $idJadwal = $_POST['jadwal'];
    $keluhan = $_POST['keluhan'];
    $noAntrian = 0; //diinisialisasi dengan 0 

    //Mencari Pasien Berdasarkan Nomor Rekam Medis (no_rm)
    $cariPasien = "SELECT * FROM pasien WHERE no_rm = '$no_rm'";
    $query = mysqli_query($mysqli, $cariPasien);
    $data = mysqli_fetch_assoc($query);
    $idPasien = $data['id'];

// Pengecekan Data Pendaftaran Poli (untuk nomor antrian)
$cekData = "SELECT * FROM daftar_poli";
$queryCekData = mysqli_query($mysqli, $cekData);
if (mysqli_num_rows($queryCekData) > 0) {
    $cekNoAntrian = "SELECT * FROM daftar_poli WHERE id_jadwal = '$idJadwal' ORDER BY no_antrian DESC LIMIT 1";
    $queryNoAntrian = mysqli_query($mysqli, $cekNoAntrian);

    // Periksa apakah query menghasilkan data
    if ($dataPoli = mysqli_fetch_assoc($queryNoAntrian)) {
        // Jika ada data, ambil no_antrian terakhir
        $antrianTerakhir = (int) $dataPoli['no_antrian'];
        $antrianBaru = $antrianTerakhir + 1; // Mengambil nomor antrian terakhir dan menambahkannya satu
    } else {
        // Jika tidak ada data, nomor antrian dimulai dari 1
        $antrianBaru = 1;
    }

    $daftarPoli = "INSERT INTO daftar_poli (id_pasien, id_jadwal, keluhan, no_antrian, status_periksa) 
                   VALUES ('$idPasien', '$idJadwal', '$keluhan', '$antrianBaru', '0')";
    $queryDaftarPoli = mysqli_query($mysqli, $daftarPoli);
    if ($queryDaftarPoli) {
        echo '<script>
                document.addEventListener("DOMContentLoaded", function() {
                    Swal.fire({
                        icon: "success",
                        title: "Berhasil",
                        text: "Berhasil mendaftar poli!",
                        didClose: () => {
                            window.location.href = "../../daftar_poliklinik.php"; // Redirect setelah alert ditutup
                        }
                    });
                });
            </script>';
    } else {
        echo '<script>
                document.addEventListener("DOMContentLoaded", function() {
                    Swal.fire({
                        icon: "error",
                        title: "Gagal",
                        text: "Gagal mendaftar poli."
                    });
                });
            </script>';
    }
} else {
    // Jika tidak ada data dalam tabel daftar_poli, maka nomor antrian akan dimulai dari 1
    $antrianBaru = 1;
    $daftarPoli = "INSERT INTO daftar_poli (id_pasien, id_jadwal, keluhan, no_antrian, status_periksa) 
                   VALUES ('$idPasien', '$idJadwal', '$keluhan', '$antrianBaru', '0')";
    $queryDaftarPoli = mysqli_query($mysqli, $daftarPoli);
    if ($queryDaftarPoli) {
        echo '<script>
                document.addEventListener("DOMContentLoaded", function() {
                    Swal.fire({
                        icon: "success",
                        title: "Berhasil",
                        text: "Berhasil mendaftar poli!",
                        didClose: () => {
                            window.location.href = "../../daftar_poliklinik.php"; // Redirect setelah alert ditutup
                        }
                    });
                });
            </script>';
    } else {
        echo '<script>
                document.addEventListener("DOMContentLoaded", function() {
                    Swal.fire({
                        icon: "error",
                        title: "Gagal",
                        text: "Gagal mendaftar poli."
                    });
                });
            </script>';
    }
}

}
?>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Poli</title>
    <link rel="stylesheet" href="../../app/css/style.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>
    <div class="form">
        <h1>Form Pendaftaran Poli</h1>
        <form action="daftar_poli.php" method="POST">
            <div class="form-group">
                <label for="no_rm">Nomor Rekam Medis</label>
                <input type="text" name="no_rm" id="no_rm" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="poli">Poli</label>
                <select name="poli" id="poli" class="form-control" required>
                    <option value="" disabled selected>Pilih Poli</option>
                    <?php
                    while ($poli = mysqli_fetch_assoc($resultPoli)) { //// Loop ini mengambil data baris per baris dari query
                        // Mengambil data ID poli dan nama poli dari database
                        echo '<option value="' . $poli['id'] . '">' . $poli['nama_poli'] . '</option>';
                         // Menghasilkan elemen <option> untuk dropdown, dengan value ID poli dan teks nama poli
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="jadwal">Jadwal Periksa</label>
                <select name="jadwal" id="jadwal" class="form-control" required>
                    <option value="" disabled selected>Pilih Jadwal</option>
                </select>
            </div>
            <div class="form-group">
                <label for="keluhan">Keluhan</label>
                <textarea name="keluhan" id="keluhan" class="form-control" rows="3" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Daftar</button>
        </form>
    </div>
    <script>
        //JavaScript (AJAX) untuk Memuat Jadwal Berdasarkan Poli yang Dipilih
        $(document).ready(function () {
            $('#poli').change(function () {
                var poliId = $(this).val();
                if (poliId) {
                    $.ajax({
                        url: 'jadwal_dokter_poli.php',
                        method: 'POST',
                        data: { poliId: poliId },
                        success: function (data) {
                            $('#jadwal').html(data);
                        }
                    });
                } else {
                    $('#jadwal').html('<option value="" disabled selected>Pilih Jadwal</option>');
                }
            });
        });

    </script>
</body>

</html>