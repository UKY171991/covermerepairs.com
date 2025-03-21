<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Print_data extends CI_Controller {
	public function __construct() {
	  parent::__construct();
	  date_default_timezone_set('NZ');
	  $this->load->model('Print_model','print');
	  
	  if(($this->session->userdata('user_id') =='') OR ($this->session->userdata('user_email') =='') OR ($this->session->userdata('user_password') =='')){
	  	redirect(base_url('login'));
	  }
	  
	  
	  //print_r($_SESSION['permission'].'--print_data'); die;
	  $permission = explode("--",$_SESSION['permission'].'--print_data');
	  $segment1 = $this->uri->segment(1);
	  if(!in_array($segment1,$permission)){
		  // permission not allow
		  redirect(base_url('login'));
	  }
	  
	  //print_r($_SESSION['permission'].'--print_data'); die;
	  
	} 

	public function index($id)  // Challan
	{
		$data['ajax']='none';
		$this->load->view('inc/header');
		$this->load->view('print/all');
		$this->load->view('inc/footer');
	}
	

	public function all_data_ajax(){
		$all_data = $this->part->all_data('part','DESC');
		$i =1;
		$data = array();
		foreach($all_data as $key => $all_datas){
			if($this->session->userdata('user_type') =='0' OR $this->session->userdata('user_type') =='4'){
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

			$row = array();
			$row[] =  $i++;
			$row[] =  $all_datas->name;
			$row[] =  $username;
			$row[] =  $action;
			$data[] = $row;
		}

		$output = array(
                   // "draw" 						=> $_POST['draw'],
                    "recordsTotal" 		=> $this->part->count_all('part','DESC'),
                    "recordsFiltered" => $this->part->count_all('part','DESC'),
                    "data" 						=> $data,
            	);
   
    echo json_encode($output);

	}

	public function delete(){
		$id = $this->input->post('id');
		$this->part->delete('part',$id);
		echo "Staff deleted succefully.";
		exit();
	}
	public function edit(){
		$id = $this->input->post('id');
		$all_data = $this->part->single_data('part',$id);
		echo json_encode($all_data);
	}
}
