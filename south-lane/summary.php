<?php include './header.php'; ?>
<?php
    $curl = curl_init();
    curl_setopt_array($curl, array(
    CURLOPT_URL => $_SERVER['SERVER_NAME'].'/south-lane/api/billing/read.php',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'GET',
    ));

$response = curl_exec($curl);

curl_close($curl);
$allData=json_decode($response);
?>
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
<?php
include './header.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Patients</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->
	<link rel="icon" type="image/png" href="./assets/images/icons/favicon.ico"/>
</head>
<body>
        <div style="margin-top: 200px;" class="container htmlContent">
            <div class="row">
                <div class="col">
                    <div class="section_title_container text-center">
                        <h2 class="section_title">View Billings</h2>
                    </div>
                </div>
            </div>
            <div class="container-login100-form-btn ">
                <div class="wrap-login100-form-btn">
                    <div class="login100-form-bgbtn"></div>
                        <but class="login100-form-btn" onclick="printSummary();">
                        Print Summary  <i class="fa fa-arrow-right" aria-hidden="true"></i>
                    </but>
                </div>
            </div>
            <br/>
        </div>
        <div class="container overflow" style="margin-top:50px;">
            <table id="patientsTable" class="table table-bordered printCSS">
                <thead>
                    <tr>
                        <td></td>
                        <td>Start date:</td>
                        <td><input type="date" id="filter_From" name="min"></td>
                        <td>End date:</td>
                        <td><input type="date" id="filter_To" name="max"></td>
                        <td>Payment Mode:</td>
                        <td colspan="2">
                            <select class="form-control" onchange="sortPaymentBased(this.value);" name="paymentModeFilter" id="paymentModeFilter">
                                <option value="">Select</option>
                                <option value="Pending">Pending</option>
                                <option value="Cash">Cash</option>
                                <option value="Card">Card</option>
                                <!-- <option value="Card Payment">Card Payment</option> -->
                                <option value="Online Transfer">Online Transfer</option>
                            </select>
                        </td>
                    </tr>
                    <tr style="background:#F60017; color:white;">
                        <th style="vertical-align: middle;">Invoice ID</th>
                        <th style="vertical-align: middle;">M.R. Number</th>
                        <th style="vertical-align: middle;">Invoice TimeStamp</th>
                        <th style="vertical-align: middle;">Invoice Date</th>
                        <th style="vertical-align: middle;">Doctor</th>
                        <th style="vertical-align: middle;">Procedures</th>
                        <th style="vertical-align: middle;">Charges</th>
                        <th style="vertical-align: middle;">Discount</th>
                        <th style="vertical-align: middle;">Total Amount</th>
                        <th style="vertical-align: middle;">Payment Mode</th>
                    </tr>
                </thead>
            <tbody>
                <?php foreach($allData as $value){?>
                <tr class="template">
                    <td class="patientId"><?=$value->bill_id_unique?></td>
                    <td class="patientContact"><?=$value->mr_number?></td>
                    <td class="patientEmail"><?=$value->bill_date?></td>
                    <td class="patientEmail"><?=date('Y-m-d',strtotime($value->bill_date))?></td>
                    <td class="patientAddress"><?=$value->doctor?></td>
                    <td class="patientnotes"><?=$value->procedures_with_amount?></td>
                    <td class="patientcreated"><?=$value->extra_charges?></td>
                    <td class="patientmodified"><?=$value->discount?></td>
                    <td class="patientmodified"><?=$value->total_amount?></td>
                    <td class="patientmodified"><?=$value->paymentmode?></td>
                </tr>
                <?php }?>
            </tbody>
            </table>
           
        </div>
    <!-- <script src="./assets/vendor/jquery/jquery-3.2.1.min.js"></script> -->
	<script src="./assets/sweetalert/sweetalert2@11.js"></script>


</body>
</html>
<?php include './footer.php';?>

    <script>
    var Table='';
      $(document).ready(function() {

        $.fn.dataTable.ext.search.push(
    function (settings, data, dataIndex) {
        var FilterStart = $('#filter_From').val();
        var FilterEnd = $('#filter_To').val();
        var DataTableStart = data[3].trim();
        if (FilterStart == '' || FilterEnd == '') {
            return true;
        }
        if (DataTableStart >= FilterStart && DataTableStart <= FilterEnd)
        {
            return true;
        }
        else {
            return false;
        }
        
    });

        Table= $('#patientsTable').DataTable( {
            dom: 'Bfrtip',
            "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
        buttons: [
            {
                extend: 'excelHtml5',
                exportOptions: {
                    columns: ':visible'
                }
            },
            'colvis',
            'pageLength'
        ]
        } );
    } );

     // Refilter the table
     $('#filter_From').change(function (e) {
        Table.draw();

        });
        $('#filter_To').change(function (e) {
            Table.draw();

        });

    function printSummary(){
		window.print();
	}

    sortPaymentBased= (value) =>{
        $('#patientsTable_filter input').val(value);
        $('#patientsTable_filter input').keyup();
    }
</script>
<style>
    .dataTables_filter input{
        border-radius: 5px;
        width: 400px;
        border: 1px solid grey;
        height: 30px;
    }

    
	@media print { 
        /* All your print styles go here */
            #patientsTable_paginate,.dataTables_info,.dt-buttons,.dataTables_filter,.htmlContent,.header,.footer { display: none !important; } 
            .printCSS{ display:block !important;width:100% }
            .container{width:100%;max-width: 100%;overflow: hidden;}
            .overflow{overflow: hidden !important;}
        }
        @page { size: auto;  margin: 0mm; }

        .overflow{
            overflow-x:scroll;
        }
</style>