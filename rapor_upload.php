<?php
	require_once "assets/library/PHPExcel.php";
	require_once "assets/library/excel_reader.php";
	include "dbfunction.php";
	
	if(empty($_FILES['tmprapor']['tmp_name'])){ 
		echo "<script>
				alert('ERROR');
			</script>";	
		
	} 
	else {
		$data = new Spreadsheet_Excel_Reader($_FILES['tmprapor']['tmp_name']);
		$baris = $data->rowcount($sheet_index=0);
		$isidata=$baris-9;
		$skskog = 0;$btlkog = 0; $updkog = 0; $gglkog=0;
		$sksmot = 0;$btlmot = 0; $updmot = 0; $gglmot=0;
		for ($i=10; $i<=$baris; $i++)
		{
			$xnis=$data->val($i,2);
			$xnmsiswa=$data->val($i,3);
			$ds=viewdata('tbsiswa',array('nis'=>$xnis))[0];
        	$idsiswa=$ds['idsiswa'];
			$qmp="SELECT akmapel FROM tbmapel m INNER JOIN tbkurikulum k USING(idkurikulum)";
			$mp=cquery($qmp);	
			$xjenis=$data->val($i,$batas+1);
			for($j=4;$j<=$mp;$j++)
			{
				$xakmapel=$data->val(5,($j-1)*4+4);
				$sqm="SELECT idmapel FROM tbmapel WHERE akmapel='$xakmapel'";
				$mp=vquery($sqm)[0];
				$idmapel=$mp['idmapel'];
				$xnkog=$data->val($i,($j-1)*4+5);
				$xpkog=$data->val($i,($j-1)*4+6);
				$xnmot=$data->val($i,($j-1)*4+7);
				$xpmot=$data->val($i,($j-1)*4+8);
				$keykog=array(
					'idsiswa'=>$idsiswa,
					'idmapel'=>$idmapel,
					'idthpel'=>$idthpel,
					'aspek'=>'3'
				);
				if(cekdata('tbrapor',$keykog)>0){
					$nilai=array(
						'nilairapor'=>$xnkog,
						'predikat'=>$xpkog
					);
					if(editdata('tbnilairapor',$nilai,'',$keykog)>0){$updkog++;} else {$btlkog++;}
				}
				else {
					$nilai = array(
						'idsiswa'=>$idsiswa,
						'idmapel'=>$idmapel,
						'idthpel'=>$idthpel,				
						'nilairapor'=>$xnkog,
						'predikat'=>$xpkog,
						'aspek'=>'3'
					);				
					if(adddata('tbnilairapor',$nilai)>0){$skskog++;} else {$gglkog++;}
				}
				$keymot=array(
					'idsiswa'=>$idsiswa,
					'idmapel'=>$idmapel,
					'idthpel'=>$idthpel,
					'aspek'=>'4'
				);
				if(cekdata('tbrapor',$keymot)>0){
					$nilai=array(
						'nilairapor'=>$xnmot,
						'predikat'=>$xpmot
					);
					if(editdata('tbnilairapor',$nilai,'',$keymot)>0){$updmot++;} else {$btlmot++;}
				}
				else {
					$nilai = array(
						'idsiswa'=>$idsiswa,
						'idmapel'=>$idmapel,
						'idthpel'=>$idthpel,				
						'nilairapor'=>$xnmot,
						'predikat'=>$xpmot,
						'aspek'=>'4'
					);				
					if(adddata('tbnilairapor',$nilai)>0){$sksmot++;} else {$gglmot++;}
				}			
			}
		}
	}
