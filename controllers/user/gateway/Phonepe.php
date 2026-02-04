<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Phonepe extends Studentgateway_Controller {

    // private $merchant_id;
    // private $salt_key;
    // private $salt_index;
    private $redirect_url;
    private $callback_url;
    // private $api_endpoint;
    
    private $client_id = 'TEST-M22MBBY1B5DAL_25050';
    private $client_secret = 'Mjk3NmE3YTctOTU0NC00ZjFlLWJjNTMtNzdjMmY5NGNiYTQ5';
    private $client_version = '1.0'; // Or whatever version PhonePe provided
    private $api_endpoint = 'https://api-preprod.phonepe.com/apis/pg-sandbox';//'https://api-preprod.phonepe.com/apis/pg-sandbox';

    public function __construct() {
        parent::__construct();
        $this->setting = $this->setting_model->get();
        $this->load->library('mailsmsconf');
        
        // Get PhonePe settings from database
        // $pay_method = $this->paymentsetting_model->getActiveMethod();
        
        // $this->merchant_id = $pay_method->api_publishable_key; // Merchant ID from PhonePe
        // $this->salt_key = $pay_method->api_secret_key; // Salt key from PhonePe
        // $this->salt_index = 1; // Typically 1, but check with PhonePe
        $this->redirect_url = base_url('user/gateway/phonepe/redirect');
        $this->callback_url = base_url('user/gateway/phonepe/callback');
        
        // Set API endpoint based on environment
        $this->api_endpoint = ($pay_method->api_publishable_key == 'test') ? 
            'https://api-preprod.phonepe.com/apis/pg-sandbox' : 
            'https://api.phonepe.com/apis/hermes';
    }

    public function index() {
        $this->session->set_userdata('top_menu', 'Library');
        $this->session->set_userdata('sub_menu', 'book/index');
        $data['params'] = $this->session->userdata('params');
        $data['setting'] = $this->setting;
        $data['student_fees_master_array'] = $data['params']['student_fees_master_array'];
        
        $this->load->view('user/gateway/phonepe/index', $data);
    }

    public function pay() {
        
        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            $session_data = $this->session->userdata('params');
            
            // Validate session data
            if (empty($session_data)) {
                $this->session->set_flashdata('error', 'Invalid session data');
                redirect(base_url('user/user/dashboard'));
            }
   
            // Prepare payment data
            $transaction_id = "TXN".time().mt_rand(1000,9999);
            $amount = ($session_data['fine_amount_balance'] + $session_data['total']) * 100; // Amount in paise
            
            $fee_category = $session_data['student_fees_master_array'][0]['fee_category'] ?? '';
            $student_fees_master_id = $session_data['student_fees_master_array'][0]['student_fees_master_id'] ?? '';
            $fee_groups_feetype_id = $session_data['student_fees_master_array'][0]['fee_groups_feetype_id'] ?? '';
            $student_transport_fee_id = $session_data['student_fees_master_array'][0]['student_transport_fee_id'] ?? '';
            
            $data = array(
                'merchantId' => $this->client_id, // Using Client Id as merchantId
                'merchantTransactionId' => $transaction_id,
                'merchantUserId' => $session_data['student_id'],
                'amount' => $amount,
                'redirectUrl' => $this->redirect_url,
                'redirectMode' => 'POST',
                'callbackUrl' => $this->callback_url,
                'mobileNumber' => $session_data['guardian_phone'],
                'paymentInstrument' => array(
                    'type' => 'PAY_PAGE'
                ),
                'metadata' => array(
                    'fee_category' => $fee_category,
                    'student_fees_master_id' => $student_fees_master_id,
                    'fee_groups_feetype_id' => $fee_groups_feetype_id,
                    'student_transport_fee_id' => $student_transport_fee_id,
                    'total_amount' => $session_data['total'],
                    'fine_amount' => $session_data['fine_amount_balance']
                )
            );
            
            try {
                // Encode the payload
                $base64_payload = base64_encode(json_encode($data));
                
                // Generate X-VERIFY header using Client Secret
                $string = $base64_payload . '/pg/v1/pay' . $this->client_secret;
                $sha256 = hash('sha256', $string);
                $final_x_header = $sha256 . '###' . $this->client_version;
                
                // Make API request to PhonePe
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, 'https://api-preprod.phonepe.com/apis/pg-sandbox/pg/v1/pay');
                curl_setopt($ch, CURLOPT_POST, 1);
                curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode(array('request' => $base64_payload)));
                curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                    'Content-Type: application/json',
                    'X-VERIFY: ' . $final_x_header,
                    'X-CLIENT-ID: ' . $this->client_id,
                    'X-CLIENT-VERSION: ' . $this->client_version,
                    'accept: application/json'
                ));
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_TIMEOUT, 30);
                
                $response = curl_exec($ch);
                $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
                
               
                $curl_error = curl_error($ch);
                curl_close($ch);
                
                if ($curl_error) {
                    throw new Exception("CURL Error: " . $curl_error);
                }
                if ($http_code >= 400) {
                    $error_details = [
                        'timestamp' => date('Y-m-d H:i:s'),
                        'http_code' => $http_code,
                        'response' => $response,
                        'request_payload' => $data, // The data you sent
                        'curl_error' => curl_error($ch)
                    ];
                    echo "<pre>";
                    print_r($error_details);
                    echo "</pre>";
                    exit();
                    log_message('error', 'PhonePe API Error: ' . json_encode($error_details));
                }
            
             // echo "<pre>";
                // print_r($http_code);
                // echo "</pre>";
                // exit();
                if ($http_code == 200) {
                    $response_data = json_decode($response, true);
                    
                    // Log the response for debugging
                    // $this->logPaymentResponse($transaction_id, $response_data);
                    
                    if (isset($response_data['data']['instrumentResponse']['redirectInfo']['url'])) {
                        redirect($response_data['data']['instrumentResponse']['redirectInfo']['url']);
                    } else {
                        $error_msg = $response_data['message'] ?? 'Payment initiation failed';
                        throw new Exception($error_msg);
                    }
                } else {
                    $error_msg = "HTTP Code: $http_code";
                    if ($response) {
                        $error_data = json_decode($response, true);
                        $error_msg .= " | " . ($error_data['message'] ?? 'No error message');
                    }
                    throw new Exception($error_msg);
                }
            } catch (Exception $e) {
                // Error handling remains the same
            }
        } else {
            redirect(base_url('user/user/dashboard'));
        }
    }

    public function redirect() {
        // Handle redirect from PhonePe (user comes back after payment)
        $transaction_id = $this->input->post('transactionId');
        
        if ($transaction_id) {
            // Verify payment status
            $this->verify_payment($transaction_id);
        } else {
            redirect(base_url('user/gateway/payment/paymentfailed'));
        }
    }

    public function callback() {
        $response = $this->input->post();
        
        if (empty($response)) {
            log_message('error', 'Empty callback received from PhonePe');
            show_error('Invalid callback', 400);
            return;
        }
        
        try {
            // Verify the callback signature using Client Secret
            $x_verify = $_SERVER['HTTP_X_VERIFY'] ?? '';
            $client_version = explode('###', $x_verify)[1] ?? '';
            $base64_payload = $response['response'];
            
            $expected_sign = hash('sha256', $base64_payload . $this->client_secret) . '###' . $this->client_version;
            
            if ($x_verify !== $expected_sign) {
                throw new Exception('Invalid callback signature');
            }
            
            // Rest of your callback processing remains the same...
            // [Keep the existing callback handling logic]
        } catch (Exception $e) {
            // Error handling remains the same
        }
    }

    private function verify_payment($transaction_id) {
        // Generate X-VERIFY header
        $string = '/pg/v1/status/' . $this->merchant_id . '/' . $transaction_id . $this->salt_key;
        $sha256 = hash('sha256', $string);
        $final_x_header = $sha256 . '###' . $this->salt_index;
        
        // Make API request to verify payment
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->api_endpoint . '/pg/v1/status/' . $this->merchant_id . '/' . $transaction_id);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'X-VERIFY: ' . $final_x_header,
            'X-MERCHANT-ID: ' . $this->merchant_id,
            'accept: application/json'
        ));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        
        $response = curl_exec($ch);
        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        
        if ($http_code == 200) {
            $response_data = json_decode($response, true);
            if (isset($response_data['code']) && $response_data['code'] == 'PAYMENT_SUCCESS') {
                $this->process_success_payment($response_data);
                redirect(base_url("user/gateway/payment/successinvoice"));
            } else {
                redirect(base_url('user/gateway/payment/paymentfailed'));
            }
        } else {
            redirect(base_url('user/gateway/payment/paymentfailed'));
        }
    }

    private function process_success_payment($payment_data) {
        $params = $this->session->userdata('params');
        
        // Extract metadata from payment
        $metadata = isset($payment_data['data']['metadata']) ? $payment_data['data']['metadata'] : array();
        
        $payment_data = array(
            'date' => date('Y-m-d'),
            'student_id' => $params['student_id'],
            'student_fees_master_id' => isset($metadata['student_fees_master_id']) ? $metadata['student_fees_master_id'] : 0,
            'fee_groups_feetype_id' => isset($metadata['fee_groups_feetype_id']) ? $metadata['fee_groups_feetype_id'] : 0,
            'student_transport_fee_id' => isset($metadata['student_transport_fee_id']) ? $metadata['student_transport_fee_id'] : 0,
            'amount' => isset($metadata['total_amount']) ? $metadata['total_amount'] : 0,
            'fine_amount' => isset($metadata['fine_amount']) ? $metadata['fine_amount'] : 0,
            'amount_detail' => json_encode(array(
                'amount' => isset($metadata['total_amount']) ? $metadata['total_amount'] : 0,
                'amount_fine' => isset($metadata['fine_amount']) ? $metadata['fine_amount'] : 0,
                'amount_discount' => 0,
                'description' => 'Paid via PhonePe',
                'payment_mode' => 'Online',
                'inv_no' => $payment_data['data']['merchantTransactionId'],
                'date' => date('Y-m-d')
            )),
            'payment_mode' => 'PhonePe',
            'transaction_id' => $payment_data['data']['transactionId'],
            'status' => 'success',
            'fee_category' => isset($metadata['fee_category']) ? $metadata['fee_category'] : 'fees'
        );
        
        // Save payment data to database
        $this->load->model('gateway_ins_model');
        $this->gateway_ins_model->add($payment_data);
        
        // Send payment success notification
        $this->mailsmsconf->mailsms('fees_submission', $params);
    }
}