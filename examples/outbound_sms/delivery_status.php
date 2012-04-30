<?php
require('../../lib/oneapi4sms.class.php');

// Enter Your Credentials here
$username = "";						// User ID of the Customer
$password = "";						// Api Key of the Customer
$senderAddress = "";				 	// Sender Address for the Message 
$requestId = "";					// Issuer Request ID 	
											
// Creating object of the OneApi4Sms class
$oneApi4SmsObject = new OneApi4Sms($username, $password);

// data returned from server in JSON format
$jsonData = $oneApi4SmsObject->deliveryStatusForOutbound($senderAddress, $requestId);
print_r($jsonData);

// decoded data for data processing 
$decodedData = json_decode($jsonData);

?>