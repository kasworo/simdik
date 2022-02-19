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
	}   
	$pdf = new PDF('P','cm',array(21.5,33.0));
	$pdf->SetMargins(2.75,1.75,1.25);
	$title = 'Laporan Mutasi Peserta Didik';
	$pdf->SetTitle($title);
	$pdf->SetAuthor('Kasworo Wardani, S.T');
	$pdf->PrintCover();
	$pdf->Output();
?>