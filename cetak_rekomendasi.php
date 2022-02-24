<?php
session_start();
if (!isset($_SESSION['login'])) {
	header("Location: login.php");
	exit;
}
require('assets/library/fpdf/fpdf.php');
include "dbfunction.php";

function UbahKelas($nama)
{
	$angka = str_replace('Kelas', '', $nama);
	switch ($angka) {
		case '1': {
				$romawi = 'I';
				break;
			}
		case '2': {
				$romawi = 'II';
				break;
			}
		case '3': {
				$romawi = 'III';
				break;
			}
		case '4': {
				$romawi = 'IV';
				break;
			}
		case '5': {
				$romawi = 'V';
				break;
			}
		case '6': {
				$romawi = 'VI';
				break;
			}
		case '7': {
				$romawi = 'VII';
				break;
			}
		case '8': {
				$romawi = 'VIII';
				break;
			}
		case '9': {
				$romawi = 'IX';
				break;
			}
		default: {
				$romawi = '';
				break;
			}
	}
	return $romawi;
}

class PDF extends FPDF
{
	// function Footer()
	// {
	// 	if ($this->PageNo()>1) {
	// 		$hal=$this->PageNo()-1;
	// 		$this->SetY(-1.575);
	// 		$this->SetFont('Arial', 'I', 10);
	// 		$this->Cell(29.0, 1.0, 'Halaman '.$hal, 0, 0, 'R');
	// 	}
	// }

	function KopSurat()
	{
		//$this->SetLineWidth(0.125);
		$this->SetXY(1.25, 0.75);
		$this->SetFont('Times', 'B', 12);
		$this->Cell(19.5, 0.575, 'PEMERINTAH KABUPATEN BUNGO', 0, 0, 'C');
		$this->Image('images/bungo.png', 1.25, 0.70, 1.75);
		$this->Image('images/logo.png', 18.125, 0.70, 2.15);
		$this->SetFont('Times', 'B', 14);
		$this->Ln();
		$this->Cell(19.5, 0.575, 'DINAS PENDIDIKAN DAN KEBUDAYAAN', 0, 0, 'C');
		$this->SetFont('Times', '', 16);
		$this->Ln();
		$this->Cell(19.5, 0.575, 'SMP NEGERI 5 PELEPAT', 0, 0, 'C');
		$this->SetFont('Times', '', 11);
		$this->Ln();
		$this->Cell(19.5, 0.575, 'Jalan Dasa Purwa, Desa Mulia Bhakti, Kecamatan Pelepat', 0, 0, 'C');
		$this->Ln();
		$this->Cell(19.5, 0.575, 'Kabupaten Bungo, Provinsi Jambi', 0, 0, 'C');
		$this->SetLineWidth(0.075);
		$this->Line(1.25, 3.7, 20.25, 3.7);
		$this->SetLineWidth(0.001);
		$this->Line(1.225, 3.7875, 20.275, 3.7875);
	}
	function IsiSurat()
	{
		$this->SetXY(2.0, 4.5);
		$this->SetFont('Times', 'B', 12);
		$this->Cell(17.5, 0.575, 'SURAT REKOMENDASI MENERIMA', 0, 0, 'C');
		$this->Ln();
		$this->SetFont('Times', '', 12);
		$this->Cell(17.5, 0.575, 'Nomor: 422/     /SMPN5PLP/2022', 0, 0, 'C');
		$this->Ln(1.0);
		$this->MultiCell(17.5, 0.575, 'Yang bertanda tangan di bawah ini, kepala SMP Negeri 5 Pelepat, Kabupaten Bungo, Provinsi Jambi menerangkan bahwa:');
		$this->Cell(0.75, 0.575);
		$this->Cell(0.75, 0.575, '1.');
		$this->Cell(5.5, 0.575, 'Nama Peserta Didik');
		$this->Cell(0.25, 0.575, ':');
		$this->Ln();
		$this->Cell(0.75, 0.575);
		$this->Cell(0.75, 0.575, '2.');
		$this->Cell(5.5, 0.575, 'Nomor Induk Siswa Nasional');
		$this->Cell(0.25, 0.575, ':');
		$this->Ln();
		$this->Cell(0.75, 0.575);
		$this->Cell(0.75, 0.575, '3.');
		$this->Cell(5.5, 0.575, 'Tempat, Tanggal Lahir');
		$this->Cell(0.25, 0.575, ':');
		$this->Ln();
		$this->Cell(0.75, 0.575);
		$this->Cell(0.75, 0.575, '4.');
		$this->Cell(5.5, 0.575, 'Jenis Kelamin');
		$this->Cell(0.25, 0.575, ':');
	}

	function PrintRekomendasi()
	{
		$this->AddPage();
		$this->KopSurat();
		$this->IsiSurat();
	}
}
$pdf = new PDF('P', 'cm', array(21.5, 33.0));
$pdf->SetMargins(1.75, 1.75, 1.75);
$title = 'Laporan Mutasi Peserta Didik';
$pdf->SetTitle($title);
$pdf->SetAuthor('Kasworo Wardani, S.T');
$pdf->PrintRekomendasi();
$pdf->Output();
