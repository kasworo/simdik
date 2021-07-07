<?php
	include "config/konfigurasi.php";
	include "config/function_nilai.php";  
	if($_REQUEST['d']=='1'){$aspek='Sikap Spiritual';}
	if($_REQUEST['d']=='2'){$aspek='Sikap Spiritual';}
	if($_REQUEST['d']=='3'){$aspek='Pengetahuan';}
	if($_REQUEST['d']=='4'){$aspek='Keterampilan';}  
?>
<div class="col-sm-12">
	<div class="alert alert-warning">
		<p><strong>Petunjuk:</strong></p>
		<p>Silahkan isikan data Nilai <?php echo $aspek;?> yang diperoleh tiap semester.<br/>Nilai Akan tersimpan otomatis jika kursor keluar dari kotak isian, setelah selesai melakukan pengisian klik tombol <strong>Refresh</strong></p>
	</div>
	<div class="card card-primary card-outline">
		<div class="card-header">
			<h5 class="card-title m-0">Data Nilai <?php echo $aspek;?></h5>
		</div>
		<div class="card-body">
			<table id="tb_rombel" class="table table-bordered table-striped table-sm">
				<thead>
					<tr>
						<th style="text-align: center;width:2.5%">No.</th>
						<th style="text-align: center;width:20%">Nomor Induk</th>
						<th style="text-align: center;">Nama Peserta Didik</th>						
						<th style="text-align: center;width:0%">Rombel</th>
						<th style="text-align: center;width:10%">Aksi</th>
					</tr>
				</thead>
				<tbody>
					<?php
						$qs=$conn->query("SELECT s.*, nmrombel FROM tbsiswa s LEFT JOIN tbregistrasi rs USING(idsiswa) LEFT JOIN tbrombel r USING(idrombel) WHERE r.idthpel='$_COOKIE[c_tahun]' OR rs.idjreg is NULL");
						$no=0;
						while($s=$qs->fetch_array()):
							$no++;
					?>
					<tr>
						<td style="text-align:center"><?php echo $no.'.';?></td>
						<td style="text-align:center"><?php echo $s['nis'].' / '.$s['nisn'];?></td>
						<td title="<?php echo $s['idsiswa'];?>"><?php echo ucwords(strtolower($s['nmsiswa']));?></td>
						<td style="text-align:center"><?php echo $s['nmrombel'];?></td>
						<td style="text-align:center">
							<button data-id="<?php echo $s['idsiswa'];?>" class="btn btn-xs btn-success btn-flat btnInput">
								<i class="fas fa-edit"></i>&nbsp;Input Nilai
							</button>
						</td>
					</tr>
					<?php endwhile?>
					</tbody>
				</table>
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
	$(".btnInput").click(function(){
		var id=$(this).data('id');
		var as="<?php echo $_GET['d'];?>";		
		if(as=='1' || as=='2'){
			window.location.href="index.php?p=inputsikap&id="+id
		}
		else if(as=='3'){
			window.location.href="index.php?p=inputkognetif&id="+id
		}
		else if(as=='4'){
			window.location.href="index.php?p=inputterampil&id="+id
		}
	})
	$(document).ready(function(){
		$(function() {
			const Toast=Swal.mixin({
				toast: true,
				position: 'top-end',
				showConfirmButton: false,
				timer: 3000
			});
		})
	})
</script>