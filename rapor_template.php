<?php
	
	require_once "assets/library/PHPExcel.php";
	include "config/konfigurasi.php";
	include "config/function_nilai.php";
	include "config/function_skul.php";	
	
	function getmapel($id){
		global $conn;
		$sql=$conn->query("SELECT*FROM tbmapel WHERE idmapel='$id'");
		while($row=$sql->fetch_assoc()){
			$rows=array(
				'idmapel'=>$row['idmapel'],
				'nmmapel'=>$row['nmmapel']
			);
		}
		return $rows;
	}

	function getthn($id){
		global $conn;
		$sql=$conn->query("SELECT*FROM tbthpel WHERE idthpel='$id'");
		$rows=[];
		while($row=$sql->fetch_assoc()){
			$rows=array(
				'idthpel'=>$row['idthpel'],
				'nmthpel'=>$row['nmthpel'],
				'desthpel'=>$row['desthpel']
			);
		}
		return $rows;
	}

	function getsiswa($rb,$th){
		global $conn;
		if($rb=='' || $th==''){
			$sql=$conn->query("SELECT nis, nisn, nmsiswa FROM tbsiswa pd LEFT JOIN tbregistrasi rg ON rg.idsiswa=pd.idsiswa LEFT JOIN tbrombel rb ON rb.idrombel=rg.idrombel LEFT JOIN tbthpel tp ON tp.idthpel=rb.idthpel WHERE pd.deleted='0'");
		}
		else {
			$sql=$conn->query("SELECT nis, nisn, nmsiswa FROM tbsiswa pd LEFT JOIN tbregistrasi rg ON rg.idsiswa=pd.idsiswa LEFT JOIN tbrombel rb ON rb.idrombel=rg.idrombel LEFT JOIN tbthpel tp ON tp.idthpel=rb.idthpel WHERE pd.deleted='0' AND rg.idrombel='$rb' AND rb.idthpel='$th'");
		}
		$rows=[];
		while($row=$sql->fetch_assoc()){
			$rows[]=$row;
		}
		return $rows;
	}

	function getrombel($id){
		global $conn;
		$sql=$conn->query("SELECT idrombel, nmrombel FROM tbrombel WHERE deleted='0'");
		$rows=[];
		while($row=$sql->fetch_assoc()){
			$rows[]=$row;
		}
		return $rows;
	}

	$mp=getmapel($_GET['m']);
	$th=getthn($_GET['t']);
	$objPHPExcel = new PHPExcel();
	$objPHPExcel->getProperties()->setCreator("Kasworo Wardani")
		->setTitle("Template")->setLastModifiedBy("Kasworo Wardani");
	$nama="rapor_template";
	if($_GET['d']=='1'){$aspek='Sikap Spiritual';}
	if($_GET['d']=='2'){$aspek='Sikap Sosial';}
	if($_GET['d']=='3'){$aspek='Pengetahuan';}
	if($_GET['d']=='4'){$aspek='Keterampilan';}
	$baris=8;
	$no=0;
	$objPHPExcel->setActiveSheetIndex(0)
		->mergeCells('A1:J1')
		->mergeCells('A3:C3')
		->mergeCells('A4:C4')
		->mergeCells('A5:C5')
		->mergeCells('A6:C6')
		->mergeCells('C8:F8')
		->mergeCells('F3:J3')
		->mergeCells('F4:J4')
		->mergeCells('F5:J5')
		->mergeCells('F6:J6')
		->setCellValue('A1', 'TEMPLATE INPUT NILAI RAPOR')
		->setCellValue('A3', 'Tahun Pelajaran')
		->setCellValue('D3', ':')
		->setCellValue('E3', $th['idthpel'])
		->setCellValue('F3', ' - '.$th['desthpel'])
		->setCellValue('A4', 'Kelas')
		->setCellValue('D4', ':')
		->setCellValue('E4', $th['idthpel'])
		->setCellValue('F4', ' - '.$th['desthpel'])
		->setCellValue('A5', 'Mata Pelajaran')
		->setCellValue('D5', ':')
		->setCellValue('E5', $mp['idmapel'])
		->setCellValue('F5', ' - '.$mp['nmmapel'])
		->setCellValue('A6', 'Penilaian')
		->setCellValue('D6', ':')
		->setCellValue('A8', 'No.')
		->setCellValue('B8', 'NIS')
		->setCellValue('C8', 'NISN')
		->setCellValue('G8', 'Nama Peserta Didik')
		->setCellValue('H8', 'Nilai')
		->setCellValue('I8', 'Predikat')
		->setCellValue('J8', 'Deskripsi');
		foreach (getsiswa() as $s){
			$no++;
			$baris++;
			$objPHPExcel->setActiveSheetIndex(0)
				->setCellValue("A$baris", $no)
				->setCellValue("B$baris",$s['nis'])
				->setCellValue("C$baris",$s['nisn'])
				->setCellValue("G$baris",$s['nmsiswa'])
				->mergeCells("C$baris:F$baris");
		}
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
	$objPHPExcel->getActiveSheet()->setTitle($nama);
	$objPHPExcel->setActiveSheetIndex(0);
	header('Content-Type: application/vnd.ms-excel');
	header('Content-Disposition: attachment;filename="'.$nama.'.xls"');
	header('Cache-Control: max-age=0');
	$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
	$objWriter->save('php://output');
	exit;
	
?>