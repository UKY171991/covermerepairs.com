<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Billty extends CI_Controller {
	public function __construct() { 
	  parent::__construct();
	  date_default_timezone_set('NZ');
	  $this->load->model('billty_model','billty');
	  
	  $permission = explode("--",$_SESSION['permission']);
	  $segment1 = $this->uri->segment(1);
	  if(!in_array($segment1,$permission)){
		  // permission not allow
		  redirect(base_url('login'));
	  }
	}
	
	public function index()
	{
		$data['branch'] = $this->billty->all_data('branch','DESC');
		$data['ajax']='billty';
		$this->load->view('inc/header');
		$this->load->view('billty/all',$data);
		$this->load->view('inc/footer');
	}
	
	
	
	public function add_data(){

		if($this->input->post()){

			$prem['branch'] = $this->input->post('branch');
			$prem['PSN'] = $this->input->post('PSN');
			$prem['consignment_no'] = $this->input->post('consignment_no');
			$prem['consignment_date'] = $this->input->post('consignment_date');
			$prem['CIN'] = $this->input->post('CIN');
			$prem['PAN'] = $this->input->post('PAN');
			$prem['work_order_details_WO_No'] = $this->input->post('work_order_details_WO_No');
			$prem['work_order_details_date'] = $this->input->post('work_order_details_date');
			$prem['work_order_details_SAP_delivery_no'] = $this->input->post('work_order_details_SAP_delivery_no');
			$prem['work_order_details_loading_station'] = $this->input->post('work_order_details_loading_station');
			$prem['work_order_details_distance'] = $this->input->post('work_order_details_distance');
			$prem['work_order_details_vehicle_no'] = $this->input->post('work_order_details_vehicle_no');
			$prem['work_order_details_delivery_station'] = $this->input->post('work_order_details_delivery_station');
			$prem['work_order_details_transit_days'] = $this->input->post('work_order_details_transit_days');
			$prem['work_order_details_load_type'] = $this->input->post('work_order_details_load_type');
			$prem['consignor_details_name'] = $this->input->post('consignor_details_name');
			$prem['consignor_details_address'] = $this->input->post('consignor_details_address');
			$prem['consignor_details_GSTIN'] = $this->input->post('consignor_details_GSTIN');
			$prem['consignor_details_designtiaon'] = $this->input->post('consignor_details_designtiaon');
			$prem['consignee_details_name'] = $this->input->post('consignee_details_name');
			$prem['consignee_details_address'] = $this->input->post('consignee_details_address');
			$prem['consignee_details_GSTIN'] = $this->input->post('consignee_details_GSTIN');
			$prem['sold_to_contain_product'] = $this->input->post('sold_to_contain_product');
			$prem['sold_to_contain_no_of_pkg'] = $this->input->post('sold_to_contain_no_of_pkg');
			$prem['sold_to_contain_packing'] = $this->input->post('sold_to_contain_packing');
			$prem['sold_to_contain_value_of_goods'] = $this->input->post('sold_to_contain_value_of_goods');
			$prem['weight_in_MT_net'] = $this->input->post('weight_in_MT_net');
			$prem['weight_in_MT_weight'] = $this->input->post('weight_in_MT_weight');
			$prem['weight_in_MT_minimum_gurantee_weight'] = $this->input->post('weight_in_MT_minimum_gurantee_weight');
			$prem['freight_charge_amount_freight'] = $this->input->post('freight_charge_amount_freight');
			$prem['freight_charge_amount_rate_PMT'] = $this->input->post('freight_charge_amount_rate_PMT');
			$prem['freight_charge_amount_advance'] = $this->input->post('freight_charge_amount_advance');
			$prem['freight_charge_amount_balance'] = $this->input->post('freight_charge_amount_balance');
			$prem['party_document_details_document_type'] = $this->input->post('party_document_details_document_type');
			$prem['party_document_details_document_no'] = $this->input->post('party_document_details_document_no');
			$prem['party_document_details_document_date'] = $this->input->post('party_document_details_document_date');
			$prem['party_document_details_invoice_no'] = $this->input->post('party_document_details_invoice_no');
			$prem['basis_of_booking'] = $this->input->post('basis_of_booking');
			$prem['branch_to_pay'] = $this->input->post('branch_to_pay');
			$prem['branch_paid'] = $this->input->post('branch_paid');
			$prem['transit_insurance_by_carrier'] = $this->input->post('transit_insurance_by_carrier');
			$prem['transit_insurance_by_customer'] = $this->input->post('transit_insurance_by_customer');
			$prem['name_of_insurance_company'] = $this->input->post('name_of_insurance_company');
			$prem['policy_no'] = $this->input->post('policy_no');
			$prem['policy_date'] = $this->input->post('policy_date');
			$prem['any_remarks'] = $this->input->post('any_remarks');
			$prem['government_by_consignor'] = $this->input->post('government_by_consignor');
			$prem['government_by_consignee'] = $this->input->post('government_by_consignee');
			$prem['government_by_GTA'] = $this->input->post('government_by_GTA');
			$prem['government_by_exempt'] = $this->input->post('government_by_exempt');
			$prem['reporng_date_time'] = $this->input->post('reporng_date_time');
			$prem['releasing_date_time'] = $this->input->post('releasing_date_time');
			$prem['reason_for_detention'] = $this->input->post('reason_for_detention');
			$prem['loading_supervisor_details_name'] = $this->input->post('loading_supervisor_details_name');
			$prem['loading_supervisor_details_employee_code'] = $this->input->post('loading_supervisor_details_employee_code');
			$prem['added_by'] = $this->session->userdata('user_id');

			$id = $this->input->post('id');
			if($id !=''){
				$this->billty->update('billty',$prem,$id);
				$mes=array('status'=>"success",'message'=>'Billty updated succefully.');
				echo json_encode($mes);
				exit();
			}else{
				$last_id = $this->billty->insert('billty',$prem);
				$mes=array('status'=>"success",'message'=>'Billty added succefully.');
				echo json_encode($mes);
				exit();
			}

		} 
		
	}
	
	
	
	

	public function all_data_ajax(){
	    
	    
        if($_SESSION['user_type'] != 1){
            $wher = array('added_by'=>$_SESSION['user_id']);
        }else{
            $wher = '';
        }
		$all_data = $this->billty->all_data('billty','DESC',$wher);

		
		$i =1;
		$data = array();
		foreach($all_data as $key => $all_datas){
			$row = array(); 


			
				$action = "<button data-toggle='modal' data-target='#edit_data' onclick='return edit(".$all_datas->id.")' class='btn btn-info btn-xs m-1'><i class='fas fa-pencil-alt'></i></button>";
				$action .= "<a href='".base_url('billty/print/'.$all_datas->id)."' target='_blank' class='btn btn-primary btn-xs m-1'><i class='fa fa-print' aria-hidden='true'></i></a>";
				$action .= "<button href='' onclick='return del(".$all_datas->id.")' class='btn btn-danger btn-xs m-1'><i class='fa fa-trash' aria-hidden='true'></i></button>";

			
			
			$branch = $all_datas->branch;

			$wher = array('id'=>$branch);
			$branch_data = $this->billty->all_data('branch','DESC',$wher);
			
			if(count($branch_data) != 0){ $branchs = $branch_data[0]->name; }else{ $branchs = ''; }
			//print_r($branch_data[0]->name); die;
		
			$row[] =  $i++;
			$row[] =  $branchs;
			$row[] =  $all_datas->PSN;
			$row[] =  $all_datas->consignment_no;
			$row[] =  $action;
			$data[] = $row;
		}


		// filter_count_all
		$output = array(
                   // "draw" 				=> intval($_POST['draw']),
                    "recordsTotal" 		=> $this->billty->count_all('billty','DESC',$wher),
                    "recordsFiltered" 	=> $this->billty->count_all('billty','DESC',$wher),
                    "data" 				=> $data,
            	);
   
    echo json_encode($output);

	//	echo json_encode(array('data' => $data));
	}

	public function delete(){
		$id = $this->input->post('id');
		$this->billty->delete('billty',$id);
		echo "Billty deleted succefully.";
		exit();
	}
	public function edit(){
		$id = $this->input->post('id');

		$wher = array('id'=>$id);
		$all_data = $this->billty->all_data('billty','DESC',$wher);
		echo json_encode($all_data);
	}
	
	public function print($id){
		$data['ajax']='none';
		$wher = array('id'=>$id);
		$data['billty'] = $this->billty->all_data('billty','DESC',$wher);

		$this->load->view('inc/header');
		$this->load->view('billty/print',$data);
		$this->load->view('inc/footer');
	}
}
