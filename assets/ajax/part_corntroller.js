$(document).ready(function() {
    var manageTable;
    var base_url = $('body').data('base_url');

    // Initialize DataTable
    manageTable = $('#manageTable').DataTable({
        'ajax': base_url + 'part_corntroller/get_all_part_corntroller',
        'order': []
    });

    // Initialize Select2
    $('#branch_id').select2({
        width: '100%',
        placeholder: 'Select a Branch'
    });

    // Custom notification function
    function showNotification(color, message) {
        var notification = '<div class="alert alert-' + color + ' alert-dismissible" role="alert">' +
            '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' +
            message +
            '</div>';
        $('#messages').html(notification);
        $('.alert-dismissible').delay(3000).slideUp('slow');
    }

    // Reset modal and form
    function resetModal() {
        $('#modal_form')[0].reset();
        $('.form-group').removeClass('has-error').removeClass('has-success');
        $('.text-danger').remove();
        $('#messages').html('');
        // Reset Select2
        $('#branch_id').val(null).trigger('change');
    }

    // Show modal for adding new
    $('#add_new_btn').on('click', function() {
        resetModal();
        $('#modal_title').text('Add Part Controller');
        $('#modal_form').attr('action', base_url + 'part_corntroller/add');
        $('#password').prop('required', true);
    });

    // Handle form submission (add/edit)
    $('#modal_form').off('submit').on('submit', function(e) {
        e.preventDefault();
        var form = $(this);
        var url = form.attr('action');

        // Clear previous messages
        $('.form-group').removeClass('has-error');
        $('.text-danger').remove();
        $('#messages').html('');

        $.ajax({
            url: url,
            type: 'POST',
            data: form.serialize(),
            dataType: 'json',
            success: function(response) {
                if (response.success === true) {
                    $('#add_modal').modal('hide');
                    manageTable.ajax.reload(null, false);
                    // Use a global notification area if available, or create one
                    showNotification('success', response.messages);
                } else {
                    if (response.messages) {
                         $('#messages').html('<div class="alert alert-danger alert-dismissible" role="alert">' +
                            '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' +
                            response.messages +
                            '</div>');
                    }
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                showNotification('danger', 'An error occurred: ' + textStatus + ' - ' + errorThrown);
            }
        });
    });

    // Handle edit button click
    $(document).on('click', '.edit_btn', function() {
        var id = $(this).data('id');
        resetModal();
        $('#modal_title').text('Edit Part Controller');
        $('#modal_form').attr('action', base_url + 'part_corntroller/edit/' + id);
        $('#password').prop('required', false);

        $.ajax({
            url: base_url + 'part_corntroller/get_part_corntroller_by_id/' + id,
            type: 'GET',
            dataType: 'json',
            success: function(response) {
                if (response) {
                    $('#fname').val(response.fname);
                    $('#lname').val(response.lname);
                    $('#email').val(response.email);
                    $('#phone').val(response.phone);
                    if (response.branch_id) {
                        $('#branch_id').val(response.branch_id).trigger('change');
                    }
                    // The modal is already being triggered by the button's data-target attribute
                    // $('#add_modal').modal('show'); 
                } else {
                    showNotification('danger', 'Could not fetch part controller data.');
                }
            },
            error: function() {
                showNotification('danger', 'Error occurred while fetching data.');
            }
        });
    });

    // Handle delete button click
    $(document).on('click', '.delete_btn', function() {
        var id = $(this).data('id');
        if (confirm("Are you sure you want to delete this part controller?")) {
            $.ajax({
                url: base_url + 'part_corntroller/delete/' + id,
                type: 'POST',
                dataType: 'json',
                success: function(response) {
                    if (response.success === true) {
                        manageTable.ajax.reload(null, false);
                        showNotification('success', response.messages);
                    } else {
                        showNotification('danger', response.messages);
                    }
                },
                error: function() {
                    showNotification('danger', 'Error occurred during deletion.');
                }
            });
        }
    });

    // Reset form when modal is closed
    $('#add_modal').on('hidden.bs.modal', function () {
        resetModal();
    });
});