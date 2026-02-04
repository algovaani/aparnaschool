<?php $this->load->view('layout/cbseexam_css.php'); ?>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.js"></script>

<style>
    /* Color Palette */
    :root {
        --color-primary: #007bff;     /* Vibrant Blue for main actions/headers */
        --color-accent: #17a2b8;      /* Teal for secondary accents */
        --color-bg-light: #f4f7fa;    /* Very light background */
        --color-text-dark: #343a40;
        --color-text-light: #6c757d;
        --color-border: #ced4da; /* Slightly stronger default border for grid look */

        /* Column Header Colors (Exact match to Screenshot 909.png) */
        --col-head-1: #34495e;  /* Admission No (Dark Gray) */
        --col-head-2: #4A90E2;  /* Student Name (Bright Blue) */
        --col-head-3: #50E3C2;  /* Class (Light Teal) */
        --col-head-4: #B8E986;  /* Father Name (Light Green) */
        --col-head-5: #FFC400;  /* Gender (Yellow) */
        --col-head-6: #1abc9c;  /* WORK EDUCATION (Teal/Cyan) */
        --col-head-7: #e67e22;  /* ART & CRAFT (Orange) */
        --col-head-8: #f1c40f;  /* HEALTH AND PHYSICAL EDUCATION (Gold Yellow) */
        --col-head-9: #e74c3c;  /* SCIENTIFIC SKILLS (Red) */
        --col-head-10: #3498db; /* THINKING SKILLS (Blue) */
        --col-head-11: #2ecc71; /* SOCIAL SKILLS (Emerald Green) */
        --col-head-12: #9b59b6; /* YOGA (Purple) */
        --col-head-13: #f39c12; /* SPORTS (Darker Orange) */

        /* Row Background Colors */
        --row-odd-bg: #ffffff;
        --row-even-bg: #f0f0f5; 
    }

    /* General body and wrapper styling for a cleaner look */
    .content-wrapper {
        background-color: var(--color-bg-light); 
        padding-top: 20px;
    }
    .box {
        background-color: #ffffff;
        box-shadow: 0 4px 12px rgba(0,0,0,.08); 
        border-radius: 10px; 
        border-top: 5px solid var(--color-primary); 
    }
    .box-header.ptbnull {
        border-bottom: 1px solid var(--color-border);
        padding: 15px 20px;
        background-color: #ffffff;
    }
    .box-title.titlefix {
        font-weight: 700;
        font-size: 1.5rem;
        color: var(--color-primary); 
    }
    /* Buttons */
    .btn-primary {
        background-color: var(--color-primary);
        border-color: var(--color-primary);
        transition: all 0.3s;
        border-radius: 5px;
    }
    .btn-primary:hover {
        background-color: #0056b3;
        border-color: #004085;
        box-shadow: 0 2px 4px rgba(0, 123, 255, 0.4);
    }
    .btn-sm i {
        margin-right: 5px; 
    }
    
    /* Table Styling */
    /* REMOVING GENERIC BORDERS TO APPLY CUSTOM ONES BELOW */
    .table-bordered th, .table-bordered td {
        border: 1px solid var(--color-border);
        padding: 12px; 
    }
    
    /* Default Table Header (observation_list on main page) */
    .observation_list thead th {
        background-color: var(--color-accent); 
        color: white; 
        font-weight: 600;
        border-bottom: 2px solid #138496;
    }

    /* --- COLORFUL COLUMN HEADERS FOR ASSIGN MARKS MODAL (TH) --- */
    #assignModal .modal-body table thead th {
        color: white;
        text-align: center;
        vertical-align: middle;
        padding: 10px 5px; 
        font-size: 0.9em;
        background-color: #555; 
        /* Ensure TH has its own defined border */
        border: 1px solid var(--color-border);
    }

    /* Apply colors to all 13 columns (Matching Screenshot) */
    #assignModal .modal-body table thead th:nth-child(1) { background-color: var(--col-head-1); } 
    #assignModal .modal-body table thead th:nth-child(2) { background-color: var(--col-head-2); } 
    #assignModal .modal-body table thead th:nth-child(3) { background-color: var(--col-head-3); } 
    #assignModal .modal-body table thead th:nth-child(4) { background-color: var(--col-head-4); color: var(--color-text-dark); border-color: #B8E986;} 
    #assignModal .modal-body table thead th:nth-child(5) { background-color: var(--col-head-5); color: var(--color-text-dark); border-color: #FFC400;} 
    #assignModal .modal-body table thead th:nth-child(6) { background-color: var(--col-head-6); } 
    #assignModal .modal-body table thead th:nth-child(7) { background-color: var(--col-head-7); } 
    #assignModal .modal-body table thead th:nth-child(8) { background-color: var(--col-head-8); } 
    #assignModal .modal-body table thead th:nth-child(9) { background-color: var(--col-head-9); } 
    #assignModal .modal-body table thead th:nth-child(10) { background-color: var(--col-head-10); } 
    #assignModal .modal-body table thead th:nth-child(11) { background-color: var(--col-head-11); } 
    #assignModal .modal-body table thead th:nth-child(12) { background-color: var(--col-head-12); } 
    #assignModal .modal-body table thead th:nth-child(13) { background-color: var(--col-head-13); } 

    /* --- ALTERNATING ROW COLORS & TABLE GRID (TD) --- */
    #assignModal .modal-body table tbody td {
        /* Standard TD border for grid look */
        border: 1px solid var(--color-border); 
        padding: 0 10px; 
        vertical-align: middle;
        /* Default background reset */
        background-color: var(--row-odd-bg) !important;
        /* Reset shadow from previous attempts to rely on border/shadow below */
        box-shadow: none !important; 
    }

    /* Apply alternating row color directly to TD */
    #assignModal .modal-body table tbody tr:nth-child(even) td {
        background-color: var(--row-even-bg) !important;
    }


    /* --- COLUMN SEPARATORS AND COLOR FOR DATA CELLS (TD) --- */
    /* Applying thin colored right border to TDs for separation */
    
    #assignModal .modal-body table tbody td:nth-child(n) { border-right-width: 1px; border-right-color: var(--color-border); }

    /* Apply thin, colored *right border* to mark columns for clear separation matching header color */
    #assignModal .modal-body table tbody td:nth-child(5) { border-right: 1px solid var(--col-head-5) !important; } /* Last static column */
    #assignModal .modal-body table tbody td:nth-child(6) { border-right: 1px solid var(--col-head-6) !important; }
    #assignModal .modal-body table tbody td:nth-child(7) { border-right: 1px solid var(--col-head-7) !important; }
    #assignModal .modal-body table tbody td:nth-child(8) { border-right: 1px solid var(--col-head-8) !important; }
    #assignModal .modal-body table tbody td:nth-child(9) { border-right: 1px solid var(--col-head-9) !important; }
    #assignModal .modal-body table tbody td:nth-child(10) { border-right: 1px solid var(--col-head-10) !important; }
    #assignModal .modal-body table tbody td:nth-child(11) { border-right: 1px solid var(--col-head-11) !important; }
    #assignModal .modal-body table tbody td:nth-child(12) { border-right: 1px solid var(--col-head-12) !important; }
    /* Last column gets a standard border */
    #assignModal .modal-body table tbody td:nth-child(13) { border-right: 1px solid var(--color-border) !important; }

    /* Ensure input elements fit perfectly within the cell, using standard input border */
    #assignModal .modal-body table tbody td input.form-control {
        border: 1px solid #ced4da !important;
        box-shadow: none !important;
        border-radius: 4px;
        height: 34px; 
        padding: 6px 10px;
        width: 100%;
        margin: 5px 0; /* Add slight margin for better visual spacing inside cells */
    }


    /* Form elements */
    .form-control {
        border-radius: 5px;
        box-shadow: none;
        border: 1px solid #ced4da;
        transition: border-color 0.3s;
    }
    .form-control:focus {
        border-color: var(--color-primary);
        box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
    }
    /* Modals for a cleaner look */
    .modal-content {
        border-radius: 10px;
        box-shadow: 0 5px 20px rgba(0,0,0,.15);
        border: none;
    }
    .modal-header {
        border-bottom: none;
        padding: 18px 25px;
        background-color: var(--color-primary); 
        color: white;
        border-top-left-radius: 8px;
        border-top-right-radius: 8px;
    }
    .modal-header .close {
        color: white;
        opacity: 1;
        text-shadow: none;
        font-size: 1.5rem;
    }
    .modal-title {
        font-size: 1.35rem;
        font-weight: 600;
    }
    .modal-body {
        padding: 25px;
    }
    /* Loader inside modal */
    .modal_loader_div {
        min-height: 100px;
        display: flex;
        justify-content: center;
        align-items: center;
    }
    .modal-footer {
        border-top: 1px solid var(--color-border);
    }

    /* Responsive Table Wrapper */
    .table-responsive.mailbox-messages {
        overflow-x: auto; 
    }

    /* Utility for form elements in modals on mobile */
    @media (max-width: 767px) {
        .col-sm-6, .col-xs-12 {
            padding-bottom: 15px; 
        }
        .box {
             border-radius: 0; 
        }
    }
