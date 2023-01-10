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
    <link rel="stylesheet" href="styles.css"/>
</head>
<body>
    <main id="box">
    <h1>Specialization Management</h1>
    <a href="addSpecialization.php"><button class="addBtn">Add Specialization</button></a>
    <!-- ADD TABLE -->
    <table>
        <thead>
            <tr>
                <th>id</th>
                <th>Specialization Name</th>
                <th>Action</th>
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
                                <a href=\"editSpecialization.php?id=".$id."&name=".$specialization_name."\"><button>Edit</button></a>
                                <a href=\"deleteSpecialization.php?id=".$id."&name=".$specialization_name."\"><button class=\"deleteBtn\">Delete</button></a>
                            </td>
                        </tr>

                    ";
                }
            }
        ?>
        
        </tbody>
    </table>
        </main>
</body>
</html>