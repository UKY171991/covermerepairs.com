<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard_model extends CI_Model { 

	public function insert($table='',$data='')
	{
		$this->db->insert($table,$data);
		return $this->db->insert_id(); 
	}

	public function all_data($table='',$order='')
	{
		$this->db->select('*');
		if($this->session->userdata('user_type') =='2' AND $table =='job') {
			$this->db->where('assign_user',$this->session->userdata('user_id'));
		}
		//$this->db->where_in('status',array(0,1,2,3));
		$this->db->order_by('id',$order);
		$query = $this->db->get($table);
		return $query->result();
	}

	public function count_all($table='',$status='')
	{
		$this->db->select('*');
		$user_type = $this->session->userdata('user_type');
		$user_id = $this->session->userdata('user_id');
		$branch_id = $this->session->userdata('branch_id'); // Assuming session stores branch_id

		if ($user_type != '1') { // Not an Admin
		    if ($branch_id) {
		        // Assuming your 'jobs' table has a 'branch_id' column
		        // You might need to join tables if branch_id is not directly in the 'jobs' table
		        $this->db->where($table.'.branch_id', $branch_id);
		    }

		    if ($user_type == '3') { // Technician
		        $this->db->where($table.'.added_by', $user_id);
		    } elseif ($user_type == '2') { // Staff
		        // If staff should only see jobs assigned to them within their branch
		        $this->db->where($table.'.assign_user', $user_id);
		    }
		    // Add other role-specific conditions here if needed
		}
		// Admin (user_type == '1') sees all data, so no additional where clauses for admin.

		if($status !=''){
			$this->db->where($table.'.status',$status);
		}
		$query = $this->db->get($table);
		return $query->num_rows();
	}

	public function count_g($table='',$data='') // data is now the $filters array
	{
		$this->db->select('*');
		$user_type = $this->session->userdata('user_type');

		if (!empty($data)) { // $data contains filters like branch_id, added_by
		    foreach ($data as $key => $value) {
		        $this->db->where($table.'.'.$key, $value);
		    }
		}
		// If $data is empty, it implies Admin or no specific filters passed from controller for this count

		$query = $this->db->get($table);
		return $query->num_rows();
	}
}
