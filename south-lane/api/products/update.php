<?php
session_start();
$activity="Updating a product";
include '../database.php';
try {
    $_POST = json_decode(file_get_contents('php://input'), true);
// Include database connection
date_default_timezone_set("Asia/Karachi");

// Get record ID
$id = isset($_GET['id']) ? $_GET['id'] : die('ERROR: Record ID not found.');

// Fetch existing product details to compare with new values
$existing_query = "SELECT vendor_id, stockinhand, cost FROM store WHERE id = ?";
$existing_stmt = $connection->prepare($existing_query);
$existing_stmt->bindParam(1, $id);
$existing_stmt->execute();
$existing_product = $existing_stmt->fetch(PDO::FETCH_ASSOC);

if (!$existing_product) {
    die('ERROR: Record not found.');
}

// Prepare update query
$query = "UPDATE store SET 
    name = '" . $_POST['name'] . "',
    category = '" . $_POST['category'] . "',
    vendor_id = '" . $_POST['vendor_id'] . "',
    stockinhand = '" . $_POST['stock_in_hand'] . "',
    price = '" . $_POST['price'] . "',
    cost = '" . $_POST['cost'] . "'
    WHERE id = ?";
$stmt = $connection->prepare($query);

// Bind the parameters
$stmt->bindParam(1, $id);

if ($stmt->execute()) {
    // Check if vendor_id, totalstock, or cost has changed
    $vendor_changed = $existing_product['vendor_id'] != $_POST['vendor_id'];
    $stock_changed = $existing_product['stockinhand'] != $_POST['stock_in_hand'];
    $cost_changed = $existing_product['cost'] != $_POST['cost'];

    // Handle vendor transaction updates
    if ($vendor_changed || $stock_changed) {
        $vendor_id = $_POST['vendor_id'];
        $quantity_difference = $_POST['stock_in_hand'] - $existing_product['stockinhand'];
        $payment_due = $quantity_difference * $_POST['cost'];

        // Insert or update vendor transaction
        // if ($quantity_difference > 0) {
            $transaction_query = "INSERT INTO VendorTransactions 
                                  SET 
                                      vendor_id = :vendor_id,
                                      item_id = :item_id,
                                      quantity_added = :quantity_added,
                                      payment_due = :payment_due,
                                      payment_status = 'Unpaid',
                                      transaction_date = NOW()";
            $transaction_stmt = $connection->prepare($transaction_query);
            $transaction_stmt->bindParam(':vendor_id', $vendor_id);
            $transaction_stmt->bindParam(':item_id', $id);
            $transaction_stmt->bindParam(':quantity_added', $quantity_difference);
            $transaction_stmt->bindParam(':payment_due', $payment_due);
            $transaction_stmt->execute();
        // }
    }

    // Log activity
    $logArray = array(
        "user_name" => isset($_SESSION["user_name"]) ? $_SESSION["user_name"] : "no user",
        "activity" => "Updated product and vendor transaction",
        "status" => "Successful",
    );
    // echo date('Y-m-d H:i:s');
} else {
    // Query failed
    $logArray = array(
        "user_name" => isset($_SESSION["user_name"]) ? $_SESSION["user_name"] : "no user",
        "activity" => "Update product",
        "status" => "Query Execution Failed",
    );
    // echo 'not updated';
}


}

// show error
catch(PDOException $exception){
    $logArray=array(
        "user_name" => isset($_SESSION["user_name"])? $_SESSION["user_name"] : "no user" ,
        "activity" => $activity,
        "status" => "POST failed",
    );
}

include '../../api/log/logApi.php';

?>