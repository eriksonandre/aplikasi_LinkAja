<!-- Connection to Database -->
<?php
include "connection.php";

$id = isset($_GET['id']) ? $_GET['id'] : '';
$ambil = $koneksi->query("SELECT * FROM pengguna WHERE id='$id'");
$pecah = $ambil->fetch_assoc();

/*if (!isset($_SESSION['id'])) 
  {
      echo "<script>alert('anda harus login');<?script>";
      echo "<script>location='login.php'</script>;";
      header('location:login.php');

  }
*/
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Home</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.min.js" integrity="sha384-skAcpIdS7UcVUC05LJ9Dxay8AXcDYfBJqt1CJ85S/CFujBsIzCIv+l9liuYLaMQ/" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" type="text/css" href="css/custom.css">

	<meta charset="utf-8">
	<style type="text/css">

	</style>
</head>

<body>
<div class="container-fluid">
  <div class="p-4">
    <div class="row justify-content-center">
      <div class="col-sm-1 mx-auto">
        <?php
          function getProfilePicture($name){
            $name_slice = explode(' ',$name);
              $name_slice = array_filter($name_slice);
              $initials = '';
            $initials .= (isset($name_slice[0][0]))?strtoupper($name_slice[0][0]):'';
            $initials .= (isset($name_slice[count($name_slice)-1][0]))?strtoupper($name_slice[count($name_slice)-1][0]):'';
            return '<div class="profile-pic">'.$initials.'</div>';
          }
        ?>
        <?php echo getProfilePicture($pecah['nama']);?>
      </div>
      <div class="col-sm-9 main"><div class="inner"><h2 class="text-uppercase outer"><?php echo $pecah['nama']; ?></h3></div></div>
      <div class="col-sm-1 main"></div>
      <div class="col-sm-1 main"></i></div>
    </div>
    </div>
  </div>
</div>

<div class="container-fluid shell">
  <div class="px-4 pt-4">
  <div class="row">
    <div class="col">
      <div class="col-3 col-md-3 col-sm-3 col-lg-3 font-weight-bold h3">Rp<?php echo number_format($pecah['saldo'],2,',','.'); ?></div>
    </div>
    <div class="col-auto"><img src="https://upload.wikimedia.org/wikipedia/commons/thumb/8/85/LinkAja.svg/2048px-LinkAja.svg.png" width="50"></div>
</div>

      <div class="d-flex justify-content-center m-5 top-menu text-center">
        <div class="flex-fill"><a href="minta.php?id=<?php echo $pecah['id']; ?>" title="Kirim Uang" target="_blank" rel="nofollow"><i class="fas fa-money-check-alt"></i><span>Minta Saldo</span></a></div>
        <div class="flex-fill"><a href="kirim.php?id=<?php echo $pecah['id']; ?>" title="Kirim Uang" target="_blank" rel="nofollow"><i class="fas fa-money-check-alt"></i><span>Kirim Saldo</span></a></div>
      </div>
    </div>
  </div>
</div>

<div class="jumbotron vertical-center">
  <div class="container">
<div class="container-fluid px-5">
<div class="d-flex justify-content-between m-5 bottom-menu text-center align-middle">
        <div class="flex-fill"><a href="pulsa.php?id=<?php echo $pecah['id']; ?>" title="Pulsa" target="_blank" rel="nofollow"><i class="fas fa-mobile-alt fa-5x"></i><span>Pulsa</span></a></div>
        <div class="flex-fill"><a href="tagihan_listrik.php?id=<?php echo $pecah['id']; ?>" title="Listrik" target="_blank" rel="nofollow"><i class="fas fa-bolt fa-5x"></i><span>Listrik</span></a></div>
        <div class="flex-fill"><a href="tagihan_air.php?id=<?php echo $pecah['id']; ?>" title="Air" target="_blank" rel="nofollow"><i class="fas fa-tint fa-5x"></i><span>PDAM</span></a></div>
</div>
        </div>
        </div>

<!-- Bottom Navbar -->
<nav class="navbar navbar-dark navbar-custom navbar-expand fixed-bottom p-0">
    <ul class="navbar-nav nav-justified w-100 nav-custom">
        <li class="nav-item other">
            <a href="sbd_home.php?id=<?php echo $pecah['id']; ?>" class="nav-link text-center">
              <i class="fas fa-home fa-3x"></i>
                <span class="small d-block">Home</span>
            </a>
        </li>
        <li class="nav-item other">
            <a href="profil.php?id=<?php echo $pecah['id']; ?>" class="nav-link text-center" role="button" id="dropdownMenuProfile" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" >
              <i class="far fa-user fa-3x"></i>
                <span class="small d-block">Akun</span>
            </a>
        </li>
    </ul>
</nav>

    </div> 
  </div>
</section>
</body>
</html>