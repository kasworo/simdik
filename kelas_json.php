<?php
    include "dbfunction.php";
    // $m=$conn->query("SELECT*FROM tbrombel WHERE idrombel='$_POST[id]'");
    $keys=array('idrombel'=>$_POST['id']);
    $m=viewdata('tbrombel',$keys)[0];
    echo json_encode($m);
?>