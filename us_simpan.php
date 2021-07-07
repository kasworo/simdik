<?php
	session_start();
	include "../config/konfigurasi.php";
	if($_REQUEST['aksi']=='simpan')
	{
		$qmp=mysqli_query($sqlconn, "SELECT akmapel FROM tb_mapel WHERE idmapel='$_REQUEST[kdmapel]'");
		$m=mysqli_fetch_array($qmp);
		$nmmapel=$m['akmapel'];
		
		$cek=mysqli_num_rows(mysqli_query($sqlconn, "SELECT*FROM tbus WHERE idsiswa='$_REQUEST[id]' AND idthpel='$_SESSION[s_tahun]' AND idmapel='$_REQUEST[kdmapel]'"));
		if($cek>0)
		{
			$sql=mysqli_query($sqlconn, "UPDATE tbus SET nilai ='$_REQUEST[nilai]' WHERE idsiswa='$_REQUEST[id]' AND idthpel='$_SESSION[s_tahun]' AND idmapel='$_REQUEST[kdmapel]'");
			echo 'Update Nilai US untuk '.$nmmapel.' Berhasil!';
		}
		else
		{
			$sql=mysqli_query($sqlconn, "INSERT INTO tbus (idthpel, idsiswa, idmapel, nilai) VALUES ('$_SESSION[s_tahun]', '$_REQUEST[id]','$_REQUEST[kdmapel]','$_REQUEST[nilai]')");
			echo 'Simpan Nilai US untuk '.$nmmapel.' Berhasil!';
		}		
	}	
?>