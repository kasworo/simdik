<?php
	require_once "assets/library/PHPExcel.php";
	include "dbfunction.php";
	
	$objPHPExcel = new PHPExcel();
	$objPHPExcel->getProperties()->setCreator("Kasworo Wardani")
		->setLastModifiedBy("Kasworo Wardani")
		->setTitle("Template")
		->setCompany("Z&N.Corp");
	$idskul=getskul();
	$semua=0;
	$no=0;
	$baris=6;
	if($_GET['d']=='1'){
		$nama="tb_siswa";
		$objPHPExcel->setActiveSheetIndex(0)
			->mergeCells('A1:AE1')
			->mergeCells('A3:A4')
			->mergeCells('B3:B4')
			->mergeCells('C3:C4')
			->mergeCells('D3:D4')
			->mergeCells('E3:E4')
			->mergeCells('F3:G3')
			->mergeCells('H3:H4')
			->mergeCells('I3:I4')
			->mergeCells('J3:J4')
			->mergeCells('K3:K4')
			->mergeCells('L3:L4')
			->mergeCells('M3:M4')
			->mergeCells('N3:N4')
			->mergeCells('O3:O4')
			->mergeCells('P3:P4')
			->mergeCells('Q3:Q4')
			->mergeCells('R3:R4')
			->mergeCells('S3:T3')
			->mergeCells('U3:Z3')
			->mergeCells('AA3:AA4')
			->mergeCells('AB3:AE3')
			->setCellValue('A1', 'TEMPLATE DATA PESERTA DIDIK')
			->setCellValue('A3', 'No')
			->setCellValue('A5', '(1)')
			->setCellValue('B3', 'N I K')
			->setCellValue('B5', '(2)')
			->setCellValue('C3', 'N I S') 
			->setCellValue('C5', '(3)') 
			->setCellValue('D3', 'N I S N')
			->setCellValue('D5', '(4)')
			->setCellValue('E3', 'Nama Peserta')
			->setCellValue('E5', '(5)')
			->setCellValue('F3', 'Tempat Dan Tanggal Lahir')
			->setCellValue('F4', 'Tempat')
			->setCellValue('F5', '(6)')
			->setCellValue('G4', 'Tanggal')
			->setCellValue('G5', '(7)')
			->setCellValue('H3', 'Gender')
			->setCellValue('H5', '(8)')
			->setCellValue('I3', 'Agama')
			->setCellValue('I5', '(9)')
			->setCellValue('J3', 'Anak Ke')
			->setCellValue('J5', '(10)')
			->setCellValue('K3', 'Saudara')
			->setCellValue('K5', '(11)')
			->setCellValue('L3', 'Golongan Darah')
			->setCellValue('L5', '(12)')
			->setCellValue('M3', 'Penyakit')
			->setCellValue('M5', '(13)')
			->setCellValue('N3', 'Kebutuhan Khusus')
			->setCellValue('N5', '(14)')
			->setCellValue('O3', 'Tinggal Dengan')
			->setCellValue('O5', '(15)')
			->setCellValue('P3', 'Mode Transportasi')
			->setCellValue('P5', '(16)')
			->setCellValue('Q3', 'Jarak')
			->setCellValue('Q5', '(17)')
			->setCellValue('R3', 'Waktu')
			->setCellValue('R5', '(18)')
			->setCellValue('S3', 'Koordinat')
			->setCellValue('S4', 'Lintang')
			->setCellValue('S5', '(19)')
			->setCellValue('T4', 'Bujur')
			->setCellValue('T5', '(20)')
			->setCellValue('U3', 'Alamat Peserta Didik')
			->setCellValue('U4', 'Alamat')
			->setCellValue('U5', '(21)')
			->setCellValue('V4', 'Desa')
			->setCellValue('V5', '(22)')
			->setCellValue('W4', 'Kecamatan')
			->setCellValue('W5', '(23)')
			->setCellValue('X4', 'Kabupatan/Kota')
			->setCellValue('X5', '(24)')
			->setCellValue('Y4', 'Provinsi')
			->setCellValue('Y5', '(25)')
			->setCellValue('Z4', 'Kode Pos')
			->setCellValue('Z5', '(26)')
			->setCellValue('AA3', 'No. HP')
			->setCellValue('AA5', '(27)')
			->setCellValue('AB3', 'Hobi / Kegemaran')
			->setCellValue('AB4', 'Olahraga')
			->setCellValue('AB5', '(28)')
			->setCellValue('AC4', 'Seni')
			->setCellValue('AC5', '(29)')
			->setCellValue('AD4', 'Organisasi')
			->setCellValue('AD5', '(30)')
			->setCellValue('AE4', 'Lainnya')
			->setCellValue('AE5', '(31)');
			$key=array('idskul'=>$idskul);
			$ceksiswa=cekdata('tbsiswa',$key);
			if($ceksiswa>0){
				$data=viewdata('tbsiswa',$key);
				foreach($data as $s)
				{
					$no++;
					$objPHPExcel->setActiveSheetIndex(0)
						->setCellValue("A$baris", $no)
						->setCellValue("B$baris",($s['nik']))
						->setCellValue("C$baris",$s['nis'])
						->setCellValue("D$baris",$s['nisn'])
						->setCellValue("E$baris",ucwords(strtolower($s['nmsiswa'])))
						->setCellValue("F$baris",ucwords(strtolower($s['tmplahir'])))
						->setCellValue("G$baris",$s['tgllahir'])
						->setCellValue("H$baris",$s['gender'])
						->setCellValue("I$baris",$s['idagama'])
						->setCellValue("J$baris",$s['anake'])
						->setCellValue("K$baris",$s['sdr'])
						->setCellValue("L$baris",$s['goldarah'])
						->setCellValue("M$baris",$s['rwysakit'])
						->setCellValue("N$baris",$s['kebkhusus'])
						->setCellValue("O$baris",$s['ikuts'])
						->setCellValue("P$baris",$s['transpr'])
						->setCellValue("Q$baris",$s['jarak'])
						->setCellValue("R$baris",$s['waktu'])
						->setCellValue("S$baris",$s['lintang'])
						->setCellValue("T$baris",$s['bujur'])
						->setCellValue("U$baris",$s['alamat'])
						->setCellValue("V$baris",$s['desa'])
						->setCellValue("W$baris",$s['kec'])
						->setCellValue("X$baris",$s['kab'])
						->setCellValue("Y$baris",$s['prov'])
						->setCellValue("Z$baris",$s['kdpos'])
						->setCellValue("AA$baris",$s['nohp'])
						->setCellValue("AB$baris",$s['hobi1'])
						->setCellValue("AC$baris",$s['hobi2'])
						->setCellValue("AD$baris",$s['hobi3'])
						->setCellValue("AE$baris",$s['hobi4']);
						$baris++;
				}
			}
			else
			{
				while($no<70)
				{
						$no++;
						$objPHPExcel->setActiveSheetIndex(0)
						->setCellValue("A$baris", $no)->setCellValue("B$baris",$idskul);
						$objPHPExcel->setActiveSheetIndex(0)->setCellValue("C$baris",'');
						$baris++; 
				}
			}		
		$semua=$baris-1;
		$objPHPExcel->getActiveSheet()->freezePane("A6");
		$objPHPExcel->setActiveSheetIndex()->getStyle("A6:AE$semua");
		$objPHPExcel->setActiveSheetIndex()->getStyle("A1:AE5")->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
		$center = array();
		$center ['alignment']=array();
		$center ['alignment']['horizontal']=PHPExcel_Style_Alignment::HORIZONTAL_CENTER;
		$objPHPExcel->setActiveSheetIndex()->getStyle("A1:AE5")->applyFromArray($center);
		$objPHPExcel->setActiveSheetIndex()->getStyle("A6:D$semua")->applyFromArray($center);
		$objPHPExcel->setActiveSheetIndex()->getStyle("G6:G$semua")->applyFromArray($center);
		$thick = array();
		$thick['borders']=array();
		$thick['borders']['allborders']=array();
		$thick['borders']['allborders']['style']=PHPExcel_Style_Border::BORDER_THIN;
		$objPHPExcel->setActiveSheetIndex()->getStyle("A3:AE$semua")->applyFromArray($thick); 

		$objPHPExcel->getActiveSheet()->getStyle('A3:A5')->getAlignment()->setWrapText(true);
		$objPHPExcel->getSheet(0)->getColumnDimension('A')->setWidth(4);
		$objPHPExcel->getSheet(0)->getColumnDimension('B')->setWidth(16);
		$objPHPExcel->getSheet(0)->getColumnDimension('C')->setWidth(6);
		$objPHPExcel->getSheet(0)->getColumnDimension('D')->setWidth(12);
		$objPHPExcel->getSheet(0)->getColumnDimension('E')->setWidth(38);
		$objPHPExcel->getSheet(0)->getColumnDimension('F')->setWidth(16);
		$objPHPExcel->getSheet(0)->getColumnDimension('G')->setWidth(12);		
	}
	else if($_GET['d']=='2'){
		$nama="tb_riwayatskul";
		$objPHPExcel->setActiveSheetIndex(0)
			->setCellValue('A1', 'TEMPLATE DATA RIWAYAT SEKOLAH')
			->mergeCells('A1:N1')
			->mergeCells('A3:A4')
			->mergeCells('B3:B4')
			->mergeCells('C3:C4')
			->mergeCells('D3:D4')
			->mergeCells('E3:E4')
			->mergeCells('F3:I3')
			->mergeCells('J3:M3')
			->mergeCells('N3:N4')
			->setCellValue('A3', 'No')
			->setCellValue('A5', '(1)')
			->setCellValue('B3', 'N I S')
			->setCellValue('B5', '(2)')
			->setCellValue('C3', 'N I S N') 
			->setCellValue('C5', '(3)') 
			->setCellValue('D3', 'Nama Peserta Didik')
			->setCellValue('D5', '(4)')
			->setCellValue('E3', 'JReg')
			->setCellValue('E5', '(5)')
			->setCellValue('F3', 'Asal SD/MI')
			->setCellValue('F4', 'Nama Sekolah')
			->setCellValue('F5', '(6)')
			->setCellValue('G4', 'No. Ijazah')
			->setCellValue('G5', '(7)')
			->setCellValue('H4', 'Tgl. Ijazah')
			->setCellValue('H5', '(8)')
			->setCellValue('I4', 'Lama')
			->setCellValue('I5', '(9)')
			->setCellValue('J3', 'Asal SMP/MTs')
			->setCellValue('J4', 'Nama Sekolah')
			->setCellValue('J5', '(10)')
			->setCellValue('K4', 'No. Surat Pindah')
			->setCellValue('K5', '(11)')
			->setCellValue('L4', 'Tgl. Surat Pindah')
			->setCellValue('L5', '(12)')
			->setCellValue('M4', 'Alasan')
			->setCellValue('M5', '(13)')
			->setCellValue('N3', 'Ket.')
			->setCellValue('N5', '(14)');
			$field=array('idsiswa', 'nmsiswa','nisn','nis', 'jnsregistrasi', 'idjreg','rw.*');
			$tbl=array(
				'tbriwayatskul rw'=>'idsiswa',
				'ref_jnsregistrasi'=>'idjreg'		
			);
			$where =array(
				'deleted'=>'0'
			); 
			$datane=leftjoin($field,'tbsiswa', $tbl, $where);
			foreach($datane as $row){
				$no++;
				$objPHPExcel->setActiveSheetIndex(0)
					->setCellValue("A$baris", $no)
					->setCellValue("B$baris",($row['nis']))
					->setCellValue("C$baris",$row['nisn'])
					->setCellValue("D$baris",ucwords(strtolower($row['nmsiswa'])))
					->setCellValue("E$baris",$row['idjreg'])
					->setCellValue("F$baris",$row['aslsd'])
					->setCellValue("G$baris",$row['noijazah'])
					->setCellValue("H$baris",$row['tglijazah'])
					->setCellValue("I$baris",$row['lama'])
					->setCellValue("J$baris",$row['aslsmp'])
					->setCellValue("K$baris",$row['nosurat'])
					->setCellValue("L$baris",$row['tglsurat'])
					->setCellValue("M$baris",$row['alasan'])
					->setCellValue("N$baris",$row['jnsregistrasi']);
				$baris++;
			}
			$semua=$baris-1;
			$objPHPExcel->getActiveSheet()->freezePane("A6");
			$objPHPExcel->setActiveSheetIndex()->getStyle("A6:N$semua");
			$objPHPExcel->setActiveSheetIndex()->getStyle("A1:N5")			->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
				$center = array();
				$center ['alignment']=array();
				$center ['alignment']['horizontal']=PHPExcel_Style_Alignment::HORIZONTAL_CENTER;
				$objPHPExcel->setActiveSheetIndex()->getStyle("A1:N5")->applyFromArray($center);
				$objPHPExcel->setActiveSheetIndex()->getStyle("A6:C$semua")->applyFromArray($center);
				$objPHPExcel->setActiveSheetIndex()->getStyle("G6:I$semua")->applyFromArray($center);
				$objPHPExcel->setActiveSheetIndex()->getStyle("K6:L$semua")->applyFromArray($center);
				$thick = array();
				$thick['borders']=array();
				$thick['borders']['allborders']=array();
				$thick['borders']['allborders']['style']=PHPExcel_Style_Border::BORDER_THIN;
				$objPHPExcel->setActiveSheetIndex()->getStyle("A3:N$semua")->applyFromArray($thick); 
				$objPHPExcel->getActiveSheet()->getStyle('A3:A5')->getAlignment()->setWrapText(true);
				$objPHPExcel->getSheet(0)->getColumnDimension('A')->setWidth(4);
				$objPHPExcel->getSheet(0)->getColumnDimension('B')->setWidth(8);
				$objPHPExcel->getSheet(0)->getColumnDimension('C')->setWidth(12);
				$objPHPExcel->getSheet(0)->getColumnDimension('D')->setWidth(36);
				$objPHPExcel->getSheet(0)->getColumnDimension('E')->setWidth(8);
				$objPHPExcel->getSheet(0)->getColumnDimension('F')->setWidth(36);
				$objPHPExcel->getSheet(0)->getColumnDimension('G')->setWidth(16);
				$objPHPExcel->getSheet(0)->getColumnDimension('H')->setWidth(16);
				$objPHPExcel->getSheet(0)->getColumnDimension('I')->setWidth(8);
	}
	else {
		$objPHPExcel->setActiveSheetIndex(0)
			->mergeCells('A1:U1')
			->mergeCells('A3:A4')
			->mergeCells('B3:B4')
			->mergeCells('C3:C4')
			->mergeCells('D3:D4')
			->mergeCells('E3:E4')
			->mergeCells('F3:F4')
			->mergeCells('G3:H3')
			->mergeCells('I3:I4')
			->mergeCells('J3:J4')
			->mergeCells('K3:K4')
			->mergeCells('L3:L4')
			->mergeCells('M3:R3')
			->mergeCells('S3:S4')
			->mergeCells('T3:T4')
			->mergeCells('U3:U4')
			->setCellValue('A3', 'No')
			->setCellValue('A5', '(1)')
			->setCellValue('B3', 'N I S')
			->setCellValue('B5', '(2)')
			->setCellValue('C3', 'N I S N') 
			->setCellValue('C5', '(3)') 
			->setCellValue('D3', 'Nama Peserta Didik')
			->setCellValue('D5', '(4)')
			->setCellValue('E3', 'Nama Orang Tua')
			->setCellValue('E5', '(5)')
			->setCellValue('F3', 'N I K')
			->setCellValue('F5', '(6)')
			->setCellValue('G3', 'Tempat Dan Tanggal Lahir')
			->setCellValue('G4', 'Tempat')
			->setCellValue('G5', '(7)')
			->setCellValue('H4', 'Tanggal')
			->setCellValue('H5', '(8)')
			->setCellValue('I3', 'Agama')
			->setCellValue('I5', '(9)')
			->setCellValue('J3', 'Pendidikan')
			->setCellValue('J5', '(10)')
			->setCellValue('K3', 'Pekerjaan')
			->setCellValue('K5', '(11)')
			->setCellValue('L3', 'Penghasilan')
			->setCellValue('L5', '(12)')
			->setCellValue('M3', 'Alamat ')
			->setCellValue('M4', 'Alamat')
			->setCellValue('M5', '(13)')
			->setCellValue('N4', 'Desa')
			->setCellValue('N5', '(14)')
			->setCellValue('O4', 'Kecamatan')
			->setCellValue('O5', '(15)')
			->setCellValue('P4', 'Kabupatan/Kota')
			->setCellValue('P5', '(16)')
			->setCellValue('Q4', 'Provinsi')
			->setCellValue('Q5', '(17)')
			->setCellValue('R4', 'Kode Pos')
			->setCellValue('R5', '(18)')
			->setCellValue('S3', 'No. HP')
			->setCellValue('S5', '(19)')
			->setCellValue('T3', 'Hidup')
			->setCellValue('T5', '(20)')
			->setCellValue('U3', 'Ket.')
			->setCellValue('U5', '(21)');
		$key=array('idskul'=>$idskul);
		$ceksiswa=cekdata('tbsiswa',$key);
		if($_GET['d']=='3'){
			$nama="tb_ayah";
			$objPHPExcel->setActiveSheetIndex(0)
				->setCellValue('A1', 'TEMPLATE DATA AYAH');			
			$keya=array(
				'idskul'=>$idskul,
				'hubkel'=>'1'
			);
			$joina=array('tbortu ay'=>'idsiswa');
			$cekayah=cekfulljoin('ay.*','tbsiswa',$joina,$keya);
			if($cekayah==$ceksiswa) {
				$fielda=array('nis', 'nisn', 'nmsiswa', 'ay.*');
				$datane=fulljoin($fielda,'tbsiswa',$joina,$keya);
			}
			else {
				$datane=vquery("SELECT nis, nisn, nmsiswa FROM tbsiswa WHERE idskul='$idskul'");
			}
		}
		if($_GET['d']=='4'){
			$nama="tb_ibu";
			$objPHPExcel->setActiveSheetIndex(0)
				->setCellValue('A1', 'TEMPLATE DATA IBU');		
			$keya=array(
				'idskul'=>$idskul,
				'hubkel'=>'2'
			);
			$joina=array('tbortu ay'=>'idsiswa');
			$cekayah=cekfulljoin('ay.*','tbsiswa',$joina,$keya);
			if($cekayah==$ceksiswa) {
				$fielda=array('nis', 'nisn', 'nmsiswa', 'ay.*');
				$datane=fulljoin($fielda,'tbsiswa',$joina,$keya);
			}
			else {
				$datane=vquery("SELECT nis, nisn, nmsiswa FROM tbsiswa WHERE idskul='$idskul'");
			}
		}
		if($_GET['d']=='5'){
			$nama="tb_wali";
			$objPHPExcel->setActiveSheetIndex(0)
				->setCellValue('A1', 'TEMPLATE DATA WALI');			
			$cekayah=cquery("SELECT nis, nisn, nmsiswa FROM tbsiswa INNER JOIN tbortu USING(idsiswa) WHERE idskul='$idskul' AND hubkel<>'1' AND hubkel<>'2'");
			if($cekayah>0) {
				$datane=vquery("SELECT nis, nisn, nmsiswa, ay.* FROM tbsiswa INNER JOIN tbortu ay USING(idsiswa) WHERE idskul='$idskul' AND hubkel<>'1' AND hubkel<>'2'");
			}
			else {
				$datane=vquery("SELECT nis, nisn, nmsiswa FROM tbsiswa WHERE idskul='$idskul'");
			}
		}
		foreach($datane as $row){
			$no++;
			$objPHPExcel->setActiveSheetIndex(0)
				->setCellValue("A$baris", $no)
				->setCellValue("B$baris",($row['nis']))
				->setCellValue("C$baris",$row['nisn'])
				->setCellValue("D$baris",ucwords(strtolower($row['nmsiswa'])))
				->setCellValue("E$baris",ucwords(strtolower($row['nmortu'])))
				->setCellValue("F$baris",$row['nik'])
				->setCellValue("I$baris",$row['idagama'])
				->setCellValue("J$baris",$row['idpddk'])
				->setCellValue("K$baris",$row['idkerja'])
				->setCellValue("L$baris",$row['idhsl'])
				->setCellValue("M$baris",$row['alamat'])
				->setCellValue("N$baris",$row['desa'])
				->setCellValue("O$baris",$row['kec'])
				->setCellValue("P$baris",$row['kab'])
				->setCellValue("Q$baris",$row['prov'])
				->setCellValue("R$baris",$row['kdpos'])
				->setCellValue("S$baris",$row['nohp'])
				->setCellValue("T$baris",$row['hidup'])
				->setCellValue("U$baris",$row['hubkel']);
				$baris++; 
		}			
		$semua=$baris-1;
		$objPHPExcel->getActiveSheet()->freezePane("A6");
		$objPHPExcel->setActiveSheetIndex()->getStyle("A6:U$semua");
		$objPHPExcel->setActiveSheetIndex()->getStyle("A1:U5")			->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
			$center = array();
			$center ['alignment']=array();
			$center ['alignment']['horizontal']=PHPExcel_Style_Alignment::HORIZONTAL_CENTER;
			$objPHPExcel->setActiveSheetIndex()->getStyle("A1:U5")->applyFromArray($center);
			$objPHPExcel->setActiveSheetIndex()->getStyle("A6:C$semua")->applyFromArray($center);
			$objPHPExcel->setActiveSheetIndex()->getStyle("F6:F$semua")->applyFromArray($center);
			$objPHPExcel->setActiveSheetIndex()->getStyle("H6:L$semua")->applyFromArray($center);
			$objPHPExcel->setActiveSheetIndex()->getStyle("S6:U$semua")->applyFromArray($center);
			$thick = array();
			$thick['borders']=array();
			$thick['borders']['allborders']=array();
			$thick['borders']['allborders']['style']=PHPExcel_Style_Border::BORDER_THIN;
			$objPHPExcel->setActiveSheetIndex()->getStyle("A3:U$semua")->applyFromArray($thick); 
			$objPHPExcel->getActiveSheet()->getStyle('A3:A5')->getAlignment()->setWrapText(true);
			$objPHPExcel->getSheet(0)->getColumnDimension('A')->setWidth(4);
			$objPHPExcel->getSheet(0)->getColumnDimension('B')->setWidth(8);
			$objPHPExcel->getSheet(0)->getColumnDimension('C')->setWidth(12);
			$objPHPExcel->getSheet(0)->getColumnDimension('D')->setWidth(36);
			$objPHPExcel->getSheet(0)->getColumnDimension('E')->setWidth(24);
			$objPHPExcel->getSheet(0)->getColumnDimension('F')->setWidth(16);
			$objPHPExcel->getSheet(0)->getColumnDimension('G')->setWidth(12);
	}	
	$objPHPExcel->getActiveSheet()->setTitle($nama);
	$objPHPExcel->setActiveSheetIndex(0);
	header('Content-Type: application/vnd.ms-excel');
	header('Content-Disposition: attachment;filename="'.$nama.'.xls"');
	header('Cache-Control: max-age=0');
	$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
	$objWriter->save('php://output');
	exit;
?>