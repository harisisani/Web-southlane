<?php
// $activity="Adding a new user";
// session_start();
// if($_POST){
//     date_default_timezone_set("Asia/Karachi");
//     // include database connection
//     include '../database.php';

//     try{
//         // insert query
//         $query = "INSERT INTO users SET user_name=:username,user_password=:password,user_contact=:contact,user_email=:email,user_created_date=:user_created_date,user_last_login=:user_last_login";
//         $stmt = $connection->prepare($query);
//         // posted values
//         $username=$_POST['username'];
//         $password=$_POST['password'];
//         $contact=$_POST['contact'];
//         $email=$_POST['email'];
//         $user_created_date=date('Y-m-d H:i:s');
//         $user_last_login=date('Y-m-d H:i:s');

//         // bind the parameters
//         $stmt->bindParam(':username', $username);
//         $stmt->bindParam(':password', $password);
//         $stmt->bindParam(':contact', $contact);
//         $stmt->bindParam(':email', $email);
//         $stmt->bindParam(':user_created_date', $user_created_date);
//         $stmt->bindParam(':user_last_login', $user_last_login);
//         if($stmt->execute()){
//             // redirect to read records page and
//             // tell the user record was deleted
//             $_SESSION['register_error']="Account created sucessfully";
//             $logArray=array(
//                 "user_name" => isset($_SESSION["user_name"])? $_SESSION["user_name"] : "no user" ,
//                 "activity" => $activity,
//                 "status" => "Successful",
//             );
//             header('Location: ../../login.php');

//         }else{
//             die('Unable to add record.');
//         }
//     }

//     // show error
//     catch(PDOException $exception){
//         $_SESSION['register_error']="Account already exists with this email";
//         $logArray=array(
//             "user_name" => isset($_SESSION["user_name"])? $_SESSION["user_name"] : "no user" ,
//             "activity" => $activity,
//             "status" => "User already exists",
//         );
//         header('Location: ../../register.php');
//         // die('ERROR: ' . $exception->getMessage());
//     }
// }else{
//     $logArray=array(
//         "user_name" => isset($_SESSION["user_name"])? $_SESSION["user_name"] : "no user" ,
//         "activity" => $activity,
//         "status" => "POST failed",
//     );
// }
include '../../api/log/logApi.php';
?>
