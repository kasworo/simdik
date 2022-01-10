<?php
	require_once "assets/library/PHPExcel.php";
	include "dbfunction.php";
    function getsiswa($kls,$th,$as){
        if($as=='1' || $as=='2'){
            $sql="SELECT s.nis, s.nisn, s.nmsiswa, nr.nilaisikap as nilairapor, nr.predikat, nr.deskripsi FROM tbsiswa s INNER JOIN tbregistrasi r ON r.idsiswa=s.idsiswa LEFT JOIN tbnilaisikap nr ON nr.idsiswa=s.idsiswa AND r.idthpel=nr.idthpel  WHERE r.idkelas='$kls' AND r.idthpel='$th' ORDER BY s.idsiswa";
        }
        if($as=='3' || $as=='4'){
            $sql="SELECT s.nis, s.nisn, s.nmsiswa, nr.nilairapor, nr.predikat, nr.deskripsi, nr.idmapel FROM tbsiswa s INNER JOIN tbregistrasi r ON r.idsiswa=s.idsiswa LEFT JOIN tbnilairapor nr ON nr.idsiswa=s.idsiswa AND r.idthpel=nr.idthpel  WHERE r.idkelas='$kls' AND r.idthpel='$th' ORDER BY s.idsiswa";
        }
        $ds=vquery($sql);
        return $ds;
    }

    function gettahun($th){
        $where=array('idthpel'=>$th);
        $tp=viewdata('tbthpel',$where)[0];
        return $tp;
    }
    
    function getkelas($kls){
        $fkls=array('idkelas', 'nmkelas');
        $tbl=array('tbskul'=>'idjenjang');
        $where=array('idkelas'=>$kls);
        $qkls=fulljoin($fkls,'tbkelas',$tbl,$where)[0];
        return $qkls;
    } 
    
    if(isset($_POST['downloadspr'])){
        $aspek='1 - Sikap Spriritual';           
        $data=getsiswa($_POST['kls1'],$_POST['thpel1'],1);
        $thn=gettahun($_POST['thpel1']);
        $tahun=$thn['idthpel'].' - '.$thn['desthpel'];
        $kls=getkelas($_POST['kls1']);
        $nmkelas=$kls['idkelas'].' - '.$kls['nmkelas'];
        $namafile='spiritual_'.$kls['idkelas'].'_'.$thn['nmthpel'];
    } 

    if(isset($_POST['downloadsos'])){
        $aspek='2 - Sikap Sosial';           
        $data=getsiswa($_POST['kls2'],$_POST['thpel2'],2);
        $thn=gettahun($_POST['thpel2']);
        $tahun=$thn['idthpel'].' - '.$thn['desthpel'];
        $kls=getkelas($_POST['kls2']);
        $nmkelas=$kls['idkelas'].' - '.$kls['nmkelas'];
        $namafile='sosial_'.$kls['idkelas'].'_'.$thn['nmthpel'];
    }

    if(isset($_POST['downloadkog'])){
        $aspek='3 - Pengetahuan';           
        $data=getsiswa($_POST['kls3'],$_POST['thpel3'],3);
        $thn=gettahun($_POST['thpel3']);
        $tahun=$thn['idthpel'].' - '.$thn['desthpel'];
        $kls=getkelas($_POST['kls3']);
        $nmkelas=$kls['idkelas'].' - '.$kls['nmkelas'];
        $namafile='pengetahuan_'.$kls['idkelas'].'_'.$thn['nmthpel'];
    }

    if(isset($_POST['downloadmot'])){
        $aspek='4 - Motorik';           
        $data=getsiswa($_POST['kls4'],$_POST['thpel4'],4);
        $thn=gettahun($_POST['thpel4']);
        $tahun=$thn['idthpel'].' - '.$thn['desthpel'];
        $kls=getkelas($_POST['kls4']);
        $nmkelas=$kls['idkelas'].' - '.$kls['nmkelas'];
        $namafile='pengetahuan_'.$kls['idkelas'].'_'.$thn['nmthpel'];
    }
    
    $objPHPExcel = new PHPExcel();
    $objPHPExcel->getProperties()->setCreator("Kasworo Wardani")
        ->setTitle("Template")->setLastModifiedBy("Kasworo Wardani");
    $objPHPExcel->setActiveSheetIndex(0)        
        ->mergeCells('A1:H1')
        ->mergeCells('A3:C3')
        ->mergeCells('A4:C4')
        ->mergeCells('A5:C5')
        ->mergeCells('A6:C6')
        ->mergeCells('F3:J3')
        ->mergeCells('F4:J4')
        ->mergeCells('F5:J5')
        ->mergeCells('F6:J6')        
        ->setCellValue('A1', 'TEMPLATE INPUT NILAI RAPOR')
        ->setCellValue('A3', 'Tahun Pelajaran')
        ->setCellValue('A4', 'Kelas')
        ->setCellValue('A5', 'Aspek')
        ->setCellValue('D3', ': '.$tahun)
        ->setCellValue('D4', ': '.$nmkelas)
        ->setCellValue('D5', ': '.$aspek)
        ->setCellValue('A7', 'No.')->setCellValue('A8', '(1)')
		->setCellValue('B7', 'NIS')->setCellValue('B8', '(2)')
		->setCellValue('C7', 'NISN')->setCellValue('C8', '(3)')
		->setCellValue('D7', 'Nama Peserta Didik')->setCellValue('D8', '(4)')
		->setCellValue('E7', 'Nilai')->setCellValue('E8', '(5)')
		->setCellValue('F7', 'Predikat')->setCellValue('F8', '(6)')
		->setCellValue('G7', 'Deskripsi')->setCellValue('G8', '(7)')
        ->setCellValue('H7', 'Keterangan')->setCellValue('H8', '(8)'); 
    $baris=9;
	$no=0;  
    foreach ($data as $s){
        $no++;        
        $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue("A$baris", $no)
            ->setCellValue("B$baris",$s['nis'])
            ->setCellValue("C$baris",$s['nisn'])
            ->setCellValue("D$baris",$s['nmsiswa'])
            ->setCellValue("E$baris",$s['nilairapor'])
            ->setCellValue("F$baris",$s['predikat'])
            ->setCellValue("G$baris",$s['deskripsi'])
            ->setCellValue("H$baris",$s['idmapel']);
        $baris++;
    }
    $semua=$baris-1;
    $objPHPExcel->getActiveSheet()->freezePane("A9");
	$objPHPExcel->setActiveSheetIndex()->getStyle("A8:H$semua");
	$objPHPExcel->setActiveSheetIndex()->getStyle("A1:H1")->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
	$center = array();
	$center ['alignment']=array();
	$center ['alignment']['horizontal']=PHPExcel_Style_Alignment::HORIZONTAL_CENTER;
	$objPHPExcel->setActiveSheetIndex()->getStyle("A7:H8")->applyFromArray($center);
	$objPHPExcel->setActiveSheetIndex()->getStyle("A8:C$semua")->applyFromArray($center);
	$objPHPExcel->setActiveSheetIndex()->getStyle("E8:H$semua")->applyFromArray($center);
	$thick = array();
	$thick['borders']=array();
	$thick['borders']['allborders']=array();
	$thick['borders']['allborders']['style']=PHPExcel_Style_Border::BORDER_THIN;
	$objPHPExcel->setActiveSheetIndex()->getStyle("A7:H$semua")->applyFromArray($thick); 
	$objPHPExcel->getSheet(0)->getColumnDimension('A')->setWidth(4);
	$objPHPExcel->getSheet(0)->getColumnDimension('B')->setWidth(8);
	$objPHPExcel->getSheet(0)->getColumnDimension('C')->setWidth(12);
	$objPHPExcel->getSheet(0)->getColumnDimension('D')->setWidth(36);
	$objPHPExcel->getSheet(0)->getColumnDimension('E')->setWidth(24);
	$objPHPExcel->getSheet(0)->getColumnDimension('F')->setWidth(16);
	$objPHPExcel->getSheet(0)->getColumnDimension('G')->setWidth(22);
    $objPHPExcel->getSheet(0)->getColumnDimension('H')->setWidth(12);
	$objPHPExcel->getActiveSheet()->setTitle($namafile);
	$objPHPExcel->setActiveSheetIndex(0);
	header('Content-Type: application/vnd.ms-excel');
	header('Content-Disposition: attachment;filename="'.$namafile.'.xls"');
	header('Cache-Control: max-age=0');
	$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
	$objWriter->save('php://output');
	exit;
?>