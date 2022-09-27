<?php require_once "controllerUserData.php"; ?>
<?php
session_start();
?>

<html>

<head>
    <title>Martrimuni Profile</title>
    <!-- <link rel="stylesheet" href="profilestyle.css"> -->
    <style>
        * {
            margin: 0;
            padding: 0;
            font-family: 'poppins', sans-serif;
            text-transform: capitalize;
            box-sizing: border-box;
            outline: none;
            border: none;
            text-decoration: none;
            font-weight: normal;

        }

        html {
            font-size: 62.5%;
            overflow: hidden;
        }

        body {
            overflow: hidden;
            min-height: 100vh;
            display: flex;
            align-items: flex-end;
            justify-content: space-between;
            background: linear-gradient(deeppink, purple);
            padding: 5.5rem;
        }

        .heading {
            font-size: 20px;
            text-align: center;
            padding: 1rem;
            color: #fff;
        }

        .am
        {
            margin: -231px;
            margin-top: 6px;
        }

        .fm
        {
            margin: -43px;
            margin-top: 6px;
        }

        .em
        {
            margin: -22px;
            margin-top: 6px;
        }

        .wm
        {
            margin: -60px;
            margin-top: 6px;
        }

        .pm
        {
            margin: -211px;
            margin-top: 6px;
        }

        header {
            width: 35rem;
            background: rgba(255, 255, 255, .2);
            box-shadow: 0 1rem 2rem rgba(0, 0, 0, .3);
            backdrop-filter: blur(.4rem);
            text-align: center;
            padding: 1rem;
            border-radius: 1rem;
        }

        header .user {
            padding-top: 2rem;
        }

        header .user img {
            margin: 1rem 0;
            height: 15rem;
            width: 15rem;
            border-radius: 50%;
            object-fit: cover;
            box-shadow: 0 0 0 1rem rgba(255, 255, 255, .2);
        }

        header .user .name {
            font-size: 3rem;
            color: #fff;
            padding: .5rem 0;
        }

        header .user .post {
            font-size: 1.8rem;
            color: #eee;
            font-weight: lighter;
        }

        header .navbar {
            padding: 1rem 3rem;
        }

        header .navbar ul li {
            margin: 1rem 0;
            list-style: none;
        }

        header .navbar ul li a {
            display: block;
            padding: 1rem;
            font-size: 2rem;
            color: rgba(255, 255, 255, .2);
            box-shadow: 0 1rem 2rem rgba(0, 0, 0, .2);
            border-radius: 1rem;
            transition: all .2s linear;
        }

        header .navbar ul li a:hover {
            background: rgba(255, 255, 255, .5);
            color: #555;
            transition: none;
        }

        .container {
            height: 58rem;
            width: 80rem;
            background: rgba(255, 255, 255, .2);
            box-shadow: 0 1rem 2rem rgba(0, 0, 0, .3);
            backdrop-filter: blur(.4rem);
            overflow: auto;
            border-radius: 1rem;
        }

        .home {
            min-height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-flow: column;
            position: relative;
            padding-bottom: 10rem;
            overflow: auto;


        }

        .home p {
            font-size: 20px;
            font-weight: lighter;
            color: #eee;
            margin-top: 15px;
            align-items: center;
            justify-content: center;
        }

        .home h3 {
            font-size: 2.5rem;
            font-weight: lighter;
            color: #eee;
            margin-top: 13px;

        }

        .home .homecontent .p {
            font-size: 2.5rem;
            font-weight: lighter;
            color: #eee;

        }

        .home .name span {
            font-size: 4rem;
            color: #fff;

        }

        .home .post {
            padding: 1rem 0;
        }

        .home .post span {
            font-size: 3rem;
            color: #fff;
        }

        .about {
            min-height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-flow: column;
            position: relative;
            padding-bottom: 10rem;
        }

        .about .aboutcontent table tr td {
            font-size: 2rem;
            font-weight: lighter;
            color: #eee;
            margin-bottom: 20px;
        }

        .family {
            min-height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-flow: column;
            position: relative;
            padding-bottom: 10rem;
        }

        .family .familycontent table tr td {
            font-size: 2rem;
            font-weight: lighter;
            color: #eee;
            margin-bottom: 3rem;
        }

        .education {
            min-height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-flow: column;
            position: relative;
            padding-bottom: 10rem;
        }

        .education .educationcontent table tr td {
            font-size: 2rem;
            font-weight: lighter;
            color: #eee;
            margin-bottom: 3rem;
        }

        .work {
            min-height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-flow: column;
            position: relative;
            padding-bottom: 10rem;
        }

        .work .workcontent table tr td {
            font-size: 2rem;
            font-weight: lighter;
            color: #eee;
            margin-bottom: 3rem;
        }
        
    </style>
</head>

<body>

    <div>
        <?php

error_reporting(E_ERROR | E_WARNING | E_PARSE);

session_start();
$email = $_SESSION['email'];

$sql = "SELECT * FROM `usertable` WHERE email = '$email'";
$result = mysqli_query($con, $sql);

