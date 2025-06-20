$(document).ready(function() {
  // Configure Toastr
  toastr.options = {
    closeButton: true,
    progressBar: true,
    positionClass: 'toast-top-right',
    timeOut: 5000
  };
  
  all_data();

  // Add button event handler - reset form and set modal title
  $('#add-model-btn').on('click', function() {
    reset();
    $('#modal-title').text('Add Model');
  });
});

  function all_data(){

    if ( $.fn.dataTable.isDataTable('#all_data') ) {
      $('#all_data').DataTable().destroy();
    }

	var base_url = $(".base_url").val();
       var dataTable = $('#all_data').DataTable({
         
          processing: true,
          serverSide: true,
            ajax: {
                url: base_url+'part/all_model_ajax', // URL to your PHP script for fetching data
                type: 'POST'
            },
            columns: [
                { data: 0 },
                { data: 1 },
                { data: 2 },
                { data: 3 },
                { data: 4 }
            ]
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
      dataType: 'json',
      success:function(res){
        if(res.status === 'success'){
          all_data();
          toastr.success(res.message);
          $("#submit_data")[0].reset();
          $(".id").val('');
          $('#edit_data').modal('hide');
        } else {
          toastr.error(res.message || 'An error occurred.');
        }
        $btn.prop('disabled', false);
      },
      error: function() {
        toastr.error('Server error occurred. Please try again.');
        $btn.prop('disabled', false);
      }
    });
});
    

function del(id){
  var base_url = $(".base_url").val();
  var conf = confirm('Are you sure you want to delete this model?');
  if(conf){
    $.ajax({
      url:base_url+'part/delete_model',
      type:'post',
      data:{'id':id},
      dataType: 'json',
      success:function(res){
        all_data();
        if(res.status === 'success') {
          toastr.success(res.message);
        } else {
          toastr.error(res.message || 'Failed to delete model.');
        }
      },
      error: function() {
        toastr.error('Server error occurred while deleting.');
      }
    });
  }
} 


function edit(id){
  var base_url = $(".base_url").val();
  $('#modal-title').text('Edit Model');
  $.ajax({
    url:base_url+'part/edit_model',
    type:'post',
    data:{'id':id},
    dataType: 'json',
    success:function(res){
      if(res && res.length > 0) {
        $('.id').val(res[0]['id']);
        $('.name').val(res[0]['name']);
        $(".brand_id option[value="+res[0]['brand_id']+"]").prop("selected", "selected");
      } else {
        toastr.error('Failed to load model data.');
      }
    },
    error: function() {
      toastr.error('Server error occurred while loading model data.');
    }
  }); 
}

function reset(){
  $("#submit_data")[0].reset();
  $('.id').val('');
  $(".brand_id").val('').trigger('change'); // For Select2 if used
}
