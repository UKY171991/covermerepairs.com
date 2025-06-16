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

		 // These counts will be filtered by branch and role in the model's count_all method
		 $data['service'] = $this->dashboard->count_all('jobs');
		 $data['pending'] = $this->dashboard->count_all('jobs','Pending Repairs');
		 $data['approvid'] = $this->dashboard->count_all('jobs','Approvid');
		 $data['progress'] = $this->dashboard->count_all('jobs','In Progress');
		 $data['wait'] = $this->dashboard->count_all('jobs','Wait');
		 $data['qc'] = $this->dashboard->count_all('jobs','QC');
		 $data['ready'] = $this->dashboard->count_all('jobs','Ready');
		 $data['picked'] = $this->dashboard->count_all('jobs','Picked');
		 $data['couriered'] = $this->dashboard->count_all('jobs','Couriered');

		 $user_type = $this->session->userdata('user_type');
		 $user_id = $this->session->userdata('user_id');
		 $branch_id = $this->session->userdata('branch_id'); // Assuming session stores branch_id

		 $count_g_filters = [];
		 if ($user_type != '1') { // Not an Admin
		    if ($branch_id) {
		        $count_g_filters['branch_id'] = $branch_id;
		    }
		    // For specific roles, filter by added_by within their branch
		    if ($user_type == '3' || $user_type == '5') { // Technician or Part Controller
		        $count_g_filters['added_by'] = $user_id;
		    }
		 }
		 // If $count_g_filters is empty, it's an Admin, and no branch/user specific filters are applied here for these counts.

		 $data['model'] = $this->dashboard->count_g('model', $count_g_filters);
		 $data['brand'] = $this->dashboard->count_g('brand', $count_g_filters);
		 $data['part_type'] = $this->dashboard->count_g('part_type', $count_g_filters);
		 $data['part'] = $this->dashboard->count_g('part', $count_g_filters);

		$data['ajax']='none';
		$this->load->view('inc/header');
		$this->load->view('home/main',$data);
		$this->load->view('inc/footer');
	}
}
