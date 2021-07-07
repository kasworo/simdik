<?php
    function viewref($data){
        global $conn;
        $sql=$conn->query($data);
        $rows=[];
        while($row=$sql->fetch_assoc()){
            $rows[]=$row;
        }
        return $rows;
    }
    function addrefhasil($data){
        global $conn;

    }