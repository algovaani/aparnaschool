<div class="content-wrapper" style="background: linear-gradient(135deg,#f8fafc 0%,#e0e7ff 100%);min-height:100vh;">
    <!-- Main content -->
    <section class="content">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card shadow-lg border-0 mt-4" style="border-radius:18px;background:#fff;">
                    <div class="card-header bg-gradient-primary text-white d-flex align-items-center" style="border-radius:18px 18px 0 0;">
                        <h3 class="mb-0"><i class="fa fa-users me-2"></i> <?php echo $this->lang->line('bulk_delete'); ?> <span class="badge bg-success ms-2">You are in bulk delete section</span></h3>
                    </div>
                    <!-- Modern Filter Area -->
                    <div class="filter-bar shadow-lg mb-4" style="margin-top:24px; padding:32px 40px; border-radius:20px; background: linear-gradient(90deg,#6366f1 0%,#14b8a6 100%); display:flex; align-items:center; gap:32px; min-width:640px;">
                        <form role="form" action="<?php echo site_url('student/bulkdelete') ?>" method="post" class="d-flex flex-column flex-md-row align-items-center gap-4 w-100">
                            <?php echo $this->customlib->getCSRF(); ?>
                            <div>
                                <label for="class_id" class="form-label text-white fs-5 fw-bold mb-1">
                                    <i class="fa fa-graduation-cap me-2"></i>Class
                                </label>
                                <select id="class_id" name="class_id" class="form-select form-select-lg border-0 shadow-sm" style="width:180px; border-radius:12px; font-size:1.2rem;">
                                    <option value=""><?php echo $this->lang->line('select'); ?></option>
                                    <?php foreach ($classlist as $class) { ?>
                                        <option value="<?php echo $class['id'] ?>" <?php if (set_value('class_id') == $class['id']) { echo "selected=selected"; } ?>>
                                            <?php echo $class['class'] ?>
                                        </option>
                                    <?php } ?>
                                </select>
                                <span class="text-warning"><?php echo form_error('class_id'); ?></span>
                            </div>
                            <div>
                                <label for="section_id" class="form-label text-white fs-5 fw-bold mb-1">
                                    <i class="fa fa-layer-group me-2"></i>Section
                                </label>
                                <select id="section_id" name="section_id" class="form-select form-select-lg border-0 shadow-sm" style="width:180px; border-radius:12px; font-size:1.2rem;">
                                    <option value=""><?php echo $this->lang->line('select'); ?></option>
                                </select>
                                <span class="text-warning"><?php echo form_error('section_id'); ?></span>
                            </div>
                            <div class="mt-4 mt-md-0">
                                <button type="submit" name="search" value="search_filter"
                                    class="btn btn-lg btn-gradient-search px-4 py-2 fs-5 fw-bold text-white shadow"
                                    style="border-radius:12px;">
                                    <i class="fa fa-search me-2"></i>Search
                                </button>
                            </div>
                        </form>
                    </div>
                    <!-- End Filter Area -->

                    <div class="card-body pt-0">
                        <form action="<?php echo site_url('student/ajax_delete') ?>" method="POST" id="deletebulk">
                            <?php if (isset($resultlist) && !empty($resultlist)) { ?>
                                <div class="d-flex justify-content-between align-items-center my-2">
                                    <label class="form-check-label fs-5">
                                        <input type="checkbox" name="checkAll" class="form-check-input me-2" id="selectAll"> <b><?php echo $this->lang->line('select_all'); ?></b>
                                    </label>
                                    <button type="submit" class="btn btn-danger btn-lg shadow-sm" id="load" data-loading-text="<i class='fa fa-spinner fa-spin'></i> <?php echo $this->lang->line('please_wait'); ?>">
                                        <i class="fa fa-trash-alt"></i> <?php echo $this->lang->line('delete') ?>
                                    </button>
                                </div>
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered table-hover align-middle" id="bulkTable" style="background:#fff;border-radius:10px;overflow:hidden;">
                                        <thead class="sticky-top bg-gradient-primary text-white">
                                            <tr>
                                                <th>#</th>
                                                <th><?php echo $this->lang->line('admission_no'); ?></th>
                                                <th><?php echo $this->lang->line('student_name'); ?></th>
                                                <th><?php echo $this->lang->line('class'); ?></th>
                                                <th><?php echo $this->lang->line('date_of_birth'); ?></th>
                                                <th><?php echo $this->lang->line('gender'); ?></th>
                                                <?php if ($sch_setting->category) { ?>
                                                    <th><?php echo $this->lang->line('category'); ?></th>
                                                <?php } if ($sch_setting->mobile_no) { ?>
                                                    <th><?php echo $this->lang->line('mobile_number'); ?></th>
                                                <?php }
                                                if (!empty($fields)) { foreach ($fields as $fields_key => $fields_value) { ?>
                                                    <th><?php echo $fields_value->name; ?></th>
                                                <?php } } ?>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $count = 1; foreach ($resultlist as $student) { ?>
                                                <tr>
                                                    <td>
                                                        <input type="checkbox" name="student[]" value="<?php echo $student['id']; ?>" class="form-check-input">
                                                    </td>
                                                    <td><?php echo $student['admission_no']; ?></td>
                                                    <td>
                                                        <a href="<?php echo base_url(); ?>student/view/<?php echo $student['id']; ?>" class="text-decoration-none text-primary fw-bold" title="View Details">
                                                            <?php echo $this->customlib->getFullName($student['firstname'],$student['middlename'],$student['lastname'],$sch_setting->middlename,$sch_setting->lastname); ?>
                                                        </a>
                                                    </td>
                                                    <td><?php echo $student['class'] . " (" . $student['section'] . ")" ?></td>
                                                    <td><?php if ($student["dob"] != null && $student["dob"]!='0000-00-00') { echo date($this->customlib->getSchoolDateFormat(), $this->customlib->dateyyyymmddTodateformat($student['dob'])); } ?></td>
                                                    <td><?php echo $this->lang->line(strtolower($student['gender'])); ?></td>
                                                    <?php if ($sch_setting->category) { ?>
                                                        <td><?php echo $student['category']; ?></td>
                                                    <?php } if ($sch_setting->mobile_no) { ?>
                                                        <td><?php echo $student['mobileno']; ?></td>
                                                    <?php }
                                                    if (!empty($fields)) { foreach ($fields as $fields_key => $fields_value) {
                                                        $display_field = $student[$fields_value->name];
                                                        if ($fields_value->type == "link") {
                                                            $display_field = "<a href='" . $student[$fields_value->name] . "' target='_blank' class='text-info'>" . $student[$fields_value->name] . "</a>";
                                                        } ?>
                                                        <td><?php echo $display_field; ?></td>
                                                    <?php } } ?>
                                                </tr>
                                            <?php $count++; } ?>
                                        </tbody>
                                    </table>
                                </div>
                            <?php } ?>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<!-- Robust Modern Styling -->
