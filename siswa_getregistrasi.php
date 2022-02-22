<?php
include "dbfunction.php";
if (isset($_GET['tp'])) {
	$th = viewdata('tbthpel', array('idthpel' => $_GET['tp']))[0];
	if (substr($th['nmthpel'], -1) == '1') {
		$sql = "SELECT*FROM ref_jnsregistrasi WHERE (idjreg BETWEEN 1 AND 3) OR (idjreg BETWEEN 5 AND 7)";
	} else {
		$sql = "SELECT*FROM ref_jnsregistrasi WHERE (idjreg='2') OR (idjreg='4') OR (idjreg BETWEEN 6 AND 8)";
	}
	$data = vquery($sql);
	echo "<option value=''>..Pilih..</option>";
	foreach ($data as $d) {
		echo "<option value='$d[idjreg]'>" . $d['jnsregistrasi'] . "</option>";
	}
}