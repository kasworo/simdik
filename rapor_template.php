<?php
require_once "assets/library/PHPExcel.php";
include "dbfunction.php";

function CellsToMergeByColsRow($start = -1, $end = -1, $row = -1, $n = 0)
{
    $merge = 'A1:A1';
    if ($start >= 0 && $end >= 0 && $row >= 0) {
        $start = PHPExcel_Cell::stringFromColumnIndex($start);
        $end = PHPExcel_Cell::stringFromColumnIndex($end);
        $baris = $row + $n - 1;
        $merge = "$start{$row}:$end{$baris}";
    }
    return $merge;
}

function getsiswa($kls, $th)
{
    $sql = "SELECT s.nis, s.nisn, s.nmsiswa, nr.nilairapor, nr.predikat, nr.deskripsi, nr.idmapel FROM tbsiswa s INNER JOIN tbregistrasi r ON r.idsiswa=s.idsiswa INNER JOIN tbregistrasi_detil rd ON r.idreg=rd.idreg LEFT JOIN tbnilairapor nr ON nr.idsiswa=s.idsiswa AND r.idthpel=nr.idthpel  WHERE rd.idkelas='$kls' AND r.idthpel='$th' GROUP BY s.idsiswa ORDER BY s.idsiswa";
    $cek = cquery($sql);
    if ($cek > 0) {
        $ds = vquery($sql);
    } else {
        $query = "SELECT s.nis, s.nisn, s.nmsiswa FROM tbsiswa s INNER JOIN tbregistrasi r ON r.idsiswa=s.idsiswa WHERE r.idkelas='$kls' AND r.idthpel='$th' GROUP BY s.idsiswa ORDER BY s.idsiswa";
        $ds = vquery($query);
    }
    return $ds;
}

function gettahun($th)
{
    $where = array('idthpel' => $th);
    $tp = viewdata('tbthpel', $where)[0];
    return $tp;
}

function getkelas($kls)
{
    $sql = "SELECT idkelas, nmkelas FROM tbkelas INNER JOIN tbskul USING(idjenjang) WHERE idkelas='$kls'";
    $qkls = vquery($sql)[0];
    return $qkls;
}

function getmapel()
{
    return viewdata('tbmapel');
}

function getekskul()
{
    return viewdata('tbekskul');
}


