<?php
if (isset($_POST['simpan'])) {
	if ($_POST['idreg'] == '1' || $_POST['idreg'] == '4') {
		$idthn = array('idthpel' => $_POST['kdthpel']);
		$th = viewdata('tbthpel', $idthn)[0];
		$tgl = $th['awal'];
	} else {
		$tgl = date('Y-m-d');
	}
	$dtr = array(
		'idsiswa' => $_POST['idsiswa'],
		'idjreg' => $_POST['idreg'],
		'idthpel' => $_POST['kdthpel']
	);
	$reg = viewdata('tbregistrasi', $dtr)[0];
	$sqlr = "SELECT idsiswa FROM tbregistrasi INNER JOIN tbregistrasi_detil USING(idreg) INNER JOIN tbkelas USING(idkelas) INNER JOIN tbthpel USING(idthpel) WHERE idsiswa='$_POST[idsiswa]' AND idthpel='$_POST[kdthpel]' AND idjreg='$_POST[idreg]'";
	$cekregis = cquery($sqlr);
	if ($cekregis === 0) {
		$data = array(
			'idreg' => $reg['idreg'],
			'idkelas' => $_POST['kdkelas'],
			'tglreg' => $tgl
		);
		$rows = adddata('tbregistrasi_detil', $data);
		if ($rows > 0) {
			echo "<script>
				$(function() {
					toastr.success('Registrasi Rombel Untuk Peserta Didik Berhasil!','Terimakasih', {
						timeOut:1000,
						fadeOut:1000,
						onHidden:function(){
							window.location.href='index.php?p=regsiswa';
						}
					});
				});
			</script>";
		} else {
			echo "<script>
				$(function() {
					toastr.error('Registrasi Rombel Untuk Peserta Didik Gagal!','Mohon Maaf', {
					timeOut:1000,
					fadeOut:1000,
					onHidden:function(){
						window.location.href='index.php?p=regsiswa';
					}
				});
			});
			</script>";
		}
	} else {
		$data = array(
			'idkelas' => $_POST['kdkelas'],
			'tglreg' => $tgl
		);
		$key = array('idjreg' => $_POST['idreg']);
		$rows = editdata('tbregistrasi_detil', $data, '', $key);
		if ($rows > 0) {
			echo "<script>
					$(function() {
						toastr.success('Update Rombel Untuk Peserta Didik Berhasil!','Terimakasih', {
						timeOut:1000,
						fadeOut:1000,
						onHidden:function(){
							window.location.href='index.php?p=regsiswa';
						}
					});
				});
			</script>";
		} else {
			echo "<script>
					$(function() {
						toastr.error('Update Rombel Untuk Peserta Didik Gagal!','Mohon Maaf', {
						timeOut:1000,
						fadeOut:1000,
						onHidden:function(){
							window.location.href='index.php?p=regsiswa';
						}
					});
				});
			</script>";
		}
	}
}

if (isset($_POST['upload'])) {
	require_once 'assets/library/PHPExcel.php';
	require_once 'assets/library/excel_reader.php';
	if (empty($_FILES['filereg']['tmp_name'])) {
		echo "<script>
					$(function() {
						toastr.error('File Template Registrasi Peserta Didik Kosong!','Mohon Maaf!',{
							timeOut:1000,
							fadeOut:1000
					});
				});
			</script>";
	} else {
		$data = new Spreadsheet_Excel_Reader($_FILES['filereg']['tmp_name']);
		$baris = $data->rowcount($sheet_index = 0);
		$isidata = $baris - 5;
		$sukses = 0;
		$gagal = 0;
		$update = 0;
		for ($i = 6; $i <= $baris; $i++) {
			$xnis = $data->val($i, 2);
			$xnisn = $data->val($i, 3);
			$xidreg = $data->val($i, 5);
			$xidkelas = $data->val($i, 6);
			$xthpel = $data->val($i, 7);
			$ds = viewdata('tbsiswa', array('nis' => $xnis, 'nisn' => $xnisn))[0];
			$idsiswa = $ds['idsiswa'];
			$dreg = viewdata('tbthpel', array('nmthpel' => $xthpel))[0];
			$idthpel = $dreg['idthpel'];
			$xtglreg = $dreg['awal'];
			$key = array(
				'idsiswa' => $idsiswa,
				'idthpel' => $idthpel
			);
			if (cekdata('tbregistrasi', $key) > 0) {
				$dr = viewdata('tbregistrasi', $key)[0];
				$keyrg = array(
					'idreg' => $dr['idreg']
				);
				if (cekdata('tbregistrasi_detil', $keyrg) > 0) {
					$datane = array(
						'idkelas' => $xidkelas,
						'tglreg' => $xtglreg
					);
					editdata('tbregistrasi_detail', $datane, '', $keyrg);
				} else {
					$datane = array(
						'idreg' => $dr['idreg'],
						'idkelas' => $xidkelas,
						'tglreg' => $xtglreg
					);
					adddata('tbregistrasi_detil', $datane);
				}
				$update++;
			} else {
				$datane = array(
					'idjreg' => $xidreg,
					'idsiswa' => $idsiswa,
					'idthpel' => $idthpel,
				);
				$tambah = adddata('tbregistrasi', $datane);
				if ($tambah > 0) {
					$sukses++;
				} else {
					$gagal++;
				}
			}
			if ($gagal > 0) {
				echo "<script>
						$(function() {
							toastr.error('Ada " . $gagal . " Data Gagal Ditambahkan','Mohon Maaf!',{
								timeOut:1000,
								fadeOut:1000,
								onHidden:function(){
									location.(reload);
								}
							});
						});
					</script>";
			}
			if ($sukses > 0) {
				echo "<script>
						$(function() {
							toastr.success('Ada " . $sukses . " Data Berhasil Ditambahkan','Terima Kasih',{
								timeOut:1000,
								fadeOut:1000,
								onHidden:function(){
									location.reload();
								}
							});
						});
					</script>";
			}
			if ($update > 0) {
				echo "<script>
						$(function() {
							toastr.warning('Ada " . $update . " Data Berhasil Diupdate!','Terima Kasih',{
								timeOut:1000,
								fadeOut:1000,
								onHidden:function(){
									location.reload;
								}
							});
						});
					</script>";
			}
		}
	}
}

