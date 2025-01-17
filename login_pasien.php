<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include 'koneksi.php';

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = $_POST['nama'];
    $password = $_POST['password'];

    // Menggunakan prepared statement untuk menghindari SQL Injection
    $stmt = $mysqli->prepare("SELECT * FROM pasien WHERE nama = ?"); //? adalah placeholder untuk variabel yang akan dipasangkan, dalam hal ini nama.
    $stmt->bind_param("s", $nama); //mengikat parameter nama yang dikirim dari form login ke query.
    $stmt->execute(); //menajalankan query
    $result = $stmt->get_result(); //mengambil hasilnya

    //memeriksa data pengguna dan validasi password
    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            $_SESSION['nama'] = $nama;
            $_SESSION['user_id'] = $row['id_user'];
            $_SESSION['akses'] = $row['role']; // Set role untuk digunakan di sidebar

            // Redirect berdasarkan role pengguna
            if ($row['role'] == 'pasien') {
                header("Location: dashboard_pasien.php");
            } else {
                header("Location: login_pasien.php");
            }
            exit;
        } else {
            $error = "Password salah.";
        }
    } else {
        $error = "nama tidak ditemukan.";
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Login</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback" />
    <!-- Font Awesome -->
    <link rel="stylesheet" href="app/plugins/fontawesome-free/css/all.min.css" />
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="app/plugins/icheck-bootstrap/icheck-bootstrap.min.css" />
    <!-- Theme style -->
    <link rel="stylesheet" href="app/dist/css/adminlte.min.css" />


</head>

<body>

    <body class="hold-transition login-page">
        <div class="login-box">
            <!-- /.login-logo -->
            <div class="card card-outline card-primary">
                <div class="card-header text-center">
                    <a href="index.php" class="h1"><b>POLI</b>KLINIK</a>
                </div>
                <div class="card-body">
                    <p class="login-box-msg">Login to your account</p>
                    <form action="cek_login_pasien.php" method="post">
                        <!--setelah isi form akan dikirim ke cek_login_pasien-->
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" placeholder="nama" name="nama" />
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-envelope"></span>
                                </div>
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <input type="password" class="form-control" placeholder="Password" name="password" />
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-lock"></span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-8">
                            </div>
                            <!-- /.col -->
                            <div class="col-4">
                                <button type="submit" class="btn btn-primary btn-block">
                                    Login
                                </button>
                            </div>
                            <!-- /.col -->
                        </div>
                    </form>
                    <p class="mb-0">
                        <a href="register.php" class="text-center">Register a new account</a>
                    </p>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
        <!-- /.login-box -->

        <?php if ($error): ?>
            <script>
                Swal.fire('Error', '<?php echo $error; ?>', 'error');
            </script>
        <?php endif; ?>
        <!-- jQuery -->
        <script src="app/plugins/jquery/jquery.min.js"></script>
        <!-- Bootstrap 4 -->
        <script src="app/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
        <!-- AdminLTE App -->
        <script src="app/dist/js/adminlte.min.js"></script>
    </body>

</html>