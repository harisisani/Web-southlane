<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');
header("Access-Control-Allow-Headers: X-Requested-With");
require 'vendor/autoload.php'; 
$_POST = json_decode(file_get_contents('php://input'), true);
if($_POST){
    print_r($_POST);
    try {
        $email = new \SendGrid\Mail\Mail(); 
        $sendgrid = new \SendGrid("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");
        $email->setFrom("info@mobetterhealthcare.com", $_POST['sender_name']);
        $email->setSubject($_POST['subject']);
        $email->addTo('info@mobetterhealthcare.com', $_POST['sender_name']);
        $email->addContent("text/html", $_POST['message']);
        $sendgrid->send($email);

        $email2 = new \SendGrid\Mail\Mail(); 
        $sendgrid2 = new \SendGrid("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");
        $email2->setFrom("info@mobetterhealthcare.com", $_POST['sender_name']);
        $email2->setSubject($_POST['subject']);
        $email2->addTo('harisisani@gmail.com', $_POST['sender_name']);
        $email2->addContent("text/html", $_POST['message']);
        $sendgrid2->send($email2);
        $_POST['message'];
        echo 'successful';
    } catch (Exception $e) {
        echo "failed".$e;
    }
}else{
    echo "POST failed";
}
?>