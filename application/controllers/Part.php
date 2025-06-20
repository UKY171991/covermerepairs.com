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
		$user_type = array('type'=>4); // user type 4 is branch
        $data['branch'] = $this->part->where_data('user', $user_type);
        
		//$data['branch'] = $this->part->all_data('user');  // user type 4 is branch
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
				echo json_encode(['status' => 'success', 'message' => 'Part type updated successfully.']);
				exit();
			}else{
				$last_id = $this->part->insert('part_type',$prem);
				echo json_encode(['status' => 'success', 'message' => 'Part type added successfully.']);
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
				echo json_encode(['status' => 'success', 'message' => 'Model updated successfully.']);
				exit();
			}else{
				$last_id = $this->part->insert('model',$prem);
				echo json_encode(['status' => 'success', 'message' => 'Model added successfully.']);
				exit();
			}
		}
	}	public function add_data(){
		if($this->input->post()){

			// Debug: log the received data
			// error_log('POST data: ' . print_r($_POST, true));
			
			$prem['branch'] = $this->input->post('branch');
			$prem['brand'] = $this->input->post('brand');
			$prem['model'] = $this->input->post('model');
			$prem['type'] = $this->input->post('type');
			$prem['price_min'] = $this->input->post('price_min');
			$prem['price_max'] = $this->input->post('price_max');
			$prem['stock'] = $this->input->post('stock');
			$prem['added_by'] = $this->session->userdata('user_id');
			$id = $this->input->post('id');
			
			// Basic validation
			if(empty($prem['branch']) || empty($prem['brand']) || empty($prem['model']) || empty($prem['type'])) {
				echo json_encode(['status' => 'error', 'message' => 'Please fill all required fields.']);
				exit();
			}
			
			if($id !=''){
				// Update existing part
				$result = $this->part->update('part',$prem,$id);
				
				if($result !== false) {
					echo json_encode(['status' => 'success', 'message' => 'Part updated successfully.']);
				} else {
					// Get database error if any
					$db_error = $this->db->error();
					$error_message = !empty($db_error['message']) ? $db_error['message'] : 'Failed to update part.';
					echo json_encode(['status' => 'error', 'message' => $error_message]);
				}
				exit();
			}else{
				// Insert new part
				$result = $this->part->insert('part',$prem);
				
				if($result) {
					echo json_encode(['status' => 'success', 'message' => 'Part added successfully.']);
				} else {
					// Get database error if any
					$db_error = $this->db->error();
					$error_message = !empty($db_error['message']) ? $db_error['message'] : 'Failed to add part.';
					echo json_encode(['status' => 'error', 'message' => $error_message]);
				}
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
		// Get DataTables parameters
		$draw = intval($this->input->post('draw'));
		$start = intval($this->input->post('start'));
		$length = intval($this->input->post('length'));
		$search_value = $this->input->post('search')['value'];
		
		// Column search parameters
		$prem = array();
		if($this->input->post('columns')[1]['search']['value'] !=''){
			$prem['name'] = $this->input->post('columns')[1]['search']['value'];
		}
		if($this->input->post('columns')[2]['search']['value'] !=''){
			$prem['user_name'] = $this->input->post('columns')[2]['search']['value'];
		}
		
		// Global search
		if(!empty($search_value)){
			$prem['global_search'] = $search_value;
		}

		// Get total records count (without filtering)
		$total_records = $this->part->count_all_part_types();
		
		// Get filtered records count
		$filtered_records = $this->part->count_filtered_part_types($prem);
		
		// Get paginated data
		if(count($prem) > 0){
			$all_data = $this->part->get_paginated_part_types($prem, $start, $length);
		}else{
			$all_data = $this->part->get_paginated_part_types(array(), $start, $length);
		}

		$data = array();
		$i = $start + 1;
		foreach($all_data as $key => $all_datas){
			if($this->session->userdata('user_type') =='1' OR $this->session->userdata('user_type') =='4'){
				$action = "<button data-toggle='modal' data-target='#edit_data' onclick='return edit(".$all_datas->id.")' class='btn btn-info btn-xs m-1'><i class='fas fa-pencil-alt'></i></button>";
				$action .= "<button onclick='return del(".$all_datas->id.")' class='btn btn-danger btn-xs m-1'><i class='fa fa-trash'></i></button>"; 
			}elseif($this->session->userdata('user_type') =='3'){
				if($all_datas->added_by == $this->session->userdata('user_id')){
					$action = "<button data-toggle='modal' data-target='#edit_data' onclick='return edit(".$all_datas->id.")' class='btn btn-info btn-xs m-1'><i class='fas fa-pencil-alt'></i></button>";
					$action .= "<button onclick='return del(".$all_datas->id.")' class='btn btn-danger btn-xs m-1'><i class='fa fa-trash'></i></button>"; 
				}else{
					$action = "<button class='btn btn-info btn-xs m-1' disabled><i class='fas fa-pencil-alt'></i></button>";
					$action .= "<button class='btn btn-danger btn-xs m-1' disabled><i class='fa fa-trash'></i></button>";
			}
			}else{
				$action = "<button class='btn btn-info btn-xs m-1' disabled><i class='fas fa-pencil-alt'></i></button>";
				$action .= "<button class='btn btn-danger btn-xs m-1' disabled><i class='fa fa-trash'></i></button>";
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

			$row = array();
			$row[] = $i++;
			$row[] = $all_datas->name;
			$row[] = $username;
			$row[] = $action;
			$data[] = $row;
		}

		$output = array(
			"draw" => $draw,
			"recordsTotal" => $total_records,
			"recordsFiltered" => $filtered_records,
			"data" => $data,		);
   
		echo json_encode($output);
	}

	public function all_model_ajax(){
		// Get DataTables parameters
		$draw = intval($this->input->post('draw'));
		$start = intval($this->input->post('start'));
		$length = intval($this->input->post('length'));
		$search_value = $this->input->post('search')['value'];
		
		// Column search parameters
		$prem = array();
		if($this->input->post('columns')[1]['search']['value'] !=''){
			$prem['name'] = $this->input->post('columns')[1]['search']['value'];
		}
		if($this->input->post('columns')[2]['search']['value'] !=''){
			$prem['brand_name'] = $this->input->post('columns')[2]['search']['value'];
		}
		if($this->input->post('columns')[3]['search']['value'] !=''){
			$prem['user_name'] = $this->input->post('columns')[3]['search']['value'];
		}
		
		// Global search
		if(!empty($search_value)){
			$prem['global_search'] = $search_value;
		}

		// Get total records count (without filtering)
		$total_records = $this->part->count_all_models();
		
		// Get filtered records count
		$filtered_records = $this->part->count_filtered_models($prem);
		
		// Get paginated data
		if(count($prem) > 0){
			$all_data = $this->part->get_paginated_models($prem, $start, $length);
		}else{
			$all_data = $this->part->get_paginated_models(array(), $start, $length);
		}
		
		$data = array();
		$i = $start + 1;
		foreach($all_data as $key => $all_datas){
			if($this->session->userdata('user_type') =='1' OR $this->session->userdata('user_type') =='4'){
				$action = "<button data-toggle='modal' data-target='#edit_data' onclick='return edit(".$all_datas->id.")' class='btn btn-info btn-xs m-1'><i class='fas fa-pencil-alt'></i></button>";
				$action .= "<button onclick='return del(".$all_datas->id.")' class='btn btn-danger btn-xs m-1'><i class='fa fa-trash'></i></button>"; 
			}elseif($this->session->userdata('user_type') =='3'){
				if($all_datas->added_by == $this->session->userdata('user_id')){
					$action = "<button data-toggle='modal' data-target='#edit_data' onclick='return edit(".$all_datas->id.")' class='btn btn-info btn-xs m-1'><i class='fas fa-pencil-alt'></i></button>";
					$action .= "<button onclick='return del(".$all_datas->id.")' class='btn btn-danger btn-xs m-1'><i class='fa fa-trash'></i></button>"; 
				}else{
					$action = "<button class='btn btn-info btn-xs m-1' disabled><i class='fas fa-pencil-alt'></i></button>";
					$action .= "<button class='btn btn-danger btn-xs m-1' disabled><i class='fa fa-trash'></i></button>";
			}
			}else{
				$action = "<button class='btn btn-info btn-xs m-1' disabled><i class='fas fa-pencil-alt'></i></button>";
				$action .= "<button class='btn btn-danger btn-xs m-1' disabled><i class='fa fa-trash'></i></button>";
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
			$row[] = $i++;
			$row[] = $all_datas->name;
			$row[] = $brand_id;
			$row[] = $username;
			$row[] = $action;
			$data[] = $row;
		}

		$output = array(
			"draw" => $draw,
			"recordsTotal" => $total_records,
			"recordsFiltered" => $filtered_records,
			"data" => $data,
		);
   		echo json_encode($output);
	}
	
	public function all_data_ajax(){
		// DataTable parameters
		$start = $this->input->post('start') ?: 0;
		$length = $this->input->post('length') ?: 10;
		$search_value = $this->input->post('search')['value'] ?? '';
		
		// Debug logging
		error_log('Start: ' . $start . ', Length: ' . $length . ', Search: ' . $search_value);
		
		// Column search
		$columns = $this->input->post('columns');
		$search = [];
		
		if (!empty($columns)) {
			foreach ($columns as $index => $column) {
				if (!empty($column['search']['value'])) {
					switch ($index) {
						case 1:
							$search['brand_name'] = $column['search']['value'];
							break;
						case 2:
							$search['model_name'] = $column['search']['value'];
							break;
						case 3:
							$search['part_type_name'] = $column['search']['value'];
							break;
						case 6:
							$search['user_name'] = $column['search']['value'];
							break;
					}
				}
			}
		}
		
		// Global search
		if (!empty($search_value)) {
			$search['global'] = $search_value;
		}
		
		// Debug search parameters
		error_log('Search parameters: ' . print_r($search, true));
				// Get paginated data
		$all_data = $this->part->get_paginated_parts($search, $start, $length);
		$total_records = $this->part->count_all_parts();
		$filtered_records = $this->part->count_filtered_parts($search);
		
		// Debug: Try alternative query if paginated returns no results
		if (empty($all_data)) {
			error_log('No data from paginated query, trying fallback...');
			$fallback_data = $this->part->all_data('part', 'DESC');
			error_log('Fallback data count: ' . count($fallback_data));
		}
		
		// Debug record counts
		error_log('Total records: ' . $total_records . ', Filtered: ' . $filtered_records . ', Data count: ' . count($all_data));
		
		$i = $start + 1;
		$data = array();
		foreach($all_data as $row){
			// Format price
			if($row->price_min !='0.00' AND $row->price_max != '0.00'){
				$price = $row->price_min.' - '.$row->price_max;
			}elseif($row->price_min !='0.00'){
				$price = $row->price_min;
			}elseif($row->price_max !='0.00'){
				$price = $row->price_max;
			} else {
				$price = '-';
			}
			
			// Format username with type
			$user_type_label ='';
			if($row->user_type =='0'){
				$user_type_label = " (Admin)";
			}elseif($row->user_type =='1'){
				$user_type_label = " (Staff)";
			}elseif($row->user_type =='2'){
				$user_type_label = " (Technician)";
			}elseif($row->user_type =='3'){
				$user_type_label = " (Branch)";
			}elseif($row->user_type =='4'){
				$user_type_label = " (Part Controller)";
			}
			$username = ($row->user_name ?? '') . $user_type_label;
			
			// Action buttons based on permissions
			if($this->session->userdata('user_type') =='1' OR $this->session->userdata('user_type') =='4'){
				$action = "<button data-id='".$row->id."' class='btn btn-success btn-xs view-btn' title='View'>View</button>";
				$action .= "<button data-toggle='modal' data-target='#edit_data' data-id='".$row->id."' class='btn btn-info btn-xs edit-btn' title='Edit'>Edit</button>";
				$action .= "<button data-id='".$row->id."' class='btn btn-danger btn-xs delete-btn' title='Delete'>Delete</button>"; 
			}elseif($this->session->userdata('user_type') =='3'){
				if($row->added_by == $this->session->userdata('user_id')){
					$action = "<button data-id='".$row->id."' class='btn btn-success btn-xs view-btn' title='View'>View</button>";
					$action .= "<button data-toggle='modal' data-target='#edit_data' data-id='".$row->id."' class='btn btn-info btn-xs edit-btn' title='Edit'>Edit</button>";
					$action .= "<button data-id='".$row->id."' class='btn btn-danger btn-xs delete-btn' title='Delete'>Delete</button>"; 
				}else{
					$action = "<button data-id='".$row->id."' class='btn btn-success btn-xs view-btn' title='View'>View</button>";
					$action .= "<button class='btn btn-info btn-xs' disabled title='Edit'>Edit</button>";
					$action .= "<button class='btn btn-danger btn-xs' disabled title='Delete'>Delete</button>";
				}
			}else{
				$action = "<button data-id='".$row->id."' class='btn btn-success btn-xs view-btn' title='View'>View</button>";
				$action .= "<button class='btn btn-info btn-xs' disabled title='Edit'>Edit</button>";
				$action .= "<button class='btn btn-danger btn-xs' disabled title='Delete'>Delete</button>";			}
			
			$data_row = array();
			$data_row[] = $i++;
			$data_row[] = $row->brand_name ?? '';
			$data_row[] = $row->model_name ?? '';
			$data_row[] = $row->part_type_name ?? '';
			$data_row[] = $price;
			$data_row[] = $row->stock;
			$data_row[] = $username;
			$data_row[] = $action;
			$data[] = $data_row;
		}
		
		$output = array(
			"draw" => intval($this->input->post('draw')),
			"recordsTotal" => $total_records,
			"recordsFiltered" => $filtered_records,
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
		$result = $this->part->delete('part',$id);
		if($result) {
			echo json_encode(['status' => 'success', 'message' => 'Part deleted successfully.']);
		} else {
			echo json_encode(['status' => 'error', 'message' => 'Failed to delete part.']);
		}
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
		echo json_encode(['status' => 'success', 'message' => 'Brand deleted successfully.']);
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
		echo json_encode(['status' => 'success', 'message' => 'Model deleted successfully.']);
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
		echo json_encode(['status' => 'success', 'message' => 'Part type deleted successfully.']);
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

	public function model_ajax() {
		$limit = $this->input->get('limit') ?: 10;
		$page = $this->input->get('page') ?: 1;
		$offset = ($page - 1) * $limit;
		$search = [
			'name' => $this->input->get('name'),
			'brand' => $this->input->get('brand'),
			'user' => $this->input->get('user'),
		];
		$models = $this->part->get_models_ajax($limit, $offset, $search);
		$total = $this->part->count_models_ajax($search);
		$result = [];
		foreach ($models as $model) {
			$brand = $this->part->single_data('brand', $model->brand_id);
			$user = $this->part->single_data('user', $model->added_by);
			$user_type = '';
			if (!empty($user)) {
				if($user[0]->type == '1') $user_type = ' (Admin)';
				elseif($user[0]->type == '2') $user_type = ' (Staff)';
				elseif($user[0]->type == '3') $user_type = ' (Technician)';
				elseif($user[0]->type == '4') $user_type = ' (Branch)';
				elseif($user[0]->type == '5') $user_type = ' (Part controller)';
			}
			$result[] = [
				'id' => $model->id,
				'name' => $model->name,
				'brand' => !empty($brand) ? $brand[0]->name : '',
				'user' => !empty($user) ? $user[0]->name . $user_type : '',
				'can_edit' => ($this->session->userdata('user_type') == '1' || $this->session->userdata('user_type') == '4' || ($this->session->userdata('user_type') == '3' && $model->added_by == $this->session->userdata('user_id'))),
			];
		}
		echo json_encode([
			'data' => $result,
			'total' => $total
		]);
		exit;
	}

	public function order_ajax() {
		$this->load->model('Stock_model', 'stock');
		$limit = $this->input->get('limit') ?: 10;
		$page = $this->input->get('page') ?: 1;
		$offset = ($page - 1) * $limit;
		$search = [
			'order_id' => $this->input->get('order_id'),
			'part_name' => $this->input->get('part_name'),
			'status' => $this->input->get('status')
		];
		$id = $this->input->get('id');
		$orders = $this->stock->get_orders_paginated($limit, $offset, $search, $id);
		$total = $id ? 1 : $this->stock->count_orders($search);
		echo json_encode(['data' => $orders, 'total' => $total]);
		exit;
	}

	public function add_order_ajax() {
		$this->load->model('Stock_model', 'stock');
		$data = $this->input->post();
		if (empty($data['id'])) {
			$id = $this->stock->insert_order($data);
		} else {
			$this->stock->update_order($data['id'], $data);
			$id = $data['id'];
		}
		echo json_encode(['status' => 'success', 'id' => $id]);
		exit;
	}

	public function delete_order_ajax() {
		$this->load->model('Stock_model', 'stock');
		$id = $this->input->post('id');
		$this->stock->delete_order($id);
		echo json_encode(['status' => 'success']);
		exit;
	}
}
