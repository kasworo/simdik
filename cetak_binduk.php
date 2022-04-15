<?php
session_start();
if (!isset($_SESSION['login'])) {
	header("Location: login.php");
	exit;
}
require('assets/library/fpdf/fpdf.php');
include "dbfunction.php";

function GetKolom($awal, $akhir, $ofset)
{
	$sql = "SELECT idthpel, nmthpel, desthpel FROM tbthpel WHERE idthpel BETWEEN '$awal' AND '$akhir' ORDER BY idthpel LIMIT 4 OFFSET $ofset";
	return vquery($sql);
}
function JmlKolom($awal, $akhir, $ofset)
{
	$sql = "SELECT idthpel, desthpel FROM tbthpel WHERE idthpel BETWEEN '$awal' AND '$akhir' ORDER BY idthpel LIMIT 4 OFFSET $ofset";
	return cquery($sql);
}

function CekMutasi($ids)
{
	$sql = "SELECT*FROM tbregistrasi WHERE idsiswa='$ids' AND idjreg='6'";
	return cquery($sql);
}

function CekRegis($ids)
{
	$sql = "SELECT r.idthpel, desthpel FROM tbregistrasi r INNER JOIN tbregistrasi_detil rd USING(idreg) INNER JOIN tbkelas USING(idkelas) INNER JOIN tbthpel USING(idthpel) WHERE idsiswa='$ids'";
	return cquery($sql);
}

function CekDropOut($ids)
{
	$sql = "SELECT*FROM tbregistrasi WHERE idsiswa='$ids' AND idjreg='7'";
	return cquery($sql);
}

function CekLulus($ids)
{
	$sql = "SELECT*FROM tbregistrasi WHERE idsiswa='$ids' AND idjreg='8'";
	return cquery($sql);
}

function IsiKepAkhir($id, $th)
{
	$kctt = array(
		'idsiswa' => $id,
		'idthpel' => $th
	);
	$cekctt = cekdata('tbakhirtahun', $kctt);
	//$data[] = '';
	if ($cekctt > 0) {
		$ctt = viewdata('tbakhirtahun', $kctt)[0];
		$data = array(
			'tgl' => indonesian_date($ctt['tglcatatan']),
			'catatan' => $ctt['catatan'],
			'lainnya' => '-'
		);
	} else {
		$data = array(
			'tgl' => '',
			'catatan' => '',
			'lainnya' => ''
		);
	}
	return $data;
}

function KonversiNilai($angka)
{
	switch ($angka) {
		case '4': {
				$huruf = 'A (Amat Baik)';
				break;
			}
		case '3': {
				$huruf = 'B (Baik)';
				break;
			}
		case '2': {
				$huruf = 'C (Cukup)';
				break;
			}
		case '1': {
				$huruf = 'D (Kurang)';
				break;
			}
		default: {
				$huruf = '';
				break;
			}
	}
	return $huruf;
}

function GetHubkel($hk)
{
	switch ($hk) {
		case '3': {
				$huruf = 'Kakak';
				break;
			}
		case '4': {
				$huruf = 'Paman / Bibi';
				break;
			}
		case '5': {
				$huruf = 'Kakek / Nenek';
				break;
			}
		case '6': {
				$huruf = 'Famili Lain';
				break;
			}
		default: {
				$huruf = '-';
				break;
			}
	}
	return $huruf;
}

function RapikanAbsen($angka)
{
	if ($angka == 0) {
		$absen = '- hari';
	} else {
		$absen = $angka . ' hari';
	}
	return $absen;
}

function UbahKelas($nama)
{
	$angka = str_replace('Kelas', '', $nama);
	switch ($angka) {
		case '1': {
				$romawi = 'I';
				break;
			}
		case '2': {
				$romawi = 'II';
				break;
			}
		case '3': {
				$romawi = 'III';
				break;
			}
		case '4': {
				$romawi = 'IV';
				break;
			}
		case '5': {
				$romawi = 'V';
				break;
			}
		case '6': {
				$romawi = 'VI';
				break;
			}
		case '7': {
				$romawi = 'VII';
				break;
			}
		case '8': {
				$romawi = 'VIII';
				break;
			}
		case '9': {
				$romawi = 'IX';
				break;
			}
		default: {
				$romawi = '';
				break;
			}
	}
	return $romawi;
}

class PDF extends FPDF
{
	protected $col = 0;
	protected $y0;

	function Header()
	{
		$this->SetY(1.75);
		$this->y0 = $this->GetY();
	}

	// function Footer()
	// {
	// 	 if ($this->PageNo()>1) {
	// 	 	$this->SetXY(3.75,-1.575);
	// 	 	$this->SetFont('Arial','I',8);
	// 	 	$sql="SELECT LEFT(desthpel,9) as tahun FROM tbthpel WHERE idthpel='$id'";
	// 	 	var_dump($sql);		   		
	// 	 	$th=vquery($sql)[0];
	// 	 	$hal=$this->PageNo()-1;
	// 	 	$this->Cell(26.25,1.0,'Buku Induk Peserta Didik Tahun Pelajaran '.$th['tahun'],0,0,'C');
	// 	 	$this->Cell(1.75,1.0,'Halaman '.$hal,0,0,'C');

	// 	 }
	// }

	function SetCol($col)
	{
		$this->col = $col;
		$x = 2.75 + $col * 14.5;
		$this->SetLeftMargin($x);
		$this->SetX($x);
	}

	function AcceptPageBreak()
	{
		if ($this->col < 1) {
			$this->SetCol($this->col + 1);
			$this->SetY($this->y0);
			return false;
		} else {
			$this->SetCol(0);
			return true;
		}
	}

	function BiodataTitle($id)
	{
		$ds = viewdata('tbsiswa', array('idsiswa' => $id))[0];
		$nis = $ds['nis'];
		$nisn = $ds['nisn'];
		$this->SetFont('Times', 'B', 14);
		$this->SetXY(2.75, 1.75);
		$this->Cell(29, 0.75, 'LEMBAR DATA PESERTA DIDIK', 0, 0, 'C');
		$this->SetXY(20.725, 2.5);
		$this->SetFont('Times', '', 11);
		$this->Cell(3.45, 0.575, 'Nomor Induk', 0, 0, 'L');
		$this->SetXY(24.725, 2.5);
		$this->Cell(5.75, 0.575, 'Nomor Induk Siswa Nasional', 0, 0, 'L');
		$this->SetXY(20.75, 3.075);
		$this->SetLineWidth(0);
		$this->SetDrawColor(2, 2, 2);
		$c = strlen($nis);
		$this->SetFont('Times', 'BI', 12);
		$t = 6 - $c;
		for ($i = 1; $i <= $t; $i++) {
			$this->Cell(0.575, 0.575, '0', 1, 0, 'C');
		}
		for ($j = 0; $j < $c; $j++) {
			$this->Cell(0.575, 0.575, substr($nis, $j, 1), 1, 0, 'C');
		}
		$this->SetXY(24.775, 3.075);
		for ($k = 0; $k < 10; $k++) {
			$this->Cell(0.575, 0.575, substr($nisn, $k, 1), 1, 0, 'C');
		}
		$this->SetY(4.5);
		$this->y0 = $this->GetY();
	}

	function PasFoto($id)
	{
		$this->SetLineWidth(0);
		$this->SetDrawColor(2, 2, 2);
		$this->Rect(28.5, 4.5, 2.8, 3.2);
		$this->SetFont('Times', '', 10);
		$this->SetXY(28.75, 5.25);
		$this->MultiCell(2.5, 0.375, 'tempelkan pas foto masuk ukuran 3 x 4 di sini', 0, 'C');
		$this->Rect(28.5, 15.0, 2.8, 3.2);
		$this->SetXY(28.75, 15.75);
		$this->MultiCell(2.5, 0.375, 'tempelkan pas foto keluar ukuran 3 x 4 di sini', 0, 'C');
	}

