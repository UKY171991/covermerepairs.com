/**
 * Technicians Management JavaScript
 * Enhanced version with better organization and features
 */

$(document).ready(function() {
    // Initialize all components
    initializeComponents();
    
    // Load initial data
    loadTechniciansData();
    
    // Bind event handlers
    bindEventHandlers();
});

/**
 * Initialize all UI components
 */
function initializeComponents() {
    // Initialize Select2 elements
    initializeSelect2();
    
    // Initialize tooltips
    initializeTooltips();
}

/**
 * Initialize Select2 dropdowns
 */
function initializeSelect2() {
    $('.select2').each(function() {
        const $this = $(this);
        const options = {
            width: '100%',
            theme: 'bootstrap4',
            allowClear: true,
            dropdownParent: $this.closest('.modal'),
            placeholder: 'Select an option'
        };
        
        if ($this.hasClass('branch')) {
            options.placeholder = 'Select one or more branches';
        }
        
        $this.select2(options);
    });
}

/**
 * Initialize Bootstrap tooltips
 */
function initializeTooltips() {
    $('[data-toggle="tooltip"]').tooltip();
}

/**
 * Bind all event handlers
 */
function bindEventHandlers() {
    // Add button click
    $('#add_btn').on('click', handleAddTechnician);
    
    // Form submission
    $('#submit_data').on('submit', handleFormSubmit);
    
    // Table action buttons (using event delegation)
    $('#all_data').on('click', '.edit_btn', handleEditTechnician);
    $('#all_data').on('click', '.view_btn', handleViewTechnician);
    $('#all_data').on('click', '.del_btn', handleDeleteTechnician);
    
    // Modal events
    $('#edit_data').on('show.bs.modal', onModalShow);
    $('#edit_data').on('hidden.bs.modal', onModalHidden);
    
    // Form validation
    $('#submit_data').on('input change', handleFormValidation);
}

/**
 * Handle Add Technician button click
 */
function handleAddTechnician() {
    resetForm();
    $('#edit_modal_title').html('<i class="fas fa-user-plus mr-2"></i>Add Technician');
    $('#edit_data').modal('show');
}

/**
 * Handle Edit Technician button click
 */
function handleEditTechnician(e) {
    e.preventDefault();
    const id = $(e.currentTarget).data('id');
    if (id) {
        editTechnician(id);
    }
}

/**
 * Handle View Technician button click
 */
function handleViewTechnician(e) {
    e.preventDefault();
    const id = $(e.currentTarget).data('id');
    if (id) {
        viewTechnician(id);
    }
}

/**
 * Handle Delete Technician button click
 */
function handleDeleteTechnician(e) {
    e.preventDefault();
    const id = $(e.currentTarget).data('id');
    if (id) {
        deleteTechnician(id);
    }
}

/**
 * Handle form submission
 */
function handleFormSubmit(e) {
    e.preventDefault();
    
    const $form = $(this);
    const $btn = $form.find('button[type=submit]');
    
    // Validate form
    if (!validateForm($form)) {
        showNotification('error', 'Please fill in all required fields.');
        return;
    }
    
    // Show loading state
    $btn.prop('disabled', true)
        .html('<i class="fas fa-spinner fa-spin mr-2"></i>Saving...');
    
    // Submit form via AJAX
    $.ajax({
        url: $form.attr('action'),
        type: 'POST',
        data: $form.serialize(),
        dataType: 'json',
        success: function(response) {
            if (response.status === 'success') {
                loadTechniciansData();
                $('#edit_data').modal('hide');
                showNotification('success', response.message || 'Technician saved successfully.');
            } else {
                showNotification('error', response.message || 'An error occurred while saving.');
            }
        },
        error: function(xhr, status, error) {
            console.error('Form submission error:', error);
            showNotification('error', 'A server error occurred. Please try again.');
        },
        complete: function() {
            $btn.prop('disabled', false)
                .html('<i class="fas fa-save mr-2"></i>Save Technician');
        }
    });
}

/**
 * Load technicians data into DataTable
 */
