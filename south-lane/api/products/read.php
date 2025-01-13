<?php
$activity="Fetching product list";
    session_start();
    try {
        include '../database.php';
        $query = "SELECT store.*, vendor.name AS vendor_name 
          FROM store 
          INNER JOIN vendor 
          ON store.vendor_id = vendor.id";
        $stmt = $connection->prepare($query);
        $stmt->execute();
        $usersData = $stmt->fetchAll(PDO::FETCH_ASSOC);
        print_r(json_encode($usersData));
        $logArray=array(
            "user_name" => isset($_SESSION["user_name"])? $_SESSION["user_name"] : "no user" ,
            "activity" => $activity,
            "status" => "Successful",
        );
    }

    // show error
    catch(PDOException $exception){
        $logArray=array(
            "user_name" => isset($_SESSION["user_name"])? $_SESSION["user_name"] : "no user" ,
            "activity" => $activity,
            "status" => "Query Execution Failed",
        );
        // die('ERROR: ' . $exception->getMessage());
    }

    // include '../../api/log/logApi.php';

?>