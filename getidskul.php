<?php
	include "config/konfigurasi.php";
	if (isset($_GET['p'])){
		$query = $conn->query("SELECT*FROM tbrayon WHERE idprov='$_GET[p]'");
		echo "<option selected value=''>..Pilih..</option>";
		while($d = $query->fetch_array())
		{
			echo "<option value='$d[idrayon]'>".substr($d['idrayon'],-2)." - $d[nmrayon]</option>";
		}
	}
?>