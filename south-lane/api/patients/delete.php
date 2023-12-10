<?php
session_start();
$activity="Deleting a new patient";
// Delete Patient query
try {
    // include database connection
    include '../database.php';

    // get record ID
    // isset() is a PHP function used to verify if a value is there or not
    $id=isset($_GET['id']) ? $_GET['id'] : die('ERROR: Record ID not found.');

    // delete query
    $query = "UPDATE patients SET deleted=1 WHERE mr_id_unique = ?";
    $stmt = $connection->prepare($query);
    $stmt->bindParam(1, $id);
    if($stmt->execute()){
        $logArray=array(
            "user_name" => isset($_SESSION["user_name"])? $_SESSION["user_name"] : "no user" ,
            "activity" => $activity,
            "status" => "Successful",
        );
    }else{
        $logArray=array(
            "user_name" => isset($_SESSION["user_name"])? $_SESSION["user_name"] : "no user" ,
            "activity" => $activity,
            "status" => "Query Execution Failed",
        );
    }
}

// show error
catch(PDOException $exception){
    die('ERROR: ' . $exception->getMessage());
}
include '../../api/log/logApi.php';
?>