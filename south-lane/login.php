<!DOCTYPE html>
<html lang="en">
<?php
	session_start();
	if(isset($_SESSION["user_id"])){
		header("Location: ./index.php");
	}
?>	
<head>
	<title>Login</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->
	<link rel="icon" type="image/png" href="./assets/images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="./assets/vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="./assets/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="./assets/fonts/iconic/css/material-design-iconic-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="./assets/vendor/animate/animate.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="./assets/vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="./assets/vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="./assets/vendor/select2/select2.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="./assets/vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="./assets/css/util.css">
	<link rel="stylesheet" type="text/css" href="./assets/css/main.css">
<!--===============================================================================================-->
</head>
<body style="background: url(./assets/images/login-bg.jpg) center;">

	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<form  class="login100-form validate-form" action="./api/users/verify-login.php" method="post">
					<span class="login100-form-title p-b-26">
						Sign In
					</span>
					<span class="login100-form-title p-b-48">
						<img src="./assets/images/logo.jpg" alt="logo" style="max-height:100px;">
					</span>

					<div class="wrap-input100 validate-input" data-validate = "Valid email is: a@b.c">
						<input class="input100" type="text" name="email">
						<span class="focus-input100" data-placeholder="Email"></span>
					</div>

					<div class="wrap-input100 validate-input" data-validate="Enter password">
						<span class="btn-show-pass">
							<i class="zmdi zmdi-eye"></i>
						</span>
						<input class="input100" type="password" name="password">
						<span class="focus-input100" data-placeholder="Password"></span>
					</div>

					<div class="container-login100-form-btn">
						<div class="wrap-login100-form-btn">
							<div class="login100-form-bgbtn"></div>
							<button class="login100-form-btn">
								Login
							</button>
						</div>
					</div>

					<!--<div class="text-center p-t-20">-->
					<!--	<span class="txt1">-->
					<!--		Don’t have an account?-->
					<!--	</span>-->
					<!--	<a class="txt2" href="./register.php">-->
					<!--		Register-->
					<!--	</a>-->
					<!--</div>-->
				</form>
			</div>
		</div>
	</div>
	<div id="dropDownSelect1"></div>

<!--===============================================================================================-->
	<script src="./assets/vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="./assets/vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
	<script src="./assets/vendor/bootstrap/js/popper.js"></script>
	<script src="./assets/vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="./assets/vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="./assets/vendor/daterangepicker/moment.min.js"></script>
	<script src="./assets/vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
	<script src="./assets/vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
	<script src="./assets/js/main.js"></script>
	<script src="./assets/sweetalert/sweetalert2@11.js"></script>
	<?php if(isset($_SESSION['register_error'])){?>
	<script>
			Swal.fire({
			position: 'top-end',
			icon: 'success',
			title: '<?=$_SESSION['register_error']?>',
			showConfirmButton: false,
			timer: 1500
		})
	</script>
	<?php }?>

	<?php if(isset($_SESSION['login_error'])){?>
	<script>
		Swal.fire({
			icon: 'error',
			title: 'Oops...',
			text: '<?=$_SESSION['login_error']?>',
			footer: '<a href="">Why do I have this issue?</a>'
		})
	</script>
	<?php }?>
</body>
</html>