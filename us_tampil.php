<?php
// require_once 'assets/library/PHPExcel.php';
// require_once 'assets/library/excel_reader.php';
// if (isset($_POST['upload'])) {
//     if (empty($_FILES['filetmp']['tmp_name'])) {
//         echo "<script>
// 				$(function() {
// 					toastr.error('File Template Kosong!','Mohon Maaf!',{
// 						timeOut:1000,
// 						fadeOut:1000
// 					});
// 				});
// 			</script>";
//     } else {
//         $data = new Spreadsheet_Excel_Reader($_FILES['filetmp']['tmp_name']);
//         $baris = $data->rowcount($sheet_index = 0);
//         $isidata = $baris - 5;
//         $sukses = 0;
//         $gagal = 0;
//         $update = 0;
//         $batal = 0;
//         $idskul = getskul();
//         for ($i = 6; $i <= $baris; $i++) {
//             $xnis = $data->val($i, 2);
//             $xnisn = $data->val($i, 3);
//             $xnmsiswa = $data->val($i, 4);
//             $xtglak = $data->val($i, 5);
//             $xnous = $data->val($i, 6);
//             $xtglus = $data->val($i, 7);
//             $xlanjut = $data->val($i, 8);
//             $xslta = $data->val($i, 9);
//         }
//     }
// }

if (isset($_POST['tambahin'])) {
	$sqt = "SELECT right(nmthpel,1) as cekth FROM tbthpel WHERE aktif='1'";
	$ct = vquery($sqt)[0];
	$cektahun = $ct['cekth'];

	$sql = "SELECT idsiswa, idthpel FROM tbregistrasi INNER JOIN tbthpel USING(idthpel) WHERE aktif='1' AND idjreg='8'";

	$ceksiswa = cquery($sql);
	if ($cektahun != '1' && $ceksiswa == 0) {
		echo "<script>
				$(function() {
					toastr.error('Peserta Didik Belum Diluluskan!', 'Mohon Maaf...', {
						timeOut: 1000,
						fadeOut: 1000
					});
				});
				</script>";
	} else {
		$sukses = 0;
		$gagal = 0;
		$update = 0;
		$dreg = vquery($sql);
		foreach ($dreg as $reg) {
			$qmp = viewdata('tbmapel');
			foreach ($qmp as $mp) {
				$qus = "SELECT AVG(nilairapor) as nilaius FROM tbnilairapor WHERE idsiswa='$reg[idsiswa]' AND idmapel='$mp[idmapel]' GROUP BY idmapel";
				$us = vquery($qus)[0];
				$nilus = $us['nilaius'];
				$keyus = array(
					'idsiswa' => $reg['idsiswa'],
					'idthpel' => $reg['idthpel'],
					'idmapel' => $mp['idmapel']
				);
				if (cekdata('tbnilaius', $keyus) > 0) {
					$dataus = array(
						'nilaius' => $nilus,
						'tglinput' => date('Y-m-d')
					);
					if (editdata('tbnilaius', $dataus, '', $keyus) > 0) {
						$update++;
					}
				} else {
					$dataus = array(
						'idsiswa' => $reg['idsiswa'],
						'idthpel' => $reg['idthpel'],
						'idmapel' => $mp['idmapel'],
						'nilaius' => $nilus,
						'tglinput' => date('Y-m-d')
					);
					if (adddata('tbnilaius', $dataus) > 0) {
						$sukses++;
					} else {
						$gagal++;
					}
				}
			}
		}
		echo "<script>
                    $(function() {
                        toastr.info('Peserta Didik Berhasil Dilulusin!', 'Informasi', {
                            timeOut: 1000,
                            fadeOut: 1000,
                            onHidden: function() {
                                $('#myLulusPD').hide();
                            }
                        });
                    });
                    </script>";
	}
}
?>
<div class="modal fade" id="myImportIjazah" aria-modal="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<form method="POST" enctype="multipart/form-data" action="">
				<div class="modal-header">
					<h5 class="modal-title">Import Nilai Ijazah</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">??</span>
					</button>
				</div>
				<div class="modal-body">
					<div class="col-sm-12">
						<div class="row">
							<label for="filerwy">Pilih File Template</label>
							<div class="custom-file">
								<input type="file" class="custom-file-input file" id="filerwy" name="filerwy">
								<label class="custom-file-label" for="filerwy">Pilih file</label>
							</div>
							<p style="color:red;margin-top:10px"><em>Hanya mendukung file *.xls (Microsoft Excel
									97-2003)</em></p>
						</div>
					</div>
				</div>
				<div class="modal-footer justify-content-between">
					<a href="us_template.php" class="btn btn-success btn-sm" target="_blank">
						<i class="fas fa-download"></i> Download
					</a>
					<button type="submit" name="upload" class="btn btn-primary btn-sm">
						<i class="fas fa-upload"></i>&nbsp;Upload
					</button>
					<button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">
						<i class="fas fa-power-off"></i> Tutup
					</button>
				</div>
			</form>
		</div>
	</div>
