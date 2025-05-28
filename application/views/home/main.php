

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Dashboard ggg</h1>  
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->



<div class="container-fluid">

  <?php // print_r($_SESSION['permission']);?>
<?php if(($this->session->userdata('user_type') =='1') OR ($this->session->userdata('user_type') =='4')) { ?>
    <div class="row">
      
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
              <span class="info-box-icon bg-info elevation-1"><i class="fas fa-tasks"></i></span>
              <a href="<?=base_url('job'); ?>">
                <div class="info-box-content">
                  <span class="info-box-text">Services</span>
                  <span class="info-box-number">
                    <?=$service?>
                    <small></small>
                  </span>
                </div>
              </a>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          

          <!-- fix for small devices only -->
          <div class="clearfix hidden-md-up"></div>

          <!-- /.col -->
          <div class="col-12 col-sm-6 col-md-3">
            <a href="<?=base_url('job'); ?>">
              <div class="info-box mb-3">
                <span class="info-box-icon bg-primary elevation-1"><i class="fas fa-users"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">Total client</span>
                  <span class="info-box-number"><?=$service?></span>
                </div>
                <!-- /.info-box-content -->
              </div>
            </a>

            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-12 col-sm-6 col-md-3">
            <a href="<?=base_url('job'); ?>?status=Pending">
              <div class="info-box mb-3">
                <span class="info-box-icon bg-dark elevation-1"><i class="fas fa-tools"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">Pending Repairs</span>
                  <span class="info-box-number"><?=$pending?></span>
                </div>
                <!-- /.info-box-content -->
              </div>
            </a>

            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          
          <div class="col-12 col-sm-6 col-md-3">
            <a href="<?=base_url('job'); ?>?status=Progress">
              <div class="info-box mb-3">
                <span class="info-box-icon bg-info elevation-1"><i class="fas fa-tools"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">In Progress Repairs</span>
                  <span class="info-box-number"><?=$progress?></span>
                </div>
                <!-- /.info-box-content -->
              </div>
            </a>
            <!-- /.info-box -->
          </div>
          <div class="col-12 col-sm-6 col-md-3">
            <a href="<?=base_url('job'); ?>?status=Waiting">
              <div class="info-box mb-3">
                <span class="info-box-icon bg-primary elevation-1"><i class="fas fa-tools"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">Waiting for confirmation</span>
                  <span class="info-box-number"><?=$wait?></span>
                </div>
                <!-- /.info-box-content -->
              </div>
            </a>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <!-- /.col -->
          <div class="col-12 col-sm-6 col-md-3">
            <a href="<?=base_url('job'); ?>?status=QC">
              <div class="info-box mb-3">
                <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-tools"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">QC</span>
                  <span class="info-box-number"><?=$qc?></span>
                </div>
                <!-- /.info-box-content -->
              </div>
            </a>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-12 col-sm-6 col-md-3">
            <a href="<?=base_url('job'); ?>?status=Ready">
              <div class="info-box mb-3">
                <span class="info-box-icon bg-success elevation-1"><i class="fas fa-tools"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">Ready to pick up</span>
                  <span class="info-box-number"><?=$ready?></span>
                </div>
                <!-- /.info-box-content -->
              </div>
            </a>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-12 col-sm-6 col-md-3">
            <a href="<?=base_url('job'); ?>?status=Picked">
              <div class="info-box mb-3">
                <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-tools"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">Picked up</span>
                  <span class="info-box-number"><?=$picked?></span>
                </div>
                <!-- /.info-box-content -->
              </div>
            </a>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->

          <div class="col-12 col-sm-6 col-md-3">
            <a href="<?=base_url('job'); ?>?status=Couriered">
              <div class="info-box mb-3">
                <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-tools"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">Couriered</span>
                  <span class="info-box-number"><?=$couriered?></span>
                </div>
                <!-- /.info-box-content -->
              </div>
            </a>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->


        </div>
      <?php } ?>



      <?php if($this->session->userdata('user_type') =='4'){ ?>
      <div class="row">

         <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
              <span class="info-box-icon bg-info elevation-1"><i class="fas fa-tasks"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Brand</span>
                <span class="info-box-number">
                  <?=$brand?>
                  <small></small>
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
              <span class="info-box-icon bg-info elevation-1"><i class="fas fa-tasks"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Model</span>
                <span class="info-box-number">
                  <?=$model?>
                  <small></small>
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->

          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
              <span class="info-box-icon bg-info elevation-1"><i class="fas fa-tasks"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Part type</span>
                <span class="info-box-number">
                  <?=$part_type?>
                  <small></small>
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->

             <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
              <span class="info-box-icon bg-info elevation-1"><i class="fas fa-tasks"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Parts & Price</span>
                <span class="info-box-number">
                  <?=$part?>
                  <small></small>
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->

      </div>

    <?php } ?>


        


</div>
  </div>