<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Bill extends CI_Controller
{

    protected $data;
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('array_helper');
        $this->load->library("session");
        $this->load->model("Bills");
        $this->load->helper('fun_helper');
    }
    public function unapproved()
    {
        $duyet = $this->input->post('duyet');
        $result = false;
        $message = "Duyệt hoá đơn không thành công";
        if ($duyet != '') {
            $data = [
                'status' => 1,
                'updated_at' => time(),
            ];
            $this->Bills->update($data,$duyet);
            $result = true;
            $message = "Duyệt hoá đơn thành công";
        }

        echo json_encode([
            'result' => $result,
            'message' => $message,
        ]);
    }
}
