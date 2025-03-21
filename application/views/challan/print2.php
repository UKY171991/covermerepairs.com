
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper" style="background:#a9c5d3">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>BRANCH/REGION COPY</h1> 
            <h1><input type='button' id='btn' value='Print' onclick='printDiv_2();'></h1> 
          </div>
          <div class="col-sm-6 col-sm-6">
            <ol class="breadcrumb float-sm-right">
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
              <div class="card-header" id="print_data_2"  style="background:#a9c5d3">
                 <!-- <h3 class="card-title">DataTable with default features</h3> -->
                 
                   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
                  <div class="container-fluid">
                    <?php 
                      $branch_data = $this->db->query("SELECT name FROM branch where id='".$challan[0]->branch."'");
                      $branch = $branch_data->result_array();
                      //print_r($branch);

                      //$date=date_create($challan[0]->created);
                      ?>

                   <div class="row">
                    <div class="col-xs-7 col-sm-7 col-md-7 border">
                      <div class="row">
                        <div class="col-xs-5 col-sm-5 col-md-5">
                          <img src="<?=base_url('assets/img/logo.png')?>">
                        </div>
                        <div class="col-xs-7 col-sm-7 col-md-7">
                          <h2 class="text-center">FREIGHT CHALLAN BRANCH/REGION COPY</h2><br>

                        </div>
                      </div>
                        <?=$branch[0]['name'];?><br>
                        <strong>Registered Office: </strong><br>
                        <p>B-2/274-275, Sector-6, Rohini Delhi-110085 Ph No. 011-45120166</p>
                    </div>
                    <div class="col-xs-5 col-sm-5 col-md-5 border">

                      
                      <h5>Branch: <?=$branch[0]['name'];?></h5>
                      <h5>PSN: <?=$challan[0]->PSN;?></h5>
                      <h5>Challan No.: <?=$challan[0]->challan_no;?></h5>
                      <h5>Challan Date: <?=date_format(date_create($challan[0]->created),"d-m-Y");?></h5>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-xs-4 col-sm-4 col-md-4 border">Loading Staon:- <?=$challan[0]->loading_station;?></div>
                    <div class="col-xs-4 col-sm-4 col-md-4 border">Distance (KMS):- <?=$challan[0]->distance;?></div>
                    <div class="col-xs-4 col-sm-4 col-md-4 border">Truck No:- <?=$challan[0]->truck_no;?></div>
                  </div>

                  <div class="row">
                    <div class="col-xs-3 col-sm-3 col-md-3 border">Delivery Staon:- <?=$challan[0]->delivery_station;?></div>
                    <div class="col-xs-3 col-sm-3 col-md-3 border">Transit Days:- <?=$challan[0]->transit_days;?></div>
                    <div class="col-xs-3 col-sm-3 col-md-3 border">Vehicle No:- <?=$challan[0]->vehicle_no;?></div>
                    <div class="col-xs-3 col-sm-3 col-md-3 border">Vehicle Type:- <?=$challan[0]->vehicle_type;?></div>
                  </div>

                  <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12 border">
                      <table class="table table-bordered">
                        <tr>
                          <th>CN No</th>
                          <th>CN Date</th>
                          <th>CN Destination</th>
                          <th>Nature of Goods</th>
                          <th>Value of Goods(₹)</th>
                          <th>No. of PKGs</th>
                          <th>Desp. Weight</th>
                          <th>Exp. Del Date</th>
                        </tr>
                        <tr>
                          <td><?=$challan[0]->cn_no_r1;?></td>
                          <td><?=date_format(date_create($challan[0]->cn_date_r1),"d-m-Y");?></td>
                          <td><?=$challan[0]->cn_destination_r1;?></td>
                          <td><?=$challan[0]->nature_of_goods_r1;?></td>
                          <td><?=$challan[0]->value_of_goods_r1;?></td>
                          <td><?=$challan[0]->no_of_pkgs_r1;?></td>
                          <td><?=$challan[0]->desp_weight_r1;?></td>
                          <td><?=date_format(date_create($challan[0]->exp_del_date_r1),"d-m-Y");?></td>
                        </tr>
                        <tr>
                          <td><?=$challan[0]->cn_no_r2;?></td>
                          <td><?=date_format(date_create($challan[0]->cn_date_r2),"d-m-Y");?></td>
                          <td><?=$challan[0]->cn_destination_r2;?></td>
                          <td><?=$challan[0]->nature_of_goods_r2;?></td>
                          <td><?=$challan[0]->value_of_goods_r2;?></td>
                          <td><?=$challan[0]->no_of_pkgs_r2;?></td>
                          <td><?=$challan[0]->desp_weight_r2;?></td>
                          <td><?=date_format(date_create($challan[0]->exp_del_date_r1),"d-m-Y");?></td>
                        </tr>
                      </table>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-xs-4 col-sm-4 col-md-4 border">
                      <div class="row">
                        <div class="col-xs-6 col-sm-6 col-md-6 border"><b>Charge Type</b></div>
                        <div class="col-xs-6 col-sm-6 col-md-6 border"><b>Amount (₹)</b></div>
                        <div class="col-xs-6 col-sm-6 col-md-6 border">Lorry Hire</div>
                        <div class="col-xs-6 col-sm-6 col-md-6 border"><?=$challan[0]->lorry_hire;?></div>
                        <div class="col-xs-6 col-sm-6 col-md-6 border">Loading Labour</div>
                        <div class="col-xs-6 col-sm-6 col-md-6 border"><?=$challan[0]->loading_labour;?></div>
                        <div class="col-xs-6 col-sm-6 col-md-6 border">Loading Detention</div>
                        <div class="col-xs-6 col-sm-6 col-md-6 border"><?=$challan[0]->loading_deten;?></div>
                        <div class="col-xs-6 col-sm-6 col-md-6 border">Other</div>
                        <div class="col-xs-6 col-sm-6 col-md-6 border"><?=$challan[0]->other;?></div>
                        <div class="col-xs-6 col-sm-6 col-md-6 border">TDS Amount</div>
                        <div class="col-xs-6 col-sm-6 col-md-6 border"><?=$challan[0]->tds_amount;?></div>
                        <div class="col-xs-6 col-sm-6 col-md-6 border">Total</div>
                        <div class="col-xs-6 col-sm-6 col-md-6 border"><?=$challan[0]->tds_amount;?></div>
                        <div class="col-xs-6 col-sm-6 col-md-6 border">total</div>
                        <div class="col-xs-6 col-sm-6 col-md-6 border"><?=$challan[0]->total;?></div>
                        <div class="col-xs-6 col-sm-6 col-md-6 border">(-) Advance (B)</div>
                        <div class="col-xs-6 col-sm-6 col-md-6 border"><?=$challan[0]->advance;?></div>
                        <div class="col-xs-6 col-sm-6 col-md-6 border">=) Balance (A-B)</div>
                        <div class="col-xs-6 col-sm-6 col-md-6 border"><?=$challan[0]->balance;?></div>
                      </div>
                    </div>
                    <div class="col-xs-8 col-sm-8 col-md-8 border">
                      <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 border">
                          CALCULATION: <?=$challan[0]->lorry_hire+$challan[0]->loading_labour+$challan[0]->loading_deten+$challan[0]->other+$challan[0]->tds_amount+$challan[0]->total+$challan[0]->advance+$challan[0]->balance;?>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12 border">
                            <div class="row">
                                <div class="col-xs-3 col-sm-3 col-md-3 border">Charge Wt(MT):</div>
                                <div class="col-xs-3 col-sm-3 col-md-3 border"><?=$challan[0]->charge_Wt;?></div>
                                <div class="col-xs-2 col-sm-2 col-md-2 border">(₹)</div>
                                <div class="col-xs-2 col-sm-2 col-md-2 border"></div>
                                <div class="col-xs-2 col-sm-2 col-md-2 border"></div>
                            </div>
                        </div>
                        
                        <div class="col-xs-12 col-sm-12 col-md-12 border">
                          Total Amount On Which the TDS Deducted (₹): <?=$challan[0]->total_amount_after_tds;?>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12 border">
                            <div class="row">
                                <div class="col-xs-6 col-sm-6 col-md-6 border">
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-12 col-md-12 border">
                                            <strong>Late Delivery Penality:-</strong> 
                                        </div>
                                        <div class="col-xs-12 col-sm-12 col-md-12 border">
                                            <?=$challan[0]->late_delivery_penality;?>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-6 col-sm-12 col-md-6 border">
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-12 col-md-12 border">
                                            <strong>Late Receiving Submission Penality:-</strong> <br>
                                            Exp. Submit Date <?=date_format(date_create($challan[0]->created),"d-m-Y");?> Days aer delivery<br>
                                            Penality Per Day (₹) <?=$challan[0]->late_receiving_submission_penality;?>
                                        </div>
                                        <div class="col-xs-12 col-sm-12 col-md-12 border">
                                          <strong>Delivery Incharge Contact No. :-</strong><br> <?=$challan[0]->delivery_incharge_contact_no;?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  
                  <div class="row">
                    <div class="col-xs-8 col-sm-8 col-md-8 border">
                          Other Advance Details
                          <table class="table table-bordered">
                              <tr>
                                  <th>Branch</th>
                                  <th>Amount (C)</th>
                                  <th>Date</th>
                                  <th>Balance (A-B-C)</th>
                              </tr>
                              <tr>
                                  <td></td>
                                  <td></td>
                                  <td></td>
                                  <td></td>
                              </tr>
                              <tr>
                                  <td></td>
                                  <td></td>
                                  <td></td>
                                  <td></td>
                              </tr>
                              <tr>
                                  <td></td>
                                  <td></td>
                                  <td></td>
                                  <td></td>
                              </tr>
                          </table>
                    </div>
                    <div class="col-xs-4 col-sm-4 col-md-4 border">
                          <strong>Balance at Branch & Phone :-</strong> <br><?=$challan[0]->balance_at_branch_phone;?>
                    </div>
                  </div>
                  
                  <div class="row">
                    <div class="col-xs-6 col-sm-6 col-md-6 border">
                      <strong>Truck Supplier Details</strong><br>
                      <?=$challan[0]->truck_supplier_details;?><br><br>
                      <p>If TDS cert is to issued to Registered Truck Supplier then above Menoned address will be used</p>
                    </div>
                    <div class="col-xs-6 col-sm-6 col-md-6 border">
                      <strong>Current Lorry Owner Details</strong><br>
                      <?=$challan[0]->current_lorry_owner_details;?><br><br>
                      <p>If TDS cert is to issued to Lorry Owner then above Menoned address will be used</p>
                    </div>

                    <div class="col-xs-6 col-sm-6 col-md-6 border">
                      Planned Transit Pass / Bah Details
                      <div class="row">
                        <div class="col-xs-4 col-sm-4 col-md-4 border">State <input type="checkbox" name=""></div>
                        <div class="col-xs-4 col-sm-4 col-md-4 border">Entry Check Post <input type="checkbox" name=""></div>
                        <div class="col-xs-4 col-sm-4 col-md-4 border">Exit Check Post <input type="checkbox" name=""></div>
                        <div class="col-xs-6 col-sm-6 col-md-6 border"><strong>Vendor Helpline</strong></div>
                        <div class="col-xs-6 col-sm-6 col-md-6 border">
                          Phone No. 011-45120166<br>Email : reachus@gglff.com
                        </div>
                      </div>
                    </div>
                    <div class="col-xs-6 col-sm-6 col-md-6 border">
                      <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12">
                          <strong>Vendor for Accounng Purpose:</strong><br>
                          Vehicle Owner<br>Subcontractor (Vide Agreement No...........Dated.................)
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-xs-6 col-sm-6 col-md-6 border">
                      <strong>Loading Supervisor Details</strong><br>
                      Name: <?=$challan[0]->loading_supervisor_details;?><br>
                      Emp Code: <?=$challan[0]->emp_code;?><br>
                      Signature<br><br>
                    </div>
                    <div class="col-xs-6 col-sm-6 col-md-6 border">
                      <strong>Lorry Driver Details</strong><br>
                      Name:<?=$challan[0]->lorry_driver_details_name;?><br>
                      Name:<?=$challan[0]->lorry_driver_details_license_no;?><br>
                      Name:<?=$challan[0]->lorry_driver_details_mobile_no;?><br>
                      Signature<br><br>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12 border">Special Instruction :</div>
                    
                  </div>

                </div>
              </div>

              <?php
                // echo "<pre>";
                //  print_r($challan);
                //  echo "</pre>";
                 ?>

              
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

<script type="text/javascript">
  //$(document).ready(function () {
    //$("#print_data").print();
    //window.print();
  //});

  function printDiv_2() 
  {

    var divToPrint=document.getElementById('print_data_2');

    //var newWin=window.open('Print-Window');
    var newWin=window.open();

    newWin.document.open();

    newWin.document.write('<html><body onload="window.print()">'+divToPrint.innerHTML+'</body></html>');

    newWin.document.close();

   // setTimeout(function(){newWin.close();},10);

  }
</script>