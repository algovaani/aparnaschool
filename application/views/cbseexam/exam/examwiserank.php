<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.js"></script>

<div class="content-wrapper"> 
    <!-- Main content -->
    <section class="content">
        <div class="row">           
            <div class="col-md-12">             
                <div class="box box-primary">
                    <div class="box-header ptbnull">
                    <h3 class="box-title titlefix"><?php echo $this->lang->line('generate_rank'); ?> : <?php echo ($exam['name']); ?></h3>  
                                
                    </div>
                    <div class="box-body">
                        <div class="download_label"><?php echo $this->lang->line('generate_rank'); ?></div>
                        <?php
$grouped = [];
if (isset($grouped_studentList)) {
foreach ($grouped_studentList as $student) {
    $key = $student->class . '-' . $student->section;
    if (!isset($grouped[$key])) {
        $grouped[$key] = [];
    }
    $grouped[$key][] = $student;
}

?>
     <form method="post" action="<?php echo base_url('cbseexam/exam/examrankgenerate') ?>" id="rankgenerate">
         <input type="hidden" name="exam_id" value="<?php echo set_value('exam_id',$exam_id); ?>"><?php
            foreach ($grouped as $sectionGroup) {
                foreach ($sectionGroup as $sectionData) {
                    $section_name = $sectionData['section_name'];
                    $students11 = $sectionData['students'];

                    echo '<h4><strong>' . $section_name . '</strong></h4>';

                    echo '<table class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Admission No</th>
                                <th>Student Name</th>
                                <th>Class (Section)</th>
                                <th>Father Name</th>
                                <th>DOB</th>
                                <th>Gender</th>
                                <th>Mobile</th>
                                <th class="text-center">Rank</th>
                            </tr>
                        </thead>
                        <tbody>';

                    foreach ($students11 as $student1) {
                        echo '<tr>
                            <td>' . $student1->admission_no . '</td>
                            <td>
                                <a href="' . base_url('student/view/' . $student1->id) . '">'
                                    . $this->customlib->getFullName($student1->firstname, $student1->middlename, $student1->lastname, $sch_setting->middlename, $sch_setting->lastname) .
                                '</a>
                            </td>
                            <td>' . $student1->class . ' (' . $student1->section . ')</td>
                            <td>' . $student1->father_name . '</td>
                            <td>' . (!empty($student1->dob) && $student1->dob != '0000-00-00' ? date($this->customlib->getSchoolDateFormat(), strtotime($student1->dob)) : '') . '</td>
                            <td>' . $this->lang->line(strtolower($student1->gender)) . '</td>
                            <td>' . $student1->mobileno . '</td>
                            <td class="text-center">' . $student1->rank . '</td>
                        </tr>';
                    }

                    echo '</tbody></table><hr>';
                }
            } ?>

            <div class="col-sm-12">
                <div class="form-group">
                    <button type="submit" name="search"  class="btn btn-primary pull-right btn-sm checkbox-toggle" autocomplete="off"><i class="fa fa-search"></i> <?php echo $this->lang->line('generate_rank'); ?></button>
                </div>
         </div>     
       
     </form>
 </div>
 <?php

}else{
 ?>
 <div class="box-body row">
     <div class="col-md-12">                            
<div class="alert alert-danger">
<?php echo $this->lang->line('no_record_found');?>
</div>
     </div>
 </div>
 <?php
}
?>
                    </div>
                </div>
            </div> 
        </div> 
    </section>
</div>


<script type="text/javascript">
 
$(document).on('submit','#rankgenerate',function(e){
   e.preventDefault(); // avoid to execute the actual submit of the form.
    var $this = $(this).find("button[type=submit]:focus");
    var form = $(this);
    var url = form.attr('action');
    var form_data = form.serializeArray();
   
    $.ajax({
           url: url,
           type: "POST",
           dataType:'JSON',
           data: form_data, // serializes the form's elements.
              beforeSend: function () {
                $('[id^=error]').html("");
                $this.button('loading');

               },
              success: function(response) { // your success handler

                if(!response.status){
                    $.each(response.error, function(key, value) {
                    $('#error_' + key).html(value);
                    });
                }else{

                    window.location.reload();

     
                }
              },
             error: function() { // your error handler
                 $this.button('reset');
             },
             complete: function() {
             $this.button('reset');
             }
         });

});
</script>