

  <!-- Custom Dashboard Styles -->
<style>
.dashboard-card {
    transition: all 0.3s ease;
    border: none;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

.dashboard-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 25px rgba(0,0,0,0.15);
}

.dashboard-card .card-body {
    padding: 1.5rem;
}

.dashboard-card h2 {
    font-weight: 700;
    font-size: 2.5rem;
    line-height: 1;
}

.dashboard-card h5 {
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    font-size: 0.9rem;
}

.dashboard-card .card-footer {
    padding: 1rem 1.5rem;
    background: rgba(255,255,255,0.1) !important;
    border-top: 1px solid rgba(255,255,255,0.2) !important;
}

.dashboard-card .card-footer a {
    transition: all 0.2s ease;
}

.dashboard-card .card-footer a:hover {
    text-decoration: underline !important;
    opacity: 0.8;
}

.bg-gradient-primary {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%) !important;
}

.bg-gradient-info {
    background: linear-gradient(135deg, #36d1dc 0%, #5b86e5 100%) !important;
}

.bg-gradient-success {
    background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%) !important;
}

.bg-gradient-warning {
    background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%) !important;
}

@media (max-width: 768px) {
    .dashboard-card h2 {
        font-size: 2rem;
    }
    
    .dashboard-card .card-body {
        padding: 1rem;
    }
    
    .dashboard-card .card-footer {
        padding: 0.75rem 1rem;
    }
}

/* Animation for numbers */
@keyframes countUp {
    from { opacity: 0; transform: translateY(20px); }
    to { opacity: 1; transform: translateY(0); }
}

.dashboard-card h2 {
    animation: countUp 0.6s ease-out;
}

/* Icon animations */
.fa-spin {
    animation: spin 2s linear infinite;
}

@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}

/* Card hover effects */
.dashboard-card:hover .fa-2x {
    transform: scale(1.1);
    transition: transform 0.3s ease;
}
</style>

