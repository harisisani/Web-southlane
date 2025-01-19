<?php
// Delete Patient query
$activity="Deleting product";
    session_start();
try {
    // include database connection
    include '../database.php';

    // get record ID
    // isset() is a PHP function used to verify if a value is there or not
    $id=isset($_GET['id']) ? $_GET['id'] : die('ERROR: Record ID not found.');

    $query = "DELETE FROM vendortransactions WHERE item_id = ?";
    $stmt = $connection->prepare($query);
    $stmt->bindParam(1, $id);
    $stmt->execute();
    // delete query
    $query = "DELETE FROM store WHERE id = ?";
    $stmt = $connection->prepare($query);
    $stmt->bindParam(1, $id);
    if($stmt->execute()){
       
        $logArray=array(
            "user_name" => isset($_SESSION["user_name"])? $_SESSION["user_name"] : "no user" ,
            "activity" => $activity,
            "status" => "Successful",
        );
    }else{
        // die('Unable to delete record.');
        $logArray=array(
            "user_name" => isset($_SESSION["user_name"])? $_SESSION["user_name"] : "no user" ,
            "activity" => $activity,
            "status" => "Query Execution Failed",
        );
    }
}

// show error
catch(PDOException $exception){
    // die('ERROR: ' . $exception->getMessage());
    $logArray=array(
        "user_name" => isset($_SESSION["user_name"])? $_SESSION["user_name"] : "no user" ,
        "activity" => $activity,
        "status" => "Query Execution Failed",
    );
}

include '../../api/log/logApi.php';
?>