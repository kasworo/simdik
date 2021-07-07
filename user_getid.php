<?php
  	include "config/konfigurasi.php";
    if (isset($_GET['lev'])){
        $query = $conn->query("SELECT username, nama FROM tbuser WHERE level='$_GET[lev]'");
        echo "<option selected value=''>..Pilih..</option>";
		while($d = $query->fetch_array())
		{
			echo "<option value='$d[username]'>$d[nama]</option>";
		}
	}

    
?>