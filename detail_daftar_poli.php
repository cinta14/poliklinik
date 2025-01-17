<!DOCTYPE html>
<?php
    session_start();
    $nama = $_SESSION['nama'];
    $idPasien = $_SESSION['id'];

    if ($nama == "") {
        header("location:login_pasien.php");
    }
?>

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
    <link rel="stylesheet" href="css/style.css">
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">

        <!-- Navbar -->
        <?php include ('components/navbar.php') ?>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <?php include ('components/sidebar.php') ?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <?php include ('page/detail_daftar_poli/index.php') ?>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

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
    <script>
    $(document).ready(function() {
        $('#poli').on('change', function() {
            var poliId = $(this).val();

            // Mengambil data jadwal berdasarkan poli yang dipilih
            $.ajax({
                type: 'POST',
                url: 'jadwal_dokter_poli.php', 
                data: {
                    poliId: poliId
                },
                success: function(data) {
                    $('#jadwal').html(data);
                }
            });
        });
    });
    </script>
</body>

</html>