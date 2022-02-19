<?php
	session_start();
	if(!isset($_SESSION['login'])){header("Location: login.php");exit;}
	require('assets/library/fpdf/fpdf.php'); 
	include "dbfunction.php";
	
	function UbahKelas($nama)
	{
		$angka=str_replace('Kelas','',$nama);
		switch($angka){
			case '1' : {$romawi='I';break;}
			case '2' : {$romawi='II';break;}
			case '3' : {$romawi='III';break;}
			case '4' : {$romawi='IV';break;}
			case '5' : {$romawi='V';break;}
			case '6' : {$romawi='VI';break;}
			case '7' : {$romawi='VII';break;}
			case '8' : {$romawi='VIII';break;}
			case '9' : {$romawi='IX';break;}
			default : {$romawi='';break;}
		}
		return $romawi;
	}
	
	class PDF extends FPDF
	{
		function Footer()
		{
			if ($this->PageNo()>1) {
				$hal=$this->PageNo()-1;
				$this->SetY(-1.575);
				$this->SetFont('Arial', 'I', 10);
				$this->Cell(29.0, 1.0, 'Halaman '.$hal, 0, 0, 'R');
			}
		}
		
		function ChapterTitle($hal)
		{
			if($hal<=1){
				$this->SetFont('Times','B',14);
				$this->Cell(28.5,0.75,'LAPORAN MUTASI PESERTA DIDIK',0,0,'C');
			}			
		}

		function GetTableJudul($hal)
		{
			if($hal<=1){				
				$y0=3.25;
				$this->SetXY(2.75,$y0);				
			} 
			else {
				$y0=2.25;
				$this->SetXY(2.75,$y0);
			}
			$y1=$y0+0.575;
			$this->SetFont('Times','',10);			
			$this->Cell(0.75,1.15,'No.','LTBR',0,'C');
			$this->Cell(3.25,1.15,'Nomor Induk','TBR',0,'C');			 
			$this->Cell(6.5,1.15,'Nama Peserta Didik','TBR',0,'C');
			$this->Cell(0.75,1.15,'L/P','TBR',0,'C');
			$this->Cell(1.0,1.15,'Kelas','TBR',0,'C'); 
			$this->SetXY(15.0,$y0);
			$this->Cell(2.75,0.575,'Tanggal','TR',0,'C');
			$this->Cell(5.25,0.575,'Nama Satuan Pendidikan','TR',0,'C');
			$this->SetXY(15.0,$y1);			
			$this->Cell(2.75,0.575,'Mutasi','BR',0,'C');
			$this->Cell(5.25,0.575,'Asal / Tujuan','BR',0,'C');
			$this->SetXY(23,$y0); 
			$this->Cell(3.0,0.57,'Mutasi','TBR',0,'C');
			$this->SetXY(23,$y1);
			$this->Cell(1.5,0.575,'Masuk','BR',0,'C');
			$this->Cell(1.5,0.575,'Keluar','BR',0,'C');
			$this->SetXY(26,$y0);
			$this->Cell(5.75,1.15,'Alasan Mutasi','TBR',0,'C');				  
		}
		function GetTableIsi($hal)
		{
			if($hal<=1){
				$y0=3.25;
				$this->SetXY(2.75,$y0);				
			} 
			else {
				$y0=2.25;
				$this->SetXY(2.75,$y0);
			}
			$y1=$y0+1.15;
			$this->SetFont('Times','',10);
			if($hal==0){
				$no=1;
				for($i=0;$i<=24;$i++) {
					$this->SetXY(2.75,$i*0.575+$y1); 
					$this->Cell(0.75, 0.575, $no++.'.', 'LBR', 0, 'C');
					$this->Cell(3.25, 0.575,'', 'BR', 0, 'C');
					$this->Cell(6.5, 0.575,'', 'BR', 0, 'L');
					$this->Cell(0.75, 0.575, '', 'BR', 0, 'C');
					$this->Cell(3.0, 0.575, '', 'BR', 0, 'C');
					$this->Cell(3.0, 0.575, '', 'BR', 0, 'C');
					$this->Cell(4.75, 0.575, '', 'BR', 0, 'C');
				}
			}
			else {
				if($hal==1){$opset=0;$no=1;} else {$opset=26;$no=26;}
				$sql="SELECT s.idsiswa, s.nis, s.nisn, s.nmsiswa, s.gender, r.idjreg, r.idkelas FROM tbsiswa s INNER JOIN tbregistrasi r USING(idsiswa) WHERE  r.idjreg='2' OR r.idjreg='6' GROUP BY r.idsiswa ORDER BY s.nis, r.tglreg LIMIT 25 OFFSET $opset";
				$qs=vquery($sql);
				$i=0;
				foreach ($qs as $s) {
					$this->SetXY(2.75,$i*0.575+$y1); 
					$this->Cell(0.75, 0.575, $no++.'.', 'LBR', 0, 'C');
					$this->Cell(3.25, 0.575, $s['nis'].' / '.$s['nisn'], 'BR', 0, 'C');
					$this->Cell(6.5, 0.575, ucwords(strtolower($s['nmsiswa'])), 'BR', 0, 'L');
					$this->Cell(0.75, 0.575, $s['gender'], 'BR', 0, 'C');
					$this->Cell(1.0, 0.575, $s['idkelas'], 'BR', 0, 'C');
					$key=array(
						'idsiswa'=>$s['idsiswa']
					);
					$dm=viewdata('tbmutasi',$key)[0];						
					$this->Cell(2.75,0.575,$dm['tglsurat'],'BR',0,'C');
					$this->Cell(5.25,0.575,$dm['aslkesmp'],'BR',0,'L');
					if($dm['jnsmutasi']=='1'){
						$masuk='1';
						$keluar='0';
					}
					else if($dm['jnsmutasi']=='2'){
						$masuk='0';
						$keluar='1';
					}
					else {
						$masuk='-';
						$keluar='-';
					}
					$this->Cell(1.5,0.575,$masuk,'BR',0,'C');
					$this->Cell(1.5,0.575,$keluar,'BR',0,'C');
					$this->Cell(5.75,0.575,$dm['alasan'],'BR',0,'C');						
				$i++;
				}
				for($j=$i;$j<=24;$j++) {
					$this->SetXY(2.75,$j*0.575+$y1); 
					$this->Cell(0.75, 0.575, $no++.'.', 'LBR', 0, 'C');
					$this->Cell(3.25, 0.575,'', 'BR', 0, 'C');
					$this->Cell(6.5, 0.575,'', 'BR', 0, 'L');
					$this->Cell(0.75, 0.575, '', 'BR', 0, 'C');
					$this->Cell(1.0, 0.575, '', 'BR', 0, 'C');
					$this->Cell(2.75, 0.575, '', 'BR', 0, 'C');
					$this->Cell(5.25, 0.575, '', 'BR', 0, 'C');
					$this->Cell(1.5, 0.575, '', 'BR', 0, 'C');
					$this->Cell(1.5, 0.575, '', 'BR', 0, 'C');
					$this->Cell(5.75, 0.575, '', 'BR', 0, 'C');
				}
			}
		}
		
		function IsiCover(){
			$this->SetLineWidth(0.125);
			$this->Rect(2.75, 1.75, 28.5, 17.5,1);
			$this->AddFont('HappyMonkey-Regular','','HappyMonkey.php');
			$this->SetXY(2.75,3.25);
			$this->SetFont('HappyMonkey-Regular','',36.5);
			$this->Cell(28.5, 0.575, 'LAPORAN MUTASI PESERTA DIDIK', 0, 0, 'C');
			$this->Image('images/logo.png',14.5,6.0,4.5);
			$this->SetFont('Times','',12); 
			$this->SetXY(2.75,12.75);
			$this->Cell(28.5, 0.575, 'PERIODE TAHUN PELAJARAN', 0, 0, 'C');
			$this->SetFont('Times','BI',12);
			$this->SetXY(2.75,13.75);
			$this->Cell(28.5, 0.575, '2018/2019 s.d 2021/2022', 0, 0, 'C');
			$this->SetXY(2.75,15.75);
			$this->SetFont('Times','',24); 
			$this->Cell(28.5, 0.575, 'SMP NEGERI 5 PELEPAT', 0, 0, 'C');   
		}

		function PrintCover(){
			$this->AddPage();
			$this->IsiCover();
		}
		function PrintChapter(){ 
			$this->SetLineWidth(0.001);		
			$sql="SELECT nis, nisn, nmsiswa FROM tbsiswa s INNER JOIN tbregistrasi r USING(idsiswa) WHERE  r.idjreg='2' OR r.idjreg='6'ORDER BY nis";
			$nsiswa=cquery($sql);
			if($nsiswa>0){
				$hal=ceil($nsiswa/25);
				for ($i=1;$i<=$hal;$i++){ 
					$this->AddPage();
					$this->ChapterTitle($i);
					$this->GetTableJudul($i);
					$this->GetTableIsi($i);
				}
			}
			else {
				$this->AddPage();
				$this->ChapterTitle(0);
				$this->GetTableJudul(0);
				$this->GetTableIsi(0);
			}			
		}		
	}   
	$pdf = new PDF('L','cm',array(21.5,33.0));
	$pdf->SetMargins(2.75,1.75,1.25);
	$title = 'Laporan Mutasi Peserta Didik';
	$pdf->SetTitle($title);
	$pdf->SetAuthor('Kasworo Wardani, S.T');
	$pdf->PrintCover();
	$pdf->PrintChapter();
	$pdf->Output();
?>