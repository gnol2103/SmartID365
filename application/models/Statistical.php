<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Statistical extends CI_Model
{
    function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->library('session');
    }
    public function get_total()
    {
        $user = $this->db->count_all("users");
        $product = $this->db->count_all("product");
        $bills = $this->db->count_all("bills");
        $this->db->select('SUM(total_price) as sum');
        $this->db->where('status',1);
        $doanhthu = $this->db->get('bills')->row_array();
        $count = [$user, $product, $bills, $doanhthu];

        return $count;
    }
    function search($date_from, $date_to)
    {
        $this->db->select('*');
        $this->db->where("created_at BETWEEN '$date_from' AND ' $date_to'");
        $this->db->where("status", 1);
        $query  =   $this->db->get('bills');
        return $query->result();
    }
}
