<link rel="stylesheet" type="text/css" href="../assets/styles/bootstrap4/bootstrap.min.css">
<?php

$activity="Sending Daily Report";
    $csvData = [
        ['Invoice ID','Patient Name','Owner Name','Owner Contact','Procedures','Sub-Total', 'Discount' , 'Total Amount' , 'Pending' ,'Received','Created By'],
    ];


     $curl = curl_init();
     $url = $_SERVER['SERVER_NAME'].'/south-lane/api/billing/read-cron.php?date='.$_GET['date'];
     curl_setopt_array($curl, array(
     CURLOPT_URL => $url,
     CURLOPT_RETURNTRANSFER => true,
     CURLOPT_ENCODING => '',
     CURLOPT_MAXREDIRS => 10,
     CURLOPT_TIMEOUT => 0,
     CURLOPT_FOLLOWLOCATION => true,
     CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
     CURLOPT_CUSTOMREQUEST => 'GET',
     ));

     $response = curl_exec($curl);

    curl_close($curl);
    $allData=json_decode($response);
    $totalSubTotal=0;
    $totalDiscount=0;
    $totalTotalAmount=0;
    $totalPending=0;
    $totalReceived=0;

    $reportHtml='<div class="container">
    <table style="border: 1px solid #b5b5b5; border-collapse:Collapse; " id="patientsTable" class="table table-bordered">
        <thead>
            <tr style="background:#F60017; color:white;">
                <th style="vertical-align: middle;">Invoice ID</th>
                <th style="vertical-align: middle;">Sub-Total</th>
                <th style="vertical-align: middle;">Discount</th>
                <th style="vertical-align: middle;">Total Amount</th>
                <th style="vertical-align: middle;">Pending</th>
                <th style="vertical-align: middle;">Received</th>
            </tr>
        </thead>
    <tbody>';
    foreach($allData as $rowIndex => $value){
    $colIndex=0;
    $csvData[$rowIndex+1][$colIndex++]=$value->bill_id_unique;
    $csvData[$rowIndex+1][$colIndex++]=$value->patient_name;
    $csvData[$rowIndex+1][$colIndex++]=$value->owner_name;
    $csvData[$rowIndex+1][$colIndex++]=$value->contact;
    $csvData[$rowIndex+1][$colIndex++]=$value->procedures_with_amount;
    $csvData[$rowIndex+1][$colIndex++]=$value->extra_charges;
    $csvData[$rowIndex+1][$colIndex++]=$value->discount;
    $csvData[$rowIndex+1][$colIndex++]=$value->total_amount;
    $csvData[$rowIndex+1][$colIndex++]=$value->pending;
    $csvData[$rowIndex+1][$colIndex++]=$value->received;
    $csvData[$rowIndex+1][$colIndex++]=$value->user_name;
    $reportHtml.='<tr class="template">
            <td class="bill_id_unique">'.$value->bill_id_unique.'</td>
            <td class="extra_charges">'.$value->extra_charges.'</td>
            <td class="discount">'.$value->discount.'</td>
            <td class="total_amount">'.$value->total_amount.'</td>
            <td class="amount_pending"><span class="value">'.$value->pending.'</span></td>
            <td class="amount_received">'.$value->received.'</td>
        </tr>';
            $totalSubTotal+=$value->extra_charges;
            $totalDiscount+=$value->discount;
            $totalTotalAmount+=$value->total_amount;
            $totalPending+=$value->pending;
            $totalReceived+=$value->received;
         }
$reportHtml.='</tbody>
    </table>
</div>';
$reportHtml.='<div class="container" style="margin-top:50px;">
<h2>Closing Totals - Dated: '.$date.'</h2>
<table id="patientsTable" class="table table-bordered">
    <thead>
        <tr style="background:#F60017; color:white;">
            <th style="vertical-align: middle;">Sub-Total</th>
            <th style="vertical-align: middle;">Discount</th>
            <th style="vertical-align: middle;">Total Amount</th>
            <th style="vertical-align: middle;">Pending</th>
            <th style="vertical-align: middle;">Received</th>
        </tr>
    </thead>
