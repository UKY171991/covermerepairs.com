<?php $ajax = 'part'; ?>

<style>
/* Enhanced DataTable Pagination Styling */
.dataTables_wrapper .dataTables_paginate .paginate_button {
    box-sizing: border-box;
    display: inline-block;
    min-width: 1.5em;
    padding: 0.5em 1em;
    margin-left: 2px;
    text-align: center;
    text-decoration: none !important;
    cursor: pointer;
    color: #333 !important;
    border: 1px solid #ddd;
    border-radius: 4px;
    background: #fff;
}

.dataTables_wrapper .dataTables_paginate .paginate_button:hover {
    color: #333 !important;
    border: 1px solid #999;
    background: #f5f5f5;
}

.dataTables_wrapper .dataTables_paginate .paginate_button.current {
    color: #fff !important;
    border: 1px solid #007bff;
    background: #007bff;
}

.dataTables_wrapper .dataTables_paginate .paginate_button.disabled {
    color: #999 !important;
    border: 1px solid #ddd;
    background: #fff;
    cursor: default;
}

.dataTables_wrapper .dataTables_info {
    padding-top: 0.755em;
}

.dataTables_wrapper .dataTables_length select {
    width: 75px;
    display: inline-block;
}

.dataTables_wrapper .dataTables_filter input {
    border: 1px solid #ddd;
    border-radius: 4px;
    padding: 4px 6px;
    margin-left: 0.5em;
}
</style>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>All Parts</h1> 
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Parts</li>
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
                <?php if($this->session->userdata('user_type') =='1' || $this->session->userdata('user_type') =='5'){ ?>
                <button id="add-part-btn" class="card-btn btn btn-info btn-sm" data-toggle='modal' data-target='#edit_data'>Add</button>
                <?php } ?>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div class="table-responsive">
                <table id="all_data" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th style="width: 5%;">#</th>
                    <th style="width: 15%;">Brand Name</th>
                    <th style="width: 15%;">Model Name</th>
                    <th style="width: 15%;">Part Type</th>
                    <th style="width: 12%;">Price</th>
                    <th style="width: 8%;">Qty.</th>
                    <th style="width: 15%;">Added by</th>
                    <th style="width: 15%;">Action</th>
                  </tr>
                  </thead>
                  <tbody>
                  <!-- Data will be loaded here by DataTable -->
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
        <div class="modal-dialog modal-xl">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title" id="modal-title">Add Part</h4>
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