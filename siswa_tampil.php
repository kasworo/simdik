<?php
if (isset($_POST['upload'])) {
	require_once 'assets/library/PHPExcel.php';
	require_once 'assets/library/excel_reader.php';
	if (empty($_FILES['filepd']['tmp_name'])) {
		echo "<script>
			$(function() {
				toastr.error('File Template Peserta Didik Kosong!','Mohon Maaf!',{
					timeOut:1000,
					fadeOut:1000
				});
			});
		</script>";
	} else {
		$data = new Spreadsheet_Excel_Reader($_FILES['filepd']['tmp_name']);
		$baris = $data->rowcount($sheet_index = 0);
		$isidata = $baris - 5;
		$sukses = 0;
		$gagal = 0;
		$update = 0;
		$idskul = getskul();
		for ($i = 6; $i <= $baris; $i++) {
			$xnik = $data->val($i, 2);
			$xnis = $data->val($i, 3);
			$xnisn = $data->val($i, 4);
			$xnama = $conn->real_escape_string($data->val($i, 5));
			$xtmplhr = $data->val($i, 6);
			$xtgllhr = $data->val($i, 7);
			$xjekel = $data->val($i, 8);
			$nmagama = $data->val($i, 9);
			$xanak = $data->val($i, 10);
			$xsdr = $data->val($i, 11);
			$xdrh = $data->val($i, 12);
			$xsakit = $data->val($i, 13);
			$xkeb = $data->val($i, 14);
			$xikut = $data->val($i, 15);
			$xtrans = $data->val($i, 16);
			$xjrk = $data->val($i, 17);
			$xwkt = $data->val($i, 18);
			$xltg = $data->val($i, 19);
			$xbjr = $data->val($i, 20);
			$xalmt = $data->val($i, 21);
			$xdesa	= $data->val($i, 22);
			$xkec	= $data->val($i, 23);
			$xkab	= $data->val($i, 24);
			$xprov = $data->val($i, 25);
			$xkdpos = $data->val($i, 26);
			$xnohp = $data->val($i, 27);
			$xolga = $data->val($i, 28);
			$xseni = $data->val($i, 29);
			$xorgn = $data->val($i, 30);
			$xlain = $data->val($i, 31);

			if (strlen($nmagama) == 1) {
				$xagama = $nmagama;
			} else {
				switch ($nmagama) {
					case 'Islam': {
							$xagama = 'A';
							break;
						}
					case 'Kristen': {
							$xagama = 'B';
							break;
						}
					case 'Katholik': {
							$xagama = 'C';
							break;
						}
					case 'Hindu': {
							$xagama = 'D';
							break;
						}
					case 'Buddha': {
							$xagama = 'E';
							break;
						}
					case 'Konghucu': {
							$xagama = 'F';
							break;
						}
					default: {
							$xagama = '';
							break;
						}
				}
			}
			// if($xnik==''){
			// 	echo "<script>
			// 		$(function() {
			// 			toastr.error('Cek Kolom NIK a.n ".$xnama."','Mohon Maaf!',{
			// 				timeOut:10000,
			// 				fadeOut:10000
			// 			});
			// 		});
			// 	</script>";
			// }
			// else 
			if ($xnis == '') {
				echo "<script>
					$(function() {
						toastr.error('Cek Kolom NIS a.n " . $xnama . "','Mohon Maaf!',{
							timeOut:10000,
							fadeOut:10000
						});
					});
				</script>";
			} else if (strlen($xnisn) <> 10 || $xnisn == '') {
				echo "<script>
					$(function() {
						toastr.error('Cek Kolom NISN a.n " . $xnama . "','Mohon Maaf!',{
							timeOut:10000,
							fadeOut:10000
						});
					});
				</script>";
			} else if (strlen($xnama) < 1 || $xnama == '') {
				echo "<script>
					$(function() {
						toastr.error('Cek Kolom Nama Lengkap a.n " . $xnama . "','Mohon Maaf!',{
							timeOut:1000,
							fadeOut:1000
						});
					});
				</script>";
			} else if (strlen($xtmplhr) < 1 || $xtmplhr == '') {
				echo "<script>
					$(function() {
						toastr.error('Cek Kolom Tempat Lahir a.n " . $xnama . "','Mohon Maaf!',{
							timeOut:1000,
							fadeOut:1000
						});
					});
				</script>";
			} else if (strlen($xtgllhr) < 1 || $xtgllhr == '') {
				echo "<script>
					$(function() {
						toastr.error('Cek Kolom Tanggal Lahir a.n " . $xnama . "','Mohon Maaf!',{
							timeOut:1000,
							fadeOut:1000
						});
					});
				</script>";
			} else if (strlen($xjekel) > 1 || $xjekel == '') {
				echo "<script>
					$(function() {
						toastr.error('Cek Kolom Jenis Kelamin a.n " . $xnama . "','Mohon Maaf!',{
							timeOut:1000,
							fadeOut:1000
						});
					});
				</script>";
			} else if ($xagama == '') {
				echo "<script>
					$(function() {
						toastr.error('Cek Kolom Agama a.n " . $xnama . "','Mohon Maaf!',{
							timeOut:1000,
							fadeOut:1000
						});
					});
				</script>";
			} else {
				$key = array(
					'nisn' => $xnisn,
					'nis' => $xnis
				);
				$ceksiswa = cekdata('tbsiswa', $key);
				if ($ceksiswa > 0) {
					$datasiswa = array(
						'idskul' => $idskul,
						'nmsiswa' => $xnama,
						'nik' => $xnik,
						'tmplahir' => $xtmplhr,
						'tgllahir' => $xtgllhr,
						'gender' => $xjekel,
						'idagama' => $xagama,
						'anake' => $xanak,
						'sdr' => $xsdr,
						'warganegara' => '1',
						'goldarah' => $xdrh,
						'rwysakit' => $xsakit,
						'kebkhusus' => $xkeb,
						'ikuts' => $xikut,
						'transpr' => $xtrans,
						'jarak' => $xjrk,
						'waktu' => $xwkt,
						'alamat' => $xalmt,
						'desa' => $xdesa,
						'kec' => $xkec,
						'kab' => $xkab,
						'prov' => $xprov,
						'kdpos' => $xkdpos,
						'lintang' => $xltg,
						'bujur' => $xbjr,
						'nohp' => $xnohp,
						'hobi1' => $xolga,
						'hobi2' => $xseni,
						'hobi3' => $xorgn,
						'hobi4' => $xlain,
						'deleted' => '0'
					);

					if (editdata('tbsiswa', $datasiswa, '', $key) > 0) {
						echo "<script>
							$(function() {
								toastr.success('Update Data Peserta Didik a.n " . $xnama . " Sukses!','Terima Kasih',{
									timeOut:3000,
									fadeOut:3000
								});
							});
						</script>";
						$update++;
					} else {
						echo "<script>
							$(function() {
								toastr.error('Update Data Peserta Didik a.n " . $xnama . " Gagal!','Terima Kasih',{
									timeOut:3000,
									fadeOut:3000
								});
							});
						</script>";
					}
				} else {
					$datasiswa = array(
						'idskul' => $idskul,
						'nmsiswa' => $xnama,
						'nik' => $xnik,
						'nis' => $xnis,
						'nisn' => $xnisn,
						'tmplahir' => $xtmplhr,
						'tgllahir' => $xtgllhr,
						'gender' => $xjekel,
						'idagama' => $xagama,
						'anake' => $xanak,
						'sdr' => $xsdr,
						'warganegara' => '1',
						'goldarah' => $xdrh,
						'rwysakit' => $xsakit,
						'kebkhusus' => $xkeb,
						'ikuts' => $xikut,
						'transpr' => $xtrans,
						'jarak' => $xjrk,
						'waktu' => $xwkt,
						'alamat' => $xalmt,
						'desa' => $xdesa,
						'kec' => $xkec,
						'kab' => $xkab,
						'prov' => $xprov,
						'kdpos' => $xkdpos,
						'lintang' => $xltg,
						'bujur' => $xbjr,
						'nohp' => $xnohp,
						'hobi1' => $xolga,
						'hobi2' => $xseni,
						'hobi3' => $xorgn,
						'hobi4' => $xlain
					);

					if (adddata('tbsiswa', $datasiswa) > 0) {
						echo "<script>
							$(function() {
								toastr.success('Tambah Data Peserta Didik a.n " . $xnama . " Sukses!','Terima Kasih',{
									timeOut:3000,
									fadeOut:3000
								});
							});
						</script>";
						$sukses++;
					} else {
						echo "<script>
							$(function() {
								toastr.error('Tambah Data Peserta Didik a.n " . $xnama . " Gagal!','Mohon Maaf',{
									timeOut:4000,
									fadeOut:3000
								});
							});
						</script>";
						$gagal++;
					}
				}
			}
		}
		echo "<script>
				$(function() {
					toastr.info('Ada " . $sukses . " data ditambah, " . $update . " data diupdate, " . $gagal . " data gagal ditambahkan!','Terimakasih',{
					timeOut:2000,
					fadeOut:2000
				});
			});
		</script>";
	}
}

