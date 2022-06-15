<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Bills extends CI_Model
{
	protected $_table = 'bills';
	function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->library('session');
	}
	public function unapproved()
	{
		$this->db->select('bills.id,bills.bill_name,bills.user_id, bills.phone,bills.address, bills.card_name, bills.note,bills.total_trans,bills.voucher,total_voucher, total_price,bills.status,bills.created_at');
		$this->db->join('users', 'users.id=bills.user_id');
		// $this->db->join('voucher', 'voucher.id=bills.voucher');
		$this->db->where('bills.status', 0);
		return $this->db->get($this->_table)->result_array();
	}
	public function approved()
	{
		$this->db->select('bills.id,bills.bill_name,bills.user_id, bills.phone,bills.address, bills.card_name, bills.note,bills.total_trans,bills.voucher,total_voucher, total_price,bills.status,bills.created_at');
		$this->db->join('users', 'users.id=bills.user_id');
		$this->db->where('bills.status', 1);
		return $this->db->get($this->_table)->result_array();
	}
	public function details($id)
	{
		$this->db->select('*');
		$bills = $this->db->get($this->_table)->result_array();
		$this->db->select('users.*,voucher.*,bill_details.*,product.name,product.price,product.type_sale,product.sale,product.hot,product.color,product.alias,bills.*,city.*,city2.*');
		$this->db->join('users', 'users.id=bills.user_id', 'left');
		$this->db->join('bill_details', 'bill_details.bill_id=bills.id', 'left');
		$this->db->join('product', 'product.id=bill_details.product_id', 'left');
		$this->db->join('city', 'bills.city_id=city.cit_id');
		$this->db->join('city2', 'bills.district_id=city2.dis_id');
		// if ($bills[0]['voucher'] != '') {
		$this->db->join('voucher', 'voucher.id=bills.voucher', 'left');
		// }
		$this->db->where('bills.id', $id);
		return $this->db->get($this->_table)->result_array();
	}
	public function update($data, $id)
	{
		$this->db->where('id', $id);
		return $this->db->update($this->_table, $data);
	}
}