	function BiodataIsi($id)
	{
		$d = viewdata('tbsiswa', array('idsiswa' => $id))[0];
		$this->PasFoto($id);
		$this->SetFont('Times', '', 11);
		$this->SetXY(2.75, 4.5);
		$this->Cell(0.75, 0.5725, 'A.');
		$this->Cell(12.5, 0.5725, 'Keterangan Diri Peserta Didik');
		$this->Ln();
		$this->SetFont('Times', '', 11);
		$this->Cell(0.75, 0.5725);
		$this->Cell(0.75, 0.5725, '1.');
		$this->Cell(4.0, 0.5725, 'Nama Peserta Didik');
		$this->Cell(0.25, 0.5725, ':');
		$this->Cell(8.25, 0.5725);
		$this->Ln();
		$this->Cell(1.5, 0.5725);
		$this->Cell(0.5, 0.5725, 'a.');
		$this->Cell(3.5, 0.5725, 'Nama Lengkap');
		$this->Cell(0.25, 0.5725, ':');
		$this->Cell(8.25, 0.5725, $d['nmsiswa']);
		$this->Ln();
		$nama = explode(" ", $d['nmsiswa']);
		if ($nama[0] == 'Muhamad' || $nama[0] == 'Muhammad' || $nama[0] == 'Muh.'  || $nama[0] == 'Moch.' || $nama[0] == 'Mhd.' || $nama[0] == 'Mohd.' || $nama[0] == 'Abdul' || strlen($nama[0] == 1)) {
			$nickname = $nama[1];
		} else {
			$nickname = $nama[0];
		}
		$this->Cell(1.5, 0.5725);
		$this->Cell(0.5, 0.5725, 'b.');
		$this->Cell(3.5, 0.5725, 'Nama Panggilan');
		$this->Cell(0.25, 0.5725, ':');
		$this->Cell(8.25, 0.5725, $nickname);
		$this->Ln();
		$this->Cell(0.75, 0.5725);
		$this->Cell(0.75, 0.5725, '2.');
		$this->Cell(4.0, 0.5725, 'N I K');
		$this->Cell(0.25, 0.5725, ':');
		$this->Cell(8.25, 0.5725, $d['nik']);
		$this->Ln();
		$this->Cell(0.75, 0.5725);
		$this->Cell(0.75, 0.5725, '3.');
		$this->Cell(4.0, 0.5725, 'Tempat, Tanggal Lahir');
		$this->Cell(0.25, 0.5725, ':');
		$this->Cell(8.25, 0.5725, $d['tmplahir'] . ', ' . indonesian_date($d['tgllahir']));
		$this->Ln();
		$this->Cell(0.75, 0.5725);
		$this->Cell(0.75, 0.5725, '4.');
		$this->Cell(4.0, 0.5725, 'Jenis Kelamin');
		$this->Cell(0.25, 0.5725, ':');
		$gender = getgender($d['gender']);
		$this->Cell(8.25, 0.5725, $gender);
		$this->Ln();
		$this->Cell(0.75, 0.5725);
		$this->Cell(0.75, 0.5725, '5.');
		$this->Cell(4.0, 0.5725, 'Agama / Kepercayaan');
		$this->Cell(0.25, 0.5725, ':');
		$agm = getagama($d['idagama']);
		$this->Cell(8.25, 0.5725, $agm);
		$this->Ln();
		$this->Cell(0.75, 0.5725);
		$this->Cell(0.75, 0.5725, '6.');
		$this->Cell(4.0, 0.5725, 'Kewarganegaraan');
		$this->Cell(0.25, 0.5725, ':');
		$wn = getwni($d['warganegara']);
		$this->Cell(8.25, 0.5725, $wn);
		$this->Ln();
		$this->Cell(0.75, 0.5725);
		$this->Cell(0.75, 0.5725, '7.');
		$this->Cell(4.0, 0.5725, 'Anak Ke');
		$this->Cell(0.25, 0.5725, ':');
		if ($d['anake'] == '' || $d['sdr'] == '') {
			$anake = '-';
		} else {
			$anake = $d['anake'] . ' dari ' . $d['sdr'] . ' bersaudara';
		}
		$this->Cell(8.25, 0.5725, $anake);
		$this->Ln();
		$this->Cell(0.75, 0.5725);
		$this->Cell(0.75, 0.5725, '8.');
		$this->Cell(4.0, 0.5725, 'Golongan Darah');
		$this->Cell(0.25, 0.5725, ':');
		$goldarah = getdarah($d['goldarah']);
		$this->Cell(8.25, 0.5725, $goldarah);
		$this->Ln();
		$this->Cell(0.75, 0.5725);
		$this->Cell(0.75, 0.5725, '9.');
		$this->Cell(4.0, 0.5725, 'Riwayat Penyakit');
		$this->Cell(0.25, 0.5725, ':');
		$skt = getpenyakit($d['rwysakit']);
		$this->Cell(8.25, 0.5725, $skt);
		$this->Ln();
		$this->Cell(0.75, 0.5725);
		$this->Cell(0.75, 0.5725, '10.');
		$this->Cell(4.0, 0.5725, 'Kebutuhan Khusus');
		$this->Cell(0.25, 0.5725, ':');
		$kbthn = getkebkhusus($d['kebkhusus']);
		$this->Cell(8.25, 0.5725, $kbthn);
		$this->Ln();
		$this->Cell(0.75, 0.5725);
		$this->Cell(0.75, 0.5725, '11.');
		$this->Cell(4.0, 0.5725, 'Tinggal Dengan');
		$this->Cell(0.25, 0.5725, ':');
		$tggl = gettinggal($d['ikuts']);
		$this->Cell(8.25, 0.5725, $tggl);
		$this->Ln();
		$this->Cell(0.75, 0.5725);
		$this->Cell(0.75, 0.5725, '12.');
		$this->Cell(4.0, 0.5725, 'Jarak / Waktu Tempuh');
		$this->Cell(0.25, 0.5725, ':');
		if ($d['jarak'] <= '1') {
			$jrk = 'Sekitar 1 Kilometer';
		} else {
			$jrk = '' . $d['jarak'] . ' Kilometer';
		}
		$this->Cell(8.25, 0.5725, $jrk . ' / ' . $d['waktu'] . ' menit');
		$this->Ln();
		$this->Cell(0.75, 0.5725);
		$this->Cell(0.75, 0.5725, '13.');
		$this->Cell(4.0, 0.5725, 'Mode Transportasi');
		$this->Cell(0.25, 0.5725, ':');
		$trans = gettrans($d['transpr']);
		$this->Cell(8.25, 0.5725, $trans);
		$this->Ln();
		$this->Cell(0.75, 0.5725);
		$this->Cell(0.75, 0.5725, '14.');
		$this->Cell(4.0, 0.5725, 'Alamat');
		$this->Cell(0.25, 0.5725, ':');
		$this->Cell(8.25, 0.5725, $d['alamat'] . ', Desa ' . $d['desa']);
		$this->Ln();
		$this->Cell(0.75, 0.5725);
		$this->Cell(0.75, 0.5725);
		$this->Cell(4.0, 0.5725);
		$this->Cell(0.25, 0.5725);
		$this->Cell(8.25, 0.5725, 'Kecamatan ' . str_replace('Kec. ', '', $d['kec']) . ', Kabupaten / Kota ' . $d['kab']);
		$this->Ln();
		$this->Cell(0.75, 0.5725);
		$this->Cell(0.75, 0.5725);
		$this->Cell(4.0, 0.5725);
		$this->Cell(0.25, 0.5725);
		$this->Cell(8.25, 0.5725, 'Provinsi ' . $d['prov'] . ', Kode Pos ' . $d['kdpos']);
		$this->Ln();
		if ($d['lintang'] == null || $d['lintang'] == '' || $d['bujur'] == null || $d['bujur'] == '') {
			$koordinat = '-';
		} else {
			$koordinat = number_format($d['lintang'], 4, '.', '.') . ' / ' . number_format($d['bujur'], 4, '.', '.');
		}
		$this->Cell(0.75, 0.5725);
		$this->Cell(0.75, 0.5725, '15.');
		$this->Cell(4.0, 0.5725, 'Koordinat');
		$this->Cell(0.25, 0.5725, ':');
		$this->Cell(8.25, 0.5725, $koordinat);
		$this->Ln();
		$this->Cell(0.75, 0.5725);
		$this->Cell(0.75, 0.5725, '16.');
		$this->Cell(4.0, 0.5725, 'Nomor HP');
		$this->Cell(0.25, 0.5725, ':');
		$this->Cell(8.25, 0.5725, $d['nohp']);
		$this->Ln();
		$this->Cell(0.75, 0.5725);
		$this->Cell(0.75, 0.5725, '17.');
		$this->Cell(4.0, 0.5725, 'Hobi / Kegemaran');
		$this->Cell(0.25, 0.5725, ':');
		$this->Cell(8.25, 0.5725);
		$this->Ln();
		if ($d['hobi1'] == '' || $d['hobi1'] == null) {
			$hobi1 = '-';
		} else {
			$hobi1 = $d['hobi1'];
		}
		$this->Cell(1.5, 0.5725);
		$this->Cell(0.5, 0.5725, 'a.');
		$this->Cell(3.5, 0.5725, 'Bidang Olahraga');
		$this->Cell(0.25, 0.5725, ':');
		$this->Cell(8.25, 0.5725, $hobi1);
		$this->Ln();
		if ($d['hobi2'] == '' || $d['hobi2'] == null) {
			$hobi2 = '-';
		} else {
			$hobi2 = $d['hobi3'];
		}
		$this->Cell(1.5, 0.5725);
		$this->Cell(0.5, 0.5725, 'b.');
		$this->Cell(3.5, 0.5725, 'Bidang Seni');
		$this->Cell(0.25, 0.5725, ':');
		$this->Cell(8.25, 0.5725, $hobi2);
		$this->Ln();
		if ($d['hobi3'] == '' || $d['hobi3'] == null) {
			$hobi3 = '-';
		} else {
			$hobi3 = $d['hobi3'];
		}
		$this->Cell(1.5, 0.5725);
		$this->Cell(0.5, 0.5725, 'c.');
		$this->Cell(3.5, 0.5725, 'Organisasi');
		$this->Cell(0.25, 0.5725, ':');
		$this->Cell(8.25, 0.5725, $hobi3);
		$this->Ln();
		if ($d['hobi4'] == '' || $d['hobi4'] == null) {
			$hobi4 = '-';
		} else {
			$hobi4 = $d['hobi4'];
		}
		$this->Cell(1.5, 0.5725);
		$this->Cell(0.5, 0.5725, 'd.');
		$this->Cell(3.5, 0.5725, 'Lainnya');
		$this->Cell(0.25, 0.5725, ':');
		$this->Cell(8.25, 0.5725, $hobi4);
		$this->Ln(0.75);
		$this->SetFont('Times', 'B', 11);
		$this->Cell(0.75, 0.5725, 'B.');
		$this->Cell(12.5, 0.5725, 'Registrasi Peserta Didik');
		$this->Ln();
		$this->SetFont('Times', '', 11);
		$this->Cell(0.75, 0.5725);
		$this->Cell(0.75, 0.5725, '1.');
		$this->Cell(4.0, 0.5725, 'Terdaftar Sebagai');
		$this->Cell(0.25, 0.5725, ':');

		$qreg = "SELECT idjreg, nmkelas, tglreg FROM tbregistrasi INNER JOIN tbregistrasi_detil USING(idreg) INNER JOIN tbkelas USING(idkelas) WHERE idsiswa='$id' AND (idjreg='1' OR idjreg='2')";
		$rg = vquery($qreg)[0];
		$regis = getregis($rg['idjreg']);
		$this->Cell(8.25, 0.5725, $regis);
		$this->Ln();
		$this->Cell(0.75, 0.5725);
		$this->Cell(0.75, 0.5725, '2.');
		$this->Cell(4.0, 0.5725, 'Tanggal');
		$this->Cell(0.25, 0.5725, ':');
		$this->Cell(8.25, 0.5725, indonesian_date($rg['tglreg']));
		$this->Ln();
		$this->Cell(0.75, 0.5725);
		$this->Cell(0.75, 0.5725, '3.');
		$this->Cell(4.0, 0.5725, 'Diterima di kelas');
		$this->Cell(0.25, 0.5725, ':');
		$this->Cell(8.25, 0.5725, KonversiRomawi(str_replace('Kelas ', '', $rg['nmkelas'])));
		$this->Ln();

		if (cekdata('tbasalsd', array('idsiswa' => $id)) == 0) {
			$aslsd = '-';
			$noijz = '';
			$tglijz = '';
			$lamasd = '';
		} else {
			$rw = viewdata('tbasalsd', array('idsiswa' => $id))[0];
			$aslsd = $rw['aslsd'];
			$noijz = $rw['noijazah'];
			$tglijz = indonesian_date($rw['tglijazah']);
			$lamasd = $rw['lama'];
		}
		$this->Cell(0.75, 0.5725);
		$this->Cell(0.75, 0.5725, '4.');
		$this->Cell(4.0, 0.5725, 'Lulus Dari');
		$this->Cell(0.25, 0.5725);
		$this->Cell(8.25, 0.5725, '');
		$this->Ln();
		$this->Cell(1.5, 0.5725);
		$this->Cell(0.5, 0.5725, 'a.');
		$this->Cell(3.5, 0.5725, 'Nama SD/MI');
		$this->Cell(0.25, 0.5725, ':');
		$this->Cell(8.25, 0.5725, $aslsd);
		$this->Ln();
		$this->Cell(1.5, 0.5725);
		$this->Cell(0.5, 0.5725, 'b.');
		$this->Cell(3.5, 0.5725, 'Nomor Seri Ijazah');
		$this->Cell(0.25, 0.5725, ':');
		$this->Cell(8.25, 0.5725, $noijz);
		$this->Ln();
		$this->Cell(1.5, 0.5725);
		$this->Cell(0.5, 0.5725, 'c.');
		$this->Cell(3.5, 0.5725, 'Tanggal Ijazah');
		$this->Cell(0.25, 0.5725, ':');
		$this->Cell(8.25, 0.5725, $tglijz);
		$this->Ln();
		$this->Cell(1.5, 0.5725);
		$this->Cell(0.5, 0.5725, 'd.');
		$this->Cell(3.5, 0.5725, 'Lama Belajar');
		$this->Cell(0.25, 0.5725, ':');
		$this->Cell(8.25, 0.5725, $lamasd . ' tahun');
		$this->Ln();
		$this->Cell(0.75, 0.5725);
		$this->Cell(0.75, 0.5725, '5.');
		$this->Cell(4.0, 0.5725, 'Pindahan Dari');
		$this->Cell(0.25, 0.5725);
		$this->Cell(8.25, 0.5725);
		$this->Ln();
		$km = array(
			'idsiswa' => $id,
			'jnsmutasi' => '1'
		);
		if (cekdata('tbmutasi', $km) == 0) {
			$aslsmp = '-';
			$nosurat = '-';
			$tglsurat = '-';
			$alasan = '-';
		} else {
			$mu = viewdata('tbmutasi', $km)[0];
			$aslsmp = $mu['aslkesmp'];
			$nosurat = $mu['nosurat'];
			$tglsurat = indonesian_date($mu['tglsurat']);
			$alasan = $mu['alasan'];
		}
		$this->Cell(1.5, 0.5725);
		$this->Cell(0.5, 0.5725, 'a.');
		$this->Cell(3.5, 0.5725, 'Nama SMP / MTs');
		$this->Cell(0.25, 0.5725, ':');
		$this->Cell(8.25, 0.5725, $aslsmp);
		$this->Ln();
		$this->Cell(1.5, 0.5725);
		$this->Cell(0.5, 0.5725, 'b.');
		$this->Cell(3.5, 0.5725, 'Nomor Surat Pindah');
		$this->Cell(0.25, 0.5725, ':');
		$this->Cell(8.25, 0.5725, $nosurat);
		$this->Ln();
		$this->Cell(1.5, 0.5725);
		$this->Cell(0.5, 0.5725, 'c.');
		$this->Cell(3.5, 0.5725, 'Tanggal Surat Pindah');
		$this->Cell(0.25, 0.5725, ':');
		$this->Cell(8.25, 0.5725, $tglsurat);
		$this->Ln();
		$this->Cell(1.5, 0.5725);
		$this->Cell(0.5, 0.5725, 'd.');
		$this->Cell(3.5, 0.5725, 'Alasan Pindah');
		$this->Cell(0.25, 0.5725, ':');
		$this->Cell(8.25, 0.5725, $alasan);
		$this->Ln(0.75);

		$this->SetFont('Times', 'B', 11);
		$this->Cell(0.75, 0.5725, 'C.');
		$this->Cell(12.5, 0.5725, 'Keterangan Orang Tua Kandung');
		$this->Ln();
		$qayah = "SELECT ay.*, r1.pendidikan, r2.pekerjaan, r3.penghasilan FROM tbortu ay LEFT JOIN ref_pendidikan r1 USING(idpddk) LEFT JOIN ref_pekerjaan r2 USING(idkerja) LEFT JOIN ref_penghasilan r3 USING(idhsl) WHERE ay.hubkel='1' AND ay.idsiswa='$id'";
		if (cquery($qayah) == 0) {
			$nmayah = '-';
			$agmayah = '-';
			$pddkayah = '-';
			$krjayah = '-';
			$gajiayah = '-';
			$hdpayah = '-';
			$alamat1 = '-';
			$alamat2 = '-';
			$alamat3 = '-';
			$nohp = '-';
		} else {
			$da = vquery($qayah)[0];
			$nmayah = $da['nmortu'];
			$agmayah = getagama($da['idagama']);
			$pddkayah = getskulortu($da['idpddk']);
			$krjayah = getkerjaortu($da['idkerja']);
			$gajiayah = getgajiortu($da['idhsl']);
			$hdpayah = getkethdp($da['wafat']);
			$alamat1 = $da['alamat'] . ', Desa ' . $da['desa'];
			$alamat2 = 'Kecamatan ' . $da['kec'] . ', Kabupaten ' . $da['kab'];
			$alamat3 = 'Provinsi ' . $da['prov']; //. ', Kode Pos ' . $da['kdpos'];
			$nohp = $da['nohp'];
		}

		$qibu = "SELECT ay.*, r1.pendidikan, r2.pekerjaan, r3.penghasilan FROM tbortu ay LEFT JOIN ref_pendidikan r1 USING(idpddk) LEFT JOIN ref_pekerjaan r2 USING(idkerja) LEFT JOIN ref_penghasilan r3 USING(idhsl) WHERE ay.hubkel='2' AND ay.idsiswa='$id'";
		if (cquery($qibu) == 0) {
			$nmibu = '-';
			$agmibu = '-';
			$pddkibu = '-';
			$krjibu = '-';
			$gajiibu = '-';
			$hdpibu = '-';
			$alamat1 = '-';
			$alamat2 = '-';
			$alamat3 = '-';
			$nohp = '-';
		} else {
			$di = vquery($qibu)[0];
			$nmibu = $di['nmortu'];
			$agmibu = getagama($di['idagama']);
			$pddkibu = getskulortu($di['idpddk']);
			$krjibu = getkerjaortu($di['idkerja']);
			$gajiibu = getgajiortu($di['idhsl']);
			$hdpibu = getkethdp($di['wafat']);
			$alamat1 = $di['alamat'] . ', Desa ' . $di['desa'];
			$alamat2 = 'Kecamatan ' . $di['kec'] . ', Kabupaten ' . $di['kab'];
			$alamat3 = 'Provinsi ' . $di['prov']; // . ', Kode Pos ' . $di['kdpos'];
			$nohp = $di['nohp'];
		}
		$this->SetFont('Times', '', 11);
		$this->Cell(0.75, 0.5725);
		$this->Cell(0.75, 0.5725, '1.');
		$this->Cell(4.0, 0.5725, 'Nama Lengkap');
		$this->Cell(0.25, 0.5725);
		$this->Cell(8.25, 0.5725);
		$this->Ln();
		$this->Cell(1.5, 0.5725);
		$this->Cell(0.5, 0.5725, 'a.');
		$this->Cell(3.5, 0.5725, 'Ayah');
		$this->Cell(0.25, 0.5725, ':');
		$this->Cell(8.25, 0.5725, $nmayah);
		$this->Ln();
		$this->Cell(1.5, 0.5725);
		$this->Cell(0.5, 0.5725, 'b.');
		$this->Cell(3.5, 0.5725, 'Ibu');;
		$this->Cell(0.25, 0.5725, ':');
		$this->Cell(8.25, 0.5725, $nmibu);
		$this->Ln();
		$this->Cell(0.75, 0.5725);
		$this->Cell(0.75, 0.5725, '2.');
		$this->Cell(4.0, 0.5725, 'Agama / Kepercayaan');
		$this->Cell(0.25, 0.5725);
		$this->Cell(8.25, 0.57);
		$this->Ln();
		$this->Cell(1.5, 0.5725);
		$this->Cell(0.5, 0.5725, 'a.');
		$this->Cell(3.5, 0.5725, 'Ayah');;
		$this->Cell(0.25, 0.5725, ':');
		$this->Cell(8.25, 0.5725, $agmayah);
		$this->Ln();
		$this->Cell(1.5, 0.5725);
		$this->Cell(0.5, 0.5725, 'b.');
		$this->Cell(3.5, 0.5725, 'Ibu');
		$this->Cell(0.25, 0.5725, ':');
		$this->Cell(8.25, 0.5725, $agmibu);
		$this->Ln();
		$this->Cell(0.75, 0.5725);
		$this->Cell(0.75, 0.5725, '3.');
		$this->Cell(4.0, 0.5725, 'Pendidikan Terakhir');
		$this->Cell(0.25, 0.5725);
		$this->Cell(8.25, 0.5725);
		$this->Ln();
		$this->Cell(1.5, 0.5725);
		$this->Cell(0.5, 0.5725, 'a.');
		$this->Cell(3.5, 0.5725, 'Ayah');
		$this->Cell(0.25, 0.5725, ':');
		$this->Cell(8.25, 0.5725, $pddkayah);
		$this->Ln();
		$this->Cell(1.5, 0.5725);
		$this->Cell(0.5, 0.5725, 'b.');
		$this->Cell(3.5, 0.5725, 'Ibu');
		$this->Cell(0.25, 0.5725, ':');
		$this->Cell(8.25, 0.5725, $pddkibu);
		$this->Ln(1.25);
		$this->Cell(0.75, 0.5725);
		$this->Cell(0.75, 0.5725, '4.');
		$this->Cell(4.0, 0.5725, 'Pekerjaan');
		$this->Cell(0.25, 0.5725);
		$this->Cell(8.25, 0.5725);
		$this->Ln();
		$this->Cell(1.5, 0.5725);
		$this->Cell(0.5, 0.5725, 'a.');
		$this->Cell(3.5, 0.5725, 'Ayah');
		$this->Cell(0.25, 0.5725, ':');
		$this->Cell(8.25, 0.5725, $krjayah);
		$this->Ln();
		$this->Cell(1.5, 0.5725);
		$this->Cell(0.5, 0.5725, 'b.');
		$this->Cell(3.5, 0.5725, 'Ibu');
		$this->Cell(0.25, 0.5725, ':');
		$this->Cell(8.25, 0.5725, $krjibu);
		$this->Ln();
		$this->Cell(0.75, 0.5725);
		$this->Cell(0.75, 0.5725, '5.');
		$this->Cell(4.0, 0.5725, 'Penghasilan Per Bulan');
		$this->Cell(0.25, 0.5725);
		$this->Cell(8.25, 0.5725);
		$this->Ln();
		$this->Cell(1.5, 0.5725);
		$this->Cell(0.5, 0.5725, 'a.');
		$this->Cell(3.5, 0.5725, 'Ayah');
		$this->Cell(0.25, 0.5725, ':');
		$this->Cell(8.25, 0.5725, $gajiayah);
		$this->Ln();
		$this->Cell(1.5, 0.5725);
		$this->Cell(0.5, 0.5725, 'b.');
		$this->Cell(3.5, 0.5725, 'Ibu');
		$this->Cell(0.25, 0.5725, ':');
		$this->Cell(8.25, 0.5725, $gajiibu);
		$this->Ln();
		$this->Cell(0.75, 0.5725);
		$this->Cell(0.75, 0.5725, '6.');
		$this->Cell(4.0, 0.5725, 'Masih Hidup / Sudah Meninggal');
		$this->Cell(0.25, 0.5725);
		$this->Cell(8.25, 0.5725);
		$this->Ln();
		$this->Cell(1.5, 0.5725);
		$this->Cell(0.5, 0.5725, 'a.');
		$this->Cell(3.5, 0.5725, 'Ayah');
		$this->Cell(0.25, 0.5725, ':');
		$this->Cell(8.25, 0.5725, $hdpayah);
		$this->Ln();
		$this->Cell(1.5, 0.5725);
		$this->Cell(0.5, 0.5725, 'b.');
		$this->Cell(3.5, 0.5725, 'Ibu');
		$this->Cell(0.25, 0.5725, ':');
		$this->Cell(8.25, 0.5725, $hdpibu);
		$this->Ln();
		$this->Cell(0.75, 0.5725);
		$this->Cell(0.75, 0.5725, '7.');
		$this->Cell(4.0, 0.5725, 'Alamat');
		$this->Cell(0.25, 0.5725, ':');
		$this->Cell(8.25, 0.5725, $alamat1);
		$this->Ln();
		$this->Cell(0.75, 0.5725);
		$this->Cell(0.75, 0.5725);
		$this->Cell(4.0, 0.5725);
		$this->Cell(0.25, 0.5725);
		$this->Cell(8.25, 0.5725, $alamat2);
		$this->Ln();
		$this->Cell(0.75, 0.5725);
		$this->Cell(0.75, 0.5725);
		$this->Cell(4.0, 0.5725);
		$this->Cell(0.25, 0.5725);
		$this->Cell(8.25, 0.5725, $alamat3);
		$this->Ln();
		$this->Cell(0.75, 0.5725);
		$this->Cell(0.75, 0.5725, '8.');
		$this->Cell(4.0, 0.5725, 'Nomor HP');
		$this->Cell(0.25, 0.5725, ':');
		$this->Cell(8.25, 0.5725, $nohp);
		$this->Ln(0.75);
		$this->SetFont('Times', 'B', 11);
		$this->Cell(0.75, 0.5725, 'D.');
		$this->Cell(12.5, 0.5725, 'Keterangan Wali Peserta Didik');
		$this->Ln();
		$qwali = "SELECT ay.*, r1.pendidikan, r2.pekerjaan, r3.penghasilan FROM tbortu ay LEFT JOIN ref_pendidikan r1 USING(idpddk) LEFT JOIN ref_pekerjaan r2 USING(idkerja) LEFT JOIN ref_penghasilan r3 USING(idhsl) WHERE (ay.hubkel<>'1' AND ay.hubkel<>'2') AND ay.idsiswa='$id'";
		if (cquery($qwali) == 0) {
			$nmwali = '-';
			$agmwali = '-';
			$pddkwali = '-';
			$krjwali = '-';
			$gajiwali = '-';
			$hdpwali = '-';
			$alamat1 = '-';
			$alamat2 = '-';
			$alamat3 = '-';
			$nohp = '-';
			$hubkel = '-';
		} else {
			$dw = vquery($qwali)[0];
			$nmwali = $dw['nmortu'];
			$agmwali = getagama($dw['idagama']);
			$pddkwali = getskulortu($dw['idpddk']);
			$krjwali = getkerjaortu($dw['idkerja']);
			$gajiwali = getgajiortu($dw['idhsl']);
			$alamat1 = $dw['alamat'] . ', Desa ' . $dw['desa'];
			$alamat2 = 'Kecamatan ' . $dw['kec'] . ', Kabupaten ' . $dw['kab'];
			$alamat3 = 'Provinsi ' . $dw['prov']; // . ', Kode Pos ' . $dw['kdpos'];
			$nohp = $dw['nohp'];
			$hubkel = GetHubKel($dw['hubkel']);
		}
		$this->SetFont('Times', '', 11);
		$this->Cell(0.75, 0.5725);
		$this->Cell(0.75, 0.5725, '1.');
		$this->Cell(4.0, 0.5725, 'Nama Lengkap');
		$this->Cell(0.25, 0.5725, ':');
		$this->Cell(8.25, 0.5725, $nmwali);
		$this->Ln();
		$this->Cell(0.75, 0.5725);
		$this->Cell(0.75, 0.5725, '2.');
		$this->Cell(4.0, 0.5725, 'Agama / Kepercayaan');
		$this->Cell(0.25, 0.5725, ':');
		$this->Cell(8.25, 0.5725, $agmwali);
		$this->Ln();
		$this->Cell(0.75, 0.5725);
		$this->Cell(0.75, 0.5725, '3.');
		$this->Cell(4.0, 0.5725, 'Pendidikan Terakhir');
		$this->Cell(0.25, 0.5725, ':');
		$this->Cell(8.25, 0.5725, $pddkwali);
		$this->Ln();
		$this->Cell(0.75, 0.5725);
		$this->Cell(0.75, 0.5725, '4.');
		$this->Cell(4.0, 0.5725, 'Pekerjaan');
		$this->Cell(0.25, 0.5725, ':');
		$this->Cell(8.25, 0.5725, $krjwali);
		$this->Ln();
		$this->Cell(0.75, 0.5725);
		$this->Cell(0.75, 0.5725, '5.');
		$this->Cell(4.0, 0.5725, 'Penghasilan Per Bulan');
		$this->Cell(0.25, 0.5725, ':');
		$this->Cell(8.25, 0.5725, $gajiwali);
		$this->Ln();
		$this->Cell(0.75, 0.5725);
		$this->Cell(0.75, 0.5725, '6.');
		$this->Cell(4.0, 0.5725, 'Alamat');
		$this->Cell(0.25, 0.5725, ':');
		$this->Cell(8.25, 0.5725, $alamat1);
		$this->Ln();
		$this->Cell(0.75, 0.5725);
		$this->Cell(0.75, 0.5725);
		$this->Cell(4.0, 0.5725);
		$this->Cell(0.25, 0.5725);
		$this->Cell(8.25, 0.5725, $alamat2);
		$this->Ln();
		$this->Cell(0.75, 0.5725);
		$this->Cell(0.75, 0.5725);
		$this->Cell(4.0, 0.5725);
		$this->Cell(0.25, 0.5725);
		$this->Cell(8.25, 0.5725, $alamat3);
		$this->Ln();
		$this->Cell(0.75, 0.5725);
		$this->Cell(0.75, 0.5725, '7.');
		$this->Cell(4.0, 0.5725, 'Nomor HP');
		$this->Cell(0.25, 0.5725, ':');
		$this->Cell(8.25, 0.5725, $nohp);
		$this->Ln();
		$this->Cell(0.75, 0.5725);
		$this->Cell(0.75, 0.5725, '8.');
		$this->Cell(4.0, 0.5725, 'Hubungan Keluarga');
		$this->Cell(0.25, 0.5725, ':');
		$this->Cell(8.25, 0.5725, GetHubkel($hubkel));
		$this->Ln(0.75);
		$this->SetFont('Times', 'B', 11);
		$this->Cell(0.75, 0.5725, 'E.');
		$this->Cell(12.5, 0.5725, 'Catatan Perkembangan Peserta Didik');
		$this->Ln(0.75);
		$this->SetFont('Times', '', 11);
		$this->Cell(0.75, 0.5725);
		$this->Cell(0.75, 0.5725, '1.');
		$this->Cell(12.5, 0.5725, 'Prestasi');
		$this->Ln();
		for ($i = 1; $i <= 4; $i++) {
			$this->Cell(1.5, 0.5725);
			$this->Cell(12.5, 0.5725, ' .........................................................................................................................');
			$this->Ln();
		}
		$this->Ln();
		$this->Cell(0.75, 0.5725);
		$this->Cell(0.75, 0.5725, '2.');
		$this->Cell(12.5, 0.5725, 'Beasiswa');
		$this->Ln();
		for ($i = 1; $i <= 4; $i++) {
			$this->Cell(1.5, 0.5725);
			$this->Cell(12.5, 0.5725, ' .........................................................................................................................');
			$this->Ln();
		}
		$this->Ln(0.125);
		$this->Cell(0.75, 0.5725);
		$this->Cell(0.75, 0.5725, '3.');
		$this->Cell(12.5, 0.5725, 'Perkembangan Kesehatan');
		$this->Ln();
		for ($i = 1; $i <= 4; $i++) {
			$this->Cell(1.5, 0.5725);
			$this->Cell(12.5, 0.5725, ' .........................................................................................................................');
			$this->Ln();
		}
		$this->Ln(0.75 - 0.5725);
		$this->SetFont('Times', 'B', 11);
		$this->Cell(0.75, 0.5725, 'F.');
		$this->Cell(12.5, 0.5725, 'Meninggalkan Sekolah');
		$this->Ln();
		$this->SetFont('Times', '', 11);
		$kp = array(
			'idsiswa' => $id,
			'jnsmutasi' => '2'
		);
		if (cekdata('tbmutasi', $kp) > 0) {
			$dp = viewdata('tbmutasi', $kp)[0];
			$sebab = 'Pindah Sekolah / Mutasi';
			$tglmutasi = indonesian_date($dp['tglsurat']);
			$nosurat = $dp['nosurat'];
			$nmsmp = $dp['aslkesmp'];
			$alasan = $dp['alasan'];
		} else {
			$kdo = array(
				'idsiswa' => $id,
				'jnsmutasi' => '3'
			);
			if (cekdata('tbmutasi', $kdo) > 0) {
				$do = viewdata('tbmutasi', $kdo)[0];
				$sebab = 'Keluar / Dropout';
				$tglmutasi = indonesian_date($do['tglsurat']);
				$nosurat = $do['nosurat'];
				$nmsmp = $do['aslkesmp'];
				$alasan = $do['alasan'];
			} else {
				$sebab = '-';
				$tglmutasi = '-';
				$nosurat = '-';
				$nmsmp = '-';
				$alasan = '-';
			}
		}
		$this->Cell(0.75, 0.5725);
		$this->Cell(0.75, 0.5725, '1.');
		$this->Cell(4.0, 0.5725, 'Pindah / Keluar');
		$this->Cell(0.25, 0.5725);
		$this->Cell(8.25, 0.5725);
		$this->Ln();
		$this->Cell(1.5, 0.5725);
		$this->Cell(0.5, 0.5725, 'a.');
		$this->Cell(3.5, 0.5725, 'Sebab');
		$this->Cell(0.25, 0.5725, ':');
		$this->Cell(8.25, 0.5725, $sebab);
		$this->Ln();
		$this->Cell(1.5, 0.5725);
		$this->Cell(0.5, 0.5725, 'b.');
		$this->Cell(3.5, 0.5725, 'Nomor Surat');
		$this->Cell(0.25, 0.5725, ':');
		$this->Cell(8.25, 0.5725, $nosurat);
		$this->Ln();
		$this->Cell(1.5, 0.5725);
		$this->Cell(0.5, 0.5725, 'c.');
		$this->Cell(3.5, 0.5725, 'Tanggal');
		$this->Cell(0.25, 0.5725, ':');
		$this->Cell(8.25, 0.5725, $tglmutasi);
		$this->Ln();
		$this->Cell(1.5, 0.5725);
		$this->Cell(0.5, 0.5725, 'd.');
		$this->Cell(3.5, 0.5725, 'Alasan');
		$this->Cell(0.25, 0.5725, ':');
		$this->Cell(8.25, 0.5725, $alasan);
		$this->Ln();
		$this->Cell(1.5, 0.5725);
		$this->Cell(0.5, 0.5725, 'e.');
		$this->Cell(3.5, 0.5725, 'Nama SMP/ MTs');
		$this->Cell(0.25, 0.5725, ':');
		$this->Cell(8.25, 0.5725, $nmsmp);
		$this->Ln();
		$this->Cell(0.75, 0.5725);
		$this->Cell(0.75, 0.5725, '2.');
		$this->Cell(4.0, 0.5725, 'Lulus / Tamat');
		$this->Cell(0.25, 0.5725);
		$this->Cell(8.25, 0.5725);
		$this->Ln();
		$kl = array(
			'idsiswa' => $id
		);
		$ceklulus = cekdata('tblulusan', $kl);
		if ($ceklulus > 0) {
			$dl = viewdata('tblulusan', $kl)[0];
			$tgllulus = indonesian_date($dl['tgllulus']);
			$tglijz0 = indonesian_date($dl['tglijazah']);
			$noijz0 = $dl['noijazah'];
			$nmslta = $dl['nmslta'];
			if ($dl['lanjut'] == '1') {
				$lanjut = 'Ya';
			} else {
				$lanjut = 'Tidak';
			}
		} else {
			$tgllulus = '-';
			$tglijz0 = '-';
			$noijz0 = '-';
			$lanjut = '-';
			$nmslta = '-';
		}
		$this->Cell(1.5, 0.5725);
		$this->Cell(0.5, 0.5725, 'a.');
		$this->Cell(3.5, 0.5725, 'Tanggal Lulus');
		$this->Cell(0.25, 0.5725, ':');
		$this->Cell(8.25, 0.5725, $tgllulus);
		$this->Ln();
		$this->Cell(1.5, 0.5725);
		$this->Cell(0.5, 0.5725, 'b.');
		$this->Cell(3.5, 0.5725, 'Nomor Ijazah');
		$this->Cell(0.25, 0.5725, ':');
		$this->Cell(8.25, 0.5725, $noijz0);
		$this->Ln();
		$this->Cell(1.5, 0.5725);
		$this->Cell(0.5, 0.5725, 'c.');
		$this->Cell(3.5, 0.5725, 'Tanggal Ijazah');
		$this->Cell(0.25, 0.5725, ':');
		$this->Cell(8.25, 0.5725, $tglijz0);
		$this->Ln();
		$this->Cell(1.5, 0.5725);
		$this->Cell(0.5, 0.5725, 'd.');
		$this->Cell(3.5, 0.5725, 'Melanjutkan');
		$this->Cell(0.25, 0.5725, ':');
		$this->Cell(8.25, 0.5725, $lanjut);
		$this->Ln();
		$this->Cell(1.5, 0.5725);
		$this->Cell(0.5, 0.5725, 'e.');
		$this->Cell(3.5, 0.5725, 'Nama SMA / SMK');
		$this->Cell(0.25, 0.5725, ':');
		$this->Cell(8.25, 0.5725, $nmslta);
		$this->Ln(0.75);
		$this->SetFont('Times', 'B', 11);
		$this->Cell(0.75, 0.5725, 'G.');
		$this->Cell(12.5, 0.5725, 'Catatan Penting Lainnya');
		$this->Ln();
		$this->SetFont('Times', '', 11);
		for ($i = 1; $i <= 6; $i++) {
			$this->Cell(0.75, 0.5725);
			$this->Cell(12.5, 0.5725, ' ................................................................................................................................');
			$this->Ln();
		}
		$this->SetCol(0);
	}

