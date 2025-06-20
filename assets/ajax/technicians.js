$(document).ready(function() {
  all_data();
 });

$(document).ready(function() {
    // Initialize Select2 only once on page load
    setTimeout(function() {
      $('.select2').each(function() {
        if (!$(this).hasClass('select2-hidden-accessible')) {
          $(this).select2({
            width: '100%',
            minimumResultsForSearch: 0,
            theme: 'bootstrap4'
          });
        }
      });
    }, 500);
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
      url:base_url+'technicians/edit',
      type:'post',
      data:{'id':id},
      success:function(res){
        const obj = JSON.parse(res);
        $('.id').val(obj[0]['id']);
        $('.name').val(obj[0]['name']);
        $('.email').val(obj[0]['email']);
        $('.phone').val(obj[0]['phone']);
        $('.username').val(obj[0]['username']);
        //$(".type option[value="+obj[0]['type']+"]").prop("selected", "selected");        $('.address').val(obj[0]['address']);
        $('.dob').val(obj[0]['dob']);
        
        // Handle branch selection for multiple branches
        console.log('Branch data from server:', obj[0]['branch']); // Debug log
        
        // Use setTimeout to ensure modal is fully loaded
        setTimeout(function() {
          // Clean up Select2 completely
          cleanSelect2('.branch');
          
          if(obj[0]['branch']) {
            let branchData = obj[0]['branch'].toString();
            
            if(branchData.includes('--')) {
              // Multiple branches - split and set array
              const branchArray = branchData.split("--").filter(function(item) {
                return item !== "" && item.trim() !== "";
              });
              console.log('Multiple branches array:', branchArray); // Debug log
              $('.branch').val(branchArray);
            } else {
              // Single branch - set as single value
              console.log('Single branch:', branchData); // Debug log
              $('.branch').val([branchData]);
            }
          }
          
          // Reinitialize Select2 with proper settings
          initSelect2('.branch');
        }, 300); // Increased delay for stability
		
		let text = obj[0]['permission'];
		const myArray = text.split("--");

		// Loop through the array using a for loop
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
  
  // Clean up all Select2 instances using utility function
  cleanSelect2('.select2');
  
  // Reinitialize all Select2 elements
  setTimeout(function() {
    initSelect2('.select2');
  }, 100);
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

// Utility function to completely clean Select2
function cleanSelect2(selector) {
  $(selector).each(function() {
    // Destroy Select2 if it exists
    if ($(this).hasClass('select2-hidden-accessible')) {
      $(this).select2('destroy');
    }
    
    // Remove any orphaned Select2 containers
    $(this).siblings('.select2-container').remove();
    
    // Show the original select element
    $(this).show();
    
    // Clear any previous values
    $(this).val(null);
  });
}

// Utility function to reinitialize Select2 properly
function initSelect2(selector, options = {}) {
  cleanSelect2(selector);
  
  const defaultOptions = {
    width: '100%',
    minimumResultsForSearch: 0,
    theme: 'bootstrap4',
    dropdownParent: $(selector).closest('.modal').length ? $(selector).closest('.modal') : $(document.body)
  };
  
  const finalOptions = $.extend({}, defaultOptions, options);
  
  $(selector).select2(finalOptions);
}

// Handle modal events to prevent Select2 duplication
$('#edit_data').on('show.bs.modal', function (e) {
  // Clean up any existing Select2 instances when modal opens
  cleanSelect2('.select2');
});

$('#edit_data').on('shown.bs.modal', function (e) {
  // Initialize Select2 after modal is fully shown
  setTimeout(function() {
    initSelect2('.select2');
  }, 100);
});

$('#edit_data').on('hidden.bs.modal', function (e) {
  // Clean up when modal is hidden
  cleanSelect2('.select2');
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