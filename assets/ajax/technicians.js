$(document).ready(function() {
  // Initialize DataTable
  all_data();

  // Initialize Select2 for branch field if it exists
  if ($('.branch-select').length > 0) {
    $('.branch-select').select2({
      width: '100%',
      theme: 'bootstrap4',
      placeholder: 'Select branches',
      allowClear: true,
      dropdownParent: $('#edit_data')
    });
  }

  // Initialize Select2 for any other select2 fields
  $('.select2').not('.branch-select').each(function() {
    if (!$(this).hasClass('select2-hidden-accessible')) {
      $(this).select2({
        width: '100%',
        theme: 'bootstrap4',
        allowClear: true
      });
    }
  });
});

function all_data(){

    if ( $.fn.dataTable.isDataTable('#all_data') ) {
      $('#all_data').DataTable().destroy();
    }

	var base_url = $(".base_url").val();
    var dataTable = $('#all_data').DataTable({
        "bSortCellsTop": true,
        "processing": true, //Feature control the processing indicator.
        ajax: {
            url: base_url+'technicians/all_data_ajax', // URL to your PHP script for fetching data
            type: 'POST'
        },
        columns: [
            { data: 0 },
            { data: 1 },
            { data: 2 },
            { data: 3 },
            { data: 4 },
            { data: 5 },
            // Add more columns as needed
        ],
    });

  }

$("#submit_data").on('submit',function(e){
  e.preventDefault();
  var $btn = $(this).find('button[type=submit]');
  $btn.prop('disabled', true);
  var action = $(this).attr('action');
  var data = $(this).serialize();
  $.ajax({
      url:action,
      type:'post',
      data:data,
      success:function(res){
        const obj = JSON.parse(res);
        if(obj['status'] =='success'){
          all_data();
          // Show success message with toastr or simple alert
          showMessage(obj['message'], 'success');
          reset();
          $('#edit_data').modal('hide');
        }else{
          // Show error message
          showMessage(obj['message'], 'error');
        }
        $btn.prop('disabled', false);
      },
      error: function() {
        showMessage('An error occurred. Please try again.', 'error');
        $btn.prop('disabled', false);
      }
    });
});
    

function del(id){
  var base_url = $(".base_url").val();
  var conf = confirm('Are you sure you want to delete?');
  if(conf){
    $.ajax({
      url:base_url+'technicians/delete',
      type:'post',
      data:{'id':id},
      success:function(res){
        all_data();
        showMessage(res, 'success');
      },
      error: function() {
        showMessage('Failed to delete. Please try again.', 'error');
      }
    });
  }
}


function edit(id){
  var base_url = $(".base_url").val();
  $('input').prop('checked', false);
  $.ajax({
    url: base_url + 'technicians/edit',
    type: 'post',
    data: {'id': id},
    success: function(res){
      const obj = JSON.parse(res);
      $('.id').val(obj[0]['id']);
      $('.name').val(obj[0]['name']);
      $('.email').val(obj[0]['email']);
      $('.phone').val(obj[0]['phone']);
      $('.username').val(obj[0]['username']);
      $('.address').val(obj[0]['address']);
      $('.dob').val(obj[0]['dob']);
      // Branch field
      if ($('.branch-select').length > 0) {
        let branchData = obj[0]['branch'] ? obj[0]['branch'].toString() : '';
        if(branchData.includes('--')) {
          const branchArray = branchData.split("--").filter(item => item !== '' && item.trim() !== '');
          $('.branch-select').val(branchArray).trigger('change');
        } else if(branchData !== '') {
          $('.branch-select').val([branchData]).trigger('change');
        } else {
          $('.branch-select').val(null).trigger('change');
        }
      }
      // Permissions
      let text = obj[0]['permission'];
      const myArray = text.split("--");
      for (var i = 0; i < myArray.length; i++) {
        $('#'+myArray[i]).prop('checked', true);
      }
    }
  });
}

function view(id){
  var base_url = $(".base_url").val();
  //$('.branch').val(null).trigger('change');
    $.ajax({
      url:base_url+'technicians/view',
      type:'post',
      data:{'id':id},
      success:function(res){
        $('.view_table').html(res);
      }
    });  
}

function reset() {
  $("#submit_data")[0].reset();
  $(".id").val("");
  $('input').prop('checked', false);
  if ($('.branch-select').length > 0) {
    $('.branch-select').val(null).trigger('change');
  }
}

