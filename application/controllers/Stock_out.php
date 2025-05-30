<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Stock_out extends CI_Controller {
    public function index() {
        $this->load->model('Stock_model', 'stock');
        $data['ajax'] = 'none';
        $data['stock_out'] = $this->stock->get_all_stock_out();
        $this->load->view('inc/header', $data);
        $this->load->view('stock_out', $data);
        $this->load->view('inc/footer', $data);
    }

    public function add_stock_out() {
        $this->load->model('Stock_model', 'stock');
        $data = $this->input->post();
        $id = $this->stock->insert_stock_out($data);
        echo json_encode(['status' => 'success', 'id' => $id]);
    }

    public function edit_stock_out($id) {
        $this->load->model('Stock_model', 'stock');
        $data = $this->input->post();
        $this->stock->update_stock_out($id, $data);
        echo json_encode(['status' => 'success']);
    }

    public function delete_stock_out($id) {
        $this->load->model('Stock_model', 'stock');
        $this->stock->delete_stock_out($id);
        echo json_encode(['status' => 'success']);
    }
} 