<?php if(isset($_POST['pilih'])): ?>
<script type="text/javascript">
	$(document).ready(function(){
		var url="rapor_template.php?";
		var thpel="<?php echo $_POST['thpel'];?>";
		var mapel="<?php echo $_POST['mapel'];?>";
		var rombel="<?php echo $_POST['rmbl'];?>";
		
		$(".inputspirit").click(function(){
			window.location.href=url+"s=1&d=1&t="+thpel+"&m="+mapel+"&r="+rombel;
		});

		$(".editspirit").click(function(){
			window.location.href=url+"s=2&d=1&t="+thpel+"&m="+mapel+"&r="+rombel;
		});
	});
</script>
<?php endif ?>
	<div class="card card-secondary card-outline">
		<div class="card-header">
			<h4 class="card-title">Impor Dan Ekspor Nilai Peserta Didik</h4>
			<div class="card-tools">
				<button class="btn btn-sm btn-primary">
					<i class="fas fa-cloud-upload-alt"></i>&nbsp;Upload
				</button>
			</div>
		</div>
		<div class="card-body">
			<div class="row">
				<div class="col-sm-5">
					<form action="" method="post">
						<div class="card">
							<div class="card-body">
								<div class="form-group mb-2 ml-2">
									<label>Pilih Tahun Pelajaran</label>
									<select class="form-control form-control-sm col-sm-8" name="thpel" id="thpel">
										<option value="">..Pilih..</option>
										<option value="1">2018/2019-Ganjil</option>
									</select>
								</div>
								<div class="form-group mb-2 ml-2">
									<label>Rombongan Belajar</label>
									<select class="form-control form-control-sm col-sm-8" name="rmbl" id="rmbl">
										<option value="">..Pilih..</option>
										<option value="1">Kelas 7A</option>
									</select>
								</div>
								<div class="form-group mb-2 ml-2">
									<label>Mata Pelajaran</label>
									<select class="form-control form-control-sm col-sm-8" name="mapel" id="mapel">
										<option value="">..Pilih..</option>
										<option value="1">Pendidikan Agama</option>
									</select>
								</div>						
							</div>
							<div class="card-footer">
								<button type="submit" class="btn btn-sm btn-primary" name="pilih">
									<i class="fas fa-checklist"></i>&nbsp;Pilih
								</button>
							</div>
						</div>
					</form>
				</div>
				<div class="col-sm-7">
					<div class="form-group row mb-2">
						<table class="table table-sm table-striped table-bordered table-condensed">
							<thead>
								<tr>
									<th style="text-align:center;width:7.5%">No.</th>
									<th style="text-align:center">Template <?php echo $rombel;?></th>
									<th style="text-align:center;width:27.5%" >Download Format</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td style="text-align:center">1.</td>
									<td>Penilaian Sikap Spiritual</td>
									<td style="text-align:center">
										<button class="btn btn-xs btn-success inputspirit">
											<i class="fas fa-cloud-download-alt"></i>&nbsp;Input
										</button>
										<button class="btn btn-xs btn-danger btnedit">
											<i class="fas fa-cloud-download-alt"></i>&nbsp;Edit
										</button>
									</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>		
</div>