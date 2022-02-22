<?php
if (!function_exists('getsiswaid')) {
    function getsiswaid()
    {
        include "../config/konfigurasi.php";
        $cekskul = mysqli_query($sqlconn, "SELECT kdskul FROM tbskul");
        $cek = mysqli_fetch_array($cekskul);
        $kdskul = $cek['kdskul'];
        $sql = mysqli_query($sqlconn, "SELECT COUNT(*) as jsiswa FROM tbsiswa");
        $row = mysqli_fetch_array($sql);
        $id = $row['jsiswa'] + 1;
        if ($id < 8) {
            $cekdigit = 10 - ($id % 9 + 1);
        } else {
            $cekdigit = 10 - ($id % 8 + 1);
        }
        $idsiswa = 'G' . substr('00' . $id, -3) . $cekdigit;
        return $idsiswa;
    }
}