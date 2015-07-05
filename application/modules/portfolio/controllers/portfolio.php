<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 class Portfolio extends CI_Controller{ 
 	public function __construct(){ 
 		parent::__construct();
 		$this->load->model('Setting_model');
 		$this->load->model('Page_model');
 		$this->load->model('Homesetting_model');
 		$this->load->model('Collection_model');
 		header('Content-Type: text/html; charset=utf-8');
 	}
 	public function index()
 	{
 		$id = 1;
 		$portfolio = $this->Setting_model->getItemById($id);
 		$data = unserialize($portfolio['setting_info']);
 		$about = $this->Page_model->getItemById(2);
 		$contact = $this->Page_model->getItemById(1);
 		$home = $this->Homesetting_model->getItemById(1);
 		$collections = $this->Collection_model->getListLimit(0, 9);
 		$data['about_title'] = $about['page_name'];
 		$data['about_content'] = $about['page_content'];
 		$data['contact_name'] = $contact['page_name'];
 		$data['contact_content'] = $contact['page_content'];
 		$data['link_1_title'] = $home['link_1_title'];
 		$data['link_1_small_title'] = $home['link_1_small_title'];
 		$data['link_1_url'] = $home['link_1_url'];
 		$data['link_2_title'] = $home['link_2_title'];
 		$data['link_2_small_title'] = $home['link_2_small_title'];
 		$data['link_2_url'] = $home['link_2_url'];
 		$data['collections'] = $collections;
 		$this->load->view("index", $data);
 	}
 	public function get_collection_by_id()
 	{
 		$collect_id = $this->input->post('collect_id');
 		$collect_id = explode('_', $collect_id);
 		$collect_id = (int) $collect_id[1];
 		$collection = $this->Collection_model->getItemById($collect_id);
 		header('Content-Type: application/json');
 		echo json_encode($collection);
 	}
 }