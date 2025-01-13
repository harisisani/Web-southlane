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
            $logArray=array(
                "user_name" => isset($_SESSION["user_name"])? $_SESSION["user_name"] : "no user" ,
                "activity" => $activity,
                "status" => "Successful",
            );
            echo date('Y-m-d H:i:s');
        }else{
            $logArray=array(
                "user_name" => isset($_SESSION["user_name"])? $_SESSION["user_name"] : "no user" ,
                "activity" => $activity,
                "status" => "Query Execution Failed",
            );
            echo 'not updated';
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
}

include '../../api/log/logApi.php';

?>