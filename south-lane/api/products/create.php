<?php
session_start();
$activity="Adding a new vendor";
// $_POST = json_decode(file_get_contents('php://input'), true);
if($_POST){
    // include database connection
    include '../database.php';
    try{
        // insert query
        $query = "INSERT INTO store 
          SET 
              name = '".$_POST['product_name']."',
              category = '".$_POST['category']."',
              vendor_id = '".$_POST['vendor_id']."',
              stockinhand = '".$_POST['stockinhand']."',
              totalstock = '".$_POST['totalstock']."',
              soldstock = '".$_POST['soldstock']."',
              price = '".$_POST['price']."',
              cost = '".$_POST['cost']."'";
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
    header("Location: ../../store-products.php");
?>
