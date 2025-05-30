<?php $ajax = 'billty'; ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>All billty</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">billty</li>
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
            <form action="<?=base_url('billty/add_data')?>" method="post" id="submit_data" enctype="multipart/form-data">
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
                  <label>Consignment No</label>
                  <input type="text" name="consignment_no" class="form-control consignment_no" placeholder="" required>
                </div>
				</div>
				
				<div class="col-md-4">
                <div class="form-group">
                  <label>Consignment Date</label>
                  <input type="text" name="consignment_date" class="form-control consignment_date" placeholder="" required>
                </div>
				</div>
				
				<div class="col-md-4">
                <div class="form-group">
                  <label>CIN</label>
                  <input type="text" name="CIN" class="form-control CIN" placeholder="" required>
                </div>
				</div>
				
				<div class="col-md-4">
                <div class="form-group">
                  <label>PAN</label>
                  <input type="text" name="PAN" class="form-control PAN" placeholder="" required>
                </div>
				</div>
			  
			  </div>
			  
			  <hr>
			  
			  <h4>Work Order Details</h4>
			  <div class="row">
			  
			  
			  <div class="col-md-4">
                <div class="form-group">
                  <label>WO No.</label>
                  <input type="text" name="work_order_details_WO_No" class="form-control work_order_details_WO_No" placeholder="" required>
                </div>
              </div>
			  
			  <div class="col-md-4">
                <div class="form-group">
                  <label>Date</label>
                  <input type="date" name="work_order_details_date" class="form-control work_order_details_date" placeholder="" required>
                </div>
              </div>
			  
			  <div class="col-md-4">
                <div class="form-group">
                  <label>SAP Delivery No.</label>
                  <input type="text" name="work_order_details_SAP_delivery_no" class="form-control work_order_details_SAP_delivery_no" placeholder="" required>
                </div>
              </div>
			  
			  <div class="col-md-4">
                <div class="form-group">
                  <label>Loading Station</label>
                  <input type="text" name="work_order_details_loading_station" class="form-control work_order_details_loading_station" placeholder="" required>
                </div>
              </div>
			  
			  <div class="col-md-4">
                <div class="form-group">
                  <label>Distance (Kms) </label>
                  <input type="text" name="work_order_details_distance" class="form-control work_order_details_distance" placeholder="" required>
                </div>
              </div> 
			  
			  <div class="col-md-4">
                <div class="form-group">
                  <label>Vehicle No.</label>
                  <input type="text" name="work_order_details_vehicle_no" class="form-control work_order_details_vehicle_no" placeholder="" required>
                </div>
              </div>
			  
			  <div class="col-md-4">
                <div class="form-group">
                  <label>Delivery Station</label>
                  <input type="text" name="work_order_details_delivery_station" class="form-control work_order_details_delivery_station" placeholder="" required>
                </div>
              </div>
			  
			   <div class="col-md-4">
                <div class="form-group">
                  <label>Transit Days</label>
                  <input type="text" name="work_order_details_transit_days" class="form-control work_order_details_transit_days" placeholder="" required>
                </div>
              </div>
			  
			   <div class="col-md-4">
                <div class="form-group">
                  <label>Load Type</label>
                  <input type="text" name="work_order_details_load_type" class="form-control work_order_details_load_type" placeholder="" required>
                </div>
               </div>
			  
			  </div>
			  
			  <hr>
			  
			  <h4>Consignor Details</h4>
			  <div class="row">
			  
			  
			  <div class="col-md-4">
                <div class="form-group">
                  <label>Name</label>
                  <input type="text" name="consignor_details_name" class="form-control consignor_details_name" placeholder="" required>
                </div>
              </div>
			  
			  <div class="col-md-4">
                <div class="form-group">
                  <label>Address</label>
                  <input type="text" name="consignor_details_address" class="form-control consignor_details_address" placeholder="" required>
                </div>
              </div>
			  
			  <div class="col-md-4">
                <div class="form-group">
                  <label>GSTIN</label>
                  <input type="text" name="consignor_details_GSTIN" class="form-control consignor_details_GSTIN" placeholder="" required>
                </div>
              </div>
			  
			  <div class="col-md-4">
                <div class="form-group">
                  <label>Designtiaon</label>
                  <input type="text" name="consignor_details_designtiaon" class="form-control consignor_details_designtiaon" placeholder="" required>
                </div>
              </div>
			  
			  </div>
			  
			  <hr>
			  
			  <h4>Consignee Details</h4>
			  <div class="row">
			  
			  <div class="col-md-4">
                <div class="form-group">
                  <label>Name</label>
                  <input type="text" name="consignee_details_name" class="form-control consignee_details_name" placeholder="">
                </div>
              </div>
			  
			  <div class="col-md-4">
                <div class="form-group">
                  <label>Address</label>
                  <input type="text" name="consignee_details_address" class="form-control consignee_details_address" placeholder="">
                </div>
              </div>
			  
			  <div class="col-md-4">
                <div class="form-group">
                  <label>GSTIN</label>
                  <input type="text" name="consignee_details_GSTIN" class="form-control consignee_details_GSTIN" placeholder="">
                </div>
              </div>
			  
			  
			  </div>
			  
			  <hr>
			  
			  <h4>Sold to Contain</h4>
			  <div class="row">
			    
			  <div class="col-md-3">
                <div class="form-group">
                  <label>Product</label>
                  <input type="text" name="sold_to_contain_product" class="form-control sold_to_contain_product" placeholder="" required>
                </div>
              </div>
			  
			  <div class="col-md-3">
                <div class="form-group">
                  <label>No. of Pkg</label>
                  <input type="text" name="sold_to_contain_no_of_pkg" class="form-control sold_to_contain_no_of_pkg" placeholder="" required>
                </div>
              </div>
			  
			  <div class="col-md-3">
                <div class="form-group">
                  <label>Packing</label>
                  <input type="text" name="sold_to_contain_packing" class="form-control sold_to_contain_packing" placeholder="" required>
                </div>
              </div>
			  
			  <div class="col-md-3">
                <div class="form-group">
                  <label>Value of Goods (Rs.)</label>
                  <input type="text" name="sold_to_contain_value_of_goods" class="form-control sold_to_contain_value_of_goods" placeholder="" required>
                </div>
              </div>
			  
            </div>
			  
			  <hr>
			  
			  <h4>Weight in MT</h4>
			<div class="row">
			  
			  <div class="col-md-4">
                <div class="form-group">
                  <label>Net</label>
                  <input type="text" name="weight_in_MT_net" class="form-control weight_in_MT_net" placeholder="" required>
                </div>
              </div>
			  
			  <div class="col-md-4">
                <div class="form-group">
                  <label>Weight</label>
                  <input type="text" name="weight_in_MT_weight" class="form-control weight_in_MT_weight" placeholder="" required>
                </div>
              </div>
			  
			  <div class="col-md-4">
                <div class="form-group">
                  <label>Minimum Gurantee Weight</label>
                  <input type="text" name="weight_in_MT_minimum_gurantee_weight" class="form-control weight_in_MT_minimum_gurantee_weight" placeholder="" required>
                </div>
              </div>
			  
			</div>
			
			<hr>
			  
			 <h4>Freight Charge Amount</h4>
			<div class="row">
			  <div class="col-md-3">
                <div class="form-group">
				  <label>Freight</label>
                  <input type="text" name="freight_charge_amount_freight" class="form-control freight_charge_amount_freight">
                </div>
              </div>
			  
			  <div class="col-md-3">
                <div class="form-group">
				  <label>Rate PMT</label>
                  <input type="text"  name="freight_charge_amount_rate_PMT" class="form-control freight_charge_amount_rate_PMT">
                </div>
              </div>
			  
			  <div class="col-md-3">
                <div class="form-group">
				  <label>Advance</label>
                  <input type="text"  name="freight_charge_amount_advance" class="form-control freight_charge_amount_advance">
                </div>
              </div>
			  
			  <div class="col-md-3">
                <div class="form-group">
				  <label>Balance</label>
                  <input type="text"  name="freight_charge_amount_balance" class="form-control freight_charge_amount_balance">
                </div>
              </div>
			  
			</div>
			
			<hr>
			  
			 <h4>Party Document Details</h4>
			<div class="row">
			  <div class="col-md-3">
                <div class="form-group">
				  <label>Document Type</label>
                  <input type="text" name="party_document_details_document_type" class="form-control party_document_details_document_type">
                </div>
              </div>
			  
			  <div class="col-md-3">
                <div class="form-group">
				  <label>Document No.</label>
                  <input type="text" name="party_document_details_document_no" class="form-control party_document_details_document_no">
                </div>
              </div>
			  
			  <div class="col-md-3">
                <div class="form-group">
				  <label>Document Date</label>
                  <input type="date" name="party_document_details_document_date" class="form-control party_document_details_document_date">
                </div>
              </div>
			  
			  <div class="col-md-3">
                <div class="form-group">
				  <label>Invoice No.</label>
                  <input type="text" name="party_document_details_invoice_no" class="form-control party_document_details_invoice_no">
                </div>
              </div>
			  
			</div>
			
			
			<hr>
			  
			<h4>Basis of Booking</h4>
			<div class="row">
			  <div class="col-md-12">
			   <div class="form-group form-check">
				<input type="checkbox" class="form-check-input" name="basis_of_booking" id="basis_of_booking">
				<label class="form-check-label" for="basis_of_booking">To be billed at</label>
			   </div>
              </div>
			  
			</div>
			
			<hr>
			  <h4>Branch</h4>
			<div class="row">
        
			  <div class="col-md-6">
			   <div class="form-group form-check">
				<input type="checkbox" class="form-check-input" name="branch_to_pay" id="branch_to_pay">
				<label class="form-check-label" for="branch_to_pay">To Pay </label>
			   </div>
              </div>
			  
			  <div class="col-md-6">
			   <div class="form-group form-check">
				<input type="checkbox" class="form-check-input" name="branch_paid" id="branch_paid">
				<label class="form-check-label" for="branch_paid">Paid</label>
			   </div>
              </div>
			  
			</div>
			
			<hr>
			  <h4>Transit Insurance By</h4>
			<div class="row">
        
			  <div class="col-md-6">
			   <div class="form-group form-check">
				<input type="checkbox" class="form-check-input" name="transit_insurance_by_carrier" id="transit_insurance_by_carrier">
				<label class="form-check-label" for="transit_insurance_by_carrier">Carrier </label>
			   </div>
              </div>
			  
			  <div class="col-md-6">
			   <div class="form-group form-check">
				<input type="checkbox" class="form-check-input" name="transit_insurance_by_customer" id="transit_insurance_by_customer">
				<label class="form-check-label" for="transit_insurance_by_customer">Customer</label>
			   </div>
              </div>
			  
			</div>
			
			
			<hr>
			  
			<div class="row">
			  
			  <div class="col-md-4">
                <div class="form-group">
				  <label>Name of Insurance Company</label>
                  <input type="text" name="name_of_insurance_company" class="form-control name_of_insurance_company">
                </div>
              </div>
			  
			  <div class="col-md-4">
                <div class="form-group">
				  <label>Policy No.</label>
                  <input type="text" name="policy_no" class="form-control policy_no">
                </div>
              </div>
			  
			  <div class="col-md-4">
                <div class="form-group">
				  <label>Policy Date</label>
                  <input type="date" name="policy_date" class="form-control policy_date">
                </div>
              </div>
			  
			  <div class="col-md-4">
                <div class="form-group">
				  <label>Any Remarks</label>
                  <input type="text" name="any_remarks" class="form-control any_remarks">
                </div>
              </div>
			  
			</div>
			
			<hr>
			
			<h4>GST to be paid to Government by (*)</h4>
			<div class="row"> 
			  <div class="col-md-3">
			   <div class="form-group form-check">
				<input type="checkbox" class="form-check-input" name="government_by_consignor" id="government_by_consignor">
				<label class="form-check-label" for="government_by_consignor">Consignor</label>
			   </div>
              </div>
			  
			  <div class="col-md-3">
			   <div class="form-group form-check">
				<input type="checkbox" class="form-check-input" name="government_by_consignee" id="government_by_consignee">
				<label class="form-check-label" for="government_by_consignee">Consignee</label>
			   </div>
              </div>
			  
			  <div class="col-md-3">
			   <div class="form-group form-check">
				<input type="checkbox" class="form-check-input" name="government_by_GTA" id="government_by_GTA">
				<label class="form-check-label" for="government_by_GTA">GTA</label>
			   </div>
              </div>
			  
			  <div class="col-md-3">
			   <div class="form-group form-check">
				<input type="checkbox" class="form-check-input" name="government_by_exempt" id="government_by_exempt">
				<label class="form-check-label" for="government_by_exempt">Exempt(**)</label>
			   </div>
              </div>
			  
			</div>
			
			<hr>
			
			<h4>Loading Detenon Details</h4>
			<div class="row">
			  <div class="col-md-4">
                <div class="form-group">
                  <label>Reporng Date/Time</label>
                  <input type="text" name="reporng_date_time" class="form-control reporng_date_time" placeholder="" required>
                </div>
              </div>
			  
			  <div class="col-md-4">
                <div class="form-group">
                  <label>Releasing Date/Time</label>
                  <input type="text" name="releasing_date_time" class="form-control releasing_date_time" placeholder="" required>
                </div>
              </div>
			  
			  <div class="col-md-4">
                <div class="form-group">
                  <label>Reason for  Detention</label>
                  <input type="text" name="reason_for_detention" class="form-control reason_for_detention" placeholder="" required>
                </div>
              </div>
			  
			</div>
			
			<hr>
			  
			  <h4>Loading Supervisor Details </h4>
			<div class="row">
			  
			  <div class="col-md-4">
                <div class="form-group">
                  <label>Name</label>
                  <input type="text" name="loading_supervisor_details_name" class="form-control loading_supervisor_details_name" placeholder="" required>
                </div>
              </div>
			  
			  <div class="col-md-4">
                <div class="form-group">
                  <label>Employee Code</label>
                  <input type="text" name="loading_supervisor_details_employee_code" class="form-control loading_supervisor_details_employee_code" placeholder="" required>
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