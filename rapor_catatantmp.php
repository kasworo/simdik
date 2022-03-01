<?php
require_once "assets/library/PHPExcel.php";
include "dbfunction.php";
$sql = "SELECT MAX(idkelas) as maks FROM tbkelas INNER JOIN tbjenjang USING(idjenjang) INNER JOIN tbskul USING(idjenjang)";
$kl = vquery($sql)[0];
$kelas = $kl['maks'];
$objPHPExcel = new PHPExcel();
$objPHPExcel->getProperties()->setCreator("Kasworo Wardani")
    ->setLastModifiedBy("Kasworo Wardani")
    ->setTitle("Template")
    ->setCompany("Z&N.Corp");
$idskul = getskul();
$semua = 0;
$no = 0;
$baris = 6;
$nama = "tb_keputusanakhir";
$objPHPExcel->setActiveSheetIndex(0)
    ->setCellValue('A1', 'TEMPLATE DATA KEPUTUSAN AKHIR TAHUN')
    ->mergeCells('A1:H1')
    ->mergeCells('A3:A4')
    ->mergeCells('B3:B4')
    ->mergeCells('C3:C4')
    ->mergeCells('D3:D4')
    ->mergeCells('E3:F3')
    ->mergeCells('G3:G4')
    ->mergeCells('H3:H4')
    ->setCellValue('A3', 'No')
    ->setCellValue('A5', '(1)')
    ->setCellValue('B3', 'N I S')
    ->setCellValue('B5', '(2)')
    ->setCellValue('C3', 'N I S N')
    ->setCellValue('C5', '(3)')
    ->setCellValue('D3', 'Nama Peserta Didik')
    ->setCellValue('D5', '(4)')
    ->setCellValue('E3', 'Keputusan Akhir Tahun')
    ->setCellValue('E4', 'Tanggal')
    ->setCellValue('E5', '(5)')
    ->setCellValue('F4', 'Isi Keputusan')
    ->setCellValue('F5', '(6)')
    ->setCellValue('G3', 'Kode Tahun')
    ->setCellValue('G5', '(7)')
    ->setCellValue('H3', 'Ket.')
    ->setCellValue('H5', '(8)');
$sqls = "SELECT nmsiswa, nisn, nis, nmthpel FROM tbsiswa LEFT JOIN tbregistrasi rg USING(idsiswa) LEFT JOIN tbthpel tp USING(idthpel) LEFT JOIN ref_jnsregistrasi USING(idjreg) WHERE deleted='0' AND tp.aktif='1' AND rg.idjreg='4' ORDER BY nis";
$datane = vquery($sqls);
foreach ($datane as $row) {
    $no++;
    $objPHPExcel->setActiveSheetIndex(0)
        ->setCellValue("A$baris", $no)
        ->setCellValue("B$baris", ($row['nis']))
        ->setCellValue("C$baris", $row['nisn'])
        ->setCellValue("D$baris", ucwords(strtolower($row['nmsiswa'])))
        ->setCellValue("G$baris", $row['nmthpel']);
    $baris++;
}
$semua = $baris - 1;
$objPHPExcel->getActiveSheet()->freezePane("A6");
$objPHPExcel->setActiveSheetIndex()->getStyle("A6:H$semua");
$objPHPExcel->setActiveSheetIndex()->getStyle("A1:H5")->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
$center = array();
$center['alignment'] = array();
$center['alignment']['horizontal'] = PHPExcel_Style_Alignment::HORIZONTAL_CENTER;
$objPHPExcel->setActiveSheetIndex()->getStyle("A1:H5")->applyFromArray($center);
$objPHPExcel->setActiveSheetIndex()->getStyle("A6:C$semua")->applyFromArray($center);
$objPHPExcel->setActiveSheetIndex()->getStyle("G6:H$semua")->applyFromArray($center);
$thick = array();
$thick['borders'] = array();
$thick['borders']['allborders'] = array();
$thick['borders']['allborders']['style'] = PHPExcel_Style_Border::BORDER_THIN;
$objPHPExcel->setActiveSheetIndex()->getStyle("A3:H$semua")->applyFromArray($thick);
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
header('Content-Disposition: attachment;filename="' . $nama . '.xls"');
header('Cache-Control: max-age=0');
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$objWriter->save('php://output');
exit;
