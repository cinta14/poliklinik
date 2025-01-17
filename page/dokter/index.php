<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Mengelola Dokter</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="index.php?page=home">Home</a></li>
                    <li class="breadcrumb-item active">Dokter</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->

        <!-- Tombol Tambah Dokter di bawah judul -->
        <div class="row mb-3">
            <div class="col-12">
                <button type="button" class="btn btn-sm btn-success" data-toggle="modal" data-target="#addModal">
                    Tambah Dokter
                </button>

            </div><!-- /.col -->
        </div><!-- /.row -->
    </div>

    <!-- /.content-header -->
    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Dokter</h3>

                            <div class="card-tools">

                                <!-- Modal Tambah Data dokter -->
                                <div class="modal fade" id="addModal" tabindex="-1" role="dialog"
                                    aria-labelledby="addModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="addModalLabel">Tambah Dokter</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <!-- Form tambah data dokter disini -->
                                                <form action="page/dokter/tambah_dokter.php" method="post">
                                                    <div class="form-group">
                                                        <label for="nama_dokter">Nama Dokter</label>
                                                        <input type="text" class="form-control" id="nama_dokter"
                                                            name="nama" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="alamat">Alamat</label>
                                                        <textarea class="form-control" rows="3" placeholder="Enter ..."
                                                            id="alamat" name="alamat"></textarea>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="no_hp">Nomor HP</label>
                                                        <input type="text" class="form-control" id="no_hp" name="no_hp"
                                                            required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="password">Password</label>
                                                        <input type="text" class="form-control" id="password"
                                                            name="password" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="poli">Poli</label>
                                                        <select class="form-control" id="poli" name="poli">
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
                                        <th>Nama Dokter</th>
                                        <th>Alamat</th>
                                        <th>No HP</th>
                                        <th>Poli</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <!-- TAMPILKAN DATA dokter DI SINI -->
                                    <?php
                                    require 'koneksi.php';
                                    $no = 1;
                                    $query = "SELECT dokter.id, dokter.nama, dokter.alamat, dokter.no_hp, poli.nama_poli FROM dokter INNER JOIN poli ON dokter.id_poli = poli.id";
                                    $result = mysqli_query($mysqli, $query);

                                    while ($data = mysqli_fetch_assoc($result)) {
                                        # code...  
                                        ?>
                                        <tr>
                                            <td><?php echo $no++ ?></td>
                                            <td><?php echo $data['nama'] ?></td>
                                            <td style="white-space: pre-line;"><?php echo $data['alamat'] ?></td>
                                            <td><?php echo $data['no_hp'] ?></td>
                                            <td><?php echo $data['nama_poli'] ?></td>
                                            <td>
                                                <button type='button' class='btn btn-sm btn-primary edit-btn'
                                                    data-toggle="modal"
                                                    data-target="#editModal<?php echo $data['id'] ?>">Edit</button>
                                                <button type='button' class='btn btn-sm btn-danger edit-btn'
                                                    data-toggle="modal"
                                                    data-target="#hapusModal<?php echo $data['id'] ?>">Hapus</button>
                                            </td>
                                            <!-- Modal Edit Data poli -->
                                            <div class="modal fade" id="editModal<?php echo $data['id'] ?>" tabindex="-1"
                                                role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="addModalLabel">Edit Dokter</h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <!-- Form edit data poli disini -->
                                                            <form action="page/dokter/update_dokter.php" method="post">
                                                                <input type="hidden" class="form-control" id="id" name="id"
                                                                    value="<?php echo $data['id'] ?>" required>
                                                                <div class="form-group">
                                                                    <label for="nama">Nama dokter</label>
                                                                    <input type="text" class="form-control" id="nama"
                                                                        name="nama" value="<?php echo $data['nama'] ?>"
                                                                        required>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="alamat">Alamat</label>
                                                                    <textarea class="form-control" rows="3" id="alamat"
                                                                        name="alamat"><?php echo $data['alamat'] ?></textarea>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="no_hp">No Hp</label>
                                                                    <input type="text" class="form-control" id="no_hp"
                                                                        name="no_hp" value="<?php echo $data['no_hp'] ?>"
                                                                        required>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="password">Password (kosongkan jika tidak
                                                                        ingin
                                                                        mengubah)</label>
                                                                    <input type="password" class="form-control"
                                                                        id="password" name="password"
                                                                        value="<?php echo isset($data['password']) ? $data['password'] : ''; ?>">
                                                                </div>

                                                                <div class="form-group">
                                                                    <label for="poli">Poli</label>
                                                                    <select class="form-control" id="poli" name="poli">
                                                                        <?php
                                                                        require 'koneksi.php';
                                                                        $query = "SELECT * FROM poli";
                                                                        $results = mysqli_query($mysqli, $query);
                                                                        while ($dataPoli = mysqli_fetch_assoc($results)) {
                                                                            $selected = $dataPoli['id']
                                                                                ?>
                                                                            <option value="<?php echo $dataPoli['id'] ?>">
                                                                                <?php echo $dataPoli['nama_poli'] ?>
                                                                            </option>
                                                                        <?php } ?>
                                                                    </select>
                                                                </div>
                                                                <button type="submit"
                                                                    class="btn btn-primary">Simpan</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Modal Hapus Data poli -->
                                            <div class="modal fade" id="hapusModal<?php echo $data['id'] ?>" tabindex="-1"
                                                role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="addModalLabel">Hapus Dokter
                                                            </h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <!-- Form edit data dokter disini -->
                                                            <form action="page/dokter/hapus_dokter.php" method="post">
                                                                <input type="hidden" class="form-control" id="id" name="id"
                                                                    value="<?php echo $data['id'] ?>" required>
                                                                <p>Anda yakin menghapus data dokter ini?
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
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->