</style>

<div class="content-wrapper"> 
    <section class="content">
        <div class="row">           
            <div class="col-md-12">             
                <div class="box box-primary">
                    <div class="box-header ptbnull">
                        <h3 class="box-title titlefix"><?php echo $this->lang->line("assign_observation_list"); ?></h3> 
                        
                        <div class="box-tools pull-right">
                            <?php if ($this->rbac->hasPrivilege('cbse_exam_assign_observation', 'can_add')) { ?>
                            <button type="button" class="btn btn-sm btn-primary"  data-record_id="0" data-original-title="<?php echo $this->lang->line('add_observation_term')?>"  data-action="add" data-toggle="modal" data-target="#myModal" autocomplete="off"><i class="fa fa-plus"></i> <?php echo $this->lang->line('add')?></button>
                            <?php } ?>
                        </div>               
                    </div>
                    <div class="box-body">                    
                        <div class="table-responsive mailbox-messages overflow-visible-lg">
                            <?php if ($this->session->flashdata('msgdelete')) { ?>
                                <?php echo $this->session->flashdata('msgdelete') ?>
                            <?php } ?>
                                 <table class="table table-striped table-bordered table-hover observation_list" data-export-title="<?php echo $this->lang->line('assign_observation_list') ?>">
                                <thead>
                                    <tr>
                                        <th><?php echo $this->lang->line('observation'); ?></th>
                                        <th><?php echo $this->lang->line('term'); ?></th>
                                        <th><?php echo $this->lang->line('code'); ?></th>
                                        <th><?php echo $this->lang->line('description'); ?></th>
                                        <th class="text-right noExport"><?php echo $this->lang->line('action'); ?></th>                                     
                                    </tr>
                                </thead>
                                <tbody>
                             
                                </tbody>
                            </table>                         
                        </div>
                    </div>
                </div>
            </div>
        </div> 
    </section>
