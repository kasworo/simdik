<?php
    include "dbfunction.php";
    if (isset($_GET['k'])){
		$sk=fulljoin('tbkelas','tbskul','idjenjang');
		$sk=$qsk->fetch_array();
		if($_COOKIE['c_login']=='1'){
			$query = $conn->query("SELECT idrombel, nmrombel FROM tbrombel r INNER JOIN tbthpel t ON t.idthpel=r.idthpel WHERE r.idkelas='$_GET[k]' AND r.idthpel='$_COOKIE[c_tahun]'");
			echo "<option selected value=''>..Pilih..</option>";
			while($d = $query->fetch_array())
			{
				echo "<option value='$d[idrombel]'>$d[nmrombel]</option>";
			}
		}
		else {
			$query = $conn->query("SELECT idrombel, nmrombel FROM tbrombel r INNER JOIN tbthpel t ON t.idthpel=r.idthpel INNER JOIN tbpengampu p USING(idrombel) WHERE r.idkelas='$_GET[k]' AND r.idthpel='$_COOKIE[c_tahun]' AND p.username='$_COOKIE[c_user]' GROUP BY p.idrombel");
			echo "<option selected value=''>..Pilih..</option>";
			while($d = $query->fetch_array())
			{
				echo "<option value='$d[idrombel]'>$d[nmrombel]</option>";
			}
		}
		
	}
?>