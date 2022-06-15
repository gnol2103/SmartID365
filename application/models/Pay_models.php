<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Pay_models extends CI_Model
{
    protected $_table = 'bills';
    protected $_table1 = 'bill_details';
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        //Load session
        $this->load->library('session');
    }
    public function addBill($data){
        $this->db->insert($this->_table, $data);;
        return $this->db->insert_id();
    }
    public function addBillDetails($data){
        $this->db->insert($this->_table1, $data);;
        return $this->db->insert_id();
    }
}