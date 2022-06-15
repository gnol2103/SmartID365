<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ResetPasswordController extends CI_Controller
{

    protected $data;
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('array_helper');
        $this->load->library("session");
        $this->load->model('Users');
    }
    public function reset()
    {
        $password = $this->input->post('password');
        $password = md5($password);
        $email = $this->input->post('email');
        $result = false;
        $message = "Chỉnh sửa thông tin thất bại";
        $data = [
            'password' => $password,
        ];
        if ($password != '') {
            $this->Users->resetPass($data, $email);
            $result = true;
            $message = "Chỉnh sửa thông tin thành công";
        }
        echo json_encode([
            'result' => $result,
            'message' => $message
        ]);

    }
}
