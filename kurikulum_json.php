<?php
    include "dbfunction.php";;
    $kur=viewdata('tbkurikulum',array('idkur'=>$_POST['id']));
    foreach($kur as $k){
        $rows=array(
            'idkur'=>$k['idkur'],
            'nmkur'=>$k['nmkur'],
            'akkur'=>$k['akkur']
        );
    }
    echo json_encode($rows);
?>