<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

include './Exception.php';
include './PHPMailer.php';
include './SMTP.php';

// passing true in constructor enables exceptions in PHPMailer
$mail = new PHPMailer(true);
$_POST = json_decode(file_get_contents('php://input'), true);
if($_POST){
    try {
        // Server settings
        // $mail->SMTPDebug = SMTP::DEBUG_SERVER; // for detailed debug output
        $mail->isSMTP();
        $mail->Host = 'localhost';
        $mail->SMTPAuth = false;
        $mail->SMTPAutoTLS = false;
        $mail->Port = 25;
    
        // $mail->Username = 'profilewebsite162@gmail.com'; // YOUR gmail email
        // $mail->Password = 'Programmer12345'; // YOUR gmail password
    
        $mail->Username = 'no-reply@southlaneanimalhospital.com'; // YOUR gmail email
        $mail->Password = 'Programmer'; // YOUR gmail password

        // Sender and recipient settings
        $mail->setFrom('no-reply@southlaneanimalhospital.com', 'South Lane Animal Hospital');
        $mail->addAddress( $_POST['receiver_email'], $_POST['receiver_name']);
        $mail->addReplyTo('harisisani@gmail.com', 'South Lane Animal Hospital'); // to set the reply to

        // Setting the email content
        $mail->IsHTML(true);
        $mail->Subject = $_POST['subject'];
        $mail->Body = $_POST['body'];
        if(isset($_POST['file_path'])){
            $mail->addAttachment($_POST['file_path']);
        }

        $mail->send();
        echo "success";
    } catch (Exception $e) {
        // echo $e;
        echo $mail->ErrorInfo;
    }
}else{
    echo "POST failed";
}

?>