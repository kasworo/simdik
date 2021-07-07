<?php
	if(!isset($_COOKIE['c_user'])){header("Location: login.php");}
	include "config/konfigurasi.php";
	if($_POST['aksi']=='1'){
		if($_POST['reg']=='1' || $_POST['reg']=='4'){
			$qth=$conn->query("SELECT awal FROM tbthpel WHERE idthpel='$_COOKIE[c_tahun]'");
			$th=$qth->fetch_array();
			$tgl=$th['awal'];
		}
		else{
			$tgl=date('Y-m-d');
		}
		$qcek=$conn->query("SELECT*FROM tbregistrasi WHERE idsiswa='$_POST[id]' AND idrombel='$_POST[rm]' AND idjreg='$_POST[reg]' AND idthpel='$_COOKIE[c_tahun]'");
		$cek=$qcek->num_rows;
		if($cek==0){
			$sql=$conn->query("INSERT INTO tbregistrasi(idsiswa, idrombel, idjreg, tglreg) VALUES ('$_POST[id]','$_POST[rm]','$_POST[reg]','$tgl')");
			echo 'Simpan Registrasi Peserta Didik Berhasil!';
		}
		else {
			$sql=$conn->query("UPDATE tbregistrasi rg INNER JOIN tbrombel rb USING(idrombel) SET rg.idrombel='$_POST[rm]', rg.idjreg='$_POST[reg]' WHERE rg.idsiswa='$_POST[id]' AND rb.idthpel='$_COOKIE[c_tahun]'");
			echo 'Update Registrasi Peserta Didik Berhasil!';
		}
	}

	if($_POST['aksi']=='2'){
		$sblm=$_COOKIE['c_tahun']-1;
		$skrg=$_COOKIE['c_tahun'];
		$qth=$conn->query("SELECT nmthpel, awal FROM tbthpel WHERE idthpel='$skrg'");
		$th=$qth->fetch_array();
		$tgl=$th['awal'];
		$nmth=$th['nmthpel'];
		if(substr($nmth,-1)=='2'){$reg='4';} else {$reg='3';}
		$sql=$conn->query("INSERT IGNORE INTO  tbregistrasi(idsiswa, idjreg, idthpel, idrombel, tglreg) SELECT idsiswa, '$reg', '$skrg', '$_POST[rb]', '$tgl' FROM tbregistrasiWHERE idthpel='$sblm' AND idrombel='$_POST[rl]'");
		$sql="";
		echo 'Simpan Registrasi Peserta Didik Berhasil!';	
	}
?>