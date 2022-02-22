<?php
include "dbfunction.php";
$id = $_POST['id'];
if (isset($_POST['d'])) {
	$data = cekdata('tbsiswa', array('idsiswa' => $id));
	if ($data == 0) {
		$dir = 'assets/img/';
		$foto = 'avatar.gif';
		$fotolama = '';
		$rows = array(
			'idsiswa' => '',
			'nmsiswa' => '',
			'nik' => '',
			'nis' => '',
			'nisn' => '',
			'tmplahir' => '',
			'tgllahir' => '',
			'gender' => '',
			'agama' => '',
			'anake' => '',
			'sdr' => '',
			'warganegara' => '',
			'goldarah' => '',
			'rwysakit' => '',
			'kebkhusus' => '',
			'ikuts' => '',
			'transpr' => '',
			'jarak' => '',
			'waktu' => '',
			'alamat' => '',
			'desa' => '',
			'kec' => '',
			'kab' => '',
			'prov' => '',
			'kdpos' => '',
			'lintang' => '',
			'bujur' => '',
			'nohp' => '',
			'hobi1' => '',
			'hobi2' => '',
			'hobi3' => '',
			'hobi4' => '',
			'foto' => $foto,
			'fotolama' => $fotolama,
			'dir' => $dir,
			'judul' => 'Tambah Data Peserta Didik',
			'tmbl' => '<i class="fas fa-save"></i> Simpan'
		);
	} else {
		$m = viewdata('tbsiswa', array('idsiswa' => $id))[0];
		if ($m['fotosiswa'] == '') {
			$dir = 'assets/img/';
			$foto = 'avatar.gif';
			$fotolama = '';
		} else {
			$dir = 'foto/';
			$foto = $m['fotosiswa'];
			$fotolama = $m['fotosiswa'];
		}
		$rows = array(
			'idsiswa' => $m['idsiswa'],
			'nmsiswa' => ucwords(strtolower($m['nmsiswa'])),
			'nik' => $m['nik'],
			'nis' => $m['nis'],
			'nisn' => $m['nisn'],
			'tmplahir' => $m['tmplahir'],
			'tgllahir' => $m['tgllahir'],
			'gender' => $m['gender'],
			'agama' => $m['idagama'],
			'anake' => $m['anake'],
			'sdr' => $m['sdr'],
			'warganegara' => $m['warganegara'],
			'goldarah' => $m['goldarah'],
			'rwysakit' => $m['rwysakit'],
			'kebkhusus' => $m['kebkhusus'],
			'ikuts' => $m['ikuts'],
			'transpr' => $m['transpr'],
			'jarak' => $m['jarak'],
			'waktu' => $m['waktu'],
			'alamat' => $m['alamat'],
			'desa' => $m['desa'],
			'kec' => $m['kec'],
			'kab' => $m['kab'],
			'prov' => $m['prov'],
			'kdpos' => $m['kdpos'],
			'lintang' => $m['lintang'],
			'bujur' => $m['bujur'],
			'nohp' => $m['nohp'],
			'hobi1' => $m['hobi1'],
			'hobi2' => $m['hobi2'],
			'hobi3' => $m['hobi3'],
			'hobi4' => $m['hobi4'],
			'foto' => $foto,
			'fotolama' => $fotolama,
			'dir' => $dir,
			'judul' => 'Update Data Peserta Didik',
			'tmbl' => '<i class="fas fa-save"></i> Update'
		);
	}
} else {
	if ($_POST['j'] == '1') {
		$hubkel = '1';
		$keys = array('idsiswa' => $id, 'hubkel' => $hubkel);
		$deshubkel = 'Ayah Kandung';
		$data = cekdata('tbortu', $keys);
		if ($data == 0) {
			$pesan = 'Tambah Data ' . $deshubkel . ' Peserta Didik';
			$tmb = '<i class="fas fa-save"></i> Simpan';
			$rows = array(
				'nmortu' => '',
				'nik' => '',
				'tmplahir' => '',
				'tgllahir' => '',
				'idagama' => '',
				'idpddk' => '',
				'wafat' => '',
				'idkerja' => '',
				'idhsl' => '',
				'hubkel' => $hubkel,
				'alamat' => '',
				'desa' => '',
				'kec' => '',
				'kab' => '',
				'prov' => '',
				'kdpos' => '',
				'nohp' => '',
				'tmbl' => $tmb,
				'psn' => $pesan
			);
		} else {
			$pesan = 'Update Data ' . $deshubkel . ' Peserta Didik';
			$tmb = '<i class="fas fa-save"></i> Update';
			$m = viewdata('tbortu', $keys)[0];
			$rows = array(
				'nmortu' => $m['nmortu'],
				'nik' => $m['nik'],
				// 'tmplahir'=>$m['tmplahir'],
				// 'tgllahir'=>$m['tgllahir'],
				'idagama' => $m['idagama'],
				'idpddk' => $m['idpddk'],
				'idkerja' => $m['idkerja'],
				'idhsl' => $m['idhsl'],
				'wafat' => $m['wafat'],
				'hubkel' => $m['hubkel'],
				'alamat' => $m['alamat'],
				'desa' => $m['desa'],
				'kec' => $m['kec'],
				'kab' => $m['kab'],
				'prov' => $m['prov'],
				'kdpos' => $m['kdpos'],
				'nohp' => $m['nohp'],
				'tmbl' => $tmb,
				'psn' => $pesan
			);
		}
	} else if ($_POST['j'] == '2') {
		$hubkel = '2';
		$keys = array('idsiswa' => $id, 'hubkel' => $hubkel);
		$deshubkel = 'Ibu Kandung';
		$data = cekdata('tbortu', $keys);
		if ($data == 0) {
			$pesan = 'Tambah Data ' . $deshubkel . ' Peserta Didik';
			$tmb = '<i class="fas fa-save"></i> Simpan';
			$rows = array(
				'nmortu' => '',
				'nik' => '',
				'tmplahir' => '',
				'tgllahir' => '',
				'idagama' => '',
				'idpddk' => '',
				'wafat' => '',
				'idkerja' => '',
				'idhsl' => '',
				'hubkel' => $hubkel,
				'alamat' => '',
				'desa' => '',
				'kec' => '',
				'kab' => '',
				'prov' => '',
				'kdpos' => '',
				'nohp' => '',
				'tmbl' => $tmb,
				'psn' => $pesan
			);
		} else {
			$pesan = 'Update Data ' . $deshubkel . ' Peserta Didik';
			$tmb = '<i class="fas fa-save"></i> Update';
			$m = viewdata('tbortu', $keys)[0];
			$rows = array(
				'nmortu' => $m['nmortu'],
				'nik' => $m['nik'],
				// 'tmplahir'=>$m['tmplahir'],
				// 'tgllahir'=>$m['tgllahir'],
				'idagama' => $m['idagama'],
				'idpddk' => $m['idpddk'],
				'idkerja' => $m['idkerja'],
				'idhsl' => $m['idhsl'],
				'wafat' => $m['wafat'],
				'hubkel' => $m['hubkel'],
				'alamat' => $m['alamat'],
				'desa' => $m['desa'],
				'kec' => $m['kec'],
				'kab' => $m['kab'],
				'prov' => $m['prov'],
				'kdpos' => $m['kdpos'],
				'nohp' => $m['nohp'],
				'tmbl' => $tmb,
				'psn' => $pesan
			);
		}
	} else {
		$sql = "SELECT*FROM tbortu WHERE idsiswa='$id' AND hubkel<>'1' AND hubkel<>'2'";
		$data = cquery($sql);
		$deshubkel = 'Wali';
		if ($data == 0) {
			$pesan = 'Tambah Data ' . $deshubkel . ' Peserta Didik';
			$tmb = '<i class="fas fa-save"></i> Simpan';
			$rows = array(
				'nmortu' => '',
				'nik' => '',
				'tmplahir' => '',
				'tgllahir' => '',
				'idagama' => '',
				'idpddk' => '',
				'wafat' => '',
				'idkerja' => '',
				'idhsl' => '',
				'hubkel' => $hubkel,
				'alamat' => '',
				'desa' => '',
				'kec' => '',
				'kab' => '',
				'prov' => '',
				'kdpos' => '',
				'nohp' => '',
				'tmbl' => $tmb,
				'psn' => $pesan
			);
		} else {
			$pesan = 'Update Data ' . $deshubkel . ' Peserta Didik';
			$tmb = '<i class="fas fa-save"></i> Update';
			$m = vquery($sql)[0];
			$rows = array(
				'nmortu' => $m['nmortu'],
				'nik' => $m['nik'],
				// 'tmplahir'=>$m['tmplahir'],
				// 'tgllahir'=>$m['tgllahir'],
				'idagama' => $m['idagama'],
				'idpddk' => $m['idpddk'],
				'idkerja' => $m['idkerja'],
				'idhsl' => $m['idhsl'],
				'wafat' => $m['wafat'],
				'hubkel' => $m['hubkel'],
				'alamat' => $m['alamat'],
				'desa' => $m['desa'],
				'kec' => $m['kec'],
				'kab' => $m['kab'],
				'prov' => $m['prov'],
				'kdpos' => $m['kdpos'],
				'nohp' => $m['nohp'],
				'tmbl' => $tmb,
				'psn' => $pesan
			);
		}
	}
}
echo json_encode($rows);