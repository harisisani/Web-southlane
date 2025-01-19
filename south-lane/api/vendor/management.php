<?php
$activity="Fetching extras List";
    session_start();
    try {
        include '../database.php';
        // Fetch vendor_id from GET parameter if provided
        $vendorId = isset($_GET['vendor_id']) ? $_GET['vendor_id'] : null;

        // Base query
        $query = "
            SELECT 
                vt.*, 
                s.name AS product_name, 
                v.name AS vendor_name, 
                b.print_receipt AS print_receipt
            FROM 
                vendortransactions vt
            INNER JOIN 
                store s ON vt.item_id = s.id
            INNER JOIN 
                vendor v ON vt.vendor_id = v.id
            LEFT JOIN 
                billing b ON vt.transactionId = b.bill_id_unique
            WHERE 
                vt.transactionId IS NOT NULL
        ";

        // Append condition if vendor_id is provided
        if (!is_null($vendorId)) {
            $query .= " AND vt.vendor_id = ".$vendorId;
        }
        $stmt = $connection->prepare($query);
        $stmt->execute();
        $usersData = $stmt->fetchAll(PDO::FETCH_ASSOC);
        print_r(json_encode($usersData));
        $logArray=array(
            "user_name" => isset($_SESSION["user_name"])? $_SESSION["user_name"] : "no user" ,
            "activity" => $activity,
            "status" => "Successful",
        );
    }

    // show error
    catch(PDOException $exception){
        $logArray=array(
            "user_name" => isset($_SESSION["user_name"])? $_SESSION["user_name"] : "no user" ,
            "activity" => $activity,
            "status" => "Query Execution Failed",
        );
        // die('ERROR: ' . $exception->getMessage());
    }

    // include '../../api/log/logApi.php';

?>