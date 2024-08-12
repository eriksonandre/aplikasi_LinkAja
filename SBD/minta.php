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
	    <title>Minta</title>

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
    <!-- Navbar Image and text -->
    <?php
        include "navbar.php";
    ?>

    <div class="container mt-5">
        <h1><b>Minta Saldo</b></h1>
        <form method="post" enctype="multipart/form-data" class="mt-5">
				<div class="form-group">
					<label>No HP Pengirim</label>
					<div class="input-group mb-3">
						<div class="input-group-prepend"> <span class="input-group-text" id="basic-addon1"><i class="fas fa-mobile mx-1"></i></span></div>
    		  	<input class="form-control" required type="text" placeholder="No. Hp Pengirim" name="hp_pengirim" maxlength=15 minlength=10>
					</div>
    		</div>
				<div class="form-group">
					<label>Nominal (Rp)</label>
					<div class="input-group mb-3">
						<div class="input-group-prepend"> <span class="input-group-text" id="basic-addon1">Rp</span> </div>
    		  <input class="form-control" type="number" name="nominal" required min=1 placeholder="Masukan jumlah nominal yang hendak diminta!">
    			</div>
				</div>
				<div class="d-flex justify-content-between">
    		  <button type="submit" class="btn btn-warning" name="btnminta">Minta</button>
    		  <a href="sbd_home.php?id=<?php echo $pecah['id']; ?>" class="btn btn-primary">Kembali</a>
    		</div>
    	</form>
    </div>

    <?php
    if(isset($_POST['btnminta'])) {
		$hppengirim = $_POST['hp_pengirim'];
		$nominal = ($_POST['nominal']);

		//Cek db email yang sama
		$enter = "SELECT * FROM pengguna WHERE nohp = '$hppengirim'";
		$query = mysqli_query($koneksi, $enter);
		$count = mysqli_num_rows($query);

		//Jika tidak dapat mengakses db
		if(!$query) {
			echo "OOPS! SOMETHING WRONG :(<br>".$enter."<br>".mysqli_error($connect);
		}
		
		//Jika tidak ditemukan no_hp yang sama
		if ($count != 0) {
			while ($row = mysqli_fetch_array($query)) {
				$npengirim = $row['nama'];
				$hpengirim = $row['nohp'];
				$spengirim = $row['saldo'];
				$idpengirim = $row['id'];

                //Jika kolom nominal berisi
                if($hppengirim == $pecah['nohp'])
                {   echo "Yang Anda isi adalah nomor Anda sendiri. <br> Silakan masukkan nomor HP yang benar!";
                }
			    	    else
                {	  $result = mysqli_query($koneksi, "INSERT INTO minta VALUES(NULL, '$npengirim', '$hpengirim', '$pecah[nama]', '$pecah[nohp]', '$nominal', 0)");
                    
                    echo "<script>alert('Saldo berhasil diminta ke $npengirim. Menunggu respons pengirim.');</script>";
                }
                if(!$result)
                {  die('Query error : '.mysqli_errno($koneksi).' - '.mysqli_error($koneksi));
                }
			}			    
		}
		else {
			echo "Tidak terdapat pengguna yang memiliki no HP tersebut!";
			die;
        }
        // if (!$result) {
        //     die('Query error : ' . mysqli_errno($koneksi) . ' - ' . mysqli_error($koneksi));
        // }
        
    }
    ?>
    </body>
</html>