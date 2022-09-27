<?php require_once "controllerUserData.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Find Your Match</title>
</head>
<body>
    <h2>Find Your Perfect Match</h2>
    <?php
    
        error_reporting(E_ERROR | E_WARNING | E_PARSE);

        session_start();
        $email = $_SESSION['email'];
        
        $sql = "SELECT * FROM `usertable` WHERE email = '$email'";
        $result = mysqli_query($con, $sql);

        $row = mysqli_fetch_assoc($result);
        echo "Hello, ". $row['name']. ". We hope that you will find your soulmate here. All the Best.";

        if ($row['G'] == "Male")
        {
            $sql = "SELECT * FROM `usertable` WHERE G = Female ";
            $result = mysqli_query($con, $sql);

            $row = mysqli_fetch_assoc($result);
            echo "Name: ". $row['name']; 
        }
        else
        {

        }

    ?>
</body>
</html>