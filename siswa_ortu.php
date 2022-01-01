<?php
	require_once "assets/library/PHPExcel.php";
	require_once "assets/library/excel_reader.php";

	function getidsiswa($nis,$nisn){
		global $conn;
		$sql=$conn->query("SELECT idsiswa FROM tbsiswa WHERE nis='$nis' OR nisn='$nisn'");
		$rows=[];
		while($row=$sql->fetch_assoc()){
			$rows[]=$row;
		}
		return $rows;
	}

	if(empty($_FILES['fileayah']['tmp_name']) || empty($_FILES['fileibu']['tmp_name']) || empty($_FILES['filewali']['tmp_name'])) { 
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
		if($_POST['nmfile']=='1'){
			$data = new Spreadsheet_Excel_Reader($_FILES['fileayah']['tmp_name']);
		}
		if($_GET['nmfile']=='2'){
			$data = new Spreadsheet_Excel_Reader($_FILES['fileibu']['tmp_name']);
		}
		if($_GET['nmfile']=='3'){
			$data = new Spreadsheet_Excel_Reader($_FILES['filewali']['tmp_name']);
		}
		$baris = $data->rowcount($sheet_index=0);
		$isidata=$baris-5;
		$sukses = 0;
		$gagal = 0;
		$update=0;	
		for ($i=6; $i<=$baris; $i++)
		{
			$xnis=$data->val($i,2);
			$xnisn=$data->val($i,3);
			$idsiswa=getidsiswa($xnis, $xnisn);
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
			$xhubkel= $hubkel;
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

			if($xnik==''|| $xnis==''|| strlen($xnisn)<>10 || $xnisn=='' || strlen($xnama)<1 || $xnama=='' || strlen($xtmplhr)<1 || $xtmplhr=='' || strlen($xtgllhr)<1 || $xtgllhr=='' || $xagama=='' ){
				$gagal++;
			}
			else {				
				$key=array(
					'idsiswa'=>$idsiswa,
					'hubkel'=>$hubkel
				);
				$cekdata=cekdata('tbortu',$key);
				if($cekdata>0){
					$dataortu=array(
						'nmortu'=>$xnama,
						'tmplahir' => $xtmplhr,
						'tgllahir' =>$xtgllhr,
						'agama' =>$xagama,
						'pddkortu'=>$xpddk,
						'hidup'=>$xhidup,
						'idkerja'=>$xkrj,
						'idhsl'=>$xhsl,
						'almt' =>$xalmt,
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
						'tmplahir' => $xtmplhr,
						'tgllahir' =>$xtgllhr,
						'agama' =>$xagama,
						'pddkortu'=>$xpddk,
						'hidup'=>$xhidup,
						'idkerja'=>$xkrj,
						'idhsl'=>$xhsl,
						'hubkel'=>$xhubkel,
						'almt' =>$xalmt,
						'desa' =>$xdesa,
						'kec' =>$xkec,
						'kab' =>$xkab,
						'prov' =>$xprov,
						'kdpos' =>$xkdpos,
						'nohp' =>$xnohp
					);
					$tambah=adddata('tbortu',$dataortu);
					if($tambah>0){
						$sukses++;
					}					
					else {
						$gagal++;
					}
				}				
			}
		}
		if($gagal>0){
			echo"<script>
				$(function() {
					toastr.error('Ada Beberapa Data Gagal Ditambahkan! (Ada ".$gagal." Data)','Mohon Maaf!',{
						timeOut:1000,
						fadeOut:1000,
						onHidden:function(){
							location.(reload);
						}
					});
				});
			</script>";
		} 
		if($sukses>0){ 
			echo"<script>
				$(function() {
					toastr.success('Ada Beberapa Data Berhasi Ditambahkan!' (Ada ".$sukses." Data)','Terima Kasih',{
						timeOut:1000,
						fadeOut:1000,
						onHidden:function(){
							location.reload();
						}
					});
				});
			</script>";
		} 
		if($update>0){ 
			echo"<script>
				$(function() {
					toastr.warning('Ada Beberapa Data Berhasi Diupdate!' (Ada ".$update." Data)','Terima Kasih',{
						timeOut:1000,
						fadeOut:1000,
						onHidden:function(){
							location.reload;
						}
					});
				});
			</script>";
		} 
	}
?>