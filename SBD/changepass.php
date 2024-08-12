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
	<title>Ganti Password Akun GOPAY</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  <link rel = "stylesheet" type = "text/css" 
   href = "css/login.css">
</head>

<body>
	<!--Navbar-->
<?php
  include "navbar.php";
?>
<br><br><br><br>

<div class="container">
  <form method="post" enctype="multipart/form-data">
    <div class="form-group">
       <label for="passwordlama">Password Lama</label>
      <input class="form-control" required type="password" placeholder="Masukkan Password Lama Anda" name="passwordlama">
    </div>
    <div class="form-group">
      <label for="passwordbaru">Password Baru</label>
      <input class="form-control" required type="password" placeholder="Masukkan Password Baru Anda" name="passwordbaru" >
    </div>
    <div class="form-group">
      <label for="passwordbaru2">Konfirmasi Password Baru</label>
      <input class="form-control" required type="password" placeholder="Ulangi Password Baru Anda" name="passwordbaru2" d>
    </div>
   <button type="submit" class="btn btn-primary" style="width: 200px;" name="btnchangepass">Ganti</button>
  </form>
</div>

<?php
  if(isset($_POST['btnchangepass'])) 
  { $pass_lama = $_POST['passwordlama'];
    $pass_baru = $_POST['passwordbaru'];
    $pass_baru2 = $_POST['passwordbaru2'];
    $idprofil = $pecah['id'];
    $pass_tes = $pecah['password'];

        //Jika password sama
    if ($pass_tes == $pass_lama) 
    { if ($pass_baru != $pass_lama)
      { if ($pass_baru == $pass_baru2)
        { $result = mysqli_query($koneksi, "UPDATE pengguna SET 
          password='$pass_baru' WHERE id='$idprofil'");

          echo "<script>alert('Password Anda berhasil diperbarui!');</script>";

          header("location: sbd_home.php?id=".$pecah['id']);
        }
        else
        { echo "<script>alert('Kedua password baru Anda tidak sesuai!');</script>";
        }
      }
      else
      { echo "<script>alert('Password baru Anda tidak boleh sama dengan password baru!');</script>";
      }        
    }
    else {
      echo "<script>alert('Password lama Anda salah!');</script>";
    }
  }  
          // echo "<script>alert('Data profil berhasil diperbarui!');</script>";
  
          // header("location: sbd_home.php?id=".$pecah['id']);

?>
</body>
</html>