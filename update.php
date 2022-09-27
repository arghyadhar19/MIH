<?php require_once "controllerUserData.php"; ?>
<?php

    error_reporting(E_ERROR | E_WARNING | E_PARSE);

    session_start();
    $email = $_SESSION['email'];

    $sql = "SELECT * FROM `usertable` WHERE email = '$email'";
    $result = mysqli_query($con, $sql);

    $row = mysqli_fetch_assoc($result);


?>
<?php
$email = $_SESSION['email'];
$password = $_SESSION['password'];
if ($email != false && $password != false) {
    $sql = "SELECT * FROM usertable WHERE email = '$email'";
    $run_Sql = mysqli_query($con, $sql);
    if ($run_Sql) {
        $fetch_info = mysqli_fetch_assoc($run_Sql);
        $status = $fetch_info['status'];
        $code = $fetch_info['code'];
        if ($status == "verified") {
            if ($code != 0) {
                header('Location: reset-code.php');
            }
        } else {
            header('Location: user-otp.php');
        }
    }
} else {
    header('Location: login-user.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $fetch_info['name'] ?></title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        @import url('https://fonts.googleapis.com/css?family=Algerian:400,500,600,700&display=swap');
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap');

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: "Poppins", sans-serif;
        }

        .sidebar {
            position: fixed;
            left: 0;
            top: 0;
            height: 100%;
            width: 78px;
            background: #11101D;
            padding: 6px 14px;
            z-index: 99;
            transition: all 0.5s ease;
        }

        .sidebar.open {
            width: 250px;
        }

        .sidebar .logo-details {
            height: 60px;
            display: flex;
            align-items: center;
            position: relative;
        }

        .sidebar .logo-details .icon {
            opacity: 0;
            transition: all 0.5s ease;
        }

        .sidebar .logo-details .logo_name {
            color: #fff;
            font-size: 20px;
            font-weight: 600;
            opacity: 0;
            transition: all 0.5s ease;
        }

        .sidebar.open .logo-details .icon,
        .sidebar.open .logo-details .logo_name {
            opacity: 1;
        }

        .sidebar .logo-details #btn {
            position: absolute;
            top: 50%;
            right: 0;
            transform: translateY(-50%);
            font-size: 22px;
            transition: all 0.4s ease;
            font-size: 23px;
            text-align: center;
            cursor: pointer;
            transition: all 0.5s ease;
        }

        .sidebar.open .logo-details #btn {
            text-align: right;
        }

        .sidebar i {
            color: #fff;
            height: 60px;
            min-width: 50px;
            font-size: 28px;
            text-align: center;
            line-height: 60px;
        }

        .sidebar .nav-list {
            margin-top: 20px;
            height: 100%;
        }

        .sidebar li {
            position: relative;
            margin: 8px 0;
            list-style: none;
        }

        .sidebar li .tooltip {
            position: absolute;
            top: -20px;
            left: calc(100% + 15px);
            z-index: 3;
            background: #fff;
            box-shadow: 0 5px 10px rgba(0, 0, 0, 0.3);
            padding: 6px 12px;
            border-radius: 4px;
            font-size: 15px;
            font-weight: 400;
            opacity: 0;
            white-space: nowrap;
            pointer-events: none;
            transition: 0s;
        }

        .sidebar li:hover .tooltip {
            opacity: 1;
            pointer-events: auto;
            transition: all 0.4s ease;
            top: 50%;
            transform: translateY(-50%);
        }

        .sidebar.open li .tooltip {
            display: none;
        }

        .sidebar input {
            font-size: 15px;
            color: #FFF;
            font-weight: 400;
            outline: none;
            height: 50px;
            width: 100%;
            width: 50px;
            border: none;
            border-radius: 12px;
            transition: all 0.5s ease;
            background: #1d1b31;
        }

        .sidebar.open input {
            padding: 0 20px 0 50px;
            width: 100%;
        }

        .sidebar .bx-search {
            position: absolute;
            top: 50%;
            left: 0;
            transform: translateY(-50%);
            font-size: 22px;
            background: #1d1b31;
            color: #FFF;
        }

        .sidebar.open .bx-search:hover {
            background: #1d1b31;
            color: #FFF;
        }

        .sidebar .bx-search:hover {
            background: #FFF;
            color: #11101d;
        }

        .sidebar li a {
            display: flex;
            height: 100%;
            width: 100%;
            border-radius: 12px;
            align-items: center;
            text-decoration: none;
            transition: all 0.4s ease;
            background: #11101D;
        }

        .sidebar li a:hover {
            background: #FFF;
        }

        .sidebar li a .links_name {
            color: #fff;
            font-size: 15px;
            font-weight: 400;
            white-space: nowrap;
            opacity: 0;
            pointer-events: none;
            transition: 0.4s;
        }

        .sidebar.open li a .links_name {
            opacity: 1;
            pointer-events: auto;
        }

        .sidebar li a:hover .links_name,
        .sidebar li a:hover i {
            transition: all 0.5s ease;
            color: #11101D;
        }

        .sidebar li i {
            height: 50px;
            line-height: 50px;
            font-size: 18px;
            border-radius: 12px;
        }

        .sidebar li.profile {
            position: fixed;
            height: 60px;
            width: 78px;
            left: 0;
            bottom: -8px;
            padding: 10px 14px;
            background: #1d1b31;
            transition: all 0.5s ease;
            overflow: hidden;
        }

        .sidebar.open li.profile {
            width: 250px;
        }

        .sidebar li .profile-details {
            display: flex;
            align-items: center;
            flex-wrap: nowrap;
        }

        .sidebar li img {
            height: 45px;
            width: 45px;
            object-fit: cover;
            border-radius: 6px;
            margin-right: 10px;
        }

        .sidebar li.profile .name,
        .sidebar li.profile .job {
            font-size: 15px;
            font-weight: 400;
            color: #fff;
            white-space: nowrap;
        }

        .sidebar li.profile .job {
            font-size: 12px;
        }

        .sidebar .profile #log_out {
            position: absolute;
            top: 50%;
            right: 0;
            transform: translateY(-50%);
            background: #1d1b31;
            width: 100%;
            height: 60px;
            line-height: 60px;
            border-radius: 0px;
            transition: all 0.5s ease;
        }

        .sidebar.open .profile #log_out {
            width: 50px;
            background: none;
        }

        .home-section {
            position: relative;
            background: white;
            min-height: 100vh;
            top: 0;
            left: 78px;
            width: calc(100% - 78px);
            transition: all 0.5s ease;
            z-index: 2;
        }

        .sidebar.open~.home-section {
            left: 250px;
            width: calc(100% - 250px);
        }

        .home-section .text {
            display: inline-block;
            color: #11101d;
            font-size: 25px;
            font-weight: 500;
            margin: 18px
        }

        @media (max-width: 420px) {
            .sidebar li .tooltip {
                display: none;
            }
        }
        .container{
    max-width: 10000px;
    position: absolute;
    top: 220%;
    left: 50%;
    transform: translate(-50%, -50%);
}
    </style>
