<?php
include_once("../connection.php");
include_once("adminHeader.php");
include_once("adminFunctions.php");

if(isset($_POST['add']))
{
    $doc_email=$_POST['doctor_email'];
    $doc_firstname=$_POST['doctor_fname'];
    $doc_surname=$_POST['doctor_sname'];

    addDoctor($con, $doc_email, $doc_firstname, $doc_surname);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Doctor</title>
</head>
<body>
    <h1>Doctor Registration</h1>
    <form method="post">
        <label for="doctor_email_address">Email Address</label>
        <input id="doctor_email_address" type="email" placeholder="Enter email address" required name="doctor_email">
        <label for="doctor_firstname">Firstname:</label>
        <input type="text" required id="doctor_firstname" name="doctor_fname" placeholder="Enter first name"> 
        <label for="doctor_surname">Surname:</label>
        <input type="text" required id="doctor_surname" name="doctor_sname" placeholder="Enter surname">
        <input type="submit" value="Add Doctor" name="add">
    </form>
</body>
</html>