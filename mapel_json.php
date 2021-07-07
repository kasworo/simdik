<?php
    include "config/function_kbm.php";
    $id=$_POST['id'];
    $qkur="SELECT*FROM tbmapel WHERE idmapel='$id'";
    $kur=viewkurikulum($qkur);
    foreach($kur as $k){
        $rows=array(
            'idkur'=>$k['idkur'],
            'idmapel'=>$k['idmapel'],
            'nmmapel'=>$k['nmmapel'],
            'akmapel'=>$k['akmapel']
        );
    }
    echo json_encode($rows);
?>