if (isset($_POST['downrpt'])) {
    $data = getsiswa($_POST['klsrpt'], $_POST['thnrpt']);
    $thn = gettahun($_POST['thnrpt']);
    $tahun = $thn['nmthpel'];
    $kls = getkelas($_POST['klsrpt']);
    $namafile = 'rapor_' . $kls['idkelas'] . '_' . $thn['nmthpel'];

    $objPHPExcel = new PHPExcel();
    $objPHPExcel->getProperties()->setCreator("Kasworo Wardani")
        ->setTitle("Template")->setLastModifiedBy("Kasworo Wardani");
    $objPHPExcel->setActiveSheetIndex(0)
        ->setCellValue('A1', 'TEMPLATE INPUT NILAI RAPOR')
        ->setCellValue('A2', strtoupper('Tahun Pelajaran ' . str_replace('-', ' Semester ', $thn['desthpel'])))
        ->setCellValue('A3', strtoupper($kls['nmkelas']))
        ->setCellValue('A5', 'No.')->setCellValue('A9', '(1)')
        ->setCellValue('B5', 'NIS')->setCellValue('B9', '(2)')
        ->setCellValue('C5', 'Nama Peserta Didik')->setCellValue('C9', '(3)')
        ->setCellValue('D5', 'Kode Tahun Pelajaran')->setCellValue('D9', '(4)')
        ->setCellValue('E5', 'Nilai Per Mata Pelajaran');
    $jmp = 0;
    $qmp = getmapel();
    foreach ($qmp as $mp) {
        $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValueByColumnAndRow($jmp * 4 + 4, 6, $mp['akmapel'])
            ->mergeCells(CellsToMergeByColsRow($jmp * 4 + 4, $jmp * 4 + 7, 6, 1))
            ->setCellValueByColumnAndRow($jmp * 4 + 4, 7, 'Peng')
            ->mergeCells(cellsToMergeByColsRow($jmp * 4 + 4, $jmp * 4 + 5, 7, 1))
            ->setCellValueByColumnAndRow($jmp * 4 + 4, 8, 'N')
            ->setCellValueByColumnAndRow($jmp * 4 + 5, 8, 'P')
            ->setCellValueByColumnAndRow($jmp * 4 + 6, 7, 'Ket')
            ->mergeCells(cellsToMergeByColsRow($jmp * 4 + 6, $jmp * 4 + 7, 7, 1))
            ->setCellValueByColumnAndRow($jmp * 4 + 6, 8, 'N')
            ->setCellValueByColumnAndRow($jmp * 4 + 7, 8, 'P')
            ->setCellValueByColumnAndRow($jmp * 4 + 4, 9, '(' . ($jmp * 4 + 5) . ')')
            ->setCellValueByColumnAndRow($jmp * 4 + 5, 9, '(' . ($jmp * 4 + 6) . ')')
            ->setCellValueByColumnAndRow($jmp * 4 + 6, 9, '(' . ($jmp * 4 + 7) . ')')
            ->setCellValueByColumnAndRow($jmp * 4 + 7, 9, '(' . ($jmp * 4 + 8) . ')');
        $jmp++;
    }
    $objPHPExcel->setActiveSheetIndex(0)
        ->mergeCells('A5:A8')->mergeCells('B5:B8')
        ->mergeCells('C5:C8')->mergeCells('D5:D8')
        ->setCellValueByColumnAndRow($jmp * 4 + 4, 6, 'Rata-rata')
        ->setCellValueByColumnAndRow($jmp * 4 + 4, 8, 'Peng')
        ->setCellValueByColumnAndRow($jmp * 4 + 4, 9, '(' . ($jmp * 4 + 5) . ')')
        ->setCellValueByColumnAndRow($jmp * 4 + 5, 8, 'Ket')
        ->setCellValueByColumnAndRow($jmp * 4 + 5, 9, '(' . ($jmp * 4 + 6) . ')')
        ->setCellValueByColumnAndRow($jmp * 4 + 6, 5, 'Penilaian Sikap')
        ->setCellValueByColumnAndRow($jmp * 4 + 6, 8, 'Spiritual')
        ->setCellValueByColumnAndRow($jmp * 4 + 6, 9, '(' . ($jmp * 4 + 7) . ')')
        ->setCellValueByColumnAndRow($jmp * 4 + 7, 8, 'Sosial')
        ->setCellValueByColumnAndRow($jmp * 4 + 7, 9, '(' . ($jmp * 4 + 8) . ')')
        ->setCellValueByColumnAndRow($jmp * 4 + 8, 5, 'Ketidakhadiran')
        ->setCellValueByColumnAndRow($jmp * 4 + 8, 8, 'S')
        ->setCellValueByColumnAndRow($jmp * 4 + 8, 9, '(' . ($jmp * 4 + 9) . ')')
        ->setCellValueByColumnAndRow($jmp * 4 + 9, 8, 'I')
        ->setCellValueByColumnAndRow($jmp * 4 + 9, 9, '(' . ($jmp * 4 + 10) . ')')
        ->setCellValueByColumnAndRow($jmp * 4 + 10, 8, 'A')
        ->setCellValueByColumnAndRow($jmp * 4 + 10, 9, '(' . ($jmp * 4 + 11) . ')')
        ->mergeCells(cellsToMergeByColsRow($jmp * 4 + 4, $jmp * 4 + 5, 6, 2))
        ->mergeCells(cellsToMergeByColsRow($jmp * 4 + 6, $jmp * 4 + 7, 5, 3))
        ->mergeCells(cellsToMergeByColsRow($jmp * 4 + 8, $jmp * 4 + 10, 5, 3))
        ->mergeCells(cellsToMergeByColsRow(4, ($jmp - 1) * 4 + 9, 5, 1))
        ->setCellValueByColumnAndRow($jmp * 4 + 11, 5, 'Kegiatan Ekstrakurikuler');
    $qeks = getekskul();
    $jeks = 0;
    foreach ($qeks as $eks) {
        $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValueByColumnAndRow($jmp * 4 + $jeks + 11, 8, $eks['akekskul'])
            ->setCellValueByColumnAndRow($jmp * 4 + $jeks + 11, 9, '(' . ($jmp * 4 + $jeks + 12) . ')');
        $jeks++;
    }
    $objPHPExcel->setActiveSheetIndex(0)
        ->mergeCells(cellsToMergeByColsRow($jmp * 4 + 11, $jmp * 4 + $jeks + 10, 5, 3));
    $baris = 10;
    $no = 0;
    foreach ($data as $s) {
        $no++;
        $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValueByColumnAndRow(0, $baris, $no)
            ->setCellValueByColumnAndRow(1, $baris, $s['nis'])
            ->setCellValueByColumnAndRow(2, $baris, $s['nmsiswa'])
            ->setCellValueByColumnAndRow(3, $baris, $tahun);
        $qmp = getmapel();
        $jmp = 0;
        foreach ($qmp as $mp) {
            $sqlkog = "SELECT nilairapor, predikat FROM tbnilairapor INNER JOIN tbsiswa USING(idsiswa) INNER JOIN tbthpel USING(idthpel) WHERE nis='$s[nis]' AND idmapel='$mp[idmapel]' AND nmthpel='$tahun' AND aspek='3'";
            if (cquery($sqlkog) > 0) {
                $kog = vquery($sqlkog)[0];
                $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValueByColumnAndRow($jmp * 4 + 4, $baris, $kog['nilairapor'])
                    ->setCellValueByColumnAndRow($jmp * 4 + 5, $baris, $kog['predikat']);
            }

            $sqlmot = "SELECT nilairapor, predikat FROM tbnilairapor INNER JOIN tbsiswa USING(idsiswa) INNER JOIN tbthpel USING(idthpel) WHERE nis='$s[nis]' AND idmapel='$mp[idmapel]' AND nmthpel='$tahun' AND aspek='4'";
            if (cquery($sqlmot) > 0) {
                $mot = vquery($sqlmot)[0];
                $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValueByColumnAndRow($jmp * 4 + 6, $baris, $mot['nilairapor'])
                    ->setCellValueByColumnAndRow($jmp * 4 + 7, $baris, $mot['predikat']);
            }
            $jmp++;
        }
        $sqlavk = "SELECT AVG(nilairapor) as rata FROM tbnilairapor INNER JOIN tbsiswa USING(idsiswa) INNER JOIN tbthpel USING(idthpel) WHERE nis='$s[nis]' AND idmapel='$mp[idmapel]' AND nmthpel='$tahun' AND aspek='3' GROUP BY idsiswa, idthpel";
        if (cquery($sqlavk) > 0) {
            $avk = vquery($sqlavk)[0];
            $objPHPExcel->setActiveSheetIndex(0)
                ->setCellValueByColumnAndRow($jmp * 4 + 4, $baris, number_format($avk['rata'], 1, ',', '.'));
        }

        $sqlavm = "SELECT AVG(nilairapor) as rata FROM tbnilairapor INNER JOIN tbsiswa USING(idsiswa) INNER JOIN tbthpel USING(idthpel) WHERE nis='$s[nis]' AND idmapel='$mp[idmapel]' AND nmthpel='$tahun' AND aspek='4' GROUP BY idsiswa, idthpel";
        if (cquery($sqlavm)) {
            $avm = vquery($sqlavm)[0];
            $objPHPExcel->setActiveSheetIndex(0)
                ->setCellValueByColumnAndRow($jmp * 4 + 5, $baris, number_format($avm['rata'], 1, ',', '.'));
        }
        $sqlsp = "SELECT nilaisikap FROM tbnilaisikap INNER JOIN tbsiswa USING(idsiswa) INNER JOIN tbthpel USING(idthpel) WHERE nis='$s[nis]' AND nmthpel='$tahun' AND aspek='1'";
        if (cquery($sqlsp) > 0) {
            $sp = vquery($sqlsp)[0];
            $objPHPExcel->setActiveSheetIndex(0)
                ->setCellValueByColumnAndRow($jmp * 4 + 6, $baris, $sp['nilaisikap']);
        }

        $sqlso = "SELECT nilaisikap FROM tbnilaisikap INNER JOIN tbsiswa USING(idsiswa) INNER JOIN tbthpel USING(idthpel) WHERE nis='$s[nis]' AND nmthpel='$tahun' AND aspek='2'";
        if (cquery($sqlso) > 0) {
            $so = vquery($sqlso)[0];
            $objPHPExcel->setActiveSheetIndex(0)
                ->setCellValueByColumnAndRow($jmp * 4 + 7, $baris, $so['nilaisikap']);
        }

        $qabs = "SELECT sakit, izin,alpa FROM tbabsensi INNER JOIN tbsiswa s USING(idsiswa) INNER JOIN tbthpel tp USING (idthpel) WHERE s.nis='$s[nis]' AND tp.nmthpel='$tahun'";
        if (cquery($qabs) > 0) {
            $abs = vquery($qabs)[0];
            $objPHPExcel->setActiveSheetIndex(0)
                ->setCellValueByColumnAndRow($jmp * 4 + 8, $baris, $abs['sakit'])
                ->setCellValueByColumnAndRow($jmp * 4 + 9, $baris, $abs['izin'])
                ->setCellValueByColumnAndRow($jmp * 4 + 10, $baris, $abs['alpa']);
        }
        $qeks = getekskul();
        $jeks = 0;

        foreach ($qeks as $eks) {
            $qneks = "SELECT nr.nilaieks FROM tbnilaiekskul nr INNER JOIN tbsiswa s USING(idsiswa) INNER JOIN tbthpel tp USING (idthpel) WHERE nr.idekskul='$eks[idekskul]' AND s.nis='$s[nis]' AND tp.nmthpel='$tahun'";
            if (cquery($qneks)) {
                $neks = vquery($qneks)[0];
                $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValueByColumnAndRow($jmp * 4 + $jeks + 11, $baris, $neks['nilaieks']);
            }
            $jeks++;
        }
        $baris++;
    }
}

