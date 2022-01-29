<?php
	require('assets/library/fpdf/fpdf.php'); 
	include "dbfunction.php";
	
	class PDF extends FPDF
    {
        protected $col = 0;
        protected $y0;
		function Footer()
        {
           $this->SetY(-1.575);
           $this->SetFont('Arial','I',8);
           $sql="SELECT LEFT(desthpel,9) as tahun FROM tbthpel WHERE nmthpel LIKE '$_GET[id]%' LIMIT 1";
           $th=vquery($sql)[0];
           $this->Cell(28.5,1.0,'Buku Induk Peserta Didik Tahun Pelajaran '.$th['tahun'],0,0,'R');
        }
		function Header()
		{
			global $title;
			$this->y0 = $this->GetY();
			//$this->Image('images/tandaair.png',4.75,8.75,13.0);
		}
        function SetCol($col)
        {
            $this->col = $col;
            $x = 2.75+$col*15;
            $this->SetLeftMargin($x);
            $this->SetX($x);
        }
        function AcceptPageBreak()
        {
            if($this->col<1)
            {
                $this->SetCol($this->col+1);
                $this->SetY($this->y0);
                return false;
            }
            else
            {
                $this->SetCol(0);
                return true;
            }
        }

        function ChapterTitle($idsiswa)
        {
			$ds=viewdata('tbsiswa',array('idsiswa'=>$idsiswa))[0];
			$nis=$ds['nis'];
			$nisn=$ds['nisn'];
			
			$this->SetFont('Times','B',12);
			$this->Cell(28.0,0.75,'LEMBAR DATA INDUK PESERTA DIDIK',0,0,'C');
            $this->Ln(1.0);
			$this->SetFont('Times','',11);
			$this->Cell(18,0.575);
            $this->Cell(3.45,0.575,'Nomor Induk',0,0,'L');		
            $this->Cell(0.575,0.575);
            $this->Cell(5.75,0.575,'Nomor Induk Siswa Nasional',0,0,'L');
            $this->Ln();
			$c=strlen($nis);
			$this->SetFont('Times','BI',12);
            $t=6-$c;
            $this->Cell(18,0.575);
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
            $this->Ln(1.75);
            $this->y0 = $this->GetY();
        }

        function ChapterBody($idsiswa)
        {
            global $conn;
            $d=viewdata('tbsiswa',array('idsiswa'=>$idsiswa))[0];
			$this->SetFont('Times','B',11);
			$this->Cell(0.75,0.575,'A.');
			$this->Cell(11.5,0.575,'Keterangan Diri Peserta Didik');
			$this->Ln();
			$this->SetFont('Times','',11);
			$this->Cell(0.75,0.575);
			$this->Cell(0.75,0.575,'1.');
			$this->Cell(4.0,0.575,'Nama Peserta Didik');
			$this->Cell(0.25,0.575,':');
			$this->Cell(8.25,0.575,$d['nmsiswa']);
			$this->Ln();
			$this->Cell(0.75,0.575);
			$this->Cell(0.75,0.575,'2.');
			$this->Cell(4.0,0.575,'N I K');
			$this->Cell(0.25,0.575,':');
			$this->Cell(8.25,0.575,$d['nik']);
			$this->Ln();
			$this->Cell(0.75,0.575);
			$this->Cell(0.75,0.575,'3.');
			$this->Cell(4.0,0.575,'Tempat, Tanggal Lahir');
			$this->Cell(0.25,0.575,':');
			$this->Cell(8.25,0.575,$d['tmplahir'].', '.indonesian_date($d['tgllahir']));
			$this->Ln();
			$this->Cell(0.75,0.575);
			$this->Cell(0.75,0.575,'4.');
			$this->Cell(4.0,0.575,'Jenis Kelamin');
			$this->Cell(0.25,0.575,':');
			$gender=getgender($d['gender']);
			$this->Cell(8.25,0.575,$gender);
			$this->Ln();
			$this->Cell(0.75,0.575);
			$this->Cell(0.75,0.575,'5.');
			$this->Cell(4.0,0.575,'Agama / Kepercayaan');
			$this->Cell(0.25,0.575,':');
			$agm=getagama($d['idagama']);
			$this->Cell(8.25,0.575,$agm);
			$this->Ln();
			$this->Cell(0.75,0.575);
			$this->Cell(0.75,0.575,'6.');
			$this->Cell(4.0,0.575,'Kewarganegaraan');
			$this->Cell(0.25,0.575,':');
			$wn=getwni($d['warganegara']);
			$this->Cell(8.25,0.575,$wn);	
			$this->Ln();
			$this->Cell(0.75,0.575);
			$this->Cell(0.75,0.575,'7.');
			$this->Cell(4.0,0.575,'Anak Ke');
			$this->Cell(0.25,0.575,':');
			if($d['anake']=='' || $d['sdr']==''){
				$anake='-';
			} else {
				$anake=$d['anake'].' dari '.$d['sdr'].' bersaudara';
			}
			$this->Cell(8.25,0.575,$anake);
			$this->Ln();
			$this->Cell(0.75,0.575);
			$this->Cell(0.75,0.575,'8.');
			$this->Cell(4.0,0.575,'Golongan Darah');
			$this->Cell(0.25,0.575,':');
			$goldarah=getdarah($d['goldarah']);
			$this->Cell(8.25,0.575,$goldarah);
			$this->Ln();
			$this->Cell(0.75,0.575);
			$this->Cell(0.75,0.575,'9.');
			$this->Cell(4.0,0.575,'Riwayat Penyakit');
			$this->Cell(0.25,0.575,':');
			$skt=getpenyakit($d['rwysakit']);
			$this->Cell(8.25,0.575,$skt);
			$this->Ln();
			$this->Cell(0.75,0.575);
			$this->Cell(0.75,0.575,'10.');
			$this->Cell(4.0,0.575,'Kebutuhan Khusus');
			$this->Cell(0.25,0.575,':');
			$kbthn=getkebkhusus($d['kebkhusus']);		
			$this->Cell(8.25,0.575,$kbthn);
			$this->Ln();
			$this->Cell(0.75,0.575);
			$this->Cell(0.75,0.575,'11.');
			$this->Cell(4.0,0.575,'Tinggal Dengan');
			$this->Cell(0.25,0.575,':');	
			$tggl=gettinggal($d['ikuts']);				
			$this->Cell(8.25,0.575,$tggl);
			$this->Ln();
			$this->Cell(0.75,0.575);
			$this->Cell(0.75,0.575,'12.');
			$this->Cell(4.0,0.575,'Jarak / Waktu Tempuh');
			$this->Cell(0.25,0.575,':');
			if($d['jarak']<='1'){$jrk='Sekitar 1 Kilometer';}
			else {$jrk=''.$d['jarak'].' Kilometer';}	
			$this->Cell(8.25,0.575,$jrk.' / '.$d['waktu']. ' menit');
			$this->Ln();
			$this->Cell(0.75,0.575);
			$this->Cell(0.75,0.575,'13.');
			$this->Cell(4.0,0.575,'Mode Transportasi');
			$this->Cell(0.25,0.575,':');
			$trans=gettrans($d['transpr']);		
			$this->Cell(8.25,0.575,$trans);
			$this->Ln();
			$this->Cell(0.75,0.575);
			$this->Cell(0.75,0.575,'14.');
			$this->Cell(4.0,0.575,'Alamat');
			$this->Cell(0.25,0.575,':');		
			$this->Cell(8.25,0.575,$d['alamat'].', Desa '.$d['desa']);
			$this->Ln();
			$this->Cell(0.75,0.575);
			$this->Cell(0.75,0.575);
			$this->Cell(4.0,0.575);
			$this->Cell(0.25,0.575);		
			$this->Cell(8.25,0.575,'Kecamatan '.str_replace('Kec. ','', $d['kec']).', Kabupaten / Kota '.$d['kab']);
			$this->Ln();
			$this->Cell(0.75,0.575);
			$this->Cell(0.75,0.575);
			$this->Cell(4.0,0.575);
			$this->Cell(0.25,0.575);		
			$this->Cell(8.25,0.575,'Provinsi '.$d['prov'].', Kode Pos '.$d['kdpos']);
			$this->Ln();
			if($d['lintang']==null || $d['lintang']=='' || $d['bujur']==null || $d['bujur']==''){
				$koordinat='-';
			}
			else {
				$koordinat=number_format($d['lintang'],4,'.','.').' / '.number_format($d['bujur'],4,'.','.');
			}
			$this->Cell(0.75,0.575);
			$this->Cell(0.75,0.575,'16.');
			$this->Cell(4.0,0.575,'Koordinat');
			$this->Cell(0.25,0.575,':');		
			$this->Cell(8.25,0.575,$koordinat);
			$this->Ln();
			$this->Cell(0.75,0.575);
			$this->Cell(0.75,0.575,'17.');
			$this->Cell(4.0,0.575,'Nomor HP');
			$this->Cell(0.25,0.575,':');		
			$this->Cell(8.25,0.575,$d['nohp']);
			$this->Ln();
			$this->Cell(0.75,0.575);
			$this->Cell(0.75,0.575,'18.');
			$this->Cell(4.0,0.575,'Hobi / Kegemaran');
			$this->Cell(0.25,0.575,':');		
			$this->Cell(8.25,0.575);
			$this->Ln();
			if($d['hobi1']=='' || $d['hobi1']==null){$hobi1='-';} else {$hobi1=$d['hobi1'];}			
			$this->Cell(1.5,0.575);
			$this->Cell(0.5,0.575,'a.');
			$this->Cell(3.5,0.575,'Bidang Olahraga');
			$this->Cell(0.25,0.575,':');		
			$this->Cell(8.25,0.575,$hobi1);
			$this->Ln();
			if($d['hobi2']=='' || $d['hobi2']==null){$hobi2='-';} else {$hobi2=$d['hobi3'];}
			$this->Cell(1.5,0.575);
			$this->Cell(0.5,0.575,'b.');
			$this->Cell(3.5,0.575,'Bidang Seni');
			$this->Cell(0.25,0.575,':');		
			$this->Cell(8.25,0.575,$hobi2);
			$this->Ln();
			if($d['hobi3']=='' || $d['hobi3']==null){$hobi3='-';} else {$hobi3=$d['hobi3'];}
			$this->Cell(1.5,0.575);
			$this->Cell(0.5,0.575,'c.');
			$this->Cell(3.5,0.575,'Organisasi');
			$this->Cell(0.25,0.575,':');		
			$this->Cell(8.25,0.575,$hobi3);
			$this->Ln();
			if($d['hobi4']=='' || $d['hobi4']==null){$hobi4='-';} else {$hobi4=$d['hobi4'];}
			$this->Cell(1.5,0.575);
			$this->Cell(0.5,0.575,'d.');
			$this->Cell(3.5,0.575,'Lainnya');
			$this->Cell(0.25,0.575,':');		
            $this->Cell(8.25,0.575,$hobi4);
            $this->Ln(1.25);
			$this->SetFont('Times','B',11);
			$this->Cell(0.75,0.575,'B.');
			$this->Cell(11.5,0.575,'Catatan Registrasi Peserta Didik');
			$this->Ln();			
			$this->SetFont('Times','',11);
			$this->Cell(0.75,0.575);
			$this->Cell(0.75,0.575,'1.');
			$this->Cell(4.0,0.575,'Terdaftar Sebagai');
			$this->Cell(0.25,0.575,':');
			
			$qreg="SELECT idjreg, nmkelas, tglreg FROM tbregistrasi INNER JOIN tbkelas USING(idkelas) WHERE idsiswa='$idsiswa' AND (idjreg='1' OR idjreg='2')";	
			$rg=vquery($qreg)[0];
			$regis=getregis($rg['idjreg']);
			$this->Cell(8.25,0.575,$regis);
			$this->Ln();
			$this->Cell(0.75,0.575);
			$this->Cell(0.75,0.575,'2.');
			$this->Cell(4.0,0.575,'Tanggal');
			$this->Cell(0.25,0.575,':');		
			$this->Cell(8.25,0.575,indonesian_date($rg['tglreg']));
			$this->Ln();
			$this->Cell(0.75,0.575);
			$this->Cell(0.75,0.575,'3.');
			$this->Cell(4.0,0.575,'Diterima di kelas');
			$this->Cell(0.25,0.575,':');		
			$this->Cell(8.25,0.575,$rg['nmkelas']);
			$this->Ln();
			$rw=viewdata('tbriwayatskul', array('idsiswa'=>$idsiswa))[0];
			if($rw['idjreg']=='1'){
				$aslsd=$rw['aslsd'];
				$noijz=$rw['noijazah'];
				$tglijz=indonesian_date($rw['tglijazah']);
				$lamasd=$rw['lama'];
				$aslsmp='-';
				$nosurat='-';
				$tglsurat='-';
				$alasan='-';
			}
			else {
				$aslsd=$rw['aslsd'];
				$noijz=$rw['noijazah'];
				$tglijz=indonesian_date($rw['tglijazah']);
				$lamasd=$rw['lama'];
				$aslsmp=$rw['aslsmp'];
				$nosurat=$rw['nosurat'];
				$tglsurat=indonesian_date($rw['tglsurat']);
				$alasan=$rw['alasan'];
			}
			$this->Cell(0.75,0.575);
			$this->Cell(0.75,0.575,'4.');
			$this->Cell(4.0,0.575,'Lulus Dari');
			$this->Cell(0.25,0.575);		
			$this->Cell(8.25,0.575,'');
			$this->Ln();
			$this->Cell(1.5,0.575);
			$this->Cell(0.5,0.575,'a.');
			$this->Cell(3.5,0.575,'Nama SD/MI');
			$this->Cell(0.25,0.575,':');
			$this->Cell(8.25,0.575,$aslsd);
			$this->Ln();
			$this->Cell(1.5,0.575);
			$this->Cell(0.5,0.575,'b.');
			$this->Cell(3.5,0.575,'Nomor Seri Ijazah');
			$this->Cell(0.25,0.575,':');
			$this->Cell(8.25,0.575,$noijz);
			$this->Ln();
			$this->Cell(1.5,0.575);
			$this->Cell(0.5,0.575,'c.');
			$this->Cell(3.5,0.575,'Tanggal Ijazah');
			$this->Cell(0.25,0.575,':');
			$this->Cell(8.25,0.575,$tglijz);
			$this->Ln();
			$this->Cell(1.5,0.575);
			$this->Cell(0.5,0.575,'d.');
			$this->Cell(3.5,0.575,'Lama Belajar');
			$this->Cell(0.25,0.575,':');	
			$this->Cell(8.25,0.575,$lamasd.' tahun');
			$this->Ln();
			$this->Cell(0.75,0.575);
			$this->Cell(0.75,0.575,'5.');
			$this->Cell(4.0,0.575,'Pindahan Dari');
			$this->Cell(0.25,0.575);		
			$this->Cell(8.25,0.575);
			$this->Ln();
			$this->Cell(1.5,0.575);
			$this->Cell(0.5,0.575,'a.');
			$this->Cell(3.5,0.575,'Nama SMP / MTs');
			$this->Cell(0.25,0.575,':');	
			$this->Cell(8.25,0.575,$aslsmp);
			$this->Ln();
			$this->Cell(1.5,0.575);
			$this->Cell(0.5,0.575,'b.');
			$this->Cell(3.5,0.575,'No. Surat Pindah');
			$this->Cell(0.25,0.575,':');	
			$this->Cell(8.25,0.575,$nosurat);
			$this->Ln();
			$this->Cell(1.5,0.575);
			$this->Cell(0.5,0.575,'c.');
			$this->Cell(3.5,0.575,'Tanggal Surat Pindah');
			$this->Cell(0.25,0.575,':');	
			$this->Cell(8.25,0.575,$tglsurat);
			$this->Ln();
			$this->Cell(1.5,0.575);
			$this->Cell(0.5,0.575,'d.');
			$this->Cell(3.5,0.575,'Alasan Pindah');
			$this->Cell(0.25,0.575,':');	
			$this->Cell(8.25,0.575,$alasan);
			$this->Ln(0.75);
			$this->SetFont('Times','B',11);
			$this->Cell(0.75,0.575,'C.');
			$this->Cell(11.5,0.575,'Keterangan Orang Tua Kandung');
			$this->Ln();
			$qayah="SELECT ay.*, r1.pendidikan, r2.pekerjaan, r3.penghasilan FROM tbortu ay LEFT JOIN ref_pendidikan r1 USING(idpddk) LEFT JOIN ref_pekerjaan r2 USING(idkerja) LEFT JOIN ref_penghasilan r3 USING(idhsl) WHERE ay.hubkel='1' AND ay.idsiswa='$idsiswa'";
			if(cquery($qayah)==0){
				$nmayah='-';
				$agmayah='-';
				$pddkayah='-';
				$krjayah='-';
				$gajiayah='-';
				$hdpayah='-';
				$alamat1='-';
				$alamat2='-';
				$alamat3='-';
				$nohp='-';
			}
			else {
				$da=vquery($qayah)[0];
				$nmayah=$da['nmortu'];
				$agmayah=getagama($da['idagama']);
				$pddkayah=getskulortu($da['idpddk']);
				$krjayah=getkerjaortu($da['idkerja']);
				$gajiayah=getgajiortu($da['idhsl']);
				$hdpayah=getkethdp($da['hidup']);
				$alamat1=$da['alamat'].', Desa '.$da['desa'];
				$alamat2='Kecamatan '.$da['kec'].', Kabupaten '.$d['kab'];	
				$alamat3='Provinsi '.$da['prov'].', Kode Pos '.$da['kdpos'];
				$nohp=$da['nohp'];
			}
			

			$qibu="SELECT ay.*, r1.pendidikan, r2.pekerjaan, r3.penghasilan FROM tbortu ay LEFT JOIN ref_pendidikan r1 USING(idpddk) LEFT JOIN ref_pekerjaan r2 USING(idkerja) LEFT JOIN ref_penghasilan r3 USING(idhsl) WHERE ay.hubkel='2' AND ay.idsiswa='$idsiswa'";
			if(cquery($qibu)==0){
				$nmibu='-';
				$agmibu='-';
				$pddkibu='-';
				$krjibu='-';
				$gajiibu='-';
				$hdpibu='-';
				$alamat1='-';
				$alamat2='-';
				$alamat3='-';
				$nohp='-';
			}
			else {
				$di=vquery($qibu)[0];
				$nmibu=$di['nmortu'];
				$agmibu=getagama($di['idagama']);
				$pddkibu=getskulortu($di['idpddk']);
				$krjibu=getkerjaortu($di['idkerja']);
				$gajiibu=getgajiortu($di['idhsl']);
				$hdpibu=getkethdp($di['hidup']);
				$alamat1=$di['alamat'].', Desa '.$di['desa'];
				$alamat2='Kecamatan '.$di['kec'].', Kabupaten '.$d['kab'];	
				$alamat3='Provinsi '.$di['prov'].', Kode Pos '.$di['kdpos'];
				$nohp=$di['nohp'];
			}
			
			$qwali="SELECT ay.*, r1.pendidikan, r2.pekerjaan, r3.penghasilan FROM tbortu ay LEFT JOIN ref_pendidikan r1 USING(idpddk) LEFT JOIN ref_pekerjaan r2 USING(idkerja) LEFT JOIN ref_penghasilan r3 USING(idhsl) WHERE (ay.hubkel<>'1' OR ay.hubkel<>'2') AND ay.idsiswa='$idsiswa'";
			$dw=vquery($qwali)[0];
			$this->SetFont('Times','',11);
			$this->Cell(0.75,0.575);
			$this->Cell(0.75,0.575,'1.');
			$this->Cell(4.0,0.575,'Nama Lengkap');
			$this->Cell(0.25,0.575,':');
			$this->Cell(8.25,0.575);
			$this->Ln();
			$this->Cell(0.75,0.575);
			$this->Cell(0.75,0.575);
			$this->Cell(4.0,0.575,'a. Ayah');
			$this->Cell(0.25,0.575,':');		
			$this->Cell(8.25,0.575,$nmayah);
			$this->Ln();
			$this->Cell(0.75,0.575);
			$this->Cell(0.75,0.575);
			$this->Cell(4.0,0.575,'b. Ibu');
			$this->Cell(0.25,0.575,':');		
			$this->Cell(8.25,0.575,$nmibu);
			$this->Ln();
			$this->Cell(0.75,0.575);
			$this->Cell(0.75,0.575,'2.');
			$this->Cell(4.0,0.575,'Agama / Kepercayaan');
			$this->Cell(0.25,0.575);
			$this->Cell(8.25,0.57);
			$this->Ln();
			$this->Cell(0.75,0.575);
			$this->Cell(0.75,0.575);
			$this->Cell(4.0,0.575,'a. Ayah');
			$this->Cell(0.25,0.575,':');
			$this->Cell(8.25,0.575,$agmayah);
			$this->Ln();
			$this->Cell(0.75,0.575);
			$this->Cell(0.75,0.575);
			$this->Cell(4.0,0.575,'b. Ibu');
			$this->Cell(0.25,0.575,':');
			$this->Cell(8.25,0.575,$agmibu);
			$this->Ln();
			$this->Cell(0.75,0.575);
			$this->Cell(0.75,0.575,'3.');
			$this->Cell(4.0,0.575,'Pendidikan Terakhir');
			$this->Cell(0.25,0.575);
			$this->Cell(8.25,0.575);
			$this->Ln();
			$this->Cell(0.75,0.575);
			$this->Cell(0.75,0.575);
			$this->Cell(4.0,0.575,'a. Ayah');
			$this->Cell(0.25,0.575,':');
			$this->Cell(8.25,0.575,$pddkayah);
			$this->Ln();
			$this->Cell(0.75,0.575);
			$this->Cell(0.75,0.575);
			$this->Cell(4.0,0.575,'b. Ibu');
			$this->Cell(0.25,0.575,':');		
			$this->Cell(8.25,0.575,$pddkibu);
			$this->Ln(0.75);
			$this->Cell(0.75,0.575);
			$this->Cell(0.75,0.575,'4.');
			$this->Cell(4.0,0.575,'Pekerjaan');
			$this->Cell(0.25,0.575);		
			$this->Cell(8.25,0.575);
			$this->Ln();
			$this->Cell(0.75,0.575);
			$this->Cell(0.75,0.575);
			$this->Cell(4.0,0.575,'a. Ayah');
			$this->Cell(0.25,0.575,':');		
			$this->Cell(8.25,0.575, $krjayah);
			$this->Ln();
			$this->Cell(0.75,0.575);
			$this->Cell(0.75,0.575);
			$this->Cell(4.0,0.575,'b. Ibu');
			$this->Cell(0.25,0.575,':');		
			$this->Cell(8.25,0.575, $krjibu);
			$this->Ln();
			$this->Cell(0.75,0.575);
			$this->Cell(0.75,0.575,'5.');
			$this->Cell(4.0,0.575,'Penghasilan Per Bulan');
			$this->Cell(0.25,0.575);
			$this->Cell(8.25,0.575);
			$this->Ln();
			$this->Cell(0.75,0.575);
			$this->Cell(0.75,0.575);
			$this->Cell(4.0,0.575,'a. Ayah');
			$this->Cell(0.25,0.575,':');
			$this->Cell(8.25,0.575,$gajiayah);
			$this->Ln();
			$this->Cell(0.75,0.575);
			$this->Cell(0.75,0.575);
			$this->Cell(4.0,0.575,'b. Ibu');
			$this->Cell(0.25,0.575,':');
			$this->Cell(8.25,0.575,$gajiibu);
			$this->Ln();
			$this->Cell(0.75,0.575);
			$this->Cell(0.75,0.575,'6.');
			$this->Cell(4.0,0.575,'Masih Hidup / Sudah Meninggal');
			$this->Cell(0.25,0.575);
			$this->Cell(8.25,0.575);
			$this->Ln();
			$this->Cell(0.75,0.575);
			$this->Cell(0.75,0.575);
			$this->Cell(4.0,0.575,'a. Ayah');
			$this->Cell(0.25,0.575,':');
			$this->Cell(8.25,0.575,$hdpayah);
			$this->Ln();
			$this->Cell(0.75,0.575);
			$this->Cell(0.75,0.575);
			$this->Cell(4.0,0.575,'b. Ibu');
			$this->Cell(0.25,0.575,':');
			$this->Cell(8.25,0.575,$hdpibu);
			$this->Ln();
			$this->Cell(0.75,0.575);
			$this->Cell(0.75,0.575,'7.');
			$this->Cell(4.0,0.575,'Alamat');
			$this->Cell(0.25,0.575,':');		
			$this->Cell(8.25,0.575,$alamat1);
			$this->Ln();
			$this->Cell(0.75,0.575);
			$this->Cell(0.75,0.575);
			$this->Cell(4.0,0.575);
			$this->Cell(0.25,0.575);		
			$this->Cell(8.25,0.575,$alamat2);
			$this->Ln();
			$this->Cell(0.75,0.575);
			$this->Cell(0.75,0.575);
			$this->Cell(4.0,0.575);
			$this->Cell(0.25,0.575);		
			$this->Cell(8.25,0.575,$alamat3);
			$this->Ln();
			$this->Cell(0.75,0.575);
			$this->Cell(0.75,0.575,'8.');
			$this->Cell(4.0,0.575,'Nomor HP');
			$this->Cell(0.25,0.575,':');		
			$this->Cell(8.25,0.575,$nohp);
			$this->Ln(0.75);
			$this->SetFont('Times','B',11);
			$this->Cell(0.75,0.575,'D.');
			$this->Cell(11.5,0.575,'Keterangan Wali Peserta Didik');
			$this->Ln();
			$qwali=$conn->query("SELECT wa.*, r1.pendidikan, r2.pekerjaan, r3.penghasilan FROM tbortu wa INNER JOIN ref_pendidikan r1 USING(idpddk) INNER JOIN ref_pekerjaan r2 USING(idkerja) INNER JOIN ref_penghasilan r3 USING(idhsl) WHERE wa.hubkel<>'2' AND wa.hubkel<>'1' AND wa.idsiswa='$d[idsiswa]'");
			$dw=$qwali->fetch_array();
			$this->SetFont('Times','',11);
			$this->Cell(0.75,0.575);
			$this->Cell(0.75,0.575,'1.');
			$this->Cell(4.0,0.575,'Nama Lengkap');
			$this->Cell(0.25,0.575,':');
			$this->Cell(8.25,0.575,$dw['nmortu']);
			$this->Ln();
			$this->Cell(0.75,0.575);
			$this->Cell(0.75,0.575,'2.');
			$this->Cell(4.0,0.575,'Agama / Kepercayaan');
			$this->Cell(0.25,0.575,':');
			$this->Cell(8.25,0.575);
			$this->Ln();
			$this->Cell(0.75,0.575);
			$this->Cell(0.75,0.575,'3.');
			$this->Cell(4.0,0.575,'Pendidikan Terakhir');
			$this->Cell(0.25,0.575,':');
			$this->Cell(8.25,0.575,$dw['pendidikan']);
			$this->Ln();
			$this->Cell(0.75,0.575);
			$this->Cell(0.75,0.575,'4.');
			$this->Cell(4.0,0.575,'Pekerjaan');
			$this->Cell(0.25,0.575,':');
			$this->Cell(8.25,0.575,$dw['pekerjaan']);
			$this->Ln();
			$this->Cell(0.75,0.575);
			$this->Cell(0.75,0.575,'5.');
			$this->Cell(4.0,0.575,'Penghasilan Per Bulan');
			$this->Cell(0.25,0.575,':');
			$this->Cell(8.25,0.575,$dw['penghasilan']);
			$this->Ln();
			$this->Cell(0.75,0.575);
			$this->Cell(0.75,0.575,'6.');
			$this->Cell(4.0,0.575,'Alamat');
			$this->Cell(0.25,0.575,':');		
			$this->Cell(8.25,0.575);
			$this->Ln();
			$this->Cell(0.75,0.575);
			$this->Cell(0.75,0.575);
			$this->Cell(4.0,0.575);
			$this->Cell(0.25,0.575);		
			$this->Cell(8.25,0.575);
			$this->Ln();
			$this->Cell(0.75,0.575);
			$this->Cell(0.75,0.575,'7.');
			$this->Cell(4.0,0.575,'Nomor HP');
			$this->Cell(0.25,0.575,':');		
			$this->Cell(8.25,0.575,$dw['nohp']);
			$this->Ln(0.75);
			$this->SetFont('Times','B',11);
			$this->Cell(0.75,0.575,'E.');
			$this->Cell(11.5,0.575,'Catatan Perkembangan Peserta Didik');
			$this->Ln();
			$this->SetFont('Times','',11);
			$this->Cell(0.75,0.575);
			$this->Cell(0.75,0.575,'1.');
			$this->Cell(11.5,0.575,'Perkembangan Kesehatan');
			$this->Ln(0.65);
			$this->Cell(0.75,0.575);
			$this->Cell(0.75,0.575);
			$this->Cell(1.0,0.575,'No.',1,0,'C');
			$this->Cell(3.5,0.575,'Tahun Pelajaran',1,0,'C');
			$this->Cell(2.0,0.575,'Tinggi',1,0,'C');
			$this->Cell(2.0,0.575,'Berat',1,0,'C');
			$this->Cell(3.0,0.575,'Lingkar Kepala',1,0,'C');
			$this->Ln();
			for($i=1;$i<=4;$i++){
				$this->Cell(0.75,0.575);
				$this->Cell(0.75,0.575);
				$this->Cell(1.0,0.575,$i.'.',1,0,'C');
				$this->Cell(3.5,0.575,'',1,0,'C');
				$this->Cell(2.0,0.575,'',1,0,'C');
				$this->Cell(2.0,0.575,'',1,0,'C');
				$this->Cell(3.0,0.575,'',1,0,'C');
				$this->Ln();
			}
			$this->Ln(0.575);
			$this->Cell(0.75,0.575);
			$this->Cell(0.75,0.575,'2.');
			$this->Cell(11.5,0.575,'Prestasi');
			$this->Ln();
			$this->Cell(0.75,0.575);
			$this->Cell(0.75,0.575);
			$this->Cell(1.0,0.575,'No.',1,0,'C');
			$this->Cell(3.5,0.575,'Tahun Pelajaran',1,0,'C');
			$this->Cell(2.0,0.575,'Bidang',1,0,'C');
			$this->Cell(2.0,0.575,'Juara',1,0,'C');
			$this->Cell(3.0,0.575,'Tingkat',1,0,'C');
			$this->Ln();
			for($i=1;$i<=4;$i++){
				$this->Cell(0.75,0.575);
				$this->Cell(0.75,0.575);
				$this->Cell(1.0,0.575,$i.'.',1,0,'C');
				$this->Cell(3.5,0.575,'',1,0,'C');
				$this->Cell(2.0,0.575,'',1,0,'C');
				$this->Cell(2.0,0.575,'',1,0,'C');
				$this->Cell(3.0,0.575,'',1,0,'C');
				$this->Ln();
			}
			$this->Cell(0.75,0.575);
			$this->Cell(0.75,0.575,'3.');
			$this->Cell(4.0,0.575,'Beasiswa');
			$this->Ln();
			$this->Cell(0.75,0.575);
			$this->Cell(0.75,0.575);
			$this->Cell(1.0,0.575,'No.',1,0,'C');
			$this->Cell(3.5,0.575,'Tahun Pelajaran',1,0,'C');
			$this->Cell(2.0,0.575,'Program',1,0,'C');
			$this->Cell(2.0,0.575,'Nominal',1,0,'C');
			$this->Cell(3.0,0.575,'Keterangan',1,0,'C');
			$this->Ln();
			for($i=1;$i<=4;$i++){
				$this->Cell(0.75,0.575);
				$this->Cell(0.75,0.575);
				$this->Cell(1.0,0.575,$i.'.',1,0,'C');
				$this->Cell(3.5,0.575,'',1,0,'C');
				$this->Cell(2.0,0.575,'',1,0,'C');
				$this->Cell(2.0,0.575,'',1,0,'C');
				$this->Cell(3.0,0.575,'',1,0,'C');
				$this->Ln();
			}
			$this->Ln(0.25);
			$this->SetFont('Times','B',11);
			$this->Cell(0.75,0.575,'F.');
			$this->Cell(11.5,0.575,'Meninggalkan Sekolah');
			$this->Ln();
			$this->SetFont('Times','',11);
			$this->Cell(0.75,0.575);
			$this->Cell(0.75,0.575,'1.');
			$this->Cell(4.0,0.575,'Lulus / Tamat');
			$this->Cell(0.25,0.575);
			$this->Cell(8.25,0.575);
			$this->Ln();
			$this->Cell(0.75,0.575);
			$this->Cell(0.75,0.575);
			$this->Cell(4.0,0.575,'a. Tanggal Lulus');
			$this->Cell(0.25,0.575,':');
			$this->Cell(8.25,0.575);
			$this->Ln();
			$this->Cell(0.75,0.575);
			$this->Cell(0.75,0.575);
			$this->Cell(4.0,0.575,'b.  No. Seri dan Tgl. Ijazah');
			$this->Cell(0.25,0.575,':');
			$this->Cell(8.25,0.575);
			$this->Ln();
			$this->Cell(0.75,0.575);
			$this->Cell(0.75,0.575);
			$this->Cell(4.0,0.575,'c.  Melanjutkan Ke');
			$this->Cell(0.25,0.575,':');
			$this->Cell(8.25,0.575);
			$this->Ln();
			$this->Cell(0.75,0.575);
			$this->Cell(0.75,0.575,'2.');
			$this->Cell(4.0,0.575,'Pindah / Mutasi');
			$this->Cell(0.25,0.575);
			$this->Cell(8.25,0.575);
			$this->Ln();
			$this->Cell(0.75,0.575);
			$this->Cell(0.75,0.575);
			$this->Cell(4.0,0.575,'a. No. dan Tgl. Surat Pindah');
			$this->Cell(0.25,0.575,':');
			$this->Cell(8.25,0.575);
			$this->Ln();
			$this->Cell(0.75,0.575);
			$this->Cell(0.75,0.575);
			$this->Cell(4.0,0.575,'b.  Sekolah Tujuan');
			$this->Cell(0.25,0.575,':');
			$this->Cell(8.25,0.575);
			$this->Ln();
			$this->Cell(0.75,0.575);
			$this->Cell(0.75,0.575,'3.');
			$this->Cell(4.0,0.575,'Keluar');
			$this->Cell(0.25,0.575);
			$this->Cell(8.25,0.575);
			$this->Ln();
			$this->Cell(0.75,0.575);
			$this->Cell(0.75,0.575);
			$this->Cell(4.0,0.575,'a.  Tanggal');
			$this->Cell(0.25,0.575,':');
			$this->Cell(8.25,0.575);
			$this->Ln();
			$this->Cell(0.75,0.575);
			$this->Cell(0.75,0.575);
			$this->Cell(4.0,0.575,'b.  Alasan');
			$this->Cell(0.25,0.575,':');
			$this->Cell(8.25,0.575);
			$this->Ln(0.75);
			$this->SetFont('Times','B',11);
			$this->Cell(0.75,0.575,'H.');
			$this->Cell(11.5,0.575,'Catatan Penting Lainnya');
			$this->Ln();
			$this->SetFont('Times','',11);
			for($i=1;$i<=6;$i++){
			$this->Cell(0.85,0.575);
			$this->Cell(11.5,0.575,' ................................................................................................................................');
			$this->Ln();
			}
			$this->SetCol(0);
        }

        function PrintChapter($idsiswa)
        {
			$this->AddPage();
			$this->ChapterTitle($idsiswa);
			$this->ChapterBody($idsiswa);			
        }
    }
    $pdf = new PDF('L','cm',array(21.5,33.0));
    $pdf->SetMargins(3.25,1.5,1.25);
    $title = 'Laporan Buku Induk';
    $pdf->SetTitle($title);
    $pdf->SetAuthor('Kasworo Wardani, S.T');
	$sql="SELECT si.idsiswa, si.nmsiswa FROM tbsiswa si INNER JOIN tbregistrasi rg USING(idsiswa) INNER JOIN tbthpel th USING(idthpel) WHERE th.nmthpel LIKE '$_GET[id]%' AND (rg.idjreg='1' OR rg.idjreg='2')";
	$data=vquery($sql);
	foreach ($data as $ds){
    	$pdf->PrintChapter($ds['idsiswa']);
	}
	$pdf->Output();
?>