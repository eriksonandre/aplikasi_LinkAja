<?php
  include "connection.php";
?>
<?php
  $id = $_GET['id'];
  $ambil = $koneksi->query("SELECT * FROM pengguna WHERE id='$id'");
  $pecah = $ambil->fetch_assoc();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Profil Saya</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css">
</head>

<body>
	<!--Navbar-->
<?php
include 'navbar.php';
?>
<br><br><br><br>

<div class="container">
  <form method="post" class="profilform" enctype="multipart/form-data">
    <div class="form-group">
       <label for="username">Nama Pengguna</label>
       <div class="input-group mb-3">
		     <div class="input-group-prepend"> <span class="input-group-text" id="basic-addon1"><i class="fas fa-user-alt"></i></span></div>
         <input class="form-control" required type="text" placeholder="<?php echo $pecah['nama']; ?>" name="pengguna" value="<?php echo $pecah["nama"]; ?>">
      </div>
    </div>
    <div class="form-group">
      <label for="pengguna">Email</label>
      <div class="input-group mb-3">
		    <div class="input-group-prepend"> <span class="input-group-text" id="basic-addon1"><i class="fas fa-envelope"></i></span></div>
        <input class="form-control" required type="text" placeholder="<?php echo $pecah['email']; ?>" name="email" value="<?php echo $pecah["email"]; ?>">
      </div>
    </div>
    <div class="form-group">
      <label for="no.hp">No.HP Pengguna</label>
      <div class="input-group mb-3">
		    <div class="input-group-prepend"><span class="input-group-text" id="basic-addon1"><i class="fas fa-mobile"></i></span></div>
        <input class="form-control" maxlength=15 minlength=10 required type="text" placeholder="<?php echo $pecah['nohp']; ?>" name="no_hp" value="<?php echo $pecah["nohp"]; ?>">
      </div>
    </div>
    <p>
    </p>
    <div class="d-flex justify-content-between">
      <button type="submit" class="btn btn-warning" name="btn_update">Update</button>
      <a href="sbd_home.php?id=<?php echo $pecah['id']; ?>" class="btn btn-primary">Kembali</a>
    </div>
      <div class="mt-5 float-right">
        <a href="changepass.php?id=<?php echo $pecah['id']; ?>">Ubah Password</a>
      </div>
      </div>
    </div>     
  </form> 
</div>
<?php
  if (isset($_POST['btn_update'])) {
    $namabaru = $_POST['pengguna'];
    $emailbaru = $_POST['email'];
    $nohpbaru = $_POST['no_hp'];
    $idprofil = $pecah['id'];

    // Apabila satuan dan tgl_exp diubah
    if (!empty($namabaru) && !empty($emailbaru) && !empty($nohpbaru)) {
      $result = mysqli_query($koneksi, "UPDATE pengguna SET 
      nama='$namabaru', email='$emailbaru', nohp='$nohpbaru' 
      WHERE id='$idprofil'");
    }
    if (!$result) {
      die('Query error : ' . mysqli_errno($koneksi) . ' - ' . mysqli_error($koneksi));
    }

    echo "<script>alert('Data profil berhasil diperbarui!');</script>";

  }
?>


</body>
</html>