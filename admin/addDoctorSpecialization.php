<?php
include_once("adminHeader.php");
include_once("../connection.php");


if(isset($_POST['add']))
{
    $doctor_id=$_POST['select_doctor'];
    $specialization_id=$_POST['select_specialization'];

    $addDocSpecialization="INSERT INTO doctor_specialization(doctor_id, specialization_id) VALUES('$doctor_id','$specialization_id');";
    if(mysqli_query($con, $addDocSpecialization))
    {
        header("location: manageDoctor.php?error=none");
        exit();
    }
    else{
        header("location: manageDoctor.php?error=yes");
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
    <title>Add Doctor Specialization</title>
    <link rel="stylesheet" href="./styles.css">
</head>
<body>
    <main id="box">
    <h1>Add Doctor Specialization</h2>
    <form method="post">
        <label for="doctor_id">Doctor Name</label>
        <select id="doctor_id" name="select_doctor"">
            <option value="">--Select a doctor--</option>
            <?php
                $getDoctors="SELECT doctor_id, first_name, last_name FROM doctor_information;";
                $getDocResult=mysqli_query($con, $getDoctors);
                if($getDocResult && mysqli_num_rows($getDocResult)>0)
                {
                    while($row=mysqli_fetch_assoc($getDocResult))
                    {
                        echo "<option value=\"".$row['doctor_id']."\">".$row['first_name']." ".$row['last_name']."</option>";
                    }
                }
            ?>
            </select>
            <label for="specialization_id">Specialzation Name</label>
        <select id="specialization_id" name="select_specialization">
            <option value="">--Select a Specialization--</option>
            <?php
                $getSpecialization="SELECT * FROM specialization";
                $getResult=mysqli_query($con, $getSpecialization);
                if($getResult && mysqli_num_rows($getResult)>0)
                {
                    while($row=mysqli_fetch_assoc($getResult))
                    {
                        echo "<option value=\"".$row['id']."\">".$row['specialization_name']."</option>";
                    }
                }
            ?>
            </select>
            <input type="submit" name="add" value="Add">

    </form>
            </main>
</body>
</html>