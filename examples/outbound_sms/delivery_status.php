<?php
require('../../lib/oneapi4sms.class.php');

// Enter Your Credentials here
$username = "2";									// User ID of the Customer
$password = "178dgsj7821";							// Api Key of the Customer
$senderAddress = "17184756239";					 	// Sender Address for the Message 
$requestId = "071afe810d57b31703af5c810d1ae9ae";	// Issuer Request ID 	
											
// Creating object of the OneApi4Sms class
$oneApi4SmsObject = new OneApi4Sms($username, $password);

// data returned from server in JSON format
$jsonData = $oneApi4SmsObject->deliveryStatusForOutbound($senderAddress, $requestId);
print_r($jsonData);

// decoded data for data processing 
$decodedData = json_decode($jsonData);

?>