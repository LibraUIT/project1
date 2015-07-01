<?php
class Use_model extends CI_Model{
	protected $_table="uses";
	public function __construct(){
		parent::__construct();
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
	public function getListItem()
	{
		$sql = "SELECT * FROM uses ORDER BY id DESC";
		$query = $this->db->query($sql);
		return $query->result_array();
	}
	public  function deleteItemById($id)
	{
		$this->db->where('id', $id);
		$this->db->delete($this->_table); 
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
	public function getItemByIdAssign($id)
	{
		$this->db->where('id_use', $id);
		$query = $this->db->get($this->_table);
		if($query->num_rows() > 0)
		{
			return $query->row_array();
		}else
		{
			return NULL;
		}
	}
	public function updateItemById($id, $update)
	{
		$this->db->where('id', $id);
		$this->db->update($this->_table, $update); 
	}
}