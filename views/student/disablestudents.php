<?php
$currency_symbol = $this->customlib->getSchoolCurrencyFormat();
?>
<div class="content-wrapper" style="background: linear-gradient(135deg, #f8fafc 0%, #e0e7ff 100%); min-height:100vh;">
    <section class="content-header">
        <h1>
            <i class="fa fa-user-plus text-primary"></i>
            <span class="fw-bold text-dark"><?php echo $this->lang->line('student_information'); ?></span>
            <small class="badge bg-gradient-info ms-2"><?php echo $this->lang->line('student1'); ?></small>
        </h1>
    </section>
    <section class="content">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card shadow-lg border-0 mt-4" style="border-radius:20px; background:#fff;">
                    <div class="card-header bg-gradient-primary text-white d-flex align-items-center" style="border-radius:20px 20px 0 0;">
                        <h3 class="mb-0"><i class="fa fa-search me-2"></i> <?php echo $this->lang->line('select_criteria'); ?></h3>
                    </div>
                    <div class="card-body pb-0">
                        <?php if ($this->session->flashdata('msg')) { ?>
                            <div class="alert alert-success fade show">
                                <?php echo $this->session->flashdata('msg'); $this->session->unset_userdata('msg'); ?>
                            </div>
                        <?php } ?>
                        <div class="row g-4 align-items-center">
                            <div class="col-md-12">
                                <form role="form" action="<?php echo site_url('student/disablestudentslist') ?>" method="post" class="row g-4 align-items-center">
                                    <?php echo $this->customlib->getCSRF(); ?>
                                    <div class="col-lg-5 col-md-6">
                                        <label class="form-label fw-bold text-primary"><?php echo $this->lang->line('class'); ?> <small class="req">*</small></label>
                                        <select autofocus id="class_id" name="class_id" class="form-select form-select-lg border-primary shadow-sm modern-select">
                                            <option value=""><?php echo $this->lang->line('select'); ?></option>
                                            <?php foreach ($classlist as $class) { ?>
                                                <option value="<?php echo $class['id'] ?>" <?php if (set_value('class_id') == $class['id']) { echo "selected=selected"; } ?>>
                                                    <?php echo $class['class'] ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                        <span class="text-danger"><?php echo form_error('class_id'); ?></span>
                                    </div>
                                    <div class="col-lg-5 col-md-6">
                                        <label class="form-label fw-bold text-primary"><?php echo $this->lang->line('section'); ?></label>
                                        <select id="section_id" name="section_id" class="form-select form-select-lg border-primary shadow-sm modern-select">
                                            <option value=""><?php echo $this->lang->line('select'); ?></option>
                                        </select>
                                        <span class="text-danger"><?php echo form_error('section_id'); ?></span>
                                    </div>
                                    <div class="col-lg-2 col-12 d-flex justify-content-lg-start justify-content-end mt-lg-auto mt-3">
                                        <button type="submit" name="search" value="search_filter" class="btn btn-lg btn-gradient-primary px-4 shadow-sm modern-button">
                                            <i class="fa fa-search me-2"></i> <?php echo $this->lang->line('search'); ?>
                                        </button>
                                    </div>
                                </form>
                            </div>
                            <div class="col-md-12 mt-4">
                                <form role="form" action="<?php echo site_url('student/disablestudentslist') ?>" method="post" class="row g-3 align-items-center">
                                    <?php echo $this->customlib->getCSRF(); ?>
                                    <div class="col-lg-10 col-md-9">
                                        <label class="form-label fw-bold text-primary"><?php echo $this->lang->line('search_by_keyword'); ?></label>
                                        <input type="text" name="search_text" class="form-control form-control-lg border-primary shadow-sm modern-input" placeholder="<?php echo $this->lang->line('search_by_student_name'); ?>" >
                                    </div>
                                    <div class="col-lg-2 col-md-3 text-end d-flex justify-content-lg-start justify-content-end mt-lg-auto mt-3">
                                        <button type="submit" name="search" value="search_full" class="btn btn-lg btn-gradient-primary px-4 shadow-sm modern-button">
                                            <i class="fa fa-search me-2"></i> <?php echo $this->lang->line('search'); ?>
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <?php if (isset($resultlist)) { ?>
                        <div class="nav-tabs-custom border-0 mt-4">
                            <ul class="nav nav-tabs">
                                <li class="active"><a href="#tab_1" data-toggle="tab" aria-expanded="true"><i class="fa fa-list"></i> <?php echo $this->lang->line('list_view'); ?></a></li>
                                <li><a href="#tab_2" data-toggle="tab" aria-expanded="false"><i class="fa fa-newspaper-o"></i> <?php echo $this->lang->line('details_view'); ?></a></li>
                            </ul>
                            <div class="tab-content">
                                <div class="download_label bg-gradient-primary text-white px-3 py-2 rounded mt-2 mb-2 fw-bold">
                                    <?php echo $this->lang->line('disable_student_list'); ?>
                                </div>
                                <div class="tab-pane active table-responsive" id="tab_1">
                                    <table class="table table-striped table-bordered table-hover align-middle" style="background:#fff; border-radius:12px;">
                                        <thead class="bg-gradient-primary text-white">
                                            <tr>
                                                <th><?php echo $this->lang->line('admission_no'); ?></th>
                                                <th><?php echo $this->lang->line('student_name'); ?></th>
                                                <th><?php echo $this->lang->line('class'); ?></th>
                                                <?php if ($sch_setting->father_name) { ?>
                                                    <th><?php echo $this->lang->line('father_name'); ?></th>
                                                <?php } ?>
                                                <th><?php echo $this->lang->line('disable_reason'); ?></th>
                                                <th><?php echo $this->lang->line('gender'); ?></th>
                                                <?php if ($sch_setting->mobile_no) { ?>
                                                    <th><?php echo $this->lang->line('mobile_number'); ?></th>
                                                <?php } ?>
                                                <th class="text-end noExport"><?php echo $this->lang->line('action'); ?></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if (!empty($resultlist)) {
                                                foreach ($resultlist as $student) {
                                                    $reason_id = $student['dis_reason'];
                                            ?>
                                            <tr>
                                                <td><?php echo $student['admission_no']; ?></td>
                                                <td>
                                                    <a href="<?php echo base_url(); ?>student/view/<?php echo $student['id']; ?>" class="text-decoration-none text-primary fw-bold">
                                                        <?php echo $this->customlib->getFullName($student['firstname'], $student['middlename'], $student['lastname'], $sch_setting->middlename, $sch_setting->lastname); ?>
                                                    </a>
                                                </td>
                                                <td><?php echo $student['class'] . "(" . $student['section'] . ")" ?></td>
                                                <?php if ($sch_setting->father_name) { ?>
                                                    <td><?php echo $student['father_name']; ?></td>
                                                <?php } ?>
                                                <td>
                                                    <span data-toggle="popover" class="detail_popover text-info" data-original-title="" title="">
                                                        <?php if (array_key_exists($reason_id, $disable_reason)) {
                                                            echo $disable_reason[$reason_id]['reason'];
                                                        } ?>
                                                    </span>
                                                    <div class="fee_detail_popover" style="display: none"><?php echo $student['dis_note']; ?></div>
                                                </td>
                                                <td><?php echo $this->lang->line(strtolower($student['gender'])); ?></td>
                                                <?php if ($sch_setting->mobile_no) { ?>
                                                    <td><?php echo $student['mobileno']; ?></td>
                                                <?php } ?>
                                                <td class="text-end">
                                                    <a href="<?php echo base_url(); ?>student/view/<?php echo $student['id'] ?>" class="btn btn-outline-primary btn-sm" data-toggle="tooltip" title="<?php echo $this->lang->line('view'); ?>">
                                                        <i class="fa fa-eye"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                            <?php } } ?>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="tab-pane" id="tab_2">
                                    <?php if (empty($resultlist)) { ?>
                                        <div class="alert alert-info"><?php echo $this->lang->line('no_record_found'); ?></div>
                                    <?php } else {
                                        foreach ($resultlist as $student) {
                                            $image = empty($student["image"]) ? "uploads/student_images/no_image.png" : $student['image'];
                                    ?>
                                    <div class="card mb-4 shadow-sm" style="border-radius:16px;">
                                        <div class="row g-3 align-items-center">
                                            <div class="col-sm-2 d-flex justify-content-center align-items-center">
                                                <a href="<?php echo base_url(); ?>student/view/<?php echo $student['id'] ?>">
                                                    <img class="img-fluid img-thumbnail" alt="<?php echo $student["firstname"] . " " . $student["lastname"] ?>" src="<?php echo $this->media_storage->getImageURL($image); ?>" style="width:110px; height:110px; border-radius:50%;">
                                                </a>
                                            </div>
                                            <div class="col-sm-10">
                                                <h4>
                                                    <a href="<?php echo base_url(); ?>student/view/<?php echo $student['id'] ?>" class="fw-bold text-primary">
                                                        <?php echo $this->customlib->getFullName($student['firstname'], $student['middlename'], $student['lastname'], $sch_setting->middlename, $sch_setting->lastname); ?>
                                                    </a>
                                                </h4>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <address>
                                                            <strong><b><?php echo $this->lang->line('class'); ?>: </b><?php echo $student['class'] . "(" . $student['section'] . ")" ?></strong><br>
                                                            <b><?php echo $this->lang->line('admission_no'); ?>: </b><?php echo $student['admission_no'] ?><br/>
                                                            <b><?php echo $this->lang->line('date_of_birth'); ?>:</b>
                                                            <?php if (!empty($student['dob']) && $student['dob'] != null) {
                                                                echo date($this->customlib->getSchoolDateFormat(), $this->customlib->dateyyyymmddTodateformat($student['dob']));
                                                            } ?><br>
                                                            <b><?php echo $this->lang->line('gender'); ?>:</b> <?php echo $this->lang->line(strtolower($student['gender'])) ?><br>
                                                        </address>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <?php if ($sch_setting->local_identification_no) { ?>
                                                            <b><?php echo $this->lang->line('local_identification_number'); ?>:</b> <?php echo $student['samagra_id'] ?><br>
                                                        <?php } if ($sch_setting->guardian_name) { ?>
                                                            <b><?php echo $this->lang->line('guardian_name'); ?>:</b> <?php echo $student['guardian_name'] ?><br>
                                                        <?php } if ($sch_setting->guardian_phone) { ?>
                                                            <b><?php echo $this->lang->line('guardian_phone'); ?>:</b> <i class="fa fa-phone-square"></i> <?php echo $student['guardian_phone'] ?><br>
                                                        <?php } if ($sch_setting->current_address) { ?>
                                                            <b><?php echo $this->lang->line('current_address'); ?>:</b> <?php echo $student['current_address'] ?> <?php echo $student['city'] ?><br>
                                                        <?php } ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 text-end">
                                                <a href="<?php echo base_url(); ?>student/view/<?php echo $student['id'] ?>" class="btn btn-outline-primary btn-sm" data-toggle="tooltip" title="<?php echo $this->lang->line('view'); ?>">
                                                    <i class="fa fa-eye"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <?php } } ?>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div></div>
        </div>
    </section>
</div>

<style>
/* Existing Styles */
.bg-gradient-primary {
    background: linear-gradient(90deg, #6366f1 0%, #14b8a6 100%) !important;
}
.bg-gradient-info {
    background: linear-gradient(90deg, #38bdf8 0%, #14b8a6 100%) !important;
    color: #fff !important;
}
.btn-gradient-primary {
    background: linear-gradient(90deg,#6366f1 0%,#14b8a6 100%);
    border:none;color:#fff;font-weight:500;transition:box-shadow 0.2s;
}
.btn-gradient-primary:hover {
    box-shadow:0 4px 14px 0 rgba(99,102,241,0.15),0 2px 2px 0 rgba(20,184,166,0.10);
    opacity:0.95;
}
.table thead th {
    background: #6366f1 !important;color:#fff !important;font-weight:600;border:none;
}
.table-striped > tbody > tr:nth-of-type(odd) { background-color: #f3f4f6; }
.table-hover tbody tr:hover { background-color: #e0e7ff; }
.card { border-radius:20px;overflow:hidden; }

/* New & Modified Styles for Rectified Area */
.form-select.modern-select, .form-control.modern-input {
    border: 2px solid #a855f7; /* New border color for a fresh look */
    border-radius: 16px; /* Larger border-radius for softer edges */
    padding: 1rem 1.5rem; /* Increased padding for more space */
    font-size: 1.1rem; /* Larger font size for better readability */
    height: auto;
    background-color: #f9faff; /* Light background for the inputs */
    transition: all 0.3s ease; /* Smooth transitions for hover/focus effects */
}
.form-select.modern-select:focus, .form-control.modern-input:focus {
    border-color: #14b8a6; /* Highlight color on focus */
    box-shadow: 0 0 0 4px rgba(20, 184, 166, 0.2); /* A more prominent focus glow */
    outline: none;
}
.btn-gradient-primary.modern-button {
    background: linear-gradient(45deg, #a855f7, #6366f1); /* New, vibrant gradient */
    border-radius: 16px; /* Match the input field styling */
    padding: 0.75rem 2rem;
    font-size: 1.1rem;
    font-weight: 600;
    box-shadow: 0 6px 20px rgba(168, 85, 247, 0.2); /* Deeper shadow */
    transition: all 0.3s ease;
}
.btn-gradient-primary.modern-button:hover {
    background: linear-gradient(45deg, #6366f1, #a855f7); /* Reverse gradient on hover */
    box-shadow: 0 8px 25px rgba(99, 102, 241, 0.3);
    transform: translateY(-2px);
}
.card-body {
    padding: 2rem; /* Add more padding inside the card body for better space management */
}
.form-label {
    font-size: 1rem;
    color: #4a5568; /* Darker, more readable label text */
    margin-bottom: 0.5rem;
}
</style>

<script type="text/javascript">
function getSectionByClass(class_id, section_id) {
    if (class_id != "" && section_id != "") {
        $('#section_id').html("");
        var base_url = '<?php echo base_url() ?>';
        var div_data = '<option value=""><?php echo $this->lang->line('select'); ?></option>';
        $.ajax({
            type: "GET",
            url: base_url + "sections/getByClass",
            data: {'class_id': class_id},
            dataType: "json",
            success: function (data) {
                $.each(data, function (i, obj) {
                    var sel = "";
                    if (section_id == obj.section_id) { sel = "selected"; }
                    div_data += "<option value=" + obj.section_id + " " + sel + ">" + obj.section + "</option>";
                });
                $('#section_id').append(div_data);
            }
        });
    }
}
$(document).ready(function () {
    var class_id = $('#class_id').val();
    var section_id = '<?php echo set_value('section_id') ?>';
    getSectionByClass(class_id, section_id);
    $(document).on('change', '#class_id', function (e) {
        $('#section_id').html("");
        var class_id = $(this).val();
        var base_url = '<?php echo base_url() ?>';
        var div_data = '<option value=""><?php echo $this->lang->line('select'); ?></option>';
        $.ajax({
            type: "GET",
            url: base_url + "sections/getByClass",
            data: {'class_id': class_id},
            dataType: "json",
            success: function (data) {
                $.each(data, function (i, obj) {
                    div_data += "<option value=" + obj.section_id + ">" + obj.section + "</option>";
                });
                $('#section_id').append(div_data);
            }
        });
    });
    $('.detail_popover').popover({
        placement: 'right',
        title: '',
        trigger: 'hover',
        container: 'body',
        html: true,
        content: function () {
            return $(this).closest('td').find('.fee_detail_popover').html();
        }
    });
});
</script>