
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class LoginController extends CI_Controller {

	protected $data;
    public function __construct()
    {
        parent::__construct();
		$this->load->helper('array_helper');
		$this->load->library("session");
		$this->load->model("Users");
    }

	public function login()
	{
        $email = $this->input->post('email');
        $password = $this->input->post('password');
		$user_id='';
		$active='';
        if($email != "" && $password != "")  {
            $result_row = $this->Users->check_login($email, $password);
			$result = false;
			$message = 'Đăng nhập thất bại';
            if($result_row != NULL){
                $id = $result_row['id'];
                $user_name = $result_row['user_name'];
				$user_id=$result_row['id'];
				$active=$result_row['active'];
                $this->session->set_userdata('user',[
                    'id' => $id,
                    'user_name' => $user_name
                ]);
                $result = true;
                $message = 'Đăng nhập thành công';
            }
            echo json_encode([
                'result' => $result,
                'message' => $message,
				'user_id'=>$user_id,
				'active'=>$active
            ]);
        }
	}

}
