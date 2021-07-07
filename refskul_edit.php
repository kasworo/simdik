<?php
	include "config/konfigurasi.php";
	$qm=$conn->query("SELECT*FROM ref_skulmitra");	
	$data=$qm->fetch_array();
	echo json_encode($data);
?>