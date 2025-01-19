<?php 
include './header.php'; 
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
$products=json_decode($response);

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => $_SERVER['SERVER_NAME'].'/south-lane/api/vendor/read.php',
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
$vendors=json_decode($response);


?>
<title>Products</title>
<script src="./assets/sweetalert/sweetalert2@11.js"></script>
<script>
    function searchProduct() {
        var searchTerm = $('#searchInput').val().toLowerCase(); // Get the search term and convert it to lowercase

        $('#patientsTable tbody tr').each(function() {
            var rowText = $(this).text().toLowerCase(); // Get the text of each row and convert it to lowercase

            if (rowText.indexOf(searchTerm) !== -1) {
                $(this).show(); // Show the row if it matches the search term
            } else {
                $(this).hide(); // Hide the row if it doesn't match the search term
            }
        });
    }

    function deleteProduct(object){
        var tr=$(object).closest('tr');
        var id=$(tr).find('td.productId').text();
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
                "url": "./api/products/delete.php?id="+id,
                "method": "get",
            };

            // window.location = 'delete.php?id=' + id;
            $.ajax(settings).done(function (response) {
                console.log(response);
                Swal.fire(
                'Deleted!',
                'Your product has been deleted.',
                'success'
                );

            $(tr).remove();
            });
        }
        })
    }

    var current_tr;
    function openUpdateProduct(object) {
        var tr = $(object).closest('tr');
        $(tr).hide();
        
        var id = $(tr).find('td.productId').text();
        var name = $(tr).find('td.productName').text();
        var category = $(tr).find('td.productCategory').text();
        var vendorId = $(tr).find('td.vendorId').text(); // Assuming vendor ID is stored in a hidden column or dataset
        var stockInHand = $(tr).find('td.stockInHand').text();
        var totalStock = $(tr).find('td.totalStock').text();
        var soldStock = $(tr).find('td.soldStock').text();
        var price = $(tr).find('td.productPrice').text();
        var cost = $(tr).find('td.productCost').text();
        
        $(tr).attr("id", "template");
        
        // Vendor dropdown options
        var vendorOptions = `
            <?php foreach ($vendors as $value) { ?>
                <option value="<?=$value->id?>" ${vendorId == <?=$value->id?> ? 'selected' : ''}>
                    <?=$value->name?>
                </option>
            <?php } ?>
        `;

        var updateRow = `
            <tr id="clone-tr">
                <td style="text-align:center;" class="r1">
                    <div class="add-remove-sign">
                        <a href="javascript:void(0)" onclick="updateProduct(this)" class="add-arrow">
                            <i class="material-icons check_box"></i>
                        </a>
                    </div>
                </td>
                <td style="text-align:center;" class="r1">
                    <div class="add-remove-sign">
                        <a href="javascript:void(0)" onclick="cancelUpdate(this)" class="add-arrow">
                            <i class="material-icons dangerous"></i>
                        </a>
                    </div>
                </td>
                <td class="productId">${id}</td>
                <td><input style="width:150px; type="text" class="input" name="updateProductName" value="${name}" ></td>
                <td><input style="width:150px; type="text" class="input" name="updateProductCategory" value="${category}" ></td>
                <td>
                    <select style="width:150px;" required class="form-control" name="updateVendorId">
                        ${vendorOptions}
                    </select>
                </td>
                <td><input style="width:75px;" type="number" class="input" name="updateStockInHand" value="${stockInHand}" ></td>
                <td>${totalStock}</td>
                <td>${soldStock}</td>
                <td><input style="width:75px;" type="number" class="input" name="updateProductPrice" step="0.01" value="${price}" ></td>
                <td><input style="width:75px;" type="number" class="input" name="updateProductCost" step="0.01" value="${cost}" ></td>
            </tr>`;
        
        $(tr).after(updateRow);
        current_tr = tr;
    }

    function updateProduct(object) {
        var tr = $(object).closest('tr'); // The editing row
        var id = $(tr).find('td.productId').text();
        console.log(id);

        // Fetch updated values from input fields
        var name = $("input[name='updateProductName']").val();
        var category = $("input[name='updateProductCategory']").val();
        var vendorId = $("select[name='updateVendorId']").val();
        var vendorName = $("select[name='updateVendorId'] option:selected").text();
        var stockInHand = $("input[name='updateStockInHand']").val();
        // var totalStock = $("input[name='updateTotalStock']").val();
        // var soldStock = $("input[name='updateSoldStock']").val();
        var price = $("input[name='updateProductPrice']").val();
        var cost = $("input[name='updateProductCost']").val();

        if (name === "" || category === "" || vendorId === "" || price === "" || cost === "") {
            Swal.fire(
                'Error!',
                'Fil out the required fields, name, category, vendor, price & cost are required',
                'error'
            );
        }else{
            // Update the original row with the new values
            $(current_tr).find('td.productName').text(name);
            $(current_tr).find('td.productCategory').text(category);
            $(current_tr).find('td.vendorId').text(vendorId); // Update vendor ID
            $(current_tr).find('td.vendorName').text(vendorName); // Update vendor Name
            $(current_tr).find('td.stockInHand').text(stockInHand);
            // $(current_tr).find('td.totalStock').text(totalStock);
            // $(current_tr).find('td.soldStock').text(soldStock);
            $(current_tr).find('td.productPrice').text(parseFloat(price).toFixed(2));
            $(current_tr).find('td.productCost').text(parseFloat(cost).toFixed(2));
            $(current_tr).find('td.productProfit').text((parseFloat(price) - parseFloat(cost)).toFixed(2));

    
            // Create JSON object for the API request
            var Json = {
                name: name,
                category: category,
                vendor_id: vendorId,
                stock_in_hand: stockInHand,
                // total_stock: totalStock,
                // sold_stock: soldStock,
                price: price,
                cost: cost
            };
    
            // AJAX settings
            var settings = {
                "url": "./api/products/update.php?id=" + id,
                "method": "POST",
                "timeout": 0,
                "headers": {
                    "Content-Type": "application/json"
                },
                "data": JSON.stringify(Json),
            };
    
            // Make the AJAX request
            $.ajax(settings).done(function (response) {
                console.log(response);
                Swal.fire(
                    'Good job!',
                    'Product has been updated successfully.',
                    'success'
                );
    
                // Show the original row and remove the editing row
                $(current_tr).show();
                $(tr).remove();
            }).fail(function (jqXHR, textStatus, errorThrown) {
                Swal.fire(
                    'Error!',
                    'Failed to update the product. Please try again.',
                    'error'
                );
                console.error("Error: ", textStatus, errorThrown);
            });
        }
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
				<h2 class="section_title">Store Products</h2>
			</div>
		</div>
		
	</div>
</div>
<div class="tabset container">
  <!-- Tab 1 -->
  <input type="radio" name="tabset" id="tab1" aria-controls="marzen" checked>
  <label for="tab1">Add a New Product</label>
  <!-- Tab 2 -->
  <input type="radio" name="tabset" id="tab2" aria-controls="rauchbier">
  <label for="tab2">Store Products</label>

  <div class="tab-panels">
    <section id="marzen" class="tab-panel">
        <form action="./api/products/create.php" method="post">
            <div class="container">
                <table class="table table-bordered">
                    <tr>
                        <th colspan="4">Insert Products</th>
                    </tr>
                    <tr>
                        <td>Vendor*</td>
                        <td>
                            <select required class="form-control" name="vendor_id">
                                <option value="">Select Vendor</option>
                                <?php foreach($vendors as $value){?>
                                    <option value="<?=$value->id?>"><?=$value->name?></option>
                                <?php }?>
                            </select>
                        </td>
                        <td>Product Name*</td>
                        <td><input required type="text" class="form-control" name="product_name"></td>
                    </tr>
                    <tr>
                        <td>Category*</td>
                        <td><input required type="text" class="form-control" name="category"></td>
                        <td>Stock Added*</td>
                        <td><input required type="number" class="form-control" name="stockinhand" value=""></td>
                    </tr>
                    <tr style="display:none;">
                        <td>Total Stock</td>
                        <td><input type="number" class="form-control" name="totalstock" value="0"></td>
                        <td>Sold Stock</td>
                        <td><input type="number" class="form-control" name="soldstock" value="0"></td>
                    </tr>
                    <tr>
                        <td>Selling Price*</td>
                        <td><input required type="number" step="0.01" class="form-control" name="price"></td>
                        <td>Buying Cost*</td>
                        <td><input required type="number" step="0.01" class="form-control" name="cost"></td>
                    </tr>
                    <tr>
                        <td colspan="4" style="text-align:right;"><button class="btn btn-success">SUBMIT</button></td>
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
                    <th colspan="6">
                        Products Data
                    </th>
                    <th colspan="6">
                        <input id="searchInput" onkeyup="searchProduct()" placeholder="Search Product" class="form-control" type="text">
                    </th>
                </tr>
                <tr>
                    <th>Edit</th>
                    <th>Cancel</th>
                    <th>ID</th>
                    <th>Product Name</th>
                    <th>Category</th>
                    <th style="width:200px;">Vendor Name</th>
                    <th style="width:50px;">Stock in Hand</th>
                    <th style="width:50px;">Total Stock</th>
                    <th style="width:50px;">Sold Stock</th>
                    <th style="width:50px;">Price</th>
                    <th style="width:50px;">Cost</th>
                    <th style="width:50px;">Profit</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($products as $product) { ?>
                <tr class="template">
                    <td style="text-align:center;" class="r1">
                        <div class="add-remove-sign">
                            <a href="javascript:void(0)" onclick="openUpdateProduct(this)" class="add-arrow">
                                <i class="material-icons border_color"></i>
                            </a>
                        </div>
                    </td>
                    <td style="text-align:center;">
                        <!-- <div class="add-remove-sign">
                            <a href="javascript:void(0)" onclick="deleteProduct(this)" class="remove-arrow">
                                <i class="material-icons">remove_circle</i>
                            </a>
                        </div> -->
                    </td>
                    <td class="productId"><?= $product->id ?></td>
                    <td class="productName"><?= $product->name ?></td>
                    <td class="productCategory"><?= $product->category ?></td>
                    <td class="vendorName"><?= $product->vendor_name ?></td>
                    <td style="display:none;" class="vendorId"><?= $product->vendor_id ?></td>
                    <td class="stockInHand"><?= $product->stockinhand ?></td>
                    <td class="totalStock"><?= $product->totalstock ?></td>
                    <td class="soldStock"><?= $product->soldstock ?></td>
                    <td class="productPrice"><?= $product->price ?></td>
                    <td class="productCost"><?= $product->cost ?></td>
                    <td class="productProfit"><?= $product->profit ?></td>
                </tr>
                <?php } ?>
            </tbody>

                </tbody>
            </table>
        </div>
    </section>
  </div>

</div>
<!-- Footer -->
<?php include './footer.php'; ?>