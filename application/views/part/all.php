<?php $ajax = 'part'; ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>All Part</h1> 
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">part</li>
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
                 <?php if($this->session->userdata('user_type') =='1' OR $this->session->userdata('user_type') =='4'){ ?>
                 <button class="card-btn btn btn-info btn-sm" data-toggle='modal' data-target='#edit_data'  onclick="reset()">Add</button>
                 <?php } ?>
              </div>
              <!-- /.card-header -->
              <div class="card-body">  <!--example1-->
                <table id="all_data" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>#</th>
                    <th>Brand Name</th>
                    <th>Model Name</th>
                    <th>Part type</th>
                    <th>Price</th>
                    <th>Qty.</th>
                    <th>Added by</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                  
                  </tbody>
                  <tfoot>
                  <tr>
                    <th>#</th>
                    <th>Brand Name</th>
                    <th>Model Name</th>
                    <th>Part type</th>
                    <th>Price</th>
                    <th>Qty.</th>
                    <th>Added by</th>
                    <th>Action</th>
                  </tr>
                  </tfoot>
                </table>
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
        <div class="modal-dialog modal-xl">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Add/Edit</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form action="<?=base_url('part/add_data')?>" method="post" id="submit_data" enctype="multipart/form-data">
            <div class="modal-body">

            <input type="hidden" name="id" class="form-control id">
			
			<hr>
			
        <div class="row">
			
          <div class="col-md-4">
                <div class="form-group">
                  <label>Branch Name</label>
				  
        				  <select name="branch" class="form-control branch" required>
        					<option Value="">Select Branch</option>
        					<?php foreach($branch as $branchs){ ?>
        					<option Value="<?=$branchs->id?>"><?=$branchs->name?></option>
        					<?php } ?>
        				  </select>
                </div>
              </div>

              <div class="col-md-4">
                <div class="form-group">
                  <label>Brand Name</label>
          
                    <select name="brand" class="form-control brand" required>
                    <option Value="">Select Branch</option>
                    <?php foreach($brand as $brands){ ?>
                    <option Value="<?=$brands->id?>"><?=$brands->name?></option>
                    <?php } ?>
                    </select>
                </div>
              </div>

              <div class="col-md-4">
                <div class="form-group">
                  <label>Model Name</label>
          
                    <select name="model" class="form-control model" required>
                    <option Value="">Select model</option>
                    <?php foreach($model as $models){ ?>
                    <option Value="<?=$models->id?>"><?=$models->name?></option>
                    <?php } ?>
                    </select>
                </div>
              </div>

              <div class="col-md-4">
                <div class="form-group">
                  <label>Part type</label>
          
                    <select name="type" class="form-control type" required>
                    <option Value="">Select model</option>
                    <?php foreach($type as $types){ ?>
                    <option Value="<?=$types->id?>"><?=$types->name?></option>
                    <?php } ?>
                    </select>
                </div>
              </div>
			  
			    <div class="col-md-4">
                <div class="form-group">
                  <label>Price min</label>
                  <input type="number" name="price_min" class="form-control price_min" placeholder="" required>
                </div>
              </div>
			  
			    <div class="col-md-4">
                <div class="form-group">
                  <label>Price max</label>
                  <input type="number" name="price_max" class="form-control price_max" placeholder="" required>
                </div>
          </div>

          <div class="col-md-4">
                <div class="form-group">
                  <label>Stock</label>
                  <input type="number" name="stock" class="form-control stock" placeholder="" required>
                </div>
          </div>
			  
			  </div>
			  
			  <hr>
			  

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