<?php
    include "config/function_kbm.php";
    $id=$_POST['id'];
    $qkur="SELECT*FROM tbkurikulum WHERE idkur='$id'";
    $kur=viewkurikulum($qkur);
    foreach($kur as $k){
        $rows=array(
            'idkur'=>$k['idkur'],
            'nmkur'=>$k['nmkur'],
            'akkur'=>$k['akkur']
        );
    }
    echo json_encode($rows);
?>