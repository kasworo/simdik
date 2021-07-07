<?php
	include "config/function_user.php";
	
	if($_POST['aksi']=='1' && $_POST['lev']=='2'){
		$sql=$conn->query("SELECT idgtk, nama, tgllahir FROM tbgtk");
		while($us=$sql->fetch_array()){
			$user='G'.substr(getskul(),-8).substr('000'.$us['idgtk'],-3);
			$nama=$us['nama'];
			$pass=str_replace('-','',$us['tgllahir']);
			$guru= array(
				'nama' =>$nama,
				'user'=>$user,
				'paswd'=>$pass
			);
			if(adduser($guru,2)>0){
				$conn->query("UPDATE tbgtk SET username='$user' WHERE idgtk='$us[idgtk]'");
			}
			
		}		
	}
	else if($_POST['aksi']=='1' && $_POST['lev']=='3'){
		$sql=$conn->query("SELECT nmsiswa, nisn, tgllahir FROM tbsiswa WHERE deleted='0'");
		while($us=$sql->fetch_array()){
			$user=$us['nisn'];
			$nama=$us['nmsiswa'];
			$pass=str_replace('-','',$us['tgllahir']);
			$user= array(
				'nama' =>$nama,
				'user'=>$user,
				'paswd'=>$pass
			);
			if(adduser($user,3)>0){			
				$conn->query("UPDATE tbsiswa SET username='$user' WHERE nisn='$us[nisn]'");
			}
		}
		$pesan="Aktivasi Akun Siswa Berhasil";
	}

	if($_POST['aksi']=='2'){
		if(deluser()>0){
			$pesan="Tabel User Berhasil Dikosongkan!";
		}
	}
	echo $pesan;
?>