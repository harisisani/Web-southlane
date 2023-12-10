<?php 
include './header.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Receipt</title>
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
<body>
<style>
    .wrap-login100 {
        background:transparent !important;
        width: 70%;
        margin: 0 auto;
        border-radius: 10px;
        overflow: hidden;
        padding: 20px 55px 33px 55px;
        box-shadow: 0 5px 10px 0px rgb(0 0 0 / 10%);
        -moz-box-shadow: 0 5px 10px 0px rgba(0, 0, 0, 0.1);
        -webkit-box-shadow: 0 5px 10px 0px rgb(0 0 0 / 10%);
        -o-box-shadow: 0 5px 10px 0px rgba(0, 0, 0, 0.1);
        -ms-box-shadow: 0 5px 10px 0px rgba(0, 0, 0, 0.1);

    }

    .container-login100-new {
        width: 100%;
        min-height: 100vh;
        flex-wrap: wrap;
        justify-content: center;
        align-items: center;
        padding: 15px;
        margin-top:25px;
    }

    .container-login100-form-btn{
        width:50%;
        float:right;
    }
	@media only screen and (min-width: 600px) {
		.desktop-grid{
			width: 50%;
			float:left;
		}
		.wrap-input100{
			float:left;
		}
		.container-login100-form-btn{
			width:25%;
			float:right;
		}
	}

    .nav-tabs .nav-item.show .nav-link, .nav-tabs .nav-link.active {
        font-weight: bold !important;
        color: #F60017 !important;
    }
</style>
<script>

	var mrNumber=0;
	function createPatientBill(){
		if($('input[name="patientname"]').val()=="" || $('input[name="ownername"]').val()=="" || $('input[name="contact"]').val()==""){
		Swal.fire({
			icon: 'error',
			title: 'Oops...',
			text: 'Fill out the required fields (*)',
			footer: '<a href="">Why do I have this issue?</a>'
		});
		}else{
			var settings = {
						"url": "./api/patients/create.php",
						"method": "POST",
						"timeout": 0,
						"headers": {
							"Content-Type": "application/json",
						},
						"data": JSON.stringify({
							"patientname": $('input[name="patientname"]').val(),
							"ownername":  $('input[name="ownername"]').val(),
							"contact":  $('input[name="contact"]').val(),
							"email":  $('input[name="email"]').val(),
							"address":  $('input[name="address"]').val(),
							"notes":  $('input[name="notes"]').val(),
						}),
						};

					$.ajax(settings).done(function (response) {
						var responseArray=response.split("^");
						if(responseArray[0].includes("success")){
							// console.log(response);
							$('input').each( function (){
								$(this).val("");
							});
							mrNumber=responseArray[1];
							Swal.fire(
								'Good job',
								'New Patient Addded with M.R. Number: '+mrNumber,
								'success'
							)
						}
					});	
				
		}
	}



</script>
        
<div style="margin-top: 200px;" class="container htmlContent">
	<div class="row">
		<div class="col">
			<div class="section_title_container text-center">
				<h2 class="section_title">Create a New Patient</h2>
				<p>Field with * are required</p>
			</div>
		</div>
		
	</div>
</div>

<div class="limiter htmlContent">
		<div class="container-login100-new">
            <div class="wrap-login100">
				<div class="tab-content" id="nav-tabContent">
					<div class="tab-pane active  show" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">						
						<div class="login100-form validate-form">
							<div class="wrap-input100 desktop-grid">
								<input class="input100" type="text" name="ownername">
								<span class="focus-input100" data-placeholder="Owner's Name*"></span>
							</div>
							<div class="wrap-input100 desktop-grid">
								<input class="input100" type="text" name="patientname">
								<span class="focus-input100" data-placeholder="Patient Name*"></span>
							</div>
							<div class="wrap-input100 desktop-grid">
								<input class="input100" type="text" name="contact">
								<span class="focus-input100" data-placeholder="Owner's Contact*"></span>
							</div>
							<div class="wrap-input100 desktop-grid">
								<input class="input100" type="text" name="email">
								<span class="focus-input100" data-placeholder="Owner's Email(optional)"></span>
							</div>
							<div class="wrap-input100">
								<input class="input100" type="text" name="address">
								<span class="focus-input100" data-placeholder="Owner's Address(optional)"></span>
							</div>
							<div class="wrap-input100">
								<input class="input100" type="text" name="notes">
								<span class="focus-input100" data-placeholder="Notes(optional)"></span>
							</div>
							<div class="container-login100-form-btn">
								<div class="wrap-login100-form-btn">
									<div class="login100-form-bgbtn"></div>
									<but class="login100-form-btn" onclick="createPatientBill()">
										SUBMIT <i class="fa fa-arrow-right" aria-hidden="true"></i>
									</but>
								</div>
							</div>
						</div>
					</div>
					
					</div> 
			</div>
		</div>
	</div>
</div>
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
</body>
</html>
<?php include './footer.php';?>
<style>
    .dataTables_filter input{
        border-radius: 5px;
        border: 1px solid grey;
        height: 30px;
    }

	@media print { 

	.ticket {
		/* width: 155px; */
		max-width: 95%;
		width:90%;
		margin-left:10px;
		margin: 0 auto;
	}

	img {
		max-width: inherit;
		width: inherit;
	}


	* {
		font-size: 12px;
	}

	/* All your print styles go here */
		.htmlContent,.header,.footer { display: none !important; } 
		.printCSS{ display:block !important;margin:0 auto;padding:5px; }
	}
	@page { size: auto;  margin: 0mm; }
</style>
