<?php
	include "config/function_kbm.php";
	if($level=='1'):
		if(isset($_POST['simpan'])){
			if($_POST['idmapel']==''){
				if(addmapel($_POST)>0)
				{
					echo "<script>
							$(function() {
								toastr.success('Tambah Data Mata Pelajaran Berhasil!','Terima Kasih...',{
									timeOut:1000,
									fadeOut:1000,
									onHidden:function(){
										window.location.href='index.php?p=datamapel';
									}
								});
							});
						</script>";
				}
				else {
					echo "<script>
							$(function() {
								toastr.error('Tambah Data Mata Pelajaran Gagal!','Mohon Maaf...',{
									timeOut:1000,
									fadeOut:1000,
									onHidden:function(){
										window.location.href='index.php?p=datamapel';
									}
								});
							});
						</script>";
				}
			}
			else {
				if(editmapel($_POST)>0)
				{
					echo "<script>
							$(function() {
								toastr.success('Update Data Mata Pelajaran Berhasil!','Terima Kasih...',{
									timeOut:1000,
									fadeOut:1000,
									onHidden:function(){
										window.location.href='index.php?p=datamapel';
									}
								});
							});
						</script>";
				}
				else {
					echo "<script>
							$(function() {
								toastr.error('Update Data Mata Pelajaran Gagal!','Mohon Maaf...',{
									timeOut:1000,
									fadeOut:1000,
									onHidden:function(){
										window.location.href='index.php?p=datamapel';
									}
								});
							});
						</script>";
				}
			}
			
			
		}
