<?php
$pass_student = array();
$fail_student = array();
$students = array();

if (!empty($studentList)) {
    foreach ($studentList as $student_value) {
        $std = new stdClass;
        $result_status = 1;
        $no_subject_result = 0;
        $std->exam_group_class_batch_exam_student_id = $student_value->exam_group_class_batch_exam_student_id;
        $std->rank = $student_value->rank;
        $std->student_id = $student_value->student_id;
        $std->admission_no = $student_value->admission_no;
        $std->class = $student_value->class;
        $std->section = $student_value->student_section;
        $std->exam_roll_no = ($exam_details->use_exam_roll_no == 0) ? $student_value->roll_no : (($student_value->exam_roll_no != 0) ? $student_value->exam_roll_no : "-");
        $std->student_name = $this->customlib->getFullName($student_value->firstname, $student_value->middlename, $student_value->lastname, $sch_setting->middlename, $sch_setting->lastname);

        if (!empty($subjectList)) {
            $total_marks = 0;
            $get_marks = 0;
            $total_percentage = 0;
            $total_credit_hour = 0;
            $total_quality_point = 0;
            $student_exam_status = 1;

            foreach ($subjectList as $subject_value) {
                $subject_status = 1;
                $total_marks += $subject_value->max_marks;
                $result = getSubjectMarks($student_value->subject_results, $subject_value->subject_id);
                if ($result) {
                    $no_subject_result = 1;
                    if ($exam_details->exam_group_type == "gpa") {
                        $get_marks += $result->get_marks;
                        $subject_credit_hour = $subject_value->credit_hours;
                        $total_credit_hour += $subject_credit_hour;
                        $percentage_grade = ($result->get_marks * 100) / $result->max_marks;
                        $point = findGradePoints($exam_grades, $percentage_grade);
                        $total_quality_point += ($point * $subject_credit_hour);
                    } else {
                        $get_marks += $result->get_marks;
                        if ($result->get_marks < $subject_value->min_marks) {
                            $student_exam_status = 0;
                        }
                    }
                }
            }

            $std->total_marks = $total_marks;
            $std->get_marks = $get_marks;
            $std->total_credit_hour = $total_credit_hour;
            $std->total_quality_point = $total_quality_point;
            $std->total_percentage = ($get_marks * 100) / $total_marks;
            $std->student_exam_status = $student_exam_status;

            if ($exam_details->exam_group_type == "average_passing") {
                $student_exam_status = ($exam_details->passing_percentage > $std->total_percentage) ? 0 : 1;
            }

            if ($student_exam_status) {
                $pass_student[$std->exam_group_class_batch_exam_student_id] = $std;
            } else {
                $fail_student[$std->exam_group_class_batch_exam_student_id] = $std;
            }
        }
    }
}

$pass_key_values = array_column($pass_student, 'total_percentage'); 
array_multisort($pass_key_values, SORT_DESC, $pass_student);

$fail_key_values = array_column($fail_student, 'total_percentage'); 
array_multisort($fail_key_values, SORT_DESC, $fail_student);

$students = array_merge($pass_student, $fail_student);

$grouped_students = [];
foreach ($students as $student) {
    $key = $student->class . '-' . $student->section;
    $grouped_students[$key][] = $student;
}
?>

