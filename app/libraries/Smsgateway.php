<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Smsgateway {

    function __construct() {
        
    }

    function sendSMS($username,$apikey,$send_to, $msg,$alpha) {
        // using default Africa is talking 
            require_once('AfricasTalkingGateway.php');
            
            // Specify the numbers that you want to send to in a comma-separated list
            // Please ensure you include the country code (+254 for Kenya in this case)
            if(substr( $send_to, 0, 1 ) === "0") {
                $recipients = '+254'. substr($send_to, 1);
            } else {
                $recipients = $send_to;
            }

            // And of course we want our recipients to know what we really do
            $message    = $msg;
            $gateway    = new AfricasTalkingGateway($username, $apikey);

            try 
            { 
                
                $results = $gateway->sendMessage($recipients, $message, $alpha);
                return "1";
                            
            }
            catch ( AfricasTalkingGatewayException $e )
            {
              log_message('error', "Encountered an error while sending: ".$e->getMessage()); 
              return "0";
            }
    }
    
}

?>