if (isset($_POST['downuas'])) {
    $data = getsiswa($_POST['klsuas'], $_POST['thnuas']);
    $thn = gettahun($_POST['thnuas']);
    $tahun = $thn['nmthpel'];
    $kls = getkelas($_POST['klsuas']);
    $namafile = 'ujian_' . $kls['idkelas'] . '_' . $thn['nmthpel'];

    $objPHPExcel = new PHPExcel();
    $objPHPExcel->getProperties()->setCreator("Kasworo Wardani")
        ->setTitle("Template")->setLastModifiedBy("Kasworo Wardani");
    $objPHPExcel->setActiveSheetIndex(0)
        ->setCellValue('A1', 'TEMPLATE INPUT NILAI UJIAN SEKOLAH')
        ->setCellValue('A2', strtoupper('Tahun Pelajaran ' . str_replace('-', ' Semester ', $thn['desthpel'])))
        ->setCellValue('A3', strtoupper($kls['nmkelas']))
        ->setCellValue('A5', 'No.')->setCellValue('A9', '(1)')
        ->setCellValue('B5', 'NIS')->setCellValue('B9', '(2)')
        ->setCellValue('C5', 'Nama Peserta Didik')->setCellValue('C9', '(3)')
        ->setCellValue('D5', 'Kode Tahun Pelajaran')->setCellValue('D9', '(4)')
        ->setCellValue('E5', 'Nilai Per Mata Pelajaran');
    $jmp = 0;
    $qmp = getmapel();
    foreach ($qmp as $mp) {
        $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValueByColumnAndRow($jmp * 2 + 4, 6, $mp['akmapel'])
            ->mergeCells(CellsToMergeByColsRow($jmp * 2 + 4, $jmp * 2 + 5, 6, 2))
            ->setCellValueByColumnAndRow($jmp * 2 + 4, 8, 'Peng')
            ->setCellValueByColumnAndRow($jmp * 2 + 5, 8, 'Ket')
            ->setCellValueByColumnAndRow($jmp * 2 + 4, 9, '(' . ($jmp * 2 + 5) . ')')
            ->setCellValueByColumnAndRow($jmp * 2 + 5, 9, '(' . ($jmp * 2 + 6) . ')');
        $jmp++;
    }
    $objPHPExcel->setActiveSheetIndex(0)
        ->mergeCells('A5:A8')->mergeCells('B5:B8')
        ->mergeCells('C5:C8')->mergeCells('D5:D8')
        ->setCellValueByColumnAndRow($jmp * 2 + 4, 5, 'Rata-rata')
        ->setCellValueByColumnAndRow($jmp * 2 + 4, 8, 'Peng')
        ->setCellValueByColumnAndRow($jmp * 2 + 4, 9, '(' . ($jmp * 4 + 5) . ')')
        ->setCellValueByColumnAndRow($jmp * 2 + 5, 8, 'Ket')
        ->setCellValueByColumnAndRow($jmp * 2 + 5, 9, '(' . ($jmp * 2 + 6) . ')')
        ->mergeCells(cellsToMergeByColsRow(4, ($jmp - 1) * 2 + 5, 5, 1))
        ->mergeCells(cellsToMergeByColsRow($jmp * 2 + 4, $jmp * 2 + 5, 5, 3));
    $baris = 10;
    $no = 0;
    foreach ($data as $s) {
        $no++;
        $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValueByColumnAndRow(0, $baris, $no)
            ->setCellValueByColumnAndRow(1, $baris, $s['nis'])
            ->setCellValueByColumnAndRow(2, $baris, $s['nmsiswa'])
            ->setCellValueByColumnAndRow(3, $baris, $tahun);
        $qmp = getmapel();
        $jmp = 0;
        foreach ($qmp as $mp) {
            $field = array('nilaius');
            $askog = array(
                'nis' => $s['nis'],
                'idmapel' => $mp['idmapel'],
                'nmthpel' => $tahun,
                'aspek' => '3'
            );
            $asmot = array(
                'nis' => $s['nis'],
                'idmapel' => $mp['idmapel'],
                'nmthpel' => $tahun,
                'aspek' => '4'
            );
            $sqlus0 = "SELECT nilaius FROM tbnilaius INNER JOIN tbsiswa USING(idsiswa) INNER JOIN tbthpel USING(idthpel) WHERE nis='$s[nis]' AND idmapel='$mp[idmapel]' AND nmthpel='$tahun' AND aspek='3'";
            $kog = vquery($sqls0);
            $objPHPExcel->setActiveSheetIndex(0)
                ->setCellValueByColumnAndRow($jmp * 2 + 4, $baris, $kog['nilaius']);
            $sqlus1 = "SELECT nilaius FROM tbnilaius INNER JOIN tbsiswa USING(idsiswa) INNER JOIN tbthpel USING(idthpel) WHERE nis='$s[nis]' AND idmapel='$mp[idmapel]' AND nmthpel='$tahun' AND aspek='4'";
            $s01 = vquery($sqlus1);
            $objPHPExcel->setActiveSheetIndex(0)
                ->setCellValueByColumnAndRow($jmp * 2 + 5, $baris, $mot['nilaius']);
            $jmp++;
        }
        $field = array('AVG(nilaius) as rata');
        $whkog = array(
            'nis' => $s['nis'],
            'idmapel' => $mp['idmapel'],
            'nmthpel' => $tahun,
            'aspek' => '3'
        );
        $whmot = array(
            'nis' => $s['nis'],
            'idmapel' => $mp['idmapel'],
            'nmthpel' => $tahun,
            'aspek' => '4'
        );
        $sqlsp = "SELECT AVG(nilaius) as rata FROM tbnilaius INNER JOIN tbsiswa USING(idsiswa) INNER JOIN tbthpel USING(idthpel) WHERE nis='$s[nis]' AND idmapel='$mp[idmapel]' AND nmthpel='$tahun' AND aspek='3' GROUP BY idsiswa, idthpel";
        $avk = vquery($sqlsp);

        $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValueByColumnAndRow($jmp * 2 + 4, $baris, number_format($avk['rata'], 1, ',', '.'));
        $sqlsp = "SELECT AVG(nilaius) as rata FROM tbnilaius INNER JOIN tbsiswa USING(idsiswa) INNER JOIN tbthpel USING(idthpel) WHERE nis='$s[nis]' AND idmapel='$mp[idmapel]' AND nmthpel='$tahun' AND aspek='4' GROUP BY idsiswa, idthpel";
        $avm = vquery($sqlsp);
        $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValueByColumnAndRow($jmp * 2 + 5, $baris, number_format($avm['rata'], 1, ',', '.'));
        $baris++;
    }
}

