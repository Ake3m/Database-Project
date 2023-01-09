<?php
include("connection.php");
include("functions.php");
include_once('header.php');

if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    loginUser($con, $email, $password);
} else {
    // header("location: login.php");
    // exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;400&display=swap" rel="stylesheet">
    <link rel="stylesheet"href="./styles/intro.css" >
    <title>Login</title>
</head>

<body>
    <div id="box">
        <h1 class="box-title">Login</h1>
        <form method="post">
            <p>
                <label for="login_email">Email Address</label>
                <input id="login_email" type="text" name="email" requied placeholder="Enter your email address">
            </p>
            <p>
                <label for="login_password">Password</label>
                <input id="login_password" type="password" name="password" placeholder="Enter your password">
            </p>
            <p><input type="submit" value="Login" name="login"></p>
            <a href="signup.php">Sign up</a>
        </form>
    </div>
        <?php
        if (isset($_GET['error'])) {
            echo"<div class=\"message\">";
            switch ($_GET['error']) {
                case "wronglogin":
                    echo "<p>Information incorrect</p></div>";
                    break;
                case "wronglogin1":
                    echo "<p>Information incorrect--</p></div>";
                    break;
            }
        }
        ?>
</body>

</html>