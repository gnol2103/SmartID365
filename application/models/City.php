<?php
defined('BASEPATH') or exit('No direct script access allowed');
class City extends CI_Model
{
	protected $_table = 'city';
	function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->library('session');
	}
	public function select()
	{
		$this->db->select('*');
		return $this->db->get($this->_table)->result_array();
	}
}