<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Part_corntroller extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set('NZ');
        $this->load->model('Users_model');
        $this->load->model('Branch_model');

        if (($this->session->userdata('user_id') == '') or ($this->session->userdata('user_email') == '') or ($this->session->userdata('user_password') == '')) {
            redirect(base_url('login'));
        }

        $permission = explode("--", $_SESSION['permission']);
        $segment1 = $this->uri->segment(1);
        if (!in_array($segment1, $permission)) {
            redirect(base_url('login'));
        }
    }

    public function index()
    {
        $this->data['branch'] = $this->Branch_model->get_branch();
        $this->load->view('part_corntroller/all', $this->data);
    }

    public function add()
    {
        $response = array();
        $this->form_validation->set_rules('fname', 'First Name', 'trim|required');
        $this->form_validation->set_rules('lname', 'Last Name', 'trim|required');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|is_unique[users.email]');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[6]');
        $this->form_validation->set_rules('phone', 'Phone', 'trim|required');

        if ($this->session->userdata('user_type') == '1' || $this->session->userdata('user_type') == '4') {
            $this->form_validation->set_rules('branch_id[]', 'Branch', 'required');
        }

        if ($this->form_validation->run() == true) {
            if ($this->session->userdata('user_type') == '1' || $this->session->userdata('user_type') == '4') {
                $branch_id = implode(',', $this->input->post('branch_id'));
            } else {
                $branch_id = $this->session->userdata('branch_id');
            }

            $data = array(
                'fname' => $this->input->post('fname'),
                'lname' => $this->input->post('lname'),
                'email' => $this->input->post('email'),
                'password' => md5($this->input->post('password')),
                'phone' => $this->input->post('phone'),
                'user_type' => 5, // 5 for Part Controller
                'branch_id' => $branch_id,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            );

            $create = $this->Users_model->create($data);

            if ($create == true) {
                $response['success'] = true;
                $response['messages'] = 'Part Controller added successfully.';
            } else {
                $response['success'] = false;
                $response['messages'] = 'Error in the database while adding the part controller.';
            }
        } else {
            $response['success'] = false;
            $response['messages'] = validation_errors();
        }
        echo json_encode($response);
    }

    public function get_part_corntroller_by_id($id)
    {
        if ($id) {
            $data = $this->Users_model->get_user_by_id($id);
            if ($data) {
                $data->branch_id = explode(',', $data->branch_id);
            }
            echo json_encode($data);
        }
    }

    public function edit($id)
    {
        $response = array();
        if ($id) {
            $this->form_validation->set_rules('fname', 'First Name', 'trim|required');
            $this->form_validation->set_rules('lname', 'Last Name', 'trim|required');
            $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
            $this->form_validation->set_rules('phone', 'Phone', 'trim|required');

            if ($this->session->userdata('user_type') == '1' || $this->session->userdata('user_type') == '4') {
                $this->form_validation->set_rules('branch_id[]', 'Branch', 'required');
            }

            if ($this->form_validation->run() == true) {
                if ($this->session->userdata('user_type') == '1' || $this->session->userdata('user_type') == '4') {
                    $branch_id = implode(',', $this->input->post('branch_id'));
                } else {
                    $branch_id = $this->session->userdata('branch_id');
                }

                $data = array(
                    'fname' => $this->input->post('fname'),
                    'lname' => $this->input->post('lname'),
                    'email' => $this->input->post('email'),
                    'phone' => $this->input->post('phone'),
                    'branch_id' => $branch_id,
                    'updated_at' => date('Y-m-d H:i:s'),
                );

                if ($this->input->post('password') != '') {
                    $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[6]');
                     if ($this->form_validation->run() == true) {
                        $data['password'] = md5($this->input->post('password'));
                     } else {
                        $response['success'] = false;
                        $response['messages'] = validation_errors();
                        echo json_encode($response);
                        return;
                     }
                }

                $update = $this->Users_model->edit($data, $id);

                if ($update == true) {
                    $response['success'] = true;
                    $response['messages'] = 'Part Controller updated successfully.';
                } else {
                    $response['success'] = false;
                    $response['messages'] = 'Error in the database while updating the part controller.';
                }
            } else {
                $response['success'] = false;
                $response['messages'] = validation_errors();
            }
            echo json_encode($response);
        }
    }

    public function get_all_part_corntroller()
    {
        $data = $this->Users_model->get_all_part_corntroller();
        $result = array('data' => array());
        $i = 1;
        foreach ($data as $key => $value) {
            $buttons = '';
            if ($this->session->userdata('user_type') == '1' || $this->session->userdata('user_type') == '4') {
                $buttons .= ' <button type="button" class="btn btn-info btn-sm edit_btn" data-id="' . $value['id'] . '" data-toggle="modal" data-target="#add_modal"><i class="fa fa-edit"></i></button>';
                $buttons .= ' <button type="button" class="btn btn-danger btn-sm delete_btn" data-id="' . $value['id'] . '"><i class="fa fa-trash"></i></button>';
            } else {
                 $buttons .= ' <button type="button" class="btn btn-info btn-sm edit_btn" data-id="' . $value['id'] . '" data-toggle="modal" data-target="#add_modal"><i class="fa fa-edit"></i></button>';
            }

            $branch_names = 'N/A';
            if (!empty($value['branch_id'])) {
                $branch_ids = explode(',', $value['branch_id']);
                $branches = $this->Branch_model->get_branch_by_ids($branch_ids);
                $branch_name_array = array();
                if($branches){
                    foreach ($branches as $branch) {
                        $branch_name_array[] = $branch->name;
                    }
                }
                if(!empty($branch_name_array)){
                    $branch_names = implode(', ', $branch_name_array);
                }
            }


            $result['data'][] = array(
                $i,
                $value['fname'] . ' ' . $value['lname'],
                $value['email'],
                $value['phone'],
                $branch_names,
                $buttons
            );
            $i++;
        }
        echo json_encode($result);
    }

    public function delete($id)
    {
        $response = array();
        if ($id) {
            $delete = $this->Users_model->delete_user($id);
            if ($delete == true) {
                $response['success'] = true;
                $response['messages'] = "Part Controller deleted successfully.";
            } else {
                $response['success'] = false;
                $response['messages'] = "Error in the database while deleting the part controller.";
            }
        } else {
            $response['success'] = false;
            $response['messages'] = "Invalid ID.";
        }
        echo json_encode($response);
    }
}
