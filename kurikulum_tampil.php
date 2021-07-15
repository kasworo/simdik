<?php
	include "config/function_kbm.php";
	if(isset($_POST['simpan'])){
		if($_POST['idkur']==''){
			if(addkurikulum($_POST)>0)
			{
				echo "<script>
						$(function() {
							toastr.success('Tambah Data Kurikulum Berhasil!','Terima Kasih...',{
								timeOut:1000,
								fadeOut:1000,
								onHidden:function(){
									window.location.href='index.php?p=datakur';
								}
							});
						});
					</script>";
			}
			else {
				echo "<script>
						$(function() {
							toastr.error('Tambah Data Kurikulum Gagal!','Mohon Maaf...',{
								timeOut:1000,
								fadeOut:1000,
								onHidden:function(){
									window.location.href='index.php?p=datakur';
								}
							});
						});
					</script>";
			}
		}
		else {
			if(editkurikulum($_POST)>0)
			{
				echo "<script>
						$(function() {
							toastr.success('Update Data Kurikulum Berhasil!','Terima Kasih...',{
								timeOut:1000,
								fadeOut:1000,
								onHidden:function(){
									window.location.href='index.php?p=datakur';
								}
							});
						});
					</script>";
			}
			else {
				echo "<script>
						$(function() {
							toastr.error('Update Data Kurikulum Gagal!','Mohon Maaf...',{
								timeOut:1000,
								fadeOut:1000,
								onHidden:function(){
									window.location.href='index.php?p=datakur';
								}
							});
						});
					</script>";
			}
		}		
	}
?>
<div class="modal fade" id="myAddKurikulum" aria-modal="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Data Kurikulum</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form action="" method="post">
                <div class="modal-body">
                    <div class="col-sm-12">
                        <input type="text" class="form-control input-sm" id="idkur" name="idkur">
                        <div class="form-group mb-2">
                            <label for="nmkur">Nama Kurikulum</label>
                            <input type="text" class="form-control input-sm" id="nmkur" name="nmkur">
                        </div>
                        <div class="form-group mb-2">
                            <label for="akkur">Kode</label>
                            <input type="number" class="form-control input-sm" id="akkur" name="akkur">
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
<div class="col-sm-12">
    <div class="card card-secondary card-outline">
        <div class="card-header">
            <h4 class="card-title">Data Kurikulum</h4>
            <div class="card-tools">
                <button class="btn btn-flat btn-success btn-sm" id="btnTambah" data-toggle="modal"
                    data-target="#myAddKurikulum">
                    <i class="fas fa-plus-circle"></i>&nbsp;Tambah
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
            <div class="table-responsive">
                <table id="tb_kurikulum" class="table table-bordered table-striped table-sm">
                    <thead>
                        <tr>
                            <th style="text-align: center;width:2.5%">No.</th>
                            <th style="text-align: center;width:7.5%">Kode</th>
                            <th style="text-align: center">Kurikulum</th>
                            <th style="text-align: center">Status</th>
                            <th style="text-align: center;width:20%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
					$qk=viewdata('tbkurikulum');
					$no=0;
					foreach($qk as $m)
					{
						$no++;
						if($m['aktif']=='1'){
							$status='Aktif';
						}
						else{
							$status='Non Aktif';
						}
				?>
                        <tr>
                            <td style="text-align:center"><?php echo $no.'.';?></td>
                            <td style="text-align:center"><?php echo $m['akkur'];?></td>
                            <td><?php echo $m['nmkur'];?></td>
                            <td><?php echo $status;?></td>
                            <td style="text-align: center">
                                <a href="#myAddKurikulum" data-toggle="modal" data-id="<?php echo $m['idkur'];?>"
                                    class="btn btn-xs btn-success btn-flat btnUpdate">
                                    <i class="fas fa-edit"></i>&nbsp;Edit
                                </a>
                                <button data-id="<?php echo $m['idkur'];?>"
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
$(document).ready(function() {
    $("#myAddKurikulum").on('hidden.bs.modal', function() {
        window.location.reload();
    })
})
$("#btnTambah").click(function() {
    $(".modal-title").html("Tambah Data Kurikulum");
    $("#simpan").html("<i class='fas fa-save'></i> Simpan");
    $("#idkur").val('');
    $("#nmkur").val('');
    $("#akkur").val('');
})
$(".btnUpdate").click(function() {
    $(".modal-title").html("Update Data Kurikulum");
    $("#simpan").html("<i class='fas fa-save'></i> Update");
    var id = $(this).data('id');
    $.ajax({
        url: 'kurikulum_json.php',
        type: 'post',
        dataType: 'json',
        data: 'id=' + id,
        success: function(data) {
            $("#idkur").val(data.idkur);
            $("#nmkur").val(data.nmkur);
            $("#akkur").val(data.akkur);
        }
    })
})
$("#btnrefresh").click(function() {
    window.location.reload();
})
</script>