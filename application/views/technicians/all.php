<?php $ajax = 'technicians'; ?>

<!-- External CSS -->
<link rel="stylesheet" href="<?=base_url('assets/css/technicians.css')?>">

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper technicians-page">
    <!-- Enhanced Content Header -->
    <section class="technicians-header">
      <div class="container-fluid">
        <div class="row align-items-center">
          <div class="col-md-6">
            <div class="page-title">
              <h1 class="m-0">
                <i class="fas fa-users-cog mr-3"></i>Technicians Management
              </h1>
              <p class="lead mb-0 mt-2 opacity-75">Manage your technical team efficiently</p>
            </div>
          </div>
          <div class="col-md-6 text-md-right">
            <ol class="breadcrumb justify-content-md-end">
              <li class="breadcrumb-item"><a href="<?=base_url()?>"><i class="fas fa-home"></i> Home</a></li>
              <li class="breadcrumb-item active">Technicians</li>
            </ol>
          </div>
        </div>
      </div>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <!-- Enhanced Main Card -->
            <div class="card technicians-main-card">
              <div class="card-header technicians-card-header d-flex justify-content-between align-items-center">
                <div>
                  <h3 class="card-title text-white mb-0">
                    <i class="fas fa-list mr-2"></i>All Technicians
                  </h3>
                  <small class="text-white opacity-75">Manage your technical staff</small>
                </div>
                <?php if($this->session->userdata('user_type') =='1' OR $this->session->userdata('user_type') =='4'){ ?>
                <button class="btn btn-light" id="add_btn">
                  <i class="fas fa-plus mr-2"></i>Add Technician
                </button>
                <?php } ?>
              </div>
              
              <!-- Enhanced Card Body -->
              <div class="card-body p-0">
                <div class="table-responsive">
                  <table id="all_data" class="table technicians-table">
                    <thead>
                      <tr>
                        <th width="5%">#</th>
                        <th width="20%">Name</th>
                        <th width="15%">Username</th>
                        <th width="20%">Email</th>
                        <th width="15%">Phone</th>
                        <th width="10%">Status</th>
                        <th width="15%" class="text-center">Actions</th>
                      </tr>
                    </thead>
                    <tbody>
                      <!-- Table data will be populated by JavaScript -->
                    </tbody> 
                    <tfoot>
                      <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Status</th>
                        <th class="text-center">Actions</th>
                      </tr>
                    </tfoot>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>



  <!-- Enhanced Add/Edit Modal -->
  <div class="modal fade technician-modal" id="edit_data">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="edit_modal_title">
            <i class="fas fa-user-plus mr-2"></i>Add Technician
          </h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="<?=base_url('technicians/add_data')?>" method="post" id="submit_data" enctype="multipart/form-data">
          <div class="modal-body">
            <input type="hidden" name="id" class="form-control id">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label><i class="fas fa-user mr-1"></i>Name</label>
                  <input type="text" name="name" class="form-control name" placeholder="Enter technician name" required>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label><i class="fas fa-id-badge mr-1"></i>Username</label>
                  <input type="text" name="username" class="form-control username" placeholder="Enter username" required>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label><i class="fas fa-envelope mr-1"></i>Email</label>
                  <input type="email" name="email" class="form-control email" placeholder="Enter email address" required>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label><i class="fas fa-phone mr-1"></i>Phone</label>
                  <input type="text" name="phone" class="form-control phone" placeholder="Enter phone number" required>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label><i class="fas fa-calendar mr-1"></i>Date of Birth</label>
                  <input type="date" name="dob" class="form-control dob" placeholder="Select date of birth" required>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label><i class="fas fa-lock mr-1"></i>Password</label>
                  <input type="password" name="password" class="form-control" placeholder="Enter new password (optional)">
                  <small class="form-text text-muted">Leave blank to keep current password</small>
                </div>
              </div>
              <div class="col-md-12">
                <div class="form-group">
                  <label><i class="fas fa-map-marker-alt mr-1"></i>Address</label>
                  <input type="text" name="address" class="form-control address" placeholder="Enter address">
                </div>
              </div>
              <?php if($this->session->userdata('user_type') =='1' || $this->session->userdata('user_type') =='4'){ ?>
              <div class="col-md-12">
                <div class="form-group">
                  <label><i class="fas fa-building mr-1"></i>Branch Assignment</label>
                  <select name="branch[]" class="form-control branch select2" multiple required style="width:100%">
                    <?php foreach($branch as $branchs){ ?>
                      <option value="<?=$branchs->id?>"><?=$branchs->name?></option>
                    <?php } ?>
                  </select>
                  <small class="form-text text-muted">Select one or more branches for this technician</small>
                </div>
              </div>
              <?php } ?>
              <div class="col-md-12">
                <div class="form-group">
                  <label><i class="fas fa-key mr-1"></i>Permissions</label>
                  <div class="permission-checkboxes">
                    <div class="row">
                      <?php foreach($permission as $permis){ ?>
                      <div class="col-md-4">
                        <div class="form-check">
                          <input class="form-check-input" name="permission[]" type="checkbox" value="<?=$permis->slug?>" id="<?=$permis->slug?>">
                          <label class="form-check-label" for="<?=$permis->slug?>">
                            <i class="fas fa-check-circle mr-1"></i><?=$permis->name?>
                          </label>
                        </div>
                      </div>
                      <?php } ?>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">
              <i class="fas fa-times mr-2"></i>Cancel
            </button>
            <button type="submit" class="btn btn-primary">
              <i class="fas fa-save mr-2"></i>Save Technician
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
    
  <!-- Enhanced View Modal -->
  <div class="modal fade technician-modal" id="view_data">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">
            <i class="fas fa-eye mr-2"></i>Technician Details
          </h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body view_table">
          <!-- Content will be populated by JavaScript -->
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">
            <i class="fas fa-times mr-2"></i>Close
          </button>
        </div>
      </div>
    </div>
  </div>