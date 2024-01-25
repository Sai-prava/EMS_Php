<?php
$server = "localhost";
$user = "root";
$pass = "";
$db = "ems";

$conn = mysqli_connect($server,$user,$pass,$db);

if (!$conn) {
   echo "failed". mysqli_connect_error();
}else{
    // echo "connection";
}



?>