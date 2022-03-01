<?php
if (isset($_POST['upload'])) {
    require_once 'assets/library/PHPExcel.php';
    require_once 'assets/library/excel_reader.php';
    if (empty($_FILES['filecatat']['tmp_name'])) {
        echo "<script>
				$(function() {
					toastr.error('File Template Kosong!','Mohon Maaf!',{
						timeOut:1000,
						fadeOut:1000
					});
				});
			</script>";
    } else {
        $data = new Spreadsheet_Excel_Reader($_FILES['filecatat']['tmp_name']);
        $baris = $data->rowcount($sheet_index = 0);
        $isidata = $baris - 5;
        $sukses = 0;
        $gagal = 0;
        $update = 0;
        $batal = 0;
        for ($i = 6; $i <= $baris; $i++) {
            $xnis = $data->val($i, 2);
            $xnisn = $data->val($i, 3);
            $xnmsiswa = $data->val($i, 4);
            $xtglcatat = $data->val($i, 5);
            $xisicatat = $data->val($i, 6);
            $xkdtahun = $data->val($i, 7);
            $ds = viewdata('tbsiswa', array('nis' => $xnis, 'nisn' => $xnisn))[0];
            $idsiswa = $ds['idsiswa'];
            $dt = viewdata('tbthpel', array('nmthpel' => $xkdtahun))[0];
            $idthpel = $dt['idthpel'];
            $sqlcek = "SELECT idsiswa FROM tbakhirtahun INNER JOIN tbsiswa USING(idsiswa) INNER JOIN tbthpel USING(idthpel) WHERE nis='$xnis' AND nmthpel='$xkdtahun'";
            if (cquery($sqlcek) == 0) {
                $datane = array(
                    'idsiswa'   => $idsiswa,
                    'tglcatatan'  => $xtglcatat,
                    'catatan'   => $xisicatat,
                    'idthpel' => $idthpel
                );
                $baru = adddata('tbakhirtahun', $datane);
                if ($baru > 0) {
                    echo "<script>
                        $(function() {
                            toastr.success('Tambah Riwayat Pendidikan Siswa Berhasil!', 'Terima Kasih...', {
                                timeOut: 3000,
                                fadeOut: 3000
                            });
                        });
                        </script>";
                } else {
                    echo "<script>
                        $(function() {
                            toastr.error('Tambah Riwayat Pendidikan Siswa Gagal!', 'Mohon Maaf...', {
                                timeOut: 3000,
                                fadeOut: 3000
                            });
                        });
                        </script>";
                }
            } else {
                $key = array(
                    'idsiswa' => $idsiswa,
                    'idthpel' => $idthpel
                );
                $datane = array(
                    'tglcatatan'  => $xtglcatat,
                    'catatan'   => $xisicatat
                );
                $update = editdata('tbakhirtahun', $datane, '', $key);
                if ($update > 0) {
                    echo "<script>
                        $(function() {
                            toastr.success('Ubah Riwayat Pendidikan Siswa Berhasil!', 'Terima Kasih...', {
                                timeOut: 3000,
                                fadeOut: 3000
                            });
                        });
                        </script>";
                } else {
                    echo "<script>
                        $(function() {
                            toastr.error('Ubah Riwayat Pendidikan Siswa Gagal!', 'Mohon Maaf...', {
                                timeOut: 3000,
                                fadeOut: 3000
                            });
                        });
                    </script>";
                }
            }
        }
    }
}

