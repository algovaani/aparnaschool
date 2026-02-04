<?php 
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Feestatus extends Admin_Controller
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
          
        $this->search_type = $this->config->item('search_type');
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
        
        // Get records - will return all data if no filters applied
        $records = $this->studentfeesummary_model->getStudentFees_report($section_id, $class_id, $search_text);
        
        $students = [];
        $all_fee_types = [];
        $all_feetype_results = $this->db->select('type')->get('feetype')->result_array();
        if(!empty($all_feetype_results)){
            $all_fee_types = array_column($all_feetype_results, 'type');
        }
        
        // REMOVED: if($class_id !="") condition - now processes all data by default
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
                            $total_paid = 0;
                            $total_discount = 0;
                            $total_fine = 0;
                            foreach ($fee_deposits as $fee_deposits_key => $fee_deposits_value) {
                                $total_paid += $fee_deposits_value->amount;
                                $total_discount += $fee_deposits_value->amount_discount;
                                $total_fine += $fee_deposits_value->amount_fine;
                            }
                            
                            // This is the corrected logic to ensure no double-counting
                            $fee_item_total_amount = $_rec_fees->amount;
                            $is_fully_discounted = (number_format($total_discount, 2) == number_format($fee_item_total_amount, 2));
                            if ($is_fully_discounted) {
                                // If it's a 100% discount, the 'Paid' amount is the full fee amount.
                                // The 'Discount' amount is effectively zero for reporting purposes.
                                $students[$main_array][$_rec_fees->type]['paid_fees'] += $fee_item_total_amount;
                                $students[$main_array][$_rec_fees->type]['discount'] += 0;
                            } else {
                                // Otherwise, add the actual paid and discount amounts.
                                $students[$main_array][$_rec_fees->type]['paid_fees'] += $total_paid;
                                $students[$main_array][$_rec_fees->type]['discount'] += $total_discount;
                            }
                            $students[$main_array][$_rec_fees->type]['fine'] += $total_fine;
                        }
                    }
                }
            }
        }
        
        // The balance calculation logic needs to be simplified to prevent the negative balance.
        foreach ($students as $student_key => $fee_types) {
            foreach ($fee_types as $type_key => $fee_data) {
                $total_settled_amount = $fee_data['paid_fees'] + $fee_data['discount'];
                $balance_fee = $fee_data['amount'] - $total_settled_amount;
                
                if ($balance_fee < 0) {
                    $balance_fee = 0;
                }
                $students[$student_key][$type_key]['balance_fee'] = $balance_fee;
            }
        }
        
        $data['sch_setting'] = $this->sch_setting_detail;
        $data['title'] = 'student fees';
        $class = $this->class_model->get();
        $data['classlist'] = $class;
        $data['records'] = $students;
        $data['all_fee_types'] = $all_fee_types;
        $data['section_id'] = $section_id;
        $data['class_id'] = $class_id;
        $data['search_text'] = $search_text;
        
        $this->load->view('layout/header', $data);
        $this->load->view('reports/_fees_report_type', $data);
        $this->load->view('layout/footer', $data);
    }
}
?>
