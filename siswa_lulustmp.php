<?php
	require_once "assets/library/PHPExcel.php";
	include "dbfunction.php";
	$field=array('MAX(idkelas) as maks');
    $join=array(
        'tbjenjang'=>'idjenjang',
        'tbskul'=>'idjenjang'
    );
	$kl=fulljoin($field,'tbkelas',$join)[0];
    $kelas=$kl['maks'];
    $objPHPExcel = new PHPExcel();
	$objPHPExcel->getProperties()->setCreator("Kasworo Wardani")
		->setLastModifiedBy("Kasworo Wardani")
		->setTitle("Template")
		->setCompany("Z&N.Corp");
	$idskul=getskul();
	$semua=0;
	$no=0;
	$baris=6;
    $nama="tb_lulusan";
	$objPHPExcel->setActiveSheetIndex(0)
		->setCellValue('A1', 'TEMPLATE DATA LULUSAN')
		->mergeCells('A1:H1')
		->mergeCells('A3:A4')
		->mergeCells('B3:B4')
		->mergeCells('C3:C4')
		->mergeCells('D3:D4')
		->mergeCells('E3:G3')
        ->mergeCells('H3:I3')
		->setCellValue('A3', 'No')
		->setCellValue('A5', '(1)')
		->setCellValue('B3', 'N I S')
		->setCellValue('B5', '(2)')
		->setCellValue('C3', 'N I S N') 
		->setCellValue('C5', '(3)') 
		->setCellValue('D3', 'Nama Peserta Didik')
		->setCellValue('D5', '(4)')
		->setCellValue('E3', 'Data Kelulusan')
		->setCellValue('E4', 'Tanggal Lulus')
		->setCellValue('E5', '(5)')
		->setCellValue('F4', 'Nomor Ijazah')		
		->setCellValue('F5', '(6)')
		->setCellValue('G4', 'Tanggal Ijazah')
		->setCellValue('G5', '(7)')
		->setCellValue('H3', 'Keterangan Setelah Lulus')
		->setCellValue('H4', 'Melanjutkan')
		->setCellValue('H5', '(8)')
		->setCellValue('I4', 'Nama Satuan Pendidikan')
		->setCellValue('I5', '(9)')
        ->setCellValue('J3', 'Kode Tahun')
		->setCellValue('J5', '(10)')
        ->setCellValue('K3', 'Ket.')
		->setCellValue('K5', '(11)');
	$field=array('idsiswa', 'nmsiswa','nisn','nis', 'jnsregistrasi', 'idjreg','rg.*', 'nmkelas','nmthpel');
	$tbl=array(
	    'tbregistrasi rg'=>'idsiswa',
        'tbkelas k'=>'idkelas',
        'tbthpel tp'=>'idthpel',
        'ref_jnsregistrasi'=>'idjreg'		
	);
	$where =array(
		'deleted'=>'0',
        'tp.aktif'=>'1',
        'rg.idkelas'=>$kelas
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
			->setCellValue("F$baris",$row['idkelas'])
			->setCellValue("G$baris",$row['idthpel'])
			->setCellValue("H$baris",$row['nmthpel']);
		$baris++;
	}
	$semua=$baris-1;
	$objPHPExcel->getActiveSheet()->freezePane("A6");
	$objPHPExcel->setActiveSheetIndex()->getStyle("A6:K$semua");
	$objPHPExcel->setActiveSheetIndex()->getStyle("A1:K5")	->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
	$center = array();
	$center ['alignment']=array();
	$center ['alignment']['horizontal']=PHPExcel_Style_Alignment::HORIZONTAL_CENTER;
	$objPHPExcel->setActiveSheetIndex()->getStyle("A1:K5")->applyFromArray($center);
	$objPHPExcel->setActiveSheetIndex()->getStyle("A6:C$semua")->applyFromArray($center);
	$objPHPExcel->setActiveSheetIndex()->getStyle("G6:K$semua")->applyFromArray($center);
	$thick = array();
	$thick['borders']=array();
	$thick['borders']['allborders']=array();
	$thick['borders']['allborders']['style']=PHPExcel_Style_Border::BORDER_THIN;
	$objPHPExcel->setActiveSheetIndex()->getStyle("A3:K$semua")->applyFromArray($thick); 
	$objPHPExcel->getActiveSheet()->getStyle('A3:A5')->getAlignment()->setWrapText(true);
	$objPHPExcel->getSheet(0)->getColumnDimension('A')->setWidth(4);
	$objPHPExcel->getSheet(0)->getColumnDimension('B')->setWidth(8);
	$objPHPExcel->getSheet(0)->getColumnDimension('C')->setWidth(12);
	$objPHPExcel->getSheet(0)->getColumnDimension('D')->setWidth(36);
	$objPHPExcel->getSheet(0)->getColumnDimension('E')->setWidth(8);
	$objPHPExcel->getSheet(0)->getColumnDimension('F')->setWidth(36);
	$objPHPExcel->getSheet(0)->getColumnDimension('G')->setWidth(16);
	$objPHPExcel->getSheet(0)->getColumnDimension('H')->setWidth(8);
    $objPHPExcel->getActiveSheet()->setTitle($nama);
	$objPHPExcel->setActiveSheetIndex(0);
	header('Content-Type: application/vnd.ms-excel');
	header('Content-Disposition: attachment;filename="'.$nama.'.xls"');
	header('Cache-Control: max-age=0');
	$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
	$objWriter->save('php://output');
	exit;
?>