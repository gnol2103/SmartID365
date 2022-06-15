<?php
defined('BASEPATH') or exit('No direct script access allowed');
class CartLink extends CI_Model
{
    private $_table = 'card_link';
    function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->library('session');
    }
    public function insert($data)
    {
        $this->db->insert($this->_table, $data);
        return $this->db->insert_id();
    }
}
