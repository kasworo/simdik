<?php
	if(isset($_GET['d']) && $_GET['d']=='1') {include "siswa_upload.php";}
?>
<div class="modal fade" id="myImportPD" aria-modal="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<form method="POST" enctype="multipart/form-data" action="index.php?p=datasiswa&d=1">
				<div class="modal-header">
					<h5 class="modal-title">Import Data Peserta Didik</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">×</span>
					</button>
				</div>
				<div class="modal-body">
					<div class="col-sm-12">
						<div class="row">
							<label for="filepd">Pilih File Template</label>
							<div class="custom-file">
								<input type="file" class="custom-file-input file" id="filepd" name="filepd">
								<label class="custom-file-label" for="filepd">Pilih file</label>
							</div>							
							<p style="color:red;margin-top:10px"><em>Hanya mendukung file *.xls (Microsoft Excel 97-2003)</em></p>
						</div>
					</div>
				</div>
				<div class="modal-footer justify-content-between">
					<a href="siswa_template.php?d=1" class="btn btn-success btn-sm btn-flat" target="_blank"><i class="fas fa-download"></i> Download</a>
					<button type="submit" name="upload" class="btn btn-primary btn-sm btn-flat">
						<i class="fas fa-upload"></i>&nbsp;Upload
					</button>
					<button type="button" class="btn btn-danger btn-sm btn-flat" data-dismiss="modal"><i class="fas fa-power-off"></i> Tutup</button>
				</div>
			</form>
		</div>
	</div>
</div>
<div class="col-sm-12">
	<div class="card card-secondary card-outline">
		<div class="card-header">
			<h4 class="card-title">Data Peserta Didik</h4>
			<div class="card-tools">
				<a href="index.php?p=addsiswa" class="btn btn-flat btn-primary btn-sm">
					<i class="fas fa-plus-circle"></i>&nbsp;Tambah
				</a>
				<button class="btn btn-flat btn-success btn-sm" data-toggle="modal" data-target="#myImportPD">
					<i class="fas fa-cloud-upload-alt"></i>&nbsp;Import
				</button>
				<button id="hapusall" class="btn btn-flat btn-danger btn-sm">
					<i class="fas fa-trash-alt"></i>&nbsp;Hapus
				</button>
			</div>
		</div>
		<div class="card-body">
			<div class="table-responsive">
				<table id="tb_siswa" class="table table-bordered table-striped table-sm">
					<thead>
						<tr>
							<th style="text-align: center;width:2.5%">No.</th>
							<th style="text-align: center;width:22.5%">Nama User</th>
							<th style="text-align: center;width:17.5%">NIS / NISN</th>
							<th style="text-align: center;">Alamat</th>
							<th style="text-align: center;width:20%">Aksi</th>
						</tr>
					</thead>
					<tbody>
						<?php
							$qs=viewdata('tbsiswa','deleted','0');
							$no=0;
							foreach($qs as $s)
							{
								$no++;
								if($s['aktif']=='1'){$stat='Aktif';$btn="btn-success";} else {$stat='Non Aktif';$btn="btn-danger";}
						?>
						<tr>
							<td style="text-align:center"><?php echo $no.'.';?></td>
							<td title="<?php echo $s['idsiswa'];?>"><?php echo ucwords(strtolower($s['nmsiswa']));?></td>
							<td><?php echo $s['nis'].' / '.$s['nisn'];?></td>
							<td><?php echo $s['alamat'];?></td>
							<td style="text-align: center">
								<!-- <a href="index.php?p=addsiswa&m=2&id=<?php echo base64_encode($s['idsiswa']);?>" class="btn btn-xs btn-primary btn-flat">
									<i class="fas fa-edit"></i>&nbsp;Edit
								</a> -->
								<button data-id="<?php echo $s['idsiswa'];?>" class="btn btn-xs btn-success btn-flat btnUpdate">
									<i class="fas fa-edit"></i>&nbsp;Edit
								</button>
								<button data-id="<?php echo $s['idsiswa'];?>" class="btn btn-xs btn-danger btn-flat btnHapus">
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
	$(function () {
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
	
	$(".btnUpdate").click(function(){
		var id=$(this).data('id');
		window.location.href="index.php?p=addsiswa&id="+id
		
	})

	$(".btnHapus").click(function(){
		var id=$(this).data('id');
		Swal.fire({
			title: 'Anda Yakin?',
			text: "Menghapus Data Peserta Didik"+id,
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
						url:"siswa_simpan.php",
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
		var id=$(this).data('id');
		Swal.fire({
			title: 'Anda Yakin?',
			text: "Menghapus Seluruh	Data Peserta Didik"+id,
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
						url:"siswa_simpan.php",
						data: "aksi=kosong&id="+id,
						success: function(data){					
							toastr.success(data);
						}
				})
				window.location.reload();
			}
		})
	})	
</script>