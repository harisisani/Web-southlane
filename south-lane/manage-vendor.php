<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<?php 
include './header.php'; 
if (isset($_GET['vendor_id'])) {
    $urlToHit=$_SERVER['SERVER_NAME'].'/south-lane/api/vendor/management.php?vendor_id='.urlencode($_GET['vendor_id']);
}else{
    $urlToHit=$_SERVER['SERVER_NAME'].'/south-lane/api/vendor/management.php';
    $vendorLabel ="All Vendors";
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
    if (isset($_GET['vendor_id'])) {
        foreach($allData as $value){
            $vendorLabel=$value->vendor_name."'s";
        }
    }
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
                        <h2 class="section_title"><?=isset($vendorLabel)? $vendorLabel : "No data found for" ?> Transactions</h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="container" style="margin-top:50px; overflow-x:scroll;">
            <table id="patientsTable" class="table table-bordered">
                <thead>
                    <tr>
                        <td>Start date:</td>
                        <td><input type="date" id="filter_From" name="min"></td>
                        <td>End date:</td>
                        <td><input type="date" id="filter_To" name="max"></td>
                        <td>Filter:</td>
                        <td colspan="2">
                            <select class="form-control" onchange="sortPaymentBased('paymentType', this.value);">
                                <option value="">Select</option>
                                <option value="Credit">Credit</option>
                                <option value="Debit">Debit</option>
                            </select>
                        </td>
                        <td colspan="2">
                            <select class="form-control" onchange="sortPaymentBased('paymentStatus', this.value);">
                                <option value="">Select</option>
                                <option value="Cleared">Cleared</option>
                                <option value="Pending">Pending</option>
                            </select>
                        </td>
                        <td colspan="2"><button type="button" onclick='printInvoice(this)' class="btn btn-success">Print Invoice</button></td>
                    </tr>
                    <tr style="background:#F60017; color:white;">
                        <th style="vertical-align: middle;">ID</th>
                        <th style="vertical-align: middle;">TimeStamp</th>
                        <th style="vertical-align: middle;">Transaction Date</th>
                        <th style="vertical-align: middle;">Transaction ID</th>
                        <th style="vertical-align: middle;">Vendor Name</th>
                        <th style="vertical-align: middle;">Item Name</th>
                        <th style="vertical-align: middle;">Qty Added</th>
                        <th style="vertical-align: middle;">Qty Sold</th>
                        <th style="vertical-align: middle;">Payment</th>
                        <th style="vertical-align: middle;">Status</th>
                        <th style="vertical-align: middle;">Type</th>
                        <th style="vertical-align: middle;">Pay</th>
                    </tr>
                </thead>
            <tbody>
                <?php 
                // echo '<pre>';
                //     print_r($allData);
                // echo '</pre>';
                foreach($allData as $value){?>
                <tr class="template">
                    <td class="bill_id_unique"><?=$value->id?></td>
                    <td class="bill_stamp"><?=$value->transaction_date?></td>
                    <td class="bill_date"><?=date('Y-m-d',strtotime($value->transaction_date))?></td>
                    <td class="trans_id"><?=$value->transactionId?>
                        <?php if(!empty($value->transactionId)){?>
                        <button type="button" onclick='showReceipt(this)' class="btn btn-success">View</button>
                        <input type="hidden" class="htmlText" value="<?=$value->print_receipt?>">
                        <?php }?>
                    </td>
                    <td class="vendor_name"><?=$value->vendor_name?></td>
                    <td class="owner_name"><?=$value->product_name?></td>
                    <td class="qty_added"><?=$value->quantity_added?></td>
                    <td class="qty_sold"><?=$value->quantity_sold?></td>
                    <td class="payment"><?=$value->payment_due?></td>
                    <td class="status"><?=$value->payment_status?></td>
                    <td class="type"><?=($value->quantity_sold > $value->quantity_added)? "Credit" :"Debit" ?></td>
                    <td>
                        <?php if($value->payment_status=="Pending"){?>
                            <button type="button" onclick='updatePaymentStatus(this,"<?=$value->id?>","Cleared")' class="btn btn-success">Pay Now</button>
                        <?php }?>

                        <?php if($value->payment_status=="Cleared"){?>
                            <button type="button" onclick='updatePaymentStatus(this,"<?=$value->id?>","Pending")' class="btn btn-danger">Mark Unpaid</button>
                        <?php }?>
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
                                <?=isset($vendorLabel)? $vendorLabel : "No data found for" ?> Summary
                                <button style="float: right;" type="button" onclick="updateSummary();" class="btn btn-success">Refresh Summary</button>
                            </th>
                        </tr>
                        <tr>
                            <td scope="col">Total Costing for Items</td>
                            <td id="total_costs">0 PKR</td>
                        </tr>
                        <tr>
                            <td scope="col">Total Costing for Sold Items</td>
                            <td id="total_sold_costs">0 PKR</td>
                        </tr>
                        <tr>
                            <td scope="col">Total Paid Costs</td>
                            <td id="total_paid_costs">0 PKR</td>
                        </tr>
                        <tr>
                            <td scope="col">Total Outstanding Costs</td>
                            <td id="total_outstanding_costs">0 PKR</td>
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
        updateSummary();

        });
        $('#filter_To').change(function (e) {
            Table.draw();
            updateSummary();

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
    function updateSummary(){
        var totalCost = 0;
        var totalSoldCost = 0;
        var totalPaidCost = 0;
        var totalOutstandingCost = 0;

        // Iterate over each row in the table with class 'template'
        $('tr.template').each(function() {
            var qtyAdded = parseInt($(this).find('.qty_added').text()) || 0;
            var qtySold = parseInt($(this).find('.qty_sold').text()) || 0;
            var paymentStatus = $(this).find('.status').text().trim();
            var payment =  parseInt($(this).find('.payment').text()) || 0;
            var type = $(this).find('.type').text().trim(); // Get the transaction type (Debit or Credit)

            // Only proceed if the type is 'Debit'
            if (type === "Debit") {
                // Calculate total cost for items (both added and sold)
                totalCost += payment
            }

            // Only proceed if the type is 'Credit'
            if (type === "Credit") {
                totalSoldCost += payment
            }

            // Calculate total paid cost (only if payment status is "Cleared")
            if (paymentStatus === 'Cleared') {
                totalPaidCost += payment
            }

            // Calculate total outstanding cost (only if payment status is "Pending")
            if (paymentStatus === 'Pending') {
                totalOutstandingCost += payment
            }
        });

        // Update the values in the summary table
        $('#total_costs').text(totalCost.toFixed(2) + ' PKR');
        $('#total_sold_costs').text(totalSoldCost.toFixed(2) + ' PKR');
        $('#total_paid_costs').text(totalPaidCost.toFixed(2) + ' PKR');
        $('#total_outstanding_costs').text(totalOutstandingCost.toFixed(2) + ' PKR');
    }
    updateSummary();
    $( document ).ready(function() {
        $('.dataTables_filter input').keyup(function (){
            updateSummary();
        });
    });


    function showReceipt(obj){
        $('.modal-body').html( $(obj).closest("tr").find('input.htmlText').val());
        $('#simpleModal').modal('show');
    }   
    
    function printInvoice(obj){
        let tableClone = $('table#patientsTable').clone(); // Clone the table to avoid modifying the original

        // Remove the first row (<tr>)
        tableClone.find('tr:first').remove();

        // Loop through each row to remove the first and fourth <td>, and all <th>
        tableClone.find('tr').each(function () {
            $(this).find('th:first').remove(); // Remove all <th> elements in the row
            $(this).find('td:first').remove(); // Remove the first <td>
            $(this).find('th').eq(2).remove(); // Remove the fourth <td> (index 2 is the new fourth after removing the first)
            $(this).find('td').eq(2).remove(); // Remove the fourth <td> (index 2 is the new fourth after removing the first)
            $(this).find('th').eq(7).remove(); // Remove the fourth <td> (index 2 is the new fourth after removing the first)
            $(this).find('td').eq(7).remove(); // Remove the fourth <td> (index 2 is the new fourth after removing the first)
        });

        // Set the modified table content to .printContent
        $('.printContent').html(tableClone.html());
        window.print();
    }

   // Object to store selected filter values
let filters = {
    paymentType: '',
    paymentStatus: ''
};

// Function to handle filtering
sortPaymentBased = (filterType, value) => {
    // Update the respective filter value in the object
    if (filterType === 'paymentType') {
        filters.paymentType = value;
    } else if (filterType === 'paymentStatus') {
        filters.paymentStatus = value;
    }

    // Combine the filter values
    let combinedFilter = [filters.paymentType, filters.paymentStatus]
        .filter(val => val !== '') // Remove empty values
        .join(' '); // Join with a space to apply both filters

    // Apply the combined filter to the table
    $('#patientsTable_filter input').val(combinedFilter);
    $('#patientsTable_filter input').keyup();
};

function updatePaymentStatus(obj,id, newStatus) {
    // Get the current URL of the browser
    var currentUrl = window.location.href;

    // Get the host (domain) part of the URL
    var currentHost = window.location.hostname;

    // Check if the host is 'localhost'
    if (currentHost === 'localhost') {
        var paymentApiURL = "http://localhost/Web-southlane/south-lane/api/vendor/payment.php";
    } else {
        var paymentApiURL = "https://www.southlaneanimalhospital.com/south-lane/api/vendor/payment.php";
    }
    
    // Send an AJAX request to update the payment status
    $.ajax({
        url: paymentApiURL, // PHP API endpoint
        type: 'POST',
        data: {
            id: id,
            paymentStatus: newStatus
        },
        success: function(response) {
            // Parse the response from PHP (assuming it's a JSON response)
            var result = JSON.parse(response);
            if(result.status === 'success') {
                // If the update was successful, update the button and the payment status
                if (newStatus === 'Cleared') {
                    // Change the button to 'Mark Unpaid'
                    $(obj).html('Mark Unpaid')
                        .attr('onclick', `updatePaymentStatus(this,"${id}", "Pending")`)
                        .removeClass('btn-success').addClass('btn-danger');
                        $(obj).closest('tr').find('.status').text("Cleared")
                } else {
                    // Change the button to 'Pay Now'
                    $(obj).html('Pay Now')
                        .attr('onclick', `updatePaymentStatus(this,"${id}", "Cleared")`)
                        .removeClass('btn-danger').addClass('btn-success');
                        $(obj).closest('tr').find('.status').text("Pending")
                }
                updateSummary();
            } else {
                // Handle error if needed
                alert('Failed to update payment status.');
            }
        },
        error: function(xhr, status, error) {
            alert('An error occurred: ' + error);
        }
    });
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

<div class="container mt-5">
    <!-- Modal -->
    <div class="modal fade" id="simpleModal" tabindex="-1" aria-labelledby="simpleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h5 class="modal-title" id="simpleModalLabel">Simple Modal</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <!-- Modal Body -->
                <div class="modal-body">
                </div>
                <!-- Modal Footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
