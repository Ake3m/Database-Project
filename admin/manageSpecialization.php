<?php
include_once("../connection.php");
include_once("adminHeader.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Specialization Management</title>
</head>
<body>
    <h1>Specialization Management</h1>
    <a href="addSpecialization.php">Add Specialization</a>
    <!-- ADD TABLE -->
    <table>
        <thead>
            <tr>
                <th>id</th>
                <th>Specialization Name</th>
            </tr>
        </thead>
        <tbody>
        <?php
            $query="SELECT * FROM specialization;";
            $result = mysqli_query($con, $query);
            if($result && mysqli_num_rows($result)>0)
            {
                while($row=mysqli_fetch_assoc($result))
                {
                    $id=$row['id'];
                    $specialization_name=$row['specialization_name'];
                    echo "
                        <tr>
                            <td>".$id."</td>
                            <td>".$specialization_name."</td>
                            <td>
                                <button><a href=\"\">Edit</a></button>
                                <button><a href=\"\">Delete</a></button>
                            </td>
                        </tr>

                    ";
                }
            }
        ?>
        
        </tbody>
    </table>
</body>
</html>