<div class="content-wrapper">
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Part Order</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="<?=base_url()?>">Home</a></li>
            <li class="breadcrumb-item active">Part Order</li>
          </ol>
        </div>
      </div>
    </div>
  </section>
  <section class="content">
    <div class="container-fluid">
      <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
          <h3 class="card-title">Part Order List</h3>
          <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#orderModal" onclick="openAddOrderModal()">Add Part Order</button>
        </div>
        <div class="card-body">
          <table class="table table-bordered table-striped" id="orderTable">
            <thead>
              <tr>
                <th>#</th>
                <th>Order ID</th>
                <th>Part Name</th>
                <th>Quantity</th>
                <th>Order Date</th>
                <th>Status</th>
                <th>Remarks</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              <?php if (!empty($orders)) : ?>
                <?php foreach ($orders as $order) : ?>
                  <tr data-id="<?= $order['id'] ?>">
                    <td><?= htmlspecialchars($order['id']) ?></td>
                    <td><?= htmlspecialchars($order['order_id']) ?></td>
                    <td><?= htmlspecialchars($order['part_name']) ?></td>
                    <td><?= htmlspecialchars($order['quantity']) ?></td>
                    <td><?= htmlspecialchars($order['order_date']) ?></td>
                    <td><?= htmlspecialchars($order['status']) ?></td>
                    <td><?= htmlspecialchars($order['remarks']) ?></td>
                    <td>
                      <button class="btn btn-info btn-xs edit-btn" onclick="openEditOrderModal(<?= $order['id'] ?>, this)">Edit</button>
                      <button class="btn btn-danger btn-xs delete-btn" onclick="deleteOrder(<?= $order['id'] ?>, this)">Delete</button>
                    </td>
                  </tr>
                <?php endforeach; ?>
              <?php else : ?>
                <tr>
                  <td colspan="8" class="text-center text-muted">No part order records found.</td>
                </tr>
              <?php endif; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </section>

  <!-- Part Order Modal -->
  <div class="modal fade" id="orderModal" tabindex="-1" role="dialog" aria-labelledby="orderModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <form id="orderForm">
          <div class="modal-header">
            <h5 class="modal-title" id="orderModalLabel">Add Part Order</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <input type="hidden" name="id" id="orderId">
            <div class="form-group">
              <label for="order_id">Order ID</label>
              <input type="text" class="form-control" name="order_id" id="order_id" required>
            </div>
            <div class="form-group">
              <label for="part_name">Part Name</label>
              <input type="text" class="form-control" name="part_name" id="part_name" required>
            </div>
            <div class="form-group">
              <label for="quantity">Quantity</label>
              <input type="number" class="form-control" name="quantity" id="quantity" required>
            </div>
            <div class="form-group">
              <label for="order_date">Order Date</label>
              <input type="date" class="form-control" name="order_date" id="order_date" required>
            </div>
            <div class="form-group">
              <label for="status">Status</label>
              <input type="text" class="form-control" name="status" id="status" required>
            </div>
            <div class="form-group">
              <label for="remarks">Remarks</label>
              <input type="text" class="form-control" name="remarks" id="remarks">
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary" id="saveOrderBtn">Save</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <script>
  $(function() {
    function openAddOrderModal() {
      $('#orderModalLabel').text('Add Part Order');
      $('#orderForm')[0].reset();
      $('#orderId').val('');
      $('#orderModal').modal('show');
    }
    window.openAddOrderModal = openAddOrderModal;

    function openEditOrderModal(id, btn) {
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
    window.openEditOrderModal = openEditOrderModal;

    $('#orderForm').submit(function(e) {
      e.preventDefault();
      var id = $('#orderId').val();
      var url = id ? '<?=base_url('part/edit_order/')?>' + id : '<?=base_url('part/add_order')?>';
      $.ajax({
        url: url,
        type: 'POST',
        data: $(this).serialize(),
        dataType: 'json',
        success: function(res) {
          if(res.status === 'success') {
            location.reload(); // For simplicity, reload. For SPA, update table dynamically.
          }
        }
      });
    });

    function deleteOrder(id, btn) {
      if(confirm('Are you sure you want to delete this record?')) {
        $.ajax({
          url: '<?=base_url('part/delete_order/')?>' + id,
          type: 'POST',
          dataType: 'json',
          success: function(res) {
            if(res.status === 'success') {
              location.reload(); // For simplicity, reload. For SPA, remove row dynamically.
            }
          }
        });
      }
    }
    window.deleteOrder = deleteOrder;
  });
  </script>
</div> 