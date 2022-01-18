<?php
	require('assets/library/fpdf/fpdf.php'); 
    include "dbfunction.php";
    function GetKolom($akhir, $ofset)
    {
        $sql="SELECT idthpel, desthpel FROM tbthpel WHERE idthpel<='$akhir' ORDER BY idthpel LIMIT 4 OFFSET $ofset";
        return vquery($sql);
    }
    function JmlKolom($akhir, $ofset)
    {
        $sql="SELECT idthpel, desthpel FROM tbthpel WHERE idthpel<='$akhir' ORDER BY idthpel LIMIT 4 OFFSET $ofset";
        return cquery($sql);
    }

    function CekRegis($ids)
    {
        $sql="SELECT r.idthpel, desthpel FROM tbregistrasi r INNER JOIN tbkelas USING(idkelas) INNER JOIN tbthpel USING(idthpel) WHERE idsiswa='$ids'";
        return cquery($sql);
    }

    function KonversiNilai($angka)
    {
        switch($angka){
			case '4' : {$huruf='A (Amat Baik)';break;}
			case '3' : {$huruf='B (Baik)';break;}
            case '2' : {$huruf='C (Cukup)';break;}
            case '1' : {$huruf='D (Kurang)';break;}
            default : {$huruf='-';break;}
		}
		return $huruf;
    }

    class PDF extends FPDF
    {
        function ChapterTitle($id)
        {
			$ds=viewdata('tbsiswa',array('idsiswa'=>$id))[0];
			$nis=$ds['nis'];
			$nisn=$ds['nisn'];
            $nama=$ds['nmsiswa'];
            $this->SetY(2.5);   
            $this->SetFont('Times','B',12);			
			$this->SetFont('Times','',11);
            $this->Cell(4,0.575,'Nama Peserta Didik',0,0,'L');
            $this->Cell(14.70,0.575);
            $this->Cell(3.45,0.575,'Nomor Induk',0,0,'L');		
            $this->Cell(0.575,0.575);
            $this->Cell(5.75,0.575,'Nomor Induk Siswa Nasional',0,0,'L');
            $this->Ln();
            $this->SetFont('Times','B',12);
            $this->Cell(4,0.575,strtoupper($nama),0,0,'L');
            $this->Cell(14.70,0.575);
            $c=strlen($nis);
            $t=6-$c;
            
            for($i=1;$i<=$t;$i++){
                $this->Cell(0.575,0.575,'0',1,0,'C');
            } 
            for($j=0;$j<$c;$j++){
                $this->Cell(0.575,0.575,substr($nis,$j,1),1,0,'C');
            }
            $this->Cell(0.575,0.575);
            for($k=0;$k<10;$k++){
                $this->Cell(0.575,0.575,substr($nisn,$k,1),1,0,'C');
            }
            $this->Ln(0.75);
        }
        
        function GetTableJudul($akhir, $hal)
        {
            if($hal==1){
                $opset=0;
                $this->SetY(1.475);
                $this->Cell(28.0,0.75,'RINGKASAN HASIL BELAJAR PESERTA DIDIK',0,0,'C');                
            } 
            else {
                $opset=4;
            }
            $this->SetXY(2.75,4.0);
            $this->SetFont('Times','',10);            
            $this->Cell(1.0,1.725,'No.','LTBR',0,'C');
            $this->Cell(8.25,1.725,'Mata Pelajaran','TBR',0,'C');            
            $i=0;
            $dreg=GetKolom($akhir, $opset);
            if(JmlKolom($akhir,$opset)==4){
                foreach($dreg as $reg){
                    $this->SetXY($i*4.8+12,4.0);
                    $this->Cell(4.8,0.575,$reg['desthpel'],'TBR',0,'C');
                    $this->SetXY($i*4.8+12,4.575);
                    $this->Cell(2.40,0.575,'Pengetahuan','BR',0,'C');
                    $this->Cell(2.40,0.575,'Keterampilan','BR',0,'C');
                    $this->SetXY($i*4.8+12,5.15);            
                    $this->Cell(1.0,0.575,'Nilai','BR',0,'C');
                    $this->Cell(1.40,0.575,'Predikat','BR',0,'C');
                    $this->Cell(1.0,0.575,'Nilai','BR',0,'C');
                    $this->Cell(1.40,0.575,'Predikat','BR',0,'C');
                    $i++;
                }
            }
            else {                
                foreach($dreg as $reg){
                    $this->SetXY($i*4.8+12,4.0);
                    $this->Cell(4.8,0.575,$reg['desthpel'],'TBR',0,'C');
                    $this->SetXY($i*4.8+12,4.575);
                    $this->Cell(2.40,0.575,'Pengetahuan','BR',0,'C');
                    $this->Cell(2.40,0.575,'Keterampilan','BR',0,'C');
                    $this->SetXY($i*4.8+12,5.15);            
                    $this->Cell(1.0,0.575,'Nilai','BR',0,'C');
                    $this->Cell(1.40,0.575,'Predikat','BR',0,'C');
                    $this->Cell(1.0,0.575,'Nilai','BR',0,'C');
                    $this->Cell(1.40,0.575,'Predikat','BR',0,'C');
                    $i++;
                }                
                $this->SetXY($i*4.8+12,4.0);
                $this->Cell(4.8,0.575,'Rata-rata','TR',0,'C');
                $this->SetXY($i*4.8+12,4.575);
                $this->Cell(4.80,0.575,'Nilai Rapor','BR',0,'C');
                $this->SetXY($i*4.8+12,5.15);            
                $this->Cell(2.40,0.575,'Pengetahuan','BR',0,'C');
                $this->Cell(2.40,0.575,'Keterampilan','BR',0,'C');
                $this->SetXY(($i+1)*4.8+12,4.0);
                $this->Cell(4.8,0.575,'Nilai Akhir','TR',0,'C');
                $this->SetXY(($i+1)*4.8+12,4.575);
                $this->Cell(4.8,0.575,'Kelulusan','BR',0,'C');
                $this->SetXY(($i+1)*4.8+12,5.15);            
                $this->Cell(2.40,0.575,'US','BR',0,'C');
                $this->Cell(2.40,0.575,'Ijazah','BR',0,'C');               
            }
        }

        function GetTableIsi($id,$akhir,$hal)
        {
            if($hal==1){$opset=0;} else {$opset=4;}
            $this->SetXY(2.75,5.725);
            $dreg = GetKolom($akhir,$opset);
            $no=0;            
            $qmp=viewdata('tbmapel');
            foreach ($qmp as $mp)
            {                
                $no++;
                $this->SetFont('Times','',10);
                $this->SetXY(2.75,($no-1)*0.575+5.725);                
                $this->Cell(1.0,0.575,$no.'.','LBR',0,'C');
                $this->SetXY(3.75,($no-1)*0.575+5.725);  
                $this->Cell(8.25,0.575,$mp['nmmapel'],'BR',0,'L');
                $i=0;
                if(JmlKolom($akhir, $opset)==4){                    
                    foreach($dreg as $reg){
                       $qkog="SELECT nilairapor,predikat FROM tbnilairapor WHERE idsiswa='$id' AND idmapel='$mp[idmapel]' AND idthpel='$reg[idthpel]' AND aspek='3'";                 $kog=vquery($qkog)[0];
                       $this->SetXY($i*4.8 + 12.0,($no-1)*0.575+5.725);
                       $this->Cell(1.0,0.575,$kog['nilairapor'],'BR',0,'C');
                       $this->SetXY($i*4.8+13.0,($no-1)*0.575+5.725);
                        $this->Cell(1.40,0.575,$kog['predikat'],'BR',0,'C');
                        
                        $qmot="SELECT nilairapor,predikat FROM tbnilairapor WHERE idsiswa='$id' AND idmapel='$mp[idmapel]' AND idthpel='$reg[idthpel]'AND aspek='4'";                   
                        $mot=vquery($qmot)[0];
                        $this->SetXY($i*4.8 + 14.4,($no-1)*0.575+5.725);
                        $this->Cell(1.0,0.575,$mot['nilairapor'],'BR',0,'C');
                        $this->SetXY($i*4.8 + 15.4,($no-1)*0.575+5.725);
                        $this->Cell(1.40,0.575,$mot['predikat'],'BR',0,'C');
                        $i++;
                    } 
                } 
                else {                    
                    foreach($dreg as $reg){
                        $qkog="SELECT nilairapor,predikat FROM tbnilairapor WHERE idsiswa='$id' AND idmapel='$mp[idmapel]' AND idthpel='$reg[idthpel]'AND aspek='3'";                   
                        $kog=vquery($qkog)[0];
                        $this->SetXY($i*4.8 + 12.0,($no-1)*0.575+5.725);
                        $this->Cell(1.0,0.575,$kog['nilairapor'],'BR',0,'C');
                        $this->SetXY($i*4.8+13.0,($no-1)*0.575+5.725);
                        $this->Cell(1.40,0.575,$kog['predikat'],'BR',0,'C');
                        $qmot="SELECT nilairapor,predikat FROM tbnilairapor WHERE idsiswa='$id' AND idmapel='$mp[idmapel]' AND idthpel='$reg[idthpel]'AND aspek='4'";                   
                        $mot=vquery($qmot)[0];
                        $this->SetXY($i*4.8 + 14.4,($no-1)*0.575+5.725);
                        $this->Cell(1.0,0.575,$mot['nilairapor'],'BR',0,'C');
                        $this->SetXY($i*4.8 + 15.4,($no-1)*0.575+5.725);
                        $this->Cell(1.40,0.575,$mot['predikat'],'BR',0,'C');
                        $i++;
                    } 
                    $qrkog="SELECT AVG(nilairapor) as kognetif FROM tbnilairapor WHERE idsiswa='$id' AND idmapel='$mp[idmapel]' AND aspek='3' GROUP BY idmapel";
                    $rkog=vquery($qrkog)[0]; 
                    $this->Cell(2.4,0.575,number_format($rkog['kognetif'],2,',','.'),'BR',0,'C'); 
                    $qrmot="SELECT AVG(nilairapor) as motorik FROM tbnilairapor WHERE idsiswa='$id' AND idmapel='$mp[idmapel]' AND aspek='4' GROUP BY idmapel";
                    $rmot=vquery($qrmot)[0];                    
                    $this->Cell(2.4,0.575,number_format($rmot['motorik'],2,',','.'),'BR',0,'C');
                    $this->Cell(2.4,0.575,'','BR',0,'C');
                    $qijz="SELECT AVG(nilairapor) as nilaiijz FROM tbnilairapor WHERE idsiswa='$id' AND idmapel='$mp[idmapel]' GROUP BY idmapel";
                    $ijz=vquery($qijz)[0];                   
                    $this->Cell(2.4,0.575,round($ijz['nilaiijz']),'BR',0,'C');
               }                            
            }
            $this->SetXY(2.75,11.625);
            $this->Cell(4.25,1.15,'Penilaian Sikap','LTBR',0,'L');
            $this->Cell(5.0,0.575,'Spiritual','TR',0,'L');
            $this->SetXY(7.0,12.2);
            $this->Cell(5.0,0.575,'Sosial','TBR',0,'L');
           // $this->SetXY(12.0,11.625); 
            $i=0;
            if(JmlKolom($akhir, $opset)==4){
                foreach($dreg as $reg){                                     
                    $qsp="SELECT nilaisikap FROM tbnilaisikap WHERE idsiswa='$id' AND idthpel='$reg[idthpel]' AND aspek='1'"; 
                    $sp=vquery($qsp)[0]; 
                    $this->SetXY($i*4.8+12,11.625);                
                    $this->Cell(4.8,0.575,KonversiNilai($sp['nilaisikap']),'TR',0,'C');
                    $qsos="SELECT nilaisikap FROM tbnilaisikap WHERE idsiswa='$id' AND idthpel='$reg[idthpel]' AND aspek='2'"; 
                    $sos=vquery($qsos)[0];
                    $this->SetXY($i*4.8+12,12.2);                
                    $this->Cell(4.8,0.575,KonversiNilai($sos['nilaisikap']),'TBR',0,'C');
                    $i++;                
                }                
            }
            else { 
                foreach($dreg as $reg){                                    
                    $qsp="SELECT nilaisikap FROM tbnilaisikap WHERE idsiswa='$id' AND idthpel='$reg[idthpel]' AND aspek='1'"; 
                    $sp=vquery($qsp)[0]; 
                    $this->SetXY($i*4.8 + 12.0,11.625);                
                    $this->Cell(4.8,0.575,KonversiNilai($sp['nilaisikap']),'TR',0,'C');
                    $qsos="SELECT nilaisikap FROM tbnilaisikap WHERE idsiswa='$id' AND idthpel='$reg[idthpel]' AND aspek='2'"; 
                    $sos=vquery($qsos)[0];
                    $this->SetXY($i*4.8 + 12.0,12.2);                
                    $this->Cell(4.8,0.575,KonversiNilai($sos['nilaisikap']),'TBR',0,'C');
                    $i++;                  
                }
                $this->SetXY($i*4.8+12.0,11.625);                
                $this->Cell(4.8,0.575,'','TR',0,'C');             
                $this->Cell(4.8,0.575,'','TR',0,'C');
                $this->SetXY($i*4.8+12.0,12.2);                  
                $this->Cell(4.8,0.575,'','TBR',0,'C');
                $this->Cell(4.8,0.575,'','TBR',0,'C');
            }
           
            $this->SetXY(2.75,12.925);
            $jeks=cekdata('tbekskul');            
            $this->Cell(4.25,0.575*$jeks,'Kegiatan Ekstrakurikuler','LTBR',0,'L');
            $deks=viewdata('tbekskul');        
            $k=0;
            foreach ($deks as $eks){                            
                $this->SetXY(7.0,$k*0.575+12.925);
                if($k==0){$brd='TBR';} else {$brd='BR';}
                $this->Cell(5.0,0.575,$eks['nmekskul'],$brd,0,'L');  
                $i=0;              
                if(JmlKolom($akhir, $opset)==4){
                    foreach ($dreg as $reg){
                        $this->SetXY($i*4.8+12.0, $k*0.575+12.925);
                        $this->Cell(4.8,0.575,'',$brd,0,'C');
                        $i++;                    
                    }
                }
                else {
                    foreach ($dreg as $reg){
                        $this->SetXY($i*4.8+12.0, $k*0.575+12.925);
                        $this->Cell(4.8,0.575,'',$brd,0,'C');
                        $i++;                    
                    } 
                    $this->Cell(4.8,0.575,'',$brd,0,'C');
                    $this->Cell(4.8,0.575,'',$brd,0,'C');
                }
                $k++;
            }            
            $this->SetXY(2.75,14.775);
            $this->Cell(4.25,1.725,'Ketidakhadiran','LTBR',0,'L');          
            $this->Cell(5.0,0.575,'Sakit','TBR',0,'L');
            $this->SetXY(7.0,15.35);
            $this->Cell(5.0,0.575,'Izin','BR',0,'L');
            $this->SetXY(7.0,15.925);
            $this->Cell(5.0,0.575,'Tanpa Keterangan','BR',0,'L');
            $j=0;
            for ($j=1;$j<=3;$j++)
            {
                $i=0;
                if(JmlKolom($akhir, $opset)==4){
                    foreach ($dreg as $reg){
                        $this->SetXY($i*4.8+12,($j-1)*0.575 +14.775);
                        if($j==1){
                         $this->Cell(4.8,0.575,'','TBR',0,'C');  
                        }
                        else {
                         $this->Cell(4.8,0.575,'','BR',0,'C');  
                        }
                        $i++;                                        
                    }                     
                }
                else {
                    foreach ($dreg as $reg){
                       $this->SetXY($i*4.8+12,($j-1)*0.575 +14.775);
                       if($j==1){
                        $this->Cell(4.8,0.575,'','TBR',0,'C');  
                       }
                       else {
                        $this->Cell(4.8,0.575,'','BR',0,'C');  
                       }
                       $i++;                                                               
                    }
                    if($j==1){
                        $this->Cell(4.8,0.575,'','TBR',0,'C');
                        $this->Cell(4.8,0.575,'','TBR',0,'C');    
                       }
                       else {
                        $this->Cell(4.8,0.575,'','BR',0,'C');  
                        $this->Cell(4.8,0.575,'','BR',0,'C');  
                       }   
                }
            }
           
            $this-> SetXY(2.75,16.625);
            $this->Cell(4.25,1.725,'Keputusan Akhir Tahun',1,0,'L');
            $this-> SetXY(7.0,16.625);
            $this->Cell(5.0,0.575,'Naik Kelas / Lulus / Mengulang','TBR',0,'L');
            $this-> SetXY(7.0,17.2);
            $this->Cell(5.0,0.575,'Tanggal ','BR',0,'L');
            $this-> SetXY(7.0,17.775);
            $this->Cell(5.0,0.575,'Catatan ','BR',0,'L');
            $j=0;
            for ($j=1;$j<=3;$j++)
            {
                $i=0;
                if(JmlKolom($akhir, $opset)==4){
                    foreach ($dreg as $reg){
                        $this->SetXY($i*4.8+12,($j-1)*0.575 +16.625);
                        if($j==1){
                         $this->Cell(4.8,0.575,'','TBR',0,'C');  
                        }
                        else {
                         $this->Cell(4.8,0.575,'','BR',0,'C');  
                        }
                        $i++;                                        
                    }                     
                }
                else {
                    foreach ($dreg as $reg){
                       $this->SetXY($i*4.8+12,($j-1)*0.575 +16.625);
                       if($j==1){
                        $this->Cell(4.8,0.575,'','TBR',0,'C');  
                       }
                       else {
                        $this->Cell(4.8,0.575,'','BR',0,'C');  
                       }
                       $i++;                                                               
                    }
                    if($j==1){
                        $this->Cell(4.8,0.575,'','TBR',0,'C');
                        $this->Cell(4.8,0.575,'','TBR',0,'C');    
                       }
                       else {
                        $this->Cell(4.8,0.575,'','BR',0,'C');  
                        $this->Cell(4.8,0.575,'','BR',0,'C');  
                       }   
                }
            }
            // $this->Cell(9.6,0.575,'','TBR',0,'C');
            // $this->Cell(9.6,0.575,'','TBR',0,'C');
            // $this->Ln(0.575);
            // $this->Cell(4.25,0.575);
            
            // $this->Cell(9.6,0.575,'','BR',0,'C');
            // $this->Cell(9.6,0.575,'','BR',0,'C');
            // $this->Ln(0.575);
            // $this->Cell(4.25,0.575);
            
            // $this->Cell(9.6,0.575,'','BR',0,'C');
            // $this->Cell(9.6,0.575,'','BR',0,'C');
            // $this->Ln();
		}

        function PrintChapter($id)
        {
            $qthakhir="SELECT MAX(idthpel) as akhir FROM tbregistrasi WHERE idsiswa='$id'";
            $tha=vquery($qthakhir)[0];
            $akhir=$tha['akhir'];            
            
            $qthmasuk="SELECT idthpel as awal FROM tbregistrasi WHERE idsiswa='$id' AND idjreg='2'";               
            $cekmasuk=cquery($qthmasuk);
            if($cekmasuk>0){ 
                $qthpel="SELECT idthpel, desthpel FROM tbthpel WHERE idthpel<='$akhir' ORDER BY idthpel";
                $nthpel=cquery($qthpel);
                $hal=ceil($nthpel/4);
            }
            else {
                $sql="SELECT r.idthpel, desthpel FROM tbregistrasi r INNER JOIN tbkelas USING(idkelas) INNER JOIN tbthpel USING(idthpel) WHERE idsiswa='$id' ORDER BY idkelas";
                $nthpel=cquery($sql);               
                $hal=ceil($nthpel/4);
            }                
            for($i=1;$i<=$hal;$i++){ 
                $this->AddPage();
                $this->ChapterTitle($id);       
                $this->GetTableJudul($akhir,$i);
                $this->GetTableIsi($id,$akhir, $i);
            }
        }
    }   
    $pdf = new PDF('L','cm',array(21.5,33.0));
    $pdf->SetMargins(2.75,1.75,1.25);
    $title = 'Laporan Buku Induk';
    $pdf->SetTitle($title);
    $pdf->SetAuthor('Kasworo Wardani, S.T');
    $sql="SELECT si.idsiswa, si.nmsiswa FROM tbsiswa si INNER JOIN tbregistrasi rg USING(idsiswa) INNER JOIN tbthpel th USING(idthpel) WHERE th.nmthpel LIKE '$_GET[id]%' AND (rg.idjreg='1' OR rg.idjreg='2')";
    $qsiswa=vquery($sql);
   foreach($qsiswa as $ds){
        $pdf->PrintChapter($ds['idsiswa']);
    }
    $pdf->Output();
?>