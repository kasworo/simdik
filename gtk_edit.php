<?php
	include "config/konfigurasi.php";
	include "config/function_gtk.php";
	$id=$_POST['id'];
	$qm="SELECT*FROM tbgtk WHERE idgtk='$id'";
	$data=cekgtk($qm);
	if($data==0){
		$dir='assets/img/';
		$foto='avatar.gif';
		$fotolama='';
		$rows=array(
			
			'idgtk'=>'',
			'nama'=>'',
			'nik'=>'',
			'nip'=>'',
			'tmplahir' =>'',
			'tgllahir' =>'',
			'gender' =>'',
			'agama' =>'',
			'kepeg'=>'',
			'jbtd'=>'',
			'email' =>'',
			'alamat' =>'',
			'desa' =>'',
			'kec' =>'',
			'kab' =>'',
			'prov' =>'',
			'kdpos' =>'',
			'nohp' => $m['nohp'],
			'foto'=>$foto,
			'fotolama'=>$fotolama,
			'dir'=>$dir
		);
	}
	else {
		$row=viewgtk($qm);
		foreach ($row as $m){
			if($m['foto']==''){
				$dir='assets/img/';
				$foto='avatar.gif';
				$fotolama='';
			}
			else {
				if(file_exists('foto/'.$m['foto'])){
					$dir='foto/';
					$foto=$m['foto'];
					$fotolama=$m['foto'];
				}
				else {
					$dir='assets/img/';
					$foto='avatar.gif';
					$fotolama='';
				}

			}
			$rows=[
				'idgtk'=>$m['idgtk'],
				'nama'=>$m['nama'],
				'nik'=>$m['nik'],
				'nip'=>$m['nip'],
				'tmplahir' => $m['tmplahir'],
				'tgllahir' => $m['tgllahir'],
				'gender' => $m['gender'],
				'agama' => $m['agama'],
				'kepeg'=>$m['kepeg'],
				'jbtd'=>$m['jbtdinas'],
				'email' => $m['email'],
				'alamat' => $m['alamat'],
				'desa' => $m['desa'],
				'kec' => $m['kec'],
				'kab' => $m['kab'],
				'prov' => $m['prov'],
				'kdpos' => $m['kdpos'],
				'nohp' => $m['nohp'],
				'foto'=>$foto,
				'fotolama'=>$fotolama,
				'dir'=>$dir			
			];
		}
	}
	echo json_encode($rows);
?>