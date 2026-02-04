<link rel="stylesheet" href="<?php echo base_url(); ?>backend/datepicker/css/bootstrap-datetimepicker.css">
<script src="<?php echo base_url(); ?>backend/datepicker/js/bootstrap-datetimepicker.js"></script>

<style>
    body {
        background: radial-gradient(circle at 35% 20%, #7f9cf5 0%, #c7d2fe 60%, #f0f5ff 100%);
        font-family: 'Inter', system-ui, -apple-system, Segoe UI, Roboto, Arial;
        min-height: 100vh;
        background-attachment: fixed;
    }
    .admission-shell {
        max-width: 900px;
        margin: 48px auto 64px auto;
        padding: 0 1rem;
    }
    .admission-card {
        border-radius: 32px;
        box-shadow: 0 20px 48px 0 rgba(80, 80, 120, 0.16), 0 4px 24px #7f9cf540;
        background: rgba(255,255,255,0.95);
        backdrop-filter: blur(8px);
        border: 1.5px solid #7f9cf5;
        margin-bottom: 40px;
        overflow: hidden;
        transition: box-shadow 0.25s;
    }
    .admission-card .card-header {
        border-radius: 32px 32px 0 0;
        background: linear-gradient(90deg,#6366f1 70%,#60a5fa 100%);
        color: #fff;
        font-size: 1.35rem;
        font-weight: 900;
        padding: 1.4rem 1.7rem;
        letter-spacing: 0.01em;
        box-shadow: 0 4px 18px #6366f122;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    .action-links a.btn {
        margin-left: .85rem;
        background: linear-gradient(90deg, #f8fafc 80%, #c7d2fe 100%);
        color: #6366f1;
        border: none;
        border-radius: 8px;
        font-weight: 700;
        box-shadow: 0 2px 12px #c7d2fe77;
        transition: color 0.2s, background 0.2s;
    }
    .action-links a.btn:hover {
        background: linear-gradient(90deg, #bae6fd 80%, #6366f1 100%);
        color: #fff;
    }
    .card-body {
        padding: 2.2rem 2.5rem 2rem 2.5rem;
        background: rgba(255,255,255,0.98);
        border-radius: 0 0 32px 32px;
    }
    .pagetitleh2 {
        font-size: 1.22rem;
        font-weight: 900;
        color: #6366f1;
        margin: 2.3rem 0 1.2rem 0;
        letter-spacing: .03em;
        text-shadow: 0 2px 16px #6366f122;
    }
    .form-label {
        font-weight: 600;
        color: #3b3f4c;
        margin-bottom: 0.38rem;
        font-size: 1.09rem;
        letter-spacing: 0.01em;
    }
    .form-control, .form-select {
        border-radius: 16px;
        background: rgba(245,247,255,0.94);
        border: 2px solid #c7d2fe;
        box-shadow: 0 1px 2px #6366f111;
        font-size: 1.07rem;
        padding: 0.75rem 1.25rem; /* Increased padding */
        height: auto; /* Allow height to adjust */
        transition: border-color 0.2s, box-shadow 0.2s;
    }
    .form-control:focus, .form-select:focus {
        border-color: #6366f1;
        box-shadow: 0 0 0 2px #6366f155;
        background: #e0e7ff;
    }
    .form-group {
        margin-bottom: 1.25rem;
        transition: box-shadow 0.2s;
    }
    .req {color: #ef4444; font-weight: 700;}
    .onlineformbtn {
        padding: .75rem 2.3rem;
        font-weight: 700;
        border-radius: 14px;
        background: linear-gradient(90deg, #6366f1 60%, #60a5fa 100%);
        color: #fff;
        border: none;
        box-shadow: 0 2px 16px #6366f128, 0 1px 6px #60a5fa12;
        transition: background .2s, transform .2s;
        font-size: 1.08rem;
        letter-spacing: 0.02em;
    }
    .onlineformbtn:hover {
        background: linear-gradient(90deg, #60a5fa 70%, #6366f1 100%);
        transform: translateY(-2px) scale(1.03);
        color: #fff;
    }
    .modal-header {
        border-radius: 18px 18px 0 0;
        background: linear-gradient(90deg, #6366f1 80%, #60a5fa 100%);
        color: #fff;
        padding: 1.15rem 1.4rem;
        box-shadow: 0 2px 8px #6366f144;
    }
    .modal-content {
        border-radius: 18px;
        box-shadow: 0 8px 32px #6366f113, 0 2px 16px #60a5fa33;
        border: 1.5px solid #60a5fa;
    }
    .fa-refresh.capture-icon {
        cursor: pointer;
        margin-left: .9rem;
        color: #6366f1;
        font-size: 1.25rem;
        transition: color .2s, transform .2s;
    }
    .fa-refresh.capture-icon:hover {
        color: #60a5fa;
        transform: rotate(-45deg) scale(1.15);
    }
    .form-check-label {
        font-weight: 500;
        color: #6366f1;
    }
    .form-check-input:checked {
        background-color: #6366f1;
        border-color: #6366f1;
    }
    .alert-danger {
        background: linear-gradient(90deg, #fee2f3 0%, #6366f1 100%);
        color: #7e1e84;
        border-radius: 16px;
        padding: 1rem 1.5rem;
        font-weight: 500;
    }
    .text-danger {
        color: #ef4444 !important;
        font-weight: 500;
        font-size: 0.97em;
    }
    input[type="file"].filestyle.form-control {
        background: rgba(255,246,254,0.92);
        border: 2px solid #60a5fa;
    }
    input[type="checkbox"].form-check-input,
    input[type="radio"].form-check-input {
        accent-color: #6366f1;
    }
    @media (max-width: 767px) {
        .admission-shell {max-width: 100vw;}
        .admission-card, .modal-content {border-radius: 14px;}
        .card-header {flex-direction: column; font-size: 1.07rem;}
        .form-group {margin-bottom: .8rem;}
        .card-body {padding: 1.25rem;}
        .pagetitleh2 {font-size: 1.08rem;}
    }
</style>

<div class="admission-shell">
    <div class="admission-card">
        <div class="card-header">
            <span><?php echo $this->lang->line('online_admission'); ?></span>
            <div class="action-links">
                <a href="#checkOnlineAdmissionStatus" class="btn btn-light btn-sm shadow-sm" onclick="openStatusFormmodal();" data-bs-toggle="modal" data-bs-target="#checkOnlineAdmissionStatus">
                    <?php echo $this->lang->line('check_your_form_status') ?>
                </a>
                <?php if (!empty($online_admission_application_form)) { ?>
                <a href="<?php echo base_url(); ?>welcome/download/<?php echo $sch_setting->id; ?>" class="btn btn-outline-light btn-sm shadow-sm">
                    <?php echo $this->lang->line('download_application_form'); ?>
                </a>
                <?php } ?>
            </div>
        </div>
        <div class="card-body">

<?php if (!$form_admission) { ?>
    <div class="alert alert-danger my-3">
        <?php echo $this->lang->line('admission_form_disable_please_contact_to_administrator'); ?>
    </div>
    <?php return;
} ?>

<?php
if ($this->session->flashdata('msg')) {
    $message = $this->session->flashdata('msg');
    echo $message;
    $this->session->unset_userdata('msg');
}
?>

<form id="form1" class="onlineform" action="<?php echo current_url() ?>" method="post" enctype="multipart/form-data">
    <?php if ($online_admission_instruction != "") { ?>
    <div class="mb-4">
        <h4 class="pagetitleh2"><?php echo $this->lang->line('instructions'); ?></h4>
        <div class="form-group">
            <?php echo $online_admission_instruction; ?>
        </div>
    </div>
    <?php } ?>

    <h4 class="pagetitleh2"><?php echo $this->lang->line('basic_details'); ?></h4>
    <div class="row g-3 mb-2">
        <div class="col-md-3">
            <div class="form-group">
                <label class="form-label"><?php echo $this->lang->line('class'); ?> <span class="req">*</span></label>
                <select id="class_id" name="class_id" class="form-select" required>
                    <option value=""><?php echo $this->lang->line('select'); ?></option>
                    <?php foreach ($classlist as $class) { ?>
                        <option value="<?php echo $class['id'] ?>" <?php if (set_value('class_id') == $class['id']) echo "selected=selected"; ?>>
                            <?php echo $class['class'] ?>
                        </option>
                    <?php } ?>
                </select>
                <span class="text-danger"><?php echo form_error('class_id'); ?></span>
            </div>
        </div>
        <div class="col-md-3 displaynone">
            <div class="form-group">
                <label class="form-label"><?php echo $this->lang->line('section'); ?> <span class="req">*</span></label>
                <select id="section_id" name="section_id" class="form-select" required>
                    <option value=""><?php echo $this->lang->line('select'); ?></option>
                </select>
                <span class="text-danger"><?php echo form_error('section_id'); ?></span>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label class="form-label"><?php echo $this->lang->line('first_name'); ?> <span class="req">*</span></label>
                <input id="firstname" name="firstname" type="text" class="form-control" value="<?php echo set_value('firstname'); ?>" autocomplete="off" required />
                <span class="text-danger"><?php echo form_error('firstname'); ?></span>
            </div>
        </div>
        <?php if ($this->customlib->getfieldstatus('middlename')) { ?>
        <div class="col-md-3">
            <div class="form-group">
                <label class="form-label"><?php echo $this->lang->line('middle_name'); ?></label>
                <input id="middlename" name="middlename" type="text" class="form-control" value="<?php echo set_value('middlename'); ?>" autocomplete="off" />
            </div>
        </div>
        <?php } ?>
        <?php if ($this->customlib->getfieldstatus('lastname')) { ?>
        <div class="col-md-3">
            <div class="form-group">
                <label class="form-label"><?php echo $this->lang->line('last_name'); ?></label>
                <input id="lastname" name="lastname" type="text" class="form-control" value="<?php echo set_value('lastname'); ?>" autocomplete="off" />
                <span class="text-danger"><?php echo form_error('lastname'); ?></span>
            </div>
        </div>
        <?php } ?>
    </div>
    <div class="row g-3 mb-2">
        <div class="col-md-3">
            <div class="form-group">
                <label class="form-label"><?php echo $this->lang->line('gender'); ?> <span class="req">*</span></label>
                <select class="form-select" name="gender" required>
                    <option value=""><?php echo $this->lang->line('select'); ?></option>
                    <?php foreach ($genderList as $key => $value) { ?>
                        <option value="<?php echo $key; ?>" <?php if (set_value('gender') == $key) echo "selected"; ?>>
                            <?php echo $value; ?>
                        </option>
                    <?php } ?>
                </select>
                <span class="text-danger"><?php echo form_error('gender'); ?></span>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label class="form-label"><?php echo $this->lang->line('date_of_birth'); ?> <span class="req">*</span></label>
                <input type="text" class="form-control date2" value="<?php echo set_value('dob'); ?>" id="dob" name="dob" required />
                <span class="text-danger"><?php echo form_error('dob'); ?></span>
            </div>
        </div>
        <?php if ($this->customlib->getfieldstatus('mobile_no')) { ?>
        <div class="col-md-3">
            <div class="form-group">
                <label class="form-label"><?php echo $this->lang->line('mobile_number'); ?></label>
                <input type="text" class="form-control" value="<?php echo set_value('mobileno'); ?>" id="mobileno" name="mobileno" autocomplete="off"/>
                <span class="text-danger"><?php echo form_error('mobileno'); ?></span>
            </div>
        </div>
        <?php } ?>
        <?php if ($this->customlib->getfieldstatus('student_email')) { ?>
        <div class="col-md-3">
            <div class="form-group">
                <label class="form-label"><?php echo $this->lang->line('email'); ?> <span class="req">*</span></label>
                <input type="email" class="form-control" value="<?php echo set_value('email'); ?>" id="email" name="email" autocomplete="off"/>
                <span class="text-danger"><?php echo form_error('email'); ?></span>
            </div>
        </div>
        <?php } ?>
    </div>
    <div class="row g-3 mb-2">
      <?php if ($this->customlib->getfieldstatus('category')) { ?>
        <div class="col-md-3">
            <div class="form-group">
               <label class="form-label"><?php echo $this->lang->line('category'); ?></label>
                    <select id="category_id" name="category_id" class="form-select">
                        <option value=""><?php echo $this->lang->line('select'); ?></option>
                        <?php foreach ($categorylist as $category) { ?>
                          <option value="<?php echo $category['id'] ?>" <?php if (set_value('category_id') == $category['id']) echo "selected=selected"; ?>>
                               <?php echo $category['category'] ?>
                          </option>
                        <?php } ?>
                     </select>
            </div>
        </div>
        <?php } ?>
       <?php if ($this->customlib->getfieldstatus('religion')) { ?>
        <div class="col-md-3">
            <div class="form-group">
                <label class="form-label"><?php echo $this->lang->line('religion'); ?></label>
                <input id="religion" name="religion" type="text" class="form-control" value="<?php echo set_value('religion'); ?>" autocomplete="off" />
                <span class="text-danger"><?php echo form_error('religion'); ?></span>
            </div>
        </div>
        <?php } if ($this->customlib->getfieldstatus('cast')) { ?>
        <div class="col-md-3">
            <div class="form-group">
                <label class="form-label"><?php echo $this->lang->line('caste'); ?></label>
                <input id="cast" name="cast" type="text" class="form-control" value="<?php echo set_value('cast'); ?>" autocomplete="off" />
                <span class="text-danger"><?php echo form_error('cast'); ?></span>
            </div>
        </div>
        <?php } ?>
        <?php if ($this->customlib->getfieldstatus('is_student_house')) { ?>
        <div class="col-md-3 col-xs-12">
            <div class="form-group">
                <label class="form-label"><?php echo $this->lang->line('house') ?></label>
                <select class="form-select" name="house">
                    <option value=""><?php echo $this->lang->line('select') ?></option>
                    <?php foreach ($houses as $hkey => $hvalue) { ?>
                        <option value="<?php echo $hvalue["id"] ?>" <?php if (set_value('house') == $hvalue["id"]) echo "selected"; ?>>
                            <?php echo $hvalue["house_name"] ?>
                        </option>
                    <?php } ?>
                </select>
                <span class="text-danger"><?php echo form_error('house'); ?></span>
            </div>
        </div>
        <?php } ?>
    </div>
    <div class="row g-3 mb-2">
      <?php if ($this->customlib->getfieldstatus('is_blood_group')) { ?>
        <div class="col-md-3 col-xs-12">
            <div class="form-group">
                <label class="form-label"><?php echo $this->lang->line('blood_group'); ?></label>
                <select class="form-select" name="blood_group">
                    <option value=""><?php echo $this->lang->line('select') ?></option>
                    <?php foreach ($bloodgroup as $bgkey => $bgvalue) { ?>
                        <option value="<?php echo $bgvalue ?>" <?php if (set_value('blood_group') == $bgvalue) echo "selected"; ?>>
                            <?php echo $bgvalue ?>
                        </option>
                    <?php } ?>
                </select>
                <span class="text-danger"><?php echo form_error('blood_group'); ?></span>
            </div>
        </div>
        <?php } ?>
        <?php if ($this->customlib->getfieldstatus('student_height')) { ?>
        <div class="col-md-3 col-xs-12">
            <div class="form-group">
                <label class="form-label"><?php echo $this->lang->line('height'); ?></label>
                <input type="text" name="height" class="form-control" value="<?php echo set_value('height'); ?>" autocomplete="off">
                <span class="text-danger"><?php echo form_error('height'); ?></span>
            </div>
        </div>
        <?php } if ($this->customlib->getfieldstatus('student_weight')) { ?>
        <div class="col-md-3 col-xs-12">
            <div class="form-group">
                <label class="form-label"><?php echo $this->lang->line('weight'); ?></label>
                <input type="text" name="weight" class="form-control" value="<?php echo set_value('weight'); ?>" autocomplete="off">
                <span class="text-danger"><?php echo form_error('weight'); ?></span>
            </div>
        </div>
        <?php } ?>
        <?php if ($this->customlib->getfieldstatus('measurement_date')) { ?>
        <div class="col-md-3 col-xs-12">
            <div class="form-group">
                <label class="form-label"><?php echo $this->lang->line('measurement_date'); ?></label>
                <input type="text" id="measure_date" name="measure_date" class="form-control date2" value="<?php echo set_value('measure_date'); ?>" autocomplete="off">
                <span class="text-danger"><?php echo form_error('measure_date'); ?></span>
            </div>
        </div>
        <?php } ?>
    </div>
    <div class="row g-3 mb-2">
        <?php if ($this->customlib->getfieldstatus('student_photo')) { ?>
        <div class="col-md-3">
            <div class="form-group">
                <label class="form-label"><?php echo $this->lang->line('student_photo'); ?></label>
                <input class="filestyle form-control" type='file' name='file' id="file" size='20' />
                <span class="text-danger"><?php echo form_error('file'); ?></span>
            </div>
        </div>
        <?php } ?>
    </div>
    <div class="row g-3 mb-2">
        <?php echo display_onlineadmission_custom_fields('students'); ?>
    </div>
    <?php if (
        $this->customlib->getfieldstatus('father_name') || $this->customlib->getfieldstatus('father_phone') ||
        $this->customlib->getfieldstatus('father_occupation') || $this->customlib->getfieldstatus('father_pic') ||
        $this->customlib->getfieldstatus('mother_name') || $this->customlib->getfieldstatus('mother_phone') ||
        $this->customlib->getfieldstatus('mother_occupation') || $this->customlib->getfieldstatus('mother_pic')
    ) { ?>
    <h4 class="pagetitleh2"><?php echo $this->lang->line('parent_detail'); ?></h4>
    <div class="row g-3 mb-2">
        <?php if ($this->customlib->getfieldstatus('father_name')) { ?>
        <div class="col-md-3">
            <div class="form-group">
                <label class="form-label"><?php echo $this->lang->line('father_name'); ?></label>
                <input id="father_name" name="father_name" type="text" class="form-control" value="<?php echo set_value('father_name'); ?>" autocomplete="off" />
                <span class="text-danger"><?php echo form_error('father_name'); ?></span>
            </div>
        </div>
        <?php } ?>
        <?php if ($this->customlib->getfieldstatus('father_phone')) { ?>
        <div class="col-md-3">
            <div class="form-group">
                <label class="form-label"><?php echo $this->lang->line('father_phone'); ?></label>
                <input id="father_phone" name="father_phone" type="text" class="form-control" value="<?php echo set_value('father_phone'); ?>" autocomplete="off" />
                <span class="text-danger"><?php echo form_error('father_phone'); ?></span>
            </div>
        </div>
        <?php } ?>
        <?php if ($this->customlib->getfieldstatus('father_occupation')) { ?>
        <div class="col-md-3">
            <div class="form-group">
                <label class="form-label"><?php echo $this->lang->line('father_occupation'); ?></label>
                <input id="father_occupation" name="father_occupation" type="text" class="form-control" value="<?php echo set_value('father_occupation'); ?>" autocomplete="off" />
                <span class="text-danger"><?php echo form_error('father_occupation'); ?></span>
            </div>
        </div>
        <?php } ?>
        <?php if ($this->customlib->getfieldstatus('father_pic')) { ?>
        <div class="col-md-3">
            <div class="form-group">
                <label class="form-label"><?php echo $this->lang->line('father_photo'); ?></label>
                <input class="filestyle form-control" type='file' name='father_pic' id="file" size='20' />
                <span class="text-danger"><?php echo form_error('father_pic'); ?></span>
            </div>
        </div>
        <?php } ?>
    </div>
    <div class="row g-3 mb-2">
        <?php if ($this->customlib->getfieldstatus('mother_name')) { ?>
        <div class="col-md-3">
            <div class="form-group">
                <label class="form-label"><?php echo $this->lang->line('mother_name'); ?></label>
                <input id="mother_name" name="mother_name" type="text" class="form-control" value="<?php echo set_value('mother_name'); ?>" autocomplete="off" />
                <span class="text-danger"><?php echo form_error('mother_name'); ?></span>
            </div>
        </div>
        <?php } ?>
        <?php if ($this->customlib->getfieldstatus('mother_phone')) { ?>
        <div class="col-md-3">
            <div class="form-group">
                <label class="form-label"><?php echo $this->lang->line('mother_phone'); ?></label>
                <input id="mother_phone" name="mother_phone" type="text" class="form-control" value="<?php echo set_value('mother_phone'); ?>" autocomplete="off" />
                <span class="text-danger"><?php echo form_error('mother_phone'); ?></span>
            </div>
        </div>
        <?php } ?>
        <?php if ($this->customlib->getfieldstatus('mother_occupation')) { ?>
        <div class="col-md-3">
            <div class="form-group">
                <label class="form-label"><?php echo $this->lang->line('mother_occupation'); ?></label>
                <input id="mother_occupation" name="mother_occupation" type="text" class="form-control" value="<?php echo set_value('mother_occupation'); ?>" autocomplete="off" />
                <span class="text-danger"><?php echo form_error('mother_occupation'); ?></span>
            </div>
        </div>
        <?php } ?>
        <?php if ($this->customlib->getfieldstatus('mother_pic')) { ?>
        <div class="col-md-3">
            <div class="form-group">
                <label class="form-label"><?php echo $this->lang->line('mother_photo'); ?></label>
                <input class="filestyle form-control" type='file' name='mother_pic' id="file" size='20' />
                <span class="text-danger"><?php echo form_error('mother_pic'); ?></span>
            </div>
        </div>
        <?php } ?>
    </div>
    <?php } ?>

    <?php if ($this->customlib->getfieldstatus('if_guardian_is')) { ?>
    <h4 class="pagetitleh2"><?php echo $this->lang->line('guardian_details'); ?></h4>
    <div class="row g-3 mb-2">
        <div class="form-group col-md-12">
            <label class="form-label"><?php echo $this->lang->line('if_guardian_is'); ?> <span class="req">*</span></label>
            <div class="d-flex gap-4">
                <div class="form-check form-check-inline">
                    <input type="radio" name="guardian_is" class="form-check-input" value="father" <?php echo set_value('guardian_is') == "father" ? "checked" : ""; ?> >
                    <label class="form-check-label"><?php echo $this->lang->line('father'); ?></label>
                </div>
                <div class="form-check form-check-inline">
                    <input type="radio" name="guardian_is" class="form-check-input" value="mother" <?php echo set_value('guardian_is') == "mother" ? "checked" : ""; ?> >
                    <label class="form-check-label"><?php echo $this->lang->line('mother'); ?></label>
                </div>
                <div class="form-check form-check-inline">
                    <input type="radio" name="guardian_is" class="form-check-input" value="other" <?php echo set_value('guardian_is') == "other" ? "checked" : ""; ?> >
                    <label class="form-check-label"><?php echo $this->lang->line('other'); ?></label>
                </div>
            </div>
            <span class="text-danger"><?php echo form_error('guardian_is'); ?></span>
        </div>
        <?php if ($this->customlib->getfieldstatus('guardian_name')) { ?>
        <div class="col-md-3">
            <div class="form-group">
                <label class="form-label"><?php echo $this->lang->line('guardian_name'); ?> <span class="req">*</span></label>
                <input id="guardian_name" name="guardian_name" type="text" class="form-control" value="<?php echo set_value('guardian_name'); ?>" autocomplete="off" />
                <span class="text-danger"><?php echo form_error('guardian_name'); ?></span>
            </div>
        </div>
        <?php } ?>
        <?php if ($this->customlib->getfieldstatus('guardian_relation')) { ?>
        <div class="col-md-3">
            <div class="form-group">
                <label class="form-label"><?php echo $this->lang->line('guardian_relation'); ?> <span class="req">*</span></label>
                <input id="guardian_relation" name="guardian_relation" type="text" class="form-control" value="<?php echo set_value('guardian_relation'); ?>" autocomplete="off" />
                <span class="text-danger"><?php echo form_error('guardian_relation'); ?></span>
            </div>
        </div>
        <?php } ?>
        <?php if ($this->customlib->getfieldstatus('guardian_email')) { ?>
        <div class="col-md-3">
            <div class="form-group">
                <label class="form-label"><?php echo $this->lang->line('guardian_email'); ?></label>
                <input id="guardian_email" name="guardian_email" type="email" class="form-control" value="<?php echo set_value('guardian_email'); ?>" autocomplete="off" />
                <span class="text-danger"><?php echo form_error('guardian_email'); ?></span>
            </div>
        </div>
        <?php } ?>
        <?php if ($this->customlib->getfieldstatus('guardian_photo')) { ?>
        <div class="col-md-3">
            <div class="form-group">
                <label class="form-label"><?php echo $this->lang->line('guardian_photo'); ?></label>
                <input class="filestyle form-control" type='file' name='guardian_pic' id="file" size='20' />
                <span class="text-danger"><?php echo form_error('guardian_pic'); ?></span>
            </div>
        </div>
        <?php } ?>
    </div>
    <div class="row g-3 mb-2">
        <?php if ($this->customlib->getfieldstatus('guardian_phone')) { ?>
        <div class="col-md-3">
            <div class="form-group">
                <label class="form-label"><?php echo $this->lang->line('guardian_phone'); ?></label>
                <input id="guardian_phone" name="guardian_phone" type="text" class="form-control" value="<?php echo set_value('guardian_phone'); ?>" autocomplete="off" />
                <span class="text-danger"><?php echo form_error('guardian_phone'); ?></span>
            </div>
        </div>
        <?php } ?>
        <?php if ($this->customlib->getfieldstatus('guardian_occupation')) { ?>
        <div class="col-md-3">
            <div class="form-group">
                <label class="form-label"><?php echo $this->lang->line('guardian_occupation'); ?></label>
                <input id="guardian_occupation" name="guardian_occupation" type="text" class="form-control" value="<?php echo set_value('guardian_occupation'); ?>" autocomplete="off" />
                <span class="text-danger"><?php echo form_error('guardian_occupation'); ?></span>
            </div>
        </div>
        <?php } ?>
        <?php if ($this->customlib->getfieldstatus('guardian_address')) { ?>
        <div class="col-md-6">
            <div class="form-group">
                <label class="form-label"><?php echo $this->lang->line('guardian_address'); ?></label>
                <textarea id="guardian_address" name="guardian_address" class="form-control" rows="1" autocomplete="off"><?php echo set_value('guardian_address'); ?></textarea>
                <span class="text-danger"><?php echo form_error('guardian_address'); ?></span>
            </div>
        </div>
        <?php } ?>
    </div>
    <?php } ?>

    <?php if ($this->customlib->getfieldstatus('current_address') || $this->customlib->getfieldstatus('permanent_address')) { ?>
    <h4 class="pagetitleh2"><?php echo $this->lang->line('student_address_details'); ?></h4>
    <div class="row g-3 mb-2">
        <?php if ($this->customlib->getfieldstatus('current_address')) { ?>
        <div class="col-md-6">
            <?php if ($this->customlib->getfieldstatus('guardian_address')) { ?>
            <div class="form-check mb-2">
                <input type="checkbox" id="autofill_current_address" class="form-check-input" onclick="return auto_fill_guardian_address();" autocomplete="off">
                <label class="form-check-label" for="autofill_current_address"><?php echo $this->lang->line('if_guardian_address_is_current_address'); ?></label>
            </div>
            <?php } ?>
            <div class="form-group">
                <label class="form-label"><?php echo $this->lang->line('current_address'); ?></label>
                <textarea id="current_address" name="current_address" class="form-control" rows="1" autocomplete="off"><?php echo set_value('current_address'); ?></textarea>
                <span class="text-danger"><?php echo form_error('current_address'); ?></span>
            </div>
        </div>
        <?php } if ($this->customlib->getfieldstatus('permanent_address')) { ?>
        <div class="col-md-6">
            <?php if ($this->customlib->getfieldstatus('current_address')) { ?>
            <div class="form-check mb-2">
                <input type="checkbox" id="autofill_address" class="form-check-input" onclick="return auto_fill_address();">
                <label class="form-check-label" for="autofill_address"><?php echo $this->lang->line('if_permanent_address_is_current_address'); ?></label>
            </div>
            <?php } ?>
            <div class="form-group">
                <label class="form-label"><?php echo $this->lang->line('permanent_address'); ?></label>
                <textarea id="permanent_address" name="permanent_address" class="form-control" rows="1" autocomplete="off"></textarea>
                <span class="text-danger"><?php echo form_error('permanent_address'); ?></span>
            </div>
        </div>
        <?php } ?>
    </div>
    <?php } ?>

    <?php if (
        $this->customlib->getfieldstatus('bank_account_no') || $this->customlib->getfieldstatus('bank_name') ||
        $this->customlib->getfieldstatus('ifsc_code') || $this->customlib->getfieldstatus('national_identification_no') ||
        $this->customlib->getfieldstatus('local_identification_no') || $this->customlib->getfieldstatus('rte') ||
        $this->customlib->getfieldstatus('previous_school_details') || $this->customlib->getfieldstatus('student_note')
    ) { ?>
    <h4 class="pagetitleh2"><?php echo $this->lang->line('miscellaneous_details'); ?></h4>
    <div class="row g-3 mb-2">
        <?php if ($this->customlib->getfieldstatus('bank_account_no')) { ?>
        <div class="col-md-4">
            <div class="form-group">
                <label class="form-label"><?php echo $this->lang->line('bank_account_number'); ?></label>
                <input id="bank_account_no" name="bank_account_no" type="text" class="form-control" value="<?php echo set_value('bank_account_no'); ?>" autocomplete="off" />
                <span class="text-danger"><?php echo form_error('bank_account_no'); ?></span>
            </div>
        </div>
        <?php } if ($this->customlib->getfieldstatus('bank_name')) { ?>
        <div class="col-md-4">
            <div class="form-group">
                <label class="form-label"><?php echo $this->lang->line('bank_name'); ?></label>
                <input id="bank_name" name="bank_name" type="text" class="form-control" value="<?php echo set_value('bank_name'); ?>" autocomplete="off" />
                <span class="text-danger"><?php echo form_error('bank_name'); ?></span>
            </div>
        </div>
        <?php } if ($this->customlib->getfieldstatus('ifsc_code')) { ?>
        <div class="col-md-4">
            <div class="form-group">
                <label class="form-label"><?php echo $this->lang->line('ifsc_code'); ?></label>
                <input id="ifsc_code" name="ifsc_code" type="text" class="form-control" value="<?php echo set_value('ifsc_code'); ?>" autocomplete="off" />
                <span class="text-danger"><?php echo form_error('ifsc_code'); ?></span>
            </div>
        </div>
        <?php } ?>
    </div>
    <div class="row g-3 mb-2">
        <div class="col-md-4">
            <div class="form-group">
                <label class="form-label">PEN No. <span class="req">*</span></label> 
                <input id="pen_no" name="pen_no" type="text" class="form-control" value="<?php echo set_value('pen_no'); ?>" autocomplete="off" required />
                <span class="text-danger"><?php echo form_error('pen_no'); ?></span>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label class="form-label">Aadhar No. <span class="req">*</span></label>
                <input id="aadhar_no" name="aadhar_no" type="text" class="form-control" value="<?php echo set_value('aadhar_no'); ?>" autocomplete="off" required />
                <span class="text-danger"><?php echo form_error('aadhar_no'); ?></span>
            </div>
        </div>
        <?php if ($this->customlib->getfieldstatus('rte')) { ?>
        <div class="col-md-4">
            <label class="form-label"><?php echo $this->lang->line('rte'); ?></label>
            <div class="form-check form-check-inline">
                <input type="radio" name="rte" class="form-check-input" value="Yes" <?php echo set_value('rte') == "yes" ? "checked" : ""; ?> >
                <label class="form-check-label"><?php echo $this->lang->line('yes'); ?></label>
            </div>
            <div class="form-check form-check-inline">
                <input type="radio" name="rte" class="form-check-input" value="No" <?php echo set_value('rte') == "no" ? "checked" : ""; ?> >
                <label class="form-check-label"><?php echo $this->lang->line('no'); ?></label>
            </div>
            <span class="text-danger"><?php echo form_error('rte'); ?></span>
        </div>
        <?php } ?>
    </div>
    <div class="row g-3 mb-2">
        <?php if ($this->customlib->getfieldstatus('previous_school_details')) { ?>
        <div class="col-md-6">
            <div class="form-group">
                <label class="form-label"><?php echo $this->lang->line('previous_school_details'); ?></label>
                <textarea class="form-control" rows="1" name="previous_school" autocomplete="off"><?php echo set_value('previous_school'); ?></textarea>
                <span class="text-danger"><?php echo form_error('previous_school'); ?></span>
            </div>
        </div>
        <?php } if ($this->customlib->getfieldstatus('student_note')) { ?>
        <div class="col-md-6">
            <div class="form-group">
                <label class="form-label"><?php echo $this->lang->line('note'); ?></label>
                <textarea class="form-control" rows="1" name="note" autocomplete="off"><?php echo set_value('note'); ?></textarea>
                <span class="text-danger"><?php echo form_error('note'); ?></span>
            </div>
        </div>
        <?php } ?>
    </div>
    <?php } ?>

    <?php if ($this->customlib->getfieldstatus('upload_documents')) { ?>
    <h4 class="pagetitleh2"><?php echo $this->lang->line('upload_documents'); ?></h4>
    <div class="row g-3 mb-2">
        <div class="col-md-6">
            <div class="form-group">
                <label class="form-label"><?php echo $this->lang->line('documents'); ?> <small><?php echo $this->lang->line('if_upload_multiple_document'); ?></small></label>
                <input id="document" name="document" type="file" class="form-control filestyle" value="<?php echo set_value('document'); ?>" />
                <span class="text-danger"><?php echo form_error('document'); ?></span>
            </div>
        </div>
    </div>
    <?php } ?>

    <div class="row g-3 mt-3">
        <?php if ($is_captcha) { ?>
        <div class="col-lg-4 col-md-5 col-sm-7">
            <div class="d-flex align-items-center">
                <span id="captcha_image"><?php echo $this->captchalib->generate_captcha()['image']; ?></span>
                <span class="fa fa-refresh capture-icon" title='Refresh Catpcha' onclick="refreshCaptcha()"></span>
                <input type="text" name="captcha" placeholder="<?php echo $this->lang->line('captcha'); ?>" class="form-control ms-2 width-auto" id="captcha" autocomplete="off">
            </div>
        </div>
        <?php } ?>
        <div class="col-lg-2 col-md-2 col-sm-5">
            <button type="submit" class="onlineformbtn mt-2"><?php echo $this->lang->line('submit'); ?></button>
        </div>
        <div class="col-md-7">
            <span class="text-danger"><?php echo form_error('captcha'); ?></span>
        </div>
    </div>
</form>
        </div>
    </div>
</div>

<div id="checkOnlineAdmissionStatus" class="modal fade" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header modal-header-small">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        <h4><?php echo $this->lang->line('check_your_form_status') ?></h4>
      </div>
      <form action="<?php echo base_url() . 'welcome/checkadmissionstatus' ?>" method="post" class="onlineform" id="checkstatusform">
        <div class="modal-body">
          <div class="form-group mb-3">
            <label class="form-label"><?php echo $this->lang->line('enter_your_reference_number'); ?> <span class="req">*</span></label>
            <input type="text" class="form-control" name="refno" id="refno" autocomplete="off">
            <span class="text-danger" id="error_status_refno"></span>
          </div>
          <div class="form-group mb-3">
            <label class="form-label"><?php echo $this->lang->line('select_your_date_of_birth'); ?> <span class="req">*</span></label>
            <input type="text" class="form-control date2" name="student_dob" id="student_dob" autocomplete="off">
            <span class="text-danger" id="error_status_dob"></span>
          </div>
          <span class="text-danger" id="invaliderror"></span>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><?php echo $this->lang->line('close'); ?></button>
          <button type="submit" class="onlineformbtn"><?php echo $this->lang->line('submit'); ?></button>
        </div>
      </form>
    </div>
  </div>
</div>

<script>
var date_format = '<?php echo strtr($this->customlib->getSchoolDateFormat(), ['d' => 'dd', 'm' => 'mm', 'Y' => 'yyyy']) ?>';
var datetime_format = '<?php echo strtr($this->customlib->getSchoolDateFormat(), ['d' => 'DD', 'm' => 'MM', 'M' => 'MMM', 'Y' => 'YYYY']) ?>';

$(document).ready(function () {
    var class_id = $('#class_id').val();
    var section_id = '<?php echo set_value('section_id', 0) ?>';
    getSectionByClass(class_id, section_id);

    $(document).on('change', '#class_id', function () {
        $('#section_id').html("");
        var class_id = $(this).val();
        getSectionByClass(class_id, 0);
    });

    $('.date2, .date').datepicker({
        autoclose: true,
        format: date_format,
        todayHighlight: true
    });
    $('.datetime').datetimepicker({
        format: datetime_format + ' hh:mm a',
        locale:'en'
    });

    function getSectionByClass(class_id, section_id) {
        if (class_id !== "") {
            $('#section_id').html("");
            var div_data = '';
            $.ajax({
                type: "POST",
                url: base_url + "welcome/getSections",
                data: {'class_id': class_id},
                dataType: "json",
                beforeSend: function () {
                    $('#section_id').addClass('dropdownloading');
                },
                success: function (data) {
                    $.each(data, function (i, obj) {
                        var sel = "";
                        if (section_id === obj.section_id) sel = "selected";
                        div_data += "<option value='" + obj.id + "' " + sel + ">" + obj.section + "</option>";
                    });
                    $('#section_id').append(div_data);
                },
                complete: function () {
                    $('#section_id').removeClass('dropdownloading');
                }
            });
        }
    }
});

function openStatusFormmodal(){
    $('#error_status_dob').html("");
    $('#error_status_refno').html("");
    $('#invaliderror').html("");
    $('#student_dob').val("");
    $('#refno').val("");
    $(':input').val('');
}
function auto_fill_guardian_address() {
    if ($("#autofill_current_address").is(':checked'))
        $('#current_address').val($('#guardian_address').val());
}
function auto_fill_address() {
    if ($("#autofill_address").is(':checked'))
        $('#permanent_address').val($('#current_address').val());
}
function refreshCaptcha(){
    $.ajax({
        type: "POST",
        url: "<?php echo base_url('site/refreshCaptcha'); ?>",
        data: {},
        success: function(captcha){
            $("#captcha_image").html(captcha);
        }
    });
}

$('input:radio[name="guardian_is"]').change(function () {
    if ($(this).is(':checked')) {
        var value = $(this).val();
        if (value === "father") {
            $('#guardian_name').val($('#father_name').val());
            $('#guardian_phone').val($('#father_phone').val());
            $('#guardian_occupation').val($('#father_occupation').val());
            $('#guardian_relation').val("<?php echo $this->lang->line('father'); ?>");
        } else if (value === "mother") {
            $('#guardian_name').val($('#mother_name').val());
            $('#guardian_phone').val($('#mother_phone').val());
            $('#guardian_occupation').val($('#mother_occupation').val());
            $('#guardian_relation').val("<?php echo $this->lang->line('mother'); ?>");
        } else {
            $('#guardian_name').val("");
            $('#guardian_phone').val("");
            $('#guardian_occupation').val("");
            $('#guardian_relation').val("");
        }
    }
});

$(document).on('submit','#checkstatusform',function(e){
    e.preventDefault();
    var form = $(this);
    var url = form.attr('action');
    var form_data = form.serializeArray();
    $.ajax({
        url: url,
        type: "POST",
        dataType:'JSON',
        data: form_data,
        success: function(response) {
            if (response.status==0) {
                $.each(response.error, function(key, value) {
                    $('#error_status_' + key).html(value);
                });
            } else if (response.status==2) {
                $('#error_status_dob').html("");
                $('#error_status_refno').html("");
                $('#invaliderror').html(response.error);
            } else {
                var refno = response.refno;
                window.location.href="<?php echo base_url() . 'welcome/online_admission_review/' ?>"+refno;
            }
        }
    });
});

$(function(){
    $('#checkOnlineAdmissionStatus').modal({
        backdrop: 'static',
        keyboard: false,
        show: false
    });
});
</script>