if (isset($_POST['simpan']) && isset($_POST['idreg'])) {
	$sqlr = "SELECT idsiswa FROM tbregistrasi INNER JOIN tbthpel USING(idthpel) WHERE idsiswa='$_POST[idsiswa]' AND 'idthpel'='$_POST[kdthpel]' AND idjreg='$_POST[idreg]'";
	$cekregis = cquery($sqlr);
	if ($cekregis > 0) {
		echo "<script>
			$(function() {
				toastr.warning('Peserta Didik Sudah Pernah Teregistrasi!','Mohon Maaf', {
					timeOut:1000,
					fadeOut:1000,
					onHidden:function(){
						window.location.href='index.php?p=datasiswa';
					}
				});
			});
		</script>";
	} else {
		$data = array(
			'idsiswa' => $_POST['idsiswa'],
			'idjreg' => $_POST['idreg'],
			'idthpel' => $_POST['kdthpel']
		);
		$rows = adddata('tbregistrasi', $data);
		if ($rows > 0) {
			echo "<script>
				$(function() {
					toastr.success('Registrasi Untuk Peserta Didik Berhasil!','Terima Kasih', {
						timeOut:1000,
						fadeOut:1000,
						onHidden:function(){
							window.location.href='index.php?p=datasiswa';
						}
					});
				});
			</script>";
		} else {
			echo "<script>
					$(function() {
						toastr.error('Registrasi Untuk Peserta Didik Gagal!','Mohon Maaf', {
						timeOut:1000,
						fadeOut:1000,
						onHidden:function(){
							window.location.href='index.php?p=datasiswa';
						}
					});
				});
			</script>";
		}
	}
}
?>
<div class="modal fade" id="myImportPD" aria-modal="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<form method="POST" enctype="multipart/form-data" action="">
				<div class="modal-header">
					<h5 class="modal-title">Import Data Peserta Didik</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">×</span>
					</button>
				</div>
				<div class="modal-body">
					<div class="col-sm-12">
						<div class="row">
							<label for="filepd">Pilih File Template</label>
							<div class="custom-file">
								<input type="file" class="custom-file-input file" id="filepd" name="filepd">
								<label class="custom-file-label" for="filepd">Pilih file</label>
							</div>
							<p style="color:red;margin-top:10px"><em>Hanya mendukung file *.xls (Microsoft Excel
									97-2003)</em></p>
						</div>
					</div>
				</div>
				<div class="modal-footer justify-content-between">
					<a href="siswa_template.php?d=1" class="btn btn-success btn-sm btn-flat" target="_blank"><i class="fas fa-download"></i> Download</a>
					<button type="submit" name="upload" class="btn btn-primary btn-sm btn-flat">
						<i class="fas fa-upload"></i>&nbsp;Upload
					</button>
					<button type="button" class="btn btn-danger btn-sm btn-flat" data-dismiss="modal"><i class="fas fa-power-off"></i> Tutup</button>
				</div>
			</form>
		</div>
	</div>
