<?php $ajax = 'model'; ?>

<!-- External CSS -->
<link rel="stylesheet" href="<?=base_url('assets/custom/custom.css')?>">

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Model Management</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Model</li>
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
                        <div class="card-header d-flex justify-content-end">
                            <?php if($this->session->userdata('user_type') =='1' OR $this->session->userdata('user_type') =='4'){ ?>
                            <button id="add-model-btn" class="card-btn btn btn-info btn-sm" data-toggle='modal' data-target='#edit_data'>Add</button>
                            <?php } ?>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <input type="hidden" class="base_url" value="<?= base_url() ?>" />
                            <div class="table-responsive">
                                <table id="all_data" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th style="width: 5%;">#</th>
                                            <th style="width: 25%;">Model Name</th>
                                            <th style="width: 25%;">Brand Name</th>
                                            <th style="width: 25%;">User Name</th>
                                            <th style="width: 20%;">Action</th>
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
            </div>
        </div>
    </section>
</div>
<!-- /.content-wrapper -->

<!-- Modal for Add/Edit Model -->
<div class="modal fade" id="edit_data">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modal-title">Add Model</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?=base_url('part/add_model')?>" method="post" id="submit_data">
                <div class="modal-body">
                    <input type="hidden" name="id" class="form-control id">
                    <div class="form-group">
                        <label>Model Name</label>
                        <input type="text" name="name" class="form-control name" required>
                    </div>
                    <div class="form-group">
                        <label>Brand Name</label>
                        <select name="brand_id" class="form-control brand_id" required>
                            <option value="">Select Brand</option>
                            <?php foreach($brand as $brands){ ?>
                            <option Value="<?=$brands->id?>"><?=$brands->name?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- View Model Modal -->
<div class="modal fade" id="view_modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Model Details</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <label><strong>Model Name:</strong></label>
                        <p id="view_model_name">-</p>
                    </div>
                    <div class="col-md-6">
                        <label><strong>Brand Name:</strong></label>
                        <p id="view_brand_name">-</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <label><strong>Added By:</strong></label>
                        <p id="view_user_name">-</p>
                    </div>
                    <div class="col-md-6">
                        <label><strong>User Type:</strong></label>
                        <p id="view_user_type">-</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <label><strong>Created At:</strong></label>
                        <p id="view_created_at">-</p>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>