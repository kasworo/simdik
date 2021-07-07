<?php
    function getskul(){
        global $conn;
        $kdskul=$_COOKIE['kdskul'];
        if($kdskul!==hash('sha256',$sk['kdskul'])){
            return false;
        }
        $sql=$conn->query("SELECT*FROM tbskul");
        $row=$sql->fetch_assoc();
        $idskul=$row['idskul'];
        return $idskul;
    }

    function viewskul(){
        global $conn;

        $idskul=$_COOKIE['kdskul'];
        $sql=$conn->query("SELECT*FROM tbskul");
        $row=$sql->fetch_assoc();
        return $row;    
    }

    function tambahskul($data){
        global $conn;
        $kode=$data['kode'];
        $nama=$conn->real_escape_string($data['nama']);
        $npsn=$data['npsn'];
        $nss=$data['nss'];
        $skpd=$data['skpd'];
        $almt=$data['almt'];
        $desa=$data['desa'];
        $kec=$data['kec'];
        $kab=$data['kab'];
        $prov=$data['prov'];
        $kdpos=$data['kdpos'];
        $web=$data['web'];
        $imel=$data['imel'];
        $sql=$conn->query("UPDATE tbskul SET nmskul='$nama', npsn='$npsn', nss='$oss', nmskpd='$skpd',alamat='$almt',desa='$desa', kec='$kec', kab='$kab', prov='$prov', kdpos='$kdpos', website='$webs', email='$imel' WHERE kdskul='$kode'");
        $row=$conn->affected_rows;
        return $row;
    }

    function updateskul($data){
        global $conn;
        $kode=$data['kode'];
        $nama=$conn->real_escape_string($data['nama']);
        $npsn=$data['npsn'];
        $nss=$data['nss'];
        $skpd=$data['skpd'];
        $almt=$data['almt'];
        $desa=$data['desa'];
        $kec=$data['kec'];
        $kab=$data['kab'];
        $prov=$data['prov'];
        $kdpos=$data['kdpos'];
        $web=$data['web'];
        $imel=$data['imel'];
        $sql=$conn->query("UPDATE tbskul SET nmskul='$nama', npsn='$npsn', nss='$oss', nmskpd='$skpd',alamat='$almt',desa='$desa', kec='$kec', kab='$kab', prov='$prov', kdpos='$kdpos', website='$webs', email='$imel' WHERE kdskul='$kode'");
        $row=$conn->affected_rows;
        return $row;
    }
?>