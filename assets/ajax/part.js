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
      { data: 4, title: "Min Price", searchable: false, orderable: true, width: "10%" },
      { data: 5, title: "Max Price", searchable: false, orderable: true, width: "10%" },
      { data: 6, title: "Stock", searchable: false, orderable: true, width: "8%" },
      { data: 7, title: "Added by", searchable: true, orderable: true, width: "15%" },
      { data: 8, title: "Action", searchable: false, orderable: false, width: "12%" }
    ],
    initComplete: function () {
      // Only add search row if it doesn't already exist
      if ($('#all_data thead tr.search-row').length === 0) {
        var api = this.api();
        
        // Clone the header row and add search inputs
        $('#all_data thead tr').clone(true).addClass('search-row').appendTo('#all_data thead');
        $('#all_data thead tr:eq(1) th').each(function (i) {
          var title = $(this).text();
          
          // Skip search for non-searchable columns
          if ([0, 4, 5, 6, 8].indexOf(i) !== -1) {
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
    error: function(xhr, status, error) {
      console.error('AJAX Error:', xhr.responseText);
      toastr.error('Server error occurred. Please try again.');
      $btn.prop('disabled', false);
    }
  });
});

$("#add_data_btn").on('click', function() {
  var base_url = $(".base_url").val();
  var data = $("#add_data_form").serialize();
  
  $.ajax({
    url: base_url + 'part/add_data',
    type:'post',
    data:data,
    dataType: 'json',
    success:function(res){
      if(res.status === 'success'){
        all_data();
        toastr.success(res.message);
        $('#edit_data').modal('hide');
      } else {
        toastr.error(res.message || 'An error occurred.');
      }
    },
    error: function(xhr, status, error) {
      console.error('AJAX Error:', xhr.responseText);
      toastr.error('Server error occurred. Please try again.');
    }
  });
});

function del(id){
  var base_url = $(".base_url").val();
  
  if(confirm('Are you sure you want to delete this part?')){
    $.ajax({
      url: base_url + 'part/del_data',
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
  }
}

function edit(id){
  var base_url = $(".base_url").val();
  $('#modal-title').text('Edit Part');
  
  $.ajax({
    url: base_url + 'part/edit_data',
    type: 'post',
    data: {'id': id},
    dataType: 'json',
    success: function(obj){
      if (obj) {
        $('#id').val(obj.id);
        $('#price_max').val(obj.price_max);
        $('#price_min').val(obj.price_min);
        $('#stock').val(obj.stock);
        $('#branch').val(obj.branch);
        $('#type').val(obj.type);

        // Set brand and load models
        $('#brand').val(obj.brand);
        load_model(obj.model); // Pass model_id to load_model
        
        $('#edit_data').modal('show');
      } else {
        toastr.error('Part data not found.');
      }
    },
    error: function() {
      toastr.error('Error loading part data.');
    }
  }); 
}

function view(id){
  var base_url = $(".base_url").val();
  
  $.ajax({
    url: base_url + 'part/edit_data',
    type: 'post',
    data: {'id': id},
    dataType: 'json',
    success: function(obj){
      if (obj) {
        $('#view_brand_name').text(obj.brand_name);
        $('#view_model_name').text(obj.model_name);
        $('#view_part_type_name').text(obj.part_type_name);
        $('#view_price_min').text(obj.price_min);
        $('#view_price_max').text(obj.price_max);
        $('#view_stock').text(obj.stock);
        $('#view_added_by').text(obj.user_name);
        
        $('#view_data').modal('show');
      } else {
        toastr.error('Part data not found.');
      }
    },
    error: function() {
      toastr.error('Error loading part data.');
    }
  }); 
}

$('#brand').on('change',function(){
  load_model();
});

function load_model(model_id_to_select){
  var base_url = $(".base_url").val();
  var brand_id = $('#brand').val();
  
  if (brand_id) {
    $.ajax({
      url: base_url + 'part/get_models_by_brand/' + brand_id,
      type: 'get',
      dataType: 'json',
      success: function(models){
        var options = '<option value="">Select Model</option>';
        if(models && models.length > 0) {
          models.forEach(function(model) {
            options += '<option value="' + model.id + '">' + model.name + '</option>';
          });
        }
        $('#model').html(options);

        // If a model needs to be pre-selected (during edit)
        if(model_id_to_select) {
          $('#model').val(model_id_to_select);
        }
      },
      error: function() {
        toastr.error('Error loading model data.');
      }
    });
  } else {
    $('#model').html('<option value="">Select Brand First</option>');
  }
}

function reset(){
  $("#add_data_form")[0].reset();
  $('#id').val('');
  $('#model').html('<option value="">Select Brand First</option>');
  
  // Re-enable form inputs and show submit button
  $('#add_data_form input, #add_data_form select').prop('disabled', false);
  $('#add_data_form button[type="submit"]').show();
}
