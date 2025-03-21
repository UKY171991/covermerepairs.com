$(document).ready(function() {
  all_data()
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
                url: base_url+'auditor/all_data_ajax', // URL to your PHP script for fetching data
                type: 'POST'
            },
            columns: [
                { data: 0 },
                { data: 1 },
                { data: 2 },
                { data: 3 },
                { data: 4 },
                { data: 5 },
            ]
        });
  }

$("#submit_data").on('submit',function(e){
  e.preventDefault();
  var action = $(this).attr('action');
  var data = $(this).serialize();
  var base_url = $(".base_url").val();
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
          $('.branch').val(null).trigger('change');
          $(".id").val('');
          //window.location.replace(base_url+'technicians');
        }else{
          alert(obj['message']);
        }
      }
    });
});
    

function del(id){
  var base_url = $(".base_url").val();
  var conf = confirm('Arey sure  you want to  delete ?');
  if(conf){
    $.ajax({
      url:base_url+'auditor/delete',
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
  //$('.branch').val(null).trigger('change');
    $.ajax({
      url:base_url+'auditor/edit',
      type:'post',
      data:{'id':id},
      success:function(res){
        const obj = JSON.parse(res);
        $('.id').val(obj[0]['id']);
        $('.name').val(obj[0]['name']);
        $('.phone').val(obj[0]['phone']);
        $('.email').val(obj[0]['email']);
        $('.address').val(obj[0]['address']);
        $('.dob').val(obj[0]['dob']);
        $('.qualification').val(obj[0]['qualification']); 
        $('.location').val(obj[0]['location']);
        $('.standred').val(obj[0]['standred']);
      }
    });  
}

function view(id){
  var base_url = $(".base_url").val();
  //$('.branch').val(null).trigger('change');
    $.ajax({
      url:base_url+'auditor/view',
      type:'post',
      data:{'id':id},
      success:function(res){
        $('.view_table').html(res);
      }
    });  
}
