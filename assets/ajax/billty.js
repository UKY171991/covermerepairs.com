
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
              url: base_url+'billty/all_data_ajax', // URL to your PHP script for fetching data
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
          
        }
      });
  });
      
  
  function del(id){
    var base_url = $(".base_url").val();
    var conf = confirm('Arey sure  you want to  delete ?');
    if(conf){
      $.ajax({
        url:base_url+'billty/delete',
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
        url:base_url+'billty/edit',
        type:'post',
        data:{'id':id},
        success:function(res){
			//console.log(res);
			
		  const obj = JSON.parse(res);
          $('.id').val(obj[0]['id']);
		  $(".branch option[value="+obj[0]['branch']+"]").prop("selected", "selected");
          //$('.branch').val(obj[0]['branch']);
          $('.PSN').val(obj[0]['PSN']);
          $('.consignment_no').val(obj[0]['consignment_no']);
		  $('.consignment_date').val(obj[0]['consignment_date']);
		  $('.CIN').val(obj[0]['CIN']);
		  $('.PAN').val(obj[0]['PAN']);
		  $('.work_order_details_WO_No').val(obj[0]['work_order_details_WO_No']);
		  $('.work_order_details_date').val(obj[0]['work_order_details_date']);
		  $('.work_order_details_SAP_delivery_no').val(obj[0]['work_order_details_SAP_delivery_no']);
		  $('.work_order_details_loading_station').val(obj[0]['work_order_details_loading_station']);
		  $('.work_order_details_distance').val(obj[0]['work_order_details_distance']);
		  $('.work_order_details_vehicle_no').val(obj[0]['work_order_details_vehicle_no']);
		  $('.work_order_details_delivery_station').val(obj[0]['work_order_details_delivery_station']);
		  $('.work_order_details_transit_days').val(obj[0]['work_order_details_transit_days']);
		  $('.work_order_details_load_type').val(obj[0]['work_order_details_load_type']);
		  $('.consignor_details_name').val(obj[0]['consignor_details_name']);
		  $('.consignor_details_address').val(obj[0]['consignor_details_address']);
		  $('.consignor_details_GSTIN').val(obj[0]['consignor_details_GSTIN']);
		  $('.consignor_details_designtiaon').val(obj[0]['consignor_details_designtiaon']);
		  $('.consignee_details_name').val(obj[0]['consignee_details_name']);
		  $('.consignee_details_address').val(obj[0]['consignee_details_address']);
		  $('.consignee_details_GSTIN').val(obj[0]['consignee_details_GSTIN']);
		  $('.sold_to_contain_product').val(obj[0]['sold_to_contain_product']);
		  $('.sold_to_contain_no_of_pkg').val(obj[0]['sold_to_contain_no_of_pkg']);
		  $('.sold_to_contain_packing').val(obj[0]['sold_to_contain_packing']);
		  $('.sold_to_contain_value_of_goods').val(obj[0]['sold_to_contain_value_of_goods']);
		  $('.weight_in_MT_net').val(obj[0]['weight_in_MT_net']);
		  $('.weight_in_MT_weight').val(obj[0]['weight_in_MT_weight']);
		  $('.weight_in_MT_minimum_gurantee_weight').val(obj[0]['weight_in_MT_minimum_gurantee_weight']);
		  $('.freight_charge_amount_freight').val(obj[0]['freight_charge_amount_freight']);
		  $('.freight_charge_amount_rate_PMT').val(obj[0]['freight_charge_amount_rate_PMT']);
		  $('.freight_charge_amount_advance').val(obj[0]['freight_charge_amount_advance']);
		  $('.freight_charge_amount_balance').val(obj[0]['freight_charge_amount_balance']);
		  $('.party_document_details_document_type').val(obj[0]['party_document_details_document_type']);
		  $('.party_document_details_document_no').val(obj[0]['party_document_details_document_no']);
		  $('.party_document_details_document_date').val(obj[0]['party_document_details_document_date']);
		  $('.party_document_details_invoice_no').val(obj[0]['party_document_details_invoice_no']);
		  $('.basis_of_booking').val(obj[0]['basis_of_booking']);
		  $('.branch_to_pay').val(obj[0]['branch_to_pay']);
		  $('.branch_paid').val(obj[0]['branch_paid']);
		  $('.transit_insurance_by_carrier').val(obj[0]['transit_insurance_by_carrier']);
		  $('.transit_insurance_by_customer').val(obj[0]['transit_insurance_by_customer']);
		  $('.name_of_insurance_company').val(obj[0]['name_of_insurance_company']);
		  $('.policy_no').val(obj[0]['policy_no']);
		  $('.policy_date').val(obj[0]['policy_date']);
		  $('.any_remarks').val(obj[0]['any_remarks']);
		  $('.government_by_consignor').val(obj[0]['government_by_consignor']);
		  $('.government_by_consignee').val(obj[0]['government_by_consignee']);
		  $('.government_by_GTA').val(obj[0]['government_by_GTA']);
		  $('.government_by_exempt').val(obj[0]['government_by_exempt']);
		  $('.reporng_date_time').val(obj[0]['reporng_date_time']);
		  $('.releasing_date_time').val(obj[0]['releasing_date_time']);
		  $('.reason_for_detention').val(obj[0]['reason_for_detention']);
		  $('.loading_supervisor_details_name').val(obj[0]['loading_supervisor_details_name']);
		  $('.loading_supervisor_details_employee_code').val(obj[0]['loading_supervisor_details_employee_code']);
		  
          
        }
      }); 
  }