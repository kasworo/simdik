<?php
	$host="localhost";
	$user="root";
	$pwd="password";
	$db="dbsimdik";
	$conn= new mysqli($host, $user, $pwd, $db);
	if(mysqli_connect_errno()) {
		echo "Error: Could not connect to database. ";
		exit;
	}
	   
	function indonesian_date($date)
	{
		$indonesian_month = array("Januari", "Februari", "Maret",
			"April", "Mei", "Juni",
			"Juli", "Agustus", "September",
			"Oktober", "November", "Desember");
		$year		= substr($date, 0, 4);
		$month	   = substr($date, 5, 2);
		$currentdate = substr($date, 8, 2);
		if($month>=1)
		{ 
			$result = $currentdate . " " . $indonesian_month[(int) $month - 1] . " " . $year;
		}
		else
		{
			$result = '';
		}
		return $result;
	}
	function getagama($idagm){
		switch($idagm){
			case 'A' : {$agama ='Islam';break;}
			case 'B' : {$agama ='Kristen';break;}
			case 'C' : {$agama ='Katholik';break;}
			case 'D' : {$agama ='Hindu';break;}
			case 'E' : {$agama ='Buddha';break;}
			default : {$agama='-';break;}
		}
		return $agama;		
	}
	
	function getgender($id){
		if($id=='L'){$jk='Laki-laki';} else {$jk='Perempuan';}
		return $jk;
	}
	function getwni($id){
		if($id=='1'){
			$wn='Warga Negara Indonesia';
		}
		else if($id=='2'){
			$wn='Warga Negara Asing';
		} 
		else {$wn='-';}
		return $wn;
	}
	
	function gettinggal($id){
		switch($id){
			case '1' : {$tggl='Orangtua';break;}
			case '2' : {$tggl='Wali Murid';break;}
			case '3' : {$tggl='Kost';break;}
			case '4' : {$tggl='Asrama';break;}
			default:{$tggl='-';break;}
		}
		return $tggl;
	}
	
	function gettrans($id){
		switch($id){
			case '1' : {$trns='Jalan Kaki';break;}
			case '2' : {$trns='Sepeda';break;}
			case '3' : {$trns='Sepeda Motor';break;}
			case '4' : {$trns='Ojek';break;}
			case '5' : {$trns='Angkutan Umum';break;}
			case '6' : {$trns='Angkutan Antar Jemput';break;}
		}
		return $trns;
	}
	
	function getpenyakit($id){
		switch ($id){
			case '0' : {$skt='Tidak Ada';break;}
			case '1' : {$skt='Demam Berdarah';break;}
			case '2' : {$skt='Malaria';break;}
			case '3' : {$skt='Asma';break;}
			case '4' : {$skt='Campak';break;}
			case '5' : {$skt='TBC';break;}
			case '6' : {$skt='Tetanus';break;}
			case '7' : {$skt='Pneumonia';break;}
			case '8' : {$skt='Jantung';break;}
			default:{$skt='-';break;}
		}
		return $skt;
	}
	
	function getkebkhusus($id){
		switch($id){
			case '0' : {$kbthn='Tidak Ada';break;}
			case '1' : {$kbthn='Tuna Daksa';break;}
			case '2' : {$kbthn='Tuna Rungu';break;}
			case '3' : {$kbthn='Tuna Wicara';break;}
			case '4' : {$kbthn='Tuna Netra';break;}
			case '5' : {$kbthn='Tuna Grahita';break;}
			case '6' : {$kbthn='Down Syndrome';break;}
			case '7' : {$kbthn='Autisme';break;}
			default:{$kbthn='-';break;}
		}
		return $kbthn;
	}

	function getdarah($id){
		switch($id){
			case '0' : {$goldarah='Tidak Tahu';break;}
			case '1' : {$goldarah='A';break;}
			case '2' : {$goldarah='B';break;}
			case '3' : {$goldarah='AB';break;}
			case '4' : {$goldarah='O';break;}
		}
		return $goldarah;
	}

	function KonversiHuruf($hrf)
    {
        if($hrf=='A' || $hrf=='SB'){
			$angka=4;
		}
		else if($hrf=='B'){
			$angka=3;
		}
		else if($hrf=='C'){
			$angka=2;
		}
		else if($hrf=='D' || $hrf=='K'){
			$angka=1;
		}
		else {
			$angka=0;
		}	
		return $angka;
    }

	function getskulortu($id){
		if(isset($id)) {
			$data=viewdata('ref_pendidikan',array('idpddk'=>$id))[0];
			return $data['pendidikan'];
		}
		else {
			return "-";
		}		
	}

	function getkethdp($id){
		if($id=='0') {
			return 'Masih Hidup';
		}
		else if ($id=='1'){
			return "Sudah Meninggal";
		}
		else {
			return "-";
		}		
	}

	function getkerjaortu($id){
		if(isset($id)) {
			$data=viewdata('ref_pekerjaan',array('idkerja'=>$id))[0];
			return $data['pekerjaan'];
		}
		else {
			return "-";
		}			
	}
	
	function getgajiortu($id){
		if(isset($id)) {
			$data=viewdata('ref_penghasilan',array('idhsl'=>$id))[0];
			return $data['penghasilan'];
		}
		else {
			return "-";
		}		
	}

	function getregis($id){
		$data=viewdata('ref_jnsregistrasi',array('idjreg'=>$id))[0];
		return $data['jnsregistrasi'];
	}
	function getskul(){
        $data=viewdata('tbskul')[0];
        return $data['idskul'];
    }
	function getidsiswa($nis,$nisn){
		$sql="SELECT idsiswa FROM tbsiswa WHERE nis='$nis' OR nisn='$nisn'";
		$data=vquery($sql)[0];
		return $data['idsiswa'];
	}
    // function getthpel(){
    //     global $conn;
    //     $sql=mysqli_query($conn, "SELECT*FROM tb_thpel WHERE aktif='Y'");
    //     $row=mysqli_fetch_array($sql);
    //     return $row['kdthpel'];
    // }

	
	function vquery($sql){
		global $conn;
		$rows=[];
		$result=$conn->query($sql);
		while($row=$result->fetch_assoc()){
			$rows[]=$row;
		}		
		return $rows;
	}

	function cquery($sql){
		global $conn;	
		$result=$conn->query($sql);
		return $result->num_rows;
	}

	function fulljoin($field,$tbl, $join, $where='', $group=''){
		global $conn;
		$rows=[];
		foreach($field as $kol) {
			$cols[]= $kol;
		}
		foreach($join as $joins=>$idjoins) {
			$tbjoin[] = "$joins USING($idjoins)";
		}
		foreach($where as $w=>$nil) {
			$keys[]= "$w = '$nil'";
		} 
		if($where=='' && $group==''){
			$sql="SELECT ".implode(', ',$cols)." FROM $tbl INNER JOIN ".implode(' INNER JOIN ',$tbjoin);
		}	 
		else if($where==''){
			$sql="SELECT ".implode(', ',$cols)." FROM $tbl INNER JOIN ".implode(' INNER JOIN ',$tbjoin)." GROUP BY $group";
		}
		else if($group==''){
			$sql="SELECT ".implode(', ',$cols)." FROM $tbl INNER JOIN ".implode(' INNER JOIN ',$tbjoin). " WHERE ".implode('AND ',$keys);
		}
		else {
			$sql="SELECT ".implode(', ',$cols)." FROM $tbl INNER JOIN ".implode(' INNER JOIN ',$tbjoin). " WHERE ".implode('AND ',$keys)." GROUP BY $group";
		}
		//var_dump($sql);die;
		$result=$conn->query($sql);
		while($row=$result->fetch_assoc()){
			$rows[]=$row;
		}		
		return $rows;
	}

	function cekfulljoin($field, $tbl, $join, $where='', $group=''){
		global $conn;
		$rows=[];
		foreach($field as $kol) {
			$cols[]= $kol;
		}
		foreach($join as $joins=>$idjoins) {
			$tbjoin[] = "$joins USING($idjoins)";
		}
		foreach($where as $w=>$nil) {
			$keys[]= "$w = '$nil'";
		}
		
		if($field=='*'){
			if($where=='' && $group==''){
				$sql="SELECT*FROM $tbl INNER JOIN ".implode(' INNER JOIN ',$tbjoin);
			}	 
			else if($where==''){
				$sql="SELECT*FROM $tbl INNER JOIN ".implode(' INNER JOIN ',$tbjoin)." GROUP BY $group";
			}
			else if($group==''){
				$sql="SELECT*FROM $tbl INNER JOIN ".implode(' INNER JOIN ',$tbjoin). " WHERE ".implode(' AND ',$keys);
			}
			else {
				$sql="SELECT*FROM $tbl INNER JOIN ".implode(' INNER JOIN ',$tbjoin). " WHERE ".implode('AND ',$keys)." GROUP BY $group";
			}
		}
		else {
			if($where=='' && $group==''){
				$sql="SELECT ".implode(', ',$cols)." FROM $tbl INNER JOIN ".implode(' INNER JOIN ',$tbjoin);
			}	 
			else if($where==''){
				$sql="SELECT ".implode(', ',$cols)." FROM $tbl INNER JOIN ".implode(' INNER JOIN ',$tbjoin)." GROUP BY $group";
			}
			else if($group==''){
				$sql="SELECT ".implode(', ',$cols)." FROM $tbl INNER JOIN ".implode(' INNER JOIN ',$tbjoin). " WHERE ".implode(' AND ',$keys);
			}
			else {
				$sql="SELECT ".implode(', ',$cols)." FROM $tbl INNER JOIN ".implode(' INNER JOIN ',$tbjoin). " WHERE ".implode('AND ',$keys)." GROUP BY $group";
			}
		}
		//var_dump($sql);die;
		$result=$conn->query($sql);
		return $result->num_rows;
	}

	function leftjoin($field,$tbl, $join, $where='', $group=''){
		global $conn;
		$rows=[];
		foreach($field as $kol) {
			$cols[]= $kol;
		}
		foreach($join as $joins=>$idjoins) {
			$tbjoin[] = "$joins USING($idjoins)";
		}
		foreach($where as $w=>$nil) {
			$keys[]= "$w = '$nil'";
		} 
	   
		if($where=='' && $group==''){
			$sql="SELECT ".implode(', ',$cols)." FROM $tbl LEFT JOIN ".implode(' LEFT JOIN ',$tbjoin);
		}	 
		else if($where==''){
			$sql="SELECT ".implode(', ',$cols)." FROM $tbl LEFT JOIN ".implode(' LEFT JOIN ',$tbjoin)." GROUP BY $group";
		}
		else if($group==''){
			$sql="SELECT ".implode(', ',$cols)." FROM $tbl LEFT JOIN ".implode(' LEFT JOIN ',$tbjoin). " WHERE ".implode(' AND ',$keys);
		}
		else {
			$sql="SELECT ".implode(', ',$cols)." FROM $tbl LEFT JOIN ".implode(' LEFT JOIN ',$tbjoin). " WHERE ".implode(' AND ',$keys)." GROUP BY $group";
		}
		//var_dump($sql);die;
		$result=$conn->query($sql);
		while($row=$result->fetch_assoc()){
			$rows[]=$row;
		}		
		return $rows;
	}
	
	function viewdata($tbl, $key='', $ord=''){
		global $conn;
		$where=[];
		foreach($key as $wh=>$nil) {
			$where[] = "$wh = '$nil'";
		}
		if($key=='' && $ord==''){
			$sql="SELECT*FROM $tbl"; 
		}
		else if($key==''){
			$sql="SELECT*FROM $tbl ORDER BY $ord";
		}
		else if($ord==''){
			$sql="SELECT*FROM $tbl WHERE ".implode (' AND ',$where);
		}
		else {
			$sql="SELECT*FROM $tbl WHERE ".implode (' AND ',$where)." ORDER BY $ord";
		}
		//var_dump($sql);
		$rows=[];
		$result=$conn->query($sql);
		while($row=$result->fetch_assoc()){
			$rows[]=$row;
		}		
		return $rows;
	}
   
	function cekdata($tbl, $keys=''){
		global $conn;
		if($keys==''){
			$sql="SELECT*FROM $tbl";
		}
		else {
			$where=[];
			foreach($keys as $wh=>$nil) {
				$where[] = "$wh = '$nil'";
			}
			$sql="SELECT*FROM $tbl WHERE ".implode (' AND ',$where);
		}
		//var_dump($sql);die;
		$result=$conn->query($sql);
		return $result->num_rows;
	}

	function adddata($tbl, $data){
		global $conn;		
		$key = array_keys($data);
		$val = array_values($data);
		$sql = "INSERT INTO $tbl (".implode(', ', $key). ") VALUES ('". implode("', '", $val)."')";
		//var_dump($sql);die;
		$conn->query($sql);
		return $conn->affected_rows;
	}

	function editdata($tbl, $data, $join='', $field=''){
		global $conn;
		$cols = [];
		foreach($data as $key=>$val) {
			$cols[] = "$key = '$val'";
		}
        $where=[];
		foreach($field as $wh=>$nil) {
			$where[] = "$wh = '$nil'";
		}
        $tbjoin=[];
		foreach($join as $joins=>$idjoins) {
			$tbjoin[] = "$joins USING($idjoins)";
		}
        if($join==''){
			$sql = "UPDATE $tbl SET " . implode(', ', $cols). " WHERE ".implode (' AND ',$where);
		}
        else {
			$sql = "UPDATE $tbl INNER JOIN ".implode(' ',$tbjoin)." SET " . implode(', ', $cols). " WHERE ".implode (' AND ',$where);
		}
		//var_dump($sql);die;
		$conn->query($sql);
		return $conn->affected_rows;
	}
?>