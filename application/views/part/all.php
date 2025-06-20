<?php $ajax = 'part'; ?>

<style>
/* Enhanced DataTable Styling */
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

.table th, .table td {
    vertical-align: middle;
}

.btn-xs {
    padding: 0.25rem 0.5rem;
    font-size: 0.75rem;
    line-height: 1.5;
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
                        <li class="breadcrumb-item"><a href="<?= base_url() ?>">Home</a></li>
                        <li class="breadcrumb-item active">Parts</li>
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
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h3 class="card-title">Parts Management</h3>
                            <?php if($this->session->userdata('user_type') == '1' || $this->session->userdata('user_type') == '5'): ?>
                            <button id="add-part-btn" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#add_edit_modal">
                                <i class="fas fa-plus"></i> Add Part
                            </button>
                            <?php endif; ?>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="parts_table" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th width="5%">#</th>
                                            <th width="15%">Brand</th>
                                            <th width="15%">Model</th>
                                            <th width="15%">Part Type</th>
                                            <th width="10%">Min Price</th>
                                            <th width="10%">Max Price</th>
                                            <th width="8%">Stock</th>
                                            <th width="15%">Added by</th>
                                            <th width="12%">Action</th>
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
<div class="modal fade" id="add_edit_modal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modal_title">Add Part</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="part_form">
                <div class="modal-body">
                    <input type="hidden" id="part_id" name="id" value="">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="branch">Branch <span class="text-danger">*</span></label>
                                <select class="form-control" id="branch" name="branch" required>
                                    <option value="">Select Branch</option>
                                    <?php foreach($branch as $b): ?>
                                    <option value="<?= $b->id ?>"><?= $b->name ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            
                            <div class="form-group">
                                <label for="brand">Brand <span class="text-danger">*</span></label>
                                <select class="form-control" id="brand" name="brand" required>
                                    <option value="">Select Brand</option>
                                    <?php foreach($brand as $br): ?>
                                    <option value="<?= $br->id ?>"><?= $br->name ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            
                            <div class="form-group">
                                <label for="model">Model <span class="text-danger">*</span></label>
                                <select class="form-control" id="model" name="model" required>
                                    <option value="">Select Model</option>
                                </select>
                            </div>
                            
                            <div class="form-group">
                                <label for="type">Part Type <span class="text-danger">*</span></label>
                                <select class="form-control" id="type" name="type" required>
                                    <option value="">Select Part Type</option>
                                    <?php foreach($type as $t): ?>
                                    <option value="<?= $t->id ?>"><?= $t->name ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="price_min">Minimum Price</label>
                                <input type="number" step="0.01" class="form-control" id="price_min" name="price_min" placeholder="0.00">
                            </div>
                            
                            <div class="form-group">
                                <label for="price_max">Maximum Price</label>
                                <input type="number" step="0.01" class="form-control" id="price_max" name="price_max" placeholder="0.00">
                            </div>
                            
                            <div class="form-group">
                                <label for="stock">Stock Quantity</label>
                                <input type="number" min="0" class="form-control" id="stock" name="stock" placeholder="0" value="0">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" id="save_btn">
                        <i class="fas fa-save"></i> Save
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- View Modal -->
<div class="modal fade" id="view_modal" tabindex="-1" role="dialog">
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
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <th width="30%">Branch</th>
                                    <td id="view_branch_name">-</td>
                                </tr>
                                <tr>
                                    <th>Brand</th>
                                    <td id="view_brand_name">-</td>
                                </tr>
                                <tr>
                                    <th>Model</th>
                                    <td id="view_model_name">-</td>
                                </tr>
                                <tr>
                                    <th>Part Type</th>
                                    <td id="view_part_type_name">-</td>
                                </tr>
                                <tr>
                                    <th>Minimum Price</th>
                                    <td id="view_price_min">-</td>
                                </tr>
                                <tr>
                                    <th>Maximum Price</th>
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