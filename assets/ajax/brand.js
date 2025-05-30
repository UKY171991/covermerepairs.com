$(document).ready(function() {
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
          showBrandMessage('success', res.message);
          $('#submit_data')[0].reset();
          $('.id').val('');
          reloadBrandTable();
        } else {
          showBrandMessage('danger', res.message || 'Error saving brand.');
        }
        $btn.prop('disabled', false);
      },
      error: function(xhr) {
        showBrandMessage('danger', xhr.responseText || 'Server error.');
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
          showBrandMessage('danger', json.message || 'Session expired. Please login again.');
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

function showBrandMessage(type, message) {
  $('#brand-message').html('<div class="alert alert-' + type + ' alert-dismissible">' +
    '<button type="button" class="close" data-dismiss="alert">&times;</button>' + message + '</div>');
}

function del(id) {
  var base_url = $('.base_url').val();
  if (confirm('Are you sure you want to delete this brand?')) {
    $.ajax({
      url: base_url + 'part/delete_brand',
      type: 'POST',
      data: { id: id },
      success: function(res) {
        reloadBrandTable();
        showBrandMessage('success', 'Brand deleted successfully.');
      },
      error: function(xhr) {
        showBrandMessage('danger', xhr.responseText || 'Delete failed.');
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
        showBrandMessage('danger', 'Brand not found.');
      }
    },
    error: function(xhr) {
      showBrandMessage('danger', xhr.responseText || 'Error loading brand.');
    }
  });
}

function reset() {
  $('#submit_data')[0].reset();
  $('.id').val('');
}