</div>


<div class="modal fade" id="myRegisPD" aria-modal="true">
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
							<input type="hidden" class="form-control input-sm" id="idsiswa" name="idsiswa">
							<input type="text" class="form-control input-sm col-sm-6" id="nmsiswa" name="nmsiswa" disabled="true">
						</div>
						<div class="form-group row mb-2">
							<label class="col-sm-5">Tahun Pelajaran</label>
							<script src="js/getregistrasi.js"></script>
							<select class="form-control input-sm col-sm-6" id="kdthpel" name="kdthpel" onchange="piltahun(this.value);">
								<option value="">..Pilih..</option>
								<?php
								$qtp = viewdata('tbthpel', $key);
								foreach ($qtp as $tp) :
								?>
									<option value="<?php echo $tp['idthpel']; ?>">
										<?php echo $tp['desthpel'];	?>
									</option>
								<?php endforeach ?>
							</select>
						</div>
						<div class="form-group row mb-2">
							<label class="col-sm-5">Terdaftar Sebagai</label>
							<select class="form-control input-sm col-sm-6" id="idreg" name="idreg" disabled>
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
		<h4 class="card-title">Data Peserta Didik</h4>
		<div class="card-tools">
			<a href="index.php?p=addsiswa" class="btn btn-primary btn-sm">
				<i class="fas fa-plus-circle"></i>&nbsp;Tambah
			</a>
			<button class="btn btn-success btn-sm" data-toggle="modal" data-target="#myImportPD">
				<i class="fas fa-cloud-upload-alt"></i>&nbsp;Import
			</button>
			<button id="hapusall" class="btn btn-danger btn-sm">
				<i class="fas fa-trash-alt"></i>&nbsp;Hapus
			</button>
		</div>
	</div>
	<div class="card-body">
		<div class="table-responsive">
			<table id="tb_siswa" class="table table-bordered table-striped table-sm">
				<thead>
					<tr>
						<th style="text-align: center;width:2.5%">No.</th>
						<th style="text-align: center;width:22.5%">Nama User</th>
						<th style="text-align: center;width:17.5%">NIS / NISN</th>
						<th style="text-align: center;">Alamat</th>
						<th style="text-align: center;width:25%">Aksi</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$data = array(
						'deleted' => '0'
					);
					$qs = viewdata('tbsiswa', $data, '', 'nis');
					// $sql="SELECT s.idsiswa, s.nis, s.nisn, s.nmsiswa, s.alamat FROM tbsiswa s LEFT JOIN tbregistrasi rg USING(idsiswa) INNER JOIN tbthpel tp USING(idthpel) WHERE tp.aktif='1' OR rg.idjreg is NULL ORDER BY s.nis";
					// $qs=vquery($sql);
					$no = 0;
					foreach ($qs as $s) {
						$no++;

					?>
						<tr>
							<td style="text-align:center"><?php echo $no . '.'; ?></td>
							<td title="<?php echo $s['idsiswa']; ?>"><?php echo ucwords(strtolower($s['nmsiswa'])); ?>
							</td>
							<td><?php echo $s['nis'] . ' / ' . $s['nisn']; ?></td>
							<td><?php echo $s['alamat']; ?></td>
							<td style="text-align: center">
								<button data-id="<?php echo $s['idsiswa']; ?>" class="btn btn-xs btn-success btnUpdate">
									<i class="fas fa-edit"></i>&nbsp;Detail
								</button>
								<button data-id="<?php echo $s['idsiswa']; ?>" class="btn btn-xs btn-info btnRegis" data-toggle="modal" data-target="#myRegisPD">
									<i class="far fa-check-square"></i>&nbsp;Registrasi
								</button>
								<button data-id="<?php echo $s['idsiswa']; ?>" class="btn btn-xs btn-danger btnHapus">
									<i class="fas fa-trash-alt"></i>&nbsp;Hapus
								</button>
							</td>
						</tr>
					<?php } ?>
				</tbody>
			</table>
		</div>
	</div>
