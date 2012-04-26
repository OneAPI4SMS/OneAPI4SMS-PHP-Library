<?php
require('../../lib/oneapi4sms.class.php');

// Enter Your Credentials here
$username = "3";									// User ID of the Customer
$password = "fkdk893e8a9";							// Api Key of the Customer
$destinationAddress = "17146841887";				// Destination Address of the message

$oneApi4SmsObject = new OneApi4Sms($username, $password);
$requestURL = $oneApi4SmsObject->getInboundRequestURL();
$dataString = "destinationAddress=".$destinationAddress;

// data returned from server in JSON format
$jsonData = $oneApi4SmsObject->getResponseFromAPI($requestURL, $dataString);
print_r($jsonData);

// decoded data for data processing 
$decodedData = json_decode($jsonData);

?>