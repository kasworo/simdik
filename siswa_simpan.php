<?php
	include "config/konfigurasi.php";
	if($_POST['aksi'] == '1'){
		$nmsiswa = addslashes($_POST['nama']);
		$id = base64_decode($_POST['id']);
		$qcek = $conn->query("SELECT*FROM tbsiswa WHERE idsiswa = '$id'");
		$cek = $qcek->num_rows;
		if($cek == 0){
			$sql = $conn->query("INSERT INTO tbsiswa (nmsiswa, nik, nis, nisn, tmplahir, tgllahir, gender, idagama, warganegara, anake, sdr, goldarah, kebkhusus, rwysakit, ikuts, jarak, waktu, transpr, alamat, desa, kec, kab, prov, kdpos, lintang, bujur, nohp, hobi1, hobi2, hobi3, hobi4, deleted, idskul) VALUES ('$nmsiswa', '$_POST[nik]','$_POST[nis]', '$_POST[nisn]', '$_POST[tmplahir]', '$_POST[tgllahir]', '$_POST[gender]', '$_POST[agama]', '$_POST[wni]', '$_POST[anak]', '$_POST[sdr]', '$_POST[gld]', '$_POST[keb]', '$_POST[skt]', '$_POST[ikt]', '$_POST[jrk]', '$_POST[wkt]', '$_POST[trans]', '$_POST[almt]', '$_POST[desa]', '$_POST[kec]', '$_POST[kab]', '$_POST[prov]', '$_POST[kdpos]', '$_POST[ltg]', '$_POST[bjr]', '$_POST[nohp]', '$_POST[olahrg]', '$_POST[seni]', '$_POST[orgns]', '$_POST[lain]', '0', '$_COOKIE[c_skul]')");
			echo 'Simpan Peserta Didik Berhasil!';
		}
		else{
			$sql="UPDATE tbsiswa SET nmsiswa = '$nmsiswa', nik = '$_POST[nik]', nis = '$_POST[nis]', nisn = '$_POST[nisn]', tmplahir = '$_POST[tmplahir]', tgllahir = '$_POST[tgllahir]', gender = '$_POST[gender]', idagama = '$_POST[agama]', warganegara = '$_POST[wni]', anake = '$_POST[anak]', sdr = '$_POST[sdr]', goldarah = '$_POST[gld]', rwysakit = '$_POST[skt]', kebkhusus = '$_POST[keb]', ikuts = '$_POST[ikt]', jarak = '$_POST[jrk]', waktu = '$_POST[wkt]', transpr = '$_POST[trans]', alamat = '$_POST[almt]', desa = '$_POST[desa]', kec = '$_POST[kec]', kab = '$_POST[kab]', prov = '$_POST[prov]', kdpos = '$_POST[kdpos]', lintang = '$_POST[ltg]', bujur = '$_POST[bjr]', nohp = '$_POST[nohp]', hobi1 = '$_POST[olahrg]', hobi2 = '$_POST[seni]', hobi3 = '$_POST[orgns]', hobi4 = '$_POST[lain]' WHERE idsiswa = '$id' AND idskul='$_COOKIE[c_skul]'";
			$query = $conn->query($sql);
			echo 'Update Peserta Didik Berhasil!';			
		}
	}
	
	if($_POST['aksi'] == '2'){		
		if($_POST['reg']=='1' || $_POST['reg']=='4'){
			$qth=$conn->query("SELECT awal FROM tbthpel WHERE idthpel='$_COOKIE[c_tahun]'");
			$th=$qth->fetch_array();
			$tgl=$th['awal'];
		}
		else{
			$tgl=date('Y-m-d');
		}
		$id = base64_decode($_POST['id']);
		$qsiswa=$conn->query("SELECT idthpel FROM tbsiswa WHERE idsiswa='$id'");
		$s=$qsiswa->fetch_array();
		$thmasuk=$s['idthpel'];
		$qregis=$conn->query("SELECT idjreg FROM tbregistrasi WHERE idsiswa='$id' AND idthpel='$thmasuk'");
		$r=$qregis->fetch_array();
		if($r['idjreg']=='2'){
			$qcek=$conn->query("SELECT*FROM tblulusdari WHERE idsiswa='$id'");
			$cek=$qcek->num_rows;
			if($cek==0){
				$sql=$conn->query("INSERT INTO tblulusdari (idsiswa,  idmitra, noijazah, tglijazah, lama) VALUES ('$id', '$_POST[asl]', '$_POST[noijz]', '$_POST[tglijz]', '$_POST[lama]')");
				$pesan='Simpan';
			}
			else {
				$sql=$conn->query("UPDATE tblulusdari SET idmitra='$_POST[asl]', noijazah='$_POST[noijz]', tglijazah=''$_POST[tglijz]'', lama='$_POST[lama]' WHERE idsiswa='$id'");
				$pesan='Update';
			}

			$qcek=$conn->query("SELECT*FROM tbmutasidari WHERE idsiswa='$id'");
			$cek=$qcek->num_rows;
			if($cek==0){
				$sql=$conn->query("INSERT INTO tbmutasidari (idsiswa,  idmitra, nosurat, tglsurat, alasan) VALUES ('$id', '$_POST[skul]', '$_POST[nosrt]', '$_POST[tglsrt]', '$_POST[sebab]')");
				$pesan='Simpan';
			}
			else {
				$sql=$conn->query("UPDATE tblulusdari SET idmitra='$_POST[skul]', nosurat='$_POST[nosrt]', tglsurat=''$_POST[tglsrt]'', alasan='$_POST[alasan]' WHERE idsiswa='$id'");
				$pesan='Update';
			}
		}
		else {
			$qcek=$conn->query("SELECT*FROM tblulusdari WHERE idsiswa='$id'");
			$cek=$qcek->num_rows;
			if($cek==0){
				$sql=$conn->query("INSERT INTO tblulusdari (idsiswa,  idmitra, noijazah, tglijazah, lama) VALUES ('$id', '$_POST[asl]', '$_POST[noijz]', '$_POST[tglijz]', '$_POST[lama]')");
				$pesan='Simpan';
			}
			else {
				$sql=$conn->query("UPDATE tblulusdari SET idmitra='$_POST[asl]', noijazah='$_POST[noijz]', tglijazah=''$_POST[tglijz]'', lama='$_POST[lama]' WHERE idsiswa='$id'");
				$pesan='Update';
			}
		}
		echo $pesan.' Data Riwayat Pendidikan Peserta Didik Berhasil';
	}
	
	if($_POST['aksi'] == '3'){		
		$id = base64_decode($_POST['id']);
		$namaortu = addslashes($_POST['nama']);
		if($_POST['hubkel']=='1' || $_POST['hubkel']=='2'){
			if($_POST['hubkel']=='1'){$sbg='Ayah Kandung';} else {$sbg='Ibu Kandung';}
			$qcek = $conn->query("SELECT*FROM tbortu WHERE idsiswa = '$id' AND hubkel='$_POST[hubkel]'");			
		}
		else {
			$sbg='Wali';
			$qcek = $conn->query("SELECT*FROM tbortu WHERE idsiswa = '$id' AND hubkel<>'1' OR hubkel<>'2'");
		}
		$cek = $qcek->num_rows;
		if($cek == 0){
			$sql = $conn->query("INSERT INTO tbortu (idsiswa, nmortu, nik, tmplahir, tgllahir, idagama, idpddk, idkerja, idhsl, hubkel, alamat, desa, kec, kab, prov, kdpos, nohp) VALUES ('$id', '$namaortu', '$_POST[nik]', '$_POST[tmplahir]', '$_POST[tgllahir]', '$_POST[agama]', '$_POST[pddk]', '$_POST[krj]', '$_POST[hsl]', '$_POST[hubkel]','$_POST[almt]', '$_POST[desa]', '$_POST[kec]', '$_POST[kab]', '$_POST[prov]', '$_POST[kdpos]', '$_POST[nohp]')");
			$pesan='Simpan Data '.$sbg.' Berhasil!';	
		}
		else{
			$sql = $conn->query("UPDATE tbortu SET nmortu = '$namaortu', nik = '$_POST[nik]', tmplahir = '$_POST[tmplahir]', tgllahir = '$_POST[tgllahir]', idagama = '$_POST[agama]', idpddk = '$_POST[pddk]', idkerja = '$_POST[krj]', idhsl = '$_POST[hsl]', hubkel='$_POST[hubkel]',alamat = '$_POST[almt]', desa = '$_POST[desa]', kec = '$_POST[kec]', kab = '$_POST[kab]', prov = '$_POST[prov]', kdpos = '$_POST[kdpos]', nohp = '$_POST[nohp]' WHERE idsiswa = '$id' AND hubkel='$_POST[hubkel]'");
			$pesan='Update Data '.$sbg.' Berhasil!';			
		}
		echo $pesan;
	}
	if($_POST['aksi'] == 'hapus'){
		$sql = $conn->query("DELETE FROM tbsiswa WHERE idsiswa = '$_POST[id]'");
		echo 'Hapus Peserta Didik Berhasil!';
	}

	if($_POST['aksi'] == 'kosong'){
		$sql = $conn->query("TRUNCATE tbsiswa");
		echo 'Hapus Peserta Didik Berhasil!';
	}
?>