function loadTechniciansData() {
    if ($.fn.dataTable.isDataTable('#all_data')) {
        $('#all_data').DataTable().destroy();
    }
    
    const base_url = $(".base_url").val();
    
    $('#all_data').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: base_url + 'technicians/all_data_ajax',
            type: 'POST',
            error: function(xhr, error, code) {
                console.error('Data loading error:', error);
                showNotification('error', 'Failed to load technicians data.');
            }
        },
        columns: [
            { data: 0, width: '5%' },  // #
            { data: 1, width: '20%' }, // Name
            { data: 2, width: '15%' }, // Username
            { data: 3, width: '20%' }, // Email
            { data: 4, width: '15%' }, // Phone
            { 
                data: 5, 
                width: '10%',
                render: function(data, type, row) {
                    return getStatusBadge(data);
                }
            }, // Status
            { 
                data: 6, 
                width: '15%',
                orderable: false,
                className: 'text-center',
                render: function(data, type, row) {
                    return getActionButtons(row[0]); // Assuming row[0] is the ID
                }
            }  // Actions
        ],
        responsive: true,
        pageLength: 25,
        lengthMenu: [[10, 25, 50, 100], [10, 25, 50, 100]],
        language: {
            search: "Search technicians:",
            lengthMenu: "Show _MENU_ technicians",
            info: "Showing _START_ to _END_ of _TOTAL_ technicians",
            infoEmpty: "No technicians found",
            infoFiltered: "(filtered from _MAX_ total technicians)",
            zeroRecords: "No matching technicians found",
            emptyTable: "No technicians data available"
        },
        initComplete: function() {
            // Add search styling
            $('.dataTables_filter input').addClass('form-control form-control-sm');
            $('.dataTables_length select').addClass('form-control form-control-sm');
        }
    });
}

/**
 * Get status badge HTML
 */
function getStatusBadge(status) {
    const statusConfig = {
        'Active': { class: 'badge-success', icon: 'fa-check-circle' },
        'Inactive': { class: 'badge-warning', icon: 'fa-pause-circle' },
        'Suspended': { class: 'badge-danger', icon: 'fa-ban' }
    };
    
    const config = statusConfig[status] || { class: 'badge-secondary', icon: 'fa-question-circle' };
    
    return `<span class="badge ${config.class}">
        <i class="fas ${config.icon} mr-1"></i>${status}
    </span>`;
}

/**
 * Get action buttons HTML
 */
function getActionButtons(id) {
    return `
        <div class="technician-actions">
            <button class="btn btn-view btn-sm" data-id="${id}" 
                    data-toggle="tooltip" title="View Details">
                <i class="fas fa-eye"></i>
            </button>
            <button class="btn btn-edit btn-sm" data-id="${id}" 
                    data-toggle="tooltip" title="Edit Technician">
                <i class="fas fa-edit"></i>
            </button>
            <button class="btn btn-delete btn-sm" data-id="${id}" 
                    data-toggle="tooltip" title="Delete Technician">
                <i class="fas fa-trash"></i>
            </button>
        </div>
    `;
}

/**
 * Edit technician
 */
function editTechnician(id) {
    resetForm();
    $('#edit_modal_title').html('<i class="fas fa-user-edit mr-2"></i>Edit Technician');
    
    const base_url = $(".base_url").val();
    
    $.ajax({
        url: base_url + 'technicians/edit',
        type: 'POST',
        data: { id: id },
        dataType: 'json',
        beforeSend: function() {
            showLoading();
        },
        success: function(data) {
            if (!data || !data[0]) {
                showNotification('error', 'Could not find technician data.');
                return;
            }
            
            populateForm(data[0]);
            $('#edit_data').modal('show');
        },
        error: function(xhr, status, error) {
            console.error('Edit error:', error);
            showNotification('error', 'Failed to fetch technician data.');
        },
        complete: function() {
            hideLoading();
        }
    });
}

/**
 * Populate form with technician data
 */
function populateForm(technician) {
    // Basic fields
    $('.id').val(technician.id || '');
    $('.name').val(technician.name || '');
    $('.email').val(technician.email || '');
    $('.phone').val(technician.phone || '');
    $('.username').val(technician.username || '');
    $('.address').val(technician.address || '');
    $('.dob').val(technician.dob || '');
    
    // Branch assignment
    if ($('.branch').length > 0 && technician.branch) {
        const branchIds = technician.branch.split('--').filter(Boolean);
        $('.branch').val(branchIds).trigger('change');
    }
    
    // Permissions
    if (technician.permission) {
        const permissions = technician.permission.split('--').filter(Boolean);
        permissions.forEach(slug => {
            const $checkbox = $('#' + slug);
            if ($checkbox.length) {
                $checkbox.prop('checked', true);
            }
        });
    }
}

/**
 * View technician details
 */