if (isset($_POST['lanjut'])) {
	$sqth = "SELECT idthpel FROM tbthpel WHERE aktif='1'";
	$th = vquery($sqth)[0];
	$saiki = $th['idthpel'];
	$sms = $th['idthpel'] - 1;
	$sukses = 0;
	$update = 0;
	$gagal = 0;
	$sqlm = "SELECT idsiswa, nmsiswa, nis, nisn, idkelas, nmkelas, idthpel FROM tbsiswa INNER JOIN tbregistrasi USING(idsiswa) INNER JOIN tbregistrasi_detil USING(idreg) INNER JOIN tbkelas USING(idkelas) INNER JOIN tbthpel USING(idthpel) WHERE deleted='0' AND idthpel='$sms' AND idjreg<='3' ORDER BY nis";

	$dlama = vquery($sqlm);
	foreach ($dlama as $dl) {
		$key = array(
			'idsiswa' => $dl['idsiswa'],
			'idthpel' => $dl['idthpel']
		);
		if (cekdata('tbregistrasi', $key) > 0) {
			$dr = viewdata('tbregistrasi', $key)[0];
			$keyrg = array(
				'idreg' => $dr['idreg']
			);
			if (cekdata('tbregistrasi_detil', $keyrg) > 0) {
				$datane = array(
					'idkelas' => $dl['idkelas'],
					'tglreg' => date('Y-m-d')
				);
				editdata('tbregistrasi_detail', $datane, '', $keyrg);
			} else {
				$datane = array(
					'idreg' => $dr['idreg'],
					'idkelas' => $dl['idkelas'],
					'tglreg' => date('Y-m-d')
				);
				adddata('tbregistrasi_detil', $datane);
			}
			$update++;
		} else {
			$datane = array(
				'idjreg' => '4',
				'idsiswa' => $dl['idsiswa'],
				'idthpel' => $dl['idthpel'],
			);
			$tambah = adddata('tbregistrasi', $datane);
			if ($tambah > 0) {
				$sukses++;
			} else {
				$gagal++;
			}
		}
	}
}
if (isset($_POST['naik'])) {
	$sqth = "SELECT idthpel FROM tbthpel WHERE aktif='1'";
	$th = vquery($sqth)[0];
	$saiki = $th['idthpel'];
	$sms = $th['idthpel'] - 1;
	$sqlm = "SELECT idsiswa, nmsiswa, nis, nisn, idkelas, idthpel, nmkelas FROM tbsiswa INNER JOIN tbregistrasi USING(idsiswa) INNER JOIN tbregistrasi_detil USING(idreg) INNER JOIN tbkelas USING(idkelas) INNER JOIN tbthpel USING(idthpel) WHERE deleted='0' AND idthpel='$sms' AND (idjreg='2' OR idjreg='4') AND idkelas<>'9' GROUP BY idsiswa ORDER BY nis";
	$dlama = vquery($sqlm);

	$sukses = 0;
	$update = 0;
	$gagal = 0;
	foreach ($dlama as $dl) {
		$key = array(
			'idsiswa' => $dl['idsiswa'],
			'idthpel' => $dl['idthpel']
		);
		if (cekdata('tbregistrasi', $key) > 0) {
			$dr = viewdata('tbregistrasi', $key)[0];
			$keyrg = array(
				'idreg' => $dr['idreg']
			);
			if (cekdata('tbregistrasi_detil', $keyrg) > 0) {
				$datane = array(
					'idkelas' => $dl['idkelas'] + 1,
					'tglreg' => date('Y-m-d')
				);
				editdata('tbregistrasi_detail', $datane, '', $keyrg);
			} else {
				$datane = array(
					'idreg' => $dr['idreg'],
					'idkelas' => $dl['idkelas'] + 1,
					'tglreg' => date('Y-m-d')
				);
				adddata('tbregistrasi_detil', $datane);
			}
			$update++;
		} else {
			$datane = array(
				'idjreg' => '3',
				'idsiswa' => $dl['idsiswa'],
				'idthpel' => $dl['idthpel'],
			);
			$tambah = adddata('tbregistrasi', $datane);

			if ($tambah > 0) {
				$sukses++;
			} else {
				$gagal++;
			}
		}
	}
}
?>
<div class="modal fade" id="myImportReg" aria-modal="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<form method="POST" enctype="multipart/form-data" action="">
				<div class="modal-header">
					<h5 class="modal-title">Import Data Registrasi Peserta Didik</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">×</span>
					</button>
				</div>
				<div class="modal-body">
					<div class="col-sm-12">
						<div class="row">
							<label for="filereg">Pilih File Template</label>
							<div class="custom-file">
								<input type="file" class="custom-file-input file" id="filereg" name="filereg">
								<label class="custom-file-label" for="filereg">Pilih file</label>
							</div>
							<p style="color:red;margin-top:10px"><em>Hanya mendukung file *.xls (Microsoft Excel
									97-2003)</em></p>
						</div>
					</div>
				</div>
				<div class="modal-footer justify-content-between">
					<a href="siswa_registmp.php" class="btn btn-success btn-sm" target="_blank"><i class="fas fa-download"></i> Download</a>
					<button type="submit" name="upload" class="btn btn-primary btn-sm">
						<i class="fas fa-upload"></i>&nbsp;Upload
					</button>
					<button type="button" class="btn btn-danger btn-sm" data-dismiss="modal"><i class="fas fa-power-off"></i> Tutup</button>
				</div>
			</form>
		</div>
	</div>
