<?php
	session_start();
  require_once '../assets/library/PHPExcel.php';
	include "../config/konfigurasi.php"; 
	include "../config/mergeCells.php";

// Create new PHPExcel object
$objPHPExcel = new PHPExcel();

//$var_soal = "$_REQUEST[ujian]";
// Set properties
$objPHPExcel->getProperties()->setCreator("Kasworo Wardani")
	  ->setLastModifiedBy("Kasworo Wardani")
	  ->setTitle("Office 2007 XLSX Test Document")
	  ->setSubject("Office 2007 XLSX Test Document")
	  ->setDescription("Soal Export")
	  ->setKeywords("office 2007 openxml php")
	  ->setCategory("Daftar nilai");
 
// Add some data
$qt=mysqli_query($sqlconn,"SELECT COUNT(*) as akhir FROM tb_thpel");
$t=mysqli_fetch_array($qt);
$akhir=$t['akhir'];
$awal=$akhir-6;

$objPHPExcel->setActiveSheetIndex(0)
  ->mergeCells('A3:A4')->mergeCells('B3:B4')->mergeCells('C3:C4')->mergeCells('D3:D4')->mergeCells('E3:E4')
  ->setCellValue('A1', 'TEMPLATE NILAI SIKAP PESERTA DIDIK')
  ->setCellValue('A3', 'No')
  ->setCellValue('A5', '(1)')
  ->setCellValue('B3', 'Id Siswa')
  ->setCellValue('B5', '(2)') 
  ->setCellValue('C3', 'NISN')
  ->setCellValue('C5', '(3)') 
  ->setCellValue('D3', 'Nama Lengkap')
  ->setCellValue('D5', '(4)')
  ->setCellValue('E3', 'Aspek')
  ->setCellValue('E5', '(5)')
  ->setCellValue('F3', 'Nilai Sikap Semester'); 
  $kol=5;
  $i=0;
  $qmp=mysqli_query($sqlconn, "SELECT idthpel FROM tb_thpel LIMIT  $awal,$akhir");
  while($mp=mysqli_fetch_array($qmp))
  {	
   $i++;
	$objPHPExcel->setActiveSheetIndex(0)
	->setCellValueByColumnAndRow($kol,4, $i)
	->setCellValueByColumnAndRow($kol,5, '('.($kol+1).')');
  
	$kol++;	
  }
  $objPHPExcel->setActiveSheetIndex(0)->mergeCells(cellsToMergeByColsRow(5,$kol-1,3));
  $objPHPExcel->setActiveSheetIndex(0)->setCellValueByColumnAndRow($kol,3,'Keterangan')->setCellValueByColumnAndRow($kol,5,'('.($kol+1).')' );
  $kolom=$objPHPExcel->getActiveSheet()->getHighestColumn();
  $objPHPExcel->setActiveSheetIndex(0)->mergeCells($kolom."3:".$kolom."4");
$no=0;
$baris=5;
$qpd=mysqli_query($sqlconn,"SELECT idsiswa, nisn, nama FROM tb_siswa");

while($pd=mysqli_fetch_array($qpd))
{
	$no++;
	$baris++;
	$objPHPExcel->setActiveSheetIndex(0)
	  ->setCellValue("A$baris", $no)->setCellValue("B$baris",$pd['idsiswa'])->setCellValue("C$baris", $pd['nisn'])->setCellValue("D$baris", $pd['nama'])->setCellValue("E$baris", '')->setCellValue("F$baris", '')->setCellValue("G$baris", '')->setCellValue("H$baris", '')->setCellValue("I$baris", '')->setCellValue("J$baris", '')->setCellValue("K$baris", '')->setCellValue("L$baris", '');
}
$semua=$baris;
$objPHPExcel->getActiveSheet()->mergeCells("A1:".$objPHPExcel
->getActiveSheet()->getHighestColumn()."1");
$objPHPExcel->getActiveSheet()->getStyle("A6:". $objPHPExcel
->getActiveSheet()->getHighestColumn().$objPHPExcel
->getActiveSheet()->getHighestRow())
	->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT);
	
$objPHPExcel->getActiveSheet()->freezePane('A6');
$objPHPExcel->getActiveSheet()->getStyle('A3:'.$objPHPExcel
->getActiveSheet()->getHighestColumn().'5')->getAlignment()->setWrapText(true);
$objPHPExcel->setActiveSheetIndex()->getStyle('A1:'. $objPHPExcel
->getActiveSheet()->getHighestColumn().'5')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);

$center = array();
$center ['alignment']=array();
$center ['alignment']['horizontal']=PHPExcel_Style_Alignment::HORIZONTAL_CENTER;
$objPHPExcel->setActiveSheetIndex()->getStyle ( 'A3:'.$objPHPExcel->getActiveSheet()->getHighestColumn().'5' )->applyFromArray ($center);

$objPHPExcel->setActiveSheetIndex()->getStyle ("A6:A".$objPHPExcel->getActiveSheet()->getHighestRow() )->applyFromArray ($center);

$thick = array ();
$thick['borders']=array();
$thick['borders']['allborders']=array();
$thick['borders']['allborders']['style']=PHPExcel_Style_Border::BORDER_THIN;
$objPHPExcel->setActiveSheetIndex()->getStyle('A1:'. $objPHPExcel->getActiveSheet()->getHighestColumn().$objPHPExcel->getActiveSheet()->getHighestRow())->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
$objPHPExcel->setActiveSheetIndex()->getStyle ('A3:'. $objPHPExcel->getActiveSheet()->getHighestColumn().$objPHPExcel->getActiveSheet()->getHighestRow())->applyFromArray ($thick);
// Rename sheet
$objPHPExcel->getActiveSheet()->setTitle('template_sikap');

// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);

// Redirect output to a client’s web browser (Excel5)
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="template_sikap.xls"');
header('Cache-Control: max-age=0');
 
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$objWriter->save('php://output');
exit;
?>