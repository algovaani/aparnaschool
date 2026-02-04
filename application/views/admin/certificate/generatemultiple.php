<style type="text/css">
    @media print {
        @page {
            size: A4;
            margin: 10mm;
        }
        .page-break { display: block; page-break-after: always; }
        body { -webkit-print-color-adjust: exact; print-color-adjust: exact; }
    }

    * { margin: 0; padding: 0; box-sizing: border-box; }

    .id-table { 
        width: 100%; 
        border-collapse: separate; 
        border-spacing: 2mm; 
    }

    .id-card-wrapper {
        width: 54mm;
        height: 85.6mm;
        position: relative;
        background: #fff;
        border-radius: 5px;
        overflow: hidden;
        margin: 0 auto;
        font-family: 'Arial', sans-serif;
        border: 0.1mm solid #ccc;
    }

    .bg-image {
        position: absolute;
        top: 0; left: 0;
        width: 100%; height: 100%;
        z-index: 1;
    }

    .content-layer {
        position: relative;
        z-index: 5;
        height: 100%;
        width: 100%;
        display: flex;
        flex-direction: column;
    }

    .header-box { 
        display: flex;
        align-items: center; 
        justify-content: center;
        height: 18mm; 
        padding: 1mm 1mm 0 1mm;
    }
    
    .st-logo { width: 9mm; height: auto; margin-right: 1.5mm; flex-shrink: 0; }
    
    .st-title-group {
        display: flex;
        flex-direction: column;
        text-align: left;
    }

    .st-title {
        color: #D4AF37;
        font-size: 8pt;
        font-weight: bold;
        text-transform: uppercase;
        line-height: 1.1;
    }

    .st-address-top {
        color: #D4AF37;
        font-size: 4.5pt;
        font-weight: bold;
        line-height: 1.1;
    }

    .photo-frame-outer {
        height: 32mm; 
        display: flex;
        justify-content: center;
        align-items: center;
        margin-top: 0.5mm;
        margin-bottom: 0.5mm;
    }
    
    .hexagon-shape {
        width: 28mm; 
        height: 31mm; 
        background: #D4AF37; 
        display: flex;
        justify-content: center;
        align-items: center;
        clip-path: polygon(50% 0%, 100% 25%, 100% 75%, 50% 100%, 0% 75%, 0% 25%);
    }
    
    .hexagon-inner {
        width: 26mm; 
        height: 29mm;
        background: #fff;
        display: flex;
        justify-content: center;
        align-items: center;
        clip-path: polygon(50% 0%, 100% 25%, 100% 75%, 50% 100%, 0% 75%, 0% 25%);
    }

    .hexagon-inner img {
        width: 100%; 
        height: 100%;
        object-fit: cover;
    }

    .st-name {
        text-align: center;
        font-size: 8.5pt;
        font-weight: bold;
        color: #D4AF37; 
        margin-bottom: 1mm;
        text-transform: uppercase;
        padding: 0 2mm;
    }

    .detail-table {
        width: 92%;
        margin: 0 auto;
        border-collapse: collapse;
    }
    
    .detail-table td {
        font-size: 6.2pt;
        font-weight: bold;
        padding: 0.4mm 0; 
        color: #000;
        line-height: 1;
    }
    
    .detail-val { font-weight: normal; padding-left: 1mm; }

    .barcode-area {
        text-align: center;
        margin-top: auto; 
        padding-bottom: 3mm; /* Adjusted padding since signature is removed */
    }
    .barcode-area img { width: 18mm; height: 3.5mm; }

</style>

<table class="id-table">
    <tr>
        <?php 
        $count = 0;
        foreach ($students as $student) { 
            $count++;
        ?>
            <td>
                <div class="id-card-wrapper">
                    <img class="bg-image" src="<?php echo $this->media_storage->getImageURL('uploads/student_id_card/background/' . $id_card[0]->background); ?>">

                    <div class="content-layer">
                        <div class="header-box">
                            <img src="<?php echo $this->media_storage->getImageURL('uploads/student_id_card/logo/'.$id_card[0]->logo); ?>" class="st-logo">
                            <div class="st-title-group">
                                <div class="st-title"><?php echo $id_card[0]->school_name; ?> </div>
                                <div class="st-address-top">GOSAIDIH, KG ASHRAM, DHANBAD<br>828109(JH) Cont: 06540358384</div>
                            </div>
                        </div>

                        <div class="photo-frame-outer">
                            <div class="hexagon-shape">
                                <div class="hexagon-inner">
                                    <?php 
                                    $photo_url = (!empty($student->image)) ? $this->media_storage->getImageURL($student->image) : $this->media_storage->getImageURL($student->gender == 'Female' ? "uploads/student_images/default_female.jpg" : "uploads/student_images/default_male.jpg");
                                    ?>
                                    <img src="<?php echo $photo_url; ?>" alt="Student Photo">
                                </div>
                            </div>
                        </div>

                        <div class="st-name">
                            <?php echo $this->customlib->getFullName($student->firstname,$student->middlename,$student->lastname,$sch_settingdata->middlename,$sch_settingdata->lastname); ?>
                        </div>

                        <table class="detail-table">
                            <?php if ($id_card[0]->enable_admission_no) { ?>
                            <tr><td width="35%">ADM NO:</td><td class="detail-val"><?php echo $student->admission_no; ?></td></tr>
                            <?php } ?>
                            
                            <?php if ($id_card[0]->enable_class) { ?>
                            <tr><td>CLASS:</td><td class="detail-val"><?php echo $student->class . ' - ' . $student->section; ?> </td></tr>
                            <?php } ?>
                            
                            <?php if ($id_card[0]->enable_fathers_name) { ?>
                            <tr><td>FATHER:</td><td class="detail-val"><?php echo $student->father_name; ?></td></tr>
                            <?php } ?>

                            <?php if ($id_card[0]->enable_dob) { ?>
                            <tr><td>D.O.B:</td><td class="detail-val"><?php echo ($student->dob != "0000-00-00" && $student->dob != "") ? date($sch_settingdata->date_format, strtotime($student->dob)) : ""; ?> </td></tr>
                            <?php } ?>

                            <?php if ($id_card[0]->enable_phone) { ?>
                            <tr><td>PHONE:</td><td class="detail-val"><?php echo $student->mobileno; ?> </td></tr>
                            <?php } ?>
                        </table>

                        <?php if ($id_card[0]->enable_barcode) { ?>
                        <div class="barcode-area">
                            <img src="<?php echo base_url('admin/studentidcard/generate_barcode/'.$student->admission_no); ?>">
                        </div>
                        <?php } ?>
                        
                        </div>
                </div>
            </td>
        <?php 
            if ($count % 3 == 0 && $count % 9 != 0) {
                echo '</tr><tr>';
            } elseif ($count % 9 == 0) {
                echo '</tr></table><div class="page-break"></div><table class="id-table"><tr>';
            }
        } 
        ?>
    </tr>
</table>