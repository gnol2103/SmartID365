<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Admin extends CI_Model
{
	protected $_table = 'admin';
	function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->library('session');
	}
	public function check_login($username, $password) {
		$this->db->where('user_name', $username);
		$this->db->where('password', md5($password));
		return $this->db->get($this->_table)->row_array();
	}

}