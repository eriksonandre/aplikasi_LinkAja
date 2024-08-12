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
	<title>Riwayat</title>
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

<!--Konten-->
<div class="container">
	<div style="height: 12px;"></div>
	<div class="col-md-20">
		<div style="height: 370px;">
		<table class="table table-hover table-striped">
			<thead class="thead-dark">
				<tr>
					<th class="align-middle text-center" scope="col">Kategori</th>
					<th class="align-middle text-center" scope="col">Nominal</th>
					<th class="align-middle text-center" scope="col">Waktu</th>
					<th class="align-middle text-center" colspan="2">Aksi</th>
				</tr>
			</thead>
				<tbody>
				<?php echo "string";
?>

				<?php
				$batas = 5;
				$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
				$page_awal = ($page > 1) ? ($page * $batas) - $batas : 0;

				$sebelum = $page - 1;
				$sesudah = $page + 1;

				$data = mysqli_query($koneksi, "SELECT * FROM riwayat");
				$jumlah_data = mysqli_num_rows($data);
				$total_halaman = ceil($jumlah_data / $batas);

				$no = $page_awal + 1;
					
				$ambil = $koneksi->query("SELECT * FROM riwayat LIMIT $page_awal,$batas");

				while ($pecah = mysqli_fetch_array($ambil)) { ?>
					<tr>
						<td class="align-middle text-center"><?php echo $no++; ?></td>
						<td class="align-middle"><?php echo $pecah['kategori']; ?></td>
						<td class="align-middle text-center"><?php echo $pecah['nominal']; ?></td>
						<td class="align-middle text-center"><?php echo $pecah['waktu']; ?></td>
						<td><a class="btn btn-danger" onclick="return confirm('Apakah Anda yakin akan menghapus data obat ini?')" href="./hapus1.php?id=<?php echo $pecah['id_obat']; ?>">
						<svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-trash" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
						<path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
						<path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4L4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
						</svg> Hapus</a></td>
					</tr>
				<?php } ?>
			</tbody>
		</table>
		</div>
		<div style="height: 90px;">
			<table>
			<tr>	
				<td width="700px" style="text-align:center">
					<center><nav>
					<ul class="pagination justify-content-center">
					<li class="page-item">
						<a class="page-link" <?php if ($page > 1) {
													echo "href='?page=$sebelum'";
												} ?>>Previous</a>
					</li>
					<?php
					for ($x = 1; $x <= $total_halaman; $x++) {
					?>
						<li class="page-item"><a class="page-link" href="?page=<?php echo $x ?>"><?php echo $x; ?></a></li>
					<?php
					}
					?>
					<li class="page-item">
						<a class="page-link" <?php if ($page < $total_halaman) {
													echo "href='?page=$sesudah'";
												} ?>>Next</a>
					</li>
					</ul>
					</nav></center>
				</td>
			</tr>
			</table>
		</div>	
	</div>
</div>
<br/>