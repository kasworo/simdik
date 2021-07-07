<?php
    function ceksiswa($data){
        global $conn;
        $sql=$conn->query($data);
        return $sql->num_rows;
    }
    function viewsiswa($data){
        global $conn;
        $sql=$conn->query($data);
        $rows=[];
        while($row=$sql->fetch_assoc()){
            $rows[]=$row;
        }
        return $rows;
    }
    
    function addsiswa($data,$m){
        global $conn;        
        $idskul=$data['idskul'];
        $nama=$data['nmsiswa'];
        $nik=$data['nik'];
        $nis=$data['nis'];
        $nisn=$data['nisn'];
        $tmplahir=$data['tmplahir'];
        $tgllahir=$data['tgllahir'];
        $gender=$data['gender'];
        $agama=$data['agama'];
        $anak=$data['anake'];
        $sdr=$data['saudara'];
        $wni=$data['warganegara'];
        $gld=$data['goldarah'];
        $skt=$data['penyakit'];
        $keb=$data['kebkhusus'];
        $ikt=$data['reftgl'];
        $trans=$data['transpor'];
        $jrk=$data['jarak'];
        $wkt=$data['waktu'];
        $almt=$data['almt'];
        $desa=$data['desa'];
        $kec=$data['kec'];
        $kab=$data['kab'];
        $prov=$data['prov'];
        $kdpos=$data['kdpos'];
        $ltg=$data['longitude'];
        $bjr=$data['latitude'];
        $nohp=$data['nohp'];
        $olahrg=$data['olahrg'];
        $seni=$data['seni'];
        $orgns=$data['orgns'];
        $lain=$data['lain'];
        if($m=='1'){         
            $foto=fotosiswa($nisn);
            if(!$foto){
                return false;
            }
            $sql="INSERT INTO tbsiswa (nmsiswa, nik, nis, nisn, tmplahir, tgllahir, gender, idagama, warganegara, anake, sdr, goldarah, kebkhusus, rwysakit, ikuts, jarak, waktu, transpr, alamat, desa, kec, kab, prov, kdpos, lintang, bujur, nohp, fotosiswa, hobi1, hobi2, hobi3, hobi4, deleted, idskul) VALUES ('$nama', '$nik','$nis', '$nisn', '$tmplahir', '$tgllahir', '$gender', '$agama', '$wni', '$anak', '$sdr', '$gld', '$keb', '$skt', '$ikt', '$jrk', '$wkt', '$trans', '$almt', '$desa', '$kec', '$kab', '$prov', '$kdpos', '$ltg', '$bjr', '$nohp', '$foto','$olahrg', '$seni', '$orgns', '$lain', '0', '$idskul')";
            
        }
        else {
            $sql="INSERT INTO tbsiswa (nmsiswa, nik, nis, nisn, tmplahir, tgllahir, gender, idagama, warganegara, anake, sdr, goldarah, kebkhusus, rwysakit, ikuts, jarak, waktu, transpr, alamat, desa, kec, kab, prov, kdpos, lintang, bujur, nohp, hobi1, hobi2, hobi3, hobi4, deleted, idskul) VALUES ('$nama', '$nik','$nis', '$nisn', '$tmplahir', '$tgllahir', '$gender', '$agama', '$wni', '$anak', '$sdr', '$gld', '$keb', '$skt', '$ikt', '$jrk', '$wkt', '$trans', '$almt', '$desa', '$kec', '$kab', '$prov', '$kdpos', '$ltg', '$bjr', '$nohp', '$olahrg', '$seni', '$orgns', '$lain', '0', '$idskul')";
            
        }
        $conn->query($sql);
        return $conn->affected_rows;
    }
    
    function editsiswa($data,$m){
        global $conn;
        $idskul=$data['idskul'];
        $id=$data['idsiswa'];
        $nama=$data['nmsiswa'];
        $nik=$data['nik'];
        $nis=$data['nis'];
        $nisn=$data['nisn'];
        $tmplahir=$data['tmplahir'];
        $tgllahir=$data['tgllahir'];
        $gender=$data['gender'];
        $agama=$data['agama'];
        $anak=$data['anake'];
        $sdr=$data['saudara'];
        $wni=$data['warganegara'];
        $gld=$data['goldarah'];
        $skt=$data['penyakit'];
        $keb=$data['kebkhusus'];
        $ikt=$data['reftgl'];
        $trans=$data['transpor'];
        $jrk=$data['jarak'];
        $wkt=$data['waktu'];
        $almt=$data['almt'];
        $desa=$data['desa'];
        $kec=$data['kec'];
        $kab=$data['kab'];
        $prov=$data['prov'];
        $kdpos=$data['kdpos'];
        $ltg=$data['longitude'];
        $bjr=$data['latitude'];
        $nohp=$data['nohp'];
        $olahrg=$data['olahrg'];
        $seni=$data['seni'];
        $orgns=$data['orgns'];
        $lain=$data['lain']; 
        $fotolama=$data['fotolama'];
        if($m=='1'){
            if($_FILES['foto']['error']===4){
                $foto=$fotolama;
            }
            else {
                $foto=fotosiswa($nisn);        
            }
            $sql="UPDATE tbsiswa SET nmsiswa = '$nama', nik = '$nik', nis = '$nis', nisn = '$nisn', tmplahir = '$tmplahir', tgllahir = '$tgllahir', gender = '$gender', idagama = '$agama', warganegara = '$wni', anake = '$anak', sdr = '$sdr', goldarah = '$gld', rwysakit = '$skt', kebkhusus = '$keb', ikuts = '$ikt', jarak = '$jrk', waktu = '$wkt', transpr = '$trans', alamat = '$almt', desa = '$desa', kec = '$kec', kab = '$kab', prov = '$prov', kdpos = '$kdpos', lintang = '$ltg', bujur = '$bjr', nohp = '$nohp', hobi1 = '$olahrg', hobi2 = '$seni', hobi3 = '$orgns', hobi4 = '$lain', fotosiswa='$foto' WHERE idsiswa = '$id'";
        }
        else {
            $sql="UPDATE tbsiswa SET nmsiswa = '$nama', nik = '$nik', tmplahir = '$tmplahir', tgllahir = '$tgllahir', gender = '$gender', idagama = '$agama', warganegara = '$wni', anake = '$anak', sdr = '$sdr', goldarah = '$gld', rwysakit = '$skt', kebkhusus = '$keb', ikuts = '$ikt', jarak = '$jrk', waktu = '$wkt', transpr = '$trans', alamat = '$almt', desa = '$desa', kec = '$kec', kab = '$kab', prov = '$prov', kdpos = '$kdpos', lintang = '$ltg', bujur = '$bjr', nohp = '$nohp', hobi1 = '$olahrg', hobi2 = '$seni', hobi3 = '$orgns', hobi4 = '$lain' WHERE (nisn = '$nisn' OR nis='$nis')  AND idskul='$idskul'";
        
        }
        $conn->query($sql);
        return $conn->affected_rows;
    }

    function fotosiswa($data){
        $maxsize=1024*840;
        $namafile=$_FILES['foto']['name'];
        $ukuranfile=$_FILES['foto']['size'];
        $error=$_FILES['foto']['error'];
        $tmpname=$_FILES['foto']['tmp_name'];
        
        if($error === 4){
            echo "<script>
                    $(function() {
                        toastr.warning('Tidak Ada File Yang Diupload','Mohon Maaf',{
                            timeOut:1000,
                            fadeOut:1000,
                            onHidden:function(){
                                $('#foto').focus();
                            }
                        });
                    });
                </script>";
            return false;
        }
        
        $ekstensivalid=['jpg', 'jpeg', 'png'];
        $ekstensifile=explode('.',$namafile);
        $ekstensifile=strtolower(end($ekstensifile));
        if(!in_array($ekstensifile,$ekstensivalid)){
            echo "<script>
                    $(function() {
                        toastr.warning('File Yang Anda Upload Bukan Gambar!','Mohon Maaf',{
                            timeOut:1000,
                            fadeOut:1000,
                            onHidden:function(){
                                $('#foto').focus();
                            }
                        });
                    });
                </script>";
                return false;
        }

        if($ukuranfile>$maxsize){
            echo "<script>
                    $(function() {
                        toastr.warning('Ukuran File Lebih Dari 840 KB','Mohon Maaf,{
                            timeOut:1000,
                            fadeOut:1000,
                            onHidden:function(){
                                $('#foto').focus();
                            }
                        });
                    });
                </script>";
        return false;
        }
        $filefoto=sha1($data);
        $filefoto.= '.';
        $filefoto.= $ekstensifile;
        
        move_uploaded_file($tmpname,'foto/'.$filefoto);
        return $filefoto;
    }

    function addriwayat($data){
        global $conn;
        $id=$data['idsiswa'];
        $reg=$data['idreg'];
        $aslsd = $data['aslsd'];
        $noijz = $data['noijz'];
        $tglijz = $data['tglijz'];
        $lamasd = $data['lamasd'];
        $aslsmp = $data['aslsmp'];
        $nosrt = $data['nosrt'];
        $tglsrt = $data['tglsrt'];
        $alasan = $data['alasan'];
        if($reg=='1'){
            $sql="INSERT INTO tbriwayatskul (idjreg, idsiswa, aslsd, noijazah, tglijazah, lama) VALUES ('$reg', '$id', '$aslsd', '$noijz', '$tglijz', '$lamasd')";
        }
        else{
                $sql="INSERT INTO tbriwayatskul (idjreg, idsiswa, aslsd, noijazah, tglijazah, lama, aslsmp, nosurat, tglsurat, alasan) VALUES ('$reg', '$id', '$aslsd', '$noijz', '$tglijz', '$lamasd', '$aslsmp', '$nosrt', '$tglsrt', '$alasan')";
        }
        $conn->query($sql);
        return $conn->affected_rows;
    }

    function editriwayat($data){
        global $conn;
        $id=$data['idsiswa'];
        $reg=$data['idreg'];
        $aslsd = $data['aslsd'];
        $noijz = $data['noijz'];
        $tglijz = $data['tglijz'];
        $lamasd = $data['lamasd'];
        $aslsmp = $data['aslsmp'];
        $nosrt = $data['nosrt'];
        $tglsrt = $data['tglsrt'];
        $alasan = $data['alasan'];
        if($reg=='1'){
            $sql="UPDATE tbriwayatskul SET aslsd='$aslsd', noijazah='$noijz', tglijazah='$tglijz', lama='$lamasd' WHERE idsiswa='$id'";
        }
        else {
            $sql="UPDATE tbriwayatskul SET aslsd='$aslsd', noijazah='$noijz', tglijazah='$tglijz', lama='$lamasd', aslsmp='$aslsmp', nosurat='$nosurat', tglsurat='$tglsrt', alasan='$alasan' WHERE idsiswa='$id'";
        }
        $conn->query($sql);
        return $conn->affected_rows;
    }

    function addortu($data){
        global $conn;
        $id=$data['idsiswa'];
        $nmortu=$data['nmortu'];
        $nik=$data['nik'];
        $tmplahir=$data['tmplahir'];
        $tgllahir=$data['tgllahir'];
        $agama=$data['agama'];
        $pddk=$data['pddkortu'];
        $hdp=$data['hidup'];
        $krj=$data['krjortu'];
        $hsl=$data['hslortu'];
        $hubkel=$data['hubkel'];
        $almt=$data['almt'];
        $desa=$data['desa'];
        $kec=$data['kec'];
        $kab=$data['kab'];
        $prov=$data['prov'];
        $kdpos=$data['kdpos'];
        $nohp=$data['nohp'];
        $sql="INSERT INTO tbortu (idsiswa, nmortu, nik, tmplahir, tgllahir, idagama, idpddk, hidup, idkerja, idhsl, hubkel, alamat, desa, kec, kab, prov, kdpos, nohp) VALUES ('$id', '$nmortu', '$nik', '$tmplahir', '$tgllahir', '$agama', '$pddk', '$hdp','$krj', '$hsl', '$hubkel','$almt', '$desa', '$kec', '$kab', '$prov', '$kdpos', '$nohp')";
        $conn->query($sql);
        return $conn->affected_rows;     
    }
    
    function editortu($data){
        global $conn;
        $id=$data['idsiswa'];
        $nmortu=$data['nmortu'];
        $nik=$data['nik'];
        $tmplahir=$data['tmplahir'];
        $tgllahir=$data['tgllahir'];
        $agama=$data['agama'];
        $pddk=$data['pddkortu'];
        $hdp=$data['hidup'];
        $krj=$data['krjortu'];
        $hsl=$data['hslortu'];
        $hubkel=$data['hubkel'];
        $almt=$data['almt'];
        $desa=$data['desa'];
        $kec=$data['kec'];
        $kab=$data['kab'];
        $prov=$data['prov'];
        $kdpos=$data['kdpos'];
        $nohp=$data['nohp'];
        $sql="UPDATE tbortu SET nmortu = '$nmortu', nik = '$nik', tmplahir = '$tmplahir', tgllahir = '$tgllahir', idagama = '$agama', idpddk = '$pddk', hidup='$hdp',idkerja = '$krj', idhsl = '$hsl', hubkel='$hubkel',alamat = '$almt', desa = '$desa', kec = '$kec', kab = '$kab', prov = '$prov', kdpos = '$kdpos', nohp = '$nohp' WHERE idsiswa = '$id' AND hubkel='$hubkel'";
        $conn->query($sql);
        return $conn->affected_rows;     
    }
?>