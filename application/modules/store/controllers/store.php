<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 class Store extends CI_Controller{ 
 	public function __construct(){ 
 		parent::__construct();
 		$this->load->library('rewrite');
 		$this->load->model('Setting_model');
 		$this->load->library('mylang');
 		if($this->session->userdata('lang_portfolio'))
 		{
 			$lang = $this->session->userdata('lang_portfolio');
 			$this->lang->load($lang[0], $lang[1]);
 		}else
 		{
 			$lang = $this->mylang->get_config();
 			$this->lang->load($lang[0], $lang[1]);
 		}
 		$this->session->set_userdata('lang_page',$lang[0]);
 	}

 	public function index()
 	{
 		$id = 1;
 		$portfolio = $this->Setting_model->getItemById($id);
 		$data = unserialize($portfolio['setting_info']);
 		$this->load->model("Product_model");
 		$products['pro'] = $this->Product_model->listProduct();
 		$relatedPro['pro'] = '';
 		$template = array(
 			"id" => "home_page",
 			"page" => "home",
 		);
 		$view = array(
 			"title" => "Home page / ".$data['site_title'],
 			"template" => $template,
 			"data" => $products,
 			"dataRelatedPro" => $relatedPro,
 			"key_work" => $data['key_work'],
 			"description" => $data['description'],
 			"footer" => $data['footer'],
 			"site_name" => $data['site_title']
 		);
 		$this->load->view("common/main",$view);
 	}

 	public function viewProduct($pid){
 		$id = 1;
 		$portfolio = $this->Setting_model->getItemById($id);
 		$data = unserialize($portfolio['setting_info']);
 		$this->load->model("Product_model");
 		$result = $this->Product_model->detailProduct($pid);
 		$detail['pro'] = $result['0'];
 		$cat_id = $result['0']['category_id'];
 		$relatedPro['pro'] = $this->Product_model->relatedProducts($pid, $cat_id);
 		$title = $detail['pro'][$this->session->userdata('lang_page').'_name'];
 		$template = array(
 			"id" => "product_page",
 			"page" => "product_detail"
 		);
 		$view = array(
 			"title" => $title,
 			"template" => $template,
 			"data" => $detail,
 			"dataRelatedPro" => $relatedPro,
 			"key_work" => $data['key_work'],
 			"description" => $data['description'],
 			"footer" => $data['footer'],
 			"site_name" => $data['site_title']
 		);
 		$this->load->view("common/main", $view);
 	}
 	public function products($cid){
 		$id = 1;
 		$portfolio = $this->Setting_model->getItemById($id);
 		$data = unserialize($portfolio['setting_info']);
 		$this->load->model("Category_model");
 		$categorys = $this->Category_model->getList();
 		$this->load->model("Product_model");
 		$cid = explode('-', $cid);
 		if($cid[0] == 0)
 		{
 			$products['pro'] = $this->Product_model->listProduct();
 		}else
 		{
 			$products['pro'] = $this->Product_model->listProductByCategoryId($cid[0]);
 		}
 		
 		$relatedPro['pro'] = '';
 		$template = array(
 			"id" => "home_page",
 			"child_menu" => "true",
 			"page" => "home"
 		);
 		$view = array(
 			"title" => $this->lang->line('text_store_product')." / ".$data['site_title'],
 			"template" => $template,
 			"data" => $products,
 			"dataRelatedPro" => $relatedPro,
 			"key_work" => $data['key_work'],
 			"description" => $data['description'],
 			"footer" => $data['footer'],
 			"site_name" => $data['site_title'],
 			"categorys" => $categorys
 		);
 		$this->load->view("common/main",$view);
 	}
 	public function contact()
 	{
 		$id = 1;
 		$portfolio = $this->Setting_model->getItemById($id);
 		$data = unserialize($portfolio['setting_info']);
 		$template = array(
 			"id" => "contact_page",
 			"child_menu" => "false",
 			"page" => "contact"
 		);
 		$view = array(
 			"title" => $this->lang->line('text_store_contact')."/ ".$data['site_title'],
 			"template" => $template,
 			"data" => array(),
 			"dataRelatedPro" => array(),
 			"key_work" => $data['key_work'],
 			"description" => $data['description'],
 			"footer" => $data['footer'],
 			"site_name" => $data['site_title']
 		);
 		$this->load->view("common/main",$view);
 	}
 	public function set_lang($id)
	{
		switch ($id) {
			case 'vi':
				$lang = array(
					0 => 'vi',
					1 => 'vietnamese'
				);
				break;
			
			case 'en':
				$lang = array(
					0 => 'en',
					1 => 'english'
				);
				break;
		}
		
		$this->session->set_userdata('lang_portfolio',$lang);
		header('location:'.base_url().'store');
	}
	public function searchProduct()
	{
		if($this->input->get('search'))
		{
			$name = $this->input->get('search');
			$this->load->model("Product_model");
			$products['pro'] = $this->Product_model->search($name);
			$id = 1;
	 		$portfolio = $this->Setting_model->getItemById($id);
	 		$data = unserialize($portfolio['setting_info']);
	 		$relatedPro['pro'] = '';
	 		$template = array(
	 			"id" => "contact_page",
	 			"child_menu" => "false",
	 			"page" => "home"
	 		);
	 		$view = array(
	 			"title" => $this->lang->line('text_store_search')." / ".$data['site_title'],
	 			"template" => $template,
	 			"data" => $products,
	 			"products" => $products,
	 			"dataRelatedPro" => $relatedPro,
	 			"key_work" => $data['key_work'],
	 			"description" => $data['description'],
	 			"footer" => $data['footer'],
	 			"site_name" => $data['site_title']
	 		);
	 		$this->load->view("common/main",$view);
		}
		
	}
	public function listProCategory(){
 		$id = 1;
 		$portfolio = $this->Setting_model->getItemById($id);
 		$data = unserialize($portfolio['setting_info']);
 		$relatedPro['pro'] = '';
 		$this->load->model("Product_model");
 		$listPro['pro'] = $this->Product_model->getItembyCategory();
 		$template = array(
 			"id" => "home_page",
 			"page" => "product_cat"
 		);
 		$view = array(
 			"title" => $this->lang->line('text_store_product')." / ".$data['site_title'],
 			"template" => $template,
 			"data" => $listPro,
 			"dataRelatedPro" => $relatedPro,
	 		"key_work" => $data['key_work'],
	 		"description" => $data['description'],
	 		"footer" => $data['footer'],
	 		"site_name" => $data['site_title']
	 		);
	 		$this->load->view("common/main",$view);
		}
 }