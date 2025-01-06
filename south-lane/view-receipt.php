<?php 
include './header.php'; 
if (isset($_GET['contact_number'])) {
    $urlToHit=$_SERVER['SERVER_NAME'].'/south-lane/api/billing/read.php?contact_number='.urlencode($_GET['contact_number']);
    if (isset($_GET['pending']) && $_GET['pending']=="true") {
        $urlToHit.="&pending=true";
    }
}else{
    $urlToHit=$_SERVER['SERVER_NAME'].'/south-lane/api/billing/read.php';
    if (isset($_GET['pending']) && $_GET['pending']=="true") {
        $urlToHit.="?pending=true";
    }
}
?>
<?php
    $curl = curl_init();
    curl_setopt_array($curl, array(
    CURLOPT_URL => ($urlToHit),
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
    .edit-paragraph{
        padding: 5px;
        cursor: pointer;
    }

    .edit-paragraph:hover{
        font-weight: bold;
    }
</style>
<script>
    function editReceiptDetails(obj,tdClass){
        var currentTr=$(obj).closest("tr");
        var savevalue=$(currentTr).find('td.'+tdClass+' span.value').text();
        var saveHtml='<input type="text" value="'+savevalue+'" class="form-control value">';
        var buttonHtml='<p style="color:green;" onclick="saveBillingDetails(this,`'+tdClass+'`)" class="edit-paragraph">Save <i class="fa fa-copy"></i></p>';
        $(currentTr).find('td.'+tdClass).html(saveHtml);
        $(currentTr).find('td.'+tdClass+'_button').html(buttonHtml);
    }

    function saveBillingDetails(obj,tdClass){
        var currentTr=$(obj).closest("tr");
        var id =$(currentTr).find('td.bill_id_unique').text();
        var currentTr=$(obj).closest("tr");
        var newValue=$(currentTr).find('input.value').val();
        if(tdClass=='edit_doctor'){
            var Json = {
                updateType: "doctor",
                doctor: newValue,
            };
        }else{
            var Json = {
                updateType: "pending",
                pending: newValue,
            };
        }

        var settings = {
            "url": "./api/billing/update.php?id="+id,
            "method": "POST",
            "timeout": 0,
            "headers": {
            "Content-Type": "application/json"
        },
            "data": JSON.stringify(Json),
        };

        $.ajax(settings).done(function (response) {
            console.log(response);
            Swal.fire(
                'Good job',
                'Billings Details updated successfully',
                'success'
            )
            var newHtml='<span class="value">'+newValue+'</span>';
            var buttonHtml='<p style="color: #F60017;" onclick="editReceiptDetails(this,`'+tdClass+'`)" class="edit-paragraph">Edit <i class="fa fa-edit"></i></p>';
            $(currentTr).find('td.'+tdClass+'').html(newHtml);
            $(currentTr).find('td.'+tdClass+'_button').html(buttonHtml);
        });

    }
</script>
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
        <div style="margin-top: 200px;" class="container">
            <div class="row">
                <div class="col">
                    <div class="section_title_container text-center">
                        <h2 class="section_title">View Billings <?=$urlToHit?></h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="container" style="margin-top:50px; overflow-x:scroll;">
            <table id="patientsTable" class="table table-bordered">
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
                        <th style="vertical-align: middle;">Invoice TimeStamp</th>
                        <th style="vertical-align: middle;">Invoice Date</th>
                        <th style="vertical-align: middle;">Invoice ID</th>
                        <th style="vertical-align: middle;">Patient Name</th>
                        <th style="vertical-align: middle;">Owner Name</th>
                        <th style="vertical-align: middle;">Owner Contact</th>
                        <th style="vertical-align: middle;">Doctor</th>
                        <th style="vertical-align: middle;">Edit Doctor</th>
                        <th style="vertical-align: middle;">Procedures</th>
                        <th style="vertical-align: middle;">Sub-Total</th>
                        <th style="vertical-align: middle;">Discount</th>
                        <th style="vertical-align: middle;">Total Amount</th>
                        <th style="vertical-align: middle;">Pending</th>
                        <th style="vertical-align: middle;">Edit Pending</th>
                        <th style="vertical-align: middle;">Received</th>
                        <th style="vertical-align: middle;">Payment Mode</th>
                        <th style="vertical-align: middle;">Created By</th>
                        <th style="vertical-align: middle;">Print</th>
                    </tr>
                </thead>
            <tbody>
                <?php foreach($allData as $value){?>
                <tr class="template">
                    <td class="bill_stamp"><?=$value->bill_date?></td>
                    <td class="bill_date"><?=date('Y-m-d',strtotime($value->bill_date))?></td>
                    <td class="bill_id_unique"><?=$value->bill_id_unique?></td>
                    <td class="patient_name"><?=$value->patient_name?></td>
                    <td class="owner_name"><?=$value->owner_name?></td>
                    <td class="contact"><?=$value->contact?></td>
                    <td class="edit_doctor"><span class="value"><?=$value->doctor?></span></td>
                    <td class="edit_doctor_button"><p style="color: #F60017;" onclick="editReceiptDetails(this,'edit_doctor')" class="edit-paragraph">Edit <i class="fa fa-edit"></i></p></td>
                    <td class="procedures_with_amount"><?=$value->procedures_with_amount?></td>
                    <td class="extra_charges"><?=$value->extra_charges?></td>
                    <td class="discount"><?=$value->discount?></td>
                    <td class="total_amount"><?=$value->total_amount?></td>
                    <td class="amount_pending"><span class="value"><?=$value->pending?></span></td>
                    <td class="amount_pending_button"><p style="color: #F60017;" onclick="editReceiptDetails(this,'amount_pending')" class="edit-paragraph">Edit <i class="fa fa-edit"></i></p></td>
                    <td class="amount_received"><?=$value->received?></td>
                    <td class="user_name"><?=$value->paymentmode?></td>
                    <td class="user_name"><?=$value->user_name?></td>
                    <td class="user_name">
                        <button type="button" onclick='printLayout(this)' class="btn btn-success">Print</button>
                        <input type="hidden" class="htmlText" value="<?=$value->print_receipt?>">
                    </td>
                </tr>
                <?php }?>
            </tbody>
            </table>
        </div>
        <div class="container" style="margin-top:50px;">
            <div class="row">
                <div class="col">
                <table class="table">
                    <tbody>
                        <tr style="background:#F60017; color:white;">
                            <th colspan=2>
                                Total Closing Balance
                                <button style="float: right;" type="button" onclick="updateClosingTotals();" class="btn btn-success">Refresh Calculations</button>
                            </th>
                        </tr>
                        <tr>
                            <td scope="col">Sub-Total</td>
                            <td id="subTotal">0 PKR</td>
                        </tr>
                        <tr>
                            <td scope="col">Discount</td>
                            <td id="discount">0 PKR</td>
                        </tr>
                        <tr>
                            <td scope="col">Total Amounts</td>
                            <td id="total">0 PKR</td>
                        </tr>
                        <tr>
                            <td scope="col">Total Received</td>
                            <td id="received">0 PKR</td>
                        </tr>
                        <tr>
                            <td scope="col">Total Pending</td>
                            <td id="pending">0 PKR</td>
                        </tr>
                    </tbody>
                    </table>
                </div>
            </div>
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
    var Table='';
      $(document).ready(function() {

        $.fn.dataTable.ext.search.push(
    function (settings, data, dataIndex) {
        var FilterStart = $('#filter_From').val();
        var FilterEnd = $('#filter_To').val();
        var DataTableStart = data[1].trim();
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
                },


            },
            'colvis',
            'pageLength'
        ]
        } );


        // Refilter the table
        $('#filter_From').change(function (e) {
        Table.draw();
        updateClosingTotals();

        });
        $('#filter_To').change(function (e) {
            Table.draw();
            updateClosingTotals();

        });

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
<script>
    function updateClosingTotals(){
        var subTotal=0,discount=0,total=0,pending=0,received=0;
        $('tr.template').each(function (){
            subTotal+=parseFloat($(this).find('td.extra_charges').text());
            discount+=parseFloat($(this).find('td.discount').text());
            total+=parseFloat($(this).find('td.total_amount').text());
            received+=parseFloat($(this).find('td.amount_received').text());
            pending+=parseFloat($(this).find('td.amount_pending').text());
        });
        $('#subTotal').text(subTotal+" PKR");
        $('#discount').text(discount+" PKR");
        $('#total').text(total+" PKR");
        $('#pending').text(pending+" PKR");
        $('#received').text(received+" PKR");
        console.log("testing purpose");
    }
    updateClosingTotals();
    $( document ).ready(function() {
        $('.dataTables_filter input').keyup(function (){
            updateClosingTotals();
        });
    });


    function printLayout(obj){
        $('.printContent').html( $(obj).closest("tr").find('input.htmlText').val());
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
</style>
