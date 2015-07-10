<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 class Store extends CI_Controller{ 
 	public function __construct(){ 
 		parent::__construct();
 	}

 	public function index()
 	{
 		$this->load->model("Product_model");
 		$products['pro'] = $this->Product_model->listProduct();
 		$view = array(
 			"title" => "Home page / Magic fashion",
 			"template" => "home",
 			"data" => $products
 		);
 		$this->load->view("common/main",$view);
 	}

 	public function viewProduct($id){
 		$this->load->model("Product_model");
 		$result = $this->Product_model->detailProduct($id);
 		$detail['pro'] = $result['0'];
 		$title = $detail['pro']['name'];
 		$view = array(
 			"title" => $title,
 			"template" => "product_detail",
 			"data" => $detail
 		);
 		$this->load->view("common/main", $view);
 	}
 }