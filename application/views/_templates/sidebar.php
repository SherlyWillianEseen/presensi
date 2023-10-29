<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="<?= base_url('user') ?>" class="brand-link">
      <img src="<?= base_url('assets/vendors/adminlte/') ?>dist/img/AdminLTELogo.png" alt="AdminLTE Logo"
        class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">Presensi</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="<?= base_url('assets/img/profile/') . $user['image']; ?>" class="img-circle elevation-2"
            alt="User Image">
        </div>
        <div class="info">
          <a href="<?= base_url('user') ?>" class="d-block"><?= $user['name']; ?></a>
        </div>
      </div>

      <!-- QUERY MENU -->
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

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

          <!-- LOOPING MENU -->
          <?php foreach ($menu as $m) : ?>
          <li class="nav-header">
            <?= $m['menu']; ?>
          </li>

          <!-- QUERY SUB-MENU SESUAI MENU -->
          <?php 
          $menuId = $m['id'];
            $querySubMenu = "SELECT *
                                FROM `user_sub_menu` JOIN `user_menu` 
                                  ON `user_sub_menu`.`menu_id` = `user_menu`.`id`
                              WHERE `user_sub_menu`.`menu_id` = $menuId
                                AND `user_sub_menu`.`is_active` = 1
                        ";
            $subMenu = $this->db->query($querySubMenu)->result_array();
          ?>

          <!-- LOOPING SUBMENU -->
          <?php foreach ($subMenu as $sm) : ?>
          <li class="nav-item">
            <?php if ($title == $sm['title']) : ?>
            <a href="<?= base_url($sm['url']); ?>" class="nav-link active">
              <?php else : ?>
              <a href="<?= base_url($sm['url']); ?>" class="nav-link">
                <?php endif; ?>
                <i class="nav-icon <?= $sm['icon']; ?>"></i>
                <p>
                  <?= $sm['title']; ?>
                </p>
              </a>
          </li>
          <!-- AKHIR LOOPING SUBMENU -->
          <?php endforeach; ?>

          <!-- AKHIR LOOPING MENU -->
          <?php endforeach; ?>

          <li class="nav-header">Pengaturan</li>
          <li class="nav-item">
            <a href="<?= base_url('auth/logout')?>" class="nav-link">
              <i class="nav-icon fas fa-fw fa-sign-out-alt"></i>
              <p>Logout</p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>