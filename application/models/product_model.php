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
		$sql = "SELECT c.category_id, c.category_name, p.id, p.en_name, p.vi_name, p.en_description, p.vi_description, p.images, p.price, p.price_new, p.date_created
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
		$sql = 'SELECT c.category_id, c.category_name, p.id, p.en_name, p.vi_name, p.en_description, p.vi_description, p.images, p.price, p.price_new, p.date_created FROM categorys c INNER JOIN products p WHERE c.category_id = p.category_id ORDER BY p.id DESC LIMIT '.(int) $offset.','.$limit.'';
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

	public function listProduct(){
		$this->load->database();
		$this->db->order_by('id', 'DESC');
		$this->db->select("id,en_name, vi_name,price,images, price_new");
		$query = $this->db->get("products");
		if($query->num_rows() > 0)
		{
			return $query->result_array();
		}else
		{
			return NULL;
		}
	}

	public function detailProduct($id){
		$this->load->database();
		$this->db->select("id, category_id, en_name, vi_name, price, price_new, images, en_description, vi_description");
		$this->db->where("id","$id");
		$query = $this->db->get("products");
		if($query->num_rows() > 0){
			return $query->result_array();
		}else
		{
			return NULL;
		}
	}

	public function relatedProducts($id, $cat){
		$this->load->database();
		$this->db->select("id, en_name, vi_name ,price, price_new, images");
		$this->db->where("category_id","$cat");
		$this->db->where("id !=", $id);
		$query = $this->db->get("products",3);
		if($query->num_rows() > 0){
			return $query->result_array();
		}
		else{
			return NULL;
		}
	}
	public function search($name)
	{
		$this->db->like('en_name', $name);
		$this->db->or_like('vi_name', $name); 
		$query = $this->db->get($this->_table);
		if($query->num_rows() > 0)
		{
			return $query->result_array();
		}else
		{
			return NULL;
		} 
	}
	public function getItembyCategory(){
		$this->load->database();
		$list_cats = $this->db->query("SELECT category_id, category_name FROM categorys");
		if($list_cats->num_rows() > 0)
		{
			foreach ($list_cats->result_array() as $value) {
				$cats[$value['category_id']] = $value['category_name'];
			}
		}
		else
		{
			return NULL;
		}
		foreach($cats as $key => $value)
		{
			$data = $this->db->query("SELECT id, name, price, price_new, images FROM products WHERE category_id = $key");
			if($data->num_rows() > 0)
			{	
				$result[$value] = $data->result_array();
			}
			else
			{
				$result = NULL;
			}	
		}
		
		return $result;
	}
	public function listProductByCategoryId($id){
		$this->load->database();
		$this->db->where("category_id", $id);
		$this->db->order_by('id', 'DESC');
		$this->db->select("id,en_name, vi_name ,price,images, price_new");
		$query = $this->db->get("products");
		if($query->num_rows() > 0)
		{
			return $query->result_array();
		}else
		{
			return NULL;
		}
	}
	public function lastitem()
	{
		$this->db->insert_id();
		$this->db->order_by('id', 'DESC');
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