</div>

<div class="card card-secondary card-outline">
	<div class="card-header">
		<h4 class="card-title">Data Peserta Didik Tingkat Akhir</h4>
		<div class="card-tools">
			<form action="" method="post">
				<button type="submit" class="btn btn-info btn-sm" id="btnTambah" name="tambahin">
					<i class="fas fa-plus-circle"></i>&nbsp;Tambah
				</button>
				<a href="#" class="btn btn-secondary btn-sm" data-toggle="modal" data-target="#myImportIjazah">
					<i class="fas fa-cloud-upload-alt"></i>&nbsp;Import
				</a>
			</form>
		</div>
	</div>
	<div class="card-body">
		<div class="table-responsive">
			<table id="tb_siswa" class="table table-bordered table-striped table-sm">
				<thead>
					<tr>
						<th style="text-align: center;width:2.5%">No.</th>
						<th style="text-align: center;">Nama Peserta</th>
						<th style="text-align: center;width:15%">NIS / NISN</th>
						<th style="text-align: center;width:15%">Jumlah</th>
						<th style="text-align: center;width:15%">Rerata</th>
						<th style="text-align: center;width:15%">Aksi</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$sql = "SELECT s.idsiswa, s.nis, s.nisn, s.nmsiswa FROM tbsiswa s INNER JOIN tbregistrasi r USING(idsiswa) INNER JOIN tbthpel t USING(idthpel) WHERE r.idjreg='8' AND t.aktif='1' ORDER BY s.nis";
					$qs = vquery($sql);
					$no = 0;
					foreach ($qs as $s) {
						$no++;
						$squs = "SELECT AVG(nilaius) as rata, SUM(nilaius) as jml FROM tbnilaius us LEFT JOIN tbthpel tp USING(idthpel) WHERE idsiswa='$s[idsiswa]' AND tp.aktif='1' GROUP BY idsiswa";
						if (cquery($squs) > 0) {
							$us = vquery($squs)[0];
							$jml = number_format(round($us['jml'], 2), 1, ',', '.');
							$rata = number_format(round($us['rata'], 2), 2, ',', '.');
						} else {
							$rata = '';
							$jml = '';
						}
					?>
						<tr>
							<td style="text-align:center"><?php echo $no . '.'; ?></td>
							<td title="<?php echo $s['idsiswa']; ?>">
								<?php echo ucwords(strtolower($s['nmsiswa'])); ?>
							</td>
							<td style="text-align:center"><?php echo $s['nis'] . ' / ' . $s['nisn']; ?></td>
							<td style="text-align:center">
								<?php
								echo $jml;
								?>
							</td>
							<td style="text-align:center">
								<?php
								echo $rata;
								?>
							</td>
							<td style="text-align: center">
								<a href="index.php?p=detailus&id=<?php echo $s['idsiswa']; ?>" class="btn btn-xs btn-secondary">
									<i class="fas fa-list"></i>&nbsp;Detail
								</a>
								<a href="index.php?p=inputus&id=<?php echo $s['idsiswa']; ?>" class="btn btn-xs btn-success">
									<i class="fas fa-edit"></i>&nbsp;Input
								</a>
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
</script>