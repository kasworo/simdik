<?php
	$idsiswa=$_GET['id'];
	$ds=viewdata('tbsiswa',array('idsiswa'=>$_GET['id']))[0];	
	$namasiswa=ucwords(strtolower($ds['nmsiswa']));
?>
<script type="text/javascript">
function isitable(id, th) {
	$.ajax({
		url: 'rapor_data.php',
		type: 'POST',
		data: "as=3&id=" + id + "&th=" + th,
		success: function(data) {
			$("#datane").html(data);
		}
	});
}
$(document).ready(function() {
	let id = "<?php echo $idsiswa;?>";
	let th = $("#txtThpel").val();

	$("#simpan").hide();
	isitable(id, th);

	$("#txtThpel").change(function(e) {
		e.preventDefault();
		let id = "<?php echo $idsiswa;?>";
		let th = $("#txtThpel").val();
		isitable(id, th);
	})
	$("#pilih").click(function(e) {
		e.preventDefault();
		$(".txtNilai").removeAttr('disabled');
		$(".txtDeskripsi").removeAttr('disabled');
		$(".txtPredikat").removeAttr('disabled');
		$(this).hide();
		$("#simpan").show();
	})
})
</script>
<?php 
	if(isset($_POST['kognetif'])){
		$rows = isset($_POST['mapel']) ? $_POST['mapel'] : 1;
		$i=0;
		$gagal=0;
		$tambah=0;
		$edit=0;
		$batal=0;
		foreach ($rows as $row){
			$key=array(
				'idsiswa'=>$idsiswa,
				'idthpel'=>$_POST['thpel'],
				'idmapel'=>$_POST['mapel'][$i],
				'aspek'=>'3'
			); 
			$ceknilai=cekdata('tbnilairapor',$key);
			if($ceknilai>0){
				$nilai=array(
					'nilairapor'=>$_POST['nilai'][$i],
					'predikat'=>$_POST['predikat'][$i],
					'deskripsi'=>$_POST['deskripsi'][$i]
				);				
				$editnilai=editdata('tbnilairapor',$nilai,'',$key);
				if($editnilai>0){$edit++;}
				else {$batal++;}
			}
			else {
				$nilai=array(
					'idsiswa'=>$idsiswa,
					'idthpel'=>$_POST['thpel'],
					'idmapel'=>$_POST['mapel'][$i],					
					'nilairapor'=>$_POST['nilai'][$i],
					'predikat'=>$_POST['predikat'][$i],
					'deskripsi'=>$_POST['deskripsi'][$i],
					'aspek'=>'3',
				);
				$tambahnilai=adddata('tbnilairapor',$nilai);		
				if($tambahnilai>0){$tambah++;}
				else {$gagal++;}
			}
			$i++;  
		}
		if($tambah>0 || $edit>0){
			echo "<script>
					$(function() {
						toastr.info('Ada ".$tambah." data ditambah, ".$edit." data diupdate, ".$gagal." data gagal ditambahkan, ".$batal." data gagal diupdate!','Terima Kasih',{
						timeOut:2000,
						fadeOut:2000
					});
				});
			</script>";
		} 
		else {
			echo "<script>
					$(function() {
						toastr.error('Tidak ada data yang berhasil ditambahkan atau diupdate!','Mohon Maaf',{
						timeOut:2000,
						fadeOut:2000
					});
				});
			</script>";
		}		 
	}		
?>
<div class="alert alert-danger">
	<p><strong>Petunjuk:</strong></p>
	<p>Silahkan pilih Tahun Pelajaran, kemudian isikan nilai lengkap dengan deskripsinya.<br />Nilai
		Akan tersimpan otomatis jika kursor keluar dari kotak isian, setelah selesai melakukan pengisian
		klik tombol <strong>Refresh</strong></p>
</div>
<div class="card card-primary card-outline">
	<div class="card-header">
		<h5 class="card-title m-0" id="judul">Input Nilai Pengetahuan Untuk <?php echo $namasiswa;?></h5>
		<div class="card-tools">
			<a href="index.php?p=datarapor&d=3" class="btn btn-tool">
				<i class="fas fa-arrow-circle-left"></i>
				<span>&nbsp;Kembali</span>
			</a>
		</div>
	</div>
	<form action="" method="post">
		<div class="card-body">
			<div class="form-group row mt-2 mb-0">
				<div class="col-sm-12">
					<label>
						Pilih Kelas dan Tahun Pelajaran
					</label>
				</div>
			</div>
			<div class="form-group row mt-2 mb-4">
				<div class="col-sm-3">
					<script type="text/javascript" src="js/get_thpel.js"></script>
					<select class="form-control input-sm" id="txtKls" onchange="getthpel(this.value)">
						<option value=""> ..Pilih.. </option>
						<?php
							$fkls=array('idkelas', 'nmkelas');
							$tbl=array('tbskul'=>'idjenjang');
							$whr=array(''

							);
							$qkls=fulljoin($fkls,'tbkelas',$tbl);
							foreach ($qkls as $kl):
						?>
						<option value="<?php echo $kl['idkelas'].'&id='.$idsiswa;?>"> <?php echo $kl['nmkelas'];?>
						</option>
						<?php endforeach ?>
					</select>
				</div>
				<div class="col-sm-3">
					<select class="form-control" id="txtThpel" name="thpel" disabled>
						<option value=""> ..Pilih.. </option>
					</select>
				</div>
				<div class="col-sm-3">
					<button class="btn btn-success col-6 mt-0 ml-2" id="pilih" disabled>
						<i class="fas fa-check-circle">
						</i> Pilih</button>
					<button type="submit" class="btn btn-info col-6 mt-0 ml-2" id="simpan" name="kognetif">
						<i class="fas fa-save">
						</i>
						Simpan</button>
				</div>
			</div>
			<br />
			<div class="table-responsive" id="datane"></div>
		</div>
	</form>
</div>
<script type="text/javascript">
function
validAngka(a) {
	if (!/^[0-9.]+$/.test(a.value)) {
		a.value =
			a.value.substring(0,
				a.value.length -
				1000);
	}
}
</script>