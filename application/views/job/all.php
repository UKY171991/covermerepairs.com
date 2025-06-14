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
              <button class="card-btn btn btn-info btn-sm" data-toggle='modal' data-target='#edit_data' onclick="reset()">Add</button>
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
                      <option value="">Select Model</option>
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
                      <option value="">Select Model</option>
                      <?php foreach($brand as $brands){ ?>
                        <option value="<?=$brands->id?>"><?=$brands->name?></option>
                      <?php } ?>
                  </select>
              </div>
          </div>

            <div class="col-md-6">
              <div class="form-group">
                  <label>Model</label>
                  <div class="input-group">
                    <select name="model_no" class="form-control model_no" required>
                        <option value="">Select Model</option>
                    </select>
                    <div class="input-group-append">
                      <button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#modelModal" title="Add Model">
                        <i class="fa fa-plus"></i>
                      </button>
                    </div>
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
      <?php if($this->session->userdata('user_type') !='5'){ ?>
      <form action="<?=base_url('job/add_issue')?>" method="post" id="submit_issue" enctype="multipart/form-data">
        <div class="modal-body">
          <hr>
          <div class="row">

            <input type="hidden" name="job" value="" class="job_id">
           
            <div class="col-md-12">
              <div class="form-group">
                <label>Add Issue</label>
                <textarea type="text" name="issue_list" class="form-control" required></textarea>
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
      <?php } ?>

      <div class="issue_list"></div>


    </div>
  </div>
</div>


<!--  Assign Modal -->
<div class="modal fade" id="assign">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Assign</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?=base_url('job/add_assign')?>" method="post" id="assign_data" enctype="multipart/form-data">
        <div class="modal-body">
          <input type="hidden" name="id" class="form-control assign">
          <hr>
          <div class="row">
           
            <div class="col-md-12">
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

<!--  Status Modal -->
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
          <hr>
          <div class="row">
           
            <div class="col-md-12">
              <div class="form-group">
                  <label>Assigned to</label>
                  <select name="status" class="form-control assigned_to" required>
                      <option value="">Select Status</option>
                      <option value="Wait">Wait</option>
                      <option value="Approvid">Approvid</option>
                      <option value="Pending Repairs">Pending Repairs</option>
                      <option value="In Progress">In Progress</option>
                      <option value="QC">QC</option>
                      <option value="Ready">Ready</option>
                      <option value="Done Repairs">Done Repairs</option>
                      <option value="Couriered">Couriered</option>
                      <option value="Picked">Picked</option>
                  </select>
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


<!--  Status Modal -->
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
          <hr>
          <div class="row">

            <input type="hidden" name="job" value="" class="job_id">
           
            <div class="col-md-12">
              <div class="form-group">
                <label>Add Couriere Status</label>
                <textarea type="text" name="issue_list" class="form-control" required></textarea>
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
      <div class="couriereStatus_list"></div>
    </div>
  </div>
</div>

<script>
function openJobStockOutModal(jobId) {
    // Open the Stock Out modal and set the job_id
    $('#stockOutModalLabel').text('Issue Part for Job');
    $('#stockOutForm')[0].reset();
    $('#stockOutId').val('');
    $('#job_id').remove(); // Remove if already present
    $('#stockOutForm').append('<input type="hidden" name="job_id" id="job_id" value="'+jobId+'">');
    $('#stockOutModal').modal('show');
}
</script>

<!-- Add Model Modal (follows /part/model structure) -->
<div class="modal fade" id="modelModal" tabindex="-1" role="dialog" aria-labelledby="modelModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modelModalLabel">Add Model</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <!-- You can load the /part/model form here via iframe or AJAX, or replicate the form structure -->
        <iframe src="/part/model" style="width:100%;height:500px;border:none;"></iframe>
      </div>
    </div>
  </div>
</div>
