<?php
if (isset($_POST['btnGuru'])) {
	$baru = 0;
	$update = 0;
	$keys = array('deleted' => '0');
}

if (isset($_POST['btnSiswa'])) {
	$baru = 0;
	$update = 0;
	$keys = array('deleted' => '0');
	$qpd = viewdata('tbsiswa', $keys, '', 'nis');
	foreach ($qpd as $pd) {
		$pwd = password_hash(str_replace('-', '', $pd['tgllahir']), PASSWORD_DEFAULT);
		$user = array(
			'namatmp' => ucwords(strtolower($pd['nmsiswa'])),
			'username' => $pd['nisn'],
			'level' => '3',
			'aktif' => '1',
			'passwd' => $pwd
		);
		$edit = array(
			'username' => $pd['nisn']
		);
		$field = array(
			'idsiswa' => $pd['idsiswa']
		);

		$cekuser = cekdata('tbuser', $edit);
		if ($cekuser === 0) {
			adddata('tbuser', $user);
			editdata('tbsiswa', $edit, '', $field);
			$baru++;
		} else {
			editdata('tbuser', $user, $edit);
			$update++;
		}
	}
	echo "<script>
				$(function() {
					toastr.success('Ada " . $baru . " Username Untuk Guru Diaktifkan!','Terima Kasih',{
						timeOut:1000,
						fadeOut:1000,
						onHidden:function(){
							window.location.href='index.php?p=datauser';
						}
					});
				});
			</script>";
}

// if (isset($_POST['kosongin'])) {
// 	if (deluser() > 0) {
// 		echo "<script>
// 				$(function() {
// 					toastr.info('Username Berhasil Dikosongkan!','Terima Kasih',{
// 						timeOut:1000,
// 						fadeOut:1000,
// 						onHidden:function(){
// 							window.location.reload();
// 						}
// 					});
// 				});
// 			</script>";
// 	}
// }
?>
<div class="card card-secondary card-outline">
	<div class="card-header">
		<h4 class="card-title">Data Pengguna</h4>
		<div class="card-tools">
			<form action="" method="post">
				<button type="submit" name="btnSiswa" class="btn btn-secondary btn-sm" id="btnSiswa">
					<i class="fas fa-random"></i>&nbsp;Siswa
				</button>
				<button name="btnGuru" class="btn btn-info btn-sm" id="btnGuru">
					<i class="fas fa-random"></i>&nbsp;Guru
				</button>
				<button name="kosongin" id="kosongin" class="btn btn-danger btn-sm">
					<i class="fas fa-trash-alt"></i>&nbsp;Hapus
				</button>
			</form>
		</div>
	</div>
	<div class="card-body">
		<div class="table-responsive">
			<table id="tb_user" class="table table-bordered table-striped table-sm">
				<thead>
					<tr>
						<th style="text-align: center;width:2.5%">No.</th>
						<th style="text-align: center;width:17.5%">Username</th>
						<th style="text-align: center;width:30%">Nama Lengkap</th>
						<th style="text-align: center;width:10%">Level</th>
						<th style="text-align: center;width:10%">Status</th>
						<th style="text-align: center;width:20%">Aksi</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$sql = "SELECT u.namatmp, u.username, u.level, u.aktif FROM tbuser u WHERE u.level<>'1'";
					$qs = vquery($sql);
					$no = 0;
					foreach ($qs as $s) {
						$no++;
						if ($s['aktif'] == '1') {
							$stat = 'Aktif';
							$btn = "btn-success";
						} else {
							$stat = 'Non Aktif';
							$btn = "btn-danger";
						}
						if ($s['level'] == '3') {
							$lev = 'Peserta Didik';
						}
						if ($s['level'] == '2') {
							$lev = 'Guru Bidang Studi';
						}
					?>
						<tr>
							<td style="text-align:center"><?php echo $no . '.'; ?></td>
							<td><?php echo $s['username']; ?></td>
							<td><?php echo $s['namatmp']; ?></td>
							<td><?php echo $lev; ?></td>
							<td style="text-align:center">
								<input data-id="<?php echo base64_encode($s['username']); ?>" type="button" class="btn <?php echo $btn; ?> btn-xs btnAktif" value="<?php echo $stat; ?>">
							</td>
							<td style="text-align: center">
								<button data-id="<?php echo base64_encode($s['username']); ?>" class="btn btn-xs btn-secondary btnReset">
									<i class="fas fa-sync-alt"></i>&nbsp;Reset
								</button>
								<a href="#" class="btn btn-xs btn-danger">
									<i class="fas fa-trash-alt"></i>&nbsp;Hapus
								</a>
							</td>
						</tr>
					<?php } ?>
				</tbody>
			</table>
		</div>
	</div>
</div>
<script type="text/javascript" src="js/getusername.js"></script>
<script type="text/javascript">
	$(function() {
		$('#tb_user').DataTable({
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