if (isset($_POST['ujian'])) {
    $data = getsiswa($_POST['kls2'], $_POST['thpel2']);
    $thn = gettahun($_POST['thpel2']);
    $tahun = $thn['nmthpel'];
    $kls = getkelas($_POST['kls2']);
    $namafile = 'ujian_' . $kls['idkelas'] . '_' . $thn['nmthpel'];

    $objPHPExcel = new PHPExcel();
    $objPHPExcel->getProperties()->setCreator("Kasworo Wardani")
        ->setTitle("Template")->setLastModifiedBy("Kasworo Wardani");
    $objPHPExcel->setActiveSheetIndex(0)
        ->setCellValue('A1', 'TEMPLATE INPUT NILAI UJIAN SEKOLAH')
        ->setCellValue('A2', strtoupper('Tahun Pelajaran ' . str_replace('-', ' Semester ', $thn['desthpel'])))
        ->setCellValue('A3', strtoupper($kls['nmkelas']))
        ->setCellValue('A5', 'No.')->setCellValue('A9', '(1)')
        ->setCellValue('B5', 'NIS')->setCellValue('B9', '(2)')
        ->setCellValue('C5', 'Nama Peserta Didik')->setCellValue('C9', '(3)')
        ->setCellValue('D5', 'Kode Tahun Pelajaran')->setCellValue('D9', '(4)')
        ->setCellValue('E5', 'Nilai Ujian Sekolah Per Mata Pelajaran');
    $jmp = 0;
    $qmp = getmapel();
    foreach ($qmp as $mp) {
        $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValueByColumnAndRow($jmp * 2 + 4, 6, $mp['akmapel'])
            ->mergeCells(CellsToMergeByColsRow($jmp * 2 + 4, $jmp * 2 + 5, 6, 2))
            ->setCellValueByColumnAndRow($jmp * 2 + 4, 8, 'Peng')
            ->setCellValueByColumnAndRow($jmp * 2 + 5, 8, 'Ket')
            ->setCellValueByColumnAndRow($jmp * 2 + 4, 9, '(' . ($jmp * 2 + 5) . ')')
            ->setCellValueByColumnAndRow($jmp * 2 + 5, 9, '(' . ($jmp * 2 + 6) . ')');
        $jmp++;
    }
    $objPHPExcel->setActiveSheetIndex(0)
        ->mergeCells('A5:A8')->mergeCells('B5:B8')
        ->mergeCells('C5:C8')->mergeCells('D5:D8')
        ->setCellValueByColumnAndRow($jmp * 2 + 4, 5, 'Rata-rata')
        ->setCellValueByColumnAndRow($jmp * 2 + 4, 8, 'Peng')
        ->setCellValueByColumnAndRow($jmp * 2 + 4, 9, '(' . ($jmp * 2 + 5) . ')')
        ->setCellValueByColumnAndRow($jmp * 2 + 5, 8, 'Ket')
        ->setCellValueByColumnAndRow($jmp * 2 + 5, 9, '(' . ($jmp * 2 + 6) . ')')
        ->mergeCells(cellsToMergeByColsRow(4, ($jmp - 1) * 2 + 5, 5, 1))
        ->mergeCells(cellsToMergeByColsRow($jmp * 2 + 4, $jmp * 2 + 5, 5, 3));
    $baris = 10;
    $no = 0;
    foreach ($data as $s) {
        $no++;
        $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValueByColumnAndRow(0, $baris, $no)
            ->setCellValueByColumnAndRow(1, $baris, $s['nis'])
            ->setCellValueByColumnAndRow(2, $baris, $s['nmsiswa'])
            ->setCellValueByColumnAndRow(3, $baris, $tahun);
        $qmp = getmapel();
        $jmp = 0;
        foreach ($qmp as $mp) {
            $sqlkog = "SELECT nilaius FROM tbnilaius INNER JOIN tbsiswa USING(idsiswa) INNER JOIN tbthpel USING(idthpel) WHERE nis='$s[nis]' AND idmapel='$mp[idmapel]' AND nmthpel='$tahun' AND aspek='3'";
            $kog = vquery($sqlkog);
            $objPHPExcel->setActiveSheetIndex(0)
                ->setCellValueByColumnAndRow($jmp * 2 + 4, $baris, $kog['nilaius']);

            $sqlmot = "SELECT nilaius FROM tbnilaius INNER JOIN tbsiswa USING(idsiswa) INNER JOIN tbthpel USING(idthpel) WHERE nis='$s[nis]' AND idmapel='$mp[idmapel]' AND nmthpel='$tahun' AND aspek='4'";
            $mot = vquery($sqlmot);
            $objPHPExcel->setActiveSheetIndex(0)
                ->setCellValueByColumnAndRow($jmp * 2 + 5, $baris, $mot['nilaius']);
            $jmp++;
        }
        $sqlsp = "SELECT AVG(nilaius) as rata FROM tbnilaius INNER JOIN tbsiswa USING(idsiswa) INNER JOIN tbthpel USING(idthpel) WHERE nis='$s[nis]' AND idmapel='$mp[idmapel]' AND nmthpel='$tahun' AND aspek='3' GROUP BY idsiswa, idthpel";
        $avk = vquery($sqlsp);
        $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValueByColumnAndRow($jmp * 2 + 4, $baris, number_format($avk['rata'], 1, ',', '.'));

        $sqlsp = "SELECT AVG(nilaius) as rata FROM tbnilaius INNER JOIN tbsiswa USING(idsiswa) INNER JOIN tbthpel USING(idthpel) WHERE nis='$s[nis]' AND idmapel='$mp[idmapel]' AND nmthpel='$tahun' AND aspek='4' GROUP BY idsiswa, idthpel";
        $avm = vquery($sqlsp);
        $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValueByColumnAndRow($jmp * 2 + 5, $baris, number_format($avm['rata'], 1, ',', '.'));
        $baris++;
    }
}

