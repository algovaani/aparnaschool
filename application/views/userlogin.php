<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#424242" />
    <title>Login : <?php echo $name; ?></title>
    <link href="<?php echo base_url(); ?>uploads/school_content/admin_small_logo/<?php $this->setting_model->getAdminsmalllogo();?>" rel="shortcut icon" type="image/x-icon">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:400,100,300,500">
    <link rel="stylesheet" href="<?php echo base_url(); ?>backend/usertemplate/assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>backend/usertemplate/assets/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>backend/usertemplate/assets/css/form-elements.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>backend/usertemplate/assets/css/style.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>backend/usertemplate/assets/css/jquery.mCustomScrollbar.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>backend/usertemplate/assets/css/style_move_background.css">

    <style>
        /* New styles to center the login form */
        html, body {
            height: 100%; /* Ensure html and body take full height */
            margin: 0;
            padding: 0;
            overflow: hidden; /* Hide scrollbars if background animation overflows */
            /* Initial background for smooth transition */
            background-color: #f0f8ff; /* A light, soft blue */
            transition: background-color 2s ease-in-out; /* Smooth transition for background color */
        }

        .top-content {
            min-height: 100vh; /* Ensure it takes full viewport height */
            display: flex; /* Use flexbox for centering */
            justify-content: center; /* Center horizontally */
            align-items: center; /* Center vertically */
            padding: 20px; /* Add some padding in case content is smaller than viewport */
            box-sizing: border-box; /* Include padding in element's total width and height */
        }

        .inner-bg {
            width: 100%; /* Allow inner-bg to take full width within flex container */
            display: flex; /* Use flexbox for its child (login container) */
            justify-content: center; /* Center horizontally */
            align-items: center; /* Center vertically if needed */
        }

        .container-login100 {
            width: 100%;
            display: -webkit-box;
            display: -webkit-flex;
            display: -moz-box;
            display: -ms-flexbox;
            display: flex;
            flex-wrap: wrap;
            align-items: stretch;
            flex-wrap: wrap;
            /* Adjustments for centering within inner-bg if inner-bg isn't full height */
            justify-content: center; /* Ensures the form part is centered if it doesn't take full width */
            max-width: 1200px; /* Optional: limit overall container width */
        }

        .wrap-login100 {
            width: 400px;
            border-radius: 10px; /* Increased for a softer look */
            position: relative;
            box-shadow: 0 0 20px rgba(0,0,0,0.2); /* Enhanced shadow */
            margin: auto; /* Center the wrap-login100 within its flex container (container-login100) if it's smaller */
            align-self: center; /* Centers the item itself within the flex container vertically */
            /* 3D border effect */
            border: 3px solid;
            border-image: linear-gradient(45deg, #FF0000, #00FF00, #0000FF, #FF00FF, #FFFF00, #00FFFF);
            border-image-slice: 1;
            padding: 20px; /* Add padding inside the border */
            box-sizing: border-box; /* Include padding in the element's total width and height */
            animation: borderAnimation 10s linear infinite; /* Animate the border */
        }

        @keyframes borderAnimation {
            0% { border-image-source: linear-gradient(45deg, #FF0000, #00FF00, #0000FF, #FF00FF, #FFFF00, #00FFFF); }
            20% { border-image-source: linear-gradient(45deg, #00FF00, #0000FF, #FF00FF, #FFFF00, #00FFFF, #FF0000); }
            40% { border-image-source: linear-gradient(45deg, #0000FF, #FF00FF, #FFFF00, #00FFFF, #FF0000, #00FF00); }
            60% { border-image-source: linear-gradient(45deg, #FF00FF, #FFFF00, #00FFFF, #FF0000, #00FF00, #0000FF); }
            80% { border-image-source: linear-gradient(45deg, #FFFF00, #00FFFF, #FF0000, #00FF00, #0000FF, #FF00FF); }
            100% { border-image-source: linear-gradient(45deg, #00FFFF, #FF0000, #00FF00, #0000FF, #FF00FF, #FFFF00); }
        }

        .login100-more {
            background-repeat: no-repeat;
            background-position: center;
            background-size: cover;
            width: calc(100% - 400px);
            position: relative;
            z-index: 1;
            background-image: url('https://aparnapublicschool.in/uploads/school_content/login_image/school-building.jpg');
            min-height: 550px; /* This height is for the image, not the login form */
        }

        /* Original styles (keep as they are) */
        .loginbg {
            background: #fff;
            padding: 20px 30px; /* Reduced top/bottom padding from 30px to 20px */
            box-sizing: border-box;
            min-height: unset; /* Ensure no fixed minimum height interferes */
            height: auto; /* Allow height to adjust to content */
        }

        .form-top {
            margin-bottom: 15px; /* Slightly reduced margin */
        }

        .form-top-left img {
            max-width: 80%; /* Slightly reduce logo size */
            height: auto;
            display: block;
            margin: 0 auto;
        }

        .form-bottom h3 {
            margin-bottom: 20px; /* Slightly reduced margin */
            color: #FF0066;
            font-weight: bolder;
            font-family: 'Courier New', Courier, monospace;
            text-align: center;
        }

        .form-group {
            margin-bottom: 12px; /* Slightly reduced margin */
        }

        .form-control-feedback {
            right: 0;
            top: 0;
            width: 34px;
            height: 34px;
            line-height: 34px;
            text-align: center;
            pointer-events: none;
            color: #ccc;
        }

        .catpcha {
            cursor: pointer;
            color: #337ab7;
            margin-left: 5px;
        }

        .forgot {
            display: block;
            text-align: center;
            margin-top: 10px; /* Slightly reduced margin */
            color: #000000;
            font-weight: bolder;
            font-family: Arial, Helvetica, sans-serif;
            text-decoration: none;
        }

        .btn {
            width: 100%;
            padding: 8px; /* Reduced button padding */
            font-size: 15px; /* Slightly reduced font size */
            border-radius: 4px;
            margin-top: 15px; /* Slightly reduced margin */
            background-color: #5cb85c;
            color: white;
            border: none;
        }

        /* --- Teacher Login Button Styling --- */
        .btn-primary {
            background-image: linear-gradient(to right, #337ab7 0%, #286090 50%, #337ab7 100%);
            background-size: 200% 100%;
            transition: background-position 0.3s ease;
            color: white;
            font-weight: bold;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.5);
            border: 1px solid #1a3c5a;
            padding: 10px 15px; /* Adjusted padding */
            font-size: 16px; /* Adjusted font size */
            text-align: center;
            text-decoration: none;
            display: inline-block;
            border-radius: 5px;
        }

        .btn-primary:hover {
            background-position: -100% 0;
            color: #f0f0f0;
        }
        /* --- End Teacher Login Button Styling --- */


        .alert {
            margin-bottom: 12px; /* Slightly reduced margin */
            padding: 8px; /* Reduced padding */
            border-radius: 4px;
            font-size: 13px; /* Slightly reduced font size */
        }

        .alert-danger {
            background-color: #f2dede;
            color: #a94442;
            border: 1px solid #ebccd1;
        }

        .alert-success {
            background-color: #dff0d8;
            color: #3c763d;
            border: 1px solid #d6e9c6;
        }

        /* Media queries for responsiveness */
        @media (max-width: 768px) {
            .container-login100 {
                flex-direction: column;
                align-items: center;
            }

            .wrap-login100 {
                width: 90%;
                min-width: 280px;
                margin-bottom: 20px;
                border-radius: 8px;
                padding: 15px; /* Adjusted padding for mobile */
            }

            .login100-more {
                display: none;
            }

            .loginbg {
                padding: 15px 20px; /* Further reduced padding for mobile */
            }

            .form-top-left img {
                max-width: 70%; /* Further reduce logo size on mobile */
            }

            .btn {
                padding: 7px; /* Further reduced button padding on mobile */
                font-size: 14px; /* Further reduced font size on mobile */
            }

            .btn-primary {
                padding: 8px 12px; /* Adjusted teacher login button padding for mobile */
                font-size: 15px; /* Adjusted teacher login button font size for mobile */
            }
        }
    </style>
    <style>
    /* Modal Styles */
    .modal {
      display: none;
      position: fixed;
      z-index: 999;
      left: 0;
      top: 0;
      width: 100%;
      height: 100%;
      overflow: auto;
      background-color: rgba(0, 0, 0, 0.6);
    }

    .modal-content {
      background-color: #fff3f8;
      margin: 10% auto;
      padding: 20px;
      border: 1px solid #ffcce0;
      width: 90%;
      max-width: 400px;
      border-radius: 10px;
      font-family: 'Segoe UI', Tahoma, sans-serif;
      color: #333;
      position: relative;
    }

    .modal-content h2 {
      font-size: 18px;
      color: #d1005b;
      margin-bottom: 10px;
    }

    .modal-content ul {
      margin: 10px 0;
      padding-left: 20px;
    }

    .modal-content ul li {
      margin-bottom: 5px;
    }

    .modal-content .buttons {
      margin-top: 15px;
    }

    .modal-content button {
      padding: 8px 16px;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      font-size: 14px;
    }

    .btn-download {
      background-color: #ff0066;
      color: white;
      margin-right: 10px;
    }

    .btn-understand {
      background-color: #ccc;
      color: #333;
    }

    .close {
      position: absolute;
      right: 12px;
      top: 10px;
      font-size: 20px;
      color: #888;
      cursor: pointer;
    }

    @media (max-width: 480px) {
      .modal-content {
        margin-top: 30%;
      }
    }
  </style>
</head>

<body>
    <div class="top-content">
        <div class="inner-bg">
            <div class="container-fluid">
                <div class="row">
                    <?php
                    $offset = "";
                    $bgoffsetbg = "bgoffsetbg";
                    $bgoffsetbgno = "";
                    if (empty($notice)) {
                        // $empty_notice = 1;
                        // $offset = "col-md-offset-4";
                        // $bgoffsetbg = "";
                        // $bgoffsetbgno = "bgoffsetbgno";
                    }
                    ?>
                    <div class="<?php echo $bgoffsetbg; ?>">
                        <div class="container-login100">
                            <div class="wrap-login100">
                                <div class="loginbg">
                                    <div class="form-top">
                                        <div class="form-top-left" style=" text-align:center">
                                            <img src="<?php echo base_url(); ?>uploads/school_content/admin_logo/aps_logo_big2.png" alt="School Logo" />
                                        </div>
                                    </div>
                                    <div class="form-bottom">
                                        <h3 class="font-white" style="color:#FF0066; font-weight:bolder; font-family:Courier New, Courier, monospace; ">Student/Parent Login</h3>
                                        <?php
                                        if (isset($error_message)) {
                                            echo "<div class='alert alert-danger'>" . $error_message . "</div>";
                                        }
                                        ?>
                                        <?php
                                        if ($this->session->flashdata('message')) {
                                            echo "<div class='alert alert-success'>" . $this->session->flashdata('message') . "</div>";
                                        };
                                        ?>
                                        <form action="<?php echo site_url('site/userlogin') ?>" method="post" class="login-form">
                                            <?php echo $this->customlib->getCSRF(); ?>
                                            <div class="form-group has-feedback">
                                                <label class="sr-only" for="form-username">
                                                    <?php echo $this->lang->line('username'); ?></label>
                                                <input type="text" name="username" value="<?php echo set_value("username"); ?>" placeholder="<?php echo $this->lang->line('username'); ?>" class="form-username form-control" id="email">
                                                <span class="fa fa-envelope form-control-feedback"></span>
                                                <span class="text-danger"><?php echo form_error('username'); ?></span>
                                            </div>
                                            <div class="form-group has-feedback">
                                                <input type="password" name="password" value="<?php echo set_value("password"); ?>" placeholder="<?php echo $this->lang->line('password'); ?>" class="form-password form-control" id="password">
                                                <span class="fa fa-lock form-control-feedback"></span>
                                                <span class="text-danger"><?php echo form_error('password'); ?></span>
                                            </div>
                                            <?php if ($is_captcha) {?>
                                            <div class="form-group has-feedback row">
                                                <div class='col-lg-7 col-md-12 col-sm-6'>
                                                    <span id="captcha_image"><?php echo $captcha_image; ?></span>
                                                    <span class="fa fa-refresh catpcha" title='<?php echo $this->lang->line("refresh_captcha") ?>' onClick="refreshCaptcha()"></span>
                                                </div>
                                                <div class='col-lg-5 col-md-12 col-sm-6'>
                                                    <input type="text" name="captcha" placeholder="<?php echo $this->lang->line('captcha'); ?>" autocomplete="off" class=" form-control" id="captcha">
                                                    <span class="text-danger"><?php echo form_error('captcha'); ?></span>
                                                </div>
                                            </div>
                                            <?php }?>
                                            <button type="submit" class="btn">
                                                <?php echo $this->lang->line('sign_in'); ?></button>
                                        </form>

                                        <p><a href="<?php echo site_url('site/ufpassword') ?>" class="forgot"> <i class="fa fa-key"></i> <?php echo $this->lang->line('forgot_password'); ?></a> </p>

                                        <p class="text-center">
                                            <a href="<?php echo site_url('site/login') ?>" class="btn btn-primary" style="margin-top: 10px;">
                                                Teacher Login
                                            </a>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="login100-more"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="<?php echo base_url(); ?>backend/usertemplate/assets/js/jquery-1.11.1.min.js"></script>
    <script src="<?php echo base_url(); ?>backend/usertemplate/assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url(); ?>backend/usertemplate/assets/js/jquery.backstretch.min.js"></script>
    <script src="<?php echo base_url(); ?>backend/usertemplate/assets/js/jquery.mCustomScrollbar.min.js"></script>
    <script src="<?php echo base_url(); ?>backend/usertemplate/assets/js/jquery.mousewheel.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const colors = [
                '#f0f8ff', // AliceBlue
                '#e0ffff', // LightCyan
                '#f5fffa', // MintCream
                '#f0fff0'  // Honeydew
            ];
            let currentColorIndex = 0;
            const body = document.body;

            function changeBackgroundColor() {
                currentColorIndex = (currentColorIndex + 1) % colors.length;
                body.style.backgroundColor = colors[currentColorIndex];
            }

            // Change color every 7 seconds
            setInterval(changeBackgroundColor, 7000);
        });
    </script>
    
    <!-- Modal -->
	<!--
<div id="appUpdateModal" class="modal">
  <div class="modal-content">
    <span class="close" onClick="closeModal()">&times;</span>
    <h2>IMPORTANT APP UPDATE NOTICE</h2>
    <p>Dear Parents,</p>
    <p>We're upgrading our parent App and discontinuing the current <strong>APS School </strong> App.</p>
    <p>Please install our new official app:<br><strong style="color:#FF0066;">APS DHANBAD</strong></p>
    <ul>
      <li>✔️ Available on Google Play Store</li>
      <li>✔️ Improved features and reliability</li>
      <li>✔️ Please uninstall the old app after updating</li>
      <li>Url :-https://play.google.com/store/apps/details?id=in.aparnapublicschool.app</li>
    </ul>
    <div class="buttons">
      <button class="btn-download" onClick="window.location.href='https://play.google.com/store/apps/details?id=in.aparnapublicschool.app'">
  Download Now
</button>
  
      <button class="btn-understand" onClick="closeModal()">We already Done</button>
    </div>
    <p style="font-size:12px; color:#777; margin-top:10px;">
      Note: Please ignore this message if you've already completed this process.
    </p>
  </div>
</div>
-->
<script>
  // Show modal on page load
  window.onload = function () {
    document.getElementById('appUpdateModal').style.display = 'block';
  }

  function closeModal() {
    document.getElementById('appUpdateModal').style.display = 'none';
  }
</script>

</body>
</html>
<script type="text/javascript">
    $(document).ready(function () {
        $('.login-form input[type="text"], .login-form input[type="password"], .login-form textarea').on('focus', function () {
            $(this).removeClass('input-error');
        });

        $('.login-form').on('submit', function (e) {
            $(this).find('input[type="text"], input[type="password"], textarea').each(function () {
                if ($(this).val() == "") {
                    e.preventDefault();
                    $(this).addClass('input-error');
                } else {
                    $(this).removeClass('input-error');
                }
            });
        });
    });
</script>
<script type="text/javascript">
    function refreshCaptcha(){
        $.ajax({
            type: "POST",
            url: "<?php echo base_url('site/refreshCaptcha'); ?>",
            data: {},
            success: function(captcha){
                $("#captcha_image").html(captcha);
            }
        });
    }
</script>
<script>
    function copy(email, password)
    {
        document.getElementById("email").value = email;
        document.getElementById("password").value = password;
    }
</script>