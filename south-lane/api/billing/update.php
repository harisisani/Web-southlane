<?php
session_start();

include '../database.php';
try {
    $_POST = json_decode(file_get_contents('php://input'), true);
    // include database connection
    date_default_timezone_set("Asia/Karachi");
    // get record ID
    $id=isset($_GET['id']) ? $_GET['id'] : die('ERROR: Record ID not found.');

    $updateType=$_POST['updateType'];
    if($updateType=="doctor"){
        $activity="Updating a doctor";
        $query = "UPDATE billing SET 
        doctor='".$_POST['doctor']."'
        WHERE bill_id_unique = ?";
    }else{
        $activity="Updating a pending amount";
        $query = "UPDATE billing SET 
        pending='".$_POST['pending']."'
        WHERE bill_id_unique = ?";
    }
    $stmt = $connection->prepare($query);

    // bind the parameters
    $stmt->bindParam(1, $id);
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