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
          <!-- ...form fields as before... -->
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
      <form action="<?=base_url('job/add_issue')?>" method="post" id="submit_issue" enctype="multipart/form-data">
        <div class="modal-body">
          <!-- ...form fields as before... -->
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
      <form action="<?=base_url('job/add_assign')?>" method="post" id="assign_data" enctype="multipart/form-data">
        <div class="modal-body">
          <!-- ...form fields as before... -->
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
          <!-- ...form fields as before... -->
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
          <!-- ...form fields as before... -->
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
</script>
