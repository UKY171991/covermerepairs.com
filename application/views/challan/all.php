<?php $ajax = 'challan'; ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>All challan</h1> 
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">challan</li>
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
              <div class="card-header">
                 <!-- <h3 class="card-title">DataTable with default features</h3> -->

                 <button class="card-btn btn btn-info btn-sm" data-toggle='modal' data-target='#edit_data'  onclick="reset()">Add</button>
              </div>
              <!-- /.card-header -->
              <div class="card-body">  <!--example1-->
                <table id="all_data" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>#</th>
                    <th>Branch Name</th>
                    <th>PSN</th>
                    <th>Challan No</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                  
                  </tbody>
                  <tfoot>
                  <tr>
                    <th>#</th>
                    <th>Branch Name</th>
                    <th>PSN</th>
                    <th>Challan No</th>
                    <th>Action</th>
                  </tr>
                  </tfoot>
                </table>
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
  <!-- /.content-wrapper -->



  <div class="modal fade" id="edit_data">
        <div class="modal-dialog modal-xl">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Add/Edit</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form action="<?=base_url('challan/add_data')?>" method="post" id="submit_data" enctype="multipart/form-data">
            <div class="modal-body">

            <input type="hidden" name="id" class="form-control id">
			
			<hr>
			
        <div class="row">
			
          <div class="col-md-4">
                <div class="form-group">
                  <label>Branch Name</label>
				  
				  <select name="branch" class="form-control branch" required>
					<option Value="">Select Branch</option>
					<?php foreach($branch as $branchs){ ?>
					<option Value="<?=$branchs->id?>"><?=$branchs->name?></option>
					<?php } ?>
				  </select>
                </div>
              </div>
			  
			    <div class="col-md-4">
                <div class="form-group">
                  <label>PSN</label>
                  <input type="text" name="PSN" class="form-control PSN" placeholder="" required>
                </div>
              </div>
			  
			    <div class="col-md-4">
                <div class="form-group">
                  <label>Challan No</label>
                  <input type="text" name="challan_no" class="form-control challan_no" placeholder="" required>
                </div>
          </div>
			  
			  </div>
			  
			  <hr>
			  
			  <div class="row">
			  
			  
			  <div class="col-md-4">
                <div class="form-group">
                  <label>Loading Station</label>
                  <input type="text" name="loading_station" class="form-control loading_station" placeholder="" required>
                </div>
              </div>
			  
			  <div class="col-md-4">
                <div class="form-group">
                  <label>Distance(KMS)</label>
                  <input type="text" name="distance" class="form-control distance" placeholder="" required>
                </div>
              </div>
			  
			  <div class="col-md-4">
                <div class="form-group">
                  <label>Truck No.</label>
                  <input type="text" name="truck_no" class="form-control truck_no" placeholder="" required>
                </div>
              </div>
			  
			  <div class="col-md-4">
                <div class="form-group">
                  <label>Delivery Station</label>
                  <input type="text" name="delivery_station" class="form-control delivery_station" placeholder="" required>
                </div>
              </div>
			  
			  <div class="col-md-4">
                <div class="form-group">
                  <label>Transit Days</label>
                  <input type="text" name="transit_days" class="form-control transit_days" placeholder="" required>
                </div>
              </div> 
			  
			  <div class="col-md-4">
                <div class="form-group">
                  <label>Vehicle No.</label>
                  <input type="text" name="vehicle_no" class="form-control vehicle_no" placeholder="" required>
                </div>
              </div>
			  
			  <div class="col-md-4">
                <div class="form-group">
                  <label>Vehicle Type</label>
                  <input type="text" name="vehicle_type" class="form-control vehicle_type" placeholder="" required>
                </div>
              </div>
			  
			  </div>
			  
			  <hr>
			  
			  <h4>Record 1</h4>
			  <div class="row">
			  
			  
			  <div class="col-md-4">
                <div class="form-group">
                  <label>CN No</label>
                  <input type="text" name="cn_no_r1" class="form-control cn_no_r1" placeholder="" required>
                </div>
              </div>
			  
			  <div class="col-md-4">
                <div class="form-group">
                  <label>CN Date</label>
                  <input type="date" name="cn_date_r1" class="form-control cn_date_r1" placeholder="" required>
                </div>
              </div>
			  
			  <div class="col-md-4">
                <div class="form-group">
                  <label>CN Destination</label>
                  <input type="text" name="cn_destination_r1" class="form-control cn_destination_r1" placeholder="" required>
                </div>
              </div>
			  
			  <div class="col-md-4">
                <div class="form-group">
                  <label>Nature of Goods</label>
                  <input type="text" name="nature_of_goods_r1" class="form-control nature_of_goods_r1" placeholder="" required>
                </div>
              </div>
			  
			  <div class="col-md-4">
                <div class="form-group">
                  <label>Value of Goods(₹)</label>
                  <input type="text" name="value_of_goods_r1" class="form-control value_of_goods_r1" placeholder="" required>
                </div>
              </div>
			  
			  <div class="col-md-4">
                <div class="form-group">
                  <label>No. of PKGs</label>
                  <input type="text" name="no_of_pkgs_r1" class="form-control no_of_pkgs_r1" placeholder="" required>
                </div>
              </div>
			  
			  <div class="col-md-4">
                <div class="form-group">
                  <label>Desp.Weight</label>
                  <input type="text" name="desp_weight_r1" class="form-control desp_weight_r1" placeholder="" required>
                </div>
              </div>
			  
			  
			  <div class="col-md-4">
                <div class="form-group">
                  <label>Exp. Del Date</label>
                  <input type="date" name="exp_del_date_r1" class="form-control exp_del_date_r1" placeholder="" required>
                </div>
              </div>
			  
			  </div>
			  
			  <hr>
			  
			  <h4>Record 2</h4>
			  <div class="row">
			  
			  <div class="col-md-4">
                <div class="form-group">
                  <label>CN No</label>
                  <input type="text" name="cn_no_r2" class="form-control cn_no_r2" placeholder="">
                </div>
              </div>
			  
			  <div class="col-md-4">
                <div class="form-group">
                  <label>CN Date</label>
                  <input type="date" name="cn_date_r2" class="form-control cn_date_r2" placeholder="">
                </div>
              </div>
			  
			  <div class="col-md-4">
                <div class="form-group">
                  <label>CN Destination</label>
                  <input type="text" name="cn_destination_r2" class="form-control cn_destination_r2" placeholder="">
                </div>
              </div>
			  
			  <div class="col-md-4">
                <div class="form-group">
                  <label>Nature of Goods</label>
                  <input type="text" name="nature_of_goods_r2" class="form-control nature_of_goods_r2" placeholder="">
                </div>
              </div>
			  
			  <div class="col-md-4">
                <div class="form-group">
                  <label>Value of Goods(₹)</label>
                  <input type="text" name="value_of_goods_r2" class="form-control value_of_goods_r2" placeholder="">
                </div>
              </div>
			  
			  <div class="col-md-4">
                <div class="form-group">
                  <label>No. of PKGs</label>
                  <input type="text" name="no_of_pkgs_r2" class="form-control no_of_pkgs_r2" placeholder="">
                </div>
              </div>
			  
			  <div class="col-md-4">
                <div class="form-group">
                  <label>Desp.Weight</label>
                  <input type="text" name="desp_weight_r2" class="form-control desp_weight_r2" placeholder="">
                </div>
              </div>
			  
			  
			  <div class="col-md-4">
                <div class="form-group">
                  <label>Exp. Del Date</label>
                  <input type="date" name="exp_del_date_r2" class="form-control exp_del_date_r2" placeholder="">
                </div>
              </div>
			  
			  </div>
			  
			  <hr>
			  
			  <h4>Charge Type and Amount</h4>
			  <div class="row">
			  
			  <div class="col-md-4">
                <div class="form-group">
                  <label>Lorry Hire</label>
                  <input type="text" name="lorry_hire" class="form-control lorry_hire" placeholder="" required>
                </div>
              </div>
			  
			  <div class="col-md-4">
                <div class="form-group">
                  <label>Loading Labour</label>
                  <input type="text" name="loading_labour" class="form-control loading_labour" placeholder="" required>
                </div>
              </div>
			  
			  <div class="col-md-4">
                <div class="form-group">
                  <label>Loading Deten</label>
                  <input type="text" name="loading_deten" class="form-control loading_deten" placeholder="" required>
                </div>
              </div>
			  
			  <div class="col-md-4">
                <div class="form-group">
                  <label>Other</label>
                  <input type="text" name="other" class="form-control other" placeholder="" required>
                </div>
              </div>
			  
			  <div class="col-md-4">
                <div class="form-group">
                  <label>TDS Amount</label>
                  <input type="text" name="tds_amount" class="form-control tds_amount" placeholder="" required>
                </div>
              </div>
			  
			  <div class="col-md-4">
                <div class="form-group">
                  <label>Total</label>
                  <input type="text" name="total" class="form-control total" placeholder="" required>
                </div>
              </div>
			  
			  <div class="col-md-4">
                <div class="form-group">
                  <label>(-) Advance (B)</label>
                  <input type="text" name="advance" class="form-control advance" placeholder="" required>
                </div>
              </div>
			  
			  <div class="col-md-4">
                <div class="form-group">
                  <label>(=) Balance (A-B)</label>
                  <input type="text" name="balance" class="form-control balance" placeholder="" required>
                </div>
              </div>
            </div>
			  
			  <hr>
			  
			  <h4>CALCULATION</h4>
			<div class="row">
			  
			  <div class="col-md-4">
                <div class="form-group">
                  <label>Charge Wt(MT):</label>
                  <input type="text" name="charge_Wt" class="form-control charge_Wt" placeholder="" required>
                </div>
              </div>
			  
			  <div class="col-md-4">
                <div class="form-group">
                  <label>Total Amount On Which the TDS Deducted (₹)</label>
                  <input type="text" name="total_amount_after_tds" class="form-control total_amount_after_tds" placeholder="" required>
                </div>
              </div>
			  
			</div>
			
			<hr>
			  
			<div class="row">
        <label>Late Delivery Penality</label>
			  <div class="col-md-12">
                <div class="form-group">
                  <textarea name="late_delivery_penality" class="form-control late_delivery_penality"></textarea>
                </div>
              </div>
			  
			</div>
			
			<hr>
			  
			<div class="row">
        <label>Late Receiving Submission Penality</label>
			  <div class="col-md-12">
                <div class="form-group">
                  <textarea name="late_receiving_submission_penality" class="form-control late_receiving_submission_penality"></textarea>
                </div>
              </div>
			  
			</div>
			
			
			<hr>
			  
			<div class="row">
        <label>Delivery Incharge Contact No.</label>
			  <div class="col-md-12">
                <div class="form-group">
                  <textarea name="delivery_incharge_contact_no" class="form-control delivery_incharge_contact_no"></textarea>
                </div>
              </div>
			  
			</div>
			
			<hr>
			  
			<div class="row">
        <label>Balance at Branch & Phone</label>
			  <div class="col-md-12">
                <div class="form-group">
                  <textarea name="balance_at_branch_phone" class="form-control balance_at_branch_phone"></textarea>
                </div>
              </div>
			  
			</div>
			
			<hr>
			  
			<div class="row">
        <label>Truck Supplier Details</label>
			  <div class="col-md-12">
                <div class="form-group">
                  <textarea name="truck_supplier_details" class="form-control truck_supplier_details"></textarea>
                </div>
              </div>
			  
			</div>
			
			<hr>

			<div class="row"> 
        <label>Current Lorry Owner Details</label>
			  <div class="col-md-12">
                <div class="form-group">
                  <textarea name="current_lorry_owner_details" class="form-control current_lorry_owner_details"></textarea>
                </div>
              </div>
			  
			</div>
			
			<hr>
			  
			<div class="row">
        <label>Loading Supervisor Details</label>
			  <div class="col-md-4">
                <div class="form-group">
                  <label>Name</label>
                  <input type="text" name="loading_supervisor_details" class="form-control loading_supervisor_details" placeholder="" required>
                </div>
              </div>
			  
			  <div class="col-md-4">
                <div class="form-group">
                  <label>Emp Code</label>
                  <input type="text" name="emp_code" class="form-control emp_code" placeholder="" required>
                </div>
              </div>
			  
			</div>
			
			<hr>
			  
			  <h2>Lorry Driver Details</h2>
			<div class="row">
			  
			  <div class="col-md-4">
                <div class="form-group">
                  <label>Name</label>
                  <input type="text" name="lorry_driver_details_name" class="form-control lorry_driver_details_name" placeholder="" required>
                </div>
              </div>
			  
			  <div class="col-md-4">
                <div class="form-group">
                  <label>License No</label>
                  <input type="text" name="lorry_driver_details_license_no" class="form-control lorry_driver_details_license_no" placeholder="" required>
                </div>
              </div>
			  
			  <div class="col-md-4">
                <div class="form-group">
                  <label>Mobile No</label>
                  <input type="text" name="lorry_driver_details_mobile_no" class="form-control lorry_driver_details_mobile_no" placeholder="" required>
                </div>
              </div>
			  
			</div>

			</div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
            </form>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->