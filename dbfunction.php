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

    function viewdata($tbl, $key='', $id='', $ord='' ){
        global $conn;
        if($key=='' && $id=='' && $ord==''){
            $sql="SELECT*FROM $tbl"; 
        }
        else if($key=='' && $id==''){
            $sql="SELECT*FROM $tbl ORDER BY $ord"; 
        }
        elseif($ord==''){
            $sql="SELECT*FROM $tbl WHERE $key='$id'";
        }
        else {
            $sql="SELECT*FROM $tbl WHERE $key = '$id' ORDER BY $ord";
        }
        $rows=[];
        $result=$conn->query($sql);
		while($row=$result->fetch_assoc()){
			$rows[]=$row;
		}		
		return $rows;
    }
   
    function cekdata($tbl, $keys='',$id=''){
        global $conn;
        if($keys=='' && $id==''){
            $sql="SELECT*FROM $tbl";
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