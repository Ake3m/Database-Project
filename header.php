<?php
session_start();  
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

</head>

<body>
    <nav>
        <div>
            <ul>
            <li><a href="index.php">Home</a></li>
<li><a href="about.php">About Us</a></li>
            <?php
                if(isset($_SESSION['email']))
                {
                    echo "<li><a href=\"profile.php\">Profile</a></li>";
                    echo "<li><a href=\"#\">Make Appointment</a></li>";
                    echo "<li><a href=\"logout.php\">Logout</a></li>";
                }
                else
                {
                    echo "<li><a href=\"signup.php\">Sign up</a></li>";
                    echo "<li><a href=\"login.php\">Login</a></li>";
                }
            ?>
            </ul>
        </div>
    </nav>
</body>

</html>