<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Dashboard</h1>  
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
    
    <!-- Job Status Overview Section -->
    <div class="row mb-4">
      <div class="col-12">
        <div class="card">
          <div class="card-header bg-gradient-primary">
            <h3 class="card-title text-white mb-0">
              <i class="fas fa-chart-line mr-2"></i>Job Status Overview
            </h3>
          </div>
          <div class="card-body">
            <div class="row">
              <!-- Total Services -->
              <div class="col-lg-3 col-md-6 mb-4">
                <div class="card bg-info text-white h-100 dashboard-card">
                  <div class="card-body">
                    <div class="d-flex align-items-center">
                      <div class="flex-grow-1">
                        <h5 class="card-title mb-0">Total Services</h5>
                        <h2 class="mb-0"><?=$service?></h2>
                      </div>
                      <div class="ml-3">
                        <i class="fas fa-tasks fa-2x opacity-75"></i>
                      </div>
                    </div>
                  </div>
                  <div class="card-footer bg-transparent border-0">
                    <a href="<?=base_url('job'); ?>" class="text-white text-decoration-none">
                      View All Jobs <i class="fas fa-arrow-right ml-1"></i>
                    </a>
                  </div>
                </div>
              </div>
              
              <!-- Total Clients -->
              <div class="col-lg-3 col-md-6 mb-4">
                <div class="card bg-primary text-white h-100 dashboard-card">
                  <div class="card-body">
                    <div class="d-flex align-items-center">
                      <div class="flex-grow-1">
                        <h5 class="card-title mb-0">Total Clients</h5>
                        <h2 class="mb-0"><?=$service?></h2>
                      </div>
                      <div class="ml-3">
                        <i class="fas fa-users fa-2x opacity-75"></i>
                      </div>
                    </div>
                  </div>
                  <div class="card-footer bg-transparent border-0">
                    <a href="<?=base_url('job'); ?>" class="text-white text-decoration-none">
                      View Clients <i class="fas fa-arrow-right ml-1"></i>
                    </a>
                  </div>
                </div>
              </div>
              
              <!-- Pending Repairs -->
              <div class="col-lg-3 col-md-6 mb-4">
                <div class="card bg-warning text-white h-100 dashboard-card">
                  <div class="card-body">
                    <div class="d-flex align-items-center">
                      <div class="flex-grow-1">
                        <h5 class="card-title mb-0">Pending Repairs</h5>
                        <h2 class="mb-0"><?=$pending?></h2>
                      </div>
                      <div class="ml-3">
                        <i class="fas fa-clock fa-2x opacity-75"></i>
                      </div>
                    </div>
                  </div>
                  <div class="card-footer bg-transparent border-0">
                    <a href="<?=base_url('job'); ?>?status=Pending" class="text-white text-decoration-none">
                      View Pending <i class="fas fa-arrow-right ml-1"></i>
                    </a>
                  </div>
                </div>
              </div>
              
              <!-- In Progress -->
              <div class="col-lg-3 col-md-6 mb-4">
                <div class="card bg-info text-white h-100 dashboard-card">
                  <div class="card-body">
                    <div class="d-flex align-items-center">
                      <div class="flex-grow-1">
                        <h5 class="card-title mb-0">In Progress</h5>
                        <h2 class="mb-0"><?=$progress?></h2>
                      </div>
                      <div class="ml-3">
                        <i class="fas fa-cog fa-spin fa-2x opacity-75"></i>
                      </div>
                    </div>
                  </div>
                  <div class="card-footer bg-transparent border-0">
                    <a href="<?=base_url('job'); ?>?status=Progress" class="text-white text-decoration-none">
                      View In Progress <i class="fas fa-arrow-right ml-1"></i>
                    </a>
                  </div>
                </div>
              </div>
            </div>
            
            <!-- Second Row of Status Cards -->
            <div class="row">
              <!-- Waiting -->
              <div class="col-lg-3 col-md-6 mb-4">
                <div class="card bg-secondary text-white h-100 dashboard-card">
                  <div class="card-body">
                    <div class="d-flex align-items-center">
                      <div class="flex-grow-1">
                        <h5 class="card-title mb-0">Waiting</h5>
                        <h2 class="mb-0"><?=$wait?></h2>
                      </div>
                      <div class="ml-3">
                        <i class="fas fa-hourglass-half fa-2x opacity-75"></i>
                      </div>
                    </div>
                  </div>
                  <div class="card-footer bg-transparent border-0">
                    <a href="<?=base_url('job'); ?>?status=Waiting" class="text-white text-decoration-none">
                      View Waiting <i class="fas fa-arrow-right ml-1"></i>
                    </a>
                  </div>
                </div>
              </div>
              
              <!-- QC -->
              <div class="col-lg-3 col-md-6 mb-4">
                <div class="card bg-warning text-white h-100 dashboard-card">
                  <div class="card-body">
                    <div class="d-flex align-items-center">
                      <div class="flex-grow-1">
                        <h5 class="card-title mb-0">QC</h5>
                        <h2 class="mb-0"><?=$qc?></h2>
                      </div>
                      <div class="ml-3">
                        <i class="fas fa-search fa-2x opacity-75"></i>
                      </div>
                    </div>
                  </div>
                  <div class="card-footer bg-transparent border-0">
                    <a href="<?=base_url('job'); ?>?status=QC" class="text-white text-decoration-none">
                      View QC <i class="fas fa-arrow-right ml-1"></i>
                    </a>
                  </div>
                </div>
              </div>
              
              <!-- Ready -->
              <div class="col-lg-3 col-md-6 mb-4">
                <div class="card bg-success text-white h-100 dashboard-card">
                  <div class="card-body">
                    <div class="d-flex align-items-center">
                      <div class="flex-grow-1">
                        <h5 class="card-title mb-0">Ready</h5>
                        <h2 class="mb-0"><?=$ready?></h2>
                      </div>
                      <div class="ml-3">
                        <i class="fas fa-check-circle fa-2x opacity-75"></i>
                      </div>
                    </div>
                  </div>
                  <div class="card-footer bg-transparent border-0">
                    <a href="<?=base_url('job'); ?>?status=Ready" class="text-white text-decoration-none">
                      View Ready <i class="fas fa-arrow-right ml-1"></i>
                    </a>
                  </div>
                </div>
              </div>
              
              <!-- Picked Up -->
              <div class="col-lg-3 col-md-6 mb-4">
                <div class="card bg-danger text-white h-100 dashboard-card">
                  <div class="card-body">
                    <div class="d-flex align-items-center">
                      <div class="flex-grow-1">
                        <h5 class="card-title mb-0">Picked Up</h5>
                        <h2 class="mb-0"><?=$picked?></h2>
                      </div>
                      <div class="ml-3">
                        <i class="fas fa-hand-holding fa-2x opacity-75"></i>
                      </div>
                    </div>
                  </div>
                  <div class="card-footer bg-transparent border-0">
                    <a href="<?=base_url('job'); ?>?status=Picked" class="text-white text-decoration-none">
                      View Picked <i class="fas fa-arrow-right ml-1"></i>
                    </a>
                  </div>
                </div>
              </div>
            </div>
            
            <!-- Couriered Status -->
            <div class="row">
              <div class="col-lg-3 col-md-6 mb-4">
                <div class="card bg-dark text-white h-100 dashboard-card">
                  <div class="card-body">
                    <div class="d-flex align-items-center">
                      <div class="flex-grow-1">
                        <h5 class="card-title mb-0">Couriered</h5>
                        <h2 class="mb-0"><?=$couriered?></h2>
                      </div>
                      <div class="ml-3">
                        <i class="fas fa-shipping-fast fa-2x opacity-75"></i>
                      </div>
                    </div>
                  </div>
                  <div class="card-footer bg-transparent border-0">
                    <a href="<?=base_url('job'); ?>?status=Couriered" class="text-white text-decoration-none">
                      View Couriered <i class="fas fa-arrow-right ml-1"></i>
                    </a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <?php } ?>



      <?php if($this->session->userdata('user_type') =='4'){ ?>
    <!-- Inventory Overview Section -->
    <div class="row mb-4">
      <div class="col-12">
        <div class="card">
          <div class="card-header bg-gradient-success">
            <h3 class="card-title text-white mb-0">
              <i class="fas fa-boxes mr-2"></i>Inventory Overview
            </h3>
          </div>
          <div class="card-body">
            <div class="row">
              <!-- Brands -->
              <div class="col-lg-3 col-md-6 mb-4">
                <div class="card bg-gradient-info text-white h-100 dashboard-card">
                  <div class="card-body">
                    <div class="d-flex align-items-center">
                      <div class="flex-grow-1">
                        <h5 class="card-title mb-0">Brands</h5>
                        <h2 class="mb-0"><?=$brand?></h2>
                      </div>
                      <div class="ml-3">
                        <i class="fas fa-tag fa-2x opacity-75"></i>
                      </div>
                    </div>
                  </div>
                  <div class="card-footer bg-transparent border-0">
                    <small class="text-white opacity-75">Total brands in system</small>
                  </div>
                </div>
              </div>
              
              <!-- Models -->
              <div class="col-lg-3 col-md-6 mb-4">
                <div class="card bg-gradient-primary text-white h-100 dashboard-card">
                  <div class="card-body">
                    <div class="d-flex align-items-center">
                      <div class="flex-grow-1">
                        <h5 class="card-title mb-0">Models</h5>
                        <h2 class="mb-0"><?=$model?></h2>
                      </div>
                      <div class="ml-3">
                        <i class="fas fa-mobile-alt fa-2x opacity-75"></i>
                      </div>
                    </div>
                  </div>
                  <div class="card-footer bg-transparent border-0">
                    <small class="text-white opacity-75">Device models available</small>
                  </div>
                </div>
              </div>
              
              <!-- Part Types -->
              <div class="col-lg-3 col-md-6 mb-4">
                <div class="card bg-gradient-warning text-white h-100 dashboard-card">
                  <div class="card-body">
                    <div class="d-flex align-items-center">
                      <div class="flex-grow-1">
                        <h5 class="card-title mb-0">Part Types</h5>
                        <h2 class="mb-0"><?=$part_type?></h2>
                      </div>
                      <div class="ml-3">
                        <i class="fas fa-th-large fa-2x opacity-75"></i>
                      </div>
                    </div>
                  </div>
                  <div class="card-footer bg-transparent border-0">
                    <small class="text-white opacity-75">Categories of parts</small>
                  </div>
                </div>
              </div>
              
              <!-- Parts -->
              <div class="col-lg-3 col-md-6 mb-4">
                <div class="card bg-gradient-success text-white h-100 dashboard-card">
                  <div class="card-body">
                    <div class="d-flex align-items-center">
                      <div class="flex-grow-1">
                        <h5 class="card-title mb-0">Parts & Price</h5>
                        <h2 class="mb-0"><?=$part?></h2>
                      </div>
                      <div class="ml-3">
                        <i class="fas fa-cogs fa-2x opacity-75"></i>
                      </div>
                    </div>
                  </div>
                  <div class="card-footer bg-transparent border-0">
                    <small class="text-white opacity-75">Total parts inventory</small>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <?php } ?>


        


</div>
  </div>