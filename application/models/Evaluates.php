<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Evaluates extends CI_Model
{
	protected $_table = 'evaluates';
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
	public function info()
	{
		$this->db->select('product.*,evaluates.*');
		$this->db->join('product', 'product.id=evaluates.product_id');
		return $this->db->get($this->_table)->result_array();
	}
	
	public function details($id)
	{
		$this->db->select('product.*,users.*,evaluates.*');
		$this->db->join('users', 'users.id = evaluates.user_id','left');
		$this->db->join('product', 'product.id = evaluates.product_id');
		$this->db->where('evaluates.id', $id);
		return $this->db->get($this->_table)->result_array();
	}
	public function select($id)
	{
		$this->db->select('*');
		$this->db->order_by('created_at', 'DESC');
		$this->db->limit(4);
		$this->db->where([
			'product_id' => $id,
		]);
		return $this->db->get($this->_table)->result_array();
	}
	public function avg($id)
	{
		$this->db->select('AVG(star) as avg');
		$this->db->where('product_id', $id);
		return $this->db->get($this->_table)->row_array();
	}
	public function star5($id)
	{
		$this->db->select('COUNT(star) as count');
		$this->db->where('star', 5);
		$this->db->where('product_id', $id);
		return $this->db->get($this->_table)->row_array();
	}
	public function star4($id)
	{
		$this->db->select('COUNT(star) as count');
		$this->db->where('star', 4);
		$this->db->where('product_id', $id);
		return $this->db->get($this->_table)->row_array();
	}
	public function star3($id)
	{
		$this->db->select('COUNT(star) as count');
		$this->db->where('star', 3);
		$this->db->where('product_id', $id);
		return $this->db->get($this->_table)->row_array();
	}
	public function star2($id)
	{
		$this->db->select('COUNT(star) as count');
		$this->db->where('star', 2);
		$this->db->where('product_id', $id);
		return $this->db->get($this->_table)->row_array();
	}

	public function star1($id)
	{
		$this->db->select('COUNT(star) as count');
		$this->db->where('star', 1);
		$this->db->where('product_id', $id);
		return $this->db->get($this->_table)->row_array();
	}
	public function count($id)
	{
		$this->db->select('COUNT(id) as count');
		$this->db->where('product_id', $id);
		return $this->db->get($this->_table)->row_array();
	}
	public function get_current_page_records($limit, $start) 
    {
        $this->db->limit($limit, $start);
        $query = $this->db->get($this->_table);
		
        if ($query->num_rows() > 0) 
        {
            foreach ($query->result() as $row) 
            {
                $data[] = $row;
            }
             
            return $data;
        }
 
        return false;
    }
     
    public function get_total() 
    {
        return $this->db->count_all($this->_table);
    }
}
