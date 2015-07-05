<?php
class Category_model extends CI_Model{
	protected $_table = "categorys";
	public function __construct(){
		parent::__construct();
	}
	
	public function updateItemById($id, $update)
	{
		$this->db->where('category_id', $id);
		$this->db->update($this->_table, $update); 
	}
	public function getItemById($id)
	{
		$this->db->where('category_id', $id);
		$query = $this->db->get($this->_table);
		if($query->num_rows() > 0)
		{
			return $query->row_array();
		}else
		{
			return NULL;
		}
	}
	public function checkName($name)
	{
		$this->db->like('category_name', $name);
		$query = $this->db->get($this->_table);
		if($query->num_rows() > 0)
		{
			return 1;
		}else
		{
			return 0;
		}
	}
	public function checkNameNotId($name, $id)
	{
		$array = array();
		$array[] = $id;
		$this->db->where_not_in('category_id', $array);
		$this->db->like('category_name', $name);
		$query = $this->db->get($this->_table);
		if($query->num_rows() > 0)
		{
			return 1;
		}else
		{
			return 0;
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
		$this->db->where('category_id', $id);
		$this->db->delete($this->_table); 
	}
}