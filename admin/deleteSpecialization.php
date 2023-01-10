<?php 
include_once("adminHeader.php");
include_once("../connection.php");
include_once("adminFunctions.php");

$id=$_GET['id'];
$name=$_GET['name'];

if(isset($_POST['no'])){
    header("location: manageSpecialization.php");
    exit();
}

if(isset($_POST['yes'])){
    $query="DELETE FROM specialization WHERE id='$id';";
    if(mysqli_query($con, $query))
    {
        header("location: manageSpecialization.php?error=none");
        exit();
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Specializaton</title>
    <link rel="stylesheet" href="./styles.css">
</head>
<body>
    <main id="box">
        <h1>Delete Specialization</h1>
        <p>Are you sure you want to delete this (<?php echo $name?>) specialization?</p>
        <form method="post">
            <input type="submit" name="yes" value="Yes">
            <input type="submit" name="no" value="No">
        </form>
    </main>
</body>
</html>
