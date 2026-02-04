<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Cron extends MY_Controller
{

    protected $cron_key;

    /**
     * This is default constructor of the class
     */
    public function __construct($key = "")
    {
        parent::__construct();
        $setting_result = $this->setting_model->getSetting();
        $this->cron_key = $setting_result->cron_secret_key;
        $this->load->model('feereminder_model');
        $this->load->model('calendar_model');
        $this->load->model('customfield_model');
        $this->load->model('class_section_time_model');
        $this->load->model('stuattendence_model');
        $this->load->model('student_model');
        $this->load->model('staff_model');
        $this->load->model('biometric_attendance_model');
        $this->load->library('customlib');
        $this->load->helper('custom');
        if ($this->customlib->getTimeZone()) {
            date_default_timezone_set($this->customlib->getTimeZone());
        } else {
            return date_default_timezone_set('UTC');
        }
    }

    public function index($key = '')
    {

        if ($key != "" && $this->cron_key == $key) {

            $this->autobackup($key);
            $this->feereminder($key);
            $this->eventreminder($key);
            $this->schedulesmsemails($key);
            $this->biometricSync($key);
        } else {
            echo "Invalid Key or Direct access is not allowed";
            return;
        }
    }



    public function student_attendance($key=""){

           if ($key != "" && $this->cron_key != $key) {
                echo "Invalid Key or Direct access is not allowed";
                return;
            }

          $time=date('H:i:s');
          $date=date('Y-m-d');
          $class_sections=$this->class_section_time_model->getAttendanceNotSubmittedByTime($date,$time);
         
          if(!empty($class_sections)){
            $attendance_data=array();
                foreach ($class_sections as $class_key => $class_value) {
                    $attendance_data[]=[
                                        'student_session_id'=>$class_value->student_session_id,
                                        'date'=>date('Y-m-d'),
                                        'attendence_type_id'=>4,
                                      ];
             
                }
            $this->stuattendence_model->batch_insert($attendance_data);
          }

    }



    public function autobackup($key = '')
    {

        if ($key != "") {
            if ($key != "" && $this->cron_key != $key) {
                echo "Invalid Key or Direct access is not allowed";
                return;
            }

            $this->load->dbutil();
            $version  = $this->customlib->getAppVersion();
            $filename = "db_ver_" . $version . '_' . date("Y-m-d_H-i-s") . ".sql";
            $prefs    = array(
                'ignore'     => array(),
                'format'     => 'txt',
                'filename'   => 'mybackup.sql',
                'add_drop'   => true,
                'add_insert' => true,
                'newline'    => "\n",
            );
            $backup = $this->dbutil->backup($prefs);
            $this->load->helper('file');
            write_file('./backup/database_backup/' . $filename, $backup);
        }
    }

    public function feereminder($key = "")
    {
        $setting_result = $this->setting_model->getSetting();
        if ($key != "") {
            if ($key != "" && $this->cron_key != $key) {
                echo "Invalid Key or Direct access is not allowed";
                return;
            }
       
            $this->load->library('mailsmsconf');
            $feereminder   = $this->feereminder_model->get(null, 1);

            $reminter_type = array();
            $studentList   = array();

            if (!empty($feereminder)) {
                foreach ($feereminder as $feereminder_key => $feereminder_value) {
                    if ($feereminder_value->reminder_type == "before") {

                        $date               = date('Y-m-d', strtotime('+' . $feereminder_value->day . ' days'));
                        $fees_type_reminder = $this->feegrouptype_model->getFeeTypeDueDateReminder($date);


                        if (!empty($fees_type_reminder)) {

                            foreach ($fees_type_reminder as $reminder_key => $reminder_value) {

                                $students = $this->feegrouptype_model->getFeeTypeStudents($reminder_value->fee_session_group_id, $reminder_value->id);

                                foreach ($students as $student_key => $student_value) {
                                    $students[$student_key]->{'fee_category'}       = "fees";       
                                    $students[$student_key]->{'fee_group_name'}       = $reminder_value->fee_group_name;
                                    $students[$student_key]->{'due_date'}       = $date;
                                    $students[$student_key]->{'fee_type'}       = $reminder_value->type;
                                    $students[$student_key]->{'fee_code'}       = $reminder_value->code;
                                    $students[$student_key]->{'fee_amount'}     = $reminder_value->amount;
                                    $students[$student_key]->{'due_amount'}     = $reminder_value->amount;
                                    $students[$student_key]->{'deposit_amount'} = number_format((float) 0, 2, '.', '');
                                    $fees_array                                 = json_decode($student_value->amount_detail);
                                    if (json_last_error() == JSON_ERROR_NONE) {
                                        $deposit_amount = 0;
                                        foreach ($fees_array as $fee_collected_key => $fee_collected_value) {
                                            $deposit_amount = $deposit_amount + ($fee_collected_value->amount + $fee_collected_value->amount_discount);
                                        };
                                        $students[$student_key]->{'deposit_amount'} = number_format((float) ($deposit_amount), 2, '.', '');
                                        $students[$student_key]->{'due_amount'}     = number_format((float) ($reminder_value->amount - $deposit_amount), 2, '.', '');
                                    };
                                    $students[$student_key]->{'student_name'} = $this->customlib->getFullName($student_value->firstname, $student_value->middlename, $student_value->lastname, $setting_result->middlename, $setting_result->lastname);
                                    $studentList[]                            = $student_value;
                                }
                            }
                        }
                        $dt="2022-09-09";
                       $transport_fees= $this->studentfeemaster_model->getTransportFeesByDueDate($dt, $dt);
                     


                           if (!empty($transport_fees)) {

                            foreach ($transport_fees as $reminder_key => $reminder_value) {

                                    $transport_fees[$reminder_key]->{'fee_category'}       ="transport";
                                    $transport_fees[$reminder_key]->{'fee_group_name'}   = "Transport";
                                    $transport_fees[$reminder_key]->{'due_date'}       = $date;
                                    $transport_fees[$reminder_key]->{'fee_type'}       = $reminder_value->month;
                                    $transport_fees[$reminder_key]->{'fee_code'}       = "-";
                                    $transport_fees[$reminder_key]->{'fee_amount'}     = $reminder_value->fees;
                                    $transport_fees[$reminder_key]->{'due_amount'}     = $reminder_value->fees;
                                    $transport_fees[$reminder_key]->{'deposit_amount'} = number_format((float) 0, 2, '.', '');
                                    $fees_array                                 = json_decode($reminder_value->amount_detail);
                                    if (isJSON($reminder_value->amount_detail)) {
                                        $deposit_amount = 0;
                                        foreach ($fees_array as $fee_collected_key => $fee_collected_value) {
                                            $deposit_amount = $deposit_amount + ($fee_collected_value->amount + $fee_collected_value->amount_discount);
                                        };
                                        $transport_fees[$reminder_key]->{'deposit_amount'} = number_format((float) ($deposit_amount), 2, '.', '');
                                        $transport_fees[$reminder_key]->{'due_amount'}     = number_format((float) ($reminder_value->amount - $deposit_amount), 2, '.', '');
                                    };
                                    $transport_fees[$reminder_key]->{'student_name'} = $this->customlib->getFullName($reminder_value->firstname, $reminder_value->middlename, $reminder_value->lastname, $setting_result->middlename, $setting_result->lastname);
                                    $studentList[]                            = $reminder_value;
                               
                            }
                        }



                    } else if ($feereminder_value->reminder_type == "after") {

                        $date               = date('Y-m-d', strtotime('-' . $feereminder_value->day . ' days'));
                        $fees_type_reminder = $this->feegrouptype_model->getFeeTypeDueDateReminder($date);

                        if (!empty($fees_type_reminder)) {
                            foreach ($fees_type_reminder as $reminder_key => $reminder_value) {

                                $students = $this->feegrouptype_model->getFeeTypeStudents($reminder_value->fee_session_group_id, $reminder_value->id);

                                foreach ($students as $student_key => $student_value) {
                                    $students[$student_key]->{'fee_category'}       = "fees";
                                    $students[$student_key]->{'due_date'}       = $date;
                                    $students[$student_key]->{'fee_group_name'}       = $reminder_value->fee_group_name;
                                    $students[$student_key]->{'fee_type'}       = $reminder_value->type;
                                    $students[$student_key]->{'fee_code'}       = $reminder_value->code;
                                    $students[$student_key]->{'fee_amount'}     = $reminder_value->amount;
                                    $students[$student_key]->{'due_amount'}     = $reminder_value->amount;
                                    $students[$student_key]->{'deposit_amount'} = number_format((float) 0, 2, '.', '');
                                    $fees_array                                 = json_decode($student_value->amount_detail);
                                    if (json_last_error() == JSON_ERROR_NONE) {
                                        $deposit_amount = 0;
                                        foreach ($fees_array as $fee_collected_key => $fee_collected_value) {

                                            $deposit_amount = $deposit_amount + ($fee_collected_value->amount + $fee_collected_value->amount_discount);
                                        };
                                        $students[$student_key]->{'deposit_amount'} = number_format((float) ($deposit_amount), 2, '.', '');
                                        $students[$student_key]->{'due_amount'}     = number_format((float) ($reminder_value->amount - $deposit_amount), 2, '.', '');
                                    };

                                    $students[$student_key]->{'student_name'} = $this->customlib->getFullName($student_value->firstname, $student_value->middlename, $student_value->lastname, $setting_result->middlename, $setting_result->lastname);
                                    $students[$student_key]->{'school_name'}  = $this->customlib->getSchoolName();
                                    $studentList[]                            = $student_value;
                                }
                            }
                        }



                                   $dt="2022-09-09";
                       $transport_fees= $this->studentfeemaster_model->getTransportFeesByDueDate($dt, $dt);
                     


                           if (!empty($transport_fees)) {

                            foreach ($transport_fees as $reminder_key => $reminder_value) {

                                    $transport_fees[$reminder_key]->{'fee_category'}       ="transport";
                                    $transport_fees[$reminder_key]->{'fee_group_name'}   = "Transport";
                                    $transport_fees[$reminder_key]->{'due_date'}       = $date;
                                    $transport_fees[$reminder_key]->{'fee_type'}       = $reminder_value->month;
                                    $transport_fees[$reminder_key]->{'fee_code'}       = "-";
                                    $transport_fees[$reminder_key]->{'fee_amount'}     = $reminder_value->fees;
                                    $transport_fees[$reminder_key]->{'due_amount'}     = $reminder_value->fees;
                                    $transport_fees[$reminder_key]->{'deposit_amount'} = number_format((float) 0, 2, '.', '');
                                    $fees_array                                 = json_decode($reminder_value->amount_detail);
                                    if (isJSON($reminder_value->amount_detail)) {
                                        $deposit_amount = 0;
                                        foreach ($fees_array as $fee_collected_key => $fee_collected_value) {
                                            $deposit_amount = $deposit_amount + ($fee_collected_value->amount + $fee_collected_value->amount_discount);
                                        };
                                        $transport_fees[$reminder_key]->{'deposit_amount'} = number_format((float) ($deposit_amount), 2, '.', '');
                                        $transport_fees[$reminder_key]->{'due_amount'}     = number_format((float) ($reminder_value->amount - $deposit_amount), 2, '.', '');
                                    };
                                    $transport_fees[$reminder_key]->{'student_name'} = $this->customlib->getFullName($reminder_value->firstname, $reminder_value->middlename, $reminder_value->lastname, $setting_result->middlename, $setting_result->lastname);
                                    $studentList[]                            = $reminder_value;
                               
                            }
                        }


                    }
                }

                if (!empty($studentList)) {
                    foreach ($studentList as $eachStudent_key => $eachStudent_value) {
                        if ($eachStudent_value->due_amount <= 0) {
                            unset($studentList[$eachStudent_key]);
                        }
                    }
                }

                if (!empty($studentList)) {
                    foreach ($studentList as $eachStudent_key => $eachStudent_value) {

                        $this->mailsmsconf->mailsms('fees_reminder', $eachStudent_value);
                    
                    }
                }
            }
        }
    }

    public function eventreminder($key = "")
    {
        $setting_result = $this->setting_model->getSetting();

        if ($key != "") {
            if ($key != "" && $this->cron_key != $key) {
                echo "Invalid Key or Direct access is not allowed";
                return;
            }
            $this->load->library('mailsmsconf');

            $event_reminder = array();

            if ($setting_result->event_reminder == "enabled") {

                $date = date('Y-m-d', strtotime('+' . $setting_result->calendar_event_reminder . ' days'));

                $event_reminder = $this->calendar_model->geteventreminder($date);

                if (!empty($event_reminder)) {
                    foreach ($event_reminder as $event_reminder_key => $event_reminder_value) {

                        if ($event_reminder_value['event_type'] == 'private') {
                            $event_email = $this->staff_model->getstaffemail($event_reminder_value['event_for']);
                            if (!empty($event_email)) {
                                foreach ($event_email as $event_email_key => $event_email_value) {
                                    $event_reminder[$event_reminder_key]['event_email_list'][] = $event_email_value['email'];
                                }
                            }
                        } else if ($event_reminder_value['event_type'] == 'sameforall') {
                            $event_email = $this->staff_model->getEmployee($event_reminder_value['event_for'], 1);
                            if (!empty($event_email)) {
                                foreach ($event_email as $event_email_key => $event_email_value) {
                                    $event_reminder[$event_reminder_key]['event_email_list'][] = $event_email_value['email'];
                                }
                            }
                        } else if ($event_reminder_value['event_type'] == 'public') {
                            $event_email = $this->calendar_model->getstaffandstudentemail();
                            if (!empty($event_email)) {
                                foreach ($event_email as $event_email_key => $event_email_value) {
                                    $event_reminder[$event_reminder_key]['event_email_list'][] = $event_email_value['email'];
                                }
                            }
                        } else if ($event_reminder_value['event_type'] == 'protected') {
                            $event_email = $this->staff_model->searchFullText("", 1);
                            if (!empty($event_email)) {
                                foreach ($event_email as $event_email_key => $event_email_value) {
                                    $event_reminder[$event_reminder_key]['event_email_list'][] = $event_email_value['email'];
                                }
                            }
                        }

                        if (!empty($event_reminder)) {
                            foreach ($event_reminder as $event_reminder_value) {
                                $this->mailsmsconf->sendEailEventReminder($event_reminder_value);
                            }
                        }
                    }
                }
            }

        }
    }

    public function schedulesmsemails($key = "")
    {
        $this->load->library('mailer');
        $this->load->model('messages_model');
        $this->load->library('smsgateway');
        $userdata     = $this->messages_model->get_scheduledata(date('Y-m-d H:i'));
        
        $current_date = date('Y-m-d H:i:s');
        foreach ($userdata as $key => $value) {
               
            $user_list = json_decode($value['user_list'], true);

            if ($value['schedule_date_time'] <= $current_date) {
                $attachments = $this->messages_model->get_message_attachment($value['id']);

                
 
                // Prepare user array for bulk SMS with rate limiting
                $user_array_for_sms = array();
                $sms_count = 0;
                
                foreach ($user_list as $user_listkey => $user_listvalue) {
                    
                    if($user_listvalue['role']=='student'){
                        
                        $user_student   =   $this->student_model->getstudentdetailbyid($user_listvalue['user_id']);
                        $email  =   $user_student['email'];
                        $phone  =   $user_student['mobileno'];
                        
                    }elseif($user_listvalue['role']=='parent'){
                        
                        $user_parent   =   $this->student_model->getstudentdetailbyid($user_listvalue['user_id']);
                        $email  =   $user_parent['guardian_email'];
                        $phone  =   $user_parent['guardian_phone'];
                        
                    }elseif($user_listvalue['role']=='staff'){
                        
                        $user_staff   =   $this->staff_model->getProfile($user_listvalue['user_id']);
                        $email  =   $user_staff['email'];
                        $phone  =   $user_staff['contact_no'];
                        
                    }                 
                    
                    if (!empty($email) && $value['send_mail'] == 1) {
                        $this->mailer->compose_mail($email, $value['title'], $value['message'], $attachments);
                    }

                    // Collect phone numbers for bulk SMS
                    if (!empty($phone) && $value['send_sms'] == 1) {
                        $user_array_for_sms[] = array(
                            'mobileno' => $phone,
                            'role' => $user_listvalue['role'],
                            'user_id' => $user_listvalue['user_id']
                        );
                        $sms_count++;
                    }
                }
                
                // Send SMS with rate limiting
                if (!empty($user_array_for_sms) && $value['send_sms'] == 1) {
                    // Check if using custom WhatsApp API
                    $sms_detail = $this->smsconfig_model->getActiveSMS();
                    if ($sms_detail && $sms_detail->type == 'custom') {
                        // Use bulk SMS with rate limiting for WhatsApp
                        $this->load->library('customsms');
                        $bulk_result = $this->customsms->sendBulkSMS($user_array_for_sms, $value['message'], 20);
                        
                        // Log the results
                        $this->load->model('message_log_model');
                        $log_data = array(
                            'message_id' => $value['id'],
                            'total_recipients' => $bulk_result['total'],
                            'success_count' => $bulk_result['success'],
                            'failed_count' => $bulk_result['failed'],
                            'details' => json_encode($bulk_result['results']),
                            'created_at' => date('Y-m-d H:i:s')
                        );
                        $this->message_log_model->add($log_data);
                    } else {
                        // Use regular SMS gateway for other providers with delay
                        foreach ($user_array_for_sms as $sms_key => $sms_user) {
                            $this->smsgateway->sendSMS($sms_user['mobileno'], $value['message'], $value['title']);
                            // Add small delay for other SMS providers too
                            if ($sms_key < count($user_array_for_sms) - 1) {
                                sleep(2); // 2 seconds delay for regular SMS
                            }
                        }
                    }
                }
                
                $insert['id']   = $value['id'];
                $insert['sent'] = 1;
                $this->messages_model->add($insert);

            }
        }
    }

    /**
     * Biometric Attendance Sync
     * Syncs attendance data from biometric API
     */
    public function biometricSync($key = "")
    {
        if ($key != "" && $this->cron_key != $key) {
            echo "Invalid Key or Direct access is not allowed";
            return;
        }

        // Check if biometric sync is enabled
        $setting = $this->setting_model->getSetting();
        if (!$setting->biometric) {
            echo "Biometric attendance is disabled";
            return;
        }

        // Get API configuration
        $config = $this->biometric_attendance_model->getApiConfig();
        if (!$config || !$config->is_active) {
            echo "Biometric API configuration not found or inactive";
            return;
        }

        // Check if fixed time sync is enabled
        if ($config->sync_enabled) {
            $current_time = date('H:i:s');
            $sync_time = $config->sync_time;
            
            // Check if current time matches sync time (with 5 minutes tolerance)
            $current_timestamp = strtotime($current_time);
            $sync_timestamp = strtotime($sync_time);
            $tolerance = 5 * 60; // 5 minutes in seconds
            
            if (abs($current_timestamp - $sync_timestamp) > $tolerance) {
                echo "Current time ($current_time) does not match sync time ($sync_time). Next sync at $sync_time";
                return;
            }
            
            // Check if already synced today
            $today = date('Y-m-d');
            if ($config->last_sync && date('Y-m-d', strtotime($config->last_sync)) == $today) {
                echo "Already synced today at " . date('H:i:s', strtotime($config->last_sync));
                return;
            }
        } else {
            // Fallback to frequency-based sync
            $last_sync = $config->last_sync;
            $sync_frequency = $config->sync_frequency; // in minutes
            
            if ($last_sync) {
                $last_sync_time = strtotime($last_sync);
                $current_time = time();
                $time_diff = ($current_time - $last_sync_time) / 60; // difference in minutes
                
                if ($time_diff < $sync_frequency) {
                    echo "Sync frequency not reached yet. Next sync in " . ($sync_frequency - $time_diff) . " minutes";
                    return;
                }
            }
        }

        try {
            // Fetch attendance data from API
            $start_date = date('Y-m-d', strtotime('-1 day')); // Yesterday
            $end_date = date('Y-m-d'); // Today
            
            $api_result = $this->biometric_attendance_model->fetchAttendanceFromAPI($start_date, $end_date);
            
            if (!$api_result['success']) {
                echo "API Error: " . $api_result['error'];
                return;
            }

            $attendance_data = $api_result['data'];
            
            if (empty($attendance_data) || !isset($attendance_data['data'])) {
                echo "No attendance data received from API";
                return;
            }

            $records = $attendance_data['data'];
            $total_records = count($records);

            if ($total_records == 0) {
                echo "No attendance records to process";
                return;
            }

            // Process attendance data
            $process_result = $this->biometric_attendance_model->processAttendanceData($records);

            // Log sync activity
            $log_data = array(
                'total_records' => $total_records,
                'processed' => $process_result['processed'],
                'errors' => $process_result['errors'],
                'error_details' => $process_result['error_details']
            );
            $this->biometric_attendance_model->logSyncActivity($log_data);

            // Update last sync time
            $this->biometric_attendance_model->saveApiConfig(array(
                'last_sync' => date('Y-m-d H:i:s')
            ));

            echo "Biometric sync completed successfully. Processed: " . $process_result['processed'] . "/" . $total_records . " records";

        } catch (Exception $e) {
            echo "Biometric sync error: " . $e->getMessage();
            
            // Log error
            $log_data = array(
                'total_records' => 0,
                'processed' => 0,
                'errors' => 1,
                'error_details' => array($e->getMessage())
            );
            $this->biometric_attendance_model->logSyncActivity($log_data);
        }
    }

    /**
     * Manual biometric sync (can be called directly)
     */
    public function manualBiometricSync($key = "")
    {
        if ($key != "" && $this->cron_key != $key) {
            echo "Invalid Key or Direct access is not allowed";
            return;
        }

        $this->biometricSync($key);
    }

}
