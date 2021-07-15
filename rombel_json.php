<?php
	include "dbfunction.php";
	$sql="SELECT r.idsiswa, r.idjreg FROM tbregistrasi r INNER JOIN tbsiswa s USING(idsiswa) INNER JOIN tbrombel k USING(idrombel) WHERE r.idsiswa='$_POST[id]' AND k.idthpel='$_COOKIE[c_tahun]'";	
	$qcek=$conn->query($sql);	
	$cek=$qcek->num_rows;
	if($cek>0){
		$rg=$qcek->fetch_array();
		$regis=$rg['idjreg'];
		$judul='Edit Registrasi Peserta Didik';
		$tmb="<i class='fas fa-save'></i> Update";
		$qm=$conn->query("SELECT r.idsiswa, s.nmsiswa FROM tbregistrasi r INNER JOIN tbsiswa s USING(idsiswa) INNER JOIN tbrombel k USING(idrombel) WHERE s.deleted='0' AND s.idsiswa='$_POST[id]' AND k.idthpel='$_COOKIE[c_tahun]'");	
	}
	else{
		$judul='Registrasi Peserta Didik';
		$regis='';
		$tmb="<i class='fas fa-save'></i> Simpan";
		$sqm="SELECT s.idsiswa, s.nmsiswa FROM tbsiswa s WHERE s.deleted='0' AND s.idsiswa='$_POST[id]'";
		$qm=$conn->query($sqm);		
	}		
	$m=$qm->fetch_array();	
	$data = array(
		'idsiswa'=>$m['idsiswa'],
		'nmsiswa'=>ucwords(strtolower($m['nmsiswa'])),
		'regis'=>$regis,
		'tahun'=>$_COOKIE['c_tahun'],
		'judul'=>$judul,
		'tmb'=>$tmb
	);
	echo json_encode($data);
?>