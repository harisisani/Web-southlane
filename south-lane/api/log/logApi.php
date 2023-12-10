<?php
   $curl = curl_init();
try{
    curl_setopt_array($curl, array(
    CURLOPT_URL => $_SERVER['SERVER_NAME'].'/south-lane/api/log/create.php',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'POST',
    CURLOPT_POSTFIELDS => json_encode($logArray),
    CURLOPT_HTTPHEADER => array(
        'Content-Type: application/json'
    ),
    ));
}

// show error
catch(PDOException $exception){
    curl_setopt_array($curl, array(
    CURLOPT_URL => 'http://localhost/south-lane/api/log/create.php',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'POST',
    CURLOPT_POSTFIELDS =>'
        "user_name":"No user",
        "activity":"log not recorded",
        "status":"unsuccessful log"
    }',
    CURLOPT_HTTPHEADER => array(
        'Content-Type: application/json',
        'Cookie: PHPSESSID=6tnki7omhgrjkvoc844tc8ji4m'
    ),
    ));
}

$response = curl_exec($curl);
curl_close($curl);
?>