<?php
$currency_symbol = $this->customlib->getSchoolCurrencyFormat();
$sch_setting = isset($sch_setting) ? $sch_setting : new stdClass();
if (!isset($sch_setting->middlename)) $sch_setting->middlename = '';
if (!isset($sch_setting->lastname)) $sch_setting->lastname = '';
$resultlist = isset($resultlist) && is_array($resultlist) ? $resultlist : array();
?>
<div class="content-wrapper">
    <section class="content-header">
        <h1><i class="fa fa-money"></i> <?php echo isset($title) && $title ? $title : ($this->lang->line('fees_due_60_days_report') ?: 'Fees Due 60 Days Report'); ?></h1>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title"><i class="fa fa-filter"></i> <?php echo $this->lang->line('select_criteria'); ?></h3>
                    </div>
                    <div class="box-body">
                        <form role="form" action="<?php echo isset($form_action) ? $form_action : site_url('financereports/fees_due_60_days_report'); ?>" method="post">
                            <?php echo $this->customlib->getCSRF(); ?>
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label><?php echo $this->lang->line('class'); ?></label>
                                        <select id="class_id" name="class_id" class="form-control">
                                            <option value=""><?php echo $this->lang->line('all'); ?></option>
                                            <?php
                                            if (!empty($classlist)) {
                                                foreach ($classlist as $cl) {
                                                    $sel = (isset($class_id) && $class_id == $cl['id']) ? 'selected="selected"' : '';
                                                    echo '<option value="' . $cl['id'] . '" ' . $sel . '>' . $cl['class'] . '</option>';
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label><?php echo $this->lang->line('section'); ?></label>
                                        <select id="section_id" name="section_id" class="form-control">
                                            <option value=""><?php echo $this->lang->line('all'); ?></option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>&nbsp;</label><br>
                                        <button type="submit" name="search" value="search" class="btn btn-primary btn-sm"><i class="fa fa-search"></i> <?php echo $this->lang->line('search'); ?></button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="box-header with-border">
                        <h3 class="box-title"><i class="fa fa-list"></i> <?php echo $this->lang->line('fees_due_60_days_report') ?: 'Fees Due 60 Days Report'; ?> <small>(<?php echo $this->lang->line('students_with_fees_not_paid_for_60_days') ?: 'Students who have not paid fees for 60+ days'; ?>)</small></h3>
                        <div class="box-tools pull-right">
                            <span class="badge bg-red"><?php echo count($resultlist); ?> <?php echo $this->lang->line('students') ?: 'Students'; ?></span>
                        </div>
                    </div>
                    <div class="box-body table-responsive">
                        <table class="table table-striped table-bordered table-hover example" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th><?php echo $this->lang->line('admission_no') ?: 'Admission No'; ?></th>
                                    <th><?php echo $this->lang->line('student_name') ?: 'Student Name'; ?></th>
                                    <th><?php echo $this->lang->line('class') ?: 'Class'; ?></th>
                                    <th><?php echo $this->lang->line('father_name') ?: 'Father Name'; ?></th>
                                    <th><?php echo $this->lang->line('guardian_name') ?: 'Guardian Name'; ?></th>
                                    <th><?php echo $this->lang->line('mobile_number') ?: 'Mobile Number'; ?></th>
                                    <th><?php echo $this->lang->line('months_unpaid') ?: 'Months Unpaid'; ?></th>
                                    <th><?php echo $this->lang->line('days_overdue') ?: 'Days Overdue'; ?></th>
                                    <th><?php echo $this->lang->line('total_due') ?: 'Total Due'; ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (empty($resultlist)) {
                                    echo '<tr><td colspan="10" class="text-center">' . $this->lang->line('no_record_found') . '</td></tr>';
                                } else {
                                    $count = 1;
                                    foreach ($resultlist as $row) {
                                        $name = $this->customlib->getFullName($row['firstname'], $row['middlename'], $row['lastname'], $sch_setting->middlename, $sch_setting->lastname);
                                        ?>
                                        <tr>
                                            <td><?php echo $count++; ?></td>
                                            <td><?php echo htmlspecialchars($row['admission_no']); ?></td>
                                            <td><a href="<?php echo base_url('student/view/' . $row['id']); ?>"><?php echo $name; ?></a></td>
                                            <td><?php echo $row['class'] . (isset($row['section']) && $row['section'] !== '' ? ' (' . $row['section'] . ')' : ''); ?></td>
                                            <td><?php echo htmlspecialchars($row['father_name']); ?></td>
                                            <td><?php echo htmlspecialchars($row['guardian_name']); ?></td>
                                            <td><?php echo htmlspecialchars($row['mobileno']); ?></td>
                                            <td><strong><?php echo (int)$row['months_unpaid']; ?></strong> <?php echo $this->lang->line('months') ?: 'months'; ?></td>
                                            <td><strong><?php echo (int)$row['days_overdue']; ?></strong> <?php echo $this->lang->line('days') ?: 'days'; ?></td>
                                            <td><strong><?php echo $currency_symbol . number_format($row['total_due'], 2); ?></strong></td>
                                        </tr>
                                        <?php
                                    }
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<script type="text/javascript">
    $(document).ready(function () {
        var class_id = $('#class_id').val();
        var section_id = '<?php echo isset($section_id) ? $section_id : ""; ?>';
        if (class_id) {
            var base_url = '<?php echo base_url(); ?>';
            $.ajax({
                type: "GET",
                url: base_url + "sections/getByClass",
                data: {'class_id': class_id},
                dataType: "json",
                success: function (data) {
                    var div_data = '<option value=""><?php echo $this->lang->line('all'); ?></option>';
                    $.each(data, function (i, obj) {
                        var sel = (section_id && section_id == obj.section_id) ? 'selected' : '';
                        div_data += '<option value="' + obj.section_id + '" ' + sel + '>' + obj.section + '</option>';
                    });
                    $('#section_id').html(div_data);
                }
            });
        }
        $(document).on('change', '#class_id', function () {
            var class_id = $(this).val();
            $('#section_id').html('<option value=""><?php echo $this->lang->line('all'); ?></option>');
            if (!class_id) return;
            var base_url = '<?php echo base_url(); ?>';
            $.ajax({
                type: "GET",
                url: base_url + "sections/getByClass",
                data: {'class_id': class_id},
                dataType: "json",
                success: function (data) {
                    var div_data = '<option value=""><?php echo $this->lang->line('all'); ?></option>';
                    $.each(data, function (i, obj) {
                        div_data += '<option value="' + obj.section_id + '">' + obj.section + '</option>';
                    });
                    $('#section_id').append(div_data);
                }
            });
        });
    });
</script>
