<?php
    include "config/konfigurasi.php";
    $qm=$conn->query("SELECT*FROM tbkompetensi WHERE idkd='$_POST[id]'");
    $m=$qm->fetch_array();
    echo json_encode($m);
?>