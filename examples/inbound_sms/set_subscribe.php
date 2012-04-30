<?php
require('../../lib/oneapi4sms.class.php');

// Enter Your Credentials here
$username = "";					// User ID of the Customer
$password = "";					// Api Key of the Customer
$options['destinationAddress'] = "";		// Destination Address of the message
$options['callbackData'] = "";	
$options['clientCorrelator'] = "";
$options['criteria'] = "";
$options['notificationFormat'] = "1";		// 1 for JSON		 		
$options['notifyURL'] = "http://your-url";	// URL to recieve messages from the oneapi4sms.com API

// Each Header parameter should be a separate array element
$headers = array(
	"Content-Type : application/x-www-form-urlencoded"
);													

// Creating object of the OneApi4Sms class
$oneApi4SmsObject = new OneApi4Sms($username, $password);

// data returned from server in JSON format
$jsonData = $oneApi4SmsObject->setSubscribe($options, $headers);
print_r($jsonData);

// decoded data for data processing 
$decodedData = json_decode($jsonData);

?>