<?php
class Tb_model extends CI_Model{
	protected $_table="tbs";
	public function __construct(){
		parent::__construct();
	}
	public function insertItem($name, $idTb, $desc, $note, $timebuy, $timeuse)
	{
		$insert = array(
				"name" => $name,
				"idTb" => $idTb,
				"descTb" => $desc,
				"note" => $note,
				"date_buy" => $timebuy,
				"date_use" => $timeuse
			);
		if($this->db->insert($this->_table, $insert))
		{
			return "TRUE";
		}else
		{
			return "FALSE";
		}

	}
	public function checkExit($idTb)
	{
		$this->db->where('idTb', $idTb);
		$query = $this->db->get($this->_table);
		if($query->num_rows() > 0)
		{
			return "FALSE";
		}else
		{
			return "TRUE";
		}
	}
	public function checkExitNotByIdTb($id, $idTb)
	{
		$this->db->where('idTb', $idTb);
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
	public function updateItemById($update, $id)
	{
		$this->db->where('id', $id);
		$this->db->update($this->_table, $update); 
	}
	public function getItemById($id)
	{
		$this->db->select('*');
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
	public function getItemByIdTb($id)
	{
		$this->db->select('*');
		$this->db->where('idTb', $id);
		$query = $this->db->get($this->_table);
		if($query->num_rows() > 0)
		{
			return $query->row_array();
		}else
		{
			return NULL;
		}
	}
	public function getList()
	{
		$this->db->order_by('id', 'DESC');
		$query = $this->db->get($this->_table);
		if($query->num_rows() > 0)
		{
			return $query->result_array();
		}else
		{
			return NULL;
		}
	}
	public function getListItemLimit($offset, $limit)
	{
		$this->db->limit($offset, $limit);
		$query = $this->db->get($this->_table);
		if($query->num_rows() > 0)
		{
			return $query->result_array();
		}else
		{
			return NULL;
		}
	}
	public function getCountAll()
	{
		return $this->db->count_all($this->_table);
	}
	public function getCountAllResultLimit($offset, $limit)
	{
		$this->db->limit($offset, $limit);
		$this->db->from($this->_table);
		return $this->db->count_all_results();
	}
	public function getListNotUsed()
	{
		/*$this->db->order_by('id', 'DESC');
		$query = $this->db->get($this->_table);*/
		$sql = "SELECT * FROM tbs tb WHERE NOT EXISTS (SELECT * FROM uses u WHERE u.id_tb = tb.id ) ";
		$query = $this->db->query($sql);
		if($query->num_rows() > 0)
		{
			return $query->result_array();
		}else
		{
			return NULL;
		}
	}
	public function checkItemNotUse($id)
	{
		$this->db->where('tb', $id);
		$query = $this->db->get('tb_hr');
		if($query->num_rows() > 0)
		{
			return "FALSE";
		}else
		{
			return "TRUE";
		}
	}
	public function deleteItemById($id)
	{
		$this->db->where('id', $id);
		$this->db->delete($this->_table); 
	}
	public function deleteItemByIdTb($id)
	{
		$this->db->where('idTb', $id);
		$this->db->delete($this->_table); 
	}
	public function getListTb()
	{
		$this->db->where('quantity' , '!=' , 0);
		$this->db->order_by('id', 'DESC');
		$query = $this->db->get($this->_table);
		if($query->num_rows() > 0)
		{
			return $query->result_array();
		}else
		{
			return NULL;
		}
	}
	public function insertTbHR($insert)
	{
		$this->db->insert('tb_hr', $insert);
	}
	public function checkExitTbHr($hr, $tb)
	{
		$this->db->where('tb', $tb);
		$this->db->where('hr', $hr);
		$query = $this->db->get('tb_hr');
		if($query->num_rows() > 0)
		{
			return FALSE;
		}else
		{
			return TRUE;
		}
	}
	public function checkExitTbHrIsHr($hr, $tb, $idTbHr)
	{
		/*$ignore = array($idTbHr);
		$this->db->where_not_in('assign', $ignore);*/
		$where = array(
				"tb" => $tb,
				"hr" => $hr
			);
		$this->db->where($where);
		$ignore = array($idTbHr);
		$this->db->where_not_in('assign', $ignore);
		$query = $this->db->get('tb_hr');
		if($query->num_rows() > 0)
		{
			return FALSE;
		}else
		{
			return TRUE;
		}
	}
	public function deleteItemTbHR($id)
	{
		$this->db->where('assign', $id);
		$this->db->delete('tb_hr'); 
	}
	public function getListTbHr()
	{
		$sql = "SELECT tr.assign, tr.type, tb.name, tr.hr, tr.tb, tr.date FROM tb_hr tr INNER JOIN tbs tb ON tr.tb = tb.idTb ";
		//$query = $this->db->get('tb_hr');
		$query = $this->db->query($sql);
		if($query->num_rows() > 0)
		{
			return $query->result_array();
		}else
		{
			return NULL;
		}
	}
	public function getItemTbHrById($id)
	{
		$sql = "SELECT tb.name, tr.hr, tr.tb, tr.date, tb.descTb, tb.idTb FROM tb_hr tr INNER JOIN tbs tb ON tr.tb = tb.idTb WHERE tr.assign='".$id."'";
		$query = $this->db->query($sql);
		if($query->num_rows() > 0)
		{
			return $query->result_array();
		}else
		{
			return NULL;
		}
	}
}