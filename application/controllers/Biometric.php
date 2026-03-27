<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Biometric extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();

        $this->load->helper('json_output');
        $this->load->library('mailsmsconf');
        $this->load->model(['setting_model', 'student_model', 'stuattendence_model', 'studentAttendaceSetting_model', 'staffAttendaceSetting_model']);
    }

    public function index()
    {
        $method = $this->input->server('REQUEST_METHOD');
        if ($method != 'POST') {
            json_output(400, array('status' => 400, 'message' => 'Bad request.'));
            return;
        }

        $raw = file_get_contents('php://input');
        $params = json_decode($raw, true);
        if (!is_array($params)) {
            json_output(400, array('status' => 400, 'message' => 'Invalid JSON body'));
            return;
        }

        $serial_number = isset($params['serial_number']) ? trim((string) $params['serial_number']) : '';
        $user_id       = isset($params['user_id']) ? trim((string) $params['user_id']) : '';
        $t             = isset($params['t']) ? trim((string) $params['t']) : '';

        if ($serial_number === '' || $user_id === '' || $t === '') {
            json_output(422, array('status' => 422, 'message' => 'Missing required fields: serial_number, user_id, t'));
            return;
        }

        $settings = $this->setting_model->getSchoolDetail();
        $is_local = isset($_SERVER['HTTP_HOST']) && (
            strpos($_SERVER['HTTP_HOST'], 'localhost') !== false
            || strpos($_SERVER['HTTP_HOST'], '127.0.0.1') !== false
        );

        // On local dev, be permissive: allow biometric even if not configured and skip device list check.
        if (!$is_local) {
            if (empty($settings) || empty($settings->biometric)) {
                json_output(403, array('status' => 403, 'message' => 'Biometric is disabled in settings'));
                return;
            }

            $total_devices = array_filter(array_map('trim', explode(",", (string) $settings->biometric_device)));
            if (!in_array($serial_number, $total_devices, true)) {
                json_output(403, array('status' => 403, 'message' => 'Device not allowed', 'serial_number' => $serial_number));
                return;
            }
        }

        $record_data = $this->student_model->biometric_attendance($user_id);
        if (empty($record_data) || empty($record_data->table_type)) {
            json_output(404, array('status' => 404, 'message' => 'User not found for biometric mapping', 'user_id' => $user_id));
            return;
        }

        $insert_result = null;
        if ($record_data->table_type == "staff") {
            $insert_record = array(
                'date'                  => date('Y-m-d', strtotime($t)),
                'staff_id'              => $record_data->id,
                'staff_attendance_type_id' => '',
                'biometric_attendence'  => 1,
                'remark'                => '',
                'created_at'            => $t,
                'biometric_device_data' => $raw,
            );
            $insert_result = $this->staffattendancemodel->onlineattendence($insert_record, isset($record_data->staff_role) ? $record_data->staff_role : null);
        } elseif ($record_data->table_type == "student") {
            $insert_record = array(
                'date'                  => date('Y-m-d', strtotime($t)),
                'student_session_id'    => $record_data->id,
                'attendence_type_id'    => '',
                'biometric_attendence'  => 1,
                'remark'                => '',
                'created_at'            => $t,
                'biometric_device_data' => $raw,
            );
            $insert_result = $this->stuattendence_model->onlineattendence($insert_record, isset($record_data->class_section_id) ? $record_data->class_section_id : null);
        } else {
            json_output(400, array('status' => 400, 'message' => 'Unsupported table_type', 'table_type' => $record_data->table_type));
            return;
        }

        if ($insert_result === 1 || $insert_result === true) {
            json_output(200, array('status' => 200, 'message' => 'Attendance submitted'));
            return;
        }
        if ($insert_result === 0) {
            json_output(200, array('status' => 200, 'message' => 'Attendance already submitted'));
            return;
        }
        if ($insert_result === 2) {
            json_output(200, array('status' => 200, 'message' => 'Attendance setting not configured, or contact to admin'));
            return;
        }

        json_output(500, array('status' => 500, 'message' => 'Attendance insert failed', 'result' => $insert_result));
    }
}
