<aside class="main-sidebar modern-sidebar" id="alert2" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: #fff; font-family: 'Segoe UI', 'Roboto', Arial, sans-serif;">
    <?php if ($this->rbac->hasPrivilege('student', 'can_view')) { ?>
        <form class="navbar-form navbar-left search-form2" role="search" action="<?php echo site_url('admin/admin/search'); ?>" method="POST" style="padding: 4px 2px;">
            <?php echo $this->customlib->getCSRF(); ?>
            <div class="input-group" style="border-radius: 24px; background: #fff; box-shadow: 0 1px 4px rgba(0,0,0,0.06);">
                <input type="text" name="search_text" class="form-control search-form" style="border-radius: 24px 0 0 24px; border: none; box-shadow: none; color: #333; padding: 6px 8px;"
                placeholder="<?php echo $this->lang->line('search_by_student_name'); ?>">
                <span class="input-group-btn">
                    <button type="submit" name="search" id="search-btn" style="padding: 4px 10px; border-radius: 0px 24px 24px 0px; background: linear-gradient(90deg,#43e97b 0%, #38f9d7 100%); color: #fff; border: none; box-shadow: none;"
                    class="btn btn-flat">
                        <i class="fa fa-search"></i>
                    </button>
                </span>
            </div>
        </form>
    <?php } ?>
    <section class="sidebar" id="sibe-box">
        <?php $this->load->view('layout/top_sidemenu'); ?>
        <ul class="sidebar-menu verttop" style="padding: 0; margin: 0; list-style: none;">
