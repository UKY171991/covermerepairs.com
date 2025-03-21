
$(document).ready(function() {
  all_data();
 });

  function all_data(){

    if ( $.fn.dataTable.isDataTable('#all_data') ) {
      $('#all_data').DataTable().destroy();
    }

	var base_url = $(".base_url").val();
       var dataTable = $('#all_data').DataTable({
         
          processing: true,
          serverSide: true,
            ajax: {
                url: base_url+'part/all_model_ajax', // URL to your PHP script for fetching data
                type: 'POST'
            },
            columns: [
                { data: 0 },
                { data: 1 },
                { data: 2 },
                { data: 3 },
                { data: 4 },
                // Add more columns as needed
            ]
        });
        //  Add individual column search inputs
    $('#all_data thead tr').clone(true).appendTo('#all_data thead');
    $('#all_data thead tr:eq(1) th').each(function(i) {
        var title = $(this).text();
        $(this).html('<input type="text" placeholder="Search ' + title + '" />');

        $('input', this).on('keyup change', function() {
          console.log(this.value);
            if (dataTable.column(i).search() !== this.value) {
                dataTable.column(i).search(this.value).draw();
            }
        });
    });
    
    }


$("#submit_data").on('submit',function(e){
  e.preventDefault();
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
        
      }
    });
});
    

function del(id){
  var base_url = $(".base_url").val();
  var conf = confirm('Arey sure  you want to  delete ?');
  if(conf){
    $.ajax({
      url:base_url+'part/delete_model',
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
      url:base_url+'part/edit_model',
      type:'post',
      data:{'id':id},
      success:function(res){
        const obj = JSON.parse(res);
        $('.id').val(obj[0]['id']);
        $('.name').val(obj[0]['name']);
        $(".brand_id option[value="+obj[0]['brand_id']+"]").prop("selected", "selected");
       
      }
    }); 
}

function reset(){
  $("#submit_data")[0].reset();
}
