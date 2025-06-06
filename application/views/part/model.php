<?php $ajax = 'model'; ?>

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
                        <div class="card-header">
                            <?php if($this->session->userdata('user_type') =='1' OR $this->session->userdata('user_type') =='4'){ ?>
                            <button class="card-btn btn btn-info btn-sm" data-toggle='modal' data-target='#edit_data' onclick="reset()">Add Model</button>
                            <?php } ?>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Model Name</th>
                                        <th>Brand Name</th>
                                        <th>User Name</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if(!empty($models)): ?>
                                        <?php $i = 1; foreach($models as $model): ?>
                                            <tr>
                                                <td><?= $i++ ?></td>
                                                <td><?= $model->name ?></td>
                                                <td>
                                                    <?php 
                                                    $brand = $this->part->single_data('brand', $model->brand_id);
                                                    echo $brand[0]->name ?? '';
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php 
                                                    $user = $this->part->single_data('user', $model->added_by);
                                                    $user_type = '';
                                                    if($user[0]->type == '1') $user_type = " (Admin)";
                                                    elseif($user[0]->type == '2') $user_type = " (Staff)";
                                                    elseif($user[0]->type == '3') $user_type = " (Technician)";
                                                    elseif($user[0]->type == '4') $user_type = " (Branch)";
                                                    elseif($user[0]->type == '5') $user_type = " (Part controller)";
                                                    echo $user[0]->name . $user_type;
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php if($this->session->userdata('user_type') == '1' OR $this->session->userdata('user_type') == '4'): ?>
                                                        <button data-toggle='modal' data-target='#edit_data' onclick='return edit(<?= $model->id ?>)' class='btn btn-info btn-xs m-1'><i class='fas fa-pencil-alt'></i></button>
                                                        <button onclick='return del(<?= $model->id ?>)' class='btn btn-danger btn-xs m-1'><i class='fa fa-trash' aria-hidden='true'></i></button>
                                                    <?php elseif($this->session->userdata('user_type') == '3'): ?>
                                                        <?php if($model->added_by == $this->session->userdata('user_id')): ?>
                                                            <button data-toggle='modal' data-target='#edit_data' onclick='return edit(<?= $model->id ?>)' class='btn btn-info btn-xs m-1'><i class='fas fa-pencil-alt'></i></button>
                                                            <button onclick='return del(<?= $model->id ?>)' class='btn btn-danger btn-xs m-1'><i class='fa fa-trash' aria-hidden='true'></i></button>
                                                        <?php else: ?>
                                                            <button class='btn btn-info btn-xs m-1' disabled><i class='fas fa-pencil-alt'></i></button>
                                                            <button class='btn btn-danger btn-xs m-1' disabled><i class='fa fa-trash' aria-hidden='true'></i></button>
                                                        <?php endif; ?>
                                                    <?php else: ?>
                                                        <button class='btn btn-info btn-xs m-1' disabled><i class='fas fa-pencil-alt'></i></button>
                                                        <button class='btn btn-danger btn-xs m-1' disabled><i class='fa fa-trash' aria-hidden='true'></i></button>
                                                    <?php endif; ?>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <tr>
                                            <td colspan="5" class="text-center">No models found</td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                            
                            <!-- Pagination -->
                            <div class="mt-3">
                                <?= $pagination ?>
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
                <h4 class="modal-title">Add/Edit Model</h4>
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
                            <!-- Dynamic Brands -->
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