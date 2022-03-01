<?php
    include "dbfunction.php";
    $keys=array('idmapel' => $_POST['id']);
    $k=viewdata('tbmapel',$keys)[0];
    $rows=array(
        'idkur'=>$k['idkur'],
        'idmapel'=>$k['idmapel'],
        'nmmapel'=>$k['nmmapel'],
        'akmapel'=>$k['akmapel']
    );
    echo json_encode($rows);
