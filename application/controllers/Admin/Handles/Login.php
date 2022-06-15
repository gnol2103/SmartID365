<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	protected $data;
    public function __construct()
    {
        parent::__construct();
		$this->load->helper('array_helper');
		$this->load->library("session");
        $this->load->model("Admin");
    }

	public function login()
	{
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        if($username != "" && $password != "")  {
            
            $result_row = $this->Admin->check_login($username, $password);
            $result = false;
            $message = 'Tên đăng nhập hoặc mật khẩu không đúng';
            if($result_row != NULL){
                $id = $result_row['id'];
                $user_name = $result_row['user_name'];

                $this->session->set_userdata('admin',[
                    'id' => $id,
                    'user_name' => $user_name
                ]);
                $result = true;
                $message = 'Đăng nhập thành công';
            }
            echo json_encode([
                'result' => $result,
                'message' => $message
            ]);
        }
	}
	
}
