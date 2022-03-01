<?php
$idsiswa = $_GET['id'];
$ds = viewdata('tbsiswa', array('idsiswa' => $_GET['id']))[0];
$namasiswa = ucwords(strtolower($ds['nmsiswa']));

if (isset($_POST['kognetif'])) {
    $rows = isset($_POST['mapel']) ? $_POST['mapel'] : 1;
    $i = 0;
    $gagal = 0;
    $tambah = 0;
    $edit = 0;
    $batal = 0;
    foreach ($rows as $row) {
        $key = array(
            'idsiswa' => $idsiswa,
            'idthpel' => $_POST['thpel'],
            'idmapel' => $_POST['mapel'][$i],
            'aspek' => '3'
        );
        $ceknilai = cekdata('tbnilairapor', $key);
        if ($ceknilai > 0) {
            $nilai = array(
                'nilairapor' => $_POST['nilai'][$i],
                'predikat' => $_POST['predikat'][$i],
                'deskripsi' => $_POST['deskripsi'][$i]
            );
            $editnilai = editdata('tbnilairapor', $nilai, '', $key);
            if ($editnilai > 0) {
                $edit++;
            } else {
                $batal++;
            }
        } else {
            $nilai = array(
                'idsiswa' => $idsiswa,
                'idthpel' => $_POST['thpel'],
                'idmapel' => $_POST['mapel'][$i],
                'nilairapor' => $_POST['nilai'][$i],
                'predikat' => $_POST['predikat'][$i],
                'deskripsi' => $_POST['deskripsi'][$i],
                'aspek' => '3',
            );
            $tambahnilai = adddata('tbnilairapor', $nilai);
            if ($tambahnilai > 0) {
                $tambah++;
            } else {
                $gagal++;
            }
        }
        $i++;
    }
    if ($tambah > 0 || $edit > 0) {
        echo "<script>
					$(function() {
						toastr.info('Ada " . $tambah . " data ditambah, " . $edit . " data diupdate, " . $gagal . " data gagal ditambahkan, " . $batal . " data gagal diupdate!','Terima Kasih',{
						timeOut:2000,
						fadeOut:2000
					});
				});
			</script>";
    } else {
        echo "<script>
					$(function() {
						toastr.error('Tidak ada data yang berhasil ditambahkan atau diupdate!','Mohon Maaf',{
						timeOut:2000,
						fadeOut:2000
					});
				});
			</script>";
    }
}
?>
<div class="alert alert-danger">
    <p><strong>Petunjuk:</strong></p>
    <p>Silahkan pilih Tahun Pelajaran, kemudian isikan nilai lengkap dengan deskripsinya.<br />Nilai
        Akan tersimpan otomatis jika kursor keluar dari kotak isian, setelah selesai melakukan pengisian
        klik tombol <strong>Refresh</strong></p>
</div>
<div class="card card-primary card-outline">
    <div class="card-header">
        <h5 class="card-title m-0" id="judul">Nilai Ijazah a.n <?php echo $namasiswa; ?></h5>
        <div class="card-tools">
            <a href="index.php?p=nilaiijz" class="btn btn-sm btn-danger">
                <i class="fas fa-arrow-circle-left"></i>
                <span>&nbsp;Kembali</span>
            </a>
            <a href="index.php?p=inputijz&id=<?php echo $idsiswa; ?>" class="btn btn-sm btn-success">
                <i class="fas fa-edit"></i>
                <span>&nbsp;Input</span>
            </a>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive" id="datane">
            <table class="table table-bordered table-condensed table-striped table-sm" id="tbnilai">
                <thead>
                    <tr>
                        <th style="text-align:center;width:5%">No</th>
                        <th style="text-align:center">Mata Pelajaran</th>
                        <th style="text-align:center;width:15%">Nilai</th>
                        <th style="text-align:center;width:15%">Keterangan</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 0;
                    $qmp = viewdata('tbmapel');
                    foreach ($qmp as $mp) :
                        $no++;
                        $sql = "SELECT ijz.* FROM tbnilaiijz ijz LEFT JOIN tbthpel tp USING(idthpel) WHERE idmapel='$mp[idmapel]' AND idsiswa='$_GET[id]' AND tp.aktif='1'";
                        $dn = vquery($sql)[0];
                    ?>
                        <tr>
                            <td style="text-align:center;"><?php echo $no . '.'; ?></td>
                            <td><?php echo $mp['nmmapel']; ?></td>
                            <td style="vertical-align: middle;text-align:center">
                                <?php
                                echo round($dn['nilaiijz'], 0);
                                ?>
                            </td>
                            <td style="vertical-align: middle;">
                                <?php
                                echo '';
                                ?>
                            </td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
</div>