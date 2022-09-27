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
	<!-- <link rel="stylesheet" href="style.css"> -->
	<link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<style>
		@import url('https://fonts.googleapis.com/css?family=Algerian:400,500,600,700&display=swap');

		@import url('https://fonts.googleapis.com/css?family=Poppins:400,500,600,700&display=swap');
		@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap');

		html,
		body {
			background: #E4E9F7;
			font-family: 'Poppins', sans-serif;
		}

		::selection {
			color: #E4E9F7;
			background: #E4E9F7;
		}

		.form-group .input-box input {
			height: 45px;
			width: 100%;
			outline: none;
			font-size: 16px;
			border-radius: 5px;
			padding-left: 15px;
			border: 1px solid #ccc;
			border-bottom-width: 2px;
			transition: all 0.3s ease;
		}

		.form-group .input-box select {
			height: 43px;
			width: 223%;
			outline: none;
			font-size: 16px;
			background: #fff;
			color: rgb(150, 146, 146);
			border-radius: 5px;
			padding-left: 15px;
			border: 1px solid #ccc;
			border-bottom-width: 2px;
			transition: all 0.3s ease;
		}

		form .form-group .input-box {
			margin-bottom: 15px;
			width: calc(100% / 2 - 20px);
		}

		form .form-group span.details {
			display: block;
			font-weight: 500;
			margin-bottom: 5px;
		}

		.container {
			max-width: 10000px;
			position: absolute;
			top: 60%;
			margin-bottom: 200px;
			left: 50%;
			transform: translate(-50%, -50%);
		}

		.container .form {
			background: rgb(167, 167, 233);
			padding: 30px 35px;
			border-radius: 5px;
			box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
		}

		.container .form form .form-control {
			height: 40spx;
			font-size: 15px;
		}

		.container .form form .forget-pass {
			margin: -15px 0 15px 0;
		}

		.container .form form .forget-pass a {
			font-size: 15px;
		}

		.container .form form .button {
			background: #6665ee;
			color: #fff;
			font-size: 17px;
			font-weight: 50;
			transition: all 0.3s ease;
		}

		.container .form form .button:hover {
			background: #5757d1;
		}

		.container .form form .link {
			padding: 5px 0;
		}

		.container .form form .link a {
			color: #6665ee;
		}

		.container .login-form form p {
			font-size: 14px;
		}

		.container .row .alert {
			font-size: 14px;
		}

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
				<a href="">
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
						<h2 class="text-center">Partner Preference</h2>
						<div class="form-group">
							<input class="form-control" type="text" name="Age" placeholder="Preferred Age" required value="<?php echo $Age ?>">
						</div>
						<div class="form-group">
							<div class="input-box">
								<span class="details"></span>
								<select name="PHT" id="profile">
									<option value="none" hidden>Preferred Height</option>
									<option value="4ft">4ft</option>
									<option value="4ft 1inch">4ft 1inch</option>
									<option value="4ft 2inch">4ft 2inch</option>
									<option value="4ft 3inch">4ft 3inch</option>
									<option value="4ft 4inch">4ft 4inch</option>
									<option value="4ft 5inch">4ft 5inch</option>
									<option value="4ft 6inch">4ft 6inch</option>
									<option value="4ft 7inch">4ft 7inch</option>
									<option value="4ft 8inch">4ft 8inch</option>
									<option value="4ft 9inch">4ft 9inch</option>
									<option value="4ft 10inch">4ft 10inch</option>
									<option value="4ft 11inch">4ft 11inch</option>
									<option value="4ft 12inch">4ft 12inch</option>
									<option value="5ft">5ft </option>
									<option value="5ft 1inch">5ft 1inch</option>
									<option value="5ft 2inch">5ft 2inch</option>
									<option value="5ft 3inch">5ft 3inch</option>
									<option value="5ft 4inch">5ft 4inch</option>
									<option value="5ft 5inch">5ft 5inch</option>
									<option value="5ft 6inch">5ft 6inch</option>
									<option value="5ft 7inch">5ft 7inch</option>
									<option value="5ft 8inch">5ft 8inch</option>
									<option value="5ft 9inch">5ft 9inch</option>
									<option value="5ft 10inch">5ft 10inch</option>
									<option value="5ft 11inch">5ft 11inch</option>
									<option value="5ft 12inch">5ft 12inch</option>
									<option value="6ft ">6ft </option>
									<option value="6ft 1inch">6ft 1inch</option>
									<option value="6ft 2inch">6ft 2inch</option>
									<option value="6ft 3inch">6ft 3inch</option>
									<option value="6ft 4inch">6ft 4inch</option>
									<option value="6ft 5inch">6ft 5inch</option>
									<option value="6ft 6inch">6ft 6inch</option>
									<option value="6ft 7inch">6ft 7inch</option>
									<option value="6ft 8inch">6ft 8inch</option>
									<option value="6ft 9inch">6ft 9inch</option>
									<option value="6ft 10inch">6ft 10inch</option>
									<option value="6ft 11inch">6ft 11inch</option>
									<option value="6ft 12inch">6ft 12inch</option>
									<option value="7ft">7ft</option>
								</select>
							</div>
						</div>
						<div class="form-group">
							<div class="input-box">
								<span class="details"></span>
								<select name="PMS" id="Partner's Marital status">
									<option value="None" hidden>Prefered Marital Status</option>
									<option value="Single">Single</option>
									<option value="Married">Married</option>
									<option value="Divorced">Divorced</option>
									<option value="Widow">Widow</option>
									<option value="A.Divorce">Awating Divorce</option>
								</select>
							</div>
						</div>
						<div class="form-group">
							<div class="input-box">
								<span class="details"></span>
								<select name="PMT" id="profile">
									<option value="None" hidden>Prefered Mother Tounge</option>
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
								<select name="PPS" id="Partner's Physical status">
									<option value="None" hidden>Prefered Physical Status</option>
									<option value="Slim">Slim</option>
									<option value="Pear">Pear</option>
									<option value="Fit">Fit</option>
									<option value="Healthy">Healthy</option>
									<option value="crisp">crisp</option>
								</select>
							</div>
						</div>
						<div class="form-group">
							<div class="input-box">
								<span class="details"></span>
								<select name="PED" id="Prefered Highest Education">
									<option value="0" hidden>Prefered Education Qualification</option>
									<option value="BTECH">B.TECH</option>
									<option value="BCA">BACHELORS IN COMPUTER APPLICATIONS</option>
									<option value="LAW">LLB</option>
									<option value="DOCTOR">MBBS</option>
								</select>
							</div>
						</div>
						<div class="form-group">
							<div class="input-box">
								<span class="details"></span>
								<select name="POCC" id="Partner's Occupation">
									<option value="0" hidden>Prefered Job Title</option>
									<option value="MANAGER">GENERAL MANAGER</option>
									<option value="hr">HUMAN RESOURCE </option>
									<option value="DOCTOR">DOCTOR</option>
									<option value="BUSSINESS">CEO</option>
									<option value="SCHOOL">HEADMASTER</option>
								</select>
							</div>
						</div>
						<div class="form-group">
							<div class="input-box">
								<span class="details"></span>
								<select name="PAI" id="Annual Income">
									<option value="0" hidden>Prefered Annual Income (Rupees)</option>
									<option value="<100000">Below 1 lakh</option>
									<option value=">100000">Above 1 lakh</option>
									<option value=">500000">Above 5 lakh</option>
									<option value=">1000000">Above 10 lakh</option>
								</select>
							</div>
						</div>
						<div class="form-group">
							<div class="input-box">
								<span class="details"></span>
								<select name="PC" id="Partner's Work Location">
									<option value="0" hidden>Prefered Work Location(Country)</option>
									<option value="Afganistan">Afghanistan</option>
									<option value="Albania">Albania</option>
									<option value="Algeria">Algeria</option>
									<option value="American Samoa">American Samoa</option>
									<option value="Andorra">Andorra</option>
									<option value="Angola">Angola</option>
									<option value="Anguilla">Anguilla</option>
									<option value="Antigua & Barbuda">Antigua & Barbuda</option>
									<option value="Argentina">Argentina</option>
									<option value="Armenia">Armenia</option>
									<option value="Aruba">Aruba</option>
									<option value="Australia">Australia</option>
									<option value="Austria">Austria</option>
									<option value="Azerbaijan">Azerbaijan</option>
									<option value="Bahamas">Bahamas</option>
									<option value="Bahrain">Bahrain</option>
									<option value="Bangladesh">Bangladesh</option>
									<option value="Barbados">Barbados</option>
									<option value="Belarus">Belarus</option>
									<option value="Belgium">Belgium</option>
									<option value="Belize">Belize</option>
									<option value="Benin">Benin</option>
									<option value="Bermuda">Bermuda</option>
									<option value="Bhutan">Bhutan</option>
									<option value="Bolivia">Bolivia</option>
									<option value="Bonaire">Bonaire</option>
									<option value="Bosnia & Herzegovina">Bosnia & Herzegovina</option>
									<option value="Botswana">Botswana</option>
									<option value="Brazil">Brazil</option>
									<option value="British Indian Ocean Ter">British Indian Ocean Ter</option>
									<option value="Brunei">Brunei</option>
									<option value="Bulgaria">Bulgaria</option>
									<option value="Burkina Faso">Burkina Faso</option>
									<option value="Burundi">Burundi</option>
									<option value="Cambodia">Cambodia</option>
									<option value="Cameroon">Cameroon</option>
									<option value="Canada">Canada</option>
									<option value="Canary Islands">Canary Islands</option>
									<option value="Cape Verde">Cape Verde</option>
									<option value="Cayman Islands">Cayman Islands</option>
									<option value="Central African Republic">Central African Republic</option>
									<option value="Chad">Chad</option>
									<option value="Channel Islands">Channel Islands</option>
									<option value="Chile">Chile</option>
									<option value="China">China</option>
									<option value="Christmas Island">Christmas Island</option>
									<option value="Cocos Island">Cocos Island</option>
									<option value="Colombia">Colombia</option>
									<option value="Comoros">Comoros</option>
									<option value="Congo">Congo</option>
									<option value="Cook Islands">Cook Islands</option>
									<option value="Costa Rica">Costa Rica</option>
									<option value="Cote DIvoire">Cote DIvoire</option>
									<option value="Croatia">Croatia</option>
									<option value="Cuba">Cuba</option>
									<option value="Curaco">Curacao</option>
									<option value="Cyprus">Cyprus</option>
									<option value="Czech Republic">Czech Republic</option>
									<option value="Denmark">Denmark</option>
									<option value="Djibouti">Djibouti</option>
									<option value="Dominica">Dominica</option>
									<option value="Dominican Republic">Dominican Republic</option>
									<option value="East Timor">East Timor</option>
									<option value="Ecuador">Ecuador</option>
									<option value="Egypt">Egypt</option>
									<option value="El Salvador">El Salvador</option>
									<option value="Equatorial Guinea">Equatorial Guinea</option>
									<option value="Eritrea">Eritrea</option>
									<option value="Estonia">Estonia</option>
									<option value="Ethiopia">Ethiopia</option>
									<option value="Falkland Islands">Falkland Islands</option>
									<option value="Faroe Islands">Faroe Islands</option>
									<option value="Fiji">Fiji</option>
									<option value="Finland">Finland</option>
									<option value="France">France</option>
									<option value="French Guiana">French Guiana</option>
									<option value="French Polynesia">French Polynesia</option>
									<option value="French Southern Ter">French Southern Ter</option>
									<option value="Gabon">Gabon</option>
									<option value="Gambia">Gambia</option>
									<option value="Georgia">Georgia</option>
									<option value="Germany">Germany</option>
									<option value="Ghana">Ghana</option>
									<option value="Gibraltar">Gibraltar</option>
									<option value="Great Britain">Great Britain</option>
									<option value="Greece">Greece</option>
									<option value="Greenland">Greenland</option>
									<option value="Grenada">Grenada</option>
									<option value="Guadeloupe">Guadeloupe</option>
									<option value="Guam">Guam</option>
									<option value="Guatemala">Guatemala</option>
									<option value="Guinea">Guinea</option>
									<option value="Guyana">Guyana</option>
									<option value="Haiti">Haiti</option>
									<option value="Hawaii">Hawaii</option>
									<option value="Honduras">Honduras</option>
									<option value="Hong Kong">Hong Kong</option>
									<option value="Hungary">Hungary</option>
									<option value="Iceland">Iceland</option>
									<option value="Indonesia">Indonesia</option>
									<option value="India">India</option>
									<option value="Iran">Iran</option>
									<option value="Iraq">Iraq</option>
									<option value="Ireland">Ireland</option>
									<option value="Isle of Man">Isle of Man</option>
									<option value="Israel">Israel</option>
									<option value="Italy">Italy</option>
									<option value="Jamaica">Jamaica</option>
									<option value="Japan">Japan</option>
									<option value="Jordan">Jordan</option>
									<option value="Kazakhstan">Kazakhstan</option>
									<option value="Kenya">Kenya</option>
									<option value="Kiribati">Kiribati</option>
									<option value="Korea North">Korea North</option>
									<option value="Korea Sout">Korea South</option>
									<option value="Kuwait">Kuwait</option>
									<option value="Kyrgyzstan">Kyrgyzstan</option>
									<option value="Laos">Laos</option>
									<option value="Latvia">Latvia</option>
									<option value="Lebanon">Lebanon</option>
									<option value="Lesotho">Lesotho</option>
									<option value="Liberia">Liberia</option>
									<option value="Libya">Libya</option>
									<option value="Liechtenstein">Liechtenstein</option>
									<option value="Lithuania">Lithuania</option>
									<option value="Luxembourg">Luxembourg</option>
									<option value="Macau">Macau</option>
									<option value="Macedonia">Macedonia</option>
									<option value="Madagascar">Madagascar</option>
									<option value="Malaysia">Malaysia</option>
									<option value="Malawi">Malawi</option>
									<option value="Maldives">Maldives</option>
									<option value="Mali">Mali</option>
									<option value="Malta">Malta</option>
									<option value="Marshall Islands">Marshall Islands</option>
									<option value="Martinique">Martinique</option>
									<option value="Mauritania">Mauritania</option>
									<option value="Mauritius">Mauritius</option>
									<option value="Mayotte">Mayotte</option>
									<option value="Mexico">Mexico</option>
									<option value="Midway Islands">Midway Islands</option>
									<option value="Moldova">Moldova</option>
									<option value="Monaco">Monaco</option>
									<option value="Mongolia">Mongolia</option>
									<option value="Montserrat">Montserrat</option>
									<option value="Morocco">Morocco</option>
									<option value="Mozambique">Mozambique</option>
									<option value="Myanmar">Myanmar</option>
									<option value="Nambia">Nambia</option>
									<option value="Nauru">Nauru</option>
									<option value="Nepal">Nepal</option>
									<option value="Netherland Antilles">Netherland Antilles</option>
									<option value="Netherlands">Netherlands (Holland, Europe)</option>
									<option value="Nevis">Nevis</option>
									<option value="New Caledonia">New Caledonia</option>
									<option value="New Zealand">New Zealand</option>
									<option value="Nicaragua">Nicaragua</option>
									<option value="Niger">Niger</option>
									<option value="Nigeria">Nigeria</option>
									<option value="Niue">Niue</option>
									<option value="Norfolk Island">Norfolk Island</option>
									<option value="Norway">Norway</option>
									<option value="Oman">Oman</option>
									<option value="Pakistan">Pakistan</option>
									<option value="Palau Island">Palau Island</option>
									<option value="Palestine">Palestine</option>
									<option value="Panama">Panama</option>
									<option value="Papua New Guinea">Papua New Guinea</option>
									<option value="Paraguay">Paraguay</option>
									<option value="Peru">Peru</option>
									<option value="Phillipines">Philippines</option>
									<option value="Pitcairn Island">Pitcairn Island</option>
									<option value="Poland">Poland</option>
									<option value="Portugal">Portugal</option>
									<option value="Puerto Rico">Puerto Rico</option>
									<option value="Qatar">Qatar</option>
									<option value="Republic of Montenegro">Republic of Montenegro</option>
									<option value="Republic of Serbia">Republic of Serbia</option>
									<option value="Reunion">Reunion</option>
									<option value="Romania">Romania</option>
									<option value="Russia">Russia</option>
									<option value="Rwanda">Rwanda</option>
									<option value="St Barthelemy">St Barthelemy</option>
									<option value="St Eustatius">St Eustatius</option>
									<option value="St Helena">St Helena</option>
									<option value="St Kitts-Nevis">St Kitts-Nevis</option>
									<option value="St Lucia">St Lucia</option>
									<option value="St Maarten">St Maarten</option>
									<option value="St Pierre & Miquelon">St Pierre & Miquelon</option>
									<option value="St Vincent & Grenadines">St Vincent & Grenadines</option>
									<option value="Saipan">Saipan</option>
									<option value="Samoa">Samoa</option>
									<option value="Samoa American">Samoa American</option>
									<option value="San Marino">San Marino</option>
									<option value="Sao Tome & Principe">Sao Tome & Principe</option>
									<option value="Saudi Arabia">Saudi Arabia</option>
									<option value="Senegal">Senegal</option>
									<option value="Seychelles">Seychelles</option>
									<option value="Sierra Leone">Sierra Leone</option>
									<option value="Singapore">Singapore</option>
									<option value="Slovakia">Slovakia</option>
									<option value="Slovenia">Slovenia</option>
									<option value="Solomon Islands">Solomon Islands</option>
									<option value="Somalia">Somalia</option>
									<option value="South Africa">South Africa</option>
									<option value="Spain">Spain</option>
									<option value="Sri Lanka">Sri Lanka</option>
									<option value="Sudan">Sudan</option>
									<option value="Suriname">Suriname</option>
									<option value="Swaziland">Swaziland</option>
									<option value="Sweden">Sweden</option>
									<option value="Switzerland">Switzerland</option>
									<option value="Syria">Syria</option>
									<option value="Tahiti">Tahiti</option>
									<option value="Taiwan">Taiwan</option>
									<option value="Tajikistan">Tajikistan</option>
									<option value="Tanzania">Tanzania</option>
									<option value="Thailand">Thailand</option>
									<option value="Togo">Togo</option>
									<option value="Tokelau">Tokelau</option>
									<option value="Tonga">Tonga</option>
									<option value="Trinidad & Tobago">Trinidad & Tobago</option>
									<option value="Tunisia">Tunisia</option>
									<option value="Turkey">Turkey</option>
									<option value="Turkmenistan">Turkmenistan</option>
									<option value="Turks & Caicos Is">Turks & Caicos Is</option>
									<option value="Tuvalu">Tuvalu</option>
									<option value="Uganda">Uganda</option>
									<option value="United Kingdom">United Kingdom</option>
									<option value="Ukraine">Ukraine</option>
									<option value="United Arab Erimates">United Arab Emirates</option>
									<option value="United States of America">United States of America</option>
									<option value="Uraguay">Uruguay</option>
									<option value="Uzbekistan">Uzbekistan</option>
									<option value="Vanuatu">Vanuatu</option>
									<option value="Vatican City State">Vatican City State</option>
									<option value="Venezuela">Venezuela</option>
									<option value="Vietnam">Vietnam</option>
									<option value="Virgin Islands (Brit)">Virgin Islands (Brit)</option>
									<option value="Virgin Islands (USA)">Virgin Islands (USA)</option>
									<option value="Wake Island">Wake Island</option>
									<option value="Wallis & Futana Is">Wallis & Futana Is</option>
									<option value="Yemen">Yemen</option>
									<option value="Zaire">Zaire</option>
									<option value="Zambia">Zambia</option>
									<option value="Zimbabwe">Zimbabwe</option>
								</select>
							</div>
						</div>
						<label for="about"></label>
						<textarea name="PEX" id="PEX" cols="21" rows="1" placeholder="Any other Information"></textarea><br><br>
						<div class="form-group">
							<input class="form-control button" type="submit" name="continue3" value="continue">
						</div>
					</form>
				</div>
			</div>
		</div>
	</section>

	<script src="script.js"></script>

</body>

</html>