<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Vouchers extends CI_Model
{
	protected $_table = 'voucher';
	function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->library('session');
	}
    public function info() {
		$this->db->select('*');
		return $this->db->get($this->_table)->result_array();
	}
	public function check_coupon($coupon) {
		$this->db->where('vou_coupon', $coupon);
		return $this->db->get($this->_table)->row_array();
	}
    public function select($id) {
		$this->db->select('*');
		$this->db->where('id', $id);
		return $this->db->get($this->_table)->row_array();
	}
    public function insert($data) {
		$this->db->insert($this->_table, $data);
		return $this->db->insert_id();
	}
	public function update($data, $id) {
		$this->db->where('id', $id);
		return $this->db->update($this->_table,$data);
	}
}