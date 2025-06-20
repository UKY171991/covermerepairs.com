<?php $ajax = 'part_corntroller'; ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>Part Controller Management</h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Part Controller</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">All Part Controllers</h3>
                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#add_modal" id="add_new_btn">
                                <i class="fa fa-plus"></i> Add New
                            </button>
                        </div>
                    </div>
                    <div class="box-body">
                        <table id="manageTable" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Branch</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<!-- Add/Edit Modal -->
<div class="modal fade" id="add_modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="modal_title">Add Part Controller</h4>
            </div>
            <form role="form" action="<?php echo base_url('part_corntroller/add') ?>" method="post" id="modal_form">
                <div class="modal-body">
                    <div id="messages"></div>

                    <div class="form-group">
                        <label for="fname">First Name</label>
                        <input type="text" class="form-control" id="fname" name="fname" placeholder="Enter First Name" required>
                    </div>
                    <div class="form-group">
                        <label for="lname">Last Name</label>
                        <input type="text" class="form-control" id="lname" name="lname" placeholder="Enter Last Name" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Enter Email" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Enter Password">
                        <small class="text-muted">Leave blank if you don't want to change it.</small>
                    </div>
                    <div class="form-group">
                        <label for="phone">Phone</label>
                        <input type="text" class="form-control" id="phone" name="phone" placeholder="Enter Phone Number" required>
                    </div>

                    <?php if ($this->session->userdata('user_type') == '1' || $this->session->userdata('user_type') == '4') : ?>
                        <div class="form-group">
                            <label for="branch_id">Branch</label>
                            <select class="form-control select2" id="branch_id" name="branch_id[]" multiple="multiple" style="width: 100%;" required>
                                <?php foreach ($branch as $br) : ?>
                                    <option value="<?php echo $br->id; ?>"><?php echo $br->name; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    <?php endif; ?>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script type="text/javascript" src="<?php echo base_url('assets/ajax/part_corntroller.js') ?>"></script>