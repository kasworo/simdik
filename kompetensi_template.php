<?php
	if(!isset($_COOKIE['c_user'])){header("Location: login.php");}
	require_once 'assets/library/PHPExcel.php';
	include "config/konfigurasi.php"; 
	$objPHPExcel = new PHPExcel();
	$objPHPExcel->getProperties()->setCreator("Kasworo Wardani")
		->setLastModifiedBy("Kasworo Wardani");
	$objPHPExcel->setActiveSheetIndex(0)
		->setMergeCells('A1:F1')
		->setCellValue('A1', 'TEMPLATE KOMPETENSI DASAR')
		->setCellValue('A3', 'No.')
		->setCellValue('A4','(1)')
		->setCellValue('B3', 'Kode Mapel')
		->setCellValue('B4','(2)')
		->setCellValue('C3', 'Kelas')
		->setCellValue('C4','(3)')
		->setCellValue('D3', 'Aspek')
		->setCellValue('D4','(4)')
		->setCellValue('E3', 'Kode KD')
		->setCellValue('E4','(5)')
		->setCellValue('F3', 'Kompetensi Dasar')
		->setCellValue('F4','(6)')		
		->setCellValue('G3', 'Ringkasan KD')
		->setCellValue('G4','(7)')
		->setCellValue('H3', 'Semester')
		->setCellValue('H4','(8)');
	$objPHPExcel->getActiveSheet()->freezePane('A5');
	$sql=$conn->query("SELECT kd.*,mp.akmapel, kls.nmkelas FROM tbkompetensi kd INNER JOIN tbmapel mp USING(idmapel) INNER JOIN tbkelas kls USING(idkelas)");
	$i=4;
	$no=0;
	while($s=$sql->fetch_array()){
		$i++;$no++;
		$objPHPExcel->setActiveSheetIndex(0)
		->setCellValue('A'.$i, $no)
		->setCellValue('B'.$i, $s['akmapel'])
		->setCellValue('C'.$i, $s['nmkelas'])
		->setCellValue('D'.$i, $s['aspek'])
		->setCellValue('E'.$i, $s['kodekd'])
		->setCellValue('F'.$i, $s['kdlengkap'])
		->setCellValue('G'.$i, $s['kdringkas'])
		->setCellValue('H'.$i, $s['semester']);
	}

	$objPHPExcel->setActiveSheetIndex()
		->getStyle('A1:F4')
		->getAlignment()
		->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);

	$center = array();
	$center ['alignment']=array();
	$center ['alignment']['horizontal']=PHPExcel_Style_Alignment::HORIZONTAL_CENTER;
	$objPHPExcel->setActiveSheetIndex()->getStyle ( 'A3:F4' )->applyFromArray ($center);

	$thick = array ();
	$thick['borders']=array();
	$thick['borders']['allborders']=array();
	$thick['borders']['allborders']['style']=PHPExcel_Style_Border::BORDER_THIN;
	$objPHPExcel->setActiveSheetIndex()->getStyle ("A3:F4" )->applyFromArray ($thick); 
	$objPHPExcel->getActiveSheet()->getStyle('A3:P5')->getAlignment()->setWrapText(true);

	$objPHPExcel->getSheet(0)->getColumnDimension('A')->setAutoSize(true);
	$objPHPExcel->getSheet(0)->getColumnDimension('B')->setAutoSize(true);
	$objPHPExcel->getSheet(0)->getColumnDimension('C')->setAutoSize(true);
	$objPHPExcel->getSheet(0)->getColumnDimension('D')->setAutoSize(true);
	$objPHPExcel->getSheet(0)->getColumnDimension('E')->setAutoSize(true);
	$objPHPExcel->getSheet(0)->getColumnDimension('F')->setAutoSize(true);
	$objPHPExcel->getActiveSheet(0)->setTitle('tmp_kompetensi');
	$objPHPExcel->setActiveSheetIndex(0);
	header('Content-Type: application/vnd.ms-excel');
	header('Content-Disposition: attachment;filename="tmp_kompetensi.xls"');
	header('Cache-Control: max-age=0');
	$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
	$objWriter->save('php://output');
	exit;
?>