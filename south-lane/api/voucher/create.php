<?php
session_start();
$activity="Adding a new bill";
$_POST = json_decode(file_get_contents('php://input'), true);
function get_initials($name) {
    $initials = '';
    $words = explode(' ', $name);
    foreach ($words as $word) {
        $initials .= strtoupper(substr($word, 0, 1));
    }
    return $initials;
}
if($_POST){
    date_default_timezone_set("Asia/Karachi");
    // include database connection
    include '../database.php';
    try{
        $query = "SELECT * FROM vouchers WHERE contact=:contact";
        $stmt = $connection->prepare($query);
        $stmt->bindParam(':contact', $_POST['contact']);
        $stmt->execute();
        $existingData = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if(count($existingData) > 0){
            // entry with the same contact number already exists
            echo 'contactexists^'.date('Y-m-d H:i:s')."^Entry with the same contact number already exists.";
        } else {
            // entry with the same contact number does not exist, proceed with insertion
            $query = "SELECT COUNT(*) as total FROM vouchers";
            $stmt = $connection->prepare($query);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            $id = $result['total'] + 1;
            if($id < 10){
                $newBillId="100".$id;
            } else if($id < 100){
                $newBillId="10".$id;
            } else if($id < 1000){
                $newBillId="1".$id;
            } else {
                $newBillId=$id;
            }
            $newBillId="SLAH-".get_initials($_POST['patientname'])."-".get_initials($_POST['ownername'])."-".$newBillId;
            $status="Available" ;
            // insert query
            $query = "INSERT INTO vouchers SET
            voucher_id_unique='".$newBillId."',
            patient_name='".$_POST['patientname']."',
            mr_number='".$_POST['mr_number']."',
            owner_name='".$_POST['ownername']."',
            contact='".$_POST['contact']."',
            email='".$_POST['email']."',
            voucher_created_date='".date('Y-m-d H:i:s')."',
            status='".$status."'";
            $stmt = $connection->prepare($query);

            if($stmt->execute()){
                // redirect to read records page and
                // tell the user record was added successfully
                $logArray=array(
                    "user_name" => isset($_SESSION["user_name"])? $_SESSION["user_name"] : "no user" ,
                    "activity" => $activity,
                    "status" => "Successful",
                );
                echo 'success^'.date('Y-m-d H:i:s')."^".$newBillId;

                $sms_text="Congratulations ".$_POST['ownername']."!\n\n";
                $sms_text.="You can now avail 50% OFF on Exclusive Grooming Session at South Lane Animal Hospital\n\n";
                $sms_text.="Voucher No.\n".$newBillId."\n";
                $sms_text.="Valid Till: 31st July 2023\n\n";
                $sms_text.="Take Care of ".$_POST['patientname']."\n";
                $sms_text.="For Online Appointment & Tracking Patient's History: shorturl.at/cjouF\n";
                $sms_text.="For further queries: +923131176092";
                $paymentArray=array(
                    "mr_number" => "Voucher",
                    "contact"   => $_POST['contact'],
                    "sms_text"  => $sms_text,
                );
                $curl = curl_init();
                $_SERVER['SERVER_NAME'] = ($_SERVER['SERVER_NAME'] =="localhost")? $_SERVER['SERVER_NAME'] : "https://".$_SERVER['SERVER_NAME'];
                curl_setopt_array($curl, array(
                    CURLOPT_URL => $_SERVER['SERVER_NAME'].'/south-lane/api/sms/send-single.php',
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
            }else{
                // die('Unable to add record.');
                $logArray=array(
                    "user_name" => isset($_SESSION["user_name"])? $_SESSION["user_name"] : "no user" ,
                    "activity" => $activity,
                    "status" => "Query Execution Failed",
                );
                echo "failure^".date('Y-m-d H:i:s')."^Unable to add record.";
            }
        }
    }

    // show error
    catch(PDOException $exception){
        echo "failure^".date('Y-m-d H:i:s')."^POST failed.";
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
