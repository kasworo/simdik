<?php
	if($_GET['d']=='1'){$aspek='Sikap Spiritual';}
	if($_GET['d']=='2'){$aspek='Sikap Spiritual';}
	if($_GET['d']=='3'){$aspek='Pengetahuan';}
	if($_GET['d']=='4'){$aspek='Keterampilan';}  
?>
<div class="modal fade" id="myImportNilai" aria-modal="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST" enctype="multipart/form-data" action="">
                <div class="modal-header">
                    <h5 class="modal-title">Import Nilai <?php echo $aspek;?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="col-sm-12">
                        <div class="row">
                            <label for="filerapor">Pilih File Template</label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input file" id="filerapor" name="filerapor">
                                <label class="custom-file-label" for="filerapor">Pilih file</label>
                            </div>
                            <p style="color:red;margin-top:10px"><em>Hanya mendukung file *.xls (Microsoft Excel
                                    97-2003)</em></p>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <a href="rapor_template.php?d=<?php echo $_GET['d'];?>" class="btn btn-success btn-sm btn-flat"
                        target="_blank"><i class="fas fa-download"></i> Download</a>
                    <button type="submit" name="upload" class="btn btn-primary btn-sm btn-flat">
                        <i class="fas fa-upload"></i>&nbsp;Upload
                    </button>
                    <button type="button" class="btn btn-danger btn-sm btn-flat" data-dismiss="modal"><i
                            class="fas fa-power-off"></i> Tutup</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="col-sm-12">
    <div class="alert alert-warning">
        <p><strong>Petunjuk:</strong></p>
        <p>Silahkan isikan data Nilai <?php echo $aspek;?> yang diperoleh tiap semester.<br />Nilai Akan tersimpan
            otomatis jika kursor keluar dari kotak isian, setelah selesai melakukan pengisian klik tombol
            <strong>Refresh</strong>
        </p>
    </div>
    <div class="card card-primary card-outline">
        <div class="card-header">
            <h5 class="card-title m-0">Data Nilai <?php echo $aspek;?></h5>
            <div class="card-tools">
                <button class="btn btn-flat btn-success btn-sm" data-target="#myImportNilai" data-toggle="modal">
                    <i class="fas fa-cloud-upload-alt"></i>&nbsp;Import
                </button>
            </div>
        </div>
        <div class="card-body">
            <table id="tb_rombel" class="table table-bordered table-striped table-sm">
                <thead>
                    <tr>
                        <th style="text-align: center;width:2.5%">No.</th>
                        <th style="text-align: center;width:20%">Nomor Induk</th>
                        <th style="text-align: center;">Nama Peserta Didik</th>
                        <th style="text-align: center;width:10%">Nilai</th>
                        <th style="text-align: center;width:20%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
						$sql="SELECT s.idsiswa, s.nis, s.nisn, s.nmsiswa FROM tbsiswa s INNER JOIN tbregistrasi rs USING(idsiswa) INNER JOIN tbkelas k USING(idkelas) INNER JOIN tbthpel tp USING(idthpel) WHERE s.deleted='0' AND tp.aktif='1'";
                        //var_dump($sql);
						$qs=vquery($sql);
						$no=0;
						foreach($qs as $s):
			        	$no++;
					?>
                    <tr>
                        <td style="text-align:center"><?php echo $no.'.';?></td>
                        <td style="text-align:center"><?php echo $s['nis'].' / '.$s['nisn'];?></td>
                        <td title="<?php echo $s['idsiswa'];?>">
                            <?php echo ucwords(strtolower($s['nmsiswa']));?>
                        </td>
                        <td style="text-align:center">
                        </td>
                        <td style="text-align:center">
                            <button data-id="<?php echo $s['idsiswa'];?>" class="btn btn-xs btn-info btn-flat btnInput">
                                <i class="fas fa-edit" aria-hidden="true"></i>&nbsp;Detail
                            </button>
                            <button data-id="<?php echo $s['idsiswa'];?>"
                                class="btn btn-xs btn-success btn-flat btnInput">
                                <i class="fas fa-edit" aria-hidden="true"></i>&nbsp;Input
                            </button>
                        </td>
                    </tr>
                    <?php endforeach?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<script type="text/javascript">
function validAngka(a) {
    if (!/^[0-9.]+$/.test(a.value)) {
        a.value = a.value.substring(0, a.value.length - 1000);
    }
}
$(".btnInput").click(function() {
    var id = $(this).data('id');
    var as = "<?php echo $_GET['d'];?>";
    if (as == '1' || as == '2') {
        window.location.href = "index.php?p=inputsikap&id=" + id
    } else if (as == '3') {
        window.location.href = "index.php?p=inputkognetif&id=" + id
    } else if (as == '4') {
        window.location.href = "index.php?p=inputterampil&id=" + id
    }
})
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