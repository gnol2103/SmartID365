<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Cart extends CI_Model
{
	function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->library('session');
	}
	
}