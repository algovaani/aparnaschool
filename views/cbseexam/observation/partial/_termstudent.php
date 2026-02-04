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
<div class="col-md-6"> 
            <form method="POST" enctype="multipart/form-data" id="fileUploadForm">

                <div class="input-group mb10">
                    <input id="my-file-selector" data-height="34" class="dropify" type="file">
                    <div class="input-group-btn">
                        <input type="submit" class="btn btn-primary" value="<?php echo $this->lang->line('submit') ?>" id="btnSubmit"/>
                    </div>
                </div>
                </form>
        </div>  
<div class="row">   
        
    

    <div class="col-md-3"> 
        <a class="btn btn-primary pull-right" href="<?php echo site_url('admin/examgroup/exportformatcbse1') ?>" target="_blank"><i class="fa fa-download"></i> <?php echo $this->lang->line('export_sample'); ?></a>
    </div>
    </div>

<form method="post" action="<?php echo site_url('cbseexam/observation/add_observation_term_marks') ?>" id="allot_exam_student">
    <input type="hidden" name="cbse_observation_term_id" value="<?php echo $cbse_observation_term_id; ?>">
    <?php
if (isset($observationParamsList) && (!empty($observationParamsList) && !empty($studentlist))) {
    ?>
     
        <div class="row marksEntryForm">
            <div class="col-md-12">
                <div class=" table-responsive ptt10">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th><?php echo $this->lang->line('admission_no'); ?></th>
                                <th><?php echo $this->lang->line('student_name'); ?></th>
                                <th><?php echo $this->lang->line('class'); ?></th>
                                <th><?php echo $this->lang->line('father_name'); ?></th>
                                <th><?php echo $this->lang->line('gender'); ?></th>
                                <?php

    foreach ($observationParamsList as $param_key => $param_value) {

        ?>
        <input type="hidden" name="cbse_observation_parameters[]" value="<?php echo  $param_value->cbse_observation_subparameter_id;?>">
 <th><?php echo $param_value->cbse_observation_parameter_name . " (" . $this->lang->line('max_marks') . $param_value->maximum_marks . ")" ?></th>
                                    <?php
}
    ?>


                            </tr>
                        </thead>
                        <tbody>
                        <?php

    if (!empty($studentlist)) {
$row=1;
        foreach ($studentlist as $student_key => $student_value) {          

            ?>
    <tr class="std_adm_<?php echo $student_value->admission_no; ?>">
        <input type="hidden" name="row[]" value="<?php echo $row; ?>">
        <input type="hidden" name="student_session_<?php echo $row;?>" value="<?php echo $student_value->student_session_id; ?>">
  <td>
    <?php echo $student_value->admission_no; ?></td>
  <td><?php echo $this->customlib->getFullName($student_value->firstname, $student_value->middlename, $student_value->lastname, $sch_setting->middlename, $sch_setting->lastname); ?></td>
                                        <td><?php echo $student_value->class." (".$student_value->section.")"; ?></td>
                                        <td><?php echo $student_value->father_name; ?></td>

                                        <td><?php echo $this->lang->line(strtolower($student_value->gender)); ?></td>
                                                       <?php
$i=1; 
    foreach ($observationParamsList as $param_key => $param_value) {
            ?>
 <td>
    <input type="hidden" name="old_cbse_observation_term_student_subparameter_id_<?php echo $student_value->student_session_id."_".$param_value->cbse_observation_subparameter_id ?>" value="<?php echo $student_value->params[$param_value->cbse_observation_parameter_id]['cbse_observation_term_student_subparameter_id']; ?>">
    
 <input type="number" data-marks="<?php echo $param_value->maximum_marks;?>" class="form-control marksssss marks<?php echo $i;?>" name="param_value_<?php echo $student_value->student_session_id."_".$param_value->cbse_observation_subparameter_id ?>" value="<?php echo $student_value->params[$param_value->cbse_observation_parameter_id]['obtain_marks']; ?>">
 </td>
                                    <?php
                                    $i++;
}
    ?>

</tr>
    <?php
    $row++;
}
    }
    ?>
                        </tbody>
                    </table>
                </div>
              
                    <button type="submit" class="btn btn-primary btn-sm pull-right" id="load" data-loading-text="<i class='fa fa-spinner fa-spin '></i> Please Wait.."><?php echo $this->lang->line('save'); ?>
                    </button>            
            </div>
        </div>
        <?php
} else {
    ?>
        <div class="alert alert-danger mt10 mb0"><?php echo $this->lang->line('no_student_assigned_in_examination_on_this_term'); ?> </div>
        <?php
}
?>
</form>