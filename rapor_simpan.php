<?php
	include "config/function_nilai.php";
	$nilai=array(
		'id'=>$_POST['id'],
		'th'=>$_POST['th'],
		'mp'=>$_POST['mp'],
		'nil'=>$_POST['nil'],
		'as'=>$_POST['as'],
		'des'=>$_POST['des']
	);
	$sql="SELECT*FROM tbnilairapor WHERE idsiswa='$_POST[id]' AND idmapel='$_POST[mp]' AND idthpel='$_POST[th]' AND aspek='$_POST[as]'";
	$ceknilai=ceknilai($sql);
	if($ceknilai>0){
		if(isinilai($nilai,2)>0){
			$pesan="Data Nilai Berhasil Diupdate!";
		}
		else{
			return false;
		}
	}
	else {
		if(isinilai($nilai,1)>0){
			$pesan="Data Nilai Berhasil Diupdate!";
		}
		else{
			return false;
		}
	}
	
	echo $pesan;
	
?>