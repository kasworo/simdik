<?php
include "dbfunction.php";
$sql = "SELECT s.idsiswa, s.nmsiswa, r.idjreg, r.idthpel FROM tbregistrasi r INNER JOIN tbsiswa s USING(idsiswa) INNER JOIN tbthpel tp USING(idthpel) WHERE s.idsiswa='$_POST[id]' AND tp.aktif='1'";
$cek = cquery($sql);
if ($cek > 0) {
    $judul = 'Edit Registrasi Peserta Didik';
    $tmb = "<i class='fas fa-save'></i> Update";
    $m = vquery($sql)[0];
    $data = array(
        'idsiswa' => $m['idsiswa'],
        'nmsiswa' => ucwords(strtolower($m['nmsiswa'])),
        'regis' => $m['idjreg'],
        'tahun' => $m['idthpel'],
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
        'regis' => '',
        'tahun' => '',
        'judul' => $judul,
        'tmb' => $tmb
    );
}
echo json_encode($data);
