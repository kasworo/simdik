<?php
	require_once "assets/library/PHPExcel.php";
	include "config/konfigurasi.php";
	include "config/function_skul.php";
	function viewguru($data){
		global $conn;
		$sql=$conn->query($data);
		$rows=[];
		while($row=$sql->fetch_assoc()){
			$rows[]=$row;
		}
		return $rows;
	}
	$objPHPExcel = new PHPExcel();
	$objPHPExcel->getProperties()->setCreator("Kasworo Wardani")
		->setLastModifiedBy("Kasworo Wardani")
		->setTitle("TemplateGTK")
		->setCompany("Z&N.Corp");		
	$idskul=getskul();
	$semua=0;
	$no=0;
	$baris=6;
    $nama="tb_gtk";
	$objPHPExcel->setActiveSheetIndex()
		->mergeCells('A1:Q1')
		->setCellValue('A1', 'TEMPLATE DATA GURU DAN TU')
		->setCellValue('A3', 'No')
		->setCellValue('A5', '(1)')
		->setCellValue('B3', 'N I K')
		->setCellValue('B5', '(2)')
		->setCellValue('C3', 'N I P') 
		->setCellValue('C5', '(3)') 
		->setCellValue('D3', 'Nama GTK')
		->setCellValue('D5', '(4)')
		->setCellValue('E3', 'Tempat Dan Tanggal Lahir')
		->setCellValue('E4', 'Tempat')
		->setCellValue('E5', '(5)')
		->setCellValue('F4', 'Tanggal')
		->setCellValue('F5', '(6)')
		->setCellValue('G3', 'Gender')
		->setCellValue('G5', '(7)')
		->setCellValue('H3', 'Agama')
		->setCellValue('H5', '(8)')
		->setCellValue('I3', 'Alamat GTK')
		->setCellValue('I4', 'Alamat')
		->setCellValue('I5', '(9)')
		->setCellValue('J4', 'Desa')
		->setCellValue('J5', '(10)')
		->setCellValue('K4', 'Kecamatan')
		->setCellValue('K5', '(11)')
		->setCellValue('L4', 'Kabupatan/Kota')
		->setCellValue('L5', '(12)')
		->setCellValue('M4', 'Provinsi')
		->setCellValue('M5', '(13)')
		->setCellValue('N4', 'Kode Pos')
		->setCellValue('N5', '(14)')
		->setCellValue('O3', 'No. HP')
		->setCellValue('O5', '(15)')
		->setCellValue('P3', 'Status')
		->setCellValue('P5', '(16)')
		->setCellValue('Q3', 'Jabatan')
		->setCellValue('Q5', '(17)');
	    $sql="SELECT*FROM tbgtk WHERE idskul='$idskul'";
		foreach(viewguru($sql) as $s){
			$no++;
			$objPHPExcel->setActiveSheetIndex()
				->setCellValue("A$baris", $no)
				->setCellValue("B$baris",$s['nik'])
				->setCellValue("C$baris",$s['nip']);
			$baris++;
		}
		$semua=$baris-1;
		$objPHPExcel->getActiveSheet()->freezePane('A6');
		$objPHPExcel->setActiveSheetIndex()->getStyle('A1:Q5')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);

		$center = array();
		$center ['alignment']=array();
		$center ['alignment']['horizontal']=PHPExcel_Style_Alignment::HORIZONTAL_CENTER;
		$objPHPExcel->setActiveSheetIndex()->getStyle ( "A3:Q$semua" )->applyFromArray ($center);

		$thick = array ();
		$thick['borders']=array();
		$thick['borders']['allborders']=array();
		$thick['borders']['allborders']['style']=PHPExcel_Style_Border::BORDER_THIN;
		$objPHPExcel->setActiveSheetIndex()->getStyle ("A3:Q$semua" )->applyFromArray ($thick); 

		$objPHPExcel->getActiveSheet()->getStyle('A3:A5')->getAlignment()->setWrapText(true);

		$objPHPExcel->getSheet()->getColumnDimension('A')->setAutoSize(true);
		$objPHPExcel->getSheet()->getColumnDimension('B')->setAutoSize(true);
		$objPHPExcel->getSheet()->getColumnDimension('C')->setAutoSize(true);
		$objPHPExcel->getSheet()->getColumnDimension('D')->setAutoSize(true);
		$objPHPExcel->getSheet()->getColumnDimension('E')->setAutoSize(true);
		$objPHPExcel->getSheet()->getColumnDimension('F')->setAutoSize(true);
		$objPHPExcel->getSheet()->getColumnDimension('G')->setAutoSize(true);
		$objPHPExcel->getSheet()->getColumnDimension('H')->setAutoSize(true);
		$objPHPExcel->getSheet()->getColumnDimension('I')->setAutoSize(true);
		$objPHPExcel->getSheet()->getColumnDimension('J')->setAutoSize(true);
		$objPHPExcel->getSheet()->getColumnDimension('K')->setAutoSize(true);
		$objPHPExcel->getSheet()->getColumnDimension('L')->setAutoSize(true);
		$objPHPExcel->getSheet()->getColumnDimension('M')->setAutoSize(true);
		$objPHPExcel->getSheet()->getColumnDimension('N')->setAutoSize(true);
		$objPHPExcel->getSheet()->getColumnDimension('O')->setAutoSize(true);
		$objPHPExcel->getSheet()->getColumnDimension('P')->setAutoSize(true);
		$objPHPExcel->getSheet()->getColumnDimension('Q')->setAutoSize(true);
	
	$objPHPExcel->getActiveSheet()->setTitle($nama);
	$objPHPExcel->setActiveSheetIndex(0);
	header('Content-Type: application/vnd.ms-excel');
	header('Content-Disposition: attachment;filename="'.$nama.'.xls"');
	header('Cache-Control: max-age=0');
	
	$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
	$objWriter->save('php://output');
	exit;
?>