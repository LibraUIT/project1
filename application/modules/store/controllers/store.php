<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 class Store extends CI_Controller{ 
 	public function __construct(){ 
 		parent::__construct();
 		$this->load->library('rewrite');
 		$this->load->model('Setting_model');
 	}

 	public function index()
 	{
 		$id = 1;
 		$portfolio = $this->Setting_model->getItemById($id);
 		$data = unserialize($portfolio['setting_info']);
 		$this->load->model("Product_model");
 		$products['pro'] = $this->Product_model->listProduct();
 		$relatedPro = '';
 		$template = array(
 			"id" => "home_page",
 			"page" => "home",
 		);
 		$view = array(
 			"title" => "Home page / Magic fashion",
 			"template" => $template,
 			"data" => $products,
 			"dataRelatedPro" => $relatedPro,
 			"key_work" => $data['key_work'],
 			"description" => $data['description']
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
 		$relatedPro['info'] = $this->Product_model->relatedProducts($pid, $cat_id);
 		$title = $detail['pro']['name'];
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
 			"description" => $data['description']
 		);
 		$this->load->view("common/main", $view);
 	}
 	public function products(){
 		$id = 1;
 		$portfolio = $this->Setting_model->getItemById($id);
 		$data = unserialize($portfolio['setting_info']);
 		$this->load->model("Product_model");

 		$products['pro'] = $this->Product_model->listProduct();
 		$relatedPro = '';
 		$template = array(
 			"id" => "home_page",
 			"child_menu" => "true",
 			"page" => "home"
 		);
 		$view = array(
 			"title" => "Products / Christian Siriano",
 			"template" => $template,
 			"data" => $products,
 			"dataRelatedPro" => $relatedPro,
 			"key_work" => $data['key_work'],
 			"description" => $data['description']
 		);
 		$this->load->view("common/main",$view);
 	}
 }