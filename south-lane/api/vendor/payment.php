<?php
session_start();
$activity="Updating a payment";
include '../database.php';
try {
    // $_POST = json_decode(file_get_contents('php://input'), true);
    
    // Get the POST data
    $id = isset($_POST['id']) ? $_POST['id'] : '';
    $paymentStatus = isset($_POST['paymentStatus']) ? $_POST['paymentStatus'] : '';

    if (!empty($id) && !empty($paymentStatus)) {
            // Validate the payment status
            if ($paymentStatus !== 'Cleared' && $paymentStatus !== 'Pending') {
                echo json_encode(['status' => 'error', 'message' => 'Invalid payment status']);
                exit;
            }

            // Update the payment status in the database
            try {
                $query = "UPDATE vendortransactions SET 
                                payment_status = ? 
                            WHERE id = ?";
                $stmt = $connection->prepare($query);

                // Bind the parameters
                $stmt->bindParam(1, $_POST['paymentStatus']);
                $stmt->bindParam(2, $id);

                if($stmt->execute()){
                    $logArray=array(
                        "user_name" => isset($_SESSION["user_name"])? $_SESSION["user_name"] : "no user" ,
                        "activity" => $activity,
                        "status" => "Successful",
                    );
                    // echo date('Y-m-d H:i:s');
                }

                if ($stmt->rowCount() > 0) {
                    echo json_encode(['status' => 'success', 'message' => 'Payment status updated successfully']);
                    $logArray=array(
                        "user_name" => isset($_SESSION["user_name"])? $_SESSION["user_name"] : "no user" ,
                        "activity" => $activity,
                        "status" => 'Payment status updated successfully',
                    );
                } else {
                    echo json_encode(['status' => 'error', 'message' => 'No matching transaction found']);
                    $logArray=array(
                        "user_name" => isset($_SESSION["user_name"])? $_SESSION["user_name"] : "no user" ,
                        "activity" => $activity,
                        "status" => 'No matching transaction found',
                    );
                }
            } catch (Exception $e) {
                echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
                $logArray=array(
                    "user_name" => isset($_SESSION["user_name"])? $_SESSION["user_name"] : "no user" ,
                    "activity" => $activity,
                    "status" => $e->getMessage(),
                );
            }
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Missing required parameters']);
            $logArray=array(
                "user_name" => isset($_SESSION["user_name"])? $_SESSION["user_name"] : "no user" ,
                "activity" => $activity,
                "status" => "Missing required parameters",
            );
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