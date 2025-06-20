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

<!-- Modals (Add/Edit Job, Found Issue, Assign, Status, Couriere Status) -->
<?php $this->load->view('job/job_modals'); ?>

<!-- Job Page JS -->
<script src="<?=base_url('assets/ajax/job.js')?>"></script>
<script>
function resetJobForm() {
  $('#submit_data')[0].reset();
  $('.id').val('');
}
</script>
