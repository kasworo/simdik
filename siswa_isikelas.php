<?php
include "dbfunction.php";
$sql = "SELECT s.idsiswa, s.nmsiswa, r.idjreg, rd.idkelas, r.idthpel FROM tbsiswa s INNER JOIN tbregistrasi r USING(idsiswa) INNER JOIN tbthpel tp USING(idthpel) LEFT JOIN tbregistrasi_detil rd USING(idreg) LEFT JOIN tbkelas k USING(idkelas) WHERE s.idsiswa='$_POST[id]' AND tp.aktif='1' AND r.idjreg<6";

$cek = cquery($sql);
if ($cek > 0) {
    $judul = 'Edit Registrasi Peserta Didik';
    $tmb = "<i class='fas fa-save'></i> Update";
    $m = vquery($sql)[0];
    $data = array(
        'idsiswa' => $m['idsiswa'],
        'nmsiswa' => ucwords(strtolower($m['nmsiswa'])),
        'kelas' => $m['idkelas'],
        'tahun' => $m['idthpel'],
        'regis' => $m['idjreg'],
        'judul' => $judul,
        'tmb' => $tmb
    );
} else {
    $judul = 'Registrasi Peserta Didik';
    $tmb = "<i class='fas fa-save'></i> Simpan";
    $sql = "SELECT s.idsiswa, s.nmsiswa FROM tbsiswa s WHERE s.deleted='0' AND s.idsiswa='$_POST[id]'";
    $m = vquery($sql)[0];
    $data = array(
        'idsiswa' => $m['idsiswa'],
        'nmsiswa' => ucwords(strtolower($m['nmsiswa'])),
        'kelas' => '',
        'tahun' => '',
        'regis' => '',
        'judul' => $judul,
        'tmb' => $tmb
    );
}


echo json_encode($data);
