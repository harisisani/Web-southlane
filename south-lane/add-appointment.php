<?php 
include './header.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Appointments</title>
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
<?php

	$curl = curl_init();

	curl_setopt_array($curl, array(
	CURLOPT_URL => $_SERVER['SERVER_NAME'].'/south-lane/api/patients/read.php',
	CURLOPT_RETURNTRANSFER => true,
	CURLOPT_ENCODING => '',
	CURLOPT_MAXREDIRS => 10,
	CURLOPT_TIMEOUT => 0,
	CURLOPT_FOLLOWLOCATION => true,
	CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	CURLOPT_CUSTOMREQUEST => 'GET',
	CURLOPT_HTTPHEADER => array(
		'Cookie: PHPSESSID=6tnki7omhgrjkvoc844tc8ji4m'
	),
	));

	$response = curl_exec($curl);

	curl_close($curl);
	$allPatientData=json_decode($response);

	$allPatient2='<table style="display:none;">';
	$allPatient='';
	foreach($allPatientData as $index => $value){
		$allPatient.='<tr class="template"><td style="text-align:center;" class="r1"><div class="add-remove-sign"><a href="javascript:void(0)" onclick="addExistingPatient(this)" class="add-arrow"><i class="fa fa-check-square-o" aria-hidden="true"></i></a></div></td><td nowrap class="srNo">'.($index+1).'</td><td nowrap class="patientId">'.$value->mr_id_unique.'</td><td class="patientName">'.$value->patient_name.'</td><td class="ownerName">'.$value->owner_name.'</tr>';
		$allPatient2.='<tr class="remainingFields"><td class="patientId">'.$value->mr_id_unique.'_'.($index+1).'</td><td class="ownerContact">'.$value->owner_contact.'</td><td class="email">'.$value->owner_email.'</td><td class="address">'.$value->owner_address.'</td><td class="notes">'.$value->pet_notes.'</td></tr>';
	}

	$allPatient.='</tbody></table>';
	$allPatient2.='</table>';
	echo $allPatient2;
