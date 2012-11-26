<?php
/**
 * PHP class for interacting with Oneapi4sms API
 */ 
class OneApi4Sms{
	
	/** 
	 * Private Class Members
	 * 
	 * $baseRequestURL  
	 * Live SERVER Request URL: "https://api.oneapi4sms.com/"
	 * 
	 * $inboundURL  
	 * for inbound message requests
	 * 
	 * $outboundURL  
	 * for outbound message requests
	 * 
	 * $reportingURL  
	 * for reporting purposes
	 * 
	 * $accountURL  
	 * for finding and adding addresses 
	 * 
	 * Leave $username and $password unchanged here.
     */ 
	private $baseRequestURL = "https://api.oneapi4sms.com/";
	//private $baseRequestURL = "http://202.164.43.84/himanshu/oneapi4sms/Source-Code/trunk/webservices/"; 
	private $inboundURL = "v1/smsmessaging/inbound/";
	private $outboundURL = "v1/smsmessaging/outbound/";
	private $reportingURL = "v1/smsmessaging/messages/";
	private $accountURL = "v1/account/";
	private $username;
	private $password;
	
	/**
	 * Class Constructor
	 * @param string $username
	 * @param string $password
	 */
	public function __construct($username, $password){
		$this->username = $username;
		$this->password = $password;		
	}
	
	/**
	 * @return string $baseRequestURL 
	 * Get the Base Request URL
	 */ 
	public function getBaseURL(){ 
		return $this->baseRequestURL;
	}
	
	/** 
	 * @return string $inboundRequestURL 
	 * get the Inbound Request URL
	 */
	public function getInboundRequestURL(){
	 	$inboundRequestURL = $this->baseRequestURL. $this->inboundURL;
	 	return $inboundRequestURL;
	}
	
	/** 
	 * Function to find all available long codes
	 * 
	 * @param string $CountryAbbreviation 
	 * @param array $options
	 * It contains values of these parameters :
	 * reportFormat
	 * 
	 * @return mixed $responseData 
	 */
	public function findAvailableAddresses($CountryAbbreviation, $options = array()){
			
		// Creating parameters
		$dataString = $this->parseOptions($options);
		$requestURL = $this->baseRequestURL . $this->accountURL . "availableAddresses/". $CountryAbbreviation;

		// CURL Request
		$responseData = $this->getResponseFromAPI($requestURL, $dataString);
		
		return $responseData;
	}
	
	
	/**
	 * Function to add an address
	 * 
	 * @param string $CountryAbbreviation
	 * @param int $msisdn
	 * @param array $headers
	 * Contains header parameters for the CURL request 
	 * 
	 * @return mixed $responseData 
	 */
	public function addAddress($CountryAbbreviation, $msisdn, $headers = array()){
			
		// Creating parameters
		$requestURL = $this->baseRequestURL . $this->accountURL . "customerAddresses/";
		$requestURL .= $CountryAbbreviation ."/". $msisdn;

		// CURL Request
		$responseData = $this->getResponseFromAPI($requestURL, $dataString = "", $headers);
		
		return $responseData;
	}
	
	
	/**
	 * Function for setSubscribe process
	 * 
	 * @param array $options
	 * It contains values of these parameters :
	 * destinationAddress, callbackData, clientCorrelator, criteria, notificationFormat, notifyURL
	 * 
	 * @param array $headers
	 * Contains header parameters for the CURL request 
	 * 
	 * @return mixed $responseData
	 */
	public function setSubscribe($options = array(), $headers = array()){	
		
		// Creating parameters
		$dataString = $this->parseOptions($options);
		$requestURL = $this->getInboundRequestURL()."subscriptions/";	
		
		// CURL Request	
		$responseData = $this->getResponseFromAPI($requestURL, $dataString, $headers);
		
		return $responseData;
	}
	
	/**
	 * Function for returning all messages
	 * 
	 * @param array $options
	 * It contains values of these parameters :
	 * reportFormat
	 * 
	 * @param array $headers
	 * Contains header parameters for the CURL request 
	 * 
	 * @return mixed $responseData 
	 */
	public function reportingAllMessages($options = array(), $headers = array()){
			
		// Creating parameters
		$dataString = $this->parseOptions($options);
		$requestURL = $this->baseRequestURL . $this->reportingURL;

		// CURL Request
		$responseData = $this->getResponseFromAPI($requestURL, $dataString, $headers);
		
		return $responseData;
	}
	
	/**
	 * Function for sending a message
	 * 
	 * @param int $senderAddress
     * @param string $message
     * @param int $receiverAddress
	 * @return mixed $responseData 
	 */
	public function sendSMS($senderAddress, $message, $receiverAddress){
				
		// Creating parameters
		$requestURL = $this->baseRequestURL . $this->outboundURL. $senderAddress . "/requests";	

        $data['message'] = urlencode($message);
        $data['address'] = $receiverAddress;
        
        $data = $this->parseOptions($data);
        
		// CURL Request
		$responseData = $this->getResponseFromAPI($requestURL, $data);
		
		return $responseData;
	}

	/**
	 * Function for checking delivery status
	 * 
	 * @param int $senderAddress
	 * Message Sender's Long Code
	 * 
	 * @param string $requestId
	 * $requestId of the issued request 
	 *  
	 * @return mixed $responseData 
	 */
	public function deliveryStatusForOutbound($senderAddress, $requestId){
				
		// Creating parameters
		$requestURL = $this->baseRequestURL . $this->outboundURL. $senderAddress . "/requests/". $requestId .'/deliveryInfos/';	

		// CURL Request
		$responseData = $this->getResponseFromAPI($requestURL);
		
		return $responseData;
	}
	
	/** 
	 * CURL API Call 
	 * To get response from the Oneapi4sms.com Server
	 * currently it is using post method
	 * 
	 * @param string $requestURL
	 * @param string $dataString
	 * Contains additional fields for CURL request
	 * 
	 * @param array $headers
	 * Contains header parameters for the CURL request 
	 * 
	 * @return mixed $curlResponse
	 */
	public function getResponseFromAPI($requestURL, $dataString = "", $headers = array()){
		
		$ch = curl_init($requestURL);
		curl_setopt($ch, CURLOPT_URL, $requestURL);
		
		curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
		curl_setopt($ch, CURLOPT_USERPWD, $this->username . ":" . $this->password);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		
		if($dataString != ""){
			curl_setopt($ch, CURLOPT_POST, true);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $dataString);
		}
		if(!empty($headers)){
			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		}
		
		$curlResponse = curl_exec($ch);
		curl_close($ch);
		return $curlResponse;
	}
	
	/**
	 * Function for parsing options and creating data string for CURL request
	 *  
	 * @param array $options 
	 * @return string $dataString
	 */
	public function parseOptions($options){
		$dataString	= "";
		$counter = 1;
		foreach($options as $key => $value){
			if($value != "" && $counter == 1)
			{
				$dataString .= $key ."=". $value; 
				$counter++;
			}
			elseif($value != ""){
				$dataString .= "&". $key ."=". $value;
			}else{}
		}
		return $dataString;
	}
}

?>