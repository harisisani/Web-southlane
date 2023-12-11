<?php
    require 'vendor/autoload.php'; 
    $email2 = new \SendGrid\Mail\Mail(); 
    $sendgrid2 = new \SendGrid("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");
    $email2->setFrom("info@mobetterhealthcare.com", "MO Arien");
    $email2->setSubject("Testing API");
    $email2->addTo('harisisani@gmail.com', "Haris Isani");
    $email2->addContent("text/html", "<h2>Test</h1><p>testing</p>");
    $sendgrid2->send($email2);
    echo 'success';
    print $response->statusCode() . "\n";
    print_r($response->headers());
    print $response->body() . "\n";
    ?>