<?php
	include "dbfunction.php";
	if (isset($_GET['k'])){
		$field=array('idrombel','nmrombel');
		$tbl=array('tbthpel'=>'idthpel');
		$keys=array(
			'idkelas'=>$_GET['k'],
			'idthpel'=>$_COOKIE['c_tahun']
		);
		//$qd = $conn->query("SELECT idrombel, nmrombel FROM tbrombel r INNER JOIN tbthpel t ON t.idthpel=r.idthpel WHERE r.idkelas='$_GET[k]' AND r.idthpel='$_COOKIE[c_tahun]'");
		$qd=fulljoin($field,'tbrombel',$tbl,$keys);
		echo "<option selected value=''>..Pilih..</option>";
		foreach($qd as $d)
		{
			echo "<option value='$d[idrombel]'>$d[nmrombel]</option>";
		}
	}
	
?>