?>
<script>
	var allPatient='<table id="patientsTable" class="table table-bordered"><thead><tr style="background:#F60017; color:white;"><th style="vertical-align: middle;"></th><th style="vertical-align: middle;">#</th><th style="vertical-align: middle;">MR ID</th><th style="vertical-align: middle;">Patient Name</th><th style="vertical-align: middle;">Owner Name</th></tr></thead><tbody>'+'<?=$allPatient?>';
	function openAddExitingPatient(){
		Swal.fire({
			title: 'Select Patient Details',
			html: ""+allPatient,
			showCloseButton: true,
			showCancelButton: true,
			focusConfirm: false,
			});
			$('#patientsTable').DataTable( {
			dom: 'Bfrtip',
			buttons: [
				'colvis',
				'pageLength'
			]
			} );
	}
	
	
	function addExistingPatient(obj){
		var tr = $(obj).closest("tr");
		$('input[name="patientname"]').val($(tr).find('td.patientName').text());
		$('input[name="ownername"]').val($(tr).find('td.ownerName').text());
		$('input[name="patientName"]').val($(tr).find('td.patientName').text());
		var match=$(tr).find('td.patientId').text()+"_"+$(tr).find('td.srNo').text();
		$('tr.remainingFields').each(function (){
			if($(this).find('td.patientId').text()==match){
				$('#mrNumber').val($(tr).find('td.patientId').text());
				$('input[name="contact"]').val($(this).find('td.ownerContact').text());
				$('input[name="email"]').val($(this).find('td.email').text());
				$('input[name="address"]').val($(this).find('td.address').text());
				$('input[name="notes"]').val($(this).find('td.notes').text());
			}
		});
		flagNewCheck=1;
		$('.input100').focus();
		Swal.fire('Details with Mr-Id: '+$(tr).find('td.patientId').text()+' are added');
	}

	var invoiceId=0;
	var returnDate="";
	var printReceipt="";
	var completeReceipt="";
	var mrNumber=0;
	var flagNewCheck=0;
	function createPatientBill(){
		if($('input[name="patientname"]').val()=="" || $('input[name="ownername"]').val()=="" || $('input[name="contact"]').val()==""){
		Swal.fire({
			icon: 'error',
			title: 'Oops...',
			text: 'Fill out the required fields (*)',
			footer: '<a href="">Why do I have this issue?</a>'
		});
		nextForm(0);
		}else{
			// completeReceipt=
			// 'Owner Name: '+$('input[name="ownername"]').val()+"<br/>"+
			// 'Patient Name: '+$('input[name="patientname"]').val()+"<br/>"+
			// 'Contact: '+$('input[name="contact"]').val()+"<br/>";
			// completeReceipt+=($('input[name="email"]').val()!="")? 'Email: '+$('input[name="email"]').val()+"<br/>" : "";
			// completeReceipt+=($('input[name="address"]').val()!="")? 'Address: '+$('input[name="address"]').val()+"<br/>" : "";
			// completeReceipt+=($('input[name="doctor"]').val()!="")? 'Doctor Name: '+$('input[name="doctor"]').val()+"<br/>" : "";
			// completeReceipt+=($('input[name="procedures_with_amount"]').val()!="")? $('input[name="procedures_with_amount"]').val() : "";
			// completeReceipt+='Amount Paid: '+$('input[name="total_amount"]').val()+"<br/>";
			// completeReceipt+=($('input[name="notes"]').val()!="")? 'Notes: '+$('input[name="notes"]').val()+"<br/>" : "";
			// ;

			completeReceipt="<table style='width:100%; margin:0 auto;'>";
			completeReceipt+=
			'<tr><td>Owner Name</td><td>: '+$('input[name="ownername"]').val()+"</td></tr>"+
			'<tr><td>Patient Name</td><td>: '+$('input[name="patientname"]').val()+"</td></tr>"+
			'<tr><td>Contact</td><td>: '+$('input[name="contact"]').val()+"</td></tr>";
			completeReceipt+=($('input[name="appointment_date"]').val()!="")? '<tr><td>Appointment Date</td><td>: '+$('input[name="appointment_date"]').val()+"</td></tr>" : "";
			completeReceipt+=($('input[name="procedure_name"]').val()!="")? '<tr><td>'+$('input[name="procedure_name"]').val()+'</td><td>: '+$('input[name="procedure_amount"]').val()+"</td></tr>" : "";
			// printReceipt+='<tr><td>Amount Paid</td><td>: '+$('input[name="total_amount"]').val()+"</td></tr>";
			// printReceipt+=($('input[name="notes"]').val()!="")? '<tr><td>Notes</td><td>: '+$('input[name="notes"]').val()+"</td></tr>" : "";
			;
			completeReceipt+="</table>";
			
			
			Swal.fire({
				title: 'Do you wish to save the below details?',
				html: completeReceipt,
				icon: 'success',
				showCancelButton: true,
				confirmButtonColor: '#3085d6',
				cancelButtonColor: '#d33',
				confirmButtonText: 'Confirm'
				}).then((result) => {
				if (result.isConfirmed) {
					if(flagNewCheck==0){
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
							"procedure_name":  $('input[name="procedure_name"]').val(),
							"procedure_amount":  $('input[name="procedure_amount"]').val(),
						}),
						};

					$.ajax(settings).done(function (response) {
						var responseArray=response.split("^");
						if(responseArray[0].includes("success")){
							console.log(response);
							mrNumber=responseArray[1];
							$('input[name="mr_number"]').val(responseArray[1]);
						}
					});	
					let timerInterval
					Swal.fire({
					title: 'Saving Information',
					html: 'I will close in <b></b> milliseconds.',
					timer: 2000,
					timerProgressBar: true,
					didOpen: () => {
						Swal.showLoading()
						const b = Swal.getHtmlContainer().querySelector('b')
						timerInterval = setInterval(() => {
						b.textContent = Swal.getTimerLeft()
						}, 100)
					},
					willClose: () => {
						clearInterval(timerInterval)
					}
					}).then((result) => {
					/* Read more about handling dismissals below */
					if (result.dismiss === Swal.DismissReason.timer) {
						console.log('I was closed by the timer')
					}
					})
					window.setTimeout( saveBill, 2000);	
				}
				else{
					mrNumber=$('#mrNumber').val();
					saveBill();
				}
					
				}
				});

				
				$('#completeReceipt').html(completeReceipt);
				
		}
	}

	function saveBill()
	{
		var settings = {
						"url": "./api/appointment/create.php",
						"method": "POST",
						"timeout": 0,
						"headers": {
							"Content-Type": "application/json",
						},
						"data": JSON.stringify({
							"patientname": $('input[name="patientname"]').val(),
							"mr_number": ""+mrNumber,
							"ownername":  $('input[name="ownername"]').val(),
							"contact":  $('input[name="contact"]').val(),
							"appointment_date":  $('input[name="appointment_date"]').val(),
							"procedure_name":  $('input[name="procedure_name"]').val(),
							"procedure_amount":  $('input[name="procedure_amount"]').val(),
						}),
						};

					$.ajax(settings).done(function (response) {
						// invoiceId=response;
						var responseArray=response.split("^");
						if(responseArray[0].includes("success")){
							console.log(response);
							returnDate=responseArray[1];
							invoiceId=responseArray[2];
							printReceipt="<table style='width:100%; margin:0 auto;'>";
							printReceipt+=
							'<tr><td>Appointment Id</td><td>: '+responseArray[2]+'</td></tr>'+
							'<tr><td>Created Date</td><td>: '+responseArray[1]+'</td></tr>'+
							'<tr><td>M.R#</td><td>: '+mrNumber+'</td></tr>'+
							'<tr><td>Owner Name</td><td>: '+$('input[name="ownername"]').val()+"</td></tr>"+
							'<tr><td>Patient Name</td><td>: '+$('input[name="patientname"]').val()+"</td></tr>"+
							'<tr><td>Contact</td><td>: '+$('input[name="contact"]').val()+"</td></tr>"+
							'<tr><td>Your Next Appointment Date</td><td>: '+$('input[name="appointment_date"]').val()+'</td></tr>'+
							'<tr><td>'+$('input[name="procedure_name"]').val()+'</td><td>: '+$('input[name="procedure_amount"]').val()+"</td></tr>";
							printReceipt+="</table>";
							$('.printContent').html(printReceipt);
							$('input[name="patientname"]').val(""); 
							$('input[name="mr_number"]').val(""); 
							// $('input[name="ownername"]').val("");
							// $('input[name="email"]').val("");
							$('input[name="address"]').val("");
							$('input[name="notes"]').val("");

						}
					});	

					Swal.fire(
						'Good job',
						'Information has been saved succesfully',
						'success'
					)

					// Swal.close();
					nextForm(2,1);
	}


    function nextForm(index,validate=0){
		if(($('input[name="patientname"]').val()=="" || $('input[name="ownername"]').val()=="" || $('input[name="contact"]').val()=="") && validate==0){
		Swal.fire({
			icon: 'error',
			title: 'Oops...',
			text: 'Fill out the required fields (*)',
			footer: '<a href="">Why do I have this issue?</a>'
		})
		}else{
			$('.nav-link').removeClass("active");
			$('.tab-pane').hide();
			$('.nav-link').eq(index).addClass("active");
			$('.tab-pane').eq(index).show();
			if(validate==0){
				var width = ((index+1) * 25)+"%";
				$('#progress').css('width',width);
			}else{
				$('#progress').css('width',"100%");
			}
		}
    }


	function printReceiptBlitz(){
		window.print();
	}
