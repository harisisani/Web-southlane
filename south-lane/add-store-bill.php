<?php
include './header.php'; 
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Store Receipt</title>
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
	CURLOPT_URL => $_SERVER['SERVER_NAME'].'/south-lane/api/products/read.php',
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
	$allData=json_decode($response);

	$curl = curl_init();

	curl_setopt_array($curl, array(
	CURLOPT_URL => $_SERVER['SERVER_NAME'].'/south-lane/api/extras/read.php',
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
	$allExtraData=json_decode($response);

?>
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
		
		 // Get the dynamic hostname
		 var hostname = window.location.origin;
		 if(hostname=="http://localhost"){
			hostname+="/Web-southlane";
		 }

		// Example MR number (replace this with the actual MR number dynamically if needed)
		var contact = $('input[name="contact"]').val();

		// Construct the API URL
		var apiUrl = `${hostname}/south-lane/api/billing/get-pending.php?contact_number=${encodeURIComponent(contact)}`;
		 console.log(apiUrl);
		// Make the AJAX request
		$.ajax({
			url: apiUrl,
			type: "GET",
			dataType: "json",
			success: function (response) {
				console.log("response:", response);
				if (response.total_pending) {
					console.log("Total Pending Amount:", response.total_pending);
					// You can update the UI with the response data
					$("input[name='previous_balance']").val(response.total_pending);
					var hostURL = `${hostname}/south-lane/view-receipt.php?pending=true&contact_number=${encodeURIComponent(contact)}`;
					$('#previousReceipt').attr('href', hostURL);
				} else {
					$('#previousReceipt').hide();
					console.log("No pending amount found for this MR number.");
				}
			},
			error: function (xhr, status, error) {
				console.error("Error:", error);
				console.error("Response:", xhr.responseText);
			}
		});
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
		}
		else if($('Select[name="paymentmode"]').val()=="0"){
		Swal.fire({
			icon: 'error',
			title: 'Oops...',
			text: 'Payment Mode is Mandatory (*)',
			footer: '<a href="">Why do I have this issue?</a>'
		});
		tabReceipt('paymentmode');
		}
		else{
			completeReceipt="<table style='width:100%; margin:0 auto;color:auto'>";
			completeReceipt+=
			'<tr><td>Owner Name</td><td>: '+$('input[name="ownername"]').val()+"</td></tr>"+
			'<tr><td>Patient Name</td><td>: '+$('input[name="patientname"]').val()+"</td></tr>"+
			'<tr><td>Contact</td><td>: '+$('input[name="contact"]').val()+"</td></tr>";
			completeReceipt+=($('Select[name="paymentmode"]').val()!="0" && $('Select[name="checkPaymentMode"]').val()!="no")? '<tr><td>Payment Mode</td><td>: '+$('Select[name="paymentmode"]').val()+"</td></tr>" : "";
			completeReceipt+=($('input[name="procedures_with_amount_print"]').val()!="")? ""+$('input[name="procedures_with_amount_print"]').val()+"" : "";
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
					Swal.fire({
						title: 'Saving Information',
						html: 'Please wait while we save the information...',
						allowOutsideClick: false,
						allowEscapeKey: false,
						showConfirmButton: false,
						willOpen: () => {
							Swal.showLoading();
						}
					});
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
						Swal.showLoading();
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
						console.log('I was closed by the timer');
						Swal.close();
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
						"url": "./api/billing/create.php",
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
							"doctor":  $('input[name="doctor"]').val(),
							"paymentmode":  $('Select[name="paymentmode"]').val(),
							"procedures_with_amount":  $('input[name="procedures_with_amount"]').val(),
							"extra_charges":  $('input[name="extra_charges"]').val(),
							"discount":  $('input[name="discount"]').val(),
							"total_amount":  $('input[name="total_amount"]').val(),
							"pending": $("input[name='amountToBePaid']").val(),
							"received": $("input[name='amountReceived']").val(),
							"sendsms": $("select[name='sendsms']").val(),
							"type": "shop",
							"cost": $('input[name="total_cost"]').val(),
						}),
						};

					$.ajax(settings).done(function (response) {
						// invoiceId=response;
						var responseArray=response.split("^");
						if(responseArray[0].includes("success")){
							console.log(response);
							returnDate=responseArray[1];
							invoiceId=responseArray[2];
							printReceipt="<table style='width:100%; margin:0 auto;color:auto'>";
							printReceipt+=
							'<tr><td>Invoice Id</td><td>: '+responseArray[2]+'</td></tr>'+
							'<tr><td>Invoice Date</td><td>: '+responseArray[1]+'</td></tr>'+
							'<tr><td>M.R#</td><td>: '+mrNumber+'</td></tr>'+
							'<tr><td>Owner Name</td><td>: '+$('input[name="ownername"]').val()+"</td></tr>"+
							'<tr><td>Patient Name</td><td>: '+$('input[name="patientname"]').val()+"</td></tr>"+
							'<tr><td>Contact</td><td>: '+$('input[name="contact"]').val()+"</td></tr>";
							printReceipt+=($('input[name="doctor"]').val()!="")? '<tr><td>Doctor Name</td><td>: '+$('input[name="doctor"]').val()+"</td></tr>" : "";
							printReceipt+=($('Select[name="paymentmode"]').val()!="0" && $('Select[name="checkPaymentMode"]').val()!="no")? '<tr><td>Payment Mode</td><td>: '+$('Select[name="paymentmode"]').val()+"</td></tr>" : "";
							printReceipt+=($('input[name="procedures_with_amount_print"]').val()!="")? ""+$('input[name="procedures_with_amount_print"]').val()+"" : "";
							// printReceipt+='<tr><td>Amount Paid</td><td>: '+$('input[name="total_amount"]').val()+"</td></tr>";
							// printReceipt+=($('input[name="notes"]').val()!="")? '<tr><td>Notes</td><td>: '+$('input[name="notes"]').val()+"</td></tr>" : "";
							;
							printReceipt+="</table>";
							$('.printContent').html(printReceipt);
							$('input[name="patientname"]').val("");
							$('input[name="mr_number"]').val("");
							// $('input[name="ownername"]').val("");
							// $('input[name="email"]').val("");
							$('input[name="address"]').val("");
							$('input[name="notes"]').val("");
							$('input[name="doctor"]').val("");
							$('Select[name="paymentmode"]').val("0");
							$('input[name="contact"]').val("");
							$('input[name="notes"]').val("");

							var Json = {
								print_receipt: printReceipt,
							}
							var settings = {
								"url": "./api/billing/savereceipt.php?id="+invoiceId,
								"method": "POST",
								"timeout": 0,
								"headers": {
								"Content-Type": "application/json"
							},
								"data": JSON.stringify(Json),
							};
							$.ajax(settings).done(function (response) {
							});
							nextForm(2,1);
							var qtys= $("input[name='product_qtys']").val();
							var ids= $("input[name='product_ids']").val();

							// Split the values into arrays and ensure no trailing commas cause issues
							var qtyArray = qtys.split(',').filter(value => value.trim() !== "");
							var idArray = ids.split(',').filter(value => value.trim() !== "");


							// Convert the arrays into the required JSON structure
							var items = [];
							for (var i = 0; i < idArray.length; i++) {
								items.push({
									id: parseInt(idArray[i].trim()), // Convert ID to an integer
									qty: parseInt(qtyArray[i].trim()) // Convert quantity to an integer
								});
							}

							// Final JSON object
							var jsonData = {
								items: items
							};

							// AJAX request to the API
							$.ajax({
								url: "./api/products/update-inventory.php", // API endpoint
								method: "POST",
								timeout: 0,
								headers: {
									"Content-Type": "application/json"
								},
								data: JSON.stringify(jsonData), // Convert JSON object to string
								success: function (response) {
									console.log("API Response:", response);
								},
								error: function (xhr, status, error) {
									console.error("API Error:", error);
								}
							});


						}
					});

					Swal.fire(
						'Good job',
						'Information has been saved succesfully',
						'success'
					)

					// Swal.close();
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

	function setHiddenValue(obj){
		var tr=$(obj).closest("tr");
		if($(obj).is(":checked")){
			$(tr).find('input.valueBox').val("yes");
		}else{
			$(tr).find('input.valueBox').val("no");
		}
		updateTotal();
	}

	function validateInput(obj){
		var tr=$(obj).closest("tr");
		if(parseFloat($(obj).val())){
			//check if the current qty is available
			var stockinhand = $(tr).find('input.stockinhand').val();
			var qty = $(tr).find('input.qty').val();
			var unit = $(tr).find('input.unit').val();
			var cost = $(tr).find('input.cost').val();
			if(parseFloat(qty) > parseFloat(stockinhand)){
				console.log("error: stock");
				Swal.fire({
					icon: 'error',
					title: 'Oops...',
					text: 'The requested quantity exceeds the available stock',
					footer: '<a href="">Why do I have this issue?</a>'
				});
				$(tr).find('input.qty').val(stockinhand);
				var total=parseFloat(stockinhand)*parseFloat(unit);
				var totalcost=parseFloat(cost)*parseFloat(qty);
				$(tr).find('input.amount').val(total);
				$(tr).find('input.totalcost').val(totalcost);
				updateTotal();
			}else{
				var total=parseFloat(qty)*parseFloat(unit);
				var totalcost=parseFloat(cost)*parseFloat(qty);
				$(tr).find('input.amount').val(total);
				$(tr).find('input.totalcost').val(totalcost);
				updateTotal();
			}
		}else{
			parseFloat($(obj).val("0"));
		}
	
	}

	function updateTotal(){
		var total=0;
		var procedure="";
		var procedurePrint="";
		var charges=0;
		var discount=0;
		var tHEadSlip=0;
		$('tr.template').each(function(){
			if($(this).find("input.valueBox").val()=="yes"){
				if($(this).find("select.show_receipt").val()=="yes"){
					tHEadSlip++;
				}
			}
		});
		if(tHEadSlip!=0){
			procedurePrint="</table><table style='width:100%; margin:0 auto;color:auto'>";
			procedurePrint+="<tr><th>Description</th><th>Unit</th><th>Qty</th><th>Amount</th>";
		}
		var totalCosts=0;

		var productQtys = "";
		var productIds = "";
		$('tr.template').each(function(){
			if($(this).find("input.valueBox").val()=="yes"){
				var text = ($(this).find("input.text").val());
				var id = ($(this).find("input.id").val());
				var qty = ($(this).find("input.qty").val());
				var unit = ($(this).find("input.unit").val());
				var cost = ($(this).find("input.totalcost").val());
				totalCosts+=parseFloat(cost);
				var amount = parseFloat($(this).find("input.amount").val());
				productQtys+=qty+",";
				productIds+=id+",";
				total+=amount;
				if(amount>0){
					charges+=amount;
				}else{
					discount+=amount;
				}
				procedure+=text+"X"+qty+" : "+amount+"<br/>";
				if($(this).find("select.show_receipt").val()=="yes"){
					procedurePrint+="<tr><td>"+text+"</td><td>"+unit+"</td><td>"+qty+"</td><td>: "+amount+"<td/></tr>";
				}
			}
		});
		if(tHEadSlip!=0){
			procedurePrint+="</table><table style='width:80%; margin:0 auto; margin-left:20%;color:auto'>";
		}
		$("input[name='total_cost']").val(totalCosts);
		$("input[name='product_qtys']").val(productQtys);
		$("input[name='product_ids']").val(productIds);
		var discountGiven=$("input[name='discount']").val();
		var previous_balance=$("input[name='previous_balance']").val();
		var grandTotal=(parseFloat(total)-parseFloat(discountGiven));
		if($('#applyprevious').val()=="yes"){
			 grandTotal+=parseFloat(previous_balance);
		}
		$("input[name='total_amount']").val(grandTotal);
		$("input[name='procedures_with_amount']").val(procedure);
		$("input[name='extra_charges']").val(charges);
		// $("input[name='discount']").val(discount);


		var amountReceived= $("input[name='amountReceived']").val();
		var amountToBePaid= $("input[name='amountToBePaid']").val();
		// procedurePrint+="<tr><td>Sub total</td><td>: "+charges+"<td/></tr>";
		// procedurePrint+="<tr><td>Discount</td><td>: "+discount+"<td/></tr>";
		// procedurePrint+="<tr><td>Grand Total</td><td>: "+grandTotal+"<td/></tr>";
		// procedurePrint+="<tr><td>Amount Received</td><td>: "+amountReceived+"<td/></tr>";
		// procedurePrint+="<tr><td>Amount to be paid</td><td>: "+amountToBePaid+"<td/></tr>";
		$('tr.templateTwo').each(function(){
				var text = ($(this).find("input.text").val());
				var amount = parseFloat($(this).find("input.amount").val());
				total+=amount;
				if(amount>0){
					charges+=amount;
				}else{
					discount+=amount;
				}
				procedure+=text+": "+amount+"<br/>";
				if($(this).find("select.show_receipt").val()=="yes"){
					procedurePrint+="<tr><td>"+text+"</td><td>: "+amount+"<td/></tr>";
				}
		});
		procedurePrint=procedurePrint.replace("-","");
		$("input[name='procedures_with_amount_print']").val(procedurePrint);
	}

	function openEmailReceipt(){
		var email = $('input[name="email"]').val();
		var name = $('input[name="ownername"]').val();
		var html ="<input type='text' value='"+email+"' id='emailText' class='form-control'>";
		Swal.fire({
			title: 'Send Receipt via Email',
			html: " "+html,
			icon: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'Yes, send it!'
			}).then((result) => {
			var apiUrl='/south-lane/api/email/sendmail.php';
			if (result.isConfirmed) {
				var settings = {
					"url": ""+apiUrl,
					"method": "POST",
					"timeout": 0,
					"headers": {
						"Content-Type": "application/json"
					},
					"data": JSON.stringify({
						"receiver_email": ""+$('#emailText').val(),
						"receiver_name": ""+name,
						"subject": "Thank you for the Payment",
						"body": "<div style='color:black !important; padding:25px; width:400px !important;background-image: url(https://southlaneanimalhospital.com/south-lane/assets/emailimages/v2/bg.jpg); background-repeat: no-repeat; background-size: cover;'><img style='width:400px;' src='https://southlaneanimalhospital.com/south-lane/assets/emailimages/v2/header.jpg'>"+completeReceipt+"</div><div style='padding:0px !important;'><img style='width:450px !important;' src='https://southlaneanimalhospital.com/south-lane/assets/emailimages/v2/footer.jpg'></div></div>"
					}),
					};

					$.ajax(settings).done(function (response) {
						console.log(response)
							if(response.includes('success')){
								Swal.fire(
									'Sent!',
									'Receipt has been mailed.',
									'success'
								);
							}else{
								Swal.fire(
								'Email not sent',
								'Try again with correct email',
								'error'
								)
							}
					});
				}
			})
	}

	function printReceiptBlitz(){
		window.print();
	}

	function searchProcedures() {
		var searchTerm = $('#searchInputProcedures').val().toLowerCase(); // Get the search term and convert it to lowercase

		$('#proceduresTable tbody tr').each(function() {
			var rowMatch = false; // Initialize a flag to check if the row matches

			// Loop through all text fields in the row
			$(this).find('input[type="text"]').each(function() {
				if ($(this).val().toLowerCase().indexOf(searchTerm) !== -1) {
					rowMatch = true; // Set the flag if any field matches
					return false; // Break out of the loop
				}
			});

			if (rowMatch) {
				$(this).show(); // Show the row if any field matches the search term
			} else {
				$(this).hide(); // Hide the row if no fields match
			}
		});
	}

	function searchExtras() {
		var searchTerm = $('#searchInputExtras').val().toLowerCase(); // Get the search term and convert it to lowercase
		
        $('#ExtrasTable tbody tr').each(function() {
            var rowText = $(this).text().toLowerCase(); // Get the text of each row and convert it to lowercase

            if (rowText.indexOf(searchTerm) !== -1) {
                $(this).show(); // Show the row if it matches the search term
            } else {
                $(this).hide(); // Hide the row if it doesn't match the search term
            }
        });
	}

	
