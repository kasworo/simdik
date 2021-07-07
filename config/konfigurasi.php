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
?>
