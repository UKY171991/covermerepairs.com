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
    });    // Handle the "Add" button click
    $('#add_btn').on('click', function() {
        reset_form();
        $('#edit_modal_title').text('Add Technician');
        $('#edit_data').modal('show');
    });

    // Handle the "Edit" button click using event delegation
    $('#all_data').on('click', '.edit_btn', function() {
        const id = $(this).data('id');
        if (id) {
            edit(id);
        }
    });

    // Handle the "View" button click using event delegation
    $('#all_data').on('click', '.view_btn', function() {
        const id = $(this).data('id');
        if (id) {
            view(id);
        }
    });

    // Handle the "Delete" button click using event delegation
    $('#all_data').on('click', '.del_btn', function() {
        const id = $(this).data('id');
        if (id) {
            del(id);
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
                show_notification('success', response.message);
            } else {
                show_notification('error', response.message || 'An unknown error occurred.');
            }
        },
        error: function() { show_notification('error', 'A server error occurred. Please try again.'); },
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
                show_notification('error', 'Could not find technician data.');
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
            show_notification('error', 'Failed to fetch technician data from the server.');
        }
    });
}

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
                show_notification('error', 'Could not find technician data.');
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

            $('#edit_data').modal('show');
        },
        error: function() {
            show_notification('error', 'Failed to fetch technician data from the server.');
        }
    });
}

function view(id) {
    const base_url = $(".base_url").val();
    $.ajax({
        url: base_url + 'technicians/view',
        type: 'POST',
        data: { id: id },
        success: function(res) {
            $('.view_table').html(res);
            $('#view_data').modal('show');
        },
        error: function() {
            show_notification('error', 'Failed to fetch technician data.');
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
                show_notification('success', 'Technician deleted successfully.');
            },
            error: function() { show_notification('error', 'Failed to delete technician.'); }
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

function show_notification(type, message) {
    toastr.options = {
        closeButton: true,
        progressBar: true,
        positionClass: 'toast-top-right',
        timeOut: 5000
    };
    if (type === 'error') {
        toastr.error(message);
    } else {
        toastr.success(message);
    }
}