</head>
<body>
<div class="sidebar">
        <div class="logo-details">
            <i class='images/logo.png'></i>
            <div class="logo_name">MIH</div>
            <i class='bx bx-menu' id="btn"></i>
        </div>
        <ul class="nav-list">
            <li>
                <a href="#">
                    <i class='bx bx-arrow-back' id="back"></i>
                    <span class="links_name">Go back</span>
                </a>
                <span class="tooltip">back</span>
            </li>
            <li>
                <a href="index.html">
                    <i class='bx bx-home'></i>
                    <span class="links_name">HOME</span>
                </a>
                <span class="tooltip">HOME</span>
            </li>
            <li>
                <a href="login-user.php">
                    <i class='bx bx-user'></i>
                    <span class="links_name">LOGIN/REGISTER</span>
                </a>
                <span class="tooltip">LOGIN/REG</span>
            </li>
            <li>
                <a href="#">
                    <i class='bx bx-play-circle'></i>
                    <span class="links_name">ABOUT US</span>
                </a>
                <span class="tooltip">ABOUT</span>
            </li>
            <li>
                <a href="#">
                    <i class='bx bx-pie-chart-alt-2'></i>
                    <span class="links_name">PLANNERS</span>
                </a>
                <span class="tooltip">PLANNER</span>
            </li>
            <li>
                <a href="#">
                    <i class='bx bx-folder'></i>
                    <span class="links_name">BLOG</span>
                </a>
                <span class="tooltip">BLOG</span>
            </li>
            <li>
                <a href="#">
                    <i class='bx bx-message-square-detail'></i>
                    <span class="links_name">CONTACT US</span>
                </a>
                <span class="tooltip">CONTACT</span>
            </li>
            <li>
                <a href="#">
                    <i class='bx bx-heart'></i>
                    <span class="links_name">MEMBERSHIP</span>
                </a>
                <span class="tooltip">MEMBER</span>
            </li>
            <li>
                <a href="#">
                    <i class='bx bx-cog'></i>
                    <span class="links_name">SETTING</span>
                </a>
                <span class="tooltip">Setting</span>
            </li>
            <li class="profile">
                <div class="name_job">
                    <div class="name"><?php echo $fetch_info['name'] ?></div>
                    <div class="job">USER</div>
                </div>
                <a href="logout-user.php">
                    <i class='bx bx-log-out' id="log_out"></i>
                </a>
            </li>
        </ul>
    </div>
        <section class="home-section">
    <div class="container">
        <div class="row">
            <div class="col-md-4 offset-md-4 form">
                <form action="home.php" method="POST" autocomplete="">
                <h2 class="text-center">UPDATE PROFILE</h2>
                    <div class="form-group">
                        Date Of Birth : <input class="form-control" type="text" name="DOB" placeholder="Date Of Birth" required
                            value="<?php echo $row['DOB'] ?>">
                    </div>
                    <div class="form-group">
                        Religion : <input class="form-control" type="text" name="R" placeholder="Religion" required
                            value="<?php echo $row['R'] ?>">
                    </div>
                    <div class="form-group">
                        Mother Tongue : <input class="form-control" type="text" name="MT" placeholder="Mother Tounge" required
                            value="<?php echo $row['MT'] ?>">
                    </div>
                    <div class="form-group">
                        Caste : <input class="form-control" type="text" name="C" placeholder="Caste" required
                            value="<?php echo $row['C'] ?>">
                    </div>
                    <div class="form-group">
                        Willing to Marry from different caste ? <input class="form-control" type="text" name="WTM"
                            placeholder="Willing to Marry from different caste?" required value="<?php echo $row['WTM'] ?>">
                    </div>
                    <div class="form-group">
                        Sub-Caste : <input class="form-control" type="text" name="SC" placeholder="SUB-CASTE" required
                            value="<?php echo $row['SC'] ?>">
                    </div>
                    <div class="form-group">
                        Dosh : <input class="form-control" type="text" name="DOSH" placeholder="DOSH" required
                            value="<?php echo $row['DOSH'] ?>">
                    </div>
                    <div class="form-group">
                        Height : <input class="form-control" type="text" name="Height" placeholder="Height" required
                            value="<?php echo $row['Height'] ?>">
                    </div>
                    <div class="form-group">
                        Maritial Status : <input class="form-control" type="text" name="MS" placeholder="Marital Status" required
                            value="<?php echo $row['MS'] ?>">
                    </div>
                    <div class="form-group">
                        Any Disability : <input class="form-control" type="text" name="AD" placeholder="Any Disability" required
                            value="<?php echo $row['AD'] ?>">
                    </div>
                    <div class="form-group">
                        Family Status : <input class="form-control" type="text" name="FS" placeholder="Family Status" required
                            value="<?php echo $row['FS'] ?>">
                    </div>
                    <div class="form-group">
                        Family Type : <input class="form-control" type="text" name="FT" placeholder="Family Type" required
                            value="<?php echo $row['FT'] ?>">
                    </div>
                    <div class="form-group">
                        Family Value : <input class="form-control" type="text" name="FV" placeholder="Family Value" required
                            value="<?php echo $row['FV'] ?>">
                    </div>
                    <div class="form-group">
                        Education : <input class="form-control" type="text" name="ED" placeholder="EDUCATION" required
                            value="<?php echo $row['ED'] ?>">
                    </div>
                    <div class="form-group">
                        Employed In : <input class="form-control" type="text" name="EI" placeholder="EMPLOYED IN" required
                            value="<?php echo $row['EI'] ?>">
                    </div>
                    <div class="form-group">
                        Occupation : <input class="form-control" type="text" name="OCC" placeholder="OCCUPATION" required
                            value="<?php echo $row['OCC'] ?>">
                    </div>
                    <div class="form-group">
                        Annual Income : <input class="form-control" type="text" name="AI" placeholder="ANNUAL INCOME (in rupees)"
                            required value="<?php echo $row['AI'] ?>">
                    </div>
                    <div class="form-group">
                        Work Location : <input class="form-control" type="text" name="WL" placeholder="WORK LOCATION (COUNTRY)" required
                            value="<?php echo $row['WL'] ?>">
                    </div>
                    <div class="form-group">
                        Residing State : <input class="form-control" type="text" name="RS" placeholder="RESIDING STATE" required
                            value="<?php echo $row['RS'] ?>">
                    </div>
                    <p>About : </p>
                    <div class="form-group">

                        <label for="about"></label>
                        <textarea name="About" id="about" cols="35" rows="10"><?php echo $row['About'] ?></textarea>

                        <p>This will be your profile's <strong>DESCRIPTION</strong></p>
                    </div>
                    <div class="form-group">
						Partner's Age : <input class="form-control" type="text" name="Age" placeholder="Partner's Age" required value="<?php echo $row['Age'] ?>">
					</div>
					<div class="form-group">
						Partner's Height : <input class="form-control" type="text" name="PHT" placeholder="Partner's Height" required value="<?php echo $row['PHT'] ?>">
					</div>
					<div class="form-group">
						Partner's Maritial Status : <input class="form-control" type="text" name="PMS" placeholder="Partner's Maritial Status" required value="<?php echo $row['PMS'] ?>">
					</div>
					<div class="form-group">
						Partner's Mother Tongue : <input class="form-control" type="text" name="PMT" placeholder="Partner's Mother Tongues" required value="<?php echo $row['PMT'] ?>">
					</div>
					<div class="form-group">
						Partner's Physical Status : <input class="form-control" type="text" name="PPS" placeholder="Partner's Physical Status" required value="<?php echo $row['PPS'] ?>">
					</div>
					<div class="form-group">
						Partner's Education : <input class="form-control" type="text" name="PED" placeholder="Partner's Education" required value="<?php echo $row['PED'] ?>">
					</div>
					<div class="form-group">
						Partner's Working Sector : <input class="form-control" type="text" name="PEI" placeholder="Partner's Working Sector" required value="<?php echo $row['PEI'] ?>">
					</div>
					<div class="form-group">
						Partner's Occupation : <input class="form-control" type="text" name="POCC" placeholder="Partner's Occupation" required value="<?php echo $row['POCC'] ?>">
					</div>
					<div class="form-group">
						Partner's Annual Income : <input class="form-control" type="text" name="PAI" placeholder="Partner's Annual Income" required value="<?php echo $row['PAI'] ?>">
					</div>
					<div class="form-group">
						Partner's Country : <input class="form-control" type="text" name="PC" placeholder="Partner's Country" required value="<?php echo $row['PC'] ?>">
					</div>
					Any Other Information : 
                    <label for="about"></label>
					<textarea name="PEX" id="PEX" cols="35" rows="8" placeholder="Any other Information" ><?php echo $row['PEX'] ?></textarea>
                    <div class="form-group">
                        <input class="form-control button" type="submit" name="Update" value="Update">
                    </div>
                </form>
            </div>
        </div>
    </div>
    </section>

<script src="script.js"></script>
</body>

</html>