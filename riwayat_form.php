<?php
	include "config/function_siswa.php";
?>
<script type="text/javascript">
	$(document).ready(function(){
		var id="<?php echo $_GET['id'];?>";
		$.ajax({
			url:"siswa_regis.php",
			type:"POST",
			dataType:'json',
			data:"m=1&id="+id,
			success:function(data){
				$("#idsiswa").val(data.idsiswa);
				$("#kdkelas").val(data.idkelas);
				$("#kdrombel").val(data.idrombel);
				$("#idreg").val(data.idjreg);
			}
		})
	})
</script>
<div class="col-sm-12">
	<div class="card card-primary card-outline">
		<div class="card-header">
			<h5 class="card-title m-0">Riwayat Pendidikan Sebelumnya</h5>			
		</div>
		<form action="" method="post">
		<div class="card-body">
			<div class="row">
				<div class="col-sm-6">
                    <div class="form-group row mb-2">
						<label class="col-sm-5 offset-sm-1">Asal SD/MI</label>
						<input type="hidden" class="form-control col-sm-6" name="idsiswa" id="idsiswa">
						<select class="form-control col-sm-6 select2bs4" id="aslsd" name="aslsd">
							<option value="">..Pilih..</option>
							<?php
								$qmtr=$conn->query("SELECT*FROM ref_skulmitra WHERE idjenjang='$_COOKIE[c_skul]-1'");
								while($mt=$qmtr->fetch_array()):
							?>
							<option value="<?php echo $mt['idmitra'];?>"><?php echo $mt['nmmitra'];?></option>
							<?php endwhile?>
						</select>
					</div>
					<div class="form-group row mb-2">
						<label class="col-sm-5 offset-sm-1">Nomor Ijazah</label>
						<input class="form-control col-sm-6" name="noijz" id="noijz"> 
					</div>
					<div class="form-group row mb-2">
						<label class="col-sm-5 offset-sm-1">Tanggal Ijazah</label>
						<input class="form-control col-sm-6" name="tglijz" id="tglijz"> 
					</div>
					<div class="form-group row mb-2">
						<label class="col-sm-5 offset-sm-1">Lama Belajar</label>
						<input class="form-control col-sm-6" name="lamasd" id="lamasd" onkeyup="validAngka(this)"> 
					</div>
				</div>
				<div class="col-sm-6">
					<div class="form-group row mb-2">
						<label class="col-sm-5 offset-sm-1">Pindahan dari</label>
						<select class="form-control col-sm-6" name="aslsmp" id="aslsmp">
							<option value="">..Pilih..</option>
							<?php
								$qsmp=$conn->query("SELECT*FROM ref_skulmitra WHERE idjenjang='$_COOKIE[c_skul]'");
								while($smp=$qsmp->fetch_array()):
							?>
							<option value="<?php echo $smp['idmitra'];?>"><?php echo $smp['nmmitra'];?></option>
							<?php endwhile?>
						</select> 
					</div>
					<div class="form-group row mb-2">
						<label class="col-sm-5 offset-sm-1">No. Surat Pindah</label>
						<input class="form-control col-sm-6" name="nomutasi" id="nomutasi" > 
					</div>
					<div class="form-group row mb-2">
						<label class="col-sm-5 offset-sm-1">Tanggal Pindah</label>
						<input class="form-control col-sm-6" name="tglmutasi" id="tglmutasi"> 
					</div>
					<div class="form-group row mb-2">
						<label class="col-sm-5 offset-sm-1">Alasan Pindah</label>
						<textarea class="form-control col-sm-6" name="alasan" id="alasan" value="<?php echo $tglmutasi;?>"></textarea>
					</div>
				</div>
			</div>
		</div>
		<div class="card-footer">
			<div class="row">
				<a href="index.php?p=addsiswa&id=<?php echo $_GET['id'];?>" class="btn btn-danger mb-2 ml-2 col-sm-2">
					<i class="fas fa-arrow-circle-left"></i>
					<span>&nbsp;Kembali</span>
				</a>
				<button type="submit" class="btn btn-primary mb-2 ml-2 col-sm-2" id="simpan">
					<i class="fas fa-fw fa-save"></i>
					<span>&nbsp;<?php echo $tmbl;?></span>
				</button>
				<a href="index.php?p=addayah&id=<?php echo $_GET['id'];?>" class="btn btn-success mb-2 ml-2 col-sm-2">
					<span>Berikutnya&nbsp;</span>
					<i class="fas fa-arrow-circle-right"></i>
				</a>
			</div>
		</div>
		</form>
	</div>	
</div>
<script type="text/javascript" src="js/pilihrombel.js"></script>
<script type="text/javascript">	
	$(document).ready(function(){
		$('#tglijz').datetimepicker({
			timepicker:false,
			format: 'Y-m-d'
		});
		$('#tglrekom').datetimepicker({
			timepicker:false,
			format: 'Y-m-d'
		});
		$('#tglmutasi').datetimepicker({
			timepicker:false,
			format: 'Y-m-d'
		});
		$("#kdrombel").change(function(){
			var rmb=$(this).val();
			if(rmb=='' || rmb==null){
				toastr.error('Pilih Rombel Dulu!');
			}
			else{
				$("#idreg").removeAttr('disabled');
			}
		})
		$("#simpan").click(function(){
			var idsiswa="<?php echo $_GET['id'];?>";
			var aslsd=$("#aslsd").val();
			var noijz=$("#noijz").val();
			var tglijz=$("#tglijz").val();
			var lama =$("#lamasd").val();
			var aslskul=$("#aslsmp").val();
			var nomutasi=$("#nomutasi").val();
			var tglmutasi=$("#tglmutasi").val();
			var alasan=$("#alasan").val();
			$.ajax({
				type:"POST",
				url:"siswa_simpan.php",
				data: "aksi=2&id="+idsiswa+"&nmsd="+aslsd+"&noijz="+noijz+"&tglijz="+tglijz+"&lama="+lama+"&aslskul="+aslskul+"&nomutasi="+nomutasi+"&tglmutasi="+tglmutasi+"&alasan="+alasan,
				success: function(data){					
					toastr.success(data);
				}
			})

		})
	})
</script>