<?php
	include "dbfunction.php";
	if (isset($_GET['k'])){
		$field=array('idrombel','nmrombel');
		$tbl=array('tbthpel'=>'idthpel');
		$keys=array(
			'idkelas'=>$_GET['k'],
			'idthpel'=>$_COOKIE['c_tahun']
		);
		$qd=fulljoin($field,'tbrombel',$tbl,$keys);
		echo "<option selected value=''>..Pilih..</option>";
		foreach($qd as $d)
		{
			echo "<option value='$d[idrombel]'>$d[nmrombel]</option>";
		}
	}
	
?>