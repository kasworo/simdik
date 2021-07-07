<?php
	if(!isset($_COOKIE['c_user'])){header("Location: login.php");}
	include "../config/konfigurasi.php";
	if($_POST['aksi']=='simpan'){
		$qcek=$conn->query("SELECT*FROM tbpengampu WHERE (idampu='$_POST[id]' AND idthpel='$_COOKIE[c_tahun]') OR (idmapel='$_POS[mp]' AND username='$_POST[guru]')");
		$cek=$qcek->num_rows;
		if($cek==0){
			$sql=$conn->query("INSERT INTO tbpengampu(idrombel, idmapel, username, idthpel) VALUES ('$_POST[rm]','$_POST[mp]','$_POST[gr]','$_COOKIE[c_tahun]')");
			echo 'Simpan Data Pembelajaran Berhasil!';
		}
		else {
			$sql=$conn->query("UPDATE tbpengampu SET idrombel='$_POST[rm]', idmapel='$_POST[mp]', username='$_POST[gr]' WHERE idampu='$_POST[id]' AND idthpel='$_COOKIE[c_tahun]'");
			echo 'Update Data Pengampu Berhasil!';
		}
	}

	if($_POST['aksi']=='salin'){
		$qcek=$conn->query("SELECT*FROM tbpengampu WHERE idthpel='$_COOKIE[c_tahun]' AND idrombel='$_POST[idra]'");
		$cek=$qcek->num_rows;
		if($cek>0){
			while($sa=$qcek->fetch_array())
			{
				$sql=$conn->query("INSERT INTO tbpengampu(idrombel, idmapel, username, idthpel) VALUES ('$_POST[idrt]','$sa[idmapel]','$sa[username]','$sa[idthpel]')");
			}
			echo 'Simpan Data Pembelajaran Berhasil!';
		}
		else {
			echo "Data Pembelajaran Asal Belum Ada";
		}
	}

	if($_POST['aksi']=='hapus'){
		$sql=$conn->query("DELETE FROM tbpengampu WHERE idampu='$_POST[id]'");
		echo 'Hapus Data Pembelajaran Berhasil!';
	}

	if($_POST['aksi']=='kosong'){
		$sql=$conn->query("TRUNCATE tbpengampu");
		echo 'Hapus Semua Data Pembelajaran Berhasil!';
	}	
?>