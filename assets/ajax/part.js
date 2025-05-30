$(document).ready(function() { 
  all_data();
 });

  function all_data(){

    if ( $.fn.dataTable.isDataTable('#all_data') ) {
      $('#all_data').DataTable().destroy();
    }

	var base_url = $(".base_url").val();
        $('#all_data').DataTable({
          "bSortCellsTop": true,
          "processing": true, //Feature control the processing indicator.
            ajax: {
                url: base_url+'part/all_data_ajax', // URL to your PHP script for fetching data
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
                { data: 7 },
                { data: 8 },
                // Add more columns as needed
            ]
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
        all_data();
        alert(res);
        $("#submit_data")[0].reset();
        $(".id").val('');
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
      url:base_url+'part/delete',
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
    $.ajax({
      url:base_url+'part/edit',
      type:'post',
      data:{'id':id},
      success:function(res){
        const obj = JSON.parse(res);
        console.log(obj);
        $('.id').val(obj[0]['id']);
        $('.price_max').val(obj[0]['price_max']);
        $('.price_min').val(obj[0]['price_min']);
        $('.stock').val(obj[0]['stock']);
        $(".branch option[value="+obj[0]['branch']+"]").prop("selected", "selected");
        $(".brand option[value="+obj[0]['brand']+"]").prop("selected", "selected");
        load_model();
        $(".model option[value="+obj[0]['model']+"]").prop("selected", "selected");
        $(".type option[value="+obj[0]['type']+"]").prop("selected", "selected");
      }
    }); 
}

$('.brand').on('change',function(){
  var base_url = $(".base_url").val();
  var id = $(this).val();
    $.ajax({
      url:base_url+'part/single_model',
      type:'post',
      data:{'bid':id},
      success:function(res){
        $('.model').html(res);
      }
    }); 
});

function load_model(){
  var base_url = $(".base_url").val();
  var bid = $('.brand').val();
  var id = $('.id').val();
    $.ajax({
      url:base_url+'part/single_model',
      type:'post',
      data:{'bid':bid,'id':id},
      success:function(res){
        $('.model').html(res);
      }
    }); 
}

function reset(){
  $("#submit_data")[0].reset();
}
