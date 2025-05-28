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

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar" style="background: #ff6f2c; color: #fff; width: 240px; position: fixed; height: 100vh;">
    <div class="sidebar-header" style="padding: 20px 0; font-size: 22px; font-weight: bold; text-align: center; background: #ff6f2c; letter-spacing: 2px; border-bottom: 1px solid rgba(255,255,255,0.1);">
      <span class="sidebar-title">DOUBLE</span>
    </div>
    <ul class="sidebar-menu" style="list-style: none; padding: 0; margin: 0;">
      <li><a href="<?=base_url()?>" style="display: flex; align-items: center; color: #fff; text-decoration: none; padding: 15px 25px; font-size: 16px;"><i class="fa fa-tachometer-alt" style="margin-right: 12px; font-size: 18px; width: 22px; text-align: center;"></i> Dashboard</a></li>
      <li><a href="<?=base_url('technicians')?>" style="display: flex; align-items: center; color: #fff; text-decoration: none; padding: 15px 25px; font-size: 16px;"><i class="fa fa-user-cog" style="margin-right: 12px; font-size: 18px; width: 22px; text-align: center;"></i> Technicians</a></li>
      <li><a href="<?=base_url('staff')?>" style="display: flex; align-items: center; color: #fff; text-decoration: none; padding: 15px 25px; font-size: 16px;"><i class="fa fa-users" style="margin-right: 12px; font-size: 18px; width: 22px; text-align: center;"></i> Staff</a></li>
      <li><a href="<?=base_url('technicians')?>" style="display: flex; align-items: center; color: #fff; text-decoration: none; padding: 15px 25px; font-size: 16px;"><i class="fa fa-user-cog" style="margin-right: 12px; font-size: 18px; width: 22px; text-align: center;"></i> Technicians</a></li>
      <li><a href="<?=base_url('branches')?>" style="display: flex; align-items: center; color: #fff; text-decoration: none; padding: 15px 25px; font-size: 16px;"><i class="fa fa-code-branch" style="margin-right: 12px; font-size: 18px; width: 22px; text-align: center;"></i> Branches</a></li>
      <li><a href="<?=base_url('part_control')?>" style="display: flex; align-items: center; color: #fff; text-decoration: none; padding: 15px 25px; font-size: 16px;"><i class="fa fa-cogs" style="margin-right: 12px; font-size: 18px; width: 22px; text-align: center;"></i> Part control</a></li>
      <li><a href="<?=base_url('part')?>" style="display: flex; align-items: center; color: #fff; text-decoration: none; padding: 15px 25px; font-size: 16px;"><i class="fa fa-cube" style="margin-right: 12px; font-size: 18px; width: 22px; text-align: center;"></i> Part</a></li>
      <li><a href="<?=base_url('part_order')?>" style="display: flex; align-items: center; color: #fff; text-decoration: none; padding: 15px 25px; font-size: 16px;"><i class="fa fa-shopping-cart" style="margin-right: 12px; font-size: 18px; width: 22px; text-align: center;"></i> Part order</a></li>
      <li class="active"><a href="<?=base_url('job')?>" style="display: flex; align-items: center; color: #fff; text-decoration: none; padding: 15px 25px; font-size: 16px; background: #00bcd4;"><i class="fa fa-briefcase" style="margin-right: 12px; font-size: 18px; width: 22px; text-align: center;"></i> Job</a></li>
      <li><a href="<?=base_url('stock_in')?>" style="display: flex; align-items: center; color: #fff; text-decoration: none; padding: 15px 25px; font-size: 16px;"><i class="fa fa-arrow-down" style="margin-right: 12px; font-size: 18px; width: 22px; text-align: center;"></i> Stock in</a></li>
      <li><a href="<?=base_url('stock_out')?>" style="display: flex; align-items: center; color: #fff; text-decoration: none; padding: 15px 25px; font-size: 16px;"><i class="fa fa-arrow-up" style="margin-right: 12px; font-size: 18px; width: 22px; text-align: center;"></i> Stock out</a></li>
      <li><a href="<?=base_url('login/logout')?>" style="display: flex; align-items: center; color: #fff; text-decoration: none; padding: 15px 25px; font-size: 16px;"><i class="fa fa-sign-out-alt" style="margin-right: 12px; font-size: 18px; width: 22px; text-align: center;"></i> Log out</a></li>
    </ul>
  </aside>


  