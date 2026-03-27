<?php
$sch_setting = isset($sch_setting) ? $sch_setting : new stdClass();
if (!isset($sch_setting->middlename)) $sch_setting->middlename = '';
if (!isset($sch_setting->lastname)) $sch_setting->lastname = '';
$resultlist = isset($resultlist) && is_array($resultlist) ? $resultlist : array();
?>
<div class="content-wrapper">
    <section class="content-header">
        <h1><i class="fa fa-certificate"></i> <?php echo isset($title) && $title ? $title : ($this->lang->line('issued_certificate_report') ?: 'Issued Certificate Report'); ?></h1>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title"><i class="fa fa-filter"></i> <?php echo $this->lang->line('select_criteria') ?: 'Select Criteria'; ?></h3>
                    </div>
                    <div class="box-body">
                        <form role="form" action="<?php echo isset($form_action) ? $form_action : site_url('financereports/issued_certificate_report'); ?>" method="post" class="">
                            <?php echo $this->customlib->getCSRF(); ?>
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label><?php echo $this->lang->line('certificate') ?: 'Certificate'; ?></label><small class="req"> *</small>
                                        <select name="certificate_id" id="certificate_id" class="form-control" required>
                                            <option value=""><?php echo $this->lang->line('select') ?: 'Select'; ?></option>
                                            <?php
                                            if (!empty($certificateList)) {
                                                foreach ($certificateList as $list) {
                                                    $sel = (isset($certificate_id) && $certificate_id == $list->id) ? 'selected="selected"' : '';
                                                    echo '<option value="' . $list->id . '" ' . $sel . '>' . htmlspecialchars($list->certificate_name) . '</option>';
                                                }
                                            }
                                            ?>
                                        </select>
                                        <span class="text-danger"><?php echo form_error('certificate_id'); ?></span>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label><?php echo $this->lang->line('class') ?: 'Class'; ?></label>
                                        <select id="class_id" name="class_id" class="form-control">
                                            <option value=""><?php echo $this->lang->line('all') ?: 'All'; ?></option>
                                            <?php
                                            if (!empty($classlist)) {
                                                foreach ($classlist as $cl) {
                                                    $cid = is_array($cl) ? $cl['id'] : $cl->id;
                                                    $cname = is_array($cl) ? $cl['class'] : $cl->class;
                                                    $sel = (isset($class_id) && $class_id == $cid) ? 'selected="selected"' : '';
                                                    echo '<option value="' . $cid . '" ' . $sel . '>' . htmlspecialchars($cname) . '</option>';
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label><?php echo $this->lang->line('section') ?: 'Section'; ?></label>
                                        <select id="section_id" name="section_id" class="form-control">
                                            <option value=""><?php echo $this->lang->line('all') ?: 'All'; ?></option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <button type="submit" name="search" value="search" class="btn btn-primary btn-sm"><i class="fa fa-search"></i> <?php echo $this->lang->line('search') ?: 'Search'; ?></button>
                                </div>
                            </div>
                        </form>
                    </div>

                    <?php if (isset($certificate_id) && $certificate_id !== '' && isset($resultlist)) { ?>
                        <div class="box-header with-border">
                            <h3 class="box-title">
                                <i class="fa fa-list"></i>
                                <?php echo $this->lang->line('student_list') ?: 'Student List'; ?>
                                <?php if (!empty($certificate_name)) { ?>
                                    <span class="text-muted"> - <?php echo htmlspecialchars($certificate_name); ?></span>
                                <?php } ?>
                                <?php if (!empty($filter_title)) { ?>
                                    <span class="text-muted"> (<?php echo htmlspecialchars($filter_title); ?>)</span>
                                <?php } ?>
                            </h3>
                            <div class="box-tools pull-right">
                                <span class="badge bg-blue"><?php echo count($resultlist); ?> <?php echo $this->lang->line('students') ?: 'Students'; ?></span>
                            </div>
                        </div>
                        <div class="box-body table-responsive">
                            <div class="download_label"><?php echo $this->lang->line('issued_certificate_report') ?: 'Issued Certificate Report'; ?></div>
                            <table class="table table-striped table-bordered table-hover example" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th><?php echo $this->lang->line('admission_no') ?: 'Admission No'; ?></th>
                                        <th><?php echo $this->lang->line('student_name') ?: 'Student Name'; ?></th>
                                        <th><?php echo $this->lang->line('class') ?: 'Class'; ?></th>
                                        <th><?php echo $this->lang->line('father_name') ?: 'Father Name'; ?></th>
                                        <th><?php echo $this->lang->line('date_of_birth') ?: 'Date of Birth'; ?></th>
                                        <th><?php echo $this->lang->line('issued_certificate_date') ?: 'Issued Certificate Date'; ?></th>
                                        <th><?php echo $this->lang->line('gender') ?: 'Gender'; ?></th>
                                        <th><?php echo $this->lang->line('category') ?: 'Category'; ?></th>
                                        <th><?php echo $this->lang->line('mobile_number') ?: 'Mobile Number'; ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if (empty($resultlist)) {
                                        echo '<tr><td colspan="10" class="text-center">' . ($this->lang->line('no_record_found') ?: 'No Record Found') . '</td></tr>';
                                    } else {
                                        $count = 1;
                                        foreach ($resultlist as $student) {
                                            ?>
                                            <tr>
                                                <td><?php echo $count++; ?></td>
                                                <td><?php echo htmlspecialchars($student['admission_no']); ?></td>
                                                <td>
                                                    <a href="<?php echo base_url('student/view/' . $student['id']); ?>">
                                                        <?php echo $this->customlib->getFullName($student['firstname'], $student['middlename'], $student['lastname'], $sch_setting->middlename, $sch_setting->lastname); ?>
                                                    </a>
                                                </td>
                                                <td><?php echo htmlspecialchars($student['class'] . (isset($student['section']) && $student['section'] !== '' ? ' (' . $student['section'] . ')' : '')); ?></td>
                                                <td><?php echo htmlspecialchars($student['father_name']); ?></td>
                                                <td><?php
                                                    if (!empty($student['dob']) && $student['dob'] != '0000-00-00') {
                                                        echo date($this->customlib->getSchoolDateFormat(), $this->customlib->dateyyyymmddTodateformat($student['dob']));
                                                    } else {
                                                        echo '-';
                                                    }
                                                    ?></td>
                                                <td><?php
                                                    if (!empty($student['certificate_issue_date']) && $student['certificate_issue_date'] != '0000-00-00') {
                                                        echo date($this->customlib->getSchoolDateFormat(), $this->customlib->dateyyyymmddTodateformat($student['certificate_issue_date']));
                                                    } else {
                                                        echo '-';
                                                    }
                                                    ?></td>
                                                <td><?php echo $this->lang->line(strtolower($student['gender'])) ?: $student['gender']; ?></td>
                                                <td><?php echo htmlspecialchars($student['category']); ?></td>
                                                <td><?php echo htmlspecialchars($student['mobileno']); ?></td>
                                            </tr>
                                            <?php
                                        }
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </section>
</div>
<script type="text/javascript">
    function getSectionByClass(class_id, section_id) {
        $('#section_id').html('<option value=""><?php echo $this->lang->line('select') ?: 'Select'; ?></option>');
        if (class_id === '') return;
        var base_url = '<?php echo base_url(); ?>';
        var div_data = '<option value=""><?php echo $this->lang->line('all') ?: 'All'; ?></option>';
        $.ajax({
            type: "GET",
            url: base_url + "sections/getByClass",
            data: {'class_id': class_id},
            dataType: "json",
            success: function (data) {
                $.each(data, function (i, obj) {
                    var sel = (section_id && section_id == obj.section_id) ? 'selected' : '';
                    div_data += '<option value="' + obj.section_id + '" ' + sel + '>' + obj.section + '</option>';
                });
                $('#section_id').append(div_data);
            }
        });
    }
    $(document).ready(function () {
        var class_id = $('#class_id').val();
        var section_id = '<?php echo isset($section_id) ? $section_id : ""; ?>';
        getSectionByClass(class_id, section_id);
        $(document).on('change', '#class_id', function () {
            var class_id = $(this).val();
            $('#section_id').html('<option value=""><?php echo $this->lang->line('all') ?: 'All'; ?></option>');
            if (class_id === '') return;
            var base_url = '<?php echo base_url(); ?>';
            $.ajax({
                type: "GET",
                url: base_url + "sections/getByClass",
                data: {'class_id': class_id},
                dataType: "json",
                success: function (data) {
                    var div_data = '<option value=""><?php echo $this->lang->line('all') ?: 'All'; ?></option>';
                    $.each(data, function (i, obj) {
                        div_data += '<option value="' + obj.section_id + '">' + obj.section + '</option>';
                    });
                    $('#section_id').append(div_data);
                }
            });
        });
    });
</script>
