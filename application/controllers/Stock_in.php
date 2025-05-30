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
} 