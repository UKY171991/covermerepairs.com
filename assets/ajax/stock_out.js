$(document).ready(function() {
    loadStockOutTable();

    // Add/Edit Stock Out
    $('#stockOutForm').on('submit', function(e) {
        e.preventDefault();
        var id = $('#stockOutId').val();
        var base_url = $('.base_url').val();
        var url = id ? base_url + 'stock_out/edit_stock_out/' + id : base_url + 'stock_out/add_stock_out';
        $.ajax({
            url: url,
            type: 'POST',
            data: $(this).serialize(),
            dataType: 'json',
            success: function(res) {
                if(res.status === 'success') {
                    $('#stockOutModal').modal('hide');
                    $('#stockOutForm')[0].reset();
                    reloadStockOutTable();
                }
            }
        });
    });
});

function loadStockOutTable() {
    if ($.fn.DataTable.isDataTable('#stockOutTable')) {
        $('#stockOutTable').DataTable().destroy();
    }
    var base_url = $('.base_url').val();
    $('#stockOutTable').DataTable({
        processing: true,
        ajax: {
            url: base_url + 'stock_out/all_stock_out_ajax',
            type: 'POST',
            dataSrc: function(json) {
                return json.data;
            }
        },
        columns: [
            { data: 0 },
            { data: 1 },
            { data: 2 },
            { data: 3 },
            { data: 4 },
            { data: 5 },
            { data: 6 }
        ]
    });
}

function reloadStockOutTable() {
    $('#stockOutTable').DataTable().ajax.reload(null, false);
}

function openAddStockOutModal() {
    $('#stockOutModalLabel').text('Add Stock Out');
    $('#stockOutForm')[0].reset();
    $('#stockOutId').val('');
    $('#stockOutModal').modal('show');
}

function openEditStockOutModal(id, btn) {
    var row = $(btn).closest('tr');
    $('#stockOutModalLabel').text('Edit Stock Out');
    $('#stockOutId').val(id);
    $('#part_name').val(row.find('td:eq(1)').text());
    $('#quantity').val(row.find('td:eq(2)').text());
    $('#date').val(row.find('td:eq(3)').text());
    $('#issued_by').val(row.find('td:eq(4)').text());
    $('#remarks').val(row.find('td:eq(5)').text());
    $('#stockOutModal').modal('show');
}

function deleteStockOut(id, btn) {
    var base_url = $('.base_url').val();
    if(confirm('Are you sure you want to delete this record?')) {
        $.ajax({
            url: base_url + 'stock_out/delete_stock_out/' + id,
            type: 'POST',
            dataType: 'json',
            success: function(res) {
                if(res.status === 'success') {
                    reloadStockOutTable();
                }
            }
        });
    }
} 