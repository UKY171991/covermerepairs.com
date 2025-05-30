<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Stock_in extends CI_Controller {
    public function index() {
        $data['ajax'] = 'none';
        $this->load->view('inc/header', $data);
        $this->load->view('stock_in', $data);
        $this->load->view('inc/footer', $data);
    }
} 