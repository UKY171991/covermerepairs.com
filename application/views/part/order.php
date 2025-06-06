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
          <div class="card-header d-flex justify-content-end">
            <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#orderModal" onclick="openAddOrderModal()">Add</button>
          </div>
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
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    let currentPage = 1;
    let perPage = 10;
    let search = { order_id: '', part_name: '', status: '' };
    let editingId = null;

    function fetchOrders(page = 1) {
        let params = {
            page: page,
            limit: perPage,
            order_id: search.order_id,
            part_name: search.part_name,
            status: search.status
        };
        $.getJSON('<?= base_url('part/order_ajax') ?>', params, function(res) {
            let rows = '';
            if (res.data.length > 0) {
                let i = (page - 1) * perPage + 1;
                res.data.forEach(function(order) {
                    rows += `<tr data-id="${order.id}">
                        <td>${i++}</td>
                        <td>${order.order_id}</td>
                        <td>${order.part_name}</td>
                        <td>${order.quantity}</td>
                        <td>${order.order_date}</td>
                        <td>${order.status}</td>
                        <td>${order.remarks}</td>
                        <td>
                            <button class="btn btn-info btn-xs edit-btn" onclick="openEditOrderModal(${order.id})">Edit</button>
                            <button class="btn btn-danger btn-xs delete-btn" onclick="deleteOrder(${order.id})">Delete</button>
                        </td>
                    </tr>`;
                });
            } else {
                rows = `<tr><td colspan="8" class="text-center text-muted">No part order records found.</td></tr>`;
            }
            $('#orderTable tbody').html(rows);
            renderPagination(res.total, page);
        });
    }

    function renderPagination(total, page) {
        let totalPages = Math.ceil(total / perPage);
        let html = '<ul class="pagination">';
        if (page > 1) {
            html += `<li class="page-item"><a class="page-link" href="#" data-page="1">First</a></li>`;
            html += `<li class="page-item"><a class="page-link" href="#" data-page="${page-1}">&laquo;</a></li>`;
        }
        for (let i = 1; i <= totalPages; i++) {
            html += `<li class="page-item${i === page ? ' active' : ''}"><a class="page-link" href="#" data-page="${i}">${i}</a></li>`;
        }
        if (page < totalPages) {
            html += `<li class="page-item"><a class="page-link" href="#" data-page="${page+1}">&raquo;</a></li>`;
            html += `<li class="page-item"><a class="page-link" href="#" data-page="${totalPages}">Last</a></li>`;
        }
        html += '</ul>';
        $('#pagination-links').html(html);
    }

    // Pagination click
    $('#pagination-links').on('click', 'a.page-link', function(e) {
        e.preventDefault();
        let page = parseInt($(this).data('page'));
        if (!isNaN(page)) {
            currentPage = page;
            fetchOrders(currentPage);
        }
    });

    // Add/Edit Order Modal
    window.openAddOrderModal = function() {
        editingId = null;
        $('#orderForm')[0].reset();
        $('#orderId').val('');
        $('#orderModalLabel').text('Add Part Order');
        $('#orderModal').modal('show');
    };
    window.openEditOrderModal = function(id) {
        editingId = id;
        $.getJSON('<?= base_url('part/order_ajax') ?>', { page: 1, limit: 1, id: id }, function(res) {
            if (res.data.length > 0) {
                let order = res.data[0];
                $('#orderId').val(order.id);
                $('#order_id').val(order.order_id);
                $('#part_name').val(order.part_name);
                $('#quantity').val(order.quantity);
                $('#order_date').val(order.order_date);
                $('#status').val(order.status);
                $('#remarks').val(order.remarks);
                $('#orderModalLabel').text('Edit Part Order');
                $('#orderModal').modal('show');
            }
        });
    };

    // AJAX form submit for add/edit
    $('#orderForm').off('submit').on('submit', function(e) {
        e.preventDefault();
        var form = $(this);
        $.ajax({
            url: '<?= base_url('part/add_order_ajax') ?>',
            method: 'POST',
            data: form.serialize(),
            success: function(response) {
                currentPage = 1;
                fetchOrders(currentPage);
                $('#orderModal').modal('hide');
                form[0].reset();
            }
        });
    });

    // AJAX delete
    window.deleteOrder = function(id) {
        if (confirm('Are you sure you want to delete this record?')) {
            $.post('<?= base_url('part/delete_order_ajax') ?>', { id: id }, function(response) {
                fetchOrders(currentPage);
            });
        }
        return false;
    };

    // Initial load
    fetchOrders(currentPage);
});
</script>
<div id="pagination-links" class="mt-3"></div>
