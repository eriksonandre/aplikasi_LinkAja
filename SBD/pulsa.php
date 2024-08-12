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
  <title>Isi Pulsa</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.csss" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
<!-- Navbar Image and text -->
<?php
  include "navbar.php";
?>
<br><br>
<div class="container mt-5">
        <h1><b>ISI PULSA</b></h1>
        <form method="post" enctype="multipart/form-data" class="mt-5">
				<div class="form-group">
					<label>Nomor Telepon</label>
					<div class="input-group mb-3">
						<div class="input-group-prepend"> <span class="input-group-text" id="basic-addon1"><i class="fas fa-mobile mx-1"></i></span> </div>
						<input type="text" class="form-control" placeholder="Masukkan Nomor Kartu" aria-label="Username" aria-describedby="basic-addon1"> 
					</div>
    		</div>
				<div class="form-group">
					<label>Nominal (Rp)</label>
					<div class="input-group mb-3">
						<div class="input-group-prepend"> <span class="input-group-text" id="basic-addon1">Rp</span> </div>
						<select type="number" class="form-control" name="nominal" required>
							<option hidden value="">Pilih Nominal</option>
							<option value="5000">5000</option>
							<option value="10000">10000</option>
							<option value="15000">15000</option>
							<option value="20000">20000</option>
							<option value="25000">25000</option>
							<option value="50000">50000</option>
							<option value="100000">100000</option>
						</select>
					</div>
    		</div>

				<div class="d-flex justify-content-between">
    		  <button type="submit" class="btn btn-success" name="btnisi">Isi</button>
    		  <a href="sbd_home.php?id=<?php echo $pecah['id']; ?>" class="btn btn-primary">Kembali</a>
    		</div>
    	</form>
    </div>

<?php
if (isset($_POST['btnisi']))
{
    $hptujuan = $_POST['nohp_tujuan'];
    $nominal = $_POST['nominal'];
    $id = $pecah['id'];

    //Cek db email yang sama
    $enter = "SELECT * FROM pengguna WHERE id = '$id'";
    $query = mysqli_query($koneksi, $enter);
    $count = mysqli_num_rows($query);

    //Jika tidak dapat mengakses db
    if (!$query)
    {
        echo "OOPS! SOMETHING WRONG :(<br>" . $enter . "<br>" . mysqli_error($connect);
    }

    //Jika tidak ditemukan id yang sama
    if ($count != 0)
    {
        while ($row = mysqli_fetch_array($query))
        {
            $npengguna = $row['nama'];
            $spengguna = $row['saldo'];

            $result = mysqli_query($koneksi, "UPDATE pengguna SET 
          saldo='$spengguna'-'$nominal' WHERE id='$id'");

            $result = mysqli_query($koneksi, "INSERT INTO pulsa VALUES(NULL, '1', 'pulsa', '$id', '$npengguna', '$hptujuan', '$nominal')");

            echo "<script>alert('Pulsa berhasil diisi.');</script>";
        }
        header("location: sbd_home.php?id=" . $pecah['id']);
    }
    else
    {
        echo "Tidak terdapat pengguna yang memiliki no HP tersebut!";
        die;
    }
}
?>
	</body>

	</html>