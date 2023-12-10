<?php
$_POST = json_decode(file_get_contents('php://input'), true);
if($_POST){
    // include database connection
    include '../database.php';

    try{
        // insert query
        $query = "INSERT INTO log SET
        user_name='".$_POST['user_name']."',
        activity='".$_POST['activity']."',
        status='".$_POST['status']."'";
        $stmt = $connection->prepare($query);

        if($stmt->execute()){
            // redirect to read records page and
            // tell the user record was deleted
            echo "success";
        }else{
            die('Unable to add record.');
            echo "log failure";
        }
    }

    // show error
    catch(PDOException $exception){
        echo "log failure";
        // die('ERROR: ' . $exception->getMessage());
    }

}

?>
