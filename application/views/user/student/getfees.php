<?php
$currency_symbol = $this->customlib->getSchoolCurrencyFormat();
?>
<style>
    @media print {
        .main-footer {
            display: none !important;
        }
    }

    /* General highlight for paid fees */
    .paid-fee-highlight {
        background-color: #e0ffe0 !important; /* Lighter green background for paid fees */
        border-color: #b3e0b3 !important;
    }

    /* Blinking Yellow Button for immediate payment */
    .blink-red {
        background-color: #ffc107 !important; /* Yellow color for attention */
        border-color: #ffc107 !important;
        animation: blinker 1s linear infinite;
    }

    @keyframes blinker {
        50% {
            opacity: 0;
        }
    }

    /* Highlight for the immediate unpaid/partially paid fee row/card */
    .unpaid-fee-highlight {
        background-color: #ffe0e0 !important; /* Lighter red background for unpaid/partially paid fees */
        border-color: #ffb3b3 !important;
    }

    /* Custom styles for Fees Group and Fees Code - Dark Green */
    /* Applied to both header and data cells */
    .fees-group-code-style {
        color: #1b5e20; /* Darker green */
        font-weight: bold;
    }

    /* Mobile-specific styles - DO NOT TOUCH */
    @media (max-width: 767px) {
        .hidden-xs {
            display: none !important;
        }
        .fee-card,
        .total-card {
            margin-bottom: 15px;
            border-radius: 4px;
            border: 1px solid #ddd;
            box-shadow: none;
        }
        .fee-card .panel-heading {
            padding: 10px 15px;
            background-color: #e6f7ff; /* Light blue panel header, can be overridden by dynamic */
            border-bottom: 1px solid #b3e0ff;
        }
        .total-card .panel-heading {
            padding: 10px 15px;
            background-color: #337ab7;
            color: white;
            border-bottom: 1px solid #2e6da4;
        }
        .fee-card .panel-body,
        .total-card .panel-body {
            padding: 15px;
        }
        .fee-row {
            margin-bottom: 8px;
            padding-bottom: 8px;
            border-bottom: 1px solid #f0f0f0;
        }
        .fee-row:last-child {
            border-bottom: none;
            margin-bottom: 0;
            padding-bottom: 0;
        }
        .panel-title {
            font-size: 16px;
            font-weight: 500;
        }
        .label {
            font-size: 12px;
            padding: 0.3em 0.6em;
        }
        .pay-button {
            border-radius: 4px;
            margin-top: 10px;
            padding: 6px 12px;
            font-size: 14px;
        }
        .text-right {
            text-align: right;
            font-family: monospace;
        }
        /* Status label colors - MODIFIED for Mobile */
        .label-success {
            background-color: #6fdc6f !important; /* Brighter green for paid */
            color: #fff; /* White text for contrast */
            font-size: 14px; /* Increased font size */
            font-weight: bold; /* Made bold */
            padding: 5px 8px; /* Adjusted padding */
            border-radius: 5px; /* Slightly rounded corners */
        }
        .label-warning {
            background-color: #ffcc00 !important; /* Brighter yellow for partial */
            color: #333; /* Darker text for contrast */
            font-size: 14px; /* Increased font size */
            font-weight: bold; /* Made bold */
            padding: 5px 8px; /* Adjusted padding */
            border-radius: 5px; /* Slightly rounded corners */
        }
        .label-danger {
            background-color: #ff6666 !important; /* Brighter red for unpaid */
            color: #fff; /* White text for contrast */
            font-size: 14px; /* Increased font size */
            font-weight: bold; /* Made bold */
            padding: 5px 8px; /* Adjusted padding */
            border-radius: 5px; /* Slightly rounded corners */
        }

        /* Mobile-specific highlights - MODIFIED */
        .fee-card.paid-fee-highlight {
            background-color: #e0ffe0 !important; /* Lighter green for mobile paid cards */
            border-color: #b3e0b3 !important;
        }

        .fee-card.unpaid-fee-highlight {
            background-color: #ffe0e0 !important; /* Lighter red for mobile unpaid/partial cards */
            border-color: #ffb3b3 !important;
        }

        /* Custom styles for Mobile Profile Section (Enhanced) */
        .student-profile-card {
            /* Using CSS variable for dynamic background color */
            background-color: var(--mobile-profile-bg, #eaf6fd); /* Default: A soft, light blue */
            border: 1px solid var(--mobile-profile-border, #a8d9f1); /* Matching border with variable */
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); /* A subtle shadow */
            transition: background-color 0.5s ease, border-color 0.5s ease; /* Smooth transitions */
        }

        .student-profile-card .panel-body {
            padding: 15px;
        }

        .student-profile-card .student-photo {
            border: 3px solid #6cb4e4; /* Blue border around the photo */
            box-shadow: 0 0 8px rgba(0, 123, 255, 0.3); /* A glow effect */
        }

        .student-profile-card .student-name {
            color: #007bff; /* Vibrant blue for the student's name */
            font-size: 20px;
            font-weight: 700;
            margin-bottom: 8px;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.1); /* A subtle text shadow */
        }

        .student-profile-card p {
            margin-bottom: 6px;
            font-size: 14px;
            line-height: 1.4;
            color: #34495e; /* Darker text for readability */
        }

        .student-profile-card p strong {
            color: #2c3e50; /* Even darker for labels to stand out */
            font-weight: 600;
        }

        .student-profile-card .text-danger {
            color: #dc3545; /* Standard danger red for RTE */
            font-weight: bold;
        }
    }
    /* Desktop-specific styles */
    @media (min-width: 768px) {
        .visible-xs {
            display: none !important;
        }
        /* Apply dark green and bold to desktop table headers */
        .table-fixed-header thead th:nth-child(3), /* Fees Group column */
        .table-fixed-header thead th:nth-child(4) { /* Fees Code column */
            color: #1b5e20;
            font-weight: bold;
        }

        /* Apply dark green and bold to desktop table data cells */
        .table-fixed-header tbody td:nth-child(3), /* Fees Group data */
        .table-fixed-header tbody td:nth-child(4) { /* Fees Code data */
            color: #1b5e20;
            font-weight: bold;
        }

        /* NEW/MODIFIED DESKTOP STYLES START HERE */
        body {
            background-color: #f0f2f5; /* Light gray background for the entire page */
            font-family: 'Arial', sans-serif; /* A more common and professional sans-serif font */
        }

        .content-wrapper {
            padding: 30px; /* More padding around the main content */
            max-width: 1200px; /* Max width to prevent content from stretching too wide on large screens */
            margin: 0 Adjusted; /* Center the content wrapper */
        }

        .box.box-primary {
            border-radius: 12px; /* More rounded corners for the main box */
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08); /* Stronger, modern shadow */
            border: none; /* Remove default border */
            overflow: hidden; /* Ensures rounded corners clip content */
        }

        .box-header {
            background-color: #ffffff; /* White header background */
            padding: 25px 30px; /* More generous padding */
            border-bottom: 1px solid #e0e6ed; /* Subtle bottom border */
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .box-title {
            font-size: 28px; /* Larger title font */
            font-weight: 700; /* Bolder title */
            color: #334155; /* Darker, professional text color */
        }

        .btn-group.pull-right {
            display: flex; /* Use flexbox for button group alignment */
            align-items: center;
        }

        .btn-group.pull-right a {
            background: #475569 !important; /* Darker, more professional blue for back button */
            color: #FFFFFF !important;
            padding: 8px 18px !important; /* More padding */
            font-size: 14px !important; /* Slightly larger font */
            border-radius: 8px; /* Rounded corners for button */
            transition: background-color 0.3s ease, transform 0.2s ease;
            display: inline-flex; /* Allows icon and text to align */
            align-items: center;
            gap: 5px; /* Space between icon and text */
        }

        .btn-group.pull-right a:hover {
            background: #334155 !important; /* Darker hover */
            transform: translateY(-2px); /* Slight lift on hover */
        }

        .box-body {
            padding: 30px !important; /* Consistent padding inside the box body */
        }

        /* Student Profile Section (Desktop) */
        .sfborder-top-border.hidden-xs {
            display: flex; /* Use flexbox for better alignment */
            align-items: center; /* Vertically align items */
            padding: 20px; /* More padding around the whole section */
            background: linear-gradient(135deg, #e6f7ff, #cceeff); /* Light blue gradient background */
            border-radius: 12px; /* Rounded corners for the profile section */
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1); /* Enhanced shadow */
            margin-bottom: 20px;
            border: 1px solid #a8d9f1; /* Subtle border */
        }

        .sfborder-top-border.hidden-xs .col-md-2 {
            padding-right: 30px; /* More space between image and text */
            flex-shrink: 0; /* Prevent image column from shrinking */
        }

        .sfborder-top-border.hidden-xs img {
            border: 5px solid #6cb4e4; /* More prominent blue border for image */
            border-radius: 50% !important; /* Ensure perfect circle */
            box-shadow: 0 0 15px rgba(0, 123, 255, 0.4); /* Stronger glow effect for image */
            object-fit: cover; /* Ensure image covers the area without distortion */
            width: 130px; /* Slightly larger image */
            height: 130px; /* Slightly larger image */
        }

        .sfborder-top-border.hidden-xs .col-md-10 {
            padding-left: 0; /* Remove default padding as flex handles spacing */
            flex-grow: 1; /* Allow text column to grow */
        }

        /* Enhanced Student Profile Table */
        .sfborder-top-border.hidden-xs .table.table-striped.mb0.font13 {
            width: 100%;
            border-collapse: collapse; /* Use collapse for cleaner borders */
            margin-bottom: 0;
            font-size: 15px; /* Slightly larger font for details */
            background-color: rgba(255, 255, 255, 0.9); /* Slightly transparent white background */
            border-radius: 8px; /* Rounded corners for the table itself */
            overflow: hidden; /* Ensures rounded corners clip content */
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05); /* Subtle shadow for the table */
        }

        .sfborder-top-border.hidden-xs .table.table-striped.mb0.font13 th,
        .sfborder-top-border.hidden-xs .table.table-striped.mb0.font13 td {
            padding: 12px 18px; /* More consistent padding */
            border: 1px solid #dbe3eb; /* Lighter, more subtle borders for cells */
            vertical-align: middle;
        }

        .sfborder-top-border.hidden-xs .table.table-striped.mb0.font13 th {
            background-color: #f0f4f8; /* Light gray background for headers */
            color: #475569; /* Darker gray text color */
            font-weight: 700; /* Bolder headers */
            text-transform: capitalize; /* Capitalize instead of uppercase for softer look */
            font-size: 13px; /* Slightly larger header font */
            text-align: left; /* Align headers to left */
        }

        .sfborder-top-border.hidden-xs .table.table-striped.mb0.font13 td {
            color: #334155; /* Darker text for readability */
        }

        /* Ensure specific profile fields are well-aligned */
        .sfborder-top-border.hidden-xs .table.table-striped.mb0.font13 tr th:first-child {
            width: 180px; /* Increased fixed width for labels */
            font-weight: 700; /* Make labels bolder */
            color: #1e293b; /* Even darker color for labels */
        }
        .sfborder-top-border.hidden-xs .table.table-striped.mb0.font13 tr td:first-child {
            font-weight: normal; /* Ensure data is not bold */
        }

        /* Table for Fees Display */
        .table-fixed-header {
            border-radius: 12px;
            overflow: hidden; /* Ensures rounded corners */
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.05); /* Soft shadow for the main fees table */
            width: 100%; /* Ensure table takes full width */
            table-layout: auto; /* Changed to auto for better column width distribution */
        }

        .table-fixed-header thead th {
            background-color: #475569; /* Darker blue-gray for table header */
            color: #ffffff; /* White text */
            padding: 15px 20px; /* More padding */
            font-size: 13px;
            font-weight: 600;
            text-transform: uppercase;
            border-bottom: none; /* Remove default border */
            white-space: nowrap; /* Prevent header text from wrapping */
        }

        .table-fixed-header tbody tr {
            transition: background-color 0.2s ease;
        }

        .table-fixed-header tbody td {
            padding: 12px 20px; /* Consistent padding */
            border-top: 1px solid #e0e6ed; /* Subtle row separator */
            word-wrap: break-word; /* Allow long text to wrap */
        }

        .table-fixed-header tbody tr:first-child td {
            border-top: none; /* No top border for the first row */
        }

        /* Status Badges */
        .label-success, .label-warning, .label-danger {
            padding: 6px 12px; /* More generous padding */
            border-radius: 20px; /* Pill shape */
            font-weight: 600;
            font-size: 12px;
            text-transform: uppercase;
            display: inline-block; /* Ensure padding applies correctly */
            min-width: 70px; /* Ensure consistent width for badges */
            text-align: center;
        }

        .label-success {
            background-color: #10b981 !important; /* Tailwind green-500 */
            color: #ffffff !important;
        }

        .label-warning {
            background-color: #f59e0b !important; /* Tailwind amber-500 */
            color: #ffffff !important;
        }

        .label-danger {
            background-color: #ef4444 !important; /* Tailwind red-500 */
            color: #ffffff !important;
        }

        /* Highlighted Rows */
        .paid-fee-highlight {
            background-color: #f0fdf4 !important; /* Very light green */
        }

        .unpaid-fee-highlight {
            background-color: #fff7ed !important; /* Very light orange/red for immediate attention */
            border-left: 4px solid #f97316; /* Orange border on the left */
        }

        .dark-gray {
            background-color: #ffffff; /* Ensure white background for normal rows */
        }

        /* Pay Button within table */
        .btn.btn-xs.btn-primary.pull-right.dropdown-toggle,
        .btn.btn-sm.blink-red,
        .btn.btn-xs.btn-primary.pull-right.myCollectFeeBtn {
            padding: 8px 15px; /* More padding */
            border-radius: 8px; /* Rounded corners */
            font-size: 13px;
            font-weight: 600;
            transition: all 0.2s ease;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1); /* Subtle shadow */
            display: inline-flex; /* Align icon and text */
            align-items: center;
            gap: 5px; /* Space between icon and text */
        }

        .btn.btn-xs.btn-primary.pull-right.dropdown-toggle,
        .btn.btn-xs.btn-primary.pull-right.myCollectFeeBtn {
            background-color: #3b82f6 !important; /* Tailwind blue-500 */
            border-color: #3b82f6 !important;
            color: #ffffff !important;
        }

        .btn.btn-xs.btn-primary.pull-right.dropdown-toggle:hover,
        .btn.btn-xs.btn-primary.pull-right.myCollectFeeBtn:hover {
            background-color: #2563eb !important; /* Darker blue on hover */
            transform: translateY(-1px);
        }

        .blink-red {
            background-color: #f97316 !important; /* Tailwind orange-500 for blinking */
            border-color: #f97316 !important;
            color: #ffffff !important;
            animation: blinker-desktop 1s linear infinite; /* Desktop specific blink */
        }

        @keyframes blinker-desktop {
            50% {
                opacity: 0.7; /* Slightly less aggressive blink for desktop */
            }
        }

        .dropdown-menu {
            border-radius: 8px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.15);
            border: none;
            padding: 8px 0;
        }

        .dropdown-menu li a {
            padding: 10px 20px;
            font-size: 14px;
            color: #334155;
        }

        .dropdown-menu li a:hover {
            background-color: #f0f4f8;
            color: #1e3a8a;
        }

        /* Grand Total Row */
        .total-bg {
            background-color: #e2e8f0; /* Light gray background for total row */
            font-weight: 700;
            color: #1e293b;
            border-radius: 8px; /* Rounded corners */
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05); /* Subtle shadow */
            margin-top: 20px; /* More space above total row */
        }

        .total-bg td {
            padding: 15px 20px; /* More padding */
            font-size: 14px;
        }

        .total-bg .text-right {
            font-size: 15px; /* Slightly larger amount */
            color: #1e293b;
        }

        /* Print button */
        .printDoc {
            background-color: #e2e8f0 !important;
            border-color: #e2e8f0 !important;
            color: #475569 !important;
            border-radius: 6px;
            padding: 6px 10px;
            transition: background-color 0.2s ease, transform 0.2s ease;
            /* Unhide for desktop */
            display: inline-block !important; /* Ensure it's visible */
        }
        .printDoc:hover {
            background-color: #cbd5e1 !important;
            transform: translateY(-1px);
        }

        /* General table improvements for better spacing and alignment */
        .table th, .table td {
            white-space: nowrap; /* Prevent text wrapping in table headers and cells by default */
            overflow: hidden;
            text-overflow: ellipsis; /* Add ellipsis for overflowing text */
        }
        /* Allow specific columns to wrap if needed, e.g., description */
        .table-fixed-header tbody td:nth-child(7) { /* Payment ID column */
            white-space: normal; /* Allow wrapping for payment ID */
        }
        /* Adjust column widths for better visual balance based on screenshot */
        .table-fixed-header thead th:nth-child(1) { width: 40px; } /* # column */
        .table-fixed-header thead th:nth-child(2) { width: 90px; } /* Status column */
        .table-fixed-header thead th:nth-child(3) { width: 120px; } /* Fees Group column */
        .table-fixed-header thead th:nth-child(4) { width: 100px; } /* Fees Code column */
        .table-fixed-header thead th:nth-child(5) { width: 110px; } /* Due Date column */
        .table-fixed-header thead th:nth-child(6) { width: 100px; } /* Amount column */
        .table-fixed-header thead th:nth-child(7) { width: 120px; } /* Payment ID column */
        .table-fixed-header thead th:nth-child(8) { width: 80px; } /* Mode column */
        .table-fixed-header thead th:nth-child(9) { width: 100px; } /* Date column */
        .table-fixed-header thead th:nth-child(10) { width: 90px; } /* Discount column */
        .table-fixed-header thead th:nth-child(11) { width: 70px; } /* Fine column */
        .table-fixed-header thead th:nth-child(12) { width: 90px; } /* Paid column */
        .table-fixed-header thead th:nth-child(13) { width: 90px; } /* Balance column */
        /* Ensure the last column (actions) takes remaining space or has a minimum width */
        .table-fixed-header thead th:last-child { width: auto; min-width: 100px; }

        /* Fine-tune specific elements for a cleaner look */
        .table-fixed-header tbody .text-right img {
            vertical-align: middle; /* Align arrow image better */
            margin-right: 5px; /* Space between arrow and text */
        }
        /* Remove default border for table cells in the profile section */
        .table.table-striped.mb0.font13 td.bozero {
            border: none !important;
        }
        /* Add a subtle border to the overall profile table for better definition */
        .sfborder-top-border.hidden-xs .table {
            border: 1px solid #e0e6ed;
            border-radius: 8px;
            overflow: hidden; /* Ensure inner elements respect border-radius */
        }
        /* Adjust top padding for box-body to align with the screenshot */
        .box-body {
            padding-top: 20px !important; /* Slightly less top padding to match screenshot */
        }
        /* Ensure the horizontal divider is clean */
        .col-md-12 > div[style*="background: #dadada"] {
            margin-top: 20px; /* More space above the divider */
            margin-bottom: 20px; /* More space below the divider */
        }
        /* NEW/MODIFIED DESKTOP STYLES END HERE */
    }

