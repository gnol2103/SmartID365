<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Voucher extends CI_Controller
{

    protected $data;
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('array_helper');
        $this->load->library("session");
        $this->load->model("Vouchers");
        $this->load->helper('fun_helper');
    }

    public function add_voucher()
    {
        $vou_name = $this->input->post('vou_name');
        $vou_coupon = $this->input->post('vou_coupon');
        $vou_condition = $this->input->post('vou_condition');
        $discount = $this->input->post('discount');
        $ticket_number = $this->input->post('ticket_number');
        $birthday = $this->input->post('birthday');
        $vou_day = $this->input->post('vou_day');
        $thu_select = $this->input->post('thu_select');
        $day_select = $this->input->post('day_select');
        $month_select = $this->input->post('month_select');
        $gender = $this->input->post('gender');
        $gender = ($gender != "") ? $gender : 0;

        // giờ bắt đầu
        $start_time = $this->input->post('start_time');
        $start_time = ($start_time != "") ? strtotime($start_time) : 0;
        // giờ kết thúc
        $time_end = $this->input->post('time_end');
        $time_end = ($time_end != "") ? strtotime($time_end) : 0;
        // ngày bắt đầu
        $start_day = $this->input->post('start_day');
        $start_day = ($start_day != "") ? strtotime($start_day) : 0;
        // ngày kết thúc
        $end_date = $this->input->post('end_date');
        $end_date = ($end_date != "") ? strtotime($end_date) : 0;

        $result = false;
        $message = "Thêm voucher không thành công";
        if ($vou_name != "" && $vou_condition != "" && $vou_coupon != "" && $discount != "" && $ticket_number != "") {
            $data = [
                'vou_name' => $vou_name,
                'vou_coupon' => $vou_coupon,
                'vou_condition' => $vou_condition,
                'discount' => $discount,
                'ticket_number' => $ticket_number,
                'remaining_tickets' => $ticket_number,
                'gender' => $gender,
                'birthday' => $birthday,
                'vou_day' => $vou_day,
                'thu_select' => $thu_select,
                'day_select' => $day_select,
                'month_select' => $month_select,
                'start_time' => $start_time,
                'time_end' => $time_end,
                'start_day' => $start_day,
                'end_date' => $end_date,
                'created_at' => time(),
            ];

            $this->Vouchers->insert($data);
            $result = true;
            $message = "Thêm voucher thành công";
        }
        echo json_encode([
            'result' => $result,
            'message' => $message
        ]);
    }
    public function edit_voucher()
    {
        $id = $this->input->post('id');
        $vou_name = $this->input->post('vou_name');
        $vou_coupon = $this->input->post('vou_coupon');
        $vou_condition = $this->input->post('vou_condition');
        $discount = $this->input->post('discount');
        $ticket_number = $this->input->post('ticket_number');
        $birthday = $this->input->post('birthday');
        $vou_day = $this->input->post('vou_day');
        $thu_select = $this->input->post('thu_select');
        $day_select = $this->input->post('day_select');
        $month_select = $this->input->post('month_select');
        $gender = $this->input->post('gender');
        $gender = ($gender != "") ? $gender : 0;

        // giờ bắt đầu
        $start_time = $this->input->post('start_time');
        $start_time = ($start_time != "") ? strtotime($start_time) : 0;
        // giờ kết thúc
        $time_end = $this->input->post('time_end');
        $time_end = ($time_end != "") ? strtotime($time_end) : 0;
        // ngày bắt đầu
        $start_day = $this->input->post('start_day');
        $start_day = ($start_day != "") ? strtotime($start_day) : 0;
        // ngày kết thúc
        $end_date = $this->input->post('end_date');
        $end_date = ($end_date != "") ? strtotime($end_date) : 0;

        $result = false;
        $message = "Chỉnh sửa voucher không thành công";
        if ($vou_name != "" && $vou_condition != "" && $vou_coupon != "" && $discount != "" && $ticket_number != "" ) {
            $data = [
                'vou_name' => $vou_name,
                'vou_coupon' => $vou_coupon,
                'vou_condition' => $vou_condition,
                'discount' => $discount,
                'ticket_number' => $ticket_number,
                'remaining_tickets' => $ticket_number,
                'gender' => $gender,
                'birthday' => $birthday,
                'vou_day' => $vou_day,
                'thu_select' => $thu_select,
                'day_select' => $day_select,
                'month_select' => $month_select,
                'start_time' => $start_time,
                'time_end' => $time_end,
                'start_day' => $start_day,
                'end_date' => $end_date,
                'updated_at' => time(),
            ];
            $this->Vouchers->update($data, $id);
            $result = true;
            $message = "Chỉnh sửa voucher thành công";
        }
        echo json_encode([
            'result' => $result,
            'message' => $message
        ]);
    }
}
