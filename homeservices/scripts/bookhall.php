<?php

require_once 'helpers.php';
require_once 'DB.php';

if (isset($_POST['book'])) {
    $input = clean($_POST);
 
    $provider = $_POST['provider'];

   
    $name = $_POST['name'];
    
    $contact = $_POST['contact'];
    $adder = $_POST['adder'];
    $date = $_POST['date'];
    $queries = $_POST['queries'];
    $payment = $_POST['payment'];
    $sql = "INSERT INTO bookings (id,provider_id,name, contact, adder, date, payment, queries, status,created_at) 
            VALUES (DEFAULT,? , ?, ?, ?, ?, ?, ?, DEFAULT,NOW())";
  
    $isBooked = DB::query($sql, [
        $provider, $name, $contact, $adder, $date, $payment, $queries
    ]);

    if ($isBooked) {
        header("Location: ../booking.php?provider=$provider&msg=success");
        exit();
    } else {
        header("Location: ../booking.php?provider=$provider&msg=failed");
        exit();
    }
}