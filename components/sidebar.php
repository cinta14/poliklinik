<aside class="main-sidebar bg-primary elevation-4">

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Tambahkan validasi session_start() -->
        <?php
        if (session_status() === PHP_SESSION_NONE) {
            session_name('adminlte_session'); // Nama unik untuk session
            session_start();
        }

        // Validasi session dan role pengguna
        if (!isset($_SESSION['akses']) || !isset($_SESSION['nama'])) {
            // Redirect ke halaman login jika session tidak ada
            header('Location: login.php');
            exit();
        }
        
        //nyimpan nilai dan menampilkan nama di sidebar
        $role = $_SESSION['akses'];
        $nama = $_SESSION['nama'];
        ?>

        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="app/images/profil1.jpg" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block text-light"><?php echo htmlspecialchars($nama); ?></a>
            </div>
        </div>
        <hr class="bg-light">
        
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Menu berdasarkan role pengguna -->
                <li class="nav-item menu-open">
                    <a href="#" class="nav-link active">
                        <i class="nav-icon fas fa-bars"></i>
                        <p class="text-light">Menu<i class="right fas fa-angle-left"></i></p>
                    </a>

                    <?php if ($role === "admin") { ?>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="dashboard_admin.php" class="nav-link">
                                    <i class="fas fa-th nav-icon text-light"></i>
                                    <p class="text-light">Dashboard <span class="right badge badge-success">Admin</span></p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="dokter.php" class="nav-link">
                                    <i class="fas fa-user-md nav-icon text-light"></i>
                                    <p class="text-light">Dokter <span class="right badge badge-success">Admin</span></p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="pasien.php" class="nav-link">
                                    <i class="fas fa-user-injured nav-icon text-light"></i>
                                    <p class="text-light">Pasien <span class="right badge badge-success">Admin</span></p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="poli.php" class="nav-link">
                                    <i class="fas fa-hospital nav-icon text-light"></i>
                                    <p class="text-light">Poli <span class="right badge badge-success">Admin</span></p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="obat.php" class="nav-link">
                                    <i class="fas fa-pills nav-icon text-light"></i>
                                    <p class="text-light">Obat <span class="right badge badge-success">Admin</span></p>
                                </a>
                            </li>

                        </ul>
                    <?php } else if ($role === "dokter") { ?>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="dashboard_dokter.php" class="nav-link">
                                        <i class="fas fa-th nav-icon text-light"></i>
                                        <p class="text-light">Dashboard <span class="right badge badge-danger">Dokter</span></p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="jadwal_periksa.php" class="nav-link">
                                        <i class="fas fa-clipboard nav-icon text-light"></i>
                                        <p class="text-light">Jadwal Periksa<span class="right badge badge-danger">Dokter</span>
                                        </p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="periksa_pasien.php" class="nav-link">
                                        <i class="fas fa-stethoscope nav-icon text-light"></i>
                                        <p class="text-light">Periksa Pasien <span
                                                class="right badge badge-danger">Dokter</span></p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="riwayat_pasien.php" class="nav-link">
                                        <i class="fas fa-notes-medical nav-icon text-light"></i>
                                        <p class="text-light">Riwayat Pasien <span
                                                class="right badge badge-danger">Dokter</span></p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="profil_dokter.php" class="nav-link">
                                        <i class="fas fa-user nav-icon text-light"></i>
                                        <p class="text-light">Profil<span
                                                class="right badge badge-danger">Dokter</span></p>
                                    </a>
                                </li>
                            </ul>
                    <?php } else if ($role === "pasien") { ?>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="dashboard_pasien.php" class="nav-link">
                                            <i class="fas fa-th nav-icon nav-icon text-light"></i>
                                            <p class="text-light">Dashboard <span class="right badge badge-warning">Pasien</span>
                                            </p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="daftar_poliklinik.php" class="nav-link">
                                            <i class="fas fa-hospital nav-icon text-light"></i>
                                            <p class="text-light">Daftar Poli <span class="right badge badge-warning">Pasien</span>
                                            </p>
                                        </a>
                                    </li>
                                </ul>
                    <?php } ?>
                </li>
               
                <br>
                <!-- Menu Logout -->
                <li class="nav-item">
                    <a href="logout.php" class="nav-link">
                        <i class="nav-icon fas fa-sign-out-alt text-light"></i>
                        <p class="text-light">Logout</p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>