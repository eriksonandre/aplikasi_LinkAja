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
  <title>Tagihan PLN</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  <link rel="stylesheet" type="text/css" href="minta.css">
</head>
<body>
<!-- Navbar Image and text -->
<?php
  include "navbar.php";
?>
<br><br>
<div class="container">
  <h1><b>Tagihan PLN</b></h1><br><br>
  <form method="post" enctype="multipart/form-data">
  <div class="form-group">
    <label for="id_pelanggan">Masukan ID Pelanggan</label>
    <input type="text" class="form-control" name="id_pelanggan" placeholder="Masukan ID Pelanggan Anda">
  </div>
  <div class="form-group">
    <label for="nominal">Jumlah Tagihan Anda (Rp.)</label>
    <input type="number" min=10000 class="form-control" required name="nominal" placeholder="Total Tagihan">
  </div>
  <div class="d-flex justify-content-between">
    <button type="submit" class="btn btn-success" name="btnbayar">Bayar</button>
    <a href="sbd_home.php?id=<?php echo $pecah['id']; ?>" class="btn btn-primary">Kembali</a>
  </div>
</form>
</div>

<?php
    if(isset($_POST['btnbayar'])) {
		$idpelanggan = $_POST['id_pelanggan'];
    $nominal = $_POST['nominal'];
    $id = $pecah['id'];

		//Cek db email yang sama
		$enter = "SELECT * FROM pengguna WHERE id = '$id'";
		$query = mysqli_query($koneksi, $enter);
		$count = mysqli_num_rows($query);

		//Jika tidak dapat mengakses db
		if(!$query) {
			echo "OOPS! SOMETHING WRONG :(<br>".$enter."<br>".mysqli_error($connect);
		}
		
		//Jika tidak ditemukan id yang sama
		if ($count != 0) {
			while ($row = mysqli_fetch_array($query)) {
				$npengguna = $row['nama'];
				$spengguna = $row['saldo'];

				
          $result = mysqli_query($koneksi, "UPDATE pengguna SET 
          saldo='$spengguna'-'$nominal' WHERE id='$id'");
					
					$result = mysqli_query($koneksi, "INSERT INTO tagihan VALUES(NULL, '2', 'PLN', '$id', '$npengguna', '$idpelanggan', '$nominal')");
					
					echo "<script>alert('Tagihan berhasil dibayar.');</script>"; 
      }			
      // header("location: sbd_home.php?id=".$pecah['id']);
		}
		else {
			echo "Tidak terdapat pengguna yang memiliki no HP tersebut!";
			die;
		}
	}	
?>
</body>
</html>