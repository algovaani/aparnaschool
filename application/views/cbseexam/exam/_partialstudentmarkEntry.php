<style type="text/css">
    .dropify input {
    position: absolute;
    top: 0;
    right: 0;
    bottom: 0;
    left: 0;
    height: 100%;
    width: 100%;
    cursor: pointer;
    z-index: 5;
}
.choose-file {
  position: relative;
}
.choose-file .form-control {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    opacity: 0;
    cursor: pointer;
    z-index: 5;
    margin: 0;
    padding: 0;
}
.choose-file label {
    width: 100%;
    padding: 0;
    z-index: 1;
    position: relative;
    border: 1px solid #000;
    font-size: 0;
    min-height: 34px;
    margin: 0;
    display: block;
    -webkit-transition: border-color .15s linear;
    transition: border-color .15s linear;
    background-size: 30px 30px;
    background-image: -webkit-linear-gradient(135deg,#f9eee2 25%,transparent 25%,transparent 50%,#f9eee2 50%,#f9eee2 75%,transparent 75%,transparent);
    background-image: linear-gradient(-45deg,#f9eee2 25%,transparent 25%,transparent 50%,#f9eee2 50%,#f9eee2 75%,transparent 75%,transparent);
    -webkit-animation: stripes 2s linear infinite;
    animation: stripes 2s linear infinite;
}
@keyframes stripes{
0% {
    background-position: 0 0;
}
100% {
    background-position: 60px 30px;
}
}
.choose-file label:before{
    position: absolute;
    top: 50%;
    left: 50%;
    display: block;
    content: "Drag & Drop a file here or click";
    font-size: 15px;
    color: #000;
    transform: translate(-50%, -50%);
}
</style>

<div class="row marksEntryForm">   
        <div class="col-md-9"> 
            <form method="POST" enctype="multipart/form-data" id="fileUploadForm">

                <div class="input-group mb10">
                    <div class="choose-file">
                        <label>Hello</label>
                        <input class="form-control" id="my-file-selector" data-height="34" class="dropify" type="file">
                    </div>
                    <div class="input-group-btn">
                        <input type="submit" class="btn btn-primary" value="<?php echo $this->lang->line('submit') ?>" id="btnSubmit"/>
                    </div>
                </div>
         
    </form>
</div> 
    <div class="col-md-3"> 
        <button type="button" class="btn btn-primary pull-right" id="export_sample_btn"><i class="fa fa-download"></i> <?php echo $this->lang->line('export_sample'); ?></button>
    </div>
    </div>

<!-- Filter Section -->
<div class="row mb10">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title"><?php echo $this->lang->line('filter_students'); ?></h4>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label><?php echo $this->lang->line('class'); ?></label>
                            <select class="form-control" id="filter_class_id" name="filter_class_id">
                                <option value=""><?php echo $this->lang->line('all_classes'); ?></option>
                                <?php if (isset($classlist) && !empty($classlist)): ?>
                                    <?php foreach ($classlist as $class): ?>
                                        <option value="<?php echo $class['id']; ?>" <?php echo (isset($class_id) && $class_id == $class['id']) ? 'selected' : ''; ?>>
                                            <?php echo $class['class']; ?>
                                        </option>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label><?php echo $this->lang->line('section'); ?></label>
                            <select class="form-control" id="filter_section_id" name="filter_section_id">
                                <option value=""><?php echo $this->lang->line('all_sections'); ?></option>
                                <?php if (isset($sectionlist) && !empty($sectionlist)): ?>
                                    <?php foreach ($sectionlist as $section): ?>
                                        <option value="<?php echo $section['id']; ?>" <?php echo (isset($section_id) && $section_id == $section['id']) ? 'selected' : ''; ?>>
                                            <?php echo $section['section']; ?>
                                        </option>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>&nbsp;</label>
                            <div>
                                <button type="button" class="btn btn-primary" id="apply_filter">
                                    <i class="fa fa-filter"></i> <?php echo $this->lang->line('apply_filter'); ?>
                                </button>
                                <button type="button" class="btn btn-default" id="clear_filter">
                                    <i class="fa fa-refresh"></i> <?php echo $this->lang->line('clear_filter'); ?>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<form method="post" action="<?php echo site_url('cbseexam/exam/entrymarks') ?>" id="assign_form1111">

    <input type="hidden" name="cbse_exam_timetable_id" value="<?php echo $timetable_id; ?>">
    <?php
    if (isset($resultlist) && !empty($resultlist)) {
    ?>
        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr class="white-space-nowrap">
                                <th><?php echo $this->lang->line('admission_no'); ?></th>
                                <th><?php echo $this->lang->line('roll_no'); ?></th>
                                <th><?php echo $this->lang->line('student_name'); ?></th>
                                <th><?php echo $this->lang->line('class'); ?></th>
                                <th><?php echo $this->lang->line('father_name'); ?></th>
                                <th><?php echo $this->lang->line('gender'); ?></th>
                                <?php
                                foreach ($exam_assessment_types as $key => $value) {

                                    if (!is_null($value->cbse_exam_timetable_assessment_type_id)) {
                                        $value = (array)$value;
                                ?>
                                        <th><?php 
                                        if($value['code']){
                                            $code = " (".$value['code'].")";
                                        }else{
                                            $code = '';
                                        }
                                        
                                        
                                        echo $value['name'] . $code; ?></th>
                                <?php
                                    }
                                }
                                ?>
                                <th><?php echo $this->lang->line('note') ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (empty($resultlist)) {
                            ?>
                                <tr>
                                    <td colspan="7" class="text-danger text-center"><?php echo $this->lang->line('no_record_found'); ?></td>
                                </tr>
                                <?php
                            } else {

                                foreach ($resultlist as $student) {

                                ?>
                                    <tr class="std_adm_<?php echo $student['admission_no']; ?>">
                                        <input type="hidden" name="exam_student_id[]" value="<?php echo $student['exam_student_id']; ?>">

                                        <td><?php echo $student['admission_no']; ?></td>
                                        <td><?php

                                            if ($exam['use_exam_roll_no'] != 0) {
                                                echo $student['exam_roll_no'];
                                            } else {
                                                echo ($student['roll_no'] != 0) ? $student['roll_no'] : '-';
                                            }

                                            ?></td>
                                        <td><?php echo $this->customlib->getFullName($student['firstname'], $student['middlename'], $student['lastname'], $sch_setting->middlename, $sch_setting->lastname); ?></td>
                                        <td><?php echo ($student['class_name'] . "(" . $student['section_name'] . ")"); ?></td>
                                        <td><?php echo $student['father_name']; ?></td>
                                        <td><?php echo $this->lang->line(strtolower($student['gender'])); ?> </td>
                                        <?php
                                          $note="";
                                          $i=1;
                                        foreach ($exam_assessment_types as $key => $value) {
                                            $remark_row_id=$value->id;
                                            if(array_key_exists($remark_row_id,$student['marks'])){
                                                $note = ($student['marks'][$remark_row_id]['note']  ) ? $student['marks'][$remark_row_id]['note'] : "";
                                            }
                                          
                                           
                                            if (!is_null($value->cbse_exam_timetable_assessment_type_id)) {
                                              
                                                $value = (array)$value;
                                                ?>
                                                    <td class="white-space-nowrap">
                                                        <div class="form-group mb0">
        
                                                            <?php
                                                            $absent_status = 0;
                                                            if (!empty($student['marks'][$value['id']])) {
                                                                $absent_status = ($student['marks'][$value['id']]['is_absent']) ? 1 : 0;
                                                            }
                                                            ?>
        
                                                            <label class="d-flex align-items-center gap-0-5">
                                                                <input type="checkbox" name="absent[<?php echo $student['exam_student_id']; ?>][<?php echo $value['id'] ?>]" value="1" <?php echo ($absent_status) ? "checked='checked'" : ""; ?> class=<?php echo "attendance_chk".$i." check_absent mt-0";?>> <?php echo $this->lang->line('mark_as_absent'); ?>
                                                            </label>
        
                                                        </div>
                                                        <input type="hidden" value="<?php echo $value['cbse_exam_timetable_assessment_type_id'];?>" name="mark[<?php echo $student['exam_student_id']; ?>][<?php echo $value['id'] ?>][cbse_exam_timetable_assessment_type]">

                                                        <input type="number" data-marks="<?php echo $value['maximum_marks']; ?>" class="marks<?php echo $i ?> mark  w-150 form-control" name="mark[<?php echo $student['exam_student_id']; ?>][<?php echo $value['id'] ?>][marks]" value="<?php if (!empty($student['marks'][$value['id']]['marks'])) { echo $student['marks'][$value['id']]['marks'];} ?>" step="any" placeholder="<?php echo $this->lang->line('max_mark'); ?>: <?php echo $value['maximum_marks']; ?>" <?php echo ($absent_status) ? "readonly='readonly'" : ""; ?>>
                                                    </td>
                                                <?php
                                            }
                                        $i++;
                                        }
                                        ?>
                                        <td>

                                            <input type="text" class="form-control note noteinput" name="exam_student_note[<?php echo $student['exam_student_id']; ?>]" value="<?php echo $note;?>">
                                        </td>

                                    </tr>
                            <?php
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                </div>

                <?php if ($this->rbac->hasPrivilege('cbse_exam_marks', 'can_edit')) { ?>
                    <div class="modal-footer clearboth mx-nt-lr-15 pb0">
                        <button type="submit" class="allot-fees btn btn-primary pull-right" id="load" data-loading-text="<i class='fa fa-spinner fa-spin '></i> Please Wait.."><?php echo $this->lang->line('save'); ?>
                        </button>
                    </div>
                <?php } ?>

            </div>
        </div>
    <?php
    } else {
    ?>

        <div class="alert alert-info">
            <?php echo $this->lang->line('no_record_found'); ?>
        </div>
    <?php
    }
    ?>
</form>

<script type="text/javascript">
$(document).ready(function() {
    // Store original data for filtering
    var originalExamId = '<?php echo isset($exam_id) ? $exam_id : ""; ?>';
    var originalSubjectId = '<?php echo isset($subject_id) ? $subject_id : ""; ?>';
    var originalTimetableId = '<?php echo isset($timetable_id) ? $timetable_id : ""; ?>';
    
    // Store current filter state
    var currentFilterState = {
        class_id: '',
        section_id: ''
    };
    
    // Handle class change to load sections
    $('#filter_class_id').on('change', function() {
        var classId = $(this).val();
        var sectionSelect = $('#filter_section_id');
        
        // Clear sections
        sectionSelect.html('<option value=""><?php echo $this->lang->line('all_sections'); ?></option>');
        
        if (classId) {
            $.ajax({
                url: baseurl + 'sections/getByClass',
                type: 'GET',
                data: {class_id: classId},
                dataType: 'json',
                success: function(data) {
                    $.each(data, function(i, obj) {
                        sectionSelect.append('<option value="' + obj.section_id + '">' + obj.section + '</option>');
                    });
                }
            });
        }
    });
    
    // Apply filter
    $('#apply_filter').on('click', function() {
        var classId = $('#filter_class_id').val();
        var sectionId = $('#filter_section_id').val();
        
        // Update current filter state
        currentFilterState.class_id = classId;
        currentFilterState.section_id = sectionId;
        
        // Show loading
        $('.marksEntryForm').html('<div class="text-center"><i class="fa fa-spinner fa-spin"></i> Loading...</div>');
        
        $.ajax({
            url: baseurl + 'cbseexam/exam/subjectstudent',
            type: 'POST',
            data: {
                exam_id: originalExamId,
                subject_id: originalSubjectId,
                timetable_id: originalTimetableId,
                class_id: classId,
                section_id: sectionId
            },
            dataType: 'JSON',
            success: function(data) {
                if (data.status == '1') {
                    $('.marksEntryForm').html(data.page);
                    // Re-initialize event handlers for the new content
                    initializeMarkEntryHandlers();
                } else {
                    alert('Error loading filtered data');
                }
            },
            error: function() {
                alert('Error occurred while filtering');
            }
        });
    });
    
    // Clear filter
    $('#clear_filter').on('click', function() {
        $('#filter_class_id').val('');
        $('#filter_section_id').html('<option value=""><?php echo $this->lang->line('all_sections'); ?></option>');
        
        // Reset stored filter state
        currentFilterState.class_id = '';
        currentFilterState.section_id = '';
        
        // Reload without filters
        $('#apply_filter').trigger('click');
    });
    
    // Initialize mark entry handlers
    function initializeMarkEntryHandlers() {
        // Re-attach export sample button handler
        $(document).off('click', '#export_sample_btn').on('click', '#export_sample_btn', function() {
            // Use stored filter state
            var currentClassId = currentFilterState.class_id;
            var currentSectionId = currentFilterState.section_id;
            
            // Create a form to submit POST data
            var form = $('<form>', {
                'method': 'POST',
                'action': baseurl + 'admin/examgroup/exportformatcbse',
                'target': '_blank'
            });
            
            // Add hidden inputs with exam data
            form.append($('<input>', {
                'type': 'hidden',
                'name': 'exam_id',
                'value': originalExamId
            }));
            
            form.append($('<input>', {
                'type': 'hidden',
                'name': 'subject_id',
                'value': originalSubjectId
            }));
            
            form.append($('<input>', {
                'type': 'hidden',
                'name': 'timetable_id',
                'value': originalTimetableId
            }));
            
            // Add current filter values from stored state
            form.append($('<input>', {
                'type': 'hidden',
                'name': 'class_id',
                'value': currentClassId || ''
            }));
            
            form.append($('<input>', {
                'type': 'hidden',
                'name': 'section_id',
                'value': currentSectionId || ''
            }));
            
            // Submit the form
            $('body').append(form);
            form.submit();
            form.remove();
        });
        
        // Re-attach event handlers for marks entry form
        $(document).off('submit', 'form#assign_form1111').on('submit', 'form#assign_form1111', function(event) {
            event.preventDefault();
            
            $('form#assign_form1111').validate({
                debug: true,
                errorClass: 'error text text-danger',
                validClass: 'success',
                errorElement: 'span',
                highlight: function(element, errorClass, validClass) {
                    $(element).addClass(errorClass);
                },
                unhighlight: function(element, errorClass, validClass) {
                    $(element).removeClass(errorClass);
                }
            });
            
            $('.mark').each(function() {
                $(this).rules("add", {
                    required: true,
                    uniqueUserName: true,
                    messages: {
                        required: "<?php echo $this->lang->line('required'); ?>",
                    }
                });
            });
            
            if ($('form#assign_form1111').validate().form()) {
                var form = $(this);
                var subsubmit_button = $(this).find(':submit');
                var $this = $(this).find("button[type=submit]:focus");
                
                $.ajax({
                    url: form.attr('action'),
                    type: "POST",
                    data: new FormData(this),
                    dataType: 'json',
                    contentType: false,
                    cache: false,
                    processData: false,
                    beforeSend: function() {
                        subsubmit_button.button('loading');
                    },
                    success: function(res) {
                        if (res.status == "fail") {
                            var message = "";
                            $.each(res.error, function(index, value) {
                                message += value;
                            });
                            errorMsg(message);
                        } else {
                            successMsg(res.message);
                            $('#subjectModal').modal('hide');
                        }
                    },
                    error: function(xhr) {
                        alert("<?php echo $this->lang->line('error_occurred_please_try_again'); ?>");
                        subsubmit_button.button('reset');
                    },
                    complete: function() {
                        subsubmit_button.button('reset');
                    }
                });
            }
        });
        
        // Re-attach absent checkbox handlers
        $(document).off('change', '.check_absent').on('change', '.check_absent', function() {
            if (this.checked) {
                $(this).closest('td').find("input.mark").val(0).attr('readonly', true);
            } else {
                $(this).closest('td').find("input.mark").val(0).attr('readonly', false);
            }
        });
    }
    
    
    // Initialize handlers on page load
    initializeMarkEntryHandlers();
});
</script>