<?php $currency_symbol = $this->customlib->getSchoolCurrencyFormat(); ?>
<?php $suppper = []; ?>
<div class="content-wrapper">

    <section class="content-header">
        <h1>
            <i class="fa fa-money"></i>Fees master by type</h1>
    </section>

     <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header ptbnull">
                        <h3 class="box-title titlefix">Fees Master By Type</h3>
                        <div class="box-tools pull-right">
                        </div>
                    </div>
                    <div class="box-body">
                        <form action="<?php echo site_url('feestatusunpaid') ?>" method="post" class="class_search_form">
                            <?php echo $this->customlib->getCSRF(); ?>
                            <div class="row">
                                <div class="col-md-6 col-sm-6">
                                    <div class="row">
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label><?php echo $this->lang->line('class'); ?></label><small class="req">  *</small>
                                                    <select autofocus="" id="class_id" name="class_id" class="form-control" >
                                                        <option value=""><?php echo $this->lang->line('select'); ?></option>
                                                        <?php
                                                            foreach ($classlist as $class) {
                                                                ?>
                                                                <option value="<?php echo $class['id'] ?>" <?php if (set_value('class_id') == $class['id']) {
                                                                    echo "selected=selected";
                                                                }
                                                                ?>><?php echo $class['class'] ?></option>
                                                                                                                    <?php
                                                            }
                                                            ?>
                                                    </select>
                                                    <span class="text-danger" id="error_class_id"></span>
                                                </div>

                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label><?php echo $this->lang->line('section'); ?></label>
                                                    <select  id="section_id" name="section_id" class="form-control" >
                                                        <option value=""><?php echo $this->lang->line('select'); ?></option>
                                                    </select>
                                                    <span class="text-danger"><?php echo form_error('section_id'); ?></span>
                                                </div>
                                            </div>
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <button type="submit" class="btn btn-primary btn-sm pull-right" name="class_search" data-loading-text="Please wait.." value=""><i class="fa fa-search"></i> <?php echo $this->lang->line('search'); ?></button>
                                                </div>
                                            </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label><?php echo $this->lang->line('search_by_keyword'); ?></label>
                                                <input type="text" name="search_text" id="search_text" class="form-control" value="<?php echo set_value('search_text'); ?>" placeholder="<?php echo $this->lang->line('search_by_student_name'); ?>">
                                                <span class="text-danger" id="error_search_text"></span>
                                            </div>
                                        </div>

                                        <div class="col-sm-12">
                                            <div class="form-group">
                                            <button type="submit" class="btn btn-primary btn-sm pull-right" name="keyword_search" data-loading-text="Please wait.." value=""><i class="fa fa-search"></i> <?php echo $this->lang->line('search'); ?></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <div class="col-md-12">
                            <div class="mailbox-messages table-responsive">
                                <div class="download_label">Fees Master By Type</div>
                                
                                <table class="table table-striped table-bordered table-hover examplenew">
                                    <thead>
                                        <tr>
										<th>Class(Section)</th>
										<th>Admission No</th>
                                        <th>Student Name</th>
										<th>Guardian Name</th>
										<th>Phone</th>
                                            <?php foreach($all_fee_types as $_ft): ?>
                                                <?php 
                                                    $suppper = [
                                                        'paid-'.$_ft => 0,
                                                        'total-'.$_ft => 0,
                                                        'bal-'.$_ft => 0,
                                                    ];    
                                                ?>
                                            <?php endforeach; ?>

                                            <?php foreach($all_fee_types as $_ft): ?>
                                                <th><?php echo $_ft.' (Bal)'; ?></th>
                                            <?php endforeach; ?>
                                            <th>Total Remain Amt</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if(isset($records) && !empty($records)): ?>
                                            <?php foreach($records as $name => $record): ?>
                                                <?php  
                                                    $ta = 0; $tpa = 0; $tra = 0;
                                                    $nn = explode('---', $name);
                                                ?>
                                                <tr style="font-weight:bold;">
                                                    <td><?php echo $nn[2]; ?></td>
                                                    <td><?php echo $nn[3]; ?></td>
													<td><?php echo $nn[1]; ?></td>
													<td><?php echo $nn[4]; ?></td>
													<td><?php echo $nn[5]; ?></td>
		
                                                    <?php foreach($all_fee_types as $_ft): ?>
                                                        <?php 
                                                            $amount = $record[$_ft]['amount'] ?? 0;
                                                            $discount = $record[$_ft]['discount'] ?? 0;
                                                            $fine = $record[$_ft]['fine'] ?? 0;
                                                            $paid_fees = $record[$_ft]['paid_fees'] ?? 0;
                                                            $remain_fees = $amount - $paid_fees + $fine - $discount;
                                                            if($remain_fees==0){ $remain_fees ='Paid';} else {$remain_fees =number_format($remain_fees, 2, '.', '');}
                                                            $suppper['bal-'.$_ft] += $remain_fees;
                                                            $tra += $remain_fees;    
                                                        ?>
                                                        <td style="color:orange;"><?php echo $remain_fees; ?></td>
                                                    <?php endforeach; ?>
                                                    <td style="color:orange;"><?php echo (number_format($tra, 2, '.', '')); ?></td>
                                                </tr>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                            
                                    </tbody>
                                    <!--thead used for displaying footer-->
                                    <thead>
                                        <tr>
										<th>Class(Section)</th>
										<th>Admission No</th>
                                        <th>Student Name</th>
										<th>Guardian Name</th>
										<th>Phone</th>
                                            <?php $sp = 0; $st = 0; $sb = 0; ?>
       
                                            <?php foreach($all_fee_types as $_ft): ?>
                                                <?php 
                                                    $bt = $suppper['bal-'.$_ft] ?? 0;
                                                    $sb += $bt; 
                                                ?>
                                                <th><?php echo (number_format($bt, 2, '.', '')); ?></th>
                                            <?php endforeach; ?>
                                            <th><?php echo (number_format($sb, 2, '.', '')); ?></th>
                                        </tr>
                                    </thead>
                                    <!--tfoot used for export footer-->
                                    <tfoot>
                                        <tr>
										<th>Class(Section)</th>
										<th>Admission No</th>
                                        <th>Student Name</th>
										<th>Guardian Name</th>
										<th>Phone</th>
                                            <?php $sp = 0; $st = 0; $sb = 0; ?>
                                            
                         
                                            <?php foreach($all_fee_types as $_ft): ?>
                                                <?php 
                                                    $bt = $suppper['bal-'.$_ft] ?? 0;
                                                    $sb += $bt; 
                                                ?>
                                                <th><?php echo (number_format($bt, 2, '.', '')); ?></th>
                                            <?php endforeach; ?>
                                            <th><?php echo (number_format($sb, 2, '.', '')); ?></th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<script type="text/javascript">
    $(document).ready(function () {
        var table = $('.examplenew').DataTable({
            // footerCallback: function (row, data, start, end, display) {
            //     console.log(row, data, start, end, display)
            // },
            // "aaSorting": [],           
            // rowReorder: {
            // selector: 'td:nth-child(2)'
            // },
            //responsive: 'false',
            // fixedHeader: {
            //     header: true,
            //     footer: true
            // },
            
            dom: "Bfrtip",
            buttons: [

                {
                    extend: 'copyHtml5',
                    text: '<i class="fa fa-files-o"></i>',
                    titleAttr: 'Copy',
                    title: $('.download_label').html(),
                    footer: true,
                    exportOptions: {
                        columns: ["thead th:not(.noExport)"]
                    }
                },

                {
                    extend: 'excelHtml5',
                    text: '<i class="fa fa-file-excel-o"></i>',
                    titleAttr: 'Excel',
                   footer: true,
                    title: $('.download_label').html(),
                     exportOptions: {
                    columns: ["thead th:not(.noExport)"]
                  }
                },

                {
                    extend: 'csvHtml5',
                    text: '<i class="fa fa-file-text-o"></i>',
                    titleAttr: 'CSV',
                    title: $('.download_label').html(),
                    footer: true,
                //      exportOptions: {
                //     columns: ["thead th:not(.noExport)"]
                //   }
                },

                {
                    extend: 'pdfHtml5',
                    text: '<i class="fa fa-file-pdf-o"></i>',
                    titleAttr: 'PDF',
                    title: $('.download_label').html(),
                    footer: true,
                    exportOptions: {
                    columns: ["thead th:not(.noExport)"]
                  }
                },

                {
                    extend: 'print',
                    text: '<i class="fa fa-print"></i>',
                    titleAttr: 'Print',
                    footer: true,
                    title: $('.download_label').html(),
                 customize: function ( win ) {

                    $(win.document.body).find('th').addClass('display').css('text-align', 'center');
                    $(win.document.body).find('td').addClass('display').css('text-align', 'left');
                    $(win.document.body).find('table').addClass('display').css('font-size', '14px');
                    // $(win.document.body).find('table').addClass('display').css('text-align', 'center');
                    $(win.document.body).find('h1').css('text-align', 'center');
                },
                     exportOptions: {
                    columns: ["thead th:not(.noExport)"]
                  }
                },

                {
                    extend: 'colvis',
                    text: '<i class="fa fa-columns"></i>',
                    titleAttr: 'Columns',
                    
                    title: $('.download_label').html(),
                    postfixButtons: ['colvisRestore']
                },
            ]
        });
    });


    $(document).ready(function () {
        var class_id = $('#class_id').val();
        var section_id = '<?php echo set_value('section_id', 0) ?>';
        getSectionByClass(class_id, section_id);
    });

    $(document).on('change', '#class_id', function (e) {
        $('#section_id').html("");
        var class_id = $(this).val();
        getSectionByClass(class_id, 0);
    });

    function getSectionByClass(class_id, section_id) {

        if (class_id != "") {
            $('#section_id').html("");
            var base_url = '<?php echo base_url() ?>';
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
</script>