<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Branch_model extends CI_Model { 

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
		//$this->db->where('type','2');
		$this->db->order_by('id',$order);
		$query = $this->db->get($table);
		return $query->result();
	}
	public function all_email($table='',$email='')
	{
		$this->db->select('*');
		$this->db->where('email',$email);
		$query = $this->db->get($table);
		return $query->num_rows();
	}
	public function all_username($table='',$username='')
	{
		$this->db->select('*');
		$this->db->where('username',$username);
		$query = $this->db->get($table);
		return $query->num_rows();
	}
	public function all_email_update($table='',$email='',$id='')
	{
		$this->db->select('*');
		$this->db->where('id !=',$id);
		$this->db->where('email',$email);
		$query = $this->db->get($table);
		return $query->num_rows();
	}
	public function all_username_update($table='',$username='',$id='')
	{
		$this->db->select('*');
		$this->db->where('username',$username);
		$this->db->where('id !=',$id);
		$query = $this->db->get($table);
		return $query->num_rows();
	}
	public function single_data($table='',$id='')
	{
		$this->db->select('*');
		//$this->db->where('type','2');
		$this->db->where('id',$id);
		$query = $this->db->get($table);
		return $query->result();
	}
	public function count_all($table='',$order='')
	{
		$this->db->order_by('id',$order);
		$query = $this->db->get($table);
		return $query->num_rows();
	}
	public function delete($table='',$id=''){
		$this->db->where('id',$id);
		$this->db->delete($table);
	}

	public function all_branch()
	{
		$this->db->select('*');
		$this->db->where('type','3');
		$this->db->order_by('name','ASC');
		$query = $this->db->get('user');
		return $query->result();
	}

	public function get_branch()
	{
		return $this->all_branch();
	}

	public function get_branch_by_ids($ids)
    {
        if (empty($ids)) {
            return array();
        }
        $this->db->select('id, name');
        $this->db->from('user');
        $this->db->where_in('id', $ids);
        $query = $this->db->get();
        return $query->result();
    }
}
