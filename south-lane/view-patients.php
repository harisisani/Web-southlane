<?php include './header.php'; ?>
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
	<title>Patients</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->
	<link rel="icon" type="image/png" href="./assets/images/icons/favicon.ico"/>
</head>
<body>
<script>
    function deletePatient(object){
        var tr=$(object).closest('tr');
        var id=$(tr).find('td.patientId').text();
        Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
        if (result.isConfirmed) {
            var settings = {
                "url": "./api/patients/delete.php?id="+id,
                "method": "get",
            };

            // window.location = 'delete.php?id=' + id;
            $.ajax(settings).done(function (response) {
                // console.log(response);
                Swal.fire(
                'Deleted!',
                'Your file has been deleted.',
                'success'
                );

            $(tr).remove();
            });
        }
        })
    }

var current_tr;
    function openUpdatePatient(object){
        var tr=$(object).closest('tr');
        $(tr).hide();
        var id=$(tr).find('td.patientId').text();
        var patientName=$(tr).find('td.patientName').text();
        var ownerName=$(tr).find('td.ownerName').text();
        var contact=$(tr).find('td.patientContact').text();
        var email=$(tr).find('td.patientEmail').text();
        var address=$(tr).find('td.patientAddress').text();
        var notes=$(tr).find('td.patientnotes').text();
        var patientcreated=$(tr).find('td.patientcreated').text();
        var patientmodified=$(tr).find('td.patientmodified').text();
        var patientuser=$(tr).find('td.patientuser').text();
        $(tr).attr("id","template");
        var updateRow='<tr id="clone-tr"><td style="text-align:center;" class="r1"><div class="add-remove-sign"><a href="javascript:void(0)" onclick="updatePatient(this)" class="add-arrow"><i class="material-icons check_box"></i></a></div></td><td style="text-align:center;" class="r1"><div class="add-remove-sign"><a href="javascript:void(0)" onclick="cancelUpdate(this)" class="add-arrow"><i class="material-icons dangerous"></i></a></div></td><td class="patientId">'+id+'</td><td><input type="text" class="input" name="updatePName" value="'+patientName+'" ></td><td><input type="text" class="input" name="updateOName" value="'+ownerName+'" ></td><td><input type="text" class="input" name="updatePContact" value="'+contact+'"></td><td><input type="text" class="input" name="updatePEmail" value="'+email+'"><td><input type="text" class="input" name="updatePAddress" value="'+address+'"></td><td><input type="text" class="input" name="updateNotes" value="'+notes+'"></td><td class="updatePatientcreated">'+patientcreated+'</td><td class="updatePatientmodified">'+patientmodified+'</td><td class="updatePatientuser">'+patientuser+'</td></tr>';
        $(tr).after(updateRow);
        current_tr=tr;
    }

    function updatePatient(object){
        var tr=$(object).closest('tr');
        var id=$(tr).find('td.patientId').text();
        var patientName=$("input[name='updatePName']").val();
        var ownerName=$("input[name='updateOName']").val();
        var contact=$("input[name='updatePContact']").val();
        var email=$("input[name='updatePEmail']").val();
        var address=$("input[name='updatePAddress']").val();
        var notes=$("input[name='updateNotes']").val();

        var Json = {
            patientName: patientName,
            ownerName: ownerName,
            contact: contact,
            email: email,
            address: address,
            notes: notes
        }
        var settings = {
            "url": "./api/patients/update.php?id="+id,
            "method": "POST",
            "timeout": 0,
            "headers": {
            "Content-Type": "application/json"
        },
            "data": JSON.stringify(Json),
        };

        $.ajax(settings).done(function (response) {
            // console.log(response);
            Swal.fire({
                position: 'top-end',
                icon: 'success',
                title: "Patient Details Updated",
                showConfirmButton: false,
                timer: 1500
            });
            $(current_tr).find('td.patientName').text(patientName);
            $(current_tr).find('td.ownerName').text(ownerName);
            $(current_tr).find('td.patientContact').text(contact);
            $(current_tr).find('td.patientEmail').text(email);
            $(current_tr).find('td.patientAddress').text(address);
            $(current_tr).find('td.patientnotes').text(notes);
            $(current_tr).find('td.patientmodified').text(response);
            $(current_tr).show();
            $(tr).remove();
        });

    }

    function cancelUpdate(object){
        var tr=$(object).closest('tr');
        $(tr).remove();
        $('tr#template').show();
        $('tr.template').removeAttr("id");
    }
</script>
        <div style="margin-top: 200px;" class="container">
            <div class="row">
                <div class="col">
                    <div class="section_title_container text-center">
                        <h2 class="section_title">View/Edit/Delete Patients</h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="container" style="margin-top:50px; overflow-x:scroll;">
            <table id="patientsTable" class="table table-bordered">
                <thead>
                    <tr style="background:#F60017; color:white;">
                        <th style="vertical-align: middle;">Edit</th>
                        <th style="vertical-align: middle;">Delete</th>
                        <th style="vertical-align: middle;">MR ID</th>
                        <th style="vertical-align: middle;">Patient Name</th>
                        <th style="vertical-align: middle;">Owner Name</th>
                        <th style="vertical-align: middle;">Owner Contact</th>
                        <th style="vertical-align: middle;">Owner Email</th>
                        <th style="vertical-align: middle;">Owner Address</th>
                        <th style="vertical-align: middle;">Notes</th>
                        <th style="vertical-align: middle;">Created Date</th>
                        <th style="vertical-align: middle;">Modified Date</th>
                        <th style="vertical-align: middle;">Modified By</th>
                    </tr>
                </thead>
            <tbody>
                <?php foreach($allData as $value){?>
                <tr class="template">
                    <td style="text-align:center;" class="r1">
                        <div class="add-remove-sign">
                            <a href="javascript:void(0)" onclick="openUpdatePatient(this)" class="add-arrow"><i class="material-icons border_color"></i></a>
                        </div>
                    </td>
                    <td style="text-align:center;">
                        <div class="add-remove-sign">
                            <a href="javascript:void(0)" onclick="deletePatient(this)" class="remove-arrow"><i class="material-icons">remove_circle</i></a>
                        </div>
                    </td>
                    <td class="patientId"><?=$value->mr_id_unique?></td>
                    <td class="patientName"><?=$value->patient_name?></td>
                    <td class="ownerName"><?=$value->owner_name?></td>
                    <td class="patientContact"><?=$value->owner_contact?></td>
                    <td class="patientEmail"><?=$value->owner_email?></td>
                    <td class="patientAddress"><?=$value->owner_address?></td>
                    <td class="patientnotes"><?=$value->pet_notes?></td>
                    <td class="patientcreated"><?=$value->patient_created_date?></td>
                    <td class="patientmodified"><?=$value->patient_last_modified_date?></td>
                    <td class="patientuser"><?=$value->patient_last_modified_by?></td>
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
      $(document).ready(function() {
        $('#patientsTable').DataTable( {
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
            'colvis',
            'pageLength'
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