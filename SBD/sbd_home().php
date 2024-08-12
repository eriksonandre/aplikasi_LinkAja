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
<html>
<head>
	<title>Home</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  <link rel="stylesheet" type="text/css" href="css/sbd_home.css">
</head>
<body>
<!-- Navbar Image and text -->
<?php
  include "navbar.php";
?>
<!--Gambar-->
<div class="jumbotron" style="background-image: url(images/img1.jpg); background-size: cover;">
  <div class="container">
    <br><br><br><br><br><br><br><br><br><br><br><br><br><br>
  </div>
</div>
<!--konten-->
<section class="konten">
  <div class="container">
    <h1>Fitur Kami</h1> 
    <div class="row">
      <div class="col-md-3">
        <div class="card">
          <img class="card-img-top" src="images/minta.png" alt="Card Image">
          <div class="card-body">				
            <a class="btn btn-success" href="minta.php?id=<?php echo $pecah['id']; ?>" style="width: 200px; height: 25%;">Minta</a>
          </div>
        </div>
      </div>
      <div class="col-md-3">
        <div class="card">
          <img class="card-img-top" src="images/minta.png" alt="Card Image">
          <div class="card-body">
            <a class="btn btn-success" href="kirim.php?id=<?php echo $pecah['id']; ?>" style="width: 200px; height: 25%;">Kirim</a>
          </div>
        </div>
      </div>        
      <div class="col-md-3">
        <div class="card">
          <img class="card-img-top" src="images/minta.png" alt="Card Image">
          <div class="card-body">
            <a class="btn btn-success" href="pilih_tagihan.php?id=<?php echo $pecah['id']; ?>" style="width: 200px; height: 25%;">Tagihan</a>
          </div>
        </div>
      </div>    
      <div class="col-md-3">
        <div class="card">
          <img class="card-img-top" src="images/minta.png" alt="Card Image">
          <div class="card-body">
            <a class="btn btn-success" href="pilih_pulsa.php?id=<?php echo $pecah['id']; ?>" style="width: 200px; height: 25%;">Pulsa</a>
          </div>
        </div>
      </div>    
      <div class="col-md-3">
        <div class="card">
          <img class="card-img-top" src="images/minta.png" alt="Card Image">
          <div class="card-body">
            <a class="btn btn-success" href="tarik_tunai.php?id=<?php echo $pecah['id']; ?>" style="width: 200px; height: 25%;">Tarik</a>
          </div>
        </div>
      </div>    
      <div class="col-md-3">
        <div class="card">
          <img class="card-img-top" src="images/minta.png" alt="Card Image">
          <div class="card-body">
            <a class="btn btn-success" href="antrian.php?id=<?php echo $pecah['id']; ?>" style="width: 200px; height: 25%;">Antrian</a>
          </div>
        </div>
      </div>
      <!-- <div class="col-md-3">
        <div class="card">
          <img class="card-img-top" src="images/minta.png" alt="Card Image">
          <div class="card-body">
            <a class="btn btn-success" href="riwayat.php?id=<?php echo $pecah['id']; ?>" style="width: 200px; height: 25%;">Riwayat</a>
          </div>
        </div>
      </div>         -->

    </div> 
  </div>
</section>
</body>
</html>