</script>

<div style="margin-top: 200px;" class="container htmlContent">
	<div class="row">
		<div class="col">
			<div class="section_title_container text-center">
				<h2 class="section_title">Create a Receipt</h2>
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
                        <button class="nav-link disabled" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Billing Details</button>
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
					<script>
						function tabReceipt(tabName){
							$('.tableClass').hide();
							$('.'+tabName).show();
						}
					</script>
					<div class="tab-pane " id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
						<div class="login100-form validate-form">
							<button type="button" onclick="tabReceipt('procedures');" class="btn btn-success">In Stock Products</button>
							<button type="button" onclick="tabReceipt('extras');" class="btn btn-success">Out of Stock Product</button>
							<button type="button" onclick="tabReceipt('breakdown');" class="btn btn-success">Breakdown</button>
							<button type="button" onclick="tabReceipt('paymentmode');" class="btn btn-success">Payment Mode</button>
							<br>
							<table style="display:none" class="table tableClass paymentmode">
								<tr>
									<th scope="col">Receipt</th>
										<th scope="col">Payment Mode</th>
									</tr>
								<tr>
									<td>
										<select name="checkPaymentMode" class="form-control">
											<option value="yes">Show on Receipt</option>
											<option value="no">Hide on Receipt</option>
										</select>
									</td>
									<td>
										<select class="form-control" name="paymentmode">
											<option value="0">Select Payment Mode*</option>
											<option value="Cash">Cash</option>
											<option value="Card Payment">Card Payment</option>
											<option value="Online Transfer">Online Transfer</option>
											<option value="Pending">Pending</option>
										</select>
									</td>
								</tr>
								<style>
									.circle-badge{
										padding: 10px;
										color: white;
										background: blue;
										border-radius: 10px;
										margin: 10px;
									}
								</style>
								<tr>
									<td style="float: right;">
										<span class="circle-badge">Send SMS After Bill Creation?</span>
									</td>
									<td>
										<select class="form-control" name="sendsms">
											<option selected value="yes">Yes</option>
											<option value="no">No</option>
										</select>
									</td>
								</tr></td>
							</table>
							<table id="proceduresTable" class="table tableClass procedures">
								<thead>
									<tr>
										<td colspan=6>
											<input id="searchInputProcedures" onkeyup="searchProcedures()" placeholder="Search Products" class="form-control" type="text">
										</td>
									</tr>
									<tr>
										<th scope="col" style="width:5%">Inc./Exc.</th>
										<th scope="col" style="width:15%">Receipt</th>
										<th scope="col" style="width:35%">Item</th>
										<th scope="col" style="width:15%">Unit Price</th>
										<th scope="col" style="width:15%">Quantity</th>
										<th scope="col" style="width:15%">Total Price</th>
									</tr>
								</thead>
								<tbody>
								<?php foreach($allData as $key => $value){
								if( $value->stockinhand>0){
								?>
								<tr class="template">
									<td>
										<div class="form-check">
											<input class="form-check-input position-static" onclick="setHiddenValue(this);" type="checkbox" value="option1" aria-label="...">
											<input class="valueBox" type="hidden" value="no">
										</div>
									</td>
									<td>
										<select onchange="updateTotal();" class="show_receipt form-control">
											<option value="yes">Show</option>
											<option value="no">Hide</option>
										</select>
									</td>
									<td>
										<input type="text" value="<?=$value->name?>" class="form-control text" placeholder="Label">
										<input type="hidden" value="<?=$value->id?>" class="form-control id" placeholder="Label">
										<input type="hidden" value="<?=$value->cost?>" class="form-control cost" placeholder="Label">
										<input type="hidden" value="<?=$value->stockinhand?>" class="form-control stockinhand" placeholder="Label">
										<input type="hidden" value="<?= floatval($value->cost)? $value->cost : 0  ?>" class="form-control totalcost" placeholder="Label">
									</td>
									<td><input type="text" onblur="validateInput(this);" value="<?= floatval($value->price)? $value->price : 0  ?>" class="form-control unit" placeholder="Unit Price"></td>
									<td><input type="text" onblur="validateInput(this);" value="1" class="form-control qty" placeholder="Quantity">
									Available in Stock: <?=$value->stockinhand?>
									</td>
									<td><input type="text" readonly=""  value="<?= floatval($value->price)? $value->price : 0  ?>" class="form-control amount" placeholder="Amount"></td>
								</tr>
								<?php }}?>
								</tbody>
							</table>
							<table style="display:none" class="table tableClass breakdown">
								<thead>
									<tr>
										<th scope="col" style="width:15%">Receipt</th>
										<th scope="col" style="width:65%">Label</th>
										<th scope="col" style="width:25%">Charges</th>
									</tr>
								</thead>
								<tbody>
									<tr class="templateTwo">
										<td>
											<select onchange="updateTotal();" class="show_receipt form-control">
												<option value="yes">Show</option>
												<option value="no">Hide</option>
											</select>
										</td>
										<td>
											<input type="text" value="Sub-Total"  class="form-control text" placeholder="Sub-Total">
										</td>
										<td>
											<input name="extra_charges" readonly="" onblur="updateTotal();" type="text" value="0" class="form-control amount" placeholder="Amount">
										</td>
									</tr>
									<tr class="templateTwo">
										<td>
											<select onchange="updateTotal();" class="show_receipt form-control">
												<option value="yes">Show</option>
												<option value="no">Hide</option>
											</select>
										</td>
										<td>
											<input type="text" value="Discount"  class="form-control text" placeholder="Discount">
										</td>
										<td>
											<input name="discount" onblur="updateTotal();" type="text" value="0" class="form-control amount" placeholder="Amount">
										</td>
									</tr>
									<tr class="templateTwo">
										<td>
											<select id="applyprevious" onchange="updateTotal();" class="show_receipt form-control">
												<option value="yes">Show</option>
												<option selected value="no">Hide</option>
											</select>
										</td>
										<td>
											<input type="text" value="Previous Pending Balance" class="form-control text" placeholder="Previous Pending Balance">
											<a target="_blank" id="previousReceipt" href="">See All Pending Receipts</a>
										</td>
										<td>
											<input readonly="" name="previous_balance" readonly="" type="text" value="0" class="form-control amount">
										</td>
									</tr>
									<tr class="templateTwo">
										<td>
											<select onchange="updateTotal();" class="show_receipt form-control">
												<option value="yes">Show</option>
												<option value="no">Hide</option>
											</select>
											<input type="hidden" id="mrNumber" name="mr_number">
											<input type="hidden" name="procedures_with_amount">
											<input type="hidden" name="procedures_with_amount_print">
										</td>
										<td>
											<input type="text" value="Grand Total" class="form-control text" placeholder="Grand Total">
										</td>
										<td>
											<input name="total_amount" readonly="" type="text" readonly="" value="0" class="form-control amount" placeholder="Amount">
											<input name="total_cost" readonly="" type="hidden" readonly="" value="0" class="form-control cost">
											<input name="product_ids" readonly="" type="text" readonly="" value="" class="form-control">
											<input name="product_qtys" readonly="" type="text" readonly="" value="" class="form-control">
										</td>
									</tr>
									<tr class="templateTwo">
										<td>
											<select onchange="updateTotal();" class="show_receipt form-control">
												<option value="yes">Show</option>
												<option value="no">Hide</option>
											</select>
										</td>
										<td>
											<input type="text" value="Amount Received" class="form-control text" placeholder="Amount Received">
										</td>
										<td>
											<input name="amountReceived" onblur="updateTotal();" type="text" value="0" class="form-control amount" placeholder="Amount">
										</td>
									</tr>
									<tr class="templateTwo">
										<td>
											<select onchange="updateTotal();" class="show_receipt form-control">
												<option value="yes">Show</option>
												<option value="no">Hide</option>
											</select>
										</td>
										<td>
											<input type="text" value="Amount To be Paid" class="form-control text" placeholder="To be Paid">
										</td>
										<td>
											<input name="amountToBePaid" onblur="updateTotal();" type="text" value="0" class="form-control amount" placeholder="Amount">
										</td>
									</tr>
								</tbody>
							</table>
							<table id="ExtrasTable" style="display:none" class="table tableClass extras">
								<thead>
									<tr>
										<td colspan="6">
											<input id="searchInputExtras" onkeyup="searchExtras()" placeholder="Search Products" class="form-control" type="text">
											<br/>
											<a style="color:#F60017;font-weight:bold;text-decoration:none;" href="store-products.php">Update Stock Now!</a>
										</td>
									</tr>
									<tr>
										<th scope="col" style="width:35%">Item</th>
										<th scope="col" style="width:15%">Price</th>
									</tr>
								</thead>
								<tbody>
								<?php foreach($allData as $key => $value){
								if( $value->stockinhand<=0){
								?>
								<tr class="template">
									<td><?=$value->name?></td>
									<td><?=$value->price?></td>
								</tr>
								<?php } }?>
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
					<div class="container-login100-form-btn">
						<div class="wrap-login100-form-btn">
							<div class="login100-form-bgbtn"></div>
								<but class="login100-form-btn" onclick="openEmailReceipt();">
								Email Receipt <i class="fa fa-arrow-right" aria-hidden="true"></i>
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
            <p style="text-align:center" class="centered">Thanks for the payment!
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
