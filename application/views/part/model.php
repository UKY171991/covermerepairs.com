<?php $ajax = 'model'; ?>

<!-- Model Management JavaScript -->
<script src="<?=base_url('assets/js/model.js')?>"></script>

<!-- Custom CSS for DataTable Pagination -->
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