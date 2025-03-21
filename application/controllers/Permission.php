<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Permission extends CI_Controller {
	public function __construct() {
	  parent::__construct();
	  date_default_timezone_set('NZ');
	  $this->load->model('users_model','user');
	  
	  if(($this->session->userdata('user_id') =='') OR ($this->session->userdata('user_email') =='') OR ($this->session->userdata('user_password') =='')){
	  	redirect(base_url('login'));
	  }
	  
	  $permission = explode("--",$_SESSION['permission']);
	  $segment1 = $this->uri->segment(1);
	  if(!in_array($segment1,$permission)){
		  // permission not allow
		  redirect(base_url('login'));
	  }
	}
	
	public function index()
	{
		$data['ajax']='permission';
		$this->load->view('inc/header');
		$this->load->view('permission/all',$data);
		$this->load->view('inc/footer');
	}

	public function add_data(){

		if($this->input->post()){

			$prem['name'] = $this->input->post('name');
			$prem['slug'] = $this->input->post('slug');
			$prem['added_by'] = $this->session->userdata('user_id');

			$id = $this->input->post('id');
			if($id !=''){
				$this->user->update('permission',$prem,$id);
				$mes=array('status'=>"success",'message'=>'Permission updated succefully.');
				echo json_encode($mes);
				exit();
			}else{
				$last_id = $this->user->insert('permission',$prem);
				$mes=array('status'=>"success",'message'=>'Permission added succefully.');
				echo json_encode($mes);
				exit();
			}

		}
		  
	}

	public function all_data_ajax(){

		$all_data = $this->user->all_data('permission','DESC');
 
		
		$i =1;
		$data = array();
		foreach($all_data as $key => $all_datas){
			$row = array(); 


			if($this->session->userdata('user_type') =='1'){
				$action = "<button data-toggle='modal' data-target='#edit_data' onclick='return edit(".$all_datas->id.")' class='btn btn-info btn-xs m-1'><i class='fas fa-pencil-alt'></i></button>";
				$action .= "<button href='' onclick='return del(".$all_datas->id.")' class='btn btn-danger btn-xs m-1'><i class='fa fa-trash' aria-hidden='true'></i></button>";
			}else{
				$action = "<button  class='btn btn-info btn-xs m-1' disabled><i class='fas fa-pencil-alt'></i></button>";
				$action .= "<button class='btn btn-danger btn-xs m-1' disabled><i class='fa fa-trash' aria-hidden='true'></i></button>";
			}


			$row[] =  $i++;
			$row[] =  $all_datas->name;
			$row[] =  $all_datas->slug;
			$row[] =  $action;
			$data[] = $row;
		}


		// filter_count_all
		$output = array(
                   // "draw" 				=> intval($_POST['draw']),
                    "recordsTotal" 		=> $this->user->count_all('permission','DESC'),
                    "recordsFiltered" 	=> $this->user->count_all('permission','DESC'),
                    "data" 				=> $data,
            	);
   
    echo json_encode($output);

	//	echo json_encode(array('data' => $data));
	}

	public function delete(){
		$id = $this->input->post('id');
		$this->user->delete('permission',$id);
		echo "Permission deleted succefully.";
		exit();
	}
	public function edit(){
		$id = $this->input->post('id');

		$wher = array('id'=>$id);
		$all_data = $this->user->all_data('permission','DESC',$wher);
		echo json_encode($all_data);
	}
}
