<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Job extends CI_Controller {
    public function __construct() {
        parent::__construct();
        date_default_timezone_set('NZ');
        $this->load->model('job_model', 'job');
        $this->load->model('part_model', 'part');
        $this->load->model('users_model', 'user');

        
        if (($this->session->userdata('user_id') == '') || ($this->session->userdata('user_email') == '') || ($this->session->userdata('user_password') == '')) {
            redirect(base_url('login'));
        }
        
        $permission = explode("--", $_SESSION['permission']);
        $segment1 = $this->uri->segment(1);
        if (!in_array($segment1, $permission)) {
            redirect(base_url('login'));
        }
    }

    public function index() {

        if(isset($_GET['status'])){
            $status_repair =  $_GET['status'];
            
            $where = array('status'=>$status_repair);
            $data['jobs'] = $this->job->where_data('jobs',$where);
        }else{
            $data['jobs'] = $this->job->all_data('jobs', 'DESC');
        }

        

        $user_type = array('type'=>4);
        $data['user'] = $this->job->where_data('user', $user_type);
        $data['branch'] = $this->job->where_data('user', $user_type);

        $utype = array('type'=>3);
        $data['technicians'] = $this->user->all_data('user','DESC',$utype);

        //$data['branch'] = $this->part->all_data('branch');
        $data['brand'] = $this->part->all_data('brand');
        $data['type'] = $this->part->all_data('part_type');
        
        $data['ajax'] = 'job';
        $this->load->view('inc/header');
        $this->load->view('job/all', $data);
        $this->load->view('inc/footer');
    }

    public function add_data() {
        if ($this->input->post()) {
            $job_data = array(
                'branch' => $this->input->post('branch'),
                'email' => $this->input->post('email'),
                'mobile' => $this->input->post('mobile'),
                'customer_name' => $this->input->post('customer_name'),
                'brand' => $this->input->post('brand'),
                'model_no' => $this->input->post('model_no'),
                'issue' => $this->input->post('issue'),
                'fault_frequency' => $this->input->post('fault_frequency'),
                'specified_faults' => $this->input->post('specified_faults'),
                'description' => $this->input->post('description'),
                'date_from' => $this->input->post('date_from'),
                'date_to' => $this->input->post('date_to'),
                //'status' => $this->input->post('status'),
                'assigned_to' => $this->input->post('assigned_to'),
                'added_by' => $this->session->userdata('user_id'),
                'inspection_fee_paid' => $this->input->post('inspection_fee_paid') ? 1 : 0,
                'loan_device_details' => $this->input->post('loan_device_details'),
                'imei_no' => $this->input->post('imei_no'),
                'exceeds' => $this->input->post('exceeds'),
                'security_code' => $this->input->post('security_code'),
            );

            $id = $this->input->post('id');
            if ($id) {
                $this->job->update('jobs', $job_data, $id);
                //echo json_encode(['status' => "success", 'message' => 'Job updated successfully.']);
                echo 'Job updated successfully.';
            } else {
                $job_status = array('status' => 'Pending'); //$this->input->post('status'),
                $mergedArray = array_merge($job_data, $job_status);
                $this->job->insert('jobs', $mergedArray);
                //echo json_encode(['status' => "success", 'message' => 'Job added successfully.']);
                echo 'Job added successfully.';
            }
        }
    }


    public function all_data_ajax(){

        $status_data = $this->input->post('status');
        
        if($status_data !=''){
             if($status_data =="Pending"){
                 $status_data =  "Pending Repairs";
             }
             if($status_data =="Progress"){
                 $status_data =  "In Progress";
             }
             if($status_data =="Waiting"){
                 $status_data =  "Wait";
             }
             if($status_data =="QC"){
                 $status_data =  "QC";
             }
             if($status_data =="Ready"){
                 $status_data =  "Ready";
             }
             if($status_data =="Picked"){
                 $status_data =  "Picked";
             }
             if($status_data =="Approvid"){
                 $status_data =  "Approvid";
             }
             if($status_data =="Couriered"){
                 $status_data =  "Couriered";
             }

            //  '','Done Repairs','','Approvid','','',''  

            $where = array('status'=>$status_data);
            $all_data = $this->job->where_data('jobs',$where);
        }else{
            $all_data = $this->job->all_data('jobs','DESC');
        }
        
        $i =1;
        $data = array();
        foreach($all_data as $key => $all_datas){
            $row = array(); 


            $action = '<div class="btn-group" role="group" aria-label="Basic mixed styles example">';

            if($this->session->userdata('user_type') =='1' OR $this->session->userdata('user_type') =='4'){
                $action .= "<a href='".base_url('job/print/'.$all_datas->id)."' target='_blank' class='btn btn-primary btn-xs m-1'><i class='fa fa-print' aria-hidden='true'></i></a>";
                //$action .= "<a href='#' onclick='return print(".$all_datas->id.")' class='btn btn-primary btn-xs m-1'><i class='fa fa-print' aria-hidden='true'></i></a>";
                $action .= "<button data-toggle='modal' data-target='#view_data' onclick='return view(".$all_datas->id.")' class='btn btn-success btn-xs m-1'><i class='fa fa-eye' aria-hidden='true'></i></button>";
                $action .= "<button data-toggle='modal' data-target='#edit_data' onclick='return edit(".$all_datas->id.")' class='btn btn-info btn-xs m-1'><i class='fas fa-pencil-alt'></i></button>";
                $action .= "<button href='' onclick='return del(".$all_datas->id.")' class='btn btn-danger btn-xs m-1'><i class='fa fa-trash' aria-hidden='true'></i></button>";
            }else{
                $action = "<button  class='btn btn-info btn-xs m-1' disabled><i class='fas fa-pencil-alt'></i></button>";
                $action .= "<button class='btn btn-danger btn-xs m-1' disabled><i class='fa fa-trash' aria-hidden='true'></i></button>";
            }
            $action .= '</div>';


            $found_issue = "<button data-toggle='modal' data-target='#found_issue' onclick='return found_issue(".$all_datas->id.")' class='btn btn-info btn-xs m-1'>Add/View Issue</button>";

            $wher = array('id'=>$all_datas->added_by);
            $depname='';
            $user = $this->user->all_data('user','DESC',$wher);

            $twher = array('id'=>$all_datas->assigned_to);
            $tec = $this->user->all_data('user','DESC',$twher);
            if(count($tec) == 0){
                $assign = "<button data-toggle='modal' data-target='#found_issue' onclick='return found_issue(".$all_datas->id.")' class='btn btn-info btn-xs m-1'>Not Assign</button>";
            }else{
                if($this->session->userdata('user_type') =='5'){
                    $assign = $tec[0]->name;
                }else{
                    $assign = "<button data-toggle='modal' data-target='#assign' onclick='return assign(".$all_datas->id.")' class='btn btn-info btn-xs m-1'>".$tec[0]->name."</button>";
                }
            }

            $bwher = array('id'=>$all_datas->brand);
            $brand = $this->user->all_data('brand','DESC',$bwher);
            if(count($brand) == 0){
                $brands = "None";
            }else{
                $brands = $brand[0]->name;
            }

            $mwher = array('id'=>$all_datas->model_no);
            $model = $this->user->all_data('model','DESC',$mwher);
            if(count($model) == 0){
                $models = "";
            }else{
                $models = $model[0]->name;
            }

            $status_colors = [
                'Pending Repairs' => 'btn-warning',
                'Done Repairs' => 'btn-success',
                'In Progress' => 'btn-primary',
                'Approvid' => 'btn-secondary',
                'Wait' => 'btn-dark',
                'QC' => 'btn-info',
                'Ready' => 'btn-light',
                'Picked' => 'btn-danger',
                'Couriered' => 'btn-success'
            ];

            $btn_class = isset($status_colors[$all_datas->status]) ? $status_colors[$all_datas->status] : 'btn-default';
            if($all_datas->status === 'Couriered'){
                $status = "<button data-toggle='modal' data-target='#status' onclick='return status(".$all_datas->id.")' class='btn ".$btn_class." btn-xs m-1'>".$all_datas->status."</button>";
                $status .= "<button data-toggle='modal' data-target='#couriereStatus' onclick='return couriere(".$all_datas->id.")' class='btn btn-info btn-xs m-1'>Couriere Status</button>";
            }else{
                $status = "<button data-toggle='modal' data-target='#status' onclick='return status(".$all_datas->id.")' class='btn ".$btn_class." btn-xs m-1'>".$all_datas->status."</button>";
            }
            

            
            $row[] =  $i++;
            $row[] =  $all_datas->id;
            $row[] =  $all_datas->customer_name;
            $row[] =  $brands.'<br>'.$models;//$all_datas->model_no;
            $row[] =  $all_datas->date_from."<br>".$all_datas->date_to;
            $row[] =  $all_datas->issue;
            $row[] =  $found_issue;
            $row[] =  $assign;
            $row[] =  $status;//"<button data-toggle='modal' data-target='#status' onclick='return status(".$all_datas->id.")' class='btn ".$btn_class." btn-xs m-1'>".$all_datas->status."</button>";

            $row[] =  $action;
            $data[] = $row;
        }


        // filter_count_all
        $output = array(
                   // "draw"                => intval($_POST['draw']),
                    "recordsTotal"      => $this->user->count_all('user','DESC'),
                    "recordsFiltered"   => $this->user->count_all('user','DESC'),
                    "data"              => $data,
                );
   
    echo json_encode($output);

    //  echo json_encode(array('data' => $data));
    }

    public function delete() {
        $id = $this->input->post('id');
        $this->job->delete('jobs', $id);
        echo json_encode(["status" => "success", "message" => "Job deleted successfully."]);
    }

    public function edit() {
        $id = $this->input->post('id');
        $job = $this->job->single_data('jobs', $id);
        // Ensure new fields are included in the response
        // No specific change needed here if single_data fetches all columns,
        // but good to be mindful.
        echo json_encode($job);
    }

    public function single_model(){
        $bid = $this->input->post('bid');
        $id = $this->input->post('id');
        $job = $this->job->single_data('jobs',$id);
        $where = array('brand_id'=>$bid);
        $all_data = $this->job->where_data('model',$where);
        echo '<option value="">Select Model</option>';
        foreach($all_data as $all){

            $select = "";
            if($job[0]->model_no == $all->id){
                $select = "selected";
            }
            echo '<option value="'.$all->id.'"  '.$select.'>'.$all->name.'</option>';
        }
    }


    public function add_issue() {
        if ($this->input->post()) {
            $job_data = array(
                'issue_list' => $this->input->post('issue_list'),
                'job' => $this->input->post('job'),
                'added_by' => $this->session->userdata('user_id'),
            );

            $id = $this->input->post('id');
            if ($id) {
                $this->job->update('issue', $job_data, $id);
                //echo json_encode(['status' => "success", 'message' => 'Job updated successfully.']);
                echo 'Issue updated successfully.';
            } else {
                $this->job->insert('issue', $job_data);
                //echo json_encode(['status' => "success", 'message' => 'Job added successfully.']);
                echo 'Issue added successfully.';
            }
        }
    }

    public function found_issie(){
        $job = $this->input->post('job');
        $where = array('job'=>$job);
        $issue = $this->job->where_data('issue',$where);

        if(count($issue) !=0){
            $i=1;

            echo "<table class='table'>";
            echo "<tr><th>#</th><th>Found issue</th><th>Create By</th><th>Create at</th></tr>";
             foreach($issue as $list){
                $user = array('id'=>$list->added_by);
                $users = $this->job->where_data('user',$user);

                $type='';
                if($users[0]->type==1){
                    $type='(Admin)';
                }elseif($users[0]->type==2){
                    $type='(Staff)';
                }elseif($users[0]->type==3){
                    $type='(Technician)';
                }elseif($users[0]->type==4){
                    $type='(Branch)';
                }elseif($users[0]->type==5){
                    $type='(Part corntroller)';
                }

                //  1=> admin,2=>staff,3=>technicians,4=>Branch ,5=> Part corntroller

                $formattedDate = date("d F Y - h:i A", strtotime($list->created_at));
                echo "<tr><td>".$i++."</td><td>".$list->issue_list."</td><td>".$users[0]->name.$type."</td> <td>".$formattedDate."</td></tr>";
             }
            echo "</table>";

        }


    }

    public function add_assign() {
        if ($this->input->post()) {
            $job_data = array(
                'assigned_to' => $this->input->post('assigned_to'),
            );

            $id = $this->input->post('id');
            if ($id) {
                $this->job->update('jobs', $job_data, $id);
                //echo json_encode(['status' => "success", 'message' => 'Job updated successfully.']);
                echo 'Assign technician updated successfully.';
            } else {
                $this->job->insert('jobs', $job_data);
                //echo json_encode(['status' => "success", 'message' => 'Job added successfully.']);
                echo 'Assign technician added successfully.';
            }
        }
    }

    public function add_status() {
        if ($this->input->post()) {
            $job_data = array(
                'status' => $this->input->post('status'),
            );

            $id = $this->input->post('job_id');
            if ($id) {
                $this->job->update('jobs', $job_data, $id);
                //echo json_encode(['status' => "success", 'message' => 'Job updated successfully.']);
                echo 'Status updated successfully.';
            } else {
                $this->job->insert('jobs', $job_data);
                //echo json_encode(['status' => "success", 'message' => 'Job added successfully.']);
                echo 'Status added successfully.';
            }
        }
    }

    public function print($id) {
        $where = array('id'=>$id);
        $data['jobs'] = $this->job->where_data('jobs',$where);

        // Ensure new fields are fetched and passed to the view
        // No specific change needed here if where_data fetches all columns,
        // and $data['jobs'] is passed to the view as is.

        $brand_id = array('id'=>$data['jobs'][0]->brand);
        $data['brand'] = $this->job->where_data('brand', $brand_id);

        $model_id = array('id'=>$data['jobs'][0]->model_no);
        $data['model'] = $this->job->where_data('model', $model_id);

        $model_id = array('id'=>$data['jobs'][0]->branch);
        $data['branch'] = $this->job->where_data('branch', $model_id);

        // FIX: Fetch all branches using the correct model/method
        $this->load->model('users_model', 'user');
        $data['all_branches'] = $this->user->all_data('user', 'DESC');

        $data['ajax'] = 'none';
        $this->load->view('inc/header');
        $this->load->view('job/print', $data);
        $this->load->view('inc/footer');
    }

    public function couriereStatus() {
        if ($this->input->post()) {
            $job_data = array(
                'issue_list' => $this->input->post('issue_list'),
                'job' => $this->input->post('job'),
                'added_by' => $this->session->userdata('user_id'),
            );

            $id = $this->input->post('id');
            if ($id) {
                $this->job->update('couriereStatus', $job_data, $id);
                //echo json_encode(['status' => "success", 'message' => 'Job updated successfully.']);
                echo 'Couriere Status updated successfully.';
            } else {
                $this->job->insert('couriereStatus', $job_data);
                //echo json_encode(['status' => "success", 'message' => 'Job added successfully.']);
                echo 'Couriere Status added successfully.';
            }
        }
    }

    public function found_couriereStatus(){
        $job = $this->input->post('job');
        $where = array('job'=>$job);
        $issue = $this->job->where_data('couriereStatus',$where);

        if(count($issue) !=0){
            $i=1;

            echo "<table class='table'>";
            echo "<tr><th>#</th><th>Couriere Status</th><th>Updated By</th><th>Create at</th></tr>";
             foreach($issue as $list){
                $user = array('id'=>$list->added_by);
                $users = $this->job->where_data('user',$user);

                $type='';
                if($users[0]->type==1){
                    $type='(Admin)';
                }elseif($users[0]->type==2){
                    $type='(Staff)';
                }elseif($users[0]->type==3){
                    $type='(Technician)';
                }elseif($users[0]->type==4){
                    $type='(Branch)';
                }elseif($users[0]->type==5){
                    $type='(Part corntroller)';
                }

                //  1=> admin,2=>staff,3=>technicians,4=>Branch ,5=> Part corntroller

                $formattedDate = date("d F Y - h:i A", strtotime($list->created_at));
                echo "<tr><td>".$i++."</td><td>".$list->issue_list."</td><td>".$users[0]->name.$type."</td> <td>".$formattedDate."</td></tr>";
             }
            echo "</table>";

        }


    }


}
