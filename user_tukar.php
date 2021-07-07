<?php
	include "config/konfigurasi.php";
	require("config/fungsi_thn.php");

if(isset($_POST['setname'], $_POST['setuser'])) 
{
    $tgl=date('Y-m-d H:i:s');		
	$user = $conn->real_escape_string($_POST['setname']);
	$passz = $conn->real_escape_string($_POST['setuser']);
	$qth=$conn->query("SELECT idthpel FROM tbthpel WHERE aktif='1'");
	$th=$qth->fetch_array();	
	$qskul=$conn->query("SELECT idskul FROM tbskul");
	$sk=$qskul->fetch_array();
	$qadm = $conn->query("SELECT*FROM tbuser WHERE username = '$user' AND passwd = '$passz'");
	$cek=$qadm->num_rows;
	if($cek>0)
	{
		$row=$qadm->fetch_array();
		setcookie('c_user',$row['username']);
		setcookie('c_login',$row['level']);
		setcookie('c_skul',$sk['idskul']);
		setcookie('c_tahun',$th['idthpel']);
		$sql = $conn->query("UPDATE tbuser SET xlog='$tgl' WHERE username='$user'");
        header("location:index.php?p=dashboard");
	}
	else {
		echo 0;
	}			
}
else {header("Location: login.php");}
?>