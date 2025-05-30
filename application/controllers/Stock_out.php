<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Stock_out extends CI_Controller {
    public function index() {
        $data['ajax'] = 'none';
        // Example dynamic data, replace with DB fetch in production
        $data['stock_out'] = [
            [
                'id' => 1,
                'part_name' => 'Example Part',
                'quantity' => 5,
                'date' => '2025-05-30',
                'issued_by' => 'Admin',
                'remarks' => 'Sample remark',
            ],
            [
                'id' => 2,
                'part_name' => 'Screen',
                'quantity' => 3,
                'date' => '2025-05-29',
                'issued_by' => 'Staff',
                'remarks' => 'Issued for repair',
            ],
        ];
        $this->load->view('inc/header', $data);
        $this->load->view('stock_out', $data);
        $this->load->view('inc/footer', $data);
    }
} 