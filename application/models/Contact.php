<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Contact extends CI_Model
{
	protected $_table = 'contact';
	function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->library('session');
	}
	public function select($id)
	{
		$this->db->select('*');
		$this->db->where([ 'user_id' => $id, ]);
		$this->db->order_by('contact_order','asc');
		return $this->db->get($this->_table)->result_array();
	}
	public function selectCont($id)
	{
		$this->db->select('*');
		$this->db->where('id', $id);
		return $this->db->get($this->_table)->result_array();
	}
    public function insert($data) {
		$this->db->insert($this->_table, $data);
		return $this->db->insert_id();
	}
	public function update($data, $id) {
		$this->db->where('id', $id);
		return $this->db->update($this->_table,$data);
	}
	public function delete($id) {
		$this->db->where('id',$id);
		return $this->db->delete($this->_table);
	}
}