</div>
<div class="modal fade" id="myRegPD" aria-modal="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="judule"></h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">×</span>
				</button>
			</div>
			<form action="" method="post">
				<div class="modal-body">
					<div class="col-sm-12">
						<div class="form-group row mb-2">
							<label class="col-sm-5">Peserta Didik</label>
							<input type="hidden" class="form-control form-control-sm" id="idsiswa" name="idsiswa">
							<input type="text" class="form-control form-control-sm col-sm-6" id="nmsiswa" name="nmsiswa" disabled="true">
						</div>
						<div class="form-group row mb-2">
							<label class="col-sm-5">Tahun Pelajaran</label>
							<select class="form-control form-control-sm col-sm-6" id="kdthpel" name="kdthpel" readonly>
								<option value="">..Pilih..</option>
								<?php
								$qtp = viewdata('tbthpel', $key);
								foreach ($qtp as $tp) :
								?>
									<option value="<?php echo $tp['idthpel']; ?>" <?php echo $tp['aktif'] == '1' ? "selected" : ""; ?>>
										<?php echo $tp['desthpel']; ?>
									</option>
								<?php endforeach ?>
							</select>
						</div>
						<div class="form-group row mb-2">
							<label class="col-sm-5">Terdaftar Sebagai</label>
							<select class="form-control form-control-sm col-sm-6" id="idreg" name="idreg" readonly>
								<option value="">..Pilih..</option>
								<?php
								$sqreg = "SELECT*FROM ref_jnsregistrasi";
								$qreg = vquery($sqreg);
								foreach ($qreg as $rg) :
								?>
									<option value="<?php echo $rg['idjreg']; ?>"><?php echo $rg['jnsregistrasi']; ?>
									</option>
								<?php endforeach ?>
							</select>
						</div>
						<div class="form-group row mb-2">
							<label class="col-sm-5">Kelas</label>
							<select class="form-control form-control-sm col-sm-6" id="kdkelas" name="kdkelas">
								<option value="">..Pilih..</option>
								<?php
								$sqkls = "SELECT idkelas, nmkelas FROM tbkelas INNER JOIN tbskul USING(idjenjang)";
								$qkls = vquery($sqkls);
								foreach ($qkls as $kl) :
								?>
									<option value="<?php echo $kl['idkelas']; ?>"><?php echo $kl['nmkelas']; ?></option>
								<?php endforeach ?>
							</select>
						</div>
					</div>
				</div>
				<div class="modal-footer justify-content-between">
					<button type="submit" class="btn btn-primary btn-md col-4" id="simpan" name="simpan">
						<i class="fas fa-save"></i> Simpan
					</button>
					<button type="button" class="btn btn-danger btn-md col-4" data-dismiss="modal">
						<i class="fas fa-power-off"></i> Tutup
					</button>
				</div>
			</form>
		</div>
	</div>
