<?php
$host = "localhost";
$user = "root";
$pwd = "";
$db = "dbsimdik";
$conn = new mysqli($host, $user, $pwd, $db);
if (mysqli_connect_errno()) {
	echo "Error: Could not connect to database. ";
	exit;
}

function indonesian_date($date)
{
	$indonesian_month = array(
		"Januari", "Februari", "Maret",
		"April", "Mei", "Juni",
		"Juli", "Agustus", "September",
		"Oktober", "November", "Desember"
	);
	$year = substr($date, 0, 4);
	$month = substr($date, 5, 2);
	$currentdate = substr($date, 8, 2);
	if ($month >= 1) {
		$result = $currentdate . " " . $indonesian_month[(int) $month - 1] . " " . $year;
	} else {
		$result = '';
	}
	return $result;
}
function isithpel()
{
	$tahun = date('Y');
	$bulan = date('m');
	if ($bulan <= 12) {
		if ($bulan > 6) {
			$tahun = $tahun;
			$semester = '1';
			$nmsemester = 'Ganjil';
			$tgl = strtotime("07/01" . $tahun);
			$awal = date('Y-m-d', $tgl);
		} else {
			$tahun = $tahun - 1;
			$semester = '2';
			$nmsemester = 'Genap';
			$tgl = strtotime("01/01" . $tahun);
			$awal = date('Y-m-d', $tgl);
		}
	}
	$tahun1 = $tahun + 1;
	$ay = $tahun . $semester;
	$nama = $tahun . '/' . $tahun1 . '-' . $nmsemester;
	$key = array(
		'nmthpel' => $ay
	);
	$cek = cekdata('tbthpel', $key);
	if ($cek == 0) {
		$data = array(
			'nmthpel' => $ay,
			'desthpel' => $nama,
			'awal' => $awal,
			'aktif' => '1'
		);
		editdata('tbthpel', array('aktif' => '0'),);
		adddata('tbthpel', $data);
	}
}
function getagama($idagm)
{
	switch ($idagm) {
		case 'A': {
				$agama = 'Islam';
				break;
			}
		case 'B': {
				$agama = 'Kristen';
				break;
			}
		case 'C': {
				$agama = 'Katholik';
				break;
			}
		case 'D': {
				$agama = 'Hindu';
				break;
			}
		case 'E': {
				$agama = 'Buddha';
				break;
			}
		default: {
				$agama = '-';
				break;
			}
	}
	return $agama;
}

function getgender($id)
{
	if ($id == 'L') {
		$jk = 'Laki-laki';
	} else {
		$jk = 'Perempuan';
	}
	return $jk;
}

function getwni($id)
{
	if ($id == '1') {
		$wn = 'Warga Negara Indonesia';
	} else if ($id == '2') {
		$wn = 'Warga Negara Asing';
	} else {
		$wn = '-';
	}
	return $wn;
}

function gettinggal($id)
{
	switch ($id) {
		case '1': {
				$tggl = 'Orangtua';
				break;
			}
		case '2': {
				$tggl = 'Wali Murid';
				break;
			}
		case '3': {
				$tggl = 'Kost';
				break;
			}
		case '4': {
				$tggl = 'Asrama';
				break;
			}
		default: {
				$tggl = '-';
				break;
			}
	}
	return $tggl;
}

function gettrans($id)
{
	switch ($id) {
		case '1': {
				$trns = 'Jalan Kaki';
				break;
			}
		case '2': {
				$trns = 'Sepeda';
				break;
			}
		case '3': {
				$trns = 'Sepeda Motor';
				break;
			}
		case '4': {
				$trns = 'Ojek';
				break;
			}
		case '5': {
				$trns = 'Angkutan Umum';
				break;
			}
		case '6': {
				$trns = 'Angkutan Antar Jemput';
				break;
			}
	}
	return $trns;
}