</script>
        
<div style="margin-top: 200px;" class="container htmlContent">
	<div class="row">
		<div class="col">
			<div class="section_title_container text-center">
				<h2 class="section_title">Create a new Appointment</h2>
				<p>Field with * are required</p>
			</div>
		</div>
		
	</div>
</div>

<div class="limiter htmlContent">
		<div class="container-login100-new">
            <div class="wrap-login100">
                <div class="progress">
                    <div id="progress" class="progress-bar progress-bar-striped bg-info" role="progressbar" style="width: 25%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                <br>
                <nav>
                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                        <button class="nav-link disabled active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">Patient Details</button>
                        <button class="nav-link disabled" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Appointment Details</button>
                        <button class="nav-link disabled" id="nav-contact-tab" data-bs-toggle="tab" data-bs-target="#nav-contact" type="button" role="tab" aria-controls="nav-contact" aria-selected="false">Save & Print</button>
                    </div>
                </nav>
                <br>
                <br>
				<div class="tab-content" id="nav-tabContent">
					<div class="tab-pane active  show" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">				
						<button style="float: right;" type="button" onclick="openAddExitingPatient();" class="btn btn-success">Add Existing</button>
						<br>
                		<br>
						
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
									<but class="login100-form-btn" onclick="nextForm(1);">
										NEXT <i class="fa fa-arrow-right" aria-hidden="true"></i>
									</but>
								</div>
							</div>
						</div>
					</div>
					<div class="tab-pane " id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
						<div class="login100-form validate-form">
							<table class="table tableClass breakdown">
								<thead>
									<tr>
										<th scope="col" style="width:15%">Appointment Date</th> 
									</tr>
								</thead>
								<tbody>
									<tr class="templateTwo">
										<td>
											<input type="hidden" id="mrNumber" name="mr_number">
											<input type="date" name="appointment_date" id="appointment_date" class="form-control text">
										</td>
									</tr>
								</tbody>
								<thead>
									<tr>
										<th scope="col" style="width:15%">Procedure Name</th> 
									</tr>
								</thead>
								<tbody>
									<tr class="templateTwo">
										<td>
											<input type="text" name="procedure_name" class="form-control text">
										</td>
									</tr>
								</tbody>
								<thead>
									<tr>
										<th scope="col" style="width:15%">Procedure Amount</th> 
									</tr>
								</thead>
								<tbody>
									<tr class="templateTwo">
										<td>
											<input type="text" name="procedure_amount" class="form-control text">
										</td>
									</tr>
								</tbody>
							</table>
							<div class="container-login100-form-btn">
								<div class="wrap-login100-form-btn">
									<div class="login100-form-bgbtn"></div>
										<but class="login100-form-btn" onclick="createPatientBill();">
										Continue  <i class="fa fa-arrow-right" aria-hidden="true"></i>
									</but>
								</div>
							</div>
							<div class="container-login100-form-btn">
								<div class="wrap-login100-form-btn">
									<div class="login100-form-bgbtn"></div>
										<but class="login100-form-btn" onclick="nextForm(0);">
										<i class="fa fa-arrow-left" aria-hidden="true"></i>  Back
									</but>
								</div>
							</div>
						</div>
					</div> 
					<div class="tab-pane" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
					<div class="row print">
						<div class="col">
							<img style="max-width: 150px; padding:15px;" src="https://www.mediafire.com/convkey/5a02/pd1uz54fm9tfztv9g.jpg" alt="">
							<h4 style="text-align:left;" id="completeReceipt" class="section_title"></h4>
						</div>  
					</div>
					<div class="container-login100-form-btn">
						<div class="wrap-login100-form-btn">
							<div class="login100-form-bgbtn"></div>
								<but class="login100-form-btn" onclick="printReceiptBlitz();">
								Print Receipt  <i class="fa fa-arrow-right" aria-hidden="true"></i>
							</but>
						</div>
					</div>
					</div>
			</div>
		</div>
	</div>
</div>

<div style="display:none;" class="printCSS" >
        <div style="background:#F2F2F2;" class="ticket">
            <img src="./assets/images/logo.jpg" alt="Logo">
            <p style="text-align:center" class="centered">PAYMENT INVOICE</p>
			<p class="centered printContent"></p>
            <p style="text-align:center" class="centered">Thanks You!
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
<script>
	 $(function() {
            var dtToday = new Date();

            var month = dtToday.getMonth() + 1;
            var day = dtToday.getDate();
            var year = dtToday.getFullYear();
            if (month < 10)
                month = '0' + month.toString();
            if (day < 10)
                day = '0' + day.toString();

            var maxDate = year + '-' + month + '-' + day;

            $('#appointment_date').attr('min', maxDate);
        });
</script>
