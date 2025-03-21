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
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="<?=base_url()?>" class="brand-link m-1" style="height: 68px;">
      <img src="<?= base_url();?>assets/dist/img/new_logo.jpg" alt="AdminLTE Logo" class="brand-image img-circle elevation-3">
      <span class="brand-text font-weight-light" style="color:#ffff0082">
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
      </span>
    </a>

	<?php 
		  $permission = explode("--",$_SESSION['permission']);
		?>
    <!-- Sidebar -->
    <div class="sidebar">

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <?php $uri =  $this->uri->segment(1);?>
          <?php $uri2 =  $this->uri->segment(2);?>
          <li class="nav-item ">
            <a href="<?=base_url()?>" class="nav-link <?=$uri =='' ? 'active':'' ?>">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard  
              </p>
            </a>
          </li>


          <?php /* if(in_array('users',$permission)){ ?>

          <li class="nav-item">
            <a href="<?=base_url('users')?>" class="nav-link <?= $uri =='users' ? 'active':'' ?>">
              <i class="nav-icon fas fa-user"></i>
              <p>
                User
              </p>
            </a>
          </li>
        <?php } */ ?>

		  <?php /* if(in_array('users',$permission) OR in_array('user_type',$permission)){ ?>
          <li class="nav-item  <?= $uri =='users' ? 'menu-is-opening menu-open':'' ?> <?= $uri =='user_type' ? 'menu-is-opening menu-open':'' ?>">
            <a href="#" class="nav-link <?= $uri =='users' ? 'active':'' ?> <?= $uri =='user_type' ? 'active':'' ?>">
              <i class="nav-icon fas fa-user"></i>
              <p>
                User
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <?php if(in_array('users',$permission)){ ?>
                <li class="nav-item"> 
                  <a href="<?=base_url('users')?>" class="nav-link <?=$uri =='users' ? 'active':'' ?>">
                  <i class="far fa-circle nav-icon"></i>
                    <p>
                      Users
                    </p>
                  </a>
                </li>
				<?php } ?>
				<?php if(in_array('user_type',$permission)){ ?>
                <li class="nav-item">
                  <a href="<?=base_url('user_type')?>" class="nav-link <?=$uri =='user_type' ? 'active':'' ?>">
                  <i class="far fa-circle nav-icon"></i>
                    <p>
                      User type
                    </p>
                  </a>
                </li>
				<?php } ?>
            </ul>
          </li>
		  <?php } */ ?>


      <?php if(in_array('staff',$permission)){ ?>

          <li class="nav-item">
            <a href="<?=base_url('staff')?>" class="nav-link <?= $uri =='staff' ? 'active':'' ?>">
              <i class="nav-icon fas fa-user"></i>
              <p>
                Staff
              </p>
            </a>
          </li>
        <?php } ?>

        <?php if(in_array('technicians',$permission)){ ?>

          <li class="nav-item">
            <a href="<?=base_url('technicians')?>" class="nav-link <?= $uri =='technicians' ? 'active':'' ?>">
              <i class="nav-icon fas fa-user"></i>
              <p>
                Technicians
              </p>
            </a>
          </li>
        <?php } ?>

        <?php if(in_array('part_corntroller',$permission)){ ?>

          <li class="nav-item">
            <a href="<?=base_url('part_corntroller')?>" class="nav-link <?= $uri =='part_corntroller' ? 'active':'' ?>">
              <i class="nav-icon fas fa-user"></i>
              <p>
                Part corntroller
              </p>
            </a>
          </li>
        <?php } ?>


      <?php if(in_array('branch',$permission)){ ?>

          <li class="nav-item">
            <a href="<?=base_url('branch')?>" class="nav-link <?= $uri =='branch' ? 'active':'' ?>">
              <i class="nav-icon fas fa-cogs"></i>
              <p>
                Branch
              </p>
            </a>
          </li>
      <?php } ?>

      <?php  if(in_array('part_type',$permission) OR in_array('part',$permission) OR in_array('brand',$permission) OR in_array('model',$permission)){ ?>
          <li class="nav-item  <?= $uri =='part' ? 'menu-is-opening menu-open':'' ?> <?= $uri =='brand' ? 'menu-is-opening menu-open':'' ?> <?= $uri =='model' ? 'menu-is-opening menu-open':'' ?>">
            <a href="#" class="nav-link <?= $uri =='part_type' ? 'active':'' ?> <?= $uri =='part' ? 'active':'' ?> <?= $uri =='brand' ? 'active':'' ?> <?= $uri =='model' ? 'active':'' ?>">
              <i class="nav-icon fas fa-clipboard"></i>
              <p>
                Part
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <?php if(in_array('brand',$permission)){ ?>
                <li class="nav-item"> 
                  <a href="<?=base_url('part/brand')?>" class="nav-link <?=$uri2 =='brand' ? 'active':'' ?>">
                  <i class="far fa-circle nav-icon"></i>
                    <p>
                      Brand Name
                    </p>
                  </a>
                </li>
        <?php } ?>
        <?php if(in_array('model',$permission)){ ?>
                <li class="nav-item">
                  <a href="<?=base_url('part/model')?>" class="nav-link <?=$uri2 =='model' ? 'active':'' ?>">
                  <i class="far fa-circle nav-icon"></i>
                    <p>
                      Model Name
                    </p>
                  </a>
                </li>
        <?php } ?>
        <?php if(in_array('part_type',$permission)){ ?>
                <li class="nav-item">
                  <a href="<?=base_url('part/part_type')?>" class="nav-link <?=$uri2 =='part_type' ? 'active':'' ?>">
                  <i class="far fa-circle nav-icon"></i>
                    <p>
                      Part Type
                    </p>
                  </a>
                </li>
        <?php } ?>
        <?php if(in_array('part',$permission)){ ?>
                <li class="nav-item">
                  <a href="<?=base_url('part')?>" class="nav-link <?=$uri2==''? ($uri =='part' ? 'active':''):'' ?>">
                  <i class="far fa-circle nav-icon"></i>
                    <p>
                      Part name & Price
                    </p>
                  </a>
                </li>
        <?php } ?>
            </ul>
          </li>
      <?php } ?>

     

      <?php if(in_array('job',$permission)){ ?>
          <li class="nav-item">
            <a href="<?=base_url('job')?>" class="nav-link <?= $uri =='job' ? 'active':'' ?>">
              <i class="nav-icon fas fa-cogs"></i>
              <p>
                Job
              </p>
            </a>
          </li>
      <?php } ?>
          

		  <?php if(in_array('challan',$permission)){ ?>
          <li class="nav-item">
            <a href="<?=base_url('challan')?>" class="nav-link <?= $uri =='challan' ? 'active':'' ?>">
              <i class="nav-icon fas fa-cogs"></i>
              <p>
                Challan
              </p>
            </a>
          </li>
		  <?php } ?>
		  
		  <?php if(in_array('billty',$permission)){ ?>
          <li class="nav-item">
            <a href="<?=base_url('billty')?>" class="nav-link <?= $uri =='billty' ? 'active':'' ?>">
              <i class="nav-icon fas fa-cogs"></i>
              <p>
                Billty
              </p>
            </a>
          </li>
		  <?php } ?>
		  
		  <?php if(in_array('payment',$permission)){ ?>
          <li class="nav-item">
            <a href="<?=base_url('payment')?>" class="nav-link <?= $uri =='payment' ? 'active':'' ?>">
              <i class="nav-icon fas fa-cogs"></i>
              <p>
                Payment
              </p>
            </a>
          </li>
		  <?php } ?>
		  
		  
		  <?php if(in_array('book',$permission) OR in_array('booking',$permission)){ ?>
          <li class="nav-item  <?= $uri =='users' ? 'menu-is-opening menu-open':'' ?> <?= $uri =='user_type' ? 'menu-is-opening menu-open':'' ?>">
            <a href="#" class="nav-link <?= $uri =='users' ? 'active':'' ?> <?= $uri =='user_type' ? 'active':'' ?>">
              <i class="nav-icon fas fa-user"></i>
              <p>
                Booking
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <?php if(in_array('users',$permission)){ ?>
                <li class="nav-item"> 
                  <a href="<?=base_url('book')?>" class="nav-link <?=$uri =='book' ? 'active':'' ?>">
                  <i class="far fa-circle nav-icon"></i>
                    <p>
                      Book
                    </p>
                  </a>
                </li>
				<?php } ?>
				<?php if(in_array('booking',$permission)){ ?>
                <li class="nav-item">
                  <a href="<?=base_url('booking')?>" class="nav-link <?=$uri =='booking' ? 'active':'' ?>">
                  <i class="far fa-circle nav-icon"></i>
                    <p>
                      All Booking
                    </p>
                  </a>
                </li>
				<?php } ?>
            </ul>
          </li>
		  <?php } ?>
			
		   
		   <?php if(in_array('permission',$permission)){ ?>
		    <li class="nav-item">
            <a href="<?=base_url('permission')?>" class="nav-link <?= $uri =='permission' ? 'active':'' ?>">
              <i class="nav-icon fas fa-cogs"></i>
              <p>
                Permission
              </p>
            </a>
          </li> 
		   <?php } ?>
        

          <li class="nav-item">
            <a href="<?=base_url('login/logout')?>" class="nav-link">
              <i class="nav-icon fas fa-sign-out-alt"></i>
              <p>
                Log out
              </p>
            </a>
          </li>
          
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>


  