<?php if (!empty($grouped_students)) { ?>
    <div class="alert alert-info" role="alert">
        <?php
        if ($exam_details->is_rank_generated) {
            echo $this->lang->line('rank_has_already_generated_you_can_update_rank');
        } else {
            echo $this->lang->line('you_can_generate_rank_from_here');
        }
        ?>
    </div>

    <?php if (!$exam_details->is_rank_generated): ?>
        <form method="POST" action="<?php echo site_url('admin/examresult/updaterank'); ?>" class="updaterank">
            <input type="hidden" name="exam_group_class_batch_exam_id" value="<?php echo $exam_details->id; ?>">
            <button type="submit" class="btn btn-primary pull-right mb10" data-loading-text="<i class='fa fa-spinner fa-spin '></i> Please wait">
                <?php echo $this->lang->line('generate_rank'); ?>
            </button>
    <?php else: ?>
        <form>
    <?php endif; ?>

    <?php foreach ($grouped_students as $group_key => $student_list): ?>
        <?php list($class_name, $section_name) = explode('-', $group_key); ?>
        <h4><?php echo "Class: $class_name | Section: $section_name"; ?></h4>
        <table class="table table-striped table-bordered table-hover example" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th><?php echo $this->lang->line('admission_no'); ?></th>
                    <th><?php echo $this->lang->line('roll_number'); ?></th>
                    <th><?php echo $this->lang->line('class'); ?></th>
                    <th><?php echo $this->lang->line('section'); ?></th>
                    <th><?php echo $this->lang->line('student_name'); ?></th>
                    <th><?php echo $this->lang->line('result'); ?></th>
                    <?php if($exam_details->exam_group_type != "gpa"){ ?>
                        <th><?php echo $this->lang->line('percent'); ?> (%)</th>
                    <?php } ?>
                    <th><?php echo $this->lang->line('rank'); ?></th>
                </tr>
            </thead>
            <tbody>
                <?php $rank_increment = 1; foreach ($student_list as $student): ?>
                    <tr>
                        <input type="hidden" name="exam_group_class_batch_exam_student_id[]" value="<?php echo $student->exam_group_class_batch_exam_student_id; ?>">
                        <input type="hidden" name="exam_group_class_batch_exam_student_id_<?php echo $student->exam_group_class_batch_exam_student_id; ?>" value="<?php echo $rank_increment; ?>">
                        <td><?php echo $student->admission_no; ?></td>
                        <td><?php echo $student->exam_roll_no; ?></td>
                        <td><?php echo $student->class; ?></td>
                        <td><?php echo $student->section; ?></td>
                        <td><?php echo $student->student_name; ?></td>
                        <td>
                            <?php
                            if ($exam_details->exam_group_type == "gpa") {
                                if ($student->total_credit_hour > 0) {
                                    $percentage_grade = ($student->get_marks * 100) / $student->total_marks;
                                    $exam_qulity_point = number_format($student->total_quality_point / $student->total_credit_hour, 2, '.', '');
                                    echo $student->total_quality_point . "/" . $student->total_credit_hour . "=" . $exam_qulity_point . " [" . get_ExamGrade($exam_grades, $percentage_grade) . "]";
                                } else {
                                    echo "--";
                                }
                            } else {
                                echo number_format($student->get_marks, 2, '.', '') . "/" . number_format($student->total_marks, 2, '.', '');
                            }
                            ?>
                        </td>
                        <?php if ($exam_details->exam_group_type != "gpa"): ?>
                        <td><?php echo number_format(($student->get_marks * 100) / $student->total_marks, 2, '.', ''); ?></td>
                        <?php endif; ?>
                        <td><?php echo $student->rank; ?></td>
                    </tr>
                    <?php $rank_increment++; endforeach; ?>
            </tbody>
        </table>
    <?php endforeach; ?>
    </form>
<?php } else { ?>
    <div class="alert alert-info"><?php echo $this->lang->line('no_record_found'); ?></div>
<?php } ?>

<?php
function getSubjectMarks($subject_results, $subject_id) {
    if (!empty($subject_results)) {
        foreach ($subject_results as $subject_result_value) {
            if ($subject_id == $subject_result_value->subject_id) {
                return $subject_result_value;
            }
        }
    }
    return false;
}

function get_ExamGrade($exam_grades, $percentage) {
    if (!empty($exam_grades)) {
        foreach ($exam_grades as $exam_grade_value) {
            if ($exam_grade_value->mark_from >= $percentage && $exam_grade_value->mark_upto <= $percentage) {
                return $exam_grade_value->name;
            }
        }
    }
    return "-";
}

function findGradePoints($exam_grades, $percentage) {
    if (!empty($exam_grades)) {
        foreach ($exam_grades as $exam_grade_value) {
            if ($exam_grade_value->mark_from >= $percentage && $exam_grade_value->mark_upto <= $percentage) {
                return $exam_grade_value->point;
            }
        }
    }
    return 0;
}
?>
