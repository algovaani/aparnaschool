<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="theme-color" content="#424242" />
        <title>Login : <?php echo $name; ?></title>      
        <link href="<?php echo base_url(); ?>uploads/school_content/admin_small_logo/<?php $this->setting_model->getAdminsmalllogo(); ?>" rel="shortcut icon" type="image/x-icon">
        <link rel="stylesheet" href="<?php echo base_url(); ?>backend/usertemplate/assets/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>backend/usertemplate/assets/font-awesome/css/font-awesome.min.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>backend/usertemplate/assets/css/form-elements.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>backend/usertemplate/assets/css/style.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>backend/usertemplate/assets/css/jquery.mCustomScrollbar.min.css">
        <style>
            /* Custom CSS to center the login form and hide background image */
            body {
                /* Eye-catching texture background */
                background-image: url('https://www.transparenttextures.com/patterns/lined-paper.png'); 
                background-repeat: repeat;
                background-color: #ccf5e2; /* Fallback and initial color */
                font-family: "Arial Rounded MT Bold", "Helvetica Neue", Helvetica, Arial, sans-serif;
                /* Add transition for smooth background color changes on the body */
                transition: background-color 2s ease;
            }

            .top-content {
                display: flex;
                align-items: center;
                justify-content: center;
                min-height: 100vh; /* Make sure it takes full viewport height */
            }

            .inner-bg {
                width: auto; /* Allow content to dictate width */
                background: none; /* Ensure no background from inner-bg */
            }

            .loginbg {
                /* Initial background color with texture */
                background-image: url('https://www.transparenttextures.com/patterns/fabric-of-squares.png'); /* A different texture that might suit the color better */
                background-repeat: repeat;
                background-color: #ADD8E6; /* Initial light blue color */
                
                padding: 30px;
                border-radius: 8px; /* Slightly increased border-radius for a softer look */
                
                /* --- START: Bold Border Area Styles --- */
                border: 4px solid #4CAF50; /* Changed to a bolder green border, increased thickness */
                box-shadow: 0 0 20px rgba(0, 0, 0, 0.3); /* Stronger initial shadow */
                /* Smooth transition for border, shadow, and background-color */
                transition: border-color 0.3s ease, box-shadow 0.3s ease, background-color 1s ease; 
                /* --- END: Bold Border Area Styles --- */

                /* Watermark styles */
                position: relative; /* Needed for absolute positioning of the watermark */
                overflow: hidden; /* Ensures watermark doesn't spill outside */
            }

            /* --- START: Interactive Highlighter Styles (Adjusted for bolder effect) --- */
            .loginbg:hover {
                border-color: #2196F3; /* Bright blue on hover, different from initial */
                box-shadow: 0 0 25px rgba(33, 150, 243, 0.6); /* More prominent glow on hover */
            }

            .loginbg:focus-within {
                border-color: #FFC107; /* Orange border when an input inside is focused */
                box-shadow: 0 0 30px rgba(255, 193, 7, 0.8); /* Even stronger glow when focused */
            }
            /* --- END: Interactive Highlighter Styles --- */

            /* Styles for the new login buttons to be in one row */
            .additional-logins {
                margin-top: 20px;
                text-align: center;
                /* Use flexbox for better alignment of buttons in a row */
                display: flex;
                justify-content: center; /* Center buttons horizontally */
                flex-wrap: wrap; /* Allow wrapping on smaller screens if needed */
                gap: 10px; /* Space between buttons */
            }
            .additional-logins a {
                display: inline-block;  
                padding: 8px 15px;
                border: none; /* Remove default border as we'll use background colors */
                border-radius: 4px;
                text-decoration: none;
                color: #fff; /* White text for better contrast */
                font-weight: bold;
                transition: background-color 0.2s ease, transform 0.2s ease; /* Added transform for hover effect */
                white-space: nowrap; /* Prevent text wrapping inside the button */
            }

            /* Specific colors for each button */
            .additional-logins .btn-teacher {
                background-color: #5cb85c; /* Green */
            }
            .additional-logins .btn-account {
                background-color: #f0ad4e; /* Orange */
            }
            .additional-logins .btn-transport {
                background-color: #5bc0de; /* Light Blue */
            }

            /* Hover effects for buttons */
            .additional-logins a:hover {
                opacity: 0.9; /* Slightly dim on hover */
                transform: translateY(-2px); /* Slight lift on hover */
                box-shadow: 0 2px 5px rgba(0,0,0,0.2);
            }

            /* Applying Arial Rounded MT Bold to relevant text elements */
            h3.font-white.bolds, 
            .form-username, 
            .form-password, 
            #captcha, 
            .btn, 
            .forgot,
            /* Also apply to error/success messages for consistency */
            .alert {
                font-family: "Arial Rounded MT Bold", "Helvetica Neue", Helvetica, Arial, sans-serif !important;
            }

            /* Watermark CSS */
            .watermark {
                position: absolute;
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%);
                width: 70%; /* Adjust as needed */
                height: auto;
                opacity: 0.08; /* Adjust for subtlety (0.05 to 0.2 is common) */
                z-index: 0; /* Ensure it stays behind content */
                pointer-events: none; /* Allows clicks/interactions with elements on top */
                filter: grayscale(100%); /* Optional: Make it grayscale for more subtlety */
            }
        </style>
    </head>
    <body>
        <div class="top-content">
            <div class="inner-bg">
                <div class="container">
                    <div class="row">
                        <div class="col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
                            <div class="loginbg">
                                <img src="<?php echo base_url(); ?>uploads/school_content/admin_logo/<?php echo $this->setting_model->getAdminlogo(); ?>" class="watermark" alt="School Logo Watermark" />

                                <div class="form-top">
                                    <div class="form-top-left logowidth">
                                        <img src="<?php echo base_url(); ?>uploads/school_content/admin_logo/<?php echo $this->setting_model->getAdminlogo(); ?>" />      
                                    </div>
                                </div>
                                <div class="form-bottom">
                                    <h3 class="font-white bolds"><?php echo $this->lang->line('admin_login'); ?></h3>
                                    <?php
                                    if (isset($error_message)) {
                                        echo "<div class='alert alert-danger'>" . $error_message . "</div>";
                                    }
                                    ?>
                                    <?php
                                    if ($this->session->flashdata('message')) {
                                        echo "<div class='alert alert-success'>" . $this->session->flashdata('message') . "</div>";
                                        $this->session->unset_userdata('message');      
                                    };
                                    ?>
                                    <?php
                                    if ($this->session->flashdata('disable_message')) {
                                        echo "<div class='alert alert-danger'>" . $this->session->flashdata('disable_message') . "</div>";
                                        $this->session->unset_userdata('disable_message');      
                                    };
                                    ?>
                                    <form action="<?php echo site_url('site/login') ?>" method="post">
                                        <?php echo $this->customlib->getCSRF(); ?>
                                        <div class="form-group has-feedback">            
                                            <input type="text" name="username" placeholder="<?php echo $this->lang->line('username'); ?>" value="<?php echo set_value('username') ?>" class="form-username form-control" id="form-username">
                                            <span class="fa fa-envelope form-control-feedback"></span>
                                            <span class="text-danger"><?php echo form_error('username'); ?></span>
                                        </div>
                                        <div class="form-group has-feedback">            
                                            <input type="password" value="<?php echo set_value('password') ?>" name="password" placeholder="<?php echo $this->lang->line('password'); ?>" class="form-password form-control" id="form-password">
                                            <span class="fa fa-lock form-control-feedback"></span>
                                            <span class="text-danger"><?php echo form_error('password'); ?></span>
                                        </div>
                                        <?php if($is_captcha){ ?>
                                        <div class="form-group has-feedback row">    
                                            <div class='col-lg-7 col-md-12 col-sm-6'>
                                                <span id="captcha_image"><?php echo $captcha_image; ?></span>
                                                <span title='Refresh Catpcha' class="fa fa-refresh catpcha" onclick="refreshCaptcha()"></span>
                                            </div>
                                            <div class='col-lg-5 col-md-12 col-sm-6'>
                                                <input type="text" name="captcha" placeholder="<?php echo $this->lang->line('captcha'); ?>" class=" form-control" autocomplete="off" id="captcha">      
                                                <span class="text-danger"><?php echo form_error('captcha'); ?></span>
                                            </div>
                                        </div>
                                        <?php } ?>
                                        <button type="submit" class="btn"><?php echo $this->lang->line('sign_in'); ?></button>
                                    </form>
                                    <a href="<?php echo site_url('site/forgotpassword') ?>" class="forgot"><i class="fa fa-key"></i> <?php echo $this->lang->line('forgot_password'); ?>?</a>

                                    <div class="additional-logins">
                                    </div>
                                </div>
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

        // --- New JavaScript for changing whole page background color ---
        const pageBackgroundColors = [
            '#ccf5e2', // Initial light green
            '#e6ccf5', // Light purple
            '#f5e2cc', // Light orange
            '#ccf5f5', // Light cyan
            '#f5cccc', // Light red
            '#e2f5cc'  // Light yellowish-green
        ];

        let pageColorIndex = 0;

        function changePageBackgroundColor() {
            const newPageColor = pageBackgroundColors[pageColorIndex];
            $('body').css('background-color', newPageColor); // Apply to the body
            pageColorIndex = (pageColorIndex + 1) % pageBackgroundColors.length;
        }

        // Change page background color every 7 seconds (7000 milliseconds)
        setInterval(changePageBackgroundColor, 7000);

        // Call it once to set the initial color (if different from default)
        changePageBackgroundColor();

        // --- End of New JavaScript for page background ---
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