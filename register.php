<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Poliklinik</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="app/plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="app/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="app/dist/css/adminlte.min.css">
</head>

<body class="hold-transition register-page">
  <div class="register-box">
    <div class="card card-outline card-primary">
      <div class="card-header text-center">
        <a href="index.php" class="h1"><b>Poli</b>Klinik</a>
      </div>
      <div class="card-body">
        <p class="login-box-msg">Register a new account</p>
        <!--mengirimkan data ke server untuk di proses-->
        <form action="cek_register.php" method="post">
          <div class="input-group mb-3">
            <input type="text" class="form-control" placeholder="Full Name" name="nama">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-user"></span>
              </div>
            </div>
          </div>
          <div class="input-group mb-3">
            <input type="text" class="form-control" placeholder="Alamat" name="alamat">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-map-marker"></span>
              </div>
            </div>
          </div>
          <div class="input-group mb-3">
            <input type="text" class="form-control" placeholder="No KTP" name="no_ktp">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-address-book"></span>
              </div>
            </div>
          </div>
          <div class="input-group mb-3">
            <input type="text" class="form-control" placeholder="No Hp" name="no_hp">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-phone"></span>
              </div>
            </div>
          </div>
          <div class="input-group mb-3">
            <input type="password" class="form-control" placeholder="Password" name="password">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>
          <!--untuk checkbox-->
          <div class="row">
            <div class="col-8">
              <div class="icheck-primary">
              </div>
            </div>
            <div class="col-4">
              <button type="submit" class="btn btn-primary btn-block">Register</button>
            </div>
          </div>
        </form>
        <!--mengarahkan pasien ke halaman login jika sudah memiliki akun-->
        <a href="login_pasien.php" class="text-center">I already have an account</a>
      </div>
    </div>
  </div>

  <!-- jQuery -->
  <script src="app/plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="app/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- AdminLTE App -->
  <script src="app/dist/js/adminlte.min.js"></script>
</body>

</html>