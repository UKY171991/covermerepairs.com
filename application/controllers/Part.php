<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Part extends CI_Controller {
	public function __construct() {
	  parent::__construct();
	  date_default_timezone_set('NZ');
	  $this->load->model('part_model','part');
	  $this->load->model('Stock_model', 'stock');
	  // Removed pagination library as it's causing issues
	  // $this->load->library('pagination');
	  
	  
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
		
		// Simple approach - get all models without pagination for now
		$data['models'] = $this->part->all_data('model', 'DESC');
		
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
	
	public function edit_brand(){
		if($this->input->post('id')){
			$prem['brand.id'] = $this->input->post('id');
			$data = $this->part->single_data_join_brand($prem);
			echo json_encode($data);
		}
	}
	
	public function delete_brand(){
		if($this->input->post('id')){
			$id = $this->input->post('id');
			$result = $this->part->delete('brand', $id);
			if($result){
				echo json_encode(['status' => 'success', 'message' => 'Brand deleted successfully.']);
			} else {
				echo json_encode(['status' => 'error', 'message' => 'Failed to delete brand.']);
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
	
	public function edit_part_type(){
		if($this->input->post('id')){
			$prem['part_type.id'] = $this->input->post('id');
			$data = $this->part->single_data_join_part_type($prem);
			echo json_encode($data);
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
	}
	
	public function edit_model(){
		if($this->input->post('id')){
			$prem['model.id'] = $this->input->post('id');
			$data = $this->part->single_data_join_model($prem);
			echo json_encode($data);
		}
	}
	
	public function delete_model(){
		if($this->input->post('id')){
			$id = $this->input->post('id');
			$result = $this->part->delete('model', $id);
			if($result){
				echo json_encode(['status' => 'success', 'message' => 'Model deleted successfully.']);
			} else {
				echo json_encode(['status' => 'error', 'message' => 'Failed to delete model.']);
			}
		}
	}
	
	public function view_model(){
		if($this->input->post('id')){
			$prem['model.id'] = $this->input->post('id');
			$data = $this->part->single_data_join_model($prem);
			echo json_encode($data);
		}
	}
	
	public function add_data(){
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
					$user_type = " (Part Controller)";
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
					$user_type = " (Part Controller)";
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
			"data" => $data,
		);
   
        echo json_encode($output);
    }

    public function all_data_ajax(){
        // Get DataTables parameters
        $draw = intval($this->input->post('draw'));
        $start = intval($this->input->post('start'));
        $length = intval($this->input->post('length'));
        $search_value = $this->input->post('search')['value'];
        
        // Get the current logged-in user's branch if they are a branch user
        $user_branch = null;
        if ($this->session->userdata('user_type') == '4') { // Branch user
            $user_branch = $this->session->userdata('branch_id'); // Get branch_id from session
        }

        // Column search parameters
        $prem = array();
        if($this->input->post('columns')[1]['search']['value'] !=''){
            $prem['brand_name'] = $this->input->post('columns')[1]['search']['value'];
        }
        if($this->input->post('columns')[2]['search']['value'] !=''){
            $prem['model_name'] = $this->input->post('columns')[2]['search']['value'];
        }
        if($this->input->post('columns')[3]['search']['value'] !=''){
            $prem['part_type_name'] = $this->input->post('columns')[3]['search']['value'];
        }
        if($this->input->post('columns')[7]['search']['value'] !=''){
            $prem['user_name'] = $this->input->post('columns')[7]['search']['value'];
        }
        
        // Global search
        if(!empty($search_value)){
            $prem['global_search'] = $search_value;
        }

        // Get total records count (without filtering)
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
            $action .= "<button data-toggle='modal' data-target='#view_modal' onclick='return view(".$all_datas->id.")' class='btn btn-success btn-xs m-1'><i class='fa fa-eye'></i></button>";
            
            // Edit and Delete buttons are available for Admin (1) and Part Controller (5)
            if($this->session->userdata('user_type') == '1' || $this->session->userdata('user_type') == '5'){
                $action .= "<button data-toggle='modal' data-target='#add_edit_modal' onclick='return edit(".$all_datas->id.")' class='btn btn-info btn-xs m-1'><i class='fas fa-pencil-alt'></i></button>";
                $action .= "<button onclick='return del(".$all_datas->id.")' class='btn btn-danger btn-xs m-1'><i class='fa fa-trash'></i></button>"; 
            }
            $action .= "</div>";

            $user_type_map = [
                '1' => ' (Admin)',
                '2' => ' (Staff)',
                '3' => ' (Technician)',
                '4' => ' (Branch)',
                '5' => ' (Part Controller)'
            ];
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
            $action = "";
            
            // Edit and Delete buttons are available for Admin (1) and Part Controller (4)
            if($this->session->userdata('user_type') =='1' OR $this->session->userdata('user_type') =='4'){
                $action .= "<button class='btn btn-info btn-xs m-1 edit-btn' data-id='".$all_datas->id."'><i class='fas fa-pencil-alt'></i></button>";
                $action .= "<button class='btn btn-danger btn-xs m-1 delete-btn' data-id='".$all_datas->id."'><i class='fa fa-trash'></i></button>"; 
            }elseif($this->session->userdata('user_type') =='3'){
                if($all_datas->added_by == $this->session->userdata('user_id')){
                    $action .= "<button class='btn btn-info btn-xs m-1 edit-btn' data-id='".$all_datas->id."'><i class='fas fa-pencil-alt'></i></button>";
                    $action .= "<button class='btn btn-danger btn-xs m-1 delete-btn' data-id='".$all_datas->id."'><i class='fa fa-trash'></i></button>"; 
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
                    $user_type = " (Part Controller)";
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
	
	public function edit_data(){
		if($this->input->post('id')){
			$prem['part.id'] = $this->input->post('id');
			$data = $this->part->single_data_join($prem);
			echo json_encode($data);
		}
	}

	public function del_data(){
		if($this->input->post('id')){
			$id = $this->input->post('id');
			$this->part->delete('part',$id);
			echo json_encode(['status' => 'success', 'message' => 'Part deleted successfully.']);
		}
	}

	public function view($id) {
        $data['part'] = $this->part->get_part_details($id);
        $this->load->view('part/view', $data);
    }

	public function get_models_by_brand($brand_id) {
        $models = $this->part->get_models_by_brand($brand_id);
        echo json_encode($models);
    }
}
