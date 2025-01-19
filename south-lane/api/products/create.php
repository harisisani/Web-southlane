<?php
session_start();
$activity="Adding a new products";
// $_POST = json_decode(file_get_contents('php://input'), true);
if($_POST){
    // include database connection
    include '../database.php';
    try{
        $query = "INSERT INTO store 
        SET 
            name = '".$_POST['product_name']."',
            category = '".$_POST['category']."',
            vendor_id = '".$_POST['vendor_id']."',
            stockinhand = '".$_POST['stockinhand']."',
            price = '".$_POST['price']."',
            cost = '".$_POST['cost']."'";
            $stmt = $connection->prepare($query);

            if ($stmt->execute()) {
                $logArray = array(
                    "user_name" => isset($_SESSION["user_name"]) ? $_SESSION["user_name"] : "no user",
                    "activity" => "Added store product",
                    "status" => "Successful",
                );
                // Record added successfully in the store table
                $new_store_id = $connection->lastInsertId(); // Get the ID of the newly added product
                // Calculate payment due
                $vendor_id = $_POST['vendor_id'];
                $quantity_added = $_POST['stockinhand'];
                $payment_due = $quantity_added * $_POST['cost']; // Assuming cost is the vendor's cost price

                // Insert vendor transaction
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
                $transaction_stmt->bindParam(':item_id', $new_store_id);
                $transaction_stmt->bindParam(':quantity_added', $quantity_added);
                $transaction_stmt->bindParam(':payment_due', $payment_due);

                if ($transaction_stmt->execute()) {
                    // echo "Store product and vendor transaction added successfully.";
                    $logArray = array(
                        "user_name" => isset($_SESSION["user_name"]) ? $_SESSION["user_name"] : "no user",
                        "activity" => "Added store product and vendor transaction",
                        "status" => "Successful",
                    );
                } else {
                    // echo "Store product added, but vendor transaction failed.";
                    $logArray = array(
                        "user_name" => isset($_SESSION["user_name"]) ? $_SESSION["user_name"] : "no user",
                        "activity" => "Add store product",
                        "status" => "Query Execution Failed",
                    );
                }
            }
    }

    // show error
    catch(PDOException $exception){
        // echo "failure";
        $logArray=array(
            "user_name" => isset($_SESSION["user_name"])? $_SESSION["user_name"] : "no user" ,
            "activity" => $activity,
            "status" => "POST failed",
        );
        // die('ERROR: ' . $exception->getMessage());
    }
    }else{
        $logArray=array(
            "user_name" => isset($_SESSION["user_name"])? $_SESSION["user_name"] : "no user" ,
            "activity" => $activity,
            "status" => "POST failed",
        );
    }
  
    include '../../api/log/logApi.php';
    header("Location: ../../store-products.php");
?>
