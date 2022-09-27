<?php require_once "controllerUserData.php"; ?>
<?php 
        $code = rand(999999, 11111);
        $status = "notverified";
	    session_start();
        $email = $_SESSION['email'];
        $update_data ="UPDATE usertable SET code ='$code', status = '$status' WHERE email ='$email'";
        $data_check = mysqli_query($con, $update_data);
        if ($data_check) {
            $subject = "Email Verification Code";
            $message = "Your verification code is $code";
            $sender = "From:playingwithlens554@gmail.com";
            if (mail($email, $subject, $message, $sender)) {
                $info = "We've sent a verification code to your email - $email";
                $_SESSION['info'] = $info;
                $_SESSION['email'] = $email;
                $_SESSION['password'] = $password;
                header('location: user-otp.php');
                exit();
            } else {
                $errors['otp-error'] = "Failed while sending code!";
            }
        } else {
            $errors['db-error'] = "Failed while inserting data into database!";
        }
        ?>