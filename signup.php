<?php
include("connection.php");
include("functions.php");
include_once('header.php');


if ($_SERVER['REQUEST_METHOD'] == "POST") {
    //something was posted
    $email = $_POST['email'];
    $password = $_POST['password'];
    $password2 = $_POST['password2'];
    $first_name = $_POST['firstname'];
    $middle_name = $_POST['middlename'];
    $last_name = $_POST['lastname'];
    $gender = $_POST['gender'];
    $dob = $_POST['date_of_birth'];
    $phone_number = $_POST['phone'];
    $address = $_POST['address'];
    $health_insurance_number = $_POST['health_insurance_number'];

    if (emptyInputSignup($email, $password, $password2, $first_name, $middle_name, $last_name, $gender, $dob, $phone_number, $address) !== false) {
        header("location: signup.php?error=emptyinput");
        exit();
    }
    if (invalidEmail($email) !== false) {
        header("location: signup.php?error=invalidemail");
        exit();
    }
    if (pwdMatch($password, $password2) !== false) {
        header("location: signup.php?error=passwordsmismatch");
        exit();
    }
    if (emailExists($con, $email) !== false) {
        header("location:signup.php?error=emailtaken");
        exit();
    }

    createUser($con, $email, $password, $first_name, $middle_name, $last_name, $gender, $dob, $phone_number, $address, $health_insurance_number);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign up</title>
    <link rel="stylesheet" href="./styles/intro.css">
    <!-- <script src="functions.js"></script> -->
</head>

<body>
    
    <div id="box">
    <h1>Sign Up</h1>    
        <form name="signupform" method="post" onsubmit="validateInput()">
            <p>
                <label for="fname">First Name<span>*</span></label>
                <input id="fname" type="text" placeholder="First Name" name="firstname" required>
                <label for="mname">Middle Name</label>
                <input id="mname" type="text" placeholder="Middle Name" name="middlename">
                <label for="lname">Last Name<span>*</span></label>
                <input id="lname" type="text" placeholder="Last Name" name="lastname" required>
            </p>
            <p>
                <label for="email">Email Address <span>*</span></label>
                <input id="email" type="email" name="email" placeholder="Email Address" required>
                <label for="password">Password</label>
                <input id="password" type="password" name="password" placeholder="Password" required minlength="5" maxlength="20">
                <label for="password2">Re-enter password</label>
                <input id="password2" type="password" name="password2" placeholder="Enter Password Again" required minlength="5" maxlength="20">
                <label for="health_insurance">Health Insurance Number</label>
                <input type="text" name="health_insurance_number" id="health_insurance" placeholder="Health Insurance #">
            </p>
            <p>
            <p>Gender</p>
            <input type="radio" id="gender1" name="gender" value="M">
            <label for="gender1">Male</label>
            <input type="radio" id="gender2" name="gender" value="F">
            <label for="gender2">Female</label>
            <p>
                <label for="dob">Date of Birth</label>
                <input type="date" name="date_of_birth" id="dob" required>
            </p>
            <p>
                <label for="phone">Phone/Mobile Number</label>
                <input type="text" id="phone" , placeholder="Phone Number" name="phone" required>
            </p>
            <p>
                <label for="address">Address</label>
                <input type="text" id="address" name="address" required>

            </p>
            <input type="submit" value="Sign up"><br><br>

            <a href="login.php">Login</a>
        </form>
    </div>
        <?php
        if (isset($_GET['error'])) {
            echo "<div class=\"message\">";
            switch ($_GET['error']) {
                case "emptyinput":
                    echo "<p>Please fill in all fields</p></div>";
                    break;
                case "invalidemail":
                    echo "<p>Please Enter a valid email</p></div>";
                    break;
                case "passwordsmismatch":
                    echo "<p> Please ensure both passwords are the same</p></div>";
                    break;
                case "emailtaken":
                    echo "<p>Email address already in use</p></div>";
                    break;
                case "stmtfailed":
                    echo "<p>Something went wrong. Please try again.</p></div>";
                    break;
                case "none":
                    header("location: login.php");
                    exit();
                    break;
            }
        }
        ?>
</body>

</html>