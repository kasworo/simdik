<?php
	require('assets/library/fpdf/fpdf.php'); 
	include "dbfunction.php";
	class PDF extends FPDF
    {
        protected $col = 0;
        protected $y0;
		function Header()
		{
			global $title;
			$this->y0 = $this->GetY();
		}

        function SetCol($col)
        {
            $this->col = $col;
            $x = 2.0+$col*15;
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

        function ChapterTitle($nis, $nisn)
        {
			$this->SetFont('Times','B',12);
			$this->Cell(28.0,0.75,'LEMBAR DATA INDUK PESERTA DIDIK',0,0,'C');
            $this->Ln(1.25);
			$this->SetFont('Times','',11);
			$this->Cell(18,0.575);
            $this->Cell(3.45,0.575,'Nomor Induk',0,0,'L');		
            $this->Cell(0.575,0.575);
            $this->Cell(5.75,0.575,'Nomor Induk Siswa Nasional',0,0,'L');
            $this->Ln();
			$c=strlen($nis);
			$this->SetFont('Times','BI',12);
            $t=6-$c;
            $this->Cell(18,0.575,strlen($nis));
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
            $this->Ln(1.5);
            $this->y0 = $this->GetY();
        }

        function ChapterBody($nisn)
        {
            include "config/konfigurasi.php";
            include "config/fungsi_tgl.php";
            $qisi=$conn->query("SELECT*FROM tbsiswa WHERE nisn='$nisn'");
            $d=$qisi->fetch_array();
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
			if($d['gender']=='L'){$jk='Laki-laki';} else {$jk='Perempuan';}
			$this->Cell(8.25,0.575,$jk);
			$this->Ln();
			$this->Cell(0.75,0.575);
			$this->Cell(0.75,0.575,'5.');
			$this->Cell(4.0,0.575,'Agama / Kepercayaan');
			$this->Cell(0.25,0.575,':');
			switch($d['idagama']){
				case 'A' : {$agm='Islam';break;}
				case 'B' : {$agm='Kristen';break;}
				case 'C' : {$agm='Katholik';break;}
				case 'D' : {$agm='Hindu';break;}
				case 'E' : {$agm='Buddha';break;}
			}
			$this->Cell(8.25,0.575,$agm);
			$this->Ln();
			$this->Cell(0.75,0.575);
			$this->Cell(0.75,0.575,'6.');
			$this->Cell(4.0,0.575,'Kewarganegaraan');
			$this->Cell(0.25,0.575,':');
			if($d['warganegara']=='1'){$wn='Warga Negara Indonesia';} else {$wn='Warga Negara Asing';}		
			$this->Cell(8.25,0.575,$wn);	
			$this->Ln();
			$this->Cell(0.75,0.575);
			$this->Cell(0.75,0.575,'7.');
			$this->Cell(4.0,0.575,'Anak Ke');
			$this->Cell(0.25,0.575,':');		
			$this->Cell(8.25,0.575,$d['anake'].' dari '.$d['saudara'].' bersaudara');
			$this->Ln();
			$this->Cell(0.75,0.575);
			$this->Cell(0.75,0.575,'8.');
			$this->Cell(4.0,0.575,'Golongan Darah');
			$this->Cell(0.25,0.575,':');
			switch($d['goldarah']){
				case '0' : {$goldarah='Tidak Tahu';break;}
				case '1' : {$goldarah='A';break;}
				case '2' : {$goldarah='B';break;}
				case '3' : {$goldarah='AB';break;}
				case '4' : {$goldarah='O';break;}
			}
			$this->Cell(8.25,0.575,$goldarah);
			$this->Ln();
			$this->Cell(0.75,0.575);
			$this->Cell(0.75,0.575,'9.');
			$this->Cell(4.0,0.575,'Riwayat Penyakit');
			$this->Cell(0.25,0.575,':');
			switch($d['rwysakit']){
				case '0' : {$skt='Tidak Ada';break;}
				case '1' : {$skt='Demam Berdarah';break;}
				case '2' : {$skt='Malaria';break;}
				case '3' : {$skt='Asma';break;}
				case '4' : {$skt='Campak';break;}
				case '5' : {$skt='TBC';break;}
				case '6' : {$skt='Tetanus';break;}
				case '7' : {$skt='Pneumonia';break;}
				case '8' : {$skt='Jantung';break;}
			}		
			$this->Cell(8.25,0.575,$skt);
			$this->Ln();
			$this->Cell(0.75,0.575);
			$this->Cell(0.75,0.575,'10.');
			$this->Cell(4.0,0.575,'Kebutuhan Khusus');
			$this->Cell(0.25,0.575,':');
			switch($d['kebkhusus']){
				case '0' : {$kbthn='Tidak Ada';break;}
				case '1' : {$kbthn='Tuna Daksa';break;}
				case '2' : {$kbthn='Tuna Rungu';break;}
				case '3' : {$kbthn='Tuna Wicara';break;}
				case '4' : {$kbthn='Tuna Netra';break;}
				case '5' : {$kbthn='Tuna Grahita';break;}
				case '6' : {$kbthn='Down Syndrome';break;}
				case '7' : {$kbthn='Autisme';break;}
			}		
			$this->Cell(8.25,0.575,$kbthn);
			$this->Ln();
			$this->Cell(0.75,0.575);
			$this->Cell(0.75,0.575,'11.');
			$this->Cell(4.0,0.575,'Tinggal Dengan');
			$this->Cell(0.25,0.575,':');	
			switch($d['ikuts']){
				case '1' : {$tggl='Orangtua';break;}
				case '2' : {$tggl='Wali Murid';break;}
				case '3' : {$tggl='Kost';break;}
				case '4' : {$tggl='Asrama';break;}
			}
				
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
			switch($d['transpr']){
				case '1' : {$trns='Jalan Kaki';break;}
				case '2' : {$trns='Sepeda';break;}
				case '3' : {$trns='Sepeda Motor';break;}
				case '4' : {$trns='Ojek';break;}
				case '5' : {$trns='Angkutan Umum';break;}
				case '6' : {$trns='Angkutan Antar Jemput';break;}
			}		
			$this->Cell(8.25,0.575,$trns);
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
			$this->Cell(0.75,0.575);
			$this->Cell(0.75,0.575,'16.');
			$this->Cell(4.0,0.575,'Koordinat');
			$this->Cell(0.25,0.575,':');		
			$this->Cell(8.25,0.575);
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
			$this->Cell(0.75,0.575);
			$this->Cell(0.75,0.575);
			$this->Cell(4.0,0.575,'a.  Bidang Olahraga');
			$this->Cell(0.25,0.575,':');		
			$this->Cell(8.25,0.575,'');
			$this->Ln();
			$this->Cell(0.75,0.575);
			$this->Cell(0.75,0.575);
			$this->Cell(4.0,0.575,'b.  Bidang Seni');
			$this->Cell(0.25,0.575,':');		
			$this->Cell(8.25,0.575,'');
			$this->Ln();
			$this->Cell(0.75,0.575);
			$this->Cell(0.75,0.575);
			$this->Cell(4.0,0.575,'c.  Organisasi');
			$this->Cell(0.25,0.575,':');		
			$this->Cell(8.25,0.575,'');
			$this->Ln();
			$this->Cell(0.75,0.575);
			$this->Cell(0.75,0.575);
			$this->Cell(4.0,0.575,'d.  Lainnya');
			$this->Cell(0.25,0.575,':');		
            $this->Cell(8.25,0.575,'');
            $this->Ln(0.75);
			$this->SetFont('Times','B',11);
			$this->Cell(0.75,0.575,'B.');
			$this->Cell(11.5,0.575,'Catatan Registrasi Peserta Didik');
			$this->Ln();
			$this->SetFont('Times','',11);
			$this->Cell(0.75,0.575);
			$this->Cell(0.75,0.575,'1.');
			$this->Cell(4.0,0.575,'Terdaftar Sebagai');
			$this->Cell(0.25,0.575,':');		
			$this->Cell(8.25,0.575,'Siswa Baru');
			$this->Ln();
			$this->Cell(0.75,0.575);
			$this->Cell(0.75,0.575,'2.');
			$this->Cell(4.0,0.575,'Tanggal');
			$this->Cell(0.25,0.575,':');		
			$this->Cell(8.25,0.575,'');
			$this->Ln();
			$this->Cell(0.75,0.575);
			$this->Cell(0.75,0.575,'3.');
			$this->Cell(4.0,0.575,'Diterima di Kelas');
			$this->Cell(0.25,0.575,':');		
			$this->Cell(8.25,0.575,'');
			$this->Ln();
			$this->Cell(0.75,0.575);
			$this->Cell(0.75,0.575,'4.');
			$this->Cell(4.0,0.575,'Lulus Dari SD/MI');
			$this->Cell(0.25,0.575,':');		
			$this->Cell(8.25,0.575,'');
			$this->Ln();
			$this->Cell(0.75,0.575);
			$this->Cell(0.75,0.575);
			$this->Cell(4.0,0.575,'a.  Tanggal');
			$this->Cell(0.25,0.575,':');	
			$this->Cell(8.25,0.575,'');
			$this->Ln();
			$this->Cell(0.75,0.575);
			$this->Cell(0.75,0.575);
			$this->Cell(4.0,0.575,'b.  Nomor Seri Ijazah');
			$this->Cell(0.25,0.575,':');	
			$this->Cell(8.25,0.575,'');
			$this->Ln();
			$this->Cell(0.75,0.575);
			$this->Cell(0.75,0.575);
			$this->Cell(4.0,0.575,'c.  Lama Belajar');
			$this->Cell(0.25,0.575,':');	
			$this->Cell(8.25,0.575,'');
			$this->Ln();
			$this->Cell(0.75,0.575);
			$this->Cell(0.75,0.575,'5.');
			$this->Cell(4.0,0.575,'Pindahan Dari');
			$this->Cell(0.25,0.575,':');		
			$this->Cell(8.25,0.575,$this->y0);
			$this->Ln();
			$this->Cell(0.75,0.575);
			$this->Cell(0.75,0.575);
			$this->Cell(4.0,0.575,'a.  Rekomendasi');
			$this->Cell(0.25,0.575,':');	
			$this->Cell(8.25,0.575,'');
			$this->Ln();
			$this->Cell(0.75,0.575);
			$this->Cell(0.75,0.575);
			$this->Cell(4.0,0.575,'b.  Nomor Surat Pindah');
			$this->Cell(0.25,0.575,':');	
			$this->Cell(8.25,0.575,'');
			$this->Ln();
			$this->Cell(0.75,0.575);
			$this->Cell(0.75,0.575);
			$this->Cell(4.0,0.575,'c.  Alasan Pindah');
			$this->Cell(0.25,0.575,':');	
			$this->Cell(8.25,0.575,'');
			
			$this->Ln(0.75);
			$this->SetFont('Times','B',11);
			$this->Cell(0.75,0.575,'C.');
			$this->Cell(11.5,0.575,'Keterangan Ayah Kandung');
			$this->Ln();
			$qayah=$conn->query("SELECT ay.*, r1.pendidikan, r2.pekerjaan, r3.penghasilan FROM tbayah ay INNER JOIN ref_pendidikan r1 USING(idpddk) INNER JOIN ref_pekerjaan r2 USING(idkerja) INNER JOIN ref_penghasilan r3 USING(idhsl) WHERE ay.idsiswa='$d[idsiswa]'");
			$da=$qayah->fetch_array();
			$this->SetFont('Times','',11);
			$this->Cell(0.75,0.575);
			$this->Cell(0.75,0.575,'1.');
			$this->Cell(4.0,0.575,'Nama Lengkap');
			$this->Cell(0.25,0.575,':');
			$this->Cell(8.25,0.575,$da['nmayah']);
			$this->Ln();
			$this->Cell(0.75,0.575);
			$this->Cell(0.75,0.575,'2.');
			$this->Cell(4.0,0.575,'N I K');
			$this->Cell(0.25,0.575,':');		
			$this->Cell(8.25,0.575,$da['nik']);
			$this->Ln();
			$this->Cell(0.75,0.575);
			$this->Cell(0.75,0.575,'3.');
			$this->Cell(4.0,0.575,'Tempat, Tanggal Lahir');
			$this->Cell(0.25,0.575,':');		
			$this->Cell(8.25,0.575,$da['tmplahir'].', '.indonesian_date($da['tgllahir']));
			$this->Ln();
			$this->Cell(0.75,0.575);
			$this->Cell(0.75,0.575,'4.');
			$this->Cell(4.0,0.575,'Agama / Kepercayaan');
			$this->Cell(0.25,0.575,':');
			switch($da['idagama']){
				case 'A' : {$agm='Islam';break;}
				case 'B' : {$agm='Kristen';break;}
			}
			$this->Cell(8.25,0.575,$agm);
			$this->Ln();
			$this->Cell(0.75,0.575);
			$this->Cell(0.75,0.575,'5.');
			$this->Cell(4.0,0.575,'Pendidikan Terakhir');
			$this->Cell(0.25,0.575,':');
			$this->Cell(8.25,0.575,$da['pendidikan']);
			$this->Ln();
			$this->Cell(0.75,0.575);
			$this->Cell(0.75,0.575,'6.');
			$this->Cell(4.0,0.575,'Pekerjaan');
			$this->Cell(0.25,0.575,':');
			$this->Cell(8.25,0.575,$da['pekerjaan']);
			$this->Ln();
			$this->Cell(0.75,0.575);
			$this->Cell(0.75,0.575,'7.');
			$this->Cell(4.0,0.575,'Penghasilan Per Bulan');
			$this->Cell(0.25,0.575,':');
			$this->Cell(8.25,0.575,$da['penghasilan']);
			$this->Ln();
			$this->Cell(0.75,0.575);
			$this->Cell(0.75,0.575,'8.');
			$this->Cell(4.0,0.575,'Masih Hidup/Meninggal');
			$this->Cell(0.25,0.575,':');
			$this->Cell(8.25,0.575,$da['penghasilan']);
			$this->Ln();
			$this->Cell(0.75,0.575);
			$this->Cell(0.75,0.575,'9.');
			$this->Cell(4.0,0.575,'Alamat');
			$this->Cell(0.25,0.575,':');		
			$this->Cell(8.25,0.575,$da['alamat'].', Desa '.$da['desa']);
			$this->Ln();
			$this->Cell(0.75,0.575);
			$this->Cell(0.75,0.575);
			$this->Cell(4.0,0.575);
			$this->Cell(0.25,0.575);		
			$this->Cell(8.25,0.575,'Kecamatan '.str_replace('Kec. ','', $da['kec']).', Kabupaten / Kota '.$da['kab']);
			$this->Ln();
			$this->Cell(0.75,0.575);
			$this->Cell(0.75,0.575,'10.');
			$this->Cell(4.0,0.575,'Nomor HP');
			$this->Cell(0.25,0.575,':');		
			$this->Cell(8.25,0.575,$da['nohp']);

			$this->Ln(0.75);
			$this->SetFont('Times','B',11);
			$this->Cell(0.75,0.575,'D.');
			$this->Cell(11.5,0.575,'Keterangan Ibu Kandung');
			$this->Ln();
			$qibu=$conn->query("SELECT ib.*, r1.pendidikan, r2.pekerjaan, r3.penghasilan FROM tbibu ib INNER JOIN ref_pendidikan r1 USING(idpddk) INNER JOIN ref_pekerjaan r2 USING(idkerja) INNER JOIN ref_penghasilan r3 USING(idhsl) WHERE ib.idsiswa='$d[idsiswa]'");
			$di=$qibu->fetch_array();
			$this->SetFont('Times','',11);
			$this->Cell(0.75,0.575);
			$this->Cell(0.75,0.575,'1.');
			$this->Cell(4.0,0.575,'Nama Lengkap');
			$this->Cell(0.25,0.575,':');
			$this->Cell(8.25,0.575,$di['nmibu']);
			$this->Ln();
			$this->Cell(0.75,0.575);
			$this->Cell(0.75,0.575,'2.');
			$this->Cell(4.0,0.575,'N I K');
			$this->Cell(0.25,0.575,':');		
			$this->Cell(8.25,0.575,$di['nik']);
			$this->Ln();
			$this->Cell(0.75,0.575);
			$this->Cell(0.75,0.575,'3.');
			$this->Cell(4.0,0.575,'Tempat, Tanggal Lahir');
			$this->Cell(0.25,0.575,':');		
			$this->Cell(8.25,0.575,$di['tmplahir'].', '.indonesian_date($di['tgllahir']));
			$this->Ln();
			$this->Cell(0.75,0.575);
			$this->Cell(0.75,0.575,'4.');
			$this->Cell(4.0,0.575,'Agama / Kepercayaan');
			$this->Cell(0.25,0.575,':');
			switch($di['idagama']){
				case 'A' : {$agm='Islam';break;}
				case 'B' : {$agm='Kristen';break;}
			}
			$this->Cell(8.25,0.575,$agm);
			$this->Ln();
			$this->Cell(0.75,0.575);
			$this->Cell(0.75,0.575,'5.');
			$this->Cell(4.0,0.575,'Pendidikan Terakhir');
			$this->Cell(0.25,0.575,':');
			$this->Cell(8.25,0.575,$di['pendidikan']);
			$this->Ln();
			$this->Cell(0.75,0.575);
			$this->Cell(0.75,0.575,'6.');
			$this->Cell(4.0,0.575,'Pekerjaan');
			$this->Cell(0.25,0.575,':');
			$this->Cell(8.25,0.575,$di['pekerjaan']);
			$this->Ln();
			$this->Cell(0.75,0.575);
			$this->Cell(0.75,0.575,'7.');
			$this->Cell(4.0,0.575,'Penghasilan Per Bulan');
			$this->Cell(0.25,0.575,':');
			$this->Cell(8.25,0.575,$di['penghasilan']);
			$this->Ln();
			$this->Cell(0.75,0.575);
			$this->Cell(0.75,0.575,'8.');
			$this->Cell(4.0,0.575,'Masih Hidup/Meninggal');
			$this->Cell(0.25,0.575,':');
			$this->Cell(8.25,0.575,$di['penghasilan']);
			$this->Ln();
			$this->Cell(0.75,0.575);
			$this->Cell(0.75,0.575,'9.');
			$this->Cell(4.0,0.575,'Alamat');
			$this->Cell(0.25,0.575,':');		
			$this->Cell(8.25,0.575,$di['alamat'].', Desa '.$di['desa']);
			$this->Ln();
			$this->Cell(0.75,0.575);
			$this->Cell(0.75,0.575);
			$this->Cell(4.0,0.575);
			$this->Cell(0.25,0.575);		
			$this->Cell(8.25,0.575,'Kecamatan '.str_replace('Kec. ','', $di['kec']).', Kabupaten / Kota '.$di['kab']);
			$this->Ln();
			$this->Cell(0.75,0.575);
			$this->Cell(0.75,0.575,'10.');
			$this->Cell(4.0,0.575,'Nomor HP');
			$this->Cell(0.25,0.575,':');		
			$this->Cell(8.25,0.575,$di['nohp']);

			$this->Ln(0.75);
			$this->SetFont('Times','B',11);
			$this->Cell(0.75,0.575,'E.');
			$this->Cell(11.5,0.575,'Keterangan Wali Peserta Didik');
			$this->Ln();
			$qibu=$conn->query("SELECT ib.*, r1.pendidikan, r2.pekerjaan, r3.penghasilan FROM tbibu ib INNER JOIN ref_pendidikan r1 USING(idpddk) INNER JOIN ref_pekerjaan r2 USING(idkerja) INNER JOIN ref_penghasilan r3 USING(idhsl) WHERE ib.idsiswa='$d[idsiswa]'");
			$di=$qibu->fetch_array();
			$this->SetFont('Times','',11);
			$this->Cell(0.75,0.575);
			$this->Cell(0.75,0.575,'1.');
			$this->Cell(4.0,0.575,'Nama Lengkap');
			$this->Cell(0.25,0.575,':');
			$this->Cell(8.25,0.575,$di['nmibu']);
			$this->Ln();
			$this->Cell(0.75,0.575);
			$this->Cell(0.75,0.575,'2.');
			$this->Cell(4.0,0.575,'N I K');
			$this->Cell(0.25,0.575,':');		
			$this->Cell(8.25,0.575,$di['nik']);
			$this->Ln();
			$this->Cell(0.75,0.575);
			$this->Cell(0.75,0.575,'3.');
			$this->Cell(4.0,0.575,'Tempat, Tanggal Lahir');
			$this->Cell(0.25,0.575,':');		
			$this->Cell(8.25,0.575,$di['tmplahir'].', '.indonesian_date($di['tgllahir']));
			$this->Ln();
			$this->Cell(0.75,0.575);
			$this->Cell(0.75,0.575,'4.');
			$this->Cell(4.0,0.575,'Agama / Kepercayaan');
			$this->Cell(0.25,0.575,':');
			switch($di['idagama']){
				case 'A' : {$agm='Islam';break;}
				case 'B' : {$agm='Kristen';break;}
			}
			$this->Cell(8.25,0.575,$agm);
			$this->Ln();
			$this->Cell(0.75,0.575);
			$this->Cell(0.75,0.575,'5.');
			$this->Cell(4.0,0.575,'Pendidikan Terakhir');
			$this->Cell(0.25,0.575,':');
			$this->Cell(8.25,0.575,$di['pendidikan']);
			$this->Ln();
			$this->Cell(0.75,0.575);
			$this->Cell(0.75,0.575,'6.');
			$this->Cell(4.0,0.575,'Pekerjaan');
			$this->Cell(0.25,0.575,':');
			$this->Cell(8.25,0.575,$di['pekerjaan']);
			$this->Ln();
			$this->Cell(0.75,0.575);
			$this->Cell(0.75,0.575,'7.');
			$this->Cell(4.0,0.575,'Penghasilan Per Bulan');
			$this->Cell(0.25,0.575,':');
			$this->Cell(8.25,0.575,$di['penghasilan']);
			$this->Ln();
			$this->Cell(0.75,0.575);
			$this->Cell(0.75,0.575,'8.');
			$this->Cell(4.0,0.575,'Hubungan Keluarga');
			$this->Cell(0.25,0.575,':');
			$this->Cell(8.25,0.575);
			$this->Ln();
			$this->Cell(0.75,0.575);
			$this->Cell(0.75,0.575,'9.');
			$this->Cell(4.0,0.575,'Alamat');
			$this->Cell(0.25,0.575,':');		
			$this->Cell(8.25,0.575,$di['alamat'].', Desa '.$di['desa']);
			$this->Ln();
			$this->Cell(0.75,0.575);
			$this->Cell(0.75,0.575);
			$this->Cell(4.0,0.575);
			$this->Cell(0.25,0.575);		
			$this->Cell(8.25,0.575,'Kecamatan '.str_replace('Kec. ','', $di['kec']).', Kabupaten / Kota '.$di['kab']);
			$this->Ln();
			$this->Cell(0.75,0.575);
			$this->Cell(0.75,0.575,'10.');
			$this->Cell(4.0,0.575,'Nomor HP');
			$this->Cell(0.25,0.575,':');		
			$this->Cell(8.25,0.575,$di['nohp']);
			$this->Ln(0.75);
			$this->SetFont('Times','B',11);
			$this->Cell(0.75,0.575,'F.');
			$this->Cell(11.5,0.575,'Catatan Perkembangan Peserta Didik');
			$this->Ln();
			$this->SetFont('Times','',11);
			$this->Cell(0.75,0.575);
			$this->Cell(0.75,0.575,'1.');
			$this->Cell(11.5,0.575,'Perkembangan Kesehatan');
			$this->Ln();
			$this->Cell(0.75,0.575);
			$this->Cell(0.75,0.575);
			$this->Cell(1.0,0.575,'No.',1,0,'C');
			$this->Cell(3.5,0.575,'Tahun Pelajaran',1,0,'C');
			$this->Cell(2.0,0.575,'Tinggi',1,0,'C');
			$this->Cell(2.0,0.575,'Berat',1,0,'C');
			$this->Cell(3.0,0.575,'Lingkar Kepala',1,0,'C');
			$this->Ln();
			for($i=1;$i<=3;$i++){
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
			for($i=1;$i<=3;$i++){
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
			for($i=1;$i<=3;$i++){
				$this->Cell(0.75,0.575);
				$this->Cell(0.75,0.575);
				$this->Cell(1.0,0.575,$i.'.',1,0,'C');
				$this->Cell(3.5,0.575,'',1,0,'C');
				$this->Cell(2.0,0.575,'',1,0,'C');
				$this->Cell(2.0,0.575,'',1,0,'C');
				$this->Cell(3.0,0.575,'',1,0,'C');
				$this->Ln();
			}
			$this->Ln(0.15);
			$this->SetFont('Times','B',11);
			$this->Cell(0.75,0.575,'G.');
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
			$this->Cell(4.0,0.575,'a.  Tanggal');
			$this->Cell(0.25,0.575,':');
			$this->Cell(8.25,0.575);
			$this->Ln();
			$this->Cell(0.75,0.575);
			$this->Cell(0.75,0.575);
			$this->Cell(4.0,0.575,'b.  Nomor Ijazah');
			$this->Cell(0.25,0.575,':');
			$this->Cell(8.25,0.575);
			$this->Ln();
			$this->Cell(0.75,0.575);
			$this->Cell(0.75,0.575);
			$this->Cell(4.0,0.575,'c.  Nomor Peserta UN');
			$this->Cell(0.25,0.575,':');
			$this->Cell(8.25,0.575);
			$this->Ln();
			$this->Cell(0.75,0.575);
			$this->Cell(0.75,0.575);
			$this->Cell(4.0,0.575,'d.  Melanjutkan Ke');
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
			$this->Cell(4.0,0.575,'a.  Tanggal');
			$this->Cell(0.25,0.575,':');
			$this->Cell(8.25,0.575);
			$this->Ln();
			$this->Cell(0.75,0.575);
			$this->Cell(0.75,0.575);
			$this->Cell(4.0,0.575,'b.  Nomor Surat Pindah');
			$this->Cell(0.25,0.575,':');
			$this->Cell(8.25,0.575);
			$this->Ln();
			$this->Cell(0.75,0.575);
			$this->Cell(0.75,0.575);
			$this->Cell(4.0,0.575,'c.  Sekolah Tujuan');
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
			$this->Cell(11.5,0.575,' ..........................................................................................................................................');
			$this->Ln();
			}
			$this->SetCol(0);
        }

        function PrintChapter($nis, $nisn)
        {
			$this->AddPage();
			$this->ChapterTitle($nis,$nisn);
			$this->ChapterBody($nisn);			
        }
    }
    include "config/konfigurasi.php";
	include "config/fungsi_tgl.php";
    $pdf = new PDF('L','cm',array(21.5,33.0));
    $pdf->SetMargins(2.75,1.75,1.25);
    $title = 'Laporan Buku Induk';
    $pdf->SetTitle($title);
    $pdf->SetAuthor('Kasworo Wardani, S.T');
    $qsiswa=$conn->query("SELECT si.* FROM tbsiswa si LEFT JOIN tbregistrasi rg USING(idsiswa) LEFT JOIN tbrombel rb USING(idrombel) LEFT JOIN tbthpel th USING(idthpel) WHERE rg.idjreg='1' OR rg.idjreg='2' AND th.nmthpel LIKE '$_REQUEST[id]%' OR rb.idthpel=''");
    while($ds=$qsiswa->fetch_array()){
        $pdf->PrintChapter($ds['nis'], $ds['nisn']);
    }
    $pdf->Output();
?>