<?php
session_start();
$activity="Adding a new vendor";
// $_POST = json_decode(file_get_contents('php://input'), true);
if($_POST){
    // include database connection
    include '../database.php';
    try{
        // insert query
        $query = "INSERT INTO vendor SET name='".$_POST['vendor_name']."',contact='".$_POST['vendor_contact']."'";
        $stmt = $connection->prepare($query);

        if($stmt->execute()){
            // redirect to read records page and
                // tell the user record was deleted
                $logArray=array(
                    "user_name" => isset($_SESSION["user_name"])? $_SESSION["user_name"] : "no user" ,
                    "activity" => $activity,
                    "status" => "Successful",
                );
            echo "success";
        }else{
            // die('Unable to add record.');
            $logArray=array(
                "user_name" => isset($_SESSION["user_name"])? $_SESSION["user_name"] : "no user" ,
                "activity" => $activity,
                "status" => "Query Execution Failed",
            );
            echo "failure";
        }
    }

    // show error
    catch(PDOException $exception){
        echo "failure";
        $logArray=array(
            "user_name" => isset($_SESSION["user_name"])? $_SESSION["user_name"] : "no user" ,
            "activity" => $activity,
            "status" => "POST failed",
        );
        // die('ERROR: ' . $exception->getMessage());
    }
    }
    include '../../api/log/logApi.php';
    header("Location: ../../vendor.php");
?>
