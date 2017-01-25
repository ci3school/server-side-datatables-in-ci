<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('usermodel', 'user');
    }

    public function index() {
        $data = array('title' => 'Users');
        $this->template->load('default', 'users/index', '', $data);
    }
    
    public function ajaxUsers() {
        $users = $this->user->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($users as $user) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $user->first_name;
            $row[] = $user->last_name;
            $row[] = $user->phone;
            $row[] = $user->address;
            $row[] = $user->city;
            $row[] = $user->country;
            
            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->user->count_all(),
            "recordsFiltered" => $this->user->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

}
/* End of file Users.php */
/* Location: ./application/controllers/Users.php */