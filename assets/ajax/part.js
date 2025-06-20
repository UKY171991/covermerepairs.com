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
  $('#add-part-btn').on('click', function() {
    reset();
    $('#modal-title').text('Add Part');
  });
  // Event delegation for dynamically generated buttons
  $(document).on('click', '.view-btn', function(e) {
    e.preventDefault();
    var id = $(this).data('id');
    view(id);
    return false;
  });
  
  $(document).on('click', '.edit-btn', function(e) {
    e.preventDefault();
    var id = $(this).data('id');
    edit(id);
    return false;
  });
  
  $(document).on('click', '.delete-btn', function(e) {
    e.preventDefault();
    var id = $(this).data('id');
    del(id);
    return false;
  });
  
  // Modal close event handler
  $('#edit_data').on('hidden.bs.modal', function () {
    reset();
  });
});

function all_data(){

  if ( $.fn.dataTable.isDataTable('#all_data') ) {
    $('#all_data').DataTable().destroy();
    // Remove any existing search rows to prevent duplicates
    $('#all_data thead tr.search-row').remove();
  }

  var base_url = $(".base_url").val();
  var dataTable = $('#all_data').DataTable({
    processing: true,
    serverSide: true,
    paging: true,
    pageLength: 10,
    lengthMenu: [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
    searching: true,
    ordering: true,
    info: true,
    autoWidth: false,
    responsive: true,
    stateSave: true,
    pagingType: "full_numbers",
    dom: 'lfrtip',
    language: {
      paginate: {
        first: "First",
        last: "Last",
        next: "Next",
        previous: "Previous"
      },
      info: "Showing _START_ to _END_ of _TOTAL_ entries",
      infoEmpty: "Showing 0 to 0 of 0 entries",
      infoFiltered: "(filtered from _MAX_ total entries)",
      lengthMenu: "Show _MENU_ entries",
      search: "Search:",
      processing: "Loading...",
      zeroRecords: "No matching records found",
      emptyTable: "No data available in table"
    },
    ajax: {
      url: base_url+'part/all_data_ajax',
      type: 'POST'
    },
    columns: [
      { data: 0, title: "#", searchable: false, orderable: false, width: "5%" },
      { data: 1, title: "Brand Name", searchable: true, orderable: true, width: "15%" },
      { data: 2, title: "Model Name", searchable: true, orderable: true, width: "15%" },
      { data: 3, title: "Part Type", searchable: true, orderable: true, width: "15%" },
      { data: 4, title: "Price", searchable: false, orderable: true, width: "12%" },
      { data: 5, title: "Qty.", searchable: false, orderable: true, width: "8%" },
      { data: 6, title: "Added by", searchable: true, orderable: true, width: "15%" },
      { data: 7, title: "Action", searchable: false, orderable: false, width: "15%" }
    ],
    initComplete: function () {
      // Only add search row if it doesn't already exist
      if ($('#all_data thead tr.search-row').length === 0) {
        var api = this.api();
        
        // Clone the header row and add search inputs
        $('#all_data thead tr').clone(true).addClass('search-row').appendTo('#all_data thead');
        $('#all_data thead tr:eq(1) th').each(function (i) {
          var title = $(this).text();
          
          // Skip search for #, Price, Qty, and Action columns
          if (i === 0 || i === 4 || i === 5 || i === 7) {
            $(this).html('');
            return;
          }
          
          $(this).html('<input type="text" class="form-control form-control-sm" placeholder="Search ' + title + '" />');
          
          $('input', this).on('keyup change clear', function () {
            if (api.column(i).search() !== this.value) {
              api.column(i).search(this.value).draw();
            }
          });
        });
      }
    }
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
  
  // Use Toastr for confirmation
  toastr.warning(
    '<div>Are you sure you want to delete this part?<br/><br/>' +
    '<button type="button" class="btn btn-success btn-sm" id="confirm-delete">Yes, Delete</button> ' +
    '<button type="button" class="btn btn-secondary btn-sm" id="cancel-delete">Cancel</button></div>',
    'Confirm Delete',
    {
      allowHtml: true,
      closeButton: false,
      timeOut: 0,
      extendedTimeOut: 0,
      tapToDismiss: false,
      onShown: function() {
        $('#confirm-delete').on('click', function() {
          toastr.clear();
          
          $.ajax({
            url: base_url + 'part/delete',
            type: 'post',
            data: {'id': id},
            dataType: 'json',
            success: function(res) {
              all_data();
              if(res.status === 'success') {
                toastr.success(res.message);
              } else {
                toastr.error(res.message || 'Failed to delete part.');
              }
            },
            error: function() {
              toastr.error('Server error occurred while deleting.');
            }
          });
        });
        
        $('#cancel-delete').on('click', function() {
          toastr.clear();
        });
      }
    }
  );
}

function edit(id){
  var base_url = $(".base_url").val();
  $('#modal-title').text('Edit Part');
  
  $.ajax({
    url: base_url + 'part/edit',
    type: 'post',
    data: {'id': id},
    dataType: 'json',
    success: function(res){
      try {
        if (res && res.length > 0) {
          var obj = res[0];
          $('.id').val(obj.id);
          $('.price_max').val(obj.price_max);
          $('.price_min').val(obj.price_min);
          $('.stock').val(obj.stock);
          $(".branch").val(obj.branch);
          $(".brand").val(obj.brand);
          load_model();
          // Set model after loading models
          setTimeout(function() {
            $(".model").val(obj.model);
          }, 500);          $(".type").val(obj.type);
          
          // Re-enable all form inputs for edit mode
          $('#submit_data input, #submit_data select').prop('disabled', false);
          $('#submit_data button[type="submit"]').show();
          
          // Show modal
          $('#edit_data').modal('show');
        } else {
          toastr.error('Part data not found.');
        }
      } catch (e) {
        console.error('Error parsing part data:', e);
        toastr.error('Error loading part data.');
      }
    },
    error: function() {
      toastr.error('Error loading part data.');
    }
  }); 
}

function view(id){
  var base_url = $(".base_url").val();
  $('#modal-title').text('View Part');
  
  $.ajax({
    url: base_url + 'part/edit',
    type: 'post',
    data: {'id': id},
    dataType: 'json',
    success: function(res){
      try {
        if (res && res.length > 0) {
          var obj = res[0];
          $('.id').val(obj.id);
          $('.price_max').val(obj.price_max);
          $('.price_min').val(obj.price_min);
          $('.stock').val(obj.stock);
          $(".branch").val(obj.branch);
          $(".brand").val(obj.brand);
          load_model();
          // Set model after loading models
          setTimeout(function() {
            $(".model").val(obj.model);
          }, 500);
          $(".type").val(obj.type);
          
          // Disable all form inputs for view mode
          $('#submit_data input, #submit_data select').prop('disabled', true);
          $('#submit_data button[type="submit"]').hide();
          
          // Show modal
          $('#edit_data').modal('show');
        } else {
          toastr.error('Part data not found.');
        }
      } catch (e) {
        console.error('Error parsing part data:', e);
        toastr.error('Error loading part data.');
      }
    },
    error: function() {
      toastr.error('Error loading part data.');
    }
  }); 
}

$('.brand').on('change',function(){
  var base_url = $(".base_url").val();
  var id = $(this).val();
  
  if (id) {
    $.ajax({
      url: base_url + 'part/single_model',
      type: 'post',
      data: {'bid': id},
      success: function(res){
        $('.model').html(res);
      },
      error: function() {
        toastr.error('Error loading model data.');
      }
    });
  } else {
    $('.model').html('<option value="">Select Model</option>');
  }
});

function load_model(){
  var base_url = $(".base_url").val();
  var bid = $('.brand').val();
  var id = $('.id').val();
  
  if (bid) {
    $.ajax({
      url: base_url + 'part/single_model',
      type: 'post',
      data: {'bid': bid, 'id': id},
      success: function(res){
        $('.model').html(res);
      },
      error: function() {
        toastr.error('Error loading model data.');
      }
    });
  }
}

function reset(){
  $("#submit_data")[0].reset();
  $('.id').val('');
  
  // Re-enable form inputs and show submit button
  $('#submit_data input, #submit_data select').prop('disabled', false);
  $('#submit_data button[type="submit"]').show();
}
