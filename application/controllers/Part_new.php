<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Part extends CI_Controller {
	
	public function __construct() {
		parent::__construct();
		date_default_timezone_set('NZ');
		$this->load->model('part_model','part');
		$this->load->model('Stock_model', 'stock');
		$this->load->library('pagination');
		
		// Check permissions
		$permission = explode("--",$_SESSION['permission']);
		$segment1 = $this->uri->segment(1);
		if(!in_array($segment1,$permission)){
			redirect(base_url('login')); 
		}
	} 

	public function index() {
		$user_type = array('type'=>4); // user type 4 is branch
		$data['branch'] = $this->part->where_data('user', $user_type);
		$data['brand'] = $this->part->all_data('brand');
		$data['type'] = $this->part->all_data('part_type');
		$data['ajax'] = 'part';
		
		$this->load->view('inc/header');
		$this->load->view('part/all',$data);
		$this->load->view('inc/footer');
	}

	public function brand() {
		$data['ajax'] = 'brand';
		$this->load->view('inc/header');
		$this->load->view('part/brand',$data);
		$this->load->view('inc/footer');
	} 

	public function model() {
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
	
	public function part_type() {
		$data['brand'] = $this->part->all_data('brand');
		$data['ajax'] = 'part_type';
		$this->load->view('inc/header');
		$this->load->view('part/part_type',$data);
		$this->load->view('inc/footer');
	}

	public function add_brand() {
		if($this->input->post()){
			$prem['name'] = trim($this->input->post('name'));
			$prem['added_by'] = $this->session->userdata('user_id');

			$id = $this->input->post('id');
			if($id !=''){
				$result = $this->part->update('brand',$prem,$id);
				
				if ($result) {
					echo json_encode(['status' => 'success', 'message' => 'Brand updated successfully.']);
				} else {
					echo json_encode(['status' => 'error', 'message' => 'Failed to update brand.']);
				}
			} else {
				$last_id = $this->part->insert('brand',$prem);
				if ($last_id) {
					echo json_encode(['status' => 'success', 'message' => 'Brand added successfully.']);
				} else {
					echo json_encode(['status' => 'error', 'message' => 'Failed to add brand.']);
				}
			}
			exit();
		}
	}

	public function add_part_type() {
		if($this->input->post()){
			$prem['name'] = trim($this->input->post('name'));
			$prem['added_by'] = $this->session->userdata('user_id');

			$id = $this->input->post('id');
			if($id !=''){
				$result = $this->part->update('part_type',$prem,$id);
				echo json_encode(['status' => 'success', 'message' => 'Part type updated successfully.']);
			} else {
				$result = $this->part->insert('part_type',$prem);
				echo json_encode(['status' => 'success', 'message' => 'Part type added successfully.']);
			}
			exit();
		}
	}

	public function add_model() {
		if($this->input->post()){
			$prem['name'] = trim($this->input->post('name'));
			$prem['brand_id'] = $this->input->post('brand_id');
			$prem['added_by'] = $this->session->userdata('user_id');

			$id = $this->input->post('id');
			if($id !=''){
				$result = $this->part->update('model',$prem,$id);
				echo json_encode(['status' => 'success', 'message' => 'Model updated successfully.']);
			} else {
				$result = $this->part->insert('model',$prem);
				echo json_encode(['status' => 'success', 'message' => 'Model added successfully.']);
			}
			exit();
		}
	}

	public function add_data() {
		if($this->input->post()){
			// Prepare data for insertion/update
			$prem = array(
				'branch' => $this->input->post('branch'),
				'brand' => $this->input->post('brand'),
				'model' => $this->input->post('model'),
				'type' => $this->input->post('type'),
				'price_min' => $this->input->post('price_min') ? $this->input->post('price_min') : 0,
				'price_max' => $this->input->post('price_max') ? $this->input->post('price_max') : 0,
				'stock' => $this->input->post('stock') ? $this->input->post('stock') : 0,
				'added_by' => $this->session->userdata('user_id')
			);
			
			$id = $this->input->post('id');
			
			// Basic validation
			if(empty($prem['branch']) || empty($prem['brand']) || empty($prem['model']) || empty($prem['type'])) {
				echo json_encode(['status' => 'error', 'message' => 'Please fill all required fields.']);
				exit();
			}
			
			try {
				if($id != ''){
					// Update existing part
					$result = $this->part->update('part', $prem, $id);
					
					if($result !== false) {
						echo json_encode(['status' => 'success', 'message' => 'Part updated successfully.']);
					} else {
						echo json_encode(['status' => 'error', 'message' => 'Failed to update part.']);
					}
				} else {
					// Insert new part
					$result = $this->part->insert('part', $prem);
					
					if($result) {
						echo json_encode(['status' => 'success', 'message' => 'Part added successfully.']);
					} else {
						echo json_encode(['status' => 'error', 'message' => 'Failed to add part.']);
					}
				}
			} catch (Exception $e) {
				echo json_encode(['status' => 'error', 'message' => 'Database error occurred.']);
			}
			exit();
		}
	}

	public function all_brand_ajax() {
		try {
			$prem = array();
			
			if(count($prem) != 0){
				$all_data = $this->part->all_data('brand','DESC',$prem);
			} else {
				$all_data = $this->part->all_data('brand','DESC');
			}

			$i = 1;
			$data = array();
			foreach($all_data as $key => $all_datas){
				// Permission check for actions
				if($this->session->userdata('user_type') == '1' OR $this->session->userdata('user_type') == '4'){
					$action = "<button data-toggle='modal' data-target='#edit_data' onclick='return edit(".$all_datas->id.")' class='btn btn-info btn-xs m-1'><i class='fas fa-pencil-alt'></i></button>";
					$action .= "<button onclick='return del(".$all_datas->id.")' class='btn btn-danger btn-xs m-1'><i class='fa fa-trash'></i></button>"; 
				} elseif($this->session->userdata('user_type') == '3'){
					if($all_datas->added_by == $this->session->userdata('user_id')){
						$action = "<button data-toggle='modal' data-target='#edit_data' onclick='return edit(".$all_datas->id.")' class='btn btn-info btn-xs m-1'><i class='fas fa-pencil-alt'></i></button>";
						$action .= "<button onclick='return del(".$all_datas->id.")' class='btn btn-danger btn-xs m-1'><i class='fa fa-trash'></i></button>"; 
					} else {
						$action = "<button class='btn btn-info btn-xs m-1' disabled><i class='fas fa-pencil-alt'></i></button>";
						$action .= "<button class='btn btn-danger btn-xs m-1' disabled><i class='fa fa-trash'></i></button>";
					}
				} else {
					$action = "<button class='btn btn-info btn-xs m-1' disabled><i class='fas fa-pencil-alt'></i></button>";
					$action .= "<button class='btn btn-danger btn-xs m-1' disabled><i class='fa fa-trash'></i></button>";
				}

				$user = $this->part->single_data('user',$all_datas->added_by);
				$username = '';
				if($user){
					foreach($user as $users){
						$user_type_map = array(
							'1' => ' (Admin)',
							'2' => ' (Staff)',
							'3' => ' (Technician)',
							'4' => ' (Branch)',
							'5' => ' (Part Controller)'
						);
						$user_type_label = isset($user_type_map[$users->type]) ? $user_type_map[$users->type] : ' (Unknown)';
						$username = $users->name . $user_type_label;
					}
				}

				$row = array();
				$row[] = $i++;
				$row[] = $all_datas->name;
				$row[] = $username;
				$row[] = $action;
				$data[] = $row;
			}

			$output = array(
				"recordsTotal" => $this->part->count_all('brand','DESC'),
				"recordsFiltered" => $this->part->count_all('brand','DESC'),
				"data" => $data,
			);
	   
			echo json_encode($output);
		} catch (Exception $e) {
			echo json_encode(['error' => 'An error occurred while fetching data.']);
		}
	}

	public function all_data_ajax() {
		try {
			// Get DataTables parameters
			$draw = intval($this->input->post('draw'));
			$start = intval($this->input->post('start'));
			$length = intval($this->input->post('length'));
			$search_value = $this->input->post('search')['value'];
			
			// Get the current logged-in user's branch if they are a branch user
			$user_branch = null;
			if ($this->session->userdata('user_type') == '4') {
				$user_branch = $this->session->userdata('branch_id');
			}
		
			// Column search parameters
			$prem = array();
			if($this->input->post('columns')[1]['search']['value'] != ''){
				$prem['brand_name'] = $this->input->post('columns')[1]['search']['value'];
			}
			if($this->input->post('columns')[2]['search']['value'] != ''){
				$prem['model_name'] = $this->input->post('columns')[2]['search']['value'];
			}
			if($this->input->post('columns')[3]['search']['value'] != ''){
				$prem['part_type_name'] = $this->input->post('columns')[3]['search']['value'];
			}
			if($this->input->post('columns')[7]['search']['value'] != ''){
				$prem['user_name'] = $this->input->post('columns')[7]['search']['value'];
			}
			
			// Global search
			if(!empty($search_value)){
				$prem['global_search'] = $search_value;
			}

			// Get total records count
			$total_records = $this->part->count_all_parts($user_branch);
			
			// Get filtered records count
			$filtered_records = $this->part->count_filtered_parts($prem, $user_branch);
			
			// Get paginated data
			$all_data = $this->part->get_paginated_parts($prem, $start, $length, $user_branch);
			
			$data = array();
			$i = $start + 1;
			foreach($all_data as $key => $all_datas){
				$action = "";
				
				// View button is always available
				$action .= "<button data-toggle='modal' data-target='#view_data' onclick='return view(".$all_datas->id.")' class='btn btn-success btn-xs m-1' title='View'><i class='fa fa-eye'></i></button>";
				
				// Edit and Delete buttons based on user permissions
				if($this->session->userdata('user_type') == '1' || $this->session->userdata('user_type') == '5'){
					$action .= "<button data-toggle='modal' data-target='#edit_data' onclick='return edit(".$all_datas->id.")' class='btn btn-info btn-xs m-1' title='Edit'><i class='fas fa-pencil-alt'></i></button>";
					$action .= "<button onclick='return del(".$all_datas->id.")' class='btn btn-danger btn-xs m-1' title='Delete'><i class='fa fa-trash'></i></button>"; 
				}

				// User type mapping
				$user_type_map = array(
					'1' => ' (Admin)',
					'2' => ' (Staff)',
					'3' => ' (Technician)',
					'4' => ' (Branch)',
					'5' => ' (Part Controller)'
				);
				$user_type_label = isset($user_type_map[$all_datas->user_type]) ? $user_type_map[$all_datas->user_type] : ' (Unknown)';
				$username = $all_datas->user_name . $user_type_label;

				$row = array();
				$row[] = $i++;
				$row[] = $all_datas->brand_name;
				$row[] = $all_datas->model_name;
				$row[] = $all_datas->part_type_name;
				$row[] = $all_datas->price_min;
				$row[] = $all_datas->price_max;
				$row[] = $all_datas->stock;
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
		} catch (Exception $e) {
			echo json_encode(['error' => 'An error occurred while fetching data.']);
		}
	}
	
	public function edit_data() {
		if($this->input->post('id')){
			try {
				$prem['part.id'] = $this->input->post('id');
				$data = $this->part->single_data_join($prem);
				
				if($data) {
					echo json_encode($data);
				} else {
					echo json_encode(['error' => 'Part not found.']);
				}
			} catch (Exception $e) {
				echo json_encode(['error' => 'An error occurred while fetching part data.']);
			}
		}
	}

	public function del_data() {
		if($this->input->post('id')){
			try {
				$id = $this->input->post('id');
				$result = $this->part->delete('part',$id);
				
				if($result) {
					echo json_encode(['status' => 'success', 'message' => 'Part deleted successfully.']);
				} else {
					echo json_encode(['status' => 'error', 'message' => 'Failed to delete part.']);
				}
			} catch (Exception $e) {
				echo json_encode(['status' => 'error', 'message' => 'An error occurred while deleting the part.']);
			}
		}
	}

	public function view($id) {
		$data['part'] = $this->part->get_part_details($id);
		$this->load->view('part/view', $data);
	}

	public function get_models_by_brand($brand_id) {
		try {
			$models = $this->part->get_models_by_brand($brand_id);
			echo json_encode($models);
		} catch (Exception $e) {
			echo json_encode(['error' => 'An error occurred while fetching models.']);
		}
	}
}
