<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Stock_model extends CI_Model {
    public function get_all_orders() {
        return $this->db->get('part_orders')->result_array();
    }
    public function get_all_stock_in() {
        return $this->db->get('stock_in')->result_array();
    }
    public function get_all_stock_out() {
        return $this->db->get('stock_out')->result_array();
    }
    // Add insert/update/delete methods as needed
} 