<?php
session_start();
$activity="Sending a receive message to: ";
$_POST = json_decode(file_get_contents('php://input'), true);
if($_POST){
    $activity.=$_POST['mr_number'];
    date_default_timezone_set("Asia/Karachi");
    // include database connection
    include '../database.php';
    try{
    // Configuration variables
    $type = "xml";
    $id = "rchsouthlane";
    $pass = "hospital@122";
    $lang = "English";
    $mask = "SouthLane";
    // Data for text message
    $to = str_replace(" ","","92".ltrim($_POST['contact'], "0"));
    $message = $_POST['sms_text'];
    $message = urlencode($message);
    // Prepare data for POST request
    $data = "id=".$id."&pass=".$pass."&msg=".$message."&to=".$to."&lang=".$lang."&mask=".$mask."&type=".$type;
    // Send the POST request with cURL
    $ch = curl_init('https://www.outreach.pk/api/sendsms.php/sendsms/url');
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $result = curl_exec($ch);
    print_r($result); //This is the result from Outreach
    curl_close($ch);
        if(!empty($result)){
            // redirect to read records page and
                // tell the user record was deleted
                $logArray=array(
                    "user_name" => isset($_SESSION["user_name"])? $_SESSION["user_name"] : "no user" ,
                    "activity" => $activity,
                    "status" => "Successful",
                );
            echo 'success';
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

?>
