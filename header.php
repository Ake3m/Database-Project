<?php
session_start();  
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./styles/nav.css">
</head>

<body>
<header>
    <p><span class="black">BRAVE</span><span class="white">HEART</span></p>
    <nav>
        <ul class="nav_links">
        <li><a href="index.php">Home</a></li>
        <li><a href="about.php">About Us</a></li>
        <?php
            if(isset($_SESSION['email']))
            {
                if(isset($_SESSION['accountType']) && $_SESSION['accountType']==='R')
                {
                    echo "<li><a href=\"profile.php\">Profile</a></li>";
                    echo "<li><a href=\"makeAppointment.php\">Make Appointment</a></li>";
                    echo "<li><a href=\"logout.php\">Logout</a></li>";
                }
                else if(isset($_SESSION['accountType']) && $_SESSION['accountType']==='D')
                {
                    echo "<li><a href=\"doctorProfile.php\">Profile</a></li>";
                    echo "<li><a href=\"viewAppointments.php\">View Appointments</a></li>";
                    echo "<li><a href=\"logout.php\">Logout</a></li>";
                }
            }
            else
            {
                echo "<li><a href=\"signup.php\">Sign up</a></li>";
                echo "<li><a href=\"login.php\">Login</a></li>";
            }
        ?>
        </ul>
    </nav>
        </header>
</body>

</html>