<?php
include_once("adminHeader.php");
include_once("../connection.php");
include_once("adminFunctions.php");

if(isset($_POST['Add']))
{
    $specilization_name=$_POST['specialization'];
    addSpecialization($con, $specilization_name);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Specializations</title>
</head>
<body>
    <h1>Add specialization</h1>
    <form method="post">
        <label for="specialization">Name of Specialization</label>
        <input id="specialization" type="text" name="specialization"> 
        <input type="submit" name="Add" value="Add">
    </form> 
</body>
</html>