</div>
<div class="card card-secondary card-outline">
	<div class="card-header">
		<h4 class="card-title">Pengaturan Kelas Periode <?php echo $tapel; ?></h4>
		<div class="card-tools">
			<form action="" method="post">
				<a href="#" class="btn btn-success btn-sm" data-target="#myImportReg" data-toggle="modal">
					<i class="fas fa-cloud-upload-alt"></i>&nbsp;Import
				</a>
				<?php
				$where = array('aktif' => '1');
				$th = viewdata('tbthpel', $where)[0];
				if (substr($th['nmthpel'], -1) == '2') :
				?>
					<button type="submit" class="btn btn-primary btn-sm" name="lanjut" id="lanjut">
						<i class="fas fa-plus-circle"></i>&nbsp;Lanjutkan
					</button>
				<?php else : ?>
					<button type="submit" class="btn btn-primary btn-sm" name="naik" id="naik">
						<i class="fas fa-plus-circle"></i>&nbsp;Naik Kelas
					</button>
				<?php endif; ?>
			</form>
		</div>
	</div>
	<div class="card-body">
		<div class="table-responsive">
			<table id="tb_siswa" class="table table-bordered table-striped table-sm">
				<thead>
					<tr>
						<th style="text-align: center;width:2.5%">No.</th>
						<th style="text-align: center;width:20%">Nomor Induk</th>
						<th style="text-align: center">Nama Peserta Didik</th>
						<th style="text-align: center;width:10%">Kelas</th>
						<th style="text-align: center;width:17.5%">Aksi</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$no = 0;
					$sqlb = "SELECT idsiswa, nmsiswa, nis, nisn, nmkelas FROM tbsiswa LEFT JOIN tbregistrasi USING(idsiswa) LEFT JOIN tbregistrasi_detil USING(idreg) LEFT JOIN tbkelas USING(idkelas) INNER JOIN tbthpel USING(idthpel) WHERE deleted='0' AND aktif='1'GROUP BY idsiswa ORDER BY nis";
					$qs = vquery($sqlb);
					foreach ($qs as $s) :
						$no++;
					?>
						<tr>
							<td style="text-align:center"><?php echo $no . '.'; ?></td>
							<td style="text-align: center" title="<?php echo $s['idsiswa']; ?>">
								<?php echo $s['nis'] . ' / ' . $s['nisn']; ?></td>
							<td>
								<?php echo ucwords(strtolower($s['nmsiswa'])); ?>
							</td>
							<td style="text-align: center">
								<?php echo $s['nmkelas']; ?>
							</td>
							<td style="text-align:center">
								<button data-target="#myRegPD" data-toggle="modal" data-id="<?php echo $s['idsiswa']; ?>" class="btn btn-xs btn-secondary col-sm-8 btnRegistrasi">
									<i class="fas fa-edit"></i>&nbsp;Lengkapi
								</button>
							</td>
						</tr>
					<?php endforeach ?>
				</tbody>
			</table>
		</div>
	</div>
</div>
<script type="text/javascript">
	$(document).ready(function() {
		$("#myRegPD").on('hidden.bs.modal', function() {
			window.location.reload();
		})
	})
	$(function() {
		$('#tb_siswa').DataTable({
			"paging": true,
			"lengthChange": false,
			"searching": true,
			"ordering": false,
			"info": false,
			"autoWidth": false,
			"responsive": true,
		});
	});

	$(".btnRegistrasi").click(function() {
		let id = $(this).data('id');
		$.ajax({
			url: 'siswa_isikelas.php',
			type: 'post',
			dataType: 'json',
			data: 'id=' + id,
			success: function(e) {
				$("#judule").html(e.judul);
				$("#idsiswa").val(e.idsiswa);
				$("#nmsiswa").val(e.nmsiswa);
				$("#kdkelas").val(e.kelas);
				$("#idreg").val(e.regis);
				$("#simpan").html(e.tmb);
			}
		})
	})


	$("#btnrefresh").click(function() {
		window.location.reload();
	})
</script>