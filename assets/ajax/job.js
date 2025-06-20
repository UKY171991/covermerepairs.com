$(document).ready(function() { 
  all_data();
 });


// show all list
  function all_data(){

    if ( $.fn.dataTable.isDataTable('#all_data') ) {
      $('#all_data').DataTable().destroy();
    }

	var base_url = $(".base_url").val();
      var status_list = $('.status_list').val();
        $('#all_data').DataTable({
          "bSortCellsTop": true,
          "processing": true, //Feature control the processing indicator.
            ajax: {
                data:{'status':status_list},
                url: base_url+'job/all_data_ajax', // URL to your PHP script for fetching data
                type: 'POST'
            },
            columns: [
                { data: 0 },
                { data: 1 },
                { data: 2 },
                { data: 3 },
                { data: 4 },
                { data: 5 },
                { data: 6 },
                { data: 7 },
                { data: 8 },
                { data: 9 }, 
                // Add more columns as needed
            ]
        });
    }


// Submit  job
$("#submit_data").on('submit',function(e){
  e.preventDefault();
  var $btn = $(this).find('button[type=submit]');
  $btn.prop('disabled', true);
  var action = $(this).attr('action');
  var data = $(this).serialize();

  $.ajax({
      url:action,
      type:'post',
      data:data,
      success:function(res){
        all_data();
        var msg = res;
        if (typeof res === 'string') {
          try {
            var parsed = JSON.parse(res);
            if (parsed && parsed.message) {
              msg = parsed.message;
            }
          } catch (e) {}
        } else if (typeof res === 'object' && res.message) {
          msg = res.message;
        }
        toastr.success(msg || 'Job updated successfully.');
        $('#edit_data').modal('hide');
        $("#submit_data")[0].reset();
        $(".id").val('');
        $btn.prop('disabled', false);
      },
      error: function() {
        toastr.error('An error occurred. Please try again.');
        $btn.prop('disabled', false);
      }
    });
});
    

//  Delete job
function del(id){
  var base_url = $(".base_url").val();
  var conf = confirm('Arey sure  you want to  delete ?');
  if(conf){
    $.ajax({
      url:base_url+'job/delete',
      type:'post',
      data:{'id':id},
      success:function(res){
        all_data();
        var msg = res;
        if (typeof res === 'string') {
          try {
            var parsed = JSON.parse(res);
            if (parsed && parsed.message) {
              msg = parsed.message;
            }
          } catch (e) {}
        } else if (typeof res === 'object' && res.message) {
          msg = res.message;
        }
        toastr.success(msg || 'Job deleted successfully.');
      }
    });
  }
  
} 

// Edit job
function edit(id){
  var base_url = $(".base_url").val();
    $.ajax({
      url:base_url+'job/edit',
      type:'post',
      data:{'id':id},
      success: function(data){
          var obj = JSON.parse(data);
          if (obj && obj[0]) {
            $('.id').val(obj[0]['id']);
            $('.branch').val(obj[0]['branch']).change();
            $('.customer_name').val(obj[0]['customer_name']);
            $('.mobile').val(obj[0]['mobile']);
            $('.email').val(obj[0]['email']);
            $('.brand').val(obj[0]['brand']).change();
            setTimeout(function() {
                $('.model_no').val(obj[0]['model_no']).change();
            }, 500);
            $('.assigned_to').val(obj[0]['assigned_to']).change();
            $('.date_from').val(obj[0]['date_from']);
            $('.date_to').val(obj[0]['date_to']);
            $('.issue').val(obj[0].hasOwnProperty('issue') ? obj[0]['issue'] : '');
            $('.fault_frequency').val(obj[0].hasOwnProperty('fault_frequency') ? obj[0]['fault_frequency'] : '');
            $('.specified_faults').val(obj[0].hasOwnProperty('specified_faults') ? obj[0]['specified_faults'] : '');
            $('.description').val(obj[0].hasOwnProperty('description') ? obj[0]['description'] : '');
            if(obj[0].hasOwnProperty('inspection_fee_paid') && (obj[0]['inspection_fee_paid'] == '1' || obj[0]['inspection_fee_paid'] == 1)){
              $('.inspection_fee_paid').prop('checked', true);
            } else {
              $('.inspection_fee_paid').prop('checked', false);
            }
            $('.loan_device_details').val(obj[0].hasOwnProperty('loan_device_details') ? obj[0]['loan_device_details'] : '');
            $('.imei_no').val(obj[0].hasOwnProperty('imei_no') ? obj[0]['imei_no'] : '');
            $('.exceeds').val(obj[0].hasOwnProperty('exceeds') ? obj[0]['exceeds'] : '');
            $('.security_code').val(obj[0].hasOwnProperty('security_code') ? obj[0]['security_code'] : '');
          } else {
            console.error("Received empty or invalid data for job edit:", obj);
          }
        },
      error: function(jqXHR, textStatus, errorThrown) {
        console.error("AJAX error in edit function:", textStatus, errorThrown);
        toastr.error('An error occurred while fetching job details.');
      }
    }); 
}

