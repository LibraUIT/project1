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
		$this->db->where('id', $id);
		$query = $this->db->get($this->_table);
		return $query->row_array();
	}
	public function checkPassword($id, $password)
	{
		$this->db->where('id', $id);
		$this->db->where('password', $password);
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
		$this->db->where('id', $id);
		$this->db->update($this->_table, $update); 
	}
}