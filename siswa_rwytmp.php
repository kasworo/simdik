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
		$nama="tb_asalsd";
		$objPHPExcel->setActiveSheetIndex(0)
			->setCellValue('A1', 'TEMPLATE ASAL SD/MI')
			->mergeCells('A1:N1')
			->mergeCells('A3:A4')
			->mergeCells('B3:B4')
			->mergeCells('C3:C4')
			->mergeCells('D3:D4')
			->mergeCells('E3:H3')
			->mergeCells('I3:I4')
			->setCellValue('A3', 'No')
			->setCellValue('A5', '(1)')
			->setCellValue('B3', 'N I S')
			->setCellValue('B5', '(2)')
			->setCellValue('C3', 'N I S N') 
			->setCellValue('C5', '(3)') 
			->setCellValue('D3', 'Nama Peserta Didik')
			->setCellValue('D5', '(4)')
			->setCellValue('E3', 'Asal SD/MI')
			->setCellValue('E4', 'Nama Sekolah')
			->setCellValue('E5', '(5)')
			->setCellValue('F4', 'No. Ijazah')
			->setCellValue('F5', '(6)')
			->setCellValue('G4', 'Tgl. Ijazah')
			->setCellValue('G5', '(7)')
			->setCellValue('H4', 'Lama')
			->setCellValue('H5', '(8)')
			->setCellValue('I3', 'Ket.')
			->setCellValue('I5', '(9)');
		$sql="SELECT s.nisn, s.nis, s.nmsiswa, a.* FROM tbsiswa s INNER JOIN tbasalsd a USING(idsiswa) INNER JOIN tbregistrasi r USING(idsiswa) WHERE s.deleted='0' AND (r.idjreg='1' OR r.idjreg='2') GROUP BY s.idsiswa ORDER BY s.nis";
		if(cquery($sql)>0){			
			$datane=vquery($sql);
			foreach($datane as $row)
			{
				$no++;
				$objPHPExcel->setActiveSheetIndex(0)
					->setCellValue("A$baris", $no)
					->setCellValue("B$baris",($row['nis']))
					->setCellValue("C$baris",$row['nisn'])
					->setCellValue("D$baris",ucwords(strtolower($row['nmsiswa'])))
					->setCellValue("E$baris",$row['aslsd'])
					->setCellValue("F$baris",$row['noijazah'])
					->setCellValue("G$baris",$row['tglijazah'])
					->setCellValue("H$baris",$row['lama'])
					->setCellValue("I$baris",'');
				$baris++;
			}
		}
		else {
			$sql="SELECT s.nisn, s.nis, s.nmsiswa FROM tbsiswa s INNER JOIN tbregistrasi r USING(idsiswa) WHERE s.deleted='0' AND (r.idjreg='1' OR r.idjreg='2') GROUP BY s.idsiswa ORDER BY s.nis";
			$datane=vquery($sql);
			foreach($datane as $row)
			{
				$no++;
				$objPHPExcel->setActiveSheetIndex(0)
					->setCellValue("A$baris", $no)
					->setCellValue("B$baris",($row['nis']))
					->setCellValue("C$baris",$row['nisn'])
					->setCellValue("D$baris",ucwords(strtolower($row['nmsiswa'])))
					->setCellValue("E$baris",'')
					->setCellValue("F$baris",'')
					->setCellValue("G$baris",'')
					->setCellValue("H$baris",'')
					->setCellValue("I$baris",'');
				$baris++;
			}
		}			
	}
	else {
        $nama="tb_mutasi";
		$objPHPExcel->setActiveSheetIndex(0)
			->setCellValue('A1', 'TEMPLATE MUTASI PESERTA DIDIK')
			->mergeCells('A1:N1')
			->mergeCells('A3:A4')
			->mergeCells('B3:B4')
			->mergeCells('C3:C4')
			->mergeCells('D3:D4')
			->mergeCells('E3:H3')
			->mergeCells('I3:I4')
			->setCellValue('A3', 'No')
			->setCellValue('A5', '(1)')
			->setCellValue('B3', 'N I S')
			->setCellValue('B5', '(2)')
			->setCellValue('C3', 'N I S N') 
			->setCellValue('C5', '(3)') 
			->setCellValue('D3', 'Nama Peserta Didik')
			->setCellValue('D5', '(4)')
			->setCellValue('E3', 'Dari atau Ke SMP/MTs')
			->setCellValue('E4', 'Nama Sekolah')
			->setCellValue('E5', '(6)')
			->setCellValue('F4', 'Nomor Surat')
			->setCellValue('F5', '(7)')
			->setCellValue('G4', 'Tanggal Surat')
			->setCellValue('G5', '(8)')
			->setCellValue('H4', 'Alasan')
			->setCellValue('H5', '(9)')
			->setCellValue('I3', 'Ket.')
			->setCellValue('I5', '(10)');
		$sql="SELECT s.nisn, s.nis, s.nmsiswa, a.* FROM tbsiswa s LEFT JOIN tbmutasi a USING(idsiswa) INNER JOIN tbregistrasi r USING(idsiswa) WHERE s.deleted='0' AND (r.idjreg='2' OR r.idjreg='6') GROUP BY s.idsiswa ORDER BY s.nis";
		if(cquery($sql)>0){			
			$datane=vquery($sql);
			foreach($datane as $row)
			{
				$no++;
				$objPHPExcel->setActiveSheetIndex(0)
					->setCellValue("A$baris", $no)
					->setCellValue("B$baris",($row['nis']))
					->setCellValue("C$baris",$row['nisn'])
					->setCellValue("D$baris",ucwords(strtolower($row['nmsiswa'])))
					->setCellValue("E$baris",$row['aslkesmp'])
					->setCellValue("F$baris",$row['nosurat'])
					->setCellValue("G$baris",$row['tglsurat'])
					->setCellValue("H$baris",$row['alasan'])
					->setCellValue("I$baris",$row['jnsmutasi']);
				$baris++;
			}
		}
		else {
			$sql="SELECT s.nisn, s.nis, s.nmsiswa FROM tbsiswa s INNER JOIN tbregistrasi r USING(idsiswa) WHERE s.deleted='0' AND (r.idjreg='2' OR r.idjreg='6') GROUP BY s.idsiswa ORDER BY s.nis";
			$datane=vquery($sql);
			foreach($datane as $row)
			{
				$no++;
				$objPHPExcel->setActiveSheetIndex(0)
					->setCellValue("A$baris", $no)
					->setCellValue("B$baris",($row['nis']))
					->setCellValue("C$baris",$row['nisn'])
					->setCellValue("D$baris",ucwords(strtolower($row['nmsiswa'])))
					->setCellValue("E$baris",'')
					->setCellValue("F$baris",'')
					->setCellValue("G$baris",'')
					->setCellValue("H$baris",'')
					->setCellValue("I$baris",'');
				$baris++;
			}
		}
			
	}
	$semua=$baris-1;
	$objPHPExcel->getActiveSheet()
		->freezePane("A5")
		->getStyle("A1:I5")
		->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
	$center = array();
	$center ['alignment']=array();
	$center ['alignment']['horizontal']=PHPExcel_Style_Alignment::HORIZONTAL_CENTER;
	
	$objPHPExcel->setActiveSheetIndex()
		->getStyle("A1:I5")
		->applyFromArray($center);
	$objPHPExcel->setActiveSheetIndex()
		->getStyle("A6:C$semua")
		->applyFromArray($center);
	$thick['borders']=array();
	$thick['borders']['allborders']=array();
	$thick['borders']['allborders']['style']=PHPExcel_Style_Border::BORDER_THIN;
	$objPHPExcel->setActiveSheetIndex()
		->getStyle("A3:I$semua")
		->applyFromArray($thick); 
	$objPHPExcel->getActiveSheet()
		->getStyle('A3:A5')
		->getAlignment()
		->setWrapText(true);
	$objPHPExcel->getSheet(0)
		->getColumnDimension('A')
		->setWidth(4);
	$objPHPExcel->getSheet(0)->getColumnDimension('B')->setWidth(8);
	$objPHPExcel->getSheet(0)->getColumnDimension('C')->setWidth(12);
	$objPHPExcel->getSheet(0)->getColumnDimension('D')->setWidth(36);
	$objPHPExcel->getSheet(0)->getColumnDimension('E')->setWidth(36);
	$objPHPExcel->getSheet(0)->getColumnDimension('F')->setWidth(20);
	$objPHPExcel->getSheet(0)->getColumnDimension('G')->setWidth(20);
	$objPHPExcel->getSheet(0)->getColumnDimension('H')->setWidth(36);
	$objPHPExcel->getSheet(0)->getColumnDimension('I')->setWidth(8);
	$objPHPExcel->getActiveSheet()->setTitle($nama);
	$objPHPExcel->setActiveSheetIndex(0);
	header('Content-Type: application/vnd.ms-excel');
	header('Content-Disposition: attachment;filename="'.$nama.'.xls"');
	header('Cache-Control: max-age=0');
	$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
	$objWriter->save('php://output');
	exit;
?>