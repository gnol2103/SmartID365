<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CartController extends CI_Controller {

	protected $data;
    public function __construct()
    {
        parent::__construct();
		$this->load->helper('array_helper');
		$this->load->library("session");
    }
}
