<footer class="bg-gradient-to-r from-sky-400 via-indigo-600 to-violet-500 text-white py-8 px-4">
    <div class="container mx-auto">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 text-center md:text-left">
            <div>
                <h6 class="uppercase font-semibold text-sm mb-3">
                    <?php echo $this->lang->line('links'); ?>
                </h6>
                <ul class="list-none m-0 p-0 text-sm space-y-2">
                    <?php foreach ($footer_menus as $footer_menu_key => $footer_menu_value) {
                        $cls_menu_dropdown = !empty($footer_menu_value['submenus']) ? "dropdown" : "";
                        $top_new_tab = $footer_menu_value['open_new_tab'] ? "target='_blank'" : "";
                        $url = $footer_menu_value['ext_url'] ? $footer_menu_value['ext_url_link'] : site_url($footer_menu_value['page_url']);
                    ?>
                        <li class="<?php echo $cls_menu_dropdown; ?>">
                            <a href="<?php echo $url; ?>" <?php echo $top_new_tab; ?> class="text-white hover:text-gray-200 transition-colors duration-300">
                                <?php echo $footer_menu_value['menu']; ?>
                            </a>
                        </li>
                    <?php } ?>
                </ul>
            </div>

            <div>
                <h6 class="uppercase font-semibold text-sm mb-3">
                    <?php echo $this->lang->line('follow_us'); ?>
                </h6>
                <div class="social flex justify-center md:justify-start space-x-4">
                    <a href="https://www.youtube.com/@aparnapublicschool" target="_blank" class="text-white hover:text-red-500 transition-colors duration-300">
                        <i class="fab fa-youtube fa-lg"></i>
                    </a>
                </div>
            </div>

            <div>
                <h6 class="uppercase font-semibold text-sm mb-3">
                    <?php echo $this->lang->line('contact'); ?>
                </h6>
                <ul class="list-none m-0 p-0 text-sm space-y-2">
                    <li class="flex items-start justify-center md:justify-start">
                        <i class="fa fa-envelope mt-1 mr-2"></i> 
                        <a href="mailto:<?php echo $school_setting->email; ?>" class="text-white hover:text-gray-200 transition-colors duration-300">
                            <?php echo $school_setting->email; ?>
                        </a>
                    </li>
                    <li class="flex items-start justify-center md:justify-start">
                        <i class="fa fa-phone mt-1 mr-2"></i>
                        <span><?php echo $school_setting->phone; ?></span>
                    </li>
                    <li class="flex items-start justify-center md:justify-start">
                        <i class="fa fa-map-marker mt-1 mr-2"></i>
                        <span><?php echo $school_setting->address; ?></span>
                    </li>
                </ul>
            </div>
            
            <div>
                <h6 class="uppercase font-semibold text-sm mb-3">
                    Location Map
                </h6>
                <div class="w-full">
                    <a href="https://aparnapublicschool.in/page/google-map" target="_blank" class="bg-gray-200 text-gray-800 font-semibold py-2 px-4 rounded-lg block text-center hover:bg-gray-300 transition-colors duration-300">
                        View Location on Google Maps
                    </a>
                </div>
            </div>
        </div>

        <hr class="my-8 border-gray-600">

        <div class="text-center text-xs">
            <?php echo $front_setting->footer_text; ?>  "Designed and maintained by"by APARNA PUBLIC SCHOOL
        </div>
    </div>

    <a class="scrollToTop fixed bottom-6 right-6 bg-white text-indigo-600 rounded-full p-3 shadow-lg hover:bg-gray-100 transition-colors duration-300" href="#">
        <i class="fa fa-angle-double-up"></i>
    </a>
</footer>