<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php echo $page['title']; ?></title>
    <meta name="title" content="<?php echo $page['meta_title']; ?>">
    <meta name="keywords" content="<?php echo $page['meta_keyword']; ?>">
    <meta name="description" content="<?php echo $page['meta_description']; ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="<?php echo base_url($front_setting->fav_icon); ?>" type="image/x-icon">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap');
        body {
            font-family: 'Inter', sans-serif;
            @apply bg-gray-50 text-gray-800;
        }
    </style>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script type="text/javascript">
        var base_url = "<?php echo base_url() ?>";
    </script>
</head>

<body class="flex flex-col min-h-screen">

    <?php echo $header; ?>
    <?php echo $slider; ?>

    <main class="container mx-auto px-4 py-8 flex-grow">
        <div class="flex flex-wrap -mx-2">
            <?php $page_column = "w-full"; ?>
            <div class="<?php echo $page_column; ?> px-2">
                <?php echo $content; ?>
            </div>
        </div>
    </main>

    <?php echo $footer; ?>
    
       <?php
// Show admission popup only on homepage (base URL or 'frontend' route)
$is_homepage_popup = ($this->uri->segment(1) == '' || $this->uri->segment(1) == 'frontend');
if ($is_homepage_popup): ?>
<style>
    .dps-popup-overlay {
        position: fixed;
        inset: 0; /* shorthand for top/right/bottom/left: 0 */
        background: rgba(0, 0, 0, 0.8);
        z-index: 99999; /* Increased z-index to ensure it is on top */
        
        /* Flexbox for centering, but safe for scrolling */
        display: flex;
        align-items: flex-start; /* Allows scrolling if popup is taller than screen */
        justify-content: center;
        
        padding: 20px; /* Spacing from screen edges on mobile */
        overflow-y: auto; /* Enables scrolling on small screens */
        -webkit-overflow-scrolling: touch; /* Smooth scrolling on iOS */
    }

    .dps-popup-hidden {
        display: none !important;
    }

    .dps-popup-card-img {
        position: relative;
        width: 100%;
        max-width: 900px; /* Maximum desktop width */
        margin: auto; /* Centers the item vertically in the flex container */
        background: transparent;
        box-shadow: 0 15px 40px rgba(0, 0, 0, 0.5);
        border-radius: 8px; /* Optional: adds nice rounded corners */
        line-height: 0; /* Removes extra space below image */
    }

    .dps-popup-card-img img {
        width: 100%;
        height: auto;
        display: block;
        border-radius: 8px;
    }

    .dps-popup-close-btn {
        position: absolute;
        top: -15px;
        right: -15px;
        background-color: #d32f2f;
        color: #ffffff;
        border: 2px solid #fff;
        
        /* Larger touch target for mobile */
        width: 40px;
        height: 40px;
        border-radius: 50%;
        font-size: 24px;
        font-weight: bold;
        line-height: 1;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 2px 10px rgba(0,0,0,0.3);
        transition: transform 0.2s;
    }

    .dps-popup-close-btn:hover {
        background-color: #b71c1c;
        transform: scale(1.1);
    }

    /* Mobile specific adjustments */
    @media (max-width: 600px) {
        .dps-popup-close-btn {
            /* Move button inside image on very small screens to prevent cropping */
            top: 10px;
            right: 10px;
            border: none;
            background-color: rgba(211, 47, 47, 0.9);
        }
    }
</style>

<div class="dps-popup-overlay" id="dpsAdmissionPopupMp">
    <div class="dps-popup-card-img">
        <button class="dps-popup-close-btn" type="button" id="dpsPopupCloseBtnMp" aria-label="Close">&times;</button>
        <img src="<?php echo base_url('uploads/popup.jpeg'); ?>" alt="Admission Open">
    </div>
</div>

<script>
(function() {
    var popup = document.getElementById('dpsAdmissionPopupMp');
    var closeBtn = document.getElementById('dpsPopupCloseBtnMp');
    
    // Safety check
    if (!popup || !closeBtn) return;

    function closePopup() {
        popup.classList.add('dps-popup-hidden');
    }

    closeBtn.addEventListener('click', closePopup);

    // Close when clicking outside the image (on the dark background)
    popup.addEventListener('click', function(e) {
        // e.target is the element actually clicked. 
        // If it equals popup, the user clicked the overlay, not the image.
        if (e.target === popup) {
            closePopup();
        }
    });
})();
</script>
<?php endif; ?>

    </body>
</html>