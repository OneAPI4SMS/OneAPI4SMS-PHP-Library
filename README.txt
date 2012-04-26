===============================================================================
                    ONE API 4 SMS- README FILE
===============================================================================
-------------------------------------------------------------------------------
OVERVIEW
-------------------------------------------------------------------------------
OneAPI4SMS is an easy to learn and easy to use API for sending and receiving
text messages using long codes or short codes. OneAPI4SMS uses a simple REST
interface based on the GSM Association OneAPI standard for SMS. OneAPI4SMS
builds on the GSMA OneAPI standard and also provides instant long code
activation and account management in many countries serving over 1/2 billion
mobile subscribers.
-------------------------------------------------------------------------------
Base URL
-------------------------------------------------------------------------------

All URLs referenced in the documentation have the following base:

https://api.oneapi4sms.com/v1/

-------------------------------------------------------------------------------
API CLASS
-------------------------------------------------------------------------------

OneApi4Sms

-------------------------------------------------------------------------------
API FUNCTIONS
-------------------------------------------------------------------------------
Each function is documented well in the OneApi4Sms class 

Here is a short refrence

1.getBaseURL => Function returns Base Request URL.

2.findAvailableAddresses => Function to find all available long codes.

3.getInboundRequestURL => Function to get the Inbound Request URL.

4.addAddress => Function to add an address.
 
5.setSubscribe => Function for setSubscribe process.

6.reportingAllMessages => Function for returning all messages.

7.deliveryStatusForOutbound => Function for checking delivery status

8.sendSMS => Function for sending a message


For Accessing these functions you need to call these methods by creating object
of the class "OneApi4Sms". Refer to the examples provided with the Oneapi4sms API.