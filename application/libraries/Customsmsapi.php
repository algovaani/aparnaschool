<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Customsms {

    private $_CI;

    // WhatsApp API credentials
    var $whatsapp_api_key = "ZjHMlUO9zu8gwYfScllYzXpEpQcWPA";
    var $whatsapp_sender  = "919334941173"; // Sender number

    function __construct($params) { 
        $this->_CI = & get_instance();
        $this->session_name = $this->_CI->setting_model->getCurrentSessionName();
    } 

   function sendSMS($to, $message) {
    // Ensure number has +91 prefix
    $to = preg_replace('/^\+?91/', '', $to); // remove existing +91 if already present
    $to = '+91' . $to;

    // Build WhatsApp API URL
    $wa_url = "http://web.mastermindz.in/send-message" .
              "?api_key=" . urlencode($this->whatsapp_api_key) .
              "&sender=" . urlencode($this->whatsapp_sender) .
              "&number=" . urlencode($to) .
              "&message=" . urlencode($message);

    // Send via cURL
    $ch = curl_init($wa_url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    curl_close($ch);

    return $response; // API response
}


}

?>
