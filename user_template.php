<?php
require_once 'assets/library/PHPExcel.php';
include "dvfunction.php";
$objPHPExcel = new PHPExcel();
$objPHPExcel->getProperties()->setCreator("Kasworo Wardani")
	->setLastModifiedBy("Kasworo Wardani")
	->setTitle("Office 2007 XLSX Test Document")
	->setSubject("Office 2007 XLSX Test Document")
	->setDescription("Soal Export")
	->setKeywords("office 2007 openxml php")
	->setCategory("Daftar User");
$objPHPExcel->setActiveSheetIndex(0)
  ->mergeCells('A1:N1')
  ->mergeCells('A3:A4')
  ->mergeCells('B3:B4')
  ->mergeCells('C3:C4')
  ->mergeCells('D3:E3')
  ->mergeCells('F3:F4')
  ->mergeCells('G3:G4')
  ->mergeCells('H3:O3')
  ->setCellValue('A1', 'TEMPLATE DATA USER')
  ->setCellValue('A3', 'No')
  ->setCellValue('A5', '(1)')
  ->setCellValue('B3', 'Username')
  ->setCellValue('B5', '(2)')
  ->setCellValue('C3', 'Nama Lengkap') 
  ->setCellValue('C5', '(3)') 
  ->setCellValue('D3', 'Tempat Dan Tanggal Lahir')
  ->setCellValue('D4', 'Tempat')
  ->setCellValue('D5', '(4)')
  ->setCellValue('E4', 'Tanggal')
  ->setCellValue('E5', '(5)')
  ->setCellValue('F3', 'Gender')
  ->setCellValue('F5', '(6)')
  ->setCellValue('G3', 'Agama')
  ->setCellValue('G5', '(7)')
  ->setCellValue('H3', 'Alamat Lengkap')
  ->setCellValue('H4', 'Alamat')
  ->setCellValue('H5', '(12)')
  ->setCellValue('I4', 'Desa')
  ->setCellValue('I5', '(13)')
  ->setCellValue('J4', 'Kecamatan')
  ->setCellValue('J5', '(14)')
  ->setCellValue('K4', 'Kabupatan/Kota')
  ->setCellValue('K5', '(15)')
  ->setCellValue('L4', 'Provinsi')
  ->setCellValue('L5', '(16)')
  ->setCellValue('M4', 'Kode Pos')
  ->setCellValue('M5', '(17)')
  ->setCellValue('N4', 'No. HP')
  ->setCellValue('N5', '(18)');
  $semua=0;
  $no=0;
  $baris=6;
  
  $qsiswa=$conn->query("SELECT*FROM tbuser");
  $ceksiswa=$qsiswa->num_rows;
  if($ceksiswa>0){
	while($s=$qsiswa->fetch_array())
	{
		$no++;
		$objPHPExcel->setActiveSheetIndex(0)
		->setCellValue("A$baris", $no)->setCellValue("b$baris",$s['username'])->setCellValue("C$baris",ucwords(strtolower($s['nama'])))->setCellValue("D$baris",ucwords(strtolower($s['tmplahir'])))->setCellValue("E$baris",$s['tgllahir'])->setCellValue("F$baris",$s['gender'])->setCellValue("G$baris",$s['agama'])->setCellValue("H$baris",$s['alamat'])->setCellValue("I$baris",$s['desa'])->setCellValue("J$baris",$s['kec'])->setCellValue("K$baris",$s['kab'])->setCellValue("L$baris",$s['prov'])->setCellValue("M$baris",$s['kdpos'])->setCellValue("N$baris",$s['nohp']);
		$baris++;
	}
  }
  else
  {
	while($no<70)
	{
		$no++;
		$objPHPExcel->setActiveSheetIndex(0)
		->setCellValue("A$baris", $no)->setCellValue("B$baris",'')->setCellValue("C$baris",'')->setCellValue("D$baris", '')->setCellValue("E$baris", '')->setCellValue("F$baris", '')->setCellValue("G$baris", '')->setCellValue("H$baris", '')->setCellValue("I$baris", '')->setCellValue("J$baris", '')->setCellValue("K$baris", '')->setCellValue("L$baris", '')->setCellValue("M$baris", '')->setCellValue("N$baris", '');
		$baris++; 
	}
	}
$semua=$baris-1;
$objPHPExcel->getActiveSheet()->freezePane('A6');

$objPHPExcel->setActiveSheetIndex()->getStyle('A1:N5')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);

$center = array();
$center ['alignment']=array();
$center ['alignment']['horizontal']=PHPExcel_Style_Alignment::HORIZONTAL_CENTER;
$objPHPExcel->setActiveSheetIndex()->getStyle ( 'A3:N5' )->applyFromArray ($center);

$thick = array ();
$thick['borders']=array();
$thick['borders']['allborders']=array();
$thick['borders']['allborders']['style']=PHPExcel_Style_Border::BORDER_THIN;
$objPHPExcel->setActiveSheetIndex()->getStyle ("A3:N$semua" )->applyFromArray ($thick); 

$objPHPExcel->getActiveSheet()->getStyle('A3:A5')->getAlignment()->setWrapText(true);

$objPHPExcel->getSheet(0)->getColumnDimension('A')->setAutoSize(true);
$objPHPExcel->getSheet(0)->getColumnDimension('B')->setAutoSize(true);
$objPHPExcel->getSheet(0)->getColumnDimension('C')->setAutoSize(true);
$objPHPExcel->getSheet(0)->getColumnDimension('D')->setAutoSize(true);
$objPHPExcel->getSheet(0)->getColumnDimension('E')->setAutoSize(true);
$objPHPExcel->getSheet(0)->getColumnDimension('F')->setAutoSize(true);
$objPHPExcel->getSheet(0)->getColumnDimension('G')->setAutoSize(true);
$objPHPExcel->getSheet(0)->getColumnDimension('H')->setAutoSize(true);
$objPHPExcel->getSheet(0)->getColumnDimension('I')->setAutoSize(true);
$objPHPExcel->getSheet(0)->getColumnDimension('J')->setAutoSize(true);
$objPHPExcel->getSheet(0)->getColumnDimension('K')->setAutoSize(true);
$objPHPExcel->getSheet(0)->getColumnDimension('L')->setAutoSize(true);
$objPHPExcel->getSheet(0)->getColumnDimension('M')->setAutoSize(true);
$objPHPExcel->getSheet(0)->getColumnDimension('N')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->setTitle('tb_user');
$objPHPExcel->setActiveSheetIndex(0);
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="tb_user.xls"');
header('Cache-Control: max-age=0');
 
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$objWriter->save('php://output');
exit;
?>