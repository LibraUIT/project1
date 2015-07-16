<?php
class Hrlevel_model extends CI_Model{
	protected $_table="hrlevels";
	public function __construct(){
		parent::__construct();
	}
	public function checkExit($name)
	{
		$this->db->where('name', $name);
		$query = $this->db->get($this->_table);
		if($query->num_rows() > 0)
		{
			return "FALSE";
		}else
		{
			return "TRUE";
		}
	}
	public function checkExitLevelId($levelid)
	{
		$this->db->where('level_id', $levelid);
		$query = $this->db->get($this->_table);
		if($query->num_rows() > 0)
		{
			return "FALSE";
		}else
		{
			return "TRUE";
		}
	}
	public function checkExitNotById($id, $name)
	{
		$this->db->where('name', $name);
		$ignore = array($id);
		$this->db->where_not_in('id', $ignore);
		$query = $this->db->get($this->_table);
		if($query->num_rows() >0 )
		{
			return "FALSE";
		}else
		{
			return "TRUE";
		}
	}
	public function checkExitLevelIdNotById($id, $levelid)
	{
		$this->db->where('level_id', $levelid);
		$ignore = array($id);
		$this->db->where_not_in('id', $ignore);
		$query = $this->db->get($this->_table);
		if($query->num_rows() >0 )
		{
			return "FALSE";
		}else
		{
			return "TRUE";
		}
	}
	public function insertItem($insert)
	{
		$this->db->insert($this->_table, $insert);
	}
	public  function getListItem()
	{
		$this->db->order_by('id', 'ASC');
		$query = $this->db->get($this->_table);
		if($query->num_rows() > 0)
		{
			return $query->result_array();
		}else
		{
			return NULL;
		}
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
	public function deleteItemById($id)
	{
		$this->db->where('id', $id);
		$this->db->delete($this->_table); 
	}
}