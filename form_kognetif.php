<?php
	include "config/konfigurasi.php";
	$idsiswa=base64_decode($_REQUEST['id']);
?>
<div class="col-sm-12">
	<div class="card card-primary card-outline">
		<div class="card-header">
			<h5 class="m-0">Input Nilai Pengetahuan</h5>
		</div>
		<div class="card-body">
			<div class="col-sm-12">
				<div class="alert alert-warning">
					<p><strong>Petunjuk:</strong></p>
					<p>Silahkan pilih Tahun Pelajaran, kemudian isikan nilai lengkap dengan deskripsinya.<br/>Nilai Akan tersimpan otomatis jika kursor keluar dari kotak isian, setelah selesai melakukan pengisian klik tombol <strong>Refresh</strong></p>
				</div>
				<div class="form-group row mt-2 mb-2">
					<div class="col-sm-4 offset-sm-2">
						Pilih Tahun Pelajaran
					</div>
					<div class="col-sm-4">
						<select class="form-control input-sm col-sm-10" id="txtThpel">
							<option value="">..Pilih..</option>
							<?php
								$qtp=$conn->query("SELECT*FROM tbthpel");
								while($tp=$qtp->fetch_array()):
							?>
							<option value="<?php echo $tp['idthpel'];?>"><?php echo $tp['desthpel'];?></option>
							<?php endwhile ?>
						</select>
					</div>
				</div>
				<br/>
				<div class="table-responsive">
					<table class="table table-bordered table-condensed table-striped">
						<thead>
							<tr>
								<th style="text-align:center;width:2.5%">No</th>
								<th style="text-align:center;">Mata Pelajaran</th>
								<th style="text-align:center;width:10%">Nilai</th>
								<th style="text-align:center;width:35%">Deskripsi</th>
							</tr>
						</thead>
						<tbody>
							<?php
								$qnil=$conn->query("SELECT idmapel, nmmapel FROM tbmapel m INNER JOIN tbkurikulum k USING(idkur)");
								$no=0;
								while($n=$qnil->fetch_array()):
									$no++;
							?>
							<tr>
								<td><?php echo $no.'.';?></td>
								<td><?php echo $n['nmmapel'];?></td>
								<td>
									<input class="form-control txtNilai" name="nilai" id="nilai<?php echo $no;?>" style="text-align:center;height:42px">
								</td>
								<td>
									<textarea class="form-control txtDeskripsi" name="" id="des<?php echo $no;?>" style="height:42px"></textarea>
								</td>
							</tr>
							<script type="text/javascript">								
								$("#nilai<?php echo $no;?>").change(function(){
									var thpel=$("#txtThpel").val();								
									var kdmapel = "<?php echo $n['idmapel'];?>";
									var idsiswa = "<?php echo $idsiswa;?>";
									var nilai = $(this).val();
									alert(nilai);
									$.ajax({
										url: "rapor_simpan.php",
										type:"POST",
										data: "as=3&th="+thpel+"&mp="+kdmapel+"&id="+idsiswa + "&nil="+nilai,
										cache: false,
										success: function(data){
											toastr.success(data);
										}
									});
								})
								$("#des<?php echo $no;?>").change(function(){
									var thpel=$("#txtThpel").val();								
									var kdmapel = "<?php echo $n['idmapel'];?>";
									var idsiswa = "<?php echo $idsiswa;?>";
									var nilai = $("#nilai<?php echo $no;?>").val();
									var des= $(this).val();
									$.ajax({
										url: "rapor_simpan.php",
										type:"POST",
										data: "as=3&th="+thpel+"&mp="+kdmapel+"&id="+idsiswa + "&nil="+nilai+"&des="+des,
										cache: false,
										success: function(data){
											toastr.success(data);
										}
									});
								})
							</script>
							<?php endwhile ?>
						</tbody>

					</table>
				</div>
				
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	function validAngka(a)
	{
		if(!/^[0-9.]+$/.test(a.value))
		{
			a.value=a.value.substring(0,a.value.length-1000);
		}
	}
	$(document).ready(function(){
		$(".txtNilai").attr('disabled','disabled');
		$(".txtDeskripsi").attr('disabled','disabled');
		$("#txtThpel").change(function(){
			if($(this).val()=='' || $(this).val()==null){
				$(".txtNilai").attr('disabled','disabled');
				$(".txtDeskripsi").attr('disabled','disabled');
			} 
			else {
				$(".txtNilai").removeAttr('disabled');
				$(".txtDeskripsi").removeAttr('disabled');
			}

		})
	})
</script>