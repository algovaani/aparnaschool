<style type="text/css">
    /* Global Styles & Vibrant Color Palette */
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap');

    :root {
        --primary-color: #6a11cb; /* Deep Purple */
        --primary-light: #2575fc; /* Bright Blue */
        --secondary-color: #1a237e; /* Rich Dark Blue for labels */
        --accent-color: #f39c12; /* Bright Orange for highlights */
        --text-color-dark: #333;
        --text-color-light: #fff;
        --background-color: #ecf0f1; /* Light Gray for a soft backdrop */
        --card-background: #fff;
        --border-color: #dcdde1;
        --shadow-light: 0 4px 20px rgba(0, 0, 0, 0.08);
        --shadow-hover: 0 10px 30px rgba(0, 0, 0, 0.15);
        --success-color: #27ae60;
        --danger-color: #e74c3c;
        --info-bg: #e8f7fc;
    }

    * {
        box-sizing: border-box;
    }

    body {
        font-family: 'Poppins', sans-serif;
        background-color: var(--background-color);
        color: var(--text-color-dark);
        line-height: 1.6;
        margin: 0;
    }

    /* Content and Layout */
    .content-wrapper {
        padding: 50px;
    }

    .box {
        background: var(--card-background);
        border-radius: 20px;
        box-shadow: var(--shadow-light);
        transition: all 0.3s ease;
        margin-bottom: 40px;
        overflow: hidden;
    }

    .box:hover {
        box-shadow: var(--shadow-hover);
        transform: translateY(-5px);
    }

    .box-header {
        padding: 30px;
        background-image: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-light) 100%);
        border-bottom: none;
        display: flex;
        align-items: center;
        justify-content: space-between;
        color: var(--text-color-light);
    }

    .box-title {
        font-size: 2rem;
        font-weight: 700;
        text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.2);
    }

    .box-header .fa {
        font-size: 1.8rem;
        margin-right: 15px;
    }

    .box-body {
        padding: 30px;
    }

    /* Tabs Navigation */
    .nav-tabs {
        display: flex;
        flex-wrap: wrap;
        padding-left: 0;
        margin-bottom: 0;
        list-style: none;
        background-color: #f4f6f9; /* Subtle background for the tab container */
        border-top-left-radius: 20px;
        border-top-right-radius: 20px;
        padding: 10px 20px 0;
    }

    .nav-tabs .nav-link {
        border: none;
        padding: 1rem 1.5rem;
        font-weight: 600;
        color: var(--secondary-color);
        transition: all 0.3s ease;
        cursor: pointer;
        background-color: transparent;
        border-radius: 10px 10px 0 0;
        position: relative;
        top: 2px;
    }
    
    .nav-tabs .nav-link:hover {
        color: var(--primary-color);
        background-color: #fff;
    }

    .nav-tabs .nav-item.active .nav-link {
        color: var(--text-color-light);
        background-image: linear-gradient(45deg, var(--primary-color) 0%, var(--primary-light) 100%);
        box-shadow: 0 -4px 10px rgba(0, 0, 0, 0.1);
        z-index: 1;
        top: 0;
    }
    
    .tab-content {
        padding: 30px;
        background-color: var(--card-background);
        border-bottom-left-radius: 20px;
        border-bottom-right-radius: 20px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.05);
    }

    /* Form Elements */
    .form-group {
        margin-bottom: 30px;
    }

    label {
        font-weight: 500;
        margin-bottom: 10px;
        color: var(--secondary-color); /* Rich dark blue for labels */
        display: block;
    }

    .form-control {
        width: 100%;
        padding: 14px 20px;
        border: 1px solid var(--border-color);
        border-radius: 10px;
        font-size: 1rem;
        transition: all 0.3s ease;
        background-color: #fcfcfc;
        color: var(--text-color-dark);
    }

    .form-control:focus {
        outline: none;
        border-color: var(--primary-color);
        box-shadow: 0 0 0 4px rgba(106, 17, 203, 0.1);
    }

    .req {
        color: var(--danger-color);
        margin-left: 5px;
        font-weight: 700;
    }

    .text-danger {
        color: var(--danger-color);
        font-size: 0.875rem;
        margin-top: 5px;
        display: block;
    }

    /* Buttons */
    .btn {
        padding: 14px 35px;
        font-size: 1rem;
        font-weight: 600;
        border-radius: 10px;
        cursor: pointer;
        transition: all 0.3s ease;
        border: none;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    
    .btn-primary {
        background-image: linear-gradient(45deg, var(--primary-color) 0%, var(--primary-light) 100%);
        color: var(--text-color-light);
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
    }

    .btn-primary:hover {
        background-image: linear-gradient(45deg, var(--primary-light) 0%, var(--primary-color) 100%);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
    }

    .btn-sm {
        padding: 10px 25px;
        font-size: 0.9rem;
    }
    
    .pull-right {
        float: right;
    }

    /* Alerts */
    .alert {
        padding: 20px;
        border-radius: 12px;
        margin-bottom: 25px;
        font-size: 1rem;
        font-weight: 500;
    }
    .alert-info {
        background-color: var(--info-bg);
        border: 1px solid #b3e1f5;
        color: #0c5460;
    }
    .alert-danger {
        background-color: #f8d7da;
        border: 1px solid #f5c6cb;
        color: #721c24;
    }

    /* Sub-sections */
    .tshadow {
        padding: 25px;
        border-radius: 16px;
        border: 1px solid var(--border-color);
        background-color: var(--card-background);
        margin-bottom: 30px;
    }

    .pagetitleh2 {
        font-size: 1.5rem;
        font-weight: 600;
        margin-bottom: 20px;
        color: var(--primary-color);
        display: flex;
        align-items: center;
    }
    
    .pagetitleh2 .fa {
        margin-right: 10px;
        font-size: 1.25rem;
        color: var(--accent-color);
    }

    /* Table for Documents */
    .table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0 15px;
    }

    .table th, .table td {
        padding: 15px;
        vertical-align: middle;
        font-size: 0.95rem;
        border-bottom: 1px solid var(--border-color);
    }

    .table thead th {
        color: var(--secondary-color);
        font-weight: 600;
        text-transform: uppercase;
        font-size: 0.8rem;
    }

    .table tbody tr:last-child th, .table tbody tr:last-child td {
        border-bottom: none;
    }
