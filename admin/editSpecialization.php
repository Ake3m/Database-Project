<?php
include_once("adminHeader.php");
include_once("../connection.php");
include_once("adminFunctions.php");

$id=$_GET['id'];
$name=$_GET['name'];

if(isset($_POST['cancel']))
{
    header("location: manageSpecialization.php");
    exit();
}
if(isset($_POST['edit'])){
    $new_name=$_POST['name'];
    $updateQ="UPDATE specialization SET specialization_name='$new_name' WHERE id='$id'";
    if(mysqli_query($con,$updateQ ))
    {
        header("location: manageSpecialization.php?error=none");
        exit();
    }
    else{
        header("location: editSpecialization.php?error=upload");
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
    <title>Edit Specializaton</title>
    <link rel="stylesheet" href="./styles.css">
</head>
<body>
    <main id="box">
        <h1>Edit Specialization Name</h1>
        <form method="post">
            <input type="text" name="name" required value="<?php echo $name?>">
            <input type="submit" name="edit" value="Edit">
            <input type="submit" name="cancel" value="Cancel">
        </form>
    </main>
</body>
</html>