$(document).ready(function() {
  // Configure Toastr
  toastr.options = {
    closeButton: true,
    progressBar: true,
    positionClass: 'toast-top-right',
    timeOut: 5000
  };

  loadBrandTable();

  // Add/Edit Brand
  $('#submit_data').on('submit', function(e) {
    e.preventDefault();
    var $btn = $(this).find('button[type=submit]');
    $btn.prop('disabled', true);
    var action = $(this).attr('action');
    var data = $(this).serialize();
    $.ajax({
      url: action,
      type: 'POST',
      data: data,
      dataType: 'json',
      success: function(res) {
        if (res.status === 'success') {
          $('#edit_data').modal('hide');
          toastr.success(res.message);
          $('#submit_data')[0].reset();
          $('.id').val('');
          reloadBrandTable();
        } else {
          toastr.error(res.message || 'Error saving brand.');
        }
        $btn.prop('disabled', false);
      },
      error: function(xhr) {
        toastr.error(xhr.responseText || 'Server error.');
        $btn.prop('disabled', false);
      }
    });
  });
});

function loadBrandTable() {
  if ($.fn.DataTable.isDataTable('#all_data')) {
    $('#all_data').DataTable().destroy();
  }
  var base_url = $('.base_url').val();
  $('#all_data').DataTable({
    processing: true,
    ajax: {
      url: base_url + 'part/all_brand_ajax',
      type: 'POST',
      dataSrc: function(json) {
        if (typeof json.data === 'undefined' && json.status === 'error') {
          toastr.error(json.message || 'Session expired. Please login again.');
          return [];
        }
        return json.data;
      }
    },
    columns: [
      { data: 0 },
      { data: 1 },
      { data: 2 },
      { data: 3 }
    ]
  });
}

function reloadBrandTable() {
  $('#all_data').DataTable().ajax.reload(null, false);
}

function del(id) {
  var base_url = $('.base_url').val();
  if (confirm('Are you sure you want to delete this brand?')) {
    $.ajax({
      url: base_url + 'part/delete_brand',
      type: 'POST',
      data: { id: id },
      dataType: 'json',
      success: function(res) {
        if (res.status === 'success') {
          reloadBrandTable();
          toastr.success(res.message);
        } else {
          toastr.error(res.message || 'Delete failed.');
        }
      },
      error: function(xhr) {
        toastr.error(xhr.responseText || 'Delete failed.');
      }
    });
  }
}

function edit(id) {
  var base_url = $('.base_url').val();
  $.ajax({
    url: base_url + 'part/edit_brand',
    type: 'POST',
    data: { id: id },
    dataType: 'json',
    success: function(obj) {
      if (obj && obj[0]) {
        $('.id').val(obj[0]['id']);
        $('.name').val(obj[0]['name']);
        $('#edit_data').modal('show');
      } else {
        toastr.error('Brand not found.');
      }
    },
    error: function(xhr) {
      toastr.error(xhr.responseText || 'Error loading brand.');
    }
  });
}

function reset() {
  $('#submit_data')[0].reset();
  $('.id').val('');
}
