<?php
if(isset($_POST['upload'])) {
    require_once 'assets/library/PHPExcel.php';
    require_once 'assets/library/excel_reader.php';
    if(empty($_FILES['filerwy']['tmp_name'])) {
        echo "<script>
        $(function() {
            toastr.error('File Template Riwayat Sekolah Kosong!', 'Mohon Maaf!', {
                timeOut: 1000,
                fadeOut: 1000
            });
        });
        </script>"; 
    } else {
        
    }
}
?>
<div class="modal fade" id="mySkulAsal" aria-modal="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST" enctype="multipart/form-data" action="index.php?p=datasiswa&d=1">
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
                                <label class="custom-file-label" for="filepd">Pilih file</label>
                            </div>
                            <p style="color:red;margin-top:10px"><em>Hanya mendukung file *.xls (Microsoft Excel
                                    97-2003)</em></p>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <a href="siswa_template.php?d=2" class="btn btn-success btn-sm btn-flat" target="_blank"><i
                            class="fas fa-download"></i> Download</a>
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
    <div class="card card-secondary card-outline">
        <div class="card-header">
            <h4 class="card-title">Riwayat Pendidikan Peserta Didik</h4>
            <div class="card-tools">
                <button class="btn btn-flat btn-success btn-sm" data-target="#mySkulAsal" data-toggle="modal">
                    <i class="fas fa-cloud-upload-alt"></i>&nbsp;Import
                </button>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="tb_siswa" class="table table-bordered table-striped table-sm">
                    <thead>
                        <tr>
                            <th style="text-align: center;width:2.5%">No.</th>
                            <th style="text-align: center">Nama Peserta Didik</th>
                            <th style="text-align: center;width:17.5%">NIS / NISN</th>
                            <th style="text-align: center;width:25%">Asal Sekolah</th>
                            <th style="text-align: center;width:17.5%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
							$field=array('idsiswa', 'nmsiswa','nisn','nis', 'jnsregistrasi', 'idjreg','aslsd', 'aslsmp');
							$tbl=array(
								'tbriwayatskul'=>'idsiswa',
                                'ref_jnsregistrasi'=>'idjreg'		
							);
							$where =array(
								'deleted'=>'0'
							); 
							$no=0;
							$qs=leftjoin($field,'tbsiswa', $tbl, $where);
                            
							foreach($qs as $s):
							$no++;
                            if($s['idjreg']=='1'){
                                $aslskul=$s['aslsd'];
                            }
                            else {
                                $aslskul=$s['aslsmp'];
                            }
						?>
                        <tr>
                            <td style="text-align:center"><?php echo $no.'.';?></td>
                            <td title="<?php echo $s['idsiswa'];?>"><?php echo ucwords(strtolower($s['nmsiswa']));?>
                            </td>
                            <td style="text-align: center"><?php echo $s['nis'].' / '.$s['nisn'];?></td>
                            <td style="text-align: center"><?php echo $aslskul;?></td>
                            <td style="text-align:center">
                                <a href="index.php?p=addriwayat&id=<?php echo $s['idsiswa'];?>"
                                    class="btn btn-sm btn-info btn-flat">
                                    <i class="fas fa-edit"></i>&nbsp;Isi Riwayat
                                </a>
                            </td>
                        </tr>
                        <?php endforeach?>
                    </tbody>
                </table>
            </div>
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
$("#btnrefresh").click(function() {
    window.location.reload();
})
</script>