<?php
    if (!isset($_GET['contact_number'])) {
        http_response_code(400);
        echo json_encode(["error" => "Missing 'contact_number' parameter"]);
        exit;
    }

    session_start();
    try {
        $activity="getting pending for a patient";
    
        $contact_number = $_GET['contact_number'];
        include '../database.php';
        // Query to fetch the pending amount
        $query = "SELECT SUM(pending) as total_pending FROM billing WHERE contact = :contact_number";
        $stmt = $connection->prepare($query);
        $stmt->bindParam(':contact_number', $contact_number, PDO::PARAM_STR);
        $stmt->execute();
    
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($result) {
            // Return the pending amount as a JSON response
            echo json_encode(["contact_number" => $contact_number, "total_pending" => $result['total_pending']]);
        } else {
            // If no record is found
            http_response_code(404);
            echo json_encode(["error" => "No record found for MR number: $contact_number"]);
        }
        

    }

    // show error
    catch(PDOException $exception){
        $logArray=array(
            "user_name" => isset($_SESSION["user_name"])? $_SESSION["user_name"] : "no user" ,
            "activity" => $activity,
            "status" => "Query Execution Failed",
        );
        die('ERROR: ' . $exception->getMessage());
    }

    // include '../../api/log/logApi.php';

?>