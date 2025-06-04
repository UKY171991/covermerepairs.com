<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Stock_out extends CI_Controller {
    public function index() {
        $this->load->model('Stock_model', 'stock');
        $data['ajax'] = 'stock_out';
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

    public function all_stock_out_ajax() {
        $this->load->model('Stock_model', 'stock');
        $all_data = $this->stock->get_all_stock_out();
        $data = array();
        $i = 1;
        foreach ($all_data as $row) {
            $data[] = [
                $i++,
                htmlspecialchars($row['part_name']),
                htmlspecialchars($row['quantity']),
                htmlspecialchars($row['date']),
                htmlspecialchars($row['issued_by']),
                htmlspecialchars($row['remarks']),
                '<button class="btn btn-info btn-xs" onclick="openEditStockOutModal('.$row['id'].', this)">Edit</button> '
                .'<button class="btn btn-danger btn-xs" onclick="deleteStockOut('.$row['id'].', this)">Delete</button>'
            ];
        }
        echo json_encode(['data' => $data]);
    }
} 