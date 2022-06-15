<?php
defined('BASEPATH') or exit('No direct script access allowed');

class RegistrationController extends CI_Controller
{

	protected $data;
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('array_helper');
		$this->load->library("session");
		$this->load->model("Users");
	}

	public function registrationAccount()
	{
		$email = $this->input->post('email');
		$user_name = $this->input->post('user_name');
		$password = $this->input->post('password');
		$birthday = $this->input->post('birthday');
		$gender = $this->input->post('gender');

		$birthday = ($birthday != "") ? strtotime($birthday) : 0;
		$result = false;
		$message = "Địa chỉ Email này đã tồn tại";
		if ($email != '' && $user_name != '' && $password != '' && $birthday != '' && $gender != '') {
			$checkMail = $this->Users->checkMail($email);
			if ($checkMail == NULL) {
				$data = [
					'email' => $email,
					'user_name' => $user_name,
					'password' => md5($password),
					'date_birth' => $birthday,
					'gender' => $gender,
					'status' => 0,
					'created_at' => time(),
				];
				$this->Users->insert($data);
				$result = true;
				$message = "Đăng ký SMARTID365 thành công";
			}
		}
		echo json_encode([
			'result' => $result,
			'message' => $message
		]);
	}
}