<tbody>';
$reportHtml.='<tr class="template">
<td class="extra_charges">'.$totalSubTotal.'</td>
<td class="discount">'.$totalDiscount.'</td>
<td class="total_amount">'.$totalTotalAmount.'</td>
<td class="amount_pending"><span class="value">'.$totalPending.'</span></td>
<td class="amount_received">'.$totalReceived.'</td>
</tr>';
$reportHtml.='</tbody>
</table><br/><br/>
</div>';

 $date=$_GET['date'];
//  $date='2022-04-04';


    // $filename = './reports/Daily Report - Dated '.$date.'.csv';
    // $filename = './reports/Daily Report - Dated '.$date.'.csv';
    // // open csv file for writing
    // $f = fopen($filename, 'w');

    // if ($f === false) {
    //     die('Error opening the file ' . $filename);
    // }

    // write each row at a time to a file
    // foreach ($csvData as $row) {
    //     fputcsv($f, $row);
    // }
    $recipientsDetails=array(
        'receiver_email' => 'harisisani@gmail.com',
        'receiver_name' => 'Haris Isani',
        'subject' => 'Daily Report - Dated: '.$date,
        'body' => $reportHtml,
        // 'file_path' => 'C:\xampp\htdocs\south-lane\crons\reports\Daily Report - Dated '.$date.'.csv',
        'file_path' => '/home/u270102017/public_html/south-lane/crons/reports/Daily Report - Dated '.$date.'.csv',
    );

    // close the file
    // fclose($f);
        try{
            // print_r($allData);
            $curl = curl_init();
            curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://southlaneanimalhospital.com/south-lane/api/email/sendmail.php',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => json_encode($recipientsDetails),
            CURLOPT_HTTPHEADER => array(
                    'Content-Type: application/json'
                ),
            ));
            $response = curl_exec($curl);
            curl_close($curl);
            $logArray=array(
                "user_name" => isset($_SESSION["user_name"])? $_SESSION["user_name"] : "no user" ,
                "activity" => $activity,
                "status" => "Successful",
            );
            echo $response;
        }
        catch (Exception $e){
            echo $e;
            $logArray=array(
                "user_name" => isset($_SESSION["user_name"])? $_SESSION["user_name"] : "no user" ,
                "activity" => $activity,
                "status" => "Query Execution Failed",
            );
            echo "failure";
        }

        $recipientsDetailsOther=array(
            'receiver_email' => 'zeeshan.shouket@gmail.com',
            'receiver_name' => 'Zeeshan Shouket',
            'subject' => 'Daily Report - Dated: '.$date,
            'body' => $reportHtml,
            // 'file_path' => 'C:\xampp\htdocs\south-lane\crons\reports\Daily Report - Dated '.$date.'.csv',
            'file_path' => '/home/u270102017/public_html/south-lane/crons/reports/Daily Report - Dated '.$date.'.csv',
        );

        try{
            // print_r($allData);
            $curl = curl_init();
            curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://southlaneanimalhospital.com/south-lane/api/email/sendmail.php',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => json_encode($recipientsDetailsOther),
            CURLOPT_HTTPHEADER => array(
                    'Content-Type: application/json'
                ),
            ));
            $response = curl_exec($curl);
            curl_close($curl);
            $logArray=array(
                "user_name" => isset($_SESSION["user_name"])? $_SESSION["user_name"] : "no user" ,
                "activity" => $activity,
                "status" => "Successful",
            );
            echo $response;
        }
        catch (Exception $e){
            echo $e;
            $logArray=array(
                "user_name" => isset($_SESSION["user_name"])? $_SESSION["user_name"] : "no user" ,
                "activity" => $activity,
                "status" => "Query Execution Failed",
            );
            echo "failure";
        }
    include '../api/log/logApi.php';
?>