</div>

<div id="myModal" class="modal fade " role="dialog">
    <div class="modal-dialog modal-dialog2 modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" >&times;</button>
                <h4 class="modal-title" id="modal-title"><?php echo $this->lang->line('add'); ?></h4>
            </div>
           <div class="modal-body minheight149"> 

                <div class="modal_loader_div" style="display: none;"></div>

                <div class="modal-body-inner">
                    
                </div>

            </div>
        </div>
    </div>
</div>

<div id="assignModal" class="modal fade " role="dialog">
    <div class="modal-dialog modal-dialog2 modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" >&times;</button>
                <h4 class="modal-title" id="modal-title"><?php echo $this->lang->line('assign_marks'); ?></h4>
            </div>
             <div class="modal-body">
                <form role="form" id="allotStudentMarks" action="<?php echo site_url('cbseexam/observation/termstudent') ?>" method="post" >
                    <input type="hidden" name="cbse_observation_term_id" value="0" id="cbse_observation_term_id">
                    <input type="hidden" name="cbse_term_id" value="0" id="cbse_term_id">
                    <div class="row">
                        <div class="col-sm-6 col-xs-12">
                                <div class="form-group">
                            <label><?php echo $this->lang->line('class'); ?></label><small class="req"> *</small>
                            <select autofocus="" id="class_id" name="class_id" class="form-control" >
                                <option value=""><?php echo $this->lang->line('select'); ?></option>
                                <?php
