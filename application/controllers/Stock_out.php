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
} 