if (isset($_POST['downijz'])) {
    //var_dump($_POST['kls']);die;
    $data = getsiswa($_POST['klsijz'], $_POST['thnijz']);
    $thn = gettahun($_POST['thnijz']);
    $tahun = $thn['nmthpel'];
    $kls = getkelas($_POST['klsijz']);
    $namafile = 'ijazah_' . $kls['idkelas'] . '_' . $thn['nmthpel'];

    $objPHPExcel = new PHPExcel();
    $objPHPExcel->getProperties()->setCreator("Kasworo Wardani")
        ->setTitle("Template")->setLastModifiedBy("Kasworo Wardani");
    $objPHPExcel->setActiveSheetIndex(0)
        ->setCellValue('A1', 'TEMPLATE INPUT NILAI IJAZAH')
        ->setCellValue('A2', strtoupper('Tahun Pelajaran ' . str_replace('-', ' Semester ', $thn['desthpel'])))
        ->setCellValue('A3', strtoupper($kls['nmkelas']))
        ->setCellValue('A5', 'No.')->setCellValue('A9', '(1)')
        ->setCellValue('B5', 'NIS')->setCellValue('B9', '(2)')
        ->setCellValue('C5', 'Nama Peserta Didik')->setCellValue('C9', '(3)')
        ->setCellValue('D5', 'Kode Tahun Pelajaran')->setCellValue('D9', '(4)')
        ->setCellValue('E5', 'Nilai Ijazah Per Mata Pelajaran');
    $jmp = 0;
    $qmp = getmapel();
    foreach ($qmp as $mp) {
        $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValueByColumnAndRow($jmp + 4, 7, $mp['akmapel'])
            ->mergeCells(CellsToMergeByColsRow($jmp + 4, $jmp + 4, 7, 2))
            ->setCellValueByColumnAndRow($jmp + 4, 9, '(' . ($jmp + 5) . ')');
        $jmp++;
    }
    $objPHPExcel->setActiveSheetIndex(0)
        ->mergeCells('A5:A8')->mergeCells('B5:B8')
        ->mergeCells('C5:C8')->mergeCells('D5:D8')
        ->setCellValueByColumnAndRow($jmp + 4, 5, 'Rata-rata')
        ->setCellValueByColumnAndRow($jmp + 4, 9, '(' . ($jmp + 5) . ')')
        ->mergeCells(cellsToMergeByColsRow(4, ($jmp - 1) + 4, 5, 2))
        ->mergeCells(cellsToMergeByColsRow($jmp + 4, $jmp + 4, 5, 4));
    $baris = 10;
    $no = 0;
    foreach ($data as $s) {
        $no++;
        $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValueByColumnAndRow(0, $baris, $no)
            ->setCellValueByColumnAndRow(1, $baris, $s['nis'])
            ->setCellValueByColumnAndRow(2, $baris, $s['nmsiswa'])
            ->setCellValueByColumnAndRow(3, $baris, $tahun);
        $qmp = getmapel();
        $jmp = 0;
        foreach ($qmp as $mp) {
            $sqlijz = "SELECT AVG(nilaiijz) as rata FROM tbnilaiijz INNER JOIN tbsiswa USING(idsiswa) INNER JOIN tbthpel USING(idthpel) WHERE nis='$s[nis]' AND idmapel='$mp[idmapel]' AND nmthpel='$tahun' GROUP BY idsiswa, idthpel";
            $kog = vquery($sqlijz);
            $objPHPExcel->setActiveSheetIndex(0)
                ->setCellValueByColumnAndRow($jmp + 4, $baris, $kog['nilaiijz']);

            $jmp++;
        }
        $sqlijz = "SELECT AVG(nilaiijz) as rata FROM tbnilaiijz INNER JOIN tbsiswa USING(idsiswa) INNER JOIN tbthpel USING(idthpel) WHERE nis='$s[nis]' AND idmapel='$mp[idmapel]' AND nmthpel='$tahun' GROUP BY idsiswa, idthpel";
        $avk = vquery($sqlijz);
        $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValueByColumnAndRow($jmp + 4, $baris, number_format($avk['rata'], 1, ',', '.'));

        $baris++;
    }
}