// change  brand  and  show  list of  model
$('.brand').on('change',function(){
  var base_url = $(".base_url").val();
  var id = $(this).val();
    $.ajax({
      url:base_url+'job/single_model',
      type:'post',
      data:{'bid':id},
      success:function(res){
        $('.model_no').html(res);
      }
    }); 
});

// load model
function load_model(){
  var base_url = $(".base_url").val();
  var bid = $('.brand').val();
  var id = $('.id').val();
  console.log(bid);
    $.ajax({
      url:base_url+'job/single_model',
      type:'post',
      data:{'bid':bid,'id':id},
      success:function(res){
        $('.model_no').html(res);
      }
    }); 
}

function reset(){
  $("#submit_data")[0].reset();
}



///  found  issue  add

$("#submit_issue").on('submit',function(e){
  e.preventDefault();
  var action = $(this).attr('action');
  var data = $(this).serialize();
  var job= $('.job_id').val();
  $.ajax({
      url:action,
      type:'post',
      data:data,
      success:function(res){
        // Only show a toast, do not try to parse as JSON
        toastr.success(typeof res === 'string' ? res : 'Issue added successfully.');
        $("#submit_issue")[0].reset();
        // Clear only the textarea, not the .issue_list div
        $("#submit_issue textarea[name='issue_list']").val('');
        found_issue(job);
      }
  });
});

// Found issue model
function found_issue(id){
  $('.job_id').val(id);
  // Only update the .issue_list div, not the textarea
  var base_url = $(".base_url").val();
    $.ajax({
      url:base_url+'job/found_issie',
      type:'post',
      data:{'job':id},
      success:function(res){
        // Set HTML only in the div, not in any textarea
        $(".issue_list").html(res);
        // Always clear the textarea when opening or updating
        $("#submit_issue textarea[name='issue_list']").val('');
      }
    }); 
}

// When opening the modal, always clear the textarea
$('#found_issue').on('show.bs.modal', function () {
  $("#submit_issue textarea[name='issue_list']").val('');
});

///  Assign  add

$("#assign_data").on('submit',function(e){
  e.preventDefault();
  var action = $(this).attr('action');
  var data = $(this).serialize();

  var job= $('.job_id').val();

  $.ajax({
      url:action,
      type:'post',
      data:data,
      success:function(res){
        toastr.success(res);
        $("#assign_data")[0].reset();
        all_data();  
      }
    });
});

// Assign
function assign(id) {
  $('.assign').val(id);
  // Find the current engineer from the table row and select it
  var row = $("button[data-target='#assign'][data-id='"+id+"']").closest('tr');
  var techName = row.find('td').eq(7).text().trim();
  var found = false;
  $('.assigned_to option').each(function() {
    if ($(this).text().trim() === techName) {
      $('.assigned_to').val($(this).val()).change();
      found = true;
      return false;
    }
  });
  if (!found) {
    $('.assigned_to').val('').change();
  }
}


///  Status  update

$("#status_data").on('submit',function(e){
  e.preventDefault();
  var action = $(this).attr('action');
  var data = $(this).serialize();

  $.ajax({
      url:action,
      type:'post',
      data:data,
      success:function(res){
        toastr.success(res);
        $("#status_data")[0].reset();
        all_data();  
      }
    });
});

// Status
function status(id){
  $('.job_id').val(id);
  // Find the current status from the table row and select it
  var row = $("button[data-target='#status'][onclick*='status("+id+")']").closest('tr');
  var currentStatus = row.find('td').eq(8).text().trim();
  // Try to match the dropdown value
  var found = false;
  $(".status_select option").each(function() {
    if ($(this).text().trim() === currentStatus) {
      $(".status_select").val($(this).val()).change();
      found = true;
      return false;
    }
  });
  if (!found) {
    $(".status_select").val('').change();
  }
}


///  couriereStatus  update

$("#couriere").on('submit',function(e){
  e.preventDefault();
  var action = $(this).attr('action');
  var data = $(this).serialize();
  var job= $('.job_id').val();
  $.ajax({
      url:action,
      type:'post',
      data:data,
      success:function(res){
        toastr.success(res);
        $("#couriere")[0].reset();
        found_couriereStatus(job); 
      }
    });
});

// couriereStatus
function couriere(id){
  $('.job_id').val(id);
  found_couriereStatus(id);
}

// Found issue model
function found_couriereStatus(id){
  $('.job_id').val(id);
  $('.couriereStatus_list').html('');
  var base_url = $(".base_url").val();
    $.ajax({
      url:base_url+'job/found_couriereStatus',
      type:'post',
      data:{'job':id},
      success:function(res){
        $('.couriereStatus_list').html(res);
      }
    }); 
}

function autoRemoveToasts() {
  setTimeout(function() {
    $(".toasts .toast").fadeOut(500, function() { $(this).remove(); });
  }, 5000);
}

// Patch all Toasts creation to auto-remove
$(document).on('DOMNodeInserted', '.toasts .toast', function() {
  autoRemoveToasts();
});

// Toastr config for job page (match branch page)
toastr.options = {
  closeButton: true,
  progressBar: true,
  positionClass: 'toast-top-right',
  timeOut: 5000
};