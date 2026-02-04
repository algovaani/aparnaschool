<?php
$currency_symbol = $this->customlib->getSchoolCurrencyFormat();
?>

<!-- Main Content Area: add class for extra left margin and shadow for separation -->
<div class="main-content separated-content">
<?php
if (!empty($students->data)) {
    foreach ($students->data as $student_key => $student) {
        if (empty($student->image)) {
            $image = ($student->gender == 'Female') ? "uploads/student_images/default_female.jpg" : "uploads/student_images/default_male.jpg";
        } else {
            $image = $student->image;
        }
?>
    <div class="modern-student-card">
        <div class="msc-image-wrap">
            <a href="<?php echo base_url(); ?>student/view/<?php echo $student->id ?>">
                <?php if ($sch_setting->student_photo) { ?>
                    <img class="msc-image" alt="<?php echo $student->firstname . " " . $student->lastname ?>" src="<?php echo $this->media_storage->getImageURL($image); ?>">
                <?php } ?>
            </a>
        </div>
        <div class="msc-content">
            <h4 class="msc-title">
                <a href="<?php echo base_url(); ?>student/view/<?php echo $student->id ?>">
                    <?php echo $this->customlib->getFullName($student->firstname, $student->middlename, $student->lastname, $sch_setting->middlename, $sch_setting->lastname); ?>
                </a>
            </h4>
            <div class="msc-info-row">
                <div class="msc-info-col">
                    <span class="msc-label"><?php echo $this->lang->line('class'); ?>:</span>
                    <span class="msc-value"><?php echo $student->class . " (" . $student->section . ")"; ?></span>
                </div>
                <div class="msc-info-col">
                    <span class="msc-label"><?php echo $this->lang->line('admission_no'); ?>:</span>
                    <span class="msc-value"><?php echo $student->admission_no; ?></span>
                </div>
                <div class="msc-info-col">
                    <span class="msc-label"><?php echo $this->lang->line('date_of_birth'); ?>:</span>
                    <span class="msc-value">
                    <?php
                        if ($student->dob != null && $student->dob != '0000-00-00') {
                            echo $this->customlib->dateFormat($student->dob);
                        }
                    ?>
                    </span>
                </div>
                <div class="msc-info-col">
                    <span class="msc-label"><?php echo $this->lang->line('gender'); ?>:</span>
                    <span class="msc-value"><?php echo $this->lang->line(strtolower($student->gender)); ?></span>
                </div>
            </div>
            <div class="msc-info-row">
                <div class="msc-info-col">
                    <span class="msc-label"><?php echo $this->lang->line('local_identification_number'); ?>:</span>
                    <span class="msc-value"><?php echo $student->samagra_id; ?></span>
                </div>
                <?php if ($sch_setting->guardian_name) { ?>
                <div class="msc-info-col">
                    <span class="msc-label"><?php echo $this->lang->line('guardian_name'); ?>:</span>
                    <span class="msc-value"><?php echo $student->guardian_name; ?></span>
                </div>
                <div class="msc-info-col">
                    <span class="msc-label"><?php echo $this->lang->line('guardian_phone'); ?>:</span>
                    <span class="msc-value"><i class="fa fa-phone-square"></i> <?php echo $student->guardian_phone; ?></span>
                </div>
                <?php } ?>
                <div class="msc-info-col">
                    <span class="msc-label"><?php echo $this->lang->line('current_address'); ?>:</span>
                    <span class="msc-value"><?php echo $student->current_address . ' ' . $student->city; ?></span>
                </div>
            </div>
        </div>
        <div class="msc-actions">
            <a href="<?php echo base_url(); ?>student/view/<?php echo $student->id ?>" class="msc-btn" title="<?php echo $this->lang->line('view'); ?>">
                <i class="fa fa-reorder"></i>
            </a>
            <?php if ($this->rbac->hasPrivilege('student', 'can_edit')) { ?>
            <a href="<?php echo base_url(); ?>student/edit/<?php echo $student->id ?>" class="msc-btn" title="<?php echo $this->lang->line('edit'); ?>">
                <i class="fa fa-pencil"></i>
            </a>
            <?php }
            if ($this->module_lib->hasActive('fees_collection') &&  $this->rbac->hasPrivilege('collect_fees', 'can_add')) { ?>
            <a href="<?php echo base_url(); ?>studentfee/addfee/<?php echo $student->student_session_id ?>" class="msc-btn" title="<?php echo $this->lang->line('add_fees'); ?>">
                <?php echo $currency_symbol; ?>
            </a>
            <?php } ?>
            <a type="button"
               class="msc-btn print_student_details shadow-none"
               data-student_id="<?php echo $student->id ?>"
               data-student_name="<?php echo $this->customlib->getFullName($student->firstname, $student->middlename, $student->lastname, $sch_setting->middlename, $sch_setting->lastname); ?>"
               data-admission_no="<?php echo $student->admission_no; ?>"
               data-action="download"
               title="Print">
                <i class="fa fa-print"></i>
            </a>
        </div>
    </div>
<?php
    }
} else {
?>
    <div class="alert alert-info modern-alert"><?php echo $this->lang->line('no_record_found'); ?></div>
<?php
}
?>
</div>

