<?php

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Complete Registration</title>
</head>
<body>
    <h1>Complete the registration</h1>
    <p>In order to be visible to patients for booking, you must complete the registration.</p>
    <form method="post">
        <h2>Basic Information</h2>
        <p>Some fields have already been filled for you. However, you can make changes if there are any inaccuracies.</p>

        <p>The personal statement is basically a formal introduction. It helps give patients an idea of your background</p>
        <p>The active since field refers to the year in which you begun practicing medicine.</p>
        <?php
        $user_data=$_SESSION['user_data'];
            echo"Email: 
        ?>
        <label for="">First</label>
       
    </form>
</body>
</html>