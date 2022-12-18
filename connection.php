<?php

$dbhost="localhost";
$dbuser = "root";
$dbpassword="password";
$dbname="clinic";

if(!$con=mysqli_connect($dbhost, $dbuser, $dbpassword, $dbname))
{
    die("Failed to connect!");
}


?>