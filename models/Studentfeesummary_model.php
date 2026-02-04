<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Studentfeesummary_model extends MY_Model
{
 public function __construct()
    {
        parent::__construct();
        $this->load->config('ci-blog');
        $this->balance_group   = $this->config->item('ci_balance_group');
        $this->balance_type    = $this->config->item('ci_balance_type');
        $this->current_session = $this->setting_model->getCurrentSession();
    }

     public function getDueFeeByFeeSessionGroup($fee_session_groups_id, $student_fees_master_id)
    {
        $sql = "SELECT student_fees_master.*,fee_groups_feetype.id as `fee_groups_feetype_id`,fee_groups_feetype.amount,fee_groups_feetype.due_date,fee_groups_feetype.fine_amount,fee_groups_feetype.fee_groups_id,fee_groups.name,fee_groups_feetype.feetype_id,feetype.code,feetype.type, IFNULL(student_fees_deposite.id,0) as `student_fees_deposite_id`, IFNULL(student_fees_deposite.amount_detail,0) as `amount_detail` FROM `student_fees_master` INNER JOIN fee_session_groups on fee_session_groups.id = student_fees_master.fee_session_group_id INNER JOIN fee_groups_feetype on  fee_groups_feetype.fee_session_group_id = fee_session_groups.id  INNER JOIN fee_groups on fee_groups.id=fee_groups_feetype.fee_groups_id INNER JOIN feetype on feetype.id=fee_groups_feetype.feetype_id LEFT JOIN student_fees_deposite on student_fees_deposite.student_fees_master_id=student_fees_master.id and student_fees_deposite.fee_groups_feetype_id=fee_groups_feetype.id WHERE student_fees_master.fee_session_group_id =" . $fee_session_groups_id . " and student_fees_master.id=" . $student_fees_master_id . " order by fee_groups_feetype.due_date ASC";

        $query = $this->db->query($sql);
        return $query->result();
    }
    public function getStudentFees_report($section_id = '', $class_id = '', $search_text = '')
    {
        $sql = "SELECT `student_fees_master`.*,fee_groups.name, students.admission_no,students.guardian_name,students.guardian_phone,students.firstname,students.firstname,students.middlename,students.lastname,students.father_name,feetype.id as fee_ttype_id,feetype.type as fee_ttype_type,sections.section, classes.class FROM `student_fees_master` INNER JOIN fee_session_groups on student_fees_master.fee_session_group_id=fee_session_groups.id INNER JOIN student_session on student_session.id=student_fees_master.student_session_id INNER JOIN fee_groups on fee_groups.id=fee_session_groups.fee_groups_id INNER JOIN students on students.id=student_session.student_id inner join classes on student_session.class_id=classes.id INNER JOIN sections on sections.id=student_session.section_id INNER JOIN fee_groups_feetype on fee_groups.id=fee_groups_feetype.fee_groups_id INNER JOIN feetype on feetype.id=fee_groups_feetype.feetype_id WHERE students.is_active ='yes' and fee_session_groups.session_id = " . $this->current_session . " and student_session.session_id = " . $this->current_session;

        if(!empty($section_id)){
            $sql .= " and student_session.section_id=" . $section_id;   
        }

        if(!empty($class_id)){
            $sql .= " and student_session.class_id=" . $class_id;   
        }

        if(!empty($search_text)){
            $sql .= " and (students.firstname LIKE '%" . $search_text."%'";
            $sql .= " or students.middlename LIKE '%" . $search_text."%'";
            $sql .= " or students.lastname LIKE '%" . $search_text."%'"; 
            $sql .= " or students.guardian_name LIKE '%" . $search_text."%'";
            $sql .= " or students.adhar_no LIKE '%" . $search_text."%'";
            $sql .= " or students.samagra_id LIKE '%" . $search_text."%'";
            $sql .= " or students.roll_no LIKE '%" . $search_text."%'";
            $sql .= " or students.admission_no LIKE '%" . $search_text."%'";
            $sql .= " or students.mobileno LIKE '%" . $search_text."%'";
            $sql .= " or students.email LIKE '%" . $search_text."%'";
            $sql .= " or students.religion LIKE '%" . $search_text."%'";
            $sql .= " or students.cast LIKE '%" . $search_text."%'";
            $sql .= " or students.gender LIKE '%" . $search_text."%'";
            $sql .= " or students.current_address LIKE '%" . $search_text."%'";
            $sql .= " or students.permanent_address LIKE '%" . $search_text."%'";
            $sql .= " or students.blood_group LIKE '%" . $search_text."%'";
            $sql .= " or students.bank_name LIKE '%" . $search_text."%'";
            $sql .= " or students.ifsc_code LIKE '%" . $search_text."%'";
            $sql .= " or students.father_name LIKE '%" . $search_text."%'";
            $sql .= " or students.father_phone LIKE '%" . $search_text."%'";
            $sql .= " or students.father_occupation LIKE '%" . $search_text."%'";
            $sql .= " or students.mother_name LIKE '%" . $search_text."%'";
            $sql .= " or students.mother_phone LIKE '%" . $search_text."%'";
            $sql .= " or students.mother_occupation LIKE '%" . $search_text."%'";
            $sql .= " or students.guardian_name LIKE '%" . $search_text."%'";
            $sql .= " or students.guardian_relation LIKE '%" . $search_text."%'";
            $sql .= " or students.guardian_phone LIKE '%" . $search_text."%'";
            $sql .= " or students.guardian_occupation LIKE '%" . $search_text."%'";
            $sql .= " or students.guardian_address LIKE '%" . $search_text."%'";
            $sql .= " or students.guardian_email LIKE '%" . $search_text."%'";
            $sql .= " or students.previous_school LIKE '%" . $search_text."%'";
            $sql .= " or students.note LIKE '%" . $search_text."%')";
        }

        $sql .= " group by id ORDER BY `student_fees_master`.`id`";

        $query  = $this->db->query($sql);
        $result = $query->result(); 
        if (!empty($result)) {
            foreach ($result as $result_key => $result_value) {

                $fee_session_group_id   = $result_value->fee_session_group_id;
                $student_fees_master_id = $result_value->id;
                $result_value->fees     = $this->getDueFeeByFeeSessionGroup($fee_session_group_id, $student_fees_master_id);

                if ($result_value->is_system != 0) {
                    $result_value->fees[0]->amount = $result_value->amount;
                }
            }
        }
        return $result;
    }

}
