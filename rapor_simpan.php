<?php
	include "dbfunction.php";
	$key=array(
		'idsiswa'=>$_POST['id'],
		'idthpel'=>$_POST['th'],
		'idmapel'=>$_POST['mp'],
		'aspek'=>$_POST['as']
	);
	$ceknilai=cekdata('tbnilairapor',$key);
	if($ceknilai>0){
		if($_POST['m']=='1'){
			$nilai=array(
				'nilairapor'=>$_POST['nil'],
			);
		}
		if($_POST['m'] == '2'){
			$nilai=array(
				'predikat'=>$_POST['hrf']
			);
		}
		if($_POST['m'] == '3'){
			$nilai=array(
				'deskripsi'=>$_POST['des']
			);
		}		
		$editnilai=editdata('tbnilairapor',$nilai,'',$key);
		if($editnilai>0){
			$jns='3';
		}
		else {
			$jns='4';
		}
	}
	else {
		$nilai=array(
			'idsiswa'=>$_POST['id'],
			'idthpel'=>$_POST['th'],
			'idmapel'=>$_POST['mp'],
			'aspek'=>$_POST['as'],
			'nilairapor'=>$_POST['nil']
		);
		$tambahnilai=adddata('tbnilairapor',$nilai);		
		if($tambahnilai>0){
			$jns='1';
		}
		else {
			$jns='2';
		}
	}	
	echo $jns;
?>