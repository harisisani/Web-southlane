<?php
session_start();
$activity="Updating the inventory after billing";
include '../database.php';
try {
    $data = json_decode(file_get_contents("php://input"), true);
    // include database connection
    date_default_timezone_set("Asia/Karachi");
    // get record ID
    if (!$data || !isset($data['items']) || !is_array($data['items'])) {
        die('ERROR: Invalid JSON data.');
    }

   
    foreach ($data['items'] as $item) {
            
        // Prepare the query once, outside the loop
        $query = "UPDATE store 
        SET stockinhand = stockinhand - ".$item['qty'].", 
            soldstock = soldstock + ".$item['qty']." 
        WHERE id = ".$item['id'];
        $stmt = $connection->prepare($query);

        if($stmt->execute()){
             // Calculate payment due (cost * quantity sold)
        $getCostQuery = "SELECT cost FROM store WHERE id = :item_id";
        $costStmt = $connection->prepare($getCostQuery);
        $costStmt->bindParam(':item_id', $item['id'], PDO::PARAM_INT);
        $costStmt->execute();
        $itemCost = $costStmt->fetchColumn();
        $paymentDue = $itemCost * $item['qty'];

        // Record the transaction for the vendor
        $transactionQuery = "INSERT INTO Vendortransactions 
            (transactionId,vendor_id, item_id, quantity_sold, payment_due, payment_status, transaction_date) 
            VALUES 
            (:transactionId,:vendor_id, :item_id, :quantity_sold, :payment_due, 'Unpaid', :transaction_date)";
        $transactionStmt = $connection->prepare($transactionQuery);

        // Bind parameters for the vendor transaction query
        $transactionStmt->bindParam(':transactionId', $item['transactionId'], PDO::PARAM_STR);
        $transactionStmt->bindParam(':vendor_id', $item['vendorId'], PDO::PARAM_INT);
        $transactionStmt->bindParam(':item_id', $item['id'], PDO::PARAM_INT);
        $transactionStmt->bindParam(':quantity_sold', $item['qty'], PDO::PARAM_INT);
        $transactionStmt->bindParam(':payment_due', $paymentDue, PDO::PARAM_STR);
        $transactionStmt->bindParam(':transaction_date', $transactionDate, PDO::PARAM_STR);

        // Set transaction date
        $transactionDate = date('Y-m-d H:i:s');

            if ($transactionStmt->execute()) {
                // Log activity for vendor transaction
                $logArray=array(
                    "user_name" => isset($_SESSION["user_name"])? $_SESSION["user_name"] : "no user" ,
                    "activity" => $activity,
                    "status" => "Successful",
                );
            } else {
                // Log failure for vendor transaction
                $logArray=array(
                    "user_name" => isset($_SESSION["user_name"])? $_SESSION["user_name"] : "no user" ,
                    "activity" => $activity,
                    "status" => "Query Execution Failed",
                );
            }
            // echo date('Y-m-d H:i:s');
        }else{
            // echo 'not updated';
        }
    }

// Close the prepared statement

    

}

// show error
catch(PDOException $exception){
    $logArray=array(
        "user_name" => isset($_SESSION["user_name"])? $_SESSION["user_name"] : "no user" ,
        "activity" => $activity,
        "status" => "POST failed",
    );
    echo  $exception;
}

include '../../api/log/logApi.php';

?>