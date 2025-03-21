<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?= base_url();?>assets/plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">

  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="<?= base_url();?>assets/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="<?= base_url();?>assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="<?= base_url();?>assets/plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= base_url();?>assets/dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="<?= base_url();?>assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="<?= base_url();?>assets/plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="<?= base_url();?>assets/plugins/summernote/summernote-bs4.min.css">

  <style type="text/css">
      body, html {
            min-height: 100%;
            font-family: auto;
        }
        hr {
            margin-top: 0.4rem;
            margin-bottom: 0.4rem;
            border: 0;
            border-top: 1px solid rgba(0,0,0,.1);
        }
        .h5, h5 {
            font-size: 1.25rem;
            text-decoration: underline;
        }
        .border {
            border: 1px solid #1f2d3d!important;
            padding: 5px;
        }
        h6{
            text-align: justify;
            font-family: serif;
            word-break: break-word;
        }
  </style>

    <title>Print details</title>
  </head>
  <body>
    <div class="container">
        <div class="row d-flex justify-content-center">
            <div class="col-md-6">
                <div class="text-center card">
                    <!-- <h3>MOBILE MONK RICCARTON</h3>  -->
                    <h3><?php if($all[0]->added_by != '0'){ echo $aded[0]->name; } ?></h3> 
                   <p><?php if($all[0]->added_by != '0'){ echo $aded[0]->address; } ?>
                   <br><?php if($all[0]->added_by){ echo $aded[0]->phone; } ?>
                   <br>Email- <?php if($all[0]->added_by){ echo $aded[0]->email; } ?>
                   <br> <?php if($aded[0]->web_address !=''){ echo "Website- ". $aded[0]->web_address; } ?></p>    
                </div>
                        
            </div>
        </div>
        <div class="text-center">
           <h3><b>REPAIR FORM<b></h3>     
        </div>

    <div class="row">
        <div class="col-md-6"><h6>Date: <?=date('d M Y h:i:s a')?></h6></div>
        <div class="col-md-6"><h6 style="text-align: center;">Job id : <?=$all[0]->id?></h6></div>
    </div>

    <div class="row">
        <div class="col-md-12"><h5><b>Customer Details: - </b></h5></div>
    </div>

    <div class="row">
        <div class="col-md-4">
            <h6>Name:<?=$all[0]->title?></h6>
        </div>
        <div class="col-md-4">
            <h6>Email Address: <?=$all[0]->email?></h6>
        </div>
        <div class="col-md-4">
            <h6>Contact Number : <?=$all[0]->phone?></h6>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-md-6">
            <h5><b>Device Information: -</b></h5>
            <h6>Make & Model:<?=$all[0]->model?></h6>
            <h6>Security Code:<?=$all[0]->pin_pattern?></h6>
            <h6>IMEI or S/N:<?=$all[0]->imei?></h6>
            <h6>Fault Description:<?=$all[0]->issue?></h6>
            <h6>Quoted Price: $<?=$all[0]->quiotation?> </h6>
            <h6>Any Other Fault (Please Describe): <?=$all[0]->issue_fund?></h6>
        </div>
        <div class="col-md-6">
            <h5><b>Device Condition:-(Please Circle)</b></h5>
            <h6>Screen Working &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : Yes <input type="radio" name="screen"> &nbsp; No <input type="radio" name="screen"></h6>
            <h6>Back Glass broken &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; :  Yes <input type="radio" name="Back"> &nbsp; No <input type="radio" name="Back"></h6>
            <h6>Cameras Working &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; :  Yes <input type="radio" name="Cameras"> &nbsp; No <input type="radio" name="Cameras"></h6>
            <h6>Speaker Working  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : Yes <input type="radio" name="Speaker"> &nbsp; No <input type="radio" name="Speaker"></h6>
            <h6>Charging Port Working : Yes <input type="radio" name="Charging"> &nbsp; No <input type="radio" name="Charging"></h6>
            <h6>Water Damage &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : Yes <input type="radio" name="Water"> &nbsp; No <input type="radio" name="Water"></h6>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-md-6 border">
            <h5 class="text-center"><b>Terms & Conditions:</b></h5>
            <h6>
            Please be aware that during the repair process there is a chance that your device’s data, applications, or some other personal information may be lost. <b>A full backup is always recommended</b>. No persons associated with the repair is responsible for the data loss or personal information.
            <br><br>

            Please note that we provide an estimated time required for repair at the time of booking. Sometimes the repair could be a bit more complicated than it appears at the booking point, thus it could take more time than estimated, please be prepared for that.
            <br><br>

            If some unexpected damage happens to your phone while repairing, we will take responsibility for that and will fix it without any sort of charge but we will need up to <b>14 days</b> to solve the issue.
            <br><br>

            Please be aware that as <b>third-party repair agents</b> we may use third party parts when original parts are unavailable and some repairs may void your manufactures warranty, please check with your devices manufacture if you have any doubts as we will not be held responsible for any loss of warranty.
            <br><br>

            We cannot provide any guarantee that waterproof/resistant devices will remain waterproof/resistant after any repair performed by us.
        </h6>
        </div>
        <div class="col-md-6 border">
            <h5 class="text-center"><b>Service Warranty:</b></h5>
            <h6>
                <b>We offer 3 months warranty on all parts and labor associated with the preceding repair</b>, the warranty is made exclusively for the benefit of the original customer of the preceding repair and, as such, is non- transferable. This warranty covers manufacturer-related part defects on parts installed by us as well as the workmanship associated with the preceding repair only and does not cover supplemental damage. Supplemental damage can be defined as any damage unrelated to the preceding repair, including, but not limited to, physical or liquid damage to the device. Manufacture-related defect symptoms may include one or more of the following: a spontaneous or abrupt decline in overall device functionality, touchscreen sensitivity or LCD performance. <b>Exclusions to this warranty include, but are not limited to, physical and/or liquid damage, game system reflows, batteries, accessories, and soldered components. Liquid damage and subsequent physical damage which occurs after a completed repair will void this warranty</b>.
                <br><br>
                Additionally, this warranty is automatically voided in the event of a manufacturer software enhancement that adversely affects the functionality of the phone. <b>This warranty is also void if the unit has been opened or repaired by another repair agency after the initial repair</b>. We do not provide refunds for repaired jobs unless two attempts have been carried out to repair the fault. We will meet our obligations under the Fair-Trading Act & Consumer Guarantees Act to provide a solution or provide a full or partial refund for the cost of the repair. 
                <br><br>
                <b>Once our technicians open the device and if they find it exposed to liquid, we are not responsible for any damage afterward.  Liquid damage phone cannot be covered under our 3 months warranty policy</b>.
            </h6>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-md-12">
            <h5><b>By signing this below you accept all terms & conditions stated above and agree that: -</b></h5>
        </div>
        <div class="col-md-12">
            <h6>If you cannot be contacted after 50 days of assessment provided that all efforts have been made to contact you or no reply has been received within 50 days after initial quotation then <b><?php if($all[0]->added_by != '0'){ echo $aded[0]->name; } ?></b> will reserve the right to dispose or keep the device in lieu of payment.</h6>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-md-12">
            <h5><b>I confirm that my device is functioning correctly upon collection</b></h5>
        </div>
        <div class="col-md-6">
            <h6><b>Signature:</b></h6>
        </div>
        <div class="col-md-6">
            <h6><b>Date::</b></h6>
        </div>
    </div>
    <div class="border">
    <div class="row">
        <div class="col-md-12">
            <h5><b>Customer Slip</b></h5>
        </div>
    </div>
    <div class="row ">
        <div class="col-md-4">
            <h6>Name: <?=$all[0]->title?></h6>
            <h6>Make & Model: <?=$all[0]->model?></h6>
            <h6>Technician Name: <?php if($all[0]->assign_user){ echo $user[0]->name; } ?></h6>
        </div>
        <div class="col-md-4">
            <h6>Job Id: <?=$all[0]->id?></h6>
            <h6>IMEI or S/N: <?=$all[0]->imei?></h6>
            <h6>Technician Signature:</h6>
        </div>
        <div class="col-md-4">
            <h6>Quoted Price: $<?=$all[0]->quiotation?></h6>
        </div>
    </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-md-12">
            <h6><?php if($aded[0]->address != ''){ echo "Contact Us: - ". $aded[0]->address; } ?></h6>
        </div>
    </div>

</div>
  </body>
  <div class="text-center">
    <button class="btn btn-info" onclick="window.print()">Print</button>
</div>
</html>