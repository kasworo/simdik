<?php
	include "dbfunction.php";
	$tgl=date('Y-m-d');
	if($_POST['aksi']=='simpan')
	{
		$sqlcek =$conn->query("SELECT*FROM tbgtk WHERE idgtk='$_POST[id]'");
		$cek=$sqlcek->num_rows;
		if($cek>0)
		{
			$sql = $conn->query("UPDATE tbgtk SET nama='$_POST[nama]', nip='$_POST[nip]', tmplahir='$_POST[tmplahir]', tgllahir='$_POST[tgllahir]', gender='$_POST[gender]', agama='$_POST[agama]',kepeg='$_POST[kepeg]', email='$_POST[email]', alamat='$_POST[almt]', desa='$_POST[desa]', kec='$_POST[kec]', kab='$_POST[kab]', prov='$_POST[prov]', kdpos='$_POST[kdpos]', nohp='$_POST[nohp]' WHERE idgtk='$_POST[id]'");
			echo "Update Data GTK Sukses!";
		
		} 
		else
		{
			$sql = $conn->query("INSERT INTO tbgtk (nama, nip, tmplahir, tgllahir, gender, agama, kepeg,email, alamat, desa, kec, kab, prov, kdpos, nohp) VALUES ('$_POST[nama]','$_POST[nip]','$_POST[tmplahir]','$_POST[tgllahir]','$_POST[gender]','$_POST[agama]','$_POST[kepeg]', '$_POST[email]','$_POST[almt]','$_POST[desa]','$_POST[kec]','$_POST[kab]','$_POST[prov]','$_POST[kdpos]','$_POST[nohp]')");
			echo "Tambah Data GTK Berhasil!";
		}
	}
?>