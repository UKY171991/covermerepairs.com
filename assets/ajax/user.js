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
            url: base_url+'users/all_data_ajax', // URL to your PHP script for fetching data
            type: 'POST'
        },
        columns: [
            { data: 0 },
            { data: 1 },
            { data: 2 },
            { data: 3 },
            { data: 4 },
            { data: 5 },
            { data: 6 },
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
          $("#submit_data")[0].reset();
          $(".id").val('');
	  $('input').prop('checked', false);
	  $('.select2').val(null).trigger('change');
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
      url:base_url+'users/delete',
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
  //$('.select2').val(null).trigger('change');
    $.ajax({
      url:base_url+'users/edit',
      type:'post',
      data:{'id':id},
      success:function(res){
        const obj = JSON.parse(res);
        $('.id').val(obj[0]['id']);
        $('.name').val(obj[0]['name']);
        $('.email').val(obj[0]['email']);
        $('.phone').val(obj[0]['phone']);
        $('.username').val(obj[0]['username']);
        $(".type option[value="+obj[0]['type']+"]").prop("selected", "selected");
		
		$('.address').val(obj[0]['address']);
		$('.dob').val(obj[0]['dob']);
        $('.qualification').val(obj[0]['qualification']); 
        $('.location').val(obj[0]['location']);
        $('.standred').val(obj[0]['standred']);
		
		let text = obj[0]['permission'];
		const myArray = text.split("--");

		// Loop through the array using a for loop
		for (var i = 0; i < myArray.length; i++) {
		  $('#'+myArray[i]).prop('checked', true);
		}
		
		
		let standred = obj[0]['standred'];
		const stand = standred.split("--");
		//var selectedValues = ['value1', 'value3'];

		// Iterate through the array and set the selected attribute
		$('.select2 option').each(function() {
		  var optionValue = $(this).val();
		  if ($.inArray(optionValue, stand) !== -1) {
			$(this).prop('selected', true);
		  }
		  $('.select2').select2(); 
		});
		
      }
    }); 
}


function view(id){
  var base_url = $(".base_url").val();
  //$('.branch').val(null).trigger('change');
    $.ajax({
      url:base_url+'users/view',
      type:'post',
      data:{'id':id},
      success:function(res){
        $('.view_table').html(res);
      }
    });  
}