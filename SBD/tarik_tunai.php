<!-- Connection to Database -->
<?php
include "connection.php";

$id = $_GET['id'];
$ambil = $koneksi->query("SELECT * FROM pengguna WHERE id='$_GET[id]'");
$pecah = $ambil->fetch_assoc();
?>

<!DOCTYPE html>
<html>
<head>
	<title>Tarik Tunai</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  <link rel="stylesheet" type="text/css" href="minta.css">
  <!-- Basic -->
  <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    
    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <!-- Site Metas -->
    <title>Cleed - Stylish Magazine</title>
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="author" content="">
    
    <!-- Site Icons -->
    <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon" />
    <link rel="apple-touch-icon" href="images/apple-touch-icon.png">
    
    <!-- Design fonts -->
    <link href="https://fonts.googleapis.com/css?family=Ubuntu:300,400,400i,500,700" rel="stylesheet"> 
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,400i,500,700,900" rel="stylesheet"> 

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.css" rel="stylesheet">

    <!-- FontAwesome Icons core CSS -->
    <link href="css/font-awesome.min.css" rel="stylesheet">

    <!-- Custom styles -->
    <link href="style.css" rel="stylesheet">

    <!-- Responsive styles -->
    <link href="css/responsive.css" rel="stylesheet">

    <!-- Colors -->
    <link href="css/colors.css" rel="stylesheet">
</head>
<body>
<!-- Navbar Image and text -->
<?php
  include "navbar.php";
?>
<br><br>
<!--Konten-->
<div class="container">
  <h1><b>Tarik Saldo</b></h1>
  <p>
  <div class="container">
  <form method="post" class="loginform">
    <div class="form-group">
      <label for="jlh_tarik">Jumlah Tarik Saldo (Rp)</label>
      <input class="form-control" required type="number" placeholder="Masukan jumlah saldo yang ingin ditarik" name="jlh_tarik" onkeypress="return numberOnly(event)">
    </div>
    <!-- <button type="submit" class="btn btn-primary" style="width: 200px;" href="#tarik" name="btn_tarik">Tarik</button> -->
    <a class="nav-link color-blue-hover" data-toggle="modal" href="#tarik"><i class='fa fa-user' style="font-size: 15px;"></i>&nbsp <b>Tarik</b></a>
  </form>
</div>


<!-- MODAL -->
    <!-- modal sign up -->
    <div class="container">
            <div class="modal fade" id="tarik">
  <?php
    $permitted_chars = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $kode = substr(str_shuffle($permitted_chars), 0, 8);
  ?>
                <div class="modal-dialog modal-dialog-centered">
                    <center>
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title mx-auto">Tarik Tunai</h4>
                        </div><!-- end modal-header -->
                        <div class="modal-body">
                            <div class="container">
                                <form method="post" class="form">
                                    <div class="form-group">
                                        Masukkan kode yang terikirim ke nomor HP Anda!
                                    </div>
                                    <div class="form-group">
                                        Kode: <?php $kode2 = $kode; echo $kode2; ?><?php echo $kode; ?>
                                    </div>
                                    <div class="form-group">
                                        <input class="form-control" required maxlength=8 type="text" placeholder="PIN" name="pin">
                                    </div>
                                    <button class="btn btn-primary" type="submit" name="btntarik">Tarik</button>
                                </form><br>
                            </div>
                        </div><!-- end modal-body -->
                    </div>
                    </center>
                </div><!-- end modal-dialog -->
            </div><!-- end modal -->
        </div><!-- end container -->
    <!-- end modal signup -->

<?php
  if(isset($_POST['btntarik'])) {
	  $pin = $_POST['pin'];
    $nominal = $_POST['jlh_tarik'];
    $id = $pecah['id'];
    $nama = $pecah['nama'];
    $saldolama = $pecah['saldo'];

    echo $pin, "<enter> ", $kode, " ", $kode2;
    echo $nominal;
    // if ($pin == $kode)
    // { $enter = "SELECT * FROM pengguna WHERE id = '$id'";
    //   $query = mysqli_query($koneksi, $enter);
    
    //     //Jika tidak dapat mengakses db
    //   if(!$query) {
    //     echo "OOPS! SOMETHING WRONG :(<br>".$enter."<br>".mysqli_error($connect);
    //   }
    //   else  {
    //     $result = mysqli_query($koneksi, "INSERT INTO tarik_tunai VALUES(NULL, '$id', '$nama', '$pin', '$nominal')");

    //     $result = mysqli_query($koneksi, "UPDATE pengguna SET 
    //     saldo='$saldolama'-'$nominal' WHERE id='$id'");

    //     echo "<script>alert('Berhasil tarik tunai!');</script>";
  
    //     header("location: sbd_home.php?id=".$pecah['id']);
    //   }
    // }
    // else {
    //   echo "<script>alert('Pin yang Anda masukkan salah!');</script>";
    // }
  }
?>

</body>
</html>