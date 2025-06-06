<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Part extends CI_Controller {
	public function __construct() {
	  parent::__construct();
	  date_default_timezone_set('NZ');
	  $this->load->model('part_model','part');
	  $this->load->model('Stock_model', 'stock');
	  $this->load->library('pagination');
	  
	  
	  $permission = explode("--",$_SESSION['permission']);
	  $segment1 = $this->uri->segment(1);
	  if(!in_array($segment1,$permission)){
		  // permission not allow
		  redirect(base_url('login')); 
	  }

	} 

	public function index()
	{
		// $user_type = array('type'=>4); // user type 4 is branch
        // $data['branch'] = $this->part->where_data('user', $user_type);
        
		$data['branch'] = $this->part->all_data('user');  // user type 4 is branch
		$data['brand'] = $this->part->all_data('brand');
		$data['type'] = $this->part->all_data('part_type');
		$data['ajax']='part';
		$this->load->view('inc/header');
		$this->load->view('part/all',$data);
		$this->load->view('inc/footer');
	}
	public function brand()
	{
		$data['ajax']='brand';
		$this->load->view('inc/header');
		$this->load->view('part/brand',$data);
		$this->load->view('inc/footer');
	} 
	public function model()
	{
		$data['brand'] = $this->part->all_data('brand');
		$data['ajax'] = 'model';
		
		// Pagination settings
		$config['base_url'] = base_url('part/model');
		$config['total_rows'] = $this->part->count_all('model', 'DESC');
		$config['per_page'] = 10;
		$config['uri_segment'] = 3;
		$config['num_links'] = 5;
		$config['full_tag_open'] = '<ul class="pagination">';
		$config['full_tag_close'] = '</ul>';
		$config['first_link'] = 'First';
		$config['last_link'] = 'Last';
		$config['first_tag_open'] = '<li class="page-item">';
		$config['first_tag_close'] = '</li>';
		$config['prev_link'] = '&laquo';
		$config['prev_tag_open'] = '<li class="page-item">';
		$config['prev_tag_close'] = '</li>';
		$config['next_link'] = '&raquo';
		$config['next_tag_open'] = '<li class="page-item">';
		$config['next_tag_close'] = '</li>';
		$config['last_tag_open'] = '<li class="page-item">';
		$config['last_tag_close'] = '</li>';
		$config['cur_tag_open'] = '<li class="page-item active"><a class="page-link" href="#">';
		$config['cur_tag_close'] = '</a></li>';
		$config['num_tag_open'] = '<li class="page-item">';
		$config['num_tag_close'] = '</li>';
		$config['attributes'] = array('class' => 'page-link');

		$this->pagination->initialize($config);
		
		$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		$data['models'] = $this->part->get_paginated_data('model', $config['per_page'], $page, 'DESC');
		$data['pagination'] = $this->pagination->create_links();
		
		$this->load->view('inc/header');
		$this->load->view('part/model', $data);
		$this->load->view('inc/footer');
	} 
	
	public function part_type(){
		$data['brand'] = $this->part->all_data('brand');
		$data['ajax']='part_type';
		$this->load->view('inc/header');
		$this->load->view('part/part_type',$data);
		$this->load->view('inc/footer');
	}
	public function add_brand(){
		if($this->input->post()){
			$prem['name'] = $this->input->post('name');
			$prem['added_by'] = $this->session->userdata('user_id');

			$id = $this->input->post('id');
			if($id !=''){
				$insert_id = $this->part->update('brand',$prem,$id);
				
	            if ($id) {
	                echo json_encode(['status' => 'success', 'message' => 'Brand updated successfully.']);
	            } else {
	                echo json_encode(['status' => 'error', 'message' => 'Failed to add brand.']);
	            }
				exit();
			}else{
				$last_id = $this->part->insert('brand',$prem);
				if ($last_id) {
	                echo json_encode(['status' => 'success', 'message' => 'Brand added successfully.']);
	            } else {
	                echo json_encode(['status' => 'error', 'message' => 'Failed to add brand.']);
	            }
				exit();
			}
		}
	}

	public function add_part_type(){
		if($this->input->post()){
			$prem['name'] = $this->input->post('name');
			$prem['added_by'] = $this->session->userdata('user_id');

			$id = $this->input->post('id');
			if($id !=''){
				$last_id = $this->part->update('part_type',$prem,$id);
				echo "Brand name updated succefully.";
				exit();
			}else{
				$last_id = $this->part->insert('part_type',$prem);
				echo "Brand name added succefully.";
				exit();
			}
		}
	}

	public function add_model(){
		if($this->input->post()){
			$prem['name'] = $this->input->post('name');
			$prem['brand_id'] = $this->input->post('brand_id');
			$prem['added_by'] = $this->session->userdata('user_id');

			$id = $this->input->post('id');
			if($id !=''){
				$last_id = $this->part->update('model',$prem,$id);
				echo "Brand name updated succefully.";
				exit();
			}else{
				$last_id = $this->part->insert('model',$prem);
				echo "Brand name added succefully.";
				exit();
			}
		}
	}

	public function add_data(){
		if($this->input->post()){

			//print_r($_POST); exit();
			$prem['branch'] = $this->input->post('branch');
			$prem['brand'] = $this->input->post('brand');
			$prem['model'] = $this->input->post('model');
			$prem['type'] = $this->input->post('type');
			$prem['price_min'] = $this->input->post('price_min');
			$prem['price_max'] = $this->input->post('price_max');
			$prem['stock'] = $this->input->post('stock');
			$prem['added_by'] = $this->session->userdata('user_id');
			$id = $this->input->post('id');
			if($id !=''){
				$last_id = $this->part->update('part',$prem,$id);
				echo "Part updated succefully.";
				exit();
			}else{
				$last_id = $this->part->insert('part',$prem);
				echo "Part added succefully.";
				exit();
			}
		}
		
	}

	/*
	public function add_data() {
	    if ($this->input->post()) {

	        // Validate form data (optional but recommended)
	        $this->form_validation->set_rules('branch', 'Branch', 'required');
	        $this->form_validation->set_rules('brand', 'Brand', 'required');
	        $this->form_validation->set_rules('model', 'Model', 'required');
	        $this->form_validation->set_rules('type', 'Type', 'required');
	        $this->form_validation->set_rules('price_min', 'Minimum Price', 'numeric');
	        $this->form_validation->set_rules('price_max', 'Maximum Price', 'numeric');

	        if ($this->form_validation->run() == FALSE) {
	            // Validation failed, return errors
	            echo json_encode(['status' => 'error', 'message' => validation_errors()]);
	            exit();
	        }

	        // Prepare Data
	        $data = [
	            'branch'     => $this->input->post('branch', TRUE),
	            'brand'     => $this->input->post('brand', TRUE),
	            'model'     => $this->input->post('model', TRUE),
	            'type'      => $this->input->post('type', TRUE),
	            'price_min' => $this->input->post('price_min', TRUE),
	            'price_max' => $this->input->post('price_max', TRUE),
	            'added_by'  => $this->session->userdata('user_id')
	        ];

	        $id = $this->input->post('id');

	        if (!empty($id)) {
	            // Update existing part
	            $update_status = $this->part->update('part', $data, $id);

	            if ($update_status) {
	                echo json_encode(['status' => 'success', 'message' => 'Part updated successfully.']);
	            } else {
	                echo json_encode(['status' => 'error', 'message' => 'Failed to update part.']);
	            }
	        } else {
	            // Insert new part
	            $insert_id = $this->part->insert('part', $data);

	            if ($insert_id) {
	                echo json_encode(['status' => 'success', 'message' => 'Part added successfully.']);
	            } else {
	                echo json_encode(['status' => 'error', 'message' => 'Failed to add part.']);
	            }
	        }

	        exit();
	    }
	}
	*/


	public function all_brand_ajax(){
		$prem = array();
		// if($_POST['columns'][1]['search']['value'] !=''){
		// 	$prem['name'] = $_POST['columns'][1]['search']['value'];
		// }

		if(count($prem) !='0'){
			$all_data = $this->part->all_data('brand','DESC',$prem);
		}else{
			$all_data = $this->part->all_data('brand','DESC');
		}

		//$all_data = $this->part->all_data('brand','DESC');
		$i =1;
		$data = array();
		foreach($all_data as $key => $all_datas){
			if($this->session->userdata('user_type') =='1' OR $this->session->userdata('user_type') =='4'){
				$action = "<button data-toggle='modal' data-target='#edit_data' onclick='return edit(".$all_datas->id.")' class='btn btn-info btn-xs m-1'><i class='fas fa-pencil-alt'></i></button>";
				$action .= "<button href='' onclick='return del(".$all_datas->id.")' class='btn btn-danger btn-xs m-1'><i class='fa fa-trash' aria-hidden='true'></i></button>"; 
			}elseif($this->session->userdata('user_type') =='3'){
				if($all_datas->added_by == $this->session->userdata('user_id')){
					$action = "<button data-toggle='modal' data-target='#edit_data' onclick='return edit(".$all_datas->id.")' class='btn btn-info btn-xs m-1'><i class='fas fa-pencil-alt'></i></button>";
					$action .= "<button href='' onclick='return del(".$all_datas->id.")' class='btn btn-danger btn-xs m-1'><i class='fa fa-trash' aria-hidden='true'></i></button>"; 
				}else{
					$action = "<button  class='btn btn-info btn-xs m-1' disabled><i class='fas fa-pencil-alt'></i></button>";
					$action .= "<button class='btn btn-danger btn-xs m-1' disabled><i class='fa fa-trash' aria-hidden='true'></i></button>";
			}
			}else{
				$action = "<button  class='btn btn-info btn-xs m-1' disabled><i class='fas fa-pencil-alt'></i></button>";
				$action .= "<button class='btn btn-danger btn-xs m-1' disabled><i class='fa fa-trash' aria-hidden='true'></i></button>";
			}

			$user = $this->part->single_data('user',$all_datas->added_by);

			$user_type ='';
			foreach($user as $users){
				if($users->type =='1'){
					$user_type = " (Admin)";
				}elseif($users->type =='2'){
					$user_type = " (Staff)";
				}elseif($users->type =='3'){
					$user_type = " (Technician)";
				}elseif($users->type =='4'){
					$user_type = " (Branch)";
				}elseif($users->type =='5'){
					$user_type = " (Part corntroller)";
				}
				$username = $users->name.$user_type;
			}



			$row = array();
			$row[] =  $i++;
			$row[] =  $all_datas->name;
			$row[] =  $username;
			$row[] =  $action;
			$data[] = $row;
		}

		$output = array(
                   //"draw" 				=> intval($_POST['draw']),
                    "recordsTotal" 		=> $this->part->count_all('brand','DESC'),
                    "recordsFiltered" => $this->part->count_all('brand','DESC'),
                    "data" 						=> $data,
            	);
   
    echo json_encode($output);

	}

	public function all_part_type_ajax(){
		$prem = array();
		if($_POST['columns'][1]['search']['value'] !=''){
			$prem['name'] = $_POST['columns'][1]['search']['value'];
		}

		if(count($prem) !='0'){
			$all_data = $this->part->all_data('part_type','DESC',$prem);
		}else{
			$all_data = $this->part->all_data('part_type','DESC');
		}

		//$all_data = $this->part->all_data('part_type','DESC');
		$i =1;
		$data = array();
		foreach($all_data as $key => $all_datas){
			if($this->session->userdata('user_type') =='1' OR $this->session->userdata('user_type') =='4'){
				$action = "<button data-toggle='modal' data-target='#edit_data' onclick='return edit(".$all_datas->id.")' class='btn btn-info btn-xs'>Edit</button>";
				$action .= "<button href='' onclick='return del(".$all_datas->id.")' class='btn btn-danger btn-xs'>Delete</button>"; 
			}elseif($this->session->userdata('user_type') =='3'){
				if($all_datas->added_by == $this->session->userdata('user_id')){
					$action = "<button data-toggle='modal' data-target='#edit_data' onclick='return edit(".$all_datas->id.")' class='btn btn-info btn-xs'>Edit</button>";
					$action .= "<button href='' onclick='return del(".$all_datas->id.")' class='btn btn-danger btn-xs'>Delete</button>"; 
				}else{
					$action = "<button  class='btn btn-info btn-xs' disabled>Edit</button>";
					$action .= "<button class='btn btn-danger btn-xs' disabled>Delete</button>";
			}
			}else{
				$action = "<button  class='btn btn-info btn-xs' disabled>Edit</button>";
				$action .= "<button class='btn btn-danger btn-xs' disabled>Delete</button>";
			}

			$user = $this->part->single_data('user',$all_datas->added_by);

			$user_type ='';
			foreach($user as $users){
				if($users->type =='1'){
					$user_type = " (Admin)";
				}elseif($users->type =='2'){
					$user_type = " (Staff)";
				}elseif($users->type =='3'){
					$user_type = " (Technician)";
				}elseif($users->type =='4'){
					$user_type = " (Branch)";
				}elseif($users->type =='5'){
					$user_type = " (Part corntroller)";
				}
				$username = $users->name.$user_type;
			}


			$row = array();
			$row[] =  $i++;
			$row[] =  $all_datas->name;
			$row[] =  $username;
			$row[] =  $action;
			$data[] = $row;
		}

		$output = array(
                   "draw" 				=> intval($_POST['draw']),
                    "recordsTotal" 		=> $this->part->count_all('part','DESC'),
                    "recordsFiltered" => $this->part->count_all('part','DESC'),
                    "data" 						=> $data,
            	);
   
    echo json_encode($output);

	}

	public function all_model_ajax(){
		$prem = array();
		if($_POST['columns'][1]['search']['value'] !=''){
			$prem['name'] = $_POST['columns'][1]['search']['value'];
		}

		if(count($prem) !='0'){
			$all_data = $this->part->all_data('model','DESC',$prem);
		}else{
			$all_data = $this->part->all_data('model','DESC');
		}
		//$all_data = $this->part->all_data('model','DESC');
		$i =1;
		$data = array();
		foreach($all_data as $key => $all_datas){
			if($this->session->userdata('user_type') =='1' OR $this->session->userdata('user_type') =='4'){
				$action = "<button data-toggle='modal' data-target='#edit_data' onclick='return edit(".$all_datas->id.")' class='btn btn-info btn-xs'>Edit</button>";
				$action .= "<button href='' onclick='return del(".$all_datas->id.")' class='btn btn-danger btn-xs'>Delete</button>"; 
			}elseif($this->session->userdata('user_type') =='3'){
				if($all_datas->added_by == $this->session->userdata('user_id')){
					$action = "<button data-toggle='modal' data-target='#edit_data' onclick='return edit(".$all_datas->id.")' class='btn btn-info btn-xs'>Edit</button>";
					$action .= "<button href='' onclick='return del(".$all_datas->id.")' class='btn btn-danger btn-xs'>Delete</button>"; 
				}else{
					$action = "<button  class='btn btn-info btn-xs' disabled>Edit</button>";
					$action .= "<button class='btn btn-danger btn-xs' disabled>Delete</button>";
			}
			}else{
				$action = "<button  class='btn btn-info btn-xs' disabled>Edit</button>";
				$action .= "<button class='btn btn-danger btn-xs' disabled>Delete</button>";
			}

			$user = $this->part->single_data('user',$all_datas->added_by);

			$username ='';
			foreach($user as $users){
				if($users->type =='1'){
					$user_type = " (Admin)";
				}elseif($users->type =='2'){
					$user_type = " (Staff)";
				}elseif($users->type =='3'){
					$user_type = " (Technician)";
				}elseif($users->type =='4'){
					$user_type = " (Branch)";
				}elseif($users->type =='5'){
					$user_type = " (Part corntroller)";
				}
				$username = $users->name.$user_type;
			}

			$brand_id = '';
			$brand = $this->part->single_data('brand',$all_datas->brand_id);
			foreach($brand as $brands){
				$brand_id = $brands->name;
			}

			$row = array();
			$row[] =  $i++;
			$row[] =  $all_datas->name;
			$row[] =  $brand_id;
			$row[] =  $username;
			$row[] =  $action;
			$data[] = $row;
		}

		$output = array(
                   "draw" 				=> intval($_POST['draw']),
                    "recordsTotal" 		=> $this->part->count_all('model','DESC'),
                    "recordsFiltered" => $this->part->count_all('model','DESC'),
                    "data" 						=> $data,
            	);
   
    echo json_encode($output);

	}

	public function all_data_ajax(){
		$all_data = $this->part->all_data('part','DESC');
		$i =1;
		$data = array();
		foreach($all_data as $key => $all_datas){
			$brand_name='';
			$brand = $this->part->single_data('brand',$all_datas->brand);
			foreach($brand as $brands){
				$brand_name = $brands->name;
			}
			$model_name='';
			$model = $this->part->single_data('model',$all_datas->model);
			foreach($model as $models){
				$model_name = $models->name;
			}
			$part_t='';
			$part_type = $this->part->single_data('part_type',$all_datas->type);
			foreach($part_type as $part_types){
				$part_t = $part_types->name;
			}
			if($all_datas->price_min !='0.00' AND $all_datas->price_max != '0.00'){
				$price = $all_datas->price_min.' - '.$all_datas->price_max;
			}elseif($all_datas->price_min !='0.00'){
				$price = $all_datas->price_min;
			}elseif($all_datas->price_max !='0.00'){
				$price = $all_datas->price_max;
			}
			$user = $this->part->single_data('user',$all_datas->added_by);
			$user_type ='';
			foreach($user as $users){
				if($users->type =='0'){
					$user_type = " (Admin)";
				}elseif($users->type =='1'){
					$user_type = " (Staff)";
				}elseif($users->type =='2'){
					$user_type = " (Technician)";
				}elseif($users->type =='3'){
					$user_type = " (Branch)";
				}elseif($users->type =='4'){
					$user_type = " (Part corntroller)";
				}
				$username = $users->name.$user_type;
			}
			if($this->session->userdata('user_type') =='1' OR $this->session->userdata('user_type') =='4'){
				$action = "<button data-toggle='modal' data-target='#edit_data' onclick='return edit(".$all_datas->id.")' class='btn btn-info btn-xs'>Edit</button>";
				$action .= "<button href='' onclick='return del(".$all_datas->id.")' class='btn btn-danger btn-xs'>Delete</button>"; 
			}elseif($this->session->userdata('user_type') =='3'){
				if($all_datas->added_by == $this->session->userdata('user_id')){
					$action = "<button data-toggle='modal' data-target='#edit_data' onclick='return edit(".$all_datas->id.")' class='btn btn-info btn-xs'>Edit</button>";
					$action .= "<button href='' onclick='return del(".$all_datas->id.")' class='btn btn-danger btn-xs'>Delete</button>"; 
				}else{
					$action = "<button  class='btn btn-info btn-xs' disabled>Edit</button>";
					$action .= "<button class='btn btn-danger btn-xs' disabled>Delete</button>";
				}
			}else{
				$action = "<button  class='btn btn-info btn-xs' disabled>Edit</button>";
				$action .= "<button class='btn btn-danger btn-xs' disabled>Delete</button>";
			}
			$row = array();
			$row[] =  $i++;
			$row[] =  $brand_name;
			$row[] =  $model_name;
			$row[] =  $part_t;
			$row[] =  $price;
			$row[] =  $all_datas->stock;
			$row[] =  $username;
			$row[] =  $action;
			$data[] = $row;
		}
		$output = array(
			"recordsTotal" => $this->part->count_all('part','DESC'),
			"recordsFiltered" => $this->part->count_all('part','DESC'),
			"data" => $data,
		);
		echo json_encode($output);
	}


	public function single_model(){
		$bid = $this->input->post('bid');
		$id = $this->input->post('id');
		$part = $this->part->single_data('part',$id);
		$all_data = $this->part->single_modal('model',$bid);
		echo '<option value="">Select Model Name</option>';
		foreach($all_data as $all){

			$select = "";
			if($part[0]->model == $all->id){
				$select = "selected";
			}
			echo '<option value="'.$all->id.'"  '.$select.'>'.$all->name.'</option>';
		}
	}

	public function delete(){
		$id = $this->input->post('id');
		$this->part->delete('part',$id);
		echo "Part deleted succefully.";
		exit();
	}
	public function edit(){
		$id = $this->input->post('id');
		$all_data = $this->part->single_data('part',$id);
		echo json_encode($all_data);
	}

	public function delete_brand(){
		$id = $this->input->post('id');
		$this->part->delete('brand',$id);
		echo "Part deleted succefully.";
		exit();
	}
	public function edit_brand(){
		$id = $this->input->post('id');
		$all_data = $this->part->single_data('brand',$id);
		echo json_encode($all_data);
	}

	public function delete_model(){
		$id = $this->input->post('id');
		$this->part->delete('model',$id);
		echo "Part deleted succefully.";
		exit();
	}
	public function edit_model(){
		$id = $this->input->post('id');
		$all_data = $this->part->single_data('model',$id);
		echo json_encode($all_data);
	}

	public function delete_part_type(){
		$id = $this->input->post('id');
		$this->part->delete('part_type',$id);
		echo "Part deleted succefully.";
		exit();
	}
	public function edit_part_type(){
		$id = $this->input->post('id');
		$all_data = $this->part->single_data('part_type',$id);
		echo json_encode($all_data);
	}

	public function order() {
		$this->load->model('Stock_model', 'stock');
		$data['ajax'] = 'order';
		$data['orders'] = $this->stock->get_all_orders();
		$this->load->view('inc/header', $data);
		$this->load->view('part/order', $data);
		$this->load->view('inc/footer', $data);
	}

	public function add_order() {
		$this->load->model('Stock_model', 'stock');
		$data = $this->input->post();
		$id = $this->stock->insert_order($data);
		echo json_encode(['status' => 'success', 'id' => $id]);
	}
	public function edit_order($id) {
		$this->load->model('Stock_model', 'stock');
		$data = $this->input->post();
		$this->stock->update_order($id, $data);
		echo json_encode(['status' => 'success']);
	}
	public function delete_order($id) {
		$this->load->model('Stock_model', 'stock');
		$this->stock->delete_order($id);
		echo json_encode(['status' => 'success']);
	}
}
