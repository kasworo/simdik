<?php
	function getuserid($id)  {
		include "config/konfigurasi.php";
			$qskul=$conn->query("SELECT kdskul FROM tbskul WHERE idskul='$_COOKIE[c_skul]'");
			$sk=$qskul->fetch_array();
			$kdskul=$sk['kdskul'];
			$userid='G'.substr($kdskul,-8).substr('00'.$id,-3);//.$cekdigit;
		   return $userid;
	}
	
	include "config/konfigurasi.php";
	if($_POST['aksi']=='simpan')
	{
		$update=0;
		$baru=0;
		if($_POST['lev']=='2'){
			$sql=$conn->query("SELECT idgtk, nama, tgllahir FROM tbgtk");
			while($us=$sql->fetch_array()){
				$user=getuserid($us['idgtk']);
				$nama=$us['nama'];
				$pass=str_replace('-','',$us['tgllahir']);
				$sqlcek =$conn->query("SELECT*FROM tbuser WHERE username='$user' OR nama='$nama'");
				$cek=$sqlcek->num_rows;
				if($cek==0){					
					$qusr = $conn->query("INSERT INTO tbuser (username, nama, passwd, level, aktif) VALUES ('$user','$nama', PASSWORD('$pass'),'$_POST[lev]','1')");
					$baru++;
				} 
				else {
					$qusr = $conn->query("UPDATE tbuser SET nama='$nama' WHERE username='$user'");
					$update++;
				}
				$qgtk=$conn->query("UPDATE tbgtk SET username='$user' WHERE idgtk='$us[idgtk]'");
			}
		}
		else{
			$sql=$conn->query("SELECT nmsiswa, nisn, tgllahir FROM tbsiswa WHERE deleted='0'");
			while($us=$sql->fetch_array()){
				$user=$us['nisn'];
				$nama=$conn->real_escape_string($us['nmsiswa']);
				$pass=$us['nis'];		
				$sqlcek =$conn->query("SELECT*FROM tbuser WHERE username='$user' OR nama='$nama'");
				$cek=$sqlcek->num_rows;
				if($cek==0){
					$qusr = $conn->query("INSERT INTO tbuser (username, nama, passwd, level, aktif) VALUES ('$user','$nama', PASSWORD('$pass'),'3','1')");
					$baru++;
				} 
				else {				
					$qusr= $conn->query("UPDATE tbuser SET nama='$nama', passwd=PASSWORD('$pass') WHERE username='$user'");
					$update++;	
				}
				$qgtk=$conn->query("UPDATE tbsiswa SET username='$user' WHERE nisn='$us[nisn]'");
			}
		}
		
		echo 'Ada '.$baru.' Pengguna Baru Berhasil Ditambahkan, '.$update.' Berhasil Diupdate';
	}
	if($_POST['aksi']=='kosong'){
		$sql=$conn->query("DELETE FROM tbuser WHERE level<>'1'");
		echo 'Data Pengguna Berhasil Dihapus, Silahkan Buat Akun Baru!';
	}
	if($_POST['aksi']=='pass'){
        $pwd=$_POST['passbaru'];
		$sql=mysqli_query($sqlconn,"UPDATE tbuser SET passwd=PASSWORD('$pwd') WHERE username='$_POST[id]'");
	   echo "Password Berhasil Diganti!";
	}
?>