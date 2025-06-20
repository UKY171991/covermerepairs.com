$(document).ready(function() {
    // Initialize DataTable
    all_data();

    // Initialize all Select2 elements once.
    $('.select2').each(function() {
        const $this = $(this);
        const options = {
            width: '100%',
            theme: 'bootstrap4',
            allowClear: true,
            dropdownParent: $this.closest('.modal')
        };
        if ($this.hasClass('branch')) {
            options.placeholder = 'Select one or more branches';
        }
        $this.select2(options);
    });

    // Handle the "Add" button click
    $('.add_btn').on('click', function() {
        reset_form();
        $('#edit_modal_title').text('Add Technician');
    });

    // Handle the "Edit" button click using event delegation
    $('#all_data').on('click', '.edit_btn', function() {
        const id = $(this).data('id');
        if (id) {
            edit(id);
        }
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
    reset_form();
    $('#edit_modal_title').text('Edit Technician');
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
                return;
            }

            // Populate fields
            $('.id').val(technician.id);
            $('.name').val(technician.name);
            $('.email').val(technician.email);
            $('.phone').val(technician.phone);
            $('.username').val(technician.username);
            $('.address').val(technician.address);
            $('.dob').val(technician.dob);

            // Handle Branch field
            if ($('.branch').length > 0) {
                const branchIds = technician.branch ? technician.branch.split('--').filter(Boolean) : [];
                $('.branch').val(branchIds).trigger('change');
            }

            // Handle Permissions
            const permissions = technician.permission ? technician.permission.split('--').filter(Boolean) : [];
            permissions.forEach(slug => $('#' + slug).prop('checked', true));
        },
        error: function() {
            showMessage('Failed to fetch technician data from the server.', 'error');
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
            success: function(res) {
                all_data();
                showMessage('Technician deleted successfully.', 'success');
            },
            error: function() { showMessage('Failed to delete technician.', 'error'); }
        });
    }
}

function reset_form() {
    const $form = $("#submit_data");
    $form[0].reset();
    $form.find(".id").val("");
    $form.find('.select2').val(null).trigger('change');
    $form.find('input[type=checkbox]').prop('checked', false);
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