<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Payment extends CI_Controller {
	public function __construct() { 
	  parent::__construct();
	  date_default_timezone_set('NZ');
	  $this->load->model('payment_model','payment');
	  
	  $permission = explode("--",$_SESSION['permission']);
	  $segment1 = $this->uri->segment(1);
	  if(!in_array($segment1,$permission)){
		  // permission not allow
		  redirect(base_url('login')); 
	  }
	}
	
	public function index()
	{
		$data['branch'] = $this->payment->all_data('branch','DESC');
		$data['ajax']='payment';
		$this->load->view('inc/header');
		$this->load->view('payment/all',$data);
		$this->load->view('inc/footer');
	}

	public function add_data(){

		if($this->input->post()){

			$prem['branch'] = $this->input->post('branch');
			$prem['PSN'] = $this->input->post('PSN');
			$prem['challan_no'] = $this->input->post('challan_no');
			$prem['loading_station'] = $this->input->post('loading_station');
			$prem['distance'] = $this->input->post('distance');
			$prem['truck_no'] = $this->input->post('truck_no');
			$prem['delivery_station'] = $this->input->post('delivery_station');
			$prem['transit_days'] = $this->input->post('transit_days');
			$prem['vehicle_no'] = $this->input->post('vehicle_no');
			$prem['vehicle_type'] = $this->input->post('vehicle_type');
			$prem['cn_no_r1'] = $this->input->post('cn_no_r1');
			$prem['cn_date_r1'] = $this->input->post('cn_date_r1');
			$prem['cn_destination_r1'] = $this->input->post('cn_destination_r1');
			$prem['nature_of_goods_r1'] = $this->input->post('nature_of_goods_r1');
			$prem['value_of_goods_r1'] = $this->input->post('value_of_goods_r1');
			$prem['no_of_pkgs_r1'] = $this->input->post('no_of_pkgs_r1');
			$prem['desp_weight_r1'] = $this->input->post('desp_weight_r1');
			$prem['exp_del_date_r1'] = $this->input->post('exp_del_date_r1');
			$prem['cn_no_r2'] = $this->input->post('cn_no_r2');
			$prem['cn_date_r2'] = $this->input->post('cn_date_r2');
			$prem['cn_destination_r2'] = $this->input->post('cn_destination_r2');
			$prem['nature_of_goods_r2'] = $this->input->post('nature_of_goods_r2');
			$prem['value_of_goods_r2'] = $this->input->post('value_of_goods_r2');
			$prem['no_of_pkgs_r2'] = $this->input->post('no_of_pkgs_r2');
			$prem['desp_weight_r2'] = $this->input->post('desp_weight_r2');
			$prem['exp_del_date_r2'] = $this->input->post('exp_del_date_r2');
			$prem['lorry_hire'] = $this->input->post('lorry_hire');
			$prem['loading_labour'] = $this->input->post('loading_labour');
			$prem['loading_deten'] = $this->input->post('loading_deten');
			$prem['other'] = $this->input->post('other');
			$prem['tds_amount'] = $this->input->post('tds_amount');
			$prem['total'] = $this->input->post('total');
			$prem['advance'] = $this->input->post('advance');
			$prem['balance'] = $this->input->post('balance');
			$prem['charge_Wt'] = $this->input->post('charge_Wt');
			$prem['total_amount_after_tds'] = $this->input->post('total_amount_after_tds');
			$prem['late_delivery_penality'] = $this->input->post('late_delivery_penality');
			$prem['late_receiving_submission_penality'] = $this->input->post('late_receiving_submission_penality');
			$prem['delivery_incharge_contact_no'] = $this->input->post('delivery_incharge_contact_no');
			$prem['balance_at_branch_phone'] = $this->input->post('balance_at_branch_phone');
			$prem['truck_supplier_details'] = $this->input->post('truck_supplier_details');
			$prem['current_lorry_owner_details'] = $this->input->post('current_lorry_owner_details');
			$prem['loading_supervisor_details'] = $this->input->post('loading_supervisor_details');
			$prem['emp_code'] = $this->input->post('emp_code');
			$prem['lorry_driver_details_name'] = $this->input->post('lorry_driver_details_name');
			$prem['lorry_driver_details_license_no'] = $this->input->post('lorry_driver_details_license_no');
			$prem['lorry_driver_details_mobile_no'] = $this->input->post('lorry_driver_details_mobile_no');
			$prem['added_by'] = $this->session->userdata('user_id');

			$id = $this->input->post('id');
			if($id !=''){
				$this->payment->update('payment',$prem,$id);
				$mes=array('status'=>"success",'message'=>'Payment updated succefully.');
				echo json_encode($mes);
				exit();
			}else{
				$last_id = $this->payment->insert('payment',$prem);
				$mes=array('status'=>"success",'message'=>'Payment added succefully.');
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
		$all_data = $this->payment->all_data('payment','DESC',$wher);

		
		$i =1;
		$data = array();
		foreach($all_data as $key => $all_datas){
			$row = array(); 


			
				$action = "<button data-toggle='modal' data-target='#edit_data' onclick='return edit(".$all_datas->id.")' class='btn btn-info btn-xs m-1'><i class='fas fa-pencil-alt'></i></button>";
				$action .= "<a href='".base_url('payment/print/'.$all_datas->id)."' target='_blank' class='btn btn-primary btn-xs m-1'><i class='fa fa-print' aria-hidden='true'></i></a>";
				$action .= "<button href='' onclick='return del(".$all_datas->id.")' class='btn btn-danger btn-xs m-1'><i class='fa fa-trash' aria-hidden='true'></i></button>";

			
			
			$branch = $all_datas->branch;

			$wher = array('id'=>$branch);
			$branch_data = $this->payment->all_data('branch','DESC',$wher);
			
			if(count($branch_data) != 0){ $branchs = $branch_data[0]->name; }else{ $branchs = ''; }
			//print_r($branch_data[0]->name); die;
		
			$row[] =  $i++;
			$row[] =  $branchs;
			$row[] =  $all_datas->PSN;
			$row[] =  $all_datas->challan_no;
			$row[] =  $action;
			$data[] = $row;
		}


		// filter_count_all
		$output = array(
                   // "draw" 				=> intval($_POST['draw']),
                    "recordsTotal" 		=> $this->payment->count_all('payment','DESC',$wher),
                    "recordsFiltered" 	=> $this->payment->count_all('payment','DESC',$wher),
                    "data" 				=> $data,
            	);
   
    echo json_encode($output);

	//	echo json_encode(array('data' => $data));
	}

	public function delete(){
		$id = $this->input->post('id');
		$this->payment->delete('payment',$id);
		echo "Payment deleted succefully.";
		exit();
	}
	public function edit(){
		$id = $this->input->post('id');

		$wher = array('id'=>$id);
		$all_data = $this->payment->all_data('payment','DESC',$wher);
		echo json_encode($all_data);
	}
	
	public function print($id){
		$data['ajax']='none';
		$wher = array('id'=>$id);
		$data['payment'] = $this->payment->all_data('payment','DESC',$wher);

		$this->load->view('inc/header');
		$this->load->view('payment/print',$data);
		$this->load->view('inc/footer');
	}
}
