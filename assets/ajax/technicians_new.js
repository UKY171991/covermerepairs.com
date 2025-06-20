$(document).ready(function() {
    // Initialize page
    all_data();
    initializeSelect2();
});

// Initialize Select2 for all elements
function initializeSelect2() {
    $('.select2').each(function() {
        if (!$(this).hasClass('select2-hidden-accessible')) {
            $(this).select2({
                width: '100%',
                minimumResultsForSearch: 0,
                theme: 'bootstrap4',
                allowClear: true,
                placeholder: $(this).attr('name') === 'branch[]' ? 'Select branches' : 'Select option',
                dropdownParent: $(this).closest('.modal').length ? $(this).closest('.modal') : $(document.body)
            });
        }
    });
}

// DataTable initialization
function all_data() {
    if ($.fn.dataTable.isDataTable('#all_data')) {
        $('#all_data').DataTable().destroy();
    }

    var base_url = $(".base_url").val();
    var dataTable = $('#all_data').DataTable({
        "bSortCellsTop": true,
        "processing": true,
        ajax: {
            url: base_url + 'technicians/all_data_ajax',
            type: 'POST'
        },
        columns: [
            { data: 0 },
            { data: 1 },
            { data: 2 },
            { data: 3 },
            { data: 4 },
            { data: 5 }
        ]
    });
}

// Form submission
$("#submit_data").on('submit', function(e) {
    e.preventDefault();
    var $btn = $(this).find('button[type=submit]');
    $btn.prop('disabled', true);
    var action = $(this).attr('action');
    var data = $(this).serialize();
    
    $.ajax({
        url: action,
        type: 'post',
        data: data,
        success: function(res) {
            try {
                const obj = JSON.parse(res);
                if (obj['status'] == 'success') {
                    all_data();
                    showMessage(obj['message'], 'success');
                    reset();
                    $('#edit_data').modal('hide');
                } else {
                    showMessage(obj['message'], 'error');
                }
            } catch (e) {
                showMessage('Error processing response', 'error');
            }
            $btn.prop('disabled', false);
        },
        error: function() {
            showMessage('An error occurred. Please try again.', 'error');
            $btn.prop('disabled', false);
        }
    });
});

// Delete function
function del(id) {
    var base_url = $(".base_url").val();
    var conf = confirm('Are you sure you want to delete?');
    if (conf) {
        $.ajax({
            url: base_url + 'technicians/delete',
            type: 'post',
            data: {'id': id},
            success: function(res) {
                all_data();
                showMessage(res, 'success');
            },
            error: function() {
                showMessage('Failed to delete. Please try again.', 'error');
            }
        });
    }
}

// Edit function
function edit(id) {
    var base_url = $(".base_url").val();
    $('input').prop('checked', false);
    
    $.ajax({
        url: base_url + 'technicians/edit',
        type: 'post',
        data: {'id': id},
        success: function(res) {
            try {
                const obj = JSON.parse(res);
                
                // Fill form fields
                $('.id').val(obj[0]['id']);
                $('.name').val(obj[0]['name']);
                $('.email').val(obj[0]['email']);
                $('.phone').val(obj[0]['phone']);
                $('.username').val(obj[0]['username']);
                $('.address').val(obj[0]['address']);
                $('.dob').val(obj[0]['dob']);
                
                // Handle branch selection
                if ($('.branch').length > 0 && obj[0]['branch']) {
                    let branchData = obj[0]['branch'].toString();
                    if (branchData.includes('--')) {
                        // Multiple branches
                        const branchArray = branchData.split("--").filter(item => item !== "" && item.trim() !== "");
                        $('.branch').val(branchArray).trigger('change');
                    } else {
                        // Single branch
                        $('.branch').val([branchData]).trigger('change');
                    }
                }
                
                // Handle permissions
                if (obj[0]['permission']) {
                    let permissionText = obj[0]['permission'];
                    const permissionArray = permissionText.split("--");
                    for (var i = 0; i < permissionArray.length; i++) {
                        $('#' + permissionArray[i]).prop('checked', true);
                    }
                }
                
            } catch (e) {
                showMessage('Error loading data', 'error');
            }
        },
        error: function() {
            showMessage('Failed to load data', 'error');
        }
    });
}

// View function
function view(id) {
    var base_url = $(".base_url").val();
    $.ajax({
        url: base_url + 'technicians/view',
        type: 'post',
        data: {'id': id},
        success: function(res) {
            $('.view_table').html(res);
        },
        error: function() {
            showMessage('Failed to load data', 'error');
        }
    });
}

// Reset function
function reset() {
    $("#submit_data")[0].reset();
    $(".id").val("");
    $('input').prop('checked', false);
    
    // Reset Select2 fields
    $('.select2').val(null).trigger('change');
}

// Modal event handlers
$('#edit_data').on('show.bs.modal', function (e) {
    // Ensure Select2 is properly initialized when modal opens
    setTimeout(function() {
        initializeSelect2();
    }, 100);
});

$('#edit_data').on('hidden.bs.modal', function (e) {
    // Reset form when modal closes
    reset();
});

// Custom notification system
function showMessage(message, type) {
    // Remove any existing notifications
    $('.custom-notification').remove();
    
    // Create notification element
    const notification = $('<div class="custom-notification ' + type + '">' + message + '</div>');
    
    notification.css({
        'position': 'fixed',
        'top': '20px',
        'right': '20px',
        'padding': '12px 20px',
        'border-radius': '4px',
        'color': 'white',
        'font-weight': 'bold',
        'z-index': '9999',
        'max-width': '400px',
        'box-shadow': '0 2px 8px rgba(0,0,0,0.2)',
        'font-size': '14px'
    });
    
    if (type === 'success') {
        notification.css('background-color', '#28a745');
    } else {
        notification.css('background-color', '#dc3545');
    }
    
    $('body').append(notification);
    
    // Fade in
    notification.hide().fadeIn(300);
    
    // Auto hide after 3 seconds
    setTimeout(function() {
        notification.fadeOut(300, function() {
            $(this).remove();
        });
    }, 3000);
}
