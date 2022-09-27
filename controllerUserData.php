<?php
session_start();
require "connection.php";
$msg = "";
$email = "";
$name = "";
$oaf = "";
$ph = "";
$AN = "";
$G = "";
$DOB = "";
$R = "";
$MT = "";
$C = "";
$WTM = "";
$SC = "";
$DOSH = "";
$Height = "";
$MS = "";
$AD = "";
$FS = "";
$FT = "";
$FV = "";
$ED = "";
$EI = "";
$AI = "";
$OCC = "";
$WL = "";
$RS = "";
$About = "";
$Age = "";
$PHT = "";
$PMS = "";
$PMT = "";
$PPS = "";
$PED = "";
$POCC = "";
$PAI = "";
$PC = "";
$PEX = "";
$CN = "";
$OWN = "";
$OEI = "";
$OPH = "";
$WE = "";
$PCI = "";
$TM = "";
$SMH = "";
$REF = "";
$WP1 = "";
$WP2 = "";
$WP3 = "";
$WP4 = "";
$WP5 = "";
$PWP = "";
$COMF = "";
$OI = "";
$pagecheck = "";
$image = "";
$image_text = "";
$target = "";
$errors = array();

//if user signup button
if (isset($_POST['signup'])) {
    session_start();
    $oaf = mysqli_real_escape_string($con, $_POST['oaf']);
    $name = mysqli_real_escape_string($con, $_POST['name']);
    $ph = mysqli_real_escape_string($con, $_POST['ph']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $_SESSION['email'] = $email;
    $AN = mysqli_real_escape_string($con, $_POST['AN']);
    $G = mysqli_real_escape_string($con, $_POST['G']);
    $password = mysqli_real_escape_string($con, $_POST['password']);
    $cpassword = mysqli_real_escape_string($con, $_POST['cpassword']);
    if ($password !== $cpassword) {
        $errors['password'] = "Confirm password not matched!";
    }
    $email_check = "SELECT * FROM usertable WHERE email = '$email'";
    $res = mysqli_query($con, $email_check);
    if (mysqli_num_rows($res) > 0) {
        $errors['email'] = "Email that you have entered is already exist!";
    }
    $AN_check = "SELECT * FROM usertable WHERE AN = '$AN'";
    $res = mysqli_query($con, $AN_check);
    if (mysqli_num_rows($res) > 0) {
        $errors['AN'] = "AADHAR Number that you have entered is already exist!";
    }

    if (count($errors) === 0) {
        $encpass = password_hash($password, PASSWORD_BCRYPT);
        $code = rand(999999, 11111);
        $status = "notverified";
        $insert_data = "INSERT INTO usertable (oaf, name, ph, email, AN, G, password, code, status)
                        values('$oaf','$name','$ph', '$email','$AN','$G', '$encpass', '$code', '$status')";
        $data_check = mysqli_query($con, $insert_data);
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
    }
}
// weddingplanner
if (isset($_POST['signup1'])) {
    session_start();
    $CN = mysqli_real_escape_string($con, $_POST['CN']);
    $OWN = mysqli_real_escape_string($con, $_POST['OWN']);
    $OEI = mysqli_real_escape_string($con, $_POST['OEI']);
    $_SESSION['OEI'] = $OEI;
    $OPH = mysqli_real_escape_string($con, $_POST['OPH']);
    $password1 = mysqli_real_escape_string($con, $_POST['password']);
    $cpassword1 = mysqli_real_escape_string($con, $_POST['cpassword']);
    if ($password1 !== $cpassword1) {
        $errors['password'] = "Confirm password not matched!";
    }
    $OEI_check = "SELECT * FROM wedding WHERE OEI = '$OEI'";
    $res = mysqli_query($con, $OEI_check);
    if (mysqli_num_rows($res) > 0) {
        $errors['OEI'] = "Email that you have entered is already exist!";
    }
    $PH_check = "SELECT * FROM wedding WHERE OPH = '$OPH'";
    $res = mysqli_query($con, $PH_check);
    if (mysqli_num_rows($res) > 0) {
        $errors['OPH'] = "Phone Number that you have entered is already exist!";
    }

    if (count($errors) === 0) {
        $encpass = password_hash($password1, PASSWORD_BCRYPT);
        $code = rand(999999, 11111);
        $status = "notverified";
        $insert_data = "INSERT INTO wedding (CN, OWN, OEI, OPH, password, code, status)
                        values('$CN','$OWN','$OEI', '$OPH', '$encpass', '$code', '$status')";
        $data_check = mysqli_query($con, $insert_data);
        if ($data_check) {
            $subject = "Email Verification Code";
            $message = "Your verification code is $code";
            $sender = "From:playingwithlens554@gmail.com";
            if (mail($OEI, $subject, $message, $sender)) {
                $info = "We've sent a verification code to your email - $OEI";
                $_SESSION['info'] = $info;
                $_SESSION['OEI'] = $OEI;
                $_SESSION['password'] = $password1;
                header('location: page8otp.php');
                exit();
            } else {
                $errors['otp-error'] = "Failed while sending code!";
            }
        } else {
            $errors['db-error'] = "Failed while inserting data into database!";
        }
    }
}

if (isset($_POST['Next'])) {
    session_start();
    $email = $_SESSION['email'];
    if (empty($_POST['DOB'])) {
        // $errors['db-error'] = "Every field is mandatory";
        echo "Every field is mandatory";
    } else {

        $DOB = mysqli_real_escape_string($con, $_POST['DOB']);
        $R = mysqli_real_escape_string($con, $_POST['R']);
        $MT = mysqli_real_escape_string($con, $_POST['MT']);
        $C = mysqli_real_escape_string($con, $_POST['C']);
        $WTM = mysqli_real_escape_string($con, $_POST['WTM']);
        $SC = mysqli_real_escape_string($con, $_POST['SC']);
        $DOSH = mysqli_real_escape_string($con, $_POST['DOSH']);
        $update_data = "UPDATE usertable SET DOB ='$DOB', R = '$R', MT='$MT', C='$C', WTM='$WTM', SC='$SC', DOSH='$DOSH'  WHERE email ='$email'";
        $data_check = mysqli_query($con, $update_data);
        if ($data_check) {
            header('location: page3.php');
            exit();
        }
    }
}
if (isset($_POST['Update'])) {
    session_start();
    $email = $_SESSION['email'];
    $DOB = mysqli_real_escape_string($con, $_POST['DOB']);
    $R = mysqli_real_escape_string($con, $_POST['R']);
    $MT = mysqli_real_escape_string($con, $_POST['MT']);
    $C = mysqli_real_escape_string($con, $_POST['C']);
    $WTM = mysqli_real_escape_string($con, $_POST['WTM']);
    $SC = mysqli_real_escape_string($con, $_POST['SC']);
    $DOSH = mysqli_real_escape_string($con, $_POST['DOSH']);
    $Height = mysqli_real_escape_string($con, $_POST['Height']);
    $MS = mysqli_real_escape_string($con, $_POST['MS']);
    $AD = mysqli_real_escape_string($con, $_POST['AD']);
    $FS = mysqli_real_escape_string($con, $_POST['FS']);
    $FT = mysqli_real_escape_string($con, $_POST['FT']);
    $FV = mysqli_real_escape_string($con, $_POST['FV']);
    $ED = mysqli_real_escape_string($con, $_POST['ED']);
    $EI = mysqli_real_escape_string($con, $_POST['EI']);
    $AI = mysqli_real_escape_string($con, $_POST['AI']);
    $OCC = mysqli_real_escape_string($con, $_POST['OCC']);
    $WL = mysqli_real_escape_string($con, $_POST['WL']);
    $RS = mysqli_real_escape_string($con, $_POST['RS']);
    $About = mysqli_real_escape_string($con, $_POST['About']);
    $Age = mysqli_real_escape_string($con, $_POST['Age']);
    $PHT = mysqli_real_escape_string($con, $_POST['PHT']);
    $PMS = mysqli_real_escape_string($con, $_POST['PMS']);
    $PMT = mysqli_real_escape_string($con, $_POST['PMT']);
    $PPS = mysqli_real_escape_string($con, $_POST['PPS']);
    $PED = mysqli_real_escape_string($con, $_POST['PED']);
    $PEI = mysqli_real_escape_string($con, $_POST['PEI']);
    $POCC = mysqli_real_escape_string($con, $_POST['POCC']);
    $PAI = mysqli_real_escape_string($con, $_POST['PAI']);
    $PC = mysqli_real_escape_string($con, $_POST['PC']);
    $PEX = mysqli_real_escape_string($con, $_POST['PEX']);
    $update_data = "UPDATE usertable SET DOB ='$DOB', R = '$R', MT='$MT', C='$C', WTM='$WTM', SC='$SC', DOSH='$DOSH', Height ='$Height', MS = '$MS', AD='$AD', FS='$FS', FT='$FT', FV='$FV', ED ='$ED', EI = '$EI', AI='$AI', OCC='$OCC', WL='$WL', RS='$RS', About ='$About', Age ='$Age', PHT = '$PHT', PMS='$PMS', PMT='$PMT', PPS='$PPS', PED='$PED', PEI='$PEI', POCC='$POCC',PAI='$PAI',PC='$PC',PEX='$PEX' WHERE email ='$email'";
    $data_check = mysqli_query($con, $update_data);
    if ($data_check) {
        header('location: profile.php');
        exit();
    }
}
if (isset($_POST['Next2'])) {
    session_start();
    $OEI = $_SESSION['OEI'];
    $WE = mysqli_real_escape_string($con, $_POST['WE']);
    $PCI = mysqli_real_escape_string($con, $_POST['PCI']);
    $TM = mysqli_real_escape_string($con, $_POST['TM']);
    $SMH = mysqli_real_escape_string($con, $_POST['SMH']);
    $REF = mysqli_real_escape_string($con, $_POST['REF']);
    $WP1 = mysqli_real_escape_string($con, $_POST['WP1']);
    $WP2 = mysqli_real_escape_string($con, $_POST['WP2']);
    $WP3 = mysqli_real_escape_string($con, $_POST['WP3']);
    $WP4 = mysqli_real_escape_string($con, $_POST['WP4']);
    $WP5 = mysqli_real_escape_string($con, $_POST['WP5']);
    $PWP = mysqli_real_escape_string($con, $_POST['PWP']);
    $COMF = mysqli_real_escape_string($con, $_POST['COMF']);
    $OI = mysqli_real_escape_string($con, $_POST['OI']);
    $update_data2 = "UPDATE wedding SET WE ='$WE', PCI = '$PCI', TM='$TM', SMH='$SMH', REF='$REF', WP1='$WP1', WP2='$WP2' WP3='$WP3' WP4='$WP4' WP5='$WP5' PWP='$PWP' COMF='$COMF' OI='$OI' WHERE OEI ='$OEI'";
    $data_check = mysqli_query($con, $update_data2);
    if ($data_check) {
        header('location: page6.php');
        exit();
    }
}
if (isset($_POST['continue'])) {
    session_start();
    $email = $_SESSION['email'];
    $Height = mysqli_real_escape_string($con, $_POST['Height']);
    $MS = mysqli_real_escape_string($con, $_POST['MS']);
    $AD = mysqli_real_escape_string($con, $_POST['AD']);
    $FS = mysqli_real_escape_string($con, $_POST['FS']);
    $FT = mysqli_real_escape_string($con, $_POST['FT']);
    $FV = mysqli_real_escape_string($con, $_POST['FV']);
    $update_h = "UPDATE usertable SET Height ='$Height', MS = '$MS', AD='$AD', FS='$FS', FT='$FT', FV='$FV' WHERE email ='$email'";
    $data_check = mysqli_query($con, $update_h);
    if ($data_check) {
        header('location: pagefour.php');
        exit();
    }
}
if (isset($_POST['EDIT'])) {
    header('location:update.php');
    exit();
}
if (isset($_POST['DELETE'])) {
    session_start();
    $email = $_SESSION['email'];
    $q = "delete from usertable where email = '$email'";
    $x = mysqli_query($con, $q);
    if ($x==0) {
        header("location:rating.php");
    } else {
        header("location:wow2.html");
    }
}
if (isset($_POST['continue2'])) {
    session_start();
    $email = $_SESSION['email'];
    $About = mysqli_real_escape_string($con, $_POST['About']);
    $update_h = "UPDATE usertable SET About ='$About' WHERE email ='$email'";
    $data_check = mysqli_query($con, $update_h);
    if ($data_check) {
        header('location: PAGE7.php');
        exit();
    }
}
if (isset($_POST['continue1'])) {
    session_start();
    $email = $_SESSION['email'];
    $ED = mysqli_real_escape_string($con, $_POST['ED']);
    $EI = mysqli_real_escape_string($con, $_POST['EI']);
    $AI = mysqli_real_escape_string($con, $_POST['AI']);
    $OCC = mysqli_real_escape_string($con, $_POST['OCC']);
    $WL = mysqli_real_escape_string($con, $_POST['WL']);
    $RS = mysqli_real_escape_string($con, $_POST['RS']);
    $update_h = "UPDATE usertable SET ED ='$ED', EI = '$EI', AI='$AI', OCC='$OCC', WL='$WL', RS='$RS' WHERE email ='$email'";
    $data_check = mysqli_query($con, $update_h);
    if ($data_check) {
        header('location: PAGE5.PHP');
        exit();
    }
}
if (isset($_POST['continue3'])) {
    session_start();
    $email = $_SESSION['email'];
    $Age = mysqli_real_escape_string($con, $_POST['Age']);
    $PHT = mysqli_real_escape_string($con, $_POST['PHT']);
    $PMS = mysqli_real_escape_string($con, $_POST['PMS']);
    $PMT = mysqli_real_escape_string($con, $_POST['PMT']);
    $PPS = mysqli_real_escape_string($con, $_POST['PPS']);
    $PED = mysqli_real_escape_string($con, $_POST['PED']);
    $POCC = mysqli_real_escape_string($con, $_POST['POCC']);
    $PAI = mysqli_real_escape_string($con, $_POST['PAI']);
    $PC = mysqli_real_escape_string($con, $_POST['PC']);
    $PEX = mysqli_real_escape_string($con, $_POST['PEX']);
    $pagecheck = 100;
    $update_h = "UPDATE usertable SET Age ='$Age', PHT = '$PHT', PMS='$PMS', PMT='$PMT', PPS='$PPS', PED='$PED', POCC='$POCC',PAI='$PAI',PC='$PC',PEX='$PEX',pagecheck='$pagecheck' WHERE email ='$email'";
    $data_check = mysqli_query($con, $update_h);
    if ($data_check) {
        header('location: page6.php');
        exit();
    }
}
//if user click verification code submit button
if (isset($_POST['check'])) {
    $_SESSION['info'] = "";
    $otp_code = mysqli_real_escape_string($con, $_POST['otp']);
    $check_code = "SELECT * FROM usertable WHERE code = $otp_code";
    $code_res = mysqli_query($con, $check_code);
    if (mysqli_num_rows($code_res) > 0) {
        $fetch_data = mysqli_fetch_assoc($code_res);
        $fetch_code = $fetch_data['code'];
        $email = $fetch_data['email'];
        $code = 0;
        $status = 'verified';
        $update_otp = "UPDATE usertable SET code = $code, status = '$status' WHERE code = $fetch_code";
        $update_res = mysqli_query($con, $update_otp);
        if ($update_res) {
            $_SESSION['name'] = $name;
            $_SESSION['email'] = $email;
            $info = "You are Verified. Now you can Login";
            $_SESSION['info'] = $info;
            header('location: verification.php');
            exit();
        } else {
            $errors['otp-error'] = "Failed while updating code!";
        }
    } else {
        $errors['otp-error'] = "You've entered incorrect code!";
    }
}
if (isset($_POST['check1'])) {
    $_SESSION['info'] = "";
    $otp_code = mysqli_real_escape_string($con, $_POST['otp']);
    $check_code = "SELECT * FROM wedding WHERE code = $otp_code";
    $code_res = mysqli_query($con, $check_code);
    if (mysqli_num_rows($code_res) > 0) {
        $fetch_data = mysqli_fetch_assoc($code_res);
        $fetch_code = $fetch_data['code'];
        $OEI = $fetch_data['OEI'];
        $code = 0;
        $status = 'verified';
        $update_otp = "UPDATE wedding SET code = $code, status = '$status' WHERE code = $fetch_code";
        $update_res = mysqli_query($con, $update_otp);
        if ($update_res) {
            $_SESSION['CN'] = $CN;
            $_SESSION['OEI'] = $OEI;
            header('location: wedhome.php');
            exit();
        } else {
            $errors['otp-error'] = "Failed while updating code!";
        }
    } else {
        $errors['otp-error'] = "You've entered incorrect code!";
    }
}
//if user click login button
if (isset($_POST['login'])) {
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $password = mysqli_real_escape_string($con, $_POST['password']);
    $check_email = "SELECT * FROM usertable WHERE email = '$email'";
    $res = mysqli_query($con, $check_email);
    if (mysqli_num_rows($res) > 0) {
        $fetch = mysqli_fetch_assoc($res);
        $fetch_pass = $fetch['password'];
        if (password_verify($password, $fetch_pass)) {
            $_SESSION['email'] = $email;
            $status = $fetch['status'];
            $pagecheck = $fetch['pagecheck'];
            if ($status == 'verified') {
                $_SESSION['email'] = $email;
                $_SESSION['password'] = $password;
                if ($pagecheck == '100') {
                    header('location: myprofile.php');
                } else {
                    // $info = "It's look like you haven't completed your registration";
                    // $_SESSION['info'] = $info;
                    echo "It's look like you haven't completed your registration";
                    header('location: home.php');
                }
            } else {
                $info = "It's look like you haven't still verify your email - $email";
                $_SESSION['info'] = $info;
                $_SESSION['email'] = $email;
                header('location: user-otp.php');
            }
        } else {
            $errors['email'] = "Incorrect email or password!";
        }
    } else {
        $errors['email'] = "It's look like you're not yet a member! Click on the bottom link to signup.";
    }
}
if (isset($_POST['login1'])) {
    session_start();
    $OEI = mysqli_real_escape_string($con, $_POST['OEI']);
    $password1 = mysqli_real_escape_string($con, $_POST['password']);
    $check_email = "SELECT * FROM wedding WHERE OEI = '$OEI'";
    $res = mysqli_query($con, $check_email);
    if (mysqli_num_rows($res) > 0) {
        $fetch = mysqli_fetch_assoc($res);
        $fetch_pass = $fetch['password'];
        if (password_verify($password1, $fetch_pass)) {
            $_SESSION['OEI'] = $OEI;
            $status = $fetch['status'];
            if ($status == 'verified') {
                $_SESSION['OEI'] = $OEI;
                $_SESSION['password'] = $password1;
                header('location: wedhome.php');
            } else {
                $info = "It's look like you haven't still verify your email - $OEI";
                $_SESSION['info'] = $info;
                header('location: page8otp.php');
            }
        } else {
            $errors['OEI'] = "Incorrect email or password!";
        }
    } else {
        $errors['OEI'] = "It's look like you're not yet a member! Click on the bottom link to signup.";
    }
}
//if user click continue button in forgot password form
if (isset($_POST['check-email'])) {
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $check_email = "SELECT * FROM usertable WHERE email='$email'";
    $run_sql = mysqli_query($con, $check_email);
    if (mysqli_num_rows($run_sql) > 0) {
        $code = rand(999999, 111111);
        $insert_code = "UPDATE usertable SET code = $code WHERE email = '$email'";
        $run_query =  mysqli_query($con, $insert_code);
        if ($run_query) {
            $subject = "Password Reset Code";
            $message = "Your password reset code is $code";
            $sender = "From:playingwithlens554@gmail.com";
            if (mail($email, $subject, $message, $sender)) {
                $info = "We've sent a passwrod reset otp to your email - $email";
                $_SESSION['info'] = $info;
                $_SESSION['email'] = $email;
                header('location: reset-code.php');
                exit();
            } else {
                $errors['otp-error'] = "Failed while sending code!";
            }
        } else {
            $errors['db-error'] = "Something went wrong!";
        }
    } else {
        $errors['email'] = "This email address does not exist!";
    }
}
if (isset($_POST['check-email1'])) {
    $OEI = mysqli_real_escape_string($con, $_POST['OEI']);
    $check_email = "SELECT * FROM wedding WHERE OEI='$OEI'";
    $run_sql = mysqli_query($con, $check_email);
    if (mysqli_num_rows($run_sql) > 0) {
        $code = rand(999999, 111111);
        $insert_code = "UPDATE wedding SET code = $code WHERE OEI = '$OEI'";
        $run_query =  mysqli_query($con, $insert_code);
        if ($run_query) {
            $subject = "Password Reset Code";
            $message = "Your password reset code is $code";
            $sender = "From:playingwithlens554@gmail.com";
            if (mail($OEI, $subject, $message, $sender)) {
                $info = "We've sent a passwrod reset otp to your email - $OEI";
                $_SESSION['info'] = $info;
                $_SESSION['OEI'] = $OEI;
                header('location: wereset.php');
                exit();
            } else {
                $errors['otp-error'] = "Failed while sending code!";
            }
        } else {
            $errors['db-error'] = "Something went wrong!";
        }
    } else {
        $errors['OEI'] = "This email address does not exist!";
    }
}

//if user click check reset otp button
if (isset($_POST['check-reset-otp'])) {
    $_SESSION['info'] = "";
    $otp_code = mysqli_real_escape_string($con, $_POST['otp']);
    $check_code = "SELECT * FROM usertable WHERE code = $otp_code";
    $code_res = mysqli_query($con, $check_code);
    if (mysqli_num_rows($code_res) > 0) {
        $fetch_data = mysqli_fetch_assoc($code_res);
        $email = $fetch_data['email'];
        $_SESSION['email'] = $email;
        $info = "Please create a new password that you don't use on any other site.";
        $_SESSION['info'] = $info;
        header('location: new-password.php');
        exit();
    } else {
        $errors['otp-error'] = "You've entered incorrect code!";
    }
}
if (isset($_POST['check-reset-otp1'])) {
    $_SESSION['info'] = "";
    $otp_code = mysqli_real_escape_string($con, $_POST['otp']);
    $check_code = "SELECT * FROM wedding WHERE code = $otp_code";
    $code_res = mysqli_query($con, $check_code);
    if (mysqli_num_rows($code_res) > 0) {
        $fetch_data = mysqli_fetch_assoc($code_res);
        $OEI = $fetch_data['OEI'];
        $_SESSION['OEI'] = $OEI;
        $info = "Please create a new password that you don't use on any other site.";
        $_SESSION['info'] = $info;
        header('location: wedpassword.php');
        exit();
    } else {
        $errors['otp-error'] = "You've entered incorrect code!";
    }
}

//if user click change password button
if (isset($_POST['change-password'])) {
    $_SESSION['info'] = "";
    $password = mysqli_real_escape_string($con, $_POST['password']);
    $cpassword = mysqli_real_escape_string($con, $_POST['cpassword']);
    if ($password !== $cpassword) {
        $errors['password'] = "Confirm password not matched!";
    } else {
        $code = 0;
        $status = 'verified';
        $email = $_SESSION['email']; //getting this email using session
        $encpass = password_hash($password, PASSWORD_BCRYPT);
        $update_pass = "UPDATE usertable SET code = $code, status = '$status', password = '$encpass' WHERE email = '$email'";
        $run_query = mysqli_query($con, $update_pass);
        if ($run_query) {
            $info = "Your password changed. Now you can login with your new password.";
            $_SESSION['info'] = $info;
            header('Location: password-changed.php');
        } else {
            $errors['db-error'] = "Failed to change your password!";
        }
    }
}
if (isset($_POST['changepassword1'])) {
    $_SESSION['info'] = "";
    $password1 = mysqli_real_escape_string($con, $_POST['password']);
    $cpassword1 = mysqli_real_escape_string($con, $_POST['cpassword']);
    if ($password1 !== $cpassword1) {
        $errors['password'] = "Confirm password not matched!";
    } else {
        $code = 0;
        $status = 'verified';
        $OEI = $_SESSION['OEI']; //getting this email using session
        $encpass = password_hash($password1, PASSWORD_BCRYPT);
        $update_pass = "UPDATE wedding SET code = $code, status = '$status', password = '$encpass' WHERE OEI = '$OEI'";
        $run_query = mysqli_query($con, $update_pass);
        if ($run_query) {
            $info = "Your password changed. Now you can login with your new password.";
            $_SESSION['info'] = $info;
            header('Location: passchanged.php');
        } else {
            $errors['db-error'] = "Failed to change your password!";
        }
    }
}

//if login now button click
if (isset($_POST['login-now'])) {
    header('Location: login-user.php');
}
if (isset($_POST['profile'])) {
        header('location: myprofile.php');
}
if (isset($_POST['login-now1'])) {
    header('Location: page9.php');
}
