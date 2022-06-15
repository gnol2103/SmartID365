<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Users extends CI_Model
{
	protected $_table = 'users';
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
	public function check_login($email, $password)
	{
		$this->db->where('email', $email);
		$this->db->where('password', md5($password));
		$this->db->where('status', 1);
		return $this->db->get($this->_table)->row_array();
	}
	public function profile($id)
	{
		$this->db->select('*');
		$this->db->where([
			'id' => $id,
		]);
		return $this->db->get('users')->row_object();
	}

	public function info()
	{
		$this->db->select('*');
		return $this->db->get($this->_table)->result_array();
	}
	public function select($id)
	{
		$this->db->select('*');
		$this->db->where('id', $id);
		return $this->db->get($this->_table)->row_array();
	}
	// public function delete($id) {
	// 	$this->db->where('id',$id);
	// 	return $this->db->delete($this->_table);
	// }
	public function update($data, $id)
	{
		$this->db->where('id', $id);
		return $this->db->update($this->_table, $data);
	}
	public function updateAvata($data, $id)
	{
		$this->db->set('avatar', $data);
		$this->db->where('id', $id);
		return $this->db->update($this->_table, $data);
	}
	public function updateCover($data, $id)
	{
		$this->db->set('cover', $data);
		$this->db->where('id', $id);
		return $this->db->update($this->_table, $data);
	}
	public function updateRegist($data, $email)
	{
		$this->db->set('status', $data);
		$this->db->where('email', $email);
		return $this->db->update($this->_table, $data);
	}
	public function resetPass($data, $email)
	{
		$this->db->set('password', $data);
		$this->db->where('email', $email);
		return $this->db->update($this->_table, $data);
	}
	public function checkMail($data)
	{
		$this->db->where('email', $data);
		return $this->db->get($this->_table)->row_array();
	}
	public function details($id)
	{
		$this->db->select('users.*, user_details.user_id,user_details.title, user_details.content');
		$this->db->join('user_details', 'user_details.user_id = users.id','left');
		$this->db->where('users.id', $id);
		return $this->db->get($this->_table)->result_array();
	}
	// public function infoInvolve($id,$color) {
	// 	$this->db->select('*');
	// 	$this->db->where('color', $color);
	// 	$this->db->where('id !=', $id);
	// 	return $this->db->get($this->_table)->result_array();
	// }
	public function get_current_page_records($limit, $start) 
    {
        $this->db->limit($limit, $start);
        $query = $this->db->get("users");
 
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
        return $this->db->count_all("users");
    }
}
