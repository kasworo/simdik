<?php
	$idtahun=$_COOKIE['c_tahun'];
	if(isset($_POST['simpan'])){
		$data=array(
			'idkelas' 	=> $_POST['kdkls'], 
			'nmrombel'	=> $_POST['nmrombel'],
			'idthpel' 	=> $_COOKIE['c_tahun'], 
			'idkur'		=> $_POST['idkur'],
			'idgtk'		=> $_POST['walas']
		);
		if(isset($_GET['id'])){
			$col=array('idrombel' =>$_GET['id']);
			$rows=editdata('tbrombel',$data, $col);
		}
		else {
			$rows=adddata('tbrombel',$data);
		}		
	}
        
?>
<div class="modal fade" id="myImportRombel" aria-modal="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="" method="POST">
                <div class="modal-header">
                    <h5 class="modal-title">Import Data Rombongan Belajar</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="col-sm-12">
                        <div class="row">
                            <label for="tmpkelas">Pilih File Template</label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="tmpkelas" name="tmpkelas">
                                <label class="custom-file-label" for="tmpkelas">Pilih file</label>
                            </div>
                            <p style="color:red;margin-top:10px"><em>Hanya mendukung file *.xls (Microsoft Excel
                                    97-2003)</em></p>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <a href="kelas_template.php" class="btn btn-success btn-sm btn-flat" target="_blank">
                        <i class="fas fa-download"></i> Download
                    </a>
                    <button type="submit" name="upload" class="btn btn-primary btn-sm btn-flat">
                        <i class="fas fa-upload"></i> Upload
                    </button>
                    <button type="button" class="btn btn-danger btn-sm btn-flat" data-dismiss="modal">
                        <i class="fas fa-power-off"></i> Tutup
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="myAddKelas" aria-modal="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Data Rombongan Belajar</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form action="" method="post">
                <div class="modal-body">
                    <div class="col-sm-12">
                        <input type="hidden" class="form-control form-control-sm col-sm-6" id="idthpel" name="idthpel"
                            value="<?php echo $idtahun;?>">
                        <input type="hidden" class="form-control form-control-sm col-sm-6" id="idrombel"
                            name="idrombel">
                        <div class="form-group row mb-2">
                            <label class="col-sm-5">Kurikulum</label>
                            <select class="form-control form-control-sm col-sm-6" id="kdkur" name="kdkur">
                                <option value="">..Pilih..</option>
                                <?php
									$qkur=viewdata("tbkurikulum");
									foreach ($qkur as $ku):
								?>
                                <option value="<?php echo $ku['idkur'];?>"><?php echo $ku['nmkur'];?></option>
                                <?php endforeach?>
                            </select>
                        </div>
                        <div class="form-group row mb-2">
                            <label class="col-sm-5">Kelas</label>
                            <select class="form-control form-control-sm col-sm-6" id="kdkelas" name="kdkelas">
                                <option value="">..Pilih..</option>
                                <?php
									$field=array('idkelas','nmkelas');
									$tabel=array('tbskul'=>'idjenjang');
									$qkls=fulljoin($field,'tbkelas',$tabel);
									foreach($qkls as $kl):
								?>
                                <option value="<?php echo $kl['idkelas'];?>"><?php echo $kl['nmkelas'];?></option>
                                <?php endforeach?>
                            </select>
                        </div>
                        <div class="form-group row mb-2">
                            <label class="col-sm-5">Rombongan Belajar</label>
                            <input type="text" class="form-control form-control-sm col-sm-6" id="nmrombel"
                                name="nmrombel" placeholder="Isikan Nama Rombel">
                        </div>
                        <div class="form-group row mb-2">
                            <label class="col-sm-5">Wali Kelas</label>
                            <select class="form-control form-control-sm col-sm-6" id="idwalas" name="idwalas">
                                <option value="">..Pilih..</option>
                                <?php
									$field=array('idgtk','nama');
									$tabel=array(
										'tbskul'=>'idskul',
										'tbrombel'=>'idgtk'
									);
									$qwls=leftjoin($field,'tbgtk',$tabel,'','idgtk');
									foreach($qwls as $wl):
								?>
                                <option value="<?php echo $wl['idgtk'];?>"><?php echo $wl['nama'];?></option>
                                <?php endforeach?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="submit" class="btn btn-primary btn-md col-4 btn-flat" id="simpan" name="simpan">
                        <i class="fas fa-save"></i> Simpan
                    </button>
                    <button type="button" class="btn btn-danger btn-md col-4 btn-flat" data-dismiss="modal">
                        <i class="fas fa-power-off"></i> Tutup
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="card card-secondary card-outline">
    <div class="card-header">
        <h4 class="card-title">Data Rombongan Belajar <?php echo $tapel;?></h4>
        <div class="card-tools">
            <button button class="btn btn-flat btn-success btn-sm" id="btnTambah" data-toggle="modal"
                data-target="#myAddKelas">
                <i class="fas fa-plus-circle"></i>&nbsp;Tambah
            </button>
            <button class="btn btn-flat btn-info btn-sm" id="btnImport" data-toggle="modal"
                data-target="#myImportRombel">
                <i class="fas fa-cloud-upload-alt"></i>&nbsp;Import
            </button>
            <button class="btn btn-flat btn-info btn-sm" id="btnRefresh">
                <i class="fas fa-sync-alt"></i>&nbsp;Refresh
            </button>
            <button id="hapusall" class="btn btn-flat btn-danger btn-sm">
                <i class="fas fa-trash-alt"></i>&nbsp;Hapus
            </button>
        </div>
    </div>
    <div class="card-body">
        <div class="form-group row mb-2">
            <div class="table-responsive">
                <?php
						$col=array('idrombel','nmkelas', 'nmrombel', 'nama');
						$tbl=array(
							'tbkelas'=>'idkelas',
							'tbgtk'=>'idgtk',
							'tbthpel'=>'idthpel'
						);
                        $where=array('aktif'=>'1');
						$sk=fulljoin($col,'tbrombel',$tbl,$where);
					?>
                <table id="tb_kelas" class="table table-bordered table-striped table-sm">
                    <thead>
                        <tr>
                            <th style="text-align: center;width:2.5%">No.</th>
                            <th style="text-align: center;width:15%">Kelas</th>
                            <th style="text-align: center;width:15%">Rombel</th>
                            <th style="text-align: center">Wali Kelas</th>
                            <th style="text-align: center;width:30%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php							
								$no=0;
								foreach($sk as $m)
								{
									$no++;
							?>
                        <tr>
                            <td style="text-align:center"><?php echo $no.'.';?></td>
                            <td style="text-align:center"><?php echo $m['nmkelas'];?></td>
                            <td style="text-align:center"><?php echo $m['nmrombel'];?></td>
                            <td><?php echo $m['nama'];?></td>
                            <td style="text-align: center">
                                <a href="#myAddKelas" data-toggle="modal" data-id="<?php echo $m['idrombel'];?>"
                                    class="btn btn-xs btn-success btn-flat btnUpdate">
                                    <i class="fas fa-edit"></i>&nbsp;Edit
                                </a>
                                <button data-id="<?php echo $m['idrombel'];?>"
                                    class="btn btn-xs btn-danger btn-flat btnHapus">
                                    <i class="fas fa-trash-alt"></i>&nbsp;Hapus
                                </button>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
$(function() {
    $('#tb_kelas').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": true,
        "ordering": false,
        "info": false,
        "autoWidth": false,
        "responsive": true,
    });
})
$("#btnTambah").click(function() {
    $(".modal-title").html("Tambah Data Rombongan Belajar");
    $("#simpan").html("<i class='fas fa-save'></i> Simpan");
    $("#idkur").val('');
    $("#kdkelas").val('');
    $("#nmrombel").val('');
})
$(".btnUpdate").click(function() {
    $(".modal-title").html("Ubah Data Rombongan Belajar");
    $("#simpan").html("<i class='fas fa-save'></i> Update");
    var id = $(this).data('id');
    $.ajax({
        url: 'kelas_json.php',
        type: 'post',
        dataType: 'json',
        data: 'id=' + id,
        success: function(data) {
            $("#idrombel").val(data.idrombel);
            $("#kdkur").val(data.idkur);
            $("#nmrombel").val(data.nmrombel);
            $("#kdkelas").val(data.idkelas);
            $("#idwalas").val(data.idgtk);
        }
    })
})
$(".btnHapus").click(function() {
    var id = $(this).data('id');
    Swal.fire({
        title: 'Anda Yakin?',
        text: "Menghapus Rombongan Belajar" + id,
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Hapus',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.value) {
            $.ajax({
                type: "POST",
                url: "kelas_simpan.php",
                data: "aksi=2&id=" + id,
                success: function(data) {
                    toastr.success(data);
                }
            })
            window.location.reload();
        }
    })
})
$("#hapusall").click(function() {
    Swal.fire({
        title: 'Anda Yakin?',
        text: "Menghapus Rombongan Belajar",
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Hapus',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.value) {
            $.ajax({
                type: "POST",
                url: "kelas_simpan.php",
                data: "aksi=3",
                success: function(data) {
                    toastr.success(data);
                }
            })
        }
    })
})
$("#btnRefresh").click(function() {
    window.location.reload();
})
$(document).ready(function() {
    $("#myAddKelas").on('hidden.bs.modal', function() {
        window.location.reload();
    })
})
</script>