if (isset($_POST['simpan'])) {
    $key = array(
        'idsiswa' => $_POST['idsiswa'],
        'idthpel' => $_POST['idthpel']
    );
    $ceks = cekdata('tbakhirtahun', $key);
    if ($ceks == 0) {
        $data = array(
            'idsiswa' => $_POST['idsiswa'],
            'idthpel' => $_POST['idthpel'],
            'tglcatatan' => $_POST['tglcatat'],
            'catatan' => $_POST['isicatat']
        );
        $baru = adddata('tbakhirtahun', $data);
        if ($baru > 0) {
            echo "<script>
            $(function() {
                toastr.success('Keputusan Akhir Tahun Berhasil Disimpan!', 'Terima Kasih...', {
                    timeOut: 3000,
                    fadeOut: 3000
                });
            });
            </script>";
        } else {
            echo "<script>
            $(function() {
                toastr.error('Keputusan Akhir Tahun Gagal Disimpan!', 'Mohon Maaf...', {
                    timeOut: 3000,
                    fadeOut: 3000
                });
            });
            </script>";
        }
    } else {
        $data = array(
            'idsiswa' => $_POST['idsiswa'],
            'idthpel' => $_POST['idthpel'],
            'tglcatatan' => $_POST['tglcatat'],
            'catatan' => $_POST['isicatat']
        );
        $update = editdata('tbakhirtahun', $data, '', $key);
        if ($update > 0) {
            echo "<script>
            $(function() {
                toastr.success('Keputusan Akhir Tahun Berhasil Diupdate!', 'Terima Kasih...', {
                    timeOut: 3000,
                    fadeOut: 3000
                });
            });
            </script>";
        } else {
            echo "<script>
            $(function() {
                toastr.error('Keputusan Akhir Tahun Gagal Diupdate!', 'Mohon Maaf...', {
                    timeOut: 1000,
                    fadeOut: 3000
                    }
                });
            });
            </script>";
        }
    }
}
?>
<div class="modal fade" id="myImportCatatan" aria-modal="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST" enctype="multipart/form-data" action="">
                <div class="modal-header">
                    <h5 class="modal-title">Import Catatan Akhir Tahun</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="col-sm-12">
                        <div class="row">
                            <label for="filecatat">Pilih File Template</label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input file" id="filecatat" name="filecatat">
                                <label class="custom-file-label" for="filecatat">Pilih file</label>
                            </div>
                            <p style="color:red;margin-top:10px"><em>Hanya mendukung file *.xls (Microsoft Excel 97-2003)</em></p>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <a href="rapor_catatantmp.php" class="btn btn-success btn-sm" target="_blank">
                        <i class="fas fa-download"></i>&nbsp;Download
                    </a>
                    <button type="submit" name="upload" class="btn btn-primary btn-sm">
                        <i class="fas fa-upload"></i>&nbsp;Upload
                    </button>
                    <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal"><i class="fas fa-power-off"></i> Tutup</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="myCatatan" aria-modal="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form method="POST" action="">
                <div class="modal-body">
                    <div class="form-group row mb-2">
                        <label class="col-sm-5 ml-2">Nama Siswa</label>
                        <input type="hidden" class="form-control form-control-sm col-sm-6" name="idsiswa" id="idsiswa">
                        <input class="form-control form-control-sm col-sm-6" name="nmsiswa" id="nmsiswa" disabled>
                    </div>
                    <div class="form-group row mb-2">
                        <label class="col-sm-5 ml-2">Tahun Pelajaran</label>
                        <select class="form-control form-control-sm col-sm-6" name="idthpel" id="idthpel">
                            <option value="">..Pilih..</option>
                            <?php
                            $qth = viewdata('tbthpel');
                            foreach ($qth as $th) :
                            ?>
                                <option value="<?php echo $th['idthpel']; ?>"><?php echo $th['desthpel']; ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>
                    <div class="form-group row mb-2">
                        <label class="col-sm-5 ml-2">Tanggal</label>
                        <input class="form-control form-control-sm col-sm-6" name="tglcatat" id="tglcatat">
                    </div>
                    <div class="form-group row mb-2">
                        <label class="col-sm-5 ml-2">Keputusan</label>
                        <textarea class="form-control form-control-sm col-sm-6" name="isicatat" id="isicatat"></textarea>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="submit" class="btn btn-success col-4" id="simpan" name="simpan">
                    </button>
                    <button type="button" class="btn btn-danger col-4" data-dismiss="modal">
                        <i class="fas fa-power-off"></i> Tutup
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="alert alert-warning">
    <p><strong>Petunjuk:</strong></p>
    <p>Silahkan isikan data Nilai yang diperoleh tiap semester.<br />Nilai Akan tersimpan
        otomatis jika kursor keluar dari kotak isian, setelah selesai melakukan pengisian klik tombol
        <strong>Refresh</strong>
    </p>
