<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/registrationstyle.css"/>
    <title>Complete Registration</title>
</head>
<body>
    <h1>Complete the registration</h1>
    <p>In order to be visible to patients for booking, you must complete the registration.</p>
    <form method="post">
        <h2>Basic Information</h2>
        <p>Some fields have already been filled for you. However, you can make changes if there are any inaccuracies.</p>

        <?php
        $user_data=$_SESSION['user_data'];
        $fname=$user_data['first_name'];
        $sname=$user_data['last_name'];
        echo"<p>Email: ".$user_data['email_address']."</p>";
        echo "<label for=\"fname\">First Name: </label>";
        echo "<input id=\"fname\" type=\"text\" value=\"".$fname."\" name=\"fname\">";
        echo "<label for=\"sname\">Last Name: </label>";
        echo "<input id=\"sname\" type=\"text\" value=\"".$sname."\" name=\"sname\">";
        
        ?>
        <p>The personal statement is basically a formal introduction. It helps give patients an idea of your background</p>
        <p>The active since field refers to the year in which you began practicing medicine.</p>
        <label for="personal_statment">Personal Statement</label>
        <textarea id="personal_statment" name="pStatement" rows="20" cols="100"></textarea>
        
        
       
    </form>
</body>
</html>