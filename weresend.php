<?php require_once "controllerUserData.php"; ?>
<?php 
        $code = rand(999999, 11111);
        $status = "notverified";
	session_start();
        $OEI = $_SESSION['OEI'];
        $update_data ="UPDATE wedding SET code ='$code', status = '$status' WHERE OEI ='$OEI'";
        $data_check = mysqli_query($con, $update_data);
        if ($data_check) {
            $subject = "Email Verification Code";
            $message = "Your verification code is $code";
            $sender = "From:playingwithlens554@gmail.com";
            if (mail($OEI, $subject, $message, $sender)) {
                $info = "We've sent a verification code to your email - $OEI";
                $_SESSION['info'] = $info;
                $_SESSION['OEI'] = $OEI;
                $_SESSION['password'] = $password;
                header('location: page8otp.php');
                exit();
            } else {
                $errors['otp-error'] = "Failed while sending code!";
            }
        } else {
            $errors['db-error'] = "Failed while inserting data into database!";
        }
        ?>