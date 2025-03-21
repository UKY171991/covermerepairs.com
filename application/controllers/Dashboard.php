<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {  
	public function __construct() {
	  parent::__construct(); 
	  date_default_timezone_set('NZ'); 
	  $this->load->model('Dashboard_model','dashboard');
	  if(($this->session->userdata('user_id') =='') OR ($this->session->userdata('user_email') =='') OR ($this->session->userdata('user_password') =='')){
	  	redirect(base_url('login'));
	  }
	  
	}
	public function index()
	{
		 //$data['all_data'] = $this->dashboard->all_data('jobs','DESC');
	    //print_r($data['all_data']); die;
		 $data['service'] = $this->dashboard->count_all('jobs');
		 $data['pending'] = $this->dashboard->count_all('jobs','Pending Repairs');
		 $data['approvid'] = $this->dashboard->count_all('jobs','Approvid');
		 $data['progress'] = $this->dashboard->count_all('jobs','In Progress');
		 $data['wait'] = $this->dashboard->count_all('jobs','Wait');
		 $data['qc'] = $this->dashboard->count_all('jobs','QC');
		 $data['ready'] = $this->dashboard->count_all('jobs','Ready');
		 $data['picked'] = $this->dashboard->count_all('jobs','Picked');
		 $data['couriered'] = $this->dashboard->count_all('jobs','Couriered');

		 $model['added_by'] =$this->session->userdata('user_id');;
		 $data['model'] = $this->dashboard->count_g('model',$model);
		 $data['brand'] = $this->dashboard->count_g('brand',$model);
		 $data['part_type'] = $this->dashboard->count_g('part_type',$model);
		 $data['part'] = $this->dashboard->count_g('part',$model);

		$data['ajax']='none';
		$this->load->view('inc/header');
		$this->load->view('home/main',$data);
		$this->load->view('inc/footer');
	}
}