function viewTechnician(id) {
    const base_url = $(".base_url").val();
    
    $.ajax({
        url: base_url + 'technicians/view',
        type: 'POST',
        data: { id: id },
        beforeSend: function() {
            showLoading();
        },
        success: function(response) {
            $('.view_table').html(response);
            $('#view_data').modal('show');
        },
        error: function(xhr, status, error) {
            console.error('View error:', error);
            showNotification('error', 'Failed to fetch technician details.');
        },
        complete: function() {
            hideLoading();
        }
    });
}

/**
 * Delete technician
 */
function deleteTechnician(id) {
    if (!confirm('Are you sure you want to delete this technician? This action cannot be undone.')) {
        return;
    }
    
    const base_url = $(".base_url").val();
    
    $.ajax({
        url: base_url + 'technicians/delete',
        type: 'POST',
        data: { id: id },
        beforeSend: function() {
            showLoading();
        },
        success: function(response) {
            loadTechniciansData();
            showNotification('success', 'Technician deleted successfully.');
        },
        error: function(xhr, status, error) {
            console.error('Delete error:', error);
            showNotification('error', 'Failed to delete technician.');
        },
        complete: function() {
            hideLoading();
        }
    });
}

/**
 * Reset form to initial state
 */
function resetForm() {
    const $form = $("#submit_data");
    $form[0].reset();
    $form.find(".id").val("");
    $form.find('.select2').val(null).trigger('change');
    $form.find('input[type=checkbox]').prop('checked', false);
    
    // Clear validation states
    $form.find('.is-invalid').removeClass('is-invalid');
    $form.find('.invalid-feedback').remove();
}

/**
 * Validate form
 */
function validateForm($form) {
    let isValid = true;
    
    // Clear previous validation
    $form.find('.is-invalid').removeClass('is-invalid');
    $form.find('.invalid-feedback').remove();
    
    // Required fields validation
    $form.find('[required]').each(function() {
        const $field = $(this);
        if (!$field.val().trim()) {
            $field.addClass('is-invalid');
            $field.after('<div class="invalid-feedback">This field is required.</div>');
            isValid = false;
        }
    });
    
    // Email validation
    const $email = $form.find('input[type="email"]');
    if ($email.val() && !isValidEmail($email.val())) {
        $email.addClass('is-invalid');
        $email.after('<div class="invalid-feedback">Please enter a valid email address.</div>');
        isValid = false;
    }
    
    return isValid;
}

/**
 * Check if email is valid
 */
function isValidEmail(email) {
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return emailRegex.test(email);
}

/**
 * Handle form validation on input change
 */
function handleFormValidation(e) {
    const $field = $(e.target);
    if ($field.val().trim()) {
        $field.removeClass('is-invalid');
        $field.siblings('.invalid-feedback').remove();
    }
}

/**
 * Modal show event handler
 */
function onModalShow(e) {
    // Re-initialize tooltips in modal
    $(e.target).find('[data-toggle="tooltip"]').tooltip();
}

/**
 * Modal hidden event handler
 */
function onModalHidden(e) {
    // Reset form when modal is hidden
    if ($(e.target).attr('id') === 'edit_data') {
        resetForm();
    }
}

/**
 * Show loading indicator
 */
function showLoading() {
    // You can implement a loading overlay here
    console.log('Loading...');
}

/**
 * Hide loading indicator
 */
function hideLoading() {
    // Hide loading overlay
    console.log('Loading complete.');
}

/**
 * Show notification
 */
function showNotification(type, message) {
    // Configure toastr
    toastr.options = {
        closeButton: true,
        progressBar: true,
        positionClass: 'toast-top-right',
        timeOut: 5000,
        extendedTimeOut: 1000,
        showEasing: 'swing',
        hideEasing: 'linear',
        showMethod: 'fadeIn',
        hideMethod: 'fadeOut'
    };
    
    if (type === 'error') {
        toastr.error(message, 'Error');
    } else if (type === 'warning') {
        toastr.warning(message, 'Warning');
    } else if (type === 'info') {
        toastr.info(message, 'Info');
    } else {
        toastr.success(message, 'Success');
    }
}

/**
 * Utility functions
 */
const Utils = {
    /**
     * Format date
     */
    formatDate: function(dateString) {
        if (!dateString) return '';
        const date = new Date(dateString);
        return date.toLocaleDateString();
    },
    
    /**
     * Format phone number
     */
    formatPhone: function(phone) {
        if (!phone) return '';
        return phone.replace(/(\d{3})(\d{3})(\d{4})/, '($1) $2-$3');
    },
    
    /**
     * Debounce function
     */
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
    }
};
