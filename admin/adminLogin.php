<?php
    include_once("../connection.php");
    include_once("adminFunctions.php");
    session_start();
    if(isset($_POST['adminlogin']))
    {
        $user=$_POST['adminEmail'];
        $password=$_POST['adminPassword'];

        loginAdmin($con, $user, $password);
    }
    else{
        
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
</head>
<body>
<div>
        <h1>Admin Login</h1>
        <form method="post">
            <p>
                <label for="admin_email">Email Address</label>
                <input id="admin_email" type="text" name="adminEmail" requied placeholder="Enter admin login">
            </p>
            <p>
                <label for="admin_password">Password</label>
                <input id="admin_password" type="password" name="adminPassword" placeholder="Enter your password">
            </p>
            <p><input type="submit" value="Login" name="adminlogin"></p>
        </form>
    </div>
</body>
</html>