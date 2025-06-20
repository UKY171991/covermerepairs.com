$(document).ready(function() {
  // Configure Toastr
  toastr.options = {
    closeButton: true,
    progressBar: true,
    positionClass: 'toast-top-right',
    timeOut: 5000
  };
  
  all_data();

  // Handle Add button click
  $('#add_btn').on('click', function() {
    reset_form();
    $('#edit_data').modal('show');
  });
});

$(document).ready(function() {
    // Initialize Select2
    $('.select2').select2();
});

// Function to reset the form
function reset_form() {
  $("#submit_data")[0].reset();
  $(".id").val('');
  $('input[type="checkbox"]').prop('checked', false);
  $('.select2').val(null).trigger('change');
}

 

  function all_data(){

    if ( $.fn.dataTable.isDataTable('#all_data') ) {
      $('#all_data').DataTable().destroy();
    }

  var base_url = $(".base_url").val();
    var dataTable = $('#all_data').DataTable({
        "bSortCellsTop": true,
        "processing": true, //Feature control the processing indicator.
        ajax: {
            url: base_url+'branch/all_data_ajax', // URL to your PHP script for fetching data
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
            { data: 9 }
        ],
    });

  }

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
        const obj = JSON.parse(res);
        if(obj['status'] =='success'){
          all_data();
          toastr.success(obj['message']);
          reset_form();
          $('#edit_data').modal('hide'); // Close the modal
        }else{
          toastr.error(obj['message']);
        }
        $btn.prop('disabled', false);
      },
      error: function() {
        toastr.error('An error occurred. Please try again.');
        $btn.prop('disabled', false);
      }
    });
});
    

function del(id){
  var base_url = $(".base_url").val();
  var conf = confirm('Are you sure you want to delete?');
  if(conf){
    $.ajax({
      url:base_url+'branch/delete',
      type:'post',
      data:{'id':id},
      success:function(res){
        all_data();
        toastr.success(res);
      },
      error: function() {
        toastr.error('An error occurred during deletion.');
      }
    });
  }
}


function edit(id){
  var base_url = $(".base_url").val();
  $('input').prop('checked', false);
  //$('.select2').val(null).trigger('change');
    $.ajax({
      url:base_url+'branch/edit',
      type:'post',
      data:{'id':id},
      success:function(res){
        const obj = JSON.parse(res);
        $('.id').val(obj[0]['id']);
        $('.name').val(obj[0]['name']);
        $('.email').val(obj[0]['email']);
        $('.phone').val(obj[0]['phone']);
        $('.username').val(obj[0]['username']);
        $(".type option[value="+obj[0]['type']+"]").prop("selected", "selected");
    
    $('.address').val(obj[0]['address']);
    $('.dob').val(obj[0]['dob']);
        $('.qualification').val(obj[0]['qualification']); 
        $('.location').val(obj[0]['location']);
        $('.standred').val(obj[0]['standred']);
    
    let text = obj[0]['permission'];
    const myArray = text.split("--");

    // Loop through the array using a for loop
    for (var i = 0; i < myArray.length; i++) {
      $('#'+myArray[i]).prop('checked', true);
    }
    
    
    let standred = obj[0]['standred'];
    const stand = standred.split("--");
    //var selectedValues = ['value1', 'value3'];

    // Iterate through the array and set the selected attribute
    $('.select2 option').each(function() {
      var optionValue = $(this).val();
      if ($.inArray(optionValue, stand) !== -1) {
      $(this).prop('selected', true);
      }
      $('.select2').select2(); 
    });
    
      }
    }); 
}


function view(id){
  var base_url = $(".base_url").val();
  //$('.branch').val(null).trigger('change');
    $.ajax({
      url:base_url+'branch/view',
      type:'post',
      data:{'id':id},
      success:function(res){
        $('.view_table').html(res);
      }
    });  
}