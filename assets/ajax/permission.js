$(document).ready(function() {
    all_data();
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
              url: base_url+'permission/all_data_ajax', // URL to your PHP script for fetching data
              type: 'POST'
          },
          columns: [
              { data: 0 },
              { data: 1 },
              { data: 2 },
              { data: 3 },
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
        url:base_url+'permission/delete',
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
        url:base_url+'permission/edit',
        type:'post',
        data:{'id':id},
        success:function(res){
          const obj = JSON.parse(res);
          $('.id').val(obj[0]['id']);
          $('.name').val(obj[0]['name']);
          $('.slug').val(obj[0]['slug']);
        }
      }); 
  }