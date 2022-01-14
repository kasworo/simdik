<?php
	require('assets/library/fpdf/fpdf.php'); 
    include "dbfunction.php";
    class PDF extends FPDF
    {
        function ChapterTitle($id)
        {
			$ds=viewdata('tbsiswa',array('idsiswa'=>$id))[0];
			$nis=$ds['nis'];
			$nisn=$ds['nisn'];
            $nama=$ds['nmsiswa'];
            $this->SetFont('Times','B',12);
			$this->Cell(28.0,0.75,'HASIL BELAJAR PESERTA DIDIK',0,0,'C');
            $this->Ln(1.25);
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
            $this->Ln(1.0);
        }

        function ChapterBody($id)
        {
            // $ds=viewdata('tbsiswa',array('idsiswa'=>$id))[0];
			// $nis=$ds['nis'];
			// $nisn=$ds['nisn'];
            $this->SetFont('Times','',10);
            $this->Cell(1.0,1.725,'No.','LTBR',0,'C');
            $this->Cell(8.25,1.725,'Mata Pelajaran','TBR',0,'C');
            $sql="SELECT r.idthpel, desthpel FROM tbregistrasi r INNER JOIN tbkelas USING(idkelas) INNER JOIN tbthpel USING(idthpel) WHERE idsiswa='$id' ORDER BY idkelas LIMIT 4";
           // var_dump($sql);die;
            $dreg=vquery($sql);
            foreach($dreg as $reg){
                $this->Cell(4.8,0.575,$reg['desthpel'],'TBR',0,'C');
            }
            
            $this->Ln(0.575);            
            $this->Cell(9.25,0.575);
            foreach($dreg as $reg){
                $this->Cell(2.40,0.575,'Pengetahuan','BR',0,'C');
                $this->Cell(2.40,0.575,'Keterampilan','BR',0,'C');
            }
            $this->Ln(0.575);
            $this->Cell(9.25,0.575);
            foreach($dreg as $reg){
                $this->Cell(1.0,0.575,'Nilai','BR',0,'C');
                $this->Cell(1.40,0.575,'Predikat','BR',0,'C');
                $this->Cell(1.0,0.575,'Nilai','BR',0,'C');
                $this->Cell(1.40,0.575,'Predikat','BR',0,'C');
            }           
            $this->Ln();
            $no=0;
            $qmp=viewdata('tbmapel');
            foreach($qmp as $mp)
            {                
                $no++;
                $this->SetFont('Times','',10);
                $this->Cell(1.0,0.575,$no.'.','LBR',0,'C');
                $this->Cell(8.25,0.575,$mp['nmmapel'],'BR',0,'L');
                foreach($dreg as $reg){
                    $qkog="SELECT nilairapor,predikat FROM tbnilairapor WHERE idsiswa='$id' AND idmapel='$mp[idmapel]' AND idthpel='$reg[idthpel]'AND aspek='3'";                   
                    $kog=vquery($qkog)[0];
                    $this->Cell(1.0,0.575,$kog['nilairapor'],'BR',0,'C');
                    $this->Cell(1.40,0.575,$kog['predikat'],'BR',0,'C');
                    $qmot="SELECT nilairapor,predikat FROM tbnilairapor WHERE idsiswa='$id' AND idmapel='$mp[idmapel]' AND idthpel='$reg[idthpel]'AND aspek='4'";                   
                    $mot=vquery($qmot)[0];
                    $this->Cell(1.0,0.575,$mot['nilairapor'],'BR',0,'C');
                    $this->Cell(1.40,0.575,$mot['predikat'],'BR',0,'C');
                }                
                $this->Ln();                
            }
            $this->Ln(0.35);
            $this->Cell(4.5,1.15,'Penilaian Sikap',1,0,'L');
            $this->Cell(5.0,0.575,'Spiritual',1,0,'L');
            $this->Cell(4.75,0.575,'',1,0,'C');
            $this->Cell(4.75,0.575,'',1,0,'C');
            $this->Cell(4.75,0.575,'',1,0,'C');
            $this->Cell(4.75,0.575,'',1,0,'C');
            $this->Ln();
            $this->Cell(4.5,0.575);
            $this->Cell(5.0,0.575,'Sosial',1,0,'L');
            $this->Cell(4.75,0.575,'',1,0,'C');
            $this->Cell(4.75,0.575,'',1,0,'C');
            $this->Cell(4.75,0.575,'',1,0,'C');	
            $this->Cell(4.75,0.575,'',1,0,'C');
            $this->Ln(0.75);
            $this->Cell(4.5,1.725,'Kegiatan Ekstrakurikuler',1,0,'L');
            $this->Cell(5.0,0.575,'Pramuka',1,0,'L');
            $this->Cell(4.75,0.575,'',1,0,'C');
            $this->Cell(4.75,0.575,'',1,0,'C');
            $this->Cell(4.75,0.575,'',1,0,'C');
            $this->Cell(4.75,0.575,'',1,0,'C');
            $this->Ln(0.575);
            $this->Cell(4.5,1.15);
            $this->Cell(5.0,0.575,'P M R',1,0,'L');
            $this->Cell(4.75,0.575,'',1,0,'C');
            $this->Cell(4.75,0.575,'',1,0,'C');
            $this->Cell(4.75,0.575,'',1,0,'C');
            $this->Cell(4.75,0.575,'',1,0,'C');
            $this->Ln(0.575);
            $this->Cell(4.5,1.15);
            $this->Cell(5.0,0.575,'Keterampilan Komputer',1,0,'L');
            $this->Cell(4.75,0.575,'',1,0,'C');
            $this->Cell(4.75,0.575,'',1,0,'C');
            $this->Cell(4.75,0.575,'',1,0,'C');
            $this->Cell(4.75,0.575,'',1,0,'C');
            $this->Ln(0.75);
            $this->Cell(4.5,1.725,'Ketidakhadiran',1,0,'L');
            $this->Cell(5.0,0.575,'Sakit',1,0,'L');
            $this->Cell(4.75,0.575,'',1,0,'C');
            $this->Cell(4.75,0.575,'',1,0,'C');
            $this->Cell(4.75,0.575,'',1,0,'C');
            $this->Cell(4.75,0.575,'',1,0,'C');
            $this->Ln(0.575);
            $this->Cell(4.5,1.5);
            $this->Cell(5.0,0.575,'Izin',1,0,'L');
            $this->Cell(4.75,0.575,'',1,0,'C');
            $this->Cell(4.75,0.575,'',1,0,'C');
            $this->Cell(4.75,0.575,'',1,0,'C');
            $this->Cell(4.75,0.575,'',1,0,'C');
            $this->Ln(0.575);
            $this->Cell(4.5,1.15);
            $this->Cell(5.0,0.575,'Tanpa Keterangan',1,0,'L');
            $this->Cell(4.75,0.575,'',1,0,'C');
            $this->Cell(4.75,0.575,'',1,0,'C');
            $this->Cell(4.75,0.575,'',1,0,'C');
            $this->Cell(4.75,0.575,'',1,0,'C');
            
            $this->Ln(0.75);
            $this->Cell(4.5,1.725,'Keputusan Akhir Tahun',1,0,'L');
            $this->Cell(5.0,0.575,'Lulus / Mengulang',1,0,'L');
            $this->Cell(9.5,0.575,'',1,0,'C');
            $this->Cell(9.5,0.575,'',1,0,'C');
            $this->Ln(0.575);
            $this->Cell(4.5,0.575);
            $this->Cell(5.0,0.575,'Tanggal ',1,0,'L');
            $this->Cell(9.5,0.575,'',1,0,'C');
            $this->Cell(9.5,0.575,'',1,0,'C');
            $this->Ln(0.575);
            $this->Cell(4.5,0.575);
            $this->Cell(5.0,0.575,'Catatan ',1,0,'L');
            $this->Cell(9.5,0.575,'',1,0,'C');
            $this->Cell(9.5,0.575,'',1,0,'C');
            $this->Ln();            
            $this->Cell(1.0,1.725,'No.',1,0,'C');
            $this->Cell(7.0,1.725,'Mata Pelajaran',1,0,'C');
            $this->Cell(1.25,1.725,'KKM',1,0,'C');
            $this->Cell(4.5,0.575,'',1,0,'C');
            $this->Cell(4.5,0.575,'',1,0,'C');
            $this->Cell(1.25,1.725,'KKM',1,0,'C');
            $this->Cell(4.5,0.575,'',1,0,'C');
            $this->Cell(4.5,0.575,'',1,0,'C');
            $this->Ln(0.575);
            $this->Cell(9.25,0.575);
            $this->Cell(2.25,0.575,'Pengetahuan',1,0,'C');
            $this->Cell(2.25,0.575,'Keterampilan',1,0,'C');
            $this->Cell(2.25,0.575,'Pengetahuan',1,0,'C');
            $this->Cell(2.25,0.575,'Keterampilan',1,0,'C');
            $this->Cell(1.25,1.725);

            $this->Cell(2.25,0.575,'Pengetahuan',1,0,'C');
            $this->Cell(2.25,0.575,'Keterampilan',1,0,'C');
            $this->Cell(2.25,0.575,'Pengetahuan',1,0,'C');
            $this->Cell(2.25,0.575,'Keterampilan',1,0,'C');
            $this->Ln(0.575);
            $this->Cell(9.25,0.575);
            $this->Cell(1.125,0.575,'Nilai',1,0,'C');
            $this->Cell(1.125,0.575,'Predikat',1,0,'C');
            $this->Cell(1.125,0.575,'Nilai',1,0,'C');
            $this->Cell(1.125,0.575,'Predikat',1,0,'C');
            $this->Cell(1.125,0.575,'Nilai',1,0,'C');
            $this->Cell(1.125,0.575,'Predikat',1,0,'C');
            $this->Cell(1.125,0.575,'Nilai',1,0,'C');
            $this->Cell(1.125,0.575,'Predikat',1,0,'C');
            $this->Cell(1.25,1.15);
            $this->Cell(1.125,0.575,'Nilai',1,0,'C');
            $this->Cell(1.125,0.575,'Predikat',1,0,'C');
            $this->Cell(1.125,0.575,'Nilai',1,0,'C');
            $this->Cell(1.125,0.575,'Predikat',1,0,'C');
            $this->Cell(1.125,0.575,'Nilai',1,0,'C');
            $this->Cell(1.125,0.575,'Predikat',1,0,'C');
            $this->Cell(1.125,0.575,'Nilai',1,0,'C');
            $this->Cell(1.125,0.575,'Predikat',1,0,'C');
            $this->Ln();
            $no=0;
            $qmp=viewdata('tbmapel');
            foreach($qmp as $mp)
            {
                $no++;
                $this->SetFont('Times','',10);
                $this->Cell(1.0,0.575,$no.'.',1,0,'C');
                $this->Cell(7.0,0.575,$mp['nmmapel'],1,0,'L');
                $this->Cell(1.25,0.575,'',1,0,'C');
                $this->Cell(1.125,0.575,'',1,0,'C');
                $this->Cell(1.125,0.575,'',1,0,'C');
                $this->Cell(1.125,0.575,'',1,0,'C');
                $this->Cell(1.125,0.575,'',1,0,'C');
                $this->Cell(1.125,0.575,'',1,0,'C');
                $this->Cell(1.125,0.575,'',1,0,'C');
                $this->Cell(1.125,0.575,'',1,0,'C');
                $this->Cell(1.125,0.575,'',1,0,'C');
                $this->Cell(1.25,0.575,'',1,0,'C');
                $this->Cell(1.125,0.575,'',1,0,'C');
                $this->Cell(1.125,0.575,'',1,0,'C');
                $this->Cell(1.125,0.575,'',1,0,'C');
                $this->Cell(1.125,0.575,'',1,0,'C');
                $this->Cell(1.125,0.575,'',1,0,'C');
                $this->Cell(1.125,0.575,'',1,0,'C');
                $this->Cell(1.125,0.575,'',1,0,'C');
                $this->Cell(1.125,0.575,'',1,0,'C');
                $this->Ln();                
            }
            $this->Ln(0.35);
            $this->Cell(4.5,1.15,'Penilaian Sikap',1,0,'L');
            $this->Cell(4.75,0.575,'Spiritual',1,0,'L');
            $this->Cell(4.75,0.575,'',1,0,'C');
            $this->Cell(4.75,0.575,'',1,0,'C');
            $this->Cell(4.75,0.575,'',1,0,'C');
            $this->Cell(4.75,0.575,'',1,0,'C');
            $this->Ln();
            $this->Cell(4.5,0.575);
            $this->Cell(4.75,0.575,'Sosial',1,0,'L');
            $this->Cell(4.75,0.575,'',1,0,'C');
            $this->Cell(4.75,0.575,'',1,0,'C');
            $this->Cell(4.75,0.575,'',1,0,'C');	
            $this->Cell(4.75,0.575,'',1,0,'C');
            $this->Ln(0.75);
            $this->Cell(4.5,1.725,'Kegiatan Ekstrakurikuler',1,0,'L');
            $this->Cell(5.0,0.575,'Pramuka',1,0,'L');
            $this->Cell(4.75,0.575,'',1,0,'C');
            $this->Cell(4.75,0.575,'',1,0,'C');
            $this->Cell(4.75,0.575,'',1,0,'C');
            $this->Cell(4.75,0.575,'',1,0,'C');
            $this->Ln(0.575);
            $this->Cell(4.5,1.15);
            $this->Cell(5.0,0.575,'P M R',1,0,'L');
            $this->Cell(4.75,0.575,'',1,0,'C');
            $this->Cell(4.75,0.575,'',1,0,'C');
            $this->Cell(4.75,0.575,'',1,0,'C');
            $this->Cell(4.75,0.575,'',1,0,'C');
            $this->Ln(0.575);
            $this->Cell(4.5,1.15);
            $this->Cell(5.0,0.575,'Keterampilan Komputer',1,0,'L');
            $this->Cell(4.75,0.575,'',1,0,'C');
            $this->Cell(4.75,0.575,'',1,0,'C');
            $this->Cell(4.75,0.575,'',1,0,'C');
            $this->Cell(4.75,0.575,'',1,0,'C');
            $this->Ln(0.75);
            $this->Cell(4.5,1.725,'Ketidakhadiran',1,0,'L');
            $this->Cell(5.0,0.575,'Sakit',1,0,'L');
            $this->Cell(4.75,0.575,'',1,0,'C');
            $this->Cell(4.75,0.575,'',1,0,'C');
            $this->Cell(4.75,0.575,'',1,0,'C');
            $this->Cell(4.75,0.575,'',1,0,'C');
            $this->Ln(0.575);
            $this->Cell(4.5,1.5);
            $this->Cell(5.0,0.575,'Izin',1,0,'L');
            $this->Cell(4.75,0.575,'',1,0,'C');
            $this->Cell(4.75,0.575,'',1,0,'C');
            $this->Cell(4.75,0.575,'',1,0,'C');
            $this->Cell(4.75,0.575,'',1,0,'C');
            $this->Ln(0.575);
            $this->Cell(4.5,1.15);
            $this->Cell(5.0,0.575,'Tanpa Keterangan',1,0,'L');
            $this->Cell(4.75,0.575,'',1,0,'C');
            $this->Cell(4.75,0.575,'',1,0,'C');
            $this->Cell(4.75,0.575,'',1,0,'C');
            $this->Cell(4.75,0.575,'',1,0,'C');
            
            $this->Ln(0.75);
            $this->Cell(4.5,1.725,'Keputusan Akhir Tahun',1,0,'L');
            $this->Cell(5.0,0.575,'Naik Kelas / Mengulang',1,0,'L');
            $this->Cell(9.5,0.575,'',1,0,'C');
            $this->Cell(9.5,0.575,'',1,0,'C');
            $this->Ln(0.575);
            $this->Cell(4.5,0.575);
            $this->Cell(5.0,0.575,'Tanggal ',1,0,'L');
            $this->Cell(9.5,0.575,'',1,0,'C');
            $this->Cell(9.5,0.575,'',1,0,'C');
            $this->Ln(0.575);
            $this->Cell(4.5,0.575);
            $this->Cell(5.0,0.575,'Kelas ',1,0,'L');
            $this->Cell(9.5,0.575,'',1,0,'C');
            $this->Cell(9.5,0.575,'',1,0,'C');    
		}

        function PrintChapter($id)
        {
            $this->AddPage();
			$this->ChapterTitle($id);
			$this->ChapterBody($id);
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