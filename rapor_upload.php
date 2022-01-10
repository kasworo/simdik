<?php
	require_once "assets/library/PHPExcel.php";
	require_once "assets/library/excel_reader.php";
	include "config/konfigurasi.php";
	if(empty($_FILES['tmprapor']['tmp_name'])){ 
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
})
</script>
<?php } else {
	$data = new Spreadsheet_Excel_Reader($_FILES['tmprapor']['tmp_name']);
	$baris = $data->rowcount($sheet_index=0);
	$tgl=date('Y-m-d');
	$isidata=$baris-5;
	$sukses = 0;
	$gagal = 0;
	$update=0;
	for ($i=6; $i<=$baris; $i++)
	{
		$xidsiswa=$data->val($i,2);
		$xsemester=$data->val($i,5);
		$mp=mysqli_num_rows(mysqli_query($sqlconn, "SELECT akmapel FROM tb_mapel m INNER JOIN tb_kurikulum k USING(idkurikulum) WHERE statkurikulum='Y'"));
		$batas=$mp+5;
		$xjenis=$data->val($i,$batas+1);
		for($j=6;$j<=$batas;$j++)
		{
			$xakmapel=$data->val(4,$j);
			$qmp=mysqli_query($sqlconn,"SELECT idmapel FROM tb_mapel m INNER JOIN tb_kurikulum k USING(idkurikulum) WHERE statkurikulum='Y' AND akmapel='$xakmapel'");
			$mp=mysqli_fetch_array($qmp);
			$kdmapel=$mp['idmapel'];
			$xnilai=$data->val($i,$j);
			if(strlen($xidsiswa)<>14 || $xidsiswa==''){
				$pesan='Cek Kolom Id Siswa, kosong atau digit tidak sesuai!';
				$jns='error';
				$gagal++;
			}
			else if(strlen($xsemester)<>5 || $xsemester==''){
				$pesan='Cek Kolom Kode Tahun Pelajaran, kosong atau digit tidak sesuai!';
				$jns='error';
				$gagal++;
			}
			else if(strlen($xjenis)<>1 || $xjenis==''){
				$pesan='Cek Kolom Keterangan, kosong atau digit tidak sesuai!';
				$jns='error';
				$gagal++;
			}
			else {
				$ceknilai=mysqli_num_rows(mysqli_query($sqlconn, "SELECT*FROM tbrapor WHERE aspek='$xjenis' AND idsiswa='$xidsiswa' AND idthpel='$xsemester' AND idmapel='$kdmapel'"));
				if($ceknilai>0){
					$query=mysqli_query($sqlconn,"UPDATE tbrapor SET nilai='$xnilai' WHERE aspek='$xjenis' AND idsiswa='$xidsiswa' AND idthpel='$xsemester' AND idmapel='$kdmapel'");
					$pesan='Update Data Sukses!';
					$jns='success';
					$update++;
				} 
				else {
					$query=mysqli_query($sqlconn,"INSERT INTO tbrapor (idsiswa, idmapel, idthpel, nilai, aspek) VALUES('$xidsiswa', '$kdmapel', '$xsemester','$xnilai', '$xjenis')");
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
    toastr.info(
        "Ada <?php echo $gagal;?> Gagal Diimport, <?php echo $update;?> data Sukse Diupdate, dan <?php echo $sukses;?> Sukses Diimport"
    );
    //return false();
})
</script>
<?php } ?>