<?php
	function cekgtk($data){
		global $conn;
		$sql=$conn->query($data);
		return $sql->num_rows;
	}	
	
    function viewgtk($data){
		global $conn;
		$sql=$conn->query($data);
		$rows=[];
		while($row=$sql->fetch_assoc()){
			$rows[]=$row;
		}
		
		return $rows;
	}
	
	function addgtk($data,$m){
		global $conn;
		$idskul=$data['idskul'];
		$nama=$data['nmgtk'];
		$nik=$data['nik'];
		$nip=$data['nip'];
		$tmplahir=$data['tmplahir'];
		$tgllahir=$data['tgllahir'];
		$gender=$data['gender'];
		$agama=$data['agama'];
		$kepeg=$data['stsp'];
		$jbtd=$data['jbtd'];
		$email=$data['imel'];
		$almt=$data['almt'];
		$desa=$data['desa'];
		$kec=$data['kec'];
		$kab=$data['kab'];
		$prov=$data['prov'];
		$kdpos=$data['kdpos'];
		$nohp=$data['nohp'];
		if($m=='1'){
			$foto=fotogtk($nik);
			if(!$foto){
				return false;
			}
			$sql="INSERT INTO tbgtk (nama, nik, nip, tmplahir, tgllahir, gender, agama, kepeg, jbtdinas, email, alamat, desa, kec, kab, prov, kdpos, nohp, foto, idskul) VALUES ('$nama','$nik','$nip','$tmplahir','$tgllahir','$gender','$agama','$kepeg', '$jbtd','$email','$almt','$desa','$kec','$kab','$prov','$kdpos','$nohp',$foto,'$idskul')";
		}
		if($m=='2')
		{
			$sql="INSERT INTO tbgtk (nama, nik, nip, tmplahir, tgllahir, gender, agama, kepeg, jbtdinas, email, alamat, desa, kec, kab, prov, kdpos, nohp, idskul) VALUES ('$nama','$nik','$nip','$tmplahir','$tgllahir','$gender','$agama','$kepeg', '$jbtd','$email','$almt','$desa','$kec','$kab','$prov','$kdpos','$nohp', '$idskul')";
		}
		$conn->query($sql);
		return $conn->affected_rows;
	}

	function editgtk($data,$m){
		global $conn;
		$id=$data['idgtk'];
		$nama=$data['nmgtk'];
		$nik=$data['nik'];
		$nip=$data['nip'];
		$tmplahir=$data['tmplahir'];
		$tgllahir=$data['tgllahir'];
		$gender=$data['gender'];
		$agama=$data['agama'];
		$kepeg=$data['stsp'];
		$jbtd=$data['jbtd'];
		$email=$data['imel'];
		$almt=$data['almt'];
		$desa=$data['desa'];
		$kec=$data['kec'];
		$kab=$data['kab'];
		$prov=$data['prov'];
		$kdpos=$data['kdpos'];
		$nohp=$data['nohp'];
        if($m=='1'){
			$fotolama=$data['fotolama'];
			if($_FILES['foto']['error']===4){
            	$foto=$fotolama;
        	}
			else {
				$foto=fotogtk($nik);        
			}
			$sql="UPDATE tbgtk SET nama='$nama', nip='$nip', nik='$nik', tmplahir='$tmplahir', tgllahir='$tgllahir', gender='$gender', agama='$agama', kepeg='$kepeg', jbtdinas='$jbtd', email='$email', alamat='$almt', desa='$desa', kec='$kec', kab='$kab', prov='$prov', kdpos='$kdpos', nohp='$nohp', foto='$foto' WHERE idgtk='$id'";
		}
		if($m=='2') {
			$sql="UPDATE tbgtk SET nama='$nama', nip='$nip', nik='$nik', tmplahir='$tmplahir', tgllahir='$tgllahir', gender='$gender', agama='$agama', kepeg='$kepeg', jbtdinas='$jbtd', email='$email', alamat='$almt', desa='$desa', kec='$kec', kab='$kab', prov='$prov', kdpos='$kdpos', nohp='$nohp' WHERE idgtk='$id'";
		}
		$conn->query($sql);
		return $conn->affected_rows;
	}
	
	function fotogtk($data){
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
                        toastr.warning('Ukuran File Lebih Dari 840 KB','Mohon Maaf',{
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
?> 