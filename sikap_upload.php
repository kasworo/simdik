<?php
	require_once "../assets/library/PHPExcel.php";
	require_once "../assets/library/excel_reader.php";
	include "../config/konfigurasi.php";
	if(empty($_FILES['tmpsikap']['tmp_name'])){ 
		?>
		<script type="text/javascript">
			$(function() {
				const Toast = Swal.mixin({
					toast: true,
					position: 'top-end',
					showConfirmButton: false,
					timer: 3000
				});
				toastr.error("File Kosong Bro");
				//return false();
			})
		</script>	
		<?php } else {
	$data = new Spreadsheet_Excel_Reader($_FILES['tmpsikap']['tmp_name']);
	$baris = $data->rowcount($sheet_index=0);
	$qt=mysqli_query($sqlconn,"SELECT COUNT(*) as akhir FROM tb_thpel");
	$t=mysqli_fetch_array($qt);
	$akhir=$t['akhir'];
	$awal=$akhir-6;
	
	$tgl=date('Y-m-d');
	$isidata=$baris-5;
	$sukses = 0;
	$gagal = 0;
	$update=0;
	for ($i=6; $i<=$baris; $i++)
	{
		$xidsiswa=$data->val($i,2);
		$xjenis=$data->val($i,5);
		$j=5;
		$qmp=mysqli_query($sqlconn,"SELECT idthpel FROM tb_thpel LIMIT $awal,$akhir");
		while ($mp=mysqli_fetch_array($qmp))
		{
			$j++;
			$idthpel=$mp['idthpel'];
			$xnilai=$data->val($i,$j);
			if(strlen($xidsiswa)<>14 || $xidsiswa==''){
				$pesan='Cek Kolom Id Siswa, kosong atau digit tidak sesuai!';
				$jns='error';
				$gagal++;
			}
			else if(strlen($xjenis)<>1 || $xjenis==''){
				$pesan='Cek Kolom Keterangan, kosong atau digit tidak sesuai!';
				$jns='error';
				$gagal++;
			}
			else {
				$ceknilai=mysqli_num_rows(mysqli_query($sqlconn, "SELECT*FROM tb_sikap WHERE aspek='$xjenis' AND idsiswa='$xidsiswa' AND idthpel='$idthpel'"));
				if($ceknilai>0){
					$query=mysqli_query($sqlconn,"UPDATE tb_sikap SET nilai='$xnilai' WHERE aspek='$xjenis' AND idsiswa='$xidsiswa' AND idthpel='$idthpel'");
					$pesan='Update Data Sukses!';
					$jns='success';
					$update++;
				} 
				else {
					$query=mysqli_query($sqlconn,"INSERT INTO tb_sikap (idsiswa, idthpel, nilai, aspek) VALUES('$xidsiswa', '$idthpel','$xnilai', '$xjenis')");
					$pesan='Simpan Data Sukses!';
					$jns='success';
					$sukses++;
				}
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
		//return false();
	})
</script>
<?php
	}
	flush();
?>
<script type="text/javascript">
	$(function() {
		const Toast = Swal.mixin({
			toast: true,
			position: 'top-end',
			showConfirmButton: false,
			timer: 2000
		});
		toastr.info("Ada <?php echo $gagal;?> Gagal Diimport, <?php echo $update;?> data Sukse Diupdate, dan <?php echo $sukses;?> Sukses Diimport");
		//return false();
	})
</script>
<?php } ?>