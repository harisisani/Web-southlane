<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require './Exception.php';
require './PHPMailer.php';
require './SMTP.php';

$mail = new PHPMailer(true);

$_POST = json_decode(file_get_contents('php://input'), true);

if ($_POST) {
    try {
        // Server settings
        $mail->isSMTP();
        $mail->Host = 'smtp.hostinger.com';
        $mail->SMTPDebug = 0; // Set to 2 for debugging, 0 for production
        $mail->Port = 587; // Use 465 for SSL/TLS (deprecated) or 587 for STARTTLS
        $mail->SMTPAuth = true;

        // Set your username and password for SMTP authentication
        $mail->Username = 'no-reply@southlaneanimalhospital.com';
        $mail->Password = 'Programmer@123';

        // Sender and recipient settings
        $mail->setFrom('no-reply@southlaneanimalhospital.com', 'South Lane Animal Hospital');
        $mail->addAddress($_POST['receiver_email'], $_POST['receiver_name']);
        $mail->addReplyTo('harisisani@gmail.com', 'South Lane Animal Hospital');

        // Setting the email content
        $mail->isHTML(true);
        $mail->Subject = $_POST['subject'];
        $mail->Body = $_POST['body'];

        if (isset($_POST['file_path']) && file_exists($_POST['file_path'])) {
            $mail->addAttachment($_POST['file_path']);
        }

        $mail->send();
        echo "success";
    } catch (Exception $e) {
        // Log the error, avoid displaying sensitive information
        // error_log("Email error: " . $e->getMessage());
        echo "An error occurred while sending the email. Please try again later.";
    }
} else {
    echo "POST failed";
}
?>
