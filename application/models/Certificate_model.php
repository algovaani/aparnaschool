<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Certificate_model extends MY_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->current_session = $this->setting_model->getCurrentSession();
    }

    public function addcertificate($data)
    {
        $this->db->trans_start(); # Starting Transaction
        $this->db->trans_strict(false); # See Note 01. If you wish can remove as well
        //=======================Code Start===========================
        if (isset($data['id'])) {
            $this->db->where('id', $data['id']);
            $this->db->update('certificates', $data);
            $message   = UPDATE_RECORD_CONSTANT . " On  certificates id " . $data['id'];
            $action    = "Update";
            $record_id = $data['id'];
            $this->log($message, $record_id, $action);
            //======================Code End==============================

            $this->db->trans_complete(); # Completing transaction
            /* Optional */

            if ($this->db->trans_status() === false) {
                # Something went wrong.
                $this->db->trans_rollback();
                return false;
            } else {
                //return $return_value;
            }
        } else {
            $this->db->insert('certificates', $data);
            $insert_id = $this->db->insert_id();
            $message   = INSERT_RECORD_CONSTANT . " On certificates id " . $insert_id;
            $action    = "Insert";
            $record_id = $insert_id;
            $this->log($message, $record_id, $action);
            //======================Code End==============================

            $this->db->trans_complete(); # Completing transaction
            /* Optional */

            if ($this->db->trans_status() === false) {
                # Something went wrong.
                $this->db->trans_rollback();
                return false;
            } else {
                //return $return_value;
            }
            return $insert_id;
        }
    }

    public function certificateList()
    {
        $this->db->select('*');
        $this->db->from('certificates');
        $this->db->where('status = 1');
        $this->db->where('created_for = 2');
        $query = $this->db->get();
        return $query->result();
    }

    public function get($id)
    {
        $this->db->select('*');
        $this->db->from('certificates');
        $this->db->where('status = 1');
        $this->db->where('id', $id);
        $query = $this->db->get();
        return $query->result();
    }

    public function remove($id)
    {
        $this->db->trans_start(); # Starting Transaction
        $this->db->trans_strict(false); # See Note 01. If you wish can remove as well
        //=======================Code Start===========================
        $this->db->where('id', $id);
        $this->db->delete('certificates');
        $message   = DELETE_RECORD_CONSTANT . " On certificates id " . $id;
        $action    = "Delete";
        $record_id = $id;
        $this->log($message, $record_id, $action);
        //======================Code End==============================
        $this->db->trans_complete(); # Completing transaction
        /* Optional */
        if ($this->db->trans_status() === false) {
            # Something went wrong.
            $this->db->trans_rollback();
            return false;
        } else {
            //return $return_value;
        }
    }

    public function getstudentcertificate()
    {
        $this->db->select('*');
        $this->db->from('certificates');
        $this->db->where('created_for = 2');
        $query = $this->db->get();
        return $query->result();
    }

    public function certifiatebyid($id)
    {
        $this->db->select('*');
        $this->db->from('certificates');
        $this->db->where('id', $id);
        $query = $this->db->get();
        return $query->row();
    }

    /**
     * Record that a certificate was issued to a student (call when certificate is generated/printed)
     */
    public function recordIssue($student_id, $student_session_id, $certificate_id)
    {
        if (!$this->db->table_exists('certificate_issue')) {
            return false;
        }
        $issued_date = date('Y-m-d');
        $session_id = $this->current_session;
        $data = array(
            'student_id' => $student_id,
            'student_session_id' => $student_session_id,
            'certificate_id' => $certificate_id,
            'issued_date' => $issued_date,
            'session_id' => $session_id,
        );
        $this->db->insert('certificate_issue', $data);
        return $this->db->insert_id();
    }

    /**
     * Get list of students who were issued a given certificate (with issue date). Optional class/section filter.
     */
    public function getIssuedListByCertificate($certificate_id, $class_id = null, $section_id = null)
    {
        if (!$this->db->table_exists('certificate_issue')) {
            return array();
        }
        $this->db->select('certificate_issue.id as issue_id, certificate_issue.issued_date as certificate_issue_date, students.id, students.admission_no, students.firstname, students.middlename, students.lastname, students.father_name, students.dob, students.gender, students.mobileno, students.guardian_name, IFNULL(categories.category, "") as category, IFNULL(classes.class, "-") as class, IFNULL(sections.section, "") as section');
        $this->db->from('certificate_issue');
        $this->db->join('students', 'students.id = certificate_issue.student_id');
        $this->db->join('student_session', 'student_session.student_id = students.id AND student_session.session_id = certificate_issue.session_id', 'left');
        $this->db->join('classes', 'classes.id = student_session.class_id', 'left');
        $this->db->join('sections', 'sections.id = student_session.section_id', 'left');
        $this->db->join('categories', 'categories.id = students.category_id', 'left');
        $this->db->where('certificate_issue.certificate_id', $certificate_id);
        $this->db->where('certificate_issue.session_id', $this->current_session);
        if (!empty($class_id)) {
            $this->db->where('student_session.class_id', $class_id);
        }
        if (!empty($section_id)) {
            $this->db->where('student_session.section_id', $section_id);
        }
        $this->db->group_by('certificate_issue.id');
        $this->db->order_by('certificate_issue.issued_date', 'DESC');
        $this->db->order_by('students.firstname', 'ASC');
        $query = $this->db->get();
        return $query->result_array();
    }

}
