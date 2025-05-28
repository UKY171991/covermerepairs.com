<!-- Content Wrapper. Contains page content -->

<style>
  .main-footer {
    display: none;
  }
  .pdf-header-table { width: 100%; border-collapse: collapse; margin-bottom: 0; }
  .pdf-header-table td { vertical-align: top; }
  .logo-cell { width: 120px; }
  .center-cell { text-align: center; font-size: 16px; font-weight: bold; }
  .right-cell { text-align: right; font-size: 13px; }
  .form-title { text-align: center; font-size: 18px; font-weight: bold; margin: 10px 0; }
  .meta-table, .info-table, .fault-table, .device-table, .condition-table, .signature-table { width: 100%; border-collapse: collapse; margin-bottom: 10px; }
  .meta-table td, .info-table td, .fault-table td, .device-table td, .condition-table td, .signature-table td { border: 1px solid #000; padding: 4px; font-size: 13px; }
  .meta-table th, .info-table th, .fault-table th { border: 1px solid #000; padding: 4px; font-size: 13px; background: #f5f5f5; }
  .section-title { font-weight: bold; margin-top: 18px; font-size: 15px; }
  .small-text { font-size: 12px; }
  .bullet-list { margin: 0 0 0 18px; padding: 0; }
  .bullet-list li { margin-bottom: 4px; }
  .signature-line { border-bottom: 1px solid #000; width: 180px; display: inline-block; margin-bottom: 2px; }
  .signature-table td { border: none; font-size: 13px; }
  .no-border { border: none !important; }
</style>

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <!-- <h1>Print Jobs</h1>  -->
          <button class="card-btn btn btn-info btn-sm" onclick='return print()'>Print Job</button>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Print Jobs</li>
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


            <div class="container mt-4">
                <div class="text-center">
                    <h2><?=!empty($branch) ? $branch[0]->name : ''?></h2>
                    <p>Phone: <?=!empty($branch) ? $branch[0]->phone : ''?></p>
                    <p>Email: barnch1@gmail.com</p>
                    <p>Address: <?=!empty($branch) ? $branch[0]->address : ''?></p>
                    <!-- <p>Website: <a href="#">mobilemonk.co.nz</a></p> -->
                    <h4 class="mt-3">REPAIR FORM</h4>
                </div>

                <div class="row mt-1">
                  <div class="col-4 col-sm-4 col-md-4 col-lg-4 col-xl-4"><p><strong>Date:</strong> <?=date('d M Y h:i:s A')?></p></div>
                  <div class="col-4 col-sm-4 col-md-4 col-lg-4 col-xl-4"></div>
                  <div class="col-4 col-sm-4 col-md-4 col-lg-4 col-xl-4"><p><strong>Job ID:</strong> <?=!empty($jobs) ? $jobs[0]->id : ''?></p></div>
                </div>
                <hr>
                
                <h5><strong>Customer Details:</strong></h5>
                <div class="row mt-1">
                  <div class="col-6 col-sm-6 col-md-6 col-lg-6 col-xl-6"><p><strong>Name:</strong> <?=!empty($jobs) ? $jobs[0]->customer_name : ''?></p></div>
                  <div class="col-6 col-sm-6 col-md-6 col-lg-6 col-xl-6"><p><strong>Email Address:</strong> <?=!empty($jobs) ? $jobs[0]->email : ''?></p></div>
                  <div class="col-6 col-sm-6 col-md-6 col-lg-6 col-xl-6"><p><strong>Contact Number:</strong> <?=!empty($jobs) ? $jobs[0]->mobile : ''?></p></div>
                </div>
                <hr>

                <?php // print_r($brand)?>

                <h5><strong>Device Information:</strong></h5>
                <div class="row mt-1">
                  <div class="col-6 col-sm-6 col-md-6 col-lg-6 col-xl-6"><p><strong>Make & Model:</strong> <?=!empty($brand) ? $brand[0]->name : ''?> <?=!empty($model) ? $model[0]->name : ''?></p></div>
                  <div class="col-6 col-sm-6 col-md-6 col-lg-6 col-xl-6"><p><strong>Security Code:</strong> asdsaSdasd</p></div>
                  <div class="col-6 col-sm-6 col-md-6 col-lg-6 col-xl-6"><p><strong>IMEI or S/N:</strong> fdq3dq3wd</p></div>
                  <div class="col-6 col-sm-6 col-md-6 col-lg-6 col-xl-6"><p><strong>Fault Description:</strong> sasdasdas</p></div>
                  <div class="col-6 col-sm-6 col-md-6 col-lg-6 col-xl-6"><p><strong>Quoted Price:</strong> $11</p></div>
                  <div class="col-6 col-sm-6 col-md-6 col-lg-6 col-xl-6"><p><strong>Any Other Fault:</strong> (Please Describe)</p></div>
                </div>
                <hr>

                <h5><strong>Device Condition:(Please Circle)</strong></h5>
                <div class="row mt-1">
                  <div class="col-6 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                    <strong>Screen Working:</strong> Yes <input type="radio" name="Screen"> No <input type="radio" name="Screen">
                  </div>
                  <div class="col-6 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                    <strong>Back Glass Broken:</strong> Yes <input type="radio" name="Glass"> No <input type="radio" name="Glass">
                  </div>
                  <div class="col-6 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                    <strong>Cameras Working:</strong> Yes <input type="radio" name="Cameras"> No <input type="radio" name="Cameras">
                  </div>
                  <div class="col-6 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                    <strong>Speaker Working:</strong> Yes <input type="radio" name="Speaker"> No <input type="radio" name="Speaker">
                  </div>
                  <div class="col-6 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                    <strong>Charging Port Working:</strong> Yes <input type="radio" name="Charging">  No <input type="radio" name="Charging">  
                  </div>
                  <div class="col-6 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                    <strong>Water Damage:</strong> Yes <input type="radio" name="Water">  No <input type="radio" name="Water">
                  </div>
                </div>
                <hr>
    
                
                <div class="row border p-3 mt-4">
                    <div class="col-md-6">
                        <h5>Terms & Conditions:</h5>
                        <p>During the repair process, your device's data, applications, or personal information may be lost. A full backup is recommended.</p>
                        <p>Repair time estimates are provided at booking but may vary.</p>
                        <p>We take responsibility for any unexpected damage during repair.</p>
                        <p>Third-party parts may be used if originals are unavailable.</p>
                        <p>We cannot guarantee waterproof resistance after repair.</p>
                    </div>
                    <div class="col-md-6">
                        <h5>Service Warranty:</h5>
                        <p>3-month warranty on parts and labor for the original customer. Non-transferable.</p>
                        <p>Excludes physical/liquid damage, software enhancement effects, or manufacturer defects.</p>
                        <p>Warranty void if opened by another repair agent.</p>
                        <p>No refunds unless two repair attempts fail.</p>
                        <p>We comply with the Fair Trading Act & Consumer Guarantees Act.</p>
                    </div>
                </div>
            </div>
            
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
