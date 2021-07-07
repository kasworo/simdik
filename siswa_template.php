<?php
	require_once "assets/library/PHPExcel.php";
	include "config/konfigurasi.php";
	include "config/function_siswa.php";
	include "config/function_skul.php";
	
	$objPHPExcel = new PHPExcel();
	$objPHPExcel->getProperties()->setCreator("Kasworo Wardani")
		->setLastModifiedBy("Kasworo Wardani")
		->setTitle("TemplateGTK")
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
			$qsiswa="SELECT*FROM tbsiswa WHERE idskul='$idskul'";
			if(ceksiswa($qsiswa)>0){
				foreach(viewsiswa($qsiswa) as $s)
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
		$objPHPExcel->setActiveSheetIndex()->getStyle("A6:AE$semua")->getNumberFormat()->setFormatCode( PHPExcel_Style_NumberFormat::FORMAT_STRING);
		

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
	else {
		if($_GET['d']=='2'){
			$nama="tb_ayah";
			$qsiswa="SELECT a.*, s.nmsiswa, s.nisn, s.nis FROM tbsiswa s INNER JOIN tbortu a ON s.idsiswa=a.idsiswa WHERE s.idskul='$idskul' AND a.hubkel='1' ORDER BY s.nmsiswa";
		}
		else if($_GET['d']=='3'){
			$nama="tb_ibu";
			$qsiswa="SELECT a.*, s.nmsiswa, s.nisn, s.nis FROM tbsiswa s INNER JOIN tbortu a ON s.idsiswa=a.idsiswa WHERE s.idskul='$idskul' AND a.hubkel='2' ORDER BY s.nmsiswa";

		}
		else {
			$nama="tb_wali";
			$qsiswa="SELECT a.*, s.nmsiswa, s.nisn, s.nis FROM tbsiswa s INNER JOIN tbortu a ON s.idsiswa=a.idsiswa WHERE s.idskul='$idskul' AND a.hubkel<>'1' AND a.hubkel<>'2' ORDER BY s.nmsiswa";
		}
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
			->setCellValue('A1', 'TEMPLATE DATA ORANG TUA/WALI PESERTA DIDIK')
			->setCellValue('A3', 'No')
			->setCellValue('A5', '(1)')
			->setCellValue('B3', 'NIS')
			->setCellValue('B5', '(2)')
			->setCellValue('C3', 'NISN') 
			->setCellValue('C5', '(3)')
			->setCellValue('D3', 'Nama Peserta Didik') 
			->setCellValue('D5', '(4)') 
			->setCellValue('E3', 'Nama Orang Tua/Wali')
			->setCellValue('E5', '(5)') 
			->setCellValue('F3', 'NIK Orang Tua/Wali')
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
			->setCellValue('M3', 'Alamat Orang Tua/Wali')
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
			->setCellValue('T3', 'Masih Hidup')
			->setCellValue('T5', '(20)')
			->setCellValue('U3', 'Hubungan Keluarga')
			->setCellValue('U5', '(21)');
			if(ceksiswa($qsiswa)>0){
				foreach(viewsiswa($qsiswa) as $s)
				{
					$no++;
					$objPHPExcel->setActiveSheetIndex(0)
						->setCellValue("A$baris", $no)
						->setCellValue("B$baris",$s['nis'])
						->setCellValue("C$baris",$s['nisn'])
						->setCellValue("D$baris",$s['nmsiswa'])						
						->setCellValue("E$baris",$s['nmortu'])
						->setCellValue("F$baris",$s['nik'])
						->setCellValue("G$baris",$s['tmplahir'])
						->setCellValue("H$baris",$s['tgllahir'])
						->setCellValue("I$baris",$s['idagama'])
						->setCellValue("J$baris",$s['idppdk'])
						->setCellValue("K$baris",$s['idkerja'])
						->setCellValue("L$baris",$s['idhsl'])
						->setCellValue("M$baris",$s['alamat'])
						->setCellValue("N$baris",$s['desa'])
						->setCellValue("O$baris",$s['kec'])
						->setCellValue("P$baris",$s['kab'])
						->setCellValue("Q$baris",$s['prov'])
						->setCellValue("R$baris",$s['kdpos'])
						->setCellValue("S$baris",$s['nohp'])
						->setCellValue("T$baris",$s['hidup'])
						->setCellValue("U$baris",$s['hubkel']);
					$baris++;
				}
			}
			else {
				$sql="SELECT a.*, s.nmsiswa, s.nisn, s.nis FROM tbsiswa s LEFT JOIN tbortu a ON s.idsiswa=a.idsiswa WHERE s.idskul='$idskul' ORDER BY s.nmsiswa";
				foreach(viewsiswa($sql) as $s)
				{
					$no++;
					$objPHPExcel->setActiveSheetIndex(0)
						->setCellValue("A$baris", $no)
						->setCellValue("B$baris",$s['nis'])
						->setCellValue("C$baris",$s['nisn'])
						->setCellValue("D$baris",$s['nmsiswa'])						
						->setCellValue("E$baris",$s['nmortu'])
						->setCellValue("F$baris",$s['nik'])
						->setCellValue("G$baris",$s['tmplahir'])
						->setCellValue("H$baris",$s['tgllahir'])
						->setCellValue("I$baris",$s['idagama'])
						->setCellValue("J$baris",$s['idppdk'])
						->setCellValue("K$baris",$s['idkerja'])
						->setCellValue("L$baris",$s['idhsl'])
						->setCellValue("M$baris",$s['alamat'])
						->setCellValue("N$baris",$s['desa'])
						->setCellValue("O$baris",$s['kec'])
						->setCellValue("P$baris",$s['kab'])
						->setCellValue("Q$baris",$s['prov'])
						->setCellValue("R$baris",$s['kdpos'])
						->setCellValue("S$baris",$s['nohp'])
						->setCellValue("T$baris",$s['hidup'])
						->setCellValue("U$baris",$s['hubkel']);
					$baris++;
				}
			}
		$semua=$baris-1;
		$objPHPExcel->getActiveSheet()->freezePane('A6');

		$objPHPExcel->setActiveSheetIndex()->getStyle('A1:T5')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);

		$center = array();
		$center ['alignment']=array();
		$center ['alignment']['horizontal']=PHPExcel_Style_Alignment::HORIZONTAL_CENTER;
		$objPHPExcel->setActiveSheetIndex()->getStyle('A3:T5')->applyFromArray($center);

		$thick = array();
		$thick['borders']=array();
		$thick['borders']['allborders']=array();
		$thick['borders']['allborders']['style']=PHPExcel_Style_Border::BORDER_THIN;
		$objPHPExcel->setActiveSheetIndex()->getStyle("A3:T$semua")->applyFromArray($thick); 

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
		$objPHPExcel->getSheet(0)->getColumnDimension('O')->setAutoSize(true);
		$objPHPExcel->getSheet(0)->getColumnDimension('P')->setAutoSize(true);
		$objPHPExcel->getSheet(0)->getColumnDimension('Q')->setAutoSize(true);
		$objPHPExcel->getSheet(0)->getColumnDimension('R')->setAutoSize(true);
		$objPHPExcel->getSheet(0)->getColumnDimension('S')->setAutoSize(true);
		$objPHPExcel->getSheet(0)->getColumnDimension('T')->setAutoSize(true);
		$objPHPExcel->getSheet(0)->getColumnDimension('U')->setAutoSize(true);	
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