?>
<div class="modal fade" id="myAddMapel" aria-modal="true">
	<div class="modal-dialog modal-dialog-centered">
	<div class="modal-content">
		<div class="modal-header">
			<h5 class="modal-title">Tambah Data Mata Pelajaran</h5>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			<span aria-hidden="true">×</span>
			</button>
		</div>
		<form action="" method="post">
			<div class="modal-body">
				<div class="col-sm-12">
					<input type="hidden" class="form-control form-control-sm" id="idmapel" name="idmapel">
					<div class="form-group row mb-2">			
						<label class="col-sm-4">Kurikulum</label>
						<select class="col-sm-6 form-control form-control-sm" id="idkur" name="idkur">
						<option value="">..Pilih..</option>
						<?php
							$qkur=$conn->query("SELECT*FROM tbkurikulum");
							while($ku=$qkur->fetch_array()){
						?>
						<option value="<?php echo $ku['idkur'];?>"><?php echo $ku['nmkur'];?>
						<?php } ?>
						</select>
					</div>
					<div class="form-group row mb-2">			
						<label class="col-sm-4">Mata Pelajaran</label>
						<input type="text" class="col-sm-6 form-control form-control-sm" id="nmmapel" name="nmmapel">
					</div>
					<div class="form-group row mb-2">			
						<label class="col-sm-4">Kode</label>
						<input type="text" class="col-sm-6 form-control form-control-sm" id="akmapel" name="akmapel">
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
			<h4 class="card-title">Data Mata Pelajaran</h4>
			<div class="card-tools">
				<button class="btn btn-flat btn-success btn-sm" id="btnTambah" data-toggle="modal" data-target="#myAddMapel">
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
				<table id="tb_mapel" class="table table-bordered table-striped table-sm">
				<thead>
				<tr>
					<th style="text-align: center;width:2.5%">No.</th>
					<th style="text-align: center;width:7.5%">Kode</th>
					<th style="text-align: center">Mata Pelajaran</th>
					<th style="text-align: center;width:20%">Aksi</th>
				</tr>
				</thead>
				<tbody>
				<?php
					$qk=$conn->query("SELECT*FROM tbmapel");
					$no=0;
					while($m=$qk->fetch_array())
					{
						$no++;
				?>
				<tr>
					<td style="text-align:center"><?php echo $no.'.';?></td>
					<td style="text-align:center"><?php echo $m['akmapel'];?></td>
					<td><?php echo $m['nmmapel'];?></td>
					<td style="text-align: center">
					<a href="#myAddMapel" data-toggle="modal" data-id="<?php echo $m['idmapel'];?>" class="btn btn-xs btn-success btn-flat btnUpdate">
						<i class="fas fa-edit"></i>&nbsp;Edit
					</a>
					<button data-id="<?php echo $m['idmapel'];?>" class="btn btn-xs btn-danger btn-flat btnHapus">
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
	$(document).ready(function(){
		$("#myAddMapel").on('hidden.bs.modal', function () {
			window.location.reload();
		})
	})
</script>
<script type="text/javascript">
	$("#btnTambah").click(function(){
		$(".modal-title").html("Tambah Data Mata Pelajaran");
		$("#simpan").html("<i class='fas fa-save'></i> Simpan");
		$("#idkur").val('');
		$("#nmmapel").val('');
		$("#akmapel").val('');
	})
	$(".btnUpdate").click(function(){
		$(".modal-title").html("Ubah Data Mata Pelajaran");
		$("#simpan").html("<i class='fas fa-save'></i> Update");
		var id=$(this).data('id');		
		$.ajax({
			url:'mapel_json.php',
			type:'post',
			dataType:'json',
			data:'id='+id,
			success:function(data)
			{
				$("#idmapel").val(data.idmapel);
				$("#idkur").val(data.idkur);
				$("#nmmapel").val(data.nmmapel);
				$("#akmapel").val(data.akmapel);
			}
		})
	})
	$(".btnHapus").click(function(){
	var id=$(this).data('id');
	Swal.fire({
		title: 'Anda Yakin?',
		text: "Menghapus Mata Pelajaran",
		icon: 'question',
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		confirmButtonText: 'Hapus',
		cancelButtonText:'Batal'
	}).then((result) => {
		if (result.value) {
		$.ajax({
			type:"POST",
			url:"mapel_simpan.php",
			data: "aksi=hapus&id="+id,
			success: function(data){			
				toastr.success(data);
			}
		})
		window.location.reload();
		}
	})
	})
	$("#hapusall").click(function(){
	Swal.fire({
		title: 'Anda Yakin?',
		text: "Menghapus Mata Pelajaran",
		icon: 'question',
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		confirmButtonText: 'Hapus',
		cancelButtonText:'Batal'
	}).then((result) => {
		if (result.value) {
		$.ajax({
			type:"POST",
		url:"mapel_simpan.php",
		data: "aksi=kosong",
		success: function(data){			
		toastr.success(data);
		}
	})
		}
	})
	})
	$("#btnrefresh").click(function(){
	window.location.reload();
	})
</script>
<?php else : ?>
	<div class="col-sm-12">
	<div class="card card-secondary card-outline">
		<div class="card-header">
			<h4 class="card-title">Data Mata Pelajaran</h4>
		</div>
		<div class="card-body">
			<div class="form-group mb-2">
				<div class="alert alert-warning">
					<p><strong>Perhatian:</strong><br/>Berikut adalah data Mata Pelajaran. Perubahan data ini hanya bisa dilakukan oleh Administrator.</p>
				</div>
			</div>
			<br/>
			<div class="table-responsive">
				<table id="tb_mapel" class="table table-bordered table-striped table-sm">
				<thead>
				<tr>
					<th style="text-align: center;width:2.5%">No.</th>
					<th style="text-align: center;width:15%">Kode Mapel</th>
					<th style="text-align: center">Mata Pelajaran</th>
				</tr>
				</thead>
				<tbody>
				<?php
					$qk=$conn->query("SELECT*FROM tbmapel");
					$no=0;
					while($m=$qk->fetch_array())
					{
						$no++;
				?>
				<tr>
					<td style="text-align:center"><?php echo $no.'.';?></td>
					<td style="text-align:center"><?php echo $m['akmapel'];?></td>
					<td><?php echo $m['nmmapel'];?></td>
				</tr>
				<?php } ?>
				</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
<?php endif ?>
<script type="text/javascript">
	$(function () {
		$('#tb_mapel').DataTable({
			"paging": true,
			"lengthChange": false,
			"searching": true,
			"ordering": false,
			"info": false,
			"autoWidth": false,
			"responsive": true,
		});
	})
</script>