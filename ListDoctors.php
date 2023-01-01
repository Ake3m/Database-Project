<?php
include("connection.php");
include("functions.php");
include_once("header.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doctor View</title>
</head>
<body>
    <?php
    $specialization_id=$_GET['specialization_id'];
    $specialization_name=$_GET['name'];
    $getDoctors="SELECT ";
    echo "<h1>Doctors that Specialize in ".$specialization_name."</h2>";
    ?>
</body>
</html>