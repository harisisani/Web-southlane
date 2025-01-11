<?php
session_start();
$activity="Adding a new bill";
$_POST = json_decode(file_get_contents('php://input'), true);
if($_POST){
    date_default_timezone_set("Asia/Karachi");
    // include database connection
    include '../database.php';

    try{

        // Get the maximum billing ID from the database
        $query = "SELECT MAX(bill_id) AS max_id FROM billing";
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

        // Format the new patient ID with the "PT" prefix
        $newBillId = "INV " . str_pad($newId, 4, "0", STR_PAD_LEFT);
        

        // insert query
        $query = "INSERT INTO billing SET
        bill_id_unique='".$newBillId."',
        patient_name='".$_POST['patientname']."',
        mr_number='".$_POST['mr_number']."',
        owner_name='".$_POST['ownername']."',
        contact='".$_POST['contact']."',
        doctor='".$_POST['doctor']."',
        paymentmode='".$_POST['paymentmode']."',
        procedures_with_amount='".$_POST['procedures_with_amount']."',
        extra_charges='".$_POST['extra_charges']."',
        discount='".$_POST['discount']."',
        total_amount='".$_POST['total_amount']."',
        pending='".$_POST['pending']."',
        received='".$_POST['received']."',
        bill_date='".date('Y-m-d H:i:s')."',
        user_name='".$_SESSION["user_name"]."'";
        $stmt = $connection->prepare($query);
        $sendSms=true;
        if($_POST['sendsms']=="no"){
            $sendSms=false;
        }
        if($stmt->execute()){
            if($sendSms){
                $sms_text="Greetings ".$_POST['ownername']."!\n";
                $sms_text.="Thank you for visiting South Lane Animal Hospital.\n";
                if($_POST['paymentmode']!="Pending"){
                    $sms_text.="Your bill is Rs.".$_POST['total_amount']." (Invoice ID. ".$newBillId.").\n\n";
                }else{
                    $sms_text.="Your pending bill amount is Rs.".$_POST['total_amount']." (Invoice ID. ".$newBillId.").\n\n";
                }
                $sms_text.="Take Care of ".$_POST['patientname']."\n";
                $sms_text.="M.R #: ".$_POST['mr_number']."\n\n";
                $sms_text.="For Online Appointment & Tracking Patient's History: shorturl.at/cjouF";
                $paymentArray=array(
                    "mr_number" => $_POST['mr_number'],
                    "contact"   => $_POST['contact'],
                    "sms_text"  => $sms_text,
                );
                $curl = curl_init();
                $_SERVER['SERVER_NAME'] = ($_SERVER['SERVER_NAME'] =="localhost")? $_SERVER['SERVER_NAME']."/Web-southlane/" : "https://".$_SERVER['SERVER_NAME'];
                $apiURL=$_SERVER['SERVER_NAME'].'/south-lane/api/sms/send-single.php';
                curl_setopt_array($curl, array(
                    CURLOPT_URL =>  $apiURL,
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => '',
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 0,
                    CURLOPT_FOLLOWLOCATION => true,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => 'POST',
                    CURLOPT_POSTFIELDS => json_encode($paymentArray),
                    CURLOPT_HTTPHEADER => array(
                        'Content-Type: application/json'
                    ),
                ));
                $response = curl_exec($curl);
                curl_close($curl);
            }
            // redirect to read records page and
                // tell the user record was deleted
                $logArray=array(
                    "user_name" => isset($_SESSION["user_name"])? $_SESSION["user_name"] : "no user" ,
                    "activity" => $activity,
                    "status" => "Successful",
                );
            echo 'success^'.date('Y-m-d H:i:s')."^".$newBillId;
            //clear previous pendings
            $contact = $_POST['contact'];
$previousQuery = "SELECT SUM(pending) as total_pending FROM billing WHERE contact = :contact";
$stmt = $connection->prepare($previousQuery);
$stmt->bindParam(':contact', $contact, PDO::PARAM_STR);
$stmt->execute();

$result = $stmt->fetch(PDO::FETCH_ASSOC);
if ($result) {
    $pendingAmounts = $result['total_pending'];
    if ($pendingAmounts > 0) {
        // Calculate the current bill total
        $currentBillTotal = $_POST['extra_charges'] - $_POST['discount'];
        $extraMoneyReceived = $_POST['received'] - $currentBillTotal;
        if ($extraMoneyReceived > 0) {
            // Logic to clear pending amounts using the extra money
            $clearPendingsQuery = "SELECT * FROM billing WHERE contact = :contact AND pending > 0 ORDER BY bill_id ASC";
            $stmtClear = $connection->prepare($clearPendingsQuery);
            $stmtClear->bindParam(':contact', $contact, PDO::PARAM_STR);
            $stmtClear->execute();

            $pendingRecords = $stmtClear->fetchAll(PDO::FETCH_ASSOC);

            foreach ($pendingRecords as $record) {
                if ($extraMoneyReceived <= 0) {
                    break; // Stop if no extra money is left
                }

                $pending = $record['pending'];
                $billId = $record['bill_id'];

                if ($extraMoneyReceived >= $pending) {
                    // Fully clear this pending amount
                    $updateQuery = "UPDATE billing SET pending = 0 WHERE bill_id = :bill_id";
                    $stmtUpdate = $connection->prepare($updateQuery);
                    $stmtUpdate->bindParam(':bill_id', $billId, PDO::PARAM_INT);
                    $stmtUpdate->execute();

                    // Deduct the cleared amount from extra money
                    $extraMoneyReceived -= $pending;
                } else {
                    // Partially clear this pending amount
                    $remainingPending = $pending - $extraMoneyReceived;
                    $updateQuery = "UPDATE billing SET pending = :remaining_pending WHERE bill_id = :bill_id";
                    $stmtUpdate = $connection->prepare($updateQuery);
                    $stmtUpdate->bindParam(':remaining_pending', $remainingPending, PDO::PARAM_INT);
                    $stmtUpdate->bindParam(':bill_id', $billId, PDO::PARAM_INT);
                    $stmtUpdate->execute();

                    // All extra money has been used
                    $extraMoneyReceived = 0;
                }
            }
        }
        }
    }

        


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