</div>
<div class="card card-primary card-outline">
    <div class="card-header">
        <h5 class="card-title m-0">Keputusan Akhir Tahun Periode <?php echo $tapel; ?> </h5>
        <div class="card-tools">
            <button class="btn btn-success btn-sm" data-target="#myImportCatatan" data-toggle="modal">
                <i class="fas fa-cloud-upload-alt"></i>&nbsp;Import
            </button>
        </div>
    </div>
    <div class="card-body">
        <table id="tb_catatan" class="table table-bordered table-striped table-sm">
            <thead>
                <tr>
                    <th style="text-align: center;width:2.5%">No.</th>
                    <th style="text-align: center;width:15%">Nomor Induk</th>
                    <th style="text-align: center;width:27.5%">Nama Peserta Didik</th>
                    <th style="text-align: center;width:15%">Tanggal</th>
                    <th style=" text-align: center;">Keputusan</th>
                    <th style="text-align: center;width:12.5%">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT s.idsiswa, s.nis, s.nisn, s.nmsiswa FROM tbsiswa s INNER JOIN tbregistrasi rs USING(idsiswa) INNER JOIN tbregistrasi_detil rd USING(idreg) INNER JOIN tbthpel tp USING(idthpel) WHERE s.deleted='0' AND tp.aktif='1' ORDER BY s.nis";
                $qs = vquery($sql);
                $no = 0;
                foreach ($qs as $s) :
                    $no++;
                    $qctt = "SELECT tglcatatan, catatan FROM tbakhirtahun INNER JOIN tbthpel USING(idthpel) WHERE aktif='1' AND idsiswa='$s[idsiswa]'";
                    if (cquery($qctt) > 0) {
                        $dc = vquery($qctt)[0];
                        $tglcatat = indonesian_date($dc['tglcatatan']);
                        $isicatat = $dc['catatan'];
                    } else {
                        $tglcatat = '';
                        $isicatat = '';
                    }


                ?>
                    <tr>
                        <td style="text-align:center"><?php echo $no . '.'; ?></td>
                        <td style="text-align:center"><?php echo $s['nis'] . ' / ' . $s['nisn']; ?></td>
                        <td title="<?php echo $s['idsiswa']; ?>">
                            <?php echo ucwords(strtolower($s['nmsiswa'])); ?>
                        </td>
                        <td style="text-align:center"><?php echo $tglcatat; ?></td>
                        <td style="text-align:center"><?php echo $isicatat; ?></td>
                        <td style="text-align:center">
                            <button data-id="<?php echo $s['idsiswa']; ?>" class="btn btn-xs btn-secondary btnIsiCatat" data-toggle="modal" data-target="#myCatatan">
                                <i class="fas fa-edit" aria-hidden="true"></i>&nbsp;Lengkapi
                            </button>
                        </td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>
</div>
<script type="text/javascript">
    $(function() {
        $('#tb_catatan').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": true,
            "ordering": false,
            "info": false,
            "autoWidth": false,
            "responsive": true,
        });
    });
    $(".btnIsiCatat").click(function(e) {
        e.preventDefault();
        let id = $(this).data('id');
        $.ajax({
            url: "siswa_riwayat.php",
            type: "POST",
            dataType: 'json',
            data: "id=" + id + "&d=5",
            success: function(data) {
                $(".modal-title").html(data.judul);
                $("#simpan").html(data.tmbl);
                $("#nmsiswa").val(data.nama);
                $("#idthpel").val(data.idthpel);
                $("#tglcatat").val(data.tglcatatan);
                $("#isicatat").val(data.isicatatan);
                if (data.idsiswa == '') {
                    $("#idsiswa").val(id);
                } else {
                    $("#idsiswa").val(data.idsiswa);
                }
            }
        })
    });
    $(document).ready(function() {
        $(function() {
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-center',
                showConfirmButton: false,
                timer: 3000
            });
        })
    })
</script>