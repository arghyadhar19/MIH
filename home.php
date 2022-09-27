<?php require_once "controllerUserData.php"; ?>
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
    <title><?php echo $fetch_info['name'] ?></title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
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
            background: #E4E9F7;
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
                <div class="profile-details">
                    <div class="name_job">
                        <div class="name"><?php echo $fetch_info['name'] ?></div>
                        <div class="job">USER</div>
                    </div>
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
                        <h2 class="text-center">20% Complete</h2>
                        <div class="form-group">
                            <input class="form-control" type="text" name="DOB" placeholder="Date Of Birth" value="<?php echo $DOB ?>">
                        </div>
                        <div class="form-group">
                            <div class="input-box">
                                <span class="details"></span>
                                <select name="R" id="profile">
                                    <option value="null" hidden>Religion</option>
                                    <option value="hindu">Hindu</option>
                                    <option value="muslim-all">Muslim-All</option>
                                    <option value="muslim-shia">Muslim-Shia</option>
                                    <option value="muslim-sunni">Muslim-Sunni</option>
                                    <option value="muslim-others">Muslim-Others</option>
                                    <option value="christian">Christian</option>
                                    <option value="sikh">Sikh</option>
                                    <option value="jain-digambar">Jain-Digambar</option>
                                    <option value="jain-shwetambar">Jain-Shwetambar</option>
                                    <option value="jain-others">Jain-Others</option>
                                    <option value="parsi">Parsi</option>
                                    <option value="buddhist">Buddhist</option>
                                    <option value="inter-religion">Inter-Religion</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-box">
                                <span class="details"></span>
                                <select name="MT" id="profile">
                                    <option value="0" hidden selected>Mother Tounge</option>
                                    <option value="Angika">Angika</option>
                                    <option value="Arunachali">Arunachali</option>
                                    <option value="Assamese">Assamese</option>
                                    <option value="Awadhi">Awadhi</option>
                                    <option value="Bagri Rajasthani">Bagri Rajasthani</option>
                                    <option value="Bhojpuri">Bhojpuri</option>
                                    <option value="Brij">Brij</option>
                                    <option value="Bihari">Bihari</option>
                                    <option value="Badaga">Badaga</option>
                                    <option value="Bengali">Bengali</option>
                                    <option value="Chatisgarhi">Chatisgarhi</option>
                                    <option value="Dogri">Dogri</option>
                                    <option value="Dhundhari/Jaipuri">Dhundhari/Jaipuri</option>
                                    <option value="English">English</option>
                                    <option value="French">French</option>
                                    <option value="Garhwali">Garhwali</option>
                                    <option value="Garo">Garo</option>
                                    <option value="Gujari/Gojari">Gujari/Gojari</option>
                                    <option value="Haryanvi">Haryanvi</option>
                                    <option value="Harauti">Harauti</option>
                                    <option value="Hindi">Hindi</option>
                                    <option value="Himachali/Pahari">Himachali/Pahari</option>
                                    <option value="Kanauji">Kanauji</option>
                                    <option value="Kashmiri">Kashmiri</option>
                                    <option value="Khandesi">Khandesi</option>
                                    <option value="Kannada">Kannada</option>
                                    <option value="Khasi">Khasi</option>
                                    <option value="Konkani">Konkani</option>
                                    <option value="Koshali">Koshali</option>
                                    <option value="Kumaoni">Kumaoni</option>
                                    <option value="Kutchi">Kutchi</option>
                                    <option value="Lepcha">Lepcha</option>
                                    <option value="Ladachi">Ladachi</option>
                                    <option value="Lambadi">Lambadi</option>
                                    <option value="Malvi">Malvi</option>
                                    <option value="Mewari">Mewari</option>
                                    <option value="Mewati/Ahirwati">Mewati/Ahirwati</option>
                                    <option value="Magahi">Magahi</option>
                                    <option value="Malayalam">Malayalam</option>
                                    <option value="Marathi">Marathi</option>
                                    <option value="Marwari">Marwari</option>
                                    <option value="Maithili">Maithili</option>
                                    <option value="Manipuri">Manipuri</option>
                                    <option value="Miji">Miji</option>
                                    <option value="Mizo">Mizo</option>
                                    <option value="Monpa">Monpa</option>
                                    <option value="Nicobarese">Nicobarese</option>
                                    <option value="Nimadi">Nimadi</option>
                                    <option value="Nepali">Nepali</option>
                                    <option value="Oriya">Oriya</option>
                                    <option value="Punjabi">Punjabi</option>
                                    <option value="Rajasthani">Rajasthani</option>
                                    <option value="Sanskrit">Sanskrit</option>
                                    <option value="Sindhi">Sindhi</option>
                                    <option value="Santhali">Santhali</option>
                                    <option value="Shekhawati">Shekhawati</option>
                                    <option value="Sourashtra">Sourashtra</option>
                                    <option value="Tamil">Tamil</option>
                                    <option value="Telegu">Telegu</option>
                                    <option value="Tripuri">Tripuri</option>
                                    <option value="Tulu">Tulu</option>
                                    <option value="Urdu">Urdu</option>
                                    <option value="Wagdi">Wagdi</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-box">
                                <span class="details"></span>
                                <select name="C" id="caste">
                                    <option value="0" hidden selected>CASTE</option>
                                    <option value="Agarwal">Agarwal</option>
                                    <option value="Aguri/Ugra Kshatriya">Aguri/Ugra Kshatriya</option>
                                    <option value="Ahirwar">Ahirwar</option>
                                    <option value="Baidya">Baidya</option>
                                    <option value="Bairwa">Bairwa</option>
                                    <option value="Baishnab">Baishnab</option>
                                    <option value="Balai">Balai</option>
                                    <option value="Banik">Banik</option>
                                    <option value="Barujibi">Barujibi</option>
                                    <option value="Brahmin-Anaviln Desai">Brahmin-Anaviln Desai</option>
                                    <option value="Brahmin-Baidhiki/Vaidhiki">Brahmin-Baidhiki/Vaidhiki</option>
                                    <option value="Brahmin-Bardai">Brahmin-Bardai</option>
                                    <option value="Brahmin-Barendra">Brahmin-Barendra</option>
                                    <option value="Brahmin-Bhargav">Brahmin-Bhargav</option>
                                    <option value="Brahmin-Khadayata">Brahmin-Khadayata</option>
                                    <option value="Bramin-Khedaval">Bramin-Khedaval</option>
                                    <option value="Brahmin-Kulin">Brahmin-Kulin</option>
                                    <option value="Brahmin-Mevada">Brahmin-Mevada</option>
                                    <option value="Brahmin-Others">Brahmin-Others</option>
                                    <option value="Brahmin-Rajgor">Brahmin-Rajgor</option>
                                    <option value="Brahmin-Rarhi">Brahmin-Rarhi</option>
                                    <option value="Brahmin-Rarhi/Radhi">Brahmin-Rarhi/Radhi</option>
                                    <option value="Brahmin-Rudraj">Brahmin-Rudraj</option>
                                    <option value="Brahmin-Sarua">Brahmin-Sarua</option>
                                    <option value="Bramin-Shri Gaud">Bramin-Shri Gaud</option>
                                    <option value="Brahmin-Tapodhan">Brahmin-Tapodhan</option>
                                    <option value="Brahmin-Valam">Brahmin-Valam</option>
                                    <option value="Brahmin-Zalora">Brahmin-Zalora</option>
                                    <option value="Dhanak">Dhanak</option>
                                    <option value="Goala">Goala</option>
                                    <option value="Gond">Gond</option>
                                    <option value="Haihaivanshi">Haihaivanshi</option>
                                    <option value="Intercaste">Intercaste</option>
                                    <option value="Julaha">Julaha</option>
                                    <option value="Kanakkan Padanna">Kanakkan Padanna</option>
                                    <option value="Kandara">Kandara</option>
                                    <option value="Karmakar">Karmakar</option>
                                    <option value="Kayastha (Bengali)">Kayastha (Bengali)</option>
                                    <option value="Khatik">Khatik</option>
                                    <option value="Kori/Koli">Kori/Koli</option>
                                    <option value="Kshatriya">Kshatriya</option>
                                    <option value="Kshatriya Kurmi">Kshatriya Kurmi</option>
                                    <option value="Kshatriya Raju">Kshatriya Raju</option>
                                    <option value="Kumaoni Rajput">Kumaoni Rajput</option>
                                    <option value="Kumbhakar">Kumbhakar</option>
                                    <option value="Kurmi">Kurmi</option>
                                    <option value="Kuruva">Kuruva</option>
                                    <option value="Mahishya">Mahishya</option>
                                    <option value="Mair Rajput Swarnkar">Mair Rajput Swarnkar</option>
                                    <option value="Mannan/Velan/Vannan">Mannan/Velan/Vannan</option>
                                    <option value="Meghwal">Meghwal</option>
                                    <option value="Modak">Modak</option>
                                    <option value="Namasudra/Namassej">Namasudra/Namassej</option>
                                    <option value="Napit">Napit</option>
                                    <option value="Pallan/Devandra Kula Vellanlan">Pallan/Devandra Kula Vellanlan</option>
                                    <option value="Panan">Panan</option>
                                    <option value="Paravan/Bharatar">Paravan/Bharatar</option>
                                    <option value="Paswan/Dusadh">Paswan/Dusadh</option>
                                    <option value="Perika/Puragiri Kshatriya">Perika/Puragiri Kshatriya</option>
                                    <option value="Poddar">Poddar</option>
                                    <option value="Poundra">Poundra</option>
                                    <option value="Pulaya/Cheruman">Pulaya/Cheruman</option>
                                    <option value="Rajput">Rajput</option>
                                    <option value="Rohit/Chamar">Rohit/Chamar</option>
                                    <option value="SC">SC</option>
                                    <option value="ST">ST</option>
                                    <option value="Sadgope">Sadgope</option>
                                    <option value="Saha">Saha</option>
                                    <option value="Samagar">Samagar</option>
                                    <option value="Sambava">Sambava</option>
                                    <option value="Satnami">Satnami</option>
                                    <option value="Shilpkar">Shilpkar</option>
                                    <option value="Sonkar">Sonkar</option>
                                    <option value="Swarnakar">Swarnakar</option>
                                    <option value="Tamboli">Tamboli</option>
                                    <option value="Tantubai">Tantubai</option>
                                    <option value="Thandan">Thandan</option>
                                    <option value="Thogata Veera Kshatriya">Thogata Veera Kshatriya</option>
                                    <option value="Tili">Tili</option>
                                    <option value="Vishwakarma">Vishwakarma</option>
                                    <option value="Don't wish to specify">Don't wish to specify</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-box">
                                <span class="details"></span>
                                <select name="WTM" id="profile">
                                    <option value="0" hidden>Wiling to Marry From different caste?</option>
                                    <option value="YES">YES</option>
                                    <option value="NO">NO</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <input class="form-control" type="text" name="SC" placeholder="SUB-CASTE" required value="<?php echo $SC ?>">
                        </div>
                        <div class="form-group">
                            <div class="input-box">
                                <span class="details"></span>
                                <select name="DOSH" id="DOSH">
                                    <option value="0" hidden>DOSH</option>
                                    <option value="YES">YES</option>
                                    <option value="NO">NO</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <input class="form-control button" type="submit" name="Next" value="Next">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <script src="script.js"></script>

</body>

</html>