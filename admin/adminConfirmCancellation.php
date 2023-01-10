<?php
    include("../connection.php");
    include("adminFunctions.php");
    include_once("adminHeader.php");

    $date=$_GET['date'];
    $doctor_id=$_GET['doctor_id'];
    $last_name=$_GET['last_name'];
    $consultation_number=$_GET['consultation_number'];

    if(isset($_POST['yes']))
    {
        $cancelAppointment="UPDATE appointment SET appointment_status_id=2 WHERE appointment_date=\"".$date."\" AND doctor_id=".$doctor_id." AND consultation_number=".$consultation_number.";";
        if(mysqli_query($con, $cancelAppointment))
        {
            header("location: manageAppointment.php?error=none");
            exit();
        }
        else{
            die("Something went wrong");
        }
    }
    if(isset($_POST['no'])){
        header("location: manageAppointment.php");
        exit();

    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Appointment Cancellation</title>
    <link rel="stylesheet" href="./styles.css">
</head>
<body>
    <main id="box">
    <h1>Appointment Cancellation</h1>
    <h2>Appointment Details</h2>
    <?php
    echo "<p>Are you sure you want to cancel this appointment on ".$date." for Dr. ".$last_name."?</p>";
    ?>
    <form method="post">
        <input type="submit" value="Yes" name="yes"/>
        <input type="submit" value="No" name="no"/>
    </form>
</main>
</body>
</html>