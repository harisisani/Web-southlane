<?php
session_start();
$activity="Adding a new patient";
$_POST = json_decode(file_get_contents('php://input'), true);
if($_POST){
    date_default_timezone_set("Asia/Karachi");
    // include database connection
    include '../database.php';


    try{

        // Get the maximum patient ID from the database
        $query = "SELECT MAX(mr_number) AS max_id FROM patients";
        $stmt = $connection->prepare($query);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $maxId = $result['max_id'];

        // Generate the new patient ID based on the maximum ID value
        if ($maxId === null) {
            $newId = 1;
        } else {
            $newId = $maxId + 1;
        }
        $newId=$newId+1000;
        // Format the new patient ID with the "PT" prefix
        $newPatientId = "PT " . str_pad($newId, 4, "0", STR_PAD_LEFT);

        // insert query
        $query = "INSERT INTO patients SET
        mr_id_unique='".$newPatientId."',
        patient_name='".$_POST['patientname']."',
        owner_name='".$_POST['ownername']."',
        owner_contact='".$_POST['contact']."',
        pet_notes='".$_POST['notes']."',
        owner_email='".$_POST['email']."',
        owner_address='".$_POST['address']."',
        patient_created_date='".date('Y-m-d H:i:s')."',
        patient_last_modified_date='".date('Y-m-d H:i:s')."',
        patient_last_modified_by='".$_SESSION["user_name"]."'";
        $stmt = $connection->prepare($query);

        if($stmt->execute()){
            // redirect to read records page and
                // tell the user record was deleted
                $logArray=array(
                    "user_name" => isset($_SESSION["user_name"])? $_SESSION["user_name"] : "no user" ,
                    "activity" => $activity,
                    "status" => "Successful",
                );
            echo "success^".$newPatientId;
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
        die('ERROR: ' . $exception->getMessage());
    }
}
    include '../../api/log/logApi.php';
?>
