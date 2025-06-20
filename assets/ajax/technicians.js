$(document).ready(function() {
  all_data();
 });


$(document).ready(function() {
    // Initialize Select2
    $('.select2').select2();
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
          // Destroy existing Select2 and reinitialize
          if ($('.branch').hasClass('select2-hidden-accessible')) {
            $('.branch').select2('destroy');
          }
          
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
          } else {
            // No branch data - clear selection
            $('.branch').val(null);
          }
          
          // Reinitialize Select2 after setting values
          $('.branch').select2({
            width: '100%',
            minimumResultsForSearch: 0,
            dropdownParent: $('.branch').closest('.modal')
          });
        }, 100); // Small delay to ensure modal is ready
		
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
  
  // Properly reset Select2 multiple selection
  $('.select2').val(null).trigger('change');
  
  // Ensure Select2 is properly initialized
  $('.select2').each(function() {
    if (!$(this).hasClass('select2-hidden-accessible')) {
      $(this).select2({
        width: '100%',
        minimumResultsForSearch: 0,
        dropdownParent: $(this).closest('.modal').length ? $(this).closest('.modal') : $(document.body)
      });
    }
  });
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