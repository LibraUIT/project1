<?php
class Product_model extends CI_Model{
	protected $_table = "products";
	public function __construct(){
		parent::__construct();
	}
	public function insertItem($insert)
	{
		$this->db->insert($this->_table, $insert);
	}
	public function getList()
	{
		$sql = "SELECT c.category_id, c.category_name, p.id, p.name, p.description, p.images, p.price, p.price_new, p.date_created
		FROM categorys c INNER JOIN products p WHERE c.category_id = p.category_id";
		$query = $this->db->query($sql);
		if($query->num_rows() > 0)
		{
			return $query->result_array();
		}else
		{
			return NULL;
		}
	}
	public function getListLimit($offset = 0 , $limit = 10)
	{
		$sql = 'SELECT c.category_id, c.category_name, p.id, p.name, p.description, p.images, p.price, p.price_new, p.date_created FROM categorys c INNER JOIN products p WHERE c.category_id = p.category_id ORDER BY p.id DESC LIMIT '.(int) $offset.','.$limit.'';
		$query = $this->db->query($sql);
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
	public function updateItemById($id, $update)
	{
		$this->db->where('id', $id);
		$this->db->update($this->_table, $update); 
	}
}