<?php
	require_once 'assets/library/PHPExcel.php';
	require_once 'assets/library/excel_reader.php';
	
	if(empty($_FILES['filepd']['tmp_name'])) { 
		echo "<script>
			$(function() {
				toastr.error('File Template Peserta Didik Kosong!','Mohon Maaf!',{
					timeOut:1000,
					fadeOut:1000
				});
			});
		</script>";	
	} else {
		$data = new Spreadsheet_Excel_Reader($_FILES['filepd']['tmp_name']);
		$baris = $data->rowcount($sheet_index=0);
		$isidata=$baris-5;
		$sukses = 0;
		$gagal = 0;
		$update=0;	
		for ($i=6; $i<=$baris; $i++)
		{
			$xnik=$data->val($i,2);		
			$xnis=$data->val($i,3);
			$xnisn=$data->val($i,4);
			$xnama= $conn->real_escape_string($data->val($i,5));
			$xtmplhr = $data->val($i,6); 
			$xtgllhr = $data->val($i,7); 
			$xjekel = $data->val($i,8); 
			$nmagama = $data->val($i,9);
			$xanak=$data->val($i,10);
			$xsdr=$data->val($i,11);
			$xdrh=$data->val($i,12);
			$xsakit=$data->val($i,13);
			$xkeb=$data->val($i,14);
			$xikut=$data->val($i,15);
			$xtrans=$data->val($i,16);
			$xjrk=$data->val($i,17);
			$xwkt=$data->val($i,18);
			$xltg=$data->val($i,19);
			$xbjr=$data->val($i,20);
			$xalmt = $data->val($i,21);
			$xdesa	= $data->val($i,22);
			$xkec	= $data->val($i,23);
			$xkab	= $data->val($i,24);
			$xprov = $data->val($i,25);
			$xkdpos = $data->val($i,26);
			$xnohp = $data->val($i,27);
			$xolga = $data->val($i,28);
			$xseni = $data->val($i,29);
			$xorgn = $data->val($i,30);
			$xlain = $data->val($i,31);
			if(strlen($nmagama)==1){$xagama=$nmagama;}
				else {
					switch ($nmagama) {
					case 'Islam':{ $xagama='A';break;}
					case 'Kristen':{ $xagama='B';break;}
					case 'Katholik':{ $xagama='C';break;}
					case 'Hindu':{ $xagama='D';break;}
					case 'Buddha':{ $xagama='E';break;}
					case 'Konghucu':{ $xagama='F';break;}
					default: {$xagama='';break;}
				}
			}
			if($xnik==''){
				echo "<script>
					$(function() {
						toastr.error('Cek Kolom NIK a.n ".$xnama."','Mohon Maaf!',{
							timeOut:10000,
							fadeOut:10000
						});
					});
				</script>";
			}
			else if($xnis==''){
				echo "<script>
					$(function() {
						toastr.error('Cek Kolom NIS a.n ".$xnama."','Mohon Maaf!',{
							timeOut:10000,
							fadeOut:10000
						});
					});
				</script>";
			}
			else if(strlen($xnisn)<>10 || $xnisn==''){
				echo "<script>
					$(function() {
						toastr.error('Cek Kolom NISN a.n ".$xnama."','Mohon Maaf!',{
							timeOut:10000,
							fadeOut:10000
						});
					});
				</script>";
			}
			else if(strlen($xnama)<1 || $xnama==''){
				echo "<script>
					$(function() {
						toastr.error('Cek Kolom Nama Lengkap a.n ".$xnama."','Mohon Maaf!',{
							timeOut:1000,
							fadeOut:1000
						});
					});
				</script>";
			}
			else if(strlen($xtmplhr)<1 || $xtmplhr==''){
				echo "<script>
					$(function() {
						toastr.error('Cek Kolom Tempat Lahir a.n ".$xnama."','Mohon Maaf!',{
							timeOut:1000,
							fadeOut:1000
						});
					});
				</script>";
			}
			else if(strlen($xtgllhr)<1 || $xtgllhr==''){
				echo "<script>
					$(function() {
						toastr.error('Cek Kolom Tanggal Lahir a.n ".$xnama."','Mohon Maaf!',{
							timeOut:1000,
							fadeOut:1000
						});
					});
				</script>";
			}
			else if(strlen($xjekel)>1 || $xjekel==''){
				echo "<script>
					$(function() {
						toastr.error('Cek Kolom Jenis Kelamin a.n ".$xnama."','Mohon Maaf!',{
							timeOut:1000,
							fadeOut:1000
						});
					});
				</script>";
			}
			else if($xagama==''){
				echo "<script>
					$(function() {
						toastr.error('Cek Kolom Agama a.n ".$xnama."','Mohon Maaf!',{
							timeOut:1000,
							fadeOut:1000
						});
					});
				</script>";

			}
			else {
				$datasiswa=array(
					'idskul'=>$idskul,
					'nmsiswa' =>$xnama,
					'nik' =>$xnik,
					'nis' =>$xnis,
					'nisn' =>$xnisn,
					'tmplahir' => $xtmplhr,
					'tgllahir' =>$xtgllhr,
					'gender' =>$xjekel,
					'agama' =>$xagama,
					'anake' =>$xanak,
					'saudara' =>$xsdr,
					'warganegara' =>'1',
					'goldarah' =>$xdrh,
					'penyakit' =>$xsakit,
					'kebkhusus' =>$xkeb,
					'reftgl' =>$xikut,
					'transpor' =>$xtrans,
					'jarak' =>$xjrk,
					'waktu' =>$xwkt,
					'almt' =>$xalmt,
					'desa' =>$xdesa,
					'kec' =>$xkec,
					'kab' =>$xkab,
					'prov' =>$xprov,
					'kdpos' =>$xkdpos,
					'longitude' =>$xltg,
					'latitude' =>$xbjr,
					'nohp' =>$xnohp,
					'olahrg' =>$xolga,
					'seni' =>$xseni,
					'orgns' =>$xorgn,
					'lain' =>$xlain
				);
				$qpd="SELECT*FROM tbsiswa WHERE nis='$xnis' AND nisn='$xnisn'";
				if(ceksiswa($qpd)>0){
					if(editsiswa($datasiswa,'2')>0){
						echo "<script>
							$(function() {
								toastr.success('Update Data Peserta Didik a.n ".$xnama." Sukses!','Terima Kasih',{
									timeOut:3000,
									fadeOut:3000
								});
							});
						</script>";
						$update++;
					}
					else {
						echo "<script>
							$(function() {
								toastr.error('Update Data Peserta Didik a.n ".$xnama." Gagal!','Terima Kasih',{
									timeOut:3000,
									fadeOut:3000
								});
							});
						</script>";
					}
				} 
				else {
					if(addsiswa($datasiswa,'2')>0){
						echo "<script>
							$(function() {
								toastr.success('Tambah Data Peserta Didik a.n ".$xnama." Sukses!','Terima Kasih',{
									timeOut:3000,
									fadeOut:3000
								});
							});
						</script>";
						$sukses++;
					}
					else {
						echo "<script>
							$(function() {
								toastr.error('Tambah Data Peserta Didik a.n ".$xnama." Gagal!','Mohon Maaf',{
									timeOut:4000,
									fadeOut:3000
								});
							});
						</script>";
						$gagal++;
					}
				}
			}
		}
		echo "<script>
				$(function() {
					toastr.info('Ada ".$sukses." data ditambah, ".$update." data diupdate, ".$gagal." data gagal ditambahkan!','Terimakasih',{
					timeOut:2000,
					fadeOut:2000
				});
			});
		</script>";		
	}
?>