	function GetNilaiTitle($id, $hal)
	{
		$ds = viewdata('tbsiswa', array('idsiswa' => $id))[0];
		$nis = $ds['nis'];
		$nisn = $ds['nisn'];
		$nama = $ds['nmsiswa'];
		if ($hal == 1) {
			$this->SetXY(2.75, 1.75);
			$this->SetFont('Times', 'B', 14);
			$this->Cell(29, 0.75, 'LAPORAN HASIL BELAJAR PESERTA DIDIK', 0, 0, 'C');
			$this->SetXY(2.75, 2.75);
			$this->SetFont('Times', '', 11);
			$this->Cell(4, 0.575, 'Nama Peserta Didik', 0, 0, 'L');
			$this->Cell(14.70, 0.575);
			$this->Cell(3.45, 0.575, 'Nomor Induk', 0, 0, 'L');
			$this->Cell(0.575, 0.575);
			$this->Cell(5.75, 0.575, 'Nomor Induk Siswa Nasional', 0, 0, 'L');
			$this->SetXY(2.75, 3.325);
			$this->SetFont('Times', 'B', 12);
			$this->Cell(4, 0.575, strtoupper($nama), 0, 0, 'L');
			$this->Cell(14.70, 0.575);
			$c = strlen($nis);
			$t = 6 - $c;
			for ($i = 1; $i <= $t; $i++) {
				$this->Cell(0.575, 0.575, '0', 1, 0, 'C');
			}
			for ($j = 0; $j < $c; $j++) {
				$this->Cell(0.575, 0.575, substr($nis, $j, 1), 1, 0, 'C');
			}
			$this->Cell(0.575, 0.575);
			for ($k = 0; $k < 10; $k++) {
				$this->Cell(0.575, 0.575, substr($nisn, $k, 1), 1, 0, 'C');
			}
		} else {
			$this->SetXY(2.75, 1.75);
			$this->SetFont('Times', '', 11);
			$this->Cell(4, 0.575, 'Nama Peserta Didik', 0, 0, 'L');
			$this->Cell(14.70, 0.575);
			$this->Cell(3.45, 0.575, 'Nomor Induk', 0, 0, 'L');
			$this->Cell(0.575, 0.575);
			$this->Cell(5.75, 0.575, 'Nomor Induk Siswa Nasional', 0, 0, 'L');
			$this->SetXY(2.75, 2.325);
			$this->SetFont('Times', 'B', 12);
			$this->Cell(4, 0.575, strtoupper($nama), 0, 0, 'L');
			$this->Cell(14.70, 0.575);
			$c = strlen($nis);
			$t = 6 - $c;
			for ($i = 1; $i <= $t; $i++) {
				$this->Cell(0.575, 0.575, '0', 1, 0, 'C');
			}
			for ($j = 0; $j < $c; $j++) {
				$this->Cell(0.575, 0.575, substr($nis, $j, 1), 1, 0, 'C');
			}
			$this->Cell(0.575, 0.575);
			for ($k = 0; $k < 10; $k++) {
				$this->Cell(0.575, 0.575, substr($nisn, $k, 1), 1, 0, 'C');
			}
		}
	}

