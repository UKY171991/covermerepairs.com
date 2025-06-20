$(document).ready(function() {
    // Configure Toastr
    toastr.options = {
        closeButton: true,
        progressBar: true,
        positionClass: 'toast-top-right',
        timeOut: 5000
    };
    
    // Initialize DataTable
    initializeDataTable();
    
    // Event Handlers
    setupEventHandlers();
});

function setupEventHandlers() {
    // Add button click
    $('#add-part-btn').on('click', function() {
        resetForm();
        $('#modal_title').text('Add Part');
        $('#add_edit_modal').modal('show');
    });
    
    // Brand change event
    $('#brand').on('change', function() {
        loadModels();
    });
    
    // Form submission
    $('#part_form').on('submit', function(e) {
        e.preventDefault();
        savePart();
    });
    
    // Modal close events
    $('#add_edit_modal').on('hidden.bs.modal', function() {
        resetForm();
    });
}

function initializeDataTable() {
    // Destroy existing table if it exists
    if ($.fn.dataTable.isDataTable('#parts_table')) {
        $('#parts_table').DataTable().destroy();
    }
    
    var base_url = $(".base_url").val();
    
    $('#parts_table').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: base_url + 'part/all_data_ajax',
            type: 'POST',
            error: function(xhr, error, thrown) {
                console.error('DataTable Error:', error);
                toastr.error('Error loading data. Please refresh the page.');
            }
        },
        columns: [
            { data: 0, name: 'sr_no', orderable: false, searchable: false },
            { data: 1, name: 'brand_name' },
            { data: 2, name: 'model_name' },
            { data: 3, name: 'part_type_name' },
            { data: 4, name: 'price_min', orderable: true, searchable: false },
            { data: 5, name: 'price_max', orderable: true, searchable: false },
            { data: 6, name: 'stock', orderable: true, searchable: false },
            { data: 7, name: 'user_name' },
            { data: 8, name: 'action', orderable: false, searchable: false }
        ],
        pageLength: 10,
        lengthMenu: [[10, 25, 50, 100], [10, 25, 50, 100]],
        language: {
            processing: 'Loading...',
            search: 'Search:',
            lengthMenu: 'Show _MENU_ entries',
            info: 'Showing _START_ to _END_ of _TOTAL_ entries',
            infoEmpty: 'Showing 0 to 0 of 0 entries',
            infoFiltered: '(filtered from _MAX_ total entries)',
            zeroRecords: 'No matching records found',
            emptyTable: 'No data available in table',
            paginate: {
                first: 'First',
                previous: 'Previous',
                next: 'Next',
                last: 'Last'
            }
        },
        order: [[0, 'desc']],
        responsive: true,
        autoWidth: false
    });
}

function loadModels(selectedModel = null) {
    var base_url = $(".base_url").val();
    var brandId = $('#brand').val();
    
    // Clear model dropdown
    $('#model').html('<option value="">Select Model</option>');
    
    if (brandId) {
        $.ajax({
            url: base_url + 'part/get_models_by_brand/' + brandId,
            type: 'GET',
            dataType: 'json',
            success: function(models) {
                var options = '<option value="">Select Model</option>';
                if (models && models.length > 0) {
                    $.each(models, function(index, model) {
                        options += '<option value="' + model.id + '">' + model.name + '</option>';
                    });
                }
                $('#model').html(options);
                
                // Set selected model if provided
                if (selectedModel) {
                    $('#model').val(selectedModel);
                }
            },
            error: function() {
                toastr.error('Error loading models');
            }
        });
    }
}

function savePart() {
    var base_url = $(".base_url").val();
    var formData = $('#part_form').serialize();
    
    // Show loading state
    $('#save_btn').prop('disabled', true).html('<i class="fas fa-spinner fa-spin"></i> Saving...');
    
    $.ajax({
        url: base_url + 'part/add_data',
        type: 'POST',
        data: formData,
        dataType: 'json',
        success: function(response) {
            if (response.status === 'success') {
                toastr.success(response.message);
                $('#add_edit_modal').modal('hide');
                $('#parts_table').DataTable().ajax.reload();
                resetForm();
            } else {
                toastr.error(response.message || 'An error occurred');
            }
        },
        error: function(xhr, status, error) {
            console.error('Save Error:', xhr.responseText);
            toastr.error('Server error occurred. Please try again.');
        },
        complete: function() {
            // Reset button state
            $('#save_btn').prop('disabled', false).html('<i class="fas fa-save"></i> Save');
        }
    });
}

function viewPart(id) {
    var base_url = $(".base_url").val();
    
    $.ajax({
        url: base_url + 'part/edit_data',
        type: 'POST',
        data: { id: id },
        dataType: 'json',
        success: function(data) {
            if (data) {
                $('#view_branch_name').text(data.branch_name || '-');
                $('#view_brand_name').text(data.brand_name || '-');
                $('#view_model_name').text(data.model_name || '-');
                $('#view_part_type_name').text(data.part_type_name || '-');
                $('#view_price_min').text(data.price_min || '-');
                $('#view_price_max').text(data.price_max || '-');
                $('#view_stock').text(data.stock || '-');
                $('#view_added_by').text(data.user_name || '-');
                
                $('#view_modal').modal('show');
            } else {
                toastr.error('Part data not found');
            }
        },
        error: function() {
            toastr.error('Error loading part details');
        }
    });
}

function editPart(id) {
    var base_url = $(".base_url").val();
    
    $.ajax({
        url: base_url + 'part/edit_data',
        type: 'POST',
        data: { id: id },
        dataType: 'json',
        success: function(data) {
            if (data) {
                // Populate form fields
                $('#part_id').val(data.id);
                $('#branch').val(data.branch);
                $('#brand').val(data.brand);
                $('#type').val(data.type);
                $('#price_min').val(data.price_min);
                $('#price_max').val(data.price_max);
                $('#stock').val(data.stock);
                
                // Load models and set selected model
                loadModels(data.model);
                
                // Update modal title and show
                $('#modal_title').text('Edit Part');
                $('#add_edit_modal').modal('show');
            } else {
                toastr.error('Part data not found');
            }
        },
        error: function() {
            toastr.error('Error loading part data');
        }
    });
}

function deletePart(id) {
    var base_url = $(".base_url").val();
    
    if (confirm('Are you sure you want to delete this part?')) {
        $.ajax({
            url: base_url + 'part/del_data',
            type: 'POST',
            data: { id: id },
            dataType: 'json',
            success: function(response) {
                if (response.status === 'success') {
                    toastr.success(response.message);
                    $('#parts_table').DataTable().ajax.reload();
                } else {
                    toastr.error(response.message || 'Failed to delete part');
                }
            },
            error: function() {
                toastr.error('Error deleting part');
            }
        });
    }
}

function resetForm() {
    $('#part_form')[0].reset();
    $('#part_id').val('');
    $('#model').html('<option value="">Select Model</option>');
    $('#modal_title').text('Add Part');
}

// Global functions for button clicks (called from inline onclick events)
function view(id) {
    viewPart(id);
}

function edit(id) {
    editPart(id);
}

function del(id) {
    deletePart(id);
}
