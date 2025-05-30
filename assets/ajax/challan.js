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
              url: base_url+'challan/all_data_ajax', // URL to your PHP script for fetching data
              type: 'POST'
          },
          columns: [
              { data: 0 },
              { data: 1 },
              { data: 2 },
              { data: 3 },
              { data: 4 },
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
        url:base_url+'challan/delete',
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
        url:base_url+'challan/edit',
        type:'post',
        data:{'id':id},
        success:function(res){
			//console.log(res);
          const obj = JSON.parse(res);
          $('.id').val(obj[0]['id']);
		  $(".branch option[value="+obj[0]['branch']+"]").prop("selected", "selected");
          //$('.branch').val(obj[0]['branch']);
          $('.PSN').val(obj[0]['PSN']);
          $('.challan_no').val(obj[0]['challan_no']);
		  $('.loading_station').val(obj[0]['loading_station']);
		  $('.distance').val(obj[0]['distance']);
		  $('.truck_no').val(obj[0]['truck_no']);
		  $('.delivery_station').val(obj[0]['delivery_station']);
		  $('.transit_days').val(obj[0]['transit_days']);
		  $('.vehicle_no').val(obj[0]['vehicle_no']);
		  $('.vehicle_type').val(obj[0]['vehicle_type']);
		  $('.cn_no_r1').val(obj[0]['cn_no_r1']);
		  $('.cn_date_r1').val(obj[0]['cn_date_r1']);
		  $('.cn_destination_r1').val(obj[0]['cn_destination_r1']);
		  $('.nature_of_goods_r1').val(obj[0]['nature_of_goods_r1']);
		  $('.value_of_goods_r1').val(obj[0]['value_of_goods_r1']);
		  $('.no_of_pkgs_r1').val(obj[0]['no_of_pkgs_r1']);
		  $('.desp_weight_r1').val(obj[0]['desp_weight_r1']);
		  $('.exp_del_date_r1').val(obj[0]['exp_del_date_r1']);
		  $('.cn_no_r2').val(obj[0]['cn_no_r2']);
		  $('.cn_date_r2').val(obj[0]['cn_date_r2']);
		  $('.cn_destination_r2').val(obj[0]['cn_destination_r2']);
		  $('.nature_of_goods_r2').val(obj[0]['nature_of_goods_r2']);
		  $('.value_of_goods_r2').val(obj[0]['value_of_goods_r2']);
		  $('.no_of_pkgs_r2').val(obj[0]['no_of_pkgs_r2']);
		  $('.desp_weight_r2').val(obj[0]['desp_weight_r2']);
		  $('.exp_del_date_r2').val(obj[0]['exp_del_date_r2']);
		  $('.lorry_hire').val(obj[0]['lorry_hire']);
		  $('.loading_labour').val(obj[0]['loading_labour']);
		  $('.loading_deten').val(obj[0]['loading_deten']);
		  $('.other').val(obj[0]['other']);
		  $('.tds_amount').val(obj[0]['tds_amount']);
		  $('.total').val(obj[0]['total']);
		  $('.advance').val(obj[0]['advance']);
		  $('.balance').val(obj[0]['balance']);
		  $('.charge_Wt').val(obj[0]['charge_Wt']);
		  $('.total_amount_after_tds').val(obj[0]['total_amount_after_tds']);
		  $('.late_delivery_penality').val(obj[0]['late_delivery_penality']);
		  $('.late_receiving_submission_penality').val(obj[0]['late_receiving_submission_penality']);
		  $('.delivery_incharge_contact_no').val(obj[0]['delivery_incharge_contact_no']);
		  $('.balance_at_branch_phone').val(obj[0]['balance_at_branch_phone']);
		  $('.truck_supplier_details').val(obj[0]['truck_supplier_details']);
		  $('.current_lorry_owner_details').val(obj[0]['current_lorry_owner_details']);
		  $('.loading_supervisor_details').val(obj[0]['loading_supervisor_details']);
		  $('.emp_code').val(obj[0]['emp_code']);
		  $('.lorry_driver_details_name').val(obj[0]['lorry_driver_details_name']);
		  $('.lorry_driver_details_license_no').val(obj[0]['lorry_driver_details_license_no']);
		  $('.lorry_driver_details_mobile_no').val(obj[0]['lorry_driver_details_mobile_no']);
        }
      }); 
  }