	function GetTableJudul($id, $kur, $awal, $akhir, $hal)
	{
		$this->SetLineWidth(0);
		$this->SetDrawColor(2, 2, 2);
		$this->SetFont('Times', '', 10);
		if ($kur == '1') {
			$y0 = 4.5;
			$this->SetXY(2.75, $y0);
			$this->Cell(1.0, 1.15, 'No.', 'LTBR', 0, 'C');
			$this->Cell(8.25, 1.15, 'Mata Pelajaran', 'TBR', 0, 'C');
			$this->SetXY(12, $y0);
			$this->Cell(3.6, 0.575, '2016/2017', 'TBR', 0, 'C');
			$this->SetXY(12, $y0 + 0.575);
			$this->Cell(1.8, 0.575, 'I', 'BR', 0, 'C');
			$this->Cell(1.8, 0.575, 'II', 'BR', 0, 'C');
			$i = 0;
			$qthpel = GetKolom($awal, $akhir, 0);
			foreach ($qthpel as $th) {
				if (substr($th['nmthpel'], -1) == '1') {
					$this->SetXY($i * 1.8 + 15.6, $y0);
					$this->Cell(3.6, 0.575, substr($th['desthpel'], 0, 9), 'TBR', 0, 'C');
					$this->SetXY($i * 1.8 + 15.6, $y0 + 0.575);
					$this->Cell(1.8, 0.575, 'I', 'BR', 0, 'C');
				} else {
					$semester = 'II';
					$this->SetXY($i * 1.8 + 15.6, $y0 + 0.575);
					$this->Cell(1.8, 0.575, 'II', 'BR', 0, 'C');
				}
				$i++;
			}
		} else {
			if ($hal == 1) {
				$opset = 0;
				$y0 = 4.5;
				$this->SetXY(2.75, $y0);
			} else {
				$opset = 4;
				$y0 = 3.5;
				$this->SetXY(2.75, $y0);
			}

			$this->Cell(1.0, 1.725, 'No.', 'LTBR', 0, 'C');
			$this->Cell(8.25, 1.725, 'Mata Pelajaran', 'TBR', 0, 'C');
			$i = 0;
			$qthpel = GetKolom($awal, $akhir, $opset);
			if (JmlKolom($awal, $akhir, $opset) == 4) {
				foreach ($qthpel as $th) {
					$this->SetXY($i * 4.8 + 12, $y0);
					$this->Cell(4.8, 0.575, $th['desthpel'], 'TBR', 0, 'C');
					$this->SetXY($i * 4.8 + 12, $y0 + 0.575);
					$this->Cell(2.40, 0.575, 'Pengetahuan', 'BR', 0, 'C');
					$this->Cell(2.40, 0.575, 'Keterampilan', 'BR', 0, 'C');
					$this->SetXY($i * 4.8 + 12, $y0 + 1.15);
					$this->Cell(1.0, 0.575, 'Nilai', 'BR', 0, 'C');
					$this->Cell(1.40, 0.575, 'Predikat', 'BR', 0, 'C');
					$this->Cell(1.0, 0.575, 'Nilai', 'BR', 0, 'C');
					$this->Cell(1.40, 0.575, 'Predikat', 'BR', 0, 'C');
					$i++;
				}
			} else {
				if (CekLulus($id) > 0) {
					foreach ($qthpel as $th) {
						$this->SetXY($i * 4.8 + 12, $y0);
						$this->Cell(4.8, 0.575, $th['desthpel'], 'TBR', 0, 'C');
						$this->SetXY($i * 4.8 + 12, $y0 + 0.575);
						$this->Cell(2.40, 0.575, 'Pengetahuan', 'BR', 0, 'C');
						$this->Cell(2.40, 0.575, 'Keterampilan', 'BR', 0, 'C');
						$this->SetXY($i * 4.8 + 12, $y0 + 1.15);
						$this->Cell(1.0, 0.575, 'Nilai', 'BR', 0, 'C');
						$this->Cell(1.40, 0.575, 'Predikat', 'BR', 0, 'C');
						$this->Cell(1.0, 0.575, 'Nilai', 'BR', 0, 'C');
						$this->Cell(1.40, 0.575, 'Predikat', 'BR', 0, 'C');
						$i++;
					}
					for ($j = $i; $j < 2; $j++) {
						$this->SetXY($j * 4.8 + 12, $y0);
						$this->Cell(4.8, 0.575, '', 'TBR', 0, 'C');
						$this->SetXY($j * 4.8 + 12, $y0 + 0.575);
						$this->Cell(2.40, 0.575, 'Pengetahuan', 'BR', 0, 'C');
						$this->Cell(2.40, 0.575, 'Keterampilan', 'BR', 0, 'C');
						$this->SetXY($j * 4.8 + 12, $y0 + 1.15);
						$this->Cell(1.0, 0.575, 'Nilai', 'BR', 0, 'C');
						$this->Cell(1.40, 0.575, 'Predikat', 'BR', 0, 'C');
						$this->Cell(1.0, 0.575, 'Nilai', 'BR', 0, 'C');
						$this->Cell(1.40, 0.575, 'Predikat', 'BR', 0, 'C');
					}
					$this->SetXY($j * 4.8 + 12, $y0);
					$this->Cell(4.8, 0.575, 'Rata-rata', 'TR', 0, 'C');
					$this->SetXY($j * 4.8 + 12, $y0 + 0.575);
					$this->Cell(4.80, 0.575, 'Nilai Rapor', 'BR', 0, 'C');
					$this->SetXY($j * 4.8 + 12, $y0 + 1.15);
					$this->Cell(2.40, 0.575, 'Pengetahuan', 'BR', 0, 'C');
					$this->Cell(2.40, 0.575, 'Keterampilan', 'BR', 0, 'C');
					$this->SetXY(($j + 1) * 4.8 + 12, $y0);
					$this->Cell(4.8, 0.575, 'Nilai Akhir', 'TR', 0, 'C');
					$this->SetXY(($j + 1) * 4.8 + 12, $y0 + 0.575);
					$this->Cell(4.8, 0.575, 'Kelulusan', 'BR', 0, 'C');
					$this->SetXY(($j + 1) * 4.8 + 12, $y0 + 1.15);
					$this->Cell(2.40, 0.575, 'US', 'BR', 0, 'C');
					$this->Cell(2.40, 0.575, 'Ijazah', 'BR', 0, 'C');
				} else {
					foreach ($qthpel as $th) {
						$this->SetXY($i * 4.8 + 12, $y0);
						$this->Cell(4.8, 0.575, $th['desthpel'], 'TBR', 0, 'C');
						$this->SetXY($i * 4.8 + 12, $y0 + 0.575);
						$this->Cell(2.40, 0.575, 'Pengetahuan', 'BR', 0, 'C');
						$this->Cell(2.40, 0.575, 'Keterampilan', 'BR', 0, 'C');
						$this->SetXY($i * 4.8 + 12, $y0 + 1.15);
						$this->Cell(1.0, 0.575, 'Nilai', 'BR', 0, 'C');
						$this->Cell(1.40, 0.575, 'Predikat', 'BR', 0, 'C');
						$this->Cell(1.0, 0.575, 'Nilai', 'BR', 0, 'C');
						$this->Cell(1.40, 0.575, 'Predikat', 'BR', 0, 'C');
						$i++;
					}
					for ($j = $i; $j < 4; $j++) {
						$this->SetXY($j * 4.8 + 12, $y0);
						$this->Cell(4.8, 0.575, '', 'TBR', 0, 'C');
						$this->SetXY($j * 4.8 + 12, $y0 + 0.575);
						$this->Cell(2.40, 0.575, 'Pengetahuan', 'BR', 0, 'C');
						$this->Cell(2.40, 0.575, 'Keterampilan', 'BR', 0, 'C');
						$this->SetXY($j * 4.8 + 12, $y0 + 1.15);
						$this->Cell(1.0, 0.575, 'Nilai', 'BR', 0, 'C');
						$this->Cell(1.40, 0.575, 'Predikat', 'BR', 0, 'C');
						$this->Cell(1.0, 0.575, 'Nilai', 'BR', 0, 'C');
						$this->Cell(1.40, 0.575, 'Predikat', 'BR', 0, 'C');
					}
				}
			}
		}
	}

