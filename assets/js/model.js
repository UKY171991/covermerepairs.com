/**
 * Model Management JavaScript
 * Handles CRUD operations for model management
 */

// Wait for DOM to be ready
$(document).ready(function() {
    console.log('Model JavaScript loaded');
    
    // Check if base_url is available
    var base_url = $(".base_url").val();
    if (!base_url) {
        console.error('Base URL not found in the page');
        // Try to get base_url from common locations
        base_url = window.location.origin + '/covermerepairs.com/';
        console.log('Using fallback base URL:', base_url);
        $(".base_url").val(base_url);
    }
    
    // Initialize DataTable
    initializeModelDataTable();
    
    // Setup event handlers
    setupEventHandlers();
});

/**
 * Initialize DataTable for Models
 */
function initializeModelDataTable() {
    if ($.fn.DataTable.isDataTable('#all_data')) {
        $('#all_data').DataTable().destroy();
    }
    
    var base_url = $(".base_url").val();
    console.log('Initializing DataTable with URL:', base_url + 'part/all_model_ajax');
    
    $('#all_data').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: base_url + 'part/all_model_ajax',
            type: 'POST',
            error: function(xhr, error, thrown) {
                console.error('DataTable Error:', error, xhr);
                showNotification('error', 'Error loading model data. Please refresh the page.');
            },
            dataSrc: function(json) {
                console.log('DataTable AJAX response:', json);
                if (json.data && json.data.length > 0) {
                    console.log('Data loaded successfully, rows:', json.data.length);
                    // Check if action buttons are in the data
                    json.data.forEach(function(row, index) {
                        if (row[4] && row[4].indexOf('edit-btn') > -1) {
                            console.log('Row ' + index + ' has action buttons');
                        }
                    });
                } else {
                    console.log('No data in response');
                }
                return json.data;
            }
        },
        columns: [
            { data: 0, width: '5%', orderable: false }, // #
            { data: 1, width: '25%' }, // Model Name
            { data: 2, width: '25%' }, // Brand Name
            { data: 3, width: '25%' }, // User Name
            { data: 4, width: '20%', orderable: false } // Action
        ],
        pageLength: 10,
        lengthMenu: [[10, 25, 50, 100], [10, 25, 50, 100]],
        language: {
            processing: 'Loading...',
            search: 'Search models:',
            lengthMenu: 'Show _MENU_ models',
            info: 'Showing _START_ to _END_ of _TOTAL_ models',
            infoEmpty: 'Showing 0 to 0 of 0 models',
            infoFiltered: '(filtered from _MAX_ total models)',
            zeroRecords: 'No matching models found',
            emptyTable: 'No models available',
            paginate: {
                first: 'First',
                previous: 'Previous',
                next: 'Next',
                last: 'Last'
            }
        },
        order: [[0, 'desc']],
        responsive: true,
        autoWidth: false,
        initComplete: function() {
            console.log('DataTable initialized successfully');
            // Check if action buttons are present
            setTimeout(function() {
                $('#all_data tbody tr').each(function(index) {
                    var actionButtons = $(this).find('.edit-btn, .delete-btn, .view-btn');
                    console.log('Row ' + index + ' has ' + actionButtons.length + ' action buttons');
                });
            }, 500);
        }
    });
}

/**
 * Setup event handlers
 */
function setupEventHandlers() {
    console.log('Setting up event handlers');
    
    // Add model button click
    $('#add-model-btn').on('click', function() {
        console.log('Add button clicked');
        resetModelForm();
        $('#modal-title').text('Add Model');
        $('#edit_data').modal('show');
    });
    
    // Form submission
    $('#submit_data').on('submit', function(e) {
        e.preventDefault();
        console.log('Form submitted');
        saveModel();
    });
    
    // Modal close events
    $('#edit_data').on('hidden.bs.modal', function() {
        resetModelForm();
    });
    
    // Edit and delete button event delegation
    $(document).on('click', '.edit-btn', function(e) {
        e.preventDefault();
        var id = $(this).data('id');
        console.log('Edit button clicked for ID:', id);
        if (id) {
            editModel(id);
        } else {
            console.log('No ID found on edit button');
        }
    });
    
    $(document).on('click', '.delete-btn', function(e) {
        e.preventDefault();
        var id = $(this).data('id');
        console.log('Delete button clicked for ID:', id);
        if (id) {
            deleteModel(id);
        } else {
            console.log('No ID found on delete button');
        }
    });
    
    $(document).on('click', '.view-btn', function(e) {
        e.preventDefault();
        var id = $(this).data('id');
        console.log('View button clicked for ID:', id);
        if (id) {
            viewModel(id);
        } else {
            console.log('No ID found on view button');
        }
    });
    
    // Debug: Check if DataTable is loaded
    setTimeout(function() {
        console.log('Checking DataTable status...');
        if ($.fn.DataTable.isDataTable('#all_data')) {
            console.log('DataTable is initialized');
            var table = $('#all_data').DataTable();
            console.log('DataTable rows:', table.data().length);
            
            // Check if action buttons exist in the table
            $('#all_data tbody tr').each(function(index) {
                var actionButtons = $(this).find('.edit-btn, .delete-btn, .view-btn');
                console.log('Row ' + index + ' action buttons:', actionButtons.length);
            });
        } else {
            console.log('DataTable is NOT initialized');
        }
    }, 2000);
}

/**
 * Reset model form
 */
function resetModelForm() {
    $('#submit_data')[0].reset();
    $('.id').val('');
    $('.brand_id').val('').trigger('change');
}

/**
 * Save model (add/edit)
 */
