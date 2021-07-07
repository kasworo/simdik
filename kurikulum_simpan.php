<?php
	include "../config/konfigurasi.php";
	if($_POST['aksi']=='simpan'){
		
		$qcek=$conn->query("SELECT*FROM tbkurikulum WHERE akkur='$_POST[akkurikulum]'");
		$cek=mysqli_num_rows($qcek);
		if($cek==0)
		{
			$sql=$conn->query("INSERT INTO tbkurikulum (nmkur, akkur) VALUES ('$_POST[nmkurikulum]','$_POST[akkurikulum]')");
				echo 'Simpan Kurikulum Berhasil!';
		}
		else
		{
			$sql=$conn->query("UPDATE tbkurikulum SET nmkur= '$_POST[nmkurikulum]', akkur='$_POST[akkurikulum]' WHERE akkurikulum='$_POST[akkurikulum]'");
			echo 'Update Kurikulum Berhasil!';
		}
	}

    if($_POST['aksi']=='kosong'){
		$sql=$conn->query("TRUNCATE tbkurikulum");
		echo 'Hapus Kurikulum Berhasil!';
	}
	if($_POST['aksi']=='hapus'){
        $sql=$conn->query("DELETE FROM tbkurikulum WHERE idkur='$_POST[id]'");
		echo 'Hapus Kurikulum Berhasil!';
	}
?>