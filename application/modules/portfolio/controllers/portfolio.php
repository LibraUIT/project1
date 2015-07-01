<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 class Portfolio extends CI_Controller{ 
 	public function __construct(){ 
 		parent::__construct();
 		$this->load->model('Setting_model');
 		$this->load->model('Page_model');
 		$this->load->model('Homesetting_model');
 	}
 	public function index()
 	{
 		$id = 1;
 		$portfolio = $this->Setting_model->getItemById($id);
 		$data = unserialize($portfolio['setting_info']);
 		$about = $this->Page_model->getItemById(2);
 		$contact = $this->Page_model->getItemById(1);
 		$home = $this->Homesetting_model->getItemById(1);
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
 		$this->load->view("index", $data);
 	}
 }