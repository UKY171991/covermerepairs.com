<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends CI_Controller {
	public function __construct() {
	  parent::__construct();
	  date_default_timezone_set('NZ');
	  $this->load->model('profile_model','profile');
	  
	  if(($this->session->userdata('user_id') =='') OR ($this->session->userdata('user_email') =='') OR ($this->session->userdata('user_password') =='')){
	  	redirect(base_url('login'));
	  }
	  
	}
	public function index()
	{
		$id = $this->session->userdata('user_id');
		$data['all_data'] = $this->profile->single_data('user',$id);
		$data['ajax']='none';
		$this->load->view('inc/header');
		$this->load->view('profile',$data);
		$this->load->view('inc/footer');
	}

	public function add_data(){

		if($this->input->post()){

			$prem['name'] = $this->input->post('name');
			$prem['email'] = $this->input->post('email');
			$prem['phone'] = $this->input->post('phone');
			$prem['address'] = $this->input->post('address');
			

			if($this->input->post('password') !=''){
				$prem['password'] = md5($this->input->post('password'));
			}

			$id = $this->session->userdata('user_id');
			$last_id = $this->profile->update('user',$prem,$id);

			$this->session->set_flashdata('message', 'Profile updated succefully.');
			$this->session->set_flashdata('status', 'success');
			
			redirect(base_url('profile'));

		}
	}

}
