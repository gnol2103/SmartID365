<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Products extends CI_Model
{
	protected $_table = 'product';
	function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->library('session');
	}
	public function insert($data) {
		$this->db->insert($this->_table, $data);
		return $this->db->insert_id();
	}
	public function info() {
		$this->db->select('*');
		return $this->db->get($this->_table)->result_array();
	}
	public function info_limit($limit, $skip) {
		$this->db->select('*');
		$this->db->limit($limit,$skip);
		return $this->db->get($this->_table)->result_array();
	}
	public function select($id) {
		$this->db->select('*');
		$this->db->where('id', $id);
		return $this->db->get($this->_table)->row_array();
	}
	public function delete($id) {
		$this->db->where('id',$id);
		return $this->db->delete($this->_table);
	}
	public function update($data, $id) {
		$this->db->where('id', $id);
		return $this->db->update($this->_table,$data);
	}
	public function infoInvolve($id,$color) {
		$this->db->select('*');
		$this->db->where('color', $color);
		$this->db->where('id !=', $id);
		$this->db->order_by('id', 'desc');
		return $this->db->get($this->_table)->result_array();
	}
	public function product()
	{
		$this->db->select('product.*,evaluates.star');
		$this->db->join('evaluates', 'product.id=evaluates.product_id','left');
		return $this->db->get($this->_table)->result_array();
	}
	
}
