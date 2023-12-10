<?php include './header.php'; ?>
<?php
    $curl = curl_init();
    curl_setopt_array($curl, array(
    CURLOPT_URL => $_SERVER['SERVER_NAME'].'/south-lane/api/voucher/read.php',
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
    function markAvailed(obj, id){
        var td = $(obj).closest("td").html("Availed")
        var settings = {
            "url": "./api/voucher/update.php?id="+id,
            "method": "GET",
            "timeout": 0
        };

        $.ajax(settings).done(function (response) {
            console.log(response);
            Swal.fire(
                'Good job',
                'Voucuer availed successfully',
                'success'
            )
        });

    }
</script>
<?php
include './header.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Vouchers</title>
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
                        <h2 class="section_title">View Vouchers</h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="container" style="margin-top:50px; overflow-x:scroll;">
            <table id="patientsTable" class="table table-bordered">
                <thead>
                    <tr>
                        <td colspan=3></td>
                        <td>Start date:</td>
                        <td><input type="date" id="filter_From" name="min"></td>
                        <td>End date:</td>
                        <td><input type="date" id="filter_To" name="max"></td>
                    </tr>
                    <tr style="background:#F60017; color:white;">
                        <th style="vertical-align: middle;">Voucher TimeStamp</th>
                        <th style="vertical-align: middle;">Voucher Issue Date</th>
                        <th style="vertical-align: middle;">Voucher ID</th>
                        <th style="vertical-align: middle;">Patient Name</th>
                        <th style="vertical-align: middle;">Owner Name</th>
                        <th style="vertical-align: middle;">Owner Contact</th>
                        <th style="vertical-align: middle;">Status</th>
                    </tr>
                </thead>
            <tbody>
                <?php foreach($allData as $value){?>
                <tr class="template">
                    <td class="bill_stamp"><?=$value->voucher_created_date?></td>
                    <td class="bill_date"><?=date('Y-m-d',strtotime($value->voucher_created_date))?></td>
                    <td class="bill_id_unique"><?=$value->voucher_id_unique?></td>
                    <td class="patient_name"><?=$value->patient_name?></td>
                    <td class="owner_name"><?=$value->owner_name?></td>
                    <td class="contact"><?=$value->contact?></td>
                    <?php if($value->status=="Available"){?>
                        <td class="user_name">
                        <button type="button" onclick='markAvailed(this,"<?=$value->voucher_id?>")' class="btn btn-success">Mark Availed</button>
                    </td>
                    <?php
                    }
                    else{?>
                        <td class="contact">Availed</td>
                    <?php
                    }?>
                    
                </tr>
                <?php }?>
            </tbody>
            </table>
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