<?php
include "connection.php";
?>

<!DOCTYPE html>
  <html lang="en">
    <head>
	  <title>Selamat Datang</title>

    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css"/>
		<link rel="stylesheet" type="text/css" href="css/material-design-iconic-font.min.css">
		<link rel="stylesheet" type="text/css" href="css/animate.css">
		<link rel="stylesheet" type="text/css" href="css/hamburgers.min.css">
		<link rel="stylesheet" type="text/css" href="css/animsition.min.css">
		<link rel="stylesheet" type="text/css" href="css/select2.min.css">
		<link rel="stylesheet" type="text/css" href="css/daterangepicker.css">
    <link rel="stylesheet" type="text/css" href="css/util.css" />
    <link rel="stylesheet" type="text/css" href="css/main.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/material-design-iconic-font/2.2.0/css/material-design-iconic-font.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    <script>
		function numberOnly(event) {
			var angka = (event.which) ? event.which : event.keyCode
			if (angka > 31 && (angka < 48 || angka > 57))
				return false;
			return true;
		}
	  </script>
    <style>
      body {
        font-family: 'Poppins';;
      }
    </style>
    </head>

  <body>

  <div class="limiter">
  <div class="container-login100">
    <div class="wrap-login100">
      <form class="login100-form validate-form" method="post" enctype="multipart/form-data">
        <span class="login100-form-title p-b-26"> Register </span>
        <span class="login100-form-title p-b-48">
          
        </span>
        <div class="wrap-input100 validate-input" data-validate="Nama Kosong!" >
          <input class="input100" type="text" name="nama" />
          <span class="focus-input100" data-placeholder="Masukkan Nama Lengkap Anda"></span>
        </div>
        <div class="wrap-input100 validate-input" data-validate="Nomor HP Kosong!">
          <input class="input100" type="text" name="nohp" onkeypress="return numberOnly(event)"/>
          <span class="focus-input100" data-placeholder="Masukan Nomor Hp Anda"></span>
        </div>
        <div class="wrap-input100 validate-input" data-validate="Email Kosong!">
          <input class="input100" type="text" name="email"/>
          <span class="focus-input100" data-placeholder="Masukan Email Anda"></span>
        </div>
        <div class="wrap-input100 validate-input" data-validate="Password Kosong!">
          <span class="btn-show-pass"><i class="zmdi zmdi-eye"></i></span>
          <input class="input100" type="password" name="password" />
          <span class="focus-input100" data-placeholder="Masukan Password Anda"></span>
        </div>
        <div class="container-login100-form-btn">
          <div class="wrap-login100-form-btn">
            <div class="login100-form-bgbtn"></div>
            <button type="submit" class="login100-form-btn" name="submit">Daftar</button>
          </div>
        </div>
        <div class="text-center p-t-115">
          <span class="txt1"> Sudah Punya Akun? </span>
          <a class="txt2" href="login.php"> Login </a>
        </div>
      </form>
    </div>
  </div>
</div>

    
</div>

    <script type="text/javascript" async="" src="css/analytics.js.download"></script>
    <script src="css/jquery-3.2.1.min.js.download"></script>
    <script src="css/animsition.min.js.download"></script>
    <script src="css/popper.js.download"></script>
    <script src="css/bootstrap.min.js.download"></script>
    <script src="css/select2.min.js.download"></script>
    <script src="css/moment.min.js.download"></script>
    <script src="css/daterangepicker.js.download"></script>
    <script src="css/countdowntime.js.download"></script>
    <script src="css/main.js.download"></script>

    <?php
  if (isset($_POST['submit'])) {
    $nama = $_POST['nama'];
    $nohp = $_POST['nohp'];
    $email = $_POST['email'];
    $password = /*md5*/ ($_POST['password']);

    $result = mysqli_query($koneksi, "INSERT INTO pengguna VALUES('', '$nama', '$nohp', '$email', '$password', 0, '', 0)");
    if (!$result) {
      die('Query error : ' . mysqli_errno($koneksi) . ' - ' . mysqli_error($koneksi));
    }
    echo "<div class='alert alert-info'>Anda berhasil terdaftar!</div>";
    echo "<meta http-equiv='refresh' content='1;url=login.php'>";
  }
  ?>
</body>
</html>