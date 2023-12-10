<?php
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
    session_start();
    $_POST = json_decode(file_get_contents('php://input'), true);
    if($_POST){
    try {
        include '../database.php';
        $_POST['contact']=str_replace(" ","",$_POST['contact']);
        $query = "SELECT * FROM billing where deleted = 0 AND mr_number='".$_POST['mr_number']."' AND REPLACE(contact, ' ', '') ='".$_POST['contact']."' ORDER BY bill_id DESC";
        $stmt = $connection->prepare($query);
        $stmt->execute();
        $usersData = $stmt->fetchAll(PDO::FETCH_ASSOC);
        // print_r($usersData);
        if(count($usersData)>0){
            print_r(safe_json_encode($usersData));
        }else{
            echo "no records found";
        }
    }

    // show error
    catch(PDOException $exception){
        die('ERROR: ' . $exception->getMessage());
    }
    }else{
        echo "server error";
    }

    // include '../../api/log/logApi.php';

?>