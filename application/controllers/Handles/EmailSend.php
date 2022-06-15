<?php
defined('BASEPATH') or exit('No direct script access allowed');

class EmailSend extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper(['array_helper','url']);
        $this->load->library('session');
        $this->load->library('email');
        $this->load->model("Users");
    }
    public function index()
    {
        $this->load->view('email_send.php');
    }

    public function send()
    {
        $to =  $this->input->post('email');
        $_SESSION['email'] = $to;
        $subject = 'Xác thực Email';

        $from = '9a2.c2phuongliet.thephuong@gmail.com';
        $emailContent = '<!DOCTYPE><html><head></head><body>';

        $emailContent .= '<p>Bạn đã đăng ký thành công. Bạn vui lòng ấn xác thực để có thể dùng dịch vụ của SmartID nha</p><br>';
        $emailContent .= '<div>Tài khoản của bạn là : <span>' . $to . '</span></div><br>';
        $emailContent .= '<div>Mật khẩu của bạn là : ******</div><br>';
        $emailContent .= '<a href="'.base_url().'/xac-thuc-tai-khoan.html?email=' . md5($to) . '">Xác thực tài khoản</a> ';

        $emailContent .= "</body></html>";

        $config['protocol']    = 'smtp';
        $config['smtp_host']    = 'ssl://smtp.gmail.com';
        $config['smtp_port']    = '465';
        $config['smtp_timeout'] = '30';

        $config['smtp_user']    = '9a3.c2phuongliet.thephuong@gmail.com';
        $config['smtp_pass']    = 'jejjmulsiyqvtjgk';

        $config['charset']    = 'utf-8';
        $config['newline']    = "\r\n";
        $config['mailtype'] = 'html';
        $config['validation'] = TRUE;

        $this->email->initialize($config);
        $this->email->set_mailtype("html");
        $this->email->from($from);
        $this->email->to($to);
        $this->email->subject($subject);
        $this->email->message($emailContent);
        $this->email->send();

        $this->session->set_flashdata('msg', "Mail đã được gửi thành công. Bạn vui lòng kiểm tra mail nhé ;) ");
        $this->session->set_flashdata('msg_class', 'alert-success');
    }
    public function forgotPass()
    {
        $to =  $this->input->post('email');
        $checkMail = $this->Users->checkMail($to);
        $result = false;
		$message = "Địa chỉ Email này không tồn tại";
        if ($checkMail != NULL) {
            $_SESSION['email'] = $to;
            $subject = 'Đổi mật khẩu';

            $from = '9a2.c2phuongliet.thephuong@gmail.com';
            $emailContent = '<!DOCTYPE><html><head></head><body>';


            $emailContent .= '<p>Bạn vui lòng bấm nút dưới để đổi mật khẩu nhé </p><br>';
            $emailContent .= '<a href="'.base_url().'dat-lai-mat-khau.html?email=' . md5($to) . '" class="changePass">Cập nhật mật khẩu</a> ';


            $emailContent .= "</body></html>";

            $config['protocol']    = 'smtp';
            $config['smtp_host']    = 'ssl://smtp.gmail.com';
            $config['smtp_port']    = '465';
            $config['smtp_timeout'] = '30';

            $config['smtp_user']    = '9a3.c2phuongliet.thephuong@gmail.com';
            $config['smtp_pass']    = 'jejjmulsiyqvtjgk';

            $config['charset']    = 'utf-8';
            $config['newline']    = "\r\n";
            $config['mailtype'] = 'html';
            $config['validation'] = TRUE;

            $this->email->initialize($config);
            $this->email->set_mailtype("html");
            $this->email->from($from);
            $this->email->to($to);
            $this->email->subject($subject);
            $this->email->message($emailContent);
            $this->email->send();
            $this->session->set_flashdata('msg', "Mail đã được gửi thành công. Bạn vui lòng kiểm tra mail nhé ;) ");
            $this->session->set_flashdata('msg_class', 'alert-success');
            $result = true;
            $message = "";
        }
        echo json_encode([
            'result' => $result,
            'message' => $message,
        ]);
    }
}
