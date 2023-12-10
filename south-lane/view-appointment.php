<?php include './header.php'; ?>
<?php

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => $_SERVER['SERVER_NAME'].'/south-lane/api/appointment/read.php',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',
  CURLOPT_HTTPHEADER => array(
    'Cookie: PHPSESSID=i0btgr6t1e4ofb6u9r2qlq1395'
  ),
));

$response = curl_exec($curl);

curl_close($curl);
$allData=json_decode($response);

?>

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
</head>
<body>
        <div style="margin-top: 200px;" class="container">
            <div class="row">
                <div class="col">
                    <div class="section_title_container text-center">
                        <h2 class="section_title">View Appointments</h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="container" style="margin-top:50px; overflow-x:scroll;">
            <table id="patientsTable" class="table table-bordered">
                <thead>
                    <tr style="background:#F60017; color:white;">
                        <th style="vertical-align: middle;">System ID</th>
                        <th style="vertical-align: middle;">Appointment ID</th>
                        <th style="vertical-align: middle;">Appointment Date</th>
                        <th style="vertical-align: middle;">M.R. Number</th>
                        <th style="vertical-align: middle;">Owner Name</th>
                        <th style="vertical-align: middle;">Patient Name</th>
                        <th style="vertical-align: middle;">Contact</th>
                        <th style="vertical-align: middle;">Procedure</th>
                        <th style="vertical-align: middle;">Amount</th>
                        <th style="vertical-align: middle;">Created By</th>
                        <th style="vertical-align: middle;">Created Date</th>
                        <!-- <th style="vertical-align: middle;">Print</th> -->
                    </tr>
                </thead>
            <tbody>
                <?php foreach($allData as $value){?>
                <tr class="template">
                    <td class="bill_id_unique"><?=$value->appointment_id?></td>
                    <td class="bill_id_unique"><?=$value->appointment_id_unique?></td>
                    <td class="patient_name"><?= date('F d, Y',strtotime($value->appointment_date))?></td>
                    <td class="owner_name"><?=$value->mr_number?></td>
                    <td class="owner_name"><?=$value->owner_name?></td>
                    <td class="contact"><?=$value->patient_name?></td>
                    <td class="bill_date"><?=$value->contact?></td>
                    <td class="procedure"><?=$value->procedure_name?></td>
                    <td class="amount"><?=$value->procedure_amount?></td>
                    <td class="procedures_with_amount"><?=$value->user_name?></td>
                    <td class="extra_charges"><?=$value->appointment_created_date?></td>
                    <!-- <td class="user_name">
                        <button type="button" onclick='printLayout(this)' class="btn btn-success">Print</button>
                        <input type="hidden" class="htmlText" value="</?=$value->print_receipt?>">
                    </td> -->
                </tr>
                <?php }?>
            </tbody>
            </table>
        </div>
    <!-- <script src="./assets/vendor/jquery/jquery-3.2.1.min.js"></script> -->
	<script src="./assets/sweetalert/sweetalert2@11.js"></script>
    <div style="display:none;" class="printCSS" >
            <div style="background:#F2F2F2;" class="ticket">
                <img src="./assets/images/logo.jpg" alt="Logo">
                <p style="text-align:center" class="centered">PAYMENT INVOICE</p>
                <p class="centered printContent"></p>
                <p style="text-align:center" class="centered">Thanks for the payment!
            </div>
    </div>

</body>
</html>
<?php include './footer.php';?>

    <script>
      $(document).ready(function() {
        $('#patientsTable').DataTable( {
            "order": [[ 0, 'desc' ]],
            dom: 'Bfrtip',
        buttons: [
            {
                extend: 'copyHtml5',
                exportOptions: {
                    columns: [ 0, ':visible' ]
                }
            },
            {
                extend: 'excelHtml5',
                exportOptions: {
                    columns: ':visible'
                }
            },
            {
                extend: 'pdfHtml5',
                exportOptions: {
                    columns: [ 0, 1, 2, 5 ]
                }
            },
            'colvis'
        ]
        } );
    } );
</script>
<style>
    .dataTables_filter input{
        border-radius: 5px;
        width: 400px;
        border: 1px solid grey;
        height: 30px;
    }
</style>
<!-- <script>

    function printLayout(obj){
        $('.printContent').html( $(obj).closest("tr").find('input.htmlText').val());
        window.print();
    }
</script>
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
            #patientsTable_paginate,.dataTables_info,.dt-buttons,.dataTables_filter,.htmlContent,.header,.footer,.container{ display: none !important; } 
            .printCSS{ display:block !important;width:100% }
	}
	@page { size: auto;  margin: 0mm; }
</style> -->
