<?php
require('../../lib/oneapi4sms.class.php');

// Enter Your Credentials here
$username = "";									// User ID of the Customer
$password = "";						                 	// Api Key of the Customer
$CountryAbbreviation = "USA";	

/**
 * This MSISDN code in invalid and is here for testing purposes. 
 * Check for correct codes here "examples/account/find_available_addresses.php"
 * For wrong MSISDN code error will be : "The %1 is not a valid msisdn" 	
 */
$msisdn = "140833709999";							
										
// Each Header parameter should be a separate array element
$headers = array(
	"Content-Type : application/x-www-form-urlencoded"
);

// Creating object of the OneApi4Sms class
$oneApi4SmsObject = new OneApi4Sms($username, $password);

// data returned from server in JSON format
$jsonData = $oneApi4SmsObject->addAddress($CountryAbbreviation, $msisdn, $headers);
print_r($jsonData);

// decoded data for data processing 
$decodedData = json_decode($jsonData);

?>