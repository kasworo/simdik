if (isset($_POST['downijz'])) {
//var_dump($_POST['kls']);die;
$data = getsiswa($_POST['klsijz'], $_POST['thnijz']);
$thn = gettahun($_POST['thnijz']);
$tahun = $thn['nmthpel'];
$kls = getkelas($_POST['klsijz']);
$namafile = 'ijazah_' . $kls['idkelas'] . '_' . $thn['nmthpel'];

$objPHPExcel = new PHPExcel();
$objPHPExcel->getProperties()->setCreator("Kasworo Wardani")
->setTitle("Template")->setLastModifiedBy("Kasworo Wardani");
$objPHPExcel->setActiveSheetIndex(0)
->setCellValue('A1', 'TEMPLATE INPUT NILAI IJAZAH')
->setCellValue('A2', strtoupper('Tahun Pelajaran ' . str_replace('-', ' Semester ', $thn['desthpel'])))
->setCellValue('A3', strtoupper($kls['nmkelas']))
->setCellValue('A5', 'No.')->setCellValue('A9', '(1)')
->setCellValue('B5', 'NIS')->setCellValue('B9', '(2)')
->setCellValue('C5', 'Nama Peserta Didik')->setCellValue('C9', '(3)')
->setCellValue('D5', 'Kode Tahun Pelajaran')->setCellValue('D9', '(4)')
->setCellValue('E5', 'Nilai Ijazah Per Mata Pelajaran');
$jmp = 0;
$qmp = getmapel();
foreach ($qmp as $mp) {
$objPHPExcel->setActiveSheetIndex(0)
->setCellValueByColumnAndRow($jmp + 4, 7, $mp['akmapel'])
->mergeCells(CellsToMergeByColsRow($jmp + 4, $jmp + 4, 7, 2))
->setCellValueByColumnAndRow($jmp + 4, 9, '(' . ($jmp + 5) . ')');
$jmp++;
}
$objPHPExcel->setActiveSheetIndex(0)
->mergeCells('A5:A8')->mergeCells('B5:B8')
->mergeCells('C5:C8')->mergeCells('D5:D8')
->setCellValueByColumnAndRow($jmp + 4, 5, 'Rata-rata')
->setCellValueByColumnAndRow($jmp + 4, 9, '(' . ($jmp + 5) . ')')
->mergeCells(cellsToMergeByColsRow(4, ($jmp - 1) + 4, 5, 2))
->mergeCells(cellsToMergeByColsRow($jmp + 4, $jmp + 4, 5, 4));
$baris = 10;
$no = 0;
foreach ($data as $s) {
$no++;
$objPHPExcel->setActiveSheetIndex(0)
->setCellValueByColumnAndRow(0, $baris, $no)
->setCellValueByColumnAndRow(1, $baris, $s['nis'])
->setCellValueByColumnAndRow(2, $baris, $s['nmsiswa'])
->setCellValueByColumnAndRow(3, $baris, $tahun);
$qmp = getmapel();
$jmp = 0;
foreach ($qmp as $mp) {
$sqlijz = "SELECT AVG(nilaiijz) as rata FROM tbnilaiijz INNER JOIN tbsiswa USING(idsiswa) INNER JOIN tbthpel USING(idthpel) WHERE nis='$s[nis]' AND idmapel='$mp[idmapel]' AND nmthpel='$tahun' GROUP BY idsiswa, idthpel";
$kog = vquery($sqlijz);
$objPHPExcel->setActiveSheetIndex(0)
->setCellValueByColumnAndRow($jmp + 4, $baris, $kog['nilaiijz']);

$jmp++;
}
$sqlijz = "SELECT AVG(nilaiijz) as rata FROM tbnilaiijz INNER JOIN tbsiswa USING(idsiswa) INNER JOIN tbthpel USING(idthpel) WHERE nis='$s[nis]' AND idmapel='$mp[idmapel]' AND nmthpel='$tahun' GROUP BY idsiswa, idthpel";
$avk = vquery($sqlijz);
$objPHPExcel->setActiveSheetIndex(0)
->setCellValueByColumnAndRow($jmp + 4, $baris, number_format($avk['rata'], 1, ',', '.'));

$baris++;
}
}

$semua = $baris - 1;
$objPHPExcel->getActiveSheet()->freezePane("A10");
$objPHPExcel->getActiveSheet()->getStyle('A5:' . $objPHPExcel
->getActiveSheet()->getHighestColumn() . '9')->getAlignment()->setWrapText(true);
$objPHPExcel->setActiveSheetIndex()->getStyle('A5:' . $objPHPExcel
->getActiveSheet()->getHighestColumn() . '9')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);

$center = array();
$center['alignment'] = array();
$center['alignment']['horizontal'] = PHPExcel_Style_Alignment::HORIZONTAL_CENTER;
$objPHPExcel->setActiveSheetIndex()->getStyle('A5:' . $objPHPExcel->getActiveSheet()->getHighestColumn() . '9')->applyFromArray($center);

$objPHPExcel->setActiveSheetIndex()->getStyle("A10:B" . $objPHPExcel->getActiveSheet()->getHighestRow())->applyFromArray($center);
$objPHPExcel->setActiveSheetIndex()->getStyle("D10:" . $objPHPExcel->getActiveSheet()->getHighestColumn() . $objPHPExcel->getActiveSheet()->getHighestRow())->applyFromArray($center);

$thick = array();
$thick['borders'] = array();
$thick['borders']['allborders'] = array();
$thick['borders']['allborders']['style'] = PHPExcel_Style_Border::BORDER_THIN;
$objPHPExcel->setActiveSheetIndex()->getStyle('A1:' . $objPHPExcel->getActiveSheet()->getHighestColumn() . $objPHPExcel->getActiveSheet()->getHighestRow())->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
$objPHPExcel->setActiveSheetIndex()->getStyle('A5:' . $objPHPExcel->getActiveSheet()->getHighestColumn() . $objPHPExcel->getActiveSheet()->getHighestRow())->applyFromArray($thick);
$objPHPExcel->getActiveSheet()->setTitle($namafile);
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="' . $namafile . '.xls"');
header('Cache-Control: max-age=0');
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$objWriter->save('php://output');
exit;