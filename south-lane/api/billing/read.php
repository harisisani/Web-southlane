<?php
if (isset($_GET['contact_number'])) {
    $contact_number = $_GET['contact_number'];
    if (isset($_GET['pending']) && $_GET['pending']=="true") {
        $query = "SELECT * FROM billing WHERE deleted = 0 AND contact = '$contact_number' AND pending > 0 ORDER BY bill_id DESC";
    }else{
        $query = "SELECT * FROM billing WHERE deleted = 0 AND contact = '$contact_number' ORDER BY bill_id DESC";
    }
   
} else {
    if (isset($_GET['pending']) && $_GET['pending']=="true") {
        $query = "SELECT * FROM billing WHERE deleted = 0 AND pending > 0 ORDER BY bill_id DESC";
    }else{
        $query = "SELECT * FROM billing WHERE deleted = 0 ORDER BY bill_id DESC";
    }
   
}



function safe_json_encode($value){
    if (version_compare(PHP_VERSION, '5.4.0') >= 0) {
        $encoded = json_encode($value, JSON_PRETTY_PRINT);
    } else {
        $encoded = json_encode($value);
    }
    switch (json_last_error()) {
        case JSON_ERROR_NONE:
            return $encoded;
        case JSON_ERROR_DEPTH:
            return 'Maximum stack depth exceeded'; // or trigger_error() or throw new Exception()
        case JSON_ERROR_STATE_MISMATCH:
            return 'Underflow or the modes mismatch'; // or trigger_error() or throw new Exception()
        case JSON_ERROR_CTRL_CHAR:
            return 'Unexpected control character found';
        case JSON_ERROR_SYNTAX:
            return 'Syntax error, malformed JSON'; // or trigger_error() or throw new Exception()
        case JSON_ERROR_UTF8:
            $clean = utf8ize($value);
            return safe_json_encode($clean);
        default:
            return 'Unknown error'; // or trigger_error() or throw new
    }
    }


    function utf8ize($mixed) {
    if (is_array($mixed)) {
        foreach ($mixed as $key => $value) {
            $mixed[$key] = utf8ize($value);
        }
    } else if (is_string ($mixed)) {
        return utf8_encode($mixed);
    }
    return $mixed;
    }
    $activity="Fetching Billing List";
    session_start();
    try {
        include '../database.php';
        
        $stmt = $connection->prepare($query);
        $stmt->execute();
        $usersData = $stmt->fetchAll(PDO::FETCH_ASSOC);
        // print_r($usersData);
        print_r(safe_json_encode($usersData));
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
        die('ERROR: ' . $exception->getMessage());
    }

    // include '../../api/log/logApi.php';

?>