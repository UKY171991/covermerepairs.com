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
    padding: 5px 10px;
}

.dataTables_wrapper .dataTables_length,
.dataTables_wrapper .dataTables_filter {
    margin-bottom: 10px;
}

/* Table styling */
#all_data thead th {
    vertical-align: middle;
    text-align: center;
    background-color: #f8f9fa;
}

#all_data tbody td {
    vertical-align: middle;
    text-align: center;
}

.table-responsive {
    overflow-x: auto;
}

/* Modal styling */
.modal-header {
    background-color: #007bff;
    color: white;
}

.modal-header .close {
    color: white;
}

.form-group label {
    font-weight: 600;
}

/* Button styling */
.btn-xs {
    padding: 0.25rem 0.4rem;
    font-size: 0.775rem;
    line-height: 1.5;
    border-radius: 0.2rem;
}
</style>

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
              <li class="breadcrumb-item"><a href="<?=base_url('home')?>">Home</a></li>
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
                <button id="add-part-btn" class="card-btn btn btn-info btn-sm" data-toggle='modal' data-target='#edit_data'>Add Part</button>
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

<!-- Add/Edit Modal -->
<div class="modal fade" id="edit_data" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="modal-title">Add Part</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="add_data_form">
          <input type="hidden" id="id" name="id" value="">
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="branch">Branch <span class="text-danger">*</span></label>
                <select class="form-control" id="branch" name="branch" required>
                  <option value="">Select Branch</option>
                  <?php if(isset($branch) && is_array($branch)): ?>
                    <?php foreach($branch as $branchs): ?>
                    <option value="<?=$branchs->id?>"><?=$branchs->name?></option>
                    <?php endforeach; ?>
                  <?php endif; ?>
                </select>
              </div>
              <div class="form-group">
                <label for="brand">Brand <span class="text-danger">*</span></label>
                <select class="form-control" id="brand" name="brand" required>
                  <option value="">Select Brand</option>
                  <?php if(isset($brand) && is_array($brand)): ?>
                    <?php foreach($brand as $brands): ?>
                    <option value="<?=$brands->id?>"><?=$brands->name?></option>
                    <?php endforeach; ?>
                  <?php endif; ?>
                </select>
              </div>
              <div class="form-group">
                <label for="model">Model <span class="text-danger">*</span></label>
                <select class="form-control" id="model" name="model" required>
                  <option value="">Select Brand First</option>
                </select>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="type">Part Type <span class="text-danger">*</span></label>
                <select class="form-control" id="type" name="type" required>
                  <option value="">Select Part Type</option>
                  <?php if(isset($type) && is_array($type)): ?>
                    <?php foreach($type as $types): ?>
                    <option value="<?=$types->id?>"><?=$types->name?></option>
                    <?php endforeach; ?>
                  <?php endif; ?>
                </select>
              </div>
              <div class="form-group">
                <label for="price_min">Min Price</label>
                <input type="number" step="0.01" class="form-control" id="price_min" name="price_min" placeholder="Min Price">
              </div>
              <div class="form-group">
                <label for="price_max">Max Price</label>
                <input type="number" step="0.01" class="form-control" id="price_max" name="price_max" placeholder="Max Price">
              </div>
              <div class="form-group">
                <label for="stock">Stock</label>
                <input type="number" class="form-control" id="stock" name="stock" placeholder="Stock Quantity" min="0">
              </div>
            </div>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="add_data_btn">Save Part</button>
      </div>
    </div>
  </div>
</div>

<!-- View Modal -->
<div class="modal fade" id="view_data" tabindex="-1" role="dialog" aria-labelledby="viewModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">View Part Details</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-12">
            <table class="table table-bordered table-striped">
              <tbody>
                <tr>
                  <th style="width: 30%;">Brand Name</th>
                  <td id="view_brand_name">-</td>
                </tr>
                <tr>
                  <th>Model Name</th>
                  <td id="view_model_name">-</td>
                </tr>
                <tr>
                  <th>Part Type</th>
                  <td id="view_part_type_name">-</td>
                </tr>
                <tr>
                  <th>Min Price</th>
                  <td id="view_price_min">-</td>
                </tr>
                <tr>
                  <th>Max Price</th>
                  <td id="view_price_max">-</td>
                </tr>
                <tr>
                  <th>Stock</th>
                  <td id="view_stock">-</td>
                </tr>
                <tr>
                  <th>Added by</th>
                  <td id="view_added_by">-</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<script>
// Base URL for AJAX calls
var base_url = "<?= base_url() ?>";
</script>
