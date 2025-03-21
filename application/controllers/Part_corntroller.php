<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Part_corntroller extends CI_Controller {
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
		$data['department'] = $this->user->all_data('user_type','ASC');
		$data['permission'] = $this->user->all_data('permission','DESC');
		$user_type = array('type'=>4); // user type 4 is branch
        $data['branch'] = $this->user->where_data('user', $user_type);
		$data['ajax']='part_corntroller';
		$this->load->view('inc/header');
		$this->load->view('part_corntroller/all',$data);
		$this->load->view('inc/footer');
	}

	public function add_data(){

		if($this->input->post()){

			$prem['name'] = $this->input->post('name');
			$prem['email'] = $this->input->post('email');
			$prem['phone'] = $this->input->post('phone');
			$prem['dob'] = $this->input->post('dob');
			$prem['address'] = $this->input->post('address');
			$prem['branch'] = $this->input->post('branch');
			$prem['username'] = $this->input->post('username');
			$prem['type'] = 5; //$this->input->post('type');
			$prem['added_by'] = $this->session->userdata('user_id');
			
			
			if($this->session->userdata('user_id')== 1 ){
				$standred = $this->input->post('branch');
				$stand = implode('--',$standred); 
				$prem['branch'] = $stand; 
			}else{
				$prem['branch'] = $this->session->userdata('user_id'); 
			}
			
			$permission = $this->input->post('permission'); 
			$per = implode('--',$permission); 
			$prem['permission'] = $per; 
			
			//print_r($prem); die;   

			if($this->input->post('username') ==''){
				$mes=array('status'=>"failed",'message'=>'Please enter username.');
				echo json_encode($mes);
				exit();
			}

			

			if($this->input->post('password') !=''){
				$prem['password'] = md5($this->input->post('password'));
			}

			$id = $this->input->post('id');
			if($id !=''){
				$all_data = $this->user->all_email_update('user',$this->input->post('email'),$id);
				if($all_data !=0){
					$mes=array('status'=>"failed",'message'=>'Email id  alreay exits');
					echo json_encode($mes);
					exit();
				}
				$all_data = $this->user->all_username_update('user',$this->input->post('username'),$id);
				if($all_data !=0){
					$mes=array('status'=>"failed",'message'=>'Username not avaliavle.');
					echo json_encode($mes);
					exit();
				}

				//print_r($_POST); exit();

				//print_r($prem); exit();

				$this->user->update('user',$prem,$id);
				$mes=array('status'=>"success",'message'=>'User updated succefully.');
				echo json_encode($mes);
				exit();
			}else{
				$all_data = $this->user->all_email('user',$this->input->post('email'));
				if($all_data !=0){
					$mes=array('status'=>"failed",'message'=>'Email id  alreay exits');
					echo json_encode($mes);
					exit();
				}

				$all_data = $this->user->all_username('user',$this->input->post('username'));
				if($all_data !=0){
					$mes=array('status'=>"failed",'message'=>'Username alreay exits');
					echo json_encode($mes);
					exit();
				}


				$last_id = $this->user->insert('user',$prem);
				$mes=array('status'=>"success",'message'=>'User added succefully.');
				echo json_encode($mes);
				exit();
			}

		}
		
	}

	public function all_data_ajax(){

		if($this->session->userdata('user_type') =='1'){
			$utype = array('type'=>5);
			$all_data = $this->user->all_data('user','DESC',$utype);
		}else{
			$utype = array('type'=>5,'added_by'=>$this->session->userdata('user_id'));
			$all_data = $this->user->all_data('user','DESC',$utype);
		}
		
		$i =1;
		$data = array();
		foreach($all_data as $key => $all_datas){
			$row = array(); 


			if($this->session->userdata('user_type') =='1' OR $this->session->userdata('user_type') =='4'){
				$action = "<button data-toggle='modal' data-target='#view_data' onclick='return view(".$all_datas->id.")' class='btn btn-primary btn-xs m-1'><i class='fa fa-eye' aria-hidden='true'></i></button>";
				$action .= "<button data-toggle='modal' data-target='#edit_data' onclick='return edit(".$all_datas->id.")' class='btn btn-info btn-xs m-1'><i class='fas fa-pencil-alt'></i></button>";
				$action .= "<button href='' onclick='return del(".$all_datas->id.")' class='btn btn-danger btn-xs m-1'><i class='fa fa-trash' aria-hidden='true'></i></button>";
			}else{
				$action = "<button  class='btn btn-info btn-xs m-1' disabled><i class='fas fa-pencil-alt'></i></button>";
				$action .= "<button class='btn btn-danger btn-xs m-1' disabled><i class='fa fa-trash' aria-hidden='true'></i></button>";
			}

			$wher = array('id'=>$all_datas->type);
			$depname='';
			$user_type = $this->user->all_data('user_type','DESC',$wher);

			if(count($user_type) !='0'){
				$depname = $user_type[0]->name;
			}

			$row[] =  $i++;
			$row[] =  $all_datas->name;
			$row[] =  $all_datas->username;
			$row[] =  $all_datas->email;
			$row[] =  $all_datas->phone;
			$row[] =  $action;
			$data[] = $row;
		}


		// filter_count_all
		$output = array(
                   // "draw" 				=> intval($_POST['draw']),
                    "recordsTotal" 		=> $this->user->count_all('user','DESC'),
                    "recordsFiltered" 	=> $this->user->count_all('user','DESC'),
                    "data" 				=> $data,
            	);
   
    echo json_encode($output);

	//	echo json_encode(array('data' => $data));
	}

	public function delete(){
		$id = $this->input->post('id');
		$this->user->delete('user',$id);
		echo "User deleted succefully.";
		exit();
	}
	public function edit(){
		$id = $this->input->post('id');

		$wher = array('id'=>$id);
		$all_data = $this->user->all_data('user','DESC',$wher);
		echo json_encode($all_data);
	}
	
	public function view(){
		$id = $this->input->post('id');
		$all_data = $this->user->single_data('user',$id);
		$all_branch = $this->user->single_data('user',$all_data[0]->branch);
		
		echo '
			<table class="table table-bordered">
				<tr><td>Name</td><td>'.$all_data[0]->name.'</td></tr>
				<tr><td>Email</td><td>'.$all_data[0]->email.'</td></tr>
				<tr><td>Phone</td><td>'.$all_data[0]->phone.'</td></tr>
				<tr><td>DOB</td><td>'.$all_data[0]->dob.'</td></tr>
				<tr><td>Address</td><td>'.$all_data[0]->address.'</td></tr>
				<tr><td>Branch</td><td>'.$all_branch[0]->name.'</td></tr>
			</table>
		';
		//print_r($all_data); die;
		//echo json_encode($all_data);
	}
}
