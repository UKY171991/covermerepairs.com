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
      success:function(res){
        const obj = JSON.parse(res);
        console.log(obj);
        $('.id').val(obj[0]['id']);
        $('.email').val(obj[0]['email']);
        $('.mobile').val(obj[0]['mobile']);
        $('.customer_name').val(obj[0]['customer_name']);
        $('.issue').val(obj[0]['issue']);
        $('.date_from').val(obj[0]['date_from']);
        $('.date_to').val(obj[0]['date_to']);
        $(".branch option[value="+obj[0]['branch']+"]").prop("selected", "selected");
        $(".brand option[value="+obj[0]['brand']+"]").prop("selected", "selected");
        $(".assigned_to option[value="+obj[0]['assigned_to']+"]").prop("selected", "selected");
        load_model();
        $(".model_no option[value="+obj[0]['model']+"]").prop("selected", "selected");
       // $(".type option[value="+obj[0]['type']+"]").prop("selected", "selected");
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