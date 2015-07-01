<?php
class Hrteam_model extends CI_Model{
	protected $_table="hrteams";
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
	public function checkExitTeamId($teamid)
	{
		$this->db->where('team_id', $teamid);
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
	public function checkExitTeamIdNotById($id, $teamid)
	{
		$this->db->where('team_id', $teamid);
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
	public function getItemByIdTeam($id)
	{
		$this->db->where('team_id', $id);
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