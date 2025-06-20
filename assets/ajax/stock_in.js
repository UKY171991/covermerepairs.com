$(document).ready(function() {
    loadStockInTable();

    // Add/Edit Stock In
    $('#stockInForm').on('submit', function(e) {
        e.preventDefault();
        var id = $('#stockInId').val();
        var base_url = $('.base_url').val();
        var url = id ? base_url + 'stock_in/edit_stock_in/' + id : base_url + 'stock_in/add_stock_in';
        $.ajax({
            url: url,
            type: 'POST',
            data: $(this).serialize(),
            dataType: 'json',
            success: function(res) {
                if(res.status === 'success') {
                    $('#stockInModal').modal('hide');
                    $('#stockInForm')[0].reset();
                    reloadStockInTable();
                    $(document).Toasts('create', {
                        class: 'bg-success',
                        title: 'Success',
                        body: res.message || 'Stock In saved successfully.'
                    });
                } else {
                    $(document).Toasts('create', {
                        class: 'bg-danger',
                        title: 'Error',
                        body: res.message || 'Failed to save Stock In.'
                    });
                }
            },
            error: function(xhr) {
                $(document).Toasts('create', {
                    class: 'bg-danger',
                    title: 'Error',
                    body: 'An error occurred while saving Stock In.'
                });
            }
        });
    });
});

function loadStockInTable() {
    if ($.fn.DataTable.isDataTable('#stockInTable')) {
        $('#stockInTable').DataTable().destroy();
    }
    var base_url = $('.base_url').val();
    $('#stockInTable').DataTable({
        processing: true,
        ajax: {
            url: base_url + 'stock_in/all_stock_in_ajax',
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

function reloadStockInTable() {
    $('#stockInTable').DataTable().ajax.reload(null, false);
}

function openAddStockInModal() {
    $('#stockInModalLabel').text('Add Stock In');
    $('#stockInForm')[0].reset();
    $('#stockInId').val('');
    $('#stockInModal').modal('show');
}

function openEditStockInModal(id, btn) {
    var row = $(btn).closest('tr');
    $('#stockInModalLabel').text('Edit Stock In');
    $('#stockInId').val(id);
    $('#part_name').val(row.find('td:eq(1)').text());
    $('#quantity').val(row.find('td:eq(2)').text());
    $('#date').val(row.find('td:eq(3)').text());
    $('#received_by').val(row.find('td:eq(4)').text());
    $('#remarks').val(row.find('td:eq(5)').text());
    $('#stockInModal').modal('show');
}

function deleteStockIn(id, btn) {
    var base_url = $('.base_url').val();
    if(confirm('Are you sure you want to delete this record?')) {
        $.ajax({
            url: base_url + 'stock_in/delete_stock_in/' + id,
            type: 'POST',
            dataType: 'json',
            success: function(res) {
                if(res.status === 'success') {
                    reloadStockInTable();
                    $(document).Toasts('create', {
                        class: 'bg-success',
                        title: 'Deleted',
                        body: res.message || 'Stock In deleted successfully.'
                    });
                } else {
                    $(document).Toasts('create', {
                        class: 'bg-danger',
                        title: 'Error',
                        body: res.message || 'Failed to delete Stock In.'
                    });
                }
            },
            error: function(xhr) {
                $(document).Toasts('create', {
                    class: 'bg-danger',
                    title: 'Error',
                    body: 'An error occurred while deleting Stock In.'
                });
            }
        });
    }
}