</style>

<div class="content-wrapper">
    <section class="content-header">
        <h1><i class="fa fa-sitemap"></i> <?php echo $this->lang->line('human_resource'); ?></h1>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title"><i class="fa fa-user-plus"></i> <?php echo $this->lang->line('add_staff'); ?></h3>
                        <div class="box-tools pull-right">
                            <a class="btn btn-sm btn-primary" href="<?php echo base_url(); ?>admin/staff/import" autocomplete="off"><i class="fa fa-upload"></i> <?php echo $this->lang->line('import_staff'); ?></a>
                        </div>
                    </div>
                    <form id="form1" action="<?php echo site_url('admin/staff/create') ?>" name="employeeform" method="post" accept-charset="utf-8" enctype="multipart/form-data">
                        <div class="box-body">
                            <?php if ($this->session->flashdata('msg')) { ?>
                                <?php echo $this->session->flashdata('msg'); $this->session->unset_userdata('msg'); ?>
                            <?php } ?>
                            <?php echo $this->customlib->getCSRF(); ?>
                            <?php
                            $errors = [];
                            if (form_error('validate_staff')) {
                                $errors[] = form_error('validate_staff');
                            }
                            if (form_error('validate_storage')) {
                                $errors[] = form_error('validate_storage');
                            }
                            if (!empty($errors)): ?>
                                <div class="alert alert-danger">
                                    <ol>
                                        <?php foreach ($errors as $error): ?>
                                            <li><?php echo $error; ?></li>
                                        <?php endforeach; ?>
                                    </ol>
                                </div>
                            <?php endif; ?>

                            <div class="alert alert-info">
                                Staff email is their login username, password is generated automatically and send to staff email. Superadmin can change staff password on their staff profile page.
                            </div>

                            <ul class="nav nav-tabs" role="tablist">
                                <li class="nav-item active">
                                    <a class="nav-link" data-toggle="tab" href="#basicInfoTab" role="tab" aria-controls="basicInfoTab" aria-selected="true"><i class="fa fa-info-circle"></i> <?php echo $this->lang->line('basic_information'); ?></a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#moreDetailsTab" role="tab" aria-controls="moreDetailsTab" aria-selected="false"><i class="fa fa-plus-circle"></i> <?php echo $this->lang->line('add_more_details'); ?></a>
                                </li>
                            </ul>

                            <div class="tab-content">
                                <div class="tab-pane active" id="basicInfoTab" role="tabpanel">
                                    <div class="row">
                                        <?php if (!$staffid_auto_insert) { ?>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="employee_id"><?php echo $this->lang->line('staff_id'); ?></label><small class="req"> *</small>
                                                    <input autofocus="" id="employee_id" name="employee_id" placeholder="" type="text" class="form-control" value="<?php echo set_value('employee_id') ?>" />
                                                    <span class="text-danger"><?php echo form_error('employee_id'); ?></span>
                                                </div>
                                            </div>
                                        <?php } ?>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="role"><?php echo $this->lang->line('role'); ?></label><small class="req"> *</small>
                                                <select id="role" name="role" class="form-control">
                                                    <option value=""><?php echo $this->lang->line('select'); ?></option>
                                                    <?php foreach ($roles as $key => $role) { ?>
                                                        <option value="<?php echo $role['id'] ?>" <?php echo set_select('role', $role['id'], set_value('role')); ?>><?php echo $role["name"] ?></option>
                                                    <?php } ?>
                                                </select>
                                                <span class="text-danger"><?php echo form_error('role'); ?></span>
                                            </div>
                                        </div>
                                        <?php if ($sch_setting->staff_designation) { ?>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="designation"><?php echo $this->lang->line('designation'); ?></label>
                                                    <select id="designation" name="designation" class="form-control">
                                                        <option value=""><?php echo $this->lang->line('select') ?></option>
                                                        <?php foreach ($designation as $key => $value) { ?>
                                                            <option value="<?php echo $value["id"] ?>" <?php echo set_select('designation', $value['id'], set_value('designation')); ?> ><?php echo $value["designation"] ?></option>
                                                        <?php } ?>
                                                    </select>
                                                    <span class="text-danger"><?php echo form_error('designation'); ?></span>
                                                </div>
                                            </div>
                                        <?php } ?>
                                        <?php if ($sch_setting->staff_department) { ?>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="department"><?php echo $this->lang->line('department'); ?></label>
                                                    <select id="department" name="department" class="form-control">
                                                        <option value=""><?php echo $this->lang->line('select') ?></option>
                                                        <?php foreach ($department as $key => $value) { ?>
                                                            <option value="<?php echo $value["id"] ?>" <?php echo set_select('department', $value['id'], set_value('department')); ?>><?php echo $value["department_name"] ?></option>
                                                        <?php } ?>
                                                    </select>
                                                    <span class="text-danger"><?php echo form_error('department'); ?></span>
                                                </div>
                                            </div>
                                        <?php } ?>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="name"><?php echo $this->lang->line('first_name'); ?></label><small class="req"> *</small>
                                                <input id="name" name="name" placeholder="" type="text" class="form-control" value="<?php echo set_value('name') ?>" />
                                                <span class="text-danger"><?php echo form_error('name'); ?></span>
                                            </div>
                                        </div>
                                        <?php if ($sch_setting->staff_last_name) { ?>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="surname"><?php echo $this->lang->line('last_name'); ?></label>
                                                    <input id="surname" name="surname" placeholder="" type="text" class="form-control" value="<?php echo set_value('surname') ?>" />
                                                    <span class="text-danger"><?php echo form_error('surname'); ?></span>
                                                </div>
                                            </div>
                                        <?php } ?>
                                        <?php if ($sch_setting->staff_father_name) { ?>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="father_name"><?php echo $this->lang->line('father_name'); ?></label>
                                                    <input id="father_name" name="father_name" placeholder="" type="text" class="form-control" value="<?php echo set_value('father_name') ?>" />
                                                    <span class="text-danger"><?php echo form_error('father_name'); ?></span>
                                                </div>
                                            </div>
                                        <?php } ?>
                                        <?php if ($sch_setting->staff_mother_name) { ?>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="mother_name"><?php echo $this->lang->line('mother_name'); ?></label>
                                                    <input id="mother_name" name="mother_name" placeholder="" type="text" class="form-control" value="<?php echo set_value('mother_name') ?>" />
                                                    <span class="text-danger"><?php echo form_error('mother_name'); ?></span>
                                                </div>
                                            </div>
                                        <?php } ?>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="email"><?php echo $this->lang->line('email'); ?> (<?php echo $this->lang->line('login') . " " . $this->lang->line('username'); ?>)</label><small class="req"> *</small>
                                                <input id="email" name="email" placeholder="" type="text" class="form-control" value="<?php echo set_value('email') ?>" />
                                                <span class="text-danger"><?php echo form_error('email'); ?></span>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="gender"> <?php echo $this->lang->line('gender'); ?></label><small class="req"> *</small>
                                                <select class="form-control" name="gender">
                                                    <option value=""><?php echo $this->lang->line('select'); ?></option>
                                                    <?php foreach ($genderList as $key => $value) { ?>
                                                        <option value="<?php echo $key; ?>" <?php echo set_select('gender', $key, set_value('gender')); ?>><?php echo $value; ?></option>
                                                    <?php } ?>
                                                </select>
                                                <span class="text-danger"><?php echo form_error('gender'); ?></span>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="dob"><?php echo $this->lang->line('date_of_birth'); ?></label><small class="req"> *</small>
                                                <input id="dob" name="dob" placeholder="" type="text" class="form-control date" value="<?php echo set_value('dob') ?>" />
                                                <span class="text-danger"><?php echo form_error('dob'); ?></span>
                                            </div>
                                        </div>
                                        <?php if ($sch_setting->staff_date_of_joining) { ?>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="date_of_joining"><?php echo $this->lang->line('date_of_joining'); ?></label>
                                                    <input id="date_of_joining" name="date_of_joining" placeholder="" type="text" class="form-control date" value="<?php echo set_value('date_of_joining') ?>" />
                                                    <span class="text-danger"><?php echo form_error('date_of_joining'); ?></span>
                                                </div>
                                            </div>
                                        <?php } ?>
                                    </div>
                                    <div class="row">
                                        <?php if ($sch_setting->staff_phone) { ?>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="contactno"><?php echo $this->lang->line('phone'); ?></label>
                                                    <input id="mobileno" name="contactno" placeholder="" type="text" class="form-control" value="<?php echo set_value('contactno') ?>" />
                                                    <span class="text-danger"><?php echo form_error('contactno'); ?></span>
                                                </div>
                                            </div>
                                        <?php } ?>
                                        <?php if ($sch_setting->staff_emergency_contact) { ?>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="emergency_no"><?php echo $this->lang->line('emergency_contact_number'); ?></label>
                                                    <input id="mobileno" name="emergency_no" placeholder="" type="text" class="form-control" value="<?php echo set_value('emergency_no') ?>" />
                                                    <span class="text-danger"><?php echo form_error('emergency_no'); ?></span>
                                                </div>
                                            </div>
                                        <?php } ?>
                                        <?php if ($sch_setting->staff_marital_status) { ?>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="marital_status"><?php echo $this->lang->line('marital_status'); ?></label>
                                                    <select class="form-control" name="marital_status">
                                                        <option value=""><?php echo $this->lang->line('select'); ?></option>
                                                        <?php foreach ($marital_status as $mavalue) { ?>
                                                            <option value="<?php echo $mavalue ?>" <?php echo set_select('marital_status', $mavalue, set_value('marital_status')); ?>><?php echo $mavalue; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                    <span class="text-danger"><?php echo form_error('marital_status'); ?></span>
                                                </div>
                                            </div>
                                        <?php } ?>
                                        <?php if ($sch_setting->staff_photo) { ?>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="file"><?php echo $this->lang->line('photo'); ?></label>
                                                    <div><input class="filestyle form-control" type='file' name='file' id="file" size='20' /></div>
                                                    <span class="text-danger"><?php echo form_error('file'); ?></span>
                                                </div>
                                            </div>
                                        <?php } ?>
                                    </div>
                                    <div class="row">
                                        <?php if ($sch_setting->staff_current_address) { ?>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="address"><?php echo $this->lang->line('current'); ?> <?php echo $this->lang->line('address'); ?></label>
                                                    <textarea name="address" class="form-control" rows="3"><?php echo set_value('address'); ?></textarea>
                                                    <span class="text-danger"></span>
                                                </div>
                                            </div>
                                        <?php } ?>
                                        <?php if ($sch_setting->staff_permanent_address) { ?>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="permanent_address"><?php echo $this->lang->line('permanent_address'); ?></label>
                                                    <textarea name="permanent_address" class="form-control" rows="3"><?php echo set_value('permanent_address'); ?></textarea>
                                                    <span class="text-danger"></span>
                                                </div>
                                            </div>
                                        <?php } ?>
                                    </div>
                                    <div class="row">
                                        <?php if ($sch_setting->staff_qualification) { ?>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="qualification"><?php echo $this->lang->line('qualification'); ?></label>
                                                    <textarea id="qualification" name="qualification" placeholder="" class="form-control" rows="3"><?php echo set_value('qualification') ?></textarea>
                                                    <span class="text-danger"><?php echo form_error('qualification'); ?></span>
                                                </div>
                                            </div>
                                        <?php } ?>
                                        <?php if ($sch_setting->staff_work_experience) { ?>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="work_exp"><?php echo $this->lang->line('work_experience'); ?></label>
                                                    <textarea id="work_exp" name="work_exp" placeholder="" class="form-control" rows="3"><?php echo set_value('work_exp') ?></textarea>
                                                    <span class="text-danger"><?php echo form_error('work_exp'); ?></span>
                                                </div>
                                            </div>
                                        <?php } ?>
                                    </div>
                                    <?php if ($sch_setting->staff_note) { ?>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="note"><?php echo $this->lang->line('note'); ?></label>
                                                    <textarea name="note" class="form-control" rows="3"><?php echo set_value('note'); ?></textarea>
                                                    <span class="text-danger"></span>
                                                </div>
                                            </div>
                                        </div>
                                    <?php } ?>
                                    <div class="row">
                                        <?php echo display_custom_fields('staff'); ?>
                                    </div>
                                </div>
                                
                                <div class="tab-pane fade" id="moreDetailsTab" role="tabpanel">
                                    <?php if ($sch_setting->staff_epf_no || $sch_setting->staff_basic_salary || $sch_setting->staff_contract_type || $sch_setting->staff_work_shift || $sch_setting->staff_work_location) { ?>
                                        <div class="tshadow mb25">
                                            <h4 class="pagetitleh2"><i class="fa fa-money"></i> <?php echo $this->lang->line('payroll'); ?></h4>
                                            <div class="row">
                                                <?php if ($sch_setting->staff_epf_no) { ?>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="epf_no"><?php echo $this->lang->line('epf_no'); ?></label>
                                                            <input id="epf_no" name="epf_no" placeholder="" type="text" class="form-control" value="<?php echo set_value('epf_no') ?>" />
                                                            <span class="text-danger"><?php echo form_error('epf_no'); ?></span>
                                                        </div>
                                                    </div>
                                                <?php } ?>
                                                <?php if ($sch_setting->staff_basic_salary) { ?>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="basic_salary"><?php echo $this->lang->line('basic_salary'); ?></label>
                                                            <input type="text" class="form-control" name="basic_salary" value="<?php echo set_value('basic_salary') ?>" >
                                                        </div>
                                                    </div>
                                                <?php } ?>
                                                <?php if ($sch_setting->staff_contract_type) { ?>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="contract_type"><?php echo $this->lang->line('contract_type'); ?></label>
                                                            <select class="form-control" name="contract_type">
                                                                <option value=""><?php echo $this->lang->line('select') ?></option>
                                                                <?php foreach ($contract_type as $key => $value) { ?>
                                                                    <option value="<?php echo $key ?>" <?php echo set_select('contract_type', $key, set_value('contract_type')); ?>><?php echo $value ?></option>
                                                                <?php } ?>
                                                            </select>
                                                            <span class="text-danger"><?php echo form_error('contract_type'); ?></span>
                                                        </div>
                                                    </div>
                                                <?php } ?>
                                                <?php if ($sch_setting->staff_work_shift) { ?>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="shift"><?php echo $this->lang->line('work_shift'); ?></label>
                                                            <input id="shift" name="shift" placeholder="" type="text" class="form-control" value="<?php echo set_value('shift') ?>" />
                                                            <span class="text-danger"><?php echo form_error('shift'); ?></span>
                                                        </div>
                                                    </div>
                                                <?php } ?>
                                                <?php if ($sch_setting->staff_work_location) { ?>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="location"><?php echo $this->lang->line('work_location'); ?></label>
                                                            <input id="location" name="location" placeholder="" type="text" class="form-control" value="<?php echo set_value('location') ?>" />
                                                            <span class="text-danger"><?php echo form_error('location'); ?></span>
                                                        </div>
                                                    </div>
                                                <?php } ?>
                                            </div>
                                        </div>
                                    <?php } ?>

                                    <?php if ($sch_setting->staff_leaves) { ?>
                                        <div class="tshadow mb25">
                                            <h4 class="pagetitleh2"><i class="fa fa-bed"></i> <?php echo $this->lang->line('leaves'); ?></h4>
                                            <div class="row">
                                                <?php foreach ($leavetypeList as $key => $leave) { ?>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="leave_type_<?php echo $leave['id']; ?>"><?php echo $leave["type"]; ?></label>
                                                            <input name="leave_type[]" type="hidden" readonly class="form-control" value="<?php echo $leave['id'] ?>" />
                                                            <input name="alloted_leave_<?php echo $leave['id'] ?>" placeholder="<?php echo $this->lang->line('number_of_leaves'); ?>" type="text" class="form-control" />
                                                            <span class="text-danger"><?php echo form_error('alloted_leave'); ?></span>
                                                        </div>
                                                    </div>
                                                <?php } ?>
                                            </div>
                                        </div>
                                    <?php } ?>

                                    <?php if ($sch_setting->staff_account_details) { ?>
                                        <div class="tshadow mb25">
                                            <h4 class="pagetitleh2"><i class="fa fa-bank"></i> <?php echo $this->lang->line('bank_account_details'); ?></h4>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="account_title"><?php echo $this->lang->line('account_title'); ?></label>
                                                        <input id="account_title" name="account_title" placeholder="" type="text" class="form-control" value="<?php echo set_value('account_title') ?>" />
                                                        <span class="text-danger"><?php echo form_error('account_title'); ?></span>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="bank_account_no"><?php echo $this->lang->line('bank_account_number'); ?></label>
                                                        <input id="bank_account_no" name="bank_account_no" placeholder="" type="text" class="form-control" value="<?php echo set_value('bank_account_no') ?>" />
                                                        <span class="text-danger"><?php echo form_error('bank_account_no'); ?></span>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="bank_name"><?php echo $this->lang->line('bank_name'); ?></label>
                                                        <input id="bank_name" name="bank_name" placeholder="" type="text" class="form-control" value="<?php echo set_value('bank_name') ?>" />
                                                        <span class="text-danger"><?php echo form_error('bank_name'); ?></span>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="ifsc_code"><?php echo $this->lang->line('ifsc_code'); ?></label>
                                                        <input id="ifsc_code" name="ifsc_code" placeholder="" type="text" class="form-control" value="<?php echo set_value('ifsc_code') ?>" />
                                                        <span class="text-danger"><?php echo form_error('ifsc_code'); ?></span>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="bank_branch"><?php echo $this->lang->line('bank_branch_name'); ?></label>
                                                        <input id="bank_branch" name="bank_branch" placeholder="" type="text" class="form-control" value="<?php echo set_value('bank_branch') ?>" />
                                                        <span class="text-danger"><?php echo form_error('bank_branch'); ?></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php } ?>

                                    <?php if ($sch_setting->staff_social_media) { ?>
                                        <div class="tshadow mb25">
                                            <h4 class="pagetitleh2"><i class="fa fa-share-alt"></i> <?php echo $this->lang->line('social_media'); ?></h4>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="facebook"><?php echo $this->lang->line('facebook_url'); ?></label>
                                                        <input name="facebook" placeholder="" type="text" class="form-control" value="<?php echo set_value('facebook') ?>" />
                                                        <span class="text-danger"><?php echo form_error('facebook'); ?></span>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="twitter"><?php echo $this->lang->line('twitter_url'); ?></label>
                                                        <input name="twitter" placeholder="" type="text" class="form-control" value="<?php echo set_value('twitter') ?>" />
                                                        <span class="text-danger"><?php echo form_error('twitter_profile'); ?></span>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="linkedin"><?php echo $this->lang->line('linkedin_url'); ?></label>
                                                        <input name="linkedin" placeholder="" type="text" class="form-control" value="<?php echo set_value('linkedin') ?>" />
                                                        <span class="text-danger"><?php echo form_error('linkedin'); ?></span>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="instagram"><?php echo $this->lang->line('instagram_url'); ?></label>
                                                        <input name="instagram" placeholder="" type="text" class="form-control" value="<?php echo set_value('instagram') ?>" />
                                                        <span class="text-danger"><?php echo form_error('instagram'); ?></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php } ?>
                                    
                                    <?php if ($sch_setting->staff_upload_documents) { ?>
                                        <div id="upload_documents_hide_show">
                                            <div class="tshadow">
                                                <h4 class="pagetitleh2"><i class="fa fa-upload"></i> <?php echo $this->lang->line('upload_documents'); ?></h4>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <table class="table">
                                                            <tbody>
                                                                <tr>
                                                                    <th style="width: 10px">#</th>
                                                                    <th><?php echo $this->lang->line('title'); ?></th>
                                                                    <th><?php echo $this->lang->line('documents'); ?></th>
                                                                </tr>
                                                                <tr>
                                                                    <td>1.</td>
                                                                    <td><?php echo $this->lang->line('resume'); ?></td>
                                                                    <td>
                                                                        <input class="filestyle form-control" type='file' name='first_doc' id="doc1">
                                                                        <span class="text-danger"><?php echo form_error('first_doc'); ?></span>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>3.</td>
                                                                    <td><?php echo $this->lang->line('resignation_letter'); ?></td>
                                                                    <td>
                                                                        <input class="filestyle form-control" type='file' name='third_doc' id="doc3">
                                                                        <span class="text-danger"><?php echo form_error('third_doc'); ?></span>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <table class="table">
                                                            <tbody>
                                                                <tr>
                                                                    <th style="width: 10px">#</th>
                                                                    <th><?php echo $this->lang->line('title'); ?></th>
                                                                    <th><?php echo $this->lang->line('documents'); ?></th>
                                                                </tr>
                                                                <tr>
                                                                    <td>2.</td>
                                                                    <td><?php echo $this->lang->line('joining_letter'); ?></td>
                                                                    <td>
                                                                        <input class="filestyle form-control" type='file' name='second_doc' id="doc2">
                                                                        <span class="text-danger"><?php echo form_error('second_doc'); ?></span>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>4.</td>
                                                                    <td><?php echo $this->lang->line('other_documents'); ?><input type="hidden" name='fourth_title' class="form-control" placeholder="Other Documents"></td>
                                                                    <td>
                                                                        <input class="filestyle form-control" type='file' name='fourth_doc' id="doc4">
                                                                        <span class="text-danger"><?php echo form_error('fourth_doc'); ?></span>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                        <div class="box-footer text-right">
                            <button type="submit" id="submitbtn" class="btn btn-primary"><?php echo $this->lang->line('save'); ?></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script>
    // Tab functionality
    $(document).ready(function(){
        $('.nav-tabs a').on('click', function(e){
            e.preventDefault();
            $('.nav-tabs .nav-item').removeClass('active');
            $(this).parent().addClass('active');
            $('.tab-pane').removeClass('active in');
            $($(this).attr('href')).addClass('active in');
        });

        // Set the first tab as active on page load
        $('.nav-tabs .nav-item:first-child').addClass('active');
        $('#basicInfoTab').addClass('active in');
    });

    $(function(){
        $('#form1').submit(function() {
            $("#submitbtn").button('loading');
        });
    });
</script>
<script type="text/javascript" src="<?php echo base_url(); ?>backend/dist/js/savemode.js"></script>