<?php
session_start();
$nama = $_SESSION['nama'];

if ($nama == "") {
    header("location:login_user.php");
}
// else if ($_SESSION['akses'] != "admin") {
//     echo '<script>alert("Anda tidak memiliki akses");window.location.href="login.php";</script>';
// }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Poliklinik</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="app/plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="app/dist/css/adminlte.min.css">
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">

        <!-- Navbar -->
        <?php include('components/navbar.php') ?>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <?php include('components/sidebar.php') ?>
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <?php include('page/obat/index.php') ?>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
            <div class="p-3">
            </div>
        </aside>
        <!-- /.control-sidebar -->

        <!-- Main Footer -->
    </div>
    <!-- ./wrapper -->

    <!-- REQUIRED SCRIPTS -->

    <!-- jQuery -->
    <script src="app/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="app/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="app/dist/js/adminlte.min.js"></script>
</body>

</html>