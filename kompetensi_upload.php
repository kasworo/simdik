<?php
	require_once "assets/library/PHPExcel.php";
	require_once "assets/library/excel_reader.php";
	include "config/konfigurasi.php";
	if(empty($_FILES['tmpkompetensi']['tmp_name'])):
?>
	<script type="text/javascript">
		$(function() {
			const Toast = Swal.mixin({
				toast: true,
				position: 'top-end',
				showConfirmButton: false,
				timer: 2000
			});
			toastr.error("File Kosong Bro");
		})
	</script>	
<?php else:
	$data = new Spreadsheet_Excel_Reader($_FILES['tmpkompetensi']['tmp_name']);	
	$baris = $data->rowcount($sheet_index=0);
	$tgl=date('Y-m-d');
	$isidata=$baris-4;
	$sukses = 0;
	$gagal = 0;
	$update=0;
	for ($i=5; $i<=$baris; $i++)
	{
		$akmapel=$data->val($i,2);
		$nmkelas=$data->val($i,3);
		$aspek=$data->val($i,4);
		$kodekd=$data->val($i,5);
		$kdlengkap=$data->val($i,6);
		$kdringkas=$data->val($i,7);
		$semester=$data->val($i,8);

		$qmp=$conn->query("SELECT idmapel FROM tbmapel WHERE akmapel='$akmapel'");
		$cekmp=$qmp->num_rows;
		if($cekmp>0){
			$mp=$qmp->fetch_array();
			$idmapel=$mp['idmapel'];
		}
		else {
			$pesan='Kode Mata Pelajaran Tidak Ada!';
			$jns='danger';
			$gagal++;
		}

		$qkl=$conn->query("SELECT idkelas FROM tbkelas WHERE nmkelas='$nmkelas'");
		$cekls=$qkl->num_rows;
		if($cekls>0){
			$kl=$qkl->fetch_array();
			$idkelas=$kl['idkelas'];
		}
		else {
			$pesan='Kode Kelas Tidak Ada!';
			$jns='danger';
			$gagal++;
		}
		
		$qcek=$conn->query("SELECT*FROM tbkompetensi WHERE idmapel='$idmapel' AND idkelas='$idkelas' AND kodekd='$kodekd'");
		$cek=mysqli_num_rows($qcek);
		if($cek==0){
			$sql=$conn->query("INSERT INTO tbkompetensi (idmapel, idkelas, semester,aspek, kodekd, kdlengkap, kdringkas, aktif) VALUES ('$idmapel','$idkelas','$semester','$aspek','$kodekd', '$kdlengkap','$kdringkas', '0')");
			$pesan='Simpan Kompetensi Berhasil!';
			$jns='success';
			$sukses++;
		}
		else {
			$sql=$conn->query("UPDATE tbkompetensi SET semester='$semester',kdlengkap='$kdlengkap', kdringkas='$kdringkas' WHERE  idmapel='$idmapel' AND idkelas='$idkelas' AND kodekd='$kodekd'");
			$pesan='Update Kompetensi Berhasil!';
			$jns='success';
			$update++;
		}
	}
?>
<script type="text/javascript">
	$(function() {
		const Toast = Swal.mixin({
			toast: true,
			position: 'top-end',
			showConfirmButton: false,
			timer: 3000
		});
		toastr.<?php echo $jns;?>("<?php echo $pesan;?>");
		return false();
	})
 </script>
<?php  flush();?>
<script type="text/javascript">
	$(function() {
		const Toast = Swal.mixin({
			toast: true,
			position: 'top-end',
			showConfirmButton: false,
			timer: 2000
		});
		toastr.info("Ada <?php echo $gagal;?> gagal ditambahkan, <?php echo $update;?> data berhasil diupdate dan <?php echo $sukses;?> sukses ditambahkan");
		return false();
	})
</script>
<?php endif ?>