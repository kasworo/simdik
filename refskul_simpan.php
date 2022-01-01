<?php
	if(!isset($_COOKIE['c_user'])){header("Location: login.php");}
	include "config/konfigurasi.php";
	$qcek=$conn->query("SELECT*FROM ref_skulmitra WHERE npsn='$_POST[npsn]'");
	$cek=$qcek->num_rows;
	if($cek==0){
		$sql=$conn->query("INSERT INTO ref_skulmitra(idjenjang, npsn, nmmitra, alamat) VALUES ('$_POST[idjen]','$_POST[npsn]','$_POST[nama]','$_POST[alamat]')");
		echo 'Simpan Sekolah Mitra Berhasil!';
	}
	else {
		$sql=$conn->query("UPDATE ref_skulmitra SET idjenjang='$_POST[idjen]', nmmitra='$_POST[nama]', alamat='$_POST[alamat]' WHERE npsn='$_POST[npsn]'");
		echo 'Update Sekolah Mitra Berhasil!';
	}
	
?>