<?php
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
        
        function ChapterTitle($hrf,$hal)
        {
            if($hal<=1){
                $this->SetFont('Times','B',18);
                $this->SetXY(31.0,1.25);
                $this->Cell(0.75,0.75,$hrf,1,1,'C');
                $this->SetXY(2.75,2.0);
                $this->SetFont('Times','B',14);
                $this->Cell(28.5,0.75,'DAFTAR PESERTA DIDIK',0,0,'C');
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
            $this->Cell(5.75,1.15,'Tempat, Tgl. Lahir','TBR',0,'C');
            $this->Cell(0.75,1.15,'L/P','TBR',0,'C'); 
            $this->SetXY(19.75,$y0);
            $this->Cell(4.25,0.575,'Diterima di Sekolah Ini','TBR',0,'C');
            $this->SetXY(19.75,$y1);
            $this->Cell(1.25,0.575,'Kelas','BR',0,'C');
            $this->Cell(3.0,0.575,'Tanggal','BR',0,'C');
            $this->SetXY(24.0,$y0); 
            $this->Cell(7.75,0.57,'Keluar Dari Sekolah Ini','TBR',0,'C');
            $this->SetXY(24.0,$y1); 
            $this->Cell(3.0,0.575,'Tanggal','BR',0,'C');
            $this->Cell(4.75,0.575,'Alasan','BR',0,'C');                  
        }
        function GetTableIsi($hrf,$hal)
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
                    $this->Cell(5.75, 0.575,'','BR', 0, 'L');
                    $this->Cell(0.75, 0.575, '', 'BR', 0, 'C');
                    $this->Cell(1.25, 0.575, '', 'BR', 0, 'C');
                    $this->Cell(3.0, 0.575, '', 'BR', 0, 'C');
                    $this->Cell(3.0, 0.575, '', 'BR', 0, 'C');
                    $this->Cell(4.75, 0.575, '', 'BR', 0, 'C');
                }
            }
            else {
                if($hal==1){$opset=0;$no=1;} else {$opset=26;$no=26;}
                $sql="SELECT idsiswa, nis, nisn, nmsiswa, tmplahir, tgllahir, gender FROM tbsiswa WHERE nmsiswa LIKE '$hrf%' ORDER BY nis LIMIT 25 OFFSET $opset";
                $qs=vquery($sql);
                $i=0;
                foreach ($qs as $s) {
                    $this->SetXY(2.75,$i*0.575+$y1); 
                    $this->Cell(0.75, 0.575, $no++.'.', 'LBR', 0, 'C');
                    $this->Cell(3.25, 0.575, $s['nis'].' / '.$s['nisn'], 'BR', 0, 'C');
                    $this->Cell(6.5, 0.575, ucwords(strtolower($s['nmsiswa'])), 'BR', 0, 'L');
                    $this->Cell(5.75, 0.575,ucwords(strtolower($s['tmplahir'])).', '.indonesian_date($s['tgllahir']),'BR', 0, 'L');
                    $this->Cell(0.75, 0.575, $s['gender'], 'BR', 0, 'C');
                    $sqlr="SELECT idkelas, tglreg FROM tbregistrasi WHERE idsiswa='$s[idsiswa]' AND (idjreg='1' OR idjreg='2')";
                    $rg=vquery($sqlr)[0];
                    $this->Cell(1.25, 0.575, UbahKelas($rg['idkelas']), 'BR', 0, 'C');
                    $this->Cell(3.0, 0.575, indonesian_date($rg['tglreg']), 'BR', 0, 'L');
                    $this->Cell(3.0, 0.575, '', 'BR', 0, 'C');
                    $this->Cell(4.75, 0.575, '', 'BR', 0, 'C');
                    $i++;
                }
                for($j=$i;$j<=24;$j++) {
                    $this->SetXY(2.75,$j*0.575+$y1); 
                    $this->Cell(0.75, 0.575, $no++.'.', 'LBR', 0, 'C');
                    $this->Cell(3.25, 0.575,'', 'BR', 0, 'C');
                    $this->Cell(6.5, 0.575,'', 'BR', 0, 'L');
                    $this->Cell(5.75, 0.575,'','BR', 0, 'L');
                    $this->Cell(0.75, 0.575, '', 'BR', 0, 'C');
                    $this->Cell(1.25, 0.575, '', 'BR', 0, 'C');
                    $this->Cell(3.0, 0.575, '', 'BR', 0, 'C');
                    $this->Cell(3.0, 0.575, '', 'BR', 0, 'C');
                    $this->Cell(4.75, 0.575, '', 'BR', 0, 'C');
                }
            }
        }
       
        function IsiCover(){
            $this->SetLineWidth(0.125);
            $this->Rect(2.75, 1.75, 28.5, 17.5,1);
            $this->AddFont('HappyMonkey-Regular','','HappyMonkey.php');
            $this->SetXY(2.75,3.25);
            $this->SetFont('HappyMonkey-Regular','',36.5);
            $this->Cell(28.5, 0.575, 'LAPORAN KLAPPER PESERTA DIDIK', 0, 0, 'C');
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
        function PrintChapter($hrf){ 
            $this->SetLineWidth(0.001);        
            $sql="SELECT nis, nisn, nmsiswa FROM tbsiswa WHERE nmsiswa LIKE '$hrf%' ORDER BY nis";
            $nsiswa=cquery($sql);
            if($nsiswa>0){
                $hal=ceil($nsiswa/25);
                for ($i=1;$i<=$hal;$i++){ 
                    $this->AddPage();
                    $this->ChapterTitle($hrf,$i);       
                    $this->GetTableJudul($i);
                    $this->GetTableIsi($hrf,$i);
                }
            }
            else {
                $this->AddPage();
                $this->ChapterTitle($hrf,0);       
                $this->GetTableJudul(0);
                $this->GetTableIsi($hrf,0);
            }            
        }        
    }   
    $pdf = new PDF('L','cm',array(21.5,33.0));
    $pdf->SetMargins(2.75,1.75,1.25);
    $title = 'Laporan Buku Induk';
    $pdf->SetTitle($title);
    $pdf->SetAuthor('Kasworo Wardani, S.T');
    $pdf->PrintCover();
    foreach (range('A', 'Z') as $hrf) {
        $pdf->PrintChapter($hrf);
    }
    $pdf->Output();
?>