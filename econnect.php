<?php

$ehost="localhost";
$euser="root";
$epass="";
$edb="eclumsy";
$conn=new mysqli($ehost,$euser,$epass,$edb);
if($conn->connect_error){
    echo "Failed to connect DB".$conn->connect_error;
}
?>