</div>
<script type="text/javascript">
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

	$(".btnUpdate").click(function() {
		let id = $(this).data('id');
		window.location.href = "index.php?p=addsiswa&id=" + id

	})

	$(".btnRegis").click(function() {
		let id = $(this).data('id');
		$.ajax({
			url: 'siswa_isiregistrasi.php',
			type: 'post',
			dataType: 'json',
			data: 'id=' + id,
			success: function(e) {
				$("#judule").html(e.judul);
				$("#idsiswa").val(e.idsiswa);
				$("#nmsiswa").val(e.nmsiswa);
				$("#idreg").val(e.regis);
				$("#simpan").html(e.tmb);
			}
		})
	})

	$(".btnHapus").click(function() {
		let id = $(this).data('id');
		Swal.fire({
			title: 'Anda Yakin?',
			text: "Menghapus Data Peserta Didik" + id,
			icon: 'question',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'Hapus',
			cancelButtonText: 'Batal'
		}).then((result) => {
			if (result.value) {
				$.ajax({
					type: "POST",
					url: "siswa_simpan.php",
					data: "aksi=hapus&id=" + id,
					success: function(data) {
						toastr.success(data);
					}
				})
				window.location.reload();
			}
		})
	})

	$("#hapusall").click(function() {
		let id = $(this).data('id');
		Swal.fire({
			title: 'Anda Yakin?',
			text: "Menghapus Seluruh	Data Peserta Didik" + id,
			icon: 'question',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'Hapus',
			cancelButtonText: 'Batal'
		}).then((result) => {
			if (result.value) {
				$.ajax({
					type: "POST",
					url: "siswa_simpan.php",
					data: "aksi=kosong&id=" + id,
					success: function(data) {
						toastr.success(data);
					}
				})
				window.location.reload();
			}
		})
	})
</script>