<?php
	include "config/konfigurasi.php";
	require("config/fungsi_thn.php");
	if(isset($_POST['user'], $_POST['pass'])) 
	{
		$tgl=date('Y-m-d H:i:s');		
		$user = $conn->real_escape_string($_POST['user']);
		$passz = $conn->real_escape_string($_POST['pass']);
		$qth=$conn->query("SELECT idthpel FROM tbthpel WHERE aktif='1'");
		$th=$qth->fetch_array();

		$qsk=$conn->query("SELECT idskul FROM tbskul");
		$sk=$qsk->fetch_array();

		$qgtk = $conn->query("SELECT*FROM tbuser WHERE username = '$user' AND passwd = PASSWORD('$passz')");
		$cek=$qgtk->num_rows;
		if($cek>0)
		{
			$row=$qgtk->fetch_array();
			setcookie('c_user',$row['username']);
			setcookie('c_login',$row['level']);
			setcookie('c_skul',$sk['idskul']);
			setcookie('c_tahun',$th['idthpel']);
			$sql = $conn->query("UPDATE tbuser SET xlog='$tgl' WHERE username='$user'");
			echo 1;	
		}
		else{
			
			echo 0;
		}			
	}
	else {header("Location: login.php");}
?>