<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}
class Webhooks extends CI_Controller {
    
    private $webhookSecret = 'wpmCQ@rt6@Yf5Tz';
    
    public function __construct() {
        parent::__construct();
    }

    public function insta_webhook() {
        $insta_webhook = $this->paymentsetting_model->insta_webhooksalt();

        $data = $_POST;
        $mac_provided = $data['mac'];  // Get the MAC from the POST data
        unset($data['mac']);  // Remove the MAC key from the data.
        $ver = explode('.', phpversion());
        $major = (int) $ver[0];
        $minor = (int) $ver[1];
        if ($major >= 5 and $minor >= 4) {
            ksort($data, SORT_STRING | SORT_FLAG_CASE);
        } else {
            uksort($data, 'strcasecmp');
        }
        // You can get the 'salt' from Instamojo's developers page(make sure to log in first): https://www.instamojo.com/developers
        // Pass the 'salt' without <>
        $mac_calculated = hash_hmac("sha1", implode("|", $data), "$insta_webhook->salt");
        if ($mac_provided == $mac_calculated) {
            if ($data['status'] == "Credit") {
                // Payment was successful, mark it as successful in your database.
                // You can acess payment_request_id, purpose etc here. 
            } else {
                // Payment was unsuccessful, mark it as failed in your database.
                // You can acess payment_request_id, purpose etc here.
            }
        } else {
            echo "MAC mismatch";
        }
    }
    
    public function razorpay()
    {
        $requestBody = file_get_contents('php://input');
        log_message('info', '🔔 Razorpay Webhook Hit. Payload: ' . $requestBody);
        
        $requestBody = file_get_contents('php://input'); // Get POST payload
        $signature = $this->input->server('HTTP_X_RAZORPAY_SIGNATURE');

        // Signature verification
        $expectedSignature = hash_hmac('sha256', $requestBody, $this->webhookSecret);

        if (hash_equals($expectedSignature, $signature)) {
            $payload = json_decode($requestBody, true);
            
            // ✅ Signature valid, handle event
            $this->handleEvent($payload);
            
            // Return 200 OK
            http_response_code(200);
        } else {
            // ❌ Invalid signature
            log_message('error', 'Invalid Razorpay webhook signature');
            http_response_code(400);
        }
    }

    private function handleEvent($payload)
    {
        $event = $payload['event'] ?? '';
        $data = $payload['payload'] ?? [];
    
        log_message('info', '📦 Full Payload: ' . print_r($payload, true));
        log_message('info', '📌 Event Type: ' . $event);
    
        $paymentEntity = $data['payment']['entity'] ?? [];
    
        $paymentId = $paymentEntity['id'] ?? '';
        $amount = ($paymentEntity['amount'] ?? 0) / 100;
        $email = $paymentEntity['email'] ?? '';
    
        // Normalize notes (handle if array or object)
        $notesRaw = $paymentEntity['notes'] ?? [];
        log_message('info', '🗒 Raw Notes Data: ' . print_r($notesRaw, true));
    
        if (is_array($notesRaw) && isset($notesRaw[0]) && is_array($notesRaw[0])) {
            $notes = $notesRaw[0];  // When notes is array with single object inside
            log_message('info', '🗒 Normalized Notes (from array[0]): ' . print_r($notes, true));
        } else {
            $notes = $notesRaw;
            log_message('info', '🗒 Normalized Notes (assoc array): ' . print_r($notes, true));
        }
    
        $date = date('Y-m-d');
    
        // DB connection
        $host = "localhost";
        $db_username = "u199006143_apsnew";
        $db_password = "MMQLl\$rM9";
        $db_name = "u199006143_apsnew";
        $conn7 = mysqli_connect($host, $db_username, $db_password, $db_name);
        log_message('info', '🚀 Starting DB Insert for Razorpay Webhook');
    
        if (mysqli_connect_errno()) {
            log_message('error', '❌ DB connection failed: ' . mysqli_connect_error());
            return;
        } else {
            log_message('info', '✅ DB connected successfully');
        }
    
        // Extract notes data
        $fee_category = mysqli_real_escape_string($conn7, $notes['fee_category'] ?? '');
        $total = mysqli_real_escape_string($conn7, $notes['amount_balance'] ?? 0);
        $fine = mysqli_real_escape_string($conn7, $notes['fine_balance'] ?? 0);
        $student_fees_master_id = mysqli_real_escape_string($conn7, $notes['student_fees_master_id'] ?? 'NULL');
        $fee_groups_feetype_id = mysqli_real_escape_string($conn7, $notes['fee_groups_feetype_id'] ?? 'NULL');
        $student_transport_fee_id = mysqli_real_escape_string($conn7, $notes['student_transport_fee_id'] ?? 'NULL');
    
        // Prepare JSON amount detail
        $myarray = array();
        $myarray[1]['amount'] = $total;
        $myarray[1]['date'] = $date;
        $myarray[1]['amount_discount'] = 0;
        $myarray[1]['amount_fine'] = $fine;
        $myarray[1]['description'] = "Razorpay ID : $paymentId";
        $myarray[1]['received_by'] = "online";
        $myarray[1]['payment_mode'] = "Razorpay";
        $myarray[1]['inv_no'] = 1;
        $myjson = json_encode($myarray);
    
        // Switch based on event
        switch ($event) {
            case 'payment.captured':
                log_message('info', '✅ Event payment.captured for ID: ' . $paymentId);
    
                if ($fee_category == "fees") {
                    $checkSql = "SELECT * FROM student_fees_deposite WHERE student_fees_master_id='$student_fees_master_id' AND fee_groups_feetype_id='$fee_groups_feetype_id'";
                } elseif ($fee_category == "transport") {
                    $checkSql = "SELECT * FROM student_fees_deposite WHERE student_transport_fee_id='$student_transport_fee_id'";
                } else {
                    log_message('error', '❌ Unknown fee_category in Razorpay webhook: ' . $fee_category);
                    return;
                }
    
                log_message('info', '🔍 Checking for duplicate payment: ' . $checkSql);
                $checkResult = mysqli_query($conn7, $checkSql);
    
                if (mysqli_num_rows($checkResult) == 0) {
                    mysqli_query($conn7, "SET FOREIGN_KEY_CHECKS=0");
    
                    $insertSql = "INSERT INTO student_fees_deposite SET 
                        student_fees_master_id='$student_fees_master_id', 
                        fee_groups_feetype_id='$fee_groups_feetype_id', 
                        student_transport_fee_id='$student_transport_fee_id', 
                        amount_detail='$myjson'";
    
                    log_message('info', '📝 Insert SQL: ' . $insertSql);
    
                    if (mysqli_query($conn7, $insertSql)) {
                        log_message('info', "✅ Razorpay Payment inserted successfully: $paymentId");
                    } else {
                        log_message('error', "❌ DB Insert Failed: " . mysqli_error($conn7));
                    }
    
                    mysqli_query($conn7, "SET FOREIGN_KEY_CHECKS=1");
                } else {
                    log_message('info', "⚠️ Duplicate payment ignored: $paymentId");
                }
                break;
    
            case 'payment.failed':
                $error_description = $paymentEntity['error_description'] ?? 'N/A';
                log_message('error', "❌ Razorpay Payment Failed: $paymentId | Amount: $amount | Reason: $error_description");
                break;
    
            default:
                log_message('info', "ℹ️ Unhandled Razorpay Event: $event");
                break;
        }
    
        mysqli_close($conn7);
        log_message('info', '🔚 DB connection closed for Razorpay webhook');
    }



}
