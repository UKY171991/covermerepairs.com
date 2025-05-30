<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Stock_in extends CI_Controller {
    public function index() {
        $this->load->view('inc/header');
        $this->load->view('stock_in');
        $this->load->view('inc/footer');
    }
} 