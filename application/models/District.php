<?php
defined('BASEPATH') or exit('No direct script access allowed');
class District extends CI_Model
{
	protected $_table = 'city2';
	function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->library('session');
	}
	public function select()
	{
		$this->db->select('*');
		$this->db->where('dis_type', NULL);
		return $this->db->get($this->_table)->result_array();
	}
	public function selectDis($id)
	{
		$this->db->select('*');
		$this->db->where('dis_parent', $id);
		return $this->db->get($this->_table)->result_array();
	}
}