<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Feestatusassign extends Admin_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('smsgateway');
        $this->load->library('mailsmsconf');
        $this->load->library('customlib');
                $this->load->library('media_storage');
         $this->load->model("module_model");
         $this->load->model("studentfeesummary_model");
         
        $this->search_type        = $this->config->item('search_type');
        $this->sch_setting_detail = $this->setting_model->getSetting();
    }

    public function index()
    {
        if (!$this->rbac->hasPrivilege('super_admin', 'can_access_feestatus')) {
        access_denied();
    }
        
        $search_text = $this->input->post('search_text');
        $class_id    = $this->input->post('class_id');
        $section_id  = $this->input->post('section_id');

        $records = $this->studentfeesummary_model->getStudentFees_report($section_id, $class_id, $search_text);
        $students = [];
        $all_fee_types = [] ;
        $all_feetype_results = $this->db->select('type')->get('feetype')->result_array();

        if(!empty($all_feetype_results)){
            $all_fee_types = array_column($all_feetype_results, 'type');
        }
        
        foreach($records as $record){
            if(in_array($record->fee_ttype_type, $all_fee_types)){
                $main_array = $record->student_session_id.'---'.$record->firstname.' '.$record->middlename.'---'.$record->class.'('.$record->section.')'.'---'.$record->admission_no.'---'.$record->guardian_name.'---'.$record->guardian_phone;
                
                
                if(!empty($record->fees)){
                    foreach($record->fees as $_rec_fees){
                        if(!isset($students[$main_array][$_rec_fees->type]['fees'])){
                            $students[$main_array][$_rec_fees->type] = [
                                'amount' => 0,
                                'fees' => [],
                                'paid_fees' => 0,
                                'discount' => 0,
                                'fine' => 0
                            ];
                        }
                        
                        $students[$main_array][$_rec_fees->type]['amount'] += $_rec_fees->amount;
                        array_push($students[$main_array][$_rec_fees->type]['fees'], $_rec_fees);
                        if(!empty($_rec_fees->amount_detail)){
                            $fee_deposits = json_decode($_rec_fees->amount_detail);

                            $discount_and_fine = 0;
                            foreach ($fee_deposits as $fee_deposits_key => $fee_deposits_value) {
                                $students[$main_array][$_rec_fees->type]['paid_fees'] += $fee_deposits_value->amount;
                                $students[$main_array][$_rec_fees->type]['paid_fees'] += $fee_deposits_value->amount_discount;
                                $students[$main_array][$_rec_fees->type]['fine'] += $fee_deposits_value->amount_fine;
                            }
                        }
                    }
                }
            }
        }
        $data['sch_setting'] = $this->sch_setting_detail;
        $data['title']       = 'student fees';
        $class               = $this->class_model->get();
        $data['classlist']   = $class;
        $data['records'] = $students;
        $data['all_fee_types'] = $all_fee_types;
        $data['section_id'] = $section_id;
        $data['class_id'] = $class_id;
        $data['search_text'] = $search_text;
        $this->load->view('layout/header', $data);
        $this->load->view('reports/_fees_report_type_assign', $data);
        $this->load->view('layout/footer', $data);
    }
}