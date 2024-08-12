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
	<title>Kirim</title>

	<!-- Bootstrap core CSS -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
	<link rel="stylesheet" type="text/css" href="kirim.css">
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

	<div class="container">
		<br><br>
		<h1><b>Kirim</b></h1>
		<form method="post" enctype="multipart/form-data">
			<table class="table table-hover table-striped align-middle text-center">
				<tr>
					<td><label>No HP Penerima</label></td>
					<td><input class="form-control" type="text" name="nohp_penerima" required maxlength=15 minlength=10 placeholder="Masukkan no HP penerima! Misal: 08xxxxxxxxxx"></td>
				</tr>
				<tr>
					<td><label>Nominal (Rp)</label></td>
					<td><input class="form-control" type="number" name="nominal" required min=1 placeholder="Masukan jumlah nominal yang hendak dikirim!"></td>
				</tr>
			</table>
			<div class="form-group">
				<div class="row">
					<div class="col-sm-8">
						<button type="submit" class="btn btn-success" style="width: 200px;" name="btnkirim">Kirim</button>
					</div>
				</div>
			</div>
		</form>
	</div>
	<!-- DAFTAR PERMINTAAN KIRIM SALDO -->
	<div class="container">
		<form>
			<table class="table table-hover table-striped align-middle text-center">
				<thead class="thead-light">
					<tr>
						<th class="align-middle text-center" scope="col">No.</th>
						<th class="align-middle text-center" scope="col">Nama Peminta</th>
						<th class="align-middle text-center" scope="col">No. HP</th>
						<th class="align-middle text-center" scope="col">Saldo</th>
						<!-- <th class="align-middle text-center" scope="col">Tgl dan Waktu</th> -->
						<th class="align-middle text-center" colspan="2">Aksi</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$hpku = $pecah['nohp'];
					$data = $koneksi->query("SELECT * FROM minta WHERE antrian = 0 AND nohp_pengirim = $hpku");
					$no = 1;
					while ($d = mysqli_fetch_array($data)) {
					?>
						<tr>
							<td class="align-middle text-center"><?php echo $no++; ?></td>
							<td class="align-middle"><?php echo $d['nama_penerima']; ?></td>
							<td class="align-middle text-center"><?php echo $d['nohp_penerima']; ?></td>
							<td class="align-middle text-center"><?php echo $d['jumlah_saldo']; ?></td>
							<!-- <td class="align-middle text-center"></td> -->
							<td><button type="submit" class="btn btn-success" style="width: 100px;" name="btnkirim2">Kirim</button></td>
							<td><button class="btn btn-danger" onclick="return confirm('Apakah Anda yakin akan menghapus permintaan ini?')" style="width: 100px;" name="btnerase">Hapus</td>
						</tr>
					<?php } ?>
				</tbody>
			</table>
		</form>
	</div>

	<?php
	if (isset($_POST['btnkirim'])) {
		$hppenerima = $_POST['nohp_penerima'];
		$nominal = ($_POST['nominal']);

		//Cek db email yang sama
		$enter = "SELECT * FROM pengguna WHERE nohp = '$hppenerima'";
		$query = mysqli_query($koneksi, $enter);
		$count = mysqli_num_rows($query);

		//Jika tidak dapat mengakses db
		if (!$query) {
			echo "OOPS! SOMETHING WRONG :(<br>" . $enter . "<br>" . mysqli_error($connect);
		}

		//Jika tidak ditemukan no_hp yang sama
		if ($count != 0) {
			while ($row = mysqli_fetch_array($query)) {
				$npenerima = $row['nama'];
				$hpenerima = $row['nohp'];
				$spenerima = $row['saldo'];
				$idpenerima = $row['id'];
				$spengirim = $pecah['saldo'];

				//Jika kolom nominal berisi
				if ($hppenerima == $pecah['nohp']) {
					echo "Yang Anda isi adalah nomor Anda sendiri. <br> Silakan masukkan nomor HP yang benar!";
				} else {
					$result = mysqli_query($koneksi, "UPDATE pengguna SET 
                    saldo='$spenerima'+'$nominal' WHERE id='$idpenerima'");
					$result = mysqli_query($koneksi, "UPDATE pengguna SET 
                    saldo='$spengirim'-'$nominal' WHERE id='$id'");

					$result = mysqli_query($koneksi, "INSERT INTO minta VALUES('', '$pecah[nama]', '$pecah[nohp]', '$npenerima', '$hpenerima', '$nominal', 1)");

					echo "<script>alert('Saldo berhasil dikirim ke $npenerima.');</script>";
				}
			}
		} else {
			echo "Tidak terdapat pengguna yang memiliki no HP tersebut!";
			die;
		}
	}
	///////////////////////////////   DAFTAR ANTRIANNNNNNNNNN
	// if(isset($_POST['btnkirim2'])) 
	// {
	// 	$idminta = $d['id_minta'];
	// 	$namapenerima = $d['nama_penerima'];
	// 	$hp_penerima = $d['nohp_penerima'];
	// 	$nominal = $d['jumlah_saldo'];
	// 	$spengirim = $pecah['saldo'];
	// 	$idpengirim = $pecah['id'];

	// 		//Cek db email yang sama
	// 		$enter = "SELECT * FROM minta WHERE id_minta = '$idminta'";
	// 		$query = mysqli_query($koneksi, $enter);
	// 		$count = mysqli_num_rows($query);

	// 		//Jika tidak dapat mengakses db
	// 		if(!$query) {
	// 			echo "OOPS! SOMETHING WRONG WITH 'MINTA' TABLE :(<br>".$enter."<br>".mysqli_error($connect);
	// 		}


	// 		if ($count != 0) 
	// 		{
	// 			while ($row = mysqli_fetch_array($query)) 
	// 			{ // TABEL MINTA
	// 				// $npenerima = $row['nama'];
	// 				// $hpenerima = $row['nohp'];
	// 				// $spenerima = $row['saldo'];
	// 				// $idpenerima = $row['id'];
	// 				// $spengirim = $pecah['saldo'];
	// 				$result = mysqli_query($koneksi, "UPDATE minta SET antrian=1 WHERE id_minta='$idminta'");
	// 				//Update table pengguna
	// 				$enter2 = "SELECT * FROM pengguna WHERE id = '$idminta'";
	// 				$query2 = mysqli_query($koneksi, $enter2);
	// 				while ($row = mysqli_fetch_array($query2)) 
	// 				{ 	$spenerima = $row['saldo']; 

	// 					$result = mysqli_query($koneksi, "UPDATE pengguna SET 
	// 					saldo='$spenerima'+'$nominal' WHERE id='$idminta'");
	// 					$result = mysqli_query($koneksi, "UPDATE pengguna SET 
	// 					saldo='$spengirim'-'$nominal' WHERE id='$idpengirim'");

	// 					echo "<script>alert('Saldo berhasil dikirim ke $namapenerima.');</script>";

	// 					header("location: sbd_home.php?id=".$pecah['id']);

	// 				}
	// 			}			
	// 		}
	// 		else {
	// 			echo "Aku tidak tahu gagal di mana!";
	// 			die;
	// 		}

	// }
	?>
</body>

</html>