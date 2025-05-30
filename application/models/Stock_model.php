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
    public function insert_order($data) {
        $this->db->insert('part_orders', $data);
        return $this->db->insert_id();
    }
    public function update_order($id, $data) {
        $this->db->where('id', $id)->update('part_orders', $data);
        return $this->db->affected_rows();
    }
    public function delete_order($id) {
        $this->db->where('id', $id)->delete('part_orders');
        return $this->db->affected_rows();
    }
    public function insert_stock_in($data) {
        $this->db->insert('stock_in', $data);
        return $this->db->insert_id();
    }
    public function update_stock_in($id, $data) {
        $this->db->where('id', $id)->update('stock_in', $data);
        return $this->db->affected_rows();
    }
    public function delete_stock_in($id) {
        $this->db->where('id', $id)->delete('stock_in');
        return $this->db->affected_rows();
    }
    public function insert_stock_out($data) {
        $this->db->insert('stock_out', $data);
        return $this->db->insert_id();
    }
    public function update_stock_out($id, $data) {
        $this->db->where('id', $id)->update('stock_out', $data);
        return $this->db->affected_rows();
    }
    public function delete_stock_out($id) {
        $this->db->where('id', $id)->delete('stock_out');
        return $this->db->affected_rows();
    }
    // Add insert/update/delete methods as needed
} 