function getpenyakit($id)
{
	switch ($id) {
		case '0': {
				$skt = 'Tidak Ada';
				break;
			}
		case '1': {
				$skt = 'Demam Berdarah';
				break;
			}
		case '2': {
				$skt = 'Malaria';
				break;
			}
		case '3': {
				$skt = 'Asma';
				break;
			}
		case '4': {
				$skt = 'Campak';
				break;
			}
		case '5': {
				$skt = 'TBC';
				break;
			}
		case '6': {
				$skt = 'Tetanus';
				break;
			}
		case '7': {
				$skt = 'Pneumonia';
				break;
			}
		case '8': {
				$skt = 'Jantung';
				break;
			}
		default: {
				$skt = '-';
				break;
			}
	}
	return $skt;
}

function getkebkhusus($id)
{
	switch ($id) {
		case '0': {
				$kbthn = 'Tidak Ada';
				break;
			}
		case '1': {
				$kbthn = 'Tuna Daksa';
				break;
			}
		case '2': {
				$kbthn = 'Tuna Rungu';
				break;
			}
		case '3': {
				$kbthn = 'Tuna Wicara';
				break;
			}
		case '4': {
				$kbthn = 'Tuna Netra';
				break;
			}
		case '5': {
				$kbthn = 'Tuna Grahita';
				break;
			}
		case '6': {
				$kbthn = 'Down Syndrome';
				break;
			}
		case '7': {
				$kbthn = 'Autisme';
				break;
			}
		default: {
				$kbthn = '-';
				break;
			}
	}
	return $kbthn;
}

function getdarah($id)
{
	switch ($id) {
		case '0': {
				$goldarah = 'Tidak Tahu';
				break;
			}
		case '1': {
				$goldarah = 'A';
				break;
			}
		case '2': {
				$goldarah = 'B';
				break;
			}
		case '3': {
				$goldarah = 'AB';
				break;
			}
		case '4': {
				$goldarah = 'O';
				break;
			}
	}
	return $goldarah;
}

function KonversiHuruf($hrf)
{
	if (is_numeric($hrf)) {
		$angka = $hrf;
	} else {
		if ($hrf == 'A' || $hrf == 'SB') {
			$angka = 4;
		} else if ($hrf == 'B') {
			$angka = 3;
		} else if ($hrf == 'C') {
			$angka = 2;
		} else if ($hrf == 'D' || $hrf == 'K') {
			$angka = 1;
		} else {
			$angka = 0;
		}
	}
	return $angka;
}

function KonversiRomawi($angka)
{
	switch ($angka) {
		case '1': {
				$romawi = 'i';
				break;
			}
		case '2': {
				$romawi = 'ii';
				break;
			}
		case '3': {
				$romawi = 'iii';
				break;
			}
		case '4': {
				$romawi = 'iv';
				break;
			}
		case '5': {
				$romawi = 'v';
				break;
			}
		case '6': {
				$romawi = 'vi';
				break;
			}
		case '7': {
				$romawi = 'vii';
				break;
			}
		case '8': {
				$romawi = 'viii';
				break;
			}
		case '9': {
				$romawi = 'ix';
				break;
			}
	}
	return strtoupper($romawi);
}

function getskulortu($id)
{
	if (isset($id)) {
		$data = viewdata('ref_pendidikan', array('idpddk' => $id))[0];
		return $data['pendidikan'];
	} else {
		return "-";
	}
}

function getkethdp($id)
{
	if ($id == '0') {
		return 'Masih Hidup';
	} else if ($id == '1') {
		return "Sudah Meninggal";
	} else {
		return "-";
	}
}

function getkerjaortu($id)
{
	if (isset($id)) {
		$data = viewdata('ref_pekerjaan', array('idkerja' => $id))[0];
		return $data['pekerjaan'];
	} else {
		return "-";
	}
}

function getgajiortu($id)
{
	if (isset($id)) {
		$data = viewdata('ref_penghasilan', array('idhsl' => $id))[0];
		return $data['penghasilan'];
	} else {
		return "-";
	}
}

