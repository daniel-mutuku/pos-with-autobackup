<?php

class FortSortGateway 
{
    public $apiURL = "http://sms-backend.fortsortinnovations.co.ke/";
    public $endpoint = "message/send";
	public $CONST_APP_TOKEN = "03a-06b-12c-24d-48e-96f";
	public $REQUEST_APP_TOKEN = "app_token";
	
	
	public function send($msg,$rec,$userkey,$password) 
	{
        
	        $dataToPost = ["app_token" => $this->CONST_APP_TOKEN,
                        	"user_key"=> $userkey,
                            "passcode" => $password,
                            "message" => $msg,
                            "recepients" => [$rec]];
            //add token
            $dataToPost[$this->REQUEST_APP_TOKEN] = $this->CONST_APP_TOKEN;
    
            //Initializes the cURL resource
            $ch = curl_init($this->apiURL.$this->endpoint);
    
            //pass encoded JSON string to the POST fields
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($dataToPost));
    
            //set the content type json
            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
    
            //set return type json
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    
            //execute request
            $response = curl_exec($ch);
    
            //close cURL resource
            curl_close($ch);
    
            return $response;
        
	}
}