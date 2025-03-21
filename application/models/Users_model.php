<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users_model extends CI_Model { 

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
	
	public function single_data($table='',$id='')
	{
		$this->db->select('*');
		//$this->db->where('type','2');
		$this->db->where('id',$id);
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

	public function where_data($table='', $where='')
    {
        $this->db->select('*');
        if($where !=''){
            $this->db->where($where);
        }
        $this->db->order_by('id','DESC');
        $query = $this->db->get($table);
        return $query->result();
    }
}
