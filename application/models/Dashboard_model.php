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
		if($this->session->userdata('user_type') =='3') {
			$this->db->where('added_by',$this->session->userdata('user_id'));
		}
		if($status !=''){
			$this->db->where('status',$status);
		}
		$query = $this->db->get($table);
		return $query->num_rows();
	}

	public function count_g($table='',$data='')
	{
		$this->db->select('*');
		if($data !=''){
			$this->db->where($data);
		}
		$query = $this->db->get($table);
		return $query->num_rows();
	}
}
