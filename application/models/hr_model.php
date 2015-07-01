<?php
class Hr_model extends CI_Model{
	protected $_table="hrs";
	public function __construct(){
		parent::__construct();
	}
	public function checkExit($id_hr)
	{
		$this->db->where('id_hr', $id_hr);
		$query = $this->db->get($this->_table);
		if($query->num_rows() > 0)
		{
			return "FALSE";
		}else
		{
			return "TRUE";
		}
	}
	public function checkExitNotByIdHr($id, $idHr)
	{
		$this->db->where('id_hr', $idHr);
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
		$sql = "SELECT hr.id as id, hr.fullname, hr.id_hr, team.team_id ,team.name as team, level.name as level
		, hr.date_join, hr.email, hr.address, hr.phone, hr.note FROM hrs hr INNER JOIN hrteams team ON hr.team = team.id INNER JOIN hrlevels level ON hr.level = level.id ORDER BY hr.id DESC";
		$query = $this->db->query($sql);
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
	public function getItemByIdHr($id)
	{
		$this->db->where('id_hr', $id);
		$query = $this->db->get($this->_table);
		if($query->num_rows() > 0)
		{
			return $query->row_array();
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
	public function updateItemById($id, $update)
	{
		$this->db->where('id', $id);
		$this->db->update($this->_table, $update); 
	}
	public function getListItemByTeamId($tid)
	{
		$this->db->where('team', $tid);
		$query = $this->db->get($this->_table);
		if($query->num_rows() > 0)
		{
			return $query->result_array();
		}else
		{
			return NULL;
		}
	}
}