<style>
    .grand-total-box {
        background-color: #0af0c2 !important;
        color: white !important;
        padding: 15px;
        border-radius: 10px;
        margin-top: 20px;
        box-shadow: 0 0 10px rgba(0,0,0,0.2);
        font-size: 18px;
        text-align: center;
    }
    .grand-total-box h4 {
        margin: 0;
        font-weight: bold;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

<style>
    .highlight-box {
        background-color: #e3f2fd;
        padding: 10px;
        border-left: 5px solid #2196f3;
        border-radius: 5px;
        margin-bottom: 10px;
        font-size: 16px;
    }
    .highlight-box strong {
        color: #0d47a1;
    }

<style>
    body {
        background-color: #f4f6f9 !important;
    }

    .panel.panel-default.fee-card {
        background-color: #ffffff;
        border: 1px solid #ddd;
        border-radius: 8px;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.05);
        padding: 15px;
        margin-bottom: 20px;
    }

<style>
    .pay-button-custom {
        background-color: #660066 !important;
        border-color: #660066 !important;
        color: white !important;
        font-weight: bold;
        border-radius: 6px;
        padding: 6px 14px;
    }
    .pay-button-custom:hover {
        background-color: #4b004b !important;
    }
</style>

</style>

</style>

</style>

</style>
<div class="content-wrapper">
    <div class="row">
        <div class="col-md-12">
            <section class="content-header">
                <h1>
                    <i class="fa fa-money"></i> <small></small>
                </h1>
            </section>
        </div>
    </div>
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header">
                        <div class="row">
                            <div class="col-md-4">
                                <h3 class="box-title"><?php echo $this->lang->line('student_fees'); ?></h3>
                            </div>
                            <div class="col-md-8 ">
                                <div class="btn-group pull-right">
                                    <a href="<?php echo base_url() ?>user/user/dashboard" type="button" style="background: #666699; color:#FFFFFF; padding:2px; font-size:12px">
                                        <i class="fa fa-arrow-left"></i> <?php echo $this->lang->line('back'); ?></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="box-body" style="padding-top:0;">
                        <div class="row">
                            <?php echo $this->session->flashdata('error');
                            $this->session->unset_userdata('error'); ?>
                            <?php if ($this->session->flashdata('msg')) {
                            ?>
                                <?php echo $this->session->flashdata('msg');
                                $this->session->unset_userdata('msg'); ?>
                            <?php } ?>
                            <div class="col-md-12">
                                <div class="sfborder-top-border visible-xs panel panel-info student-profile-card">
                                    <div class="panel-body">
                                        <div class="col-xs-4 text-center">
                                            <?php if ($sch_setting->student_photo) {
                                            ?>
                                                <img width="115" height="115" class="mt5 mb10 sfborder-img-shadow img-responsive img-circle student-photo" src="<?php
                                                if (!empty($student['image'])) {
                                                    echo base_url() . $student['image'] . img_time();
                                                } else {
                                                    echo base_url() . "uploads/student_images/no_image.png" . img_time();
                                                }
                                                ?>" alt="User profile picture">
                                            <?php
                                            } ?>
                                        </div>
                                        <div class="col-xs-8">
                                            <h4 class="student-name"><?php echo $this->customlib->getFullName($student['firstname'], $student['middlename'], $student['lastname'], $sch_setting->middlename, $sch_setting->lastname); ?></h4>
                                            <p><strong><?php echo $this->lang->line('class_section'); ?>:</strong> <?php echo $student['class'] . " (" . $student['section'] . ")" ?></p>
                                            <?php if ($sch_setting->admission_no) { ?>
                                                <p><strong><?php echo $this->lang->line('admission_no'); ?>:</strong> <?php echo $student['admission_no']; ?></p>
                                            <?php } ?>
                                            <?php if ($sch_setting->father_name) { ?>
                                                <p><strong><?php echo $this->lang->line('father_name'); ?>:</strong> <?php echo $student['father_name']; ?></p>
                                            <?php } ?>
                                            <?php if ($sch_setting->mobile_no) {
                                            ?>
                                                <p><strong><?php echo $this->lang->line('mobile_number'); ?>:</strong> <?php echo $student['mobileno']; ?></p>
                                            <?php } ?>
                                            <?php if ($sch_setting->roll_no) {
                                            ?>
                                                <p><strong><?php echo $this->lang->line('roll_number'); ?>:</strong> <?php echo $student['roll_no']; ?> </p>
                                            <?php } ?>
                                            <?php if ($sch_setting->category) {
                                            ?>
                                                <p><strong><?php echo $this->lang->line('category'); ?>:</strong>
                                                    <?php
                                                    foreach ($categorylist as $value) {
                                                        if ($student['category_id'] == $value['id']) {
                                                            echo $value['category'];
                                                        }
                                                    }
                                                    ?>
                                                </p>
                                            <?php } ?>
                                            <?php if ($sch_setting->rte) { ?>
                                                <p><strong><?php echo $this->lang->line('rte'); ?>:</strong> <b class="text-danger"> <?php echo $student['rte']; ?> </b></p>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="sfborder-top-border hidden-xs">
                                    <div class="col-md-2">
                                        <?php if ($sch_setting->student_photo) {
                                        ?>
                                            <img width="115" height="115" class="mt5 mb10 sfborder-img-shadow img-responsive img-rounded" src="<?php
                                            if (!empty($student['image'])) {
                                                echo base_url() . $student['image'] . img_time();
                                            } else {
                                                echo base_url() . "uploads/student_images/no_image.png" . img_time();
                                            }
                                            ?>" alt="User profile picture">
                                        <?php
                                        } ?>
                                    </div>
                                    <div class="col-md-10">
                                        <div class="row">
                                            <table class="table table-striped mb0 font13">
                                                <tbody>
                                                    <tr>
                                                        <th class="bozero"><?php echo $this->lang->line('name'); ?></th>
                                                        <td class="bozero"><?php echo $this->customlib->getFullName($student['firstname'], $student['middlename'], $student['lastname'], $sch_setting->middlename, $sch_setting->lastname); ?></td>
                                                        <th class="bozero"><?php echo $this->lang->line('class_section'); ?></th>
                                                        <td class="bozero"><?php echo $student['class'] . " (" . $student['section'] . ")" ?> </td>
                                                    </tr>
                                                    <tr>
                                                        <?php if ($sch_setting->father_name) { ?>
                                                            <th><?php echo $this->lang->line('father_name'); ?></th>
                                                            <td><?php echo $student['father_name']; ?></td>
                                                        <?php }
                                                        ?>
                                                        <th><?php echo $this->lang->line('admission_no'); ?></th>
                                                        <td><?php echo $student['admission_no']; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <?php if ($sch_setting->mobile_no) {
                                                        ?>
                                                            <th><?php echo $this->lang->line('mobile_number'); ?></th>
                                                            <td><?php echo $student['mobileno']; ?></td>
                                                        <?php }
                                                        if ($sch_setting->roll_no) { ?>
                                                            <th><?php echo $this->lang->line('roll_number'); ?></th>
                                                            <td> <?php echo $student['roll_no']; ?> </td>
                                                        <?php } ?>
                                                    </tr>
                                                    <tr>
                                                        <?php if ($sch_setting->category) {
                                                        ?>
                                                            <th><?php echo $this->lang->line('category'); ?></th>
                                                            <td>
                                                                <?php
                                                                foreach ($categorylist as $value) {
                                                                    if ($student['category_id'] == $value['id']) {
                                                                        echo $value['category'];
                                                                    }
                                                                }
                                                                ?>
                                                            </td>
                                                        <?php }
                                                        if ($sch_setting->rte) { ?>
                                                            <th><?php echo $this->lang->line('rte'); ?></th>
                                                            <td><b class="text-danger"> <?php echo $student['rte']; ?> </b>
                                                            </td>
                                                        <?php } ?>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div style="background: #dadada; height: 1px; width: 100%; clear: both; margin-bottom: 10px;"></div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <div class="download_label"><?php echo $this->lang->line('student_fees') . ": " . $student['firstname'] . " " . $student['lastname'] ?> </div>
                            <?php
                            if (empty($student_due_fee) && empty($transport_fees)) {
                            ?>
                                <div class="alert alert-danger">
                                    No fees Found.
                                </div>
                            <?php
                            } else {
                            ?>
                                <div class="fee-display-wrapper">
                                    <div class="hidden-xs">
                                        <table class="table table-striped table-bordered
                                        table-hover  table-fixed-header">
                                            <thead>
                                                <tr>
                                                    <th style="width: 10px">#</th>
                                                    <th align="left" class="text text-left"><?php echo $this->lang->line('status'); ?></th>
                                                    <th align="left" class="fees-group-code-style"><?php echo $this->lang->line('fees_group'); ?></th>
                                                    <th align="left" class="fees-group-code-style"><?php echo $this->lang->line('fees_code'); ?></th>
                                                    <th align="left" class="text text-center"><?php echo $this->lang->line('due_date'); ?></th>
                                                    <th class="text text-right"><?php echo $this->lang->line('amount') ?> <span><?php echo "(" . $currency_symbol . ")"; ?></span></th>
                                                    <th class="text text-left"><?php echo $this->lang->line('payment_id'); ?></th>
                                                    <th class="text text-left"><?php echo $this->lang->line('mode'); ?></th>
                                                    <th class="text text-left"><?php echo $this->lang->line('date'); ?></th>
                                                    <th class="text text-right"><?php echo $this->lang->line('discount'); ?> <span><?php echo "(" . $currency_symbol . ")"; ?></span></th>
                                                    <th class="text text-right"><?php echo $this->lang->line('fine'); ?> <span><?php echo "(" . $currency_symbol . ")"; ?></span></th>
                                                    <th class="text text-right"><?php echo $this->lang->line('paid'); ?> <span><?php echo "(" . $currency_symbol . ")"; ?></span></th>
                                                    <th class="text text-right"><?php echo $this->lang->line('balance'); ?> <span><?php echo "(" . $currency_symbol . ")"; ?></span></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $total_amount = 0;
                                                $total_deposite_amount = 0;
                                                $total_fine_amount = 0;
                                                $total_discount_amount = 0;
                                                $total_balance_amount = 0;
                                                $total_fees_fine_amount = 0;
                                                // NEW: Flag to check if there is *any* outstanding balance before enabling other payments
                                                $has_outstanding_balance = false;
                                                $first_unpaid_found = false;

                                                foreach ($student_due_fee as $key => $fee) {
                                                    foreach ($fee->fees as $fee_key => $fee_value) {
                                                        $fee_paid = 0;
                                                        $fee_discount = 0;
                                                        $fee_fine = 0;
                                                        $alot_fee_discount = 0;
                                                        if (!empty($fee_value->amount_detail)) {
                                                            $fee_deposits = json_decode(($fee_value->amount_detail));
                                                            foreach ($fee_deposits as $fee_deposits_key => $fee_deposits_value) {
                                                                $fee_paid = $fee_paid + $fee_deposits_value->amount;
                                                                $fee_discount = $fee_discount + $fee_deposits_value->amount_discount;
                                                                $fee_fine = $fee_fine + $fee_deposits_value->amount_fine;
                                                            }
                                                        }
                                                        if (($fee_value->due_date != "0000-00-00"
                                                            && $fee_value->due_date != null) && (strtotime($fee_value->due_date) < strtotime(date('Y-m-d')))) {
                                                            $total_fees_fine_amount = $total_fees_fine_amount + $fee_value->fine_amount;
                                                        }
                                                        if ($fee_discount == $fee_value->amount) {
                                                            $total_amount += $fee_value->amount;
                                                            $total_discount_amount += 0;
                                                            // $total_deposite_amount += $fee_discount;
                                                            $total_fine_amount += $fee_fine;
                                                            $feetype_balance = $fee_value->amount - ($fee_paid + $fee_discount);
                                                            $total_balance_amount += $feetype_balance;
                                                        } else {
                                                            $total_amount += $fee_value->amount;
                                                            $total_discount_amount += $fee_discount;
                                                            // $total_deposite_amount += $fee_paid;
                                                            $total_fine_amount += $fee_fine;
                                                            $feetype_balance = $fee_value->amount - ($fee_paid + $fee_discount);
                                                            $total_balance_amount += $feetype_balance;
                                                        }

                                                        $is_immediate_pay_button = false;
                                                        $pay_status = "";

                                                        // Check if there's any outstanding balance
                                                        if ($feetype_balance > 0) {
                                                            $has_outstanding_balance = true; // Set general flag if any fee has a balance
                                                        }

                                                        // Blinking logic and highlight for the *first* fee that has a balance (partially paid or unpaid)
                                                        // This assumes fees are ordered by due date or some logical payment order.
                                                        if ($feetype_balance > 0 && !$first_unpaid_found) {
                                                            $is_immediate_pay_button = true;
                                                            $first_unpaid_found = true;
                                                            $pay_status = ""; // Enable button for the first one
                                                        } else if ($feetype_balance > 0 && $first_unpaid_found) {
                                                            $pay_status = "disabled"; // Disable for subsequent fees with balance
                                                        }

                                                        $row_class = '';
                                                        if ($feetype_balance == 0) {
                                                            $row_class = 'paid-fee-highlight'; // Highlight if paid
                                                        } elseif ($feetype_balance > 0 && strtotime($fee_value->due_date) < strtotime(date('Y-m-d'))) {
                                                            $row_class = 'danger font12'; // Overdue fees
                                                        } else {
                                                            $row_class = 'dark-gray'; // Other fees
                                                        }

                                                        // Apply unpaid-fee-highlight only if it's the *first* outstanding fee (partial or full)
                                                        if ($is_immediate_pay_button) {
                                                            $row_class .= ' unpaid-fee-highlight';
                                                        }
                                                        ?>
                                                        <tr class="<?php echo $row_class; ?>">
                                                            <td> </td>
                                                            <td align="left" class="text text-left">
                                                                <?php
                                                                if ($feetype_balance == 0 || $fee_discount == $fee_value->amount || !empty($fee_discount)) {
                                                                ?><span class="label label-success"><?php echo $this->lang->line('paid'); ?></span><?php
                                                                                                        } else if (!empty($fee_value->amount_detail)) {
                                                                                                        ?><span class="label label-warning"><?php echo $this->lang->line('partial'); ?></span><?php
                                                                                                                                            } else {
                                                                                                                                            ?><span class="label label-danger"><?php echo $this->lang->line('unpaid'); ?></span><?php
                                                                                                                                                                                            }
                                                                                                                                                                                            ?>
                                                            </td>
                                                            <td align="left" class="text-rtl-right fees-group-code-style">
                                                                <?php
                                                                if ($fee_value->is_system) {
                                                                    echo $this->lang->line($fee_value->name) . " (" . $this->lang->line($fee_value->type) . ")";
                                                                } else {
                                                                    echo $fee_value->name . " (" . $fee_value->type . ")";
                                                                }
                                                                ?>
                                                            </td>
                                                            <td align="left" class="text-rtl-right fees-group-code-style">
                                                                <?php
                                                                if ($fee_value->is_system) {
                                                                    echo $this->lang->line($fee_value->code);
                                                                } else {
                                                                    echo $fee_value->code;
                                                                }
                                                                ?>
                                                            </td>
                                                            <td align="left" class="text text-center">
                                                                <?php
                                                                if ($fee_value->due_date) {
                                                                    echo date($this->customlib->getSchoolDateFormat(), $this->customlib->dateyyyymmddTodateformat($fee_value->due_date));
                                                                } else {
                                                                }
                                                                ?>
                                                            </td>
                                                            <td class="text text-right"><?php echo amountFormat($fee_value->amount);
                                                                                        if (($fee_value->due_date != "0000-00-00" && $fee_value->due_date != null) && (strtotime($fee_value->due_date) < strtotime(date('Y-m-d')))) {
                                                                                        ?>
                                                                    <span data-toggle="popover" class="text text-danger detail_popover"><?php echo " + " . (amountFormat($fee_value->fine_amount)); ?></span>
                                                                    <div class="fee_detail_popover" style="display: none">
                                                                        <?php
                                                                        if ($fee_value->fine_amount != "") {
                                                                        ?>
                                                                            <p class="text text-danger"><?php echo $this->lang->line('fine'); ?></p>
                                                                        <?php
                                                                        }
                                                                        ?>
                                                                    </div>
                                                                <?php
                                                                                        }
                                                                                        ?>
                                                            </td>
                                                            <td class="text text-left"></td>
                                                            <td class="text text-left"></td>
                                                            <td class="text text-left"></td>
                                                            <td class="text text-right">
                                                                <?php
                                                                if ($fee_discount == $fee_value->amount) {
                                                                    echo '0.00';
                                                                } else {
                                                                    echo amountFormat($fee_discount);
                                                                }
                                                                ?>
                                                            </td>
                                                            <td class="text text-right"><?php
                                                                                        echo amountFormat($fee_fine);
                                                                                        ?></td>
                                                            <td class="text text-right">
                                                                <?php
                                                                if ($fee_discount == $fee_value->amount) {
                                                                    echo amountFormat($fee_discount);
                                                                } else {
                                                                    echo amountFormat($fee_paid-$fee_discount);
                                                                }
                                                                ?>
                                                            </td>
                                                            <td class="text text-right">
                                                                <?php
                                                                $display_none = "ss-none";
                                                                if ($feetype_balance > 0) {
                                                                    $display_none = "";
                                                                    echo amountFormat($feetype_balance);
                                                                }
                                                                ?>
                                                            </td>
                                                        </tr>
                                                        <?php
                                                        // Display payment history
                                                        if (!empty($fee_value->amount_detail)) {
                                                            $fee_deposits = json_decode(($fee_value->amount_detail));
                                                            foreach ($fee_deposits as $fee_deposits_key => $fee_deposits_value) {
                                                        ?>
                                                                <tr class="white-td">
                                                                    <td align="left"></td>
                                                                    <td class="text">
                                                                        <button class="btn btn-xs btn-default printDoc" data-main_invoice="<?php echo $fee_value->student_fees_deposite_id ?>" data-sub_invoice="<?php echo $fee_deposits_value->inv_no ?>" data-fee-category="fees" title="<?php echo $this->lang->line('print'); ?>"><i class="fa fa-print"></i> </button>
                                                                    </td>
                                                                    <td align="left"></td>
                                                                    <td align="left"></td>
                                                                    <td align="left"></td>
                                                                    <td class="text-right"><img src="<?php echo base_url(); ?>backend/images/table-arrow.png" alt="" /></td>
                                                                    <td class="text text-left">
                                                                        <a href="#" data-toggle="popover" class="detail_popover"> <?php echo $fee_value->student_fees_deposite_id . "/" . $fee_deposits_value->inv_no; ?></a>
                                                                        <div class="fee_detail_popover" style="display: none">
                                                                            <?php
                                                                            if ($fee_deposits_value->description == "") {
                                                                            ?>
                                                                                <p class="text text-danger"><?php echo $this->lang->line('no_description'); ?></p>
                                                                            <?php
                                                                            } else {
                                                                            ?>
                                                                                <p class="text text-info"><?php echo $fee_deposits_value->description; ?></p>
                                                                            <?php
                                                                            }
                                                                            ?>
                                                                        </div>
                                                                    </td>
                                                                    <td class="text text-left"><?php echo $this->lang->line(strtolower($fee_deposits_value->payment_mode)); ?></td>
                                                                    <td class="text text-left">
                                                                        <?php echo date($this->customlib->getSchoolDateFormat(), $this->customlib->dateyyyymmddTodateformat($fee_deposits_value->date)); ?>
                                                                    </td>
                                                                    <td class="text text-right">
                                                                        <?php
                                                                        if ($fee_discount == $fee_value->amount) {
                                                                            echo '0.00';
                                                                        } else {
                                                                            echo amountFormat($fee_deposits_value->amount_discount);
                                                                        }
                                                                        ?>
                                                                    </td>
                                                                    <td class="text text-right"><?php
                                                                                                amountFormat($fee_deposits_value->amount_fine);
                                                                                                ?></td>
                                                                    <td class="text text-right">
                                                                        <?php
                                                                        if ($fee_discount == $fee_value->amount) {
                                                                            $total_deposite_amount = $total_deposite_amount+$fee_deposits_value->amount_discount;
                                                                            echo amountFormat($fee_deposits_value->amount_discount);
                                                                        } else {
                                                                            $total_deposite_amount = $total_deposite_amount+($fee_deposits_value->amount-$fee_deposits_value->amount_discount);
                                                                            echo amountFormat($fee_deposits_value->amount-$fee_deposits_value->amount_discount);
                                                                        }
                                                                        ?>
                                                                    </td>
                                                                    <td></td>
                                                                    <td class="text text-right">
                                                                        <button class="btn btn-xs btn-default printDoc" data-main_invoice="<?php echo $fee_value->student_fees_deposite_id ?>" data-sub_invoice="<?php echo $fee_deposits_value->inv_no ?>" data-fee-category="fees" title="<?php echo $this->lang->line('print'); ?>"><i class="fa fa-print"></i> </button>
                                                                    </td>
                                                                </tr>
                                                        <?php
                                                            }
                                                        }
                                                        ?>
                                                        <?php
                                                        // Display the "Pay Now" button for desktop only if there's a balance remaining
                                                        // The blinking logic for the button remains tied to "empty amount_detail"
                                                        if ($feetype_balance > 0) { ?>
                                                            <tr class="info font12">
                                                                <td class="text text-left"></td>
                                                                <td colspan="12">
                                                                    <div class="btn-group pull-right">
                                                                        <?php
                                                                        // Check if it's the first outstanding fee or if all previous outstanding fees are paid/partially paid
                                                                        $can_pay_current_fee = $is_immediate_pay_button || (!$is_immediate_pay_button && $first_unpaid_found == false);

                                                                        if ($payment_method && $sch_setting->is_offline_fee_payment) {
                                                                        ?>
                                                                            <form class="form_fees" action="<?php echo site_url('user/gateway/payment/pay'); ?>" method="POST">
                                                                                <input type="hidden" name="fee_category" value="fees">
                                                                                <input type="hidden" name="student_transport_fee_id" value="0">
                                                                                <input type="hidden" name="student_fees_master_id" value="<?php echo $fee->id; ?>">
                                                                                <input type="hidden" name="fee_groups_feetype_id" value="<?php echo $fee_value->fee_groups_feetype_id; ?>">
                                                                                <input type="hidden" name="student_id" value="<?php echo $student['id']; ?>">
                                                                                <input type="hidden" name="submit_mode" value="">
                                                                                <div class="dropdown">
                                                                                    <button class="btn btn-xs btn-primary pull-right dropdown-toggle" type="button" data-toggle="dropdown" <?php echo ($can_pay_current_fee) ? '' : 'disabled'; ?>><i class="fa fa-money"></i> <?php echo $this->lang->line('pay'); ?>
                                                                                        <span class="caret"></span> </button>
                                                                                    <ul class="dropdown-menu  dropdown-menu-right">
                                                                                        <li><a href="javascript:void(0)" onclick="submitform('online_payment',this)"><?php echo $this->lang->line('online_payment'); ?></a></li>
                                                                                        <li><a href="javascript:void(0)" onclick="submitform('offline_payment',this)"><?php echo $this->lang->line('offline_payment'); ?></a></li>
                                                                                    </ul>
                                                                                </div>
                                                                            </form>
                                                                        <?php
                                                                        } elseif ($payment_method) {
                                                                        ?>
                                                                            <form class="form_fees" action="<?php echo site_url('user/gateway/payment/pay'); ?>" method="POST">
                                                                                <input type="hidden" name="fee_category" value="fees">
                                                                                <input type="hidden" name="student_transport_fee_id" value="0">
                                                                                <input type="hidden" name="student_fees_master_id" value="<?php echo $fee->id; ?>">
                                                                                <input type="hidden" name="fee_groups_feetype_id" value="<?php echo $fee_value->fee_groups_feetype_id; ?>">
                                                                                <input type="hidden" name="student_id" value="<?php echo $student['id']; ?>">
                                                                                <input type="hidden" name="submit_mode" value="online_payment">
                                                                                <button type="submit" class="btn btn-sm <?php echo ($is_immediate_pay_button) ? 'blink-red' : 'btn-primary'; ?>" <?php echo ($can_pay_current_fee) ? '' : 'disabled'; ?>>
                                                                                    <i class="fa fa-money"></i> <?php echo $this->lang->line('pay'); ?> Fee : <i class="fa fa-inr"></i>
                                                                                    <?php
                                                                                    $display_none = "ss-none";
                                                                                    if ($feetype_balance > 0) {
                                                                                        $display_none = "";
                                                                                        echo amountFormat($feetype_balance);
                                                                                    }
                                                                                    ?></button>
                                                                            </form>
                                                                        <?php
                                                                        } elseif ($sch_setting->is_offline_fee_payment) {
                                                                        ?>
                                                                            <form class="form_fees" action="<?php echo site_url('user/gateway/payment/pay');
                                                                                                            ?>" method="POST">
                                                                                <input type="hidden" name="fee_category" value="fees">
                                                                                <input type="hidden" name="student_transport_fee_id" value="0">
                                                                                <input type="hidden" name="student_fees_master_id" value="<?php echo $fee->id; ?>">
                                                                                <input type="hidden" name="fee_groups_feetype_id" value="<?php echo $fee_value->fee_groups_feetype_id; ?>">
                                                                                <input type="hidden" name="student_id" value="<?php echo $student['id']; ?>">
                                                                                <input type="hidden" name="submit_mode" value="offline_payment">
                                                                                <button type="submit" class="btn btn-xs btn-primary pull-right myCollectFeeBtn" <?php echo ($can_pay_current_fee) ? '' : 'disabled'; ?>><i class="fa fa-money"></i> <?php echo $this->lang->line('pay'); ?> </button>
                                                                            </form>
                                                                        <?php
                                                                        }
                                                                        ?>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        <?php } ?>
                                                <?php
                                                    }
                                                }
                                                ?>
                                                <?php
                                                if (!empty($transport_fees)) {
                                                    foreach ($transport_fees as $transport_fee_key => $transport_fee_value) {
                                                        $fee_paid = 0;
                                                        $fee_discount = 0;
                                                        $fee_fine = 0;
                                                        $fees_fine_amount = 0;
                                                        $feetype_balance = 0;
                                                        if (!empty($transport_fee_value->amount_detail)) {
                                                            $fee_deposits = json_decode(($transport_fee_value->amount_detail));
                                                            foreach ($fee_deposits as $fee_deposits_key => $fee_deposits_value) {
                                                                $fee_paid = $fee_paid + $fee_deposits_value->amount;
                                                                $fee_discount = $fee_discount + $fee_deposits_value->amount_discount;
                                                                $fee_fine = $fee_fine + $fee_deposits_value->amount_fine;
                                                            }
                                                        }
                                                        $feetype_balance = $transport_fee_value->fees - ($fee_paid + $fee_discount);
                                                        if (($transport_fee_value->due_date != "0000-00-00" && $transport_fee_value->due_date != null) && (strtotime($transport_fee_value->due_date) < strtotime(date('Y-m-d')))) {
                                                            $fees_fine_amount = is_null($transport_fee_value->fine_percentage) ? $transport_fee_value->fine_amount : percentageAmount($transport_fee_value->fees, $transport_fee_value->fine_percentage);
                                                            $total_fees_fine_amount = $total_fees_fine_amount + $fees_fine_amount;
                                                        }
                                                        $total_amount += $transport_fee_value->fees;
                                                        $total_discount_amount += $fee_discount;
                                                        // $total_deposite_amount += $fee_paid;
                                                        $total_fine_amount += $fee_fine;
                                                        $total_balance_amount += $feetype_balance;
                                                        $row_class = '';
                                                        if ($feetype_balance == 0) {
                                                            $row_class = 'paid-fee-highlight'; // Highlight if paid
                                                        } elseif (strtotime($transport_fee_value->due_date) < strtotime(date('Y-m-d'))) {
                                                            $row_class = 'danger font12'; // Overdue fees
                                                        } else {
                                                            $row_class = 'dark-gray'; // Other fees
                                                        }

                                                        $is_immediate_pay_button_transport = false;
                                                        $pay_status_transport = "";

                                                        // Check if there's any outstanding balance
                                                        if ($feetype_balance > 0) {
                                                            $has_outstanding_balance = true; // Set general flag if any fee has a balance
                                                        }

                                                        // Blinking logic and highlight for the *first* fee that has a balance (partially paid or unpaid)
                                                        if ($feetype_balance > 0 && !$first_unpaid_found) {
                                                            $is_immediate_pay_button_transport = true;
                                                            $first_unpaid_found = true;
                                                            $pay_status_transport = "";
                                                        } else if ($feetype_balance > 0 && $first_unpaid_found) {
                                                            $pay_status_transport = "disabled";
                                                        }

                                                        // Apply unpaid-fee-highlight only if it's the *first* outstanding fee
                                                        if ($is_immediate_pay_button_transport) {
                                                            $row_class .= ' unpaid-fee-highlight';
                                                        }
                                                ?>
                                                        <tr class="<?php echo $row_class; ?>">
                                                            <td>
                                                                <input class="checkbox" type="checkbox" name="fee_checkbox" data-fee_master_id="0" data-fee_session_group_id="0" data-fee_groups_feetype_id="0" data-fee_category="transport" data-trans_fee_id="<?php echo $transport_fee_value->id; ?>">
                                                            </td>
                                                            <td align="left" class="text-rtl-right"><?php echo $this->lang->line('transport_fees'); ?></td>
                                                            <td align="left" class="text-rtl-right fees-group-code-style"><?php echo $transport_fee_value->month; ?></td>
                                                            <td align="left" class="text text-left fees-group-code-style">
                                                                <?php echo $this->customlib->dateformat($transport_fee_value->due_date);
                                                                ?> </td>
                                                            <td align="left" class="text text-left width85">
                                                                <?php
                                                                if ($feetype_balance == 0) {
                                                                ?><span class="label label-success"><?php echo $this->lang->line('paid'); ?></span><?php
                                                                                                        } else if (!empty($transport_fee_value->amount_detail)) {
                                                                                                        ?><span class="label label-warning"><?php echo $this->lang->line('partial'); ?></span><?php
                                                                                                                                            } else {
                                                                                                                                            ?><span class="label label-danger"><?php echo $this->lang->line('unpaid'); ?></span><?php
                                                                                                                                                                                            }
                                                                                                                                                                                            ?>
                                                            </td>
                                                            <td class="text text-right"><?php echo amountFormat($transport_fee_value->fees);
                                                                                        if (($transport_fee_value->due_date != "0000-00-00" && $transport_fee_value->due_date != null) && (strtotime($transport_fee_value->due_date) < strtotime(date('Y-m-d')))) {
                                                                                            $tr_fine_amount = $transport_fee_value->fine_amount;
                                                                                            if ($transport_fee_value->fine_type != "" && $transport_fee_value->fine_type == "percentage") {
                                                                                                $tr_fine_amount = percentageAmount($transport_fee_value->fees, $transport_fee_value->fine_percentage);
                                                                                            }
                                                                                        ?>
                                                                    <span data-toggle="popover" class="text text-danger detail_popover"><?php echo " + " . (amountFormat($tr_fine_amount)); ?></span>
                                                                    <div class="fee_detail_popover" style="display: none">
                                                                        <p class="text text-danger"><?php echo $this->lang->line('fine'); ?></p>
                                                                    </div>
                                                                <?php
                                                                                        }
                                                                                        ?>
                                                            </td>
                                                            <td class="text text-left"></td>
                                                            <td class="text text-left"></td>
                                                            <td class="text text-left"></td>
                                                            <td class="text text-right">
                                                                <?php 
                                                                if($fee_discount == $fee_paid){
                                                                    echo "0.00";
                                                                }else{
                                                                    echo amountFormat($fee_discount);
                                                                }
                                                                 ?>
                                                            </td>
                                                            <td class="text text-right">
                                                                <?php echo amountFormat($fee_fine); ?>
                                                            </td>
                                                            <td class="text text-right">
                                                                <?php 
                                                                if($fee_discount == $fee_paid){
                                                                    $total_deposite_amount = $total_deposite_amount+$fee_paid;
                                                                    echo amountFormat($fee_paid);
                                                                }else{
                                                                    $total_deposite_amount = $total_deposite_amount+($fee_paid-$fee_discount);
                                                                    echo amountFormat($fee_paid-$fee_discount);
                                                                }
                                                                 ?>
                                                            </td>
                                                            <td class="text text-right">
                                                                <?php
                                                                $display_none = "ss-none";
                                                                if ($feetype_balance > 0) {
                                                                    $display_none = "";
                                                                    echo amountFormat($feetype_balance);
                                                                }
                                                                ?>
                                                            </td>
                                                            <td>
                                                                <?php
                                                                // Display the "Pay Now" button for desktop only if there's a balance remaining
                                                                // The blinking logic for the button remains tied to "empty amount_detail"
                                                                if ($feetype_balance > 0) {
                                                                    // Check if it's the first outstanding fee or if all previous outstanding fees are paid/partially paid
                                                                    $can_pay_current_fee_transport = $is_immediate_pay_button_transport || (!$is_immediate_pay_button_transport && $first_unpaid_found == false);

                                                                    if ($payment_method && $sch_setting->is_offline_fee_payment) {
                                                                ?>
                                                                        <form class="form_fees" action="<?php echo site_url('user/gateway/payment/pay'); ?>" method="POST">
                                                                            <input type="hidden" name="fee_category" value="transport">
                                                                            <input type="hidden" name="student_transport_fee_id" value="<?php echo $transport_fee_value->id; ?>">
                                                                            <input type="hidden" name="student_fees_master_id" value="0">
                                                                            <input type="hidden" name="fee_groups_feetype_id" value="0">
                                                                            <input type="hidden" name="student_id" value="<?php echo $student['id']; ?>">
                                                                            <input type="hidden" name="submit_mode" value="">
                                                                            <div class="dropdown">
                                                                                <button class="btn btn-xs btn-primary pull-right dropdown-toggle" type="button" data-toggle="dropdown" <?php echo ($can_pay_current_fee_transport) ? '' : 'disabled'; ?>><i class="fa fa-money"></i> <?php echo $this->lang->line('pay'); ?>
                                                                                    <span class="caret"></span></button>
                                                                                <ul class="dropdown-menu  dropdown-menu-right">
                                                                                    <li><a href="javascript:void(0)" onclick="submitform('online_payment',this)"><?php echo $this->lang->line('online_payment'); ?></a></li>
                                                                                    <li><a href="javascript:void(0)" onclick="submitform('offline_payment',this)"><?php echo $this->lang->line('offline_payment'); ?></a></li>
                                                                                </ul>
                                                                            </div>
                                                                        </form>
                                                                    <?php
                                                                    } elseif ($payment_method) {
                                                                    ?>
                                                                        <form class="form_fees" action="<?php echo site_url('user/gateway/payment/pay'); ?>" method="POST">
                                                                            <input type="hidden" name="fee_category" value="transport">
                                                                            <input type="hidden" name="student_transport_fee_id" value="<?php echo $transport_fee_value->id; ?>">
                                                                            <input type="hidden" name="student_fees_master_id" value="0">
                                                                            <input type="hidden" name="fee_groups_feetype_id" value="0">
                                                                            <input type="hidden" name="student_id" value="<?php echo $student['id']; ?>">
                                                                            <input type="hidden" name="submit_mode" value="online_payment">
                                                                            <button type="submit" class="btn btn-xs pull-right myCollectFeeBtn <?php echo ($is_immediate_pay_button_transport) ? 'blink-red' : 'btn-primary'; ?>" <?php echo ($can_pay_current_fee_transport) ? '' : 'disabled'; ?>><i class="fa fa-money"></i> <?php echo $this->lang->line('pay');
                                                                                                                                                                                                                                                                                                                                    ?></button>
                                                                        </form>
                                                                    <?php
                                                                    } elseif ($sch_setting->is_offline_fee_payment) {
                                                                    ?>
                                                                        <form class="form_fees" action="<?php echo site_url('user/gateway/payment/pay'); ?>" method="POST">
                                                                            <input type="hidden" name="fee_category" value="transport">
                                                                            <input type="hidden" name="student_transport_fee_id" value="<?php echo $transport_fee_value->id; ?>">
                                                                            <input type="hidden" name="student_fees_master_id" value="0">
                                                                            <input type="hidden" name="fee_groups_feetype_id" value="0">
                                                                            <input type="hidden" name="student_id" value="<?php echo $student['id']; ?>">
                                                                            <input type="hidden" name="submit_mode" value="offline_payment">
                                                                            <button type="submit" class="btn btn-xs btn-primary pull-right myCollectFeeBtn" <?php echo ($can_pay_current_fee_transport) ? '' : 'disabled'; ?>><i class="fa fa-money"></i> <?php echo $this->lang->line('pay');
                                                                                                                                                                                                                                                                                                                                ?></button>
                                                                        </form>
                                                                <?php
                                                                    }
                                                                }
                                                                ?>
                                                            </td>
                                                        </tr>
                                                        <?php
                                                        // Display payment history
                                                        if (!empty($transport_fee_value->amount_detail)) {
                                                            $fee_deposits = json_decode(($transport_fee_value->amount_detail));
                                                            foreach ($fee_deposits as $fee_deposits_key => $fee_deposits_value) {
                                                        ?>
                                                                <tr class="white-td">
                                                                    <td align="left"></td>
                                                                    <td align="left"></td>
                                                                    <td align="left"></td>
                                                                    <td align="left"></td>
                                                                    <td align="left"></td>
                                                                    <td class="text-right"><img src="<?php echo base_url(); ?>backend/images/table-arrow.png" alt="" /></td>
                                                                    <td class="text text-left">
                                                                        <a href="#" data-toggle="popover" class="detail_popover"> <?php echo $transport_fee_value->student_fees_deposite_id . "/" . $fee_deposits_value->inv_no; ?></a>
                                                                        <div class="fee_detail_popover" style="display: none">
                                                                            <?php
                                                                            if ($fee_deposits_value->description == "") {
                                                                            ?>
                                                                                <p class="text text-danger"><?php echo $this->lang->line('no_description'); ?></p>
                                                                            <?php
                                                                            } else {
                                                                            ?>
                                                                                <p class="text text-info"><?php echo $fee_deposits_value->description; ?></p>
                                                                            <?php
                                                                            }
                                                                            ?>
                                                                        </div>
                                                                    </td>
                                                                    <td class="text text-left"><?php echo $this->lang->line(strtolower($fee_deposits_value->payment_mode)); ?></td>
                                                                    <td class="text text-left">
                                                                        <?php echo date($this->customlib->getSchoolDateFormat(), $this->customlib->dateyyyymmddTodateformat($fee_deposits_value->date)); ?>
                                                                    </td>
                                                                    <td class="text text-right"><?php 
                                                                    if($fee_deposits_value->amount_discount == $fee_deposits_value->amount){
                                                                        echo "0.00";
                                                                    }else{
                                                                        echo amountFormat($fee_deposits_value->amount_discount);
                                                                    }
                                                                    //echo amountFormat($fee_deposits_value->amount_discount); ?></td>
                                                                    <td class="text text-right"><?php echo amountFormat($fee_deposits_value->amount_fine); ?></td>
                                                                    <td class="text text-right"><?php
                                                                    if($fee_deposits_value->amount_discount == $fee_deposits_value->amount){
                                                                        echo amountFormat($fee_deposits_value->amount);
                                                                    }else{
                                                                        echo amountFormat($fee_deposits_value->amount-$fee_deposits_value->amount_discount);
                                                                    }
                                                                    
                                                                    ?></td>
                                                                    <td></td>
                                                                    <td class="text text-right">
                                                                        <button class="btn btn-xs btn-default printDoc" data-main_invoice="<?php echo $transport_fee_value->student_fees_deposite_id ?>" data-sub_invoice="<?php echo $fee_deposits_value->inv_no ?>" data-fee-category="transport" title="<?php echo $this->lang->line('print'); ?>"><i class="fa fa-print"></i> </button>
                                                                    </td>
                                                                </tr>
                                                        <?php
                                                            }
                                                        }
                                                        ?>
                                                <?php
                                                    }
                                                }
                                                ?>
                                                <tr class="box box-solid total-bg">
                                                    <td align="left"></td>
                                                    <td align="left"></td>
                                                    <td align="left"></td>
                                                    <td align="left"></td>
                                                    <td align="left" class="text text-left"><?php echo $this->lang->line('grand_total'); ?></td>
                                                    <td class="text text-right">
                                                        <?php
                                                        echo $currency_symbol . amountFormat($total_amount);
                                                        ?>
                                                        <span data-toggle="popover" class="text text-danger detail_popover"><?php echo " + " . (amountFormat($total_fees_fine_amount)); ?></span>
                                                        <div class="fee_detail_popover" style="display: none">
                                                            <p class="text text-danger"><?php echo $this->lang->line('fine'); ?></p>
                                                        </div>
                                                    </td>
                                                    <td class="text text-left"></td>
                                                    <td class="text text-left"></td>
                                                    <td class="text text-left"></td>
                                                    <td class="text text-right"><?php
                                                                                echo $currency_symbol . amountFormat($total_discount_amount);
                                                                                ?></td>
                                                    <td class="text text-right"><?php
                                                                                echo $currency_symbol . amountFormat($total_fine_amount);
                                                                                ?></td>
                                                    <td class="text text-right"><?php
                                                                                echo $currency_symbol . amountFormat($total_deposite_amount);
                                                                                ?></td>
                                                    <td class="text text-right"><?php
                                                    echo $currency_symbol . amountFormat(($total_fees_fine_amount+$total_amount)-($total_discount_amount+$total_deposite_amount));
                                                                                //echo $currency_symbol . amountFormat($total_balance_amount);
                                                                                ?></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="visible-xs">
                                        <?php
                                        $total_amount_mobile = 0; // Separate totals for mobile display logic
                                        $total_deposite_amount_mobile = 0;
                                        $total_fine_amount_mobile = 0;
                                        $total_discount_amount_mobile = 0;
                                        $total_balance_amount_mobile = 0;
                                        $total_fees_fine_amount_mobile = 0;
                                        $first_unpaid_found_mobile = false;

                                        foreach ($student_due_fee as $key => $fee) {
                                            foreach ($fee->fees as $fee_key => $fee_value) {
                                                $fee_paid = 0;
                                                $fee_discount = 0;
                                                $fee_fine = 0;
                                                $alot_fee_discount = 0;
                                                $last_invoice_no = ''; // Initialize
                                                if (!empty($fee_value->amount_detail)) {
                                                    $fee_deposits = json_decode(($fee_value->amount_detail));
                                                    foreach ($fee_deposits as $fee_deposits_key => $fee_deposits_value) {
                                                        $fee_paid += $fee_deposits_value->amount;
                                                        $fee_discount += $fee_deposits_value->amount_discount;
                                                        $fee_fine += $fee_deposits_value->amount_fine;
                                                        $last_invoice_no = $fee_deposits_value->inv_no; // Keep track of the last invoice for print button
                                                    }
                                                }
                                                if (($fee_value->due_date != "0000-00-00" && $fee_value->due_date != null) && (strtotime($fee_value->due_date) < strtotime(date('Y-m-d')))) {
                                                    $total_fees_fine_amount_mobile += $fee_value->fine_amount;
                                                }
                                                if ($fee_discount == $fee_value->amount) {
                                                    $total_amount_mobile += $fee_value->amount;
                                                    $total_discount_amount_mobile += 0;
                                                    // $total_deposite_amount_mobile += $fee_discount;
                                                    $total_fine_amount_mobile += $fee_fine;
                                                    $feetype_balance = $fee_value->amount - ($fee_paid + $fee_discount);
                                                    $total_balance_amount_mobile += $feetype_balance;
                                                } else {
                                                    $total_amount_mobile += $fee_value->amount;
                                                    $total_discount_amount_mobile += $fee_discount;
                                                    // $total_deposite_amount_mobile += $fee_paid;
                                                    $total_fine_amount_mobile += $fee_fine;
                                                    $feetype_balance = $fee_value->amount - ($fee_paid + $fee_discount);
                                                    $total_balance_amount_mobile += $feetype_balance;
                                                }
                                                // Determine status
                                                $status = '';
                                                $status_class = '';
                                                if ($feetype_balance == 0 || $fee_discount == $fee_value->amount || !empty($fee_discount)) {
                                                    $status = $this->lang->line('paid');
                                                    $status_class = 'success';
                                                } else if (!empty($fee_value->amount_detail)) {
                                                    $status = $this->lang->line('partial');
                                                    $status_class = 'warning';
                                                } else {
                                                    $status = $this->lang->line('unpaid');
                                                    $status_class = 'danger';
                                                }
                                                $is_overdue = ($feetype_balance > 0 && strtotime($fee_value->due_date) < strtotime(date('Y-m-d')));

                                                // Logic for immediate pay button for mobile view - only for first fee with a balance
                                                $is_immediate_pay_button_mobile = false;
                                                $pay_status = "";

                                                if ($feetype_balance > 0 && !$first_unpaid_found_mobile) {
                                                    $is_immediate_pay_button_mobile = true;
                                                    $first_unpaid_found_mobile = true;
                                                    $pay_status = ""; // Enable button for the first one
                                                } else if ($feetype_balance > 0 && $first_unpaid_found_mobile) {
                                                    $pay_status = "disabled"; // Disable for subsequent fees with balance
                                                }

                                                $fee_card_class = "panel-default"; // Default panel class
                                                if ($is_overdue) {
                                                    $fee_card_class = "panel-danger"; // Overdue fees are danger
                                                }

                                                // Apply unpaid-fee-highlight only if it's the *first* outstanding fee
                                                if ($is_immediate_pay_button_mobile) {
                                                    $fee_card_class = "panel-primary unpaid-fee-highlight";
                                                }
                                        ?>
                                                <div class="panel <?php echo $fee_card_class; ?> fee-card <?php echo ($feetype_balance == 0) ? 'paid-fee-highlight' : ''; ?>">
                                                    <div class="panel-heading" style="background-color: #e6f7ff; border-color: #b3e0ff;">
                                                        <h3 class="panel-title" style="    display: flex;    justify-content: space-between;">
                                                            <?php
                                                            if ($fee_value->is_system) {
                                                                echo $this->lang->line($fee_value->name) . " (" . $this->lang->line($fee_value->type) . ")";
                                                            } else {
                                                                echo $fee_value->name . " (" . $fee_value->type . ")";
                                                            }
                                                            ?>
                                                            <div style="display: flex; justify-content: end;gap: 10px;">
                                                                <span class="label label-<?php echo $status_class; ?> pull-right"><?php echo $status; ?></span>
                                                                <?php if (!empty($fee_value->amount_detail)) { ?>
                                                                    <button class="btn btn-xs btn-default printDoc"
                                                                        data-main_invoice="<?php echo $fee_value->student_fees_deposite_id ?>"
                                                                        data-sub_invoice="<?php echo $last_invoice_no ?>"
                                                                        data-fee-category="fees"
                                                                        title="<?php echo $this->lang->line('print'); ?>">
                                                                        <i class="fa fa-print"></i>
                                                                    </button>
                                                                <?php } ?>
                                                            </div>
                                                        </h3>
                                                    </div>
                                                    <div class="panel-body">
                                                        <div class="row fee-row">
                                                            <div class="col-xs-6">
                                                                <strong><?php echo $this->lang->line('fees_code'); ?>:</strong>
                                                            </div>
                                                            <div class="col-xs-6 text-right fees-group-code-style">
                                                                <?php echo $fee_value->is_system ? $this->lang->line($fee_value->code) : $fee_value->code; ?>
                                                            </div>
                                                        </div>
                                                        <div class="row fee-row">
                                                            <div class="col-xs-6">
                                                                <strong><?php echo $this->lang->line('due_date'); ?>:</strong>
                                                            </div>
                                                            <div class="col-xs-6 text-right">
                                                                <?php echo $fee_value->due_date ? date($this->customlib->getSchoolDateFormat(), $this->customlib->dateyyyymmddTodateformat($fee_value->due_date)) : ''; ?>
                                                            </div>
                                                        </div>
                                                        <div class="row fee-row">
                                                            <div class="col-xs-6">
                                                                <strong><?php echo $this->lang->line('amount'); ?>:</strong>
                                                            </div>
                                                            <div class="col-xs-6 text-right">
                                                                <?php echo amountFormat($fee_value->amount); ?>
                                                                <?php if (($fee_value->due_date != "0000-00-00" && $fee_value->due_date != null) && (strtotime($fee_value->due_date) < strtotime(date('Y-m-d')))) : ?>
                                                                    <span class="text-danger">+<?php echo amountFormat($fee_value->fine_amount); ?></span>
                                                                <?php endif; ?>
                                                            </div>
                                                        </div>
                                                        <div class="row fee-row">
                                                            <div class="col-xs-6">
                                                                <strong><?php echo $this->lang->line('discount'); ?>:</strong>
                                                            </div>
                                                            <div class="col-xs-6 text-right">
                                                                <?php echo ($fee_discount == $fee_value->amount) ? '0.00' : amountFormat($fee_discount); ?>
                                                            </div>
                                                        </div>
                                                        <div class="row fee-row">
                                                            <div class="col-xs-6">
                                                                <strong><?php echo $this->lang->line('fine'); ?>:</strong>
                                                            </div>
                                                            <div class="col-xs-6 text-right">
                                                                <?php echo amountFormat($fee_fine); ?>
                                                            </div>
                                                        </div>
                                                        <div class="row fee-row">
                                                            <div class="col-xs-6">
                                                                <strong><?php echo $this->lang->line('paid'); ?>:</strong>
                                                            </div>
                                                            <div class="col-xs-6 text-right">
                                                                <?php if($fee_discount == $fee_value->amount){
                                                                    $total_deposite_amount_mobile = $total_deposite_amount_mobile+$fee_discount;
                                                                echo  amountFormat($fee_discount);
                                                                }else{ 
                                                                    $total_deposite_amount_mobile = $total_deposite_amount_mobile+($fee_paid-$fee_discount);
                                                                    echo amountFormat($fee_paid-$fee_discount); 
                                                                }?>
                                                            </div>
                                                        </div>
                                                        <div class="row fee-row">
                                                            <div class="col-xs-6">
                                                                <strong><?php echo $this->lang->line('balance'); ?>:</strong>
                                                            </div>
                                                            <div class="col-xs-6 text-right">
                                                                <?php if ($feetype_balance > 0) echo amountFormat($feetype_balance); ?>
                                                            </div>
                                                        </div>
                                                        <?php
                                                        // Display the "Pay Now" button for mobile if there's a balance remaining
                                                        if ($feetype_balance > 0) : ?>
                                                            <div class="row payment-actions">
                                                                <div class="col-xs-12">
                                                                    <?php
                                                                    // Check if it's the first outstanding fee or if all previous outstanding fees are paid/partially paid
                                                                    $can_pay_current_fee_mobile = $is_immediate_pay_button_mobile || (!$is_immediate_pay_button_mobile && $first_unpaid_found_mobile == false);

                                                                    if ($payment_method && $sch_setting->is_offline_fee_payment) { ?>
                                                                        <form class="form_fees" action="<?php echo site_url('user/gateway/payment/pay'); ?>" method="POST">
                                                                            <input type="hidden" name="fee_category" value="fees">
                                                                            <input type="hidden" name="student_transport_fee_id" value="0">
                                                                            <input type="hidden" name="student_fees_master_id" value="<?php echo $fee->id; ?>">
                                                                            <input type="hidden" name="fee_groups_feetype_id" value="<?php echo $fee_value->fee_groups_feetype_id; ?>">
                                                                            <input type="hidden" name="student_id" value="<?php echo $student['id']; ?>">
                                                                            <input type="hidden" name="submit_mode" value="">
                                                                            <div class="dropdown">
                                                                                <button class="btn btn-primary btn-sm btn-block dropdown-toggle" type="button" data-toggle="dropdown" <?php echo ($can_pay_current_fee_mobile) ? '' : 'disabled'; ?>><i class="fa fa-money"></i> <?php echo $this->lang->line('pay'); ?>
                                                                                    <span class="caret"></span></button>
                                                                                <ul class="dropdown-menu  dropdown-menu-right">
                                                                                    <li><a href="javascript:void(0)" onclick="submitform('online_payment',this)"><?php echo $this->lang->line('online_payment'); ?></a></li>
                                                                                    <li><a href="javascript:void(0)" onclick="submitform('offline_payment',this)"><?php echo $this->lang->line('offline_payment'); ?></a></li>
                                                                                </ul>
                                                                            </div>
                                                                        </form>
                                                                    <?php } elseif ($payment_method) { ?>
                                                                        <form class="form_fees" action="<?php echo site_url('user/gateway/payment/pay'); ?>" method="POST">
                                                                            <input type="hidden" name="fee_category" value="fees">
                                                                            <input type="hidden" name="student_transport_fee_id" value="0">
                                                                            <input type="hidden" name="student_fees_master_id" value="<?php echo $fee->id; ?>">
                                                                            <input type="hidden" name="fee_groups_feetype_id" value="<?php echo $fee_value->fee_groups_feetype_id; ?>">
                                                                            <input type="hidden" name="student_id" value="<?php echo $student['id']; ?>">
                                                                            <input type="hidden" name="submit_mode" value="online_payment">
                                                                            <button type="submit" class="btn btn-sm btn-block <?php echo ($is_immediate_pay_button_mobile) ? 'blink-red' : 'btn-primary'; ?>" <?php echo ($can_pay_current_fee_mobile) ? '' : 'disabled'; ?>>
                                                                                <i class="fa fa-money"></i> <?php echo $this->lang->line('pay'); ?> Fee : <?php echo $currency_symbol; ?>
                                                                                <?php if ($feetype_balance > 0) echo amountFormat($feetype_balance); ?>
                                                                            </button>
                                                                        </form>
                                                                    <?php } elseif ($sch_setting->is_offline_fee_payment) { ?>
                                                                        <form class="form_fees" action="<?php echo site_url('user/gateway/payment/pay'); ?>" method="POST">
                                                                            <input type="hidden" name="fee_category" value="fees">
                                                                            <input type="hidden" name="student_transport_fee_id" value="0">
                                                                            <input type="hidden" name="student_fees_master_id" value="<?php echo $fee->id; ?>">
                                                                            <input type="hidden" name="fee_groups_feetype_id" value="<?php echo $fee_value->fee_groups_feetype_id; ?>">
                                                                            <input type="hidden" name="student_id" value="<?php echo $student['id']; ?>">
                                                                            <input type="hidden" name="submit_mode" value="offline_payment">
                                                                            <button type="submit" class="btn btn-primary btn-sm btn-block myCollectFeeBtn" <?php echo ($can_pay_current_fee_mobile) ? '' : 'disabled'; ?>><i class="fa fa-money"></i> <?php echo $this->lang->line('pay'); ?> </button>
                                                                        </form>
                                                                    <?php } ?>
                                                                </div>
                                                            </div>
                                                        <?php endif; ?>
                                                    </div>
                                                </div>
                                        <?php
                                            }
                                        }
                                        ?>
                                        <?php
                                        if (!empty($transport_fees)) {
                                            foreach ($transport_fees as $transport_fee_key => $transport_fee_value) {
                                                $fee_paid = 0;
                                                $fee_discount = 0;
                                                $fee_fine = 0;
                                                $fees_fine_amount = 0;
                                                $feetype_balance = 0;
                                                $last_invoice_no = ''; // Initialize
                                                if (!empty($transport_fee_value->amount_detail)) {
                                                    $fee_deposits = json_decode(($transport_fee_value->amount_detail));
                                                    foreach ($fee_deposits as $fee_deposits_key => $fee_deposits_value) {
                                                        $fee_paid = $fee_paid + $fee_deposits_value->amount;
                                                        $fee_discount = $fee_discount + $fee_deposits_value->amount_discount;
                                                        $fee_fine = $fee_fine + $fee_deposits_value->amount_fine;
                                                        $last_invoice_no = $fee_deposits_value->inv_no;
                                                    }
                                                }
                                                $feetype_balance = $transport_fee_value->fees - ($fee_paid + $fee_discount);
                                                if (($transport_fee_value->due_date != "0000-00-00" && $transport_fee_value->due_date != null) && (strtotime($transport_fee_value->due_date) < strtotime(date('Y-m-d')))) {
                                                    $fees_fine_amount = is_null($transport_fee_value->fine_percentage) ? $transport_fee_value->fine_amount : percentageAmount($transport_fee_value->fees, $transport_fee_value->fine_percentage);
                                                    $total_fees_fine_amount_mobile = $total_fees_fine_amount_mobile + $fees_fine_amount;
                                                }
                                                $total_amount_mobile += $transport_fee_value->fees;
                                                $total_discount_amount_mobile += $fee_discount;
                                                // $total_deposite_amount_mobile += $fee_paid;
                                                $total_fine_amount_mobile += $fee_fine;
                                                $total_balance_amount_mobile += $feetype_balance;
                                                $is_overdue = ($feetype_balance > 0 && strtotime($transport_fee_value->due_date) < strtotime(date('Y-m-d')));
                                                // Determine status for transport fees
                                                $status = '';
                                                $status_class = '';
                                                if ($feetype_balance == 0) {
                                                    $status = $this->lang->line('paid');
                                                    $status_class = 'success';
                                                } else if (!empty($transport_fee_value->amount_detail)) {
                                                    $status = $this->lang->line('partial');
                                                    $status_class = 'warning';
                                                } else {
                                                    $status = $this->lang->line('unpaid');
                                                    $status_class = 'danger';
                                                }

                                                // Logic for immediate pay button for transport fees in mobile view - only for first fee with a balance
                                                $is_immediate_pay_button_transport_mobile = false;

                                                if ($feetype_balance > 0 && !$first_unpaid_found_mobile) {
                                                    $is_immediate_pay_button_transport_mobile = true;
                                                    $first_unpaid_found_mobile = true;
                                                }

                                                $fee_card_class = "panel-default"; // Default panel class
                                                if ($is_overdue) {
                                                    $fee_card_class = "panel-danger"; // Overdue fees are danger
                                                }

                                                // Apply unpaid-fee-highlight only if it's the *first* outstanding fee
                                                if ($is_immediate_pay_button_transport_mobile) {
                                                    $fee_card_class = "panel-primary unpaid-fee-highlight";
                                                }
                                        ?>
                                                <div class="panel <?php echo $fee_card_class; ?> fee-card <?php echo ($feetype_balance == 0) ? 'paid-fee-highlight' : ''; ?>">
                                                    <div class="panel-heading" style="background-color: #e6f7ff; border-color: #b3e0ff;">
                                                        <h3 class="panel-title" style="display: flex; justify-content: space-between;">
                                                            <?php echo $this->lang->line('transport_fees'); ?> (<?php echo $transport_fee_value->month; ?>)
                                                            <div style="display: flex; justify-content: end;gap: 10px;">
                                                                <span class="label label-<?php echo $status_class; ?> pull-right"><?php echo $status; ?></span>
                                                                <?php if (!empty($transport_fee_value->amount_detail)) { ?>
                                                                    <button class="btn btn-xs btn-default printDoc"
                                                                        data-main_invoice="<?php echo $transport_fee_value->student_fees_deposite_id ?>"
                                                                        data-sub_invoice="<?php echo $last_invoice_no ?>"
                                                                        data-fee-category="transport"
                                                                        title="<?php echo $this->lang->line('print'); ?>">
                                                                        <i class="fa fa-print"></i>
                                                                    </button>
                                                                <?php } ?>
                                                            </div>
                                                        </h3>
                                                    </div>
                                                    <div class="panel-body">
                                                        <div class="row fee-row">
                                                            <div class="col-xs-6">
                                                                <strong><?php echo $this->lang->line('due_date'); ?>:</strong>
                                                            </div>
                                                            <div class="col-xs-6 text-right">
                                                                <?php echo $this->customlib->dateformat($transport_fee_value->due_date); ?>
                                                            </div>
                                                        </div>
                                                        <div class="row fee-row">
                                                            <div class="col-xs-6">
                                                                <strong><?php echo $this->lang->line('amount'); ?>:</strong>
                                                            </div>
                                                            <div class="col-xs-6 text-right">
                                                                <?php echo amountFormat($transport_fee_value->fees); ?>
                                                                <?php if (($transport_fee_value->due_date != "0000-00-00" && $transport_fee_value->due_date != null) && (strtotime($transport_fee_value->due_date) < strtotime(date('Y-m-d')))) :
                                                                    $tr_fine_amount = $transport_fee_value->fine_amount;
                                                                    if ($transport_fee_value->fine_type != "" && $transport_fee_value->fine_type == "percentage") {
                                                                        $tr_fine_amount = percentageAmount($transport_fee_value->fees, $transport_fee_value->fine_percentage);
                                                                    }
                                                                ?>
                                                                    <span class="text-danger">+<?php echo amountFormat($tr_fine_amount); ?></span>
                                                                <?php endif; ?>
                                                            </div>
                                                        </div>
                                                        <div class="row fee-row">
                                                            <div class="col-xs-6">
                                                                <strong><?php echo $this->lang->line('discount'); ?>:</strong>
                                                            </div>
                                                            <div class="col-xs-6 text-right">
                                                                <?php
                                                                if($fee_discount == $fee_fine){
                                                                    echo "0.00";
                                                                }else{
                                                                    echo amountFormat($fee_discount);
                                                                }
                                                                 ?>
                                                            </div>
                                                        </div>
                                                        <div class="row fee-row">
                                                            <div class="col-xs-6">
                                                                <strong><?php echo $this->lang->line('fine'); ?>:</strong>
                                                            </div>
                                                            <div class="col-xs-6 text-right">
                                                                <?php echo amountFormat($fee_fine); ?>
                                                            </div>
                                                        </div>
                                                        <div class="row fee-row">
                                                            <div class="col-xs-6">
                                                                <strong><?php echo $this->lang->line('paid'); ?>:</strong>
                                                            </div>
                                                            <div class="col-xs-6 text-right">
                                                                <?php
                                                                if($fee_discount == $fee_fine){
                                                                    $total_deposite_amount_mobile = $total_deposite_amount_mobile+$fee_paid;
                                                                    echo amountFormat($fee_paid);
                                                                }else{
                                                                    $total_deposite_amount_mobile = $total_deposite_amount_mobile+($fee_paid-$fee_discount);
                                                                    echo amountFormat($fee_paid-$fee_discount);
                                                                }
                                                                // echo amountFormat($fee_paid); 
                                                                ?>
                                                            </div>
                                                        </div>
                                                        <div class="row fee-row">
                                                            <div class="col-xs-6">
                                                                <strong><?php echo $this->lang->line('balance'); ?>:</strong>
                                                            </div>
                                                            <div class="col-xs-6 text-right">
                                                                <?php if ($feetype_balance > 0) echo amountFormat($feetype_balance); ?>
                                                            </div>
                                                        </div>
                                                        <?php
                                                        // Display the "Pay Now" button for mobile if there's a balance remaining
                                                        if ($feetype_balance > 0) : ?>
                                                            <div class="row payment-actions">
                                                                <div class="col-xs-12">
                                                                    <?php
                                                                    // Check if it's the first outstanding fee or if all previous outstanding fees are paid/partially paid
                                                                    $can_pay_current_fee_transport_mobile = $is_immediate_pay_button_transport_mobile || (!$is_immediate_pay_button_transport_mobile && $first_unpaid_found_mobile == false);

                                                                    if ($payment_method && $sch_setting->is_offline_fee_payment) { ?>
                                                                        <form class="form_fees" action="<?php echo site_url('user/gateway/payment/pay'); ?>" method="POST">
                                                                            <input type="hidden" name="fee_category" value="transport">
                                                                            <input type="hidden" name="student_transport_fee_id" value="<?php echo $transport_fee_value->id; ?>">
                                                                            <input type="hidden" name="student_fees_master_id" value="0">
                                                                            <input type="hidden" name="fee_groups_feetype_id" value="0">
                                                                            <input type="hidden" name="student_id" value="<?php echo $student['id']; ?>">
                                                                            <input type="hidden" name="submit_mode" value="">
                                                                            <div class="dropdown">
                                                                                <button class="btn btn-primary btn-sm btn-block dropdown-toggle" type="button" data-toggle="dropdown" <?php echo ($can_pay_current_fee_transport_mobile) ? '' : 'disabled'; ?>><i class="fa fa-money"></i> <?php echo $this->lang->line('pay'); ?>
                                                                                    <span class="caret"></span></button>
                                                                                <ul class="dropdown-menu  dropdown-menu-right">
                                                                                    <li><a href="javascript:void(0)" onclick="submitform('online_payment',this)"><?php echo $this->lang->line('online_payment'); ?></a></li>
                                                                                    <li><a href="javascript:void(0)" onclick="submitform('offline_payment',this)"><?php echo $this->lang->line('offline_payment'); ?></a></li>
                                                                                </ul>
                                                                            </div>
                                                                        </form>
                                                                    <?php } elseif ($payment_method) { ?>
                                                                        <form class="form_fees" action="<?php echo site_url('user/gateway/payment/pay'); ?>" method="POST">
                                                                            <input type="hidden" name="fee_category" value="transport">
                                                                            <input type="hidden" name="student_transport_fee_id" value="<?php echo $transport_fee_value->id; ?>">
                                                                            <input type="hidden" name="student_fees_master_id" value="0">
                                                                            <input type="hidden" name="fee_groups_feetype_id" value="0">
                                                                            <input type="hidden" name="student_id" value="<?php echo $student['id']; ?>">
                                                                            <input type="hidden" name="submit_mode" value="online_payment">
                                                                            <button type="submit" class="btn btn-sm btn-block myCollectFeeBtn <?php echo ($is_immediate_pay_button_transport_mobile) ? 'blink-red' : 'btn-primary'; ?>" <?php echo ($can_pay_current_fee_transport_mobile) ? '' : 'disabled'; ?>><i class="fa fa-money"></i> <?php echo $this->lang->line('pay');
                                                                                                                                                                                                                                                                                                                                ?></button>
                                                                        </form>
                                                                    <?php } elseif ($sch_setting->is_offline_fee_payment) { ?>
                                                                        <form class="form_fees" action="<?php echo site_url('user/gateway/payment/pay'); ?>" method="POST">
                                                                            <input type="hidden" name="fee_category" value="transport">
                                                                            <input type="hidden" name="student_transport_fee_id" value="<?php echo $transport_fee_value->id; ?>">
                                                                            <input type="hidden" name="student_fees_master_id" value="0">
                                                                            <input type="hidden" name="fee_groups_feetype_id" value="0">
                                                                            <input type="hidden" name="student_id" value="<?php echo $student['id']; ?>">
                                                                            <input type="hidden" name="submit_mode" value="offline_payment">
                                                                            <button type="submit" class="btn btn-primary btn-sm btn-block myCollectFeeBtn" <?php echo ($can_pay_current_fee_transport_mobile) ? '' : 'disabled'; ?>><i class="fa fa-money"></i> <?php echo $this->lang->line('pay');
                                                                                                                                                                                                                                                                                                                                ?></button>
                                                                        </form>
                                                                    <?php } ?>
                                                                </div>
                                                            </div>
                                                        <?php endif; ?>
                                                    </div>
                                                </div>
                                        <?php
                                            }
                                        }
                                        ?>
                                        <div class="panel panel-primary total-card">
                                            <div class="panel-heading">
                                                <h3 class="panel-title"><?php echo $this->lang->line('grand_total'); ?></h3>
                                            </div>
                                            <div class="panel-body">
                                                <div class="row">
                                                    <div class="col-xs-6">
                                                        <strong><?php echo $this->lang->line('total_amount'); ?>:</strong>
                                                    </div>
                                                    <div class="col-xs-6 text-right">
                                                        <?php echo $currency_symbol . amountFormat($total_amount_mobile); ?>
                                                        <span class="text-danger">+<?php echo amountFormat($total_fees_fine_amount_mobile); ?></span>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-xs-6">
                                                        <strong><?php echo $this->lang->line('discount'); ?>:</strong>
                                                    </div>
                                                    <div class="col-xs-6 text-right">
                                                        <?php echo $currency_symbol . amountFormat($total_discount_amount_mobile); ?>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-xs-6">
                                                        <strong><?php echo $this->lang->line('fine'); ?>:</strong>
                                                    </div>
                                                    <div class="col-xs-6 text-right">
                                                        <?php echo $currency_symbol . amountFormat($total_fine_amount_mobile); ?>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-xs-6">
                                                        <strong><?php echo $this->lang->line('paid'); ?>:</strong>
                                                    </div>
                                                    <div class="col-xs-6 text-right">
                                                        <?php echo $currency_symbol . amountFormat($total_deposite_amount_mobile); ?>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-xs-6">
                                                        <strong><?php echo $this->lang->line('balance'); ?>:</strong>
                                                    </div>
                                                    <div class="col-xs-6 text-right">
                                                        <?php 
                                                        echo $currency_symbol . amountFormat(($total_amount_mobile+$total_fees_fine_amount_mobile)-($total_discount_amount_mobile+$total_deposite_amount_mobile));
                                                        //echo $currency_symbol . amountFormat($total_balance_amount_mobile); ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<div id="listCollectionModal" class="modal fade">
    <div class="modal-dialog">
        <form action="<?php echo site_url('user/gateway/payment/grouppay'); ?>" method="POST" id="collect_fee_group">
            <div class="modal-content">
                <input type="hidden" class="form-control" id="group_std_id" name="student_session_id" value="<?php echo $student["student_session_id"]; ?>" readonly="readonly" />
                <input type="hidden" class="form-control" id="group_parent_app_key" name="parent_app_key" value="<?php echo $student['parent_app_key'] ?>" readonly="readonly" />
                <input type="hidden"
                    class="form-control" id="group_guardian_phone" name="guardian_phone" value="<?php echo $student['guardian_phone'] ?>" readonly="readonly" />
                <input type="hidden" class="form-control" id="group_guardian_email" name="guardian_email" value="<?php echo $student['guardian_email'] ?>" readonly="readonly" />
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title"><?php echo $this->lang->line('pay_fees'); ?></h4>
                </div>
                <div class="modal-body">
                </div>
            </div>
        </form>
    </div>
</div>
<div id="processing_fess_modal" class="modal fade">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title"><?php echo $this->lang->line('processing_fees'); ?></h4>
            </div>
            <div class="modal-body scroll-area">
            </div>
        </div>
    </div>
</div>
<div id="bank_payment_modal" class="modal fade">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close"
                    data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title"><?php echo $this->lang->line('offline_bank_payments'); ?></h4>
            </div>
            <div class="modal-body scroll-area">
            </div>
        </div>
    </div>
</div>
<div id="myPaymentModel" class="modal fade">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close"
                    data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><?php echo $this->lang->line('payment_details'); ?> </h4>
            </div>
            <div class="modal-body modalminheight">
                <div class="modal_inner_loader"></div>
                <div class="payment_detail" id="media_div">
                </div>
            </div></div>
        </div>
    </div>
<script type="text/javascript">
    $(document).on('click', '.printDoc', function(e) {
    // original code below (won’t be reached)
    var main_invoice = $(this).data('main_invoice');
    var sub_invoice = $(this).data('sub_invoice');
    var fee_category = $(this).data('fee-category');
    var student_session_id = '<?php echo $student['student_session_id'] ?>';

    $.ajax({
        url: base_url+'user/user/printFeesByName',
        type: 'post',
        dataType: "JSON",
        data: {
            'fee_category': fee_category,
            'student_session_id': student_session_id,
            'main_invoice': main_invoice,
            'sub_invoice': sub_invoice
        },
        success: function(response) {
            if (window.matchMedia("(max-width: 767px)").matches) {
                Popup(response.page);
            } else {
                Popup1(response.page);
            }
        },
        error: function(xhr) {
            alert("<?php echo $this->lang->line('error_occurred_please_try_again'); ?>");
        }
    });
});

    $(document).ready(function() {
        $('#listCollectionModal').modal({
            backdrop: 'static',
            keyboard: false,
            show: false
        });
        $(document).on('click', '.printSelected', function() {
            var print_btn = $(this);
            var array_to_print = [];
            $.each($("input[name='fee_checkbox']:checked"), function() {
                var trans_fee_id = $(this).data('trans_fee_id');
                var fee_category = $(this).data('fee_category');
                var fee_session_group_id = $(this).data('fee_session_group_id');
                var fee_master_id = $(this).data('fee_master_id');
                var fee_groups_feetype_id = $(this).data('fee_groups_feetype_id');
                item = {};
                item["fee_category"] = fee_category;
                item["trans_fee_id"] = trans_fee_id;
                item["fee_session_group_id"] = fee_session_group_id;
                item["fee_master_id"] = fee_master_id;
                item["fee_groups_feetype_id"] = fee_groups_feetype_id;
                array_to_print.push(item);
            });
            if (array_to_print.length === 0) {
                alert("<?php echo $this->lang->line('please_select_record'); ?>");
            } else {
                $.ajax({
                    url: '<?php echo site_url("user/user/printFeesByGroupArray") ?>', // Replaced PHP site_url with placeholder
                    type: 'post',
                    data: {
                        'data': JSON.stringify(array_to_print)
                    },
                    beforeSend: function() {
                        print_btn.button('loading');
                    },
                    success: function(response) {
                        Popup(response);
                    },
                    error: function(xhr) { // if error occured
                        print_btn.button('reset');
                        alert("<?php echo $this->lang->line('error_occurred_please_try_again'); ?>");
                    },
                    complete: function() {
                        print_btn.button('reset');
                    }
                });
            }
        });
        $(document).on('click', '.collectSelected', function() {
            var $this = $(this);
            var array_to_collect_fees = [];
            var select_count = 0;
            $.each($("input[name='fee_checkbox']:checked"), function() {
                var trans_fee_id = $(this).data('trans_fee_id');
                var fee_category = $(this).data('fee_category');
                var fee_session_group_id = $(this).data('fee_session_group_id');
                var fee_master_id = $(this).data('fee_master_id');
                var fee_groups_feetype_id = $(this).data('fee_groups_feetype_id');
                item = {};
                item["fee_category"] = fee_category;
                item["trans_fee_id"] = trans_fee_id;
                item["fee_session_group_id"] = fee_session_group_id;
                item["fee_master_id"] = fee_master_id;
                item["fee_groups_feetype_id"] = fee_groups_feetype_id;
                array_to_collect_fees.push(item);
                select_count++;
            });
            if (select_count > 0) {
                $.ajax({
                    type: 'POST',
                    url: base_url + "user/user/getcollectfee",
                    data: {
                        'data': JSON.stringify(array_to_collect_fees)
                    },
                    dataType: "JSON",
                    beforeSend: function() {
                        $this.button('loading');
                    },
                    success: function(data) {
                        $("#listCollectionModal .modal-body").html(data.view);
                        $("#listCollectionModal").modal('show');
                        $this.button('reset');
                    },
                    error: function(xhr) { // if error occured
                        alert("<?php echo $this->lang->line('error_occurred_please_try_again'); ?>");
                    },
                    complete: function() {
                        $this.button('reset');
                    }
                });
            } else {
                alert('<?php echo $this->lang->line('please_select_record') ?>');
            }
        });
        $(document).on('click', '.getProcessingfees', function() {
            var $this = $(this);
            $.ajax({
                type: 'POST',
                url: base_url + "user/user/getProcessingfees",
                dataType: "JSON",
                beforeSend: function() {
                    $this.button('loading');
                },
                success: function(data) {
                    $("#processing_fess_modal .modal-body").html(data.view);
                    $("#processing_fess_modal").modal({
                        backdrop: 'static',
                        keyboard: false
                    });
                    $this.button('reset');
                },
                error: function(xhr) { // if error occured
                    alert("<?php echo $this->lang->line('error_occurred_please_try_again'); ?>");
                },
                complete: function() {
                    $this.button('reset');
                }
            });
        });

        // Call the function to set a dynamic background color for mobile profile card
        setMobileProfileBackgroundColor();
    });
    var base_url = '<?php echo base_url() ?>'; // Replaced PHP echo with a placeholder for Canvas execution

    function Popup1(data, winload = true) {
        var newWindow = window.open('', '_blank', 'width=800,height=600');
        newWindow.document.open();
        newWindow.document.write('<html>');
        newWindow.document.write('<head>');
        newWindow.document.write('<title></title>');
        newWindow.document.write('<link rel="stylesheet" href="' + base_url + 'backend/bootstrap/css/bootstrap.min.css">');
        newWindow.document.write('</head>');
        newWindow.document.write('<body>');
        newWindow.document.write(data);
        newWindow.document.write('</body>');
        newWindow.document.write('</html>');
        newWindow.document.close();
        newWindow.focus();
        setTimeout(function() {
            newWindow.print();
            if (winload) {
                // You might need to consider how to reload the original window
                // if the new window closing should trigger a reload on the parent.
                // For
                // a simple new window print, this line might not be needed.
                // window.location.reload(true);
            }
        }, 500);
    }

    function Popup(data, winload = false) {
        var frame1 = $('<iframe />').attr("id", "printDiv");
        frame1[0].name = "frame1";
        frame1.css({
            "position": "absolute",
            "top": "-1000000px"
        });
        $("body").append(frame1);
        var frameDoc = frame1[0].contentWindow ? frame1[0].contentWindow : frame1[0].contentDocument.document ? frame1[0].contentDocument.document : frame1[0].contentDocument;
        frameDoc.document.open();
        //Create a new HTML document.
        frameDoc.document.write('<html>');
        frameDoc.document.write('<head>');
        frameDoc.document.write('<title></title>');
        // Corrected variable name to base_url for consistency
        frameDoc.document.write('<link rel="stylesheet" href="' + base_url + 'backend/bootstrap/css/bootstrap.min.css">');
        frameDoc.document.write('</head>');
        frameDoc.document.write('<body>');
        frameDoc.document.write(data);
        frameDoc.document.write('</body>');
        frameDoc.document.write('</html>');
        frameDoc.document.close();
        setTimeout(function() {
            document.getElementById('printDiv').contentWindow.focus();
            document.getElementById('printDiv').contentWindow.print();
            $("#printDiv", top.document).remove();
            if (winload) {
                window.location.reload(true);
            }
        }, 500);
        return true;
    }
    $('.detail_popover').popover({
        placement: 'right',
        title: '',
        trigger: 'hover',
        container: 'body',
        html: true,
        content: function() {
            return $(this).closest('td').find('.fee_detail_popover').html();
        }
    });

    // Function to set dynamic background color for mobile profile card
    function setMobileProfileBackgroundColor() {
        const profileCard = document.querySelector('.visible-xs .student-profile-card');
        if (profileCard) {
            // Generate a slightly varied light blue/green color using HSL
            const hue = 180 + Math.random() * 60; // Hues between light blue (180) and light green (240)
            const saturation = 40 + Math.random() * 20; // Saturation 40-60% for a softer look
            const lightness = 85 + Math.random() * 5; // Lightness 85-90% for a very light background

            const dynamicColor = `hsl(${hue}, ${saturation}%, ${lightness}%)`;
            const dynamicBorderColor = `hsl(${hue}, ${saturation + 10}%, ${lightness - 5}%)`; // Slightly darker border

            profileCard.style.setProperty('--mobile-profile-bg', dynamicColor);
            profileCard.style.setProperty('--mobile-profile-border', dynamicBorderColor);
        }
    }
</script>
<script type="text/javascript">
    function submitform(type, element) {
        $(element).closest("form").find("input[name=submit_mode]").val(type);
        $(element).closest("form").submit();
    }
    $(document).on('click', '.getBankPayments', function() {
        var $this = $(this);
        $.ajax({
            type: 'POST',
            url: base_url + "user/offlinepayment/getBankPayments",
            dataType: "JSON",
            beforeSend: function() {
                $this.button('loading');
            },
            success: function(data) {
                $("#bank_payment_modal .modal-body").html(data.page);
                // The initDatatable function is not defined in this snippet,
                // so it's commented out to prevent errors.
                // initDatatable('payment-list', 'user/offlinepayment/getlistbyuser', [], [], 100);
                $("#bank_payment_modal").modal({
                    backdrop: 'static',
                    keyboard: false
                });
                $this.button('reset');
            },
            error: function(xhr) { // if error occured
                alert("<?php echo $this->lang->line('error_occurred_please_try_again'); ?>");
                $this.button('reset');
            },
            complete: function() {
                $this.button('reset');
            }
        });
    });
    $(document).on('click', '.getbankdetail', function() {
        var $this = $(this);
        var recordid = $(this).data('recordid');
        $('.payment_detail', $('#myPaymentModel')).html("");
        $('#myPaymentModel').modal('show');
        $.ajax({
            type: 'POST',
            url: base_url + "user/offlinepayment/getpayment",
            data: {
                'recordid': recordid
            },
            dataType: 'JSON',
            beforeSend: function() {
                $this.button('loading');
            },
            success: function(data) {
                $('.payment_detail', $('#myPaymentModel')).html(data.page);
                $('.modal_inner_loader').fadeOut("slow");
                $this->button('reset');
            },
            error: function(xhr) { // if error occured
                alert("<?php echo $this->lang->line('error_occurred_please_try_again'); ?>");
                $this->button('reset');
            },
            complete: function() {
                $this.button('reset');
            }
        });
    });
</script>


<script>
function Popup(data, winload = false) {
    var printWindow = window.open('', '_blank');
    printWindow.document.open();
    printWindow.document.write('<html><head><title>Print</title>');
    printWindow.document.write('<link rel="stylesheet" href="' + base_url + 'backend/bootstrap/css/bootstrap.min.css">');
    printWindow.document.write('</head><body>');
    printWindow.document.write(data);
    printWindow.document.write('</body></html>');
    printWindow.document.close();

    printWindow.focus();
    printWindow.onload = function () {
        setTimeout(function () {
            printWindow.print();
            printWindow.close();
            if (winload) {
                window.location.reload(true);
            }
        }, 500);
    };
}
</script>