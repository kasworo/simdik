<?php
	include "../config/konfigurasi.php";
	if($_REQUEST['aksi']=='simpan')
	{
		if($_REQUEST['jns']=='1'){$jns='Spiritual';} else {$jns='Sosial';}
		$qtp=mysqli_query($sqlconn, "SELECT nmthpel FROM tb_thpel WHERE idthpel='$_REQUEST[thpel]'");
		$t=mysqli_fetch_array($qtp);
		$nmthpel=$t['nmthpel'];
        
        $cek=mysqli_num_rows(mysqli_query($sqlconn, "SELECT*FROM tb_sikap WHERE idsiswa='$_REQUEST[id]'  AND idthpel='$_REQUEST[thpel]' AND aspek='$_REQUEST[jns]'"));
		if($cek>0)
		{
			$sql=mysqli_query($sqlconn, "UPDATE tb_sikap SET nilai ='$_REQUEST[nilai]' WHERE idsiswa='$_REQUEST[id]' AND idthpel='$_REQUEST[thpel]'  AND aspek='$_REQUEST[jns]'");
			echo 'Update Nilai '.$jns.' '.$nmthpel.' Berhasil!';
		}
		else
		{
			$sql=mysqli_query($sqlconn, "INSERT INTO tb_sikap (idthpel, idsiswa, nilai, aspek) VALUES ('$_REQUEST[thpel]', '$_REQUEST[id]', '$_REQUEST[nilai]',  '$_REQUEST[jns]')");
			echo 'Simpan Nilai '.$jns.' '.$nmthpel.' Berhasil!';
		}		
	}	
?>