foreach ($classlist as $class) {
    ?>
                                    <option value="<?php echo $class['id'] ?>" <?php
if (set_value('class_id') == $class['id']) {
        echo "selected=selected";
    }
    ?>><?php echo $class['class'] ?></option>
                                            <?php
}
?>
                            </select>
                            <span class="text-danger"><?php echo form_error('class_id'); ?></span>
                        </div>
                        </div>
                        <div class="col-sm-6 col-xs-12">
                            <div class="form-group">
                                <label for="exampleInputEmail1"><?php echo $this->lang->line('section'); ?></label>
                                <select  id="section_id" name="section_id" class="form-control" >
                                    <option value=""><?php echo $this->lang->line('select'); ?></option>
                                </select>
                                <span class="text-danger"><?php echo form_error('section_id'); ?></span>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer clearboth mx-nt-lr-15 pb0">
                        
                        <button type="submit" name="search" value="search_filter" class="btn btn-primary pull-right btn-sm checkbox-toggle"><i class="fa fa-search"></i> <?php echo $this->lang->line('search'); ?></button>
                        
                    </div>
                </form>

                <div class="studentAllotForm">

                </div>
            </div>
        </div>
    </div>
</div> 

<script type="text/javascript">

    $(document).ready(function () {

    $.validator.addMethod("uniqueUserName", function (value, element, options)
    {
       var max_mark = element.getAttribute('data-marks');   
        //we need the validation error to appear on the correct element
        return parseFloat(value) <= parseFloat(max_mark);
    },
            "<?php echo $this->lang->line('invalid_marks') ?>"
            );

        $(document).on('submit', 'form#allot_exam_student', function (event) {
            event.preventDefault();

                $('form#allot_exam_student').validate({
                    debug: true,
                    errorClass: 'error text text-danger',
                    validClass: 'success',
                    errorElement: 'span',
                    highlight: function(element, errorClass, validClass) {
                       $(element).parent().addClass(errorClass);
                    },
                    unhighlight: function(element, errorClass, validClass) {
                      $(element).parent().removeClass(errorClass);
                    }
                });

            $('.marksssss').each(function () {
                $(this).rules("add",
                        {
                            required: true,
                              uniqueUserName: true,
                            messages: {
                                required: "<?php echo $this->lang->line('required') ?>",
                            }
                        });
            });

// test if form is valid
            if ($('form#allot_exam_student').validate().form()) {
    //     e.preventDefault(); // avoid to execute the actual submit of the form.
        var form = $(this);
        var $this = form.find("button[type=submit]:focus");
        var url = form.attr('action');    

     $.ajax({
            url: url,
            type: "POST",
            data: new FormData(this),
            dataType: 'json',
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: function () {
                $this.button('loading');
            },
            success: function (res)
            {
                if (res.status == 1) {
                    successMsg(res.message);
                    $('#assignModal').modal('hide');

                } else {
                    var message = "";
            $.each(res.error, function (index, value) {

                message += value;

            });
         errorMsg(message);           

                }

                $this.button('reset');
            },
            error: function (xhr) { // if error occured
                alert("Error occured.please try again");
                $this.button('reset');
            },
            complete: function () {
                $this.button('reset');
            }

        });     

                  } else {
                console.log("does not validate");
            }    
        })        

    });

    $("#assignModal").on("show.bs.modal", function(e) {
    var link = $(e.relatedTarget);  
    let record_id=link.data('record_id');
    let cbse_term_id=link.data('cbse_term_id');
    $('#cbse_observation_term_id').val(record_id);
    $('#cbse_term_id').val(cbse_term_id);

});

    $("#assignModal").on("hidden.bs.modal", function(e) {
    $('.studentAllotForm').html(""); 
    reset_form('#allotStudentMarks'); 
    $('#section_id').find('option').not(':first').remove();
    
});

  $("form#allotStudentMarks").on('submit', (function (e) {
        e.preventDefault(); // avoid to execute the actual submit of the form.
        var form = $(this);
        var $this = form.find("button[type=submit]:focus");
        var url = form.attr('action');
        $.ajax({
            url: url,
            type: "POST",
            data: new FormData(this),
            dataType: 'json',
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: function () {
                $this.button('loading');
                    $('.studentAllotForm').html("");  
            },
            success: function (res)
            {                

            if (res.status == 1) {
            $('.studentAllotForm').html(res.page); 

            } else {
             var message = "";
            $.each(res.error, function (index, value) {

            message += value;

            });
             errorMsg(message);          

            }

            },
            error: function (xhr) { // if error occured
                alert("Error occured.please try again");
                $this.button('reset');
            },
            complete: function () {
                $this.button('reset');
            }
        });
    }
    ));

    $(document).on('change', '#class_id', function (e) {
        $('#section_id').html("");
        var class_id = $(this).val();
        var selector = $(this).closest("div.assignModal").find('#section_id');
        getSectionByClass(class_id, section_id, selector);
    });

        function getSectionByClass(class_id, section_id) {
            if (class_id != 0 && class_id !== "") {
                $('#section_id').html("");
                var div_data = '<option value=""><?php echo $this->lang->line('select'); ?></option>';
                $.ajax({
                    type: "GET",
                   url: base_url + "sections/getByClass",
                    data: {'class_id': class_id},
                    dataType: "json",
                    beforeSend: function () {
                        $('#section_id').addClass('dropdownloading');
                    },
                    success: function (data) {
                        $.each(data, function (i, obj)
                        {
                            var sel = "";
                            if (section_id == obj.section_id) {
                                sel = "selected";
                            }
                            div_data += "<option value=" + obj.section_id + " " + sel + ">" + obj.section + "</option>";
                        });
                        $('#section_id').append(div_data);
                    },
                    complete: function () {
                        $('#section_id').removeClass('dropdownloading');
                    }
                });
            }
        }


    $("#myModal").on("show.bs.modal", function(e) {
    var link = $(e.relatedTarget);
    let action=link.data('action');
    let _title=link.data('originalTitle');
    let record_id=link.data('record_id');
    console.log(link.data());

    $('#myModal .modal-title').html(_title);
     $.ajax({
                    url: baseurl+'cbseexam/observation/observationtermform',
                    type: "POST",
                    data: {"action" : action,'record_id':record_id},
                    dataType: 'json',                   
                    beforeSend: function () {
                        $('#myModal .modal-body .modal-body-inner').html(""); 
                        $('#myModal .modal-body .modal_loader_div').css("display", "block"); 
                   
                    },
                    success: function (data)
                    {
                          row=data.total_rows;
                          $('#myModal .modal-body .modal-body-inner').html(data.page); 
                          $('#myModal .modal-body .modal_loader_div').fadeOut(400);
                    },
                    error: function (xhr) { // if error occured
                    alert("<?php echo $this->lang->line('error_occurred_please_try_again'); ?>");
                 
                    },
                    complete: function () {
            
                    }
            });
});

