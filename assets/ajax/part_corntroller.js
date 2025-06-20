$(document).ready(function() {
    const base_url = $(".base_url").val();
    let table;

    // Initialize Select2 for the modal, ensuring it's attached to the modal content
    $('.select2').select2({
        dropdownParent: $('#edit_data .modal-content')
    });

    // Function to initialize or re-initialize the DataTable
    function initialize_table() {
        if ($.fn.dataTable.isDataTable('#all_data')) {
            table.destroy();
        }
        table = $('#all_data').DataTable({
            "processing": true,
            "ajax": {
                "url": base_url + 'part_corntroller/all_data_ajax',
                "type": "POST",
                "dataSrc": "data"
            },
            "columns": [
                { "data": 0 },
                { "data": 1 },
                { "data": 2 },
                { "data": 3 },
                { "data": 4 },
                { "data": 5 }
            ],
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
        });
    }

    // Centralized function to reset the form to its default state
    function reset_form() {
        $('#submit_data')[0].reset();
        $('.id').val('');
        $('input[type="checkbox"]').prop('checked', false);
        $('.branch').val(null).trigger('change'); // Specifically for Select2
    }

    // A simple notification handler (can be replaced with a more advanced library like SweetAlert or Toastr)
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

    // Event handler for the "Add" button
    $('#add_btn').on('click', function() {
        reset_form();
        $('#modal_title').text('Add Part Controller');
        $('#edit_data').modal('show');
    });

    // Use event delegation for buttons inside the DataTable
    $('#all_data').on('click', '.edit_btn', function() {
        const id = $(this).data('id');
        reset_form();

        $.ajax({
            url: base_url + 'part_corntroller/edit',
            type: 'post',
            data: { 'id': id },
            dataType: 'json',
            success: function(res) {
                if (res && res.length > 0) {
                    const data = res[0];
                    $('#modal_title').text('Edit Part Controller');

                    // Populate form fields
                    $('.id').val(data.id);
                    $('.name').val(data.name);
                    $('.email').val(data.email);
                    $('.phone').val(data.phone);
                    $('.username').val(data.username);
                    $('.address').val(data.address);
                    $('.dob').val(data.dob);

                    // Handle multi-select for branches
                    if (data.branch) {
                        const branch_ids = data.branch.split('--');
                        $('.branch').val(branch_ids).trigger('change');
                    }

                    // Handle checkboxes for permissions
                    if (data.permission) {
                        const permissions = data.permission.split('--');
                        permissions.forEach(function(permission) {
                            if (permission) {
                                $('#' + permission).prop('checked', true);
                            }
                        });
                    }

                    $('#edit_data').modal('show');
                } else {
                    show_notification('error', 'Could not retrieve Part Controller data.');
                }
            },
            error: function() {
                show_notification('error', 'An error occurred while fetching data.');
            }
        });
    });

    $('#all_data').on('click', '.view_btn', function() {
        const id = $(this).data('id');
        $.ajax({
            url: base_url + 'part_corntroller/view',
            type: 'post',
            data: { 'id': id },
            success: function(res) {
                $('.view_table').html(res);
                $('#view_data').modal('show');
            },
            error: function() {
                show_notification('error', 'An error occurred while fetching the data.');
            }
        });
    });

    $('#all_data').on('click', '.del_btn', function() {
        const id = $(this).data('id');
        if (confirm('Are you sure you want to delete this Part Controller?')) {
            $.ajax({
                url: base_url + 'part_corntroller/delete',
                type: 'post',
                data: { 'id': id },
                success: function(res) {
                    show_notification('success', res);
                    table.ajax.reload();
                },
                error: function() {
                    show_notification('error', 'An error occurred during deletion.');
                }
            });
        }
    });

    // Handle the form submission for both add and edit
    $("#submit_data").on('submit', function(e) {
        e.preventDefault();
        const $btn = $(this).find('button[type=submit]');
        $btn.prop('disabled', true);
        const action = $(this).attr('action');
        const data = $(this).serialize();

        $.ajax({
            url: action,
            type: 'post',
            data: data,
            dataType: 'json',
            success: function(res) {
                if (res.status === 'success') {
                    show_notification('success', res.message);
                    $('#edit_data').modal('hide');
                    table.ajax.reload();
                } else {
                    show_notification('error', res.message);
                }
                $btn.prop('disabled', false);
            },
            error: function() {
                show_notification('error', 'An error occurred. Please try again.');
                $btn.prop('disabled', false);
            }
        });
    });

    // Initial data load
    initialize_table();
});