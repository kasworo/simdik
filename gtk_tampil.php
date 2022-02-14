<div class="modal fade" id="myImportguru" aria-modal="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<form action="" method="post" enctype="multipart/form-data">
				<div class="modal-header">
					<h5 class="modal-title">Import Data Guru dan Staff</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">×</span>
					</button>
				</div>
				<div class="modal-body">
					<div class="col-sm-12">
						<div class="row">
							<label for="tmpguru">Pilih File Template</label>
							<div class="custom-file">
								<input type="file" class="custom-file-input" id="tmpguru" name="tmpguru">
								<label class="custom-file-label" for="tmpguru">Pilih file</label>
							</div>
							<p style="color:red;margin-top:10px"><em>Hanya mendukung file *.xls (Microsoft Excel
									97-2003)</em></p>
						</div>
					</div>
				</div>
				<div class="modal-footer justify-content-between">
					<a href="gtk_template.php" class="btn btn-success btn-sm btn-flat" target="_blank">
						<i class="fas fa-download"></i> Download</a>
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
		<h4 class="card-title">Data Guru dan Staff</h4>
		<div class="card-tools">
			<a href="index.php?p=addgtk&m=1" class="btn btn-flat btn-primary btn-sm">
				<i class="fas fa-plus-circle"></i>&nbsp;Tambah
			</a>
			<button class="btn btn-flat btn-success btn-sm" data-toggle="modal" data-target="#myImportguru">
				<i class="fas fa-cloud-upload-alt"></i>&nbsp;Import
			</button>
			<button id="hapusall" class="btn btn-flat btn-danger btn-sm">
				<i class="fas fa-trash-alt"></i>&nbsp;Hapus
			</button>
		</div>
	</div>
	<div class="card-body">
		<div class="table-responsive">
			<table id="tb_guru" class="table table-bordered table-striped table-sm">
				<thead>
					<tr>
						<th style="text-align: center;width:2.5%">No.</th>
						<th style="text-align: center;width:22.5%">Nama Lengkap</th>
						<th style="text-align: center;width:17.5%">NIP/NIK</th>
						<th style="text-align: center;">Alamat</th>
						<th style="text-align: center;width:20%">Aksi</th>
					</tr>
				</thead>
				<tbody>
					<?php
						$row=viewdata("tbgtk");
						$no=0;
						foreach ($row as $s):
						$no++;						
					?>
					<tr>
						<td style="text-align:center"><?php echo $no.'.';?></td>
						<td><?php echo $s['nama'];?></td>
						<td><?php echo $s['nip'];?></td>
						<td><?php echo $s['alamat'];?></td>
						<td style="text-align: center">
							<button data-id="<?php echo $s['idgtk'];?>"
								class="btn btn-xs btn-primary btn-flat btnUpdate">
								<i class="fas fa-edit"></i>&nbsp;Edit
							</button>
							<a href="#" class="btn btn-xs btn-danger btn-flat">
								<i class="fas fa-trash-alt"></i>&nbsp;Hapus
							</a>
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
	$('#tb_guru').DataTable({
		"paging": false,
		"lengthChange": false,
		"searching": true,
		"ordering": false,
		"info": false,
		"autoWidth": false,
		"responsive": true,
	});
});
$(".btnUpdate").click(function() {
	var id = $(this).data('id');
	window.location.href = "index.php?p=addgtk&id=" + id;

})
</script>