<style>
    .bg-gradient-primary {
        background: linear-gradient(90deg,#6366f1 0%,#14b8a6 100%) !important;
    }
    .btn-gradient-search {
        background: linear-gradient(90deg, #14b8a6 0%, #6366f1 100%);
        border: none;
        transition: box-shadow 0.2s, transform 0.2s;
    }
    .btn-gradient-search:hover {
        box-shadow: 0 6px 18px 0 rgba(99,102,241,0.18);
        transform: translateY(-2px) scale(1.04);
        opacity:0.98;
    }
    .btn-danger {
        background: linear-gradient(90deg,#ef4444 0%,#f59e42 100%);
        border:none;color:#fff;
    }
    .table thead th {
        background: #6366f1 !important;color:#fff !important;font-weight:600;border:none;
    }
    .table-striped > tbody > tr:nth-of-type(odd) { background-color: #f3f4f6; }
    .table-hover tbody tr:hover { background-color: #e0e7ff; }
    .form-select, .form-control {
        border: 2px solid #6366f1;border-radius:10px;box-shadow:0 1px 2px rgba(99,102,241,0.05);
    }
    .form-select:focus, .form-control:focus {
        border-color:#14b8a6;box-shadow:0 0 0 2px #14b8a655;
    }
    .sticky-top { position: sticky; top: 0; z-index: 2; }
    .card-title i { margin-right:8px; }
    .card { border-radius:18px;overflow:hidden; }
    .form-check-input { width:1.5em;height:1.5em; }
    #selectAll:checked { accent-color:#6366f1; }
    @media (max-width: 768px) {
        .table-responsive { font-size: 0.95em; }
        .card-body { padding: 0.75rem; }
        .filter-bar { flex-direction:column; gap:18px; padding:18px 10px; min-width:100%; }
    }
</style>
<script type="text/javascript">
    // Section dropdown AJAX
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

        // Robust Select All Checkbox
        $("#selectAll").click(function () {
            $("input[name='student[]']").prop('checked', $(this).prop('checked'));
        });

        // Robust Delete Handler
        $("#deletebulk").submit(function (e) {
            e.preventDefault();
            var checkCount = $("input[name='student[]']:checked").length;
            if (checkCount == 0) {
                alert("<?php echo $this->lang->line('atleast_one_student_should_be_select'); ?>");
            } else {
                if (confirm("<?php echo $this->lang->line('are_you_sure_you_want_to_delete'); ?>")) {
                    var form = $(this);
                    var url = form.attr('action');
                    var submit_button = form.find(':submit');
                    $.ajax({
                        type: "POST",
                        url: url,
                        data: form.serialize(),
                        dataType: "JSON",
                        beforeSend: function () { submit_button.button('loading'); },
                        success: function (data) {
                            var message = "";
                            if (!data.status) {
                                $.each(data.error, function (index, value) { message += value; });
                                errorMsg(message);
                            } else {
                                successMsg(data.message);
                                location.reload();
                            }
                        },
                        error: function (xhr) {
                            submit_button.button('reset');
                            alert("<?php echo $this->lang->line('error_occurred_please_try_again'); ?>");
                        },
                        complete: function () { submit_button.button('reset'); }
                    });
                }
            }
        });
    });
</script>