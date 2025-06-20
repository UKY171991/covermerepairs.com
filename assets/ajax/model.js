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
                url: base_url+'part/all_model_ajax',
                type: 'POST'
            },
            columns: [
                { data: 0, title: "#", searchable: false, orderable: false, width: "5%" },
                { data: 1, title: "Model Name", searchable: true, orderable: true, width: "25%" },
                { data: 2, title: "Brand Name", searchable: true, orderable: true, width: "25%" },
                { data: 3, title: "User Name", searchable: true, orderable: true, width: "25%" },
                { data: 4, title: "Action", searchable: false, orderable: false, width: "20%" }
            ],
            initComplete: function () {
                // Only add search row if it doesn't already exist
                if ($('#all_data thead tr.search-row').length === 0) {
                    var api = this.api();
                    
                    // Clone the header row and add search inputs
                    $('#all_data thead tr').clone(true).addClass('search-row').appendTo('#all_data thead');
                    $('#all_data thead tr:eq(1) th').each(function (i) {
                        var title = $(this).text();
                        
                        // Skip search for # and Action columns
                        if (i === 0 || i === 4) {
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
