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
        $year        = substr($date, 0, 4);
        $month       = substr($date, 5, 2);
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
       
        $result=$conn->query($sql);
		while($row=$result->fetch_assoc()){
			$rows[]=$row;
		}		
		return $rows;
    }
    
    function viewdata($tbl, $key='', $ord=''){
        global $conn;
        if($key=='' && $ord==''){
            $sql="SELECT*FROM $tbl"; 
        }
        else if($ord==''){
            $where=[];
            foreach($key as $wh=>$nil) {
                $where[] = "$wh = '$nil'";
            }
            $sql="SELECT*FROM $tbl WHERE ".implode (' AND ',$where);
        }
        else {
            $where=[];
            foreach($key as $wh=>$nil) {
                $where[] = "$wh = '$nil'";
            }
            $sql="SELECT*FROM $tbl WHERE ".implode (' AND ',$where)." ORDER BY $ord";
        }
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

    function editdata($tbl, $data, $kol='', $id=''){
        global $conn;
        $cols = [];
        foreach($data as $key=>$val) {
            $cols[] = "$key = '$val'";
        }
        if($id==''){
            $where=[];
            foreach($kol as $wh=>$nil) {
                $where[] = "$wh = '$nil'";
            }
            $sql = "UPDATE $tbl SET " . implode(', ', $cols). " WHERE ".implode (' AND ',$where);
        }        
        else
        {
            $sql = "UPDATE $tbl SET " . implode(', ', $cols). " WHERE $kol='$id'";
        }
        $conn->query($sql);
        return $conn->affected_rows;
    }
?>