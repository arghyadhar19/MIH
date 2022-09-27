<?php require_once "controllerUserData.php"; ?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<title>Signup Form</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	<link rel="stylesheet" href="style.css">
	<style>
		@import url('https://fonts.googleapis.com/css?family=Algerian:400,500,600,700&display=swap');

		nav {
			padding-left: 100px !important;
			padding-right: 100px !important;
			background: black;
			font-family: 'Algerian', sans-serif;
		}

		nav a.navbar-brand {
			color: #fff;
			font-size: 30px !important;
			font-weight: 500;
		}

		button a {
			color: #6665ee;
			font-weight: 500;
		}

		button a:hover {
			text-decoration: none;
		}

		h1 {
			position: absolute;
			top: 50%;
			left: 50%;
			width: 100%;
			text-align: center;
			transform: translate(-50%, -50%);
			font-size: 50px;
			font-weight: 600;
		}
	</style>
</head>

<body>
	<header>
		<nav class="navbar">
			<a class="navbar-brand" href="#">MIH MATRIMONY</a>
			<button type="button" class="btn btn-light"><a href="logout-user.php">Logout</a></button>
		</nav>
	</header>
	<div class="container">
		<div class="row">
			<div class="col-md-4 offset-md-4 form">
				<form action="PAGE8reg.PHP" method="POST" autocomplete="">
					<h2 class="text-center">Wedding Planner's Signup Form</h2>
					<?php
					if (count($errors) == 1) {
					?>
						<div class="alert alert-danger text-center">
							<?php
							foreach ($errors as $showerror) {
								echo $showerror;
							}
							?>
						</div>
					<?php
					} elseif (count($errors) > 1) {
					?>
						<div class="alert alert-danger">
							<?php
							foreach ($errors as $showerror) {
							?>
								<li><?php echo $showerror; ?></li>
							<?php
							}
							?>
						</div>
					<?php
					}
					?>
					<div class="form-group">
						<input class="form-control" type="text" name="CN" placeholder="Company Name" required value="<?php echo $CN ?>">
					</div>
					<div class="form-group">
						<input class="form-control" type="text" name="OWN" placeholder="Owner's Name" required value="<?php echo $OWN ?>">
					</div>
					<div class="form-group">
						<input class="form-control" type="email" name="OEI" placeholder="Official EMAIL-id" required value="<?php echo $OEI ?>">
					</div>
					<div class="form-group">
						<input class="form-control" type="number" name="OPH" placeholder="Official Phone Number" required value="<?php echo $OPH ?>">
					</div>
					<div class="form-group">
						<input class="form-control" type="password" name="password" placeholder="Password" required>
					</div>
					<div class="form-group">
						<input class="form-control" type="password" name="cpassword" placeholder="Confirm Password" required>
					</div>
					<div class="form-group">
						<input class="form-control button" type="submit" name="signup1" value="Signup">
					</div>
					<div class="link login-link text-center">Already a member? <a href="page9.php">Login here</a></div>
				</form>
			</div>
		</div>
	</div>

</body>

</html>