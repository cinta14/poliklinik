<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Daftar Poli</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Daftar Poli</li>
                </ol>
            </div>
        </div>
    </div>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-4">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Daftar Poli</h3>
                </div>
                <div class="card-body">
                    <form action="page/daftar_poli/daftar_poli.php" method="post">
                        <div class="form-group mb-3">
                            <label for="no_rm font-weight-bold">No Rekam Medis</label>
                            <input type="text" class="form-control" name="no_rm"
                                value="<?php echo $_SESSION['no_rm'] ?>" readonly required>
                            <!--no_rm yang diisi secara otomatis menggunakan $_SESSION['no_rm']-->
                        </div>
                        <div class="form-group">
                            <label for="poli">Pilih Poli</label>
                            <select class="form-control" id="poli" name="poli" required>
                                <option value="" disabled selected>Pilih Poli</option>
                                <?php
                                require 'koneksi.php';
                                $query = "SELECT * FROM poli";
                                $result = mysqli_query($mysqli, $query);
                                while ($dataPoli = mysqli_fetch_assoc($result)) {
                                    ?>
                                    <option value="<?php echo $dataPoli['id'] ?>">
                                        <?php echo $dataPoli['nama_poli'] ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group mb-3">
                            <label for="no_rm font-weight-bold">Pilih Jadwal</label>
                            <select class="form-control" id="jadwal" name="jadwal" required></select>
                        </div>
                        <div class="form-group mb-3">
                            <label for="keluhan">Keluhan</label>
                            <textarea class="form-control" rows="3" id="keluhan" name="keluhan" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-block btn-primary">
                            Daftar
                        </button>
                    </form>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>

        <!--menampilkan riwayat daftar poli-->
        <div class="col-md-8">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Riwayat Daftar Poli</h3>
                </div>
                <div class="card-body table-responsive p-0">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Poli</th>
                                <th>Dokter</th>
                                <th>Hari</th>
                                <th>Mulai</th>
                                <th>Selesai</th>
                                <th>Antrian</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>

                            
                            <?php
                            require 'koneksi.php';
                            $no = 1;
                            // $query = "SELECT ..."; untuk menampilkan data pendaftaran poli, dokter, jadwal periksa, dan nomor antrian pasien tertentu.di bawah
                            $query = "SELECT daftar_poli.id as idDaftarPoli, poli.nama_poli, dokter.nama, jadwal_periksa.hari, jadwal_periksa.jam_mulai, jadwal_periksa.jam_selesai, daftar_poli.no_antrian FROM daftar_poli INNER JOIN jadwal_periksa ON daftar_poli.id_jadwal = jadwal_periksa.id INNER JOIN dokter ON jadwal_periksa.id_dokter = dokter.id INNER JOIN poli ON dokter.id_poli = poli.id WHERE daftar_poli.id_pasien = '$idPasien'";
                            $result = mysqli_query($mysqli, $query); //Menjalankan query SQL yang telah didefinisikan sebelumnya dan menyimpan hasilnya dalam variabel $result

                            while ($data = mysqli_fetch_assoc($result)) { //Mengambil satu baris data dari hasil query dalam bentuk array asosiatif (menggunakan nama kolom sebagai indeks array).
                                # code...  
                                ?>
                                <!--Menampilkan Data dalam Tabel-->
                                <tr>
                                    <td><?php echo $no++ ?></td>
                                    <td><?php echo $data['nama_poli'] ?></td>
                                    <td><?php echo $data['nama'] ?></td>
                                    <td><?php echo $data['hari'] ?></td>
                                    <td><?php echo $data['jam_mulai'] ?></td>
                                    <td><?php echo $data['jam_selesai'] ?></td>
                                    <td><?php echo $data['no_antrian'] ?></td>
                                    <td>
                                        <a href="detail_daftar_poli.php?id=<?php echo $data['idDaftarPoli'] ?>"
                                            class='btn btn-sm btn-success edit-btn'>Detail</a>
                                    </td>
                                </tr>
                            <?php } ?>

                        </tbody>
                    </table>
                </div>
            </div>
            <!-- /.card -->
        </div>
    </div>
</section>