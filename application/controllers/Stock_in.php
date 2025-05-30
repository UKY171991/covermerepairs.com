<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Stock_in extends CI_Controller {
    public function index() {
        $this->load->model('Stock_model', 'stock');
        $data['ajax'] = 'none';
        $data['stock_in'] = $this->stock->get_all_stock_in();
        $this->load->view('inc/header', $data);
        $this->load->view('stock_in', $data);
        $this->load->view('inc/footer', $data);
    }

    public function add_stock_in() {
        $this->load->model('Stock_model', 'stock');
        $data = $this->input->post();
        $id = $this->stock->insert_stock_in($data);
        echo json_encode(['status' => 'success', 'id' => $id]);
    }

    public function edit_stock_in($id) {
        $this->load->model('Stock_model', 'stock');
        $data = $this->input->post();
        $this->stock->update_stock_in($id, $data);
        echo json_encode(['status' => 'success']);
    }

    public function delete_stock_in($id) {
        $this->load->model('Stock_model', 'stock');
        $this->stock->delete_stock_in($id);
        echo json_encode(['status' => 'success']);
    }
} 