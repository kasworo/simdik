<?php
require_once 'assets/library/PHPExcel.php';
require_once 'assets/library/excel_reader.php';
if (isset($_POST['upload'])) {
    if (empty($_FILES['filetmp']['tmp_name'])) {
        echo "<script>
				$(function() {
					toastr.error('File Template Kosong!','Mohon Maaf!',{
						timeOut:1000,
						fadeOut:1000
					});
				});
			</script>";
    } else {
        $data = new Spreadsheet_Excel_Reader($_FILES['filetmp']['tmp_name']);
        $baris = $data->rowcount($sheet_index = 0);
        $isidata = $baris - 5;
        $sukses = 0;
        $gagal = 0;
        $update = 0;
        $batal = 0;
        $idskul = getskul();
        for ($i = 6; $i <= $baris; $i++) {
            $xnis = $data->val($i, 2);
            $xnisn = $data->val($i, 3);
            $xnmsiswa = $data->val($i, 4);
            $xtglak = $data->val($i, 5);
            $xnoijz = $data->val($i, 6);
            $xtglijz = $data->val($i, 7);
            $xlanjut = $data->val($i, 8);
            $xslta = $data->val($i, 9);
        }
    }
}

if (isset($_POST['simpan'])) {
    $ceks = cekdata('tblulusan', array('idsiswa' => $_POST['idsiswa']));
    if ($ceks == 0) {
        $data = array(
            'idsiswa'   => $_POST['idsiswa'],
            'tgllulus'  => $_POST['tgllulus'],
            'noijazah'   => $_POST['noijazah'],
            'tglijazah'  => $_POST['tglijazah'],
            'lanjut'    => $_POST['lanjut'],
            'nmslta'  => $_POST['nmslta'],
        );
        $baru = adddata('tblulusan', $data);
        if ($baru > 0) {
            echo "<script>
				$(function() {
					toastr.success('Tambah Riwayat Pendidikan Siswa Berhasil!', 'Terima Kasih...', {
						timeOut: 1000,
						fadeOut: 1000,
						onHidden: function() {
							$('#myLulusPD').hide();
						}
					});
				});
				</script>";
        } else {
            echo "<script>
				$(function() {
					toastr.error('Tambah Riwayat Pendidikan Siswa Gagal!', 'Mohon Maaf...', {
						timeOut: 1000,
						fadeOut: 1000,
						onHidden: function() {
							$('#myLulusPD').hide();
						}
					});
				});
				</script>";
        }
    } else {
        $data = array(
            'tgllulus'  => $_POST['tgllulus'],
            'noijazah'   => $_POST['noijazah'],
            'tglijazah'  => $_POST['tglijazah'],
            'lanjut'    => $_POST['lanjut'],
            'nmslta'  => $_POST['nmslta'],
        );
        $update = editdata('tblulusan', $data, '', array('idsiswa' => $_POST['idsiswa']));
        if ($update > 0) {
            echo "<script>
				$(function() {
					toastr.success('Ubah Riwayat Pendidikan Siswa Berhasil!', 'Terima Kasih...', {
						timeOut: 1000,
						fadeOut: 1000,
						onHidden: function() {
							$('#myLulusPD').hide();
						}
					});
				});
				</script>";
        } else {
            echo "<script>
				$(function() {
					toastr.error('Ubah Riwayat Pendidikan Siswa Gagal!', 'Mohon Maaf...', {
						timeOut: 1000,
						fadeOut: 1000,
						onHidden: function() {
							$('#myLulusPD').hide();
						}
					});
				});
				</script>";
        }
    }
}
?>
<div class="modal fade" id="myImportLulus" aria-modal="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST" enctype="multipart/form-data" action="">
                <div class="modal-header">
                    <h5 class="modal-title">Import Riwayat Sekolah</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="col-sm-12">
                        <div class="row">
                            <label for="filerwy">Pilih File Template</label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input file" id="filerwy" name="filerwy">
                                <label class="custom-file-label" for="filerwy">Pilih file</label>
                            </div>
                            <p style="color:red;margin-top:10px"><em>Hanya mendukung file *.xls (Microsoft Excel
                                    97-2003)</em></p>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <a href="siswa_rwytmp.php?d=2" class="btn btn-success btn-sm btn-flat" target="_blank">
                        <i class="fas fa-download"></i> Download
                    </a>
                    <button type="submit" name="upload" class="btn btn-primary btn-sm btn-flat">
                        <i class="fas fa-upload"></i>&nbsp;Upload
                    </button>
                    <button type="button" class="btn btn-danger btn-sm btn-flat" data-dismiss="modal">
                        <i class="fas fa-power-off"></i> Tutup
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="myLulusPD" aria-modal="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Riwayat lulusan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form method="POST" action="">
                <div class="modal-body">
                    <div class="form-group row mb-2">
                        <input type="hidden" class="form-control form-control-sm col-sm-6" name="idsiswa" id="idsiswa">
                        <label class="col-sm-5 ml-2">Tanggal Lulus</label>
                        <input class="form-control form-control-sm col-sm-6" name="tgllulus" id="tgllulus">
                    </div>
                    <div class="form-group row mb-2">
                        <label class="col-sm-5 ml-2">Nomor Seri Ijazah</label>
                        <input class="form-control form-control-sm col-sm-6" name="noijazah" id="noijazah">
                    </div>
                    <div class="form-group row mb-2">
                        <label class="col-sm-5 ml-2">Tanggal Ijazah</label>
                        <input class="form-control form-control-sm col-sm-6" name="tglijazah" id="tglijazah">
                    </div>
                    <div class="form-group row mb-2">
                        <label class="col-sm-5 ml-2">Melanjutkan</label>
                        <select class="form-control form-control-sm col-sm-6" name="lanjut" id="lanjut">
                            <option value="">..Pilih..</option>
                            <option value="1">Ya</option>
                            <option value="0">Tidak</option>
                        </select>
                    </div>
                    <div class="form-group row mb-2">
                        <label class="col-sm-5 ml-2">Nama Sekolah</label>
                        <input class="form-control form-control-sm col-sm-6" name="nmslta" id="nmslta">
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="submit" class="btn btn-success col-4" id="simpan" name="simpan">
                        <i class="fas fa-save"></i> Simpan
                    </button>
                    <button type="button" class="btn btn-danger col-4" data-dismiss="modal">
                        <i class="fas fa-power-off"></i> Tutup
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="card card-secondary card-outline">
    <div class="card-header">
        <h4 class="card-title">Data Peserta Didik Tingkat Akhir</h4>
        <div class="card-tools">
            <form action="" method="post">
                <button type="submit" class="btn btn-info btn-sm" id="btnTambah" name="lulus">
                    <i class="fas fa-plus-circle"></i>&nbsp;Tambah
                </button>
                <button class="btn btn-secondary btn-sm" data-toggle="modal" data-target="#myImportLulus">
                    <i class="fas fa-cloud-upload-alt"></i>&nbsp;Import
                </button>
            </form>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table id="tb_siswa" class="table table-bordered table-striped table-sm">
                <thead>
                    <tr>
                        <th style="text-align: center;width:2.5%">No.</th>
                        <th style="text-align: center;">Nama Peserta Didik</th>
                        <th style="text-align: center;width:17.5%">NIS / NISN</th>
                        <th style="text-align: center;width:15%">Tanggal</th>
                        <th style="text-align: center;width:27.5%">Alasan</th>
                        <th style="text-align: center;width:12.5%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = "SELECT s.idsiswa, s.nis, s.nisn, s.nmsiswa FROM tbsiswa s INNER JOIN tbregistrasi r USING(idsiswa) INNER JOIN tbthpel t USING(idthpel) WHERE r.idjreg='7'";
                    $qs = vquery($sql);
                    $no = 0;
                    foreach ($qs as $s) {
                        $no++;
                    ?>
                        <tr>
                            <td style="text-align:center"><?php echo $no . '.'; ?></td>
                            <td title="<?php echo $s['idsiswa']; ?>">
                                <?php echo ucwords(strtolower($s['nmsiswa'])); ?>
                            </td>
                            <td><?php echo $s['nis'] . ' / ' . $s['nisn']; ?></td>
                            <td style="text-align:center"></td>
                            <td style="text-align:center"></td>
                            <td style="text-align: center">
                                <button class="btn btn-xs btn-success btnLulus" data-id="<?php echo $s['idsiswa']; ?>" data-toggle="modal" data-target="#myLulusPD">
                                    <i class="fas fa-sign-out-alt"></i>&nbsp;Lengkapi
                                </button>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(function() {
        $('#tb_siswa').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": true,
            "ordering": false,
            "info": false,
            "autoWidth": false,
            "responsive": true,
        });
    });

    $(".btnLulus").click(function(e) {
        e.preventDefault();
        let id = $(this).data('id');
        $.ajax({
            url: "siswa_riwayat.php",
            type: "POST",
            dataType: 'json',
            data: "id=" + id + "&d=3",
            success: function(data) {
                $(".modal-title").html(data.judul);
                $("#simpan").html(data.tmbl);
                $("#tgllulus").val(data.tgllulus);
                $("#nmslta").val(data.nmslta);
                $("#noijazah").val(data.noijazah);
                $("#tglijazah").val(data.tglijazah);
                $("#lanjut").val(data.lanjut);
                if (data.idsiswa == '') {
                    $("#idsiswa").val(id);
                } else {
                    $("#idsiswa").val(data.idsiswa);
                }
            }
        })
    });
</script>