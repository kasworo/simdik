<?php
	if($_COOKIE['c_login']=='1'):
	if(isset($_POST['upload'])){include "kompetensi_upload.php";}
?>
<div class="modal fade" id="myImporKompetensi" aria-modal="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<form action="" method="POST" enctype="multipart/form-data">
				<div class="modal-header">
					<h5 class="modal-title">Import Kompetensi Dasar</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">×</span>
					</button>
				</div>
				<div class="modal-body">
					<div class="col-sm-12">
			<div class="row">
				<label for="tmpkompetensi">Pilih File Template</label>
				<div class="custom-file">
					<input type="file" class="custom-file-input" id="tmpkompetensi" name="tmpkompetensi">
					<label class="custom-file-label" for="tmpkompetensi">Pilih file</label>
				</div>				
				<p style="color:red;margin-top:10px"><em>Hanya mendukung file *.xls (Microsoft Excel 97-2003)</em></p>
			</div>
					</div>
				</div>
				<div class="modal-footer justify-content-between">
					<a href="kompetensi_template.php" class="btn btn-success btn-sm btn-flat" target="_blank"><i class="fas fa-download"></i> Download</a>
					<button type="submit" name="upload" id="upload" class="btn btn-primary btn-sm btn-flat"><i class="fas fa-upload"></i> Upload</button>
					<button type="button" class="btn btn-danger btn-sm btn-flat" data-dismiss="modal"><i class="fas fa-power-off"></i> Tutup</button>
				</div>
			</form>
		</div>
	</div>
</div>
<div class="modal fade" id="myAddKompetensi" aria-modal="true">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-header">
					<h5 class="modal-title">Tambah Data Kompetensi Dasar</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">×</span>
					</button>
				</div>
				<div class="modal-body">
					<div class="col-sm-12">
						<div class="form-group row mb-2">
							<div class="col-sm-4">
								<label>Pilih Kelas</label>
								<input type="hidden" id="idkompetensi">
							</div>
							<div class="col-sm-8">
								<select class="form-control input-sm" id="idkelas" name="idkelas">
									<option value="">..Pilih..</option>
									<?php
										$qkls=$conn->query("SELECT idkelas,nmkelas FROM tbkelas INNER JOIN tbskul USING (idjenjang)");
										while($kl=$qkls->fetch_array()):
									?>
									<option value="<?php echo $kl['idkelas'];?>"><?php echo $kl['nmkelas'];?></option>
									<?php endwhile?>
								</select>
							</div>
						</div>
						<div class="form-group row mb-2">
							<div class="col-sm-4">
								<label>Mata Pelajaran</label>
							</div>
							<div class="col-sm-8">
								<select class="form-control input-sm" id="idmapel" name="idmapel">
									<option value="">..Pilih..</option>
									<?php
										$qmp=$conn->query("SELECT*FROM tbmapel");
										while($mp=$qmp->fetch_array()):
									?>
									<option value="<?php echo $mp['idmapel'];?>"><?php echo $mp['nmmapel'];?></option>
									<?php endwhile?>
								</select>
							</div>
						</div>
						<div class="form-group row mb-2">
							<div class="col-sm-4">
								<label>Semester</label>
							</div>
							<div class="col-sm-8">
								<select class="form-control input-sm" id="idsemester" name="idsemester">
									<option value="">..Pilih..</option>
									<option value="1">Ganjil</option>
									<option value="2">Genap</option>
								</select>
							</div>
						</div>
						<div class="form-group row mb-2">
							<div class="col-sm-4">
								<label>Aspek</label>
							</div>
							<div class="col-sm-8">
								<select class="form-control input-sm" id="idaspek" name="idaspek">
									<option value="">..Pilih..</option>
									<option value="1">Sikap Spiritual</option>
									<option value="2">Sikap Sosial</option>
									<option value="3">Pengetahuan</option>
									<option value="4">Keterampilan</option>
								</select>
							</div>
						</div>
						<div class="form-group row mb-2">
							<div class="col-sm-4">
								<label>Kode kompetensi</label>
							</div>
							<div class="col-sm-8">
								<input class="form-control input-sm" id="kodekompetensi" name="kodekompetensi">
							</div>
						</div>
						<div class="form-group row mb-2">
							<div class="col-sm-4">
								<label>Kompetensi Dasar</label>
							</div>
							<div class="col-sm-8">
								<textarea class="form-control input-sm" id="deskompetensi" name="deskompetensi"></textarea>
							</div>
						</div>
						<div class="form-group row mb-2">
							<div class="col-sm-4">
								<label>Kompetensi Ringkas</label>
							</div>
							<div class="col-sm-8">
								<textarea class="form-control input-sm" id="rkskompetensi" name="rkskompetensi"></textarea>
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer justify-content-between">
					<button type="button" class="btn btn-primary btn-md col-4 btn-flat" id="simpan">
						<i class="fas fa-save"></i> Simpan
					</button>
					<button type="button" class="btn btn-danger btn-md col-4 btn-flat" data-dismiss="modal">
						<i class="fas fa-power-off"></i> Tutup
					</button>
				</div>
		</div>
	</div>
