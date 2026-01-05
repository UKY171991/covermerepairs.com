<?php $ajax = 'technicians'; ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>All Technicians</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Technicians</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card modern-table-card">
              <div class="card-header">
                  <h3 class="card-title"><i class="fas fa-users-cog mr-2"></i> Technicians List</h3>
                  <div class="card-tools">
                    <?php if($this->session->userdata('user_type') =='1' OR $this->session->userdata('user_type') =='4'){ ?>
                    <button class="btn btn-light btn-sm shadow-sm" id="add_btn" style="border-radius: 8px; font-weight: 600; padding: 0.5rem 1.25rem;">
                        <i class="fas fa-plus mr-1"></i> Add Technician
                    </button>
                    <?php } ?>
                  </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
              
                <div class="table-responsive">
                <table id="all_data" class="table modern-table">
                  <thead>
                  <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th class="text-center">Action</th>
                  </tr>
                  </thead>
                  <tbody>
                  
                  </tbody> 
                </table>
                </div>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->



  <div class="modal fade" id="edit_data">
    <div class="modal-dialog modal-lg modal-dialog-centered">
      <div class="modal-content border-0 shadow-lg" style="border-radius: 20px; overflow: hidden;">
        <div class="modal-header bg-light border-0 py-3 px-4">
          <h5 class="modal-title font-weight-bold text-primary" id="edit_modal_title">
            <i class="fas fa-user-plus mr-2"></i> Add Technician
          </h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true" style="font-size: 1.5rem;">&times;</span>
          </button>
        </div>
        <form action="<?=base_url('technicians/add_data')?>" method="post" id="submit_data" enctype="multipart/form-data">
          <div class="modal-body p-4">
            <input type="hidden" name="id" class="form-control id">
            <div class="row">
              <div class="col-md-6 mb-3">
                <div class="form-group">
                  <label class="font-weight-600"><i class="fas fa-user mr-1 text-muted"></i> Name</label>
                  <input type="text" name="name" class="form-control name p-4" style="border-radius: 10px;" placeholder="Full Name" required>
                </div>
              </div>
              <div class="col-md-6 mb-3">
                <div class="form-group">
                  <label class="font-weight-600"><i class="fas fa-id-badge mr-1 text-muted"></i> Username</label>
                  <input type="text" name="username" class="form-control username p-4" style="border-radius: 10px;" placeholder="Username" required>
                </div>
              </div>
              <div class="col-md-6 mb-3">
                <div class="form-group">
                  <label class="font-weight-600"><i class="fas fa-envelope mr-1 text-muted"></i> Email</label>
                  <input type="email" name="email" class="form-control email p-4" style="border-radius: 10px;" placeholder="email@example.com" required>
                </div>
              </div>
              <div class="col-md-6 mb-3">
                <div class="form-group">
                  <label class="font-weight-600"><i class="fas fa-phone mr-1 text-muted"></i> Phone</label>
                  <input type="text" name="phone" class="form-control phone p-4" style="border-radius: 10px;" placeholder="Phone Number" required>
                </div>
              </div>
              <div class="col-md-6 mb-3">
                <div class="form-group">
                  <label class="font-weight-600"><i class="fas fa-calendar-alt mr-1 text-muted"></i> DOB</label>
                  <input type="date" name="dob" class="form-control dob p-4" style="border-radius: 10px;" required>
                </div>
              </div>
              <div class="col-md-6 mb-3">
                <div class="form-group">
                  <label class="font-weight-600"><i class="fas fa-lock mr-1 text-muted"></i> Password</label>
                  <input type="password" name="password" class="form-control p-4" style="border-radius: 10px;" placeholder="Leave blank to keep current">
                </div>
              </div>
              <div class="col-md-6 mb-3">
                <div class="form-group">
                  <label class="font-weight-600"><i class="fas fa-map-marker-alt mr-1 text-muted"></i> Address</label>
                  <input type="text" name="address" class="form-control address p-4" style="border-radius: 10px;" placeholder="Address" >
                </div>
              </div>
              <?php if($this->session->userdata('user_type') =='1' || $this->session->userdata('user_type') =='4'){ ?>
              <div class="col-md-6 mb-3">
                <div class="form-group">
                  <label class="font-weight-600"><i class="fas fa-building mr-1 text-muted"></i> Branch</label>
                  <select name="branch[]" class="form-control branch select2" multiple required style="width:100%">
                    <?php foreach($branch as $branchs){ ?>
                      <option value="<?=$branchs->id?>"><?=$branchs->name?></option>
                    <?php } ?>
                  </select>
                </div>
              </div>
              <?php } ?>
              <div class="col-md-12">
                <div class="form-group">
                  <label class="font-weight-600 mb-2"><i class="fas fa-key mr-1 text-muted"></i> Permissions</label>
                  <div class="row bg-light p-3 rounded" style="border-radius: 15px;">
                    <?php foreach($permission as $permis){ ?>
                    <div class="col-md-4 mt-2">
                      <div class="custom-control custom-checkbox">
                        <input class="custom-control-input" name="permission[]" type="checkbox" value="<?=$permis->slug?>" id="<?=$permis->slug?>">
                        <label class="custom-control-label" for="<?=$permis->slug?>">
                          <?=$permis->name?>
                        </label>
                      </div>
                    </div>
                    <?php } ?>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer border-0 bg-light p-4">
            <button type="button" class="btn btn-secondary px-4 mr-2" data-dismiss="modal" style="border-radius: 10px;">Close</button>
            <button type="submit" class="btn btn-primary px-4 shadow-sm" style="border-radius: 10px; font-weight: 600;">Save Changes</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <!-- /.modal -->
    
    
    
    <div class="modal fade" id="view_data">
        <div class="modal-dialog modal-lg modal-dialog-centered">
          <div class="modal-content border-0 shadow-lg" style="border-radius: 20px; overflow: hidden;">
            <div class="modal-header bg-light border-0 py-3 px-4">
              <h5 class="modal-title font-weight-bold text-primary">
                <i class="fas fa-eye mr-2"></i> Technician Details
              </h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true" style="font-size: 1.5rem;">&times;</span>
              </button>
            </div>
            <div class="modal-body view_table p-4">
      

            </div>
            <div class="modal-footer border-0 bg-light p-4">
              <button type="button" class="btn btn-secondary px-4" data-dismiss="modal" style="border-radius: 10px;">Close</button>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->