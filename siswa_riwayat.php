<?php 
    include "dbfunction.php";
	$ds=viewdata('tbsiswa',array('idsiswa'=>$_POST['id']))[0];
	$nmsiswa=$ds['nmsiswa'];
    if($_POST['d']=='1'){
		$data=cekdata('tbasalsd', array('idsiswa'=>$_POST['id']));
		if($data==0){
			$rows=array(
				'idsiswa'=>'',
				'aslsd' =>'',
				'noijz' =>'',
				'tglijz' =>'',
				'lamasd' =>'',
				'judul'=>'Input Riwayat a.n '.$nmsiswa,
				'tmbl'=>'<i class="fas fa-save"></i> Simpan'
			);
		}
		else {
			$m=viewdata('tbasalsd', array('idsiswa'=>$_POST['id']))[0];
			$rows=array(
				'idsiswa'=>$m['idsiswa'],
				'aslsd' =>$m['aslsd'],
				'noijz' =>$m['noijazah'],
				'tglijz' =>$m['tglijazah'],
				'lamasd' =>$m['lama'],
				'judul'=>'Update Riwayat a.n '.$nmsiswa,
				'tmbl'=>'<i class="fas fa-save"></i> Update'
			);
		}
	}
    else if($_POST['d']=='2'){
		$data=cekdata('tbmutasi', array('idsiswa'=>$_POST['id']));
		if($data==0){
			$rows=array(
				'idsiswa'=>'',
				'mutasi' =>'',
				'aslsmp' =>'',
				'nosrt' =>'',
				'tglsrt' =>'',
				'alasan' =>'',
				'judul'=>'Tambah Riwayat Mutasi a.n '.$nmsiswa,
				'tmbl'=>'<i class="fas fa-save"></i> Simpan'
			);
		}
		else {
			$m=viewdata('tbmutasi', array('idsiswa'=>$_POST['id']))[0];
				$rows=array(
					'idsiswa'=>$m['idsiswa'],
					'mutasi' =>$m['jnsmutasi'],
					'aslsmp' =>$m['aslkesmp'],
					'nosrt' =>$m['nosurat'],
					'tglsrt' =>$m['tglsurat'],
					'alasan' =>$m['alasan'],
					'judul'=>'Update Riwayat Mutasi a.n '.$nmsiswa,
					'tmbl'=>'<i class="fas fa-save"></i> Update'
				);
		}
	}
	echo json_encode($rows);
?>