	function GetTableIsi($id, $kur, $awal, $akhir, $hal)
	{
		if ($hal == 1) {
			$opset = 0;
			$y0 = 6.225;
			$this->SetXY(2.75, $y0);
		} else {
			$opset = 4;
			$y0 = 5.225;
			$this->SetXY(2.75, $y0);
		}
		$this->SetLineWidth(0);
		$this->SetDrawColor(2, 2, 2);
		$qthpel = GetKolom($awal, $akhir, $opset);
		$j = 0;
		$sqm = "SELECT idmapel, nmmapel FROM tbmapel WHERE idkur='$kur'";
		$qmp = vquery($sqm);
		foreach ($qmp as $mp) {
			$no = $j + 1;
			$this->SetFont('Times', '', 10);
			$this->SetXY(2.75, $j * 0.575 + $y0);
			$this->Cell(1.0, 0.575, $no . '.', 'LBR', 0, 'C');
			$this->SetXY(3.75, $j * 0.575 + $y0);
			$this->Cell(8.25, 0.575, $mp['nmmapel'], 'BR', 0, 'L');
			$i = 0;
			if (JmlKolom($awal, $akhir, $opset) == 4) {
				foreach ($qthpel as $th) {
					$qkog = "SELECT nilairapor,predikat FROM tbnilairapor WHERE idsiswa='$id' AND idmapel='$mp[idmapel]' AND idthpel='$th[idthpel]'AND aspek='3'";
					if (cquery($qkog) == 0) {
						$nilaikog = '';
						$predkog = '';
					} else {
						$kog = vquery($qkog)[0];
						$nilaikog = $kog['nilairapor'];
						$predkog = $kog['predikat'];
					}
					$this->SetXY($i * 4.8 + 12.0, $j * 0.575 + $y0);
					$this->Cell(1.0, 0.575, $nilaikog, 'BR', 0, 'C');
					$this->SetXY($i * 4.8 + 13.0, $j * 0.575 + $y0);
					$this->Cell(1.40, 0.575, $predkog, 'BR', 0, 'C');
					$qmot = "SELECT nilairapor,predikat FROM tbnilairapor WHERE idsiswa='$id' AND idmapel='$mp[idmapel]' AND idthpel='$th[idthpel]'AND aspek='4'";
					if (cquery($qmot) == 0) {
						$nilaimot = '';
						$predmot = '';
					} else {
						$mot = vquery($qmot)[0];
						$nilaimot = $mot['nilairapor'];
						$predmot = $mot['predikat'];
					}
					$this->SetXY($i * 4.8 + 14.4, $j * 0.575 + $y0);
					$this->Cell(1.0, 0.575, $nilaimot, 'BR', 0, 'C');
					$this->SetXY($i * 4.8 + 15.4, $j * 0.575 + $y0);
					$this->Cell(1.40, 0.575, $predmot, 'BR', 0, 'C');
					$i++;
				}
			} else {
				if (CekLulus($id) > 0) {
					foreach ($qthpel as $th) {
						$qkog = "SELECT nilairapor,predikat FROM tbnilairapor WHERE idsiswa='$id' AND idmapel='$mp[idmapel]' AND idthpel='$th[idthpel]'AND aspek='3'";
						if (cquery($qkog) == 0) {
							$nilaikog = '';
							$predkog = '';
						} else {
							$kog = vquery($qkog)[0];
							$nilaikog = $kog['nilairapor'];
							$predkog = $kog['predikat'];
						}
						$this->SetXY($i * 4.8 + 12.0, $j * 0.575 + $y0);
						$this->Cell(1.0, 0.575, $nilaikog, 'BR', 0, 'C');
						$this->SetXY($i * 4.8 + 13.0, $j * 0.575 + $y0);
						$this->Cell(1.40, 0.575, $predkog, 'BR', 0, 'C');
						$qmot = "SELECT nilairapor,predikat FROM tbnilairapor WHERE idsiswa='$id' AND idmapel='$mp[idmapel]' AND idthpel='$th[idthpel]'AND aspek='4'";
						if (cquery($qmot) == 0) {
							$nilaimot = '';
							$predmot = '';
						} else {
							$mot = vquery($qmot)[0];
							$nilaimot = $mot['nilairapor'];
							$predmot = $mot['predikat'];
						}
						$this->SetXY($i * 4.8 + 14.4, $j * 0.575 + $y0);
						$this->Cell(1.0, 0.575, $nilaimot, 'BR', 0, 'C');
						$this->SetXY($i * 4.8 + 15.4, $j * 0.575 + $y0);
						$this->Cell(1.40, 0.575, $predmot, 'BR', 0, 'C');
						$i++;
					}
					for ($k = $i; $k < 2; $k++) {
						$this->SetXY($k * 4.8 + 12.0, $j * 0.575 + $y0);
						$this->Cell(1.0, 0.575, '', 'BR', 0, 'C');
						$this->SetXY($k * 4.8 + 13.0, $j * 0.575 + $y0);
						$this->Cell(1.40, 0.575, '', 'BR', 0, 'C');
						$this->SetXY($k * 4.8 + 14.4, $j * 0.575 + $y0);
						$this->Cell(1.0, 0.575, '', 'BR', 0, 'C');
						$this->SetXY($k * 4.8 + 15.4, $j * 0.575 + $y0);
						$this->Cell(1.40, 0.575, '', 'BR', 0, 'C');
					}
					$qrkog = "SELECT AVG(nilairapor) as kognetif FROM tbnilairapor WHERE idsiswa='$id' AND idmapel='$mp[idmapel]' AND aspek='3' GROUP BY idmapel";
					if (cquery($qrkog) == 0) {
						$nilairkog = '';
					} else {
						$rkog = vquery($qrkog)[0];
						$nilairkog = number_format($rkog['kognetif'], 2, ',', '.');
					}

					$qrmot = "SELECT AVG(nilairapor) as motorik FROM tbnilairapor WHERE idsiswa='$id' AND idmapel='$mp[idmapel]' AND aspek='4' GROUP BY idmapel";
					if (cquery($qrmot) == 0) {
						$nilairmot = '';
					} else {
						$rmot = vquery($qrmot)[0];
						$nilairmot = number_format($rmot['motorik'], 2, ',', '.');
					}
					$this->Cell(2.4, 0.575, $nilairkog, 'BR', 0, 'C');
					$this->Cell(2.4, 0.575, $nilairmot, 'BR', 0, 'C');
					$this->Cell(2.4, 0.575, '', 'BR', 0, 'C');
					$sqijz = "SELECT nilaiijz FROM tbnilaiijz WHERE idsiswa='$id' AND idmapel='$mp[idmapel]'";

					if (
						cquery($sqijz) == 0
					) {
						$nilaijz = '';
					} else {
						$ijz = vquery($sqijz)[0];
						$nilaijz = round($ijz['nilaiijz'], 0);
					}
					$this->Cell(2.4, 0.575, $nilaijz, 'BR', 0, 'C');
				} else {
					foreach ($qthpel as $th) {
						$qkog = "SELECT nilairapor,predikat FROM tbnilairapor WHERE idsiswa='$id' AND idmapel='$mp[idmapel]' AND idthpel='$th[idthpel]'AND aspek='3'";
						if (cquery($qkog) == 0) {
							$nilaikog = '';
							$predkog = '';
						} else {
							$kog = vquery($qkog)[0];
							$nilaikog = $kog['nilairapor'];
							$predkog = $kog['predikat'];
						}
						$this->SetXY($i * 4.8 + 12.0, $j * 0.575 + $y0);
						$this->Cell(1.0, 0.575, $nilaikog, 'BR', 0, 'C');
						$this->SetXY($i * 4.8 + 13.0, $j * 0.575 + $y0);
						$this->Cell(1.40, 0.575, $predkog, 'BR', 0, 'C');
						$qmot = "SELECT nilairapor,predikat FROM tbnilairapor WHERE idsiswa='$id' AND idmapel='$mp[idmapel]' AND idthpel='$th[idthpel]'AND aspek='4'";
						if (cquery($qmot) == 0) {
							$nilaimot = '';
							$predmot = '';
						} else {
							$mot = vquery($qmot)[0];
							$nilaimot = $mot['nilairapor'];
							$predmot = $mot['predikat'];
						}
						$this->SetXY($i * 4.8 + 14.4, $j * 0.575 + $y0);
						$this->Cell(1.0, 0.575, $nilaimot, 'BR', 0, 'C');
						$this->SetXY($i * 4.8 + 15.4, $j * 0.575 + $y0);
						$this->Cell(1.40, 0.575, $predmot, 'BR', 0, 'C');
						$i++;
					}
					for ($k = $i; $k < 4; $k++) {
						$this->SetXY($k * 4.8 + 12.0, $j * 0.575 + $y0);
						$this->Cell(1.0, 0.575, '', 'BR', 0, 'C');
						$this->SetXY($k * 4.8 + 13.0, $j * 0.575 + $y0);
						$this->Cell(1.40, 0.575, '', 'BR', 0, 'C');
						$this->SetXY($k * 4.8 + 14.4, $j * 0.575 + $y0);
						$this->Cell(1.0, 0.575, '', 'BR', 0, 'C');
						$this->SetXY($k * 4.8 + 15.4, $j * 0.575 + $y0);
						$this->Cell(1.40, 0.575, '', 'BR', 0, 'C');
					}
				}
			}
			$j++;
		}
		$y1 = $y0 + 0.125;
		$this->SetXY(2.75, $j * 0.575 + $y1);
		$this->Cell(4.25, 1.15, 'Penilaian Sikap', 'LTBR', 0, 'L');
		$this->Cell(5.0, 0.575, 'Spiritual', 'TR', 0, 'L');
		$this->SetXY(7.0, $j * 0.575 + $y1 + 0.575);
		$this->Cell(5.0, 0.575, 'Sosial', 'TBR', 0, 'L');
		$i = 0;
		if (JmlKolom($awal, $akhir, $opset) == 4) {
			foreach ($qthpel as $th) {
				$qsp = "SELECT nilaisikap FROM tbnilaisikap WHERE idsiswa='$id' AND idthpel='$th[idthpel]' AND aspek='1'";
				if (cquery($qsp) == 0) {
					$nilaisp = '';
				} else {
					$sp = vquery($qsp)[0];
					$nilaisp = KonversiNilai($sp['nilaisikap']);
				}
				$this->SetXY($i * 4.8 + 12, $j * 0.575 + $y1);
				$this->Cell(4.8, 0.575, $nilaisp, 'TBR', 0, 'C');
				$qsos = "SELECT nilaisikap FROM tbnilaisikap WHERE idsiswa='$id' AND idthpel='$th[idthpel]' AND aspek='2'";
				if (cquery($qsos) == 0) {
					$nilaisos = '';
				} else {
					$sos = vquery($qsos)[0];
					$nilaisos = KonversiNilai($sos['nilaisikap']);
				}
				$this->SetXY($i * 4.8 + 12, $j * 0.575 + $y1 + 0.575);
				$this->Cell(4.8, 0.575, $nilaisos, 'BR', 0, 'C');
				$i++;
			}
		} else {
			if (CekLulus($id) > 0) {
				foreach ($qthpel as $th) {
					$qsp = "SELECT nilaisikap FROM tbnilaisikap WHERE idsiswa='$id' AND idthpel='$th[idthpel]' AND aspek='1'";
					if (cquery($qsp) == 0) {
						$nilaisp = '';
					} else {
						$sp = vquery($qsp)[0];
						$nilaisp = KonversiNilai($sp['nilaisikap']);
					}
					$this->SetXY($i * 4.8 + 12, $j * 0.575 + $y1);
					$this->Cell(4.8, 0.575, $nilaisp, 'TBR', 0, 'C');

					$qsos = "SELECT nilaisikap FROM tbnilaisikap WHERE idsiswa='$id' AND idthpel='$th[idthpel]' AND aspek='2'";
					if (cquery($qsos) == 0) {
						$nilaisos = '';
					} else {
						$sos = vquery($qsos)[0];
						$nilaisos = KonversiNilai($sos['nilaisikap']);
					}
					$this->SetXY($i * 4.8 + 12, $j * 0.575 + $y1 + 0.575);
					$this->Cell(4.8, 0.575, $nilaisos, 'BR', 0, 'C');
					$i++;
				}
				$qsp = "SELECT AVG(nilaisikap) AS akspr FROM tbnilaisikap WHERE idsiswa='$id' AND aspek='1' GROUP BY idsiswa";
				if (cquery($qsp) == 0) {
					$nilairsp = '';
				} else {
					$sp = vquery($qsp)[0];
					$nilairsp = KonversiNilai($sp['akspr']);
				}
				$qso = "SELECT AVG(nilaisikap) AS aksos FROM tbnilaisikap WHERE idsiswa='$id' AND aspek='2' GROUP BY idsiswa";
				if (cquery($qso) == 0) {
					$nilairso = '';
				} else {
					$so = vquery($qso)[0];
					$nilairso = KonversiNilai($so['aksos']);
				}
				$this->SetXY($k * 4.8 + 12.0, $j * 0.575 + $y1);
				$this->Cell(9.6, 0.575, $nilairsp, 'TBR', 0, 'C');
				$this->SetXY($k * 4.8 + 12.0, $j * 0.575 + $y1 + 0.575);
				$this->Cell(9.6, 0.575, $nilairso, 'BR', 0, 'C');
			} else {
				foreach ($qthpel as $th) {
					$qsp = "SELECT nilaisikap FROM tbnilaisikap WHERE idsiswa='$id' AND idthpel='$th[idthpel]' AND aspek='1'";
					if (cquery($qsp) == 0) {
						$nilaisp = '';
					} else {
						$sp = vquery($qsp)[0];
						$nilaisp = KonversiNilai($sp['nilaisikap']);
					}
					$this->SetXY($i * 4.8 + 12, $j * 0.575 + $y1);
					$this->Cell(4.8, 0.575, $nilaisp, 'TBR', 0, 'C');

					$qsos = "SELECT nilaisikap FROM tbnilaisikap WHERE idsiswa='$id' AND idthpel='$th[idthpel]' AND aspek='2'";
					if (cquery($qsos) == 0) {
						$nilaisos = '';
					} else {
						$sos = vquery($qsos)[0];
						$nilaisos = KonversiNilai($sos['nilaisikap']);
					}
					$this->SetXY($i * 4.8 + 12, $j * 0.575 + $y1 + 0.575);
					$this->Cell(4.8, 0.575, $nilaisos, 'BR', 0, 'C');
					$i++;
				}
				for ($k = $i; $k < 4; $k++) {
					$this->SetXY($k * 4.8 + 12, $j * 0.575 + $y1);
					$this->Cell(4.8, 0.575, '', 'TBR', 0, 'C');
					$this->SetXY($k * 4.8 + 12, $j * 0.575 + $y1 + 0.575);
					$this->Cell(4.8, 0.575, '', 'BR', 0, 'C');
				}
			}
		}
		$y2 = $y0 + 1.4;
		$this->SetXY(2.75, $j * 0.575 + $y2);
		$sqleks = "SELECT idekskul, nmekskul FROM tbnilaiekskul INNER JOIN tbekskul USING(idekskul) WHERE idsiswa='$id' GROUP BY idekskul";
		$jeks = cquery($sqleks);
		if ($jeks > 0) {
			$this->Cell(4.25, 0.575 * $jeks, 'Kegiatan Ekstrakurikuler', 'LTBR', 0, 'L');
			$deks = vquery($sqleks);
			$k = 0;
			foreach ($deks as $eks) {
				$this->SetXY(7.0, ($j + $k) * 0.575 + $y2);
				if ($k == 0) {
					$brd = 'TBR';
				} else {
					$brd = 'BR';
				}
				$this->Cell(5.0, 0.575, $eks['nmekskul'], $brd, 0, 'L');
				$i = 0;
				if (JmlKolom($awal, $akhir, $opset) == 4) {
					foreach ($qthpel as $th) {
						$qneks = "SELECT nilaieks FROM tbnilaiekskul WHERE idsiswa='$id' AND idekskul='$eks[idekskul]' AND idthpel='$th[idthpel]'";
						if (cquery($qneks) == 0) {
							$nilaiekskul = '';
						} else {
							$neks = vquery($qneks)[0];
							$nilaieks = KonversiNilai($neks['nilaieks']);
							$nilaiekskul = str_replace('A (Amat Baik)', 'SB (Sangat Baik)', $nilaieks);
						}

						$this->SetXY($i * 4.8 + 12.0, ($j + $k) * 0.575 + $y2);
						$this->Cell(4.8, 0.575, $nilaiekskul, $brd, 0, 'C');
						$i++;
					}
				} else {
					if (CekLulus($id) > 0) {
						foreach ($qthpel as $th) {
							$qneks = "SELECT nilaieks FROM tbnilaiekskul WHERE idsiswa='$id' AND idekskul='$eks[idekskul]' AND idthpel='$th[idthpel]'";
							if (cquery($qneks) == 0) {
								$nilaiekskul = '';
							} else {
								$neks = vquery($qneks)[0];
								$nilaieks = KonversiNilai($neks['nilaieks']);
								$nilaiekskul = str_replace('A (Amat Baik)', 'SB (Sangat Baik)', $nilaieks);
							}

							$this->SetXY($i * 4.8 + 12.0, ($j + $k) * 0.575 + $y2);
							$this->Cell(4.8, 0.575, $nilaiekskul, $brd, 0, 'C');
							$i++;
						}

						$qreks = "SELECT AVG(nilaieks) as nrkpeks FROM tbnilaiekskul WHERE idsiswa='$id' AND idekskul='$eks[idekskul]' GROUP BY idekskul";
						if (cquery($qreks) == 0) {
							$nilaiekskul = '';
						} else {
							$reks = vquery($qreks)[0];
							$nilaieks = KonversiNilai(round($reks['nrkpeks']));
							$nilaiekskul = str_replace('A (Amat Baik)', 'SB (Sangat Baik)', $nilaieks);
						}

						$this->Cell(9.6, 0.575, $nilaiekskul, $brd, 0, 'C');
					} else {
						foreach ($qthpel as $th) {
							$qneks = "SELECT nilaieks FROM tbnilaiekskul WHERE idsiswa='$id' AND idekskul='$eks[idekskul]' AND idthpel='$th[idthpel]'";
							if (cquery($qneks) == 0) {
								$nilaiekskul = '';
							} else {
								$neks = vquery($qneks)[0];
								$nilaieks = KonversiNilai($neks['nilaieks']);
								$nilaiekskul = str_replace('A (Amat Baik)', 'SB (Sangat Baik)', $nilaieks);
							}

							$this->SetXY($i * 4.8 + 12.0, ($j + $k) * 0.575 + $y2);
							$this->Cell(4.8, 0.575, $nilaiekskul, $brd, 0, 'C');
							$i++;
						}
						for ($l = $i; $l < 4; $l++) {
							$this->SetXY($l * 4.8 + 12.0, ($j + $k) * 0.575 + $y2);
							$this->Cell(4.8, 0.575, '', $brd, 0, 'C');
						}
					}
				}
				$k++;
			}
		} else {
			$sqleks = "SELECT idekskul, nmekskul FROM tbekskul LIMIT 3";
			$jeks = cquery($sqleks);
			$this->Cell(4.25, 0.575 * $jeks, 'Kegiatan Ekstrakurikuler', 'LTBR', 0, 'L');
			$deks = vquery($sqleks);
			$k = 0;
			foreach ($deks as $eks) {
				$this->SetXY(7.0, ($j + $k) * 0.575 + $y2);
				if ($k == 0) {
					$brd = 'TBR';
				} else {
					$brd = 'BR';
				}
				$this->Cell(5.0, 0.575, $eks['nmekskul'], $brd, 0, 'L');
				$i = 0;
				if (JmlKolom($awal, $akhir, $opset) == 4) {
					foreach ($qthpel as $th) {
						$this->SetXY($i * 4.8 + 12.0, ($j + $k) * 0.575 + $y2);
						$this->Cell(4.8, 0.575, '', $brd, 0, 'C');
						$i++;
					}
				} else {
					foreach ($qthpel as $th) {
						$this->SetXY($i * 4.8 + 12.0, ($j + $k) * 0.575 + $y2);
						$this->Cell(4.8, 0.575, '', $brd, 0, 'C');
						$i++;
					}
					for ($l = $i; $l < 4; $l++) {
						$this->SetXY($l * 4.8 + 12.0, ($j + $k) * 0.575 + $y2);
						$this->Cell(4.8, 0.575, '', $brd, 0, 'C');
					}
				}
				$k++;
			}
		}
		$y3 = $y0 + 1.525;
		$this->SetXY(2.75, ($j + $k) * 0.575 + $y3);
		$this->Cell(4.25, 1.725, 'Ketidakhadiran', 'LTBR', 0, 'L');
		$this->Cell(5.0, 0.575, 'Sakit', 'TBR', 0, 'L');
		$this->SetXY(7.0, ($j + $k) * 0.575 + $y3 + 0.575);
		$this->Cell(5.0, 0.575, 'Izin', 'BR', 0, 'L');
		$this->SetXY(7.0, ($j + $k) * 0.575 + $y3 + 1.15);
		$this->Cell(5.0, 0.575, 'Tanpa Keterangan', 'BR', 0, 'L');
		$i = 0;
		if (JmlKolom($awal, $akhir, $opset) == 4) {
			foreach ($qthpel as $th) {
				$qabs = "SELECT sakit, izin, alpa FROM tbabsensi WHERE idsiswa='$id' AND idthpel='$th[idthpel]'";
				if (cquery($qabs) == 0) {
					$sakit = '';
					$ijin = '';
					$alpa = '';
				} else {
					$abs = vquery($qabs)[0];
					$sakit = RapikanAbsen($abs['sakit']);
					$ijin = RapikanAbsen($abs['izin']);
					$alpa = RapikanAbsen($abs['alpa']);
				}
				$this->SetXY($i * 4.8 + 12, ($j + $k) * 0.575 + $y3);
				$this->Cell(4.8, 0.575, $sakit, 'TBR', 0, 'C');
				$this->SetXY($i * 4.8 + 12, ($j + $k) * 0.575 + $y3 + 0.575);
				$this->Cell(4.8, 0.575, $ijin, 'BR', 0, 'C');
				$this->SetXY($i * 4.8 + 12, ($j + $k) * 0.575 + $y3 + 1.15);
				$this->Cell(4.8, 0.575, $alpa, 'BR', 0, 'C');
				$i++;
			}
		} else {
			if (CekLulus($id) > 0) {
				foreach ($qthpel as $th) {
					$qabs = "SELECT sakit, izin, alpa FROM tbabsensi WHERE idsiswa='$id' AND idthpel='$th[idthpel]'";
					if (cquery($qabs) == 0) {
						$sakit = '';
						$ijin = '';
						$alpa = '';
					} else {
						$abs = vquery($qabs)[0];
						$sakit = RapikanAbsen($abs['sakit']);
						$ijin = RapikanAbsen($abs['izin']);
						$alpa = RapikanAbsen($abs['alpa']);
					}
					$this->SetXY($i * 4.8 + 12, ($j + $k) * 0.575 + $y3);
					$this->Cell(4.8, 0.575, $sakit, 'TBR', 0, 'C');
					$this->SetXY($i * 4.8 + 12, ($j + $k) * 0.575 + $y3 + 0.575);
					$this->Cell(4.8, 0.575, $ijin, 'BR', 0, 'C');
					$this->SetXY($i * 4.8 + 12, ($j + $k) * 0.575 + $y3 + 1.15);
					$this->Cell(4.8, 0.575, $alpa, 'BR', 0, 'C');
					$i++;
				}
				$this->SetXY($i * 4.8 + 12, ($j + $k) * 0.575 + $y3);
				$this->Cell(9.6, 0.575, '', 'TBR', 0, 'C');
				$this->SetXY($i * 4.8 + 12, ($j + $k) * 0.575 + $y3 + 0.575);
				$this->Cell(9.6, 0.575, '', 'BR', 0, 'C');
				$this->SetXY($i * 4.8 + 12, ($j + $k) * 0.575 + $y3 + 1.15);
				$this->Cell(9.6, 0.575, '', 'BR', 0, 'C');
			} else {
				foreach ($qthpel as $th) {
					$qabs = "SELECT sakit, izin, alpa FROM tbabsensi WHERE idsiswa='$id' AND idthpel='$th[idthpel]'";
					if (cquery($qabs) == 0) {
						$sakit = '';
						$ijin = '';
						$alpa = '';
					} else {
						$abs = vquery($qabs)[0];
						$sakit = RapikanAbsen($abs['sakit']);
						$ijin = RapikanAbsen($abs['izin']);
						$alpa = RapikanAbsen($abs['alpa']);
					}
					$this->SetXY($i * 4.8 + 12, ($j + $k) * 0.575 + $y3);
					$this->Cell(4.8, 0.575, $sakit, 'TBR', 0, 'C');
					$this->SetXY($i * 4.8 + 12, ($j + $k) * 0.575 + $y3 + 0.575);
					$this->Cell(4.8, 0.575, $ijin, 'BR', 0, 'C');
					$this->SetXY($i * 4.8 + 12, ($j + $k) * 0.575 + $y3 + 1.15);
					$this->Cell(4.8, 0.575, $alpa, 'BR', 0, 'C');
					$i++;
				}
				for ($m = $i; $m < 4; $m++) {
					$this->SetXY($m * 4.8 + 12, ($j + $k) * 0.575 + $y3);
					$this->Cell(4.8, 0.575, '', 'TBR', 0, 'C');
					$this->SetXY($m * 4.8 + 12, ($j + $k) * 0.575 + $y3 + 0.575);
					$this->Cell(4.8, 0.575, '', 'BR', 0, 'C');
					$this->SetXY($m * 4.8 + 12, ($j + $k) * 0.575 + $y3 + 1.15);
					$this->Cell(4.8, 0.575, '', 'BR', 0, 'C');
				}
			}
		}
		$y4 = $y0 + 3.375;
		$y5 = $y4 + 0.575;
		$y6 = $y5 + 0.575;
		$this->SetXY(2.75, ($j + $k) * 0.575 + $y4);
		$this->Cell(4.25, 1.725, 'Keputusan Akhir Tahun', 1, 0, 'L');
		$this->Cell(5.0, 0.575, 'Naik Kelas / Lulus / Mengulang', 'TBR', 0, 'L');
		$this->SetXY(7.0, ($j + $k) * 0.575 + $y4 + 0.575);
		$this->Cell(5.0, 0.575, 'Tanggal', 'BR', 0, 'L');
		$this->SetXY(7.0, ($j + $k) * 0.575 + $y4 + 1.15);
		$this->Cell(5.0, 0.575, 'Catatan ', 'BR', 0, 'L');
		$i = 0;
		if (JmlKolom($awal, $akhir, $opset) == 4) {
			foreach ($qthpel as $th) {
				if (substr($th['nmthpel'], -1) == '2') {
					$ctt = IsiKepAkhir($id, $th['idthpel']);
					$this->SetXY($i * 4.8 + 12, ($j + $k) * 0.575 + $y4);
					$this->Cell(4.8, 0.575, $ctt['catatan'], 'TBR', 0, 'C');
					$this->SetXY($i * 4.8 + 12, ($j + $k) * 0.575 + $y5);
					$this->Cell(4.8, 0.575, $ctt['tgl'], 'BR', 0, 'C');
					$this->SetXY($i * 4.8 + 12, ($j + $k) * 0.575 + $y6);
					$this->Cell(4.8, 0.575, $ctt['lainnya'], 'BR', 0, 'C');
				} else {
					$this->SetXY($i * 4.8 + 12, ($j + $k) * 0.575 + $y4);
					$this->Cell(4.8, 0.575, '', 'TBR', 0, 'C');
					$this->SetXY($i * 4.8 + 12, ($j + $k) * 0.575 + $y5);
					$this->Cell(4.8, 0.575, '', 'BR', 0, 'C');
					$this->SetXY($i * 4.8 + 12, ($j + $k) * 0.575 + $y6);
					$this->Cell(4.8, 0.575, '', 'BR', 0, 'C');
				}
				$i++;
			}
		} else {
			if (CekLulus($id) > 0) {
				foreach ($qthpel as $th) {
					if (substr($th['nmthpel'], -1) == '2') {
						$ctt = IsiKepAkhir($id, $th['idthpel']);
						$this->SetXY($i * 4.8 + 12, ($j + $k) * 0.575 + $y4);
						$this->Cell(4.8, 0.575, $ctt['catatan'], 'TBR', 0, 'C');
						$this->SetXY($i * 4.8 + 12, ($j + $k) * 0.575 + $y5);
						$this->Cell(4.8, 0.575, $ctt['tgl'], 'BR', 0, 'C');
						$this->SetXY($i * 4.8 + 12, ($j + $k) * 0.575 + $y6);
						$this->Cell(4.8, 0.575, $ctt['lainnya'], 'BR', 0, 'C');
					} else {
						$this->SetXY($i * 4.8 + 12, ($j + $k) * 0.575 + $y4);
						$this->Cell(4.8, 0.575, '', 'TBR', 0, 'C');
						$this->SetXY($i * 4.8 + 12, ($j + $k) * 0.575 + $y5);
						$this->Cell(4.8, 0.575, '', 'BR', 0, 'C');
						$this->SetXY($i * 4.8 + 12, ($j + $k) * 0.575 + $y6);
						$this->Cell(4.8, 0.575, '', 'BR', 0, 'C');
					}
					$i++;
				}
				$this->SetXY($i * 4.8 + 12, ($j + $k) * 0.575 + $y4);
				$this->Cell(9.6, 0.575, '', 'TBR', 0, 'C');
				$this->SetXY($i * 4.8 + 12, ($j + $k) * 0.575 + $y5);
				$this->Cell(9.6, 0.575, '', 'BR', 0, 'C');
				$this->SetXY($i * 4.8 + 12, ($j + $k) * 0.575 + $y6);
				$this->Cell(9.6, 0.575, '', 'BR', 0, 'C');
			} else {
				foreach ($qthpel as $th) {
					if (substr($th['nmthpel'], -1) == '2') {
						$ctt = IsiKepAkhir($id, $th['idthpel']);
						$this->SetXY($i * 4.8 + 12, ($j + $k) * 0.575 + $y4);
						$this->Cell(4.8, 0.575, $ctt['catatan'], 'TBR', 0, 'C');
						$this->SetXY($i * 4.8 + 12, ($j + $k) * 0.575 + $y5);
						$this->Cell(4.8, 0.575, $ctt['tgl'], 'BR', 0, 'C');
						$this->SetXY($i * 4.8 + 12, ($j + $k) * 0.575 + $y6);
						$this->Cell(4.8, 0.575, $ctt['lainnya'], 'BR', 0, 'C');
					} else {
						$this->SetXY($i * 4.8 + 12, ($j + $k) * 0.575 + $y4);
						$this->Cell(4.8, 0.575, '', 'TBR', 0, 'C');
						$this->SetXY($i * 4.8 + 12, ($j + $k) * 0.575 + $y5);
						$this->Cell(4.8, 0.575, '', 'BR', 0, 'C');
						$this->SetXY($i * 4.8 + 12, ($j + $k) * 0.575 + $y6);
						$this->Cell(4.8, 0.575, '', 'BR', 0, 'C');
					}
					$i++;
				}
				for ($l = $i; $l < 4; $l++) {
					foreach ($qthpel as $th) {
						$this->SetXY($l * 4.8 + 12, ($j + $k) * 0.575 + $y4);
						$this->Cell(4.8, 0.575, '', 'TBR', 0, 'C');
						$this->SetXY($l * 4.8 + 12, ($j + $k) * 0.575 + $y5);
						$this->Cell(4.8, 0.575, '', 'BR', 0, 'C');
						$this->SetXY($l * 4.8 + 12, ($j + $k) * 0.575 + $y6);
						$this->Cell(4.8, 0.575, '', 'BR', 0, 'C');
						$i++;
					}
				}
			}
		}
	}
	function IsiCover($id)
	{
		$this->SetLineWidth(0.125);
		$this->Rect(2.75, 2.0, 28.5, 17.25, 1);
		$this->AddFont('HappyMonkey-Regular', '', 'HappyMonkey.php');
		$this->SetXY(2.75, 3.25);
		$this->SetFont('HappyMonkey-Regular', '', 36.5);
		$this->Cell(29, 0.575, 'BUKU INDUK PESERTA DIDIK', 0, 0, 'C');
		$this->SetXY(2.75, 4.75);
		$this->SetFont('HappyMonkey-Regular', '', 28.5);
		$sql = "SELECT LEFT(desthpel,9) as tahune FROM tbthpel WHERE idthpel='$id' GROUP BY tahune";
		$th = vquery($sql)[0];
		$this->Cell(29, 0.575, 'TAHUN PELAJARAN ' . str_replace('/', ' / ', $th['tahune']), 0, 0, 'C');
		$this->Image('images/logo.png', 14.5, 7.5, 4.5);
		$this->SetFont('Times', '', 12);
		$this->SetXY(2.75, 15.75);
		$ds = viewdata('tbskul')[0];
		$this->SetFont('Times', 'B', 18);
		$this->Cell(29, 0.575, strtoupper($ds['nmskpd']), 0, 0, 'C');
		$this->SetXY(2.75, 16.5);
		$this->Cell(29, 0.575, strtoupper($ds['nmskul']), 0, 0, 'C');
	}

