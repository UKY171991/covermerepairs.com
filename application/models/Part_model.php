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
		$result = $this->db->update($table,$data);
		return $result;
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

	public function get_models_by_brand($brand_id)
	{
		$this->db->select('id, name');
		$this->db->where('brand_id', $brand_id);
		$query = $this->db->get('model');
		return $query->result();
	}

	public function single_data_join($where)
	{
		$this->db->select('part.*, brand.name as brand_name, model.name as model_name, part_type.name as part_type_name, user.name as user_name, branch.name as branch_name');
		$this->db->from('part');
		$this->db->join('brand', 'brand.id = part.brand', 'left');
		$this->db->join('model', 'model.id = part.model', 'left');
		$this->db->join('part_type', 'part_type.id = part.type', 'left');
		$this->db->join('user', 'user.id = part.added_by', 'left');
		$this->db->join('user as branch', 'branch.id = part.branch', 'left');
		$this->db->where($where);
		$query = $this->db->get();
		return $query->row();
	}

	public function single_stock($table='',$data='')
	{
		$this->db->select('*');
		$this->db->where($data);
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
		$result = $this->db->delete($table);
		return $result;
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

	public function get_models_ajax($limit, $offset, $search = []) {
		$this->db->select('*');
		if (!empty($search['name'])) {
			$this->db->like('name', $search['name']);
		}
		if (!empty($search['brand'])) {
			$this->db->like('brand_id', $search['brand']);
		}
		if (!empty($search['user'])) {
			$this->db->like('added_by', $search['user']);
		}
		$this->db->order_by('id', 'DESC');
		$this->db->limit($limit, $offset);
		$query = $this->db->get('model');
		return $query->result();
	}

	public function count_models_ajax($search = []) {
		if (!empty($search['name'])) {
			$this->db->like('name', $search['name']);
		}
		if (!empty($search['brand'])) {
			$this->db->like('brand_id', $search['brand']);
		}
		if (!empty($search['user'])) {
			$this->db->like('added_by', $search['user']);
		}
		return $this->db->count_all_results('model');
	}

	// New methods for proper pagination
	public function count_all_models() {
		return $this->db->count_all('model');
	}

	public function count_filtered_models($search = []) {
		$this->db->select('*');
		$this->db->from('model');
		
		if (!empty($search['name'])) {
			$this->db->like('name', $search['name']);
		}
		if (!empty($search['brand_name'])) {
			$this->db->join('brand', 'brand.id = model.brand_id');
			$this->db->like('brand.name', $search['brand_name']);
		}
		if (!empty($search['user_name'])) {
			$this->db->join('user', 'user.id = model.added_by');
			$this->db->like('user.name', $search['user_name']);
		}
		if (!empty($search['global_search'])) {
			$this->db->group_start();
			$this->db->like('model.name', $search['global_search']);
			$this->db->or_like('brand.name', $search['global_search']);
			$this->db->or_like('user.name', $search['global_search']);
			$this->db->group_end();
		}
		
		return $this->db->count_all_results();
	}

	public function get_paginated_models($search = [], $start = 0, $length = 10) {
		$this->db->select('model.*');
		$this->db->from('model');
		
		if (!empty($search['name'])) {
			$this->db->like('model.name', $search['name']);
		}
		if (!empty($search['brand_name'])) {
			$this->db->join('brand', 'brand.id = model.brand_id');
			$this->db->like('brand.name', $search['brand_name']);
		}
		if (!empty($search['user_name'])) {
			$this->db->join('user', 'user.id = model.added_by');
			$this->db->like('user.name', $search['user_name']);
		}
		if (!empty($search['global_search'])) {
			$this->db->group_start();
			$this->db->like('model.name', $search['global_search']);
			if (!isset($search['brand_name'])) {
				$this->db->join('brand', 'brand.id = model.brand_id', 'left');
			}
			$this->db->or_like('brand.name', $search['global_search']);
			if (!isset($search['user_name'])) {
				$this->db->join('user', 'user.id = model.added_by', 'left');
			}
			$this->db->or_like('user.name', $search['global_search']);
			$this->db->group_end();
		}
		
		$this->db->order_by('model.id', 'DESC');
		$this->db->limit($length, $start);
		
		$query = $this->db->get();
		return $query->result();
	}

	// New methods for part_type pagination
	public function count_all_part_types() {
		return $this->db->count_all('part_type');
	}

	public function count_filtered_part_types($search = []) {
		$this->db->select('*');
		$this->db->from('part_type');
		
		if (!empty($search['name'])) {
			$this->db->like('part_type.name', $search['name']);
		}
		if (!empty($search['user_name'])) {
			$this->db->join('user', 'user.id = part_type.added_by');
			$this->db->like('user.name', $search['user_name']);
		}
		if (!empty($search['global_search'])) {
			$this->db->group_start();
			$this->db->like('part_type.name', $search['global_search']);
			if (!isset($search['user_name'])) {
				$this->db->join('user', 'user.id = part_type.added_by', 'left');
			}
			$this->db->or_like('user.name', $search['global_search']);
			$this->db->group_end();
		}
		
		return $this->db->count_all_results();
	}

	public function get_paginated_part_types($search = [], $start = 0, $length = 10) {
		$this->db->select('part_type.*');
		$this->db->from('part_type');
		
		if (!empty($search['name'])) {
			$this->db->like('part_type.name', $search['name']);
		}
		if (!empty($search['user_name'])) {
			$this->db->join('user', 'user.id = part_type.added_by');
			$this->db->like('user.name', $search['user_name']);
		}
		if (!empty($search['global_search'])) {
			$this->db->group_start();
			$this->db->like('part_type.name', $search['global_search']);
			if (!isset($search['user_name'])) {
				$this->db->join('user', 'user.id = part_type.added_by', 'left');
			}
			$this->db->or_like('user.name', $search['global_search']);
			$this->db->group_end();
		}
		
		$this->db->order_by('part_type.id', 'DESC');
		$this->db->limit($length, $start);
		
		$query = $this->db->get();
		return $query->result();
	}

	// Pagination methods for parts
	public function get_paginated_parts($search = [], $start = 0, $length = 10, $user_branch = null) {
		$this->db->select('part.id, part.price_min, part.price_max, part.stock, brand.name as brand_name, model.name as model_name, part_type.name as part_type_name, user.name as user_name, user.type as user_type');
		$this->db->from('part');
		$this->db->join('brand', 'brand.id = part.brand', 'left');
		$this->db->join('model', 'model.id = part.model', 'left');
		$this->db->join('part_type', 'part_type.id = part.type', 'left');
		$this->db->join('user', 'user.id = part.added_by', 'left');

		if ($user_branch !== null) {
            $this->db->where('part.branch', $user_branch);
        }
		
		// Apply column search filters
		if (!empty($search['brand_name'])) {
			$this->db->like('brand.name', $search['brand_name']);
		}
		if (!empty($search['model_name'])) {
			$this->db->like('model.name', $search['model_name']);
		}
		if (!empty($search['part_type_name'])) {
			$this->db->like('part_type.name', $search['part_type_name']);
		}
		if (!empty($search['user_name'])) {
			$this->db->like('user.name', $search['user_name']);
		}
		
		// Global search
		if (!empty($search['global_search'])) {
			$this->db->group_start();
			$this->db->like('brand.name', $search['global_search']);
			$this->db->or_like('model.name', $search['global_search']);
			$this->db->or_like('part_type.name', $search['global_search']);
			$this->db->or_like('user.name', $search['global_search']);
			$this->db->or_like('part.price_min', $search['global_search']);
			$this->db->or_like('part.price_max', $search['global_search']);
			$this->db->group_end();
		}
		
		$this->db->order_by('part.id', 'DESC');
		
		if ($length != -1) {
			$this->db->limit($length, $start);
		}
		
		$query = $this->db->get();
		return $query->result();
	}
	
	public function count_all_parts($user_branch = null) {
		$this->db->from('part');
		if ($user_branch !== null) {
            $this->db->where('part.branch', $user_branch);
        }
		return $this->db->count_all_results();
	}
	
	public function count_filtered_parts($search = [], $user_branch = null) {
		$this->db->from('part');
		$this->db->join('brand', 'brand.id = part.brand', 'left');
		$this->db->join('model', 'model.id = part.model', 'left');
		$this->db->join('part_type', 'part_type.id = part.type', 'left');
		$this->db->join('user', 'user.id = part.added_by', 'left');

		if ($user_branch !== null) {
            $this->db->where('part.branch', $user_branch);
        }
		
		// Apply column search filters
		if (!empty($search['brand_name'])) {
			$this->db->like('brand.name', $search['brand_name']);
		}
		if (!empty($search['model_name'])) {
			$this->db->like('model.name', $search['model_name']);
		}
		if (!empty($search['part_type_name'])) {
			$this->db->like('part_type.name', $search['part_type_name']);
		}
		if (!empty($search['user_name'])) {
			$this->db->like('user.name', $search['user_name']);
		}
		
		// Global search
		if (!empty($search['global_search'])) {
			$this->db->group_start();
			$this->db->like('brand.name', $search['global_search']);
			$this->db->or_like('model.name', $search['global_search']);
			$this->db->or_like('part_type.name', $search['global_search']);
			$this->db->or_like('user.name', $search['global_search']);
			$this->db->or_like('part.price_min', $search['global_search']);
			$this->db->or_like('part.price_max', $search['global_search']);
			$this->db->group_end();
		}
		
		return $this->db->count_all_results();
	}

	public function get_part_details($id)
	{
		$this->db->select('part.*, brand.name as brand_name, model.name as model_name, part_type.name as part_type_name, user.name as user_name');
		$this->db->from('part');
		$this->db->join('brand', 'brand.id = part.brand', 'left');
		$this->db->join('model', 'model.id = part.model', 'left');
		$this->db->join('part_type', 'part_type.id = part.type', 'left');
		$this->db->join('user', 'user.id = part.added_by', 'left');
		$this->db->where('part.id', $id);
		$query = $this->db->get();
		return $query->row();
	}

}
