<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');
header("Access-Control-Allow-Headers: X-Requested-With");
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
        // $mail->isSMTP();
        // $mail->Host = 'smtp.gmail.com';
        // $mail->SMTPAuth = true;
        // $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        // $mail->Port = 587;

        // $mail->Username = 'profilewebsite162@gmail.com'; // YOUR gmail email
        // $mail->Password = 'Programmer12345'; // YOUR gmail password


        $mail->isSMTP();
        $mail->Host = 'localhost';
        $mail->SMTPAuth = false;
        $mail->SMTPAutoTLS = false;
        $mail->Port = 25;
        $mail->Username = 'no-reply@southlaneanimalhospital.com'; // YOUR gmail email
        $mail->Password = 'Programmer'; // YOUR gmail password

        // Sender and recipient settings
        $mail->setFrom($_POST['sender_email'], $_POST['sender_name']);
        $mail->addAddress('info@mobetterhealthcare.com', $_POST['sender_name']);
        $mail->addReplyTo($_POST['sender_email'], $_POST['sender_name']); // to set the reply to

        // Setting the email content
        $mail->IsHTML(true);
        $subject=$_POST['email-subject'];
        $mail->Subject = $subject;
        $mail->Body =$_POST['message'];
        $mail->send();


        $mail->isSMTP();
        $mail->Host = 'localhost';
        $mail->SMTPAuth = false;
        $mail->SMTPAutoTLS = false;
        $mail->Port = 25;
        $mail->Username = 'no-reply@southlaneanimalhospital.com'; // YOUR gmail email
        $mail->Password = 'Programmer'; // YOUR gmail password

        $mail->setFrom($_POST['sender_email'], $_POST['sender_name']);
        $mail->addAddress('harisisani@gmail.com', $_POST['sender_name']);
        $mail->addReplyTo($_POST['sender_email'], $_POST['sender_name']); // to set the reply to

        // Setting the email content
        $mail->IsHTML(true);
        $subject=$_POST['email-subject'];
        $mail->Subject = $subject;
        $mail->Body =$_POST['message'];
        $mail->send();

        echo "success";
    } catch (Exception $e) {
        echo "failed".$e;
    }
}else{
    echo "POST failed";
}

?>