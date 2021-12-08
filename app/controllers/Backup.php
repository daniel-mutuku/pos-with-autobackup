<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Backup extends CI_Controller {

	/**
	 * 
	 */
    public $_backupStatus = FCPATH . "db".DIRECTORY_SEPARATOR."backupStatus.txt";
    public $_lockedStatus = FCPATH . "db".DIRECTORY_SEPARATOR."lockedStatus.txt";
    const HTTP_OK = 200;
    public $random = "abcdefghijklmnopqrstuvwxyz1234567890";

    public $CONST_APP_TOKEN = "Re(VmR35aDMKdnf/";
    public $CONST_API_URL = "http://localhost:81/project-backupapi/api/";
    public $_exportFile = FCPATH . "db/exports.sql";
    public $apiURL = "http://sms-backend.fortsortinnovations.co.ke/";
    public $endpoint = "message/send";
	public $SMS_APP_TOKEN = "03a-06b-12c-24d-48e-96f";
	public $REQUEST_APP_TOKEN = "app_token";
    
    public function __construct()
    {
        parent::__construct();
    }

	public function index()
	{
        $locked = file_get_contents($this->_lockedStatus);
        if($locked < 1){
            redirect($_SERVER['HTTP_REFERER']);
        }

		$this->load->view('backup/index');
	}

    public function start_backup()
    {

        $msg = "Dear Daniel, the Backup for POS system has started. The system will be locked for 5 mins to ensure a smooth backup. You can continue using the system after 5 mins. Sorry for inconveniences.";

        $this->send($msg,"0717576900");

        file_put_contents($this->_backupStatus, 0);
        file_put_contents($this->_lockedStatus, 1);

        $sql = file_get_contents($this->_exportFile);
        
        $datatopost = array('sql' => $sql);
        $url = $this->getApiUrl('backup/index');

        $response = $this->http_post($url,$datatopost);

        $resArr = json_decode($response,true);
        if($resArr['http_code'] == self::HTTP_OK){
            file_put_contents($this->_backupStatus, 1);
            file_put_contents($this->_exportFile, "");
        }else{
            $msg = "Dear Daniel, the Backup for POS system has failed. The system has rolled back to the previous committed backup. Please check your internet connection before the next back up.";

            $this->send($msg,"0717576900");
        }

    }
    public function complete_backup()
    {
        $locked = file_get_contents($this->_backupStatus);
        if($locked > 0){
            file_put_contents($this->_lockedStatus, 0);
            $msg = "Dear Daniel, the Backup for POS system has completed successfully. You can now continue using the system. Sorry for inconveniences.";

            $this->send($msg,"0717576900");
        }else{
            file_put_contents($this->_backupStatus, 0);
        }

    }

    function getApiUrl($endPoint)
    {
        return $this->CONST_API_URL . $endPoint;
    }

    function http_post($url, $dataToPost)
    {
        
        //add token
        $dataToPost['app_token'] = $this->CONST_APP_TOKEN;

        //Initializes the cURL resource
        $ch = curl_init($url);

        //pass encoded JSON string to the POST fields
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($dataToPost));

        //set the content type json
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));

        //set return type json
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        //execute request
        $response = curl_exec($ch);
        $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        //close cURL resource
        curl_close($ch);

        $result = array('http_code' => $httpcode,'response' => $response);

        // echo $response;die;

        return json_encode($result);
    }

    public function send($msg,$rec) 
	{
	        $dataToPost = ["app_token" => $this->SMS_APP_TOKEN,
                        	"user_key"=> "BbsHNPhqlzyFk9oruGU5DIcXK36ivw",
                            "passcode" => "Admin@2020",
                            "message" => $msg,
                            "recepients" => [$rec]];
            
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
