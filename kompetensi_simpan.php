<?php
	if(!isset($_COOKIE['c_user'])){header("Location: login.php");}
	include "../config/konfigurasi.php";
	if($_POST['aksi']=='1'){
		$qcek=$conn->query("SELECT*FROM tbkompetensi WHERE idmapel='$_POST[map]' AND idkelas='$_POST[kls]' AND kodekd='$_POST[kode]'");
		$cek=mysqli_num_rows($qcek);
		if($cek==0){
			$sql=$conn->query("INSERT INTO tbkompetensi (idmapel, idkelas, semester,aspek, kodekd, kdlengkap, kdringkas, aktif) VALUES ('$_POST[map]','$_POST[kls]','$_POST[sms]','$_POST[asp]','$_POST[kode]', '$_POST[des]','$_POST[rks]', '0')");
			echo 'Simpan Kompetensi Berhasil!';
		}
		else{
			$sql=$conn->query("UPDATE tbkompetensi SET semester='$_POST[sms]',kdlengkap='$_POST[des]', kdringkas='$_POST[rks]' WHERE  idmapel='$_POST[map]' AND idkelas='$_POST[kls]' AND kodekd='$_POST[kode]'");
			echo 'Update Kompetensi Berhasil!';
		}
	}
?>