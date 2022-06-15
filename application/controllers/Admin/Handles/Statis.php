<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Statis extends CI_Controller
{

    protected $data;
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('array_helper');
        $this->load->library("session");
        $this->load->model("Statistical");
        $this->load->helper('fun_helper');
    }
    public function search()
    {
        $date_from = $this->input->post('date_from');
        $date_to = $this->input->post('date_to');
        $date_from = ($date_from != "") ? strtotime($date_from) : 0;
        $date_to = ($date_to != "") ? strtotime($date_to) : 0;
        $result = false;
        $message = 'Tìm kiếm không thành công';
        if ($date_from < $date_to) {
            if ($date_from != '' && $date_to != '') {
                $date =  $this->Statistical->search($date_from, $date_to);
                $count = count($date);
                if($count != 0){
                    $result = true;
                    $message = 'Tìm kiếm thành công';
                }
            }
        }

        if ($result == true) {
            echo json_encode([
                'result' => $result,
                'message' => $message,
                'data' => $date,
            ]);
        } else {
            echo json_encode([
                'result' => $result,
                'message' => $message,
                'data' => NULL,
            ]);
        }
    }
}
