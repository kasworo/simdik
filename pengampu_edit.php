<?php
    include "../config/konfigurasi.php";
    
    $qam=$conn->query("SELECT a.*, r.idkelas FROM tbpengampu a INNER JOIN tbmapel m USING(idmapel) INNER JOIN tbrombel r USING(idrombel) WHERE a.idampu='$_POST[id]' AND a.idthpel='$_COOKIE[c_tahun]'");
    $am=$qam->fetch_array();
    echo json_encode($am);
?>