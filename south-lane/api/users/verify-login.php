<?php
    session_start();
    $activity="Attempting Login";
    include '../database.php';
    try {
        $query = "SELECT * FROM users";
        $stmt = $connection->prepare($query);
        $stmt->execute();
        $usersData = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // show error
    catch(PDOException $exception){
        die('ERROR: ' . $exception->getMessage());
        $logArray=array(
            "user_name" => isset($_SESSION["user_name"])? $_SESSION["user_name"] : "no user" ,
            "activity" => $activity,
            "status" => "Query Execution Failed",
        );
    }

    if($_POST){
            foreach($usersData as $value){
                if($value['user_email']==$_POST['email'] && $value['user_password']==$_POST['password'] ){
                        date_default_timezone_set("Asia/Karachi");
                        $_SESSION["user_id"]=$value['user_id'];
                        $_SESSION["user_name"]=$value['user_name'];
                        $_SESSION["user_password"]=$value['user_password'];
                        $_SESSION["user_contact"]=$value['user_contact'];
                        $_SESSION["user_email"]=$value['user_email'];
                        $query = "UPDATE users SET user_last_login='".date('Y-m-d H:i:s')."' WHERE user_email = '".$value['user_email']."'";
                        $stmt = $connection->prepare($query);
                        $stmt->execute();
                    }
                }
        if(!isset($_SESSION["user_id"])){
            $_SESSION['login_error']="Username or Password is incorrect";
            header("Location: ../../login.php");
            $logArray=array(
                "user_name" => isset($_SESSION["user_name"])? $_SESSION["user_name"] : "no user" ,
                "activity" => $activity,
                "status" => "Username or password incorrect",
            );
        }else{
            header("Location: ../../index.php");
            $logArray=array(
                "user_name" => isset($_SESSION["user_name"])? $_SESSION["user_name"] : "no user" ,
                "activity" => $activity,
                "status" => "Successful",
            );
        }
    }else{
        $logArray=array(
            "user_name" => isset($_SESSION["user_name"])? $_SESSION["user_name"] : "no user" ,
            "activity" => $activity,
            "status" => "POST Request Failed",
        );
    }
    include '../../api/log/logApi.php';
?>