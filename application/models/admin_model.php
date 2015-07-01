<?php
class Admin_model extends CI_Model{
	protected $_user="users";
	public function __construct(){
		parent::__construct();
	}
	public function checkUserLogin($username , $password)
	{
		$this->db->select('*');
    	$this->db->where('u_email', $username);
    	$this->db->where('u_password', $password);
    	$query = $this->db->get($this->_user);
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
        $query = $this->db->get($this->_user);
        return $query->row_array();
    }
}