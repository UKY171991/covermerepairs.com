<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile_model extends CI_Model { 

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
	
	public function single_data($table='',$id='')
	{
		$this->db->select('*');
		$this->db->where('id',$id);
		$query = $this->db->get($table);
		return $query->result();
	}
}
