<?php
	include "konfigurasi.php";
	$tahun = date('Y');
	$bulan = date('m');
	if($bulan>6 && $bulan<=12)
	{
		$tahun=$tahun;
		$semester='1';
		$nmsemester='Ganjil';
		$tgl = strtotime("07/01".$tahun);
		$awal = date('Y-m-d',$tgl);
	}
	else 
	{
		$tahun=$tahun-1;
		$semester='2';
		$nmsemester='Genap';
		$tgl = strtotime("01/01".$tahun);
		$awal = date('Y-m-d',$tgl);
	}	
	$tahun1 = $tahun+1;
	$tahune = substr($tahun1,2,2);
	$ay = $tahun.$semester;
	$nama = $tahun.'/'.$tahun1.'-'.$nmsemester;
	
	$sql=$conn->query("SELECT*FROM tbthpel WHERE nmthpel= '$ay'");		
	$cek=$sql->num_rows;
	if($cek==0)
	{
		$qupd = $conn->query("UPDATE tbthpel SET aktif = '0' WHERE aktif='1'");
		$qins = $conn->query("INSERT INTO tbthpel (nmthpel, desthpel, awal, aktif) VALUES ('$ay','$nama', '$awal', '1')");
	}

	function gettahun(){
		global $conn;
		$qthn=$conn->query("SELECT idthpel FROM tbthpel WHERE aktif='1'");
		$row=$qthn->fetch_array();
		$tahun=$row['idthpel'];
		return $tahun;
	}
?>