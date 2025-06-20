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
                    <th>#</th>
                    <th>Brand Name</th>
                    <th>Model Name</th>
                    <th>Part Type</th>
                    <th>Min Price</th>
                    <th>Max Price</th>
                    <th>Stock</th>
                    <th>Added by</th>
                    <th>Action</th>
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
<!-- edit modal -->
<div class="modal fade" id="edit_data">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Add Part</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="add_data_form" action="" method="post">
          <input type="hidden" id="id" name="id" value="">
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="branch">Branch</label>
                <select class="form-control" id="branch" name="branch" required>
                  <option value="">Select Branch</option>
                  <?php foreach($branch as $branchs){ ?>
                  <option value="<?=$branchs->id?>"><?=$branchs->name?></option>
                  <?php } ?>
                </select>
              </div>
              <div class="form-group">
                <label for="brand">Brand</label>
                <select class="form-control" id="brand" name="brand" required>
                  <option value="">Select Brand</option>
                  <?php foreach($brand as $brands){ ?>
                  <option value="<?=$brands->id?>"><?=$brands->name?></option>
                  <?php } ?>
                </select>
              </div>
              <div class="form-group">
                <label for="model">Model</label>
                <select class="form-control" id="model" name="model" required>
                  <option value="">Select Model</option>
                </select>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="type">Part Type</label>
                <select class="form-control" id="type" name="type" required>
                  <option value="">Select Part Type</option>
                  <?php foreach($type as $types){ ?>
                  <option value="<?=$types->id?>"><?=$types->name?></option>
                  <?php } ?>
                </select>
              </div>
              <div class="form-group">
                <label for="price_min">Min Price</label>
                <input type="text" class="form-control" id="price_min" name="price_min" placeholder="Min Price">
              </div>
              <div class="form-group">
                <label for="price_max">Max Price</label>
                <input type="text" class="form-control" id="price_max" name="price_max" placeholder="Max Price">
              </div>
              <div class="form-group">
                <label for="stock">Stock</label>
                <input type="number" class="form-control" id="stock" name="stock" placeholder="Stock">
              </div>
            </div>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="add_data_btn">Save</button>
      </div>
    </div>
  </div>
</div>
<!-- view modal -->
<div class="modal fade" id="view_data">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">View Part</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <table class="table table-bordered">
          <tbody>
            <tr>
              <th>Brand Name</th>
              <td id="view_brand_name"></td>
            </tr>
            <tr>
              <th>Model Name</th>
              <td id="view_model_name"></td>
            </tr>
            <tr>
              <th>Part Type</th>
              <td id="view_part_type_name"></td>
            </tr>
            <tr>
              <th>Min Price</th>
              <td id="view_price_min"></td>
            </tr>
            <tr>
              <th>Max Price</th>
              <td id="view_price_max"></td>
            </tr>
            <tr>
              <th>Stock</th>
              <td id="view_stock"></td>
            </tr>
            <tr>
              <th>Added by</th>
              <td id="view_added_by"></td>
            </tr>
          </tbody>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>