<?php
$idsiswa = $_GET['id'];
$ds = viewdata('tbsiswa', array('idsiswa' => $_GET['id']))[0];
$namasiswa = ucwords(strtolower($ds['nmsiswa']));

if (isset($_POST['simpan'])) {
	$sqtahun = "SELECT idthpel FROM tbthpel WHERE aktif='1' AND right(nmthpel,1)='2'";
	if (cquery($sqtahun) > 0) {
		$th = vquery($sqtahun)[0];
		$idthpel = $th['idthpel'];
		$rows = isset($_POST['mapel']) ? $_POST['mapel'] : 1;
		$i = 0;
		$tambah = 0;
		$edit = 0;
		foreach ($rows as $row) {
			$teori = array(
				'idsiswa' => $idsiswa,
				'idthpel' => $idthpel,
				'idmapel' => $_POST['mapel'][$i],
				'aspek' => '1'
			);

			$cekteori = cekdata('tbnilaius', $teori);
			if ($cekteori > 0) {
				$nilai = array(
					'nilaius' => $_POST['teori'][$i]
				);
				$editteori = editdata('tbnilaius', $nilai, '', $teori);
				$edit++;
			} else {
				$nilai = array(
					'idsiswa' => $idsiswa,
					'idthpel' => $idthpel,
					'idmapel' => $_POST['mapel'][$i],
					'nilaius' => $_POST['teori'][$i],
					'aspek' => '1'
				);
				$tambahteori = adddata('tbnilaius', $nilai);
				$tambah++;
			}

			$praktek = array(
				'idsiswa' => $idsiswa,
				'idthpel' => $idthpel,
				'idmapel' => $_POST['mapel'][$i],
				'aspek' => '2'
			);
			$cekpraktek = cekdata('tbnilaius', $praktek);
			if ($cekpraktek > 0) {
				$nilai = array(
					'nilaius' => $_POST['praktik'][$i]
				);
				$editpraktek = editdata('tbnilaius', $nilai, '', $praktek);
				$edit++;
			} else {
				$nilai = array(
					'idsiswa' => $idsiswa,
					'idthpel' => $idthpel,
					'idmapel' => $_POST['mapel'][$i],
					'nilaius' => $_POST['praktik'][$i],
					'aspek' => '2'
				);
				$tambahpraktek = adddata('tbnilaius', $nilai);
				$tambah++;
			}
			$i++;
		}
		if ($tambah > 0 || $edit > 0) {
			echo "<script>
					$(function() {
						toastr.info('Ada " . $tambah . " data ditambah, " . $edit . " data diupdate!','Terima Kasih',{
						timeOut:2000,
						fadeOut:2000
					});
				});
			</script>";
		} else {
			echo "<script>
					$(function() {
						toastr.error('Tidak ada data yang berhasil ditambahkan atau diupdate!','Mohon Maaf',{
						timeOut:2000,
						fadeOut:2000
					});
				});
			</script>";
		}
	} else {
		echo "<script>
					$(function() {
						toastr.error('Nilai Ijazah Hanya Dapat Diisikan Pada Semester Genap','Mohon Maaf',{
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
	<form action="" method="post">
		<div class="card-header">
			<h5 class="card-title m-0" id="judul">Nilai Ijazah a.n <?php echo $namasiswa; ?></h5>
			<div class="card-tools">
				<a href="index.php?p=nilaius" class="btn btn-sm btn-danger">
					<i class="fas fa-arrow-circle-left"></i>
					<span>&nbsp;Kembali</span>
				</a>
				<button type="submit" class="btn btn-sm btn-success" name="simpan">
					<i class="fas fa-save"></i>
					<span>&nbsp;Simpan</span>
				</button>
			</div>
		</div>
		<div class="card-body">
			<div class="table-responsive" id="datane">
				<table class="table table-bordered table-condensed table-striped table-sm" id="tbnilai">
					<thead>
						<tr>
							<th style="text-align:center;width:5%">No</th>
							<th style="text-align:center">Mata Pelajaran</th>
							<th style="text-align:center;width:15%">Pengetahuan</th>
							<th style="text-align:center;width:15%">Keterampilan</th>
							<th style="text-align:center;width:15%">Keterangan</th>
						</tr>
					</thead>
					<tbody>
						<?php
						$no = 0;
						$qmp = viewdata('tbmapel');
						foreach ($qmp as $mp) :
							$no++;
							$sql = "SELECT ijz.* FROM tbnilaius ijz LEFT JOIN tbthpel tp USING(idthpel) WHERE idmapel='$mp[idmapel]' AND idsiswa='$_GET[id]' AND tp.aktif='1'";
							if (cquery($sql) > 0) {
								$dn = vquery($sql)[0];
							}
						?>
							<tr>
								<td style="text-align:center;"><?php echo $no . '.'; ?></td>
								<td><?php echo $mp['nmmapel']; ?>
									<input type="hidden" name="mapel[]" id="mapel" value="<?php echo $mp['idmapel']; ?>">
								</td>
								<td class="text-center" style="text-align: center;">
									<input type="number" name="teori[]" id="teori" class="form-control form-control-sm text-center" value="<?php echo round($dn['nilaius'], 0); ?>">
								</td>
								<td class="text-center" style="text-align: center;">
									<input type="number" name="praktik[]" id="praktek" class="form-control form-control-sm text-center" value="<?php echo round($dn['nilaius'], 0); ?>">
								</td>
								<td style="vertical-align: middle;">
									<?php
									echo '';
									?>
								</td>
							</tr>
						<?php endforeach ?>
					</tbody>
				</table>
			</div>
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