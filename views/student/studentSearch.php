<?php
$currency_symbol = $this->customlib->getSchoolCurrencyFormat();
?>
<!DOCTYPE html>
<html>
<head>
    <title><?php echo $this->lang->line('student_list'); ?></title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        /* Modern & Colourful Design */
        body {
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
            background-color: #ecf0f5;
            color: #333;
        }
        .content-wrapper {
            padding: 20px;
        }
        .box {
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
            overflow: hidden;
        }
        .box-header {
            /* === REVISED COLOR HERE === */
            background-color: #3498db; 
            color: #fff;
            padding: 15px 20px;
            border-bottom: 1px solid #e7e7e7;
            border-radius: 8px 8px 0 0;
            display: flex;
            align-items: center;
        }
        .box-header .box-title {
            margin: 0;
            font-size: 1.2em;
            font-weight: 600;
        }
        .box-header .box-title i {
            margin-right: 10px;
        }
        .box-body {
            padding: 20px;
        }
        .btn-primary {
            background-color: #27ae60;
            border-color: #27ae60;
            color: #fff;
            transition: background-color 0.3s ease;
        }
        .btn-primary:hover,
        .btn-primary:focus {
            background-color: #2ecc71;
            border-color: #2ecc71;
        }
        .form-group label {
            font-weight: 500;
        }
        .form-control {
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        /* Tabs Styling */
        .nav-tabs-custom {
            border: none;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }
        .nav-tabs {
            border-bottom: 2px solid #ddd;
            padding: 0 20px;
            display: flex;
            justify-content: space-between;
        }
        .nav-tabs > li {
            margin-bottom: -2px;
            flex-grow: 1;
        }
        .nav-tabs > li > a {
            border: none;
            border-radius: 0;
            color: #777;
            background-color: transparent;
            border-bottom: 2px solid transparent;
            font-weight: 600;
            text-align: center;
            padding: 15px;
            transition: all 0.3s ease;
        }
        .nav-tabs > li.active > a,
        .nav-tabs > li.active > a:hover,
        .nav-tabs > li.active > a:focus {
            color: #2c3e50;
            background-color: #f7f7f7;
            border-bottom: 2px solid #27ae60;
        }
        .tab-content {
            padding: 20px;
            background: #f7f7f7;
            border-radius: 0 0 8px 8px;
        }

        /* Student List & Detail View */
        .student-list {
            width: 100%;
            border-collapse: collapse;
        }
        .student-list th, .student-list td {
            padding: 12px;
            border: 1px solid #ddd;
            text-align: left;
        }
        .student-list th {
            background-color: #f2f2f2;
            font-weight: 600;
        }
        .student-list tbody tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        .student-list tbody tr:hover {
            background-color: #e8f4f8;
        }
        .carousel-row {
            margin-bottom: 20px;
        }
        .slide-row {
            background: #fff;
            border-radius: 8px;
            padding: 20px;
            display: flex;
            align-items: center;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        .slide-row .img-thumbnail {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            margin-right: 20px;
            object-fit: cover;
        }
        .slide-content h4 a {
            color: #2c3e50;
            font-weight: 600;
            text-decoration: none;
        }
        .slide-content h4 a:hover {
            text-decoration: underline;
        }
        .slide-footer .buttons a {
            margin-left: 5px;
            background-color: #34495e;
            border-color: #34495e;
            color: #fff;
            border-radius: 4px;
            transition: all 0.3s ease;
        }
        .slide-footer .buttons a:hover {
            background-color: #4e6377;
        }
        .req {
            color: #e74c3c;
        }
    </style>
</head>
<body>
<div class="content-wrapper">
    <section class="content-header"> </section>
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title"><i class="fa fa-search"></i> <?php echo $this->lang->line('select_criteria'); ?></h3>
                    </div>
                    <div class="box-body">
                        <?php if ($this->session->flashdata('msg')) {?> <div class="alert alert-success">  <?php echo $this->session->flashdata('msg'); $this->session->unset_userdata('msg'); ?> </div> <?php }?>
                        <div class="row">
                            <form role="form" action="<?php echo site_url('student/searchvalidation') ?>" method="post" class="class_search_form">
                                <div class="col-md-6">
                                    <div class="row">
                                        <?php echo $this->customlib->getCSRF(); ?>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label><?php echo $this->lang->line('class'); ?></label> <small class="req"> *</small>
                                                <select autofocus="" id="class_id" name="class_id" class="form-control" >
                                                    <option value=""><?php echo $this->lang->line('select'); ?></option>
                                                    <?php $count = 0; foreach ($classlist as $class) { ?>
                                                        <option value="<?php echo $class['id'] ?>" <?php if (set_value('class_id') == $class['id']) { echo "selected=selected"; } ?>><?php echo $class['class'] ?></option>
                                                    <?php $count++; } ?>
                                                </select>
                                                <span class="text-danger" id="error_class_id"></span>
                                            </div>
                                        </div> 
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label><?php echo $this->lang->line('section'); ?></label>
                                                <select id="section_id" name="section_id" class="form-control" >
                                                    <option value=""><?php echo $this->lang->line('select'); ?></option>
                                                </select>
                                                <span class="text-danger"><?php echo form_error('section_id'); ?></span>
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <button type="submit" name="search" value="search_filter" class="btn btn-primary btn-sm pull-right checkbox-toggle"><i class="fa fa-search"></i> <?php echo $this->lang->line('search'); ?></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label><?php echo $this->lang->line('search_by_keyword'); ?></label>
                                                <input type="text" name="search_text" id="search_text" class="form-control" value="<?php echo set_value('search_text'); ?>"  placeholder="<?php echo $this->lang->line('search_by_student_name'); ?>">
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <button type="submit" name="search" value="search_full" class="btn btn-primary pull-right btn-sm checkbox-toggle"><i class="fa fa-search"></i> <?php echo $this->lang->line('search'); ?></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            
                <div class="nav-tabs-custom border0 navnoshadow">
                    <div class="box-header ptbnull"></div>
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#tab_1" data-toggle="tab" aria-expanded="true"><i class="fa fa-list"></i> <?php echo $this->lang->line('list_view'); ?></a></li>
                        <li class=""><a href="#tab_2" data-toggle="tab" aria-expanded="false"><i class="fa fa-newspaper-o"></i> <?php echo $this->lang->line('details_view'); ?></a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active table-responsive no-padding overflow-scroll-lg" id="tab_1">
                            <table class="table table-striped table-bordered table-hover student-list" data-export-title="<?php echo $this->lang->line('student_list'); ?>">
                                <thead>
                                    <tr>
                                        <th><?php echo $this->lang->line('admission_no'); ?></th>
                                        <th><?php echo $this->lang->line('student_name'); ?></th>
                                        <th><?php echo $this->lang->line('roll_no'); ?></th>
                                        <th><?php echo $this->lang->line('class'); ?></th>
                                         <?php if ($sch_setting->father_name) {?>
                                        <th><?php echo $this->lang->line('father_name'); ?></th>
                                         <?php }?>
                                        <th><?php echo $this->lang->line('date_of_birth'); ?></th>
                                        <th><?php echo $this->lang->line('gender'); ?></th>
                                         <?php if ($sch_setting->category) {  ?>
                                         <?php if ($sch_setting->category) {?>
                                        <th><?php echo $this->lang->line('category'); ?></th>
                                         <?php }
                                         }if ($sch_setting->mobile_no) {  ?>
                                        <th><?php echo $this->lang->line('mobile_number'); ?></th>
                                         <?php }
                                         if (!empty($fields)) {
                                            foreach ($fields as $fields_key => $fields_value) {  ?>
                                                <th><?php echo $fields_value->name; ?></th>
                                         <?php }
                                         } ?>
                                        <th class="text-right noExport white-space-nowrap"><?php echo $this->lang->line('action'); ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                        <div class="tab-pane detail_view_tab" id="tab_2">
                             <?php if (empty($resultlist)) { ?>
                                <div class="alert alert-info"><?php echo $this->lang->line('no_record_found'); ?></div>
                            <?php } else {
                                $count = 1;
                                foreach ($resultlist as $student) {
                                    if (empty($student["image"])) {
                                        if ($student['gender'] == 'Female') {
                                            $image = "uploads/student_images/default_female.jpg";
                                        } else {
                                            $image = "uploads/student_images/default_male.jpg";
                                        }
                                    } else {
                                        $image = $student['image'];
                                    }
                            ?>
                                    <div class="carousel-row">
                                        <div class="slide-row">
                                            <div id="carousel-2" class="carousel slide slide-carousel" data-ride="carousel">
                                                <div class="carousel-inner">
                                                    <div class="item active">
                                                        <a href="<?php echo base_url(); ?>student/view/<?php echo $student['id'] ?>">
                                                            <?php if ($sch_setting->student_photo) {?><img class="img-responsive img-thumbnail width150" alt="<?php echo $student["firstname"] . " " . $student["lastname"] ?>" src="<?php echo $this->media_storage->getImageURL($image); ?>" alt="Image"><?php }?>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="slide-content">
                                                <h4><a href="<?php echo base_url(); ?>student/view/<?php echo $student['id'] ?>"> <?php echo $this->customlib->getFullName($student['firstname'], $student['middlename'], $student['lastname'], $sch_setting->middlename, $sch_setting->lastname); ?></a></h4>
                                                <div class="row">
                                                    <div class="col-xs-6 col-md-6">
                                                        <address>
                                                            <strong><b><?php echo $this->lang->line('class'); ?>: </b><?php echo $student['class'] . "(" . $student['section'] . ")" ?></strong><br>
                                                            <b><?php echo $this->lang->line('admission_no'); ?>: </b><?php echo $student['admission_no'] ?><br/>
                                                            <b><?php echo $this->lang->line('date_of_birth'); ?>: <?php if ($student["dob"] != null && $student["dob"] != '0000-00-00') {echo date($this->customlib->getSchoolDateFormat(), $this->customlib->dateyyyymmddTodateformat($student['dob']));}?><br>
                                                            <b><?php echo $this->lang->line('gender'); ?>:&nbsp;</b><?php echo $this->lang->line(strtolower($student['gender'])) ?><br>
                                                        </address>
                                                    </div>
                                                    <div class="col-xs-6 col-md-6">
                                                        <b><?php echo $this->lang->line('local_identification_no'); ?>:&nbsp;</b><?php echo $student['samagra_id'] ?><br>
                                                        <?php if ($sch_setting->guardian_name) {?>
                                                        <b><?php echo $this->lang->line('guardian_name'); ?>:&nbsp;</b><?php echo $student['guardian_name'] ?><br>
                                                        <?php }if ($sch_setting->guardian_name) {?>
                                                        <b><?php echo $this->lang->line('guardian_phone'); ?>: </b> <abbr title="Phone"><i class="fa fa-phone-square"></i>&nbsp;</abbr> <?php echo $student['guardian_phone'] ?><br> <?php }?>
                                                        <b><?php echo $this->lang->line('current_address'); ?>:&nbsp;</b><?php echo $student['current_address'] ?> <?php echo $student['city'] ?><br>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="slide-footer">
                                                <span class="pull-right buttons">
                                                    <a href="<?php echo base_url(); ?>student/view/<?php echo $student['id'] ?>" class="btn btn-default btn-xs"  data-toggle="tooltip" title="<?php echo $this->lang->line('view'); ?>" >
                                                        <i class="fa fa-reorder"></i>
                                                    </a>
                                                    <?php
                                                    if ($this->rbac->hasPrivilege('student', 'can_edit')) {
                                                    ?>
                                                        <a href="<?php echo base_url(); ?>student/edit/<?php echo $student['id'] ?>" class="btn btn-default btn-xs"  data-toggle="tooltip" title="<?php echo $this->lang->line('edit'); ?>">
                                                            <i class="fa fa-pencil"></i>
                                                        </a>
                                                    <?php
                                                    }
                                                    if ($this->module_lib->hasActive('fees_collection') && $this->rbac->hasPrivilege('collect_fees', 'can_add')) {
                                                    ?>
                                                        <a href="<?php echo base_url(); ?>studentfee/addfee/<?php echo $student['id'] ?>" class="btn btn-default btn-xs" data-toggle="tooltip" title="" data-original-title="<?php echo $this->lang->line('add_fees'); ?>">
                                                        <?php echo $currency_symbol; ?>
                                                        </a>
                                                    <?php }?>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                }
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

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
                    if (section_id == obj.section_id) {
                        sel = "selected";
                    }
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
});

$(document).ready(function() {
    emptyDatatable('student-list','data');
});

$(document).ready(function(){
    $("form.class_search_form button[type=submit]").click(function() {
        $("button[type=submit]", $(this).parents("form")).removeAttr("clicked");
        $(this).attr("clicked", "true");
    });

    $(document).on('submit','.class_search_form',function(e){
        e.preventDefault();
        var $this = $("button[type=submit][clicked=true]");
        var form = $(this);
        var url = form.attr('action');
        var form_data = form.serializeArray();
        form_data.push({name: 'search_type', value: $this.attr('value')});
        $.ajax({
            url: url,
            type: "POST",
            dataType:'JSON',
            data: form_data,
            beforeSend: function () {
                $('[id^=error]').html("");
                $this.button('loading');
                resetFields($this.attr('value'));
            },
            success: function(response) {
                if(!response.status){
                    $.each(response.error, function(key, value) {
                        $('#error_' + key).html(value);
                    });
                } else {
                    if ($.fn.DataTable.isDataTable('.student-list')) {
                        $('.student-list').DataTable().destroy();
                    }
                    table = $('.student-list').DataTable({
                        dom: 'Bfrtip',
                        buttons: [
                            { extend: 'copy', text: '<i class="fa fa-files-o"></i>', titleAttr: 'Copy', className: "btn-copy", title: $('.student-list').data("exportTitle"), exportOptions: { columns: ["thead th:not(.noExport)"] } },
                            { extend: 'excel', text: '<i class="fa fa-file-excel-o"></i>', titleAttr: 'Excel', className: "btn-excel", title: $('.student-list').data("exportTitle"), exportOptions: { columns: ["thead th:not(.noExport)"] } },
                            { extend: 'csv', text: '<i class="fa fa-file-text-o"></i>', titleAttr: 'CSV', className: "btn-csv", title: $('.student-list').data("exportTitle"), exportOptions: { columns: ["thead th:not(.noExport)"] } },
                            { extend: 'pdf', text: '<i class="fa fa-file-pdf-o"></i>', titleAttr: 'PDF', className: "btn-pdf", title: $('.student-list').data("exportTitle"), exportOptions: { columns: ["thead th:not(.noExport)"] } },
                            { extend: 'print', text: '<i class="fa fa-print"></i>', titleAttr: 'Print', className: "btn-print", title: $('.student-list').data("exportTitle"), customize: function ( win ) { $(win.document.body).find('th').addClass('display').css('text-align', 'center'); $(win.document.body).find('table').addClass('display').css('font-size', '14px'); $(win.document.body).find('h1').css('text-align', 'center'); }, exportOptions: { columns: ["thead th:not(.noExport)"] } }
                        ],
                        "columnDefs": [ { "targets": -1, "orderable": false } ],
                        "language": { processing: '<i class="fa fa-spinner fa-spin fa-1x fa-fw"></i><span class="sr-only">Loading...</span> '},
                        "pageLength": 100,
                        "processing": true,
                        "serverSide": true,
                        "ajax":{
                            "url": baseurl+"student/dtstudentlist",
                            "dataSrc": 'data',
                            "type": "POST",
                            'data': response.params,
                        },"drawCallback": function(settings) {
                            $('.detail_view_tab').html("").html(settings.json.student_detail_view);
                        }
                    });
                }
            },
            error: function() {
                $this.button('reset');
            },
            complete: function() {
                $this.button('reset');
            }
        });
    });
});

function resetFields(search_type){
    if(search_type == "search_full"){
        $('#class_id').prop('selectedIndex',0);
        $('#section_id').find('option').not(':first').remove();
    }else if (search_type == "search_filter") {
        $('#search_text').val("");
    }
}

$(document).on('click', '.print_student_details', function() {
    let $button_ = $(this);
    var student_id = $(this).attr('data-student_id');
    var admission_no = $(this).attr('data-admission_no');
    var student_name = $(this).attr('data-student_name');
    $.ajax({
        type: 'POST',
        url: baseurl + 'student/printStudentDetails',
        data: {'student_id':student_id},
        beforeSend: function() {
            $button_.button('loading');
        },
        xhr: function() {
            var xhr = new XMLHttpRequest();
            xhr.responseType = 'blob';
            return xhr;
        },
        success: function(data, jqXHR, response) {
            var blob = new Blob([data], {type: 'application/pdf'});
            var link = document.createElement('a');
            link.href = window.URL.createObjectURL(blob);
            link.download = student_name + '_' + admission_no + '.pdf';
            document.body.appendChild(link);
            link.click();
            document.body.removeChild(link);
            $button_.button('reset');
        },
        error: function(xhr, status, error) {
            console.error("Error occurred:", status, error);
            $button_.button('reset');
        },
        complete: function() {
            $button_.button('reset');
        }
    });
});
</script>
</body>
</html>