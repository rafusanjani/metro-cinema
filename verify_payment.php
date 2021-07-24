<?php
require 'config.php';

require 'AfricasTalkingGateway.php';

$status = $_GET['status'];

$tx_ref = $_GET['tx_ref'];

$readPayment = $dbConnection->query("SELECT * FROM payments WHERE tx_ref = '$tx_ref'");

$results = $readPayment->fetch_assoc();

$phone_number = $results['phone_number'];

$name = $results['name'];

$seatNumber = "VIP-12";

if($status == "successful"){

	$dbConnection->query("UPDATE payments SET status='$status' WHERE tx_ref='$tx_ref' ");

	$message = "Hello ".$name." Thank you for paying Movie 12, your seat number is ".$seatNumber.", The mover start at 8:30 PM today";	

	$apikey     = "";	

	$gateway    = new AfricasTalkingGateway("", $apikey,);

	$gateway->sendMessage($phone_number, $message);

	header("Location:thank_you.php?message='Thank you for paying'  ");

}else{

	header("Location:thank_you.php?message='You payment failed' ");

}

 