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
        alert(res);
        $("#submit_data")[0].reset();
        $(".id").val('');
        $btn.prop('disabled', false);
      },
      error: function() {
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
        alert(res);
        
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
            $('.branch').val(obj[0]['branch']);
            $('.customer_name').val(obj[0]['customer_name']);
            $('.mobile').val(obj[0]['mobile']);
            $('.email').val(obj[0]['email']);
            $('.brand').val(obj[0]['brand']);
            // Trigger change to load models if necessary, then set model_no
            $('.brand').trigger('change'); 
            setTimeout(function() { // Timeout to allow models to load
                $('.model_no').val(obj[0]['model_no']);
            }, 500); // Adjust timeout as needed
            $('.assigned_to').val(obj[0]['assigned_to']);
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
            // $('.status').val(obj[0]['status']); // Assuming status is handled elsewhere or not in this modal
          } else {
            console.error("Received empty or invalid data for job edit:", obj);
            // Optionally, display an error message to the user
          }
        },
      error: function(jqXHR, textStatus, errorThrown) {
        console.error("AJAX error in edit function:", textStatus, errorThrown);
        alert("An error occurred while fetching job details.");
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
        alert(res);
        $("#submit_issue")[0].reset();
        found_issue(job);
        
      }
    });
});

// Found issue model
function found_issue(id){
  $('.job_id').val(id);
  $('.issue_list').html('');
  var base_url = $(".base_url").val();
    $.ajax({
      url:base_url+'job/found_issie',
      type:'post',
      data:{'job':id},
      success:function(res){
        $('.issue_list').html(res);
      }
    }); 
}


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
        alert(res);
        $("#assign_data")[0].reset();
        all_data();  
      }
    });
});

// Assign
function assign(id){
  $('.assign').val(id);
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
        alert(res);
        $("#status_data")[0].reset();
        all_data();  
      }
    });
});

// Status
function status(id){
  $('.job_id').val(id);
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
        alert(res);
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