// Message display function
function showMessage(message, type) {
  // Create a simple custom notification
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
    'box-shadow': '0 2px 8px rgba(0,0,0,0.2)'
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

// Debug function to test branch data
function debugBranchData(id) {
  var base_url = $(".base_url").val();
  $.ajax({
    url: base_url + 'technicians/edit',
    type: 'post',
    data: {'id': id},
    success: function(res) {
      const obj = JSON.parse(res);
      console.log('Full response object:', obj);
      console.log('Branch field value:', obj[0]['branch']);
      console.log('Type of branch field:', typeof obj[0]['branch']);
      
      if (obj[0]['branch'] && obj[0]['branch'].includes('--')) {
        const branches = obj[0]['branch'].split('--');
        console.log('Split branches:', branches);
      }
    }
  });
}

// Utility function to properly clean Select2 without breaking functionality
function cleanSelect2(selector) {
  $(selector).each(function() {
    // Only destroy if it's actually a Select2 instance
    if ($(this).hasClass('select2-hidden-accessible')) {
      $(this).select2('destroy');
    }
    
    // Remove orphaned containers, but be careful not to remove active ones
    $(this).siblings('.select2-container').remove();
    
    // Ensure the original select is visible
    $(this).show();
  });
}

// Utility function to reinitialize Select2 properly
function initSelect2(selector, options = {}) {
  const defaultOptions = {
    width: '100%',
    minimumResultsForSearch: 0,
    theme: 'bootstrap4',
    allowClear: true
  };
  
  const finalOptions = $.extend({}, defaultOptions, options);
  
  $(selector).each(function() {
    // Only initialize if not already initialized
    if (!$(this).hasClass('select2-hidden-accessible')) {
      // Set dropdownParent for modals
      if ($(this).closest('.modal').length > 0) {
        finalOptions.dropdownParent = $(this).closest('.modal');
      }
      
      $(this).select2(finalOptions);
    }
  });
}

// Handle modal events more carefully
$('#edit_data').on('shown.bs.modal', function (e) {
  console.log('Modal shown event triggered');
  console.log('Branch field exists in modal:', $('.branch', this).length > 0);
  
  // Initialize branch field specifically (only if it exists)
  if ($('.branch').length > 0) {
    console.log('Initializing branch field in modal...');
    handleBranchField(null);
  } else {
    console.log('No branch field found in modal');
  }
  
  // Initialize other Select2 fields if any
  $('.select2:not(.branch)', this).each(function() {
    if (!$(this).hasClass('select2-hidden-accessible')) {
      initSelect2($(this));
    }
  });
});

// Additional cleanup to remove any orphaned Select2 elements
function removeOrphanedSelect2Elements() {
  // Remove any Select2 containers that don't have a corresponding select element
  $('.select2-container').each(function() {
    const selectId = $(this).attr('id');
    if (selectId) {
      const originalSelectId = selectId.replace('select2-', '').replace('-container', '');
      if ($('#' + originalSelectId).length === 0) {
        $(this).remove();
      }
    }
  });
  
  // Remove any duplicate Select2 containers
  $('.select2-container').each(function() {
    const $this = $(this);
    $('.select2-container').not($this).each(function() {
      if ($(this).attr('id') === $this.attr('id')) {
        $(this).remove();
      }
    });
  });
}

// Call cleanup function periodically to prevent buildup
setInterval(removeOrphanedSelect2Elements, 5000);

// Function to handle branch field specifically (only if it exists)
function handleBranchField(branchData = null) {
  const $branchField = $('.branch');
  
  // Check if branch field exists (only for admin users)
  if ($branchField.length === 0) {
    console.log('Branch field not found - user may not have permission to manage branches');
    return;
  }
  
  // Ensure the field is visible and properly initialized
  if (!$branchField.hasClass('select2-hidden-accessible')) {
    $branchField.select2({
      width: '100%',
      minimumResultsForSearch: 0,
      theme: 'bootstrap4',
      allowClear: true,
      placeholder: 'Select branches',
      dropdownParent: $branchField.closest('.modal').length ? $branchField.closest('.modal') : $(document.body)
    });
  }
  
  // Set the branch data if provided
  if (branchData) {
    if (branchData.includes('--')) {
      // Multiple branches
      const branchArray = branchData.split("--").filter(item => item !== "" && item.trim() !== "");
      $branchField.val(branchArray).trigger('change');
    } else {
      // Single branch
      $branchField.val([branchData]).trigger('change');
    }
  } else {
    // Clear selection
    $branchField.val(null).trigger('change');
  }
}