function saveModel() {
    var $form = $('#submit_data');
    var $btn = $form.find('button[type="submit"]');
    
    // Validate form
    if (!$form.find('input[name="name"]').val().trim()) {
        showNotification('error', 'Please enter model name.');
        return;
    }
    
    if (!$form.find('select[name="brand_id"]').val()) {
        showNotification('error', 'Please select a brand.');
        return;
    }
    
    // Show loading state
    $btn.prop('disabled', true).html('<i class="fas fa-spinner fa-spin"></i> Saving...');
    
    // Submit form via AJAX
    $.ajax({
        url: $form.attr('action'),
        type: 'POST',
        data: $form.serialize(),
        dataType: 'json',
        success: function(response) {
            if (response.status === 'success') {
                $('#edit_data').modal('hide');
                initializeModelDataTable(); // Reload table
                showNotification('success', response.message || 'Model saved successfully.');
            } else {
                showNotification('error', response.message || 'An error occurred while saving.');
            }
        },
        error: function(xhr, status, error) {
            console.error('Save error:', error);
            showNotification('error', 'A server error occurred. Please try again.');
        },
        complete: function() {
            $btn.prop('disabled', false).html('Save');
        }
    });
}

/**
 * Edit model
 */
function editModel(id) {
    console.log('Editing model with ID:', id);
    resetModelForm();
    $('#modal-title').text('Edit Model');
    
    var base_url = $(".base_url").val();
    
    $.ajax({
        url: base_url + 'part/edit_model',
        type: 'POST',
        data: { id: id },
        dataType: 'json',
        beforeSend: function() {
            console.log('Sending edit request for ID:', id);
            showNotification('info', 'Loading model data...');
        },
        success: function(data) {
            console.log('Edit response:', data);
            if (data && data.length > 0) {
                var model = data[0];
                
                // Populate form
                $('.id').val(model.id || '');
                $('.name').val(model.name || '');
                $('.brand_id').val(model.brand_id || '').trigger('change');
                
                $('#edit_data').modal('show');
            } else {
                showNotification('error', 'Model not found.');
            }
        },
        error: function(xhr, status, error) {
            console.error('Edit error:', error, xhr);
            showNotification('error', 'Failed to load model data.');
        }
    });
}

/**
 * Delete model
 */
function deleteModel(id) {
    console.log('Deleting model with ID:', id);
    if (!confirm('Are you sure you want to delete this model? This action cannot be undone.')) {
        return;
    }
    
    var base_url = $(".base_url").val();
    
    $.ajax({
        url: base_url + 'part/delete_model',
        type: 'POST',
        data: { id: id },
        dataType: 'json',
        beforeSend: function() {
            console.log('Sending delete request for ID:', id);
            showNotification('info', 'Deleting model...');
        },
        success: function(response) {
            console.log('Delete response:', response);
            if (response.status === 'success') {
                initializeModelDataTable(); // Reload table
                showNotification('success', response.message || 'Model deleted successfully.');
            } else {
                showNotification('error', response.message || 'Failed to delete model.');
            }
        },
        error: function(xhr, status, error) {
            console.error('Delete error:', error, xhr);
            showNotification('error', 'A server error occurred. Please try again.');
        }
    });
}

/**
 * View model details
 */
function viewModel(id) {
    console.log('Viewing model with ID:', id);
    var base_url = $(".base_url").val();
    
    $.ajax({
        url: base_url + 'part/view_model',
        type: 'POST',
        data: { id: id },
        beforeSend: function() {
            console.log('Sending view request for ID:', id);
            showNotification('info', 'Loading model details...');
        },
        success: function(response) {
            console.log('View response:', response);
            // You can create a view modal or show details in an alert
            // For now, showing in a simple modal
            if (response && response.length > 0) {
                var model = response[0];
                var details = `
                    <p><strong>Model Name:</strong> ${model.name || 'N/A'}</p>
                    <p><strong>Brand ID:</strong> ${model.brand_id || 'N/A'}</p>
                    <p><strong>Added By:</strong> ${model.user_name || 'N/A'}</p>
                    <p><strong>Created At:</strong> ${model.created_at || 'N/A'}</p>
                `;
                
                // Create a simple view modal or use existing modal
                alert('Model Details:\n\n' + details.replace(/<[^>]*>/g, ''));
            } else {
                showNotification('error', 'Model not found.');
            }
        },
        error: function(xhr, status, error) {
            console.error('View error:', error, xhr);
            showNotification('error', 'Failed to load model details.');
        }
    });
}

/**
 * Show notification
 */
function showNotification(type, message) {
    console.log('Notification:', type, message);
    
    // Try toastr first
    if (typeof toastr !== 'undefined') {
        // Configure toastr
        toastr.options = {
            closeButton: true,
            progressBar: true,
            positionClass: 'toast-top-right',
            timeOut: 5000
        };
        
        if (type === 'error') {
            toastr.error(message);
        } else if (type === 'warning') {
            toastr.warning(message);
        } else if (type === 'info') {
            toastr.info(message);
        } else {
            toastr.success(message);
        }
    } else {
        // Fallback to console and alert
        console.log('[' + type.toUpperCase() + '] ' + message);
        
        // Only show alert for important messages
        if (type === 'error') {
            alert('Error: ' + message);
        }
    }
}

/**
 * Utility functions
 */
var Utils = {
    debounce: function(func, wait) {
        let timeout;
        return function executedFunction(...args) {
            const later = () => {
                clearTimeout(timeout);
                func(...args);
            };
            clearTimeout(timeout);
            timeout = setTimeout(later, wait);
        };
    },
    
    logError: function(error, context) {
        console.error('Error in ' + context + ':', error);
        if (error.stack) {
            console.error('Stack trace:', error.stack);
        }
    }
};
