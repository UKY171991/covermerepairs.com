
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Consignee Copy</h1> 
            <h1><input type='button' id='btn' value='Print' onclick='printDiv_2();'></h1> 
          </div>
          <div class="col-sm-6 col-sm-6">
            <ol class="breadcrumb float-sm-right">
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
              <div class="card-header" id="print_data_2" style="background: #acc9d7;">
                 <!-- <h3 class="card-title">DataTable with default features</h3> -->
                 
                   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
                  <div class="container-fluid">
                    <?php 
                      $branch_data = $this->db->query("SELECT name FROM branch where id='".$billty[0]->branch."'");
                      $branch = $branch_data->result_array();
                      //print_r($branch);

                      //$date=date_create($billty[0]->created);
                      ?>

                    <div class="row">
                      <div class="col-xs-4 col-sm-4 col-md-4 border"><img src="<?=base_url('assets/img/logo.png')?>"></div>
                      <div class="col-xs-4 col-sm-4 col-md-4 border">
                        <center>
                        <h4>CONSIGNMENT NOTE</h4>
                        <h5>Consignee Copy</h5>
                        <small  style="color:red;">(GOODS WILL BE DELIVERED AGST. THIS COPY)</small>
                        </center>
                      </div>
                      <div class="col-xs-4 col-sm-4 col-md-4 border">
                        <div class="row">
                          <div class="col-xs-12 col-sm-12 col-md-12 border">PSN: <?=$billty[0]->PSN;?></div>
                          <div class="col-xs-12 col-sm-12 col-md-12 border">Consignment No: <?=$billty[0]->consignment_no;?></div>
                        </div>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-xs-4 col-sm-4 col-md-4 border">
                        <?=$branch[0]['name'];?><br>
                        <strong>Registered Office: </strong><br>
                        <p>B-2/274-275, Sector-6, Rohini Delhi-110085 Ph No. 011-45120166</p>
                      </div>
                      <div class="col-xs-4 col-sm-4 col-md-4 border">
                        <div class="col-xs-12 col-sm-12 col-md-12 border">Branch: <?=$branch[0]['name'];?></div>
                        <div class="col-xs-12 col-sm-12 col-md-12 border">
                          CIN: <?=$billty[0]->CIN;?></br>
                          PAN: <?=$billty[0]->PAN;?></br>
                        </div>
                      </div>
                      <div class="col-xs-4 col-sm-4 col-md-4 border">
                        Consignment Date: <?=date_format(date_create($billty[0]->created),"d-m-Y");?>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-xs-8 col-sm-8 col-md-8 border">Customer Support : Email : reachus@gglff.com,</div>
                      <div class="col-xs-4 col-sm-4 col-md-4 border">SAP Delivery No: <?=$billty[0]->work_order_details_SAP_delivery_no;?></div>
                    </div>

                    <div class="row">
                      <div class="col-xs-12 col-sm-12 col-md-12 border"><strong>Work Order Details</strong></div>
                      <div class="col-xs-6 col-sm-6 col-md-6 border">WO No. : <?=$billty[0]->work_order_details_WO_No;?></div>
                      <div class="col-xs-6 col-sm-6 col-md-6 border">Date : <?=date_format(date_create($billty[0]->work_order_details_date),"d-m-Y");?></div>
                    </div>

                    <div class="row">
                      <div class="col-xs-4 col-sm-4 col-md-4 border">Loading Staon : <?=$billty[0]->work_order_details_loading_station;?></div>
                      <div class="col-xs-4 col-sm-4 col-md-4 border">Distance (Kms) : <?=$billty[0]->work_order_details_distance;?></div>
                      <div class="col-xs-4 col-sm-4 col-md-4 border">Vehicle No.: <?=$billty[0]->work_order_details_vehicle_no;?></div>
                    </div>

                    <div class="row">
                      <div class="col-xs-4 col-sm-4 col-md-4 border">Delivery Staon : <?=$billty[0]->work_order_details_delivery_station;?></div>
                      <div class="col-xs-4 col-sm-4 col-md-4 border">Transit Days : <?=$billty[0]->work_order_details_transit_days;?></div>
                      <div class="col-xs-4 col-sm-4 col-md-4 border">Load Type : <?=$billty[0]->work_order_details_load_type;?></div>
                    </div>

                    <div class="row">
                      <div class="col-xs-6 col-sm-6 col-md-6 border">
                        <p class="text-center"><strong>Consignor Details</strong></p>
                        <div class="row">
                          <div class="col-xs-12 col-sm-12 col-md-12 border">Name: <?=$billty[0]->consignor_details_name;?></div>
                          <div class="col-xs-12 col-sm-12 col-md-12 border">Address: <?=$billty[0]->consignor_details_address;?></div>
                          <div class="col-xs-12 col-sm-12 col-md-12 border">GSTIN: <?=$billty[0]->consignor_details_GSTIN;?></div>
                        </div>
                      </div>
                      <div class="col-xs-6 col-sm-6 col-md-6 border">
                        <p class="text-center"><strong>Consignee Details</strong></p>
                        <div class="row">
                          <div class="col-xs-12 col-sm-12 col-md-12 border">Name: <?=$billty[0]->consignee_details_name;?></div>
                          <div class="col-xs-12 col-sm-12 col-md-12 border">Address: <?=$billty[0]->consignee_details_address;?></div>
                          <div class="col-xs-12 col-sm-12 col-md-12 border">GSTIN: <?=$billty[0]->consignee_details_GSTIN;?></div>
                        </div>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-xs-8 col-sm-8 col-md-8 border">
                        Sold to Contain
                        <table class="table table-bordered">
                          <tr>
                            <th>Product</th>
                            <th>No. of Pkg</th>
                            <th>Packing</th>
                            <th>Value of Goods (Rs.)</th>
                          </tr>
                          <tr>
                            <td><?=$billty[0]->work_order_details_SAP_delivery_no;?></td>
                            <td><?=$billty[0]->sold_to_contain_no_of_pkg;?></td>
                            <td><?=$billty[0]->sold_to_contain_packing;?></td>
                            <td><?=$billty[0]->sold_to_contain_value_of_goods;?></td>
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
                        <p>Received goods as per details above for carriage subject to the condions given overleaf.</p>
                      </div>
                      <div class="col-xs-4 col-sm-4 col-md-4 border">
                        Sold to Contain
                        <div class="row">
                          <div class="col-xs-4 col-sm-4 col-md-4 border">Net : </div>
                          <div class="col-xs-8 col-sm-8 col-md-8 border"><?=$billty[0]->weight_in_MT_net;?></div>
                          <div class="col-xs-4 col-sm-4 col-md-4 border">Weight : </div>
                          <div class="col-xs-8 col-sm-8 col-md-8 border"><?=$billty[0]->weight_in_MT_weight;?></div>
                          <div class="col-xs-12 col-sm-12 col-md-12 border">
                            <input type="checkbox" name=""> Minimum Gurantee Weight
                          </div>
                          <div class="col-xs-12 col-sm-12 col-md-12 border">
                            <?=$billty[0]->weight_in_MT_minimum_gurantee_weight;?>
                          </div>
                          <div class="col-xs-12 col-sm-12 col-md-12 border"><strong>Freight Charge Amount</strong></div>
                          <div class="col-xs-4 col-sm-4 col-md-4 border">Freight :</div>
                          <div class="col-xs-8 col-sm-8 col-md-8 border"><?=$billty[0]->freight_charge_amount_freight;?></div>
                          <div class="col-xs-4 col-sm-4 col-md-4 border">Rate PMT</div>
                          <div class="col-xs-8 col-sm-8 col-md-8 border"><?=$billty[0]->freight_charge_amount_rate_PMT;?></div>
                          <div class="col-xs-4 col-sm-4 col-md-4 border">Advance</div>
                          <div class="col-xs-8 col-sm-8 col-md-8 border"><?=$billty[0]->freight_charge_amount_advance;?></div>
                          <div class="col-xs-4 col-sm-4 col-md-4 border">Balance</div>
                          <div class="col-xs-8 col-sm-8 col-md-8 border"><?=$billty[0]->freight_charge_amount_balance;?></div>
                        </div>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-xs-8 col-sm-8 col-md-8 border">
                        <strong>Party Document Details</strong>
                        <div class="row">
                          <div class="col-xs-4 col-sm-4 col-md-4 border"><strong>Document Type</strong></div>
                          <div class="col-xs-4 col-sm-4 col-md-4 border"><strong>Document No.</strong></div>
                          <div class="col-xs-4 col-sm-4 col-md-4 border"><strong>Document Date</strong></div>
                          <div class="col-xs-4 col-sm-4 col-md-4 border"></div>
                          <div class="col-xs-4 col-sm-4 col-md-4 border"></div>
                          <div class="col-xs-4 col-sm-4 col-md-4 border"></div>
                          <div class="col-xs-4 col-sm-4 col-md-4 border">Invoice No</div>
                          <div class="col-xs-4 col-sm-4 col-md-4 border"></div>
                          <div class="col-xs-4 col-sm-4 col-md-4 border"></div>
                        </div>
                        <div class="row">
                          <div class="col-xs-6 col-sm-6 col-md-6 border">
                            GST to be paid to Government by (*)
                            <div class="row">
                              <div class="col-xs-6 col-sm-6 col-md-6 border">
                                <input type="checkbox" <?php if($billty[0]->government_by_consignor=='on'){ echo 'checked'; }else{ echo ''; } ?> > Consignor
                              </div>
                              <div class="col-xs-6 col-sm-6 col-md-6 border">
                                <input type="checkbox" <?php if($billty[0]->government_by_consignee=='on'){ echo 'checked'; }else{ echo ''; } ?>> Consignee
                              </div>
                              <div class="col-xs-6 col-sm-6 col-md-6 border">
                                <input type="checkbox" <?php if($billty[0]->government_by_GTA=='on'){ echo 'checked'; }else{ echo ''; } ?>> GTA
                              </div>
                              <div class="col-xs-6 col-sm-6 col-md-6 border">
                                <input type="checkbox" <?php if($billty[0]->government_by_exempt=='on'){ echo 'checked'; }else{ echo ''; } ?>> Exempt(**)
                              </div>
                            </div>
                            <p><small>*In case recipient of services fails under nofied category GST liability fails on recipient of service instead of GTA service provider.</small></p>
                            <p><small>* services rendered may be exempt noficaon no. 12/2017-central Tax (rate) the dated 28 june 2017 being transportaon of agriculture product, Milk, Salt and Food grain including Flour Pulses & Rice Organic nature, Newspaper or Magazines, relief materials meant for vicms of natural or manual or manmade disasters calamies accidents and mishap and military equipments.</small></p>
                            <p><small>*Declaraon: we hereby declare that we have not enrolled input tax credit of input, input service & capitals goods for providing the output taxable service of goods transport agency service.</small></p>
                          </div>
                          <div class="col-xs-6 col-sm-6 col-md-6 border">
                            Loading Detenon Details
                            <div class="row">
                              <div class="col-xs-6 col-sm-6 col-md-6 border">Reporng Date/Time : </div>
                              <div class="col-xs-6 col-sm-6 col-md-6 border"><?=date_format(date_create($billty[0]->reporng_date_time),"d-m-Y");?></div>
                              <div class="col-xs-6 col-sm-6 col-md-6 border">Releasing Date/me : </div>
                              <div class="col-xs-6 col-sm-6 col-md-6 border"><?=date_format(date_create($billty[0]->releasing_date_time),"d-m-Y");?></div>
                              <div class="col-xs-12 col-sm-12 col-md-12 border">
                                Reason for Detention : <br> <?=$billty[0]->reason_for_detention;?>
                              </div>
                              <div class="col-xs-12 col-sm-12 col-md-12 border">
                                Signature of Consigner Rep : <br><br><br>
                              </div>
                            </div>

                          </div>

                          <div class="col-xs-12 col-sm-12 col-md-12 border">

                            <div class="row">
                              <div class="col-xs-6 col-sm-6 col-md-6 border">
                                <div class="row">
                                  <div class="col-xs-12 col-sm-12 col-md-12 border">Consignor Details (See Terms Overleaf)</div>
                                  <div class="col-xs-12 col-sm-12 col-md-12 border">Name & Signature of Rep. :<br><br><br></div>
                                </div>
                              </div>
                              <div class="col-xs-6 col-sm-6 col-md-6 border">
                                <div class="row">
                                  <div class="col-xs-12 col-sm-12 col-md-12 border">Loading Supervisor Details (See Terms Overleaf)</div>
                                  <div class="col-xs-12 col-sm-12 col-md-12 border">Name & Signature :<br><br><br></div>
                                </div>
                              </div>
                              
                            </div>

                          </div>
                        </div>
                      </div>
                      <div class="col-xs- col-sm-4 col-md-4 border">
                        <strong>Basis of Booking</strong>
                        <div class="row">
                          <div class="col-xs-12 col-sm-12 col-md-12 border"><input type="checkbox"> To be billed at</div>
                          <div class="col-xs-12 col-sm-12 col-md-12 border">Branch : <?=$branch[0]['name'];?></div>
                          <div class="col-xs-6 col-sm-6 col-md-6 border"><input type="checkbox"> To Pay </div>
                          <div class="col-xs-6 col-sm-6 col-md-6 border"><input type="checkbox"> Paid</div>
                          <div class="col-xs-12 col-sm-12 col-md-12 border text-center"><strong>Transit Insurance By</strong></div>
                          <div class="col-xs-6 col-sm-6 col-md-6 border"><input type="checkbox"> Carrier</div>
                          <div class="col-xs-6 col-sm-6 col-md-6 border"><input type="checkbox"> Customer</div>
                          <div class="col-xs-6 col-sm-12 col-md-12 border">Name of Insurance Company <br> <?=$billty[0]->name_of_insurance_company;?></div>
                          <div class="col-xs-5 col-sm-5 col-md-5 border">Policy No. :</div>
                          <div class="col-xs-7 col-sm-7 col-md-7 border"><?=$billty[0]->policy_no;?></div>
                          <div class="col-xs-6 col-sm-6 col-md-6 border">Policy Date : </div>
                          <div class="col-xs-6 col-sm-6 col-md-6 border"> <?=date_format(date_create($billty[0]->policy_date),"d-m-Y");?></div>
                          <div class="col-xs-12 col-sm-12 col-md-12 border">
                            <small style="color:red">Not Responsible for Breaking/Leakage</small>
                          </div>
                          <div class="col-xs-12 col-sm-12 col-md-12">
                            <span class="text-center">Any Remarks</span><br>
                            <?=$billty[0]->any_remarks;?>
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-xs-4 col-sm-4 col-md-4 border">Designaon : <?=$billty[0]->consignor_details_designtiaon;?></div>
                      <div class="col-xs-4 col-sm-4 col-md-4 border">Employee Code : <?=$billty[0]->loading_supervisor_details_employee_code;?></div>
                      <div class="col-xs-4 col-sm-4 col-md-4 border"></div>
                    </div>

                   

                  <?php
                // echo "<pre>";
                //  print_r($billty);
                //  echo "</pre>";
                 ?>

                </div>
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