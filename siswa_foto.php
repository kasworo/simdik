<?php
	include "../config/konfigurasi.php";	
	$uploaddir="foto/";
	$userid=sha1($_REQUEST['id']);
	$size=$_FILES['filefoto']['size'];
	$maxsize=1024*250;
	
	if($size<=$maxsize)
	{
		$namafile = basename($_FILES['filefoto']['name']);
		$file = $uploaddir. basename($namafile);
		if (move_uploaded_file($_FILES['filefoto']['tmp_name'], $file))
		{ 
			$nfoto=$uploaddir.$userid.".jpg";
			$nfhoto=$userid.".jpg";
			$sql = $conn->query("UPDATE tbsiswa SET foto = '$nfhoto' WHERE username='$_REQUEST[id]'"); 
			rename ($file, $nfoto);
			
			echo "success";	
		}
		else
		{
			echo "error";
		}
	}
	else{
		echo "error";
	}