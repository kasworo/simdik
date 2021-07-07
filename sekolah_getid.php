<?php
    if (!function_exists('getidskul')) {
        function getidskul()  {
            include "../config/konfigurasi.php";
            $cekskul=mysqli_query($sqlconn, "SELECT kdskul FROM tb_skul");
            $cek=mysqli_fetch_array($cekskul);
            $kdskul=$cek['kdskul'];
            return $kdskul;
        }
    }
?>