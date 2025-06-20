<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>All Jobs</h1> 
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Jobs</li>
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
              <?php if($this->session->userdata('user_type') == '1' || $this->session->userdata('user_type') == '4'){ ?>
              <button class="card-btn btn btn-info btn-sm" data-toggle='modal' data-target='#edit_data' onclick="resetJobForm()">Add</button>
              <?php } ?>
            </div>
            <!-- Card Body -->
            <div class="card-body">
              <div class="table-responsive">
                <table id="all_data" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Job Code</th>
                      <th>Customer Name</th>
                      <th>Brand/Model</th>
                      <th>From / To</th>
                      <th>Issue</th>
                      <th>Found Issue</th>
                      <th>Assign</th>
                      <th>Status</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                  
                  </tbody>
                  <tfoot>
                    <tr>
                      <th>#</th>
                      <th>Job Code</th>
                      <th>Customer Name</th>
                      <th>Brand/Model</th>
                      <th>From / To</th>
                      <th>Issue</th>
                      <th>Found Issue</th>
                      <th>Assign</th>
                      <th>Status</th>
                      <th>Action</th>
                    </tr>
                  </tfoot>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>

<!-- All modals for Add/Edit Job, Found Issue, Assign, Status, Couriere Status are included below for reliability and to avoid missing file errors. -->

<!-- Job Modal -->
<div class="modal fade" id="edit_data">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Add/Edit Job</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?=base_url('job/add_data')?>" method="post" id="submit_data" enctype="multipart/form-data">
        <div class="modal-body">
          <input type="hidden" name="id" class="form-control id">
          <input type="hidden" name="status_list" class="form-control status_list" value="<?php if(isset($_GET['status'])){ echo $_GET['status']; } ?>">
          <hr>
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                  <label>Branch Name</label>
                  <select name="branch" class="form-control branch" required>
                      <option value="">Select Branch</option>
                      <?php foreach($branch as $branchs){ ?>
                        <option value="<?=$branchs->id?>"><?=$branchs->name?></option>
                      <?php } ?>
                  </select>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>Customer Name</label>
                <input type="text" name="customer_name" class="form-control customer_name" required>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>Mobile</label>
                <input type="text" name="mobile" class="form-control mobile" required>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>Email</label>
                <input type="text" name="email" class="form-control email" required>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                  <label>Brand</label>
                  <select name="brand" class="form-control brand" required>
                      <option value="">Select Brand</option>
                      <?php foreach($brand as $brands){ ?>
                        <option value="<?=$brands->id?>"><?=$brands->name?></option>
                      <?php } ?>
                  </select>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>Model</label>
                <div class="d-flex align-items-center">
                  <select name="model_no" class="form-control model_no" required style="flex:1;">
                    <option value="">Select Model</option>
                  </select>
                  <a href="<?=base_url('part/model')?>" target="_blank" class="btn btn-outline-primary ml-2" title="Add Model" style="height:38px;">
                    <i class="fa fa-plus"></i>
                  </a>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                  <label>Assigned to</label>
                  <select name="assigned_to" class="form-control assigned_to" required>
                      <option value="">Select Technician</option>
                      <?php foreach($technicians as $technician){ ?>
                        <option value="<?=$technician->id?>"><?=$technician->name?></option>
                      <?php } ?>
                  </select>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>From</label>
                <input type="date" name="date_from" class="form-control date_from" required>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>To</label>
                <input type="date" name="date_to" class="form-control date_to" required>
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group">
                <label>Issue</label>
                <textarea type="text" name="issue" class="form-control issue" required></textarea>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <div class="form-check">
                  <input type="checkbox" name="inspection_fee_paid" id="inspection_fee_paid" value="1" class="form-check-input inspection_fee_paid">
                  <label class="form-check-label" for="inspection_fee_paid">Inspection Fee Paid</label>
                </div>
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group">
                <label for="loan_device_details">Loan Device Details</label>
                <textarea name="loan_device_details" id="loan_device_details" class="form-control loan_device_details"></textarea>
              </div>
            </div>
            <div class="col-md-12">
              <hr>
              <h5>Fault Details</h5>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="fault_frequency">Fault Frequency</label>
                <input type="text" name="fault_frequency" id="fault_frequency" class="form-control fault_frequency">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="specified_faults">Specified Faults</label>
                <input type="text" name="specified_faults" id="specified_faults" class="form-control specified_faults">
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group">
                <label for="description">Description</label>
                <textarea name="description" id="description" class="form-control description" rows="3"></textarea>
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
  </div>
</div>

<!-- Found Issue Modal -->
<div class="modal fade" id="found_issue">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Found Issue</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?=base_url('job/add_issue') ?>" method="post" id="submit_issue" enctype="multipart/form-data">
        <div class="modal-body">
          <input type="hidden" name="job" value="" class="form-control job_id">
          <div class="form-group">
            <label for="issue_list">Add Issue</label>
            <textarea name="issue_list" class="form-control" rows="3" placeholder="Enter found issue..." required></textarea>
          </div>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save changes</button>
        </div>
      </form>
      <div class="issue_list"></div>
    </div>
  </div>
</div>

<!-- Assign Modal -->
<div class="modal fade" id="assign">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Assign</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?=base_url('job/add_assign') ?>" method="post" id="assign_data" enctype="multipart/form-data">
        <div class="modal-body">
          <input type="hidden" name="id" class="form-control assign">
          <div class="form-group">
            <label>Assigned to</label>
            <select name="assigned_to" class="form-control assigned_to" required>
              <option value="">Select Technician</option>
              <?php foreach($technicians as $technician){ ?>
                <option value="<?=$technician->id?>"><?=$technician->name?></option>
              <?php } ?>
            </select>
          </div>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save changes</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Status Modal -->
<div class="modal fade" id="status">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Status</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?=base_url('job/add_status')?>" method="post" id="status_data" enctype="multipart/form-data">
        <div class="modal-body">
          <input type="hidden" name="job_id" class="form-control job_id">
          <div class="form-group">
            <label for="status">Select Status</label>
            <select name="status" class="form-control status_select" required>
              <option value="">Select Status</option>
              <option value="Pending">Pending</option>
              <option value="In Progress">In Progress</option>
              <option value="Wait">Wait</option>
              <option value="QC">QC</option>
              <option value="Ready">Ready</option>
              <option value="Picked">Picked</option>
              <option value="Approvid">Approvid</option>
              <option value="Couriered">Couriered</option>
            </select>
          </div>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save changes</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Couriere Status Modal -->
<div class="modal fade" id="couriereStatus">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Couriere Status</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?=base_url('job/couriereStatus')?>" method="post" id="couriere" enctype="multipart/form-data">
        <div class="modal-body">
          <input type="hidden" name="job" class="form-control job_id">
          <div class="form-group">
            <label for="issue_list">Add Couriere Status</label>
            <textarea name="issue_list" class="form-control" rows="3" placeholder="Enter couriere status update..."></textarea>
          </div>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save changes</button>
        </div>
      </form>
      <div class="couriereStatus_list"></div>
    </div>
  </div>
</div>

<!-- Job Page JS -->
<script src="<?=base_url('assets/ajax/job.js')?>"></script>
<script>
function resetJobForm() {
  $('#submit_data')[0].reset();
  $('.id').val('');
}

// Ensure all select fields use Select2 for better dropdown handling
$('select.form-control').addClass('select2');
</script>
