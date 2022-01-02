<?php
	require_once "assets/library/PHPExcel.php";
	require_once "assets/library/excel_reader.php";
	if(empty($_FILES['fileortu']['tmp_name'])){ 
		echo"<script>
			$(function() {
				toastr.error('File Template Orang Tua/Wali Kosong!','Mohon Maaf!',{
					timeOut:1800,
					fadeOut:1800
				});
			});
		</script>";	
	}
	else {
		$data = new Spreadsheet_Excel_Reader($_FILES['fileortu']['tmp_name']);
		$baris = $data->rowcount($sheet_index=0);		
		$isidata=$baris-5;
		$sukses = 0;
		$gagal = 0;
		$update=0;	
		for ($i=6; $i<=$baris; $i++)
		{
			$xnis=$data->val($i,2);
			$xnisn=$data->val($i,3);			
			$xnama= $conn->real_escape_string($data->val($i,5));			
			$xnik=$data->val($i,6); 
			$xtmplhr = $data->val($i,7); 
			$xtgllhr = $data->val($i,8); 
			$nmagama = $data->val($i,9);
			$xpddk=$data->val($i,10);
			$xkrj=$data->val($i,11);
			$xhsl=$data->val($i,12);
			$xalmt = $data->val($i,13);
			$xdesa	= $data->val($i,14);
			$xkec	= $data->val($i,15);
			$xkab	= $data->val($i,16);
			$xprov = $data->val($i,17);
			$xkdpos = $data->val($i,18);
			$xnohp = $data->val($i,19);
			$xhidup = $data->val($i,20);
			$xhubkel= $data->val($i,21);
			$ds=viewdata('tbsiswa',array('nis'=>$xnis,'nisn'=>$xnisn))[0];
            $idsiswa=$ds['idsiswa'];			
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
			if($xnis==''|| strlen($xnisn)<>10 || $xnisn=='' || strlen($xnama)<1 || $xnama=='' || $xagama=='' ){
				$gagal++;
			}
			else {				
				$key=array(
					'idsiswa'=>$idsiswa,
					'hubkel'=>$xhubkel
				);			
				$cekdata=cekdata('tbortu',$key);
				
				if($cekdata>0){
					$dataortu=array(
						'nmortu'=>$xnama,
					//	'tmplahir' => $xtmplhr,
					//	'tgllahir' =>$xtgllhr,
						'idagama' =>$xagama,
						'idpddk'=>$xpddk,
						'hidup'=>$xhidup,
						'idkerja'=>$xkrj,
						'idhsl'=>$xhsl,
						'alamat' =>$xalmt,
						'desa' =>$xdesa,
						'kec' =>$xkec,
						'kab' =>$xkab,
						'prov' =>$xprov,
						'kdpos' =>$xkdpos,
						'nohp' =>$xnohp
					);
					$editortu=editdata('tbortu',$dataortu,'',$key);
					$update++;
				} 
				else {
					$dataortu=array(
						'idsiswa' =>$idsiswa,
						'nmortu'=>$xnama,
						//'tmplahir' => $xtmplhr,
						//'tgllahir' =>$xtgllhr,
						'idagama' =>$xagama,
						'idpddk'=>$xpddk,
						'hidup'=>$xhidup,
						'idkerja'=>$xkrj,
						'idhsl'=>$xhsl,
						'hubkel'=>$xhubkel,
						'alamat' =>$xalmt,
						'desa' =>$xdesa,
						'kec' =>$xkec,
						'kab' =>$xkab,
						'prov' =>$xprov,
						'kdpos' =>$xkdpos,
						'nohp' =>$xnohp
					);
										
					$tambah=adddata('tbortu',$dataortu);
					if($tambah>0){$sukses++;}					
					else {$gagal++;}
				}				
			}
		}
		// if($gagal>0){
		// 	echo"<script>
		// 		$(function() {
		// 			toastr.error('Ada ".$gagal." Data Gagal Ditambahkan!','Mohon Maaf!',{
		// 				timeOut:1000,
		// 				fadeOut:1000,
		// 				onHidden:function(){
		// 					location.(reload);
		// 				}
		// 			});
		// 		});
		// 	</script>";
		// } 
		// if($sukses>0){ 
		// 	echo"<script>
		// 		$(function() {
		// 			toastr.success('Ada ".$sukses." Data Berhasil Ditambahkan!','Terima Kasih',{
		// 				timeOut:1000,
		// 				fadeOut:1000,
		// 				onHidden:function(){
		// 					location.reload();
		// 				}
		// 			});
		// 		});
		// 	</script>";
		// } 
		// if($update>0){ 
		// 	echo"<script>
		// 		$(function() {
		// 			toastr.warning('Ada ".$update." Data Berhasil Diupdate!','Terima Kasih',{
		// 				timeOut:1000,
		// 				fadeOut:1000,
		// 				onHidden:function(){
		// 					location.reload;
		// 				}
		// 			});
		// 		});
		// 	</script>";
		// } 
	}
?>