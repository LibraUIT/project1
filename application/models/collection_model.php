<?php
class Collection_model extends CI_Model{
	protected $_table = "collections";
	public function __construct(){
		parent::__construct();
	}
	
	public function updateItemById($id, $update)
	{
		$this->db->where('collection_id', $id);
		$this->db->update($this->_table, $update); 
	}
	public function getItemById($id)
	{
		$this->db->where('collection_id', $id);
		$query = $this->db->get($this->_table);
		if($query->num_rows() > 0)
		{
			return $query->row_array();
		}else
		{
			return NULL;
		}
	}
	public function insertItem($insert)
	{
		$this->db->insert($this->_table, $insert);
	}
	public function getListLimit($offset = 0, $limit =10)
	{
		$this->db->limit($limit, $offset );
		$this->db->order_by('collection_id', 'DESC');
		$query = $this->db->get($this->_table);
		if($query->num_rows() > 0)
		{
			return $query->result_array();
		}else
		{
			return NULL;
		}
	}
	public function getList()
	{
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
		$this->db->where('collection_id', $id);
		$this->db->delete($this->_table); 
	}
}