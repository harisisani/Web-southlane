<?php 
include './header.php'; 
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
$procedures=json_decode($response);

?>
<title>Procedures</title>
<script src="./assets/sweetalert/sweetalert2@11.js"></script>
<script>

    function deleteProcedure(object){
        var tr=$(object).closest('tr');
        var id=$(tr).find('td.procedureId').text();
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
                "url": "./api/extras/delete.php?id="+id,
                "method": "get",
            };

            // window.location = 'delete.php?id=' + id;
            $.ajax(settings).done(function (response) {
                console.log(response);
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
    function openUpdateProcedure(object){
        var tr=$(object).closest('tr');
        $(tr).hide();
        var id=$(tr).find('td.procedureId').text();
        var name=$(tr).find('td.procedureName').text();
        var amount=$(tr).find('td.procedureAmount').text();
        $(tr).attr("id","template");
        var updateRow='<tr id="clone-tr"><td style="text-align:center;" class="r1"><div class="add-remove-sign"><a href="javascript:void(0)" onclick="updateProcedure(this)" class="add-arrow"><i class="material-icons check_box"></i></a></div></td><td style="text-align:center;" class="r1"><div class="add-remove-sign"><a href="javascript:void(0)" onclick="cancelUpdate(this)" class="add-arrow"><i class="material-icons dangerous"></i></a></div></td><td class="procedureId">'+id+'</td><td><input type="text" class="input" name="updatePName" value="'+name+'" ></td><td><input type="text" class="input" name="updatePAmount" value="'+amount+'"></td></tr>';
        $(tr).after(updateRow);
        current_tr=tr;
    }

    function updateProcedure(object){
        var tr=$(object).closest('tr');
        var id=$(tr).find('td.procedureId').text();
        console.log(id);
        var name=$("input[name='updatePName']").val();
        var amount=$("input[name='updatePAmount']").val();

        $(current_tr).find('td.procedureName').text(name);
        $(current_tr).find('td.procedureAmount').text(amount);

        var Json = {
            name: name,
            amount: amount
        };

        var settings = {
            "url": "./api/extras/update.php?id="+id,
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
                'Procedure has been updated successfully',
                'success'
            )
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
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" />
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons" />
<style>
        /*
    CSS for the main interaction
    */
    .tabset > input[type="radio"] {
    position: absolute;
    left: -200vw;
    }

    .tabset .tab-panel {
    display: none;
    }

    .tabset > input:first-child:checked ~ .tab-panels > .tab-panel:first-child,
    .tabset > input:nth-child(3):checked ~ .tab-panels > .tab-panel:nth-child(2),
    .tabset > input:nth-child(5):checked ~ .tab-panels > .tab-panel:nth-child(3),
    .tabset > input:nth-child(7):checked ~ .tab-panels > .tab-panel:nth-child(4),
    .tabset > input:nth-child(9):checked ~ .tab-panels > .tab-panel:nth-child(5),
    .tabset > input:nth-child(11):checked ~ .tab-panels > .tab-panel:nth-child(6) {
    display: block;
    }

    /*
    Styling
    */
    body {
    font: 16px/1.5em "Overpass", "Open Sans", Helvetica, sans-serif;
    color: #333;
    font-weight: 300;
    }

    .tabset > label {
    position: relative;
    display: inline-block;
    padding: 15px 15px 25px;
    border: 1px solid transparent;
    border-bottom: 0;
    cursor: pointer;
    font-weight: 600;
    }

    .tabset > label::after {
    content: "";
    position: absolute;
    left: 15px;
    bottom: 10px;
    width: 22px;
    height: 4px;
    background: #8d8d8d;
    }

    .tabset > label:hover,
    .tabset > input:focus + label {
    color: #06c;
    }

    .tabset > label:hover::after,
    .tabset > input:focus + label::after,
    .tabset > input:checked + label::after {
    background: #06c;
    }

    .tabset > input:checked + label {
    border-color: #ccc;
    border-bottom: 1px solid #fff;
    margin-bottom: -1px;
    }

    .tab-panel {
    padding: 30px 0;
    border-top: 1px solid #ccc;
    }

</style>
<div style="margin-top: 200px;" class="container htmlContent">
	<div class="row">
		<div class="col">
			<div class="section_title_container text-center">
				<h2 class="section_title">Extras</h2>
			</div>
		</div>
		
	</div>
</div>
<div class="tabset container">
  <!-- Tab 1 -->
  <input type="radio" name="tabset" id="tab1" aria-controls="marzen" checked>
  <label for="tab1">Add an Extra</label>
  <!-- Tab 2 -->
  <input type="radio" name="tabset" id="tab2" aria-controls="rauchbier">
  <label for="tab2">Extras</label>

  <div class="tab-panels">
    <section id="marzen" class="tab-panel">
        <form action="./api/extras/create.php" method="post">
            <div class="container">
                <table class="table table-bordered">
                    <tr>
                        <th colspan="4">Insert Extra</th>
                    </tr>
                    <tr>
                        <td>Extra Name</td>
                        <td><input type="text" class="form-control" name="pName"></td>
                        <td>Extra Amount</td>
                        <td><input type="text" class="form-control" name="pAmount"></td>
                    </tr>
                    <tr>
                        <td colspan="4" style="text-align:right;"><button onclick="createNewProcedure();" class="btn btn-success">SUBMIT</button></td>
                    </tr>
                </table>
            </div>
        </form>
    </section>
    <section id="rauchbier" class="tab-panel">
        <div class="container" style="margin-top:50px;">
            <table id="patientsTable" class="table table-bordered">
                <thead>
                    <tr>
                        <th colspan=8>
                            Patient's Data
                        </th>
                    </tr>
                    <tr>
                        <th>Edit</th>
                        <th>Delete</th>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Amount</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($procedures as $value){?>
                    <tr class="template">
                        <td style="text-align:center;" class="r1">
                            <div class="add-remove-sign">
                                <a href="javascript:void(0)" onclick="openUpdateProcedure(this)" class="add-arrow"><i class="material-icons border_color"></i></a>
                            </div>
                        </td>
                        <td style="text-align:center;">
                            <div class="add-remove-sign">
                                <a href="javascript:void(0)" onclick="deleteProcedure(this)" class="remove-arrow"><i class="material-icons">remove_circle</i></a>
                            </div>
                        </td>
                        <td class="procedureId"><?=$value->extra_id?></td>
                        <td class="procedureName"><?=$value->extra_name?></td>
                        <td class="procedureAmount"><?=$value->extra_amount?></td>
                    </tr>
                    <?php }?>
                </tbody>
            </table>
        </div>
    </section>
  </div>

</div>
<!-- Footer -->
<?php include './footer.php'; ?>