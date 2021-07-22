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
		//var_dump($sql);die;
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
		$result=$conn->query($sql);
		return $result->num_rows;
	}

	function adddata($tbl, $data){
		global $conn;		
		$key = array_keys($data);
		$val = array_values($data);
		$sql = "INSERT INTO $tbl (".implode(', ', $key). ") VALUES ('". implode("', '", $val)."')";
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
		$conn->query($sql);
		return $conn->affected_rows;
	}
?>