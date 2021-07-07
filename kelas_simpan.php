<?php
	include "config/konfigurasi.php";
	if($_POST['aksi']=='1'){
		$qcek=$conn->query("SELECT*FROM tbrombel WHERE idrombel='$_POST[id]'");
		$cek=mysqli_num_rows($qcek);
		if($cek==0){
			
			$sql=$conn->query("INSERT INTO tbrombel (idkelas, nmrombel, idthpel, idkur, idgtk) VALUES ('$_POST[kdkls]', '$_POST[nmrombel]', '$_COOKIE[c_tahun]', '$_POST[idkur]', '$_POST[walas]')");
			echo 'Simpan Rombongan Belajar Berhasil!';
		}
		else{
			$sql=$conn->query("UPDATE tbrombel SET idkur='$_POST[idkur]', idgtk='$_POST[walas]', nmrombel= '$_POST[nmrombel]' WHERE idrombel='$_POST[id]'");
			echo 'Update Rombongan Belajar Berhasil!';
		}
	}	
	if($_POST['aksi']=='2'){
		$sql=$conn->query("DELETE FROM tbrombel WHERE idrombel='$_POST[id]'");
		echo 'Hapus Rombongan Belajar Berhasil!';
	}
	if($_POST['aksi']=='3'){
		$sql=$conn->query("TRUNCATE tbrombel");
		echo 'Hapus Rombongan Belajar Berhasil!';
	}
?>