<!-- Modern and Colourful CSS -->
<style>
/* Main content separated from sidebar with extra margin and shadow */
.main-content.separated-content {
    margin-left: 280px; /* Set this to your sidebar width + extra separation (e.g. sidebar is 240px, add 40px extra) */
    box-shadow: 0 0 20px 0 rgba(90,90,150,0.10); /* Subtle shadow for separation */
    background: #fff;
    border-radius: 10px;
    min-height: 90vh;
    padding: 24px 18px 0 18px;
    transition: margin-left 0.3s;
}
@media (max-width: 991px) {
    .main-content.separated-content {
        margin-left: 0;
        box-shadow: none;
        border-radius: 0;
        padding: 12px 8px;
        min-height: unset;
    }
}
.modern-student-card {
    background: linear-gradient(135deg, #e0eafc 0%, #cfdef3 100%);
    border-radius: 16px;
    box-shadow: 0 4px 24px rgba(99, 102, 241, 0.09);
    padding: 20px 28px 18px 28px;
    margin-bottom: 22px;
    display: flex;
    flex-wrap: wrap;
    align-items: flex-start;
    transition: box-shadow 0.2s;
}
.modern-student-card:hover {
    box-shadow: 0 6px 32px rgba(99, 102, 241, 0.18);
}
.msc-image-wrap {
    min-width: 120px;
    max-width: 120px;
    margin-right: 22px;
}
.msc-image {
    width: 120px;
    height: 120px;
    border-radius: 50%;
    object-fit: cover;
    box-shadow: 0 2px 8px rgba(76, 201, 240, 0.13);
    border: 3px solid #667eea;
    background: #fff;
}
.msc-content {
    flex: 1;
    min-width: 220px;
}
.msc-title {
    font-size: 1.22rem;
    margin: 0 0 8px 0;
    font-weight: 700;
    color: #4f4f6f;
    letter-spacing: 0.02em;
}
.msc-title a {
    color: #5f5fee;
    text-decoration: none;
}
.msc-title a:hover {
    text-decoration: underline;
}
.msc-info-row {
    display: flex;
    flex-wrap: wrap;
    margin-bottom: 8px;
}
.msc-info-col {
    min-width: 120px;
    margin-right: 22px;
    margin-bottom: 4px;
}
.msc-label {
    font-weight: 600;
    color: #667eea;
    font-size: 0.99rem;
}
.msc-value {
    font-weight: 400;
    color: #444;
    margin-left: 2px;
    font-size: 0.97rem;
}
.msc-actions {
    display: flex;
    align-items: center;
    margin-top: 14px;
}
.msc-btn {
    background: linear-gradient(90deg, #43e97b 0%, #38f9d7 100%);
    color: #fff !important;
    border: none;
    border-radius: 50px;
    padding: 8px 18px;
    margin-right: 10px;
    box-shadow: 0 1px 8px rgba(67,233,123,0.13);
    font-size: 1.05rem;
    transition: background 0.18s;
    text-decoration: none;
    display: inline-block;
}
.msc-btn:hover {
    background: linear-gradient(90deg, #5f5fee 0%, #43e97b 100%);
    color: #fff !important;
}
.modern-alert {
    border-radius: 10px;
    background: linear-gradient(90deg, #f5f7fa 0%, #c3cfe2 100%);
    color: #444;
    font-weight: 600;
    font-size: 1.07rem;
    padding: 20px 30px;
    box-shadow: 0 2px 10px rgba(99, 102, 241, 0.06);
    margin: 22px 0;
}

/* Responsive Styles */
@media (max-width: 600px) {
    .modern-student-card {
        flex-direction: column;
        align-items: center;
        padding: 14px 7px;
    }
    .msc-image-wrap {
        margin-right: 0;
        margin-bottom: 12px;
    }
    .msc-content {
        min-width: 0;
        width: 100%;
    }
}
</style>