$(document).on('submit','#add_form',function(e){
    console.log("sdfsdf");
      e.preventDefault();
        var $this = $(this).find("button[type=submit]:focus");      

        $.ajax({
            url: base_url+"cbseexam/observation/assignObservationTerm",
            type: "POST",
            data: new FormData(this),
            dataType: 'json',
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: function () {
                $this.button('loading');
            },
            success: function (res)
            {
                if (res.status == 0) {
                    var message = "";
                    $.each(res.error, function (index, value) {
                        message += value;
                    });
                    errorMsg(message);
                } else {
                    successMsg(res.message);
                    $('#myModal').modal('hide');
                   table.ajax.reload( null, false );
                }
            },
            error: function (xhr) { // if error occured
                alert("<?php echo $this->lang->line('error_occurred_please_try_again'); ?>");
                $this.button('reset');
            },
            complete: function () {
                $this.button('reset');
            }
        });
});

    ( function ( $ ) {
    'use strict';
    $(document).ready(function () {

        initDatatable('observation_list','cbseexam/observation/getlist',[],[],100);
       
    });
} ( jQuery ) )
</script>

<script type="text/javascript">

    $(document).ready(function () {

        modal_click_disabled('myModal','assignModal');

    }); 
    
    function add()
    {        
        $('#observation_parameter').val('');
        $('#searchclassid').val('');
        $('#sections').html('');
        $('#myModal').modal('show');  
        $('#modal-title').html('<?php echo $this->lang->line('add')?>');            
    }    

    function remove(string){
        var result = confirm("<?php echo $this->lang->line('delete_confirm') ?>");
        if (result) {
            $('#'+string).html('');
        }
    }

    function remove_edit(id){
        var result = confirm("<?php echo $this->lang->line('delete_confirm') ?>");
        if (result) {
            $('#'+id).html('');
            $('#delete_ides').append('<input type="hidden" name="delete_ides[]" value="'+id+'"/>');
        }
    } 

    function edit(cbse_observation_parameter_id,class_id)
    {  
        getSectionByClass(class_id, '', 'sections');
        $('#observation_parameter').val(cbse_observation_parameter_id);
        $('#searchclassid').val(class_id);
        $('#sections').html("");       
        $('#edit_val').val(1);
        $.ajax({
            url: '<?php echo base_url(); ?>cbseexam/observation/get_assignclasssections',
            type: "POST",
            data:{cbse_observation_parameter_id:cbse_observation_parameter_id,class_id:class_id},
            dataType: 'json',
            beforeSend: function() {
                    
            },
            success: function(res) {  
                  $('#modal-title').html('<?php echo $this->lang->line('edit')?>');
                  $('#sections').html(res.view);  
                   $.each(res.acs, function (i, obj)
                {  
                    
            $("div.custom-select-option").find("input[type=checkbox][value="+obj.class_section_id+"]").prop('checked',true);

                });
                     $('#myModal').modal('show');
            },
            error: function (xhr) { // if error occured
                alert("<?php echo $this->lang->line('error_occurred_please_try_again'); ?>");                   
            },
            complete: function() {
                  
            }
        });
    }

