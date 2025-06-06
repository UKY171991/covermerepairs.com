$(document).ready(function() {
    let currentPage = 1;
    let perPage = 10;
    let search = { order_id: '', part_name: '', status: '' };
    let editingId = null;

    function fetchOrders(page = 1) {
        $.getJSON(BASE_URL + 'part/order_ajax', { page, limit: perPage }, function(res) {
            let rows = '';
            if (res.data.length > 0) {
                let i = (page - 1) * perPage + 1;
                res.data.forEach(function(order) {
                    rows += `<tr>
                        <td>${i++}</td>
                        <td>${order.order_id}</td>
                        <td>${order.part_name}</td>
                        <td>${order.quantity}</td>
                        <td>${order.order_date}</td>
                        <td>${order.status}</td>
                        <td>${order.remarks}</td>
                        <td>
                            <button class="btn btn-info btn-xs" onclick="openEditOrderModal(${order.id})">Edit</button>
                            <button class="btn btn-danger btn-xs" onclick="deleteOrder(${order.id})">Delete</button>
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

    $('#pagination-links').on('click', 'a.page-link', function(e) {
        e.preventDefault();
        let page = parseInt($(this).data('page'));
        if (!isNaN(page)) {
            currentPage = page;
            fetchOrders(currentPage);
        }
    });

    window.openAddOrderModal = function() {
        $('#orderForm')[0].reset();
        $('#orderId').val('');
        $('#orderModalLabel').text('Add Part Order');
        $('#orderModal').modal('show');
    };

    window.openEditOrderModal = function(id) {
        $.getJSON(BASE_URL + 'part/order_ajax', { id: id, page: 1, limit: 1 }, function(res) {
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

    $('#orderForm').off('submit').on('submit', function(e) {
        e.preventDefault();
        $.ajax({
            url: BASE_URL + 'part/add_order_ajax',
            method: 'POST',
            data: $(this).serialize(),
            dataType: 'json',
            success: function(response) {
                currentPage = 1;
                fetchOrders(currentPage);
                $('#orderModal').modal('hide');
                $('#orderForm')[0].reset();
            }
        });
    });

    window.deleteOrder = function(id) {
        if (confirm('Are you sure you want to delete this record?')) {
            $.post(BASE_URL + 'part/delete_order_ajax', { id: id }, function(response) {
                fetchOrders(currentPage);
            });
        }
        return false;
    };

    fetchOrders(currentPage);
});