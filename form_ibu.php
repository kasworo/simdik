<script type="text/javascript">
	$(document).ready(function(){
		var id="<?php echo $_GET['id'];?>";
		$.ajax({
			url:"siswa_ortu.php",
			type:"POST",
			dataType:'json',
			data:"m=2&id="+id,
			success:function(data){
				$("#nmibu").val(data.nmortu);
				$("#nik").val(data.nik);
				$("#tmplahir").val(data.tmplahir);
				$("#tgllahir").val(data.tgllahir);
				$("#agama").val(data.idagama);
				$("#pddkibu").val(data.idpddk);
				$("#krjibu").val(data.idkerja);
				$("#hslibu").val(data.idhsl);
				$("#hubkel").val(data.hubkel);
				$("#almt").val(data.alamat);
				$("#desa").val(data.desa)
				$("#kec").val(data.kec);
				$("#kab").val(data.kab);
				$("#prov").val(data.prov);
				$("#kdpos").val(data.kdpos);
				$("#nohp").val(data.nohp);
				$("#pesan").html(data.psn);
				$("#simpan").html(data.tmb);
			}
		})
	})
</script>
<div class="col-sm-12">
	<div class="alert alert-warning">
		<p><strong>Petunjuk</strong><br/><span id="pesan"></span></p>
	</div>
	<div class="card card-primary card-outline">
		<div class="card-header">
			<h5 class="card-title m-0">Data Ibu Kandung</h5>
		</div>
		<div class="card-body">
			<div class="row">
				<div class="col-sm-6">
					<div class="form-group row mb-2">
						<label class="col-sm-5 offset-sm-1">Nama Ibu</label>
						<div class="col-sm-6">
							<input class="form-control" name="nmibu" id="nmibu">
						</div>
					</div>
					<div class="form-group row mb-2">
						<label class="col-sm-5 offset-sm-1">NIK</label>
						<div class="col-sm-6">
							<input class="form-control" name="nik" id="nik"> 
						</div>
					</div>
					<div class="form-group row mb-2">
						<label class="col-sm-5 offset-sm-1">Tempat Lahir</label>			
						<div class="col-sm-6">
							<input class="form-control" name="tmplahir" id="tmplahir">
						</div>
					</div>
					<div class="form-group row mb-2">
						<label class="col-sm-5 offset-sm-1">Tanggal Lahir</label>
						<div class="col-sm-6">
							<input class="form-control" name="tgllahir" id="tgllahir" >
						</div>
					</div>				
					<div class="form-group row mb-2">
						<label class="col-sm-5 offset-sm-1">Agama</label>
						<div class="col-sm-6">
							<select class="form-control" name="agama" id="agama">
								<option value="">..Pilih..</option>
								<option value="A">Islam</option>
								<option value="B">Kristen</option>
								<option value="C">Katholik</option>
								<option value="D">Hindu</option>
								<option value="E">Buddha</option>
								<option value="F">Konghucu</option>
							</select>
						</div>						
					</div>
					<div class="form-group row mb-2">
						<label class="col-sm-5 offset-sm-1">Pendidikan Terakhir</label>
						<div class="col-sm-6">
							<select class="form-control" name="pddkibu" id="pddkibu">
								<option value="">..Pilih..</option>
								<?php
									$qed=$conn->query("SELECT*FROM ref_pendidikan");
									while($ed=$qed->fetch_array()):
								?>
								<option value="<?php echo $ed['idpddk'];?>" ><?php echo $ed['pendidikan'];?></option>
								<?php endwhile?>
							</select>
						</div>
					</div>
					<div class="form-group row mb-2">
						<label class="col-sm-5 offset-sm-1">Pekerjaan</label>
						<div class="col-sm-6">
							<select class="form-control" name="krjibu" id="krjibu">
								<option value="">..Pilih..</option>
								<?php
									$qkrj=$conn->query("SELECT*FROM ref_pekerjaan LIMIT 7");
									while($kr=$qkrj->fetch_array()):
								?>
								<option value="<?php echo $kr['idkerja'];?>"><?php echo $kr['pekerjaan'];?></option>
								<?php endwhile?>
							</select>
						</div>
					</div>
					<div class="form-group row mb-2">
						<label class="col-sm-5 offset-sm-1">Penghasilan / Bulan</label>
						<div class="col-sm-6">
							<select class="form-control" name="hslibu" id="hslibu">
								<option value="">..Pilih..</option>
								<?php
									$qhsl=$conn->query("SELECT*FROM ref_penghasilan");
									while($hs=$qhsl->fetch_array()):
								?>
								<option value="<?php echo $hs['idhsl'];?>"><?php echo $hs['penghasilan'];?></option>
								<?php endwhile?>
							</select>
						</div>
					</div>
				</div>
					<div class="col-sm-6">
						<div class="form-group row mb-2">
							<label class="col-sm-5 offset-sm-1">Hubungan Keluarga</label>
							<div class="col-sm-6">
								<select class="form-control" name="hubkel" id="hubkel" disabled="true">
									<option value="">..Pilih..</option>
									<option value="2">Ibu Kandung</option>
								</select>
							</div>
						</div>
						<div class="form-group row mb-2">
							<label class="col-sm-5 offset-sm-1">Alamat</label>
							<div class="col-sm-6">
								<input class="form-control" name="almt" id="almt">
							</div>
						</div>				
						<div class="form-group row mb-2">
							<label class="col-sm-5 offset-sm-1">Desa / Kelurahan</label>
							<div class="col-sm-6">		
								<input class="form-control" name="desa" id="desa">		
							</div>
						</div>
						<div class="form-group row mb-2">
							<label class="col-sm-5 offset-sm-1">Kecamatan</label>
							<div class="col-sm-6">		
								<input class="form-control" name="kec" id="kec">	
							</div>
						</div>
						<div class="form-group row mb-2">
							<label class="col-sm-5 offset-sm-1">Kabupaten</label>
							<div class="col-sm-6">
								<input class="form-control" name="kab" id="kab" >
							</div>
						</div>
						<div class="form-group row mb-2">
							<label class="col-sm-5 offset-sm-1">Provinsi</label>
							<div class="col-sm-6">
								<input class="form-control" name="prov" id="prov">
							</div>
						</div>					
						<div class="form-group row mb-2">
							<label class="col-sm-5 offset-sm-1">Kode Pos</label>
							<div class="col-sm-6">
								<input class="form-control" name="kdpos" id="kdpos">
							</div>
						</div>
						<div class="form-group row mb-2">
							<label class="col-sm-5 offset-sm-1">Nomor HP</label>
							<div class="col-sm-6">
								<input class="form-control" name="nohp" id="nohp">
							</div>
						</div>
					</div>
				</div>
		</div>
		<div class="card-footer">
			<div class="row">
				<a href="index.php?p=addayah&id=<?php echo $_GET['id'];?>" class="btn btn-md btn-danger mb-2 ml-2 col-sm-2">
					<i class="fas fa-arrow-circle-left"></i>
					<span>&nbsp;Kembali</span>
				</a>
				<button class="btn btn-primary btn-md mb-2 ml-2 col-sm-2" id="simpan">
					<i class="fas fa-fw fa-save"></i>
					<span>&nbsp;<?php echo $tmbl;?></span>
				</button>
				<?php
					$id=base64_decode($_GET['id']);
					$qdom=$conn->query("SELECT ikuts FROM tbsiswa WHERE idsiswa='$id'");
					$dom=$qdom->fetch_array();
					$cekdom=$dom['ikuts'];
					if($cekdom<>'1'):
				?>
				<a href="index.php?p=addwali&id=<?php echo $_GET['id'];?>" class="btn btn-success btn-md mb-2 ml-2 col-sm-2">
					<span>Berikutnya&nbsp;</span>
					<i class="fas fa-arrow-circle-right"></i>
				</a>
				<?php else:?>
				<a href="index.php?p=datasiswa" class="btn btn-secondary btn-md mb-2 ml-2 col-sm-2">
					<span>Tutup&nbsp;</span>
					<i class="fas fa-sign-out-alt"></i>
				</a>
				<?php endif?>
			</div>
		</div>
	</div>	
