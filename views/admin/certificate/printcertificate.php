<?php 
function convertToWords($number) {
    $ones = array(
        1 => 'one', 2 => 'two', 3 => 'three', 4 => 'four', 5 => 'five',
        6 => 'six', 7 => 'seven', 8 => 'eight', 9 => 'nine', 10 => 'ten',
        11 => 'eleven', 12 => 'twelve', 13 => 'thirteen', 14 => 'fourteen',
        15 => 'fifteen', 16 => 'sixteen', 17 => 'seventeen', 18 => 'eighteen',
        19 => 'nineteen', 20 => 'twenty', 21 => 'twenty-one', 22 => 'twenty-two',
        23 => 'twenty-three', 24 => 'twenty-four', 25 => 'twenty-one', 26 => 'twenty-six',
        27 => 'twenty-seven', 28 => 'twenty-eight', 29 => 'twenty-nine', 30 => 'thirty'
    );

    $tens = array(
        2 => 'twenty', 3 => 'thirty', 4 => 'forty', 5 => 'fifty',
        6 => 'sixty', 7 => 'seventy', 8 => 'eighty', 9 => 'ninety'
    );

    $number = (int)$number;

    if ($number == 0) {
        return 'zero';
    }

    $string = '';

    // Handling thousands
    if ($number >= 1000) {
        $string .= $ones[($number / 1000)] . ' thousand ';
        $number %= 1000;
    }

    // Handling hundreds
    if ($number >= 100) {
        $string .= $ones[($number / 100)] . ' hundred ';
        $number %= 100;
    }

    // Handling tens and ones
    if ($number > 0) {
        if ($string != '') {
            $string .= 'and ';
        }

        if ($number < 20) {
            $string .= $ones[$number];
        } else {
            $string .= $tens[(int)($number / 10)];
            if (($number % 10) > 0) {
                $string .= '-' . $ones[$number % 10];
            }
        }
    }

    return $string;
}
?>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<style type="text/css">

    @media print {
      .page-break { display: block; page-break-before: always; }
    }
    *{ margin:0; padding: 0;}

    table{ font-family: 'arial'; margin:0; padding: 0;font-size: 15px; color: #000;}
    .tc-container{width: 100%;position: relative; text-align: center;margin-bottom:60px;padding-bottom: 10px; font-size: 15px}
    .tcmybg {
        background: top center;
        background-size: contain;
        position: absolute;
        left: 0;
        bottom: 10px; font-size: 15px;
        width: 160px;
        height: 160px;
        margin-left: auto;
        margin-right: auto;
        right: 0;
        opacity: 0.10;
    }
    /*begin students id card*/
    .studentmain{background: #efefef;width: 100%; margin-bottom: 30px;}
    .studenttop img{width:30px;vertical-align: top;}
    .studenttop{background: #453278;padding:2px;color: #fff;overflow: hidden;position: relative;z-index: 1;}
    .sttext1{font-size: 15px;font-weight: bold;line-height: 30px;}
    .stgray{background: #efefef;padding-top: 5px; padding-bottom: 10px; font-size: 15px}
    .staddress{margin-bottom: 0; padding-top: 2px;}
    .stdivider{border-bottom: 2px solid #000;margin-top: 5px; margin-bottom: 5px;}
    .stlist{padding: 0; margin:0; list-style: none;}
    .stlist li{text-align: left;display: inline-block;width: 100%;padding: 0px 5px;}
    .stlist li span{width:65%;float: right;}
    .stimg{width: 80px;height: 80px; margin-bottom: 5px;}
    .stimg img{width: 100%;height: 80px;border-radius: 2px;display: block;}
    .img-circle {border-radius:15px;}
    .center-block {display: block;margin-right: auto;margin-left: auto;}
    .staround{padding:3px 10px  font-size: 15px3px 0;position: relative;overflow: hidden;}
    .staround2{position: relative; z-index: 9;}
    .stbottom{background: #453278;height: 10px; font-size: 15pxwidth: 100%;clear: both;margin-bottom: 5px;}
    .principal{margin-top: -40px;margin-right:10px; font-size: 15px float:right;}
    .stred{color: #000;}
    .spanlr{padding-left: 5px; padding-right: 5px;}
    .cardleft{width: 20%;float: left;}
    .cardright{width: 77%;float: right; }
    .width32{width: 32.55%; padding: 3px; float: left; height: 100%;}
    .signature{border:1px solid #ddd;display:block; text-align: center; /*padding: 5px 10px; font-size: 15px*/ /*margin-top: 2px;*/}
    .vertlist{padding: 0; margin:0; list-style: none;height: 129px;}
    .vertlist li{text-align: left;display: inline-block;width: 100%; padding-bottom: 0px;color: #000;}
    .vertlist li span{width:55%;float: right;}
    .barcodeimg{display: block;margin-top: 5px;text-align: left;}
</style>
<style>
  .cert-type{
        margin-left: 190px;
        margin-top: 35px;
        margin-bottom: 35px;
        font-size: 15px;
    }
    /*#watermark{*/
    /*    position: fixed;*/
    /*    opacity: 0.2;*/
    /*    bottom:   8cm;*/
    /*    left:     6.5cm;*/
    /*    width:    9cm;*/
    /*    height:   9cm;*/
    /*    z-index:  -2;*/
    /*  }*/
      
      *{padding: 0; margin:0;}
    body{ font-family: 'arial';}
    .tc-container{width: 100%;position: relative; text-align: center;padding: 2%;}
    .tc-container tr td{vertical-align: bottom;}
    /*.tc-container{
        width: 100%;
        padding: 2%;
        position: relative;
        z-index: 2;
    }*/
    .tcmybg {
        background:top center;
        position: absolute;
        top: 0;
        left: 0;
        bottom: 0;
        z-index: 1;
    }
    .tc-container tr td h1, h2 ,h3{margin-top: 0; font-weight: normal;}
    /*@media (max-width:210mm) and (min-width:297mm){
        .tc-container{
            margin-top: 200px;
            margin-bottom: 100px;}
    }*/
   
</style>

<?php
if ($certificate[0]->certificate_name == "TRANSFER CERTIFICATE") {
    ?>
    <?php
    foreach ($students as $student) {
        $i++;
       ?>
       <div class="" style="position: relative; font-family: 'arial';">
            <?php if (!empty($certificate[0]->background_image)) { ?>
                    <img src="<?php echo $this->media_storage->getImageURL('uploads/certificate/' . $certificate[0]->background_image); ?>" style="width: 100%; height: 100vh" />
                <?php } ?>

                <div class="container" id="printable" style="width: 800px; height: 1165px; position: absolute; top: 0; left: 0; width: 100%; font-size:8px; font-family: 'arial';">

            <!-- Your content goes here -->
            <div class="row" style="text-align:center;">               
                <div class="col-md-12" >
                    <!--<h2 style="margin-top: 0px;">APARNA PUBLIC SCHOOL, DHANBAD</h2>-->
                    <!--<P>(School Leaving certificate / Transfer Certificate signed by The Principal)</P>-->
                    <h2 style="margin-top: 170px;">Transfer Certificate</h2>
                </div>
            </div>
            <div class="col-md-12" style="margin-top: 20px;">
                <div class="row">
                    <div class="col-md-6">
                        <span style="font-size: 15px;">Transfer Certificate No: <strong><u><i><?php echo 'APS/'.date("y",strtotime("-1 year"))."-". date("y").'/'.str_pad($student->roll_no, 4, '0', STR_PAD_LEFT); ?></i></u></strong></span> 
                    </div><br>
                    <div class="col-md-6">
                        <span style="font-size: 15px; ">Addmision No: <strong><u><i><?php echo 'APS-'.$student->admission_no; ?></i></u></strong></span>
                    </div>
                </div>
            </div>
            <div id="watermark">
                <!--<img src="<?php //echo base_url('uploads/certificate/water.jpg'); ?>" height="100%" width="100%">-->
            </div>
              <div class="row" style="margin-left: 30px; ">
                <div class="col-md-12 " style="font-size: 13px; margin-top: 5px;">
                    1. Name of Pupil: <strong style="float:right; margin-right: 10px; font-size: 13px"><u><i><?php echo $student->firstname. $student->middlename . $student->lastname; ?></i></u></strong><br>
                    2. Name  (a) Father/Guardian: <strong style="float:right; margin-right: 10px; font-size: 13px"><u><i><?php echo $student->father_name; ?></i></u></strong><br>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(b) mother: <strong style="float:right; margin-right: 10px; font-size: 13px"><u><i><?php echo $student->mother_name; ?></i></u></strong><br>
                    3. Nationality: <strong style="float:right; margin-right: 10px; font-size: 13px"><u><i>Indian</i></u></strong><br>
                    4. Whether the pupil belongs to SC/ST/OBC/:-<strong style="float:right; margin-right: 10px; font-size: 13px"><u><i><?php if($student->cast !=''){ echo $student->cast; }else{ echo 'No'; }?></i></u></strong><br>
                    5. Date of birth(according to admission register): <strong style="float:right; margin-right: 10px; font-size: 13px"><u><i><?php echo date_format(date_create($student->dob), "d-m-Y"); ?></i></u></strong><br>
                       &nbsp;&nbsp;&nbsp;&nbsp; (In words) : <strong style="float:right; margin-right: 10px; font-size: 13px"><u><i>
                        <?php 
                        $dob = $student->dob;
                        $timestamp = strtotime($dob);
                        $date_in_words = date("dS - M - Y", $timestamp);
                        $date_parts = explode(" - ", $date_in_words);

                        // Define arrays for words
                        $day_words = ["", "ONE", "TWO", "THREE", "FOUR", "FIVE", "SIX", "SEVEN", "EIGHT", "NINE", "TEN", "ELEVEN", "TWELVE", "THIRTEEN", "FOURTEEN", "FIFTEEN", "SIXTEEN", "SEVENTEEN", "EIGHTEEN", "NINETEEN", "TWENTY", "TWENTY ONE", "TWENTY TWO", "TWENTY THREE", "TWENTY FOUR", "TWENTY FIVE", "TWENTY SIX", "TWENTY SEVEN", "TWENTY EIGHT", "TWENTY NINE", "THIRTY", "THIRTY ONE"];
                        $month_words = ["", "JAN", "FEB", "MAR", "APR", "MAY", "JUN", "JUL", "AUG", "SEP", "OCT", "NOV", "DEC"];
                        $year_words = ["", "NINETEEN HUNDRED", "TWO THOUSAND", "ONE", "TWO", "THREE", "FOUR", "FIVE", "SIX", "SEVEN", "EIGHT", "NINE", "TEN", "ELEVEN", "TWELVE", "THIRTEEN", "FOURTEEN", "FIFTEEN", "SIXTEEN", "SEVENTEEN", "EIGHTEEN", "NINETEEN", "TWENTY", "TWENTY ONE", "TWENTY TWO", "TWENTY THREE", "TWENTY FOUR", "TWENTY FIVE", "TWENTY SIX", "TWENTY SEVEN", "TWENTY EIGHT", "TWENTY NINE", "THIRTY", "THIRTY ONE"];

                        // Convert day, month, and year to words
                        $day = $day_words[(int)$date_parts[0]];
                        $month = $month_words[(int)$date_parts[1]];
                        $year = $date_parts[2] < 2000 ? $year_words[1] : $year_words[2];
                        $year .= " " . $year_words[(int)substr($date_parts[2], -2)+2];
                        // Combine the words
                        echo $day . " - " . date('F', strtotime($dob)) . " - " . $year;
                        ?></i></u></strong><br>
                    6. Class in which the Pupil last studied: <strong style="float:right; margin-right: 10px; font-size: 13px"><u><i><?php echo $student->class; ?></i></u></strong><br>
                    7. Subjects is studied stating in each case compulsory of effective: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong style="font-size: 13px"><u><i><?php echo $student->subject_name; ?> </i></u></strong><br>
                    8. Date of promotion to the class in which studying. If final exam has not be held State whether qualified for promotion to heigher class or not: &nbsp;&nbsp;&nbsp;&nbsp;<strong style="float:right; margin-right: 10px; font-size: 13px"><u><i><?php echo $student->class_date; ?></i></u></strong><br> 
                    9. Whether the pupil has passed the craft subject or not: <strong style="float:right; margin-right: 10px; font-size: 13px"><u><i><?php echo $student->crft_sub; ?></i></u></strong><br>
                    10. Whether the pupil has passed the core subject (s) or not ? If yes state subjects: <strong style="float:right; margin-right: 10px; font-size: 13px"><u><i><?php echo $student->core_sub; ?></i></u></strong><br>
                    11. Month up to which fee have been paid: <strong style="float:right; margin-right: 10px; font-size: 13px"><u><i><?php echo $student->last_fee_paid_date; ?></i></u></strong><br>
                    12. Whether the pupil was in reciept of any concession? If so, state the nature of concession: <strong style="float:right; margin-right: 10px; font-size: 13px"><u><i><?php echo $student->concession_reciept; ?></i></u></strong><br>
                    13. Date of Pupil last attendance at the school<strong style="float:right; margin-right: 10px; font-size: 13px"><u><i><?php echo date_format(date_create($student->last_attendance_date), "d-m-Y"); ?></i></u></strong><br>
                    14. Date of which he/she struck off the rolls of the school:- <strong style="float:right; margin-right: 10px; font-size: 13px"><u><i><?php echo date("dM-Y");?></i></u></strong><br>
                    15. Number of school days up to the date with number of hours utilized for practical work in different subjects:- <strong style="float:right; margin-right: 10px; font-size: 13px"><u><i>210 Days</i></u></strong><br>
                    <!-- 16. Number of school days the pupil attended (with number of hours of practice at work in different subjects attended by the pupil):- <strong style="float:right; margin-right: 10px; font-size: 13px"><u><i><?php echo $student->dateate ." " ."Days"; ?></i></u></strong><br> -->
                    16. Number of school days the pupil attended (with number of hours of practice at work in different subjects attended by the pupil):- <strong style="float:right; margin-right: 10px; font-size: 13px"><u><i><?php echo $student->pupil_attend_days ." " ."Days"; ?></i></u></strong><br>
                    17. Date of application for this certificate:- <strong style="float:right; margin-right: 10px; font-size: 13px"><u><i><?php echo date('dM-Y', strtotime('-10 days', strtotime(date('dM-Y')))); ?></i></u></strong><br>
                    18. Date of issue of certificate:- <strong style="float:right; margin-right: 10px; font-size: 13px"><u><i><?php echo date("dM-Y");?></i></u></strong><br>
                    19. Reason for leaving the school:- <strong style="float:right; margin-right: 10px; font-size: 13px"><u><i>Transfer</i></u></strong><br>
                    20. Whether NCC Cadet / Boy Scout / Girl Guide?:- <strong style="float:right; margin-right: 10px; font-size: 13px"><u><i><?php echo $student->ncc_cadet; ?></i></u></strong><br>
                    21. Games played and other co-curricular activities in which the pupil usualy took part with degree of proficiency attained:- <strong style="float:right; margin-right: 10px; font-size: 13px"><u><i><?php echo $student->game_play; ?></i></u></strong><br>
                    22. Genral conduct:- <strong style="float:right; margin-right: 10px; font-size: 13px"><u><i><?php echo $student->cunduct; ?></i></u></strong><br>
                    23. pramoted next class name & date:- <strong style="float:right; margin-right: 10px; font-size: 13px"><u><i><?php echo $student->class_date; ?></i></u></strong><br>
                    24. Craft subject passed yes or no:- <strong style="float:right; margin-right: 10px; font-size: 13px"><u><i><?php echo $student->crft_sub; ?></i></u></strong><br>
                    25. Core subject passed yes or no:- <strong style="float:right; margin-right: 10px; font-size: 13px"><u><i><?php echo $student->core_sub; ?></i></u></strong><br>
                    26. Total number of school days:- <strong style="float:right; margin-right: 10px; font-size: 13px"><u><i><?php echo $student->tot_school_days; ?></i></u></strong><br>
                    27. Take concession reciept yes or no:- <strong style="float:right; margin-right: 10px; font-size: 13px"><u><i><?php echo $student->cunduct; ?></i></u></strong><br>
                    28. Annual charges collection yes or no:- <strong style="float:right; margin-right: 10px; font-size: 13px"><u><i><?php echo $student->anul_chrg_colct; ?></i></u></strong><br>
                    29. First fee paid date:- <strong style="float:right; margin-right: 10px; font-size: 13px"><u><i><?php echo $student->first_fee_paid_date; ?></i></u></strong><br>
                    30. Last fee paid date:- <strong style="float:right; margin-right: 10px; font-size: 13px"><u><i><?php echo $student->last_fee_paid_date; ?></i></u></strong><br>
                    31. First fee paid date:- <strong style="float:right; margin-right: 10px; font-size: 13px"><u><i><?php echo $student->first_fee_paid_date; ?></i></u></strong><br>
                    32. Total Days Attended Pupil:- <strong style="float:right; margin-right: 10px; font-size: 13px"><u><i><?php echo $student->tot_school_days; ?></i></u></strong><br>
                    
                    
                    <!--23. Annual charges for the year have allready been collected on the date:- <strong style="float:right; margin-right: 10px; font-size: 13px"><u><i><?php echo $student->anul_chrg_colct; ?></i></u></strong><br>-->
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-12" style="margin-left: 30px; margin-top: 30px;font-size:12px">
                    <div class="col-md-12" >
                        <span><strong><i>(Signature of Principal)</i></strong></span>
                        <br>
                        <span><strong><i>Date: <?php echo date("d/m/Y");?></i></strong></span><br>
                    </div>
                </div>
            </div>
            <div class="" >
                <span style="margin-bottom:1px;"></span>
            </div>
        </div>
        </div>
        <?php
        }
    }elseif($certificate[0]->certificate_name == "FEE DUE CERTIFICATE") {
        foreach ($students as $student) {
            $i++;
        ?>
        <div class="" style="position: relative; font-family: 'arial';">
            <?php if (!empty($certificate[0]->background_image)) { ?>
                    <img src="<?php echo $this->media_storage->getImageURL('uploads/certificate/' . $certificate[0]->background_image); ?>" style="width: 100%; height: 100vh" />
                <?php } ?>

        <div class="container" id="printable" style="width: 800px; height: 1165px; position: absolute; top: 0; left: 0; width: 100%; font-size:8px; font-family: 'arial';">
            <div class="col-md-12" style="margin-top: 200px;">
                <div class="row">
                    <div class="col-md-6">
                        <span style="float:left; font-size: 21px; margin-right: 40px;"><strong style="font-size: 21px"><u><i>Ref. No: APS/Date: <?php echo date('dd/mm/Y') ?></i></u></strong></span> 
                    </div><br>
                </div>
            </div>
            <!-- <div class="col-md-12" style="text-align:center;  margin-top: 25px;  margin-right: 20px;">
                <div class="row">
                    <div class="col-md-12">
                      <h2 style="">FEE DUE CERTIFICATE</h2>
                    </div><br>
                </div>
            </div> -->
            <!--<div id="watermark">-->
            <!--    <img src="<?php //echo base_url('uploads/certificate/water.jpg'); ?>" height="100%" width="100%">-->
            <!--</div>-->
            <div class="row" style="margin-left: 30px; justify-content:center;">
                <div class="col-md-12 " style="font-size: 21px; font-weight: 20px; margin-top: 40px;">
                    This is to inform you that the school fee of your ward –&nbsp;<strong style="font-size: 21px"><u><i><?php echo $student->firstname. $student->middlename . $student->lastname; ?></i></u></strong>is due for the month of – <br><br>
                    <ul class="fee-list">
                    <?php
                    // echo "<pre>====222============"; 
                    // print_r($studentDueFee);
                    // echo "</pre>";
                    // exit();

                            // Assuming your input array is stored in $feeData
                            $feeData = [ /* your array data here */ ];

                            // Initialize variables for each fee type
                            $admissionFee = 0;
                            $annualFee = 0;
                            $monthlyFees = [
                                'APRIL' => 0,
                                'MAY' => 0,
                                'JUNE' => 0,
                                'JULY' => 0,
                                'AUGUST' => 0,
                                'SEPTEMBER' => 0,
                                'OCTOBER' => 0,
                                'NOVEMBER' => 0,
                                'DECEMBER' => 0,
                                'JANUARY' => 0,
                                'FEBRUARY' => 0,
                                'MARCH' => 0
                            ];

                            // Process the fee data
                            foreach ($studentDueFee as $feeGroup) {
                               
                                if (isset($feeGroup->fees)) {
                                    foreach ($feeGroup->fees as $fee) {
                                        $type = strtoupper($fee->type);
                                        $amount = (float)$fee->amount;
                                        
                                        if ($type === 'ADMISSION FEE ( ONE TIME)' && empty($fee->amount_detail)) {
                                            $admissionFee += $amount;
                                        } elseif ($type === 'ANNUAL FEE' && empty($fee->amount_detail)) {
                                            $annualFee += $amount;
                                        } elseif (array_key_exists($type, $monthlyFees)  && empty($fee->amount_detail)) {
                                            $monthlyFees[$type] += $amount;
                                        }
                                    }
                                }
                            }

                            // Calculate total
                            $totalFee = $admissionFee + $annualFee + array_sum($monthlyFees);

                            // Generate the output
                            $output = "<li class='fee-item'> ADMISSION FEE Rs. " . number_format($admissionFee, 2) . "</li>";
                            $output .= "<li class='fee-item'>ANNUAL FEE Rs. " . number_format($annualFee, 2)."</li>";

                            foreach ($monthlyFees as $month => $amount) {
                                if ($amount != 0) {
                                    $output .= "<li>" . $month . "- Rs. " . number_format($amount, 2) ."</li>";
                                }
                            }

                            $output .= "<div class='total-fee'> Total Fee due is Rs. " . number_format($totalFee, 2)."</div></ul>";

                            // Display the output
                            echo $output;
                            ?>
                     
                    <br><br>
                    <p>
                        You are requested to pay the fees IMMEDIATELY to avoid additional late fees. We would be grateful if you pay the due amount at the earliest for smooth running of the school.<br>
                        Kindly ignore this message if already paid.
                    </p>
                </div>
                <div class="row">
                    <div class="col-md-12" style="margin-top: 170px;">
                        <span style="text-align:center; font-size: 21px; float:right; margin-right: 120px;">Thanks & Regards <br>Principal<br>Aparna Public School</span>
                    </div>
                </div>
            </div>
            
            
            
        </div>
        </div>

        <?php
        }
    } elseif($certificate[0]->certificate_name == "BONAFIED CERTIFICATE") {
        ?>
        <?php
        foreach ($students as $student) {
            $i++;
        ?>
        <div class="" style="position: relative;">
         <?php if (!empty($certificate[0]->background_image)) { ?>
                    <img src="<?php echo $this->media_storage->getImageURL('uploads/certificate/' . $certificate[0]->background_image); ?>" style="width: 100%; height: 100vh" />
                <?php } ?>
        <div class="container" id="printable" style="width: 800px; height: 1165px; position: absolute; top: 0; left: 0; width: 100%; font-size:8px; font-family: 'arial';">

           <div class="col-md-12" style="margin-top: 210px;">
                <div class="row">
                    <div class="col-md-12">
                        <span style="float:left; font-size: 21px; margin-left: 30px;"><strong style="font-size: 21px"><u><i><?php echo 'APS/BONA/'.str_pad($student->roll_no, 4, '0', STR_PAD_LEFT); ?></i></u></strong></span> 
                    </div>
                </div>
                <div class="row">
                   <div class="col-md-12">
                         <span style="float:left; font-size: 21px; margin-left: 30px;">Date: <strong style="font-size: 21px"><u><i><?php echo date("d/m/Y");?></i></u></strong></span> 
                    </div><br>
                </div>
            </div>
            <div class="col-md-12" style="text-align:center;  margin-top: 50px;  margin-right: 20px;">
                <div class="row">
                    <div class="col-md-12">
                      <h2 style="">Bonafied Certificate</h2>
                    </div><br>
                </div>
            </div>
            <div id="watermark">
                <!--<img src="<?php //echo base_url('uploads/certificate/water.jpg'); ?>" height="100%" width="100%">-->
            </div>
            <div class="row" style="margin-left: 30px; justify-content:center;">
                <div class="col-md-12 " style="font-size: 21px; font-weight: 20px; margin-top: 60px;">
                    This is to certify that&nbsp;<strong style="font-size: 21px"><u><i><?php echo $student->firstname. $student->middlename . $student->lastname; ?></i></u></strong>&nbsp;Admission No.&nbsp;<strong style="font-size: 21px"><u><i><?php echo $student->admission_no; ?></i></u>&nbsp;</strong> Date of Birth
                    &nbsp;<strong style="font-size: 21px"><u><i><?php echo date_format(date_create($student->dob), 'd/m/Y');?></i></u>&nbsp;</strong> S/O <strong style="font-size: 21px"><u><i><?php echo $student->father_name;?></i></u></strong> &nbsp;is a student studying in &nbsp;<strong style="font-size: 21px"><u><i><?php echo "CLASS: ".$student->class;?></i></u></strong>
                    at Aparna Public School, Dhanbad for the acadmic year&nbsp; <strong style="font-size: 21px"><u><i><?php echo date("Y",strtotime("-1 year"))."-". date("y");?></i></u></strong>
                    He/She is bonafied student of our school.
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-12" style="margin-top: 170px;">
                    <span style="text-align:center; font-size: 21px;">Principal
                    <br>Aparna Public School</span>
                    <!--<span style="text-align:center; font-size: 21px; float:right; margin-right: 100px;">Aparna Public School</span><br>-->
                </div>
            </div>
            <div class="" >
                <span style="margin-bottom:1px;"></span>
            </div>
        </div>
        </div>
        <?php
        }
    }
    elseif($certificate[0]->certificate_name == "FEE DETAILS CERTIFICATE") {
        ?>
         <?php
        foreach ($students as $student) {
            $i++;
        ?>
         <div class="" style="position: relative;">
        <?php if (!empty($certificate[0]->background_image)) { ?>
                    <img src="<?php echo $this->media_storage->getImageURL('uploads/certificate/' . $certificate[0]->background_image); ?>" style="width: 100%; height: 100vh" />
                <?php } ?>
        <div class="container" id="printable" style="width: 800px; height: 1165px; position: absolute; top: 0; left: 0;width: 100%; font-size:8px; font-family: 'arial';">
            <!--<div class="row">               -->
            <!--    <div class="col-md-12" style="width: 100%; height: 200px;" >-->
                    <!--<img src="<?php //echo base_url('uploads/certificate/header2.jpg'); ?>" height="200px" width="100%">-->
            <!--    </div>-->
            <!--</div>-->
            <div class="col-md-12" style="margin-top: 190px; ">
                <div class="row">
                    <div class="col-md-12">
                        <span style="float:left; font-size: 21px; margin-left: 40px;"><?php echo 'FEE/APS/'.str_pad($student->roll_no, 4, '0', STR_PAD_LEFT); ?></span><br>
                    </div><br>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <span style="float:left; font-size: 21px; margin-left: 40px;"><?php echo date("d/m/Y");?></span>  
                    </div><br>
                </div>
            </div>
            <div class="col-md-12" style="text-align:center; font-size: 25px; margin-top: 20px;">
                <div class="row">
                    <div class="col-md-12">
                      <b><u>TO WHOM IT MAY CONCERN</b></u>
                    </div><br>
                </div> 
            </div>
            <div id="watermark">
                <!--<img src="<?php //echo base_url('uploads/certificate/water.jpg'); ?>" height="100%" width="100%">-->
            </div>
           <div class="row" style="margin-left: 40px; font-size: 21px; font-weight: 20px; margin-top: 20px; margin-right: 40px; content-justify:center;">
                <div class="col-md-12" style="">
                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;It is certified that <strong><u><?php echo $student->firstname. $student->middlename . $student->lastname; ?></u></strong> S/0 - <strong style="font-size: 21px"><u><?php echo $student->father_name;?></u></strong> is studying in <strong style="font-size: 21px"><u><?php echo $student->class;?></u></strong> for the academic
                  year <strong><u><?php echo date("Y",strtotime("-1 year"))."-". date("y");?> </u></strong> in our school. His/Her tuition fee is paid for the period from <strong><u><?php echo $student->first_fee_paid_date; ?></u></strong> to <strong><u><?php echo $student->last_fee_paid_date; ?></u></strong>
                  Tuition Fee in respect of the above said ward of the individual concerned has been receipt <strong><u><?php echo ($student->tutionFee1) ? $student->tutionFee1 : 'NA'; ?> /- </u></strong> per month as per the fee 
                  structure of our school.<br><br>
                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Further it is certified that a sum of total <strong><u>
                   <?php  
                        $number = preg_replace("/[^0-9]/", "", $student->totalDepositAmount);
                        $amount = $number; //$number * 12; 
                        echo $amount;
                        ?> /- 
                           <?php
                           echo ucwords(convertToWords($amount)); 
                    ?></u></strong> has been received to our school 
                  as a tuition fee in respect of the above said student for the said academic year  <strong><u><?php echo date("Y",strtotime("-1 year"))." - ". date("y");?> </u></strong>.<br><br>
                  Note: This certificate is being issued to the individual concerned on their own request.
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-12" style="margin-left: 40px; margin-top: 30px; font-size: 21px;">
                    <div class="col-md-12" >
                        <span>Principal</span>
                        <br>
                        <span>Aparna Public School</span><br>
                    </div>
                </div>
            </div>
            <div class="" >
                <span style="margin-bottom:1px;"></span>
            </div>
        </div>
        </div>
        <?php
        }
    }
    elseif($certificate[0]->certificate_name == "CHARACTER CERTIFICATE") {
        ?>
         <?php
         $certificate[0]->certificate_text = str_replace('[name]', '[name]', $certificate[0]->certificate_text);
        $certificate[0]->certificate_text = str_replace('[present_address]', '[current_address]', $certificate[0]->certificate_text);
        $certificate[0]->certificate_text = str_replace('[guardian]', '[guardian_name]', $certificate[0]->certificate_text);
        $certificate[0]->certificate_text = str_replace('[phone]', '[mobileno]', $certificate[0]->certificate_text);
        
        foreach ($students as $student) {
            $i++;
            $certificate_body = "";
            $certificate_body = $certificate[0]->certificate_text;
            foreach ($student as $std_key => $std_value) {
        
                if ($std_key == "dob") {
        
                    if ($std_value != "0000-00-00" && $std_value != "") {
                        $std_value = date($this->customlib->getSchoolDateFormat(), $this->customlib->dateYYYYMMDDtoStrtotime($std_value));
                    }
                }
                if ($std_key == "admission_date") {
        
                    if ($std_value != "0000-00-00" && $std_value != "") {
                        $std_value = date($this->customlib->getSchoolDateFormat(), $this->customlib->dateYYYYMMDDtoStrtotime($std_value));
                    }
                }
                if ($std_key == "created_at") {
        
                    if ($std_value != "0000-00-00" && $std_value != "") {
                        $std_value = date($this->customlib->getSchoolDateFormat(), $this->customlib->dateYYYYMMDDtoStrtotime($std_value));
                    }
                }
                $certificate_body = str_replace('[' . $std_key . ']', $std_value, $certificate_body);
            }
        ?>
         <div class="" style="position: relative;">
        <?php if (!empty($certificate[0]->background_image)) { ?>
                    <img src="<?php echo $this->media_storage->getImageURL('uploads/certificate/' . $certificate[0]->background_image); ?>" style="width: 100%; height: 100vh" />
                <?php } ?>
        <div class="container" id="printable" style="width: 800px; height: 1165px; position: absolute; top: 0; left: 0; width: 100%; font-size:8px; font-family: 'arial';">
            <div class="row">               
                <div class="col-md-12" style="width: 100%; height: 200px;">
                    <!--<img src="<?php //echo base_url('uploads/certificate/header2.jpg'); ?>">-->
                </div>
            </div>
            <div class="col-md-12" style="margin-top: 60px;">
                <div class="row">
                    <div class="col-md-6">
                        <span style="float:right; font-size: 15px; margin-right: 40px;">Date: <strong><u><i><?php echo date("d/m/Y");?></i></u></strong></span> 
                    </div><br>
                </div>
            </div>
            <div class="col-md-12" style="text-align:center;  margin-top: 30px;  margin-right: 20px;">
                <div class="row">
                    <div class="col-md-12">
                      <h2 style="">CHARACTER CERTIFICATE</h2>
                    </div><br>
                </div>
            </div>
            <div id="watermark">
                <!--<img src="<?php //echo base_url('uploads/certificate/water.jpg'); ?>" height="100%" width="100%">-->
            </div>
            <div class="row" style="margin-left: 90px; ">
                <div class="col-md-12 " style="font-size: 21px; font-weight: 10px; margin-top: 10px; justify-content: center;">
                  <br><br>
                 <?php echo $certificate_body; ?>
                </div>
            </div>
            
            <!--<div class="row">-->
            <!--    <div class="col-md-12" style="margin-top: 170px;">-->
            <!--        <span style="text-align:center; float:right; margin-right: 105px;">Principal</span>-->
            <!--        <br><br>-->
            <!--        <span style="float:right; margin-right: 70px;">Aparna Public School</span><br>-->
            <!--    </div>-->
            <!--</div>-->
            <div class="" >
                <span style="margin-bottom:1px;"></span>
            </div>
        </div>
        </div>
        <?php
        }
    }
    elseif($certificate[0]->certificate_name == "CONFIRMATION CERTIFICATE") {
        ?>
         <?php
        foreach ($students as $student) {
            $i++;
        ?>
        <div class="" style="position: relative;">
       <?php if (!empty($certificate[0]->background_image)) { ?>
    <img src="<?php echo $this->media_storage->getImageURL('uploads/certificate/test.jpeg', $certificate[0]->background_image); ?>" style="width: 100%; height: 100vh" />
<?php } ?>

        <div class="container" id="printable" style="width: 800px; height: 1165px; position: absolute; top: 0; left: 0; z-index: 1; width: 100%; font-size:8px; font-family: 'arial';">
            <!--<div class="row">               -->
            <!--    <div class="col-md-12" style="width: 100%; height: 200px;">-->
                    <!--<img src="<?php //echo base_url('uploads/certificate/header2.jpg'); ?>" height="200px" width="100%">-->
            <!--    </div>-->
            <!--</div>-->
            <div class="col-md-12" style="margin-top: 170px;">
                <div class="row">
                    <div class="col-md-12">
                        <span style="float:right; font-size: 21px;"><strong style="font-size: 21px"><u><i><?php echo 'ACM/'.str_pad($student->roll_no, 4, '0', STR_PAD_LEFT); ?></i></u></strong></span> 
                    </div>
                </div>
                <div class="row">
                   <div class="col-md-12">
                         <span style="float:right; font-size: 21px;"><strong style="font-size: 21px"><u><i><?php echo date("d/m/Y");?></i></u></strong></span> 
                    </div><br>
                </div>
            </div>
            <div id="watermark">
                <!--<img src="<?php //echo base_url('uploads/certificate/water.jpg'); ?>" height="100%" width="100%">-->
            </div>
            <div class="row" style="margin-left: 30px; justify-content:center;">
                <div class="col-md-12 " style="font-size: 22px; font-weight: 20px; margin-top: 30px;">
                    To<br>
                    Mr/Mrs.....<strong style="font-size: 22px"><u><i><?php echo $student->father_name; ?></i></u></strong>..............................<br><br>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;This is to inform you that your ward....<strong style="font-size: 22px"><u><i><?php echo $student->firstname. $student->middlename . $student->lastname; ?></i></u></strong>.....has been<br>
                    admitted to class ...<strong style="font-size: 22px"><u><i><?php echo $student->class; ?></i></u></strong>... for session <strong style="font-size: 22px"><u><i> <?php echo date("Y",strtotime("-1 year"))."-". date("Y");?></i></u></strong>. Your wards admission number
                    is ...<strong style="font-size: 22px"><u><i><?php echo "APS-".$student->admission_no; ?></i></u></strong>... Heartiest congratulations to being a part of Aparna Family.<br><br>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;The classes shall commence from the month of <strong style="font-size: 22px"><u><i>April 2024.</i></u></strong> Kindly go through the
                    school prospectus so that you become familiar with the aspects of Aparna Public School.<br><br>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;If you have any queries regarding anything, feel free to contact the school office on
                    the contact number provided  <strong style="font-size: 22px"><u><i>7779997200.</i></u></strong>

                </div>
            </div>
            <div class="row">
                <div class="col-md-12" style="margin-top: 20px;">
                    <span style="float:left; font-size: 22px; margin-left: 40px;">Thanks & Regards,</span>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12" style="margin-top: 10px;">
                    <span style="float:left; font-size: 22px; margin-left: 40px;">Principal
                    <br>Aparna Public School</span>
                    <!--<span style="float:left; font-size: 22px; margin-left: 40px;">Aparna Public School</span><br>-->
                </div>
            </div>
            <div class="" >
                <span style="margin-bottom:1px;"></span>
            </div>
        </div>
        </div>
        <?php
        }
    }
    else{
        $certificate[0]->certificate_text = str_replace('[name]', '[name]', $certificate[0]->certificate_text);
        $certificate[0]->certificate_text = str_replace('[present_address]', '[current_address]', $certificate[0]->certificate_text);
        $certificate[0]->certificate_text = str_replace('[guardian]', '[guardian_name]', $certificate[0]->certificate_text);
        $certificate[0]->certificate_text = str_replace('[phone]', '[mobileno]', $certificate[0]->certificate_text);
        
        foreach ($students as $student) {
            $certificate_body = "";
            $certificate_body = $certificate[0]->certificate_text;
        
            foreach ($student as $std_key => $std_value) {
        
                if ($std_key == "dob") {
        
                    if ($std_value != "0000-00-00" && $std_value != "") {
                        $std_value = date($this->customlib->getSchoolDateFormat(), $this->customlib->dateYYYYMMDDtoStrtotime($std_value));
                    }
                }
                if ($std_key == "admission_date") {
        
                    if ($std_value != "0000-00-00" && $std_value != "") {
                        $std_value = date($this->customlib->getSchoolDateFormat(), $this->customlib->dateYYYYMMDDtoStrtotime($std_value));
                    }
                }
                if ($std_key == "created_at") {
        
                    if ($std_value != "0000-00-00" && $std_value != "") {
                        $std_value = date($this->customlib->getSchoolDateFormat(), $this->customlib->dateYYYYMMDDtoStrtotime($std_value));
                    }
                }
                $certificate_body = str_replace('[' . $std_key . ']', $std_value, $certificate_body);
            }
            ?>
        
            <div class="" style="position: relative; text-align: center; font-family: 'arial';">

                <?php if (!empty($certificate[0]->background_image)) { ?>

                    <img src="<?php echo $this->media_storage->getImageURL('uploads/certificate/' . $certificate[0]->background_image); ?>" style="width: 100%; height: 100vh" />
                <?php } ?>
        
                <table width="100%" cellspacing="0" cellpadding="0" style="font-size:20px; position: absolute;top: 0; margin-left: auto;margin-right: auto;left: 0;right: 0;<?php echo "width:" . $certificate[0]->content_width . "px" ?>">
                    <tr>
                        <td style="position: absolute;right:0;">
                            <?php if ($certificate[0]->enable_student_image == 1) { ?>
                                <img style="position: relative; <?php echo "top:" . $certificate[0]->enable_image_height . "px" ?>;" src="<?php echo $this->media_storage->getImageURL($student->image); ?>" width="100" height="auto">
                            <?php } ?>
                        </td>
                    </tr>
                    <tr>
                        <td valign="top" style="text-align:left; position: relative; <?php echo "top:" . $certificate[0]->header_height . "px" ?>"><?php echo $certificate[0]->left_header ?></td>
                        <td valign="top" style="text-align:center; position: relative; <?php echo "top:" . $certificate[0]->header_height . "px" ?>"><?php echo $certificate[0]->center_header ?></td>
                        <td valign="top" style="text-align:right; position: relative; <?php echo "top:" . $certificate[0]->header_height . "px" ?>"><?php echo $certificate[0]->right_header ?></td>
                    </tr>
                    <tr>
                        <td colspan="3" valign="top" style="position: relative; <?php echo "top:" . $certificate[0]->content_height . "px" ?>">
                            <p style="font-size: 20px; line-height: 30px; text-align:center;"><?php echo $certificate_body;
                            ?></p></td>
                    </tr>
                    <tr>
                        <td valign="top" style="text-align:left;position: relative; <?php echo "top:" . $certificate[0]->footer_height . "px" ?>"><?php echo $certificate[0]->left_footer ?></td>
                        <td valign="top" style="text-align:center;position: relative; <?php echo "top:" . $certificate[0]->footer_height . "px" ?>"><?php echo $certificate[0]->center_footer ?></td>
                        <td valign="top" style="text-align:right;position: relative; <?php echo "top:" . $certificate[0]->footer_height . "px" ?>"><?php echo $certificate[0]->right_footer ?></td>
                    </tr>
                </table>
            </div>
        
            <?php
        }
        
    }

?>
<script> 
    function printDiv() { 
        var divContents = document.getElementById("printable").innerHTML; 
        var a = window.open('', '', 'height=500, width=500'); 
        a.document.write('<html>'); 
        a.document.write('<body > <h1>Div contents are <br>'); 
        a.document.write(divContents); 
        a.document.write('</body></html>'); 
        a.document.close(); 
        a.print(); 
    } 
</script> 