<?php
  $koneksi = mysqli_connect("localhost", "root", "", "linkaja");
  if(mysqli_connect_errno())
  {  
  	echo "Failed" . mysqli_connect_error();
  }
?>
