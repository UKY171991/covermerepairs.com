$(document).ready(function() {
    // Initialize DataTable
    all_data();

    // Initialize all Select2 elements. This runs only once.
    $('.select2').each(function() {
        const $this = $(this);
        const options = {
            width: '100%',
            theme: 'bootstrap4',
            allowClear: true
        };
        if ($this.closest('.modal').length) {
            options.dropdownParent = $this.closest('.modal');
        }
        if ($this.hasClass('branch')) {
            options.placeholder = 'Select one or more branches';
        }
        $this.select2(options);
    });

    // When the "Add" button is clicked, reset the form for a new entry.
    $('.add_btn').on('click', function() {
        reset_form();
    });
});

function all_data() {
    if ($.fn.dataTable.isDataTable('#all_data')) {
        $('#all_data').DataTable().destroy();
    }
    const base_url = $(".base_url").val();
    $('#all_data').DataTable({
        "processing": true,
        "ajax": { "url": base_url + 'technicians/all_data_ajax', "type": "POST" },
        "columns": [
            { "data": 0 }, { "data": 1 }, { "data": 2 },
            { "data": 3 }, { "data": 4 }, { "data": 5 }
        ]
    });
}

$("#submit_data").on('submit', function(e) {
    e.preventDefault();
    const $btn = $(this).find('button[type=submit]');
    $btn.prop('disabled', true).text('Saving...');
    $.ajax({
        url: $(this).attr('action'),
        type: 'POST',
        data: $(this).serialize(),
        dataType: 'json',
        success: function(response) {
            if (response.status === 'success') {
                all_data();
                $('#edit_data').modal('hide');
                showMessage(response.message, 'success');
            } else {
                showMessage(response.message || 'An unknown error occurred.', 'error');
            }
        },
        error: function() { showMessage('A server error occurred. Please try again.', 'error'); },
        complete: function() { $btn.prop('disabled', false).text('Save changes'); }
    });
});

function edit(id) {
    // NOTE FOR DEBUGGING: Open your browser's developer console (F12) to see these messages.
    console.log(`Requesting data for technician ID: ${id}`);
    reset_form();
    const base_url = $(".base_url").val();

    $.ajax({
        url: base_url + 'technicians/edit',
        type: 'POST',
        data: { id: id },
        dataType: 'json',
        success: function(data) {
            const technician = data[0];
            if (!technician) {
                showMessage('Could not find technician data.', 'error');
                console.error("Received empty or invalid data for technician.", data);
                return;
            }
            console.log("Received data:", technician);

            // Populate fields
            $('.id').val(technician.id);
            $('.name').val(technician.name);
            $('.email').val(technician.email);
            $('.phone').val(technician.phone);
            $('.username').val(technician.username);
            $('.address').val(technician.address);
            $('.dob').val(technician.dob);

            // Handle Branch field
            const $branchField = $('.branch');
            console.log(`Branch field element exists in modal: ${$branchField.length > 0}`);
            if ($branchField.length > 0) {
                const branchIds = technician.branch ? technician.branch.split('--').filter(Boolean) : [];
                console.log(`Setting branch IDs: ${JSON.stringify(branchIds)}`);
                $branchField.val(branchIds).trigger('change');
                console.log(`Branch field value after setting: ${$branchField.val()}`);
            }

            // Handle Permissions
            $('input[name="permission[]"]').prop('checked', false); // Clear first
            const permissions = technician.permission ? technician.permission.split('--').filter(Boolean) : [];
            permissions.forEach(slug => $('#' + slug).prop('checked', true));
            console.log("Permissions set.");
        },
        error: function(jqXHR, textStatus, errorThrown) {
            showMessage('Failed to fetch technician data from the server.', 'error');
            console.error("AJAX error:", textStatus, errorThrown);
        }
    });
}

function del(id) {
    if (confirm('Are you sure you want to delete this technician?')) {
        const base_url = $(".base_url").val();
        $.ajax({
            url: base_url + 'technicians/delete',
            type: 'POST',
            data: { id: id },
            // Assuming the response is a simple string message
            success: function(res) {
                all_data();
                // Attempt to parse as JSON, otherwise treat as text
                try {
                    const obj = JSON.parse(res);
                    showMessage(obj.message || 'Deleted successfully.', obj.status || 'success');
                } catch (e) {
                    showMessage(res, 'success');
                }
            },
            error: function() { showMessage('Failed to delete technician.', 'error'); }
        });
    }
}

/**
 * Resets the form by manually clearing fields, avoiding native form.reset()
 * which can interfere with plugins like Select2.
 */
function reset_form() {
    console.log("Resetting form...");
    const $form = $("#submit_data");

    // Clear text-based inputs and textareas
    $form.find('input[type="text"], input[type="email"], input[type="password"], input[type="date"], textarea').val('');
    
    // Clear hidden ID field
    $form.find(".id").val("");

    // Uncheck all permission checkboxes
    $form.find('input[type="checkbox"]').prop('checked', false);

    // Reset Select2 fields
    if ($form.find('.select2').length) {
        console.log("Resetting Select2 fields.");
        $form.find('.select2').val(null).trigger('change');
    }
    console.log("Form reset complete.");
}


function showMessage(message, type) {
    const bgColor = type === 'success' ? '#28a745' : '#dc3545';
    const notification = $('<div>', {
        text: message,
        css: {
            position: 'fixed', top: '20px', right: '20px',
            padding: '15px', borderRadius: '5px', color: 'white',
            fontWeight: 'bold', zIndex: 10001, backgroundColor: bgColor,
            boxShadow: '0 2px 10px rgba(0,0,0,0.2)'
        }
    });
    $('body').append(notification);
    notification.hide().fadeIn(300).delay(3500).fadeOut(400, function() { $(this).remove(); });
}