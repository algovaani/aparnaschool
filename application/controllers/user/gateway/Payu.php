<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Payu extends Studentgateway_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->setting = $this->setting_model->get();
        $this->setting[0]['currency_symbol'] = $this->customlib->getSchoolCurrencyFormat();
        $this->load->library('mailsmsconf');
    }

    public function index()
    {
        $this->session->set_userdata('top_menu', 'Library');
        $this->session->set_userdata('sub_menu', 'book/index');
        $pre_session_data           = $this->session->userdata('params');
        $txnid                      = substr(hash('sha256', mt_rand() . microtime()), 0, 20);
        $pre_session_data['txn_id'] = $txnid;
        $this->session->set_userdata("params", $pre_session_data);
        $session_data                   = $this->session->userdata('params');
        $session_data['name']           = ($session_data['name'] != "") ? $session_data['name'] : "noname";
        $session_data['email']          = ($session_data['email'] != "") ? $session_data['email'] : "noemail@gmail.com";
        $session_data['guardian_phone'] = ($session_data['guardian_phone'] != "") ? $session_data['guardian_phone'] : "0000000000";
        $session_data['address']        = ($session_data['address'] != "") ? $session_data['address'] : "noaddress";
        $pay_method                     = $this->paymentsetting_model->getActiveMethod();
        //payumoney details
        $amount           = round(number_format((float) (convertBaseAmountCurrencyFormat($session_data['fine_amount_balance'] + $session_data['total'] - $session_data['applied_fee_discount']+ $session_data['gateway_processing_charge'])), 2, '.', ''));
        $customer_name    = $session_data['name'];
        $customer_emial   = 'anupamnayak12070@gmail.com';
        $customer_mobile  = $session_data['guardian_phone'];
        $customer_address = $session_data['address'];
		
		// optional
		$fee_category = $session_data['student_fees_master_array'][0]['fee_category'];
		$student_fees_master_id = $session_data['student_fees_master_array'][0]['student_fees_master_id'];
		$fee_groups_feetype_id = $session_data['student_fees_master_array'][0]['fee_groups_feetype_id'];
		$student_transport_fee_id = $session_data['student_fees_master_array'][0]['student_transport_fee_id'];
		$fee_group_name = $session_data['student_fees_master_array'][0]['fee_group_name'];	
		$total = $session_data['total'];
		$fine_amount_balance = $session_data['fine_amount_balance'];
		$applied_fee_discount = $session_data['applied_fee_discount']; //new line

        $product_info = $fee_category;
        $MERCHANT_KEY = $pay_method->api_secret_key;
        $SALT         = $pay_method->salt;

        //optional udf values
        $udf1 = $total;
        $udf2 = $fine_amount_balance;
        $udf3 = $student_fees_master_id;
        $udf4 = $fee_groups_feetype_id;
        $udf5 = $student_transport_fee_id;

        $hashstring = $MERCHANT_KEY . '|' . $txnid . '|' . $amount . '|' . $product_info . '|' . $customer_name . '|' . $customer_emial . '|' . $udf1 . '|' . $udf2 . '|' . $udf3 . '|' . $udf4 . '|' . $udf5 . '||||||' . $SALT;
        $hash       = strtolower(hash('sha512', $hashstring));

        $success = base_url('user/gateway/payu/success');
        $fail    = base_url('user/gateway/payu/success');
        $cancel  = base_url('user/gateway/payu/success');
        $data    = array(
            'mkey'                      => $MERCHANT_KEY,
            'tid'                       => $txnid,
            'hash'                      => $hash,
            'amount'                    => $amount,
            'student_fees_master_array' => $session_data['student_fees_master_array'],
            'name'                      => $customer_name,
            'productinfo'               => $product_info,
            'mailid'                    => $customer_emial,
            'phoneno'                   => $customer_mobile,
            'address'                   => $customer_address,
            'action'                    => "https://secure.payu.in", //for live change action  https://secure.payu.in
            'sucess'                    => $success,
            'failure'                   => $fail,
            'cancel'                    => $cancel,
			'udf1'                      => $udf1,
			'udf2'                      => $udf2,
			'udf3'                      => $udf3,
			'udf4'                      => $udf4,
			'udf5'                      => $udf5,
        );
        $data['session_data'] = $session_data;
        $data['setting']      = $this->setting;

        $this->load->view('user/gateway/payu/index', $data);
    }

    public function checkout()
    {
        $this->form_validation->set_rules('firstname', $this->lang->line('customer_name'), 'required|trim|xss_clean');
        $this->form_validation->set_rules('phone', $this->lang->line('mobile_number'), 'required|trim|xss_clean');
        $this->form_validation->set_rules('email', $this->lang->line('email'), 'required|valid_email|trim|xss_clean');
        $this->form_validation->set_rules('amount', $this->lang->line('amount'), 'required|trim|xss_clean');

        if ($this->form_validation->run() == false) {
            $data = array(
                'firstname' => form_error('firstname'),
                'phone'     => form_error('phone'),
                'email'     => form_error('email'),
                'amount'    => form_error('amount'),
            );
            $array = array('status' => 'fail', 'error' => $data);
            echo json_encode($array);
        } else {

            $array = array('status' => 'success', 'error' => '');
            echo json_encode($array);
        }
    }

    public function success()
    {
        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            $session_data = $this->session->userdata('params');

            if ($this->input->post('status') == "success") {
                $mihpayid      = $this->input->post('mihpayid');
                $transactionid = $this->input->post('txnid');
                $txn_id        = $session_data['txn_id'];

                if ($txn_id == $transactionid) {
                        redirect(base_url("user/gateway/payment/successinvoice"));
                    } else {
                        redirect(base_url('user/gateway/payment/paymentfailed'));
                    }

                } else {
                    redirect(base_url('user/gateway/payment/paymentfailed'));
                }
            } else {

                redirect(base_url('user/gateway/payment/paymentfailed'));
            }
        }
    }