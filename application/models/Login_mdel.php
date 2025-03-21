<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login_mdel extends CI_Model { 

	public function insert($table='',$data='')
	{
		$this->db->insert($table,$data);
		return $this->db->insert_id();
	}
	public function update($table='',$data='',$id='')
	{
		$this->db->where('id',$id);
		$this->db->update($table,$data);
		return $this->db->insert_id();
	}
	public function all_data($table='',$order='')
	{
		$this->db->select('*');
		$this->db->order_by('id',$order); 
		$query = $this->db->get($table);
		return $query->result();
	}
	public function single_data($table='',$data='')
	{
		$this->db->select('*');
		$this->db->where($data);
		return $query = $this->db->get($table);
		//return $query->result();
	}
	public function count_all($table='',$order='')
	{
		$this->db->select('*');
		$this->db->order_by('id',$order);
		$query = $this->db->get($table);
		return $query->num_rows();
	}
	public function delete($table='',$id=''){
		$this->db->where('id',$id);
		$this->db->delete($table);
	}
}
