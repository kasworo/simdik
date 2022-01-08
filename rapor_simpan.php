<?php
	include "dbfunction.php";
	$key=array(
		'idsiswa'=>$_POST['id'],
		'idthpel'=>$_POST['th'],
		'idmapel'=>$_POST['mp'],
		'aspek'=>$_POST['as']
	);
	$ceknilai=cekdata('tbnilairapor',$key);
	//var_dump($ceknilai);die;
	if($ceknilai>0){
		$nilai=array(
			'nilairapor'=>$_POST['nil'],
			'predikat'=>$_POST['hrf'],			
			'deskripsi'=>$_POST['des']
		);
		$editnilai=editdata('tbnilairapor',$nilai,'',$key);
		if($editnilai>0){
			$pesan="Data Nilai Berhasil Diupdate!";
		}
		else {
			return false;
		}
	}
	else {
		$nilai=array(
			'idsiswa'=>$_POST['id'],
			'idthpel'=>$_POST['th'],
			'idmapel'=>$_POST['mp'],
			'aspek'=>$_POST['as'],
			'nilairapor'=>$_POST['nil'],
			'predikat'=>$_POST['hrf'],			
			'deskripsi'=>$_POST['des']
		);
		$tambahnilai=adddata('tbnilairapor',$nilai);
		if($tambahnilai>0){
			$pesan="Data Nilai Berhasil Diupdate!";
		}
		else{
			return false;
		}
	}	
	echo $pesan;
?>