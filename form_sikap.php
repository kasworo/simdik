<?php
	include "config/konfigurasi.php";
	$idsiswa=base64_decode($_REQUEST['id']);
?>
<div class="col-sm-12">
	<div class="card card-primary card-outline">
		<div class="card-header">
			<h5 class="m-0">Input Nilai Sikap Spiritual dan Sosial</h5>
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
								<th style="text-align:center;">Aspek Sikap</th>
								<th style="text-align:center;width:10%">Nilai</th>
								<th style="text-align:center;width:35%">Deskripsi</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>1.</td>
								<td>Sikap Spiritual<br/>(<em>Bersyukur, Rajin Beribadah, dan lain-lain</em>)</td>
								<td>
									<input class="form-control txtNilai" name="nilai" id="spiritual" style="text-align:center;height:42px">
								</td>
								<td>
									<textarea class="form-control txtDeskripsi" name="" id="des_spiritual" style="height:42px"></textarea>
								</td>
							</tr>
                            <tr>
								<td>2.</td>
								<td>Sikap Sosial<br/>(<em>Jujur, Tanggung Jawab dan Lain-lain</em>)</td>
								<td>
									<input class="form-control txtNilai" name="nilai" id="sosial" style="text-align:center;height:42px">
								</td>
								<td>
									<textarea class="form-control txtDeskripsi" name="" id="des_sosial" style="height:42px"></textarea>
								</td>
							</tr>
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
    $("#spiritual").change(function(){
		var thpel=$("#txtThpel").val();
		var idsiswa = "<?php echo $idsiswa;?>";
		var nilai = $(this).val();
		$.ajax({
		    url: "rapor_simpan.php",
			type:"POST",
			data: "as=1&th="+thpel+"&id="+idsiswa + "&nil="+nilai,
			cache: false,
			success: function(data){
				toastr.success(data);
			}
		});
	})
    $("#sosial").change(function(){
		var thpel=$("#txtThpel").val();
		var idsiswa = "<?php echo $idsiswa;?>";
		var nilai = $(this).val();
		$.ajax({
		    url: "rapor_simpan.php",
			type:"POST",
			data: "as=2&th="+thpel+"&id="+idsiswa + "&nil="+nilai,
			cache: false,
			success: function(data){
				toastr.success(data);
			}
		});
	})
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