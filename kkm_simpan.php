<?php
	if(!isset($_COOKIE['c_user'])){header("Location: login.php");}
	include "../config/konfigurasi.php";
	if($_POST['aksi']=='simpan'){
		$qcek=$conn->query("SELECT*FROM tbkkm WHERE idmapel='$_POST[id]' AND idkelas='$_POST[kls]' AND idthpel='$_COOKIE[c_tahun]'");
		$cek=mysqli_num_rows($qcek);
		if($cek==0){
			$sql=$conn->query("INSERT INTO tbkkm (idmapel, idkelas, idthpel,kkm) VALUES ('$_POST[id]','$_POST[kls]','$_COOKIE[c_tahun]','$_POST[kkm]')");
			echo 'Simpan KKM Berhasil!';
		}
		else{
			$sql=$conn->query("UPDATE tbkkm SET kkm='$_POST[kkm]' WHERE idmapel='$_POST[id]' AND idkelas='$_POST[kls]' AND idthpel='$_COOKIE[c_tahun]'");
			echo 'Update KKM Berhasil!';
		}
	}
	
	if($_POST['aksi']=='salin'){
		$sql=$conn->query("INSERT INTO tbkkm (idmapel, idkelas, kkm, idthpel) SELECT idmapel, idkelas, kkm, '$_POST[tuju]' FROM tbkkm WHERE idthpel='$_POST[asal]'");
		echo 'Salin KKM Berhasil!';
	}

	if($_POST['aksi']=='kosong'){
		$sql=$conn->query("DELETE FROM tbkkm WHERE idthpel='$_COOKIE[c_tahun]'");
		echo 'Hapus Data KKM Berhasil!';
	}
?>