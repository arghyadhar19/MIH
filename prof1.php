<?php require_once "controllerUserData.php"; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>Profile</title>
    <style>

        .test
        {
            max-width: 10000px;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            color: white;
            text-align:left;
            background:rgb(167, 167, 233);
            padding: 30px 35px;
            border-radius: 5px;
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
            font-size: 20px;
        }
        .test img{
            border-radius:50%;
            height:150px;
            width:150px;
            margin-left:65px;
            margin-right:65px;
         
        }

    </style>
</head>
<body>
    
    <div class="test">
    <?php
        
        error_reporting(E_ERROR | E_WARNING | E_PARSE);

        session_start();
        $email = $_SESSION['email'];
        
        $sql = "SELECT * FROM `usertable` WHERE email = '$email'";
        $result = mysqli_query($con, $sql);
        
        $row = mysqli_fetch_assoc($result);
    ?>
     <img src="images\logo.png"><br>
    <?php
        echo "<p align= center><b><i><font-size= 30px>". $row['name']. "</font></i></b></p>";
        echo "Date Of Birth : ". $row['DOB']. "<br><br>";
        echo "Religion : ". $row['R']. "<br><br>";
        echo "Mother Tongue : ". $row['MT']. "<br><br>";
        echo "Caste : ". $row['C']. "<br><br>";
        echo "Employed In : ". $row['EI']. "<br><br>";
        echo "Occupation : ". $row['OCC']. "<br><br>";
        echo "Annual Income : ". $row['AI']. "<br><br>";
        echo "Work Location : ". $row['WL']. "<br><br>";
        ?>
    Click here to see more <a href="myprofile.php">Click Here</a>
    </div>
</body>
</html>
        