</div>
<div class="col-sm-12">
	<div class="card card-secondary card-outline">
		<div class="card-header">
			<h4 class="card-title">Data Kompetensi Dasar</h4>
			<div class="card-tools">
				<button class="btn btn-flat btn-success btn-sm" id="btnTambah" data-toggle="modal" data-target="#myAddKompetensi">
					<i class="fas fa-plus-circle"></i>&nbsp;Tambah
				</button>
				<button class="btn btn-flat btn-default btn-sm" id="btnImport" data-toggle="modal" data-target="#myImporKompetensi">
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
			<div class="table-responsive">
				<table id="tb_kompetensi" class="table table-bordered table-striped table-sm">
					<thead>
						<tr>
							<th style="text-align: center;width:2.5%">No.</th>
							<th style="text-align: center;width:15%">Mata Pelajaran</th>
							<th style="text-align: center;width:7.5%">Kelas</th>
							<th style="text-align: center;width:15%">Aspek</th>
							<th style="text-align: center">Kompetensi Dasar</th>
							<th style="text-align: center;width:7.5%">Semester</th>
							<th style="text-align: center;width:12.5%">Aksi</th>
						</tr>
					</thead>
				<tbody>
					<?php
						$qk=$conn->query("SELECT kd.*, mp.nmmapel, kl.nmkelas FROM tbkompetensi kd INNER JOIN tbmapel mp USING (idmapel) INNER JOIN tbkelas kl USING(idkelas)");
						$no=0;
						while($m=$qk->fetch_array()):
							$no++;
							switch ($m['aspek']):
								case '1' :{$aspek='Sikap Spiritual';break;}
								case '2' :{$aspek='Sikap Sosial';break;}
								case '3' :{$aspek='Pengetahuan';break;}
								case '4' :{$aspek='Keterampilan';break;}
							endswitch;
							if($m['semester']=='1'){$sms='Ganjil';} else {$sms='Genap';}
					?>
					<tr>
						<td style="text-align:center"><?php echo $no.'.';?></td>
						<td><?php echo $m['nmmapel'];?></td>
						<td><?php echo $m['nmkelas'];?></td>
						<td><?php echo $aspek;?></td>
						<td><?php echo $m['kodekd'].'. '.$m['kdlengkap'];?></td>
						<td><?php echo $sms;?></td>
						<td style="text-align: center">
							<a href="#myAddKompetensi" data-toggle="modal" data-id="<?php echo $m['idkd'];?>" class="btn btn-xs btn-success btn-flat btnUpdate">
								<i class="fas fa-edit"></i>&nbsp;Edit
							</a>
							<button data-id="<?php echo $m['idkd'];?>" class="btn btn-xs btn-danger btn-flat btnHapus">
								<i class="fas fa-trash-alt"></i>&nbsp;Hapus
							</button>
						</td>
					</tr>
					<?php endwhile ?>
				</tbody>
			</table>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	$(document).ready(function(){
		$("#myAddKompetensi").on('hidden.bs.modal', function () {
			window.location.reload();
		})
	})
	$("#btnTambah").click(function(){
		$(".modal-title").html("Tambah Data kompetensi");
		$("#simpan").html("<i class='fas fa-save'></i> Simpan");
		$("#idkompetensi").val('');
		$("#idkelas").val('');
		$("#idmapel").val('');
		$("#idsemester").val('');
		$("#idaspek").val('');
		$("#kodekompetensi").val('');
		$("#deskompetensi").val('');
		$("#rkskompetensi").val('');
	})
	
	$("#simpan").click(function(){
		var idkd=$("#idkompetensi").val();
		var idkls=$("#idkelas").val();
		var idmap=$("#idmapel").val();
		var idsms=$("#idsemester").val();
		var idasp=$("#idaspek").val();
		var kodkd=$("#kodekompetensi").val();
		var deskd=$("#deskompetensi").val();
		var rkskd=$("#rkskompetensi").val();
		$.ajax({
			url:"admin/kompetensi_simpan.php",
			type:'POST',
			data:"aksi=1&idkd="+idkd+"&kls="+idkls+"&map="+idmap+"&sms="+idsms+"&asp="+idasp+"&kode="+kodkd+"&des="+deskd+"&rks="+rkskd,
			success:function(data){
				toastr.success(data);
			}
		})
	})
	
	$(".btnUpdate").click(function(){
		$(".modal-title").html("Ubah Data kompetensi");
		$("#simpan").html("<i class='fas fa-save'></i> Update");
		var id=$(this).data('id');	  
		$.ajax({
			url:'kompetensi_edit.php',
			type:'post',
			dataType:'json',
			data:'id='+id,
			success:function(data){
				$("#idkompetensi").val(data.idkd);
				$("#idkelas").val(data.idkelas);
				$("#idmapel").val(data.idmapel);
				$("#idsemester").val(data.semester);
				$("#idaspek").val(data.aspek);
				$("#kodekompetensi").val(data.kodekd);
				$("#deskompetensi").val(data.kdlengkap);
				$("#rkskompetensi").val(data.kdringkas);	
			}
		})
	})
	
	$(".btnHapus").click(function(){
		var id=$(this).data('id');
		Swal.fire({
			title: 'Anda Yakin?',
			text: "Menghapus kompetensi",
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
					url:"kompetensi_simpan.php",
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
			text: "Menghapus kompetensi",
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
					url:"kompetensi_simpan.php",
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
<?php else:?>
<?php endif?>