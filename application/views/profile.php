  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper" style="background-image: url(<?=base_url('assets/custom/new_one_dash.jpg')?>); background-repeat: no-repeat; background-size: cover;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Edit Profile</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Edit Profile</li>
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
              <div class="card-header">
                <!-- <h3 class="card-title">DataTable with default features</h3> -->
                Edit Profile
              </div>
              <!-- /.card-header -->
              <div class="card-body">  <!--example1-->

              	 <?php
            $message = $this->session->flashdata('message');
              if ($message) {
                $status = $this->session->flashdata('status');
               ?>  
                <div class="alert alert-<?=$status?>">
              <?php echo $message; ?>
            </div>
              <?php } ?>

              	<form action="<?=base_url('profile/add_data')?>" method="post" id="submit_data" enctype="multipart/form-data">

            <input type="hidden" name="id" class="form-control id">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label>Name</label>
                  <input type="text" name="name" value="<?=$all_data[0]->name;?>" class="form-control" placeholder="" required>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label>Email</label>
                  <input type="email" name="email" value="<?=$all_data[0]->email?>" class="form-control" placeholder="" required>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label>Phone</label>
                  <input type="text" name="phone" value="<?=$all_data[0]->phone?>" class="form-control" placeholder="" required>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label>Address</label>
                  <textarea name="address" class="form-control address" required><?=$all_data[0]->address?></textarea>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label>Password</label>
                  <input type="password" name="password" class="form-control" placeholder="if you want  to  change  Password please enter password">
                </div>
              </div>

               <div class="col-md-12">
                <div class="form-group">
                  <button type="submit" class="btn btn-primary">Update</button>
                </div>
              </div>

              <!-- /.col -->
            </div>
            </form>

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
              <h4 class="modal-title">Add/Edit</h4>
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
                  <label>Password</label>
                  <input type="password" name="password" class="form-control" placeholder="if you want  to  change  Password please enter password">
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