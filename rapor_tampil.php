<?php
if ($_GET['d'] == '1') {
	$aspek = 'Sikap Spiritual';
}
if ($_GET['d'] == '2') {
	$aspek = 'Sikap Spiritual';
}
if ($_GET['d'] == '3') {
	$aspek = 'Pengetahuan';
}
if ($_GET['d'] == '4') {
	$aspek = 'Keterampilan';
}
?>
<div class="modal fade" id="myImportNilai" aria-modal="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<form method="POST" enctype="multipart/form-data" action="">
				<div class="modal-header">
					<h5 class="modal-title">Import Nilai <?php echo $aspek; ?></h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">×</span>
					</button>
				</div>
				<div class="modal-body">
					<div class="col-sm-12">
						<div class="row">
							<label for="filerapor">Pilih File Template</label>
							<div class="custom-file">
								<input type="file" class="custom-file-input file" id="filerapor" name="filerapor">
								<label class="custom-file-label" for="filerapor">Pilih file</label>
							</div>
							<p style="color:red;margin-top:10px"><em>Hanya mendukung file *.xls (Microsoft Excel
									97-2003)</em></p>
						</div>
					</div>
				</div>
				<div class="modal-footer justify-content-between">
					<a href="rapor_template.php?d=<?php echo $_GET['d']; ?>" class="btn btn-success btn-sm" target="_blank"><i class="fas fa-download"></i> Download</a>
					<button type="submit" name="upload" class="btn btn-primary btn-sm">
						<i class="fas fa-upload"></i>&nbsp;Upload
					</button>
					<button type="button" class="btn btn-danger btn-sm" data-dismiss="modal"><i class="fas fa-power-off"></i> Tutup</button>
				</div>
			</form>
		</div>
	</div>
</div>
<div class="alert alert-warning">
	<p><strong>Petunjuk:</strong></p>
	<p>Silahkan isikan data Nilai <?php echo $aspek; ?> yang diperoleh tiap semester.<br />Nilai Akan tersimpan
		otomatis jika kursor keluar dari kotak isian, setelah selesai melakukan pengisian klik tombol
		<strong>Refresh</strong>
	</p>
</div>
<div class="card card-primary card-outline">
	<div class="card-header">
		<h5 class="card-title m-0">Data Nilai <?php echo $aspek; ?></h5>
		<div class="card-tools">
			<button class="btn btn-success btn-sm" data-target="#myImportNilai" data-toggle="modal">
				<i class="fas fa-cloud-upload-alt"></i>&nbsp;Import
			</button>
		</div>
	</div>
	<div class="card-body">
		<table id="tb_rapor" class="table table-bordered table-striped table-sm">
			<thead>
				<tr>
					<th style="text-align: center;width:2.5%">No.</th>
					<th style="text-align: center;width:20%">Nomor Induk</th>
					<th style="text-align: center;">Nama Peserta Didik</th>
					<?php if ($_GET['d'] == '1' || $_GET['d'] == '2') : ?>
						<th style="text-align: center;width:20%">Nilai</th>
					<?php endif ?>
					<?php if ($_GET['d'] == '3' || $_GET['d'] == '4') : ?>
						<th style="text-align: center;width:20%">Rata-rata Nilai</th>
					<?php endif ?>
					<th style="text-align: center;width:20%">Aksi</th>
				</tr>
			</thead>
			<tbody>
				<?php
				$sql = "SELECT s.idsiswa, s.nis, s.nisn, s.nmsiswa FROM tbsiswa s INNER JOIN tbregistrasi rs USING(idsiswa) INNER JOIN tbregistrasi_detil rd USING(idreg) INNER JOIN tbthpel tp USING(idthpel) WHERE s.deleted='0' AND tp.aktif='1' ORDER BY s.nis";
				$qs = vquery($sql);
				$no = 0;
				foreach ($qs as $s) :
					$no++;
					if ($_GET['d'] == '1' || $_GET['d'] == '2') {
						$qcek = "SELECT nilaisikap FROM tbnilaisikap WHERE idsiswa='$s[idsiswa]' AND aspek='$_GET[d]'";
						if (cquery($qcek) > 0) {
							$qnilai = "SELECT AVG(nilaisikap) as rata FROM tbnilaisikap WHERE idsiswa='$s[idsiswa]' AND aspek='$_GET[d]' GROUP BY aspek";
							$nil = vquery($qnilai)[0];
							$nilai = number_format($nil['rata'], 2, ',', '.');
						} else {
							$nilai = '-';
						}
					}
					if ($_GET['d'] == '3' || $_GET['d'] == '4') {
						$qcek = "SELECT nilairapor FROM tbnilairapor WHERE idsiswa='$s[idsiswa]' AND aspek='$_GET[d]'";
						if (cquery($qcek) > 0) {
							$qnilai = "SELECT AVG(nilairapor) as rata FROM tbnilairapor WHERE idsiswa='$s[idsiswa]' AND aspek='$_GET[d]' GROUP BY idmapel";
							$nil = vquery($qnilai)[0];
							$nilai = number_format($nil['rata'], 2, ',', '.');
						} else {
							$nilai = '-';
						}
					}
				?>
					<tr>
						<td style="text-align:center"><?php echo $no . '.'; ?></td>
						<td style="text-align:center"><?php echo $s['nis'] . ' / ' . $s['nisn']; ?></td>
						<td title="<?php echo $s['idsiswa']; ?>">
							<?php echo ucwords(strtolower($s['nmsiswa'])); ?>
						</td>
						<td style="text-align:center">
							<?php echo $nilai; ?>
						</td>
						<td style="text-align:center">
							<button data-id="<?php echo $s['idsiswa']; ?>" class="btn btn-xs btn-info btnDetail">
								<i class="fas fa-edit" aria-hidden="true"></i>&nbsp;Detail
							</button>
							<button data-id="<?php echo $s['idsiswa']; ?>" class="btn btn-xs btn-success btnInput">
								<i class="fas fa-edit" aria-hidden="true"></i>&nbsp;Input
							</button>
						</td>
					</tr>
				<?php endforeach ?>
			</tbody>
		</table>
	</div>
</div>
<script type="text/javascript">
	$(function() {
		$('#tb_rapor').DataTable({
			"paging": true,
			"lengthChange": false,
			"searching": true,
			"ordering": false,
			"info": false,
			"autoWidth": false,
			"responsive": true,
		});
	});
	$(".btnInput").click(function() {
		let id = $(this).data('id');
		let asp = "<?php echo $_GET['d']; ?>";
		if (asp == '1' || asp == '2') {
			window.location.href = "index.php?p=inputsikap&id=" + id
		} else if (asp == '3') {
			window.location.href = "index.php?p=inputkognetif&id=" + id
		} else if (asp == '4') {
			window.location.href = "index.php?p=inputterampil&id=" + id
		}
	})
	$(".btnDetail").click(function() {
		let id = $(this).data('id');
		let asp = "<?php echo $_GET['d']; ?>";
		if (asp == '1' || asp == '2') {
			window.location.href = "index.php?p=detailsikap&id=" + id
		} else if (asp == '3') {
			window.location.href = "index.php?p=detailkognetif&id=" + id
		} else if (asp == '4') {
			window.location.href = "index.php?p=detailmotorik&id=" + id
		}
	})
	$(document).ready(function() {
		$(function() {
			const Toast = Swal.mixin({
				toast: true,
				position: 'top-center',
				showConfirmButton: false,
				timer: 3000
			});
		})
	})
</script>