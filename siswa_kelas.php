<?php
	include "dbfunction.php";
	if (isset($_GET['k'])){
		if($_GET['k']=='1' || $_GET['k']=='7' || $_GET['k']=='10'){
			$data=viewdata('ref_jnsregistrasi');
		}
		else {
			$data=viewdata('ref_jnsregistrasi');
		}
		echo "<option value=''>..Pilih..</option>";
		foreach ($data as $d) {
			echo "<option value='$d[idjreg]'>".$d['jnsregistrasi']."</option>";
		}
		
	}
	
?>