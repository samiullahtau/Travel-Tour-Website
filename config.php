<?php

$server = "localhost";
$username = "root";
$password = "";
$database = "registration";

$con = mysqli_connect($server , $username , $password , $database);
if(!$con){
    echo "Connection Error";
}

?>