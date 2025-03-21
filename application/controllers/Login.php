<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

    public function __construct() {
      parent::__construct();
      date_default_timezone_set('NZ');
      $this->load->model('login_mdel','login');
    }

    public function index()
    {
        // If the user is already logged in, redirect to home or dashboard
        if ($this->session->userdata('user_id')) {
            redirect(base_url());
        }

        // Load the login view
        $this->load->view('login');
    }

    public function do_login()
    {

        // Get the input data from the login form
        //$prem['email'] = $this->input->post('email');
        $prem['username'] = $this->input->post('email');
        $prem['password'] = md5($this->input->post('password'));

        $query = $this->login->single_data('user',$prem);

        // Check if a user with the given username exists
        if ($query->num_rows() > 0) {

            $user = $query->row();

            $password = md5($this->input->post('password'));
            // Verify the password
            if ($password == $user->password) {
                // Password is correct, set user data in session
                $this->session->set_userdata('user_id', $user->id);
                $this->session->set_userdata('user_email', $user->email);
                $this->session->set_userdata('user_password', $user->password);
                $this->session->set_userdata('user_type', $user->type);
                $this->session->set_userdata('user_name', $user->username);
                $this->session->set_userdata('name', $user->name);
                $this->session->set_userdata('permission', $user->permission);
                //$this->session->set_userdata('part', $user->permission);

                // Redirect to home or dashboard
                redirect(base_url());
            } else {
                // Password is incorrect, show an error message
                $this->session->set_flashdata('error', 'Invalid username or password.');
                redirect(base_url('login'));
            }
        } else {
            // User does not exist, show an error message
            $this->session->set_flashdata('error', 'Invalid username or password.');
            redirect(base_url('login'));
        }
    }

    public function logout()
    {
        // Destroy the session and redirect to the login page
        $this->session->sess_destroy();
        redirect(base_url('login'));
    }
}
