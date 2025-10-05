<?php
    // session_start();
    //  if(isset($_SESSION["user_name"])){
         $host="localhost";
            $db_name="u270102017_app_southlane";
            $user="u270102017_blitz";
            $password='Programmer@123';
            // $db_name="app_southlane";
            $user="root";
            $password='';
            try{
                $connection=new PDO("mysql:host=".$host.";dbname=".$db_name,$user,$password);
            }
            catch(PDOException $exception){
                echo 'Connection Error: '.$exception->getMessage();
            }
    //   }else{
    //       echo 'Session not active';
    //       header("Location: ./login.php");
    //   }
?>
