<div class="modal fade" id="myImportUS" aria-modal="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="?p=nilaius&d=1" method="POST" enctype="multipart/form-data">
                <div class="modal-header">
                    <h5 class="modal-title">Import Nilai Ujian Sekolah</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="col-sm-12">
                        <div class="row">
                            <label for="tmpus">Pilih File Template</label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="tmpus" name="tmpus">
                                <label class="custom-file-label" for="tmpus">Pilih file</label>
                            </div>
                            <p style="color:red;margin-top:10px"><em>Hanya mendukung file *.xls (Microsoft Excel
                                    97-2003)</em></p>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <a href="us_template.php" class="btn btn-success btn-sm btn-flat" target="_blank"><i
                            class="fas fa-download"></i> Download</a>
                    <button type="submit" class="btn btn-primary btn-sm btn-flat"><i class="fas fa-upload"></i>
                        Upload</button>
                    <button type="button" class="btn btn-danger btn-sm btn-flat" data-dismiss="modal"><i
                            class="fas fa-power-off"></i> Tutup</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="card card-secondary card-outline">
    <div class="card-header">
        <h5 class="card-title">Daftar Rekap Nilai Ujian Sekolah</h5>
        <div class="card-tools">
            <button class="btn btn-flat btn-success btn-sm" data-toggle="modal" data-target="#myImportUS">
                <i class="fas fa-cloud-upload-alt"></i>&nbsp;Import
            </button>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table id="tb_us" class="table table-bordered table-striped table-sm">
                <thead>
                    <tr>
                        <th style="text-align: center;width:2.5%">No.</th>
                        <th style="text-align: center;width:15%">NIS/NISN</th>
                        <th>Nama Peserta Didik</th>
                        <th style="text-align: center;width:12.5%">Jumlah</th>
                        <th style="text-align: center;width:12.5%">Rata-rata</th>
                        <th style="text-align: center;width:17.5%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql="SELECT s.idsiswa, s.nis, s.nisn, s.nmsiswa FROM tbsiswa s INNER JOIN tbregistrasi rs USING(idsiswa) INNER JOIN tbkelas k USING(idkelas) INNER JOIN tbthpel tp USING(idthpel) WHERE s.deleted='0' AND rs.idkelas='9' AND tp.aktif='1'";
                    $qs=vquery($sql);
                    $no=0;
                    foreach($qs as $s):
                        $no++;
                  ?>
                    <tr>
                        <td style="text-align:center"><?php echo $no.'.';?></td>
                        <td><?php echo $s['nis'].' / '.$s['nisn'];?></td>
                        <td><?php echo $s['nmsiswa'];?></td>
                        <td style="text-align: center">
                        </td>
                        <td style="text-align: center">
                        </td>
                        <td style="text-align: center">
                            <button data-id="<?php echo $s['idsiswa'];?>" class="btn btn-xs btn-info btn-flat btnInput">
                                <i class="fas fa-edit" aria-hidden="true"></i>&nbsp;Detail
                            </button>
                            <button data-id="<?php echo $s['idsiswa'];?>"
                                class="btn btn-xs btn-success btn-flat btnInput">
                                <i class="fas fa-edit" aria-hidden="true"></i>&nbsp;Input
                            </button>
                        </td>
                    </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<script type="text/javascript">
$(function() {
    $('#tb_us').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": true,
        "ordering": false,
        "info": false,
        "autoWidth": false,
        "responsive": true,
    });
});

function validAngka(a) {
    if (!/^[0-9.]+$/.test(a.value)) {
        a.value = a.value.substring(0, a.value.length - 1000);
    }
}
$(".btnInput").click(function() {
    var id = $(this).data('id');
    window.location.href = "index.php?p=inputus&id=" + id

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