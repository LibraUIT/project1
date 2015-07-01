<?php
class Homesetting_model extends CI_Model{
	protected $_table = "home_setting";
	public function __construct(){
		parent::__construct();
	}
	public function updateItemById($id, $update)
	{
		$this->db->where('id', $id);
		$this->db->update($this->_table, $update); 
	}
	public function getItemById($id)
	{
		$this->db->where('id', $id);
		$query = $this->db->get($this->_table);
		if($query->num_rows() > 0)
		{
			return $query->row_array();
		}else
		{
			return NULL;
		}
	}
}