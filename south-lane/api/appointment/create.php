<?php
session_start();
$activity="Adding a new bill";
$_POST = json_decode(file_get_contents('php://input'), true);
if($_POST){
    date_default_timezone_set("Asia/Karachi");
    // include database connection
    include '../database.php';
    try{

        $query = "SELECT MAX(appointment_id) AS max_id FROM appointments";
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
        $newBillId = "APP " . str_pad($newId, 4, "0", STR_PAD_LEFT);

        $username=isset($_SESSION["user_name"])? $_SESSION["user_name"] : "Website Entry" ;
        // insert query
        $query = "INSERT INTO appointments SET
        appointment_id_unique='".$newBillId."',
        patient_name='".$_POST['patientname']."',
        mr_number='".$_POST['mr_number']."',
        owner_name='".$_POST['ownername']."',
        contact='".$_POST['contact']."',
        procedure_name='".$_POST['procedure_name']."',
        procedure_amount='".$_POST['procedure_amount']."',
        appointment_date='".$_POST['appointment_date']."',
        appointment_created_date='".date('Y-m-d H:i:s')."',
        user_name='".$username."'";
        $stmt = $connection->prepare($query);

        if($stmt->execute()){
            // redirect to read records page and
                // tell the user record was deleted
                $logArray=array(
                    "user_name" => isset($_SESSION["user_name"])? $_SESSION["user_name"] : "no user" ,
                    "activity" => $activity,
                    "status" => "Successful",
                );
            echo 'success^'.date('Y-m-d H:i:s')."^".$newBillId;
            $curl = curl_init();
            $hashAlgo = 'sha256';

            $nameParts = explode(" ", $_POST['ownername']);
            if (count($nameParts) >= 2) {
                $firstName = $nameParts[0];
                $lastName = implode(" ", array_slice($nameParts, 1));
            } else {
                $firstName = $_POST['ownername'];
                $lastName = "";
            }

            if (isset($_POST['email']) && !empty($_POST['email'])) {
                $hashedEmail = hash($hashAlgo, strtolower(trim($_POST['email'])));
            }

            $hashedPhone = hash($hashAlgo, strtolower(trim($_POST['contact'])));
            $hashedFirstName = hash($hashAlgo, strtolower(trim($firstName)));
            $hashedLastName = hash($hashAlgo, strtolower(trim($lastName)));

            $data = array(
                'data' => array(
                    array(
                        'event_name' => 'Appointment',
                        'event_time' => 1691498638,
                        'action_source' => 'website',
                        'event_id' => '001',
                        'event_source_url' => 'https://southlaneanimalhospital.com',
                        'user_data' => array(
                            'em' => array(
                                $hashedEmail,
                            ),
                            'ph' => array(
                                $hashedPhone,
                            ),
                            'fn' => array(
                                $hashedFirstName,
                            ),
                            'ln' => array(
                                $hashedLastName,
                            ),
                        ),
                    ),
                ),
            );

            $jsonPayload = json_encode($data);

            curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://graph.facebook.com/v17.0/6211370685647098/events?access_token=EAALE6GBRwbIBO9kRIbBM7v9AGdZCHNeVnwQzaf5Cfp1ID1RcNMXZBgr3fMxa66nHGjOvAciLcRmrHVry811nJbFZCkLfij9Q4DZB4ivpUy7gApE9AWZBcGMohuZB9ruZCpPqSOLf303WZBbOJOW5AlrZCs5UkAmpyHJPSkunufa2uLUPVfErph21VUZBcXZCVu1qAZDZD',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => $jsonPayload,
                CURLOPT_HTTPHEADER => array(
                    'Content-Type: application/json'
                ),
            ));

            $response = curl_exec($curl);

            curl_close($curl);
            // echo $response;
            

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
