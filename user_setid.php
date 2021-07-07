<?php
	include "config/konfigurasi.php";
	if(isset($_GET['id'])){
		$qsis=$conn->query("SELECT passwd FROM tbuser WHERE username='$_GET[id]'");
		$s=$qsis->fetch_array();
		echo $s['passwd'];
	}
	
?>