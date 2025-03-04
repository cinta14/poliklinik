<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <!-- Baris untuk Judul dan Breadcrumb -->
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Mengelola Obat</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="index.php?page=home">Home</a></li>
                    <li class="breadcrumb-item active">Obat</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->

        <!-- Baris untuk tombol "Tambah" di bawah Judul -->
        <div class="row mb-2">
            <div class="col-12">
                <button type="button" class="btn btn-sm btn-success float-left" data-toggle="modal"
                    data-target="#addModal">
                    Tambah Obat
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
                        <h3 class="card-title">Obat</h3>

                        <div class="card-tools">

                            <!-- Modal Tambah Data Obat -->
                            <div class="modal fade" id="addModal" tabindex="-1" role="dialog"
                                aria-labelledby="addModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="addModalLabel">Tambah Obat</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <!-- Form tambah data obat disini -->
                                            <form action="page/obat/tambah_obat.php" method="post">
                                                <div class="form-group">
                                                    <label for="nama_obat">Nama Obat</label>
                                                    <input type="text" class="form-control" id="nama_obat"
                                                        name="nama_obat" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="kemasan">Kemasan</label>
                                                    <input type="text" class="form-control" id="kemasan" name="kemasan"
                                                        required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="harga">Harga</label>
                                                    <input type="text" class="form-control" id="harga" name="harga"
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
                                    <th>Nama Obat</th>
                                    <th>Kemasan</th>
                                    <th>Harga</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>

                                <!-- TAMPILKAN DATA OBAT DI SINI -->
                                <?php
                                require 'koneksi.php';
                                $no = 1;
                                $query = "SELECT * FROM obat";
                                $result = mysqli_query($mysqli, $query);

                                while ($data = mysqli_fetch_assoc($result)) {
                                    # code...  
                                    ?>
                                    <tr>
                                        <td><?php echo $no++ ?></td>
                                        <td><?php echo $data['nama_obat'] ?></td>
                                        <td><?php echo $data['kemasan'] ?></td>
                                        <td>Rp. <?php echo number_format($data['harga'], 0, ',', '.') ?></td>
                                        <td>
                                            <button type='button' class='btn btn-sm btn-primary edit-btn'
                                                data-toggle="modal"
                                                data-target="#editModal<?php echo $data['id'] ?>">Edit</button>
                                            <button type='button' class='btn btn-sm btn-danger edit-btn' data-toggle="modal"
                                                data-target="#hapusModal<?php echo $data['id'] ?>">Hapus</button>
                                        </td>
                                        <!-- Modal Edit Data Obat -->
                                        <div class="modal fade" id="editModal<?php echo $data['id'] ?>" tabindex="-1"
                                            role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="addModalLabel">Edit Obat</h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <!-- Form edit data obat disini -->
                                                        <form action="page/obat/update_obat.php" method="post">
                                                            <input type="hidden" class="form-control" id="id" name="id"
                                                                value="<?php echo $data['id'] ?>" required>
                                                            <div class="form-group">
                                                                <label for="nama_obat">Nama Obat</label>
                                                                <input type="text" class="form-control" id="nama_obat"
                                                                    name="nama_obat"
                                                                    value="<?php echo $data['nama_obat'] ?>" required>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="kemasan">Kemasan</label>
                                                                <input type="text" class="form-control" id="kemasan"
                                                                    name="kemasan" value="<?php echo $data['kemasan'] ?>"
                                                                    required>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="harga">Harga</label>
                                                                <input type="text" class="form-control" id="harga"
                                                                    name="harga" value="<?php echo $data['harga'] ?>"
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
                                                        <h5 class="modal-title" id="addModalLabel">Hapus Obat</h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <!-- Form edit data obat disini -->
                                                        <form action="page/obat/hapus_obat.php" method="post">
                                                            <input type="hidden" class="form-control" id="id" name="id"
                                                                value="<?php echo $data['id'] ?>" required>
                                                            <p>Apakah anda yakin ingin menghapus obat ini?
                                                            </p>
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
</div>