function getregis($id)
{
	$data = viewdata('ref_jnsregistrasi', array('idjreg' => $id))[0];
	return $data['jnsregistrasi'];
}
function getskul()
{
	$data = viewdata('tbskul')[0];
	return $data['idskul'];
}
function getidsiswa($nis, $nisn)
{
	$sql = "SELECT idsiswa FROM tbsiswa WHERE nis='$nis' OR nisn='$nisn'";
	$data = vquery($sql)[0];
	return $data['idsiswa'];
}

function vquery($sql)
{
	global $conn;
	$rows = [];
	$result = $conn->query($sql);
	while ($row = $result->fetch_assoc()) {
		$rows[] = $row;
	}
	return $rows;
}

function cquery($sql)
{
	global $conn;
	//var_dump($sql);
	$result = $conn->query($sql);
	return $result->num_rows;
}


function viewdata($tbl, $key = '', $grup = '', $ord = '')
{
	global $conn;
	if ($key == '') {
		if ($grup == '' && $ord == '') {
			$sql = "SELECT*FROM $tbl";
		} else if ($grup == '') {
			$sql = "SELECT*FROM $tbl ORDER BY $ord";
		} else {
			$sql = "SELECT*FROM $tbl GROUP BY $grup";
		}
	} else {
		$where = [];
		foreach ($key as $wh => $nil) {
			$where[] = "$wh = '$nil'";
		}
		if ($grup == '' && $ord == '') {
			$sql = "SELECT*FROM $tbl WHERE " . implode(' AND ', $where);
		} else if ($grup == '') {
			$sql = "SELECT*FROM $tbl WHERE " . implode(' AND ', $where) . " ORDER BY $ord";
		} else {
			$sql = "SELECT*FROM $tbl WHERE " . implode(' AND ', $where) . " GROUP BY $grup";
		}
	}
	//var_dump($sql);
	$rows = [];
	$result = $conn->query($sql);
	while ($row = $result->fetch_assoc()) {
		$rows[] = $row;
	}
	return $rows;
}

function cekdata($tbl, $key = '', $grup = '', $ord = '')
{
	global $conn;
	if ($key == '') {
		if ($grup == '' && $ord == '') {
			$sql = "SELECT*FROM $tbl";
		} else if ($grup == '') {
			$sql = "SELECT*FROM $tbl ORDER BY $ord";
		} else {
			$sql = "SELECT*FROM $tbl GROUP BY $grup";
		}
	} else {
		$where = [];
		foreach ($key as $wh => $nil) {
			$where[] = "$wh = '$nil'";
		}
		if ($grup == '' && $ord == '') {
			$sql = "SELECT*FROM $tbl WHERE " . implode(' AND ', $where);
		} else if ($grup == '') {
			$sql = "SELECT*FROM $tbl WHERE " . implode(' AND ', $where) . " ORDER BY $ord";
		} else {
			$sql = "SELECT*FROM $tbl WHERE " . implode(' AND ', $where) . " GROUP BY $grup";
		}
	}
	//var_dump($sql);
	$result = $conn->query($sql);
	return $result->num_rows;
}

function adddata($tbl, $data)
{
	global $conn;
	$key = array_keys($data);
	$val = array_values($data);
	$sql = "INSERT INTO $tbl (" . implode(', ', $key) . ") VALUES ('" . implode("', '", $val) . "')";
	$conn->query($sql);
	return $conn->affected_rows;
}

function editdata($tbl, $data, $join = '', $field = '')
{
	global $conn;
	$cols = [];
	foreach ($data as $key => $val) {
		$cols[] = "$key = '$val'";
	}
	$where = [];
	foreach ($field as $wh => $nil) {
		$where[] = "$wh = '$nil'";
	}

	if ($join == '') {
		$sql = "UPDATE $tbl SET " . implode(', ', $cols) . " WHERE " . implode(' AND ', $where);
	} else {
		$tbjoin = [];
		foreach ($join as $joins => $idjoins) {
			$tbjoin[] = "$joins USING($idjoins)";
		}
		$sql = "UPDATE $tbl INNER JOIN " . implode(' ', $tbjoin) . " SET " . implode(', ', $cols) . " WHERE " . implode(' AND ', $where);
	}
	$conn->query($sql);
	return $conn->affected_rows;
}
