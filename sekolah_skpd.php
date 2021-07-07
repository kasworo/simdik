<?php
include "../config/konfigurasi.php";
$uploaddir = '../images/'; 
$namafile = basename($_FILES['uploadskpd']['name']);
$file = $uploaddir . basename($_FILES['uploadskpd']['name']); 
 if (move_uploaded_file($_FILES['uploadskpd']['tmp_name'], $file)) { 
$sql = mysqli_query($sqlconn,"update tb_skul set logoskpd = '$namafile'");
  echo "success"; 
} else {
	echo "error";
}

?>