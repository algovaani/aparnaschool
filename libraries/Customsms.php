<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Customsms {

    private $_CI;

    // WhatsApp API credentials
    var $whatsapp_api_key = "x9MVPSHwfgZYP83BSonNUyaMdhMDANZw";
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
    curl_setopt($ch, CURLOPT_TIMEOUT, 30); // 30 seconds timeout
    $response = curl_exec($ch);
    curl_close($ch);

    return $response; // API response
}

   function sendBulkSMS($recipients, $message, $delay_seconds = 15) {
    $results = array();
    $success_count = 0;
    $failed_count = 0;
    
    foreach ($recipients as $index => $recipient) {
        // Skip if mobile number is empty
        if (empty($recipient['mobileno'])) {
            $results[] = array(
                'number' => $recipient['mobileno'] ?? 'N/A',
                'status' => 'failed',
                'error' => 'Empty mobile number'
            );
            $failed_count++;
            continue;
        }
        
        try {
            // Send SMS
            $response = $this->sendSMS($recipient['mobileno'], $message);
            
            // Check if response indicates success (you may need to adjust this based on your API response)
            if ($response !== false && !empty($response)) {
                $results[] = array(
                    'number' => $recipient['mobileno'],
                    'status' => 'success',
                    'response' => $response
                );
                $success_count++;
            } else {
                $results[] = array(
                    'number' => $recipient['mobileno'],
                    'status' => 'failed',
                    'error' => 'API returned empty response'
                );
                $failed_count++;
            }
            
        } catch (Exception $e) {
            $results[] = array(
                'number' => $recipient['mobileno'],
                'status' => 'failed',
                'error' => $e->getMessage()
            );
            $failed_count++;
        }
        
        // Add delay between messages (except for the last one)
        if ($index < count($recipients) - 1) {
            sleep($delay_seconds);
        }
    }
    
    return array(
        'total' => count($recipients),
        'success' => $success_count,
        'failed' => $failed_count,
        'results' => $results
    );
}


}

?>
