<?php
	if(!isset($_COOKIE['c_user'])){header("Location: login.php");}
if($_COOKIE['c_login']=='1'):
?>

<div class="modal fade" id="myAddKKM" aria-modal="true">
	<div class="modal-dialog">
	<div class="modal-content">
		<div class="modal-header">
			<h5 class="modal-title">Salin Data KKM</h5>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			<span aria-hidden="true">×</span>
			</button>
		</div>
		<div class="modal-body">
			<div class="col-sm-12">
			<div class="form-group mb-2">	
				<label>Dari Tahun Pelajaran</label>
				<select class="form-control input-sm" id="athpel" name="athpel">
				<option value="">..Pilih..</option>
				<?php
					$qt=$conn->query("SELECT*FROM tbthpel");
					while($t=$qt->fetch_array()){
				?>
					<option value="<?php echo $t['idthpel'];?>"><?php echo $t['desthpel'];?>
				<?php } ?>
				</select>
			</div>
			<div class="form-group mb-2">			
				<label>Ke Tahun Pelajaran</label>
				<select class="form-control input-sm" id="tthpel" name="tthpel">
					<option value="">..Pilih..</option>
					<?php
					$qt=$conn->query("SELECT*FROM tbthpel");
					while($t=$qt->fetch_array()){
				?>
					<option value="<?php echo $t['idthpel'];?>"><?php echo $t['desthpel'];?>
				<?php } ?>
				</select>
			</div>
			</div>
		</div>
		<div class="modal-footer justify-content-between">
			<button type="button" class="btn btn-primary btn-md col-4 btn-flat" id="btnSalin">
				<i class="far fa-copy"></i> Salin
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
			<h4 class="card-title">Data KKM Tahun Pelajaran <?php echo $tapel;?></h4>
			<div class="card-tools">
				<button class="btn btn-flat btn-success btn-sm" id="btnSalin" data-toggle="modal" data-target="#myAddKKM">
					<i class="far fa-copy"></i>&nbsp;Salin
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
				<table id="tb_kkm" class="table table-bordered table-striped table-sm">
				<thead>
				<tr>
					<th style="text-align: center;width:2.5%">No.</th>
					<th style="text-align: center">Mata Pelajaran</th>
					<?php
					$qk=$conn->query("SELECT*FROM tbkelas INNER JOIN tbskul USING(idjenjang)");
					while($k=$qk->fetch_array()){
					?>
					<th style="text-align: center;width:10%"><?php echo $k['nmkelas'];?></th>
				<?php } ?>
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
					<td><?php echo $m['nmmapel'];?></td>
					<?php
					$ql=$conn->query("SELECT*FROM tbkelas INNER JOIN tbskul USING(idjenjang)");
					while($l=$ql->fetch_array()){
						$qkkm=$conn->query("SELECT kkm FROM tbkkm WHERE idmapel='$m[idmapel]' AND idkelas='$l[idkelas]' AND idthpel='$_COOKIE[c_tahun]'");
						$k=$qkkm->fetch_array();
						if($k['kkm']==0 || $k['kkm']==null) {$kkm='';} else {$kkm=$k['kkm'];}
					?>
					<td style="text-align: center;">
					 
					<input class="form-control input-sm input-sm-4 ekkm" data-id="<?php echo $m['idmapel'].'&kls='.$l['idkelas'];?>" style="text-align:center" value="<?php echo $kkm;?>">
					</td>
				<?php } ?>
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
	$('#tb_kkm').DataTable({
		"paging": true,
		"lengthChange": false,
		"searching": true,
		"ordering": false,
		"info": false,
		"autoWidth": false,
		"responsive": true,
	});
	});

	$(".ekkm").change(function(){
	var id=$(this).data('id');
	var kkm=$(this).val();	
	$.ajax({
		url:"kkm_simpan.php",
		type:'POST',
		data:"aksi=simpan&id="+id+"&kkm="+kkm,
		success:function(data){
			toastr.success(data);
		}
	})
	})

	$("#btnSalin").click(function(){
	var asal=$("#athpel").val();
	var tuju=$("#tthpel").val();	
	$.ajax({
		url:"kkm_simpan.php",
		type:'POST',
		data:"aksi=salin&asal="+asal+"&tuju="+tuju,
		success:function(data){
			toastr.success(data);
		}
	})
	})

	$("#hapusall").click(function(){
	Swal.fire({
		title: 'Anda Yakin?',
		text: "Menghapus data KKM",
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
			url:"kkm_simpan.php",
			data: "aksi=kosong",
			success: function(data){
			toastr.success(data);
			}
		})
		}
	})
	})

	$("#btnRefresh").click(function(){
	window.location.reload();
	})
</script>
<?php else: ?>
	<div class="col-sm-12">
	<div class="card card-secondary card-outline">
		<div class="card-header">
			<h4 class="card-title">Data KKM Tahun Pelajaran <?php echo $tapel;?></h4>
		</div>
		<div class="card-body">
			<div class="form-group mb-2">
				<div class="alert alert-warning">
					<p><strong>Perhatian:</strong><br/>Berikut adalah data Kriteria Ketuntasan Minimal yang berlaku pada saat ini. Perubahan data ini hanya bisa dilakukan oleh Administrator.</p>
				</div>
			</div>
			<br/>
			<div class="table-responsive">
				<table id="tb_kkm" class="table table-bordered table-striped table-sm">
				<thead>
				<tr>
					<th style="text-align: center;width:2.5%">No.</th>
					<th style="text-align: center">Mata Pelajaran</th>
					<?php
					$qk=$conn->query("SELECT*FROM tbkelas INNER JOIN tbskul USING(idjenjang)");
					while($k=$qk->fetch_array()){
					?>
					<th style="text-align: center;width:10%"><?php echo $k['nmkelas'];?></th>
				<?php } ?>
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
					<td><?php echo $m['nmmapel'];?></td>
					<?php
					$ql=$conn->query("SELECT*FROM tbkelas INNER JOIN tbskul USING(idjenjang)");
					while($l=$ql->fetch_array()){
						$qkkm=$conn->query("SELECT kkm FROM tbkkm WHERE idmapel='$m[idmapel]' AND idkelas='$l[idkelas]' AND idthpel='$_COOKIE[c_tahun]'");
						$k=$qkkm->fetch_array();
						if($k['kkm']==0 || $k['kkm']==null) {$kkm='';} else {$kkm=$k['kkm'];}
					?>
					<td style="text-align: center;">
					<?php echo $kkm;?>
					</td>
				<?php } ?>
				</tr>
				<?php } ?>
				</tbody>
				</table>
			</div>
		</div>
	</div>
</div>

<?php endif?>