$row = mysqli_fetch_assoc($result);

        ?>
    </div>
    <header>
        <div class="user">
            <img src="pic/profile.jpg">
            <h3 class="name">
                <?php echo $row['name'];?>
            </h3>

        </div>
        <nav class="navbar">
            <ul>
                <li><a href="#home">Home</a></li>
                <li><a href="update.php">Update Your Profile</a></li>
                <li><a href="#family">Family</a></li>
                <li><a href="#education">Education</a></li>
                <li><a href="#work">Work</a></li>
            </ul>
        </nav>
    </header>
    <div class="container">
        <section class="home" id="home">
            <h3><?php echo $row['name']. "'s Profile"; ?></h3>
            <div class="homecontent">
                <p>
                    <?php echo $row['About'];?>
                </p>
            </div>
            <div class="aboutcontent">
                <h1 class="heading am">About Me</h1>
                    <table>
                        <tr>
                            <td>Gender:</td>
                            <td>
                            <?php echo $row['G']; ?>
                        </td>
                    </tr><br><br> 
                    <tr>
                        <td>Mother Toungue:</td>
                        <td>
                            <?php echo $row['MT'];?>
                        </td>
                    </tr><br><br>
                    <tr>
                        <td>Email Id:</td>
                        <td>
                        <?php echo $row['email'];?>
                        </td>
                    </tr><br><br>
                    <tr>
                        <td>Phone No.:</td>
                        <td>
                        <?php echo $row['ph'];?>
                        </td>
                    </tr><br><br>
                    <tr>
                        <td>Aadhar No.:</td>
                        <td>
                        <?php echo $row['AN'];?>
                    </tr><br><br>
                    <tr>
                        <td>Date Of Birth:</td>
                        <td>
                            <?php echo $row['DOB'];?>
                        </td>
                    </tr><br><br>
                    <tr>
                        <td>Religion:</td>
                        <td>
                        <?php echo $row['R'];?>
                        </td>
                    </tr><br><br>
                    <tr>
                        <td>Caste:</td>
                        <td>
                        <?php echo $row['C'];?>
                        </td>
                    </tr><br><br>
                    <tr>
                        <td>Maritial Status:</td>
                        <td>
                        <?php echo $row['MS'];?>
                        </td>
                    </tr><br><br>  
                    <tr>  
                        <td>Height:</td>
                        <td>
                        <?php echo $row['Height'];?>
                        </td>
                    </tr><br><br>
                    <tr>
                        <td>Any Disability:</td>
                        <td>
                        <?php echo $row['AD'];?>
                        </td>
                    </tr><br><br>
                    </table>
            </div>
            <div class="familycontent">
                <h1 class="heading fm">My Family</h1>
                <table>
                    <tr>
                        <td>Family Status:</td>
                        <td>
                        <?php echo $row['FS'];?>
                        </td>
                    </tr><br><br>

                    <tr>
                        <td>Family Type:</td>
                        <td>
                        <?php echo $row['FT'];?>
                        </td>
                    </tr>
                    <tr>
                        <td>Family Values:</td>
                        <td>
                        <?php echo $row['FV'];?>
                        </td>
                    </tr><br><br>
                </table>
            </div>
            <h1 class="heading em">My Education</h1>
            <div class="educationcontent">
                <table>
                    <tr>
                        <td>Highest Education:</td>
                        <td>
                        <?php echo $row['ED'];?>
                        </td>
                    </tr><br><br>
                </table>
            </div>
            <h1 class="heading wm">My Work</h1>
            <div class="workcontent">
                <table>
                    <tr>
                        <td>Employed In:</td>
                        <td>
                        <?php echo $row['EI'];?>
                        </td>
                    </tr><br><br>

                    <tr>
                        <td>Occupation:</td>
                        <td>
                        <?php echo $row['OCC'];?>
                        </td>
                    </tr>
                    <tr>
                        <td>Annual Income:</td>
                        <td>
                        <?php echo $row['AI'];?>
                        </td>
                    </tr><br><br>
                    <tr>
                        <td>Work Location:</td>
                        <td>
                        <?php echo $row['WL'];?>
                        </td>
                    </tr><br><br>

                </table>
            </div>
            <h1 class="heading pm">My Preferences</h1>
            <div class="workcontent">
                <table>
                    <tr>
                        <td>Preferable Partner's Age:</td>
                        <td>
                        <?php echo $row['Age'];?>
                        </td>
                    </tr><br><br>

                    <tr>
                        <td>Preferable Partner's Height:</td>
                        <td>
                        <?php echo $row['PHT'];?>
                        </td>
                    </tr>
                    <tr>
                        <td>Preferable Partner's Maritial Status:</td>
                        <td>
                        <?php echo $row['PMS'];?>
                        </td>
                    </tr><br><br>
                    <tr>
                        <td>Preferable Partner's Mother Tongue:</td>
                        <td>
                        <?php echo $row['PMT'];?>
                        </td>
                    </tr><br><br>
                    <tr>
                        <td>Preferable Partner's Physical Status:</td>
                        <td>
                        <?php echo $row['PPS'];?>
                        </td>
                    </tr><br><br>
                    <tr>
                        <td>Preferable Partner's Highest Education:</td>
                        <td>
                        <?php echo $row['PED'];?>
                        </td>
                    </tr><br><br>
                    <tr>
                        <td>Preferable Partner's Employed Section:</td>
                        <td>
                        <?php echo $row['PEI'];?>
                        </td>
                    </tr><br><br>
                    <tr>
                        <td>Preferable Partner's Occupation:</td>
                        <td>
                        <?php echo $row['POCC'];?>
                        </td>
                    </tr><br><br>
                    <tr>
                        <td>Preferable Partner's Annual Income:</td>
                        <td>
                        <?php echo $row['PAI'];?>
                        </td>
                    </tr><br><br>
                    <tr>
                        <td>Preferable Partner's Caste:</td>
                        <td>
                        <?php echo $row['PC'];?>
                        </td>
                    </tr><br><br>
                    <tr>
                        <td>Other Preferable Partner's Information:</td>
                        <td>
                        <?php echo $row['PEX'];?>
                        </td>
                    </tr><br><br>

                </table>
            </div>
        </section>

        <!-- <section class="about" id="about">

        </section>
        <section class="family" id="family">


        </section>
        <section class="education" id="education">

        </section>
        <section class="work" id="work">

        </section> -->
    </div>
</body>

</html>