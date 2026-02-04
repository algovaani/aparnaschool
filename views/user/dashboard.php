<?php
// Set the timezone to India Standard Time (IST)
date_default_timezone_set('Asia/Kolkata');

// Get the current hour of the day
$current_hour = date('H');

// Determine the appropriate greeting based on the time
if ($current_hour >= 5 && $current_hour < 12) {
    $greeting = "Good morning";
} elseif ($current_hour >= 12 && $current_hour < 17) {
    $greeting = "Good afternoon";
} else {
    $greeting = "Good evening";
}

// Get the current date in a readable format
$current_date = date("F j, Y");

// The rest of the original code, with the modified welcome section.
?>
<!-- Add Google Font Poppins for a modern look -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
<style>
  body {
    font-family: 'Poppins', sans-serif;
  }
  .btn::-moz-focus-inner {
    border: 0;
  }

  .btn,
  .btn.btn-default {
    box-shadow: 0 2px 2px 0 rgba(153, 153, 153, 0.14),
      0 3px 1px -2px rgba(153, 153, 153, 0.2),
      0 1px 5px 0 rgba(153, 153, 153, 0.12);
  }

  .btn.btn-primary:focus,
  .btn.btn-primary:active,
  .btn.btn-primary:hover {
    box-shadow: 0 14px 26px -12px rgba(156, 39, 176, 0.42),
      0 4px 23px 0px rgba(0, 0, 0, 0.12),
      0 8px 10px -5px rgba(156, 39, 176, 0.2);
  }

  .btn-new1 {
    background-color: #9c27b0;
    border-color: #971fab;
    color: #ffffff;
  }

  .btn-new1:hover,
  .btn-new1:active,
  .btn-new1.hover {
    background-color: #7a198a;
    color: #ffffff;
  }

  .btn-new2 {
    background-color: #0b98cc;
    border-color: #0b98cc;
    color: #ffffff;
  }

  .btn-new2:hover,
  .btn-new2:active,
  .btn-new2.hover {
    background-color: #057fab;
    color: #ffffff;
  }

  .btn-new3 {
    background-color: #e91e63;
    border-color: #e91e63;
    color: #ffffff;
  }

  .btn-new3:hover,
  .btn-new3:active,
  .btn-new3.hover {
    background-color: #d11052;
    color: #ffffff;
  }

  .btn-new4 {
    background-color: #ff9800;
    border-color: #ff9800;
    color: #ffffff;
  }

  .btn-new4:hover,
  .btn-new4:active,
  .btn-new4.hover {
    background-color: #cd7c04;
    color: #ffffff;
  }

  /* MODIFIED: New styles for the session button to be a modern blue tab style */
  .btn-new5 {
    /* Changed to a linear gradient background for a more dynamic look */
    background: linear-gradient(145deg, #3498db, #2980b9); 
    border-color: #2c3e50; 
    color: #ffffff; 
    /* Increased border-radius for a more pronounced rounded shape */
    border-radius: 15px; 
    transition: all 0.3s ease; /* Add transition for hover effect */
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
  }

  .btn-new5:hover,
  .btn-new5:active,
  .btn-new5.hover {
    background: linear-gradient(145deg, #2980b9, #2c3e50); 
    color: #ffffff;
    box-shadow: 0 6px 10px rgba(0, 0, 0, 0.2);
  }

  /* --- IMPORTANT CSS CHANGES FOR 3 BUTTONS PER ROW --- */
  .row1 {
    display: flex;
    flex-wrap: wrap;
    margin-left: -5px;
    margin-right: -5px;
  }

  .column {
    flex: 1 1 33.33%;
    padding: 5px;
    box-sizing: border-box;
  }

  /* Base styling for large buttons */
  .btn.btn-lg {
    padding: 15px 10px;
    font-size: 14px;
    line-height: 1.5;
  }

  .btn.btn-lg .fa-4x {
    font-size: 4em;
    display: block;
    margin-bottom: 5px;
  }

  /* Media queries for responsiveness */
  @media screen and (max-width: 768px) {
    .column {
      flex: 1 1 33.33%;
    }

    .btn.btn-lg {
      padding: 12px 8px;
      font-size: 13px;
    }

    .btn.btn-lg .fa-4x {
      font-size: 3em;
    }
  }

  @media screen and (max-width: 576px) {
    .column {
      flex: 1 1 33.33%;
    }

    .btn.btn-lg {
      padding: 8px 3px;
      font-size: 11px;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      height: 100%;
    }

    .btn.btn-lg br {
      display: none;
    }

    .btn.btn-lg .fa-4x {
      font-size: 2em;
      margin-bottom: 3px;
    }
    
    /* Responsive styles for the welcome message section */
    .welcome-section .row {
      display: flex;
      flex-direction: column;
      align-items: center;
      text-align: center;
    }
    .welcome-section .col-lg-3, .welcome-section .col-lg-9 {
      width: 100%;
    }
    .welcome-container {
      margin-top: 15px;
    }
    .welcome-heading {
      font-size: 20px;
    }
    .welcome-text {
      font-size: 14px;
    }
    .user-image {
      width: 120px;
      height: 120px;
      border-radius: 50%; /* Make image circular on mobile */
    }
  }

  @media screen and (max-width: 375px) {
    .btn.btn-lg {
      padding: 6px 2px;
      font-size: 9px;
    }
    .btn.btn-lg .fa-4x {
      font-size: 1.8em;
    }
  }
  
  /* New styles for the welcome message */
  .welcome-container {
    font-family: 'Poppins', sans-serif;
  }
  .welcome-heading {
    font-weight: 700;
    font-size: 24px;
    background: linear-gradient(90deg, #6a11cb 0%, #2575fc 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    text-shadow: 1px 1px 2px rgba(0,0,0,0.2);
    margin-bottom: 5px;
  }
  .welcome-text {
    font-weight: 400;
    color: #555;
    font-size: 16px;
    margin-top: 5px;
  }

  /* Added style for the new colorful welcome section background */
  .colorful-welcome {
    background: linear-gradient(135deg, #fceabb 0%, #cfec85 100%);
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
  }
</style>
<div class="content-wrapper">
  <section class="content pb0">
    <div class="row">
      <ul style="text-align:center">
        <li class="removehover">
          <a class="btn btn-lg btn-new5" data-toggle="modal" data-target="#user_sessionModal" style="font-size:14px;">
            <!-- MODIFIED LINE: Changed "Current Session" to "Academic Session" -->
            <!-- MODIFIED LINE: Set span color to white for better contrast -->
            <span style="color: #ffffff;">Academic Session: <?php echo $this->setting_model->getCurrentSessionName(); ?></span><br />
            <!-- MODIFIED LINE: Changed text color to red -->
            <span style="font-size:12px;text-align:center; color: #dc3545;">(Click here to change Session)</span>
            <i class="fa fa-pencil pull-right"></i>
          </a>
        </li>
      </ul>
    </div>

    <div class="row">
      <div class="col-lg-12 col-md-12 col-sm-12">
        <div class="box box-primary borderwhite">
          <!-- Added the new class "colorful-welcome" to the box-body -->
          <div class="box-body direct-top-equal-scroll-22 welcome-section colorful-welcome">
            <div class="row">
              <div class="col-lg-3 col-md-3 col-sm-3">
                <?php
                  if (!empty($student_data["image"])) {
                      $file = base_url() . $student_data["image"] . img_time();
                  } else {
                      if ($student_data['gender'] == 'Female') {
                          $file = base_url() . "uploads/student_images/default_female.jpg" . img_time();
                      } else {
                          $file = base_url() . "uploads/student_images/default_male.jpg" . img_time();
                      }
                  }
                ?>
                <img src="<?php echo $file . '' . img_time(); ?>" class="img-rounded img-responsive img-h-150 mb-xs-1 user-image">
              </div>
              <div class="col-lg-9 col-md-9 col-sm-9">
                <!-- MODIFIED SECTION: Welcome message with new style -->
                <div class="welcome-container">
                  <h4 class="mt0 welcome-heading"><?php echo $greeting; ?>, <?php echo $studentsession_username; ?>!</h4>
                  <p class="welcome-text">
                    I am APS AI, I am helping you to connect with school.<br>
                    Please follow my dashboard.
                  </p>
                </div>
                <!-- END MODIFIED SECTION -->
                <?php if ($attendence_percentage > 0 && $attendence_percentage < $low_attendance_limit && $low_attendance_limit != '0.00') { ?>
                  <p class="text-danger"><?php echo $this->lang->line('your_current_attendance_is'); ?> <?php echo $attendence_percentage; ?>% <?php echo $this->lang->line('which_is_lower_than'); ?> <?php echo $low_attendance_limit; ?>% <?php echo $this->lang->line('of_minimum_attendance_mark'); ?>. </p>
                <?php } elseif ($attendence_percentage > 0 && $attendence_percentage >= $low_attendance_limit && $low_attendance_limit != '0.00') { ?>
                  <p class="text-success"><?php echo $this->lang->line('your_current_attendance_is'); ?> <?php echo $attendence_percentage; ?>% <?php echo $this->lang->line('which_is_above'); ?> <?php echo $low_attendance_limit; ?>% <?php echo $this->lang->line('of_minimum_attendance_mark'); ?>.</p>
                <?php } ?>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="row1">
        <div class="column">
          <div class="box box-primary borderwhite">
            <a href="<?php echo base_url('user/user/getfees'); ?>" class="btn btn-lg btn-success" style="width:100%">
                  <i class="fa fa-inr fa-4x" aria-hidden="true"></i>
              <br /><br />Fees
            </a>
          </div>
        </div>
        <div class="column">
          <div class="box box-primary borderwhite">
            <a href="<?php echo base_url('/user/timetable');?>" class="btn btn-lg btn-new3" style="width:100%">
              <i class="fa fa-calendar fa-4x" aria-hidden="true"></i>
              <br /><br />Class Timetable
            </a>
          </div>
        </div>
        <div class="column">
          <div class="box box-primary borderwhite">
            <a href="<?php echo base_url('/user/apply_leave');?>" class="btn btn-lg btn-warning" style="width:100%">
              <i class="fa fa-calendar-minus-o fa-4x" aria-hidden="true"></i>
              <br /><br />Apply Leave
            </a>
          </div>
        </div>
      </div>

      <div class="row1">
        <div class="column">
          <div class="box box-primary borderwhite">
            <a href="<?php echo base_url('/user/content/list');?>" class="btn btn-lg btn-new2" style="width:100%">
              <i class="fa fa-book fa-4x" aria-hidden="true"></i>
              <br /><br />Contents
            </a>
          </div>
        </div>
        <div class="column">
          <div class="box box-primary borderwhite">
            <a href="<?php echo base_url('/user/homework');?>" class="btn btn-lg btn-danger" style="width:100%">
              <i class="fa fa-book fa-4x" aria-hidden="true"></i>
              <br /><br />Homework
            </a>
          </div>
        </div>
        <div class="column">
          <div class="box box-primary borderwhite">
            <a href="<?php echo base_url('/user/notification');?>" class="btn btn-lg btn-new1" style="width:100%">
              <i class="fa fa-list-alt fa-4x" aria-hidden="true"></i>
              <br /><br />Notice Board
            </a>
          </div>
        </div>
      </div>

      <div class="row1">
        <div class="column">
          <div class="box box-primary borderwhite">
            <a href="<?php echo base_url('/user/attendence');?>" class="btn btn-lg btn-success" style="width:100%">
              <i class="fa fa-hand-paper-o fa-4x" aria-hidden="true"></i>
              <br /><br />Attendance
            </a>
          </div>
        </div>
        <div class="column">
          <div class="box box-primary borderwhite">
            <a href="<?php echo base_url('/user/examschedule');?>" class="btn btn-lg btn-new3" style="width:100%">
              <i class="fa fa-clipboard fa-4x" aria-hidden="true"></i>
              <br /><br />Exam Datesheet
            </a>
          </div>
        </div>
        <div class="column">
          <div class="box box-primary borderwhite">
            <a href="<?php echo base_url('/user/syllabus');?>" class="btn btn-lg btn-warning" style="width:100%">
              <i class="fa fa-pencil-square-o fa-4x" aria-hidden="true"></i>
              <br /><br />Lesson Plan
            </a>
          </div>
        </div>
      </div>

      <div class="row1">
        <div class="column">
          <div class="box box-primary borderwhite">
            <a href="<?php echo base_url('/user/onlineexam');?>" class="btn btn-lg btn-new2" style="width:100%">
              <i class="fa fa-laptop fa-4x" aria-hidden="true"></i>
              <br /><br />Online Exam
            </a>
          </div>
        </div>
        <div class="column">
          <div class="box box-primary borderwhite">
            <a href="<?php echo base_url('/user/visitors');?>" class="btn btn-lg btn-danger" style="width:100%">
              <i class="fa fa-address-book fa-4x" aria-hidden="true"></i>
              <br /><br />Visitor Book
            </a>
          </div>
        </div>
        <div class="column">
          <div class="box box-primary borderwhite">
            <a href="<?php echo base_url('/user/exam/examresult');?>" class="btn btn-lg btn-new3" style="width:100%">
              <i class="fa fa-file-text fa-4x" aria-hidden="true"></i>
              <br /><br />Exam Result
            </a>
          </div>
        </div>
      </div>

      <div class="row1">
        <div class="column">
          <div class="box box-primary borderwhite">
            <a href="<?php echo base_url('/user/route');?>" class="btn btn-lg btn-new4" style="width:100%">
              <i class="fa fa-road fa-4x" aria-hidden="true"></i>
              <br /><br />Transport Route
            </a>
          </div>
        </div>
        <div class="column">
          <div class="box box-primary borderwhite">
            <a href="<?php echo base_url('/user/syllabus/status');?>" class="btn btn-lg btn-success" style="width:100%">
              <i class="fa fa-book fa-4x" aria-hidden="true"></i>
              <br /><br />Syllabus Status
            </a>
          </div>
        </div>
        <div class="column">
          <div class="box box-primary borderwhite">
            <a href="<?php echo base_url('/user/user/profile');?>" class="btn btn-lg btn-new1" style="width:100%">
              <i class="fa fa-user fa-4x" aria-hidden="true"></i>
              <br /><br />My Profile
            </a>
          </div>
        </div>
      </div>
    </div>

    <div style="height:10px"></div>
  </section>
</div>

<!-- JavaScript to display and update the current time -->
<script>
    function updateClock() {
        const now = new Date();
        const hours = now.getHours().toString().padStart(2, '0');
        const minutes = now.getMinutes().toString().padStart(2, '0');
        const seconds = now.getSeconds().toString().padStart(2, '0');
        const timeString = `${hours}:${minutes}:${seconds}`;
        document.getElementById('live-clock').textContent = timeString;
    }

    // Call updateClock() once to set the initial time, then every second
    updateClock();
    setInterval(updateClock, 1000);
</script>