$semua = $baris - 1;
$objPHPExcel->getActiveSheet()->freezePane("A10");
$objPHPExcel->getActiveSheet()->getStyle('A5:' . $objPHPExcel
    ->getActiveSheet()->getHighestColumn() . '9')->getAlignment()->setWrapText(true);
$objPHPExcel->setActiveSheetIndex()->getStyle('A5:' . $objPHPExcel
    ->getActiveSheet()->getHighestColumn() . '9')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);

$center = array();
$center['alignment'] = array();
$center['alignment']['horizontal'] = PHPExcel_Style_Alignment::HORIZONTAL_CENTER;
$objPHPExcel->setActiveSheetIndex()->getStyle('A5:' . $objPHPExcel->getActiveSheet()->getHighestColumn() . '9')->applyFromArray($center);

$objPHPExcel->setActiveSheetIndex()->getStyle("A10:B" . $objPHPExcel->getActiveSheet()->getHighestRow())->applyFromArray($center);
$objPHPExcel->setActiveSheetIndex()->getStyle("D10:" . $objPHPExcel->getActiveSheet()->getHighestColumn() . $objPHPExcel->getActiveSheet()->getHighestRow())->applyFromArray($center);

$thick = array();
$thick['borders'] = array();
$thick['borders']['allborders'] = array();
$thick['borders']['allborders']['style'] = PHPExcel_Style_Border::BORDER_THIN;
$objPHPExcel->setActiveSheetIndex()->getStyle('A1:' . $objPHPExcel->getActiveSheet()->getHighestColumn() . $objPHPExcel->getActiveSheet()->getHighestRow())->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
$objPHPExcel->setActiveSheetIndex()->getStyle('A5:' . $objPHPExcel->getActiveSheet()->getHighestColumn() . $objPHPExcel->getActiveSheet()->getHighestRow())->applyFromArray($thick);
$objPHPExcel->getActiveSheet()->setTitle($namafile);
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="' . $namafile . '.xls"');
header('Cache-Control: max-age=0');
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$objWriter->save('php://output');
exit;
