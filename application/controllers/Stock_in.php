<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Stock_in extends CI_Controller {
    public function index() {
        $data['ajax'] = 'none';
        // Example dynamic data, replace with DB fetch in production
        $data['stock_in'] = [
            [
                'id' => 1,
                'part_name' => 'Example Part',
                'quantity' => 10,
                'date' => '2025-05-30',
                'received_by' => 'Admin',
                'remarks' => 'Sample remark',
            ],
            [
                'id' => 2,
                'part_name' => 'Battery',
                'quantity' => 15,
                'date' => '2025-05-29',
                'received_by' => 'Staff',
                'remarks' => 'Received in good condition',
            ],
        ];
        $this->load->view('inc/header', $data);
        $this->load->view('stock_in', $data);
        $this->load->view('inc/footer', $data);
    }
} 