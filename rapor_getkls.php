<?php
	include "dbfunction.php";
	if (isset($_GET['k'])){	
        $sql="SELECT r.idthpel, tp.desthpel FROM tbregistrasi r INNER JOIN tbthpel tp USING(idthpel) WHERE r.idsiswa='$_GET[id]' AND r.idkelas='$_GET[k]' ORDER BY tp.idthpel";
        $data=vquery($sql);
		echo "<option value=''>..Pilih..</option>";
		foreach ($data as $d) {
			echo "<option value='$d[idthpel]'>".$d['desthpel']."</option>";
		}
		
	}
	
?>