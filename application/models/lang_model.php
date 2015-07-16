<?php
class Lang_model extends CI_Model{
	protected $_setting = "language";
	public function __construct(){
		parent::__construct();
	}
	
	public function updateItemById($id, $update)
	{
		$this->db->where('id', $id);
		$this->db->update($this->_setting, $update); 
	}
	public function getItemById($id)
	{
		$this->db->where('id', $id);
		$query = $this->db->get($this->_setting);
		if($query->num_rows() > 0)
		{
			return $query->row_array();
		}else
		{
			return NULL;
		}
	}
}