window.openAddOrderModal = function() {
  $('#orderModalLabel').text('Add Part Order');
  $('#orderForm')[0].reset();
  $('#orderId').val('');
  $('#orderModal').modal('show');
}
window.openEditOrderModal = function(id, btn) {
  var row = $(btn).closest('tr');
  $('#orderModalLabel').text('Edit Part Order');
  $('#orderId').val(id);
  $('#order_id').val(row.find('td:eq(1)').text());
  $('#part_name').val(row.find('td:eq(2)').text());
  $('#quantity').val(row.find('td:eq(3)').text());
  $('#order_date').val(row.find('td:eq(4)').text());
  $('#status').val(row.find('td:eq(5)').text());
  $('#remarks').val(row.find('td:eq(6)').text());
  $('#orderModal').modal('show');
}
window.deleteOrder = function(id, btn) {
  if(confirm('Are you sure you want to delete this record?')) {
    $.ajax({
      url: BASE_URL + 'part/delete_order/' + id,
      type: 'POST',
      dataType: 'json',
      success: function(res) {
        if(res.status === 'success') {
          location.reload();
        }
      }
    });
  }
}
$(document).ready(function() {
  $('#orderForm').submit(function(e) {
    e.preventDefault();
    var $btn = $(this).find('button[type=submit]');
    $btn.prop('disabled', true);
    var id = $('#orderId').val();
    var url = id ? BASE_URL + 'part/edit_order/' + id : BASE_URL + 'part/add_order';
    $.ajax({
      url: url,
      type: 'POST',
      data: $(this).serialize(),
      dataType: 'json',
      success: function(res) {
        if(res.status === 'success') {
          location.reload();
        }
        $btn.prop('disabled', false);
      },
      error: function() {
        $btn.prop('disabled', false);
      }
    });
  });
});