<!DOCTYPE html>
  <html lang="en">
    <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
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
    <meta name="robots" content="noindex, follow" />
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
        <span class="login100-form-title p-b-26"> Welcome </span>
        <span class="login100-form-title p-b-48">
          <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/8/85/LinkAja.svg/2048px-LinkAja.svg.png" width="50">
        </span>
        <div class="wrap-input100 validate-input" data-validate="Email yang benar email@domain.com">
          <input class="input100" type="text" name="pengguna" />
          <span class="focus-input100" data-placeholder="Email"></span>
        </div>
        <div class="wrap-input100 validate-input" data-validate="Enter password">
          <span class="btn-show-pass"><i class="zmdi zmdi-eye"></i></span>
          <input class="input100" type="password" name="sandi" />
          <span class="focus-input100" data-placeholder="Password"></span>
        </div>
        <div class="container-login100-form-btn">
          <div class="wrap-login100-form-btn">
            <div class="login100-form-bgbtn"></div>
            <button type="submit" class="login100-form-btn" name="btnlogin">Login</button>
          </div>
        </div>
        <div class="text-center p-t-115">
          <span class="txt1"> Don’t have an account? </span>
          <a class="txt2" href="register.php"> Sign Up </a>
        </div>
      </form>
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

include "connection.php";

if(isset($_POST['btnlogin'])) {
  $user_lgn = $_POST['pengguna'];
  $pass_lgn = /*md5*/($_POST['sandi']);

  //Cek db email yang sama
  $enter = "SELECT * FROM pengguna WHERE email = '$user_lgn'";
  $query = mysqli_query($koneksi, $enter);
  $count = mysqli_num_rows($query);

  //Jika tidak dapat mengakses db
  if(!$query) {
    echo "OOPS! SOMETHING WRONG :(<br>".$enter."<br>".mysqli_error($connect);
  }
  
  //Jika tidak ditemukan email yang sama
  if ($count != 0) {
    while ($row = mysqli_fetch_array($query)) {
      $n = $row['nama'];
      $h = $row['nohp'];
      $e = $row['email'];
      $p = $row['password'];
      $s = $row['saldo'];
      $id = $row['id'];

      //Jika password sama
      if ($pass_lgn == $p) {
          header("location: sbd_home.php?id=".$id);
          $_SESSION['nama'] = $n;
          $_SESSION['nohp'] = $h;
          $_SESSION['email'] = $e;
          $_SESSION['saldo'] = $s;
          $_SESSION['id_user'] = $id;
          die;
      }
      else {
        header ("location: wrong_pass.php");
        die;
      }
    }     
  }
  else {
    echo "<script>alert('Email atau Password Salah');window.location='login.php'</script>";
    /*alert ('location: wrong_user.php');*/
    die;
  }
}
?>
</body>
	<!-- Navbar
<nav class="navbar navbar-light" style="background-color: aqua">
  <a class="navbar-brand" href=#>
    <img src="https://1.bp.blogspot.com/-NwSMFZdU8l4/XZxj8FxN6II/AAAAAAAABdM/oTjizwstkRIqQZ7LOZSPMsUG3EYXF3E4wCEwYBhgL/s1600/logo-gopay-vector.png" width="200" height="55" style="border-radius: 15%;" >
  </a>
  <table>
  	<tr>
  		<td><a href="login_admin.php" class="btn btn-success" style="width: 200px;">Admin</a></td> 
  	</tr>
  </table>
</nav>
<br><br><br><br>

<div class="container">
  <form method="post" class="loginform" enctype="multipart/form-data">
    <div class="form-group">
      <label for="pengguna">Email</label>
      <input class="form-control" required type="text" placeholder="Masukkan Email Anda" name="pengguna">
    </div>
    <div class="form-group">
      <label for="sandi">Password</label>
      <input class="form-control" required type="password" placeholder="Masukkan Password Anda" name="sandi">
    </div>

    <button type="submit" class="btn btn-primary" style="width: 200px;" name="btnlogin">Masuk</button>
    <br><br>Belum punya akun? <a href="register.php">Daftar disini</a>
  </form>
    
</div>

</body> -->
</html>