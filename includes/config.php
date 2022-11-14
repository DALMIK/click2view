<?php
ob_start(); // Turns on output buffering

date_default_timezone_set("Europe/London");

try {
    $con = new PDO("mysql:dbname=rbdTube;host=localhost", "root", "");
    
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
    
    // if($con){
    //     echo "connection succefull";
    // }else{
    //     echo "not working";
    // }
}
catch (PDOException $e) {
    exit("Connection failed: " . $e->getMessage());
}
?>