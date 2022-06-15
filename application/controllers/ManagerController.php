<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ManagerController extends CI_Controller
{
	protected $data;
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('array_helper');
		$this->load->library("session");
		$this->load->library('user_agent');
		$this->load->helper('fun_helper');
		$this->load->model("Users");
		$this->load->model("Products");
		$this->load->model("User_details");
		$this->load->model("Contact");
		$this->load->model("City");
		$this->load->model("District");
		$this->load->model("Evaluates");
		date_default_timezone_set('Asia/Ho_Chi_Minh');
	}
	public function checkLogin()
	{
		if (!$this->session->userdata('user')) {
			header('location: /dang-nhap.html');
		}
	}
	public function logout()
	{
		$this->session->unset_userdata('user');
		header('location: /');
	}
	public function tutorial()
	{
		$this->data['title'] = 'Hướng dẫn';
		$this->data['css'] = ['tutorial.css?v=' . version()];
		$this->data['js'] = ['tutorial.js?v=' . version()];
		$this->data['content'] = '/tutorial.php';
		$this->load->view('manager_view', $this->data);
	}

	public function home()
	{
		$this->data['title'] = 'Trang chủ';
		$this->data['css'] = ['home.css?v=' . version()];
		$this->data['content'] = '/home.php';
		$this->load->view('manager_view', $this->data);
	}

	public function login()
	{
		$this->data['title'] = 'Đăng nhập';
		$this->data['css'] = ['registration.css?v=' . version()];
		$this->data['js'] = ['jquery.validate.min.js', 'login.js?v=' . version()];
		$this->data['content'] = '/login.php';
		$this->load->view('manager_view', $this->data);
	}

	public function billInfor()
	{
		$this->checkLogin();
		$this->data['title'] = 'Thông tin thanh toán';
		$this->data['css'] = ['bill_infor.css?v=' . version()];
		$this->data['js'] = ['bill_infor.js?v=' . version()];
		$this->data['content'] = '/bill_infor.php';
		$this->load->view('manager_view', $this->data);
	}

	public function cart()
	{
		$this->checkLogin();
		$this->data['voucher'] = $this->session->userdata('voucher');
		$this->data['city'] = $this->City->select();
		$this->data['district'] = $this->District->select();
		$this->data['title'] = 'Giỏ hàng';
		$this->data['css'] = ['cart.css?v=' . version()];
		$this->data['js'] = ['jquery.validate.min.js', 'cart.js?v=' . version()];
		$this->data['content'] = '/cart.php';
		$payment = $this->input->get('payment');
		$this->data['payment'] = $payment;
		$this->load->view('manager_view', $this->data);
	}

	public function forgotPassword()
	{
		$this->data['title'] = 'Quên mật khẩu';
		$this->data['css'] = ['registration.css?v=' . version()];
		$this->data['js'] = ['jquery.validate.min.js', 'forgot_password.js?v=' . version()];
		$this->data['content'] = '/forgot_password.php';
		$this->load->view('manager_view', $this->data);
	}

	public function mailSend()
	{
		if (!empty($_GET['email'])) {
			if ($_GET['email'] == md5($_SESSION['email'])) {
				$email = $_SESSION['email'];
				$data = [
					'status' => 1,
				];
				$this->Users->updateRegist($data, $email);
				$this->data['js'] = ['jquery.validate.min.js', 'mail_send_success.js?v=' . version()];
			} else {
				$this->output->set_status_header('404');
				$this->load->view('error404');
			}
		} else {
			$this->data['js'] = ['jquery.validate.min.js', 'mail_send.js?v=' . version()];
		}
		$this->data['title'] = 'Xác thực tài khoản';
		$this->data['css'] = ['mail_send.css?v=' . version()];
		$this->data['content'] = '/mail_send.php';
		$this->data['page_content']='Hãy kiểm tra Email chúng tôi đã gửi về **********@gmail.com và làm theo hướng dẫn để xác thực tài khoản.';
		$this->load->view('manager_view', $this->data);
	}

	public function mailForgotPasswordSend(){
		$data=[
			'js'=>['jquery.validate.min.js', 'mail_forgot_password_send.js?v=' . version()],
			'title'=>'Quên mật khẩu',
			'css'=>['mail_send.css?v='.version()],
			'content'=>'/mail_send.php',
			'page_content'=>'Hãy kiểm tra Email chúng tôi đã gửi về **********@gmail.com và làm theo hướng dẫn để đặt lại mật khẩu.'
		];
		$this->load->view('manager_view', $data);
	}

	public function personalPage($id)
	{
		$session = $this->session->userdata('user');
		$prof = $this->Users->profile($id);
		$details = $this->User_details->select($id);
		$contact = $this->Contact->select($id);
		$this->data['title'] = 'Trang cá nhân';
		$this->data['css'] = ['personal_page.css?v=' . version()];
		if ($prof != NULL) {
			if ($id == $session['id']) {
				$this->data['content'] = '/personal_page.php';
				$this->data['js'] = ['jquery.ui.touch-punch.min.js','personal_page.js?v=' . version(),'dropdrag_contact.js'];
			} else {
				$this->data['content'] = '/personal_page_view.php';
			}
		} else {
			echo 'Không có trang cá nhân này';
		}
		$this->data['prof'] = $prof;
		$this->data['details'] = $details;
		$this->data['contact'] = $contact;
		$this->data['contacts'] = contact();
		$this->data['bank'] = bank();
		$this->data['id'] = $session['id'];
		$this->load->view('manager_view', $this->data);
	}

	public function product()
	{
		$this->data['title'] = 'Sản phẩm';
		$this->data['css'] = ['/font-awesome/css/font-awesome.min.css?v=' . version(), 'product.css?v=' . version()];
		$this->data['js'] = ['product.js?v=' . version()];
		$this->data['content'] = '/product.php';
		$this->load->view('manager_view', $this->data);
	}

	public function productDetails($alias, $id)
	{
		$this->data['title'] = 'Chi tiết sản phẩm';
		$this->data['css'] = ['/font-awesome/css/font-awesome.min.css?v=' . version(), 'product_details.css?v=' . version()];
		$this->data['js'] = ['jquery.validate.min.js', 'product_details.js?v=' . version(),];
		$this->data['content'] = '/product_details.php';
		$infoProduct = $this->Products->select($id);
		$session = $this->session->userdata('user');
		$prof_user = $this->Users->profile($session['id']);
		$this->data['user'] = $prof_user;
		$this->data['infoProduct'] = $infoProduct;
		$this->data['eva'] = $this->Evaluates->select($id);
		$this->data['star5'] = $this->Evaluates->star5($id);
		$this->data['star4'] = $this->Evaluates->star4($id);
		$this->data['star3'] = $this->Evaluates->star3($id);
		$this->data['star2'] = $this->Evaluates->star2($id);
		$this->data['star1'] = $this->Evaluates->star1($id);
		$this->data['avg'] = $this->Evaluates->avg($id);
		$this->data['count'] = $this->Evaluates->count($id);
		$this->load->view('manager_view', $this->data);
	}
	public function registration()
	{
		$this->data['title'] = 'Đăng ký';
		$this->data['css'] = ['registration.css?v=' . version()];
		$this->data['js'] = ['jquery.validate.min.js', 'registration.js?v=' . version()];
		$this->data['content'] = '/registration.php';
		$this->load->view('manager_view', $this->data);
	}

	public function resetPassword()
	{
		if (!empty($_GET['email'])) {
			if ($_GET['email'] == md5($_SESSION['email'])) {
				$email = $_SESSION['email'];
			} else {
				$this->output->set_status_header('404');
				$this->load->view('error404');
			}
		}
		$this->data['title'] = 'Đặt lại mật khẩu';
		$this->data['css'] = ['registration.css?v=' . version()];
		$this->data['js'] = ['jquery.validate.min.js', 'reset_password.js?v=' . version()];
		$this->data['content'] = '/reset_password.php';
		$this->data['email'] = $email;
		$this->load->view('manager_view', $this->data);
	}
}
