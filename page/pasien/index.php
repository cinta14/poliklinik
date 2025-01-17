<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <!-- Baris untuk Judul dan Breadcrumb -->
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Mengelola Pasien</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="index.php?page=home">Home</a></li>
                    <li class="breadcrumb-item active">Pasien</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->

        <!-- Baris untuk tombol "Tambah" di bawah Judul -->
        <div class="row mb-2">
            <div class="col-12">
                <button type="button" class="btn btn-sm btn-success float-left" data-toggle="modal"
                    data-target="#addModal">
                    Tambah Pasien
                </button>
            </div><!-- /.col -->
        </div><!-- /.row -->

    </div><!-- /.container-fluid -->
</div><!-- /.content-header -->

<!-- /.content-header -->
<!-- Main content -->
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Pasien</h3>

                        <div class="card-tools">

                            <!-- Modal Tambah Data Pasien -->
                            <div class="modal fade" id="addModal" tabindex="-1" role="dialog"
                                aria-labelledby="addModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="addModalLabel">Tambah Pasien</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <!-- Form tambah data pasien disini -->
                                            <form action="page/pasien/tambah_pasien.php" method="post">
                                                <div class="form-group">
                                                    <label for="nama">Nama Pasien</label>
                                                    <input type="text" class="form-control" id="nama" name="nama"
                                                        required>
                                                </div>
                                                <div class="form-group mb-3">
                                                    <label for="alamat">Alamat</label>
                                                    <textarea class="form-control" rows="3" id="alamat" name="alamat"
                                                        placeholder="Alamat" required></textarea>
                                                </div>
                                                <div class="form-group">
                                                    <label for="no_ktp">No KTP</label>
                                                    <input type="text" class="form-control" id="no_ktp" name="no_ktp"
                                                        required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="no_hp">No HP</label>
                                                    <input type="text" class="form-control" id="no_hp" name="no_hp"
                                                        required>
                                                </div>
                                                <button type="submit" class="btn btn-success">Tambah</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive p-0">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Pasien</th>
                                    <th>Alamat</th>
                                    <th>No KTP</th>
                                    <th>No Hp</th>
                                    <th>No RM</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- TAMPILKAN DATA OBAT DI SINI -->
                                <?php
                                require 'koneksi.php';
                                $no = 1;
                                $query = "SELECT * FROM pasien";
                                $result = mysqli_query($mysqli, $query);

                                while ($data = mysqli_fetch_assoc($result)) {
                                    # code...  
                                    ?>
                                    <tr>
                                        <td><?php echo $no++ ?></td>
                                        <td><?php echo $data['nama'] ?></td>
                                        <td><?php echo $data['alamat'] ?></td>
                                        <td><?php echo $data['no_ktp'] ?></td>
                                        <td><?php echo $data['no_hp'] ?></td>
                                        <td><?php echo $data['no_rm'] ?></td>
                                        <td>
                                            <button type='button' class='btn btn-sm btn-primary edit-btn'
                                                data-toggle="modal"
                                                data-target="#editModal<?php echo $data['id'] ?>">Edit</button>
                                            <button type='button' class='btn btn-sm btn-danger edit-btn' data-toggle="modal"
                                                data-target="#hapusModal<?php echo $data['id'] ?>">Hapus</button>
                                        </td>
                                        <!-- Modal Edit Data Pasien -->
                                        <div class="modal fade" id="editModal<?php echo $data['id'] ?>" tabindex="-1"
                                            role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="addModalLabel">Edit Pasien</h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <!-- Form edit data pasien disini -->
                                                        <form action="page/pasien/update_pasien.php" method="post">
                                                            <input type="hidden" class="form-control" id="id" name="id"
                                                                value="<?php echo $data['id'] ?>" required>
                                                            <div class="form-group">
                                                                <label for="nama">Nama Pasien</label>
                                                                <input type="text" class="form-control" id="nama"
                                                                    name="nama" value="<?php echo $data['nama'] ?>"
                                                                    required>
                                                            </div>
                                                            <div class="form-group mb-3">
                                                                <label for="alamat">Alamat</label>
                                                                <textarea class="form-control" rows="3" id="alamat"
                                                                    name="alamat" placeholder="Alamat"
                                                                    required><?php echo $data['alamat'] ?></textarea>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="no_ktp">No KTP</label>
                                                                <input type="text" class="form-control" id="no_ktp"
                                                                    name="no_ktp" value="<?php echo $data['no_ktp'] ?>"
                                                                    required>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="no_hp">No HP</label>
                                                                <input type="text" class="form-control" id="no_hp"
                                                                    name="no_hp" value="<?php echo $data['no_hp'] ?>"
                                                                    required>
                                                            </div>
                                                            <button type="submit" class="btn btn-primary">Simpan</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Modal Hapus Data Obat -->
                                        <div class="modal fade" id="hapusModal<?php echo $data['id'] ?>" tabindex="-1"
                                            role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="addModalLabel">Hapus Pasien</h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <!-- Form hapus data obat disini -->
                                                        <form action="page/pasien/hapus_pasien.php" method="post">
                                                            <input type="hidden" class="form-control" id="id" name="id"
                                                                value="<?php echo $data['id'] ?>" required>
                                                            <p>Anda yakin menghapus data pasien ini? </p>
                                                            <button type="submit" class="btn btn-danger">Hapus</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>