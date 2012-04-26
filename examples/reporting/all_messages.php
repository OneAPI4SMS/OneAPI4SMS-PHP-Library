<?php
require('../../lib/oneapi4sms.class.php');

// Enter Your Credentials here
$username = "3";									// User ID of the Customer
$password = "fkdk893e8a9";							// Api Key of the Customer
$options['reportFormat'] = "xml";			 		// it can be xml, json or csv

// Creating object of the OneApi4Sms class
$oneApi4SmsObject = new OneApi4Sms($username, $password);

// data returned from server in JSON format
$jsonData = $oneApi4SmsObject->reportingAllMessages($options);
print_r($jsonData);

// decoded data for data processing 
$decodedData = json_decode($jsonData);

?>