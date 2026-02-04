<header class="bg-white shadow-md">
    <link href="<?php echo base_url(); ?>backend/toast-alert/toastr.css" rel="stylesheet"/>
    <script src="<?php echo base_url(); ?>backend/toast-alert/toastr.js"></script>

    <div class="container mx-auto px-4 py-3 flex items-center justify-between flex-wrap">
        <div class="flex-grow">
            <a class="logo" href="<?php echo base_url(); ?>">
                <img src="<?php echo base_url($front_setting->logo); ?>" alt="School Logo" class="h-12 w-auto">
            </a>
        </div>
        <div class="mt-2 md:mt-0">
            <a href="<?php echo base_url(); ?>site/userlogin" class="bg-gradient-to-r from-red-500 to-red-600 text-white font-bold uppercase py-2 px-4 rounded-lg shadow-lg hover:from-red-600 hover:to-red-500 transition-all duration-300 ease-in-out whitespace-nowrap">
                <i class="fa fa-user mr-2"></i> <?php echo $this->lang->line('login'); ?>
            </a>
        </div>
    </div>

    <nav class="bg-gradient-to-r from-sky-400 via-indigo-600 to-violet-500 shadow-xl py-2 sticky top-0 z-50">
        <div class="container mx-auto px-4 flex justify-between items-center">
            <button id="mobile-menu-button" class="md:hidden text-white focus:outline-none">
                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path>
                </svg>
            </button>

            <ul id="desktop-menu" class="hidden md:flex space-x-1 w-full justify-center">
                <?php foreach ($main_menus as $menu_key => $menu_value) {
                    $submenus = !empty($menu_value['submenus']);
                    $menu_selected = ($menu_value['page_slug'] == $active_menu) ? "active" : "";
                    $cls_menu_dropdown = $submenus ? "relative group" : "";
                ?>
                    <li class="<?php echo $menu_selected; ?> <?php echo $cls_menu_dropdown; ?>">
                        <?php if (!$submenus) {
                            $top_new_tab = $menu_value['open_new_tab'] ? "target='_blank'" : '';
                            $url = $menu_value['ext_url'] ? $menu_value['ext_url_link'] : site_url($menu_value['page_url']);
                        ?>
                            <a href="<?php echo $url; ?>" <?php echo $top_new_tab; ?> class="text-white text-sm uppercase px-2 py-2 rounded-md font-medium hover:bg-white hover:text-indigo-600 transition-colors duration-300 ease-in-out whitespace-nowrap">
                                <?php echo $menu_value['menu']; ?>
                            </a>
                        <?php } else { ?>
                            <a href="#" class="text-white text-sm uppercase px-2 py-2 rounded-md font-medium hover:bg-white hover:text-indigo-600 transition-colors duration-300 ease-in-out whitespace-nowrap flex items-center">
                                <?php echo $menu_value['menu']; ?>
                                <svg class="w-4 h-4 ml-1 transform transition-transform duration-200 group-hover:rotate-180" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                            </a>
                            <ul class="absolute hidden group-hover:block bg-indigo-700 shadow-lg rounded-md mt-2 w-48 transition-all duration-300">
                                <?php foreach ($menu_value['submenus'] as $submenu_value) {
                                    $child_new_tab = $submenu_value['open_new_tab'] ? "target='_blank'" : '';
                                    $url = $submenu_value['ext_url'] ? $submenu_value['ext_url_link'] : site_url($submenu_value['page_url']);
                                ?>
                                    <li>
                                        <a href="<?php echo $url; ?>" <?php echo $child_new_tab; ?> class="block px-4 py-2 text-white hover:bg-indigo-500 rounded-md transition-colors duration-300">
                                            <?php echo $submenu_value['menu'] ?>
                                        </a>
                                    </li>
                                <?php } ?>
                            </ul>
                        <?php } ?>
                    </li>
                <?php } ?>
            </ul>
        </div>

        <div id="mobile-menu" class="hidden md:hidden absolute top-full left-0 right-0 bg-indigo-700 shadow-lg z-50">
            <ul class="flex flex-col space-y-2 py-2">
                <?php foreach ($main_menus as $menu_key => $menu_value) {
                    $submenus = !empty($menu_value['submenus']);
                    $url = $menu_value['ext_url'] ? $menu_value['ext_url_link'] : site_url($menu_value['page_url']);
                ?>
                    <li>
                        <a href="<?php echo $url; ?>" class="block px-4 py-2 text-white hover:bg-indigo-500 rounded-md transition-colors duration-300">
                            <?php echo $menu_value['menu']; ?>
                        </a>
                        <?php if ($submenus) { ?>
                            <ul class="ml-4 border-l border-indigo-400">
                                <?php foreach ($menu_value['submenus'] as $submenu_value) {
                                    $url = $submenu_value['ext_url'] ? $submenu_value['ext_url_link'] : site_url($submenu_value['page_url']);
                                ?>
                                    <li>
                                        <a href="<?php echo $url; ?>" <?php echo $child_new_tab; ?> class="block px-4 py-2 text-white hover:bg-indigo-500 transition-colors duration-300">
                                            <?php echo $submenu_value['menu']; ?>
                                        </a>
                                    </li>
                                <?php } ?>
                            </ul>
                        <?php } ?>
                    </li>
                <?php } ?>
            </ul>
        </div>
    </nav>
</header>
<script>
    document.getElementById('mobile-menu-button').addEventListener('click', function() {
        const mobileMenu = document.getElementById('mobile-menu');
        mobileMenu.classList.toggle('hidden');
    });
</script>