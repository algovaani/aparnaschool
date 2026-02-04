<?php


if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Easebuzz extends Studentgateway_Controller {
	

    public function __construct()
    {
        parent::__construct();
        $this->setting = $this->setting_model->get();
        $this->setting[0]['currency_symbol'] = $this->customlib->getSchoolCurrencyFormat();
		//$this->load->library('Easebuzz_lib');
        $this->load->library('mailsmsconf');
    }

    public function index()
    {
        $this->session->set_userdata('top_menu', 'Library');
        $this->session->set_userdata('sub_menu', 'book/index');
        $data['params']         = $this->session->userdata('params');
        $data['setting']        = $this->setting;
        
        $data['student_fees_master_array']=$data['params']['student_fees_master_array'];
        $this->load->view('user/gateway/easebuzz/index', $data);
    } 

    public function pay()
    {
		

        if ($this->input->server('REQUEST_METHOD') == 'POST') {
			
            $session_data            = $this->session->userdata('params');
            $pay_method              = $this->paymentsetting_model->getActiveMethod();

			$MERCHANT_KEY = $pay_method->api_secret_key;
			$SALT = $pay_method->salt;
			$ENV = 'prod';
			
			$email = 'anupamnayak12070@gmail.com';
			$phone = $_POST['phone'];
			$firstname = $session_data['name'];
			$order_id = "order_".time().mt_rand(100,999);
			$amount = number_format((float) ($session_data['fine_amount_balance'] + $session_data['total']), 2, '.', '');
			$rurl = base_url('user/gateway/easebuzz/success');
			
			// by me
			$fee_category = $session_data['student_fees_master_array'][0]['fee_category'];
			$student_fees_master_id = $session_data['student_fees_master_array'][0]['student_fees_master_id'];
			$fee_groups_feetype_id = $session_data['student_fees_master_array'][0]['fee_groups_feetype_id'];
			$student_transport_fee_id = $session_data['student_fees_master_array'][0]['student_transport_fee_id'];
			$fee_group_name = $session_data['student_fees_master_array'][0]['fee_group_name'];
			
			$total = $session_data['total'];
			$fine_amount_balance = $session_data['fine_amount_balance'];
			
			//$fee_type_code = $session_data['student_fees_master_array'][0]['fee_type_code'];
			//$admission_no = $session_data['admission_no'];
			//$admission_no2 = preg_replace("/[^0-9a-zA-Z ]/", "", $admission_no);
			

			
			
		
include_once 'Easebuzz_lib/Easebuzz_lib.php';		
//$easebuzzObj = $this->Easebuzz_lib($MERCHANT_KEY, $SALT, $ENV);
$easebuzzObj = new Easebuzz_lib($MERCHANT_KEY, $SALT, $ENV);
$postData = array ("txnid" => $order_id,
                   "amount" => $amount,
				   "firstname" => $firstname,
				   "phone" => $phone,
				   "email" => $email,
				   "productinfo" => $fee_category,
				   "surl" => $rurl,
				   "furl" => $rurl,
				   "udf1" => $total,
				   "udf2" => $fine_amount_balance,
				   "udf3" => $student_fees_master_id,
				   "udf4" => $fee_groups_feetype_id,
				   "udf5" => $student_transport_fee_id,
				   "udf6" => "",
				   "udf7" => "",
				   "address1" => "",
				   "address2" => "",
				   "city" => "",
				   "state" => "",
				   "country" => "",
				   "zipcode" => ""
				   );		
$easebuzzObj->initiatePaymentAPI($postData);
        } else {
            redirect(base_url('user/user/dashboard'));
        }
    }





    public function success()
    {
     $session_data = $this->session->userdata('params');
        
        if (!empty($session_data)) {
			
			include_once 'Easebuzz_lib/Easebuzz_lib.php';
			$pay_method = $this->paymentsetting_model->getActiveMethod();
			$SALT = $pay_method->salt;
			
			$easebuzzObj = new Easebuzz_lib($MERCHANT_KEY = null, $SALT, $ENV = null); 			
			$result = $easebuzzObj->easebuzzResponse( $_POST );
			$result2 = json_decode($result, true);
			$status2 = $result2['status'];

			if ($status2 == 1) {
				$status = strtolower($result2['data']['status']);
				$order_id = $result2['data']['txnid'];
				//$easebuzz_txnid = $result2['data']['easepayid'];
				
				
            if ($status == "success") {
			redirect(base_url("user/gateway/payment/successinvoice")); 
	
	}
	else{
		redirect(base_url('user/gateway/payment/paymentfailed'));
		}
	}
	else{
		redirect(base_url('user/gateway/payment/paymentfailed'));
		}	
	}
	else{
		redirect(base_url('user/gateway/payment/paymentfailed'));
		}
	
	
	
	}

    public function cancel()
    {
    redirect(base_url('user/gateway/payment/paymentfailed'));
    }

}