<!DOCTYPE html>
<html>
<head>
    <title><?php echo $this->lang->line('attendance'); ?></title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <style type="text/css">
        /* Base styles for the attendance tabs and remarks input (desktop & mobile common) */
        .attendance-tab-container {
            display: flex;
            gap: 5px;
            align-items: center;
            flex-wrap: nowrap; /* Forces tabs to stay on a single line */
            overflow-x: auto;
            /* Adds horizontal scroll if content overflows */
            padding-bottom: 5px;
            /* Ensures space for scrollbar */
        }

        .attendance-tab {
            display: inline-block;
            padding: 8px 15px;
            border: 1px solid #cccccc;
            border-radius: 4px;
            cursor: pointer;
            background-color: #f0f0f0;
            color: #333;
            transition: background-color 0.2s ease, color 0.2s ease, border-color 0.2s ease;
            user-select: none;
            font-size: 14px;
            line-height: 1.42857143;
            flex-shrink: 0;
            /* Prevents tabs from shrinking */
        }

        .attendance-tab:hover {
            background-color: #e0e0e0;
            border-color: #b0b0b0;
        }

        /* Specific active tab colors */
        .active-present {
            background-color: #5cb85c;
            /* Green */
            border-color: #4cae4c;
            color: #fff;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .active-absent {
            background-color: #d9534f;
            /* Red */
            border-color: #d43f3a;
            color: #fff;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .active-late {
            background-color: #f0ad4e;
            /* Yellow/Orange */
            border-color: #eea236;
            color: #fff;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .active-half_day {
            background-color: #5bc0de;
            /* Blue */
            border-color: #46b8da;
            color: #fff;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        /* Hide the actual radio buttons visually */
        .hidden_radio {
            opacity: 0;
            position: absolute;
            width: 0;
            height: 0;
            pointer-events: none;
        }

        /* Styles for the "Mark as Holiday" checkbox button */
        .button-checkbox > .btn span.state-icon {
            margin-right: 5px;
        }
        .button-checkbox > .btn.active {
            background-color: #5cb85c;
            border-color: #4cae4c;
        }
        .button-checkbox > .btn {
            background-color: #337ab7;
            border-color: #2e6da4;
            color: #fff;
        }

        /* General layout styles (ensure these match your AdminLTE/Bootstrap setup) */
        .content-wrapper { min-height: 946px;
        }
        .content-header h1 { font-size: 24px; margin: 0 0 10px 0; line-height: 1;
        }
        .box { border-radius: 3px; background: #ffffff; border-top: 3px solid #d2d6de; margin-bottom: 20px;
            width: 100%; box-shadow: 0 1px 1px rgba(0,0,0,0.1); }
        .box-header { color: #444;
            display: block; padding: 10px; position: relative; }
        .box-header.with-border { border-bottom: 1px solid #f4f4f4;
        }
        .box-title { display: inline-block; font-size: 18px; margin: 0; line-height: 1;
        }
        .box-body { border-top-left-radius: 0; border-top-right-radius: 0; border-bottom-right-radius: 3px; border-bottom-left-radius: 3px; padding: 10px;
        }
        .form-group { margin-bottom: 15px;
        }
        .req { color: red;
        }
        .table-responsive { min-height: .01%; overflow-x: auto;
        }
        .table { width: 100%; max-width: 100%; margin-bottom: 20px; background-color: transparent; border-collapse: collapse;
            border-spacing: 0; }
        .table > thead > tr > th, .table > tbody > tr > td { padding: 8px;
            line-height: 1.42857143; vertical-align: top; border-top: 1px solid #ddd; }
        .table-hover > tbody > tr:hover { background-color: #f5f5f5;
        }
        .btn { display: inline-block; padding: 6px 12px; margin-bottom: 0; font-size: 14px;
            font-weight: 400; line-height: 1.42857143; text-align: center; white-space: nowrap; vertical-align: middle; cursor: pointer; border: 1px solid transparent; border-radius: 4px;
        }
        .btn-primary { color: #fff; background-color: #337ab7; border-color: #2e6da4;
        }
        .btn-primary:hover { background-color: #286090; border-color: #204d74;
        }
        .pull-right { float: right !important;
        }
        .checkbox-toggle { display: inline-block; vertical-align: middle;
        }
        .alert { padding: 15px; margin-bottom: 20px; border: 1px solid transparent; border-radius: 4px;
        }
        .alert-success { color: #3c763d; background-color: #dff0d8; border-color: #d6e9c6;
        }
        .alert-warning { color: #8a6d3b; background-color: #fcf8e3; border-color: #faebcc;
        }
        th.noteinput, td.noteinput { width: 15%; max-width: 15%;
        }
        .noteinput { width: 100%; box-sizing: border-box; padding: 6px 8px; font-size: 13px;
            line-height: 1.42857143; color: #555; background-color: #fff; background-image: none; border: 1px solid #ccc; border-radius: 4px; box-shadow: inset 0 1px 1px rgba(0,0,0,.075);
            transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s; }

        /* --- View Switching Logic (Desktop vs Mobile) --- */
        .mobile-only-view {
            display: none;
            /* Hidden by default (on desktop) */
        }
        .desktop-only-view {
            display: block;
            /* Visible by default (on desktop) */
            /* Ensure the table itself doesn't wrap unnecessarily if its content is too wide */
            white-space: nowrap;
            overflow-x: auto;
        }

        /* --- Mobile Specific Styles (Card View) --- */
        @media (max-width:767px){
            .desktop-only-view {
                display: none;
                /* Hide the entire table on mobile */
            }

            .mobile-only-view {
                display: block;
                /* Show cards on mobile */
            }

            .student-card-mobile {
                border: 1px solid #ddd;
                border-radius: 5px;
                padding: 15px;
                margin-bottom: 15px;
                box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            }

            /* Card background colors (cyclical) */
            .card-bg-1 { background-color: #e6f2ff;
                /* Light Blue */ }
            .card-bg-2 { background-color: #e6ffe6;
                /* Light Green */ }
            .card-bg-3 { background-color: #fffde6;
                /* Light Yellow */ }
            .card-bg-4 { background-color: #ffe6f2;
                /* Light Pink */ }
            .card-bg-5 { background-color: #f2f2f2;
                /* Light Grey */ }


            .student-card-mobile .card-row {
                display: flex;
                flex-wrap: wrap; /* Allows items within the row to wrap if needed */
                justify-content: space-between;
                margin-bottom: 8px;
            }

            /* Specifically for #, Admission No and Roll No. to be closer in mobile */
            .student-card-mobile .card-row.student-info-row {
                justify-content: flex-start;
                /* Align items to the start */
                gap: 10px;
                /* Reduced gap between these specific items */
            }
            .student-card-mobile .card-row.student-info-row .card-item {
                flex-grow: 0;
                flex-shrink: 0;
                flex-basis: auto; /* Take only content width */
                /* No margin-right here, gap handles it */
            }

            .student-card-mobile .card-label {
                font-weight: normal;
                /* Default label font weight */
                color: #555;
                font-size: 12px; /* Smaller font for general labels */
                display: inline;
                /* Keep label inline with value by default */
                margin-right: 4px;
                /* Small space between label and value */
            }

            /* Make Admission No., Roll No., and Name labels bold in mobile cards */
            .student-card-mobile .card-label.bold-label {
                font-weight: bold !important;
                /* Explicitly bold for these labels */
            }

            /* Styling for the values themselves in mobile view */
            .student-card-mobile .card-value {
                font-size: 14px;
                /* Default value font size */
                color: #333;
            }

            /* Specific styling for Admission No. in mobile card */
            .student-card-mobile .card-item > .card-value.admission-no-value {
                color: #000066;
                /* Dark blue */
                font-size: 12px;
                font-weight: bold;
            }

            /* Specific styling for Name in mobile card - CORRECTED TO BE DYNAMIC */
            /* This will be set by JavaScript based on background color */
            .student-card-mobile .card-item > .card-value.name-value {
                font-size: 14px;
                font-weight: normal; /* Ensure it's not bold unless specifically requested */
                /* Color will be set dynamically by JS */
            }

            /* For full-width items like Name and Biometric Date, ensure label and value are inline-block */
            .student-card-mobile .card-row.full-width-item .card-item .card-label,
            .student-card-mobile .card-row.full-width-item .card-item .card-value {
                display: inline-block;
                /* Make label and value sit side-by-side */
                vertical-align: middle;
                /* Align them nicely */
            }
            /* Add margin for label in full-width items */
            .student-card-mobile .card-row.full-width-item .card-item .card-label {
                margin-bottom: 0;
                /* Remove previous block margin */
                margin-right: 5px;
                /* Small gap between label and value */
            }


            .student-card-mobile .attendance-section,
            .student-card-mobile .note-section {
                margin-top: 15px;
                padding-top: 10px;
                border-top: 1px dashed #eee;
            }
            .student-card-mobile .attendance-section .card-label,
            .student-card-mobile .note-section .card-label {
                margin-bottom: 8px;
            }

            /* The attendance-tab-container already has nowrap and overflow-x: auto
                from its global definition, ensuring a single line with scroll on mobile.
            */
        }
</style>

<div class="content-wrapper" style="min-height: 946px;">
    <section class="content-header">
        <h1><i class="fa fa-sitemap"></i> <?php echo $this->lang->line('human_resource'); ?></h1>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title"><i class="fa fa-search"></i> <?php echo $this->lang->line('select_criteria'); ?></h3>
                    </div>
                    <form id='form1' action="<?php echo site_url('admin/staffattendance/index') ?>" method="post" accept-charset="utf-8">
                        <div class="box-body">
                            <?php
                            if ($this->session->flashdata('msg')) {
                                echo $this->session->flashdata('msg');
                                $this->session->unset_userdata('msg');
                            }
                            ?>
                            <?php echo $this->customlib->getCSRF(); ?>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1"><?php echo $this->lang->line('role'); ?></label>
                                        <select autofocus="" id="class_id" name="user_id" class="form-control" >
                                            <option value="select"><?php echo $this->lang->line('select'); ?></option>
                                            <?php
                                            foreach ($classlist as $key => $class) {
                                                ?>
                                                <option value="<?php echo $class["type"] ?>"   <?php
                                                if ($class["type"] == $user_type_id) {
                                                    echo "selected =selected";
                                                }
                                                ?>><?php print_r($class["type"])?></option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                        <span class="text-danger"><?php echo form_error('class_id'); ?></span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">
                                            <?php echo $this->lang->line('attendance_date'); ?></label>
                                        <input  name="date" placeholder="" type="text" class="form-control date"  value="<?php echo set_value('date', date($this->customlib->getSchoolDateFormat())); ?>" readonly="readonly"/>
                                        <span class="text-danger"><?php echo form_error('date'); ?></span>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <button type="submit" name="search" value="search" class="btn btn-primary btn-sm pull-right checkbox-toggle"><i class="fa fa-search"></i> <?php echo $this->lang->line('search'); ?></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    <?php
                    if (isset($resultlist)) {
                        ?>
                        <div class="box-header ptbnull"></div>
                        <div class="box-header with-border">
                            <h3 class="box-title"><i class="fa fa-users"></i> <?php echo $this->lang->line('staff_list'); ?></h3>
                            <div class="box-tools pull-right">
                            </div>
                        </div>
                        <div class="box-body">
                            <?php
                            if (!empty($resultlist)) {
                                $checked = "";
                                if (!isset($msg)) {
                                    if (isset($resultlist[0]) && $resultlist[0]['staff_attendance_type_id'] != "") {
                                        if ($resultlist[0]['staff_attendance_type_id'] != 5) {
                                            ?>
                                            <div class="alert alert-success"><?php echo $this->lang->line('attendance_already_submitted_you_can_edit_record'); ?></div>
                                            <?php
                                        } else {
                                            $checked = "checked='checked'";
                                            ?>
                                            <div class="alert alert-warning"><?php echo $this->lang->line('attendance_already_submitted_as_holiday_you_can_edit_record'); ?></div>
                                            <?php
                                        }
                                    }
                                } else {
                                    ?>
                                    <div class="alert alert-success"><?php echo $this->lang->line('attendance_saved_successfully'); ?></div>
                                    <?php
                                }
                                ?>
                                <form action="<?php echo site_url('admin/staffattendance/index') ?>" id="save_attendance" method="post">
                                    <?php echo $this->customlib->getCSRF(); ?>
                                    <div class="mailbox-controls">
                                        <span class="button-checkbox">
                                            <?php if (($this->rbac->hasPrivilege('staff_attendance', 'can_add')) || ($this->rbac->hasPrivilege('staff_attendance', 'can_edit'))) {?>
                                                <button type="button" class="btn btn-sm btn-primary" data-color="primary"><i class="state-icon glyphicon glyphicon-unchecked"></i> <?php echo $this->lang->line('mark_as_holiday'); ?></button>
                                                <input type="checkbox" id="checkbox1" class="hidden" name="holiday" value="checked" <?php echo $checked; ?>/>
                                            <?php }?>
                                        </span>
                                        <div class="pull-right">
                                            <?php if (($this->rbac->hasPrivilege('staff_attendance', 'can_add')) || ($this->rbac->hasPrivilege('staff_attendance', 'can_edit'))) {?>
                                                <button type="submit" name="search" value="saveattendence" class="btn btn-primary btn-sm pull-right checkbox-toggle" id="load" data-loading-text="<i class='fa fa-spinner fa-spin '></i> <?php echo $this->lang->line('save_attendance'); ?>"><i class="fa fa-save"></i> <?php echo $this->lang->line('save_attendance'); ?> </button>
                                            <?php }?>
                                        </div>
                                    </div>
                                    <input type="hidden" name="user_id" value="<?php echo $user_type_id; ?>">
                                    <input type="hidden" name="section_id" value="">
                                    <input type="hidden" name="date" value="<?php echo $date; ?>">

                                    <div class="desktop-only-view">
                                        <div class="table-responsive ptt10">
                                            <table class="table table-hover table-striped example">
                                                <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th><?php echo $this->lang->line('staff_id'); ?></th>
                                                    <?php if ($sch_setting->biometric) { ?>
                                                        <th><?php echo $this->lang->line('date'); ?></th>
                                                    <?php } ?>
                                                    <th><?php echo $this->lang->line('name'); ?></th>
                                                    <th><?php echo $this->lang->line('role'); ?></th>
                                                    <th width="30%"><?php echo $this->lang->line('attendance'); ?></th>
                                                    <th class="noteinput"><?php echo $this->lang->line('note'); ?></th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <?php
                                                $row_count = 1;
                                                foreach ($resultlist as $key => $value) {
                                                    $initial_attendance_type_id = isset($value['staff_attendance_type_id']) ? $value['staff_attendance_type_id'] : null;

                                                    if (($date == 'xxx' || $initial_attendance_type_id === null) && !$sch_setting->biometric) {
                                                        $initial_attendance_type_id = 1; // Default to Present
                                                    } elseif (($date == 'xxx' || $initial_attendance_type_id === null) && $sch_setting->biometric) {
                                                        $initial_attendance_type_id = 2; // Default to Absent if biometric and new
                                                    }
                                                    $attendendence_id = $value["id"];
                                                    ?>
                                                    <tr>
                                                        <td>
                                                            <input type="hidden" name="student_session[]" value="<?php echo $value['staff_id']; ?>">
                                                            <input  type="hidden" value="<?php echo $attendendence_id ?>"  name="attendendence_id<?php echo $value["staff_id"]; ?>">
                                                            <?php echo $row_count; ?>
                                                        </td>
                                                        <td>
                                                            <?php echo $value['employee_id']; ?>
                                                        </td>
                                                        <?php if ($sch_setting->biometric) { ?>
                                                            <td>
                                                                <?php if ($value['biometric_attendence']) { echo $value['attendence_dt']; } ?>
                                                            </td>
                                                        <?php } ?>
                                                        <td>
                                                            <?php echo $value['name'] . " " . $value['surname']; ?>
                                                        </td>
                                                        <td><?php echo $value['user_type']; ?></td>
                                                        <td>
                                                            <div class="attendance-tab-container">
                                                                <?php
                                                                $count = 0;
                                                                foreach ($attendencetypeslist as $type) {
                                                                    if ($type['key_value'] != "H") {
                                                                        $att_type_key = str_replace(" ", "_", strtolower($type['type']));
                                                                        $is_checked = ($initial_attendance_type_id == $type['id']) ? "checked" : "";
                                                                        $active_class = $is_checked ? "active-" . $att_type_key : "";
                                                                        ?>
                                                                        <input type="radio" id="attendencetype_desktop<?php echo $value['staff_id'] . "-" . $count; ?>" value="<?php echo $type['id'] ?>" name="attendencetype<?php echo $value['staff_id']; ?>" class="hidden_radio" <?php echo $is_checked; ?>>
                                                                        <span class="attendance-tab <?php echo $active_class; ?>" data-radio-id="attendencetype_desktop<?php echo $value['staff_id'] . "-" . $count; ?>" data-type="<?php echo $att_type_key; ?>">
                                                                            <?php echo $this->lang->line($att_type_key); ?>
                                                                        </span>
                                                                        <?php
                                                                        $count++;
                                                                    }
                                                                }
                                                                ?>
                                                            </div>
                                                        </td>
                                                        <td class="noteinput">
                                                            <input type="text" class="noteinput" name="remark<?php echo $value["staff_id"] ?>" value="<?php echo (isset($value["remark"]) ? $value["remark"] : ""); ?>" >
                                                        </td>
                                                    </tr>
                                                    <?php
                                                    $row_count++;
                                                }
                                                ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>

                                    <div class="mobile-only-view">
                                        <div class="mobile-cards-container">
                                            <?php
                                            $row_count = 1; // Reset row count for cards
                                            foreach ($resultlist as $key => $value) {
                                                $initial_attendance_type_id = isset($value['staff_attendance_type_id']) ? $value['staff_attendance_type_id'] : null;
                                                if (($date == 'xxx' || $initial_attendance_type_id === null) && !$sch_setting->biometric) {
                                                    $initial_attendance_type_id = 1;
                                                } elseif (($date == 'xxx' || $initial_attendance_type_id === null) && $sch_setting->biometric) {
                                                    $initial_attendance_type_id = 2;
                                                }
                                                ?>
                                                <div class="student-card-mobile card-bg-<?php echo ($row_count % 5) + 1; ?>">
                                                    <input type="hidden" name="student_session[]" value="<?php echo $value['staff_id']; ?>">
                                                    <input type="hidden" value="<?php echo $value['id']; ?>" name="attendendence_id<?php echo $value['staff_id']; ?>">

                                                    <div class="card-row student-info-row">
                                                        <div class="card-item"><span class="card-label">#</span> <span class="card-value"><?php echo $row_count; ?></span></div>
                                                        <div class="card-item"><span class="card-label bold-label">Staff Id:</span> <span class="card-value admission-no-value"><?php echo $value['employee_id']; ?></span></div>
                                                        <div class="card-item"><span class="card-label bold-label">Role:</span> <span class="card-value"><?php echo $value['user_type']; ?></span></div>
                                                    </div>
                                                    <?php if ($sch_setting->biometric) { ?>
                                                        <div class="card-row full-width-item">
                                                            <div class="card-item"><span class="card-label"><?php echo $this->lang->line('date'); ?>:</span> <span class="card-value"><?php if ($value['biometric_attendence'] && $value['attendence_dt']) { echo date('d/m/Y', strtotime($value['attendence_dt'])); } ?></span></div>
                                                        </div>
                                                    <?php } ?>
                                                    <div class="card-row full-width-item">
                                                        <div class="card-item">
                                                            <span class="card-label bold-label"><?php echo $this->lang->line('name'); ?>:</span>
                                                            <span class="card-value name-value"><?php echo $value['name'] . " " . $value['surname']; ?></span>
                                                        </div>
                                                    </div>

                                                    <div class="attendance-section">
                                                        <span class="card-label"><?php echo $this->lang->line('attendance'); ?>:</span>
                                                        <div class="attendance-tab-container">
                                                            <?php
                                                            $count = 0;
                                                            foreach ($attendencetypeslist as $type) {
                                                                if ($type['key_value'] != "H") {
                                                                    $att_type_key = str_replace(" ", "_", strtolower($type['type']));
                                                                    $is_checked = ($initial_attendance_type_id == $type['id']) ? "checked" : "";
                                                                    $active_class = $is_checked ? "active-" . $att_type_key : "";
                                                                    ?>
                                                                    <input type="radio" id="attendencetype_mobile<?php echo $value['staff_id'] . "-" . $count; ?>" value="<?php echo $type['id'] ?>" name="attendencetype<?php echo $value['staff_id']; ?>" class="hidden_radio" <?php echo $is_checked; ?>>
                                                                    <span class="attendance-tab <?php echo $active_class; ?>" data-radio-id="attendencetype_mobile<?php echo $value['staff_id'] . "-" . $count; ?>" data-type="<?php echo $att_type_key; ?>">
                                                                        <?php echo $this->lang->line($att_type_key); ?>
                                                                    </span>
                                                                    <?php
                                                                    $count++;
                                                                }
                                                            }
                                                            ?>
                                                        </div>
                                                    </div>

                                                    <div class="note-section">
                                                        <span class="card-label"><?php echo $this->lang->line('note'); ?>:</span>
                                                        <input type="text" class="noteinput" name="remark<?php echo $value["staff_id"] ?>" value="<?php echo (isset($value["remark"]) ? $value["remark"] : ""); ?>" >
                                                    </div>
                                                </div>
                                                <?php
                                                $row_count++;
                                            }
                                            ?>
                                        </div>
                                    </div>

                                    <div class="pull-right" style="margin-top: 20px; margin-bottom: 20px;">
                                        <?php
                                        // Assuming can_edit logic is similar to student attendance
                                        $can_edit = 1; // You might have your own logic for staff edit permission
                                        if (!($this->session->flashdata('msg')) && isset($resultlist[0]) && $resultlist[0]['staff_attendance_type_id'] != "") {
                                            if ($resultlist[0]['staff_attendance_type_id'] != 5) {
                                                if (!($this->rbac->hasPrivilege('staff_attendance', 'can_edit'))) {
                                                    $can_edit = 0;
                                                }
                                            }
                                        }

                                        if ($can_edit == 1) {
                                            if ($this->rbac->hasPrivilege('staff_attendance', 'can_add')) {
                                                ?>
                                                <button type="submit" name="search" value="saveattendence" class="btn btn-primary btn-sm checkbox-toggle" id="load" data-loading-text="<i class='fa fa-spinner fa-spin '></i> <?php echo $this->lang->line('save_attendance'); ?>"><i class="fa fa-save"></i> <?php echo $this->lang->line('save_attendance'); ?> </button>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </div>
                                </form>
                                <?php
                            } else {
                                ?>
                                <div class="alert alert-info"><?php echo $this->lang->line('no_record_found'); ?></div>
                                <?php
                            }
                            ?>
                        </div>
                    </div>
                    <?php
                    }
                    ?>
                </section>
            </div>

            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
            <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
            <script type="text/javascript">
                $(document).on('submit','#save_attendance',function(e) {
                    $('#load').button('loading');
                });
                $(document).ready(function () {
                    $.extend($.fn.dataTable.defaults, {
                        searching: false,
                        ordering: true,
                        paging: false,
                        retrieve: true,
                        destroy: true,
                        info: false
                    });
                    var table = $('.example').DataTable();
                    table.buttons('.export').remove();

                    // Datepicker initialization (assuming you have a datepicker library)
                    if ($.fn.datepicker) {
                        $('.date').datepicker({
                            dateFormat: 'dd-mm-yy', // Adjust format as needed for your school format
                            autoclose: true,
                            todayHighlight: true
                        });
                    }

                    // --- JavaScript for Tab-like behavior (Applies to both desktop table and mobile cards) ---
                    $(document).on('click', '.attendance-tab', function() {
                        var $this = $(this);
                        var radioId = $this.data('radio-id');
                        var $correspondingRadio = $('#' + radioId);
                        var attendanceType = $this.data('type');

                        // Find all tabs within the same staff's context (either table row or mobile card)
                        var $staffContainer = $this.closest('tr, .student-card-mobile');
                        $staffContainer.find('.attendance-tab')
                            .removeClass('active-present active-absent active-late active-half_day'); // Remove all specific active classes

                        // Add the specific active class to the clicked tab
                        $this.addClass('active-' + attendanceType);
                        // Check the corresponding hidden radio button
                        $correspondingRadio.prop('checked', true);
                    });

                    // Initialize active state on page load for pre-selected attendance
                    $('.hidden_radio:checked').each(function() {
                        var radioId = $(this).attr('id');
                        var $tab = $('.attendance-tab[data-radio-id="' + radioId + '"]');
                        var attendanceType = $tab.data('type');
                        if (attendanceType) {
                            $tab.addClass('active-' + attendanceType);
                        }
                    });

                    // --- "Mark as Holiday" Button Logic ---
                    $(function () {
                        $('.button-checkbox').each(function () {
                            var $widget = $(this),
                                $button = $widget.find('button'),
                                $checkbox = $widget.find('input:checkbox'),
                                color = $button.data('color'),
                                settings = {
                                    on: { icon: 'glyphicon glyphicon-check' },
                                    off: { icon: 'glyphicon glyphicon-unchecked' }
                                };

                            if ($button.find('.state-icon').length == 0) {
                                $button.prepend('<i class="state-icon ' + settings[$button.data('state') || 'off'].icon + '"></i> ');
                            }
                            updateDisplay();

                            $button.on('click', function () {
                                $checkbox.prop('checked', !$checkbox.is(':checked'));
                                $checkbox.triggerHandler('change');
                            });

                            $checkbox.on('change', function () {
                                updateDisplay();
                                var isChecked = $checkbox.is(':checked');
                                if (isChecked) {
                                    var returnVal = confirm("<?php echo $this->lang->line('are_you_sure'); ?>");
                                    if (!returnVal) {
                                        $checkbox.prop("checked", false).trigger('change');
                                        return;
                                    }
                                    $('.attendance-tab')
                                        .removeClass('active-present active-absent active-late active-half_day')
                                        .css('pointer-events', 'none');
                                    $('.noteinput').prop('disabled', true);

                                    var holidayTypeId = null;
                                    <?php
                                    foreach ($attendencetypeslist as $type) {
                                        if ($type['key_value'] == "H") {
                                            echo "holidayTypeId = " . $type['id'] . ";\n";
                                            break;
                                        }
                                    }
                                    ?>
                                    if(holidayTypeId) {
                                        $('input.hidden_radio[value="' + holidayTypeId + '"]').prop('checked', true);
                                        // Also ensure the holiday tab is visually active if it exists
                                        $('.attendance-tab[data-type="holiday"]').addClass('active-holiday');
                                    }

                                } else {
                                    $('.attendance-tab').css('pointer-events', 'auto');
                                    $('.noteinput').prop('disabled', false);

                                    var presentTypeId = null;
                                    <?php
                                    foreach ($attendencetypeslist as $type) {
                                        if ($type['key_value'] == "P") {
                                            echo "presentTypeId = " . $type['id'] . ";\n";
                                            break;
                                        }
                                    }
                                    ?>

                                    $('.hidden_radio').each(function() {
                                        var $radio = $(this);
                                        var radioId = $(this).attr('id');
                                        var $tab = $('.attendance-tab[data-radio-id="' + radioId + '"]');

                                        $tab.removeClass('active-present active-absent active-late active-half_day active-holiday'); // Remove all classes
                                        $radio.prop('checked', false);

                                        if ($radio.val() == presentTypeId) {
                                            $radio.prop('checked', true);
                                            $tab.addClass('active-present');
                                        }
                                    });
                                }
                            });
                            function updateDisplay() {
                                var isChecked = $checkbox.is(':checked');
                                $button.data('state', (isChecked) ? "on" : "off");
                                $button.find('.state-icon')
                                    .removeClass()
                                    .addClass('state-icon ' + settings[$button.data('state')].icon);
                                if (isChecked) {
                                    $button
                                        .removeClass('btn-primary')
                                        .addClass('btn-success active');
                                } else {
                                    $button
                                        .removeClass('btn-success active')
                                        .addClass('btn-primary');
                                }
                            }

                            if ($('#checkbox1').is(':checked')) {
                                $('.attendance-tab').css('pointer-events', 'none');
                                $('.noteinput').prop('disabled', true);
                            }
                        });
                    });

                    $('form#save_attendance').on('submit', function (e) {
                        if ($(this).data('submitted')) {
                            e.preventDefault();
                            return false;
                        }
                        $(this).data('submitted', true);
                    });

                    // --- Dynamic Name Color Logic (for mobile cards) ---
                    // Function to calculate luminance and return black or white text
                    function getContrastTextColor(color) {
                        // Handle both hex and RGB/RGBA color inputs
                        let r, g, b;
                        if (color.startsWith("#")) {
                            r = parseInt(color.substring(1, 3), 16);
                            g = parseInt(color.substring(3, 5), 16);
                            b = parseInt(color.substring(5, 7), 16);
                        } else if (color.startsWith("rgb")) {
                            const rgbMatch = color.match(/\d+/g);
                            if (rgbMatch && rgbMatch.length >= 3) {
                                r = parseInt(rgbMatch[0]);
                                g = parseInt(rgbMatch[1]);
                                b = parseInt(rgbMatch[2]);
                            } else {
                                return '#000000'; // Default to black if RGB parsing fails
                            }
                        } else {
                            // If neither hex nor rgb, try to get computed style via a temporary element
                            const tempDiv = $('<div>').css('background-color', color).hide().appendTo('body');
                            const computedColor = tempDiv.css('background-color');
                            tempDiv.remove();
                            return getContrastTextColor(computedColor); // Recurse with the computed RGB
                        }

                        // Calculate luminance
                        const luminance = ((r * 299) + (g * 587) + (b * 114)) / 1000;
                        return (luminance >= 128) ? '#000000' : '#ffffff'; // Light backgrounds get black text, dark get white
                    }

                    // Apply dynamic color on page load for mobile cards
                    function applyMobileCardStyles() {
                        if (window.innerWidth <= 767) {
                            $('.student-card-mobile').each(function() {
                                var $card = $(this);
                                var bgColor = $card.css('background-color'); // Get actual computed background color (e.g., "rgb(230, 242, 255)")
                                var $nameValue = $card.find('.card-value.name-value');

                                var textColor = getContrastTextColor(bgColor);
                                $nameValue.css('color', textColor);
                            });
                        } else {
                            // Optionally reset mobile-specific styles if switching to desktop view dynamically
                            $('.student-card-mobile').find('.card-value.name-value').css('color', ''); // Remove inline color
                        }
                    }

                    // Run on initial load
                    applyMobileCardStyles();
                    // Optional: Run on window resize in case user changes view from desktop to mobile without refresh
                    $(window).on('resize', function() {
                        applyMobileCardStyles();
                    });
                });
            </script>
        </body>
    </html>