</div>
<script type="text/javascript">
	$(document).ready(function(){
		$('#tgllahir').datetimepicker({
			timepicker:false,
			format: 'Y-m-d'
		});
		$("#simpan").click(function(){
			var idsiswa="<?php echo $_GET['id'];?>";
			var nmibu = $("#nmibu").val();
			var nik = $("#nik").val();
			var tmplahir = $("#tmplahir").val();
			var tgllahir = $("#tgllahir").val();
			var agama = $("#agama").val();
			var pddk=$("#pddkibu").val();
			var krj=$("#krjibu").val();
			var hsl=$("#hslibu").val();
			var hubkel=$("#hubkel").val();
			var almt = $("#almt").val();
			var desa = $("#desa").val()
			var kec = $("#kec").val();
			var kab	= $("#kab").val();
			var prov = $("#prov").val();
			var kdpos = $("#kdpos").val();
			var nohp = $("#nohp").val();
			if(nmibu=="" || nmibu==null){
				toastr.error('Nama ibu Wajib Diisi!');
				$("#nmibu").focus();
			}
			else if(tmplahir=="" || tmplahir==null){
				toastr.error('Tempat Lahir Wajib Diisi!');
				$("#tmplahir").focus();
			}
			else if(tgllahir=="" || tgllahir==null){
				toastr.error('Tanggal Lahir Wajib Diisi!');
				$("#tgllahir").focus();
			}				
			else if(agama=="" || agama==null){
				toastr.error('Agama Wajib Diisi!');
				$("#agama").focus();
			}
			else {
				$.ajax({
					type:"POST",
					url:"siswa_simpan.php",
					data: "aksi=3&id="+idsiswa+"&nama="+nmibu+"&nik="+nik+"&tmplahir="+tmplahir+"&tgllahir="+tgllahir +"&agama="+agama +"&pddk="+pddk+"&krj="+krj+"&hsl="+hsl+"&hubkel="+hubkel+"&almt="+almt+"&desa="+desa + "&kec="+kec +"&kab="+kab + "&prov=" + prov +"&kdpos="+kdpos + "&nohp="+nohp,
					success:function(data)
					{
						toastr.success(data);
					}	
				})
			}
		})
	})
</script>