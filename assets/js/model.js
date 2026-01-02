/**
 * Model Management JavaScript
 * Handles CRUD operations for model management
 */

// Wait for DOM to be ready
$(document).ready(function() {
    // Check if base_url is available
    var base_url = $(".base_url").val();
    if (!base_url) {
        // Try to get base_url from common locations
        base_url = window.location.origin + '/covermerepairs.com/';
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
    
    $('#all_data').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: base_url + 'part/all_model_ajax',
            type: 'POST',
            error: function(xhr, error, thrown) {
                showNotification('error', 'Error loading model data. Please refresh the page.');
            },
            dataSrc: function(json) {
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
            // DataTable initialized successfully
        }
    });
}

/**
 * Setup event handlers
 */
function setupEventHandlers() {
    // Add model button click
    $('#add-model-btn').on('click', function() {
        resetModelForm();
        $('#modal-title').text('Add Model');
        $('#edit_data').modal('show');
    });
    
    // Form submission
    $('#submit_data').on('submit', function(e) {
        e.preventDefault();
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
        if (id) {
            editModel(id);
        }
    });
    
    $(document).on('click', '.delete-btn', function(e) {
        e.preventDefault();
        var id = $(this).data('id');
        if (id) {
            deleteModel(id);
        }
    });
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
    resetModelForm();
    $('#modal-title').text('Edit Model');
    
    var base_url = $(".base_url").val();
    
    $.ajax({
        url: base_url + 'part/edit_model',
        type: 'POST',
        data: { id: id },
        dataType: 'json',
        beforeSend: function() {
            showNotification('info', 'Loading model data...');
        },
        success: function(data) {
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
            showNotification('error', 'Failed to load model data.');
        }
    });
}

/**
 * Delete model
 */
function deleteModel(id) {
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
            showNotification('info', 'Deleting model...');
        },
        success: function(response) {
            if (response.status === 'success') {
                initializeModelDataTable(); // Reload table
                showNotification('success', response.message || 'Model deleted successfully.');
            } else {
                showNotification('error', response.message || 'Failed to delete model.');
            }
        },
        error: function(xhr, status, error) {
            showNotification('error', 'A server error occurred. Please try again.');
        }
    });
}

/**
 * Show notification
 */
function showNotification(type, message) {
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
