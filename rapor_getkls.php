<?php
include "dbfunction.php";
if (isset($_GET['k'])) {
	$sql = "SELECT r.idthpel, tp.desthpel FROM tbregistrasi r INNER JOIN tbthpel tp USING(idthpel) INNER JOIN tbregistrasi_detil rd USING(idreg) WHERE r.idsiswa='$_GET[id]' AND rd.idkelas='$_GET[k]' ORDER BY tp.idthpel";
	$data = vquery($sql);
	echo "<option value=''>..Pilih..</option>";
	foreach ($data as $d) {
		echo "<option value='$d[idthpel]'>" . $d['desthpel'] . "</option>";
	}
}
