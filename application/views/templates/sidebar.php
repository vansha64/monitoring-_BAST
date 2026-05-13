<?php
$role_id = $this->session->userdata('role_id');

// Query menu sesuai role
$queryMenu = "SELECT `user_menu`.`id`, `menu`
              FROM `user_menu`
              JOIN `user_access_menu` 
              ON `user_menu`.`id` = `user_access_menu`.`menu_id`
              WHERE `user_access_menu`.`role_id` = $role_id
              ORDER BY `user_access_menu`.`menu_id` ASC";
$menu = $this->db->query($queryMenu)->result_array();
?>

<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

        <?php foreach ($menu as $m) : ?>
            <?php
            $menuId = $m['id'];
            $querySubmenu = "SELECT * FROM `user_sub_menu` 
                             WHERE `menu_id`=$menuId 
                             AND `is_active`=1";
            $subMenu = $this->db->query($querySubmenu)->result_array();
            ?>

            <?php if (!empty($subMenu)) : ?>
                <!-- Menu dengan Submenu -->
                <li class="nav-item">
                    <a class="nav-link collapsed" data-bs-target="#menu-<?= $menuId; ?>" data-bs-toggle="collapse" href="#">
                        <i class="bi bi-menu-button-wide"></i>
                        <span><?= $m['menu']; ?></span>
                        <i class="bi bi-chevron-down ms-auto"></i>
                    </a>
                    <ul id="menu-<?= $menuId; ?>" class="nav-content collapse" data-bs-parent="#sidebar-nav">
                        <?php foreach ($subMenu as $sm) : ?>
                            <li>
                                <a href="<?= base_url($sm['url']); ?>">
                                    <i class="<?= !empty($sm['icon']) ? $sm['icon'] : 'bi bi-circle'; ?>"></i>
                                    <span><?= $sm['title']; ?></span>
                                </a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </li>
            <?php else : ?>
                <!-- Menu tanpa Submenu -->
                <li class="nav-item">
                    <a class="nav-link collapsed" href="#">
                        <i class="bi bi-menu-button-wide"></i>
                        <span><?= $m['menu']; ?></span>
                    </a>
                </li>
            <?php endif; ?>
        <?php endforeach; ?>

    </ul>
</aside>
<!-- End Sidebar -->
