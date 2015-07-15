<?php
class User_model extends CI_Model{
	protected $_table="users";
	public function __construct(){
		parent::__construct();
	}
	public function checkUser($username , $password)
	{
		$this->db->select('*');
    	$this->db->where('username', $username);
    	$this->db->where('password', $password);
    	$query = $this->db->get($this->_table);
    	if($query->num_rows() > 0)
    	{
    		return $query->row_array();
    	}
    	else
    	{
    		return "FALSE";
    	}
	}
	public function getUserById($id)
	{
		$this->db->select('*');
		$this->db->where('u_id', $id);
		$query = $this->db->get($this->_table);
		return $query->row_array();
	}
	public function checkPassword($id, $password)
	{
		$this->db->where('u_id', $id);
		$this->db->where('u_password', $password);
		$query = $this->db->get($this->_table);
		if($query->num_rows() > 0)
    	{
    		return "TRUE";
    	}
    	else
    	{
    		return "FALSE";
    	}
	}
	public function updateItemById($id, $update)
	{
		$this->db->where('u_id', $id);
		$this->db->update($this->_table, $update); 
	}
	public function checkEmail($email)
	{
		$this->db->select('*');
    	$this->db->where('u_email', $email);
    	$query = $this->db->get($this->_table);
    	if($query->num_rows() > 0)
    	{
    		return "FALSE";
    	}
    	else
    	{
    		return "TRUE";
    	}
	}
	public function insertItem($insert)
	{
		if($this->db->insert($this->_table, $insert))
		{
			return "TRUE";
		}else
		{
			return "FALSE";
		}

	}
	public function getList()
	{
		$this->db->order_by('u_id', 'DESC');
		$query = $this->db->get($this->_table);
		if($query->num_rows() > 0)
		{
			return $query->result_array();
		}else
		{
			return NULL;
		}
	}
	public function deleteItemById($id)
	{
		$this->db->where('u_id', $id);
		$this->db->delete($this->_table); 
	}
}