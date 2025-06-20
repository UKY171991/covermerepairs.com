<?php $ajax = 'part_corntroller'; ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>All Part corntroller</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Part corntroller</li>
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
            <div class="card">
              <div class="card-header d-flex justify-content-end">
                <?php if($this->session->userdata('user_type') =='1' OR $this->session->userdata('user_type') =='4' OR $this->session->userdata('user_type') =='5'){ ?>
                <button class="card-btn btn btn-info btn-sm" id="add_btn">Add</button>
                <?php } ?>
              </div>
              <!-- /.card-header -->
              <div class="card-body">  <!--example1-->
              
                <div class="table-responsive">
                <table id="all_data" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                  
                  </tbody> 
                  <tfoot>
                  <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Action</th>
                  </tr>
                  </tfoot>
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
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title" id="modal_title">Add/Edit</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form action="<?=base_url('part_corntroller/add_data')?>" method="post" id="submit_data" enctype="multipart/form-data">
            <div class="modal-body">

            <input type="hidden" name="id" class="form-control id">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label>Name</label>
                  <input type="text" name="name" class="form-control name" placeholder="" required>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label>Username</label>
                  <input type="text" name="username" class="form-control username" placeholder="" required>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label>Email</label>
                  <input type="email" name="email" class="form-control email" placeholder="" required>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label>Phone</label>
                  <input type="text" name="phone" class="form-control phone" placeholder="" required>
                </div>
              </div>

            
			  
			  <div class="col-md-6">
                <div class="form-group">
                  <label>DOB</label>
                  <input type="date" name="dob" class="form-control dob" placeholder="" required>
                </div>
              </div>

              <div class="col-md-6">
                <div class="form-group">
                  <label>Password</label>
                  <input type="password" name="password" class="form-control" placeholder="if you want  to  change  Password please enter password">
                </div>
              </div>
			  
			  <div class="col-md-6">
                <div class="form-group">
                  <label>Address</label>
                  <input type="text" name="address" class="form-control address" placeholder="">
                </div>
              </div>

            
              <?php if($this->session->userdata('user_type') =='1' || $this->session->userdata('user_type') =='4'){ ?>
              <div class="col-md-6">
                <div class="form-group">
                  <label>Branch</label>
        				  <select name="branch[]" class="form-control branch select2" multiple required>
        					<!--<option value="">Select branch</option> -->
        					<?php foreach($branch as $branchs){ ?>
        					<option value="<?=$branchs->id?>"><?=$branchs->name?></option>
        					<?php } ?>
        				  </select>
                </div>
              </div>
              <?php } ?>
			  
			  <div class="col-md-12">
                <div class="form-group">
                  <label>Permission</label>
				  <div class="row">
				  <?php foreach($permission as $permis){ ?>
					<div class="col-md-4 mt-2">
						<div class="form-check">
						  <input class="form-check-input" name="permission[]" type="checkbox" value="<?=$permis->slug?>" id="<?=$permis->slug?>">
						  <label class="form-check-label" for="<?=$permis->slug?>">
							<?=$permis->name?>
						  </label>
						</div>
					</div>
					<?php } ?>
				  </div>
				  
                </div>
              </div>

              <!-- /.col -->
            </div>
        

            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
            </form>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->
	  
	  
	  
	  <div class="modal fade" id="view_data">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">View Part Controller</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body view_table">
			

            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->