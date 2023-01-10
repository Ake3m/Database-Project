<?php
include_once("adminHeader.php");

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css"/>
    <title>Admin Panel</title>
</head>
<body>
    <main id="box">
    <h1>Control Panel</h1>
    <p>The admin panel is used to make modifications in the system. This means that changes made here can be catestrophic to the system and may cause things to break. Please be sure of all the changes you make here. Thank you. </p>
    <div id="config_choices">
        <a href="manageDoctor.php">       
            Manage doctors
        </a> 
        <a href="manageCustomers.php"> 
                Manage customers
        </a>
        <a href="manageSpecialization.php"> 
                Manage specilizaions
        </a>
        <a href="manageAppointment.php">Manage appointments</a>
    </div>
</main>
</body>
</html>