(function ($){
    "use strict"; 
    
    $(document).ready(function () {
        $("#btnreset").click(function () {
            $("#form1")[0].reset();
        });
    });

    $("#form1").on('submit', (function (e) {
        e.preventDefault();
        var $this = $(this).find("button[type=submit]:focus");
       
        $.ajax({
            url: base_url+"cbseexam/observation/assignClassSection",
            type: "POST",
            data: new FormData(this),
            dataType: 'json',
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: function () {
                $this.button('loading');

            },
            success: function (res)
            {
                if (res.status == "fail") {
                    var message = "";
                    $.each(res.error, function (index, value) {
                        message += value;
                    });
                    errorMsg(message);
                } else {
                    successMsg(res.message);
                    window.location.reload(true);
                }
            },
            error: function (xhr) { // if error occured
                alert("<?php echo $this->lang->line('error_occurred_please_try_again'); ?>");
                $this.button('reset');
            },
            complete: function () {
                $this.button('reset');
            }
        });
    }));

    $(document).on('click', '.examobservation', function () {
        var $this = $(this);
        var recordid = $this.data('recordid');
        $('input[name=recordid]').val(recordid);
        
        $.ajax({
            type: 'POST',
            url: baseurl + "cbseexam/observation/exam_observationstudent",
            data: {'observation_id': recordid},
            dataType: 'JSON',
            beforeSend: function () {
                $this.button('loading');
            },
            success: function (data) {
                $('#observationModal .modal-body').html(data.page);
                $('#observationModal').modal('show');
                $this.button('reset');
            },
            error: function (xhr) { // if error occured
                alert("Error occured.please try again");
                $this.button('reset');
            },
            complete: function () {
                $this.button('reset');
            }
        });
    }); 

    $('.deleteobservation').click(function(){
        var observation_parameter_id = $(this).attr('data-observation_parameter_id');
        var class_id = $(this).attr('data-class_id');
        if(confirm('<?php echo $this->lang->line('delete_confirm'); ?>')){
            $.ajax({
                url: '<?php echo base_url(); ?>cbseexam/observation/removeassignclass_sections',
                type: "POST",
                data: {observation_parameter_id:observation_parameter_id,class_id:class_id},
                dataType: 'json',
                success: function (res)
                {
                    successMsg(res.message);
                    window.location.reload(true);
                }
            });
        }
    })    
})(jQuery);
</script>
<script>
    $("#custom-select").on("click",function(){
        $("#custom-select-option-box").toggle();
    });

    $(".custom-select-option").on("click", function(e) {
        var checkboxObj = $(this).children("input");
        if($(e.target).attr("class") != "custom-select-option-checkbox") {
                if($(checkboxObj).prop('checked') == true) {
                    $(checkboxObj).prop('checked',false)
                } else {
                    $(checkboxObj).prop("checked",true);
                }
        }
    });

    $(document).ready(function () {
        $(document).on('click', "#btnSubmit", function (event) {

            //stop submit the form, we will post it manually.
            event.preventDefault();
            var file_data = $('#my-file-selector').prop('files')[0];
            var form_data = new FormData();
            console.log("file_data==",file_data);
            form_data.append('file', file_data);

            $.ajax({
                url: baseurl + "/admin/examgroup/uploadfilecbse1",
                type: 'POST',
                dataType: 'JSON',
                data: form_data,
               contentType: false,
cache: false,
processData:false,
 beforeSend: function () {

                    $('#examfade,#exammodal').css({'display': 'block'});
            },
                success: function (data) {
$('#fileUploadForm')[0].reset();
  if (data.status == "0") {
           var message = "";
          $.each(data.error, function (index, value) {
            message += value;
         });
           errorMsg(message);
       } else {
           var arr = [];
            $.each(data.student_marks, function (index) {
                console.log("data.student_marks[index]=",data.student_marks[index]);
                var s = data.student_marks[index];
                var dataObj = { adm_no: s.adm_no };
                // Loop to set mark values
                for (var i = 1; i <= data.total_subjects; i++) {
                    dataObj['mark' + i] = s['marks' + i];
                }
                arr.push(dataObj);
            });
//===============
                    $.each(arr, function (index, value) {
                         let adm_no_csv = value.adm_no;
                             var row = $('.marksEntryForm').find('table tbody').find('tr.std_adm_' + adm_no_csv);
                                for (var i = 1; i <= data.total_subjects; i++) {
                                    var fieldName = 'mark' + i;
                                    row.find("td input.marks" + i).val(value[fieldName]); // Corrected syntax
                                }

                    });
                     successMsg("<?php echo $this->lang->line('csv_file_uploaded_successfully') ?>");
                     // $(".dropify-clear").trigger('click');
//=================
       }
                },
            error: function (xhr) { // if error occured
                alert("<?php echo $this->lang->line('error_occurred_please_try_again'); ?>");
                    $('#examfade,#exammodal').css({'display': 'none'});
            },
            complete: function () {

                $('#fileUploadForm')[0].reset();
                $('#examfade,#exammodal').css({'display': 'none'});
            }

            });
        });
    });
// $(document).on('click', function(event) {
  if (event.target.id != "custom-select" && !$(event.target).closest('div').hasClass("custom-select-option")  ) {
          $("#custom-select-option-box").hide();
     }
});

$(document).on('change','#select_all',function(){   
        $('input:checkbox').not(this).prop('checked', this.checked);
});
</script>