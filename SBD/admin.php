<!-- Connection to Database -->
<?php
include "connection.php";
?>

<!DOCTYPE html>
<html>
    <head>
	    <title>Admin</title>

        <!-- Bootstrap core CSS -->
	    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
        <link rel="stylesheet" type="text/css" href="minta.css">
	    <link href="css/bootstrap.css" rel="stylesheet">
	    <link href="style.css" rel="stylesheet">
	    <link href="bootstrap.min.css" rel="stylesheet">
    	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css">
    	<script src="./js/bootstrap.min.js"></script>
	    <script src="./js/jquery.js"></script>
    </head>

    <body>
    <!--Navbar-->
	<nav class="navbar navbar-light" style="background-color: aqua">
	  <a class="navbar-brand" href=#>
	    <img src="https://1.bp.blogspot.com/-NwSMFZdU8l4/XZxj8FxN6II/AAAAAAAABdM/oTjizwstkRIqQZ7LOZSPMsUG3EYXF3E4wCEwYBhgL/s1600/logo-gopay-vector.png" width="200" height="55" style="border-radius: 15%;" >
	  </a>
	  <table>
	  	<tr>
  		<!-- <td><a href="login.php" class="btn btn-success" style="width: 200px;">Login</a></td> -->
  		</tr>
  	  </table>
	</nav>
	<br><br>

    <div class="container">
        <br><br>
        <h1><b>Top Up</b></h1>
        <form method="post" enctype="multipart/form-data">
            <table class="table table-hover table-striped align-middle text-center">
                <tr>
					<td><label>No HP</label></td>
					<td><input class="form-control" type="text" name="hp_tujuan" required maxlength=15 minlength=10 placeholder="Masukkan no HP tujuan! Misal: 08xxxxxxxxxx"></td>
				</tr>
                <tr>
					<td><label>Nominal (Rp)</label></td>
					<td><input class="form-control" type="number" name="jlh_topup" required min=1 placeholder="Masukan jumlah nominal yang hendak di top up!"></td>
				</tr>
            </table> 
            <div class="form-group">
					<div class="row">
						<div class="col-sm-8">
							<button type="submit" class="btn btn-success" style="width: 200px;" name="btn_topup">TOP UP</button>
						</div>
						<div class="col-sm-4">
			                <a class="nav-link" style="color: #0c093c;text-align:right;" href="logout.php"><i class="fas fa-arrow-circle-left"></i> Logout</a>
			            </div>
					</div>
				</div>   
        </form>

    </div>

    <?php
    if(isset($_POST['btn_topup'])) {
		$hppenerima = $_POST['hp_tujuan'];
		$nominal = $_POST['jlh_topup'];

    	$enter = "SELECT * FROM pengguna WHERE nohp = '$hppenerima'";
		$query = mysqli_query($koneksi, $enter);
		while ($row = mysqli_fetch_array($query)) 
		{ 	$spenerima = $row['saldo']; 
			$idpenerima = $row['id'];
			$namapenerima = $row['nama'];

			$result = mysqli_query($koneksi, "UPDATE pengguna SET 
			saldo='$spenerima'+'$nominal' WHERE id='$idpenerima'");
					
						echo "<script>alert('Saldo berhasil dikirim ke $namapenerima.');</script>";
					   
						// header("location: sbd_home.php?id=".$pecah['id']);
						
		}
	
	/*
		$enter = "SELECT * FROM pengguna WHERE nohp = '$no_hp'";
		$query = mysqli_query($koneksi, $enter);
	 while ($row = mysqli_fetch_array($query)) 
	 { 	$spenerima = $row['saldo']; 
	$result = mysqli_query($koneksi, "UPDATE pengguna SET 
	saldo='$spenerima'+'$nominal' WHERE nohp='$no_hp'");
*/

		// $koneksi->query("UPDATE pengguna SET saldo ='$saldo_sekarang' WHERE nohp='$nohp'");

		// echo "<script>alert('Topup ke  Sukses');</script>";
		// echo "<script>location='admin.php?id=$id';</script>";
	}
    ?>
    </body>
</html>