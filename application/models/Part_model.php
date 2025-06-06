<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Part_model extends CI_Model { 

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
	public function all_data($table='',$order='',$data='')
	{
		$this->db->select('*');
		if($data !=''){
			$this->db->like($data);
		}
		$this->db->order_by('id',$order);
		$query = $this->db->get($table);
		return $query->result();
	}

	
	public function single_data($table='',$id='')
	{
		$this->db->select('*');
		$this->db->where('id',$id);
		$query = $this->db->get($table);
		return $query->result();
	}

	public function single_stock($table='',$data='')
	{
		$this->db->select('*');
		$this->db->where($data);
		$query = $this->db->get($table);
		return $query->result();
	}

	public function single_modal($table='',$id='')
	{
		$this->db->select('*');
		$this->db->where('brand_id',$id);
		$query = $this->db->get($table);
		return $query->result();
	}

	public function count_all($table='',$order='',$data='')
	{
		$this->db->select('*');
		if($data !=''){
			$this->db->like($data);
		}
		$this->db->order_by('id',$order);
		$query = $this->db->get($table);
		return $query->num_rows();
	}
	public function delete($table='',$id=''){
		$this->db->where('id',$id);
		$this->db->delete($table);
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

	public function get_paginated_data($table='', $limit=10, $offset=0, $order='DESC', $where='')
	{
		$this->db->select('*');
		if($where != ''){
			$this->db->where($where);
		}
		$this->db->order_by('id', $order);
		$this->db->limit($limit, $offset);
		$query = $this->db->get($table);
		return $query->result();
	}
}
