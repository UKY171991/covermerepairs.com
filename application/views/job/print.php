<?php
$branch_name = isset($branch[0]->name) ? $branch[0]->name : 'N/A';
if (isset($all_branches) && isset($jobs[0]->branch)) {
    foreach ($all_branches as $b) {

        if ($b->id == $jobs[0]->branch) {
            $branch_name = $b->name;
            $branch_address = $b->address;
            $branch_phone = $b->phone;
            $branch_email = $b->email;
            break;
        }
    }
}



?>

<!-- Content Wrapper. Contains page content -->

<style>
  body, .content-wrapper { background: #fff !important; }
  .pdf-header-table { width: 100%; border-collapse: collapse; margin-bottom: 0; }
  .pdf-header-table td { vertical-align: middle; }
  .logo-cell { width: 100px; }
  .center-cell { width: 60%; text-align: center; font-size: 18px; font-weight: bold; color: #222; }
  .right-cell { width: 120px; text-align: right; font-size: 13px; }
  .form-title { text-align: center; font-size: 22px; font-weight: bold; margin: 10px 0; color: #222; }
  .meta-table, .info-table, .fault-table, .signature-table { width: 100%; border-collapse: collapse; margin-bottom: 10px; }
  .meta-table td, .info-table td, .fault-table td, .signature-table td { border: 1px solid #000; padding: 4px; font-size: 18px; }
  .meta-table th, .info-table th, .fault-table th { border: 1px solid #000; padding: 4px; font-size: 18px; background: #f5f5f5; }
  .section-title { font-weight: bold; margin-top: 18px; font-size: 18px; color: #222; }
  .small-text { font-size: 12px; }
  .signature-table td { border: none; font-size: 13px; }
  .no-border { border: none !important; }
  .bullet-list { margin: 0 0 0 18px; padding: 0; }
  .bullet-list li { margin-bottom: 4px; }
  .static-box { border: 1px solid #000; padding: 8px; margin-bottom: 10px; }
  .signature-line { border-bottom: 1px solid #000; width: 260px; display: inline-block; margin-bottom: 2px; }
  .checkbox { display:inline-block;width:16px;height:16px;border:1px solid #000;vertical-align:middle;margin-right:4px; }
  @media print {
    .no-print { display: none !important; }
  }
</style>

<div class="content-wrapper" style="background:#fff;">
  <section class="content">
    <div class="container-fluid">
      <div class="no-print" style="text-align:right; margin: 20px 0 10px 0;">
        <button onclick="window.print()" class="btn btn-primary btn-sm"><i class="fa fa-print"></i> Print</button>
                </div>
      <table class="pdf-header-table" style="margin-top:20px;">
        <tr>
          <td class="logo-cell">
            <img src="<?= base_url('assets/dist/img/mobile_logo.jpg') ?>" style="height:70px;">
          </td>
          <td class="center-cell">
            <div style="font-size:18px;font-weight:bold;">
              <?= $branch[0]->name ?? $branch_name ?>
            </div>
            <?= $branch[0]->address ?? $branch_address ?><br>
            Ph: <?= $branch[0]->phone ?? $branch_phone ?><br>
            <a href="mailto:<?= $branch[0]->email ?? $branch_email ?>"><?= $branch[0]->email ?? $branch_email ?></a>
            <div class="form-title" style="margin-top:10px;">SERVICE REQUEST FORM</div>
          </td>
          <td class="right-cell" style="text-align:right;">
            <?php
              $job_id = isset($jobs[0]->id) ? $jobs[0]->id : '';
              $qr_url = base_url('job/print/' . $job_id);
              $qr_code_src = 'https://api.qrserver.com/v1/create-qr-code/?size=90x90&data=' . urlencode($qr_url);
            ?>
            <div style="margin-bottom:8px;">
              <img src="<?= $qr_code_src ?>" alt="QR Code" style="height:90px;width:90px;">
                </div>
          </td>
        </tr>
      </table>
      <!-- <div class="form-title" style="margin-top:10px;">SERVICE REQUEST FORM</div> -->
      
      <table class="info-table">
        <tr>
          <td>Branch Name: <?= $branch_name ?></td>
          <td>Customer Name: <?= $jobs[0]->customer_name ?? '' ?></td>
          <td>Contact(H/M/W): <?= $jobs[0]->mobile ?? '' ?></td>
        </tr>
        <tr>
          <td>Make: <?= $brand[0]->name ?? '' ?></td>
          <td>Model: <?= $model[0]->name ?? '' ?></td>
          <td>IMEI/ESN: <?= $jobs[0]->imei ?? '' ?></td>
        </tr>
        <tr>
          <td>Security Code: <?= $jobs[0]->security_code ?? '' ?></td>
          <td>Order ID/Auction: <?= $jobs[0]->order_id ?? '' ?></td>
          <td>Notify Exceeds: $<?= $jobs[0]->notify_exceeds ?? '500' ?></td>
        </tr>
        <tr>
          <td>Date: <?= date('d/m/Y') ?></td>
          <td>Address: <?= $jobs[0]->address ?? '' ?></td>
          <td>Claim No: <?= $jobs[0]->claim_no ?? '' ?></td>
          <td>Insurance: <?= $jobs[0]->insurance ?? '' ?></td>
        </tr>
        <tr>
          <td>Accessories Include: <?= $jobs[0]->accessories ?? '' ?></td>
          <td>Job Number: <?= $jobs[0]->id ?? '' ?></td>
          <td>Email: <?= $jobs[0]->email ?? '' ?></td>
        </tr>
        <tr>
          <td>Estimated Working Days: <?= $jobs[0]->working_days ?? '' ?></td>
          <td>Remove Gmail ID? <?= $jobs[0]->remove_gmail ?? 'Yes' ?></td>
        </tr>
      </table>
      <div class="static-box">
        <div style="font-weight:bold;">Issue</div>
        <?= $jobs[0]->issue ?? '' ?>
      </div>
      <table class="fault-table">
        <tr>
          <th>Fault Frequency:</th>
          <th>Specified Faults:</th>
        </tr>
        <tr>
          <td><?= $jobs[0]->fault_frequency ?? '' ?></td>
          <td><?= $jobs[0]->specified_faults ?? '' ?></td>
        </tr>
        <tr>
          <th colspan="2">Description:</th>
        </tr>
        <tr>
          <td colspan="2"><?= $jobs[0]->description ?? '' ?></td>
        </tr>
      </table>
      <div class="static-box">
        <div style="font-weight:bold;">Cover Me Terms and Conditions</div>
        Please be aware that your device data, applications and other personal information may be irretrievably lost during the service repair process, a backup is recommended before repair. None of the parties associated with the repair process, including Cover Me, the service repair agent or the store shall be responsible for the loss of any data or personal information you may experience.
                </div>
      <div class="static-box">
        <div style="font-weight:bold;">Service Warranty</div>
        <ul class="bullet-list">
          <li>Our service warranty only applies when the manufacturer's replacement part fails, within 1 year from the date of repair.</li>
          <li>Equipment found to be liquid or physically damaged, at discretion of the repairer, may be excluded from warranty.</li>
          <li>The warranty does not cover failure or defects caused by misuse, accidents, physical damage, improper handling or storage, modification, neglect, alteration, removal/repair of parts, exposure of fire, water, food, liquid and failure to follow instructions of proper device usage.</li>
          <li>We do not have to provide refund for repaired jobs done unless three attempts have been carried out to repair the specific faults; we will meet our obligation under the Fair Trading Act and Consumer Guarantees Act to provide a remedy or provide refund for the cost of repair. Please note that the inspection fee is not refundable under any circumstances once it has been conducted.</li>
          <li>If the product is inspected by any third party repairer, the warranty would be voided.</li>
        </ul>
                </div>
      <div class="static-box">
        <div style="font-weight:bold;">Warranty Claim</div>
        This only applies to devices repaired by Cover Me which are experiencing the same fault or faults within 1 year after the first repair. A valid proof of purchase or repair from the customer is required.
                  </div>
      <div class="static-box">
        <div style="font-weight:bold;">Inspection Fee</div>
        $50 inc GST inspection fee will be deducted from final repair cost. <span class="checkbox"></span> Inspection Paid
                  </div>
      <div class="static-box">
        <div style="font-weight:bold;">Loan Device</div>
        The customer must return the loan device in good condition after the repair. Failing to comply will forfeit the deposit fee.<br>
        [Make: ] [Model: ] [IMEI: ] [Deposit Taken: ] [Accessories: <span class="checkbox"></span> Battery <span class="checkbox"></span> Charger / Other :]
                  </div>
      <div class="static-box">
        <div style="font-weight:bold;">Cover Me Device Drop Off/ Pickup Conditions</div>
        <ul class="bullet-list">
          <li>Unfortunately we are unable to monitor the status of your device once it has left our premises. Cover Me cannot be held responsible for any physical/liquid/impact ext damage occurred after releasing the device.</li>
          <li>Please check carefully for any mark, scratches, dents or variation to the device before you sign below. This also applies to anyone who drops-off or pickups the device on behalf of the owner.</li>
        </ul>
        Any crack on Screen? Any damage on Screen? Any dents on Screen? Any crack on Back Cover? Any damage on Back Cover? Any dents on Back Cover? Any crack on Frame? Any damage on Frame? Any dents on Frame? Any crack on Back Camera Lens? Any damage on Back Camera Lens? Any dents on Back Camera Lens? Face Recognition/Fingerprint Sensor Accessories/ Others: Working?
                  </div>
      <div class="static-box">
        <div style="font-weight:bold;">By signing this form you accept all terms and conditions above and agree that</div>
        <ul class="bullet-list">
          <li>if you cannot be contacted after 50 days of assessment, under the circumstances that all efforts have been done to contact you or</li>
          <li>no reply is received from you within 50 days after the initial quotation for repair or</li>
          <li>no claim is made to the device after 50 days from the date of service completion, the device is deemed unwanted and Cover Me will reserve the right to dispose or keep the device in lieu of payment.</li>
          <li>You are happy with the condition of the device and have checked yourself.</li>
        </ul>
      </div>
      <div class="static-box">
        <table class="signature-table" style="margin-top:30px; width:100%;">
          <tr>
            <td>
              <strong>Drop Off Signature</strong><br>
              Customer: <span class="signature-line"></span> Date: <span class="signature-line" style="width:120px;"></span><br>
              Staff Name: <span class="signature-line"></span> Date: <span class="signature-line" style="width:120px;"></span>
            </td>
            <td>
              <strong>Pickup Signature</strong><br>
              Customer: <span class="signature-line"></span> Date: <span class="signature-line" style="width:120px;"></span><br>
              Staff Name: <span class="signature-line"></span> Date: <span class="signature-line" style="width:120px;"></span>
            </td>
          </tr>
        </table>
      </div>
    </div>
  </section>
</div>
