<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Billty_model extends CI_Model { 

	public function insert($table='',$data='')
	{
		$this->db->insert($table,$data);
		return $this->db->insert_id();
	}

	public function all_data($table='',$order='',$data='')
	{
		$this->db->select('*');
		if($data !=''){
			$this->db->where($data);
		}
		if($order !=''){
			$this->db->order_by('id',$order);
		}
		$query = $this->db->get($table);
		return $query->result();
	}

	public function count_all($table='',$order='',$data='')
	{
		if($data !=''){
			$this->db->where($data);
		}
		if($order !=''){
			$this->db->order_by('id',$order);
		}
		$query = $this->db->get($table);
		return $query->num_rows();
	}

	public function update($table='',$data='',$id='')
	{
		$this->db->where('id',$id);
		$this->db->update($table,$data);
		return $this->db->insert_id();
	}

	public function delete($table='',$id=''){
		$this->db->where('id',$id);
		$this->db->delete($table);
	}
}
