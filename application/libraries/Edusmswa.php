<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Edusmswa
{

    private $_CI;
    public $username = "";
    public $apikey = "";
    public $senderid = "";
	public $tempid = "";
    public $url = "https://apiwa.edusms.in/sendwa/api_body.php";

    public function __construct($array)
    {
        $this->_CI = &get_instance();
 
        $this->username = $array['username'];
        $this->apikey = $array['authkey'];
        $this->senderid = $array['senderid'];
        $this->tempid = $array['templateid'];
    }

    public function sendSMS($to, $message)
    {

        $postData = array(
            "username" => $this->username,
            "apikey" => $this->apikey,
            "sender_phone" => $this->senderid,
            "template_name" => $this->tempid,
			"country_code" => '91',
			"body" => $message,
            "dest_mobileno" => $to,
        );

        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL            => $this->url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING       => "",
            CURLOPT_MAXREDIRS      => 10,
            CURLOPT_TIMEOUT        => 30,
            CURLOPT_HTTP_VERSION   => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST  => "POST",
            CURLOPT_POSTFIELDS     => $postData,
            CURLOPT_SSL_VERIFYHOST => 0,
            CURLOPT_SSL_VERIFYPEER => 0,
        ));

        $response = curl_exec($curl);
        $err      = curl_error($curl);

        curl_close($curl);
        return true;

    }

}
