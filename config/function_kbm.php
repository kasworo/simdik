<?php
    function viewkurikulum($data){
        global $conn;
        $sql=$conn->query($data);
        $rows=[];
        while($row=$sql->fetch_assoc()){
            $rows[]=$row;
        }
        return $rows;
    }
    function addkurikulum($data){
        global $conn;
        $nmkur=$data['nmkur'];
        $akkur=$data['akkur'];
        $sql="INSERT INTO tbkurikulum (nmkur, akkur, aktif) VALUES ('$nmkur','$akkur','1')";
        $conn->query($sql);
        return $conn->affected_rows;
    }
    function editkurikulum($data){
        global $conn;
        $idkur=$data['idkur'];
        $nmkur=$data['nmkur'];
        $akkur=$data['akkur'];
        $sql="UPDATE tbkurikulum SET nmkur='$nmkur', akkur='$akkur' WHERE idkur='$idkur'";
        $conn->query($sql);
        return $conn->affected_rows;

    }

    function addmapel($data){
        global $conn;
        $idkur=$data['idkur'];
        $nmmapel=$data['nmmapel'];
        $akmapel=$data['akmapel'];
        $sql="INSERT INTO tbmapel (idkur, nmmapel, akmapel) VALUES ('$idkur','$nmmapel','$akmapel')";
        $conn->query($sql);
        return $conn->affected_rows;
    }

    function editmapel($data){
        global $conn;
        $idmapel=$data['idmapel'];
        $idkur=$data['idkur'];
        $nmmapel=$data['nmmapel'];
        $akmapel=$data['akmapel'];
        $sql="UPDATE tbmapel SET idkur='$idkur', nmmapel='$nmmapel', akmapel='$akmapel' WHERE idmapel='$idmapel'";
        $conn->query($sql);
        return $conn->affected_rows;
    }

    function addrombel($data){
        global $conn;
        $idthpel=$data['idthpel'];
        $idkur=$data['kdkur'];
        $kdkls=$data['kdkelas'];
        $idrombel=$data['idrombel'];
        $nmrombel=$data['nmrombel'];
        $walas=$data['idwalas'];
        $sql="INSERT INTO tbrombel (idkelas, nmrombel, idthpel, idkur, idgtk) VALUES ('$kdkls', '$nmrombel', '$idtahun', '$idkur', '$walas')";
        $conn->query($sql);
        return $conn->affected_rows;
    }

    function editrombel($data){
        global $conn;
        $idthpel=$data['idthpel'];
        $idkur=$data['kdkur'];
        $kdkls=$data['kdkelas'];
        $idrombel=$data['idrombel'];
        $nmrombel=$data['nmrombel'];
        $walas=$data['idwalas'];
        $sql="UPDATE tbrombel SET idkur='$idkur', idgtk='$walas', nmrombel= '$nmrombel' WHERE idrombel='$idthpel'";
        $conn->query($sql);
        return $conn->affected_rows;
    }

    function delrombel($data){
        global $conn;
        $sql="DELETE FROM tbrombel WHERE idrombel='$data";
        $conn->query($sql);
        return $conn->affected_rows;
    }