<?php
$side_list = side_menu_list(1);
if (!empty($side_list)) {
    foreach ($side_list as $side_list_key => $side_list_value) {

        $module_permission = access_permission_sidebar_remove_pipe($side_list_value->access_permissions);
        $module_access     = false;
        if (!empty($module_permission)) {
            foreach ($module_permission as $m_permission_key => $m_permission_value) {
                $cat_permission = access_permission_remove_comma($m_permission_value);
                if ($this->rbac->hasPrivilege($cat_permission[0], $cat_permission[1])) {
                    $module_access = true;
                    break;
                }
            }
        }
        if ($module_access) {
            if ($this->module_lib->hasModule($side_list_value->short_code) && $this->module_lib->hasActive($side_list_value->short_code)) {
                ?>
                <li class="treeview <?php echo activate_main_menu($side_list_value->activate_menu); ?>" style="margin-bottom: 1px;">
                    <a href="javascript:void(0);" class="treeview-toggle" style="display: flex; align-items: center; padding: 6px 10px; border-radius: 6px; background: rgba(255,255,255,0.07); color: #fff; transition: background 0.2s;">
                        <i class="<?php echo $side_list_value->icon; ?>" style="margin-right: 6px; font-size: 1em;"></i>
                        <span style="flex:1; font-size: 0.9em;"><?php echo $this->lang->line($side_list_value->lang_key); ?></span>
                        <?php if (!empty($side_list_value->submenus)) { ?>
                        <i class="fa fa-angle-left pull-right tree-arrow" style="margin-left: auto; transition: transform 0.2s;"></i>
                        <?php } ?>
                    </a>
                    <?php
                    if (!empty($side_list_value->submenus)) {
                        ?>
                        <ul class="treeview-menu" style="background: rgba(0,0,0,0.07); border-radius: 0 0 6px 6px; margin: 0; padding: 0; display: none;">
                            <?php
                            foreach ($side_list_value->submenus as $submenu_key => $submenu_value) {

                                $sidebar_permission = access_permission_sidebar_remove_pipe($submenu_value->access_permissions);
                                $sidebar_access     = false;

                                if (!empty($sidebar_permission)) {
                                    foreach ($sidebar_permission as $sidebar_permission_key => $sidebar_permission_value) {
                                        $sidebar_cat_permission = access_permission_remove_comma($sidebar_permission_value);
                                        if ($submenu_value->addon_permission != "") {
                                            if ($this->rbac->hasPrivilege($sidebar_cat_permission[0], $sidebar_cat_permission[1])
                                                && $this->auth->addonchk($submenu_value->addon_permission, false)) {
                                                $sidebar_access = true;
                                                break;
                                            }
                                        } else {
                                            if ($this->rbac->hasPrivilege($sidebar_cat_permission[0], $sidebar_cat_permission[1])) {
                                                $sidebar_access = true;
                                                break;
                                            }
                                        }
                                    }
                                }

                                if ($sidebar_access) {
                                    if (!empty($submenu_value->permission_group_id)) {
                                        if (!$this->module_lib->hasActive($submenu_value->short_code)) {
                                            continue;
                                        }
                                    }
                                    ?>
                                    <li class="<?php echo activate_submenu($submenu_value->activate_controller,
                                        explode(',', $submenu_value->activate_methods)); ?>">
                                        <a href="<?php echo site_url($submenu_value->url); ?>" style="display: flex; align-items: center; padding: 6px 14px; color: #fff; border-radius: 4px; transition: background 0.2s;">
                                            <i class="fa fa-angle-double-right" style="margin-right: 5px; color: #38f9d7;"></i>
                                            <span style="font-size: 0.85em;"><?php echo $this->lang->line($submenu_value->lang_key); ?></span>
                                        </a>
                                    </li>
                                <?php
                                }
                            }
                            ?>
                        </ul>
                    <?php
                    }
                    ?>
                </li>
                <?php
            }
        }
    }
}
?>
        </ul>
    </section>
    <style>
        .modern-sidebar {
            width: 175px;
            min-width: 140px;
            max-width: 100vw;
            box-sizing: border-box;
        }
        .modern-sidebar .sidebar-menu li a:hover,
        .modern-sidebar .sidebar-menu li.active > a {
            background: linear-gradient(90deg,#43e97b 0%, #38f9d7 100%);
            color: #fff !important;
            box-shadow: 0 1px 8px rgba(67,233,123,0.10);
        }
        .modern-sidebar .sidebar-menu .treeview-menu li a:hover {
            background: rgba(67,233,123,0.13);
            color: #fff !important;
        }
        .modern-sidebar .sidebar-menu .treeview-menu {
            padding-left: 0;
        }
        .modern-sidebar .sidebar-menu .treeview-menu li {
            margin-bottom: 1px;
        }
        .modern-sidebar .sidebar-menu .treeview > a {
            font-weight: 500;
        }
        .modern-sidebar .sidebar-menu .fa {
            transition: color 0.15s;
        }
        /* Compact the sidebar for mobile */
        @media (max-width: 991px) {
            .modern-sidebar {
                transform: translateX(-100%);
                position: fixed;
                top: 0;
                left: 0;
                width: 220px;
                max-width: 80vw;
                z-index: 1050;
                box-shadow: 0 4px 12px rgba(0,0,0,0.18);
                transition: transform 0.3s ease-in-out;
                height: 100vh;
                max-height: 100vh;
                overflow-y: auto;
                -webkit-overflow-scrolling: touch;
                padding-top: 12px;
                padding-bottom: 10px;
            }
            .modern-sidebar.active {
                transform: translateX(0);
            }
            .sidebar-toggle-btn {
                display: block;
                position: fixed;
                top: 12px;
                left: 12px;
                z-index: 1100;
                background: #43e97b;
                color: #fff;
                border: none;
                border-radius: 24px;
                padding: 6px 11px;
                box-shadow: 0 2px 8px rgba(67,233,123,0.08);
            }
            .navbar-form.search-form2 {
                padding: 6px 10px !important;
            }
            .sidebar-menu {
                padding-top: 4px;
                padding-bottom: 8px;
            }
            .sidebar-menu li a {
                padding: 7px 11px;
                font-size: 0.95em;
            }
            .sidebar-menu .treeview-menu li a {
                padding: 5px 11px;
            }
        }
    </style>
    <button class="sidebar-toggle-btn" onclick="document.querySelector('.modern-sidebar').classList.toggle('active')">
        <i class="fa fa-bars"></i>
    </button>
</aside>
<script>
    // Sidebar menu expand/collapse for mobile and desktop
    document.querySelectorAll('.treeview-toggle').forEach(function(toggle) {
        toggle.addEventListener('click', function(e) {
            e.stopPropagation();
            var parent = this.parentElement;
            var submenu = parent.querySelector('.treeview-menu');
            var arrow = this.querySelector('.tree-arrow');
            if (submenu) {
                if (submenu.style.display === "block") {
                    submenu.style.display = "none";
                    if (arrow) arrow.style.transform = "rotate(0deg)";
                } else {
                    // close other open menus
                    document.querySelectorAll('.treeview-menu').forEach(function(menu) {
                        menu.style.display = "none";
                    });
                    document.querySelectorAll('.tree-arrow').forEach(function(a) {
                        a.style.transform = "rotate(0deg)";
                    });
                    submenu.style.display = "block";
                    if (arrow) arrow.style.transform = "rotate(-90deg)";
                    // scroll into view if needed (especially on mobile)
                    if (window.innerWidth <= 991) {
                        setTimeout(function() {
                            submenu.scrollIntoView({behavior: "smooth", block: "nearest"});
                        }, 50);
                    }
                }
            }
        });
    });

    // Close sidebar on outside click for mobile
    document.addEventListener('click', function(e) {
        var sidebar = document.querySelector('.main-sidebar');
        var toggleBtn = document.querySelector('.sidebar-toggle-btn');
        if (window.innerWidth <= 991) {
            if (sidebar.classList.contains('active') && !sidebar.contains(e.target) && !toggleBtn.contains(e.target)) {
                sidebar.classList.remove('active');
                // Close any open submenus
                document.querySelectorAll('.treeview-menu').forEach(function(menu) {
                    menu.style.display = "none";
                });
                document.querySelectorAll('.tree-arrow').forEach(function(a) {
                    a.style.transform = "rotate(0deg)";
                });
            }
        }
    });
</script>