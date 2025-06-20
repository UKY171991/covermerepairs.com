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
          alert(obj['message']);
          reset();
        }else{
          alert(obj['message']);
        }
        $btn.prop('disabled', false);
      },
      error: function() {
        $btn.prop('disabled', false);
      }
    });
});
    

function del(id){
  var base_url = $(".base_url").val();
  var conf = confirm('Arey sure  you want to  delete ?');
  if(conf){
    $.ajax({
      url:base_url+'technicians/delete',
      type:'post',
      data:{'id':id},
      success:function(res){
        all_data();
        alert(res);
        
      }
    });
  }
  
}


function edit(id){
  var base_url = $(".base_url").val();
  $('input').prop('checked', false);
  
  // Reinitialize Select2 if needed
  if (!$('.branch').hasClass('select2-hidden-accessible')) {
    $('.branch').select2();
  }
  
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
        if(obj[0]['branch']) {
          let branchData = obj[0]['branch'];
          
          // Clear previous selections first
          $('.branch').val(null).trigger('change');
          
          if(branchData.includes('--')) {
            // Multiple branches - split and set array
            const branchArray = branchData.split("--").filter(function(item) {
              return item !== "";  // Remove empty strings
            });
            $('.branch').val(branchArray).trigger('change');
          } else {
            // Single branch - set as single value
            $('.branch').val([branchData]).trigger('change');
          }
        } else {
          // No branch data - clear selection
          $('.branch').val(null).trigger('change');
        }
		
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
  
  // Reinitialize Select2 if needed
  if (!$('.select2').hasClass('select2-hidden-accessible')) {
    $('.select2').select2();
  }
}