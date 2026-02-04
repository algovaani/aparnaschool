<?php if (!empty($staffs)) { ?>
<style>
    @media print {
        body { margin: 0; padding: 0; }
        .page-break { page-break-after: always; }
        @page { size: A4; margin: 0; }
    }

    /* A4 Sheet Setup */
    .print-sheet {
        width: 210mm;
        height: 297mm;
        padding: 8mm 5mm;
        margin: auto;
        display: grid;
        grid-template-columns: repeat(3, 54mm);
        grid-gap: 10mm 10mm;
        justify-content: center;
        box-sizing: border-box;
    }

    /* Premium ID Card Body */
    .id-card-modern {
        width: 54mm;
        height: 85.6mm;
        border: 0.3mm solid #D4AF37; 
        border-radius: 4mm;
        overflow: hidden;
        position: relative;
        background: #fff;
        font-family: 'Arial', sans-serif;
        box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }

    /* Design Elements */
    .top-wave {
        position: absolute;
        top: 0; width: 100%; height: 35mm;
        background: #0b2f5b; 
        clip-path: polygon(0 0, 100% 0, 100% 65%, 0% 100%);
        z-index: 1;
    }
    .top-accent {
        position: absolute;
        top: 0; width: 100%; height: 37mm;
        background: #D4AF37; 
        clip-path: polygon(0 0, 100% 0, 100% 70%, 0% 105%);
        z-index: 0;
    }

    .bottom-wave {
        position: absolute;
        bottom: 0; width: 100%; height: 20mm;
        background: #0b2f5b;
        clip-path: polygon(0 40%, 100% 0, 100% 100%, 0% 100%);
        z-index: 1;
    }
    .bottom-accent {
        position: absolute;
        bottom: 0; width: 100%; height: 22mm;
        background: #D4AF37;
        clip-path: polygon(0 35%, 100% -5%, 100% 100%, 0% 100%);
        z-index: 0;
    }

    /* Header Content */
    .header-content {
        position: absolute;
        top: 4mm;
        width: 100%;
        text-align: center;
        z-index: 2;
        color: white;
    }
    .school-logo {
        height: 11mm;
        background: white;
        padding: 1mm;
        border-radius: 50%;
        margin-bottom: 1.5mm;
        border: 0.3mm solid #D4AF37;
    }
    .school-name {
        font-size: 3.2mm; 
        font-weight: 900;
        text-transform: uppercase;
        line-height: 3.5mm;
        letter-spacing: 0.4px;
    }

    /* Photo Section */
    .photo-area {
        position: absolute;
        top: 18mm; 
        width: 100%;
        text-align: center;
        z-index: 3;
    }
    .staff-img {
        width: 25mm;
        height: 25mm;
        border: 1mm solid #D4AF37; 
        border-radius: 3mm;
        /* PHOTO FIXES BELOW */
        object-fit: contain; /* Isse pura face dikhega, crop nahi hoga */
        background-color: #D4AF37; /
        padding: 1px;
    }

    /* Details Section */
    .staff-info {
        position: absolute;
        top: 45mm;
        width: 100%;
        text-align: center;
        padding: 0 4mm;
        z-index: 2;
    }
    /* STAFF NAME SIZE REDUCED */
    .staff-name {
        font-size: 3.4mm; /* Pehle 3.8mm tha, ab thoda chota kiya hai */
        font-weight: 900;
        color: #0b2f5b;
        text-transform: uppercase;
    }
    .staff-role {
        font-size: 2.6mm;
        color: #D4AF37;
        font-weight: bold;
        text-transform: uppercase;
        margin: 1mm auto 2mm auto;
        display: inline-block;
        background: #123e75;
        padding: 0.8mm 4mm;
        border-radius: 50px;
    }

    .data-row {
        text-align: left;
        font-size: 2.5mm;
        line-height: 3.8mm;
        color: #333;
        margin-left: 2mm;
    }
    .data-row b { color: #0b2f5b; width: 11mm; display: inline-block; }

    .qr-box {
        position: absolute;
        bottom: 8.5mm; 
        right: 3mm;
        width: 10mm;
        height: 10mm;
        background: white;
        padding: 0.8mm;
        border-radius: 1mm;
        z-index: 4;
        border: 0.2mm solid #D4AF37;
    }

    /* Footer Address */
    .footer-address {
        position: absolute;
        bottom: 1.5mm; 
        width: 100%;
        color: white;
        font-size: 1.7mm;
        text-align: center;
        z-index: 2;
        line-height: 2.4mm;
        padding: 0 3mm;
        font-weight: bold;
    }
</style>

<div class="print-sheet">
    <?php 
    $count = 0;
    foreach ($staffs as $staff) { 
        $count++;
    ?>
    <div class="id-card-modern">
        <div class="top-accent"></div>
        <div class="top-wave"></div>
        <div class="bottom-accent"></div>
        <div class="bottom-wave"></div>

        <div class="header-content">
            <?php if (!empty($id_card[0]->logo)) { ?>
                <img class="school-logo" src="<?php echo base_url('uploads/school_logo/'.$id_card[0]->logo); ?>">
            <?php } ?>
            <div class="school-name">APARNA PUBLIC SCHOOL</div>
        </div>

        <div class="photo-area">
            <?php
            $img_path = (!empty($staff->image)) 
                ? base_url("uploads/staff_images/" . $staff->image) 
                : base_url("uploads/staff_images/default_" . strtolower($staff->gender) . ".jpg");
            ?>
            <img src="<?php echo $img_path; ?>" class="staff-img">
        </div>

        <div class="staff-info">
            <div class="staff-name"><?php echo $staff->name . " " . $staff->surname; ?></div>
            <div class="staff-role"><?php echo $staff->designation; ?></div>
            
            <div class="data-row">
                <?php if ($id_card[0]->enable_staff_id) { ?>
                    <b>ID :</b> <?php echo $staff->employee_id; ?><br>
                <?php } ?>
                <?php if ($id_card[0]->enable_staff_phone) { ?>
                    <b>Phone :</b> <?php echo $staff->contact_no; ?><br>
                <?php } ?>
                <?php if ($id_card[0]->enable_staff_dob && $staff->dob != '0000-00-00') { ?>
                    <b>DOB :</b> <?php echo date($this->customlib->getSchoolDateFormat(), strtotime($staff->dob)); ?>
                <?php } ?>
            </div>
        </div>

        <?php if ($id_card[0]->enable_staff_barcode) { ?>
        <div class="qr-box">
            <img src="<?php echo $this->media_storage->getImageURL($staff->barcode); ?>" style="width:100%;">
        </div>
        <?php } ?>

        <div class="footer-address">
            AFFILIATED TO CBSE(10+2), NEW DELHI, GOSAIDIH, KG ASHRAM, DHANBAD<br>
            CONT: 06540358384 | <b>aparnapublicschool@gmail.com</b>
        </div>
    </div>

    <?php 
        if ($count % 9 == 0 && $count < count($staffs)) {
            echo '</div><div class="page-break"></div><div class="print-sheet">';
        }
    } ?>
</div>
<?php } ?>