    <!-- Sidebar -->
    <ul class="navbar-nav sidebar sidebar-dark accordion" id="accordionSidebar">

        <!-- Sidebar - Brand -->
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= base_url('homepage'); ?>">
            <div class="sidebar-brand-icon ">
                <i class="fas fa-user-md"></i>
            </div>
            <div class="sidebar-brand-text mx-3">SISTEM PAKAR INDIHOME</div>
        </a>


        <!-- Query Menu -->
        <?php
        $role_id = $this->session->userdata('role_id');
        $queryMenu = "SELECT `user_menu`.`id`, `menu`
                    FROM `user_menu` JOIN `user_access_menu`
                    ON `user_menu`.`id` = `user_access_menu`.`menu_id`
                    WHERE `user_access_menu`.`role_id` = $role_id
                    ORDER BY `user_access_menu`.`menu_id` ASC 
                    ";
        $menu = $this->db->query($queryMenu)->result_array();
        ?>


        <!-- Looping Menu-->
        <?php foreach ($menu as $m) : ?>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                <?= $m['menu']; ?>
            </div>

            <!-- Siapkan Sub-Menu Sesuai Menu -->
            <?php
            $menuId = $m['id'];
            $querySubMenu = "SELECT * FROM `user_sub_menu`
                    WHERE `menu_id` = $menuId
                    AND `is_active` = 1
                ";
            $subMenu = $this->db->query($querySubMenu)->result_array();
            ?>

            <?php foreach ($subMenu as $sm) : ?>
                <!-- Nav Item -->
                <?php if ($title == $sm['title']) : ?>
                    <li class="nav-item active">
                    <?php else : ?>
                    <li class="nav-item">
                    <?php endif; ?>
                    <a class="nav-link pt-1" href="<?= base_url($sm['url']); ?>">
                        <i class=" <?= $sm['icon']; ?> "></i>
                        <span class="title"><?= $sm['title']; ?></span></a>
                    </li>
                <?php endforeach; ?>

            <?php endforeach; ?>

            <!-- Nav Item - Log out -->
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url('auth/logout'); ?>" data-toggle="modal" data-target="#logoutModal">
                    <i class="fas fa-fw fa-sign-out-alt"></i>
                    <span class="title">Log Out</span></a>
            </li>

    </ul>
    <!-- End of Sidebar -->