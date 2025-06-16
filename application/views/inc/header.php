<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8"> 
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>
    <?php if($this->session->userdata('user_type') =='1'){
          echo 'Admin';
        }elseif($this->session->userdata('user_type') =='2'){
          echo 'Staff';
        }elseif($this->session->userdata('user_type') =='3'){
          echo 'Technician';
        }elseif($this->session->userdata('user_type') =='4'){
          echo 'Branch';
        }elseif($this->session->userdata('user_type') =='5'){
          echo 'Part controler';
        }?>
   | Dashboard</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?= base_url();?>assets/plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">

  <!-- DataTables -->
  <link rel="stylesheet" href="<?= base_url();?>assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="<?= base_url();?>assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="<?= base_url();?>assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
    <!-- Select2 -->
  <link rel="stylesheet" href="<?= base_url();?>assets/plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="<?= base_url();?>assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">

  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="<?= base_url();?>assets/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="<?= base_url();?>assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="<?= base_url();?>assets/plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= base_url();?>assets/dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="<?= base_url();?>assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="<?= base_url();?>assets/plugins/daterangepicker/daterangepicker.css">
  <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
  <!-- summernote -->
  <link rel="stylesheet" href="<?= base_url();?>assets/plugins/summernote/summernote-bs4.min.css">

  <link rel="stylesheet" href="<?= base_url();?>assets/custom/custom.css">
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="<?= base_url();?>assets/dist/img/new_logo.jpg" alt="AdminLTELogo" height="60">
  </div>

  <input type="hidden" name="base_url" class="base_url" value="<?=base_url()?>">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">

      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <?php if($this->session->userdata('name') !=''){
            echo $this->session->userdata('name');
          }else{
            $this->session->userdata('user_name');
          }
          ?> 
          <i class="fas fa-angle-down right"></i>
        </a>
        <div class="dropdown-menu  dropdown-menu-right">
          <a href="<?=base_url('profile')?>" class="dropdown-item">
            <i class="fas fa-user mr-2"></i> Edit
          </a>
          <div class="dropdown-divider"></div>
          <a href="<?=base_url('login/logout')?>" class="nav-link">
              <i class="nav-icon fas fa-sign-out-alt"></i>
                Log out
            </a>
         
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <?php if ($this->uri->segment(1) == 'branches' && $this->session->userdata('user_type') == '4'): ?>
    <div class="alert alert-info text-center m-0" style="border-radius:0;">
      <strong>User type:</strong> Branch
    </div>
  <?php endif; ?>

  <?php $uri = $this->uri->segment(1); ?>
  <?php $user_type = $this->session->userdata('user_type'); ?>
  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="<?=base_url() ?>" class="brand-link">
      <img src="<?= base_url();?>assets/dist/img/desktop_logo.jpg" alt="Desktop Logo" class="brand-image img-circle elevation-3 d-none d-md-inline" style="opacity: .8">
      <img src="<?= base_url();?>assets/dist/img/mobile_logo.jpg" alt="Mobile Logo" class="brand-image img-circle elevation-3 d-inline d-md-none" style="opacity: .8">
      <strong><?= $this->session->userdata('name'); ?></strong> 
      (<small>
        <?php
          if($user_type == '1') echo 'Admin';
          elseif($user_type == '2') echo 'Staff';
          elseif($user_type == '3') echo 'Technician';
          elseif($user_type == '4') echo 'Branch';
          elseif($user_type == '5') echo 'Part Controller';
        ?>
      </small>)
    </a>
    <!-- User Info -->
    <!-- <div class="sidebar-user-info text-center py-2" style="color: #fff;">
      <strong><?= $this->session->userdata('name'); ?></strong><br>
      <small>
        <?php /*
          if($user_type == '1') echo 'Admin';
          elseif($user_type == '2') echo 'Staff';
          elseif($user_type == '3') echo 'Technician';
          elseif($user_type == '4') echo 'Branch';
          elseif($user_type == '5') echo 'Part Controller';
        */ ?>
      </small>
    </div> -->
    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <?php $user_permissions = $this->session->userdata('permission'); ?>

          <?php print_r($user_permissions) ?>
          <?php if (!is_array($user_permissions)) { $user_permissions = []; } // Ensure it's an array ?>

          <?php if(in_array('dashboard', $user_permissions)): ?>
          <li class="nav-item">
            <a href="<?=base_url()?>" class="nav-link <?= $uri == '' ? 'active' : '' ?>">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>Dashboard</p>
            </a>
          </li>
          <?php endif; ?>

          <?php if($user_type != '5'){ // For Admin, Staff, Technician, and Branch users ?>
            <?php if(in_array('technicians', $user_permissions)): ?>
            <li class="nav-item">
              <a href="<?=base_url('technicians')?>" class="nav-link <?= $uri == 'technicians' ? 'active' : '' ?>">
                <i class="nav-icon fas fa-user-cog"></i>
                <p>Technicians</p>
              </a>
            </li>
            <?php endif; ?>
            <?php if(in_array('staff', $user_permissions)): ?>
            <li class="nav-item">
              <a href="<?=base_url('staff')?>" class="nav-link <?= $uri == 'staff' ? 'active' : '' ?>">
                <i class="nav-icon fas fa-users"></i>
                <p>Staff</p>
              </a>
            </li>
            <?php endif; ?>
          <?php } ?>

          <?php if(in_array($user_type, ['1', '5']) && in_array('part_corntroller', $user_permissions)): ?>
          <li class="nav-item">
            <a href="<?=base_url('part_corntroller')?>" class="nav-link <?= $uri == 'part_corntroller' ? 'active' : '' ?>">
              <i class="nav-icon fas fa-cogs"></i>
              <p>Part control</p>
            </a>
          </li>
          <?php endif; ?>

          <?php if(in_array($user_type, ['1', '2', '4']) && in_array('branch', $user_permissions)): ?>
          <li class="nav-item">
            <a href="<?=base_url('branch')?>" class="nav-link <?= $uri == 'branch' ? 'active' : '' ?>">
              <i class="nav-icon fas fa-code-branch"></i>
              <p>Branches</p>
            </a>
          </li>
          <?php endif; ?>

          <?php
            $can_see_part_dropdown = (
                ($user_type != '3') && // Not for Technician
                (in_array('Brand', $user_permissions) || // Changed 'brand' to 'Brand'
                in_array('Modal', $user_permissions) || // Changed 'model' to 'Modal'
                in_array('part_type', $user_permissions) ||
                in_array('part', $user_permissions))
            );
          ?>
          <?php if($can_see_part_dropdown): ?>
          <li class="nav-item has-treeview <?= in_array($uri, ['part', 'brand', 'model', 'part_type']) ? 'menu-open' : '' ?>">
            <a href="#" class="nav-link <?= in_array($uri, ['part', 'brand', 'model', 'part_type']) ? 'active' : '' ?>">
              <i class="nav-icon fas fa-cube"></i>
              <p>
                Part
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <?php if(in_array('Brand', $user_permissions)): ?> // Changed 'brand' to 'Brand'
              <li class="nav-item">
                <a href="<?=base_url('part/brand')?>" class="nav-link <?= $uri == 'part' && $this->uri->segment(2) == 'brand' ? 'active' : '' ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Brand name</p>
                </a>
              </li>
              <?php endif; ?>
              <?php if(in_array('Modal', $user_permissions)): ?> // Changed 'model' to 'Modal'
              <li class="nav-item">
                <a href="<?=base_url('part/model')?>" class="nav-link <?= $uri == 'part' && $this->uri->segment(2) == 'model' ? 'active' : '' ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Model name</p>
                </a>
              </li>
              <?php endif; ?>
              <?php if(in_array('part_type', $user_permissions)): ?>
              <li class="nav-item">
                <a href="<?=base_url('part/part_type')?>" class="nav-link <?= $uri == 'part' && $this->uri->segment(2) == 'part_type' ? 'active' : '' ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Part type</p>
                </a>
              </li>
              <?php endif; ?>
              <?php if(in_array('part', $user_permissions)): ?>
              <li class="nav-item">
                <a href="<?=base_url('part')?>" class="nav-link <?= $uri == 'part' && ($this->uri->segment(2) == '' || $this->uri->segment(2) == null) ? 'active' : '' ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Part name & Price</p>
                </a>
              </li>
              <?php endif; ?>
            </ul>
          </li>
          <?php endif; // end $can_see_part_dropdown ?>

          <?php if(in_array($user_type, ['1', '2', '4', '5']) && in_array('part_order', $user_permissions)): ?>
          <li class="nav-item">
            <a href="<?=base_url('part/order')?>" class="nav-link <?= $uri == 'part' && $this->uri->segment(2) == 'order' ? 'active' : '' ?>">
              <i class="nav-icon fas fa-shopping-cart"></i>
              <p>Part order</p>
            </a>
          </li>
          <?php endif; ?>

          <?php if($user_type != '5' && in_array('Job', $user_permissions)): ?> // Changed 'job' to 'Job'
          <li class="nav-item">
            <a href="<?=base_url('job')?>" class="nav-link <?= $uri == 'job' ? 'active' : '' ?>">
              <i class="nav-icon fas fa-briefcase"></i>
              <p>Job</p>
            </a>
          </li>
          <?php endif; ?>

          <?php if(in_array($user_type, ['1', '2', '4', '5']) && in_array('stock_in', $user_permissions)): ?>
          <li class="nav-item">
            <a href="<?=base_url('stock_in')?>" class="nav-link <?= $uri == 'stock_in' ? 'active' : '' ?>">
              <i class="nav-icon fas fa-arrow-down"></i>
              <p>Stock in</p>
            </a>
          </li>
          <?php endif; ?>

          <?php if(in_array('stock_out', $user_permissions)): ?>
          <li class="nav-item">
            <a href="<?=base_url('stock_out')?>" class="nav-link <?= $uri == 'stock_out' ? 'active' : '' ?>">
              <i class="nav-icon fas fa-arrow-up"></i>
              <p>Stock out</p>
            </a>
          </li>
          <?php endif; ?>

          <!-- Log out - Visible to All -->
          <li class="nav-item">
            <a href="<?=base_url('login/logout')?>" class="nav-link">
              <i class="nav-icon fas fa-sign-out-alt"></i>
              <p>Log out</p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>