	function PrintCover($id)
	{
		$this->AddPage();
		$this->IsiCover($id);
	}
	function PrintBiodata($id)
	{
		$this->SetLineWidth(0.001);
		$this->SetMargins(2.75, 1.75, 1.25);
		$this->SetAutoPageBreak(true, 2);
		$this->AddPage();
		$this->BiodataTitle($id);
		$this->BiodataIsi($id);
	}

	function PrintNilai($id, $kur)
	{
		$this->SetLineWidth(0.001);
		$cekregis = CekRegis($id);
		$cekmutasi = CekMutasi($id);
		$cekdo = CekDropOut($id);
		if ($cekregis >= 6) {
			$qthakhir = "SELECT MIN(idthpel) as awal, MAX(idthpel) as akhir FROM tbregistrasi WHERE idsiswa='$id'";
			$tha = vquery($qthakhir)[0];
			$akhir = $tha['akhir'];
			$awal = $tha['awal'];
		} else {
			if (CekLulus($id) > 0) {;
				$qpake = "SELECT idthpel FROM tbregistrasi WHERE idsiswa='$id' AND idjreg<'8' ORDER BY idthpel";
				$kepake = cquery($qpake);
				$qreg = "SELECT r.idthpel FROM tbregistrasi r WHERE idsiswa='$id' AND idjreg='8'";
				$reg = vquery($qreg)[0];
				$batas = $reg['idthpel'];

				$qkabeh = "SELECT idthpel FROM tbthpel WHERE idthpel<='$batas'";
				$kabeh = cquery($qkabeh);
				if ($kabeh > 6) {
					$ofset = $kabeh - $kepake;
				} else {
					$ofset = 0;
				}
				$qthpel = "SELECT idthpel FROM tbthpel WHERE idthpel<='$batas' LIMIT 6 OFFSET $ofset";
				$thp = vquery($qthpel);
				foreach ($thp as $th) {
					$tahun[] = $th['idthpel'];
				}
				$awal = min($tahun);
				$akhir = max($tahun);
			} else {
				$qthakhir = "SELECT MIN(idthpel) as awal, MAX(idthpel) as akhir FROM tbregistrasi WHERE idsiswa='$id' AND idjreg<'6'";
				$tha = vquery($qthakhir)[0];
				$akhir = $tha['akhir'];
				$awal = $tha['awal'];
			}
		}

		$qthpel = "SELECT idthpel FROM tbthpel WHERE idthpel BETWEEN '$awal' AND '$akhir'";
		$nthpel = cquery($qthpel);
		$hal = ceil($nthpel / 4);
		for ($i = 1; $i <= $hal; $i++) {
			$this->SetMargins(2.75, 1.75, 1.25);
			$this->SetAutoPageBreak(true, 2);
			$this->AddPage();
			$this->GetNilaiTitle($id, $i);
			$this->GetTableJudul($id, $kur, $awal, $akhir, $i);
			$this->GetTableIsi($id, $kur, $awal, $akhir, $i);
		}
	}
}
$pdf = new PDF('L', 'cm', array(21.5, 33.0));
$title = 'Laporan Buku Induk';
$pdf->SetTitle($title);
$pdf->SetAuthor('Kasworo Wardani, S.T');
$awal = $_GET['awal'];
$akhir = $_GET['akhir'];
$qthpel = "SELECT idthpel FROM tbthpel WHERE idthpel BETWEEN '$awal' AND '$akhir' GROUP BY LEFT(nmthpel,4)";
$qthn = vquery($qthpel);
foreach ($qthn as $thn) {
	//$pdf->PrintCover($thn['idthpel']);
	$sql = "SELECT si.idsiswa, rd.idkur FROM tbsiswa si INNER JOIN tbregistrasi rg USING(idsiswa) INNER JOIN tbthpel th USING(idthpel) INNER JOIN tbregistrasi_detil rd USING(idreg) WHERE th.idthpel BETWEEN '$awal' AND '$akhir' AND (rg.idjreg='1' OR rg.idjreg='2') AND si.idsiswa='7' ORDER BY si.nis";
	$qsiswa = vquery($sql);
	foreach ($qsiswa as $ds) {
		$pdf->PrintBiodata($ds['idsiswa']);
		$pdf->PrintNilai($ds['idsiswa'], $ds['idkur']);
	}
}
$pdf->Output();
